<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="/css/combobox.css" rel="stylesheet">
@section('content-header')
<style type="text/css">
    .tdTitle {
        text-align: right;
        font-weight: 700;
        width: 20%;
    }

    .tddetail {
        width: 30%;
        text-align: left;
    }

    .countText {
        text-decoration-line: underline;
        cursor: pointer;
    }

    .tableListbooking {
        font-size: 12px;
    }

    .custom-combobox {
        position: relative;
        display: inline-block;

    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox-input {
        margin: 0;
        padding: 5px 10px;
    }

    .custom-combobox {
        position: relative;
        display: inline-block;

    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 2;
        background-color: aliceblue;

    }

    .custom-combobox-input {
        margin: 0;
        padding: 6px 10px;
        min-width: 350px;
        max-width: 95%;
        border: 1px solid #989595;
    }
    #accordion  .setfontnew  h3{
        font-family: "Kanit", sans-serif;
    }
</style>
<!-- /.content-header -->
@endsection
@section('body')
<!-- Page Heading -->
<!-- Main row -->
<div class="container-fluid">
    <div class="row">

        <div class="card w-100">
            <div class="card-header 
            @if($getStatus == "approved")
                text-white bg-success
            @elseif ($getStatus == "canceled")
                 text-white bg-warning
             @elseif ($getStatus == "ForwardDean")
                text-white bg-info
            @else 
                text-white bg-danger
            @endif                 
            
            ">
                <h3>รายละเอียดการขอใช้ห้อง</h3>
            </div>
            <div class="card-body">

                <input type="hidden" id="hinden_bookingID" name="hinden_bookingID" value="{{ $detailBooking[0]->id }}">
                <input type="hidden" id="adminAccount" name="adminAccount" value="{{ Session::get('cmuitaccount') }}">
                <div class="col-md-12 ">
                    <div class="table-responsive">
                        <table class="table text text-start table-light  table-hover ">
                            <tbody>
                                <tr>
                                    <td class="tdTitle"> ห้อง </td>
                                    <td class="text-start  fw-bold text-danger tddetail">
                                        <span id="roomFullName">
                                            {{ $detailBooking[0]->roomFullName }}
                                        </span>
                                    </td>
                                    <td class="tdTitle">วันที่/เวลา</td>
                                    <td class="text-start fw-bold text-danger tddetail">
                                        <span id="booking_date">
                                            {{ $detailBooking[0]->schedule_startdate }} -
                                            {{ $detailBooking[0]->schedule_enddate }}
                                        </span>
                                        <br />
                                        <span id="booking_time" class=" ml-2">
                                            {{ $detailBooking[0]->booking_time_start }} -
                                            {{ $detailBooking[0]->booking_time_finish }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdTitle"> เรื่องที่ขอใช้ </td>
                                    <td class="text-start ">
                                        <span id="booking_subject">
                                            {{ $detailBooking[0]->booking_subject }}
                                        </span>
                                    </td>
                                    <td class="tdTitle"> ประเภทผู้ขอใช้ </td>
                                    </td>
                                    <td class="text-start tddetail">
                                        @if ($detailBooking[0]->booking_type == "general")
                                            บุคคลภายนอก
                                        @else
                                            บุคคลภายใน
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdTitle">ผู้จอง / หน่วยงาน</td>
                                    <td class="text-start tddetail">
                                        <span id="booking_booker">
                                            {{ $detailBooking[0]->booking_booker }}
                                        </span>
                                    </td>
                                    <td class="tdTitle">จำนวนคน </td>
                                    <td class="text-start tddetail">
                                        <span id="booking_ofPeople">
                                            {{ $detailBooking[0]->booking_ofPeople }}</span> คน
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdTitle">เบอร์โทรติดต่อ</td>
                                    <td class="text-start tddetail">
                                        <span id="booking_phone">
                                            {{ $detailBooking[0]->booking_phone }}</span>
                                        </span>
                                    </td>
                                    <td class="tdTitle">Email</td>
                                    <td class="text-start">
                                        <span id="booking_email">
                                            {{ $detailBooking[0]->booking_email }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdTitle">หมายเหตุ</td>
                                    <td class="text-start" colspan="3">
                                        <span id="description">
                                            {{ $detailBooking[0]->description }}
                                        </span>
                                    </td>
                                </tr>
                                @if (!empty($detailBooking[0]->booking_fileurl))
                                    <tr>
                                        <td class="tdTitle"> ไฟล์แนบ </td>
                                        <td class="text-start" colspan="3">
                                            <a href="/storage/upload/{{ $detailBooking[0]->booking_fileurl }} "
                                                target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> เปิดไฟล์</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr />
                @if ($getStatus == 'approved' || $getStatus == 'Newinbox')

                    <div id="accordion">
                        <h3> ตั้งค่า : กำหนดราคาสำหรับการขอใช้สถานที่ </h3>
                        <div>
                            <form id="payment_form" class="row g-3 m-auto setfontnew" method="post" action="/admin/payment/setdata"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <h5>กำหนดราคาสำหรับการขอใช้สถานที่</h5>
                                    <hr>
                                    <div class="form-row mb-3">
                                        <div class="form-group col-md-12 mb-3">
                                            <label for="totalAmount"> ระบุราคา </label>
                                            <input type="number" style="padding: 7px;" placeholder="ระบุราคา" id="totalAmount"
                                                name="totalAmount"></input>
                                        </div>
                                    </div>

                                    <h5 class="mt-3">ข้อมูลที่ใช้ออกใบเสร็จรับเงิน</h5>
                                    <hr>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="cust_name">ชื่อที่แสดงในใบเสร็จรับเงิน</label>
                                            <input type="text" class="form-control" id="cust_name" neme="cust_name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cust_tax">เลขประจำตัวประชาชน/เลขผู้เสียภาษี</label>
                                            <input type="text" class="form-control" id="cust_tax" name="cust_tax">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="cust_email">Email</label>
                                            <input type="email" class="form-control" id="cust_email" name="cust_email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cust_address">ที่อยู่</label>
                                            <input type="text" class="form-control" id="cust_address">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cust_address">รายละเอียดรายการใบเสร็จรับเงิน</label>
                                            <input type="text" class="form-control" id="cust_detail_receipt"
                                                name="cust_detail_receipt">
                                        </div>


                                    </div>
                                    <div class="col-12 mt-3 text-center justify-content-center">
                                        <input type="hidden" id="hinden_bookingID" name="hinden_bookingID" value="{{ $detailBooking[0]->id }}">
                                        <button type="submit" name="submitPayment" id="submitPayment"
                                            class=" btn btn-primary">
                                            <i class="bi bi-floppy"></i> บันทึกข้อมูลการชำระ และออกใบเสร็จรับเงิน

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <h3>ตั้งค่า กำหนดผู้ปฏิบัติงาน</h3>
                        <div>
                            <div class="col-12">

                                <div class="justify-content-center  w-75  setfontnew">
                                    <div class=" d-flex ">
                                        <div>ค้าหาด้วยชื่อผู้ปฏิบัติงาน </div>
                                        <div class="ml-3 mr-3" style="width: 380px;">
                                            <select class=" slcCombobox" name="assignCmu" id="assignEmp">
                                                <option value="">--- เลือก --</option>
                                                @foreach ($sclEmployee as $rows)
                                                    @if (!empty($rows->firstname_TH))
                                                        {{ $fullname = $rows->firstname_TH . ' ' . $rows->lastname_TH}}
                                                    @endif
                                                    <option value="{{$rows->cmuitaccount}}">{{$fullname}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="text-start ml- " align="left">
                                            <button type="button" class="btn btn-secondary btnAddEmp ">
                                                <i class="bi bi-plus-circle-fill"></i> เพิ่ม
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dispaly_listAssign mt-5">

                                    <table class="table table-sm " id="empbyEach">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ขื่อ นามสกุล</th>
                                                <th>หน่วยงาน</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="Trresponse">

                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>
                       
                    </div>






                @endif

                <form id="approve_booking_form" class="row g-3 m-auto" method="post" action="#"
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" col-md-12 p-2 mt-3">
                        <div class="" style="width: 80%;margin: 10px auto;">
                            @if ($getStatus == 'Newinbox')
                                <div
                                    class="text-center justify-content-center   p-3 border border-danger bg-light bg-opacity-10 m-auto fw-bold">
                                    <div style="font-size: 20px;font-weight: 700;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="chkStatus" id="action2"
                                                value="approved" checked />
                                            <label class="form-check-label" for="action2">อนุมัติรายการ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="chkStatus" id="action1"
                                                value="canceled" />
                                            <label class="form-check-label" for="action1">ไม่อนุมติ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="chkStatus" id="action3"
                                                value="ForwardDean" />
                                            <label class="form-check-label" for="action3"> ส่งต่อผู้บริหาร
                                            </label>
                                        </div>
                                    </div>
                                    <div class="p-2 text-left">
                                        <hr />
                                        * หมายเหตุ
                                        <div class="text-danger">* การ "ไม่อนุมติ" คือการยกเลิกรายการจองห้อง
                                            โดยจะถูกลบออกและจะมีผลทันที กรุณาตรวจสอบก่อนยกเลิก </div>
                                        <div class="text-danger">* การ "ส่งต่อผู้บริหาร" คือ
                                            การส่งให้ผู้บริหารอนุมัติรายการขอใช้ห้อง
                                            และท่านจะไม่สามารถทำการอนุมัติรายการนี้ได้อีก </div>
                                    </div>
                                    <button type="submit" id="btnActionssubmit" class="btn btn-primary mx-3">
                                        ดำเนินการ
                                    </button>


                                </div>
                            @elseif ($getStatus == 'ForwardDean')
                                <div class="alert alert-info d-flex- align-items-center text-center" role="alert">
                                    <div>
                                        <h1><i class="bi bi-skip-forward-circle"></i></h1>
                                        <h3>รายการถูกส่งต่อให้ผู้บริหาร </h3>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            @elseif ($getStatus == 'canceled')
                                <div class="alert alert-warning d-flex- align-items-center text-center" role="alert">
                                    <div>
                                        <h1><i class="bi bi-slash-circle"></i></h1>
                                        <h3>ยกเลิกรายการแล้ว</h3>
                                    </div>
                                    <div>
                                        ถูกยกเลิกโดย : <span id="admin_action_acount">
                                            {{ $getService->getFullNameCmuAcount($detailBooking[0]->admin_action_acount)}}
                                        </span> <br />
                                        เมื่อ : <span id="admin_action_date">
                                            {{ $getService->convertDateThai($detailBooking[0]->admin_action_date, '', true) }}
                                        </span>
                                        <hr />
                                    </div>
                                </div>
                            @elseif ($getStatus == 'approved')
                                <div class="alert alert-success d-flex- align-items-center text-center" role="alert">
                                    <div>
                                        <h1><i class="bi bi-check-circle-fill"></i></h1>
                                        <h3>รายการอนุมัติแล้ว</h3>
                                    </div>
                                    <div class="">
                                        อนุมติโดย :
                                        <span id="admin_action_acount">
                                            {{  $getService->getFullNameCmuAcount($detailBooking[0]->admin_action_acount)}}
                                        </span>
                                        <br />
                                        เมื่อ : <span id="admin_action_date">
                                            {{ $getService->convertDateThai($detailBooking[0]->admin_action_date, '', true)}}
                                        </span>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </form>
                <div class="text-center m-3"><a
                        href="/print/form/booking/{{$detailBooking[0]->id}}/{{$detailBooking[0]->bookingToken}}"
                        class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
                        พิมพ์แบบฟอร์มการขอใช้ห้อง </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('corescript')
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/slccombobox.js"></script>
<script>
    $(function () {
        $("#tableListbooking").DataTable({
            order: [0, 'ASC']
        });
        $("#accordion").accordion({
            heightStyle: "content"
        });
        $(document).on('click', '.btnAddEmp', function (e) {
            $.ajax({
                url: "/admin/assignEmployee",
                method: 'get',
                data: {
                    cmuitaccount: $("#assignEmp").val(),
                    bookingId: $("#hinden_bookingID").val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Successfully !',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {

                            getAssign();
                            (".custom-combobox-input").val('');
                            $("#assignEmp").val("0").change();
                        });
                    }
                }
            });
        });

        function getAssign() {
            $.ajax({
                url: "{{ url('/admin/getAssignEmployee') }}",
                method: 'get',
                data: {
                    bookingId: $("#hinden_bookingID").val(),
                    _time: Math.random(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    var tr = "<tr>";
                    var prename = "";
                    $.each(response.listemp, function (i, element) {
                        prename = (element.typeposition_id == 1) ? element.position_work : element.prename_TH
                        tr += "<td></td>";
                        tr += "<td>" + prename + ' ' + element.firstname_TH + ' ' + element.lastname_TH + "</td>";
                        tr += "<td>" + element.dep_name + "</td>";
                        tr += '<td><a href="#" id="' + element.id + '"  class="text-danger mx-1 deleteEmp"> <i class="bi-trash h4"></i></a></td>';
                        tr += "</tr>";
                    });
                    $('.Trresponse').html(tr);
                }
            });
        }

        // Delete  ajax request
        $(document).on('click', '.deleteEmp', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'ต้องการลบข้อมูลใช่หรือไม่ ?',
                text: "การลบข้อมูลจะมีผลทันที และไม่สามารถย้อนกลับได้ !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน, ลบข้อมูลนี้ !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/delete/assignEmployee",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result) => {
                                getAssign()
                            });
                        }
                    });
                }
            })
        });

        // ทำการอนุมัติ / ไม่อนุมัติ /ส่งต่อผู้บริหาร
        $("#approve_booking_form").submit(function (e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: "{{ url('/admin/approveBooking') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Successfully !',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });
        getAssign();
    });
</script>
@endsection