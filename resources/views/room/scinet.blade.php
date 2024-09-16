@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="tis-620">
    <title>ตารางจองห้องประชุม คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</title>
    <!--<link href="style.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100&display=swap"
    rel="stylesheet">
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100&display=swap');

    @font-face {
        font-family: 'Kanit', sans-serif;
        src: url(Kanit/Kanit-Bold.ttf);
        font-weight: bold;
    }

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 25px;
        /*background-color:#004080*/
        position: relative;
        width: 960px;
        margin: 0px auto;
    }

    .containers {
        width: 960px;
        margin: 0px auto;
        font-family: 'Kanit', sans-serif;
        background-image: url({{ asset('img/bg.jpg') }});
        height: 1080px;
        font-weight: 900;
        background-repeat: no-repeat;
        background-color: #FFFFFF;

    }


    .titleRoom {
        font-weight: 400;
    }

    .titleRoomACT {
        font-weight: bold;
        color: red;
    }

    .bgrow {
        background-color: #009879;
    }

    .animate-charcter {
        text-transform: uppercase;
        background-image: linear-gradient(-225deg,
                #231557 0%,
                #44107a 29%,
                #ff1361 67%,
                #fff800 100%);
        background-size: auto auto;
        background-clip: border-box;
        background-size: 200% auto;
        color: #fff;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 3s linear infinite;
        /*display: inline-block;*/
        font-size: 22px;

    }

    @keyframes textclip {
        to {
            background-position: 200% center;
        }
    }

    .animate-charcter2 {
        font-weight: 700;
        font-size: 26px;
        animation: 5s fadeIn infinite;
    }

    @keyframes fadeIn {
        0% {

            opacity: 0;
            transform: translate3d(0, 5px, 0);
            background-color: #7DBEFF;
            color: #000000;

        }
        30%,
        60% {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            color: #990000;
        }
        61%,
        80% {
            opacity: 1;
            transform: translate3d(0, 0, 0);
            color: #990000;
            background-color: #CAE4FF;
        }

        90% {
            opacity: 0;
            transform: translate3d(0, -0px, 0);

            background-color: #EAF4FF;

        }

        100% {

            opacity: 0;
            transform: translate3d(0, -5px, 0);


        }
    }

    .roomeName {
        position: absolute;
        right: 20px;
        top: 15px;
        color: #FFFFFF;
        font-size: 50px;
        font-weight: 600;
        width: 650px;
        text-align: right
    }

    .divMaintime {
        /*	border:1px red solid ;*/
        width: 100%;
        min-height: 1000px;
        padding-top: 170px;
        font-weight: bold;
    }

    .roomeDate {
        background-color: #000000;
        width: 390px;
        color: #FFFFFF;
        margin-left: 255px;
        text-align: center;
        padding: 5px;
        font-size: 40px;
        f
    }

    .row_table {
        margin: 20px auto;
        min-height: 180px;
        position: relative;
        font-size: 37px;
    }

    .Htitle {
        padding-top: 6px;
        padding-left: 80px;
        font-weight: 900;
        font-size: 42px;
    }
    .displayNow {
        position: absolute;
        left: 8px;
        top: 10px
    }
</style>

<body>
    <div class="containers">
        <div class="roomeName">{{ $RoomTitle }}</div>
        <div class="divMaintime">
            <div class="roomeDate"> {{ $DateTitlePage }} </div>
            @if (count($listBookingRoom) > 0)
                @foreach ($listBookingRoom as $rows)
                    <div class="row_table">
                        <div class="displayNow">
                            <?php
                            $timesstart = $getService->get_TimenowConvert($rows->booking_time_start);
                            $endtimes = $getService->get_TimenowConvert($rows->booking_time_finish);            
                            if ($getTimeNow >= $timesstart && $getTimeNow <= $endtimes) {
                                echo '<img src="/img/now.gif">';
                            } elseif ($getTimeNow <= $timesstart) {
                                echo '<img src="/img/next.png">';
                            }
                            ?>
                        </div>
                        <div
                            style="background-image:url(/img/bar.png);width:734px;height:74px;margin-left:195px;position:relative">
                            <div style="position:absolute;right:17px;top:15px;">{{ $rows->booking_booker }}</div>
                            <div class="Htitle">
                                {{ Str::limit($rows->booking_time_start, 5, '') }}-{{ Str::limit($rows->booking_time_finish, 5, '') }}
                            </div>
                            <div
                                style="background-color:#990000;color:#FFFFFF;min-height:80px;width:672px;margin-left:62px;margin-top:8px;padding:15px">
                                {{ $rows->booking_subject }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
