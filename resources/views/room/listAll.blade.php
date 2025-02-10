@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายการจองห้องประชุม</title>
    @includeIf('partials.headtag')
</head>

<body>
    @includeIf('partials.header')
    <main class="main">
        <section id="search" class="about section" style="padding: 70px 0px 100px 0px">

            <!-- Section Title
            <div class="container section-title" data-aos="fade-up">
                <h2> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h2>
            </div> -->
            <div class="container">
                <div class="row">
                    <div class="row g-0 text-center mt-5 w-100">
                        <div class="col-4 col-md-3 p-2">
                            <div class="formSlc bg-mycustom text-start w-90 mx-3 mb-3">
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

                            <div class="formSlc bg-mycustom text-start w-90 mx-3 ">
                                <h5 class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path
                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg> ตรวจสอบการใช้ห้องรายวัน
                                </h5>
                                <hr />
                                
                                <form id="serachBookingDate" method="post" action="/booking/Searchlist">
                                    @csrf
                               
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

                        <div class="col-md-8">
                            <div class="card">
                                <h5 class="card-header">ระบบจองห้องประชุม คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชีายงใหม่ <br />
                                    รายการจองห้องประชุมประจำวันที่ {{$dateTitle}}

                                </h5>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="show_all">
                                                <table class="table mt-2 p-2 table-bordered table-sm">
                                                    <thead class=" table-secondary">
                                                        <tr class="text-center">
                                                            <th style="width: 110px;">เวลา</th>
                                                            <th>เรื่องที่ประชุม</th>
                                                            <th>หน่วยงาน</th>
                                                            <th class="text-center">จำนวนคน</th>
                                                            <th style="width: 180px;">ผู้จอง</th>
                                                            <th style="width: 200px;">หมายเหตุ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($bookingall) > 0)
                                                                                                            @php 
                                                                                                                $rooName = "";
                                                                                                            @endphp 
                                                                                                            @foreach ($bookingall as $rows)
                                                                                                                                                                @php   

                                                                                                                                                                                                                                                                                                                                                                                       if ($rooName != $rows->roomFullName) {
                                                                                                                                                                        $rooName = $rows->roomFullName;
                                                                                                                                                                        $isNewTRROOM = TRUE;
                                                                                                                                                                    } else {
                                                                                                                                                                        $isNewTRROOM = FALSE;
                                                                                                                                                                    }


                                                                                                                                                                   @endphp 

                                                                                                                                                                @if($isNewTRROOM)
                                                                                                                                                                    <tr class="text-start table-light ">
                                                                                                                                                                        <td colspan="6">
                                                                                                                                                                            <b>{{$rooName}}</b>
                                                                                                                                                                        </td>
                                                                                                                                                                    </tr>
                                                                                                                                                                @endif
                                                                                                                                                                <tr class="text-start">
                                                                                                                                                                    <td>
                                                                                                                                                                        {{ Str::limit($rows->booking_time_start, 5, '') }}-{{ Str::limit($rows->booking_time_finish, 5, '') }}
                                                                                                                                                                    </td>
                                                                                                                                                                    <td>{{ $rows->booking_subject }}</td>
                                                                                                                                                                    <td>{{ $rows->roomFullName }}</td>

                                                                                                                                                                    <td class="text-center">{{ $rows->booking_ofPeople }}</td>
                                                                                                                                                                    <td>{{ $rows->booking_booker }}</td>
                                                                                                                                                                    <td>{{ $rows->description }}</td>
                                                                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="p-2 mt-2 text-center">
                                                                        <div class="alert alert-light text-info fs-5"
                                                                            role="alert">
                                                                            <h2 class="text-info">
                                                                                <i class="bi bi-check2-circle"></i>
                                                                            </h2>
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

                                    </div>
                                </div>

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
        $(function () {
            $("#tableListbooking").DataTable({
                order: [0, 'ASC']
            });

        });
    </script>
</body>

</html>