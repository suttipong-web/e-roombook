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
    <div class="container px-10">
        <div class="container">
            <div class="row g-0 text-start">
                <div class="col-sm-6 col-md-8 p-3">
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
                                    <img src="/storage/images/{{ $getListRoom[0]->thumbnail }}" class="d-block w-100"
                                        alt="{{ $getListRoom[0]->roomFullName }}">
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
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!--End Slide Images -->
                    <div class="col-lg-12 mt-4">

                        <h2> {{ $getListRoom[0]->roomFullName }}</h2>
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
                        <div> {{ $getListRoom[0]->roomDetail }} </div>
                        <hr />
                        <h4> อุปกรณ์ภายในห้อง ( Room Services ) </h4>
                        <div> </div>
                        <hr />

                    </div>
                </div>
                <div class="col-6 col-md-4 mt-3 p-2">
                    <div class="formSlc  text-center" style="border: 1px solid #000;">
                        <br />
                        <h4>
                            <i class="bi bi-calendar-fill"></i>
                            ตรวจสอบการจองห้อง
                        </h4>
                        <hr />

                        <form id="serachBookingDate" method="post" action="/booking/search"
                            style="width: 90%;margin: 5px auto;text-align: left;">
                            @csrf
                            <input type="hidden" id="hinden_roomID" name="roomID" value="{{ $getListRoom[0]->id }}">
                            <div class="mb-3">
                                <label for="search_date" class="form-label"> วันที่ </label>
                                <input class="form-control dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="search_date" name="search_date">
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
                <div class="col-md-10">
                    <h4> ตารางการจองห้อง ( Room Availability) </h4>

                    <div class="showtable">
                        .....

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
                    console.log(response);
                    $(".showtable").html(response);
                }
            });
        }
        $(document).on('click', '.btnUTS', function(e) {
            var $uts = $(this).attr('valuts');
            fetchAll($uts);
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

</html>
