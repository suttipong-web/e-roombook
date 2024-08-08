@extends('admin.main-layout')
@section('content-header')

<!-- /.content-header -->
@endsection
@section('body')
<!-- Main row -->
<div class="row">
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">จัดการผู้ใช้งาน</h5>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-sm ">
                        <thead>
                            <tr>
                                <th>ปรับปรุง</th>
                                <th>ชื่อ นามสกุล</th>
                                <th>หน่วยงาน</th>
                                <th>Email</th>
                                <th>ประเภทผู้ใช้งาน </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ListUser)
                                                    @foreach ($ListUser as $rows)           
                                                                            <?php  
                                                                               $prname = ($rows->typeposition_id == 1) ? $rows->positionName : $rows->prename_TH;
                                                        $userFullname = $prname . " " . $rows->firstname_TH . " " . $rows->lastname_TH;
                                                                               ?>
                                                                            <tr>
                                                                                <td>{{ $rows->last_activity}}</td>
                                                                                <td>{{ $userFullname }}</td>
                                                                                <td>{{ $rows->dep_name}}</td>
                                                                                <td>{{ $rows->email}}</td>
                                                                                <td>{{ $rows->admin_type_detail}}</td>
                                                                                <td width="80">
                                                                                    <a href="/admin/user/viewprifile/{{$rows->id}}" id="{{$rows->id}}"
                                                                                        class="text-success mx-1 editIcon" data-bs-toggle="modal"
                                                                                        data-bs-target="#editModal">
                                                                                        <i class="bi-pencil-square h5"></i></a>

                                                                                    <a href="#" id="{{$rows->id}}" class="text-danger mx-1 deleteIcon"><i
                                                                                            class="bi-trash h5"></i></a>
                                                                                </td>

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
</div>
<!-- /.row (main row) -->

@endsection
@section('corescript')
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/slccombobox.js"></script>
<script>
</script>
@endsection