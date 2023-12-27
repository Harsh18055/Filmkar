<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\representer;
use App\Models\User;
use App\Models\user_gallery;
use App\Models\job_posts;
use App\Models\user_category;
use App\Models\user_videos;
use App\Models\user_social;
use Session;
use DB;
use DateTime;

class JobController extends Controller
{
    public function job_posts(){

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name','user_representers.username as organize_user')
        ->get();
        
         $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);

        // return $result['job_posts'];

        return view('admin/job_posts',$result);
    }

    public function is_approved(Request $request,$is_approved,$id){
        $model=job_posts::find($id);
        $model->is_approved=$is_approved;
        $model->save();
        
        $user_representers = job_posts::leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->select('user_representers.*')
        ->where('user_representers.id',$model->representers_id)
        ->first();
        
        if($is_approved == '1'){
        $details = [
                'username' => $user_representers->username,
                'message' => 'Thank you for youPatience.Your New Job is Approved and its live now.'
            ];
        \Mail::to($user_representers->email)->send(new \App\Http\Mail\approvalmail($details));
        }else{
        $details = [
                'username' => $user_representers->username,
                'message' => 'Thank you for your Patience. Your new Job is Disapproved by the Admin. Pls do the necessary Changes to make it live.'
            ];
        \Mail::to($user_representers->email)->send(new \App\Http\Mail\approvalmail($details));
        }
        $request->session()->flash('message','Job Posts status updated');
        return redirect('admin/job_posts');
    }

    public function isfeatured(Request $request,$isfeatured,$id){
        $model=job_posts::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','isfeatured status updated');
        return redirect('admin/job_posts');
    }

    public function view_job(Request $request,$id){

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name','user_representers.*')
        ->where('job_posts.id',$id)
        ->first();

        // return $result['job_posts'];

        return view('admin/view_job',$result);
    }
}
