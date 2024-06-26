<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จ้องห้องประชุมคณะวิศวกรรมศาสตร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container p-10 mt-5">
        <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1>
        <div class="row">
            <div class="row g-0 text-center mt-5">
                <div class="col-6 col-md-3">
                    <div class="formSlc  text-start w-75">
                        <h4>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-calendar-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                            ทำรายการจองห้อง
                        </h4>
                        <hr />
                        
                        <form id="serachBookingDate" method="post" action="{{ url('/booking/search') }}">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
    <link href="{{ asset('js/bootstrap-datepicker-thai/css/datepicker.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}">
    </script>
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
                    url: "{{ url('/booking/filter') }}",
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
