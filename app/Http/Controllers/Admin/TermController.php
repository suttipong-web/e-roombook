<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terms;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\class\HelperService;
class TermController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $courseGroups = DB::table('course_group')->orderBy('id')->get();
        $listAllTerms = Terms::all();

         //ประเภทห้อง 
         $roomType = DB::table('room_type')
         ->select('id', 'roomtypeName')
         ->where('id', '<>', 1) 
         ->get();


        return view('admin.term.index')->with([
            'listAllTerms' => $listAllTerms,
            'courseGroups' => $courseGroups ,
            'roomType' => $roomType
        ]);


    }
 
    public function getTermEdit(Request $request)
    {
        $id = $request->input('id');
        $result = Terms::find($id);
        $result2 = json_encode($result);
        $courseGroups = DB::table('course_group')->orderBy('id')->get();
        return response()->json([
            'dataTerm' => $result2

        ]);
    }

    public function deleteTerm(Request $request)
    {
        $id = $request->id;
        $result = Terms::find($id);
        if ($result) {
            Terms::destroy($id);
            return response()->json([
                'status' => "deleted"
            ]);
        } else {
            return response()->json([
                'status' => "error"
            ]);
        }
    }

    public function updated(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date'
               
            ]);
            $chkroomtype =  $this->convertArrayToComma($request->chkroomtype);   
            $setData = [
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'group1_start' => $request->group1_start,
                'group1_end' => $request->group1_end,
                'group2_start' => $request->group2_start,
                'group2_end' => $request->group2_end,
                'group3_start' => $request->group3_start,
                'group3_end' => $request->group3_end ,
                'chkroomtype' => $chkroomtype
            ];



            $result = Terms::find($request->id);

          

            //$result = Terms::update($setData);
            $chk = $result->update($setData);
            if ($chk) {
                return response()->json([
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 208,
                    'message'=>  $chk 
                ]);
            }

        } catch (ValidationException $e) {
            return response()->json([
                'erroemsd' => $e->validator->errors()->all(),
                'status' => 208,
                'error' => 'ERROR'
            ]);
        }
    }

    public function saved(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date'               
            ]);
            $chkroomtype =  $this->convertArrayToComma($request->chkroomtype);  
            $setData = [
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'group1_start' => $request->group1_start,
                'group1_end' => $request->group1_end,
                'group2_start' => $request->group2_start,
                'group2_end' => $request->group2_end,
                'group3_start' => $request->group3_start,
                'group3_end' => $request->group3_end,
                'chkroomtype' => $chkroomtype
            ];

            $insert = Terms::create($setData);
            if ($insert) {
                return response()->json([
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => 208,
                    'error' => 'ERROR'
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'erroemsd' => $e->validator->errors()->all(),
                'status' => 208,
                'error' => 'ERROR'
            ]);
        }
    }
    
    function convertArrayToComma($dataArr)
    {
        if (!is_array($dataArr)) {
            $val='';
        } else {
        $val = implode(",", $dataArr);
       
        }
        return $val;
    }
}
