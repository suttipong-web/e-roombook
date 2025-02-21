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
    <div class="d-sm-flex align-items-end justify-content-between mb-4">
            <a href="/admin/term/add/"> เพิ่มรายการใหม่ </a>
    </div>
        <div class="card  mt-3">
            <div class="card-header">
                <h4> <a href="#">
                        <i class="bi bi-tags"></i>
                        กำหนดการลงตารางเรียน
                    </a></h4>
            </div>
            <div class="card-body  disPlayTable">
                <table class="table table-sm mt-2" @if (count($listAllTerms)> 0) id="tableList" @endif>
                    <thead class="table-secondary ">
                        <tr style="text-align: left;">
                            <th>ปรับปรุง</th>
                            <th>ภาคการศึกษา</th>
                            <th>ช่วงวันเปิด-ปิดภาคการศึกษา</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listAllTerms) > 0)
                        @foreach ($listAllTerms as $rows)
                        <tr style="text-align: left;">
                            <td>{{$rows->updated_at}}</td>
                            <td>{{$rows->title}}</td>
                            <td>{{$rows->start_date}} - {{$rows->end_date}}</td>
                            <td>
                                <a href="#" id="{{$rows->id}}" class="text-success mx-1 editIcon"
                                    data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi-pencil-square h5"></i></a>
                                <a href="#'{{$rows->id}}" class="text-success mx-1 "><i class="bi bi-person-fill-gear h5"></i></a>
                                <a href="#" id="{{$rows->id}}" class="text-danger mx-1 deleteIcon"><i class="bi-trash h5"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
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