<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการข้อมูลห้อง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>



    <div class="container px-10">
        {{-- add new employee modal start --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> เพิ่มข้อมูลใหม่ </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-light">
                        <form action="#" id="add_ROOMS_form" enctype="multipart/form-data"
                            class="row g-3 w-90 m-10-auto">
                            @csrf
                            <div class="col-6 my-2">
                                <label for="roomTypeId" class="form-label">ประเภทห้อง</label>
                                <select id="roomTypeId" class="form-select" name="roomTypeId">
                                    <option value="0">--- เลือก --- </option>
                                    <!-- ต่อฐานข้อมูล  -->
                                    @foreach ($getroomType as $item)
                                        <option value='{{ $item->id }}'>{{ $item->roomtypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 my-2">
                                <label for="placeId" class="form-label">สถานที่/อาคาร </label>
                                <select id="placeId" class="form-select" name="placeId">
                                    <option value="0">--- เลือก --- </option>
                                    <!-- ต่อฐานข้อมูล  -->
                                    @foreach ($getroomPlace as $item)
                                        <option value='{{ $item->id }}'>{{ $item->placeName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="roomFullName" class="form-label">ชื่อห้อง</label>
                                <input type="text" class="form-control" id="roomFullName" name="roomFullName"
                                    required placeholder=" ระบุชื่อห้อง | ห้องประชุม 3 ชั้น 7 " />
                            </div>
                            <div class="col-md-6">
                                <label for="roomTitle" class="form-label">ชื่อย่อ</label>
                                <input type="text" class="form-control" id="roomTitle" name="roomTitle"
                                    placeholder="ห้อง วสท. (*ถ้ามี)" />
                            </div>
                            <div class="col-md-6">
                                <label for="roomSize" class="form-label">ขนาดห้อง</label>
                                <input type="text" class="form-control" id="roomSize" name="roomSize"
                                    placeholder=" 20 ที่นั่ง " />
                            </div>
                            <div class="col-12">
                                <label for="roomDetail" class="form-label">รายละเอียด/หมายเหตุ </label>
                                <textarea class="form-control" placeholder="ระบุรายละเอียด ของห้อง " id="roomDetail" name="roomDetail"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="avatar" class="form-label">ตัวอย่างห้อง</label>
                                <input type="file" id="avatar" name="avatar" class="form-control" />
                            </div>

                            <div class="modal-footer my-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="add_rooms_btn" class="btn btn-primary"> เพิ่มข้อมูล </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- add new  modal end --}}

        {{-- edit  modal start --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class=" container  ms-1 ">
                        <form action="#" method="POST" id="edit_form" enctype="multipart/form-data"
                            class="row g-3 w-90 m-2-auto">
                            @csrf
                            <input type="hidden" name="room_id" id="Edit_id">
                            <input type="hidden" name="Edit_thumbnail" id="Edit_thumbnail">
                            <div class="modal-body p-4 bg-light">
                                <div class="row ">
                                    <div class="col-12 mt-2 justify-content-md-end">
                                        <b>สถานะห้อง ( ปิดให้บริการ | เปิดบริการ)</b>
                                        <div class="form-check form-switch">

                                            <input class="form-check-input" type="checkbox" name="is_open"
                                                role="switch" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"
                                                id="labelONOFF">
                                            </label>

                                        </div>
                                        <hr />
                                    </div>
                                    <div class="col-6">
                                        <label for="roomTypeId" class="form-label">ประเภทห้อง</label>
                                        <select id="Edit_roomTypeId" class="form-select" name="roomTypeId">
                                            <option value="0">--- เลือก --- </option>
                                            <!-- ต่อฐานข้อมูล  -->
                                            @foreach ($getroomType as $item)
                                                <option value='{{ $item->id }}'>{{ $item->roomtypeName }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="placeId" class="form-label">สถานที่/อาคาร </label>
                                        <select id="Edit_placeId" class="form-select" name="placeId">
                                            <option value="0">--- เลือก --- </option>
                                            <!-- ต่อฐานข้อมูล  -->
                                            @foreach ($getroomPlace as $item)
                                                <option value='{{ $item->id }}'>{{ $item->placeName }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="roomFullName" class="form-label">ชื่อห้อง</label>
                                        <input type="text" class="form-control" id="Edit_roomFullName"
                                            name="roomFullName" required
                                            placeholder=" ระบุชื่อห้อง | ห้องประชุม 3 ชั้น 7 " />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="roomTitle" class="form-label">ชื่อย่อ</label>
                                        <input type="text" class="form-control" id="Edit_roomTitle"
                                            name="roomTitle" placeholder="ห้อง วสท. (*ถ้ามี)" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="roomSize" class="form-label">ขนาดห้อง</label>
                                        <input type="text" class="form-control" id="Edit_roomSize"
                                            name="roomSize" placeholder=" 20 ที่นั่ง " />
                                    </div>
                                    <div class="col-12">
                                        <label for="roomDetail" class="form-label">รายละเอียด/หมายเหตุ </label>
                                        <textarea class="form-control" placeholder="ระบุรายละเอียด ของห้อง " id="Edit_roomDetail" name="roomDetail"></textarea>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <div class="mt-2">
                                            <label for="avatar"> เลือกรูปตัวอย่างห้อง </label>
                                            <input type="file" name="avatar" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-6 mt-2">
                                        <div class="mt-2" id="Display_avatar">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" id="edit_btn" class="btn btn-success">แก้ไขข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- edit  modal end --}}

        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                            <h3 class="text-light">ระบบจัดการข้อมูลห้อง</h3>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addModal"><i
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>

    <script>
        //Add Data เพิ่มข้อมูลใหม่
        $(function() {
            // add new  ajax request
            $("#add_ROOMS_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                console.log(fd);
                $("#add_rooms_btn").text('Adding...');
                $.ajax({
                    url: "{{ url('/room/store') }}",
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
                    url: "{{ url('/room/edit') }}",
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
                            '" height="140" class="img-fluid img-thumbnail">');

                    }
                });
            });

            // Form update  ajax request
            $("#edit_form").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_btn").text('Updating...');
                $.ajax({
                    url: "{{ url('/room/update') }}",
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
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
                            url: "{{ url('/room/delete') }}",
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
                    url: "{{ url('/room/fetchall') }} ",
                    method: 'get',
                    success: function(response) {
                        $("#show_all").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }



        });
    </script>



</body>

</html>
