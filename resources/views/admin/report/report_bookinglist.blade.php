<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')
@endsection
@section('body')

    <div class="card">
        <h5 class="card-header"> รายงานการขอใช้ห้องทั้งหมด </h5>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableReport" class="table table-sm">
                    <thead>
                        <tr>
                            <th>วันที่</th>
                            <th>ช่วงเวลา</th>
                            <th>ห้อง</th>
                            <th>เรื่อง</th>
                            <th>หน่วยงาน</th>
                            <th>ผู้จอง</th>
                            <th>เบอร์โทร</th>
                            <th>สถานะ</th>
                            <!-- <th>โดย</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($getBookingList) > 0)
                            @foreach ($getBookingList as $rows)
                                <tr>
                                    <td>{{ $rows->booking_date }}</td>
                                    <td>{{ $rows->booking_time_start }} - {{ $rows->booking_time_finish }}</td>
                                    <td>{{ $rows->roomFullName }} </td>
                                    <td>{{ $rows->booking_subject }} </td>
                                    <td>{{ $rows->booking_department }} </td>
                                    <td>{{ $rows->booking_booker }} </td>
                                    <td>{{ $rows->booking_phone }} </td>
                                    <td>
                                        <span
                                            class="badge 
                                    @if ($rows->booking_AdminAction == 'approved') badge-success
                                    @elseif($rows->booking_AdminAction == 'ForwardDean') badge-info
                                    @else badge-danger @endif
                                     ">
                                            {{ $getService->getStatusTh($rows->booking_AdminAction) }}
                                    </td>
                                    </span>
                                    <!--  <td> {{ $getService->getFullNameCmuAcount($rows->admin_action_acount) }}</td> -->
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="p-2 mt-2 text-center">
                                        <div class="alert alert-success" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="16"
                                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                            </svg>
                                            <br /> ไม่พบรายการ
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

@endsection
@section('corescript')
    <script>
        $(function() {
            $("#tableReport").DataTable({
                order: [0, 'ASC']
            });
        });
    </script>
@endsection
