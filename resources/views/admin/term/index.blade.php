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
        <div class="d-sm-flex align-items-end justify-content-end mb-4">
            <button href="/admin/term/add/" class="btn  btn-primary"
                data-bs-toggle="modal" data-bs-target="#addModal"
                data-toggle="modal" data-target="#addModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg> เพิ่มรายการใหม่
            </button>
        </div>
        <div class="card  mt-3">
            <div class="card-header">
                <h4> <a href="#">
                        <i class="bi bi-tags"></i>
                        กำหนดการลงตารางใช้ห้อง
                    </a></h4>
            </div>
            <div class="card-body  disPlayTable">
                <table class="table table-sm mt-2" @if (count($listAllTerms)> 0) id="tableList" @endif>
                    <thead class="table-secondary ">
                        <tr style="text-align: left;">
                            <th  style="text-align: left;">ปรับปรุง </th>
                            <th>รายการ </th>
                            <th>ช่วงวันใช้ห้อง/เปิดปิดการจอง</th>
                            <th>จัดการ </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listAllTerms) > 0)
                        @foreach ($listAllTerms as $rows)
                        <tr style="text-align: left;">
                            <td style="text-align: left;">{{$rows->updated_at}}</td>
                            <td>{{$rows->title}}</td>
                            <td>{{$rows->start_date}} - {{$rows->end_date}}</td>
                            <td>
                                <a href="#" id="{{$rows->id}}" class="text-success mx-1 editIcon"
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="bi bi-pencil-square h5"></i>
                                </a>
                             
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

<!-- Edit -->
{{-- edit modal start --}}
<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  bg-light ">
                <form id="edit_form" enctype="multipart/form-data" action="#">
                    @csrf
                    <input type="hidden" name="id" id="Edit_id">
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="2"> <b> กำหนดการลงตารางใช้ห้อง </b>
                                <hr />
                            </td>
                        </tr>
                        <tr>
                            <td>รายการ</td>
                            <td><input class="form-control3" required name="title" id="Edit_title"></td>
                        </tr>
                        <tr>
                            <td>ช่วงวันใช้ห้อง/เปิดปิดการจอง</td>
                            <td>
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_start_date" name="start_date"
                                    data-date-format="yyyy-mm-dd" required>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                ถึง &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_end_date" name="end_date"
                                    data-date-format="yyyy-mm-dd" required>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <b> ช่วงวันที่ลงตารางการใช้ห้อง </b>
                                <hr />
                            </td>
                        </tr>
                        @foreach ($courseGroups as $row)
                        <tr>
                            <td>{{$row->group_title}}</td>
                            <td> <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_group{{$row->id}}_start"
                                    name="group{{$row->id}}_start"
                                    data-date-format="yyyy-mm-dd" required
                                    placeholder="วันที่เริ่มต้น">
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                ถึง &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_group{{$row->id}}_end" name="group{{$row->id}}_end"
                                    data-date-format="yyyy-mm-dd" required
                                    placeholder="วันที่สิ้นสุด">
                            </td>

                        </tr>
                        @endforeach

                        <tr>
                            <br />
                            <td colspan="2" align="center">
                                <button type="submit" class="btn btn-primary " id="btnEdit_form"> แก้ไขข้อมูล </button>
                                <a href="/admin/term" class="btn btn-dark"> ยกเลิก </button>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- END Edit -->

<!--Add data  -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="bi bi-plus-circle-fill"></i> เพิ่มข้อมูลกำหนดการลงตารางเรียน </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="tr ue">&times;</span>
                </button>
            </div>
            <div class="modal-body  bg-light">
                <form id="add_form" enctype="multipart/form-data" action="#">
                    @csrf
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="2"> <b> รายละเอียดกำหนดการ </b>
                                <hr />
                            </td>
                        </tr>
                        <tr>
                            <td>ภาคการศึกษา</td>
                            <td><input class="form-control3" required name="title"></td>
                        </tr>
                        <tr>
                            <td>ช่วงเปิด-ปิดภาคการศึกษา</td>
                            <td>
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" name="start_date"
                                    data-date-format="yyyy-mm-dd" required>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                ถึง &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" name="end_date"
                                    data-date-format="yyyy-mm-dd" required>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <b> ช่วงวันที่ลงตารางสอน </b>
                                <hr />
                            </td>
                        </tr>
                        @foreach ($courseGroups as $row)
                        <tr>
                            <td align="left">{{$row->group_title}}</td>
                            <td> <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_schedule_startdate" name="group{{$row->id}}_start"
                                    data-date-format="yyyy-mm-dd" required
                                    placeholder="วันที่เริ่มต้น">
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                ถึง &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="form-control3 dateScl" type="text" data-provide="datepicker"
                                    data-date-language="th" id="Edit_schedule_enddate" name="group{{$row->id}}_end"
                                    data-date-format="yyyy-mm-dd" required
                                    placeholder="วันที่สิ้นสุด">
                            </td>

                        </tr>
                        @endforeach

                        <tr>
                            <br />
                            <td colspan="2" align="center">
                                <button type="submit" class="btn btn-primary " id="btnadd_form"> บันทึก </button>
                                <a href="/admin/term" class="btn btn-dark"> ยกเลิก </button>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</div>
<!--END Add data Modal  -->

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