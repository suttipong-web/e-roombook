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
    <link rel="stylesheet" href="/css/schedule.css">
    @includeIf('partials.headtag')
</head>

<body>
   
    <input type="hidden" id="hinden_roomID" value="{{$dataroom->id}}">
    <div class="container-fluid">       
   
        <h3 class="text-center">{{$dataroom->roomFullName}}</h3>
        <hr>
        <div class="" id="popshowtable">
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
            fetchAll({{$getust}});
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
                        hindenBtnALL: true,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        $(".showtable").html(response);
                        window.print();
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

        });
    </script>



</body>

</html>
