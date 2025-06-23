<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายละเอียดห้อง : {{ $roomTitle }} </title>

    <link rel="stylesheet" href="/css/app/views/demo.css" />
    <link rel="stylesheet" href="/css/vendor/magic/magic.min.css">
    <link rel="stylesheet" href="/css/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/css/jquery.desoslide.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/schedule.css">
    @includeIf('partials.headtag')


</head>

<body>
    @includeIf('partials.header')
    <main class="main">

        <section id="room" class="about section" style="padding: 110px 0px 40px 0px">
            <div class="container">
                <div class="row g-0 text-start  justify-content-center displayDataroom">
                    <div class="col-sm-10 col-md-10 p-3 ">

                        <!-- Section Title -->
                        <div class="section-title" data-aos="fade-up">
                            <h2> {{ $getListRoom[0]->roomFullName }} </h2>
                        </div><!-- End Section Title -->

                        <!-- Slide Images -->


                        <div class="row">
                            <!-- Result 3 -->
                            <article class="col-lg-11 col-md-11">

                                <div class="row">
                                    <div id="slideshow3" class="col-lg-10 col-md-10"></div>

                                    <div class="col-lg-1 col-md-2 text-center">
                                        <ul id="slideshow3_thumbs" class="desoslide-thumbs-vertical list-inline">
                                            <li>
                                                <?php
                                                $fileroomMain = $getListRoom[0]->thumbnail;
                                                ?>
                                                <a href="/storage/images/{{ $fileroomMain }}">
                                                    <img src="/storage/images/{{ $fileroomMain }}"
                                                        alt="{{ $getListRoom[0]->roomFullName }}" height="100">
                                                </a>
                                            </li>
                                            @foreach ($roomGallery as $rows)
                                                <li>
                                                    <a href="/storage/images/{{ $rows->filename }}">
                                                        <img src="/storage/images/{{ $rows->filename }}"
                                                            alt="{{ $rows->roomFullName }}" height="100">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </article>

                            <!-- Code 3 -->

                        </div>
                    </div>
                    <!--End Slide Images -->
                    <div class="col-lg-12 mt-1">
                        <div class="container text-start mt-3 justify-content-center">
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-light"> <i class="bi bi-gear-fill"></i></button>
                                    ประเภท <br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $getListRoom[0]->roomtypeName }}
                                </div>
                                <div class=" col-md-2">
                                    <button class="btn btn-sm btn-light"> <i class="bi bi-geo-alt-fill"></i></button>
                                    สถานที่ <br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $getListRoom[0]->placeName }}
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-light"> <i class="bi bi-person-hearts"></i></button>
                                    ความจุ <br />
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวน
                                    {{ $getListRoom[0]->roomSize }}
                                    ที่นั่ง
                                </div>
                                <div class="col-md-6 justify-content-end text-center">
                                    <a type="button" class="btn btn-primary  btn-Booking"
                                        href="/booking/check/{{ $getListRoom[0]->id }}/showlist/{{ $getListRoom[0]->roomFullName }}">
                                        <i class="bi bi-vector-pen"></i> ทำรายการจอง
                                    </a>
                                </div>
                            </div>
                        </div>

                        <br /> <br />
                        <h5>รายละเอียด </h5>
                        <div class="row mx-1 p-3 mt-2 fs-6"> {{ $getListRoom[0]->roomDetail }} </div>
                        <hr />
                        <h5> อุปกรณ์ภายในห้อง ( Room Services ) </h5>
                        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 p-3">
                            @if (!empty($listItemRoom))
                                @foreach ($listItemRoom as $rows)
                                    <div class="col"><i class="bi bi-check-circle"></i>
                                        &nbsp;&nbsp; {{ $rows->item_name }} </div>
                                @endforeach
                            @endif
                        </div>
                        <hr />

                    </div>
                </div>

                <div class="row" id="popshowtable">
                    <h5>ตารางการใช้ห้อง ( Room Availability)</h5>
                    <div class="row">

                    </div>
                    <div class="showtable">

                    </div>
                </div>
            </div>

        </section>
    </main>

    <!-- Modol  Checkc บุคคลภายนอก/ภายใน  -->
    <div class="modal fade" id="caseBooker" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
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

    @includeIf('partials.footer')
    @includeIf('partials.incJS')

    <script src="/js/slide/highlight.pack.js"></script>
    <script src="/js/jquery.desoslide.min.js"></script>
    <script src="/js/slide/demo.js"></script>
    <script>
        $(function() {
            fetchAll('');

            function fetchAll($uts) {
                var val = "";
                //console.log('Start');
                $.ajax({
                    url: "/fetchScheduleByRoom",
                    method: 'get',
                    data: {
                        uts: $uts,
                        getroomId: $("#hinden_roomID").val(),
                        hindenBtnBooking: true,
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

            $(document).on('click', '.btnPrint', function(e) {
            // var thePopup = window.open('', "ตารางการใช้ห้อง",
                //      "menubar=0,location=0,,width=100%");
                //  $('#popshowtable').clone().appendTo(thePopup.document.body);
                    //thePopup.print();
                //Copy the element you want to print to the print-me div.
                $("#popshowtable").clone().appendTo("#print-me");
                //Apply some styles to hide everything else while printing.
                $("body").addClass('<link rel="stylesheet" href="/css/schedule.css">');
                //Print the window.
                window.print();
                //Restore the styles.
                $("body").removeClass("printing");
                //Clear up the div.
                $("#print-me").empty();
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
            $(document).on('click', '.sc-detail-std', function(e) {
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
