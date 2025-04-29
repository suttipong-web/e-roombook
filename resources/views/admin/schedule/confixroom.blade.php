<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')
    <style type="text/css">
        .displayTable {
            font-size: 13px
        }

        .allform {
            font-size: 14px;
        }
    </style>
@endsection
@section('body')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ระบบจัดการใช้ห้อง</h1>
</div>
@isset($updated)
    @if ($updated)
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> บันทึกข้อมูลเรียบร้อยแล้ว
        </div>

    @endif
@endisset
<div class="card">
    <h5 class="card-header">กำหนดวันเวลาเปิดปิดห้อง </h5>
    <div class="card-body">
        <div class="col-md-12  ">
            <form id="editform" enctype="multipart/form-data" action="/admin/schedules/configroom/edit" method="POST"
                class="allform">
                @csrf
                <input type="hidden" name="id" id="Edit_id" value="{{$dataConfig->id}}">
                <table class="table table-borderless">
                    <tr>
                        <td colspan="2"> <b> ตั้งค่าการเปิดปิดระบบจองห้อง </b>
                            <hr />
                        </td>
                    </tr>
                    <tr>
                        <td>ช่วงเปิด-ปิดการจองห้อง</td>
                        <td>
                            <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_start_date" name="datestart"
                                data-date-format="yyyy-mm-dd" value="{{$dataConfig->datestart}}">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            ถึง &nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_end_date" name="endstart" data-date-format="yyyy-mm-dd"
                                value="{{$dataConfig->endstart}}">
                        </td>
                    </tr>
                    <tr>
                        <td>เปิด/ปิด การจองห้องประเภท </td>
                        <td>
                            @php
                                $selectedRoomTypes = explode(',', $dataConfig->chkroom);
                            @endphp
                            <!---$dataConfig->chkroom  --->
                            @foreach ($roomType as $listroomType)
                            <input type="checkbox" name="chkroom[]" id="Edit{{$listroomType->id}}" class="chkroomtype"
                                value="{{$listroomType->id}}" {{ in_array($listroomType->id, $selectedRoomTypes) ?
                            'checked' : '' }}>
                            <label for="Edit{{$listroomType->id}}">{{$listroomType->roomtypeName}} &nbsp;&nbsp;</label>
                            @endforeach
                            <div>หมายเหตุ: หากไม่ถูกเลือก หมายความว่าไม่เปิดให้ประเภทห้องนี้จองได้ </div>
                        </td>
                    </tr>

                    <tr>
                        <br />
                        <td colspan="2" align="center">
                            <button type="submit" class="btn btn-primary "> แก้ไขข้อมูล </button>

                        </td>
                    </tr>
                </table>
            </form>



        </div>
    </div>
</div>





@endsection
@section('corescript')

@endsection