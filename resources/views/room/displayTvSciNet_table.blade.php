<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>พิมพ์ตารางการจองห้อง</title>

    <link rel="stylesheet" href="/css/app/views/demo.css" />
    <link rel="stylesheet" href="/css/vendor/magic/magic.min.css">
    <link rel="stylesheet" href="/css/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/css/jquery.desoslide.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/schedule_scinet.css">
    @includeIf('partials.headtag')
    <style type="text/css">
        @media print {
            @page {
                size: landscape;
                /* กำหนดให้พิมพ์เป็นแนวนอน */
                margin: 0.5cm;
                background-color: #000;
            }

            
             header, footer {
                display: none;
            }

            .showtable {
                width: 100%;
               

            }
        }

        .showtable {
            width: 100%;
            margin: 0px auto;
            overflow-y: hidden;

        }
    
        .mainTv h1 {
            color: #141313;      
           
            text-align: center;
        }
        .bg-black {
           /* background-color: #000;*/
        }
        body ,html {            
               background-color: #000;
              /*  height: 730px;*/
                overflow-y: hidden;
                
            }
            .mainTv {
           /* background-color: #000;*/
            color: #fff;
            font-size: 16px;
            width: 1920px;
            height: 1080px;
           /* border: 1px solid red;*/
            background-image: url("{{ asset('theme_1/img/bgscinet.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        #popshowtable {
            padding-top: 125px;
            color: #000;
        }
        .showtable table{
            /*background-color: #ead7c1*/
            border: 1px solid rgb(243, 241, 241);
        }
      .showtable table tr,
.showtable table td {
    border: none;
}
    </style>
</head>

<body>

    <input type="hidden" id="hinden_roomID" value="{{ $dataroom->id }}">
    <div class="container-fluid- mainTv" >

        <div id="popshowtable">
            <br/>
            <h1 style="text-align: center">ตารางการใช้ห้อง : {{ $dataroom->roomFullName }} </h1>
        <br/>
            <div class="showtable" >

            </div>
        </div>
    </div>
    @includeIf('partials.incJS')
    <script>
        $(function() {
            fetchAll({{ $getust }});

            function fetchAll($uts) {
                var val = "";
                //console.log('Start');
                $.ajax({
                    url: "/fetchScheduleByRoom_scinet",
                    method: 'get',
                    data: {
                        uts: $uts,
                        getroomId: $("#hinden_roomID").val(),
                        hindenBtnBooking: false,
                        hindenPrint: false,
                        pagePrint: false,
                        hindenBtnALL: false,                      
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        $(".showtable").html(response);
                        // window.print();
                    }
                });
            }

            $(document).on('click', '.btnUTS', function(e) {
                var $uts = $(this).attr('valuts');
                fetchAll($uts);
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
            
            $(document).on('click', '.sc-detail-std', function(e) {
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

             $(document).on('click', '.sc-detail-between', function(e) {
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




            $(document).on('click', '.btnPrint', function(e) {
                   //Print the window.
                $(".wrap_schedule_control").css("display", "none");
                window.print();

                $(".wrap_schedule_control").css("display", "block");
            });

        });
    </script>



</body>

</html>
