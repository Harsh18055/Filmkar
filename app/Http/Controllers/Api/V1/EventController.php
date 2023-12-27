<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_videos;
use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\representer;
use App\Models\User;
use App\Models\user_representer;
use App\Models\Admin\event_category;
use App\Models\Event;
use App\Models\Admin\slider;
use Session, DB,File;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function sliders(){

        $slider=slider::first();
        
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($slider){
            $result['status'] = true;
            $result['data'] = $slider;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function getallevents(){

        $event_posts=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name')
        ->where('events.is_approved','1')
        ->where('events.status','1')
        ->orderBy('events.created_at', 'desc')
        ->paginate(10);
         $result['count'] = count($event_posts);
        //  $result['event_categories']=event_category::get();
        
        // $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        // $result['city']=city::orderBy('city')->get();
         $result['state']=state::orderBy('name')->get();
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($event_posts){
            $result['status'] = true;
            $result['data'] = $event_posts;
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
    public function dashboardevent(){

        $event_posts=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name')
        ->where('events.is_approved','1')
        ->where('events.status','1')
        ->orderBy('events.created_at', 'desc')
        ->limit(5)
        ->get();
        
        //  $result['new']=job_posts::where('is_view','0')->update(['is_view'=>'1']);
        if($event_posts){
            $result['status'] = true;
            $result['data'] = $event_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
}
