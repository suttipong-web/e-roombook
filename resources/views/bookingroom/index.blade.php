<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset('theme_1/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('theme_1/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <title>จองห้องประชุมคณะวิศวกรรมศาสตร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('theme_1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/aos/aos.css" rel="stylesheet') }}">
    <link href="{{ asset('theme_1/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme_1/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('theme_1/css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

        <section id="booking" class="about section light-background" style="padding: 160px 0px 100px 0px">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h2>
            </div><!-- End Section Title -->

            <div class="container">

                {{-- <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1> --}}
                <div class="row">
                    <div class="row g-0 text-center mt-5">
                        <div class="col-6 col-md-3">
                            <div class="formSlc  text-start w-75">
                                <h4>
                                    <i class="bi bi-calendar-fill"></i>
                                    ตรวจสอบการใช้ห้อง
                                </h4>
                                <hr />

                                <form id="serachBookingDate" method="post" action="/booking/search">
                                    @csrf
                                    <input type="hidden" name="booking_type" id="booking_type" value="general">
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label"> เลือกห้อง </label>
                                        <select name="slcRoom" id="slcRoom" class="form-select ">

                                            @foreach ($roomSlc as $item)
                                                <option value='{{ $item->id }}'> {{ $item->roomFullName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">

                                        <label for="search_date" class="form-label"> วันที่ </label>
                                        <input class="form-control dateScl" type="text" data-provide="datepicker"
                                            data-date-language="th" id="search_date" name="search_date"
                                            value="{{ date('d/m/Y') }}">
                                    </div>

                                    <div class="text-center d-flex justify-content-center">
                                        <button type="submit" id="search_booking" class="btn btn-dark">
                                            ตรวจสอบการจอง
                                        </button>
                                    </div>
                                    <hr />
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-9">
                            <div class="row ">
                                <select class="form-select form-select-lg mb-3 text-center" aria-label="ประเภทห้อง"
                                    id="sclRoomtype">
                                    @foreach ($getroomType as $item)
                                        <option value="{{ $item->id }}">รายการ{{ $item->roomtypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row row-cols-1 row-cols-md-3 g-4 text-start displayRooms">
                                @foreach ($getListRoom as $rows)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="/storage/images/{{ $rows->thumbnail }}" class="card-img-top"
                                                alt="{{ $rows->roomFullName }}">
                                            <div class="card-body">
                                                <a href="/room/{{ $rows->id }}/{{ $rows->roomFullName }}">
                                                    <h6 class="card-title text-center">{{ $rows->roomFullName }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <footer id="footer" class="footer">

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

    {{-- <footer class="py-5" style="">
            <div class="row">
                <div class="col-6 col-md-3 mb-3">
                    <h5>ติดต่อมหาวิทยาลัย</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-body-secondary">
                                มหาวิทยาลัยเชียงใหม่ 239 ถนนห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200 <br>
                                โทรศัพท์ :+66 5394 1300 <br>
                                โทรสาร : +66 5321 7143 <br>
                                อีเมล : contacts@cmu.ac.th
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-body-secondary">
                                ศูนย์สื่อสารองค์กรและนักศึกษาเก่าสัมพันธ์ <br>
                                โทรศัพท์ : +66 5394 3333, +66 5394 4444 <br>
                                โทรสาร : +66 5394 4900 <br>
                                อีเมล : ccarc@cmu.ac.th
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-body-secondary">
                                กองวิเทศสัมพันธ์ สำนักงานมหาวิทยาลัย
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-3 mb-3">
                    <h5>บริการสำคัญ</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="https://cmu.ac.th/Content/University/CMUPhoneBook.pdf"
                                class="nav-link p-0 text-body-secondary">
                                สมุดโทรศัพท์มหาวิทยาลัยเชียงใหม่
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://cmu.ac.th/Content/University/BrochureCMU-Map2017.pdf"
                                class="nav-link p-0 text-body-secondary">
                                แผนที่มหาวิทยาลัยเชียงใหม่
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://donate.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                การบริจาค
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://portal.office.com/" class="nav-link p-0 text-body-secondary">
                                CMU MAIL
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                CMU MIS
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://cmubackoffice.mis.cmu.ac.th/" class="nav-link p-0 text-body-secondary">
                                สำหรับเจ้าหน้าที่
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5 offset-md-1 mb-3">
                    <h5>เยี่ยมชมมหาวิทยาลัยเชียงใหม่</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="https://cmu.ac.th/360/" class="nav-link p-0 text-body-secondary">
                                CMU 360 องศา
                            </a>
                        </li>
                    </ul>
                    <form>
                        <h5>ช่องทางสื่อสาร</h5>
                        <p> Website : <a href="https://www.cmu.ac.th/">https://www.cmu.ac.th.</a></p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>Copyright © 2024 Chiang Mai University, All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi"
                                width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi"
                                width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi"
                                width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </div>
        </footer> --}}
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
    <link href="/js/bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">
    <script type="text/javascript" src="/js/bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>
    <script>
        $(function() {

            $(".dateSlcPlan").datepicker({
                /*    language:'th-th',*/
                format: 'dd/mm/yyyy',
                autoclose: true
            });


            $(document).on('change', '#sclRoomtype', function(e) {
                var typeID = $('#sclRoomtype').val();
                $.ajax({
                    url: "/booking/filter",
                    method: 'get',
                    data: {
                        typeID: typeID,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $(".displayRooms").html(response);
                    }
                });
            });


        });
    </script>
</body>

</html>
