<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-css')
    <style type="text/css">
        <style type="text/css">.wrap_schedule {
            margin: auto;
            width: 800px;
        }

        .activity {
            background-color: #C6EEC3;
            font-size: 12px;
        }

        .time_schedule {
            font-size: 12px;
        }

        .day_schedule {
            font-size: 12px;
        }

        .time_schedule_text {
            width: 60px;
        }

        .day_schedule_text {
            width: 80px;
        }
    </style>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">
@endsection
@section('body')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> ระบบจัดการตารางเรียนตาราง </h1>
    </div>

    <div class="card">
        <h5 class="card-header">ข้อมูลตารางเรียน </h5>
        <div class="card-body">
            <h5 class="card-title">คำอธบายการจัดตารางเรียน </h5>
            <p class="card-text">
                เจ้าหน้าที่หน่วยงานสามารถจัดการตารางสอนของแต่ละเทอมได้
                โดยจะแบ่งช่วงเวลาในการลงข้อมูลตามลําดับ<br />
            <ul>
                <li>กระบวนวิชาวิศวกรรมพื้นฐาน (ลงข้อมูลก่อนเปิดเทอม 4 อาทิตย์) </li>
                <li>กระบวนวิชาภาคพิเศษ (ลงข้อมูลก่อนเปิดเทอม 3 อาทิตย์)</li>
                <li>กระบวนวิชาจากภาควิชาต่างๆ (ลงข้อมูลก่อนเปิดเทอม 2 อาทิตย์) </li>
                <li> เมื่อกดยืนยันแล้วจะไม่สามารถ แก้ไขช่วงเวลาได้ </li>
            </ul>
            </p>

            <br />
            <hr />

            <div class="col-md-12 showtable">

                {{ $htmltables }}




            </div>
        </div>
    </div>
@endsection
@section('corescript')
    <script>
        fetchAll();

        function fetchAll() {
            var val = "";
            $.ajax({
                url: "/admin/schedules/getTabletime",
                method: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $(".showtable").html(response);
                }
            });
        }
    </script>
@endsection
