<?php

namespace App\Http\Controllers\Api\V1\Talent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\User;
use App\Models\user_category;
use App\Models\user_gallery;
use App\Models\user_videos;
use App\Models\user_language;
use App\Models\user_representer;
use App\Models\user_social;
use App\Models\job_application;
use App\Models\job_posts;
use App\Models\Referral;
use App\Models\Referral_Representer;
use App\Models\user_attr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Mail\Eventapprovalmail;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class TalentAuthController extends Controller
{

   public function talent_register(Request $request){

        // return $request->post();
        
        $validator = Validator::make($request->all(), [
            'username'=>'required|unique:users',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'c_password'=>'required',
        ]);

        if ($validator->fails()) {
             $result['status'] = false;
             $result['data'] = $validator->errors()->first();
             return response()->json($result);
        }

        $username = $request->post('username');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $password = $request->post('password');
        $c_password = $request->post('c_password');

        if($password != $c_password){
             $result['status'] = false;
             $result['data'] = 'Please enter correct Confirm password';
             return response()->json($result);
        }

        $user = new User;
        $user->username = strtolower($username);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->email_varify = 1;
        $user->password = hash::make($password);
        $user->save();

       if($request->post('referral_code'))
       {
            $validatedData = $request->validate([
                'referral_code' => 'required|exists:users,referral_code',
            ]);
            $referral_code = $request->get('referral_code');
    
            if($referral_code != null){
                $referral = new Referral;
                $referral->referrer_id = $user->id;
                $referredUser = User::where('referral_code', $referral_code)->first();
                $referral->referred_id = $referredUser->id;
                $referral->save();
    
                $reffered_points = DB::table('points_setting')->where('key', 'per_reffered')->first()->value;
                $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
    
                DB::table('users')->where('id', $user->id)->update(['points' => $referrer_points]);
    
                $sum = $reffered_points + $referredUser->points;
                DB::table('users')->where('id', $referredUser->id)->update(['points' => $sum]);
            }else{
                $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
                DB::table('users')->where('id', $user->id)->update(['points' => '3']);
            }
       }


       
        // return "hii";
         $verificationUrl = "https://filmkar.com/varify?email=" . base64_encode($email)."&type=1";
        $details = [
            'username' => $username,
            'email' => $email,
            'subject' => "Varify email For Filmaker",
            'message' => "Please click the following link to verify your account: " . $verificationUrl

        ];
       Mail::to($email)->send(new Eventapprovalmail($details));
        // dd(\Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details)));
        // Session::flash('success', 'Mail Send successful!');
              
        // $request->session()->put('USER_ID',$user->id);
        // $request->session()->put('USER_NAME',$user->username);
        // return redirect('user/dashboard');
         $result['status'] = true;
         $result['data'] = 'Mail Send successful!';
         return response()->json($result);
    }
    
    public function talent_login(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
             $result['status'] = false;
             $result['data'] = $validator->errors()->first();
             return response()->json($result);
        }
          $email=$request->post('email');
        $password=$request->post('password');
        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $user=User::where(['email'=>$email])->first();
        
        
        if ($user) {
            if ($user->status == '0') {
                $result['status'] = false;
                $result['data'] = 'Your account is inactive. Please contact the admin.';
            } else {
                // Use strict comparison (===) to compare password hashes
                if (Hash::check($request->post('password'), $user->password)) {
                    $result['status'] = true;
                    $result['data']['user'] = $user;
                    $result['data']['language'] = $language;
                    $result['data']['state'] = $state;
                    $result['data']['city'] = $city;
                    $result['data']['category'] = $category;
                } else {
                    $result['status'] = false;
                    $result['data'] = 'Please enter the correct password.';
                }
            }
        } else {
            $result['status'] = false;
            $result['data'] = 'Please enter valid login details.';
        }
        
        // Always return a JSON response
        return response()->json($result);
    }
    
    public function getsingaltalent(Request $request){
        $user=User::where(['id'=>$request->post('user_id')])->first();
        $category=Category::all();
        $language=language::all();
        $state=state::query()->orderBy('name','ASC')->get();
        $city=city::query()->orderBy('city','ASC')->get();
        $user_attr=user_attr::where('user_id',$request->post('user_id'))->first();
         $user_language = user_language::where('user_id',$request->post('user_id'))->get();
         $user_category = user_category::where('user_id',$request->post('user_id'))->get();
        if($user) {
            $result['status'] = true;
            $result['data']['user'] = $user;
            $result['data']['language'] = $language;
            $result['data']['state'] = $state;
            $result['data']['city'] = $city;
            $result['data']['category'] = $category;
            $result['data']['user_attr'] = $user_attr == null ? [] : $user_attr;
            $result['data']['user_language'] = $user_language == null ? [] : $user_language;
            $result['data']['user_category'] = $user_category == null ? [] : $user_category;
        }else{
            $result['status'] = true;
            $result['data']['user'] = [];
            $result['data']['language'] = [];
            $result['data']['state'] = [];
            $result['data']['city'] = [];
            $result['data']['category'] = [];
            $result['data']['user_attr'] = [];
            $result['data']['user_language'] = [];
            $result['data']['user_category'] = [];
        }
        return response()->json($result);
    }
    
    public function getallstate(){
        $state=state::orderBy('name','ASC')->get();
        if($state) {
            $result['status'] = true;
            $result['data'] = $state;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
     public function getalllanguage(){
        $language=language::orderBy('language','ASC')->get();
        if($language) {
            $result['status'] = true;
            $result['data'] = $language;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function getallcitybystateID(Request $request){
        $city = city::where('state_id',$request->post('state_id'))->orderBy('city','ASC')->get();
        if($city) {
            $result['status'] = true;
            $result['data'] = $city;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function getallcategory(){
        $Category=Category::where('parent_id',null)->orderBy('category_name','ASC')->get();
        if($Category) {
            $result['status'] = true;
            $result['data'] = $Category;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function getallsubcatbycatID(Request $request){
        $Category = Category::orderBy('category_name','ASC')->where('parent_id',$request->post('parent_id'))->get();
        if($Category) {
            $result['status'] = true;
            $result['data'] = $Category;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function gettalentvideolist(Request $request){
        $uservideos=DB::table('user_videos')->where('user_id',$request->post('user_id'))->simplePaginate(10);
        if($uservideos) {
            $result['status'] = true;
            $result['data'] = $uservideos;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function gettalentimageslist(Request $request){
        $user_galleries=DB::table('user_galleries')->where('user_id',$request->post('user_id'))->simplePaginate(10);
        $user=User::where(['id'=>$request->post('user_id')])->first();
        if($user_galleries) {
            $result['status'] = true;
            $result['path'] = 'https://filmkar.com/assets/gallery/'.$user->username.'/';
            $result['data'] = $user_galleries;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function gettalentsociallink(Request $request){
        $user_socials=DB::table('user_socials')->where('user_id',$request->post('user_id'))->get();
        if($user_socials) {
            $result['status'] = true;
            $result['data'] = $user_socials;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function gettalentappliedjobs(Request $request){
        $arr=User::where(['id'=>$request->post('user_id')])->get();

        $applied_jobs=DB::table('job_posts')->leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('job_applications', 'job_posts.id', '=', 'job_applications.job_posts_id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city')
        ->where('job_applications.user_id',$request->post('user_id'))
        ->simplePaginate(10);

        if($applied_jobs) {
            $result['status'] = true;
            $result['data'] = $applied_jobs;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    public function talentchangepassword(Request $request){

        $id = $request->post('user_id');
        $password = $request->post('password');

        $user=User::find($id);
        if($user){
            $user->password = hash::make($password);
            $user->save();
            $result['status'] = true;
            $result['data'] = 'Password has been Updated!';

        }else{
            $result['status'] = false;
            $result['data'] = 'Password not Updated!';
        }
        return response()->json($result);
    }
    
    public function updatetalentprofile(Request $request){
        
        // return $request->post();
        $validator = Validator::make($request->all(), [
            'username'=>'required|unique:users,username,'.$request->post('user_id'),
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users,email,'.$request->post('user_id'),
            'phonenumber'=>'required',
            'whatsapp_no' => 'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'gender'=>'required',
            // 'languages'=>'required',
            // 'birthdate'=>'required',
            'year_of_experience'=>'required'
            ]);
            
    
    
        if ($validator->fails()) {
            //  $request->session()->flash('error',$validator->errors()->first());
            //     return redirect('user/manage_profile');
            
             $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            return response()->json($result);
                
                
        }

        $id = $request->post('user_id');
        $username = $request->post('username');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $is_email_enable = $request->post('is_email_enable');
        $phonenumber = $request->post('phonenumber');
        $whatsapp_no = $request->post('whatsapp_no');
        $is_phoneno_enable = $request->post('is_phoneno_enable');
        $is_birthdate_enable = $request->post('is_birthdate_enable');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $gender = $request->post('gender');
         $categories = $request->post('categories');
         
        // return $categories;
        // if($categories ==  null){
        //     // $request->session()->flash('error','You need to atleast choose one category!');
        //     // return redirect('user/manage_profile');
            
        //     $result['status'] = false;
        //     $result['message'] = "You need to atleast choose one category!";
        //     return response()->json($result);
        // }
        
          $languages = $request->post('language');
        if($languages ==  null){
            // $request->session()->flash('error','You need to atleast choose one language!');
            // return redirect('user/manage_profile');
            
            $result['status'] = false;
            $result['message'] = "You need to atleast choose one language!";
            return response()->json($result);
        }
        
        $birthdate = $request->post('birthdate');
        $year_of_experience = $request->post('year_of_experience');
        $about_you = $request->post('about_you');

        $eyecolor = $request->post('eyecolor');
        $haircolor = $request->post('haircolor');
        $dresssize = $request->post('dresssize');
        $shoesize = $request->post('shoesize');
        $hairtype = $request->post('hairtype');
        $talent_height_in_CM = $request->post('talent_height_in_CM');
        $waist_in_CM = $request->post('waist_in_CM');
        $attr_id = $request->post('attr_id');
        // return $attr_id;
        $user = User::find($id);
        if($username != $user->username){
            $currentFolderPath = 'assets/gallery/'.$user->username;
            $newFolderPath = 'assets/gallery/'.$username;
            rename($currentFolderPath, $newFolderPath);
        }
        
         if($user->email != $email){
             $verificationUrl = "https://filmkar.com/user/changeemail?email=" . base64_encode($email)."";
            $details = [
                'username' => $username,
                'email' => $email,
                'subject' => "Varify email For Filmaker",
                'message' => "Please click the following link to verify your email: " . $verificationUrl
    
            ];
           
            \Mail::to($email)->send(new \App\Mail\mailchange($details));
        
            $result['status'] = true;
            $result['message'] = "Check your mail for change mail.";
            return response()->json($result);
            
        }
        $user->username = strtolower($username);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->is_email_enable = $is_email_enable == null ? '0' : '1';
        $user->phonenumber = $phonenumber;
        $user->is_phoneno_enable = $is_phoneno_enable == null ? '0' : '1';
        $user->is_birthdate_enable = $is_birthdate_enable == null ? '0' : '1';
        $user->whatsapp_no = $whatsapp_no;
        $user->password = $user->password;
        $user->state_id = $state_id;
        $user->city_id = $city_id;
        $user->gender = $gender;
        $user->birthdate = $birthdate;
        $user->year_of_experience = $year_of_experience;
        $user->about_you = $about_you == null ? '' : $about_you;
        $user->status='2';
        $user->save();

        if($eyecolor != '' && $haircolor != '' && $dresssize != '' && $shoesize != '' && $hairtype != '' 
        && $talent_height_in_CM != '' && $waist_in_CM != ''){

            if($attr_id != ""){
                $user_attr = user_attr::find($attr_id);
                $user_attr->user_id = $user->id;
                $user_attr->eyecolor = $eyecolor;
                $user_attr->haircolor = $haircolor;
                $user_attr->dresssize = $dresssize;
                $user_attr->shoesize = $shoesize;
                $user_attr->hairtype = $hairtype;
                $user_attr->talent_height_in_CM = $talent_height_in_CM;
                $user_attr->waist_in_CM = $waist_in_CM;
                $user_attr->save();
            }else{
                $user_attr = new user_attr;
                $user_attr->user_id = $user->id;
                $user_attr->eyecolor = $eyecolor;
                $user_attr->haircolor = $haircolor;
                $user_attr->dresssize = $dresssize;
                $user_attr->shoesize = $shoesize;
                $user_attr->hairtype = $hairtype;
                $user_attr->talent_height_in_CM = $talent_height_in_CM;
                $user_attr->waist_in_CM = $waist_in_CM;
                $user_attr->save();
            }
        }

        $user_category = user_language::where('user_id',$id)->wherenotin('language_id',$languages)->delete();
    
        foreach($languages as $list){
            $user_language = user_language::where('user_id',$id)->where('language_id',$list)->first();

            if(!$user_category){
                $user_language = new user_language;
                $user_language->user_id = $id;
                $user_language->language_id = $list;
                $user_language->save();
            }
            else{
                $user_language->user_id = $id;
                $user_language->language_id = $list;
                $user_language->save();
            }
        }

        $user_category = user_category::where('user_id',$id)->wherenotin('cat_id',$categories)->delete();


        foreach($categories as $list){
            $user_category = user_category::where('user_id',$id)->where('cat_id',$list)->first();

            $is_attr_category = Category::where('is_attr','1')->first();
            // return $is_attr_category->category_name;
            $isattrcategoryname[] = $is_attr_category->id;


            $category_name = Category::where('id',$list)->first();

            $categoryname[] = $category_name->id;


            if(!$user_category){
                $user_category = new user_category;
                $user_category->user_id = $id;
                $user_category->cat_id = $list;
                $user_category->save();
            }
            else{
                $user_category->user_id = $id;
                $user_category->cat_id = $list;
                $user_category->save();
            }
            
        }
        // return $categoryname;


        if( !empty(array_intersect($isattrcategoryname, $categoryname))){

            // user_attr::where('user_id',$id)->delete();
        }else{
            user_attr::where('user_id',$id)->delete();
        }

         $verificationUrl = "https://digitalbhuro.com/varify?email=" . base64_encode($email)."&type=1";
        $details = [
            'username' => $username,
            'email' => $email,
            'subject' => "Varify email For Filmaker",
            'message' => "Please click the following link to verify your account: " . $verificationUrl

        ];
       
        \Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details));
        // Session::flash('success', 'Mail Send successful!');
              
        // $request->session()->put('USER_ID',$user->id);
        // $request->session()->put('USER_NAME',$user->username);
        
        // $request->session()->flash('message','Profile has been Updated!');
        
        $result['status'] = true;
        $result['message'] = "Profile has been Updated!";
        return response()->json($result);
    }
    
    
     public function uploadimage(Request $request){

        $user_id = $request->post('user_id');
        // return $request->post();
        $arr=User::where(['id'=>$user_id])->first(); 
        

        if ($request->hasfile('image')) {
           
            
            foreach ($request->file('image') as $file) {
                
            $x = 1;
            $file_name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $directory = public_path('assets/gallery/' . $arr->username);
                
            // Check if the directory exists, and if not, create it.
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            
            $filePath = $directory . '/' . $file_name;
            $img = \Image::make($file);
            $img->save($filePath, 30);
    
                $user_gallery = new user_gallery;
                $user_gallery->user_id =  $user_id;
                $user_gallery->image = $file_name;
                $user_gallery->save();
            }
            $result['status'] = 1;
            $result['message'] = "Profile has been Updated!";
        }else{
             $result['status'] = 0;
            $result['message'] = "Profile has not been Updated!";
        }
        
        return response()->json($result);
    }
    
    public function gallerydelete(Request $request){
        
        $id = $request->post('id');
     

        $query = user_gallery::where('id',$id)->delete();
        if($query == 1){
            $result['status'] = 1;
            $result['message'] = "Photo Deleted!";
        }else{
            $result['status'] = 0;
            $result['message'] = "something went wrong!";
        }
        return response()->json($result);
    }
    
      public function videodelete(Request $request){
        
        $id = $request->post('id');
     

        $query = user_videos::where('id',$id)->delete();
        if($query == 1){
            $result['status'] = 1;
            $result['message'] = "video Deleted!";
        }else{
            $result['status'] = 0;
            $result['message'] = "something went wrong!";
        }
        return response()->json($result);
    }
    
    
    public function uploadvideo(Request $request)
    {
        $id = $request->post('id');
        $user_id = $request->post('user_id');
        $videoarr = $request->post('video_link');
        // $user_id = Session::get('user_id');
    
        $request->validate([
            'video_link' => 'required|array',
        ]);
       
    
        foreach ($videoarr as $index => $video) {
           
            $str = $video;
            $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
    
            if (preg_match($pattern, $str)) {
                // $model=user_videos::find($user_id);
                if ($index > 0) {
                    $model=user_videos::find($index);
                    $model->video_link=$video;
                    $model->save();

                }else{
                    $model=new user_videos();
                    $model->user_id=$user_id;
                    $model->video_link=$video;
                    $model->save();
                }
            } else {
                $result['status'] = 0;
                $result['message'] = "Invalid video link format for $video";
            }
        }
        $result['status'] = 1; // Default to success
        $result['message'] = "Profile has been Updated!";
        return response()->json($result);
    }
    
    
    public function updateuploadvideo(Request $request)
    {
        $id = $request->post('id');
        $videoarr = $request->post('video_link');
    
        $str = $videoarr;
        $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
    
        if (preg_match($pattern, $str)) {
          
            DB::table('user_videos')
                ->where('id', $id)
                ->update(['video_link' => $videoarr]);
    
            $result['status'] = 1; // Default to success
            $result['message'] = "Video has been Updated!";
        } else {
            $result['status'] = 0; // Set status to 0 for failure
            $result['message'] = "Invalid video link format!";
        }
    
        return response()->json($result);
    }


    public function uploadsocialmedialink(Request $request){
        // return $request->post();

        $user_id = $request->post('user_id');
        // return $user_id;
        
        $request->post('social_id')>0;
        $user_social=user_social::where(['user_id'=>$user_id])->first();
        $user_social->user_id = $user_id;
        $user_social->facebook = $request->post('facebook');
        $user_social->instagram = $request->post('instagram');
        $user_social->linkedin = $request->post('linkedin');
        $user_social->twitter = $request->post('twitter');
        $user_social->save();
        
        
         $result['status'] = 1;
        $result['message'] = "Social Media has been Updated!";
        return response()->json($result);
        
    }
    
    public function joblist(Request $request){

        $result['category']=Category::where('parent_id',null)->get();

        $user_id = $request->post('user_id');
        $arr=User::where(['id'=>$user_id])->get();
        $result['id']=$arr['0']->id;
        $result['email_varify']=$arr[0]->email_varify;
        $result['profile']=$arr['0']->profile;
        $result['username']=$arr['0']->username;

        // $result['applied_jobs'] = job_application::
        // leftjoin('users', 'job_applications.user_id', '=', 'users.id')
        // ->leftjoin('job_posts', 'job_applications.job_posts_id', '=', 'job_posts.id')
        // ->select('job_posts.*')
        // ->where('job_applications.user_id',$USER_ID)
        // ->get();

        $result['applied_jobs']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('job_applications', 'job_posts.id', '=', 'job_applications.job_posts_id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->select('job_posts.*', 'states.name as state','cities.city as city')
        ->where('job_applications.user_id',$user_id)
        ->paginate(3);

        // return $result['applied_users']; 
        // return view('front/user/applied_job_list', $result);
        
         return response()->json($result);
    }
    
    
     public function profilechangepassword(Request $request){

        // $request->validate([
        //     'current_password'=>'required',
        //     'password'=>'required',
        //     'c_password'=>'required',
        // ]);

        $user_id = $request->post('user_id');
        $current_password = $request->post('current_password');
        $password = $request->post('password');
        $c_password = $request->post('c_password');

        $oldpassuser=User::find($user_id);
        
        if($oldpassuser){
            if(Hash::check($current_password,$oldpassuser->password)){
                
                
                if($password != $c_password){
                    // $request->session()->flash('error','');
                    // return redirect('user/confirm_password');
                    
                    $result['status'] = 0;
                    $result['message'] = "Please enter correct Confirm password";
                    return response()->json($result);
                    
                }else{
                    $user = User::find($user_id);
                    $user->password = hash::make($password);
                    $user->save();
                   
                    $result['status'] = 1;
                    $result['message'] = "Password has been Updated";
                    return response()->json($result); 
                }

            }else{
                $result['status'] = 0;
                $result['message'] = "Current password does not match!";
                return response()->json($result);
            }
        }
        
    }
    
}
