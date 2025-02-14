<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
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
        <h1 class="h3 mb-0 text-gray-800">ระบบจัดการใช้ห้องตามตารางเรียน</h1>
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
                <a href="/admin/schedules/view" class="btn btn-info  " tabindex="-1" role="button" aria-disabled="true">

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

            <div class="align-self-end" style="text-align: right">
                <button class="btn btn-secondary" data-toggle="modal" data-target="#addModal"><i
                        class="bi-plus-circle me-2"></i> เพิ่มข้อมูล</button>
                <button class="btn btn-secondary ml-3" data-toggle="modal" data-target="#addModalExwcel">
                    <i class="bi bi-file-earmark-arrow-down"></i> Import File </button>
            </div>
            <div class="col-md-12   mt-3 displayTable">

                <table class="table table-hover  table-sm " id="tableListbooking">
                    <thead class="table">
                        <tr style="text-align: left;">
                            <th>วันเวลาที่ทำรายการ</th>
                            <th>หน่วยงาน</th>
                            <th>ภาคการศึกษา</th>
                            <th>จำนวนรายการทั้งหมด</th>
                            <th>จำนวนที่อนุมัติ</th>
                            <th>จำนวนที่ไม่อนุมัติ</th>                     
                            <th width="100">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($getBookingList) > 0)
                            @foreach ($getBookingList as $rows)
                                <tr >
                                    <td> {{ $rows->updated_at }}

                                    </td>
                                    <td>{{ $rows->dep_title }} </td>
                                    <td>{{ $rows->terms }}/{{ $rows->courseofyear }}</td>
                                    <td class="text-center">{{$rows->countCourse}}</td>
                                    <td class="text-center">{{$rows->countPublic}}</td>
                                    <td class="text-center">{{$rows->countError}}</td>
                                    <td class="bg-light text-dark">
                                  
                                            <a href="/admin/schedules/views/{{ $rows->is_group_session }}" id="{{ $rows->id }}" class="text-success mx-1">
                                            <i class="bi bi-gear h6"></i></a>

                                            <a href="#" id="{{ $rows->is_group_session }}" class="text-danger mx-2 deleteIcon">
                                                <i class="bi-trash h6"></i></a>
                                         
                                     
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

              <!--  <div class="col-md-12 modal-footer   mt-2 p-3 text-end">

                    <button type="button" id="btn-confirm-submit" class="btn btn-primary "> ยืนยันเพิ่มตารางเรียน </button>
                </div>-->



            </div>
        </div>
    </div>


    <!-- #Import addModalExcel -->
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
                    <h3> อัพโหลดไฟล์ตารางเรียน </h3>
                    <div>
                        <ul>
                            <li>เจ้าหน้าที่หน่วยงานสามารถนำเข้าไฟล์ตารางเรียนได้</li>
                            <li>ไฟล์ที่นำเข้าต้องเป็นไฟล์ Excel เท่านั้น</li>
                            <li>ไฟล์ที่นำเข้าต้องอยู่ในรูแบบที่ระบบกำหนดไว้เท่านั้น ดาวน์โหลดรูปแบบไฟล์ตัวอย่างที่นี่
                                <a href="/storage/download/schedule.xlsx" target="_blank"> >> Download << </a>

                            </li>
                        </ul>
                        <hr />
                    </div>
                    <form action="{{ url('/admin/schedule/saveImportfile') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01"> อัพโหลดไฟล์ </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="inputGroupFile01" name="fileupload"
                                    ccept=".xlsx, .xls">
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
                            <label for="Edit_roomID" class="form-label"> เลือกห้อง </label>
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
                            <input type="text" class="form-control" id="Edit_courseNO" name="courseNO" required
                                placeholder="รหัสวิชา " required />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="courseTitle" class="form-label">ชื่อวิชา</label>
                            <input type="text" class="form-control" id="Edit_courseTitle" name="courseTitle"
                                placeholder=" ชื่อวิชา " />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="courseSec" class="form-label"> Section </label>
                            <input type="text" class="form-control" id="Edit_courseSec" name="courseSec"
                                placeholder="  Course Section " />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="lecturer" class="form-label">อาจารย์ผู้สอน</label>
                            <input type="text" class="form-control" id="Edit_lecturer" name="lecturer"
                                placeholder="  อาจารย์ผู้สอน " />
                        </div>
                        <div class="col-md-4 my-1">
                            <label for="Stdamount" class="form-label">จำนวนนักศึกษา</label>
                            <input type="text" class="form-control" id="Edit_Stdamount" name="Stdamount"
                                placeholder="  จำนวนนักศึกษา " />
                        </div>


                        <div class="col-md-2 my-1">
                            <label for="Edit_courseofyear" class="form-label">ปีการศึกษา</label>
                            <select id="Edit_courseofyear" class="form-control" name="courseofyear" required>
                                @for ($i = date('Y') + 543; $i <= date('Y') + 543 + 1; $i++)
                                    <option value='{{ $i }}'> {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="Edit_terms" class="form-label">เทอมการศึกษา</label>
                            <select id="Edit_terms" class="form-control" name="terms" required>
                                <option value='1'>เทอม 1 </option>
                                <option value='2'>เทอม 2 </option>
                            </select>
                        </div>

                        <div class="col-md-2 my-1">
                            <label for="schedule_startdate" class="form-label"> วันที่เริ่มต้น* </label>
                            <input class="form-control dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_schedule_startdate" name="schedule_startdate"
                                data-date-format="yyyy-mm-dd" required>

                        </div>
                        <div class="col-md-2 my-1">
                            <label for="schedule_enddate" class="form-label"> วันที่สิ้นสุด* </label>
                            <input class="form-control dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_schedule_enddate" name="schedule_enddate"
                                data-date-format="yyyy-mm-dd" required>

                        </div>

                        <div class="col-md-2 my-1">
                            <label for="booking_time_start" class="form-label"> เวลาเริ่ม* </label>
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

                        <div class="col-md-4 mt-2 p-2">
                            <label for="schedule_repeatday" class="form-label"> ลงเวลาในวัน </label>
                            <select id="Edit_schedule_repeatday" class="form-control" name="schedule_repeatday" required>
                                <option value="0">--- เลือก --- </option>
                                @foreach ($listDays as $item)
                                    <option value="{{ $item->dayTitle }}">{{ $item->dayList }}</option>
                                @endforeach
                                <!-- ต่อฐานข้อมูล  -->
                            </select>

                        </div>
                        <div class="col-md-8 mt-2 p-2">
                            <label for="Edit_description" class="form-label"> หมายเหตุ </label>
                            <input type="text" class="form-control" id="Edit_description" name="description" />
                        </div>
                        <div class="col-md-12 modal-footer   mt-2 p-3 text-end">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="edit_btn" class="btn btn-primary "> แก้ไขข้อมูล </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit modal start --}}

    

    <form action="/admin/schedules" id="fromRef"></form>
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



            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('/admin/schedule/delete_import') }}",
                            method: 'delete',
                            data: {
                                sid: id,
                                _token: csrf
                            },
                            success: function(response) {

                                //console.log(response);
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

            function NewfetchData() {
                $("#fromRef").submit();
            }

        });
    </script>
@endsection
