@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายการการจองห้อง</title>
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
                        <div class="col-md-12">
                            <div class="card mt-0 mb-3">
                                <div class="card-header">
                                    <div class="col-md-12  ">
                                        <h5 class="section_title"> รายการการจองโดย
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path fill-rule="evenodd"
                                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                            </svg> {{ Session::get('userfullname') }}
                                            ({{ Session::get('cmuitaccount') }})
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body justify-content-start text-start ">
                                    <div class="card-body  disPlayTableBooking">
                                        <table class="table table-sm mt-2" 
                                        
                                        
                                          @if (count($getBookingList) > 0)
                                           id="tableListbooking"
                                         @endif
                                            style="font-size: 14px;">
                                            <thead class="table-secondary ">
                                                <tr style="text-align: center;">
                                                    <th width="10%" style="text-align: center;">วันที่ทำรายการ</th>
                                                    <th width="10%"style="text-align: center;">ช่วงเวลาที่ใช้</th>
                                                    <th width="20%" style="text-align: center;">ห้อง</th>
                                                    <th width="30%" style="text-align: center;">รายการ</th>
                                                    <th width="12%" style="text-align: center;"> รายละเอียด </th>
                                                    <th width="9%" style="text-align: center;"> สถานะการจอง </th>
                                                    <th width="8%" style="text-align: center;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($getBookingList) > 0)
                                                    @foreach ($getBookingList as $rows)
                                                        <tr style="text-align: left;">

                                                            <td style="text-align: center;">

                                                               {{ $getService->convertDateThaiWithTime($rows->booking_at, false,true) }}
                                                            </td>
                                                            <td class="text-center" style="text-align: center;">
   {{ $getService->convertDateThaiNoTime($rows->schedule_startdate, true) }}  <br/>
                                                                {{ Str::limit($rows->booking_time_start, 5, '') }} -
                                                                {{ Str::limit($rows->booking_time_finish, 5, '') }}
                                                            </td>
                                                            <td>{{ $rows->roomFullName }} </td>
                                                            <td>{{ $rows->booking_subject }} </td>
                                                            <td>{{ $rows->description }}  </td>
                                                            <td>
                                                                @if ($rows->booking_AdminAction == 'approved' || (int)$rows->booking_status==1 ) 
                                                                    <span class="badge text-bg-success"> <i
                                                                            class="bi bi-check-circle-fill"></i>
                                                                        อนุมัติ
                                                                    </span>
                                                                @elseif ($rows->booking_status == '2')
                                                                    <span class="badge text-bg-warning"> <i
                                                                            class="bi bi-clock-history"></i>
                                                                        ยกเลิกรายการ</span>
                                                                @else
                                                                    <span class="badge text-bg-warning"> <i
                                                                            class="bi bi-clock-history"></i>
                                                                        รอการอนุมัติ</span>
                                                                @endif



                                                            </td>

                                                            <td>
                                                                @if (!empty(Session::get('cmuitaccount')) && Session::get('cmuitaccount') == $rows->booking_email)
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#delModal"
                                                                        class="btn btn-danger btn-sm clikDel"
                                                                        id="{{ $rows->id }}"
                                                                        style="font-size: 12px;">
                                                                        CANCEL<i class="bi bi-x-circle-fill"></i>
                                                                    </a>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>                                                   
                                                        <td colspan="7">
                                                            <div class="p-2 mt-2 text-center">
                                                                <div class="alert alert-success" role="alert">
                                                                    
                                                                    <p > <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg>  ไม่มีประวัติรายการจองใช้ห้องของท่าน</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>

                                    </div>


                                </div>
                                <br />
                            </div>
                            <br />

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

    @includeIf('partials.footer')
    @includeIf('partials.incJS')
    <script>
        $(function() {
            $("#tableListbooking").DataTable({
                order: [0, 'desc']
            });

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
                                window.location.reload();
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

        });
    </script>
</body>

</html>
