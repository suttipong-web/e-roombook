@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตรวจสอบการใช้ห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/js/bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('theme_1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('theme_1/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('theme_1/css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/schedule2.css">
    <!-- Favicons -->
    <link href="{{ asset('theme_1/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('theme_1/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
</head>

<body>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('theme_1/img/engineering_CMU_Logo_02.png') }}" alt="" style="height: 36px;">
                {{-- <h1 class="sitename">Arsha</h1> --}}
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/#hero" class="active">หน้าแรก</a></li>
                    <li><a href="/#about">เกี่ยวกับเรา</a></li>
                    <li><a href="/#services">บริการของเรา</a></li>
                    <li><a href="/#faq-2">คำถามที่พบบ่อย</a></li>
                    <li><a href="#footer">ติดต่อเรา</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="/booking">เริ่มต้นจองห้อง</a>
        </div>
    </header>
    <main class="main">
        <section id="search" class="about section" style="padding: 70px 0px 100px 0px">

            <!-- Section Title
            <div class="container section-title" data-aos="fade-up">
                <h2> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h2>
            </div> -->

            <div class="container">
                <div class="row">
                    <div class="row g-0 text-center mt-5 w-100">
                        <div class="col-md-9">
                            <div class="card">
                                <h5 class="card-header">ข้อมูลการใช้ {{ $RoomtitleSearch }} :
                                    <span class="text-primary"> วันที่
                                        {{ $getService->convertDateThai($DateTitleSearch, false, false) }}
                                        <span>
                                </h5>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true">
                                                แสดงรายการจองห้องประจำวัน
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane"
                                                aria-selected="false">ตารางการจองห้องประจำสัปดาห์</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="show_all">
                                                <table class="table mt-2 table-sm">
                                                    <thead class="table-light ">
                                                        <tr class="text-start">
                                                            <th>ช่วงเวลาที่ใช้งาน</th>
                                                            <th>รายการ</th>
                                                            <th>ผู้จอง</th>
                                                            <th>สถานะ</th>
                                                            <th>หมายเหตุ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($getBookingList) > 0)
                                                            @foreach ($getBookingList as $rows)
                                                                <tr class="text-start">
                                                                    <td>{{ Str::limit($rows->booking_time_start, 5, '') }}-{{ Str::limit($rows->booking_time_finish, 5, '') }}
                                                                    </td>
                                                                    <td>{{ $rows->booking_subject }}</td>
                                                                    <td>{{ $rows->booking_booker }}</td>
                                                                    <td>
                                                                        @if ((int) $rows->booking_status == 1)
                                                                            <span class="badge text-bg-success"> <i
                                                                                    class="bi bi-check-circle-fill"></i>
                                                                                อนุมัติ
                                                                            </span>
                                                                        @else
                                                                            <span class="badge text-bg-warning"> <i
                                                                                    class="bi bi-clock-history"></i>
                                                                                รอการอนุมัติ</span>
                                                                        @endif
                                                                    </td>

                                                                    <td>{{ $rows->description }} </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="p-2 mt-2 text-center">
                                                                        <div class="alert alert-info" role="alert">
                                                                            <h4>
                                                                                <i class="bi bi-check2-circle"></i>
                                                                            </h4>
                                                                            <p> ไม่มีรายการจองใช้งานในวันนี้</p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="showtable"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3 mb-3">
                                <div class="card-header p-3">
                                    @if ($usertype == 'general')
                                        <h5>
                                            <span class="text-danger"> บุคคลภายนอกคณะฯ </span>
                                            ให้กรอกข้อมูลการจองตามแบบฟอร์มด้านล่าง
                                        </h5>
                                        <div class="text-center">
                                            <a href="{{ $getService->geturlCMUOauth($searchRoomID) }}"
                                                class="btn btn-primary " tabindex="-1" role="button"
                                                aria-disabled="true">
                                                <i class="bi bi-box-arrow-in-right"></i> บุคคลภายในคณะฯ
                                                คลิกที่นี่

                                            </a>
                                        </div>
                                    @else
                                        <h5>
                                            กรอกข้อมูลการจองตามแบบฟอร์มด้านล่าง
                                        </h5>
                                    @endif
                                </div>

                                <div class="card-body justify-content-start text-start">
                                    <form id="add_booking_form" class="row g-3 w-100 m-10-auto"
                                        enctype="multipart/form-data" action="/booking/insertBooking" method="post">
                                        @csrf
                                        <input type="hidden" name="roomID" id="roomID"
                                            value="{{ $searchRoomID }}">
                                        <input type="hidden" name="booking_type" id="booking_type"
                                            value="{{ $usertype }}">
                                        <div class="col-md-3 p-2">
                                            <label for="schedule_startdate" class="form-label"> วันที่เริ่ม *</label>
                                            <input class="form-control dateScl" type="text"
                                                data-provide="datepicker" data-date-language="th"
                                                value="{{ $searchDates }}" id="schedule_startdate"
                                                name="schedule_startdate" required>
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <label for="schedule_enddate" class="form-label"> วันที่สิ้นสุด </label>
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
                                                / บริษัท </label>
                                            <input type="text" class="form-control" id="booking_department"
                                                name="booking_department"
                                                placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท " />
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
                                                name="booking_ofPeople" placeholder=" จำนวนที่เข้าใช้งาน " />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_email" class="form-label"> Email * </label>
                                            <input type="email" class="form-control" id="booking_email"
                                                name="booking_email" placeholder=" Email " required
                                                value="{{ Session::get('cmuitaccount') }}" />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_phone" class="form-label">โทรศัพท์
                                                *</label>
                                            <input type="text" class="form-control" id="booking_phone"
                                                name="booking_phone" placeholder=" 05394xxxx" />
                                        </div>

                                        <div class="col-12">
                                            <label for="description" class="form-label">
                                                ระบุรายละเอียดเพิ่มเติม </label>
                                            <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                                        </div>

                                        @if (empty(Session::get('cmuitaccount')) || $usertype == 'general')
                                            <div class="text-primary"> โปรดทำการแนบไฟล์เอกสารขอใช้งานจากหน่วยงานของท่าน
                                                เพื่อใช้ประกอบการพิจารณาอนุมัติใช้งาน (ไฟล์ pdf เท่านั้น) * </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">*แนบไฟล์
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    accept="application/pdf" required name="pdf">
                                                <br />
                                                <div> กรณีบุคคลภายนอกต้องแนบเอกสาร เพื่อขอใช้สถานที่ </div>
                                            </div>
                                        @endif

                                        <input type="hidden" name="booker_cmuaccount"
                                            value="{{ Session::get('cmuitaccount') }}">

                                        <div class="p-2 text-center text-success fs-6">
                                            @if ($usertype == 'general')
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
                                            <button type="submit" id="add_btn"
                                                class="btn btn-success btn-Booking">
                                                <i class="bi bi-vector-pen"></i> ทำรายจองห้อง
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

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">คณะวิศวกรรมศาสตร์</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>มหาวิทยาลัยเชียงใหม่ 239 ถนนห้วยแก้ว 00</p>
                        <p>ต.สุเทพ อ.เมือง จ.เชียงใหม่ 502</p>
                        <p class="mt-3"><strong>โทรศัพท์:</strong> <span>+66 5394 1300</span></p>
                        <p class="mt-3"><strong>โทรสาร:</strong> <span>+66 5321 7143</span></p>
                        <p><strong>อีเมล:</strong> <span>contacts@cmu.ac.th</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>บริการสำคัญ</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://cmu.ac.th/Content/University/CMUPhoneBook.pdf"
                                class="nav-link p-0 text-body-secondary">
                                สมุดโทรศัพท์มหาวิทยาลัยเชียงใหม่
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://cmu.ac.th/Content/University/BrochureCMU-Map2017.pdf"
                                class="nav-link p-0 text-body-secondary">
                                แผนที่มหาวิทยาลัยเชียงใหม่
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://donate.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                การบริจาค
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://portal.office.com/" class="nav-link p-0 text-body-secondary">
                                CMU MAIL
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                CMU MIS
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://cmubackoffice.mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                สำหรับเจ้าหน้าที่
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>เยี่ยมชมมหาวิทยาลัยเชียงใหม่</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://cmu.ac.th/360/" class="nav-link p-0 text-body-secondary">
                                CMU 360 องศา
                            </a>
                        </li>
                    </ul>
                    <h4 class="mt-3">ช่องทางสื่อสาร</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i>
                            <a href="https://www.cmu.ac.th/">https://www.cmu.ac.th.</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>ติดตามเรา</h4>
                    <p>ติดตามเราผ่านสื่อต่างที่นี่</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">2024 Chiang Mai University,</strong> <span> All
                    rights reserved.</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/js/bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
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
                        console.log(response)
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Booking Successfully!',
                                text: ' ทำรายการจองสำเร็จ ',
                                icon: 'success'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#add_booking_form")[0].reset();
                                $("#addModal").modal('hide');
                                NewfetchData();
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

            fetchScheduleTable('');

            function fetchScheduleTable($uts) {
                var val = "";

                $.ajax({
                    url: "/fetchScheduleByRoom",
                    method: 'get',
                    data: {
                        uts: $uts,
                        getroomId: $("#roomID").val(),
                        hindenBtnBooking: false,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $(".showtable").html(response);
                    }
                });
            }
            $(document).on('click', '.btnUTS', function(e) {
                var $uts = $(this).attr('valuts');
                fetchScheduleTable($uts);
            });
            $(document).on('click', '.sc-detail', function(e) {
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
        });
    </script>
</body>

</html>
