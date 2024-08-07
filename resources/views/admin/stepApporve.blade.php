<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')
    <link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/combobox.css" rel="stylesheet">
@endsection
@section('body')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Dashboard </h1>
    </div>

    <!-- Main row -->


    <div class="row">
        <div class="container-fluid">
            <div class="card  mt-3 w-100">
                <div
                    class="card-header 
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
                    <table class="table table-sm mt-2" id="tableListbooking">
                        <thead class="table-secondary ">
                            <tr style="text-align: left;">
                                <th width="15%">วันที่ทำรายการ</th>
                                <th width="12%">ช่วงเวลาขอใช้</th>
                                <th width="25%">ห้องที่ขอใช้</th>
                                <th width="25%">เรื่อง</th>
                                <th width="13%">ผู้จอง</th>
                                <th width="13%" class="text-center">ประเภทบุคคล</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($getBookingList) > 0)
                                @foreach ($getBookingList as $rows)
                                    <tr style="text-align: left;">
                                        <td>
                                            @if (!$rows->is_read)
                                                <span class="text-danger"><i
                                                        class="bi bi-envelope-exclamation-fill"></i></span>
                                            @endif
                                            {{ $getService->convertDateThai($rows->booking_at, true, true) }}
                                        </td>
                                        <td class="text-center">
                                            {{ $getService->convertDateThai($rows->schedule_startdate, true, true) }}
                                            <br />
                                            {{ Str::limit($rows->booking_time_start, 5, '') }} -
                                            {{ Str::limit($rows->booking_time_finish, 5, '') }}
                                        </td>
                                        <td>{{ $rows->roomFullName }} </td>
                                        <td>{{ $rows->booking_subject }} </td>
                                        <td>{{ $rows->booking_booker }} </td>
                                        <td class="text-center">
                                            @if ($rows->booking_type == 'general')
                                                ภายนอก
                                            @else
                                                ภายใน
                                            @endif
                                        </td>
                                        <td class="text-center">

                                            <a class="btn btn-primary btn-sm"
                                                href="/admin/apporve_detail/{{ $getStatus }}/{{ $rows->id }}/{{ $rows->bookingToken }}/{{ $rows->stepID }}"
                                                role="button"> <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-gear-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                                </svg></a>

                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="p-2 mt-2 text-center">
                                            
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



@endsection
@section('corescript')

    <script>
        $(function() {

        });
    </script>
