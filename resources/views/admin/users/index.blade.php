@extends('admin.main-layout')
@section('content-header')

    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">

           
            @if(request()->query('do') == 'success')
            <div class="alert alert-success text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg> บันทึกข้อมูลเรียบร้อยแล้ว
            </div>
            @endif

            <div class="card">
                <h5 class="card-header">จัดการผู้ใช้งาน</h5>
                <div class="card-body">

                    <div class="table-responsive-" >
                        <table class="table" id="tableList">
                            <thead>
                                <tr>
                                    <th>ปรับปรุงล่าสุด</th>
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
        $(function() {

            $("#tableList").DataTable({
                order: [0, 'DESC']
            });
        });
    </script>
@endsection