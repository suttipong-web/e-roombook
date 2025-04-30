@extends('admin.emp-layout')
@section('content-header')
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ระบบจัดการใช้ห้องตามตารางเรียน</h1>
    </div>
    <div class="row">
        <div class="container-fluid">
        <h5 class="card-header">ข้อมูลตารางเรียน </h5>
        <div class="card-body">
            <h5 class="card-title">คำอธิบาย</h5>
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
        </div>
    </div>
    <!-- /.row (main row) -->
@endsection
