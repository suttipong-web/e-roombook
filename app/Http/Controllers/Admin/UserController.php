<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $sql = 'SELECT
                users.id,
                users.email,
                users.isAdmin,
                users.prename_TH,
                users.firstname_TH,
                users.lastname_TH,
                users.positionName,
                users.positionName2,
                users.dep_id,
                users.last_activity,
                users.typeposition_id,
                users.lineToken,
                users.user_type,
                department.dep_name,            
                users_type_admin.admin_type_detail
                FROM
                users
                INNER JOIN department ON users.dep_id = department.dep_id
                LEFT JOIN users_type_admin ON users.user_type = users_type_admin.admin_type_name
                order by  users.dep_id ASC
                ';
        $ListUser = DB::select(DB::raw($sql));
        //  if($ListAdmin){
        return view("admin.users.index")->with([
            'ListUser' => $ListUser
        ]);
    }
    public function viewprifile(Request $request)
    {


        //ประเภท 
        $users_type = DB::table('users_type_admin')
            ->select('admin_type_name', 'admin_type_detail')
            ->get();


        // หน่วยงาน     
        $department = DB::table('department')
            ->select('dep_id', 'dep_name')
            ->get();


        if ($request->userId) {
            $userID = $request->userId;
            $sql = 'SELECT
            users.id,
            users.email,
            users.isAdmin,
            users.prename_TH,
            users.firstname_TH,
            users.lastname_TH,
            users.positionName,
            users.positionName2,
            users.dep_id,
            users.last_activity,
            users.typeposition_id,
            users.lineToken,
            users.user_type,
            department.dep_name,            
            users_type_admin.admin_type_detail
            FROM
            users
            INNER JOIN department ON users.dep_id = department.dep_id
            LEFT JOIN users_type_admin ON users.user_type = users_type_admin.admin_type_name
            where  users.id  =' . $userID . '
            order by  users.dep_id ASC
            ';
            $ListUser = DB::select(DB::raw($sql));
            return view("admin.users.viewprofile")->with([
                'ListUser' => $ListUser,
                'ListDep' => $department,
                'Listtype' => $users_type
            ]);
        }
    }
    public function saved(Request $request)
    {

        $setData = [
            'email' => $request->email,
            'prename_TH' => $request->prename_TH,
            'firstname_TH' => $request->firstname_TH,
            'lastname_TH' => $request->lastname_TH,
            'last_activity' => Carbon::now(),
            'lineToken' => $request->lineToken,
            'dep_id' => $request->dep_id,
            'user_type' => $request->user_type
        ];
        if ($request->userId) {
            $result = User::find($request->userId);
            $result->update($setData);
        } else {
            User::create($setData);
        }
        
    }
}
