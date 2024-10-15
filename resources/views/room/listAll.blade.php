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
                        <div class="col-md-12">
                            <div class="card">
                                <h5 class="card-header">ข้อมูลการขอใช้ห้อง

                                </h5>
                                <div class="card-body">
                                    <div>แสดงรายการใช้ห้องทั้งหมด</div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="show_all">
                                                <table class="table mt-2 table-sm" id="tableListbooking">
                                                    <thead class="table-light ">
                                                        <tr class="text-start">
                                                            <th>ช่วงเวลา</th>
                                                            <th>ห้องประชุม</th>
                                                            <th>รายการ</th>

                                                            <th>ผู้จอง</th>
                                                            <th>หน่วยงาน</th>
                                                            <th>สถานะ</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (count($bookingall) > 0)
                                                            @foreach ($bookingall as $rows)
                                                                <tr class="text-start">
                                                                    <td>
                                                                        {{ $getService->convertDateThai($rows->schedule_startdate, false, false) }}
                                                                        {{ Str::limit($rows->booking_time_start, 5, '') }}-{{ Str::limit($rows->booking_time_finish, 5, '') }}
                                                                    </td>
                                                                    <td>{{ $rows->roomFullName }}</td>
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
        $(function() {
            $("#tableListbooking").DataTable({
                order: [0, 'ASC']
            })



        });
    </script>
</body>

</html>
