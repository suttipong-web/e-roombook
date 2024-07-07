<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')

@endsection
@section('body')


<div class="card">
    <h5 class="card-header">รายงานระบบจองห้อง</h5>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"> <a href="{{ url('/admin/report/bookinglist') }}">รายงานการขอใช้ห้อง</a></li>
            <li class="list-group-item"><a href="{{ url('/admin/report/bookingtable') }}">รายงานการตารางการใช้ห้อง</a></li>
           <!-- <li class="list-group-item"><a href="{{ url('/admin/report/stat') }}">รายงานสถิติการใช้งาน</a></li>-->
        </ul>
    </div>
</div>



@endsection
@section('corescript')

<script>
    $(function () {

    });

</script>