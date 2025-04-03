<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.emp-layout')
@section('content-header')
    <style type="text/css">
        .displayTable {
            font-size: 13px
        }

        .allform {
            font-size: 14px;
        }
    </style>
@endsection
@section('body')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> ระบบจัดการตารางเรียนตาราง </h1>
    </div>

    <div class="card">
     <h5 class="card-header">ข้อมูลตารางเรียน </h5>
        <div class="card-body">
            <h5 class="card-title">คำอธิบาย</h5>
            <p class="card-text">
             
            <ul>
                <li>เจ้าหน้าที่หน่วยงานสามารถจัดการตารางเรียนของแต่ละเทอมได้ โดยจะแบ่งช่วงเวลาในการลงข้อมูลตามลําดับ</li>

                <li> สามารถนำเข้าข้อมูลได้โดยการเพิ่มข้อมูลทีละรายการ หรือสามารถ Import File Excel โดยกรอกข้อมูลตามรูปแบบไฟล์ตัวอย่างที่ให้นี้เท่านั้น 
                    <a href="/storage/download/schedule.xlsx" target="_blank"> >> Download << </a>
                </li>
                <li><span class="bg-danger text-white ">** หากรายการไหนขึ้นไฮไลท์สีแดง หมายถึงรายการนั้นไม่สามารถบันทึกข้อมูลได้ เนื่องจากมีรายการใช้ห้อง/วันเวลา นั้นอยู่แล้ว
                    </span> </li>
                <li> เมื่อทำการกดยืนยันการทำรายการแล้ว จะไม่สามารถทำการแก้ไขข้อมูลได้ จะ้ต้องทำการลบข้อมูลรายการนั้น แล้วทำรายการใหม่</li>
                <li>เจ้าหน้าที่ - กระบวนวิชาวิศวกรรมพื้นฐาน สามารถลงข้อมูลได้เป็นอันดับที่ 1 (ก่อนเปิดเทอม 4 อาทิตย์ หรือจะแจ้งให้ทราบอีกทีภายหลัง) </li>
                <li>เจ้าหน้าที่ - กระบวนวิชาภาคพิเศษ สามารถลงข้อมูลได้เป็นอันดับที่ 2 (ก่อนเปิดเทอม 4 อาทิตย์ หรือจะแจ้งให้ทราบอีกทีภายหลัง)</li>
                <li>เจ้าหน้าที่ - กระบวนวิชาจากภาควิชาต่างๆ สามารถลงข้อมูลได้เป็นอันดับที่ 1 (ก่อนเปิดเทอม 4 อาทิตย์ หรือจะแจ้งให้ทราบอีกทีภายหลัง)</li>
               
            </ul>
            </p>
      

            <div class="text-start">
                <a href="/major/schedules/view" class="btn btn-info  " tabindex="-1" role="button" aria-disabled="true">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-calendar2-week" viewBox="0 0 16 16">
                        <path
                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                        <path
                            d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                    </svg>
                    ดูรายการตารางเรียน (รูปแบบตาราง)

                </a>
            </div>
            <hr />

            @if($getService->getUserStatusImportdata())
            <div class="align-self-end" style="text-align: right">
                <button class="btn btn-secondary" data-toggle="modal" data-target="#addModal"><i
                        class="bi-plus-circle me-2"></i> เพิ่มข้อมูล</button>

                <button class="btn btn-secondary ml-3" data-toggle="modal" data-target="#addModalExwcel">
                    <i class="bi bi-file-earmark-arrow-down"></i> Import File </button>
            </div>
            @else
            <div class="text-center mb-2 p-2 text-center text-danger" style="text-align: center">
                 
                 <div class="alert alert-danger" role="alert">
                 ***  ยังไม่เปิดให้ลงตารางเรียน  ***
                </div>
            </div>
            @endif

             <div class="col-md-12   mt-3 displayTable">

                <table class="table table-hover  table-sm " id="tableListbooking-">
                    <thead class="table">
                        <tr style="text-align: center;">
                            <th class="text-center">วันที่แก้ไขล่าสุด</th>
                            <th class="text-center" >รหัสวิชา</th>
                            <th class="text-center" >ชื่อวิชา</th>
                            <th class="text-center" >Section</th>
                            <th class="text-center">จำนวนคน</th>
                            <th class="text-center">วัน</th>
                            <th align="center" class="text-center">เวลา</th>
                            <th class="text-center">ห้องเรียน</th>
                            <th class="text-center">ผู้สอน</th>
                            <th class="text-center">หมายเหตุ</th>
                            <th width="100" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($getBookingList) > 0)
                            @foreach ($getBookingList as $rows)
                                <tr class="text-center <?php   if ( ($rows->is_duplicate) || ($rows->is_error_room))  {
                                    echo 'bg-danger text-white ';
                                } ?>">
                                    <td class="text-center">
                                        @if ($rows->is_import_excel)
                                            <span class="text-success"><i class="bi bi-file-earmark-excel-fill"></i></span>
                                        @endif {{ $rows->updated_at }}

                                    </td>
                                    <td class="text-center">{{ $rows->courseNO }} </td>
                                    <td class="text-center">{{ $rows->courseTitle }}</td>
                                    <td class="text-center">{{ $rows->courseSec }}</td>
                                    <td class="text-center">{{ $rows->Stdamount }}</td>
                                    <td class="text-center">{{ $rows->schedule_repeatday }} </td>
                                    <td align="center" class="text-center">{{ substr($rows->booking_time_start, 0, 5) }} -
                                        {{ substr($rows->booking_time_finish, 0, 5) }} <br />
                                        {{ $rows->schedule_startdate . ' - ' . $rows->schedule_enddate }}
                                    </td>
                                    <td class="text-center">{{ $rows->roomFullName }}</td>
                                    <td class="text-center">{{ $rows->lecturer }}</td>
                                    <td class="text-center">
                                        @if(($rows->is_duplicate) || ($rows->is_error_room))
                                        <button class="btn btn-warning show-error btn-sm"
                                            data-detail="{{$rows->is_error_detail}}">{{ $rows->is_error }}
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                        </svg>
                                        </button>
                                    @endif

                                    </td>
                                    <td class="bg-light text-dark text-center">
                                        @if ($rows->is_public)
                                            @php
                                                $hiddbtn = 1;
                                            @endphp
                                            <span class="badge badge-success">
                                                สำเร็จ
                                            </span>
                                        @endif

                                        <a href="#" id="{{ $rows->id }}" class="text-success mx-1 editIcon">
                                            <i class="bi-pencil-square h6"></i></a>
                                        <a href="#" id="{{ $rows->id }}" class="text-danger mx-1 deleteIcon">
                                            <i class="bi-trash h6"></i></a>
                                        &nbsp;

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($getService->getUserStatusImportdata())
                    <div class="col-md-12 modal-footer   mt-2 p-3 text-end">
                        <button type="button" id="btn-confirm-submit" sesionId = '{{ $sesionId }}'
                            class="btn btn-primary "> ยืนยันเพิ่มตารางเรียน
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>


    <!-- #Import addModalExwcel -->
    <div class="modal fade" id="addModalExwcel" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Import File </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <h3> อัพโหลดข้อมูลการใช้ห้อง </h3>
                    <div>
                        <ul>
                            <li>เจ้าหน้าที่หน่วยงานสามารถนำเข้าไฟล์ตารางการใช้ห้องได้ </li>                       
                            <li>ไฟล์ที่นำเข้าต้องเป็นไฟล์ EXCEL ที่อยู่ในรูปแบบที่ระบบกำหนดไว้เท่านั้น
                                <a href="/storage/download/schedule.xlsx" target="_blank"> >> Download  ที่นี่<< </a>

                            </li>
                        </ul>
                        <hr />
                    </div>
                    <form action="/major/schedule/saveImportfile" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01"> อัพโหลดไฟล์ </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="fileupload"
                                    aria-describedby="inputGroupFileAddon01" accept=".xlsx, .xls">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"> อัพโหลดไฟล์ </button>
                        </div>
                        <br /> <br />
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Edit new modal start --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> แก้ไขข้อมูล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <form action="#" id="edit_form" enctype="multipart/form-data" class="row g-3  m-auto allform">
                        @csrf
                        <input type="hidden" id="adminAccount" name="adminAccount"
                            value="{{ Session::get('cmuitaccount') }}">
                        <input type="hidden" name="id" id="Edit_id">
                        <div class="col-md-4 my-1">
                            <label for="Edit_roomID" class="form-label"> เลือกห้อง * </label>
                            <select id="Edit_roomID" class="form-control" name="roomID" required>
                                <option value="0">--- เลือก --- </option>
                                <!-- ต่อฐานข้อมูล  -->
                                @foreach ($getListRoom as $item)
                                    <option value='{{ $item->id }}'>{{ $item->roomFullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 my-1">
                            <label for="Edit_courseNO" class="form-label">รหัสวิชา*</label>
                            <input type="text" class="form-control" id="Edit_courseNO" name="courseNO" 
                                placeholder="รหัสวิชา " required />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="courseTitle" class="form-label">ชื่อวิชา * </label>
                            <input type="text" class="form-control" id="Edit_courseTitle" name="courseTitle"
                                placeholder=" ชื่อวิชา "  required/>
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="courseSec" class="form-label"> Section *</label>
                            <input type="text" class="form-control" id="Edit_courseSec" name="courseSec"
                                placeholder="  Course Section " required />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="lecturer" class="form-label">อาจารย์ผู้สอน * </label>
                            <input type="text" class="form-control" id="Edit_lecturer" name="lecturer"
                                placeholder="  อาจารย์ผู้สอน "  required/>
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="Stdamount" class="form-label">จำนวนนักศึกษา *</label>
                            <input type="text" class="form-control" id="Edit_Stdamount" name="Stdamount"
                                placeholder="  จำนวนนักศึกษา " required />
                        </div>


                        <div class="col-md-2 my-1">
                            <label for="Edit_courseofyear" class="form-label">ปีการศึกษา *</label>
                            <select id="Edit_courseofyear" class="form-control" name="courseofyear" required>
                                @for ($i = date('Y') + 543 - 1; $i <= date('Y') + 543 + 1; $i++)
                                    <option value='{{ $i }}'> {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="Edit_terms" class="form-label">ภาคการศึกษา *</label>
                            <select id="Edit_terms" class="form-control" name="terms" required>
                                <option value='1'>เทอม 1 </option>
                                <option value='2'>เทอม 2 </option>
                            </select>
                        </div>
                        <div class="col-md-4 my-1">
                                <label for="schedule_repeatday" class="form-label"> เลือกวัน *</label>
                                <select id="Edit_schedule_repeatday" class="form-control" name="schedule_repeatday" required>
                                    @foreach ($listDays as $item)
                                        <option value="{{ $item->dayTitle }}">{{ $item->dayTitle }}</option>
                                    @endforeach
                                    <!-- ต่อฐานข้อมูล  -->
                                </select>
    
                        </div>
                        <div class="col-md-2 my-1">
                            <label for="booking_time_start" class="form-label"> เวลาเริ่ม * </label>
                            <select id="Edit_booking_time_start" class="form-control" name="booking_time_start" required>
                                <option value="0">--- เลือก --- </option>
                                @foreach ($getService->getALlTimes() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach

                                <!-- ต่อฐานข้อมูล  -->
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="booking_time_finish" class="form-label"> เวลาสิ้นสุด *</label>
                            <select id="Edit_booking_time_finish" class="form-control" name="booking_time_finish"
                                required>
                                <option value="0">--- เลือก --- </option>
                                @foreach ($getService->getALlTimes() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                <!-- ต่อฐานข้อมูล  -->
                            </select>
                        </div>

                       
                        <div class="col-md-12 mt-2 p-2">
                            <label for="Edit_description" class="form-label"> หมายเหตุ </label>
                            <input type="text" class="form-control" id="Edit_description" name="description" />
                        </div>
                        <div class="col-md-12 modal-footer   mt-2 p-3 text-end">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="edit_btn" class="btn btn-primary"> แก้ไขข้อมูล </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit modal start --}}

    {{-- add new employee modal start --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> เพิ่มข้อมูลใหม่ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3 bg-light">
                    <form action="#" id="add_booking_form" enctype="multipart/form-data"
                        class="row g-3  m-auto allform">
                        @csrf
                        <input type="hidden" id="adminAccount" name="adminAccount"
                            value="{{ Session::get('cmuitaccount') }}">
                            <input type="hidden"  name="sesionId"
                            value="{{$sesionId}}">


                        <div class="col-md-4 my-1">
                            <label for="roomID" class="form-label"> เลือกห้อง *</label>
                            <select id="roomID" class="form-control" name="roomID" required>
                                <option value="0">--- เลือก --- </option>
                                <!-- ต่อฐานข้อมูล  -->
                                @foreach ($getListRoom as $item)
                                    <option value='{{ $item->id }}'>{{ $item->roomFullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 my-1">
                            <label for="courseNO" class="form-label">รหัสวิชา*</label>
                            <input type="text" class="form-control" id="courseNO" name="courseNO" required
                                placeholder="รหัสวิชา " required />
                        </div>

                        <div class="col-md-4 my-1">
                            <label for="courseTitle" class="form-label">ชื่อวิชา*</label>
                            <input type="text" class="form-control" id="courseTitle" name="courseTitle"
                                placeholder=" ชื่อวิชา " required />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="courseSec" class="form-label"> Section* </label>
                            <input type="text" class="form-control" id="courseSec" name="courseSec"
                                placeholder="  Course Section " required />
                        </div>

                        <div class="col-md-4 my-1">
                            <label for="Stdamount" class="form-label">จำนวนนักศึกษา*</label>
                            <input type="text" class="form-control" id="Stdamount" name="Stdamount"
                                placeholder="  จำนวนนักศึกษา " required />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="lecturer" class="form-label">อาจารย์ผู้สอน*</label>
                            <input type="text" class="form-control" id="lecturer" name="lecturer"
                                placeholder="  อาจารย์ผู้สอน " required />
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="courseofyear" class="form-label">ปีการศึกษา*</label>
                            <select id="courseofyear" class="form-control" name="courseofyear" required>
                                @for ($i = date('Y') + 543 - 1; $i <= date('Y') + 543 + 1; $i++)
                                    <option value='{{ $i }}'> {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="terms" class="form-label">ภาคการศึกษา*</label>
                            <select id="terms" class="form-control" name="terms" required>
                                <option value='1'>เทอม 1 </option>
                                <option value='2'>เทอม 2 </option>
                            </select>
                        </div>

                        <div class="col-md-4  my-1">
                            <label for="schedule_repeatday" class="form-label">เลือกวัน* </label>
                            <select id="schedule_repeatday" class="form-control schedule_repeatday"
                                name="schedule_repeatday" required>
                            
                                @foreach ($listDays as $item)
                                    <option value="{{ $item->dayTitle }}">{{ $item->dayTitle }}</option>
                                @endforeach
                                <!-- ต่อฐานข้อมูล  -->
                            </select>
                        </div>


                        <div class="col-md-2 my-1">
                            <label for="booking_time_start" class="form-label"> เวลาเริ่ม* </label>
                            <select id="booking_time_start" class="form-control" name="booking_time_start" required>
                                <option value="0">--- เลือก --- </option>

                                @foreach ($getService->getALlTimes() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach

                                <!-- ต่อฐานข้อมูล  -->
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="booking_time_finish" class="form-label"> เวลาสิ้นสุด *</label>
                            <select id="booking_time_finish" class="form-control" name="booking_time_finish" required>
                                <option value="0">--- เลือก --- </option>
                                @foreach ($getService->getALlTimes() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                                <!-- ต่อฐานข้อมูล  -->
                            </select>
                        </div>


                        <div class="col-md-12 mt-2 p-2">
                            <label for="description" class="form-label"> หมายเหตุ </label>
                            <input type="text" class="form-control" id="description" name="description" />
                        </div>
                        <div class="col-md-12 modal-footer   mt-2 p-3 text-end">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="add_rooms_btn" class="btn btn-primary"> เพิ่มข้อมูล </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End modal start --}}
 <form action="/major/schedules" id="fromRef"></form>
@endsection
@section('corescript')
    <script>
        $(function() {

            $("#tableListbooking").DataTable({
                order: [0, 'ASC']
            });

            $(".dateSlcPlan").datepicker({
                /*    language:'th-th',*/
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            // เมื่อเฃือกวันทำซ้ำ วนลูป สร้างชุดข้อมูล
            $(document.body).on("change", ".repeatday_chk", function() {
                $("#schedule_repeatday").val("");
                var repeatday_chk = [];
                $(".repeatday_chk:checked").each(function(k, ele) {
                    repeatday_chk.push($(ele).val());
                });
                $("#schedule_repeatday").val(repeatday_chk.join(",")); // จะได้ค่าเปน เช่น 1,3,4
            });

            $(document.body).on("change", ".repeatday_chk2", function() {
                $("#Edit_schedule_repeatday").val("");
                var repeatday_chk2 = [];
                $(".repeatday_chk2:checked").each(function(k, ele) {
                    repeatday_chk2.push($(ele).val());
                });
                $("#Edit_schedule_repeatday").val(repeatday_chk2.join(",")); // จะได้ค่าเปน เช่น 1,3,4
            });

            $(".input-group-prepend").find("div").css("cursor", "pointer").click(function() {
                $(this).parents(".input-group").find(":text").val("");
            });


            $("#add_booking_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                console.log(fd);
                $("#add_rooms_btn").text('Adding...');
                $.ajax({
                    url: "/admin/insertSchedule",
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
                                title: 'Booking Successfully!',
                                text: ' ทำรายการจองสำเร็จ ',
                                icon: 'success'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#add_booking_form")[0].reset();
                                $("#add_booking_form").modal('hide');
                                NewfetchData();
                            });
                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'Booking fail !',
                                text: ' ไม่สามารถจองห้องในเวลานี้ได้ โปรดตรวจสอบ วันที่และเวลา ใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#add_rooms_btn").text('เพิ่มข้อมูล');
                                $("#add_booking_form")[0].reset();
                                $("#add_booking_form").modal('hide');
                                NewfetchData();
                            });

                        }

                    }
                });
                return false;
            });

            // if click edit  /  ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                var booking_time_start = "";
                var booking_time_finish = "";
                var courseofyear = "";
                var terms = "";
                var varTemp = "";
                $.ajax({
                    url: "/admin/editSchedule",
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        arr = $.parseJSON(response.dataRoom);
                        console.log(arr);
                        $.each(arr, function(key, value) {
                            var InputID = "";
                            if (key == 'booking_time_start') {
                                booking_time_start = value.substring(0, 5);
                            } else if (key == 'booking_time_finish') {
                                booking_time_finish = value.substring(0, 5);
                            } else {
                                InputID = '#Edit_' + key;
                                $(InputID).val(value);
                            }

                        });

                        $("#Edit_booking_time_start").val(
                            booking_time_start);
                        $("#Edit_booking_time_finish").val(booking_time_finish);

                        $('#editModal').modal("show");
                    }
                });

            });

            // Form update  ajax request
            $("#edit_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_btn").text('Updating...');

                $.ajax({
                    url: "/admin/updateSchedule",
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            Swal.fire(
                                'Updated!',
                                'ระบบได้ทำการแก้ไขข้อมูลของท่านแล้ว ',
                                'success'
                            ).then((result) => {
                                $("#edit_form")[0].reset();
                                $("#editModal").modal('hide');
                                NewfetchData();
                            });

                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'fail !',
                                text: ' ไม่สามารถจองห้องในเวลานี้ได้ โปรดตรวจสอบ วันที่และเวลา ใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#edit_btn").text('แก้ไขข้อมูล');
                                $("#editModal").modal('show');

                            });
                        }
                        $("#edit_btn").text(' แก้ไขข้อมูล ');
                    }
                });
            });


            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                console.log(id);
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'ต้องการลบข้อมูล ?',
                    text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยันลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/major/scheduletime/delete",
                            method: 'post',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {

                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'ทำรายการลบข้อมูลของท่านเรียบร้อย.',
                                    'success'
                                ).then((result) => {
                                    NewfetchData();
                                });
                            }
                        });
                    }
                })
            });


            
            //ยืนยันการลงทะเบียนตารางเรียน
            $(document).on('click', '#btn-confirm-submit', function(e) {
                var sid = $(this).attr('sesionId');
                Swal.fire({
                    title: 'คุณต้องการจะทำรายการนี้ ?',
                    text: " การกดยืนยันรายการจะมีผลการจองห้องทันที ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/admin/confirmtable/' + sid+'/major'
                    }
                });
            });

            function NewfetchData() {
                window.location.reload(true);
            }
            $(".show-error").on("click", function () {
                let errorDetail = $(this).data("detail"); // ดึงค่าจาก data-detail

                Swal.fire({
                    icon: 'warning',
                    title: 'พบข้อผิดพลาด',
                    html: errorDetail || 'ไม่มีรายละเอียดเพิ่มเติม', // ถ้าไม่มีข้อความให้แสดง default
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'ปิด'
                });
            });

        });
    </script>
@endsection
