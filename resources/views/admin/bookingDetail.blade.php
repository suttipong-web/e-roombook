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

        .tableListbooking {
            font-size: 12px;
        }
    </style>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> รายละเอียดการขอใช้ห้อง</h1>
    </div>

    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">
            <div class="row">

                <div class="card">
                    <div class="card-header">
                        รายละเอียดการขอใช้ห้อง
                    </div>
                    <div class="card-body">
                        <form id="approve_booking_form" class="row g-3 m-auto" method="post" action="#"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="hinden_bookingID" name="hinden_bookingID"
                                value="{{ $detailBooking[0]->id }}">
                            <input type="hidden" id="adminAccount" name="adminAccount"
                                value="{{ Session::get('cmuitaccount') }}">
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
                                                <td class="text-start " colspan="3">
                                                    <span id="booking_subject">
                                                        {{ $detailBooking[0]->booking_subject }}
                                                    </span>
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
                                                <td class="tdTitle">รายการขอใช้เพิ่มเติม </td>
                                                </td>
                                                <td class="text-start tddetail">
                                                    <div id="userRequest"> </div>
                                                </td>
                                                <td class="tdTitle">*หมายเหตุ </td>
                                                <td class="text-start tddetail">
                                                    <div id="description">
                                                        {{ $detailBooking[0]->description }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="  col-md-12 p-2">
                                <div class="" style="width: 70%;margin: 5px auto;border: 1px solid;">
                                    @if ($getStatus == 'Newinbox')
                                        <div
                                            class="text-center justify-content-center   p-2 border border-danger bg-light bg-opacity-10 m-auto fw-bold">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="chkStatus"
                                                    id="action2" value="approved" checked />
                                                <label class="form-check-label" for="action2">อนุมัติรายการ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="chkStatus"
                                                    id="action1" value="canceled" />
                                                <label class="form-check-label" for="action1">ไม่อนุมติ</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="chkStatus"
                                                    id="action3" value="ForwardDean" />
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
    </div>
@endsection
@section('corescript')
    <script>
        $(function() {
            $("#tableListbooking").DataTable({
                order: [0, 'ASC']
            });


            // ทำการอนุมัติ / ไม่อนุมัติ /ส่งต่อผู้บริหาร
            $("#approve_booking_form").submit(function(e) {
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
                    success: function(response) {
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
