<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')

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
</style>
<!-- /.content-header -->
@endsection
@section('body')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Dashboard </h1>
</div>

<!-- Main row -->
<div class="row">
    <div class="container-fluid">
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-danger text-uppercase mb-1">
                                    รายาการมาใหม่</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <span class="CountNewInbox countText" status="Newinbox">{{ $CountNewInbox }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope fa-2x text-gray-300"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-info text-uppercase mb-1">
                                    รายการที่ส่งต่อผู้บริหาร</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <span class="CountForward countText" status="ForwardDean"> {{ $CountForward }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-share-square fa-2x text-gray-300"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-warning text-uppercase mb-1">
                                    รายการที่ถูกยกเลิก </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <span class="CountCanceled countText" status="canceled">{{ $CountCanceled }} </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-window-close fa-2x text-gray-300"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class=" font-weight-bold text-success text-uppercase mb-1">รายการที่อนุมัติ
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">

                                        <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <span class="CountApprove countText"
                                                status="approved">{{ $CountApprove }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="row">
    <div class="container-fluid">
        <div class="card  mt-3">
            <div class="card-header 
            @if ($getStatus == 'Newinbox') bg-danger
            @elseif ($getStatus == 'ForwardDean') bg-info
            @elseif ($getStatus == 'canceled') bg-warning
            @elseif ($getStatus == 'approved') bg-success @endif
             ">
                <a href="#" style="color: aliceblue">
                    <i class="bi bi-tags"></i> {{ $titlesCard }}
                </a>
            </div>
            <div class="card-body  disPlayTableBooking">

                <table class="table table-hover  table-sm mt-2" id="tableListbooking">
                    <thead class="table-secondary">
                        <tr style="text-align: left;">
                            <th width="15%">วันที่ทำรายการ</th>
                            <th width="12%">ช่วงเวลาขอใช้</th>
                            <th width="25%">ห้องที่ขอใช้</th>
                            <th width="25%">เรื่อง</th>
                            <th width="13%">ผู้จอง</th>
                            <th width="10%">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($getBookingList) > 0)
                            @foreach ($getBookingList as $rows)
                                <tr style="text-align: left;">
                                    <td>
                                        {{ $getService->convertDateThai($rows->booking_at, true, true) }}
                                    </td>
                                    <td>{{ $rows->booking_time_start }} - {{ $rows->booking_time_finish }}</td>
                                    <td>{{ $rows->roomFullName }} </td>
                                    <td>{{ $rows->booking_subject }} </td>
                                    <td>{{ $rows->booking_booker }} </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm editIcon" bookingID="{{ $rows->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="p-2 mt-2 text-center">
                                        <div class="alert alert-success" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="16"
                                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                            </svg>
                                            <br /> ไม่พบรายการจองห้องวันนี้
                                            <p> ท่านสามารถทำรายการจอง นี้ได้โดยกดปุ่ม " ทำรายจองห้อง "
                                                และระบุรายละเอียดการขอใช้ให้ครบถ้วน </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>
<!-- /.row (main row) -->


{{-- Booking FORM modal start --}}
<div class="modal fade" id="modalbookingDetail" tabindex="-1" aria-labelledby="bookingDetail" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light  ">
                <h5 class="modal-title" id="exampleModalLabel"> รายละเอียกการขอใช้ห้อง </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0 viewBooking">
                <form id="approve_booking_form" class="row g-3 m-auto" method="post" action="#"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="hinden_bookingID" name="hinden_bookingID">
                    <input type="hidden" id="adminAccount" name="adminAccount"
                        value="{{ Session::get('cmuitaccount') }}">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            <table class="table text text-start table-info  table-hover ">
                                <tbody>
                                    <tr>
                                        <td class="tdTitle"> ห้อง </td>
                                        <td class="text-start  fw-bold text-danger tddetail">
                                            <span id="roomFullName"></span>
                                        </td>
                                        <td class="tdTitle">วันที่/เวลา</td>
                                        <td class="text-start fw-bold text-danger tddetail">
                                            <span id="booking_date"></span>
                                            <span id="booking_time" class=" ml-2"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdTitle"> เรื่องที่ขอใช้ </td>
                                        <td class="text-start " colspan="3">
                                            <span id="booking_subject"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdTitle">ผู้จอง / หน่วยงาน</td>
                                        <td class="text-start tddetail">
                                            <span id="booking_booker"></span>
                                        </td>
                                        <td class="tdTitle">จำนวนคน </td>
                                        <td class="text-start tddetail">
                                            <span id="booking_ofPeople"></span> คน
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdTitle">เบอร์โทรติดต่อ</td>
                                        <td class="text-start tddetail">
                                            <span id="booking_phone"></s>
                                        </td>
                                        <td class="tdTitle">Email</td>
                                        <td class="text-start">
                                            <span id="booking_email"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdTitle">รายการขอใช้เพิ่มเติม </td>
                                        </td>
                                        <td class="text-start tddetail">
                                            <div id="userRequest"> </div>
                                        </td>
                                        <td class="tdTitle">*หมายเหตุ </td>
                                        <td class="text-start tddetail">
                                            <div id="description"> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="  col-md-12 p-2">
                        <div class=""  style="width: 70%;margin: 5px auto;border: 1px solid;">
                            @if ($getStatus == 'Newinbox')

                                <div
                                    class="text-center justify-content-center   p-2 border border-danger bg-light bg-opacity-10 m-auto fw-bold">

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
                                        <label class="form-check-label" for="action3"> ส่งต่อผู้บริหาร </label>
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

                                @elseif ($getStatus == 'canceled')
                                <div
                                    class="text-center justify-content-center  p-3 border border-danger bg-light bg-opacity-10 m-auto fw-bold">

                                    รายการนี้ถูกยกเลิกโดย : <span id="admin_action_acount"></span> <br />
                                    เมื่อ : <span id="admin_action_date"></span>
                                    <hr />
                                </div>
                                 @elseif ($getStatus == 'approved')
                                <div
                                    class="text-center justify-content-center p-3 border border-danger bg-light bg-opacity-10 m-auto fw-bold">

                                    รายการนี้อนุมติโดย :
                                    <span id="admin_action_acount"></span>
                                    <br />
                                    เมื่อ : <span id="admin_action_date"></span>
                                    <hr />
                                </div>
                                  @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Booking FORM modal end --}}





@endsection
@section('corescript')
<script>
    $(function () {
        $("#tableListbooking").DataTable({
            order: [0, 'ASC']
        });


        $(document).on('click', '.countText', function () {
            let isStatus = $(this).attr('status');
            console.log(isStatus);
            location.href = "/admin/viewstatus/" + isStatus;
        });

        // if click edit  /  ajax request
        $(document).on('click', '.editIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('bookingID');
            $.ajax({
                url: "{{ url('/admin/bookingDetail') }}",
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status == 200) {
                        $("#booking_date").html(response.booking_date);
                        $("#booking_time").html(response.booking_time);
                        $("#booking_subject").html(response.booking_subject);
                        $("#booking_booker").html(response.booking_booker);
                        $("#booking_ofPeople").html(response.booking_ofPeople);
                        $("#booking_department").html(response.booking_department);
                        $("#description").html(response.description);
                        $("#booking_at").html(response.booking_at);
                        $("#booking_email").html(response.booking_email);
                        $("#booking_phone").html(response.booking_phone);
                        $("#booking_status").html(response.booking_status);
                        $("#userRequest").html(response.userRequest);
                        $("#roomFullName").html(response.roomFullName);
                        $("#hinden_bookingID").val(id);
                        $("#admin_action_acount").html(response.admin_action_acount);
                        $("#admin_action_date").html(response.admin_action_date);

                        $('#modalbookingDetail').modal("show");
                    }

                }
            });

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





    });
</script>
@endsection