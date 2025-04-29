@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายการจองห้องประชุม</title>
    <link rel="stylesheet" href="/css/app/views/demo.css" />
    <link rel="stylesheet" href="/css/vendor/magic/magic.min.css">
    <link rel="stylesheet" href="/css/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/css/jquery.desoslide.css">
    
    <link rel="stylesheet" href="/css/schedule.css">
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
                        @php
                            if($roomTypeId == 2) {
                                $roomType = 'ห้องเรียน';
                            } elseif($roomTypeId == 3) {
                                $roomType = 'ห้องคอมพิวเตอร์';
                            } else {
                                $roomType = 'ห้องประชุม';
                            }
                        @endphp
                        
                        <div class="col-md-12">
                            <div class="col-md-12 text-right p-2 mb-2 justify-end text-end">
                                <a href="/booking/{{$roomTypeId}}/{{$roomType}}" class="mt-3 mb-3"> << ตรวจสอบห้อง</a> / แสดงตารางเรียน 
                            </div>
    
                            <div class="card">
                                <h5 class="card-header">ตรวจสอบการใช้ห้อง
                                    @if($roomTypeId == 2)
                                       <b> ห้องเรียน </b>
                                    @elseif($roomTypeId == 3)
                                    <b> ห้องคอมพิวเตอร์ </b>
                                    @endif

                                    (รวมทุกห้อง)
                                    
                                    <br />คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่ 
                           

                                </h5>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="showtables " >

                                               

                                            </div>

                                        </div>
                                       
                                    </div>
                                </div> 

                            </div>


                        </div>
                        <center>
                            <a href="/booking/{{$roomTypeId}}/{{$roomType}} " class="btn btn-primary mt-3 mb-3"> << ย้อนกลับ </a>
                        </center>

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
    @section('corescript')
    <script>
        fetchAll('');

        function fetchAll($uts) {
            var val = "";
            $.ajax({
                url: "/fetchScheduleAll",
                method: 'get',
                data: {
                    uts: $uts,                  
                    dateSearch: '{{$dateTitle}}',
                    roomTypeId: '{{$roomTypeId}}',
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    $(".showtables").html(response);
                }
            });
        }
        $(document).on('click', '.btnUTS', function (e) {
            var $uts = $(this).attr('valuts');
            fetchAll($uts);
        });

        $(document).on('click', '.sc-detail-std', function (e) {
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

    </script>
</body>

</html>