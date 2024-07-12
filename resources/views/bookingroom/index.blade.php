<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จองห้องประชุมคณะวิศวกรรมศาสตร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container p-10 mt-5">
        <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1>
        <div class="row">
            <div class="row g-0 text-center mt-5">
                <div class="col-6 col-md-3">
                    <div class="formSlc  text-start w-75">
                        <h4>
                            <i class="bi bi-calendar-fill"></i>
                            ทำรายการจองห้อง
                        </h4>
                        <hr />

                        <form id="serachBookingDate" method="post" action="/booking/search">
                            @csrf
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label"> เลือกห้อง </label>
                                <select name="slcRoom" id="slcRoom" class="form-select ">
                                    <option value="0">-- เลือก --</option>
                                    @foreach ($roomSlc as $item)
                                        <option value='{{ $item->id }}'> {{ $item->roomFullName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                {{ $nowdate = date('d/m/Y') }}
                                <label for="search_date" class="form-label"> วันที่ </label>
                                <input class="form-control dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="search_date" name="search_date"
                                    value="{{ $nowdate }}">
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
                                        <h6 class="card-title text-center">{{ $rows->roomFullName }}</h6>
                                        <div class="card-text">ประเภทห้อง : {{ $rows->roomtypeName }}</div>
                                        <div class="card-text">ขนาด/ความจุห้อง : {{ $rows->roomSize }} ที่นั่ง</div>
                                        <p class="card-text">รายละเอียด : {{ $rows->roomDetail }}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-outline-secondary">
                                            ตรวจสอบการจอง
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-5" style="">
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
        </footer>
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
