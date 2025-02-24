<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')
<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="/css/combobox.css" rel="stylesheet">
@endsection
@section('body')


<div class="row">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-end justify-content-start mb-4">
            <h4> <a href="/admin/groupCourse">กลุ่มกระบวนวิชา </a>/
                {{$courseGroups[0]->group_title}}

            </h4>
        </div>
        <div class="card  mt-3">
            <div class="card-header">
                <h5>
                    <i class="bi bi-tags"></i>
                    ผู้ใช้ในกลุ่มกระบวนวิชา : {{$courseGroups[0]->group_title}}
                </h5>
            </div>
            <div class="card-body  disPlayTable">

                <input type="hidden" id="hinden_CID" value="{{$courseGroups[0]->id}}">
                <div class="mb-2">
                    <div class="row text-center justify-content-center">
                        <table>
                            <tr>
                                <td  style="width: 420px;font-weight: 600;"> ระบุชื่อ  : <select class="slcCombobox" name="assigncmuitaccount" id="assigncmuitaccount"
                                        style="width: 290px;overflow: hidden;">
                                        <option value="">--- เลือก --</option>
                                        @foreach ($sclEmployee as $rows)
                                        @if (!empty($rows->firstname_TH))
                                        {{ $fullname = $rows->firstname_TH . ' ' . $rows->lastname_TH}}
                                        @endif
                                        <option value="{{$rows->email}}">{{$fullname}}</option>
                                        @endforeach
                                    </select></td>
                                <td> <button class="btn btn-light btnAddAdmin"> <i class="bi bi-plus-circle-fill h4"></i> เพิ่ม</td>
                            </tr>
                        </table>
                    </div>
                </div>
           
            <hr />
            <br />
            <table class="table table-sm mt-2" @if (count($ListAdmin)> 0) id="tableList" @endif>
                <thead class="table-secondary ">
                    <tr style="text-align: left;">
                        <th  style="text-align: left;"> ปรับปรุง </th>
                        <th>ชื่อ - นามสกุล </th>
                        <th>หน่วยงาน </th>
                        <th>Email </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($ListAdmin) > 0)
                    @foreach ($ListAdmin as $rows)
                    <tr style="text-align: left;">
                        <td  style="text-align: left;"> {{$rows->updated_at}} </td>
                        <td>{{$rows->prename_TH}} {{$rows->firstname_TH}} {{$rows->lastname_TH}}</td>
                        <td>{{$rows->dep_title}}</td>
                        <td>{{$rows->cmuitaccount}}</td>
                        <td> <a href="#" id="{{$rows->id}}" class="text-danger mx-1 deleteIcon"><i class="bi-trash h5"></i></a></td>
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
        
        $("#tableList").DataTable({
            order: [0, 'desc']
        });
         // Add Admin 
         $(document).on('click', '.btnAddAdmin', function (e) {
            $.ajax({
                url: "/admin/groupCourse/AddAdmin",
                method: 'post',
                data: {
                    cmuitaccount: $("#assigncmuitaccount").val(),
                    courseId: $("#hinden_CID").val(),             
                    _token: '{{ csrf_token() }}'
                }, success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire({
                            title: ' Successfully !',
                            text: ' เพิ่มผู้ดูแลเรียบร้อยแล้ว ',
                            icon: 'success'
                        }).then((result) => {
                            //  getAdminRoom();
                            window.location.reload(true);     
                        });
                    }

                }
            });
        });

          // Delete  ajax request
          $(document).on('click', '.deleteIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'ต้องการลบข้อมูลใช่หรือไม่ ?',
                text: "การลบข้อมูลจะมีผลทันที และไม่สามารถย้อนกลับได้ !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน, ลบข้อมูลนี้!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/groupCourse/delete",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function (response) {                           
                            Swal.fire(
                                'Deleted!',
                                'ทำการลบข้อมูลเรียบร้อยแล้ว.',
                                'success'
                            ).then((result) => {
                                window.location.reload(true);   
                            });
                        }
                    });
                }
            })
        });

    });
</script>
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/slccombobox.js"></script>
@endsection