<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
@section('content-header')

@endsection
@section('body')


<div class="row">
    <div class="container-fluid">
        <!-- <div class="d-sm-flex align-items-end justify-content-end mb-4">
            <button href="/admin/term/add/" class="btn  btn-primary"
                data-bs-toggle="modal" data-bs-target="#addModal"
                data-toggle="modal" data-target="#addModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg> เพิ่มรายการใหม่
            </button>
        </div> -->
        <div class="card  mt-3">
            <div class="card-header">
                <h4> <a href="#">
                        <i class="bi bi-tags"></i>
                        ผู้ใช้ในกลุ่มกระบวนวิชา 
                    </a></h4>
            </div>
            <div class="card-body  disPlayTable">
                <table class="table table-sm mt-2" @if (count($courseGroups)> 0) id="tableList" @endif>
                    <thead class="table-secondary ">
                        <tr style="text-align: left;">
                            <th  style="text-align: left;">ปรับปรุง </th>
                            <th>กลุ่มกระบวนวิชา </th>
                           
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($courseGroups) > 0)
                        @foreach ($courseGroups as $rows)
                        <tr style="text-align: left;">
                            <td  style="text-align: left;">{{$rows->updated_at}} </td>
                            <td>{{$rows->group_title}}</td>                           
                            <td>
                        
                                <a href="/admin/groupCourse/assign/{{$rows->id}}/{{$rows->group_title}}" class="text-success mx-1 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                    </svg>
                                </a>
                           
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
        $("#tableList").DataTable({
            order: [0, 'desc']
        });
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