<!-- import  function service -->
@inject('getService', 'App\class\HelperService')
@extends('admin.main-layout')
<link href="/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="/css/combobox.css" rel="stylesheet">
@section('content-header')
<style type="text/css">
    .tdTitle {
        text-align: right;
        font-weight: 700;
        width: 20%;
    }

    .tddetail {
        width: 30%;
        text-align: left;
    }

    .countText {
        text-decoration-line: underline;
        cursor: pointer;
    }

    .tableListbooking {
        font-size: 12px;
    }

    .custom-combobox {
        position: relative;
        display: inline-block;

    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox-input {
        margin: 0;
        padding: 5px 10px;
    }

    .custom-combobox {
        position: relative;
        display: inline-block;

    }

    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 2;
        background-color: aliceblue;

    }

    .custom-combobox-input {
        margin: 0;
        padding: 6px 10px;
        min-width: 350px;
        max-width: 95%;
        border: 1px solid #989595;
    }
</style>
<!-- /.content-header -->
@endsection
@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <h5 class="card-header mRoomtitle">รายชื่อผู้ดูแลประจำห้อง : {{$ListAdmin[0]->roomFullName}}</h5>
            <div class="card-body">
                <input type="hidden" id="hinden_roomID" value="{{$ListAdmin[0]->roomID}}">

                <div class="row  mb-2 p-3 justify-content-center">
                    <div class="col-4 ">
                        <label for="Edit_adminfullname1" class="form-label"> ระบุ ชื่อ นามสกุล ผู้ดูแลประจำห้อง
                        </label>
                        <select class="slcCombobox" name="assigncmuitaccount" id="assigncmuitaccount"
                            style="width: 300px;overflow: hidden;">
                            <option value="">--- เลือก --</option>
                            @foreach ($sclEmployee as $rows)
                                @if (!empty($rows->firstname_TH))
                                    {{ $fullname = $rows->firstname_TH . ' ' . $rows->lastname_TH}}
                                @endif
                                <option value="{{$rows->cmuitaccount}}">{{$fullname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 ml-2">
                        <label for="Edit_adminPhone1" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="adminPhone" name="adminPhone" required
                            placeholder=" เบอร์โทรติดต่อ " />
                    </div>

                    <div class="col-3 mt-2">
                        <br />
                        <button class="btn btn-light btnAddAdmin"> <i class="bi bi-plus-circle-fill h4"></i>
                        </button>
                    </div>

                </div>
                <div class="mt-3 col-md-12 ">
                    <hr />
                    <table id="tableList" class="table table-sm">
                        <thead>
                            <tr align="center" class="text-center">
                                <th align="center" class="text-center" style="width: 80px;">#</th>
                                <th align="center" class="text-center" style="width: 40%;">ชื่อผู้ดูแล</th>
                                <th align="center" class="text-center">เบอร์โทร</th>
                                <th align="center" class="text-center">สังกัด/หน่วยงาน</th>
                                <th align="center" class="text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="Trresponse">
                            <tr>
                                <td> &nbsp; </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('corescript')
<script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/slccombobox.js"></script>
<script>
    $(function () {
        $("#tableList").DataTable({
            order: [0, 'desc']
        });
        // Add Admin 
        $(document).on('click', '.btnAddAdmin', function (e) {
            $.ajax({
                url: "/admin/room/AddAdminRoom",
                method: 'get',
                data: {
                    cmuitaccount: $("#assigncmuitaccount").val(),
                    roomID: $("#hinden_roomID").val(),
                    phone: $("#adminPhone").val(),
                    _token: '{{ csrf_token() }}'
                }, success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Successfully !',
                            text: ' เพิ่มผู้ดูแลเรียบร้อยแล้ว ',
                            icon: 'success'
                        }).then((result) => {
                            getAdminRoom();
                        });
                    }

                }
            });
        });

        // if click edit  /  ajax request
        $(document).on('click', '.editAdminIcon', function (e) {
            e.preventDefault();
            let id = $(this).attr('id');
            console.log('roomID=>' + id);
            $.ajax({
                url: "{{ url('/admin/room/editAdmin') }}",
                method: 'get',
                data: {
                    roomid: id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    var tr = "<tr>";
                    var prename = "";
                    var l = 0;
                    var roomTitle = "";
                    $.each(response.ListAdmin, function (i, element) {
                        l++;
                        prename = (element.typeposition_id == 1) ? element.position_work : element.prename_TH
                        tr += "<td>" + l + "</td>";
                        tr += "<td>" + prename + ' ' + element.firstname_TH + ' ' + element.lastname_TH + "</td>";
                        tr += "<td>" + element.phone + "</td>";
                        tr += "<td>" + element.dep_name + "</td>";
                        tr += '<td align="center" class="text-center">';
                        tr += '<a href="#" id="' + element.id + '" class="text-success mx-1 editAdmin"><i class="bi-pencil-square h5"></i></a>';
                        tr += '<a href="#" id="' + element.id + '"  class="text-danger mx-1 deleteAdmin"><i class="bi-trash h5"></i></a></td>';
                        tr += "</tr>";
                        roomTitle = element.roomFullName;
                    });
                    $('.mRoomtitle').html('ผู้ดูแลประจำห้อง' + roomTitle);
                    $('#hinden_roomID').val(id);
                    $('.Trresponse').html(tr);
                }
            });
            $('#editAdminRoomModal').modal("show");
        });

        
         // Delete  ajax request
         $(document).on('click', '.deleteAdmin', function (e) {
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
                confirmButtonText: 'ยืนยัน, ลบข้อมูลนี้ !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/room/delete/admin",
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result) => {
                                getAdminRoom() 
                            });
                        }
                    });
                }
            })
        });

        function getAdminRoom() {

            var roomId = $('#hinden_roomID').val();
            $.ajax({
                url: "/admin/room/fetchAdmin",
                method: 'get',
                data: {
                    roomID: roomId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    var tr = "<tr>";
                    var prename = "";
                    var l = 0;
                    $.each(response.ListAdmin, function (i, element) {
                        l++;
                        prename = (element.typeposition_id == 1) ? element.position_work : element.prename_TH
                        tr += "<td>" + l + "</td>";
                        tr += "<td>" + prename + ' ' + element.firstname_TH + ' ' + element.lastname_TH + "</td>";
                        tr += "<td>" + element.phone + "</td>";
                        tr += "<td>" + element.dep_name + "</td>";
                        tr += '<td>';
                        tr += '<a href="#" id="' + element.id + '" class="text-success mx-1 editAdmin"><i class="bi-pencil-square h5"></i></a>';
                        tr += '<a href="#" id="' + element.id + '"  class="text-danger mx-1 deleteAdmin"><i class="bi-trash h5"></i></a></td>';
                        tr += "</tr>";
                    });
                    $('.Trresponse').html(tr);
                }
            });
        }
        getAdminRoom();
    });
</script>
@endsection