@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลการใช้ห้อง</title>
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
                                <div class="card-header p-2">
                                    <div class="col-md-12 p-2">
                                        <h5 class="section_title"> 2กรอกแบบฟอร์มขอใช้ห้อง :
                                            <span class="text-primary"> {{ $RoomtitleSearch }} </span>
                                        </h5>
                                        <div class="text-danger">

                                            @if ($usertype == 'general')
                                                สำหรับบุคคลภายนอกคณะฯ
                                            @else
                                                สำหรับบุคคลภายในคณะฯ
                                            @endif
                                        </div>
                                    </div>


                                </div>

                                <div class="card-body justify-content-start text-start ">
                                    <form id="add_booking_form" class="row g-3 w-100 m-10-auto"
                                        enctype="multipart/form-data" action="/booking/insertBooking" method="post"
                                        style="font-weight: 700">
                                        @csrf
                                        <input type="hidden" name="roomID" id="roomID" value="{{ $searchRoomID }}">
                                        <input type="hidden" id="roomTitle" value="{{ $RoomtitleSearch }}">
                                        <input type="hidden" name="booking_type" id="booking_type"
                                            value="{{ $usertype }}">
                                        <div>


                                        </div>


                                        <div class="col-md-3 ">
                                            <label for="schedule_startdate" class="form-label">
                                                <span style="color: blueviolet;font-weight: 700"> วันที่เริ่ม *</span>
                                            </label>
                                          <!--  <input class="form-control 
                                             @if($roomtype > 1) dateMaxScl @else datescl @endif                                           
                                            " type="text" data-provide="datepicker"
                                                data-date-language="th" value="{{ $searchDates }}"
                                                id="schedule_startdate" name="schedule_startdate" required> -->
                                                <input class="form-control 
                                             dateMaxScl                                    
                                            " type="text" data-provide="datepicker"
                                                data-date-language="th" value="{{ $searchDates }}"
                                                id="schedule_startdate" name="schedule_startdate" required readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="schedule_enddate" class="form-label"> <span
                                                    style="color: blueviolet;font-weight: 700"> วันที่สิ้นสุด * </span>
                                            </label>
                                            <!--
                                            <input class="form-control @if($roomtype > 1) dateMaxScl @else datescl @endif " type="text" data-provide="datepicker"
                                                data-date-language="th" value="{{ $searchDates }}"
                                                id="schedule_enddate" name="schedule_enddate" required
                                                
                                                                                              
                                                > -->
                                                <input class="form-control dateMaxScl" type="text" data-provide="datepicker"
                                                data-date-language="th" value="{{ $searchDates }}"
                                                id="schedule_enddate" name="schedule_enddate" required
                                                
                                                readonly                                       
                                                >
                                        </div>

                                        <div class="col-md-6 ">
                                            <label for="booking_time_start" class="form-label"> <span
                                                    style="color: blueviolet;font-weight: 700"> ช่วงเวลาที่ใช้งาน
                                                    *</span>
                                            </label>
                                            <br />
                                            <select name="booking_time_start" class="form-control-2" required
                                                id="booking_time_start">
                                                <option value=""> เวลาเริ่ม </option>
                                                @foreach ($getService->getALlTimes() as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select> :
                                            <select name="booking_time_finish" class="form-control-2" required>
                                                <option value="">เวลาสิ้นสุด</option>
                                                @foreach ($getService->getALlTimes() as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12 text-danger fst-italic">
                                            @if ($usertype == 'eng')
                                                หมายเหตุ : สำหรับการจองห้องช่วงเวลาเสาร์-อาทิตย์ หรือวันหยุด
                                                ต้องทำการแนบเอกสารการขอใช้ห้องด้วย
                                            @else
                                                หมายเหตุ : สำหรับการจองห้อง จะต้องดำเนินจอง ล่วงหน้าไม่น้อยกว่า 14
                                                วันทำการ
                                            @endif
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
                                                name="booking_department" placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท "
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
                                            <label for="booking_ofPeople" class="form-label">จำนวนผู้ใช้ *</label>
                                            <input type="number" class="form-control" id="booking_ofPeople"
                                                name="booking_ofPeople" placeholder=" จำนวนที่เข้าใช้งาน "
                                                max="999" maxlength="3" required />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_email" class="form-label"> Email * </label>
                                            <input type="email" class="form-control" id="booking_email"
                                                name="booking_email" placeholder=" Email " required
                                                value="{{ Session::get('cmuitaccount') }}" />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_phone" class="form-label">โทรศัพท์ *
                                            </label>
                                            <input type="text" class="form-control" id="booking_phone"
                                                name="booking_phone" placeholder=" 05394xxxx" required />
                                        </div>

                                        <div class="col-12">
                                            <label for="description" class="form-label">
                                                ระบุรายละเอียดเพิ่มเติม </label>
                                            <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                                        </div>
                                        @if ($usertype == 'eng')
                                            <div class="text-primary">
                                                แนบเอกสารขอใช้ห้อง กรณีจองช่วงเวลาเสาร์-อาทิตย์ หรือวันหยุด (ไฟล์ pdf
                                                เท่านั้น) </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">แนบไฟล์
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    accept="application/pdf" name="pdf">
                                                <br />
                                            </div>
                                            <hr />
                                        @elseif($usertype == 'general')
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
                                                โปรดระบุข้อมูลการออกใบเสร็จรับเงิน</h6>

                                            <div class="text-danger"> (ในการขอใช้ห้องสำหรับบุคคลภายนอกคณะวิศวกรรมศาสตร์
                                                อาจมีค่าธรรมเนียมในการใช้
                                                ทางคณะฯจะจัดส่งผลการขอใช้ห้องและอัตราค่าธรรมเนียม ที่ท่านอาจต้องชำระ
                                                ไปใน Email ที่ท่านระบุ)
                                            </div>

                                            <div class="col-md-6">
                                                <label for="fullname_receipt" class="form-label">
                                                    ชื่อที่แสดงบนใบเสร็จรับเงิน
                                                </label>
                                                <input type="text" class="form-control" id="fullname_receipt"
                                                    name="fullname_receipt" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="taxpayer_receipt" class="form-label">
                                                    เลขประจำตัวประชาชน/ประจำตัวผู้เสียภาษี
                                                </label>
                                                <input type="text" class="form-control" id="taxpayer_receipt"
                                                    name="taxpayer_receipt" />
                                            </div>
                                            <!--
                                                <div class="col-md-6">
                                                    <label for="email_receipt" class="form-label">
                                                        Email ในการรับใบเสร็จและใบเสนอราคา
                                                    </label>
                                                    <input type="text" class="form-control" id="email_receipt"
                                                        name="email_receipt" />
                                                </div>-->
                                            <div class="col-md-12 mb-3">
                                                <label for="address_receipt" class="form-label">
                                                    ที่อยู่
                                                </label>
                                                <input type="text" class="form-control" id="address_receipt"
                                                    name="address_receipt" />
                                            </div>
                                        @endif

                                        <input type="hidden" name="booker_cmuaccount"
                                            value="{{ Session::get('cmuitaccount') }}">

                                        <div class="p-2 text-center text-success " style="font-weight: 800">
                                            @if ($usertype == 'general')
                                                <hr />
                                                แบบฟอร์มการจองนี้สำหรับบุคคลภายนอกคณะฯ เท่านั้น<br />
                                            @endif
                                            โปรดตรวจสอบข้อมูลของท่านให้เรียบร้อย ก่อนทำการยืนยันรายการจองห้อง
                                        </div>

                                        <div class="text-center  justify-content-center  mb-3  ">
                                            <button type="submit" class="btn btn-danger btn-Booking btn-lg ">
                                                &nbsp;&nbsp;&nbsp; <i class="bi bi-vector-pen"></i> ทำรายการจอง
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
                                            name="search_date" required
                                            
                                            
                                            >
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
                                title: 'Booking Successful',
                                text: 'ระบบทำรายการจองสำเร็จ',
                                icon: 'success'
                            }).then((result) => {
                                $("#add_btn").text('ทำรายการจอง');
                                $("#add_booking_form")[0].reset();
                                $("#addModal").modal('hide');
                                //NewfetchData();
                                var reurl = "/booking/check/" + $("#roomID").val() +
                                    "/showlist/" + $("#roomTitle").val();
                                window.location.href = reurl;
                            });
                        } else if (response.status == 209) {
                            // แนบไฟล์ไม่สำเร็จ 
                            Swal.fire({
                                title: 'ไม่สามารถทำรายการจองได้!.',
                                text: response.errortext,
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('ทำรายการจอง');
                                $("#addModal").modal('hide');
                            });
                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'ไม่สามารถทำรายการจองได้!.',
                                text: ' วันหรือเวลาที่ท่านเลือก มีรายการการใช้งานแล้ว โปรดทำการเลือกวันและเวลาของท่านใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('ทำรายการจอง');
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
            //หาค่าวันล่าสุดที่สามารถเข้าจองได้ 
            let finalBookingDate = "{{ $getService->getendDateBooking() }}";
            $('.dateMaxScl').datepicker({
              //  27/02/2025
                format: 'dd/mm/yyyy', // กำหนดรูปแบบวันที่
                language: 'th', // ใช้ภาษาไทย
                startDate: new Date(), 
                endDate: new Date('2025-04-09') 
                //endDate: new Date(finalBookingDate) // เดือนใน JavaScript เริ่มจาก 0 -> พฤษภาคมคือ 4

            });

        });
    </script>
</body>

</html>
