<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.emp-layout')
@section('content-css')
    <link rel="stylesheet" href="/css/schedule.css">
@endsection
@section('body')
    <!-- Page Heading -->
    <input type="hidden" id="adminAccount" name="adminAccount" value="{{ Session::get('cmuitaccount') }}">

    <div class="card">
        <h5 class="card-header"> ระบบจัดการตารางเรียน </h5>
        <div class="card-body">
            <h5 class="card-title text-danger">คำอธิบาย</h5>
            <p class="card-text">
            <ul>
                <li>เจ้าหน้าที่หน่วยงานสามารถจัดการตารางการใช้ห้อง โดยจะแบ่งช่วงเวลาในการลงข้อมูลตามลําดับ</li>

                <li> สามารถนำเข้าข้อมูลได้โดยการเพิ่มข้อมูลทีละรายการ หรือสามารถ Import File Excel
                    โดยกรอกข้อมูลตามรูปแบบไฟล์ที่กำหนดไว้เท่านั้น
                    <a href="/storage/download/schedule.xlsx" target="_blank"> >> Download ที่นี่ << </a>
                </li>
                <li> ไฟล์ "ชื่อห้อง" และรูปแบบ "วัน"
                    <a href="https://docs.google.com/spreadsheets/d/11bcRZtluhOF1tEp9LFUM0CedwuMm-tJW/edit?usp=sharing&ouid=117190688247688266889&rtpof=true&sd=true" target="_blank"> >> Download ที่นี่ << </a>
                </li>
                <li><span class="bg-danger text-white ">** หากรายการไหนขึ้นไฮไลท์สีแดง
                        หมายถึงรายการนั้นไม่สามารถบันทึกข้อมูลได้ เนื่องจากมีรายการใช้ห้อง/วันเวลา นั้นอยู่แล้ว
                    </span> </li>
                <li>เมื่อทำการกดยืนยันการทำรายการแล้ว จะไม่สามารถทำการแก้ไขข้อมูลได้ จะต้องทำการลบข้อมูลรายการนั้น
                    แล้วทำรายการใหม่ </li>
                <li>เจ้าหน้าที่ - กระบวนวิชาวิศวกรรมพื้นฐาน สามารถลงข้อมูลได้เป็นอันดับที่ 1 (ก่อนเปิดเทอม 4 อาทิตย์
                    หรือจะแจ้งให้ทราบอีกทีภายหลัง) </li>
                <li>เจ้าหน้าที่ - กระบวนวิชาภาคพิเศษ สามารถลงข้อมูลได้เป็นอันดับที่ 2 (ก่อนเปิดเทอม 3 อาทิตย์
                    หรือจะแจ้งให้ทราบอีกทีภายหลัง) </li>
                <li>เจ้าหน้าที่ - กระบวนวิชาจากภาควิชาต่างๆ สามารถลงข้อมูลได้เป็นอันดับที่ 1 (ก่อนเปิดเทอม 2 อาทิตย์
                    หรือจะแจ้งให้ทราบอีกทีภายหลัง) </li>

            </ul>
            <a href="/major/schedules/" class="btn btn-info  " tabindex="-1" role="button" aria-disabled="true">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-calendar2-week" viewBox="0 0 16 16">
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                    <path
                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                </svg>
                จัดการข้อมูลตารางเรียน
            </a>
            </p>
            <hr />
            <h4> {{ $TitlePage }} </h4>            
            <div class="col-md-12 showtable">

            </div>
        </div>
    </div>

@endsection
@section('corescript')
    <script>
        fetchAll('', '');

        function fetchAll($uts, $roomId) {
            var val = "";
            $.ajax({
                url: "/admin/schedules/fetchall",
                method: 'get',
                data: {
                    uts: $uts,
                    getroomId: $roomId,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    $(".showtable").html(response);
                }
            });
        }
        $(document).on('click', '.btnUTS', function (e) {
            var $uts = $(this).attr('valuts');
            fetchAll($uts);
        });

        $(document).on('click', '.sc-detail-std', function (e) {
            var detail = $(this).attr('detail');
            var titles = $(this).attr('htitle');
            Swal.fire({
                title: "<strong>" + titles + "</strong>",
                icon: "info",
                html: detail,
                showCloseButton: true,
                focusConfirm: false
            });
        });

    </script>

@endsection