<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\class\HelperService;

class GroupCourseController extends Controller
{
    //
    public function index(Request $request) {
        $courseGroups = DB::table('course_group')->orderBy('id')->get();
        return view('admin.term.group_corse')->with([
            'courseGroups' => $courseGroups
        ]);

    }

    public function assigngroup(Request $request) {
        
        $courseGroups = DB::table('course_group')->where('id', $request->id)->get();        
        $courseId= $request->id ;
        $sql=  " 
        SELECT
        admin_group_courses.id,
        admin_group_courses.cmuitaccount,
        admin_group_courses.created_at,
        admin_group_courses.updated_at,
        admin_group_courses.courseId,
        users.prename_TH,
        users.firstname_TH,
        users.lastname_TH,
        department.dep_title
        FROM
        admin_group_courses
        INNER JOIN users ON admin_group_courses.cmuitaccount = users.email
        INNER JOIN department ON users.dep_id = department.dep_id
        WHERE   admin_group_courses.courseId = '{$courseId}' 
        
        " ;
        $ListAdmin = DB::select(DB::raw($sql));
        
        return view('admin.term.group_corse')->with([
            'coursetitle' => $courseGroups[0]->group_title,
            'ListAdmin'=> $ListAdmin,
        ]);


    }

}
