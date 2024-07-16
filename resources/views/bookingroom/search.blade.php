@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ตรวจสอบการใช้ห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/js/bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/schedule2.css">
</head>

<body>

    <div class="container p-10 mt-5">
        <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1>
        <div class="row">
            <div class="row g-0 text-center mt-5">

                <div class="col-md-9">
                    <div class="card">
                        <h5 class="card-header">{{ $titleSearch }}</h5>
                        <div class="card-body">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true"> แสดงรายการจองห้องประจำวัน
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
                                                                @if ((int) $rows->booking_status > 0)
                                                                    <span class="badge text-bg-success"> <i
                                                                            class="bi bi-check-circle-fill"></i> อนุมัติ
                                                                    </span>
                                                                @else
                                                                    <span class="badge text-bg-warning"> <i
                                                                            class="bi bi-clock-history"></i>
                                                                        รอการอนุมัติ</span>
                                                                @endif
                                                            </td>

                                                            <td>{{ $rows->description }} </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4">
                                                            <div class="p-2 mt-2 text-center">
                                                                <div class="alert alert-success" role="alert">
                                                                    <i class="bi bi-check2-circle"></i>

                                                                    <br /> ไม่พบรายการจองห้องวันนี้
                                                                    <p> ท่านสามารถทำรายการจอง นี้ได้โดยกดปุ่ม "
                                                                        ทำรายจองห้อง
                                                                        "
                                                                        และระบุรายละเอียดการขอใช้ให้ครบถ้วน </p>
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
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4> ระบุรายละเอียดการขอใช้ห้อง </h4>
                            @if (empty(Session::get('cmuitaccount')))
                                <div class="text-center">
                                    <a href="{{ $getService->geturlCMUOauth($searchRoomID) }}" class="btn btn-warning "
                                        tabindex="-1" role="button" aria-disabled="true">
                                        <h5 class="mb-1"> <i class="bi bi-gear-wide"></i> สำหรับบุคคลภายใน
                                            เข้าสู้ระบบการจองด้วย @cmu.ac.th </h5>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="card-body justify-content-start text-start">
                            <form id="add_booking_form" class="row g-3 w-90 m-10-auto" enctype="multipart/form-data"
                                action="/booking/insertBooking" method="post">
                                @csrf
                                <input type="hidden" name="roomID" id="roomID" value="{{ $searchRoomID }}">
                                <input type="hidden" name="booking_type" id="booking_type" value="{{ $usertype }}">
                                <div class="col-md-3 p-2">
                                    <label for="schedule_startdate" class="form-label"> วันที่เริ่ม *</label>
                                    <input class="form-control dateScl" type="text" data-provide="datepicker"
                                        data-date-language="th" value="{{ $searchDates }}" id="schedule_startdate"
                                        name="schedule_startdate" required>
                                </div>
                                <div class="col-md-3 p-2">
                                    <label for="schedule_enddate" class="form-label"> วันที่สิ้นสุด </label>
                                    <input class="form-control dateScl" type="text" data-provide="datepicker"
                                        data-date-language="th" value="{{ $searchDates }}" id="schedule_enddate"
                                        name="schedule_enddate" required>
                                </div>

                                <div class="col-md-6 p-2">
                                    <label for="booking_time_start" class="form-label">ช่วงเวลาที่ใช้งาน *</label>
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
                                    <label for="booking_booker" class="form-label">ผู้ขอใช้ * </label>
                                    <input type="text" class="form-control" id="booking_booker"
                                        name="booking_booker" placeholder=" ระบุชื่อผู้ทำรายการ "
                                        value=" {{ Session::get('userfullname') }}" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="booking_department" class="form-label">สังกัดหน่วยงาน /องค์กร
                                        /บริษัท </label>
                                    <input type="text" class="form-control" id="booking_department"
                                        name="booking_department" placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท " />
                                </div>
                                <div class="col-md-12">
                                    <label for="booking_subject" class="form-label">
                                        เรื่องที่ขอใช้/โครงการกิจกรรม
                                        *</label>
                                    <input type="text" class="form-control" id="booking_subject"
                                        name="booking_subject" required placeholder=" ระบุเหตุผลการขอใช้ห้อง " />
                                </div>
                                <div class="col-md-4">
                                    <label for="booking_ofPeople" class="form-label">จำนวนผู้เข้าใช้</label>
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
                                    <label for="booking_phone" class="form-label">เบอร์โทรติดต่อ
                                        *</label>
                                    <input type="text" class="form-control" id="booking_phone"
                                        name="booking_phone" placeholder=" 05394xxxx" />
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">
                                        ระบุรายละเอียดการขอใช้เพิ่มเติม </label>
                                    <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                                </div>
                                @if (empty(Session::get('cmuitaccount')) || $usertype == 'general')
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">*แนบไฟล์ เอกสารการขอให้สถานที่ (.pdf
                                            เท่านั้น)
                                        </label>
                                        <input class="form-control" type="file" id="formFile"
                                            accept="application/pdf" required name="pdf">
                                        <br />
                                        <div> กรณีบุคคลภายนอกต้องแนบเอกสาร เพื่อขอใช้สถานที่ </div>
                                    </div>
                                @endif

                                <input type="hidden" name="booker_cmuaccount"
                                    value="{{ Session::get('cmuitaccount') }}">

                                <div class="p-2 text-center text-danger">
                                    *** โปรดตรวจสอบข้อมูลของท่าน ก่อนยืนยันการทำรายการจองห้อง
                                </div>
                                <div class="text-center  justify-content-center  mb-3 ">

                                    <button type="submit" id="add_btn" class="btn btn-success">
                                        <i class="bi bi-calendar2-plus-fill"></i> ทำรายจองห้อง
                                    </button>
                                </div>

                            </form>
                        </div>
                        <br />
                    </div>
                    <br />
                </div>

                <div class="col-md-3">
                    <div class="justify-content-center text-center w-90">
                        <img src="/storage/images/{{ $imgRoom }}" class="img-fluid img-thumbnail">
                    </div>
                    <div class="formSlc  text-start w-90 mt-4">

                        <h4>
                            <i class="bi bi-calendar2-plus-fill"></i>
                            ตรวจสอบการใช้ห้อง
                        </h4>
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
                                <button type="submit" id="search_booking" class="btn btn-dark">
                                    ตรวจสอบ
                                </button>
                            </div>
                            <hr />
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>


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
                        console.log(response)
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
