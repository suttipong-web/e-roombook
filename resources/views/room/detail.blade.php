<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายรเอียดห้อง : {{ $roomTitle }}</title>
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

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style type="text/css">
        .slideImg {
            padding: 5px;
            margin: 5px auto;
            width: 500px;
            border: 1px solid #000;
        }
    </style>

    <link rel="stylesheet" href="/css/schedule.css">

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

        <section id="room" class="about section" style="padding: 160px 0px 100px 0px">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2> {{ $getListRoom[0]->roomFullName }} </h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row g-0 text-start  justify-content-center">
                    <div class="col-sm-10 col-md-10 p-3 ">
                        <div class="slideImg">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">

                                    <div class="carousel-item  active" data-bs-interval="5000">
                                        <img src="/storage/images/{{ $getListRoom[0]->thumbnail }}"
                                            class="d-block w-100" alt="{{ $getListRoom[0]->roomFullName }}">
                                        <div class="carousel-caption d-none d-md-block">

                                        </div>
                                    </div>
                                    @foreach ($roomGallery as $rows)
                                        <div class="carousel-item " data-bs-interval="3000">
                                            <img src="/storage/images/{{ $rows->filename }}" class="d-block w-100"
                                                alt="{{ $rows->roomFullName }}">
                                            <div class="carousel-caption d-none d-md-block">

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <!--End Slide Images -->
                        <div class="col-lg-12 mt-5">

                            <div class="row p-3 text-center justify-content-center mb-2 mt-2">
                                <button type="button" class="btn btn-primary   ml-3 col-4 bg-purple"
                                    data-bs-toggle="modal" data-bs-target="#caseBooker">
                                    <i class="bi bi-calendar-week-fill"></i> ทำรายการขอใช้ห้อง
                                </button>
                            </div>

                            {{-- <h2> {{ $getListRoom[0]->roomFullName }}</h2> --}}

                            <div class="container text-start mt-3">
                                <div class="row p-10">
                                    <div class="col-6 col-md-4"><i class="bi bi-building-fill"></i>
                                        ประเภท{{ $getListRoom[0]->roomtypeName }}</div>
                                    <div class="col-6 col-md-4"><i class="bi bi-geo-alt-fill"></i> สถานที่
                                        {{ $getListRoom[0]->placeName }}
                                    </div>
                                    <div class="col-6 col-md-4"><i class="bi bi-calendar2-check-fill"></i> สถานะ</div>
                                </div>
                            </div>
                            <br />
                            <div class="row mx-3 p-3"> {{ $getListRoom[0]->roomDetail }} </div>
                            <hr />
                            <h5> อุปกรณ์ภายในห้อง ( Room Services ) </h5>
                            <div class="row px-3">
                                @foreach ($listItemRoom as $rows)
                                    <span class="d-flex"><i class="bi bi-check-circle"></i>
                                        &nbsp;&nbsp; {{ $rows->item_name }} </span>
                                @endforeach

                            </div>
                            <hr />

                        </div>
                    </div>

                    <div class="col-sm-10 col-md-10 p-3 ">
                        <h5> ตารางการจองห้อง ( Room Availability) </h5>
                        <div class="row">

                        </div>
                        <div class="showtable">

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


    <!-- Modol  Checkc บุคคลภายนอก/ภายใน  -->
    <div class="modal fade" id="caseBooker" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> โปรดเลือกขั้นตอนการขอใช้สถานที่ </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <a href="/booking/check/{{ $getListRoom[0]->id }}/general/{{ $getListRoom[0]->roomFullName }}"
                                    class="btn btn-light " tabindex="-1" role="button" aria-disabled="true">
                                    <h5 class="mb-1"><i class="bi bi-person-bounding-box"></i> สำหรับบุคคลภายนอก
                                    </h5>
                                </a>
                            </div>
                            <p class="mb-1">
                            <ul>
                                <li>คือบุคคลหรือหน่วยงานที่อยู่นอกการกำกับดูแลของคณะวิศวกรรมศาสตร์
                                    มหาวิทยาลับเชียงใหม่ </li>
                                <li>สำหรับการขอใช้ห้อง หากเป็นบุคคลภายนอก ท่านจะต้องแนบเอกสารการขอใช้สถานที่
                                    และหากมีค่าใช้จ่ายทางผู้ดูจะแจ้งค่าใช้จ่ายและผลการอนุมัติ ให้ท่านภายใน 1-3
                                    วันทำการ
                                </li>
                            </ul>


                        </div>
                    </div>
                    <br />
                    <div class="list-group">
                        <div href="#" class="list-group-item list-group-item-action " aria-current="true"
                            style="background-color: #7d1a11;color: #fff;">
                            <div class="d-flex w-100 justify-content-between">

                                <a href="{{ $urlCMUOauth }}" class="btn btn-light " tabindex="-1" role="button"
                                    aria-disabled="true">
                                    <h5 class="mb-1"> <i class="bi bi-gear-wide"></i> สำหรับบุคคลภายใน</h5>
                                </a>
                            </div>

                            <p class="mb-1">
                            <ul>
                                <li>คือบุคคลหรือหน่วยงานที่อยู่ภายใต้สังกัดของคณะวิศวกรรมศาสตร์ มหาวิทยาลับเชียงใหม่
                                </li>
                                <li>ท่านสามารถทำรายการขอใช้สถานที่ โดยใช้ CMU Acount (xxx@cmu.ac.th)
                                    ในการเข้าสู่ระบบการจองห้อง </li>
                                <li>ขึั้นตอนนี้ไม่รวมการขอใช้ห้องในการจัดทำระบบตารางเรียนตารางสอน </li>
                            </ul>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="hinden_roomID" value="{{ $getListRoom[0]->id }}">
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
            fetchAll('');

            function fetchAll($uts) {
                var val = "";
                console.log('Start');
                $.ajax({
                    url: "/fetchScheduleByRoom",
                    method: 'get',
                    data: {
                        uts: $uts,
                        getroomId: $("#hinden_roomID").val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        $(".showtable").html(response);
                    }
                });
            }

            $(document).on('click', '.btnUTS', function(e) {
                var $uts = $(this).attr('valuts');
                fetchAll($uts);
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

    <script type="text/javascript">
        $(function() {
            $('#select_date').datetimepicker({
                useCurrent: false,
                locale: 'th',
                format: 'YYYY-MM-DD'
            });
            $('#select_date').on('change.datetimepicker', function(e) {
                window.location = 'demo_schedule.php?uts=' + e.date.format("X");
            });
        });
    </script>
</body>

</html>
