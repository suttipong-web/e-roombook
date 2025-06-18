@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>พิมพ์แบบฟอร์มการขอใช้ห้อง </title>
    @includeIf('partials.headtag')
</head>
<style type="text/css">
    body {
        margin: 0;
        padding: 0;
        background: rgb(204, 204, 204);

    }

    page[size="A4"] {
        background: white;
        width: 21cm;
        height: 29.7cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        /* box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);*/
        padding-top: 1px;

    }

    @media print {

        body,
        page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
    }

    .main-form {
        width: 93%;
        border: 1px solid;
        margin: 30px auto;
        min-height: 1065px;
        padding-bottom: 50px;
        padding-top: 30px;
        padding-left: 30px;
        padding-right: 30px;
        line-height: 30px;
        margin-top: 20px;
    }

    .htitlte h6 {
        text-align: center;
    }
</style>

<body>
    <page size="A4">
        <div class="main-form">
            <div class="htitlte">
                <center> <img src="/storage/images/RibbinENG1-150x130.png" height="100"></center>
                <br />
                <h6> แบบฟอร์มการขอใช้ห้องประชุม / ห้องเรียน / ห้องปฏิบัติการคอมพิวเตอร์
                    <hr />
                </h6>
            </div>
            <div style="text-align: right;margin-top: 30px;">
               
                วันที่  {{ $getService->convertDateThai($detailBooking[0]->admin_action_date,false, false) }}
            </div>

            <table>
                <tr>
                    <td>เรื่อง &nbsp;&nbsp;</td>
                    <td>ขอใช้สถานที่ {{ $detailBooking[0]->roomFullName }}</td>
                </tr>
                <tr>
                    <td>เรียน &nbsp;&nbsp;</td>
                    <td>{{$subjectdoc}}</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;</td>
                    <td>ข้าพเจ้า&nbsp;{{ $detailBooking[0]->booking_booker }}&nbsp;&nbsp;&nbsp;สังกัด
                        &nbsp;&nbsp;&nbsp;{{ $detailBooking[0]->booking_department }}
                        &nbsp;&nbsp;&nbsp;&nbsp;เบอร์โทร&nbsp;{{ $detailBooking[0]->booking_phone }} </td>
                </tr>
                <tr>
                    <td></td>
                    <td>มีความประสงค์จะขอใช้ห้องเพื่อ {{ $detailBooking[0]->booking_subject }} </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="text-align: left;text-justify:auto ;">
                            ขอใช้ในวันที่ 
                         
                            &nbsp;&nbsp;{{ $getService->convertDateThaiNoTime($detailBooking[0]->schedule_startdate, false) }}
                            &nbsp;&nbsp;ถึงวันที่ &nbsp;&nbsp;{{ $getService->convertDateThaiNoTime($detailBooking[0]->schedule_enddate, false) }}
                            &nbsp;&nbsp;ตั้งแต่เวลา&nbsp;{{ Str::limit($detailBooking[0]->booking_time_start, 5, '') }}
                            น. &nbsp; ถึงเวลา
                            {{ Str::limit($detailBooking[0]->booking_time_finish, 5, '') }} น.
                            โดยมีจำนวนผู้เข้าร่วม &nbsp;&nbsp;&nbsp; {{ $detailBooking[0]->booking_ofPeople }}
                            &nbsp;&nbsp;&nbsp; คน &nbsp;&nbsp;&nbsp;
                            ประเภทผู้ใช้งาน
                            @if ($detailBooking[0]->booking_type == 'general')
                                บุคคลภายนอก
                            @else
                                บุคคลภายใน
                            @endif

                        </div>

                        <div> รายละเอียดการขอใช้เพิ่มเติม &nbsp;&nbsp; {{ $detailBooking[0]->description }}</div>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">โดยมีเจ้าหน้าที่ผู้เกี่ยวข้องและปฏิบัติงาน ดังนี้.</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div style="padding-left: 10px;text-align: left;">
                            <table>
                                <tbody class="listEmp table table-sm">
                                    @foreach ($ListEmployee as $rowEmp)
                                        <tr>

                                            <td>
                                                @if ($rowEmp->typeposition_id == 1)
                                                    {{ $prename = $rowEmp->position_work }}
                                                @else
                                                    {{ $prename = $rowEmp->prename_TH }}
                                                @endif
                                                @if (!empty($rowEmp->firstname_TH))
                                                    {{ $rowEmp->firstname_TH . ' ' . $rowEmp->lastname_TH }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($rowEmp->dep_name))
                                                    {{ $rowEmp->dep_name }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

                <tr align="left">
                    <td colspan="2">ผลการพิจารณา</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div> <input type="checkbox" @if ($detailBooking[0]->booking_AdminAction == 'approved' || $detailBooking[0]->booking_status) checked @endif class="fs-5">
                            อนุญาต</div>
                        <div> <input type="checkbox" @if ($detailBooking[0]->booking_AdminAction == 'canceled' || $detailBooking[0]->dean_appove_status == 2) checked @endif class="fs-5">
                            ไม่อนุัมติ </div>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="2" align="center">

                        <br />
                        <div style="text-align: center;">
                            ลงชื่อ ........................................ผู้อนุญาติ <br />
                            (................................................)

                        </div>
                    </td>
                </tr>-->
            </table>


        </div>
    </page>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
</body>

</html>
