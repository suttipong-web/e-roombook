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

        #accordion .setfontnew h3 {
            font-family: "Kanit", sans-serif;
        }

        .setFn {
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
                <div
                    class="card-header 
            @if ($getStatus == 'approved') text-white bg-success
            @elseif ($getStatus == 'canceled')
                 text-white bg-warning
             @elseif ($getStatus == 'ForwardDean')
                text-white bg-info
            @else 
            text-white bg-danger @endif                             
            ">
                    <h4>รายละเอียดการขอใช้ห้อง</h4>
                </div>
                <div class="card-body">

                    <input type="hidden" id="hinden_bookingID" name="hinden_bookingID" value="{{ $detailBooking[0]->id }}">
                    <input type="hidden" id="adminAccount" name="adminAccount" value="{{ Session::get('cmuitaccount') }}">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            <table class="table text text-start table-light ">
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
                                            @if ($detailBooking[0]->booking_type == 'general')
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
                                                {{ $detailBooking[0]->booking_booker }} <br />
                                                {{ $detailBooking[0]->booking_department }}
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

                    <div class="col-12">
                        <div class=" col-12 mb-3">
                            <h5 class="setFn">มีการกำหนดราคาสำหรับการขอใช้สถานที่ : {{ $detailBooking[0]->totalAmount }}
                                บาท
                            </h5>
                            <hr />
                        </div>

                        <div class="col-12 mt-2">
                            <h5>โดยมีเจ้าหน้าที่ผู้เกี่ยวข้องและปฏิบัติงาน ดังนี้. </h5>
                            <div class="dispaly_listAssign ">
                                <table class="table table-sm  setFn" id="empbyEach">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ขื่อ นามสกุล</th>
                                            <th>หน่วยงาน</th>
                                        </tr>
                                    </thead>
                                    <tbody class="Trresponse">
                                        @if (count($sclEmployee) > 0)
                                            <?php $i = 0; ?>
                                            @foreach ($sclEmployee as $rows)
                                                <?php $prename = $rows->typeposition_id == 1 ? $rows->positionName : $rows->prename_TH;
                                                $fullname = $prename . ' ' . $rows->firstname_TH . ' ' . $rows->lastname_TH;
                                                $i += 1;
                                                ?>
                                                <tr>
                                                    <td>{{ $i }}.</td>
                                                    <td>{{ $fullname }}</td>
                                                    <td>{{ $rows->dep_name }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <form id="approve_booking_form" class="row g-3 m-auto" method="post"
                            action="/admin/dean/approveBooking" enctype="multipart/form-data">
                            @csrf
                            <div class=" col-md-12 p-2 mt-3">
                                <div class="" style="width: 80%;margin: 10px auto;">
                                    @if ($getStatus == 'Newinbox')
                                        <div
                                            class="text-center justify-content-center   p-3 border border-danger bg-light bg-opacity-10 m-auto fw-bold">
                                            <div style="font-size: 20px;font-weight: 700;">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="action2">
                                                        @if (session('user_type') == 'dean')
                                                            <inpgit ut class="form-check-input" type="radio"
                                                                name="chkStatus" id="action2" value="3" checked />
                                                            อนุมัติรายการ
                                                        @else
                                                            @if ($detailBooking[0]->booking_type == 'major' || session('user_type') == 'eng')
                                                                | &nbsp;<input class="form-check-input" type="radio"
                                                                    name="chkStatus" id="action2" value="3"
                                                                    checked />
                                                                อนุมัติรายการ &nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;
                                                            @endif

                                                            <input class="form-check-input" type="radio" name="chkStatus"
                                                                id="action2" value="1" checked />
                                                            ทราบ / ส่งต่อผู้บริหาร
                                                        @endif
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    |&nbsp;<input class="form-check-input" type="radio" name="chkStatus"
                                                        id="action1" value="2" />
                                                    <label class="form-check-label" for="action1">ไม่อนุมติ</label>
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
                                            <input type="hidden" name="hinden_bookingID"
                                                value="{{ $detailBooking[0]->id }}">
                                            <input type="hidden" name="hinden_stepapporveId"
                                                value="{{ $stepapporveId }}">

                                            <button type="submit" id="btnActionssubmit" class="btn btn-primary mx-3">
                                                ดำเนินการ
                                            </button>


                                        </div>
                                    @elseif ($getStatus == 'approved')
                                        <div class="alert alert-success d-flex- align-items-center text-center"
                                            role="alert">
                                            <div>
                                                <h1><i class="bi bi-check-circle-fill"></i></h1>
                                                <h3>รายการอนุมัติแล้ว</h3>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>

                        </form>
                        <!-- <div class="text-center m-3"><a
                                                                                                                                                                                                                                            href="/print/form/booking/{{ $detailBooking[0]->id }}/{{ $detailBooking[0]->bookingToken }}"
                                                                                                                                                                                                                                            class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i>
                                                                                                                                                                                                                                            พิมพ์แบบฟอร์มการขอใช้ห้อง </a>
                                                                                                                                                                                                                                    </div> -->
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @section('corescript')
        <script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/slccombobox.js"></script>
        <script>
            $(function() {
                $("#tableListbooking").DataTable({
                    order: [0, 'ASC']
                });

                // ทำการอนุมัติ / ไม่อนุมัติ /ส่งต่อผู้บริหาร
                $("#approve_booking_form").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    console.log('start');
                    $.ajax({
                        url: "/admin/dean/approveBooking",
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.status == 200) {
                                Swal.fire({
                                    title: 'Successfully !',
                                    text: response.message,
                                    icon: 'success'
                                }).then((result) => {
                                    // GO to page with status          
                                    window.location.href = '/admin/stepapporve';
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
