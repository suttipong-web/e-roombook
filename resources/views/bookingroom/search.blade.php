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
                                                แสดงรายการจองห้องประจำวัน
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane"
                                                aria-selected="false">ตารางการจองห้องประจำสัปดาห์</button>
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
                                                            <th>สถานะ</th>
                                                            <th>หมายเหตุ</th>
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

                                                                    <td>{{ $rows->description }} </td>
                                                                    <td>
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#delModal"
                                                                            class="btn btn-danger btn-sm clikDel"
                                                                            id="{{ $rows->id }}">
                                                                            <i class="bi bi-dash-circle-fill"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="p-2 mt-2 text-center">
                                                                        <div class="alert alert-info" role="alert">
                                                                            <h4>
                                                                                <i class="bi bi-check2-circle"></i>
                                                                            </h4>
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
                            <div class="card mt-5 mb-3">
                                <div class="card-header p-3">
                                    @if (empty(Session::get('cmuitaccount')) || $usertype == 'general')
                                        <h5>
                                            <span class="text-danger"> บุคคลภายนอกคณะฯ </span>
                                            ให้กรอกข้อมูลการจองตามแบบฟอร์มด้านล่าง
                                        </h5>
                                        <div class="text-center">
                                            <a href="{{ $getService->geturlCMUOauth($searchRoomID) }}"
                                                class="btn btn-primary " tabindex="-1" role="button"
                                                aria-disabled="true">
                                                <i class="bi bi-box-arrow-in-right"></i> บุคคลภายในคณะฯ
                                                คลิกที่นี่

                                            </a>
                                        </div>
                                    @else
                                        <h5>
                                            กรอกข้อมูลการจองตามแบบฟอร์มด้านล่าง
                                        </h5>
                                    @endif
                                </div>

                                <div class="card-body justify-content-start text-start ">
                                    <form id="add_booking_form" class="row g-3 w-100 m-10-auto"
                                        enctype="multipart/form-data" action="/booking/insertBooking" method="post">
                                        @csrf
                                        <input type="hidden" name="roomID" id="roomID" value="{{ $searchRoomID }}">
                                        <input type="hidden" name="booking_type" id="booking_type"
                                            value="{{ $usertype }}">
                                        <div class="col-md-3 p-2">
                                            <label for="schedule_startdate" class="form-label"> วันที่เริ่ม *</label>
                                            <input class="form-control dateScl" type="text"
                                                data-provide="datepicker" data-date-language="th"
                                                value="{{ $searchDates }}" id="schedule_startdate"
                                                name="schedule_startdate" required>
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <label for="schedule_enddate" class="form-label"> วันที่สิ้นสุด </label>
                                            <input class="form-control dateScl" type="text"
                                                data-provide="datepicker" data-date-language="th"
                                                value="{{ $searchDates }}" id="schedule_enddate"
                                                name="schedule_enddate" required>
                                        </div>

                                        <div class="col-md-6 p-2">
                                            <label for="booking_time_start" class="form-label">ช่วงเวลาที่ใช้งาน
                                                *</label>
                                            <br />
                                            <select name="booking_time_start" class="form-control-2" required
                                                id="booking_time_start">
                                                <option value=""> เวลาเริ่ม* </option>
                                                @foreach ($getService->getALlTimes() as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select> :
                                            <select name="booking_time_finish" class="form-control-2" required>
                                                <option value="">เวลาสิ้นสุด*</option>
                                                @foreach ($getService->getALlTimes() as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="booking_booker" class="form-label">ชื่อผู้จอง * </label>
                                            <input type="text" class="form-control" id="booking_booker"
                                                name="booking_booker" placeholder=" ระบุชื่อผู้ทำรายการ "
                                                value=" {{ Session::get('userfullname') }}" required />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="booking_department" class="form-label"> สังกัดหน่วยงาน /
                                                องค์กร
                                                / บริษัท *</label>
                                            <input type="text" class="form-control" id="booking_department"
                                                name="booking_department"
                                                placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท "
                                                value="{{ Session::get('dep_name') }}" required />
                                        </div>

                                        <div class="col-md-12">
                                            <label for="booking_subject" class="form-label">
                                                หัวข้อในการจอง *
                                            </label>
                                            <input type="text" class="form-control" id="booking_subject"
                                                name="booking_subject" required
                                                placeholder=" ระบุเหตุผลการขอใช้ห้อง " />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_ofPeople" class="form-label">จำนวนผู้ใช้</label>
                                            <input type="number" class="form-control" id="booking_ofPeople"
                                                name="booking_ofPeople" placeholder=" จำนวนที่เข้าใช้งาน " />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_email" class="form-label"> Email * </label>
                                            <input type="email" class="form-control" id="booking_email"
                                                name="booking_email" placeholder=" Email " required
                                                value="{{ Session::get('cmuitaccount') }}" />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="booking_phone" class="form-label">โทรศัพท์
                                            </label>
                                            <input type="text" class="form-control" id="booking_phone"
                                                name="booking_phone" placeholder=" 05394xxxx" />
                                        </div>

                                        <div class="col-12">
                                            <label for="description" class="form-label">
                                                ระบุรายละเอียดเพิ่มเติม </label>
                                            <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="booking_code_cancel" class="form-label">รหัสยกเลิกรายการ
                                            </label>
                                            <input type="password" class="form-control" id="booking_code_cancel"
                                                name="booking_code_cancel" placeholder=" xxxx " />
                                        </div>
                                        @if (empty(Session::get('cmuitaccount')) || $usertype == 'general')
                                            <div class="text-primary"> โปรดทำการแนบไฟล์เอกสารขอใช้งานจากหน่วยงานของท่าน
                                                เพื่อใช้ประกอบการพิจารณาอนุมัติใช้งาน (ไฟล์ pdf เท่านั้น) * </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">*แนบไฟล์
                                                </label>
                                                <input class="form-control" type="file" id="formFile"
                                                    accept="application/pdf" required name="pdf">
                                                <br />
                                                <div> กรณีบุคคลภายนอกต้องแนบเอกสาร เพื่อขอใช้สถานที่ </div>
                                            </div>
                                        @endif

                                        <input type="hidden" name="booker_cmuaccount"
                                            value="{{ Session::get('cmuitaccount') }}">

                                        <div class="p-2 text-center text-success fs-6">
                                            @if ($usertype == 'general' || empty(Session::get('cmuitaccount')))
                                                แบบฟอร์มการจองนี้สำหรับบุคคลภายนอกคณะฯ เท่านั้น <br />
                                                <span style="color: blueviolet"> สำหรับบุคคลภายในคณะฯ คลิกที่ปุ่ม
                                                    <!--  <a href="{{ $getService->geturlCMUOauth($searchRoomID) }}"> -->
                                                    “บุคคลภายในคณะฯคลิกที่นี่”
                                                    <!--</a>-->
                                                    ด้านบน </span> <br />
                                            @endif
                                            โปรดตรวจสอบข้อมูลของท่านให้เรียบร้อย ก่อนทำการยืนยันรายการจองห้อง
                                        </div>
                                        <div class="text-center  justify-content-center  mb-3 ">
                                            <button type="submit" class="btn btn-success btn-Booking">
                                                <i class="bi bi-vector-pen"></i> ทำรายจองห้อง
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                <br />
                            </div>
                            <br />
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
                    <h5 class="modal-title"> ยืนยันการลบข้อมูล </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body  bg-light ">

                    <div class="row col-12 ">
                        <div class="mb-3">
                            <label for="booking_password" class="form-label">รหัสยกเลิกของท่าน </label>
                            <input type="password" class="form-control" id="booking_password"
                                name="booking_password" placeholder=" รหัสยกเลิกของท่าน " required>

                        </div>
                    </div>
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
                        booking_code_cancel: $('#booking_password').val(),
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

            //Add Data เพิ่มการจอง ใหม่
            // add new  ajax request
            $("#add_booking_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_btn").text('Adding...');
                $.ajax({
                    url: "/booking/insertBooking",
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            Swal.fire({
                                title: 'Booking Successfully!',
                                text: ' ทำรายการจองสำเร็จ ',
                                icon: 'success'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#add_booking_form")[0].reset();
                                $("#addModal").modal('hide');
                                NewfetchData();
                            });
                        } else if (response.status == 209) {
                            // แนบไฟล์ไม่สำเร็จ 
                            Swal.fire({
                                title: 'Booking fail !',
                                text: response.errortext,
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#addModal").modal('hide');
                            });
                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'Booking fail !',
                                text: ' ไม่สามารถจองห้องในเวลานี้ได้ โปรดตรวจสอบ วันที่และเวลา ใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#addModal").modal('hide');
                                $("#booking_time_start").focus();
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
                        getroomId: $("#roomID").val(),
                        hindenBtnBooking: false,
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
