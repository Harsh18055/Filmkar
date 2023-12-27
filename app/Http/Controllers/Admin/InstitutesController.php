<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\movie;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\user_representer;
use Session;
use DB;
use File;

class InstitutesController extends Controller
{
    public function institute(Request $request)
{
    $type = $request->get('type');

    if ($type == '1') {
        $result['data'] = Movie::leftJoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')
            ->select('movies.*', 'user_representers.username as user_name')
            ->where('movies.is_approved', $type)
            ->get();
    } else {
        $result['data'] = Movie::leftJoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')
            ->select('movies.*', 'user_representers.username as user_name')
            ->where('movies.is_approved', $type)
            ->get();
    }
    
    $result['new']=Movie::where('is_view','0')->update(['is_view'=>'1']);

    return view('admin/institute', $result);
}
  public function is_approved(Request $request,$is_approved,$id){
        $model=movie::find($id);
        $model->is_approved=$is_approved;
        $model->save();
        $request->session()->flash('message','status updated');

        if($is_approved == 1){
            return redirect()->back();
        }else{
        return redirect()->back();
        }
    }



     public function isfeatured(Request $request,$isfeatured,$id){
        $model=movie::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','status updated');
        return redirect()->back();

    }

    public function view_institute(Request $request, $id)
    {
       
        $result['institute_post'] = Movie::leftJoin('states', 'movies.id', '=', 'states.id')
            ->leftJoin('cities', 'movies.id', '=', 'cities.id')
            ->leftJoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')
            ->select('movies.*', 'states.name as state', 'cities.city as city',
                'user_representers.website as user_website', 'user_representers.id as user_id', 'user_representers.username as user_name', 'user_representers.email as user_email', 'user_representers.phone_no as user_number')
            ->where('movies.id', $id)
            ->first();
        
        return view('admin/view_institute', $result);
    }
}
