<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Example Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('js/bootstrap-datepicker-thai/css/datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container p-10 mt-5">
        <h1 class="text-center"> รายการห้องประชุมคณะวิศวกรรมศาสตร์ </h1>
        <div class="row">
            <div class="row g-0 text-center mt-5">
                <div class="col-6 col-md-4">
                    <div class="justify-content-center text-center w-90">
                        <img src="/storage/images/{{ $imgRoom }}" class="img-fluid img-thumbnail">
                    </div>
                    <div class="formSlc  text-start w-90 mt-4">

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
                                <select name="slcRoom" id="slcRoom" class="form-select " required>
                                    <option value="0">-- เลือก --</option>
                                    @foreach ($roomSlc as $item)
                                        <option value='{{ $item->id }}'
                                            @if ($searchRoomID == $item->id) selected @endif> {{ $item->roomFullName }}
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
                                    ตรวจสอบการจอง
                                </button>
                            </div>
                            <hr />
                        </form>
                    </div>


                </div>
                <div class="col-sm-6 col-md-8">
                    <div class="card">
                        <h5 class="card-header">{{ $titleSearch }}</h5>
                        <div class="card-body">
                            <dvi class="show_all">
                                <table class="table mt-2">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ช่วงเวลาที่ใช้งาน</th>
                                            <th>รายการจอง</th>
                                            <th>ผู้จอง</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($getBookingList) > 0)
                                            @foreach ($getBookingList as $rows)
                                                <tr>
                                                    <td>{{ $rows->booking_time_start }} -
                                                        {{ $rows->booking_time_finish }}
                                                    </td>
                                                    <td>{{ $rows->booking_subject }}</td>
                                                    <td>{{ $rows->booking_booker }}</td>
                                                    <td>{{ $rows->description }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">
                                                    <div class="p-2 mt-2 text-center">
                                                        <div class="alert alert-success" role="alert">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                                <path
                                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                            </svg>
                                                            <br /> ไม่พบรายการจองห้องวันนี้
                                                            <p> ท่านสามารถทำรายการจอง นี้ได้โดยกดปุ่ม " ทำรายจองห้อง "
                                                                และระบุรายละเอียดการขอใช้ให้ครบถ้วน </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <div class="text-center d-flex justify-content-center">
                                <button type="button" id="btnBooking" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-calendar2-plus-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 3.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5H2.545c-.3 0-.545.224-.545.5m6.5 5a.5.5 0 0 0-1 0V10H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V11H10a.5.5 0 0 0 0-1H8.5z" />
                                    </svg> ทำรายจองห้อง
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    {{-- Booking FORM   modal start --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> ระบุรายละเอียกการขอใช้ห้อง </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <form id="add_booking_form" class="row g-3 w-90 m-10-auto" method="post" action="#"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="roomID" value="{{ $searchRoomID }}">
                        <input type="hidden" name="dateStart" value="{{ $searchDates }}">

                        <div class="col-md-6 p-2">
                            <label for="timesStart" class="form-label">ช่วงเวลาที่ใช้งาน *</label>
                            <br />
                            <select name="booking_time_start" class="form-control-2" required>
                                <option value=""> เริ่ม </option>
                                <option value="0800">08:00</option>
                                <option value="0830">08:30</option>
                                <option value="0900">09:00</option>
                                <option value="0930">09:30</option>
                                <option value="1000">10:00</option>
                                <option value="1030">10:30</option>
                                <option value="1100">11:00</option>
                                <option value="1130">11:30</option>
                                <option value="1200">12:00</option>
                                <option value="1230">12:30</option>
                                <option value="1300">13:00</option>
                                <option value="1330">13:30</option>
                                <option value="1400">14:00</option>
                                <option value="1430">14:30</option>
                                <option value="1500">15:00</option>
                                <option value="1530">15:30</option>
                                <option value="1600">16:00</option>
                                <option value="1630">16:30</option>
                                <option value="1700">17:00</option>
                                <option value="1730">17:30</option>
                                <option value="1800">18:00</option>
                            </select> :
                            <select name="booking_time_finish" class="form-control-2" required>
                                <option value="">สิ้นสุด</option>
                                <option value="0800">08:00</option>
                                <option value="0830">08:30</option>
                                <option value="0900">09:00</option>
                                <option value="0930">09:30</option>
                                <option value="1000">10:00</option>
                                <option value="1030">10:30</option>
                                <option value="1100">11:00</option>
                                <option value="1130">11:30</option>
                                <option value="1200">12:00</option>
                                <option value="1230">12:30</option>
                                <option value="1300">13:00</option>
                                <option value="1330">13:30</option>
                                <option value="1400">14:00</option>
                                <option value="1430">14:30</option>
                                <option value="1500">15:00</option>
                                <option value="1530">15:30</option>
                                <option value="1600">16:00</option>
                                <option value="1630">16:30</option>
                                <option value="1700">17:00</option>
                                <option value="1730">17:30</option>
                                <option value="1800">18:00</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="booking_booker" class="form-label">ผู้จอง </label>
                            <input type="text" class="form-control" id="booking_booker" name="booking_booker"
                                placeholder=" ผู้ทำรายการ " />
                        </div>
                        <div class="col-md-12">
                            <label for="booking_subject" class="form-label"> เรื่องที่ขอใช้ / กิจกรรม / ตารางเรียน
                                *</label>
                            <input type="text" class="form-control" id="booking_subject" name="booking_subject"
                                required placeholder=" ระบุเหตุผลการขอใช้ห้อง " />
                        </div>
                        <div class="col-md-3">
                            <label for="booking_ofPeople" class="form-label">จำนวนผู้เข้าร่วมประชุม</label>
                            <input type="number" class="form-control" id="booking_ofPeople" name="booking_ofPeople"
                                placeholder=" จำนวนที่เข้าใช้งาน " />
                        </div>

                        <div class="col-md-3">
                            <label for="booking_department" class="form-label">หน่วยงาน</label>
                            <input type="text" class="form-control" id="booking_department"
                                name="booking_department" placeholder=" สังกัดหน่วยงาน /องค์กร /บริษัท " />
                        </div>
                        <div class="col-md-3">
                            <label for="booking_department" class="form-label">เบอร์โทรติดต่อ</label>
                            <input type="text" class="form-control" id="booking_contact" name="booking_contact"
                                placeholder=" 05394xxxx" />
                        </div>
                        <div class="col-3">
                            <label for="booking_cancel" class="form-label"> รหัสยกเลิกการจอง </label>
                            <input type="password" class="form-control" id="booking_cancel" name="booking_cancel"
                                placeholder=" รหัสยกเลิกการจอง " />
                        </div>

                        <div class="col-12">
                            <div>
                                ระบุอุปกรณ์ที่ต้องการขอใช้ :
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="booking_computer"
                                        name="booking_computer" value="1">
                                    <label class="form-check-label" for="inlineRadio1"> คอมพิวเตอร์ </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="booking_food"
                                        name="booking_food" value="1">
                                    <label class="form-check-label" for="inlineRadio2">อาหารและเครื่องดื่ม</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="booking_zoom"
                                        name="booking_zoom" value="1">
                                    <label class="form-check-label" for="inlineRadio2">ใช้โปรแกรม zoom </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="booking_camera"
                                        name="booking_camera" value="1">
                                    <label class="form-check-label" for="inlineRadio2">ช่างภาพ/บันทึกภาพ</label>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label"> หมายเหตุ </label>
                            <textarea class="form-control" placeholder="ระบุรายละเอียดการขอใช้เพิ่มเติม " id="description" name="description"></textarea>
                        </div>


                        <div class="modal-footer my-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" id="add_btn" class="btn btn-primary"> จองห้อง </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Booking FORM    modal end --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}">
    </script>
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
                    url: "{{ url('/booking/insertBooking') }}",
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
                        } else {
                            //จองไม่ได้
                            Swal.fire({
                                title: 'Booking fail !',
                                text: ' ไม่สามารถจองห้องในเวลานี้ได้ โปรดตรวจสอบ วันที่และเวลา ใหม่อีกครั้ง ',
                                icon: 'error'
                            }).then((result) => {
                                $("#add_btn").text('เพิ่มข้อมูลห้อง');
                                $("#add_booking_form")[0].reset();
                                $("#addModal").modal('hide');
                                NewfetchData();
                            });

                        }

                    }
                });
                return false;
            });

            function NewfetchData() {
                $("#serachBookingDate").submit();
            }

        });
    </script>
</body>

</html>
