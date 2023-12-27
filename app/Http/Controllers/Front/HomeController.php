<?php

namespace App\Http\Controllers\Front;

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


class HomeController extends Controller
{
    
     public function getreplay($question_id)
{
    // Retrieve the answer from the database based on the question_id
    $answer = DB::table('chatbot')->where('id', $question_id)->first();

    if ($answer) {
        echo '<li class="chat outgoing"  ><span class="material-symbols-outlined">smart_toy</span><p>' . $answer->answer . '</p></li>';
    } else {
        echo '<li class="chat outgoing"  ><span class="material-symbols-outlined">smart_toy</span><p>No answer found for the specified question ID.</p></li>';
    }
}

    
       public function chatbot()
    {
        $result['data']=chatbot::all();
    }
    
    
    
    
    
    public function index(){
        
        //->take(8)
        
        $result['category']=Category::where('parent_id',null)->orderby('category_name')->limit(8)->get();
        // return $result['category'];

         $result['vendor'] = DB::table('users')
    ->select(
        'users.id', 'username', 'firstname','city', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'password', 'gender',
        'birthdate', 'year_of_experience' , 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name','states.name as states_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
     ->leftjoin('states' , 'users.state_id', '=', 'states.id')
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '1')
    //->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc')
    ->orderBy('users.created_at')
    ->paginate(12);
        // return $result['vendor'];
        // $result['jobs'] = job_posts::where('isfeatured', '1')->where('is_approved', '1')->get();
        
        $result['jobs'] = DB::table('job_posts')
                        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
                        ->leftjoin('states', 'job_posts.state_id', '=', 'states.id')
                        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
                        ->select('job_posts.*','user_representers.logo', 'states.name as state','cities.city as city')
                        ->where('job_posts.isfeatured', '1')
                        ->where('job_posts.is_approved', '1')
                        ->get();
                        
        //return $result['jobs'];
        $result['events'] = Event::where('events.isfeatured', '1')
                                    ->leftjoin('states', 'states.id', '=', 'events.state_id')
                                    ->leftjoin('event_categories', 'event_categories.id', '=', 'events.event_cat_id')
                                    ->select('events.*', 'states.name as state' , 'event_categories.category_name')
                                    ->where('is_approved', '1')
                                    ->get();
        
        
        $result['movies'] = Movie::where('movies.isfeatured','1')
            ->leftJoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')
            ->select('movies.*', 'user_representers.username as user_name')
            ->where('movies.is_approved', '1')
            ->get(); 
        //  return $result['data'];
        
         $result['institutes'] = DB::table('user_representers')
    ->leftJoin('states', 'user_representers.state_id', '=', 'states.id')
    ->leftJoin('cities', 'user_representers.city_id', '=', 'cities.id')
    ->select(
        'user_representers.*',
        'states.name as state',
        'cities.city as city',
        DB::raw('(SELECT COUNT(ratting) FROM organisation_rattings WHERE organisation_rattings.organisation_id = user_representers.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM organisation_rattings WHERE organisation_rattings.organisation_id = user_representers.id) as userratting')
    )
    //->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc')
    ->orderBy('user_representers.created_at')
    ->where('user_representers.is_approved', '1')
    ->where('user_representers.isfeatured', '1')
    ->paginate(12);
        
         $result['data']=blog::all();
         
         
        
        // return $result['institutes'];
        

        $setting = DB::table('settings')->find(1);
        $trending_category = explode(',',$setting->trending_category);

        $result['setting'] = DB::table('categories')->whereIn('categories.id', $trending_category)->get();

        foreach($result['category'] as $list){

            $cat_id = $list->id;
            $temp['id'] = $list->id;
            $temp['category_name'] = $list->category_name;
            $temp['category_slug'] = $list->category_slug;
            $temp['count'] = User::leftjoin('user_categories', 'users.id', '=', 'user_categories.user_id')
            ->leftjoin('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->where('user_categories.cat_id',$cat_id)
            ->where('users.status','1')
            ->count();
            // $temp['count'] = $count;
            $result['category_count'][] = $temp;
        }
        // return $result['category_count'][0]['id'];
        
        //['sliders'] = slider::();
        $result['sliders'] = slider::first();
        $result['testimage'] = $result['sliders'] ? $result['sliders']->talent : null;
        $result['jobimage'] = $result['sliders'] ? $result['sliders']->job : null;
        $result['eventimage'] = $result['sliders'] ? $result['sliders']->event : null;
        $result['moiveimage'] = $result['sliders'] ? $result['sliders']->moive : null;
        $result['organisationimage'] = $result['sliders'] ? $result['sliders']->organisation : null;

        return view('front/home',$result);
    }

    public function register(){
        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::query()->orderBy('name','ASC')->get();
        $result['city']=city::query()->orderBy('city','ASC')->get();

        $user_id = Session::get('USER_ID');
        $organisation_ID = Session::get('organisation_ID');
        
        if(isset($user_id)){
            return redirect()->route('home');
        }else{
            return view('front/register',$result);
        }
    }

    public function register_organisation(){
        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::query()->orderBy('name','ASC')->get();
        $result['city']=city::query()->orderBy('city','ASC')->get();
        $result['representers']=representer::all();
        
        $organisation_ID = Session::get('organisation_ID');
        
        if(isset($organisation_ID)){
            return redirect()->route('home');
        }else{
            return view('front/register_organisation',$result);
        }
    }

    public function contact(){

        // $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        return view('front/contact',$result);
    }

    public function getcitybystate(Request $request, $id){

        $arr = city::where('state_id',$id)->orderBy('city')->get();
        
        $html = "<option></option>";
        foreach($arr as $list){
         $html .="<option value=".$list->id.">$list->city</option>";
        }
        echo $html;
    }

    public function getsubcat(Request $request){
        

        $id = $request->get('array');
        $subcatid = $request->get('subcatarray');

        $str_arr = preg_split ("/\,/", $id);
        $str_sub_arr = preg_split ("/\,/", $subcatid);
        $arr = Category::whereIn('parent_id',$str_arr)->get();

        // $arrselected = Category::whereIn('id',$subcatid)->get();

        // $arrayofsub = array();
        // foreach($arrselected as $list){

        //     array_push($arrayofsub,$list->id);
        // }
        // return $arrayofsub;

        
        foreach($arr as $list){
        // echo "<option value=".$list->id.">$list->category_name</option>";
        if(in_array($list->id, $str_sub_arr)){
            echo "<option value=".$list->id." selected>";
        }else{
            echo "<option value=".$list->id.">";
        }
        echo "$list->category_name</option>";

        }

    }

    public function getisattrcategory(Request $request){
        

        $id = $request->get('array');

        $category_ids = preg_split ("/\,/", $id);

        // return $category_ids;
        
        $is_attr_category = Category::select('id')->where('is_attr','1')->get();

        foreach($is_attr_category as $list){
            $isattrcategoryname[] = $list->id;
        }

        if( !empty(array_intersect($isattrcategoryname, $category_ids))){

            echo 1;
        }else{
            echo 0;
        }

    }

    public function talent_browse(){

        $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        $result['language']=language::all();
        $result['city']=city::orderBy('city')->get();
        $result['state']=state::orderBy('name')->get();
         $result['featured_vendor'] = DB::table('users')
    ->select(
        'users.id', 'username', 'firstname','city', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'is_birthdate_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name','states.name as states_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->leftjoin('states' , 'users.state_id', '=', 'states.id')
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '1')
    //->orderBy('usercount', 'desc')
     ->orderBy('userratting', 'desc')
    // ->orderBy('users.created_at')
    ->paginate(8);
        // User::leftjoin('states' , 'users.state_id', '=', 'states.id')
        // ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
        
        // ->where('isfeatured', '1')
        // ->where('status', '1')
        // ->paginate(8);
        
        
    $result['vendor'] = DB::table('users')
    ->select(
        'users.id', 'username', 'firstname', 'lastname', 'profile', 'email', 'email_varify', 'phonenumber', 'is_phoneno_enable', 'is_birthdate_enable', 'password', 'gender',
        'birthdate', 'year_of_experience', 'about_you', 'whatsapp_no', 'points', 'isfeatured', 'status', 'is_view',
        'remember_token', 'referral_code', 'created_at', 'updated_at','cities.city as city_name','states.name as states_name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->leftjoin('states' , 'users.state_id', '=', 'states.id')
    ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
    ->where('status', 1)
    ->where('isfeatured', '0')
    //->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc')
    ->orderBy('created_at')
    ->paginate(24);
    

//  $result['vendor'] = 
//         User::leftjoin('states' , 'users.state_id', '=', 'states.id')
//         ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')
//         ->where('isfeatured', '0')
//         ->where('status', '1')
//         ->paginate(12);
        
        

       
        // return $result['vendor'];
        $result['vendorcount'] = count($result['vendor']);
    

        return view('front/telent_browse',$result);
    }

    public function filterusers(Request $request){
    
        $result['category']=Category::where('parent_id',null)->orderBy('category_name','asc')->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        $params = $request->all();
        $params = array_filter($params, fn($value) => filled($value));

        $query = User::leftJoin('states', 'users.state_id', '=', 'states.id')
    ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
    ->leftJoin('user_categories', 'users.id', '=', 'user_categories.user_id')
    ->leftJoin('user_languages', 'users.id', '=', 'user_languages.user_id');

foreach ($params as $key => $value) {
    if (!empty($value)) {
        // Add where clause for non-empty parameters
        switch ($key) {
            case 'category_id':
                $query->where('user_categories.cat_id', $value);
                break;
            case 'language':
                $query->where('user_languages.language_id', $value);
                break;
            case 'gender':
                $query->where('users.gender', $value);
                break;
            case 'state_id':
                $query->where('users.state_id', $value);
                break;
            case 'city_id':
                $query->where('users.city_id', 'LIKE', "%$value%");
                break;
            case 'keyword':
                $query->where(function ($query) use ($value) {
                    $query->where('users.username', 'LIKE', "%$value%")
                        ->orWhere('users.firstname', 'LIKE', "%$value%")
                        ->orWhere('users.lastname', 'LIKE', "%$value%");
                });
                break;
        }
    }
}

if (!empty($params['year_of_experience_min']) && !empty($params['year_of_experience_max'])) {
    $query->whereBetween('users.year_of_experience', [$params['year_of_experience_min'], $params['year_of_experience_max']]);
}

$query->where('users.status', '=', 1)
    ->select('users.id', 'users.firstname', 'users.username', 'users.birthdate', 'users.lastname', 'users.profile', 'cities.city', 'states.name',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->groupBy('users.id', 'users.firstname', 'users.username', 'users.birthdate', 'users.lastname', 'users.profile', 'cities.city', 'states.name')
    //   ->where('isfeatured', '0')
   // ->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc');

$result['vendor'] = $query->paginate(12);

        
        $result['featured_vendor'] = 
        User::leftjoin('states' , 'users.state_id', '=', 'states.id')
        ->leftjoin('cities' , 'users.city_id', '=', 'cities.id')

        ->where('users.status', '1')
        ->paginate(24);

        $result['vendorcount'] = $result['vendor']->count();
        
        // return "test";
        return view('front/telent_browse',$result);

    }

    public function details(Request $request,$slug){


        // $user = User::find(1);
        // return $user->categories;
        // $result['category']=Category::where('parent_id',null)->get();

        $result['categorybyslug']=Category::where('parent_id',null)->where('category_slug',$slug)->first();
        $id = $result['categorybyslug']->id;

      $result['vendor'] = user_category::leftjoin('users', 'user_categories.user_id', '=', 'users.id')
    ->leftjoin('categories', 'user_categories.cat_id', '=', 'categories.id')
    ->leftjoin('states', 'users.state_id', '=', 'states.id')
    ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
    ->select(
        'users.*',
        'states.name as state',
        'cities.city as city',
        DB::raw('(SELECT COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting) FROM user_rattings WHERE user_rattings.user_id = users.id) as userratting')
    )
    ->where('user_categories.cat_id', $id)
    ->where('users.status', '1')
    //->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc')
    ->orderBy('created_at')
    ->get();

        $result['vendorcount'] = count($result['vendor']);
        $result['language']=language::all();
        // $result['state']=state::all();
        
        $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        // $result['city']=city::orderBy('city')->get();
        $result['state']=state::orderBy('name')->get();

        return view('front/vendor',$result);


    }

    

    public function vendordetails(Request $request,$username){
        $result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::leftjoin('states', 'users.state_id', '=', 'states.id')
        ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
        ->select('users.*','states.name as state','cities.city as city')
        ->where('username',$username)
        ->where('users.status', '1')
        ->first();
        
         $result['vendor_attr'] = DB::table('user_attrs')
         ->where('user_id',$result['vendor']->id)
         ->first();

        $result['galleryArr'] = user_gallery::where('user_id',$result['vendor']->id)->paginate(12);
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
        
    //   $result['ratings'] = DB::table('user_rattings')
    //     ->leftJoin('users', 'user_rattings.user_id', '=', 'users.id')
    //     ->select('user_rattings.*', 'users.*') 
    //     ->where('user_rattings.user_id', $result['id'])
    //     ->get();
        
         $result['ratings'] = DB::table('user_rattings')
        ->leftjoin('user_representers','user_rattings.email','=','user_representers.email')
        ->leftjoin('users','user_rattings.email','=','users.email')
        ->select('user_representers.*','user_rattings.*','users.profile','users.username as talentUsername')
        ->where('user_rattings.user_id', $result['id'])
        ->get();
        
        

        $result['ratings_count'] = $result['ratings']->count();
        $result['ratings_average'] = number_format($result['ratings']->avg('ratting') , 1);
        
        return view('front/vendordetails',$result);

    }

    public function vendorcontact(Request $request){

        // return $request->all();
        $details = [
            'telent_name' => $request->telent_name,
            'telent_email' => $request->telent_email,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        \Mail::to([$request->telent_email, 'web@filmkar.com'])->send(new \App\Mail\TelentHireContact($details));

        return redirect()->back();
    }

    public function blog(){

        $result['blog']=blog::paginate(6);
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/blog',$result);
    }

    public function blogdetails(Request $request,$slug){
        $result['category']=Category::where('parent_id',null)->get();

        $result['signleblog']=blog::where('slug',$slug)->first();

        return view('front/blogdetails',$result);


    }

    public function jobs(){

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','user_representers.logo','user_representers.company','categories.category_name')
        ->where('job_posts.is_approved','1')
        // ->where('user_representers.is_approved','1')
        ->latest('job_posts.created_at')
        ->paginate(10);
        // return $result['job_posts'];
        // $user_id = Session::get('USER_ID');

        $result['count']=job_posts::count();
        // $result['job_application_applied']=job_application::where('user_id',$user_id)->get();
        $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        $result['city']=city::orderBy('city')->get();
        $result['state']=state::orderBy('name')->get();
        return view('front/jobs',$result);
    }

    public function job_detail($slug)
    {   
        // $job_post  = job_posts::where('slug',$slug)->first();

        $result['job_post']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name',
        'user_representers.website','user_representers.email','user_representers.phone_no','user_representers.logo','user_representers.company','user_representers.id as o_id')
        ->where('job_posts.slug',$slug)
        ->where('job_posts.is_approved','1')
        ->first();

        $result['similar_jobs']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city','categories.category_name','user_representers.logo')
        ->where('categories.id',$result['job_post']->job_role_id)
        ->where('job_posts.id','!=',$result['job_post']->id)
        ->where('job_posts.is_approved','1')
        ->paginate(4);

        //return $result['similar_jobs'];
        $result['category']=Category::where('parent_id',null)->get();
        return view('front/job_details',$result);
 
    }

    public function filters(Request $request){

        $category_id = $request->get('category_id');
        $gender = $request->get('gender');
        $state_id = $request->get('state_id');
        $city_id = $request->get('city_id');

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city')
        ->where('job_posts.status','1')
        ->where('user_representers.is_approved','1')
        ->where('job_posts.is_approved','1')
        ->where('job_posts.job_role_id', 'like', '%' . $category_id . '%')
        ->where('job_posts.gender', 'like', '%' . $gender . '%')
        ->where('job_posts.state_id', 'like', '%' . $state_id . '%')
        ->where('job_posts.city_id', 'like', '%' . $city_id . '%')
        ->paginate(3);
        $result['count']=job_posts::count();
        $result['category']=Category::where('parent_id',null)->get();
        $result['state']=state::all();
        $result['city']=city::all();
        return view('front/jobs',$result);
    }
    public function filter(Request $request){
        
        

        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        $params = $request->all();
        $params = array_filter($params, fn($value) => filled($value));

// return $params;
        $query = 
        job_posts::leftjoin('states' , 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities' , 'job_posts.city_id', '=', 'cities.id')
        ->leftjoin('categories', 'job_posts.job_role_id', '=', 'categories.id')
        ->leftjoin('user_representers', 'job_posts.representers_id', '=', 'user_representers.id')->where('job_posts.is_approved', '1');

        foreach ($params as $key => $value) {
            if (!empty($value)) {
                // Add where clause for non-empty parameters
                switch ($key) {
                    case 'keyword':
                        $query->where('job_posts.title', 'LIKE', "%$value%");
                        break;
                    case 'category_id':
                        $query->where('job_posts.job_role_id', '=', $value);
                        break;
                    case 'gender':
                        $query->where('job_posts.gender', $value);
                        break;
                    case 'state_id':
                        $query->where('job_posts.state_id', $value);
                        break;
                    case 'city_id':
                        $query->where('job_posts.city_id', 'LIKE', "%$value%");
                        break;
                    case 'MinAge':
                        $query->where('job_posts.MinAge', 'LIKE', "%$value%");
                        break;
                    case 'MaxAge':
                        $query->orwhere('job_posts.MaxAge', 'LIKE', "%$value%");
                        break;
                    // Add more cases for additional parameters
                }
            }
        }
        // $query->where('job_posts.status', '1');
        $query
        ->select('job_posts.*', 'states.name as state','user_representers.logo','user_representers.company','cities.city as city','categories.category_name')
        ->where('job_posts.status','1')
        ->where('user_representers.is_approved','1')
        ->where('job_posts.is_approved','1')
        ->orderby('title','asc');

        // $query->get();

        $result['job_posts'] = $query->paginate(3);

        $result['count'] = $result['job_posts']->count();
        return view('front/jobs',$result);

    }

    public function apply(Request $request,$user_id,$job_posts_id){

        $query = job_application::where('user_id',$user_id)->where('job_posts_id',$job_posts_id)->first();



        if($query){
            return false;
        }else{
            $job_application = new job_application;
            $job_application->user_id = $user_id;
            $job_application->job_posts_id = $job_posts_id;
            $organize_id = job_posts::where('id',$job_posts_id)->first();
            $job_application->representer_id = $organize_id->representers_id;
            $job_application->save();

            $per_job = DB::table('points_setting')->where('key', 'per_job','ASC')->first()->value;
            $user = DB::table('users')->where('id', $user_id)->first();

            $deduct_points = $user->points - $per_job;
            DB::table('users')->where('id', $user_id)->update(['points' => $deduct_points]);

            return true;
        }
        
    }

    public function forgotpassword(Request $request){

        $user_type = $request->get('user_type');
        $email = $request->get('email');

        if($user_type == 'telent'){
            $User = User::where('email',$email)->first();
            if($User){
                $User = User::find($User->id);
                $token = time() . rand(1, 100);
                $User->remember_token = $token;
                $User->save();
    
                $url_parms = URL::to('/chnagepassword?email=').$email.'&'.'token='.$token.'&'.'user_type='.$user_type;
                // return $url_parms;
    
                $details = [
                    'username' => $User->username,
                    'email' => $User->email,
                    'url' => $url_parms
                ];
            //    return $email;
                \Mail::to($email)->send(new \App\Mail\forgotmail($details));
            return true;
            }
        }elseif($user_type == 'organize'){
            $user_representer = user_representer::where('email',$email)->first();
            if($user_representer){
                $user_representer = user_representer::find($user_representer->id);
                $token = time() . rand(1, 100);
                $user_representer->remember_token = $token;
                $user_representer->save();

                $url_parms = URL::to('/chnagepassword?email=').$email.'&'.'token='.$token.'&'.'user_type='.$user_type;
                // $url_parms = URL::to('chnagepassword?email=').$email.'&'.'token='.$token;
                // return $url_parms;

                $details = [
                    'username' => $user_representer->name,
                    'email' => $user_representer->email,
                    'url' => $url_parms
                ];
            //    return $email;
                \Mail::to($email)->send(new \App\Mail\forgotmail($details));
            return true;
            }
        }else{
            return false;
        }        
    }

    public function chnagepassword(Request $request){

        $token = $request->get('token');
        $email = $request->get('email');
        $user_type = $request->get('user_type');
        $result['category']=Category::where('parent_id',null)->get();

        if($user_type == 'telent'){
            $User = User::where('email',$email)->where('remember_token',$token)->first();
            if($User){
                return view('front/changepassword',$result);
            }else{
                return "somthing want worng";
            }
        }elseif($user_type == 'organize')
        {
            $user_representer = user_representer::where('email',$email)->where('remember_token',$token)->first();
            if($user_representer){
                return view('front/changepassword',$result);
            }else{
                return "somthing want worng";
            }
        }
        else{
            return "somthing want worng";
        }
        
        
    }

    public function chnagepassword_process(Request $request){

        $token = $request->post('token');
        $email = $request->post('email');
        $password = $request->post('password');
        $cpassword = $request->post('cpassword');
        $user_type = $request->post('user_type');

        if($user_type == 'telent'){
            $User = User::where('email',$email)->where('remember_token',$token)->first();

            if($User){
                
                if($password == $cpassword){
    
                    $model = User::find($User->id);
                    $model->password = hash::make($password);
                    $model->remember_token = '';
                    $model->save();
    
                    $request->session()->flash('message','Password hashbeen changed');
                    return redirect()->route('user.login');
                }else{
                    $request->session()->flash('message','Confirm Password Dose Not Match!');
                    return redirect()->back();
                }
            }
        }elseif($user_type == 'organize'){

            $user_representer = user_representer::where('email',$email)->where('remember_token',$token)->first();

            if($user_representer){
                
                if($password == $cpassword){
    
                    $model = user_representer::find($user_representer->id);
                    $model->password = hash::make($password);
                    $model->remember_token = '';
                    $model->save();
    
                    $request->session()->flash('message','Password hashbeen changed');
                    return redirect()->route('user.login');
                }else{
                    $request->session()->flash('message','Confirm Password Dose Not Match!');
                    return redirect()->back();
                }
            }
        }
        else{
            return "somthing want worng";
        }
    }

    public function events(){
        
        $result['events']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name')
        ->where('events.is_approved','1')
        ->where('events.status','1')
        ->orderBy('events.created_at', 'desc')
        ->paginate(6);
        $result['count'] = count($result['events']);
        $result['event_categories']=event_category::get();
        
        $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        $result['city']=city::orderBy('city')->get();
        $result['state']=state::orderBy('name')->get();
        return view('front/events',$result);
    }

    public function event_search(Request $request){

        $result['category']=Category::where('parent_id',null)->get();
        $result['event_categories']=event_category::get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();
        $params = $request->all();
        // return $params;
        $params = array_filter($params, fn($value) => filled($value));

        $query = 
        Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id');
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                // Add where clause for non-empty parameters
                switch ($key) {
                    case 'keyword':
                        $query->where('events.title', 'like', '%' . $value . '%');
                        $query->orwhere('events.about_event', 'like', '%' . $value . '%');
                        $query->orwhere('events.tags', 'like', '%' . $value . '%');
                        break;
                    case 'category_id':
                        $query->where('events.event_cat_id', $value);
                        break;
                    case 'event_type':
                        $query->where('events.event_type', $value);
                        break;
                    case 'state_id':
                        $query->where('events.state_id', $value);
                        break;
                    case 'city_id':
                        $query->where('events.city_id', 'LIKE', "%$value%");
                        break;
                    // case 'year_of_experience_min':
                    //     $query->where('users.year_of_experience', 'LIKE', "%$value%");
                    //     break;
                    // case 'year_of_experience_max':
                    //     $query->where('users.year_of_experience', 'LIKE', "%$value%");
                    //     break;
                    // Add more cases for additional parameters
                }
            }
        }
        $query->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name');
        $query->where('events.is_approved','1');
        $result['events'] = $query->paginate(6);

        // return $result['events'];
        $result['count'] = count($result['events']);
        $result['category']=Category::where('parent_id',null)->get();
        return view('front/events',$result);
    }
    
    public function event_detail($slug){

        $result['event_post']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name',
        'user_representers.website as user_website','user_representers.username as user_name','user_representers.email as user_email','user_representers.phone_no as user_number')
        ->where('events.slug',$slug)
        ->where('events.is_approved','1')
        ->where('events.status','1')
        ->first();

        $result['similar_event']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name')
        ->where('event_categories.id',$result['event_post']->event_cat_id)
        ->where('events.id','!=',$result['event_post']->id)
        ->where('events.is_approved','1')
        ->where('events.status','1')
        ->paginate(4);

        // return $result['similar_jobs'];
        $result['category']=Category::where('parent_id',null)->get();
        return view('front/event_details',$result);
    }
    
    public function movies(){
        
        $result['movies']=DB::table('movies')->where('is_approved',1)->where('isfeatured',1)->orderBy('created_at', 'desc')->paginate(10);
        $result['genre_types']=DB::table('genre_type')->get();
        $result['format_types']=DB::table('format_type')->get();
        $result['languages']=DB::table('languages')->get();
        return view('front/movies',$result);
    }
    public function movies2(){
        
        $result['movies']=DB::table('movies')->where('is_approved',1)->where('isfeatured',1)->orderBy('created_at', 'desc')->paginate(10);
        $result['genre_types']=DB::table('genre_type')->get();
        $result['format_types']=DB::table('format_type')->get();
        $result['languages']=DB::table('languages')->get();
        return view('front/movies2',$result);
    }
     
    public function movie_detail($slug){

        
        $result['movie_post']=DB::table('movies')->select('movies.*', 'user_representers.*')->where('movies.slug',$slug)->leftjoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')->first();
        
        // return $result['movie_post'];
        
        $movie_data = DB::table('movies')->where('movies.slug',$slug)->first();
        $result['id'] = $movie_data->id;
        $castarray = DB::table('movie_cast')->where('movie_id',$movie_data->id)->get();
        foreach($castarray as $list)
        {
            $user_profile = $list->user_profile;
            $segments = explode('/', $user_profile);
            $slug = end($segments);
            $user = DB::table('users')->where('username',$slug)->first();
            
            if(isset($user))
            {
                $result['cast'][] = (object)[
                    'id' => $user->id,
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'profile' => $user->profile,
                    'character_name' => $list->character_name
                ];
            }
            
        }
        
        $crewarray = DB::table('movie_crew')->where('movie_id',$movie_data->id)->get();
        foreach($crewarray as $list)
        {
            $user_profile = $list->crew_profile;
            $segments = explode('/', $user_profile);
            $slug = end($segments);
            $user = DB::table('users')->where('username',$slug)->first();
            
            if(isset($user))
            {
                $result['crew'][] = (object)[
                    'id' => $user->id,
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'profile' => $user->profile,
                    'crew_type' =>$list->crew_type
                ];
            }
            
        }
        // return $result['cast'];
        
        
        $result['galleryArr'] = DB::table('movie_image')->where('movie_id',$movie_data->id)->get();
        $result['videosArr'] = DB::table('movie_video')->where('movie_id',$movie_data->id)->get();
        
        $result['ratings'] = DB::table('movie_rattings')->leftjoin('user_representers','movie_rattings.email','=','user_representers.email')->select('user_representers.*','movie_rattings.*')->where('movie_id',$movie_data->id)->get();
;
        
        $result['ratings_count'] = $result['ratings']->count();
        $result['ratings_average'] = number_format($result['ratings']->avg('ratting') , 1);
        return view('front/movie_details',$result);
    }




     public function movie_detail2($slug){

        
        $result['movie_post']=DB::table('movies')->select('movies.*', 'user_representers.*')->where('movies.slug',$slug)->leftjoin('user_representers', 'movies.representers_id', '=', 'user_representers.id')->first();
        
        // return $result['movie_post'];
        
        $movie_data = DB::table('movies')->where('movies.slug',$slug)->first();
        $result['id'] = $movie_data->id;
        $castarray = DB::table('movie_cast')->where('movie_id',$movie_data->id)->get();
        foreach($castarray as $list)
        {
            $user_profile = $list->user_profile;
            $segments = explode('/', $user_profile);
            $slug = end($segments);
            $user = DB::table('users')->where('username',$slug)->first();
            
            if(isset($user))
            {
                $result['cast'][] = (object)[
                    'id' => $user->id,
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'profile' => $user->profile,
                    'character_name' => $list->character_name
                ];
            }
            
        }
        
        $crewarray = DB::table('movie_crew')->where('movie_id',$movie_data->id)->get();
        foreach($crewarray as $list)
        {
            $user_profile = $list->crew_profile;
            $segments = explode('/', $user_profile);
            $slug = end($segments);
            $user = DB::table('users')->where('username',$slug)->first();
            
            if(isset($user))
            {
                $result['crew'][] = (object)[
                    'id' => $user->id,
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'profile' => $user->profile,
                    'crew_type' =>$list->crew_type
                ];
            }
            
        }
        // return $result['cast'];
        
        
        $result['galleryArr'] = DB::table('movie_image')->where('movie_id',$movie_data->id)->get();
        $result['videosArr'] = DB::table('movie_video')->where('movie_id',$movie_data->id)->get();
        
        $result['ratings'] = DB::table('movie_rattings')->leftjoin('user_representers','movie_rattings.email','=','user_representers.email')->select('user_representers.*','movie_rattings.*')->where('movie_id',$movie_data->id)->get();
;
        
        $result['ratings_count'] = $result['ratings']->count();
        $result['ratings_average'] = number_format($result['ratings']->avg('ratting') , 1);
        return view('front/movie_details2',$result);
    }


    
    public function movie_search(Request $request){

        $result['genre_types']=DB::table('genre_type')->get();
        $result['format_types']=DB::table('format_type')->get();
        $result['languages']=DB::table('languages')->get();
        
        $params = $request->all();
        
        $params = array_filter($params, fn($value) => filled($value));

        $query = DB::table('movies')->where('is_approved',1);
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                // Add where clause for non-empty parameters
                switch ($key) {
                    case 'keyword':
                        $query->where('movies.title', 'like', '%' . $value . '%');
                        $query->orwhere('movies.about', 'like', '%' . $value . '%');
                        break;
                    case 'genre_id':
                        $query->whereRaw('JSON_CONTAINS(movies.genre, \'["' . $value . '"]\')');
                        break;
                    case 'format_id':
                        $query->whereRaw('JSON_CONTAINS(movies.format, \'["' . $value . '"]\')');
                        break;
                    case 'language_id':
                        $query->whereRaw('JSON_CONTAINS(movies.language, \'["' . $value . '"]\')');
                        break;
                }
            }
        }
        $result['movies'] = $query->paginate(6);
        
        return view('front/movies',$result);
    }



    public function movie_search2(Request $request){

        $result['genre_types']=DB::table('genre_type')->get();
        $result['format_types']=DB::table('format_type')->get();
        $result['languages']=DB::table('languages')->get();
        
        $params = $request->all();
        
        $params = array_filter($params, fn($value) => filled($value));

        $query = DB::table('movies')->where('is_approved',1);
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                // Add where clause for non-empty parameters
                switch ($key) {
                    case 'keyword':
                        $query->where('movies.title', 'like', '%' . $value . '%');
                        $query->orwhere('movies.about', 'like', '%' . $value . '%');
                        break;
                    case 'genre_id':
                        $query->whereRaw('JSON_CONTAINS(movies.genre, \'["' . $value . '"]\')');
                        break;
                    case 'format_id':
                        $query->whereRaw('JSON_CONTAINS(movies.format, \'["' . $value . '"]\')');
                        break;
                    case 'language_id':
                        $query->whereRaw('JSON_CONTAINS(movies.language, \'["' . $value . '"]\')');
                        break;
                }
            }
        }
        $result['movies'] = $query->paginate(6);
        
        return view('front/movies2',$result);
    }


    
    
    public function checkratting(Request $request)
    {
        $email = $request->get('email');
        $id = $request->get('id');
        $user = DB::table('movie_rattings')->where('email',$email )->where('movie_id', $id)->first();
    
        if ($user) {
            echo "yes";
        } else {
            echo "no";
        }
    }
    
    public function checkuserratting(Request $request)
    {
        $email = $request->get('email');
        $id = $request->get('id');
        $user = DB::table('user_rattings')->where('email',$email )->where('user_id', $id)->first();
    
        if ($user) {
            echo "yes";
        } else {
            echo "no";
        }
    }
    
    public function getReview(Request $request)
    {
        $reviewId = $request->input('id');
        
        $review = DB::table('user_rattings')->where('id',$reviewId )->first();

        // Return the review data as a JSON response
        return response()->json($review);
    }
    
    public function rattingeditform(Request $request)
    {
        
        $reviewId = $request->post('id');
        
        $review = DB::table('user_rattings')->where('id',$reviewId )->first();
        $review = DB::table('user_rattings')->where('id', $reviewId)->first();

        // Update the review data
        if ($review) {
            DB::table('user_rattings')->where('id', $reviewId)->update([
                'ratting' => $request->post('ratting'),
                'review' => $request->post('review'),
            ]);
        
        }

        // Return the review data as a JSON response
        return redirect()->back();
    }
    
    
    
    public function ratting(Request $request)
    {
        // $user_id = Session::get('USER_ID');
        // $organisation_ID = Session::get('organisation_ID');
        // if($user_id){
        //     $useremail = DB::table('users')->where('id', $user_id)->first()->email;
        // }else{
        //     $useremail = DB::table('user_representers')->where('id', $organisation_ID)->first()->email;
        // }
        DB::table('movie_rattings')->insert([
            'movie_id'=> $request->id,
            'email' => $request->ratting_email,
            'ratting' => $request->ratting,
            'review' => $request->review,
        ]);
        
      return redirect()->back();
    }
    
    public function userratting(Request $request)
    {
        
        $user_id = Session::get('USER_ID');
        $organisation_ID = Session::get('organisation_ID');
        if($user_id){
            $useremail = DB::table('users')->where('id', $user_id)->first()->email;
        }else{
            $useremail = DB::table('user_representers')->where('id', $organisation_ID)->first()->email;
        }
        // return $request->id;
        DB::table('user_rattings')->insert([
            'user_id'=> $request->id,
            'email' => $useremail,
            'ratting' => $request->ratting,
            'review' => $request->review,
        ]);
        
      return redirect()->back();
    }
    
    public function organisationuserratting(Request $request)
    {
        $user_id = Session::get('USER_ID');
        $organisation_ID = Session::get('organisation_ID');
        if($user_id){
            $useremail = DB::table('users')->where('id', $user_id)->first()->email;
        }else{
            $useremail = DB::table('user_representers')->where('id', $organisation_ID)->first()->email;
        }
        // return $request->id;
        DB::table('organisation_rattings')->insert([
            'organisation_id'=> $request->id,
            'email' => $useremail,
            'ratting' => $request->ratting,
            'review' => $request->review,
        ]);
        
      return redirect()->back();
    }
    
      public function institutes(){
        
      $result['institutes']=user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
    ->select('user_representers.*', 'states.name as state','cities.city as city' , 
        DB::raw('(SELECT COUNT(ratting) FROM organisation_rattings WHERE organisation_rattings.organisation_id = user_representers.id) as usercount'),
        DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM organisation_rattings WHERE organisation_rattings.organisation_id = user_representers.id) as userratting')
    )
    // ->leftjoin('user_representers', 'institutes.representers_id', '=', 'user_representers.id')
    ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id')
    //->orderBy('usercount', 'desc')
    ->orderBy('userratting', 'desc') // Explicitly specify order direction
    ->orderBy('created_at')
    ->where('user_representers.is_approved','1')
    ->paginate(12);
        
        $result['similar_institute']=user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
        ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id')
        ->select('user_representers.*', 'states.name as state','cities.city as city')
        ->where('user_representers.is_approved','0')
        ->paginate(12);

        // return $result['institutes'];
        $result['count'] = count($result['institutes']);
        $result['language']=language::all();
        
        $result['category']=Category::where('parent_id',null)->orderBy('category_name')->get();
        $result['city']=city::orderBy('city')->get();
        $result['state']=state::orderBy('name')->get();
        

        return view('front/institutes',$result);
    }

    public function institute_search(Request $request){
    
        $keyword = $request->get('keyword');
        $params = $request->all();
        // return $params;
        $params = array_filter($params, fn($value) => filled($value));
        // $result['institutes']=Institute::leftjoin('states', 'institutes.state_id', '=', 'states.id')
        // ->leftjoin('user_representers', 'institutes.representers_id', '=', 'user_representers.id')
        // ->leftjoin('cities', 'institutes.city_id', '=', 'cities.id')
        // ->select('institutes.*', 'states.name as state','cities.city as city')
        // ->where('institutes.title', 'like', '%' . $keyword . '%')
        // ->orwhere('institutes.about', 'like', '%' . $keyword . '%')
        // ->orwhere('states.name', 'like', '%' . $keyword . '%')
        // ->orwhere('cities.city', 'like', '%' . $keyword . '%')
        // ->where('institutes.is_approved','1')
        // ->where('institutes.status','1')
        // ->get();
        $query = 
        user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
        // ->leftjoin('user_representers', 'user_representerss.representers_id', '=', 'user_representers.id')
        ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id');
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                // Add where clause for non-empty parameters
                switch ($key) {
                    case 'keyword':
                        $query->where('user_representers.company', 'like', '%' . $keyword . '%');
                        $query->orwhere('user_representers.about_company', 'like', '%' . $keyword . '%');
                        $query->orwhere('states.name', 'like', '%' . $keyword . '%');
                        $query->orwhere('cities.city', 'like', '%' . $keyword . '%');
                        break;
                    case 'type':
                        $query->where('user_representers.type', $value);
                        break;
                    case 'state_id':
                        $query->where('user_representers.state_id', $value);
                        break;
                    case 'city_id':
                        $query->where('user_representers.city_id', 'LIKE', "%$value%");
                        break;
                }
            }
        }
        $query->select('user_representers.*', 'states.name as state','cities.city as city',
         DB::raw('(SELECT AVG(ratting) * COUNT(ratting)  FROM organisation_rattings WHERE organisation_rattings.organisation_id = user_representers.id) as userratting'));
        $query->where('user_representers.is_approved','1')->orderBy('userratting', 'desc') ;
        $result['institutes'] = $query->paginate(12);
        $result['count'] = count($result['institutes']);
        $result['category']=Category::where('parent_id',null)->get();
        $result['state']=state::all();
        $result['city']=city::all();
        
        return view('front/institutes',$result);
    }

    public function institute_detail($id){

        $result['institute_post']=user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
        ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id')
        ->select('user_representers.*', 'states.name as state','cities.city as city')
        ->where('user_representers.id',$id)
        ->where('user_representers.is_approved','1')
        ->first();
        
        
        $result['similar_institute']=user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
        ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id')
        ->select('user_representers.*', 'states.name as state','cities.city as city')
        ->where('user_representers.id','!=',$result['institute_post']->id)
        ->where('user_representers.is_approved','1')
        ->paginate(4);
         //return $result['similar_institute'];

        $result['galleryArr'] = representers_gallery::where('representers_id',$result['institute_post']->id)->get();
        
        $result['logo'] = user_representer::where('id',$id)->get()->first();
        
        $result['map_link'] = user_representer::where('id',$id)->get()->first();
        //return $result['map_link']->google_map_link;
       
        $result['videosarr'] = DB::table('representers_videos')->where('representers_id',$id)->get();
        
        $result['courseoffered'] = DB::table('courseoffereds')->where('representers_id',$id)->get();
       
        $result['category']=Category::where('parent_id',null)->get();
        
        
        
         $result['ratings'] = DB::table('organisation_rattings')
        ->leftjoin('user_representers','organisation_rattings.email','=','user_representers.email')
        ->leftjoin('users','organisation_rattings.email','=','users.email')
        ->select('user_representers.*','organisation_rattings.*','users.profile','users.username as talentUsername')
        ->where('organisation_id',$id)->get();
        
        
        $result['ratings_count'] = $result['ratings']->count();
        $result['ratings_average'] = number_format($result['ratings']->avg('ratting') , 1);

        // return $result;
        return view('front/institute_detail',$result);
    }
    
    public function categories(){
        $result['category']=Category::where('parent_id',null)->orderby('category_name')->get();
        
        foreach($result['category'] as $list){

            $cat_id = $list->id;
            $temp['id'] = $list->id;
            $temp['category_name'] = $list->category_name;
            $temp['category_slug'] = $list->category_slug;
            $temp['count'] = User::leftjoin('user_categories', 'users.id', '=', 'user_categories.user_id')
            ->leftjoin('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->where('user_categories.cat_id',$cat_id)
            ->where('users.status','1')
            ->count();
            // $temp['count'] = $count;
            $result['category_count'][] = $temp;
        }
         return view('front/categories',$result);
    }
        
    public function subscribe(Request $request){
        
       
        $existingEmail = DB::table('subscribe')->where('email', $request->post('email'))->first();

        if ($existingEmail) {
            // Email already exists, display error message or perform desired actions
            return response()->json(['success' => false,'msg' => 'You have alredy suscribed.']);
        } else {
            // Email doesn't exist, insert the new email
            DB::table('subscribe')->insert([
            'email' => $request->post('email'),
            ]);
        
            return response()->json(['success' => true,'msg' => 'Thank you. You have subscribed for Filmkar Newsletter.']);
        }
        
    }
    
    public function discussion()
    {
        return view('front/discussion');
    }
    
   
}
