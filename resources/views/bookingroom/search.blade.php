@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตรวจสอบการใช้ห้อง</title>
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
                                                            <th>ผู้จอง</th>
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
                                                                        @if ((!empty(Session::get('cmuitaccount'))) && (Session::get('cmuitaccount')==  $rows->booking_email))
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#delModal"
                                                                                class="btn btn-danger btn-sm clikDel"
                                                                                id="{{ $rows->id }}" style="font-size: 12px;">
                                                                               CANCEL<i class="bi bi-x-circle-fill"></i>
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
                                    @if (!empty(Session::get('cmuitaccount')))
                                        <a href="/booking/form/{{ $searchRoomID }}/eng/{{ $RoomtitleSearch }}/{{ $dateUrl }}" class="btn btn-primary   ml-3  btn-Booking" ><i class="bi bi-vector-pen"></i> ทำรายการจอง</a>
                                    @else
                                    <button type="button" class="btn btn-primary   ml-3  btn-Booking"
                                        data-bs-toggle="modal" data-bs-target="#caseBooker">
                                        <i class="bi bi-vector-pen"></i> ทำรายการจอง
                                    </button>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
</svg>   <br/>
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
                    <h5 class="modal-title" id="exampleModalLabel"> เลือกประเภทผู้ใช้งาน </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action " aria-current="true"
                            style="background-color: #fff;color: #000000;">
                           
                            <div class="d-flex w-100 justify-content-between">
                                <a href="/booking/form/{{ $searchRoomID }}/general/{{ $RoomtitleSearch }}/{{ $dateUrl }}"
                                    class="btn " tabindex="-1" role="button" aria-disabled="true">
                                    <h5 class="mb-1"><i class="bi bi-person-bounding-box"></i> บุคคลภายนอกคณะฯ
                                    </h5>
                                </a>
                            </div>
                            <p class="mb-1">
                            <ul>
                                <li>คือบุคคลที่ไม่ได้สังกัดคณะวิศวกรรมศาสตร์ มหาวิทยาลับเชียงใหม่</li>
                                <li>ต้องทำการแนบเอกสารการขอใช้ห้องประกอบการทำรายการจอง หากการขอใช้นั้นมีค่าใช้จ่าย
                                    ระบบจะทำการส่งรายละเอียดการชำระและผลการอนุมัติการใช้งานไปใน Email ของท่านภายใน 1-3
                                    วันทำการ
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
                                $state =  "booking_".$searchRoomID."_".$dateUrl;
                                $CMUOauth = $getService->geturlCMUOauth( $state);
                            
                                ?>
                                <a href="{{ $CMUOauth }}" class=" btn text-white" tabindex="-1" role="button"
                                    aria-disabled="true">
                                    <h5 class="mb-1 text-white"> <i class="bi bi-gear-wide text-white"></i>
                                        บุคคลภายในคณะฯ</h5>
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
