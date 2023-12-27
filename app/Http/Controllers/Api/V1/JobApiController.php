<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\job_posts;


class JobApiController extends Controller
{
    public function getalljobs(){

        $job_posts=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name','user_representers.username as organize_user')
        ->where('job_posts.is_approved','1')
        ->get();
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($job_posts){
            $result['status'] = true;
            $result['data'] = $job_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
   
    public function getsinglejobs(Request $request){
        $id=$request->post('id');
        $job_posts=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name',
        'user_representers.website','user_representers.email','user_representers.phone_no','user_representers.logo','user_representers.company','user_representers.id as o_id')
        ->where('job_posts.is_approved','1')
        ->where('job_posts.id', $id)
        ->first();
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($job_posts){
            $result['status'] = true;
            $result['data'] = $job_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function dashboardjobs(){

        $job_posts=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name','user_representers.username as organize_user')
        ->where('job_posts.is_approved','1')
        ->orderBy('job_posts.created_at', 'desc') // Assuming there's a created_at column
        ->limit(5)
        ->get();
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($job_posts){
            $result['status'] = true;
            $result['data'] = $job_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    
       
}