@extends('admin.main-layout')
@section('content-header')
    <!-- /.content-header -->
@endsection
@section('body')
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
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid ">
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
                aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> <i class="bi bi-plus-circle-fill"></i> เพิ่มข้อมูลใหม่ </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="tr ue">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body  bg-light">
                            <form action="#" id="add_ROOMS_form" enctype="multipart/form-data"
                                class="row g-3 w-100 m-auto">
                                @csrf
                                <div class="col-6 my-2">
                                    <label for="roomTypeId" class="form-label">ประเภทห้อง</label>
                                    <select id="roomTypeId" class="form-control" name="roomTypeId">
                                        <option value="0">--- เลือก --- </option>
                                        <!-- ต่อฐานข้อมูล  -->
                                        @foreach ($getroomType as $item)
                                            <option value='{{ $item->id }}'>{{ $item->roomtypeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 my-2">
                                    <label for="placeId" class="form-label">สถานที่/อาคาร </label>
                                    <select id="placeId" class="form-control" name="placeId">
                                        <option value="0">--- เลือก --- </option>
                                        <!-- ต่อฐานข้อมูล  -->
                                        @foreach ($getroomPlace as $item)
                                            <option value='{{ $item->id }}'>{{ $item->placeName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="roomFullName" class="form-label">ชื่อห้อง</label>
                                    <input type="text" class="form-control" id="roomFullName" name="roomFullName"
                                        required placeholder=" ระบุชื่อห้อง | ห้องประชุม 3 ชั้น 7 " />
                                </div>

                                <div class="col-md-3">
                                    <label for="roomSize" class="form-label">ขนาดห้อง</label>
                                    <input type="text" class="form-control" id="roomSize" name="roomSize"
                                        placeholder=" 20 ที่นั่ง " />
                                </div>

                                <div class="col-md-3">
                                    <label for="room_wh" class="form-label">ขนาดห้อง(ตรม.)</label>
                                    <input type="text" class="form-control" id="room_wh" name="room_wh"
                                        placeholder=" กว้าง*ยาว" />
                                </div>
                                <div class="col-12">
                                    <label for="roomDetail" class="form-label">รายละเอียด/หมายเหตุ </label>
                                    <textarea class="form-control" placeholder="ระบุรายละเอียด ของห้อง " id="roomDetail" name="roomDetail"></textarea>
                                </div>

                                <div class="col-6 mt-2">
                                    <strong>อุุปกรณ์เสริมภายในห้อง</strong>
                                    <hr />
                                    <div class="col-12 mt-2">
                                        @foreach ($roomItemList as $item)
                                            <div class="col-md-6 mt-2">
                                                <input class="form-check-input room_itemlist" type="checkbox"
                                                    id="roomItem{{ $item->id }}" value="{{ $item->id }}"
                                                    name="room_itemlist[]">
                                                <label class="form-check-label"
                                                    for="roomItem{{ $item->id }}">{{ $item->item_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="avatar" class="form-label">รูปตัวอย่างห้อง</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                        <label class="custom-file-label" for="avatar">Choose file</label>
                                    </div>
                                </div>

                                <div class="col-12 modal-footer my-2">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" id="add_rooms_btn" class="btn btn-primary"> เพิ่มข้อมูล
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



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
                            <form action="/admin/room/update" method="POST" id="edit_form"
                                enctype="multipart/form-data" class="row g-3 w-100 m-auto">

                                @csrf
                                <input type="hidden" name="room_id" id="Edit_id">
                                <input type="hidden" name="Edit_thumbnail" id="Edit_thumbnail">
                                <input type="hidden" name="Edit_roomTitle" id="Edit_roomTitle">
                                <div class="row col-12 ">
                                    <div class="col-12 mt-2">
                                        <b>สถานะห้อง ( ปิดให้บริการ | เปิดบริการ)</b>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="flexSwitchCheckChecked" name="is_open">
                                            <label class="custom-control-label" for="flexSwitchCheckChecked"
                                                id="labelONOFF">( ปิดให้บริการ | เปิดบริการ)</label>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="roomTypeId" class="form-label">ประเภทห้อง</label>
                                        <select id="Edit_roomTypeId" class="form-control" name="roomTypeId">
                                            <option value="0">--- เลือก --- </option>
                                            <!-- ต่อฐานข้อมูล  -->
                                            @foreach ($getroomType as $item)
                                                <option value='{{ $item->id }}'>{{ $item->roomtypeName }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label for="placeId" class="form-label">สถานที่/อาคาร </label>
                                        <select id="Edit_placeId" class="form-control" name="placeId">
                                            <option value="0">--- เลือก --- </option>
                                            <!-- ต่อฐานข้อมูล  -->
                                            @foreach ($getroomPlace as $item)
                                                <option value='{{ $item->id }}'>{{ $item->placeName }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="roomFullName" class="form-label">ชื่อห้อง</label>
                                        <input type="text" class="form-control" id="Edit_roomFullName"
                                            name="roomFullName" required
                                            placeholder=" ระบุชื่อห้อง | ห้องประชุม 3 ชั้น 7 " />
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="roomSize" class="form-label">จำนวนที่นั่ง</label>
                                        <input type="text" class="form-control" id="Edit_roomSize" name="roomSize"
                                            placeholder=" 20 ที่นั่ง " />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="room_wh" class="form-label">ขนาดห้อง(ตรม.)</label>
                                        <input type="text" class="form-control" id="Edit_room_wh" name="room_wh"
                                            placeholder=" กว้าง*ยาว" />
                                    </div>
                                    <div class="col-12">
                                        <label for="roomDetail" class="form-label"> รายละเอียด/หมายเหตุ </label>
                                        <textarea class="form-control" placeholder="ระบุรายละเอียด ของห้อง " id="Edit_roomDetail" name="roomDetail"></textarea>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <strong>อุุปกรณ์เสริมภายในห้อง</strong>
                                        <hr />
                                        <div class="col-12 mt-2">
                                            @foreach ($roomItemList as $item)
                                                <div class="col-md-6 mt-2">
                                                    <input class="form-check-input room_itemlist" type="checkbox"
                                                        id="EditroomItem{{ $item->id }}" value="{{ $item->id }}"
                                                        name="room_itemlist[]">
                                                    <label class="form-check-label"
                                                        for="EditroomItem{{ $item->id }}">{{ $item->item_name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <div class="mt-2">
                                            <label for="avatar" class="form-label">ตัวอย่างห้อง</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="avatar"
                                                    name="avatar">
                                                <label class="custom-file-label" for="avatar">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="mt-2" id="Display_avatar">

                                        </div>
                                    </div>
                                </div>

                                <div class=" col-12 justify-content-center text-center">
                                    <hr />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" id="edit_btn" class="btn btn-success">แก้ไขข้อมูล</button>
                                </div>
                                <br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- edit modal end --}}


            <div class="row ">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                            <h4 class="text-light">ระบบจัดการข้อมูลห้อง</h4>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal"
                                data-toggle="modal" data-target="#addModal"><i
                                    class="bi-plus-circle me-2"></i>เพิ่มข้อมูลห้อง</button>
                        </div>
                        <div class="card-body" id="show_all">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

@section('corescript')
    <script>
        //Add Data เพิ่มข้อมูลใหม่
        $(function() {
            // add new  ajax request
            $("#add_ROOMS_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                // console.log(fd);
                $("#add_rooms_btn").text('Adding...');
                $.ajax({
                    url: "/admin/room/store",
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Rooms Added Successfully!',
                                'success'
                            )
                            fetchAll();
                        }
                        $("#add_rooms_btn").text('เพิ่มข้อมูลห้อง');
                        $("#add_ROOMS_form")[0].reset();
                        $("#addModal").modal('hide');
                    }
                });
            });


            // if click edit  /  ajax request
            $(document).on('click', '.editIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: "/admin/room/edit",
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {

                        var obj = JSON.parse(response.dataRoom);
                        var isThumbnail = "";
                        var isRoomOpen = '0'
                        ISroomTypeId = "";
                        ISplaceId = "";
                        arr = $.parseJSON(response.dataRoom);
                        console.log(arr);
                        $.each(arr, function(key, value) {
                            //รูป
                            if (key == 'thumbnail') {
                                isThumbnail = value;
                            } //สถานะเปิดปิด
                            else if (key == 'is_open') {
                                isRoomOpen = value;
                            }
                            //ประเภทห้อง
                            else if (key == 'roomTypeId') {
                                ISroomTypeId = value;
                            }
                            //  สถานที
                            else if (key == 'placeId') {
                                ISplaceId = value;
                            } else if (key == 'room_itemlist') {
                                $('input[type="checkbox"].room_itemlist').prop(
                                    'checked', false);
                                if ($.trim(value) !== "") {
                                    var selectedValues = value.split(
                                        ','); // ["1", "2", "3"]
                                    // ใช้ $.each() เพื่อวนลูปผ่านอาร์เรย์และตั้งค่า checkbox ที่มีค่าในอาร์เรย์นั้น
                                    $.each(selectedValues, function(index, vals) {
                                        $('input[name="room_itemlist[]"][value="' +
                                            vals + '"]').prop('checked',
                                            true);
                                    });
                                }

                            } else {
                                $InputID = '#Edit_' + key;
                                $($InputID).val(value);
                            }



                        });


                        //ประเภทห้อง            
                        $('#Edit_roomTypeId option[value=' + ISroomTypeId + ']').prop(
                            'selected', true);
                        //  สถานที                    
                        $('#Edit_placeId option[value=' + ISplaceId + ']').prop('selected',
                            true);
                        //รูป
                        $('#Edit_thumbnail').val(isThumbnail);

                        // สถานะเปิดปิด
                        console.log('isRoomOpen=>' + isRoomOpen);
                        if (isRoomOpen) {
                            $('#flexSwitchCheckChecked').attr('checked', true);
                            $('#labelONOFF').html(' เปิดให้บริการ');
                        } else {
                            $('#flexSwitchCheckChecked').attr('checked', false);
                            $('#labelONOFF').html(' ปิดให้บริการ');
                        }
                        //flexSwitchCheckChecked
                        // $("#is_open").val(response.is_open);
                        $("#Display_avatar").html('<img src="/storage/images/' + isThumbnail +
                            '" height="90" class="img-fluid img-thumbnail">');


                        $('#editModal').modal("show");

                    }
                });
            });

            // Form update  ajax request
            $("#edit_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_btn").text('Updating...');
                $.ajax({
                    url: "/admin/room/update",
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
                                'Updated!',
                                'Employee Updated Successfully!',
                                'success'
                            )
                            fetchAll();
                        }
                        $("#edit_btn").text(' แก้ไขข้อมูล ');
                        $("#edit_form")[0].reset();
                        $("#editModal").modal('hide');
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
                            url: "/admin/room/delete",
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                fetchAll();
                            }
                        });
                    }
                })
            });

            // ดึงข้อมูลมามาแสดงในตาราง ทั้งหมดและ ใช้ Datable   
            fetchAll();

            function fetchAll() {
                $.ajax({
                    url: "/admin/room/fetchall",
                    method: 'get',
                    success: function(response) {
                        $("#show_all").html(response);
                        $("#tableListRoomALl").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }



        });
    </script>

    <script type="text/javascript" src="/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/slccombobox.js"></script>
@endsection
