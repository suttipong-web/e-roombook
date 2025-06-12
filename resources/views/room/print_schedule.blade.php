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
    <link rel="stylesheet" href="/css/schedule_print.css">
    @includeIf('partials.headtag')
    <style type="text/css">
        @media print {
            @page {
                size: landscape;
                /* กำหนดให้พิมพ์เป็นแนวนอน */
                margin: 0.5cm;
            }

            body {
                transform: scale(0.90);
                /* ปรับขนาดเนื้อหาให้พอดีกับหน้า */
                transform-origin: top left;
            }
             header, footer {
                display: none;
            }

            .showtable {
                width: 100%;
                margin: 5px auto;

            }
        }

        .showtable {
            width: 1200px;
            margin: 5px auto;
            text-align: center;

        }
    </style>
</head>

<body>

    <input type="hidden" id="hinden_roomID" value="{{ $dataroom->id }}">
    <div class="container">

        <h3 class="text-center">{{ $dataroom->roomFullName }}</h3>
        <hr>
        <div class="p-2" id="popshowtable">
            <h5>ตารางการใช้ห้อง ( Room Availability)</h5>
            <div class="row">

            </div>
            <div class="showtable">

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
                    url: "/fetchScheduleByRoom",
                    method: 'get',
                    data: {
                        uts: $uts,
                        getroomId: $("#hinden_roomID").val(),
                        hindenBtnBooking: true,
                        hindenPrint: true,
                         pagePrint: true,
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
