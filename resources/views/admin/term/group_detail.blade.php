<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')

@endsection
@section('body')


<div class="row">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-end justify-content-start mb-4">
       <h4> <a href="/admin/groupCourse">กลุ่มกระบวนวิชา </a>/ 
        {{$coursetitle}}
        </h4>
        </div>  
        <div class="card  mt-3">
            <div class="card-header">
                <h5> 
                        <i class="bi bi-tags"></i>
                        ผู้ใช้ในกลุ่มกระบวนวิชา  : {{$coursetitle}}
                    </h5>
            </div>
            <div class="card-body  disPlayTable">
                <table class="table table-sm mt-2" @if (count($ListAdmin)> 0) id="tableList" @endif>
                    <thead class="table-secondary ">
                        <tr style="text-align: left;">
                            <th>ปรับปรุง</th>
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
                            <td>{{$rows->updated_at}}</td>
                            <td>{{$rows->prename_TH}} {{$rows->firstname_TH}} {{$rows->lastname_TH}}</td>                           
                            <td>{{$rows->dep_title}}</td>
                            <td>{{$rows->email}}</td>
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
        // add new  ajax request
        $("#add_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            //  console.log(fd);
            $("#btnadd_form").text('Adding...');
            $.ajax({
                url: "/admin/term/saved",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire(
                            'Seved ',
                            'บันทึกข้อมูลสำเร็จ',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true); // รีโหลดหน้าเว็บเมื่อกด OK
                                $("#btnadd_form").text('บันทึกข้อมูล');

                            }
                        });
                    } else {

                        Swal.fire(
                            'Error !',
                            'ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบข้อมูลใหม่',
                            'error'
                        ).then((result) => {
                            $("#txtTitle").focus();
                            $("#btnadd_form").text('บันทึกข้อมูล');
                        });
                    }
                }
            });
        });

        // Form update  ajax request
        $("#edit_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#btnEdit_form").text('Updating...');
            $.ajax({
                url: "/admin/term/update",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire(
                            'Seved ',
                            'บันทึกข้อมูลสำเร็จ',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true); // รีโหลดหน้าเว็บเมื่อกด OK
                                $("#btnEdit_form").text('แก้ไขข้อมูล');
                                $("#editModal").modal('hide');
                            }
                        });
                    } else {
                        Swal.fire(
                            'Error !',
                            'ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบข้อมูลใหม่',
                            'error'
                        ).then((result) => {
                            $("#txtTitle").focus();
                            $("#btnEdit_form").text('แก้ไขข้อมูล');
                        });
                    }



                }
            });
        });







        // Delete  ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/term/delete",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            if (response.status == "deleted") {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    window.location.reload(true);
                                });

                            }
                        }
                    });
                }
            })
        });


        // if click edit  /  ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: "/admin/term/getDataedit",
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                   // console.log(response);
                    arr = $.parseJSON(response.dataTerm);
                    $.each(arr, function(key, value) {
                        $InputID = '#Edit_' + key;
                        $($InputID).val(value);
                    });
                    $('#editModal').modal("show");

                }
            });
        });


    });
</script>

@endsection