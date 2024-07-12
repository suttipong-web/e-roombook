<?php

namespace App\Http\Controllers;

use App\Models\room_gallery;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomsController extends Controller
{
    public function index()
    {
        //ประเภทห้อง 
        $roomType = DB::table('room_type')
            ->select('id', 'roomtypeName')
            ->get();
        // สถานที่     
        $roomPlace = DB::table('place')
            ->select('id', 'placeName')
            ->get();

        return view("/admin/room/index")->with([
            'getroomType' => $roomType,
            'getroomPlace' => $roomPlace
        ]);
    }
    // handle fetch all  ajax request
    public function fetchAll()
    {

        $rowsRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->get();

        $output = '';
        if ($rowsRoom->count() > 0) {
            $output .= '
            <div class="table-responsive">
        <table class="table table-striped table-sm text-left align-middle w-100" id="tableListRoomALl">
        <thead>
          <tr>
            <th>#</th>
            <th></th>
            <th>ห้อง</th>
              <th>ประเภท</th>
                <th>สถานที่ </th>
            <th>รายละอียด</th>
          
            <th>สถานะ</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
            foreach ($rowsRoom as $rows) {

                if (!empty($rows->thumbnail)) {
                    $img = '/storage/images/' . $rows->thumbnail;
                } else {
                    $img = '/storage/images/noinages.png';
                }


                $isOpen = ($rows->is_open) ? '<span class="badge text-bg-success  badge-success">เปิดปกติ</span>' : '<span class="badge text-bg-danger  badge-danger">ปิดการใช้</span>';
                $output .= '<tr class="text-start">
            <td>' . $rows->id . '</td>
            <td  class="text-left"><img src="' . $img . '"  class="img-thumbnail "  width="100" ></td>
            <td>' . $rows->roomFullName . '</td>
             <td>' . $rows->roomtypeName . '</td>
             <td>' . $rows->placeName . '</td>
            <td>' . $rows->roomDetail . '</td>
           
            <td>' . $isOpen . '</td>
            <td  width="80" >
              <a href="#" id="' . $rows->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi-pencil-square h4"></i></a>

              <a href="#" id="' . $rows->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
            </td>
          </tr>';
            }
            $output .= '</tbody></table></div>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function store(Request $request)
    {
        $fileName = "";
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        $roomToken = md5(time());
        $setData = [
            'roomToken' => $roomToken,
            'roomFullName' => $request->roomFullName,
            'roomTitle' => $request->roomTitle,
            'roomSize' => $request->roomSize,
            'roomTypeId' => $request->roomTypeId,
            'placeId' => $request->placeId,
            'roomDetail' => $request->roomDetail,
            'thumbnail' => $fileName
        ];
        Rooms::create($setData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an employee ajax request
    public function edit(Request $request)
    {
        // $id = $request->id;
        $result = Rooms::find($request->id);
        $result2 = json_encode($result);
        return response()->json([
            'status' => 200,
            'dataRoom' => $result2
        ]);
    }

    // handle update an  ajax request
    public function update(Request $request)
    {

        $fileName = '';
        $RoomOpen = false;
        $result = Rooms::find($request->room_id);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($result->Edit_thumbnail) {
                Storage::delete('public/images/' . $result->Edit_thumbnail);
            }
        } else {
            $fileName = $request->Edit_thumbnail;
        }
        if ($request->is_open == 'on') {
            $RoomOpen = true;
        }
        $setData = [
            'roomFullName' => $request->roomFullName,
            'roomTitle' => $request->roomTitle,
            'roomSize' => $request->roomSize,
            'roomTypeId' => $request->roomTypeId,
            'placeId' => $request->placeId,
            'roomDetail' => $request->roomDetail,
            'thumbnail' => $fileName,
            'is_open' => $RoomOpen
        ];
        $result->update($setData);
        return response()->json([
            'status' => 200
        ]);
    }

    // handle delete  ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $result = Rooms::find($id);
        if (Storage::delete('public/images/' . $result->thumbnail)) {
            Rooms::destroy($id);
        }
    }

    public function detail(Request $request)
    {

        if ($request->roomId) {
            $roomId = $request->roomId;
            //`room_galleries` 
            $getgallery = room_gallery::join('rooms', 'rooms.id', '=', 'room_galleries.roomID')
                ->select('filename', 'rooms.roomFullName')->where('roomID', $roomId)->get();

            $listRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
                ->join('place', 'place.id', '=', 'rooms.placeId')
                ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
                ->where('rooms.id', '=', $roomId)
                ->get();

            $roomTitle = trim($listRoom[0]->roomFullName);
            return view("room/detail")->with([
                'getListRoom' => $listRoom,
                'roomGallery' => $getgallery,
                'roomTitle' => $roomTitle
            ]);
        }
    }


}
