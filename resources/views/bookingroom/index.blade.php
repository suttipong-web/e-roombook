@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จองห้องประชุมคณะวิศวกรรมศาสตร์</title>

    @includeIf('partials.headtag')
    <style type="text/css">
        .tabRoomType {
            /* border: 1px solid #333;*/
            margin-right: 2px;
            margin-left: 10px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            background-image: radial-gradient(circle, #ffffff, #fbfafb, #f6f6f6, #f2f1f2, #eeeded);

        }
    </style>
</head>

<body>
    @includeIf('partials.header')

    <main class="main">
        <section id="booking" class="about section " style="padding: 160px 0px 100px 0px">
            <div class="container">
                {{-- <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1> --}}
                <div class="row">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-md-3 p-2">
                            <div class="formSlc bg-mycustom text-start w-90 mx-3">
                                <h5 class="text-danger">
                                    <img src="/theme_1/img/check-green.png" height="40">ตรวจสอบการใช้ห้อง
                                </h5>
                                <hr />
                                <form id="serachBookingDate" method="post" action="/booking/search">
                                    @csrf
                                    <input type="hidden" name="booking_type" id="booking_type" value="general">
                                    <div class="mb-3">
                                        <label for="formGroupExampleInput" class="form-label"> เลือกห้อง </label>
                                        <select name="slcRoom" id="slcRoom" class="form-select ">
                                            @if ($roomSlc)
                                                @foreach ($roomSlc as $item)
                                                    <option value='{{ $item->id }}'> {{ $item->roomFullName }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="search_date" class="form-label"> วันที่ </label>
                                        <input class="form-control dateScl" type="text" data-provide="datepicker"
                                            data-date-language="th" id="search_date" name="search_date"
                                            data-date-format="dd/mm/yyyy" value="{{ $searchDates }}">
                                    </div>
                                    <div class="text-center d-flex justify-content-center">
                                        <button type="submit" id="search_booking"
                                            class="btn btn-light btnCheckBooking text-white">
                                            คลิกตรวจสอบ
                                        </button>
                                    </div>
                                    <hr />
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-9">
                            <div class="container justify-content-center">
                                <div class="row  g-0 text-center ">
                                    @if ($getroomType)
                                        @foreach ($getroomType as $item)
                                            <?php
                                            $nameiCon = 'typeroom' . $item->id . '-' . $item->id . '.png';
                                            ?>
                                            <div class="col  col-md-4    text-center mb-3">
                                                <div class="p-1 tabRoomType justify-content-center">
                                                    <!-- เปิดการจองเฉพาะห้องประชุม --> 
                                                    @if ($item->id == 1)
                                                        <a
                                                            href="/booking/{{ $item->id }}/{{ $item->roomtypeName }}">
                                                            <img src="/theme_1/img/<?= $nameiCon ?>" height="45">
                                                            <br />
                                                            <h5> {{ $item->roomtypeName }} </h5>
                                                        </a>
                                                    @else
                                                    <a href="#">
                                                        <img src="/theme_1/img/<?= $nameiCon ?>" height="45">
                                                        <br />
                                                        <h5> {{ $item->roomtypeName }} </h5>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- Section Title -->
                            <div class="container section-title mt-5" data-aos="fade-up">
                                <h2>
                                    @if (!empty($pageTitle))
                                        ประเภท : {{ $pageTitle }}
                                    @else
                                        รายการห้องประชุมคณะวิศวกรรมศาสตร์
                                    @endif
                                </h2>
                            </div><!-- End Section Title -->

                            <div class="row row-cols-1 row-cols-md-3 g-4 text-start displayRooms">
                                @foreach ($getListRoom as $rows)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="/storage/images/{{ $rows->thumbnail }}" class="card-img-top"
                                                alt=" {{ $rows->roomFullName }} ">
                                            <div class="card-body">
                                                <h6 class="card-title text-center">{{ $rows->roomFullName }} </h6>
                                                <div class="card-text">ประเภทห้อง : {{ $rows->roomtypeName }} </div>
                                                <div class="card-text">ขนาด/ความจุห้อง : {{ $rows->roomSize }} ที่นั่ง
                                                </div>
                                                <p class="card-text">รายละเอียด : {{ $rows->roomDetail }} </p>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="/room/{{ $rows->id }}/{{ $rows->roomFullName }}"
                                                    class="btn btn-outline-secondary">
                                                    รายละเอียดเพิ่มเติม
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

    @includeIf('partials.footer')

    @includeIf('partials.incJS')

    <script>
        $(function() {

            $('#search_date').datepicker({
                language: 'th',
                format: 'dd/mm/yyyy'
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
