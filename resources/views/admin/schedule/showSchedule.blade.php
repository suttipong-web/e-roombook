<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-css')
<link rel="stylesheet" href="/css/schedule.css">
@endsection
@section('body')
<!-- Page Heading -->
<input type="hidden" id="adminAccount" name="adminAccount" value="{{ Session::get('cmuitaccount') }}">
<div class="card">
    <h5 class="card-header"> ระบบจัดการตารางเรียน </h5>
    <div class="card-body">
        <h5 class="card-title text-danger" >คำอธิบายการจัดตารางเรียน </h5>
        <p class="card-text">
           <ul>
             <li>เจ้าหน้าที่หน่วยงานสามารถจัดการตารางเรียนของแต่ละเทอมได้ โดยจะแบ่งช่วงเวลาในการลงข้อมูลตามลําดับ</li>

            <li> ท่านสามารถนำเข้าข้อมูลได้ จากการ Import File Excel ตารางเรียนโดยกรอกข้อมูลตามรูปแบบไฟล์ตัวอย่างที่ให้เท่านั้น  
            <a href="/storage/download/schedule.xlsx" target="_blank"> >> Download << </a></li>
            <li> เมื่อกดยืนยันแล้วจะไม่สามารถ แก้ไขช่วงเวลาได้ </li>
            <li> ระบบแสดงตารางเรียนตามห้องเรียน และช่วงวันที่ ที่ระบุไว้ในการเพิ่มข้อมูล </li>
            <li>กระบวนวิชาวิศวกรรมพื้นฐาน (ลงข้อมูลก่อนเปิดเทอม 4 อาทิตย์) </li>
            <li>กระบวนวิชาภาคพิเศษ (ลงข้อมูลก่อนเปิดเทอม 3 อาทิตย์)</li>
            <li>กระบวนวิชาจากภาควิชาต่างๆ (ลงข้อมูลก่อนเปิดเทอม 2 อาทิตย์) </li>

        </ul>
        <a href="/admin/schedules/" class="btn btn-info  " tabindex="-1" role="button" aria-disabled="true">

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
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
                cmuaccount: $('#adminAccount').val(),
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
</script>

<script type="text/javascript">
    $(function () {
        $('#select_date').datetimepicker({
            useCurrent: false,
            locale: 'th',
            format: 'YYYY-MM-DD'
        });
        $('#select_date').on('change.datetimepicker', function (e) {
            window.location = 'demo_schedule.php?uts=' + e.date.format("X");
        });
    });
</script>
@endsection