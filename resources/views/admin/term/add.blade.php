<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')

@endsection
@section('body')

<!-- Page Heading 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> กำหนดการลงตารางเรียน

    </h1>
</div>-->
<!-- Main row -->
<div class="row">
    <div class="container-fluid">
        <div class="card  mt-3">
            <div class="card-header">
                <h4> <a href="#">
                        <i class="bi bi-tags"></i>
                        กำหนดการลงตารางเรียน
                    </a></h4>
            </div>
            <div class="card-body  disPlayTable">

                <table>
                    <tr>
                        <td>ภาคการศึกษา</td>
                        <td><input class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ช่วงเปิด-ปิดภาคการศึกษา</td>
                        <td><input class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ช่วงเปิด-ปิดภาคการศึกษา</td>
                        <td>
                            
                            <input class="form-control5 dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_schedule_startdate" name="schedule_startdate"
                                data-date-format="yyyy-mm-dd" required>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                           กึง
                            <input class="form-control5 dateScl" type="text" data-provide="datepicker"
                                data-date-language="th" id="Edit_schedule_enddate" name="schedule_enddate"
                                data-date-format="yyyy-mm-dd" required>


                        </td>
                    </tr>



                </table>



            </div>
        </div>
    </div>
</div>

@endsection
@section('corescript')

<script>
    $(function() {

    });
</script>