<?php

namespace App\Http\Controllers\Admin;

use App\class\HelperService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terms;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TermController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $listAllTerms = Terms::all();
        return view('admin.term.index')->with([
            'listAllTerms' => $listAllTerms    
        ]);

    }
    public function pageAdd(Request $request){      
         return view('admin.term.add')->with([          
        ]);
    }
    public function pageEdit(Request $request){
        $id = $request->input('id');
        $result = Terms::find($id);
        return view('admin.term.edit')->with([
            'resultTerms' => $result    
        ]);
    }
}
