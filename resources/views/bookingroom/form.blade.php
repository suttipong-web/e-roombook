@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตรวจสอบการใช้ห้อง</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/schedule2.css">
    @includeIf('partials.headtag')

</head>

<body>
    @includeIf('partials.header')

    <main class="main ">
        <section id="search" class="about section" style="padding: 70px 0px 100px 0px">

            <!-- Section Title
            <div class="container section-title" data-aos="fade-up">
                <h2> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h2>
            </div> -->

            <div class="container">
                <div class="row">
                    <div class="row g-0 text-center mt-5 w-100">
                        <div class="col-md-9">
                                <div class="card mt-0 mb-3">
                                    <div class="card-header p-3">
                                           <div class="col-md-12 p-2">
                                               <h5  class="section_title">  กรอกแบบฟอร์มขอใช้ห้อง  : {{ $RoomtitleSearch }} </h5>
                                               
                                            </div>
                                     
                                         
                                    </div>

                                    <div class="card-body justify-content-start text-start ">
                                        <form id="add_booking_form" class="row g-3 w-100 m-10-auto"
                                            enctype="multipart/form-data" action="/booking/insertBooking"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="roomID" id="roomID"
                                                value="{{ $searchRoomID }}">
                                                  <input type="hidden" id="roomTitle"
                                                value="{{ $RoomtitleSearch }}">
                                            <input type="hidden" name="booking_type" id="booking_type"
                                                value="{{ $usertype }}">
                                            <div>
                                                   

                                            </div>   
                                        
                                                
                                            <div class="col-md-3 p-2">
                                                <label for="schedule_startdate" class="form-label"> วันที่เริ่ม
                                                    *</label>
                                                <input class="form-control dateScl" type="text"
                                                    data-provide="datepicker" data-date-language="th"
                                                    value="{{ $searchDates }}" id="schedule_startdate"
                                                    name="schedule_startdate" required>
                                            </div>
                                            <div class="col-md-3 p-2">
                                                <label for="schedule_enddate" class="form-label"> วันที่สิ้นสุด
                                                </label>
                                                <input class="form-control dateScl" type="text"
                                                    data-provide="datepicker" data-date-language="th"
                                                    value="{{ $searchDates }}" id="schedule_enddate"
                                                    name="schedule_enddate" required>
                                            </div>

                                            <div class="col-md-6 p-2">
                                                <label for="booking_time_start" class="form-label">ช่วงเวลาที่ใช้งาน
                                                    *</label>
                                                <br />
                                                <select name="booking_time_start" class="form-control-2" required
                                                    id="booking_time_start">
                                                    <option value=""> เวลาเริ่ม* </option>
                                                    @foreach ($getService->getALlTimes() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select> :
                                                <select name="booking_time_finish" class="form-control-2" required>
                                                    <option value="">เวลาสิ้นสุด*</option>
                                                    @foreach ($getService->getALlTimes() as $item)
                                                        <option value="{{ $item }}">{{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="booking_booker" class="form-label">ชื่อผู้จอง * </label>
                                                <input type="text" class="form-control" id="booking_booker"
                                                    name="booking_booker" placeholder=" ระบุชื่อผู้ทำรายการ "
                                                    value=" {{ Session::get('userfullname') }}" required />
                                            </div>

                                            <div class="col-md-6">
                                                <label for="booking_department" class="form-label"> สังกัดหน่วยงาน /
                                                    องค์กร
                                                    / บริษัท *</label>
                                                <input type="text" class="form-control" id="booking_department"
                                                    name="booking_department"
                                                    placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท "
                                                    value="{{ Session::get('dep_name') }}" required />
                                            </div>

                                            <div class="col-md-12">
                                                <label for="booking_subject" class="form-label">
                                                    หัวข้อในการจอง *
                                                </label>
                                                <input type="text" class="form-control" id="booking_subject"
                                                    name="booking_subject" required
                                                    placeholder=" ระบุเหตุผลการขอใช้ห้อง " />
                                            </div>

                                            <div class="col-md-4">
                                                <label for="booking_ofPeople" class="form-label">จำนวนผู้ใช้</label>
                                                <input type="number" class="form-control" id="booking_ofPeople"
                                                    name="booking_ofPeople" placeholder=" จำนวนที่เข้าใช้งาน "  max="999"  maxlength="3"/>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="booking_email" class="form-label"> Email * </label>
                                                <input type="email" class="form-control" id="booking_email"
                                                    name="booking_email" placeholder=" Email " required
                                                    value="{{ Session::get('cmuitaccount') }}" />
                                            </div>

                                            <div class="col-md-4">
                                                <label for="booking_phone" class="form-label">โทรศัพท์
                                                </label>
                                                <input type="text" class="form-control" id="booking_phone"
                                                    name="booking_phone" placeholder=" 05394xxxx" />
                                            </div>

                                            <div class="col-12">
                                                <label for="description" class="form-label">
                                                    ระบุรายละเอียดเพิ่มเติม </label>
                                                <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                                            </div>
                                            @if ($usertype == 'eng')
                                                <div class="col-md-12">
                                                    <label for="booking_code_cancel"
                                                        class="form-label">รหัสยกเลิกรายการ
                                                    </label>
                                                    <input type="password" class="form-control"
                                                        id="booking_code_cancel" name="booking_code_cancel"
                                                        placeholder=" xxxx " />
                                                </div>
                                            @endif
                                            @if ($usertype == 'general')
                                                <div class="text-primary">
                                                    โปรดทำการแนบไฟล์เอกสารขอใช้งานจากหน่วยงานของท่าน
                                                    เพื่อใช้ประกอบการพิจารณาอนุมัติใช้งาน (ไฟล์ pdf เท่านั้น) * </div>
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">*แนบไฟล์
                                                    </label>
                                                    <input class="form-control" type="file" id="formFile"
                                                        accept="application/pdf" required name="pdf">
                                                    <br />
                                                </div>
                                                <hr />

                                                <h6 class="text-decoration-underline"><i class="bi bi-gear-fill"></i>
                                                    โปรดระบุข้อมูลการออกใบเสรจรับเงิน</h6>

                                                <div class="text-danger"> (การขอใช้สถานที่อาจมีค่าธรรมเนียบ
                                                    ซึ่งทางคณะวิศวกรรมศาสตร์
                                                    จะสรุปค่าธรรมเนียบการขอใช้สถานที่ให้ทราบหลังภายใน 1-3 วันทำการ)
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="fullname_receipt" class="form-label">
                                                        ชื่อที่แสดงในใบเสร็จรับเงิน (Printed on the receipt)
                                                    </label>
                                                    <input type="text" class="form-control" id="fullname_receipt"
                                                        name="fullname_receipt" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="taxpayer_receipt" class="form-label">
                                                        เลขประจำตัวประชาชน/ประจำตัวผู้เสียภาษี (Tax ID)
                                                    </label>
                                                    <input type="text" class="form-control" id="taxpayer_receipt"
                                                        name="taxpayer_receipt" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email_receipt" class="form-label">
                                                        Email ในการรับใบเสร็จและใบเสนอราคา
                                                    </label>
                                                    <input type="text" class="form-control" id="email_receipt"
                                                        name="email_receipt" />
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="address_receipt" class="form-label">
                                                        ที่อยู่ (Address)
                                                    </label>
                                                    <input type="text" class="form-control" id="address_receipt"
                                                        name="address_receipt" />
                                                </div>
                                            @endif

                                            <input type="hidden" name="booker_cmuaccount"
                                                value="{{ Session::get('cmuitaccount') }}">

                                            <div class="p-2 text-center text-success fs-5">
                                                @if ($usertype == 'general')
                                                    <hr />
                                                    แบบฟอร์มการจองนี้สำหรับบุคคลภายนอกคณะฯ เท่านั้น <br />
                                                    <span style="color: blueviolet"> สำหรับบุคคลภายในคณะฯ คลิกที่ปุ่ม
                                                        <!--  <a href="{{ $getService->geturlCMUOauth($searchRoomID) }}"> -->
                                                        “บุคคลภายในคณะฯคลิกที่นี่”
                                                        <!--</a>-->
                                                        ด้านบน </span> <br />
                                                @endif
                                                โปรดตรวจสอบข้อมูลของท่านให้เรียบร้อย ก่อนทำการยืนยันรายการจองห้อง
                                            </div>
                                            <div class="text-center  justify-content-center  mb-3 ">
                                                <button type="submit" class="btn btn-danger btn-Booking btn-lg">
                                                    &nbsp;&nbsp;&nbsp; <i class="bi bi-vector-pen"></i> ทำรายจองห้อง
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                    <br />
                                </div>
                                <br />
                       
                        </div>

                        <div class="col-md-3 jstify-content-center">
                            <div class="formSlc bg-mycustom text-start w-90 ">
                                <h5 class="text-danger">
                                    <img src="/theme_1/img/check-green.png" height="40">ตรวจสอบการใช้ห้อง
                                </h5>
                                <hr />
                                <form id="serachBookingDate" method="post" action="/booking/search">
                                    @csrf
                                    <input type="hidden" name="booking_type" id="booking_type"
                                        value="{{ $usertype }}">
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label"> เลือกห้อง </label>
                                        <select name="slcRoom" id="slcRoom" class="form-select " required>
                                            <option value="0">-- เลือก --</option>
                                            @foreach ($roomSlc as $item)
                                                <option value='{{ $item->id }}'
                                                    @if ($searchRoomID == $item->id) selected @endif>
                                                    {{ $item->roomFullName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="search_date" class="form-label"> วันที่ </label>
                                        <input class="form-control dateScl" type="text" data-provide="datepicker"
                                            data-date-language="th" value="{{ $searchDates }}" id="search_date"
                                            name="search_date" required>
                                    </div>
                                    <div class="text-center d-flex justify-content-center">
                                        <button type="submit" id="search_booking "
                                            class="btn btn-light btnCheckBooking  text-white">
                                            คลิกตรวจสอบ
                                        </button>
                                    </div>
                                    <hr />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

   

    @includeIf('partials.footer')
    @includeIf('partials.incJS')
    <script>
        $(function() {
 

          

            //Add Data เพิ่มการจอง ใหม่
            // add new  ajax request
            $("#add_booking_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_btn").text('Adding...');
                $.ajax({
                    url: "/booking/insertBooking",
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
                                text: response.msgreturn,
                                icon: 'success'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#add_booking_form")[0].reset();
                                $("#addModal").modal('hide');
                                //NewfetchData();
                                var reurl = "/booking/check/"+$("#roomID").val()+"/showlist/"+$("#roomTitle").val();
                              window.location.href =reurl;
                            });
                        } else if (response.status == 209) {
                            // แนบไฟล์ไม่สำเร็จ 
                            Swal.fire({
                                title: 'Booking fail !',
                                text: response.errortext,
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#addModal").modal('hide');
                            });
                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'Booking fail !',
                                text: ' ไม่สามารถจองห้องในเวลานี้ได้ โปรดตรวจสอบ วันที่และเวลา ใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#addModal").modal('hide');
                                $("#booking_time_start").focus();
                            });
                        }
                    }
                });

            });

            function NewfetchData() {
                //$("#serachBookingDate").submit();
                location.reload();
                document.getElementById('home-tab').focus();
            }



        });
    </script>
</body>

</html>