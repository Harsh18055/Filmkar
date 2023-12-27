<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\slider;
use App\Models\chatbot;
use App\Models\Admin\representer;
use App\Models\User;
use App\Models\movie;
use App\Models\user_gallery;
use App\Models\job_posts;
use App\Models\job_application;
use App\Models\Admin\event_category;
use App\Models\user_category;
use App\Models\Event;
use App\Models\user_videos;
use App\Models\user_representer;
use App\Models\representers_gallery;
use App\Models\user_social;
use App\Models\Institute;
use App\Models\Admin\Banners;
use Session;
use DB;
use DateTime,Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class TalentController extends Controller
{
    
    public function dashboardfeaturet(){

        $talent_posts=DB::table('users')
    ->select(
        'users.id', 'username', 'firstname', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
        )
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '1')
    ->orderBy('userratting', 'desc')
    ->limit(8)
    ->get();
        
        
        if($talent_posts){
            $result['status'] = true;
            $result['data'] = $talent_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function dashboardmembert(){

        $talent_posts=DB::table('users')
    ->select(
        'users.id', 'username', 'firstname', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
        )
    
    ->where('status', 1)
    ->where('isfeatured', '0')
    ->orderBy('userratting', 'desc')
    ->limit(8)
    ->get();
        
        
        if($talent_posts){
            $result['status'] = true;
            $result['data'] = $talent_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function allfeaturetalent(){

        $talent_posts=DB::table('users')
    ->select(
        'users.id', 'username', 'firstname','city', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name','states.name as states_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->leftjoin('states' , 'users.state_id', '=', 'states.id')
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '1')
     ->orderBy('userratting', 'desc')
    ->paginate(8);
    
        
        
        if($talent_posts){
            $result['status'] = true;
            $result['data'] = $talent_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function allmembertalent(){

         $talent_posts=DB::table('users')
    ->select(
        'users.id', 'username', 'firstname','city', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name','states.name as states_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->leftjoin('states' , 'users.state_id', '=', 'states.id')
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '0')
     ->orderBy('userratting', 'desc')
    ->paginate(8);
    
        
        if($talent_posts){
            $result['status'] = true;
            $result['data'] = $talent_posts;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    public function getsingletalent(Request $request){
       
        $id=$request->post('id');
        
        //$result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::leftjoin('states', 'users.state_id', '=', 'states.id')
        ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
        ->select('users.*','states.name as state','cities.city as city')
        ->where('users.id',$id)
        ->where('users.status', '1')
        ->first();
        
         $result['vendor_attr'] = DB::table('user_attrs')
         ->where('user_id',$result['vendor']->id)
         ->first();

        $result['galleryArr'] = user_gallery::where('user_id',$result['vendor']->id)->get();
        $result['id'] = $result['vendor']->id;
        $bday = new DateTime($result['vendor']->birthdate); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $result['yearsold'] = $diff->y;

        
        $result['subcategoryname'] = array();
        foreach($result['vendor']->categories as $list){

            $checkcategory = Category::where('id',$list->id)->first();
            if($checkcategory->parent_id == null){
            $result['categoryname'][] = $list->category_name;
            }else{
            $result['subcategoryname'][] = $list->category_name;
            }
        }
        // return $result;
        $result['videosarr'] = user_videos::where('user_id',$result['vendor']->id)->get();
        
        $result['user_social'] = user_social::where('user_id',$result['vendor']->id)->first();
    
        
        $result['ratings'] = DB::table('user_rattings')
        ->leftjoin('user_representers','user_rattings.email','=','user_representers.email')
        ->select('user_representers.*','user_rattings.*')
        ->where('user_rattings.user_id', $result['id'])
        ->get();
        
        

        $result['ratings_count'] = $result['ratings']->count();
        $result['ratings_average'] = number_format($result['ratings']->avg('ratting') , 1);
        
        if($result){
            $result['status'] = true;
            
        }else{
            $result['status'] = false;
        }

        return response()->json($result);
    }
    
    public function update_talent_social_media(Request $request){

        $user_id = $request->post('user_id');
        
        $validator = Validator::make($request->all(), [
                'user_id'=>'required',
                'social_id'=>'required',
            ]);

        if ($validator->fails()) {
             return response()->json($validator->errors()->first());
        }
        
        if($request->post('social_id')>0){
            $user_social=user_social::where(['user_id'=>$user_id])->first();
        }else{
            // return "hi";
            $user_social=new user_social();
        }
        

        $user_social->user_id = $user_id;
        $user_social->facebook = $request->post('facebook');
        $user_social->instagram = $request->post('instagram');
        $user_social->linkedin = $request->post('linkedin');
        $user_social->twitter = $request->post('twitter');
        $user_social->save();


       if($user_social){
            $result['status'] = true;
            
        }else{
            $result['status'] = false;
        }
        return response()->json($result);
    }

}
