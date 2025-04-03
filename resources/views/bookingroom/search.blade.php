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
                            <input type="hidden" name="roomIDs" id="roomIDs" value="{{ $searchRoomID }}">

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
                                                แสดงรายการใช้ห้องประจำวัน
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane"
                                                aria-selected="false">แสดงรายการใช้ห้องประจำสัปดาห์</button>
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
                                                            <th>
                                                                @if ($roomTypeId > 1)
                                                                    ผู้สอน
                                                                @else
                                                                    ผู้จอง
                                                                @endif
                                                            </th>
                                                            <th>หน่วยงาน</th>
                                                            <th>สถานะ</th>

                                                            <th></th>
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
                                                                    <td>{{ $rows->booking_department }} </td>
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


                                                                    <td style="font-size: 10px;width: 100px;">
                                                                        @if (!empty(Session::get('cmuitaccount')) && Session::get('cmuitaccount') == $rows->booking_email)
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#delModal"
                                                                                class="btn btn-danger btn-sm clikDel"
                                                                                id="{{ $rows->id }}"
                                                                                style="font-size: 12px;">
                                                                                CANCEL<i
                                                                                    class="bi bi-x-circle-fill"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
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
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="showtable"> </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <?php //$dateUrl =$searchDates;
                            $dateUrl = $getService->convertDateSqlInsert($searchDates);
                            ?>
                            <div class="row mt-3 text-center justify-content-center">
                                <div class="col-md-6 justif y-content-end text-center">
                                    <!-- เปิดให้จองแค่ห้องประชุม -->
                                    @if  ((strtotime($dateUrl) <= strtotime('2025-04-02')) || ( Session::get('cmuitaccount')=='kiattichai.b@cmu.ac.th')|| ( Session::get('cmuitaccount')=='suttipong.r@cmu.ac.th') || ( Session::get('cmuitaccount')=='winai.k@cmu.ac.th'))     
                                        @if ($roomTypeId == 1  || ( Session::get('cmuitaccount')=='kiattichai.b@cmu.ac.th')|| ( Session::get('cmuitaccount')=='suttipong.r@cmu.ac.th'))
                                            @if (!empty(Session::get('cmuitaccount')))
                                                <a href="/booking/form/{{ $searchRoomID }}/eng/{{ $RoomtitleSearch }}/{{ $dateUrl }}"
                                                    class="btn btn-primary   ml-3  btn-Booking"><i
                                                        class="bi bi-vector-pen"></i>
                                                    ทำรายการจอง</a>
                                            @else
                                                <button type="button" class="btn btn-primary   ml-3  btn-Booking"
                                                    data-bs-toggle="modal" data-bs-target="#caseBooker">
                                                    <i class="bi bi-vector-pen"></i> ทำรายการจอง
                                                </button>
                                            @endif


                                        @endif
                                     @else
                                                <div class="text-center text-bg-danger"> ไม่สามารถทำรายการจองในวันที่นี้ได้ </div>
                                    @endif


                                </div>
                            </div>
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
                            <br />
                            <div class="formSlc bg-mycustom text-start w-90 mx-3 ">
                                <h5 class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
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
                    </div>
                </div>
            </div>
        </section>
    </main>


    {{-- del modal start --}}
    <div class="modal fade" id="delModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger"> คำเตือน </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  bg-light ">

                    <!--<div class="row col-12 ">
                        <div class="mb-3">
                            <label for="booking_password" class="form-label">รหัสยกเลิกของท่าน </label>
                            <input type="password" class="form-control" id="booking_password"
                                name="booking_password" placeholder=" รหัสยกเลิกของท่าน " required>

                        </div>
                    </div>-->
                    <p class="text-danger text-center fs-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                        </svg> <br />
                        <b class="text-dark"> แน่ใจหรือไม่!!..ในการยกเลิกการจองนี้ของท่าน</b>
                    </p>
                    <div class=" col-12 justify-content-center text-center">
                        <hr />
                        <input type="hidden" id="delBookingId" name="delBookingId">
                        <button type="button" class="btn btn-danger btnDelConfirm"> ยืนยันการยกเลิกการจอง
                        </button>
                    </div>
                    <br />

                </div>
            </div>
        </div>
    </div>
    {{-- edit modal end --}}

    <!-- Modol  Checkc บุคคลภายนอก/ภายใน  -->
    <div class="modal fade" id="caseBooker" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                         เลือกประเภทผู้ใช้งาน 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action " aria-current="true"
                            style="background-color: #fff;color: #000000;">

                            <div class="d-flex w-100 justify-content-between">
                                <a href="/booking/form/{{ $searchRoomID }}/general/{{ $RoomtitleSearch }}/{{ $dateUrl }}"
                                    class="btn btn-info " tabindex="-1" role="button" aria-disabled="true">
                                    <h5 class="mb-1 text-white"> <!--<i class="bi bi-person-bounding-box"></i>--> บุคคลภายนอกคณะฯ
                                         ( คลิกที่นี่     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-index" viewBox="0 0 16 16">
                                            <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 1 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 0 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.035a.5.5 0 0 1-.416-.223l-1.433-2.15a1.5 1.5 0 0 1-.243-.666l-.345-3.105a.5.5 0 0 1 .399-.546L5 8.11V9a.5.5 0 0 0 1 0V1.75A.75.75 0 0 1 6.75 1M8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v5.34l-1.2.24a1.5 1.5 0 0 0-1.196 1.636l.345 3.106a2.5 2.5 0 0 0 .405 1.11l1.433 2.15A1.5 1.5 0 0 0 6.035 16h6.385a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5 5 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.6 2.6 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046zm2.094 2.025"/>
                                          </svg>)
                                    
                                    </h5>
                                </a>
                            </div>

                            <p class="mb-1">
                            <ul>
                                <li>คือบุคคลที่ไม่ได้สังกัดคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</li>
                                <li class="text-danger"><b>สำหรับการจองห้อง จะต้องดำเนินจอง ล่วงหน้าไม่น้อยกว่า 14
                                        วันทำการ</b></li>
                                <li>ต้องทำการแนบเอกสารการขอใช้ห้องประกอบการทำรายการจอง </li>
                                <li>หากคำขอใช้งานของท่านมีรายละเอียดเกี่ยวกับการชำระเงินและผลการอนุมัติ
                                    ระบบจะส่งข้อมูลไปยังอีเมลของท่าน
                                </li>
                            </ul>


                        </div>
                    </div>
                    <br />
                    <div class="list-group">
                        <div href="#" class="list-group-item list-group-item-action btn-light"
                            aria-current="true" style="background-color: #0899fa;color: #fff;">
                            <div class="d-flex w-100 justify-content-between active">
                                <?php
                                $state = 'booking_' . $searchRoomID . '_' . $dateUrl;
                                $CMUOauth = $getService->geturlCMUOauth($state);
                                
                                ?>
                                <a href="{{ $CMUOauth }}" class=" btn text-white btn-primary" tabindex="-1" role="button"
                                    aria-disabled="true">
                                    <h5 class="mb-1 text-white"> <!--<i class="bi bi-gear-wide text-white"></i>-->
                                        บุคคลภายในคณะฯ 

                                        ( คลิกที่นี่     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-index" viewBox="0 0 16 16">
                                            <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 1 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 0 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.035a.5.5 0 0 1-.416-.223l-1.433-2.15a1.5 1.5 0 0 1-.243-.666l-.345-3.105a.5.5 0 0 1 .399-.546L5 8.11V9a.5.5 0 0 0 1 0V1.75A.75.75 0 0 1 6.75 1M8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v5.34l-1.2.24a1.5 1.5 0 0 0-1.196 1.636l.345 3.106a2.5 2.5 0 0 0 .405 1.11l1.433 2.15A1.5 1.5 0 0 0 6.035 16h6.385a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5 5 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.6 2.6 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046zm2.094 2.025"/>
                                          </svg>)
                                    </h5>
                                </a>
                            </div>

                            <p class="mb-1">
                            <ul>
                                <li>คือบุคคลที่สังกัดคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่ </li>
                                <li>สำหรับภาควิชา/ศูนย์ ที่สังกัดคณะฯ เมื่อทำรายการจองต้องรอการอนุมัติจากคณะฯ</li>
                                <li>ท่านสามารถทำรายการขอใช้สถานที่ได้โดยใช้บัญชี CMU Account (xxx@cmu.ac.th)
                                    ในการเข้าสู่ระบบการจองห้อง </li>
                                <li>ขั้นตอนนี้ไม่รวมการขอใช้ห้องสำหรับการจัดทำระบบตารางเรียนและตารางสอน</li>
                            </ul>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @includeIf('partials.footer')
    @includeIf('partials.incJS')
    <script>
        $(function() {
            $(document).on('click', '.clikDel', function(e) {
                var bookingId = $(this).attr('id');
                $('#delBookingId').val(bookingId);
                console.log('bid=>' + $('#delBookingId').val());
            });


            $(document).on('click', '.btnDelConfirm', function(e) {
                console.log('start del');
                $.ajax({
                    url: "/booking/cancel",
                    method: 'post',
                    data: {
                        bookingId: $('#delBookingId').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Successfully!',
                                text: ' ทำการยกเลิกรายการจองสำเร็จ ',
                                icon: 'success'
                            }).then((result) => {

                                $("#delModal").modal('hide');
                                NewfetchData();
                            });

                        } else {
                            Swal.fire({
                                title: ' fail !',
                                text: ' ไม่สามารถยกเลิกรายการได้ กรุณาตรวจสอบรหัสของท่านอีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $('#booking_password').val('');
                                $('#booking_password').focus();
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
                        getroomId: $("#roomIDs").val(),
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
