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
use App\Models\representers_videos;
use App\Models\user_social;
use App\Models\Admin\event_category;
use App\Models\Event;
use App\Models\job_application;
use App\Models\Admin\representer;
use App\Models\movie;
use App\Models\job_posts;
use App\Models\Referral;
use App\Models\Referral_Representer;
use App\Models\representers_gallery;
use Illuminate\Support\Facades\File;
use App\Models\courseoffered;
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

class OrganisationController extends Controller
{
    
    public function orggetporfiledata(Request $request){
       
         
        $user_id = $request->post('user_id');
        $arr=user_representer::where(['id'=>$user_id])->get(); 
        $result['type']=$arr['0']->type;
        $result['organize_user'] = user_representer::where(['id'=>$user_id])->first(); 

        $result['representers'] = representer::all();

        $result['usercity']= city::join('user_representers', 'cities.id', '=', 'user_representers.city_id')
            ->select('cities.*')
            ->where('user_representers.id', $user_id)
            ->first();
        $result['cityarr']= city::join('user_representers', 'cities.state_id', '=', 'user_representers.state_id')
            ->select('cities.*')
            ->where('user_representers.id', $user_id)
            ->get();
        $result['state']=state::orderby('name')->get();
        $result['category']=Category::where('parent_id',null)->orderby('category_name')->get();
        
        
          return response()->json($result);

    }
    
    public function getrepresenter(){
       $representer['representers'] = representer::all();
        if($representer) {
            $result['status'] = true;
            return response()->json($representer);
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
     public function JobTypePaymentDuration(){
       $representer['representers'] = representer::all();
        if($representer) {
            $result['status'] = true;
            return response()->json($representer);
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }
        return response()->json($result);
    }
    
    
    
    public function orggetjobposts(Request $request){

        $user_id = $request->post('user_id');

        $arr=user_representer::where(['id'=>$user_id])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;
        $result['category']=Category::where('parent_id',null)->get();

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftJoin('job_applications', 'job_posts.id', '=', 'job_applications.job_posts_id')
        ->select('job_posts.*', 'states.name as state','cities.city as city', DB::raw('(SELECT COUNT(*) FROM job_applications WHERE job_applications.job_posts_id = job_posts.id) AS num_applications'))
        ->where('job_posts.representers_id',$result['id'])
        ->distinct()
        ->latest('job_posts.created_at')
        ->paginate(3);

        return response()->json($result);
    }
    
    
      public function orggetjobsingleposts(Request $request){

        $user_id = $request->post('user_id');

        $result['job_posts']=job_posts::leftjoin('states', 'job_posts.state_id', '=', 'states.id')
        ->leftjoin('cities', 'job_posts.city_id', '=', 'cities.id')
        ->leftJoin('job_applications', 'job_posts.id', '=', 'job_applications.job_posts_id')
        ->select('job_posts.*', 'states.name as state','cities.city as city', DB::raw('(SELECT COUNT(*) FROM job_applications WHERE job_applications.job_posts_id = job_posts.id) AS num_applications'))
        ->where('job_posts.id',$request->post('id'))
        ->distinct()
        ->latest('job_posts.created_at')
        ->first();


        $result['status'] = true;
        $result['message'] = "Single Post sccess!";
        return response()->json($result);
    }
    
    public function orgsinglegeteventposts(Request $request){

        $user_id = $request->post('user_id');

        $result['event_posts']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->select('events.*', 'states.name as state','cities.city as city')
        ->where('events.id',$request->post('id'))
        ->orderBy('events.created_at', 'desc')
        ->paginate(3);

        return response()->json($result);
    }
    
     public function orggetcourseoffered(Request $request){
         
       
        $user_id = $request->post('user_id');
        // $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$user_id])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;

        $result['corsearr']=courseoffered::where('representers_id',$user_id)->get();


        // return view('front/organize/course_offered', $result);
         $result['status'] = true;
        $result['message'] = "course offered sccess!";
        return response()->json($result);

    }
      
      public function orggeteventposts(Request $request){

        $user_id = $request->post('user_id');

        $arr=user_representer::where(['id'=>$user_id])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;
        $result['event_category']=event_category::all();
        $result['category']=Category::where('parent_id',null)->get();

        $result['event_posts']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->select('events.*', 'states.name as state','cities.city as city')
        ->where('events.representers_id',$result['id'])
        ->orderBy('events.created_at', 'desc')
        ->paginate(3);

        return response()->json($result);
    }
    
       public function orggetmovieposts(Request $request){
       
        $user_id = $request->post('user_id');

        // $result['category']=Category::where('parent_id',null)->get();
        
        $result = Movie::where('representers_id',$user_id)->orderBy('created_at', 'desc')->paginate(3);
        
        return response()->json($result);
   }
   
     public function orggetsinglemovie(Request $request){
       
        $id = $request->post('id');

        // $result['category']=Category::where('parent_id',null)->get();
        
        $result = Movie::where('id',$id)
        ->orderBy('created_at', 'desc')->paginate(3);
        
        return response()->json($result);
   }
   

    // public function orggetgallery(Request $request)
    // {
    //     $user_id = $request->post('user_id');
    
    //     $galleries = DB::table('representers_galleries')
    //      ->where('representers_id', $user_id)
    //      ->get();
       
    //     return response()->json($galleries);
    // }
    
    
    
    public function orggetgallery(Request $request){
        
        $representers_galleries = DB::table('representers_galleries')->where('representers_id', $request->post('id'))->simplePaginate(10);
        $user = user_representer::where('id', $request->post('id'))->first();
        
        if ($representers_galleries->isNotEmpty()) {
            $result['status'] = true;
            $result['path'] = url('/').'/assets/organize/gallery/'.$user->username.'/';
            $result['data'] = $representers_galleries;
        
        } else {
            $result['status'] = false;
            $result['data'] = [];
        }
        
        return response()->json($result);

    }
    
     public function orggetvideos(Request $request,$id=''){
        $user_id = $request->post('user_id');
       
        $result['videosArr'] = DB::table('representers_videos')
        ->where('representers_id', $user_id)
        ->get();


        // return $result['videosArr'];

        return response()->json($result);

    }
    
    public function orggetchangepasswordprocess(Request $request){

        $request->validate([
            'current_password'=>'required',
            'password'=>'required',
            'c_password'=>'required',
        ]);

        $user_id = $request->post('user_id');
        $current_password = $request->post('current_password');
        $password = $request->post('password');
        $c_password = $request->post('c_password');

        $result=user_representer::find($user_id);
        if($result){
            if(Hash::check($current_password,$result->password)){
                
                if($password != $c_password){

                    // $request->session()->flash('error','Please enter correct Confirm password');
                    // return redirect('organize/confirm_password');
                    $result['status'] = false;
                    $result['message'] = "Please enter correct Confirm password";
                    return response()->json($result);
                }else{
                    $user = user_representer::find($user_id);
                    $user->password = hash::make($password);
                    $user->save();
                    // $request->session()->flash('message','Password has been Updated!');
                    // return redirect('organize/confirm_password');
                    $result['status'] = true;
                    $result['message'] = "Password has been Updated!";
                    return response()->json($result);
                }

            }else{
                // $request->session()->flash('error','Current password does not match!');
                // return redirect()->back();
                $result['status'] = false;
                $result['message'] = "Current password does not match!";
                return response()->json($result);
            }
        }
        
    }
    
    public function orgupdateprofile(Request $request){
        
        
        //  return $request->all();
        
        $user_id = $request->post('user_id');
        $username = $request->post('username');

        // request()->validate([
        //     'username' => 'required|unique:user_representers,username,'.$request->input('id'),
        //     'email' => 'required|unique:user_representers,email,'.$request->input('id'),
           
        // ]);
        
        
    //   $user_representer = user_representer::orwhere('username', '=', $request->input('username'))
    //     ->orwhere('email', '=', $request->input('email'))
    //     ->where('id', '!=', $request->input('id'))
    //     ->first();
        
    //     if($user_representer){
           
    //          $request->session()->flash('error',"This email or username alredy been taken."   );
        
    //         return redirect('organize/manage_profile');
    //     }

        // $id = $request->post('id');
        // $username = $request->post('username');
        $email = $request->post('email');
        $company = $request->post('company');
        $representer_id = $request->post('representer_id');
        $about_company = $request->post('about_company');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $zipcode = $request->post('zipcode');
        $website = $request->post('website');
        $phone_no = $request->post('phone_no');
        $whatsapp_no = $request->post('whatsapp_no');
        $address = $request->post('address');
        $google_map_link = $request->post('google_map_link');

        

        $user_representer = user_representer::find($user_id);
        
        // if($user_representer->email != $email){
        //      $verificationUrl = "https://filmkar.com/organize/changeemail?email=" . base64_encode($email)."";
        // $details = [
        //     'username' => $username,
        //     'email' => $email,
        //     'subject' => "Varify email For Filmaker",
        //     'message' => "Please click the following link to verify your email: " . $verificationUrl

        // ];
       
        // \Mail::to($email)->send(new \App\Mail\mailchange($details));
        //     $request->session()->flash('message',"Check your mail for change mail."   );
        
        //     return redirect('organize/manage_profile');
        // }

        if($request->hasfile('logo')){

            if($request->post('id')>0){
                $arrImage=DB::table('user_representers')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/institute/logo' .$arrImage[0]->logo;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            // $file=$request->file('logo');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/institute/logo/';
            // $file->move($upload_path, $name);
            // $user_representer->logo=$name == null ? $request->post('logo') : $name;
            
            $x=1;
            $file=$request->file("logo");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/institute/logo/' . $file_name);
            $img->save($filePath, 30);
            $user_representer->logo=$file_name == null ? $request->post('logo') : $file_name;
        }

        if($request->hasfile('thumbnail')){

            if($request->post('id')>0){
                $arrImage=DB::table('user_representers')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/institute/thumbnail/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            // $file=$request->file('thumbnail');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/institute/thumbnail/';
            // $file->move($upload_path, $name);
            // $user_representer->thumbnail=$name == null ? $request->post('thumbnail') : $name;
            
            
            $x=1;
            $file=$request->file("thumbnail");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/institute/thumbnail/' . $file_name);
            $img->save($filePath, 30);
            $user_representer->thumbnail=$file_name == null ? $request->post('thumbnail') : $file_name;
        }

        $user_representer->username = $username;
        $user_representer->email = $email;
        $user_representer->company = $company;
        $user_representer->representer_id = $representer_id;
        $user_representer->about_company = $about_company;
        $user_representer->state_id = $state_id;
        $user_representer->city_id = $city_id;
        $user_representer->zipcode = $zipcode;
        $user_representer->website = $website;
        $user_representer->phone_no = $phone_no;
        $user_representer->whatsapp_no = $whatsapp_no;
        $user_representer->address = $address;
        $user_representer->google_map_link = $google_map_link;
        $user_representer->is_approved = '0';
        $user_representer->save();
        
        // $verificationUrl = "https://filmkar.com/varify?email=" . base64_encode($email)."&type=2";
        // $details = [
        //     'username' => $username,
        //     'email' => $email,
        //     'subject' => "Varify email For Filmaker",
        //     'message' => "Please click the following link to verify your account: " . $verificationUrl

        // ];
       
        // \Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details));
        // Session::flash('success', 'Mail Send successful!');
        $result['status'] = true;
        $result['message'] = "Mail Send successful!";
        
        // $request->session()->put('organisation_ID',$user_representer->id);
        // $request->session()->put('organisation_NAME',$user_representer->username);
        
        //  $request->session()->flash('message',"Thanks for the updates! It's been submitted to admin for approval."   );
        
        // return redirect('organize/manage_profile');

        $result['status'] = true;
        $result['message'] = "Profile has been Updated!";
        return response()->json($result);
    }
    
    public function orgupdatejob(Request $request){
    
        // return $request->post();

        // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     'job_role_id'=>'required',
        //     'job_type'=>'required',
        //     'gender'=>'required',
        //     'MinAge'=>'required',
        //     'MaxAge'=>'required',
        //     'audition_required'=>'required',
        //     'budget'=>'required',
        //     'budget_duration'=>'required',
        //     'last_date'=>'required',
        //     'job_start'=>'required',
        //     // 'job_end'=>'required',
        //     'No_of_vacancies'=>'required',
        //     'state_id'=>'required',
        //     'city_id'=>'required',
        //     'tags'=>'required',
        // ]);
       $user_id = $request->post('user_id');

        if($request->post('user_id')>0){
            $model=job_posts::find($request->post('user_id'));
            $msg="Thank you for update Job. Your Job will be live after Admin approval.";
            $model->slug=$model->slug;
        }else{
            $model=new job_posts();
            $msg="Thank you for uploading new Job. Your Job will be live after Admin approval.";
            $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
            $model->slug=$slug;

            $per_job = DB::table('points_setting')->where('key','per_job')->first()->value;
            $points = DB::table('user_representers')->where('id',$user_id)->first()->points;

            $sum = $points - $per_job;
             DB::table('user_representers')->where('id', $user_id)->update(['points' => $sum]);
        }
    
        $model->representers_id=$user_id;
        $model->title=$request->post('title');
        $model->description=$request->post('description');
        $model->job_role_id=$request->post('job_role_id');
        $model->job_type=$request->post('job_type');
        $model->gender=$request->post('gender');
        $model->MinAge=$request->post('MinAge');
        $model->MaxAge=$request->post('MaxAge');
        $model->budget=$request->post('budget');
        $model->budget_duration=$request->post('budget_duration');
        $model->last_date=$request->post('last_date');
        $model->job_start=$request->post('job_start');
        $model->job_end=$request->post('job_end');
        $model->No_of_vacancies=$request->post('No_of_vacancies');
        $model->state_id=$request->post('state_id');
        $model->city_id=$request->post('city_id');
        $model->phone_no=$request->post('phone_no');
        $model->zipcode=$request->post('zipcode');
        $model->tags=$request->post('tags');
        $model->status=0;
        $model->save();

        // $request->session()->flash('message',$msg);
        // return redirect('organize/job_posts');
        
        $result['status'] = true;
        $result['message'] = "Job has been Updated!";
        return response()->json($result);
    }
    
    public function orginsertjob(Request $request){

    // $request->validate([
    //     'title'=>'required',
    //     'description'=>'required',
    //     'job_role_id'=>'required',
    //     'job_type'=>'required',
    //     'gender'=>'required',
    //     'MinAge'=>'required',
    //     'MaxAge'=>'required',
    //     'audition_required'=>'required',
    //     'budget'=>'required',
    //     'budget_duration'=>'required',
    //     'last_date'=>'required',
    //     'job_start'=>'required',
    //     'No_of_vacancies'=>'required',
    //     'state_id'=>'required',
    //     'city_id'=>'required',
    //     'tags'=>'required',
    // ]);

    $user_id = $request->post('user_id');

    $model = new job_posts();
    $msg = "Thank you for uploading new Job. Your Job will be live after Admin approval.";

    $slug = strtolower(str_replace(' ', '-', $request->post('title'))) . time() . rand(1, 100);
    $model->slug = $slug;

    $per_job = DB::table('points_setting')->where('key', 'per_job')->first()->value;
    $points = DB::table('user_representers')->where('id', $user_id)->first()->points;

    $sum = $points - $per_job;
    DB::table('user_representers')->where('id', $user_id)->update(['points' => $sum]);

    $model->representers_id = $user_id;
    $model->title = $request->post('title');
    $model->description = $request->post('description');
    $model->job_role_id = $request->post('job_role_id');
    $model->job_type = $request->post('job_type');
    $model->gender = $request->post('gender');
    $model->MinAge = $request->post('MinAge');
    $model->MaxAge = $request->post('MaxAge');
    $model->audition_required = $request->post('audition_required');
    $model->budget = $request->post('budget');
    $model->budget_duration = $request->post('budget_duration');
    $model->last_date = $request->post('last_date');
    $model->job_start = $request->post('job_start');
    $model->job_end = $request->post('job_end');
    $model->No_of_vacancies = $request->post('No_of_vacancies');
    $model->state_id = $request->post('state_id');
    $model->city_id = $request->post('city_id');
    $model->phone_no = $request->post('phone_no');
    $model->zipcode = $request->post('zipcode');
    $model->tags = $request->post('tags');
    $model->status = 0;
    $model->save();

    $result['status'] = true;
    $result['message'] = "Job has been inserted!";
    return response()->json($result);
}

    
    
    public function orginsertevent(Request $request){

   
    $user_id = $request->post('user_id');

    $model = new Event();
    $msg = "Thank you for uploading new event. Your Job will be live after Admin approval.";

    $slug = strtolower(str_replace(' ', '-', $request->post('title'))) . time() . rand(1, 100);
    $model->is_approved = '0';
    $model->slug = $slug;

    if ($request->hasfile('thumbnail')) {
        $x = 1;
        $file = $request->file("thumbnail");
        $file_name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img = \Image::make($file);
        $filePath = public_path('assets/event/thumbnail/' . $file_name);
        $img->save($filePath, 30);
        $model->thumbnail = $file_name;
    }

    if ($request->post('event_type') == 'online') {
        $model->address = '';
        $model->pin_code = '';
        $model->phone_number = '';
        $model->state_id = null;
        $model->city_id = null;
        $model->email = '';
    } else {
        $model->address = $request->post('address');
        $model->pin_code = $request->post('pin_code');
        $model->event_venue = $request->post('event_venue');
        $model->phone_number = $request->post('phone_number');
        $model->state_id = $request->post('state_id');
        $model->city_id = $request->post('city_id');
        $model->email = $request->post('email');
    }

    $model->representers_id = $user_id;
    $model->event_cat_id = $request->post('event_cat_id');
    $model->title = $request->post('title');
    // $model->event_type = $request->post('event_type');
    $model->start_date = $request->post('start_date');
    $model->end_date = $request->post('end_date');
    $model->start_time = $request->post('start_time');
    $model->end_time = $request->post('end_time');
    $model->price = $request->post('price');
    $model->about_event = $request->post('about_event');
    $model->tags = $request->post('tags');
    $model->status = 1;
    $model->is_approved = 0;
    $model->save();

    $result['status'] = true;
    $result['message'] = "Job has been inserted!";
    return response()->json($result);
}

    
    
    
    
    public function orgupdateevent(Request $request){


        // return $request->post();
        // $request->validate([
        //     'title'=>'required',
        //     'start_date'=>'required',
        //     'end_date'=>'required',
        //     'start_time'=>'required',
        //     'end_time'=>'required',
        //     'price'=>'required',
        //     'about_event'=>'required',
        //     'tags'=>'required',
        // ]);

        $user_id = $request->post('user_id');
        if($request->post('user_id')>0){
            $model=Event::find($request->post('user_id'));
            $msg="Thank you for update event. Your Event will be live after Admin approval.";
            $model->slug=$model->slug;
        }else{
            $model=new Event();
            $msg="Thank you for uploading new event. Your Job will be live after Admin approval.";
            $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
            $model->is_approved='0';
            $model->slug=$slug;
        }

        if($request->hasfile('thumbnail')){

            if($request->post('user_id')>0){
                $arrImage=DB::table('events')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/event/thumbnail/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }
    
            $x=1;
            $file=$request->file("thumbnail");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/event/thumbnail/' . $file_name);
            $img->save($filePath, 30);
            $model->thumbnail=$file_name == null ? $request->post('thumbnail') : $file_name;
        }
        if($request->post('event_type') == 'online'){
            $model->address='';
            $model->pin_code='';
            $model->phone_number='';
            $model->state_id=null;
            $model->city_id=null;
            $model->email='';
        }else{
            $model->address=$request->post('address');
            $model->pin_code=$request->post('pin_code');
            $model->event_venue=$request->post('event_venue');
            $model->phone_number=$request->post('phone_number');
            $model->state_id=$request->post('state_id');
            $model->city_id=$request->post('city_id');
            $model->email=$request->post('email');
        }
        
        $model->representers_id=$user_id;
        $model->event_cat_id=$request->post('event_cat_id');
        $model->title=$request->post('title');
        $model->event_type=$request->post('event_type');
        $model->start_date=$request->post('start_date');
        $model->end_date=$request->post('end_date');
        $model->start_time=$request->post('start_time');
        $model->end_time=$request->post('end_time');
        $model->price=$request->post('price');
        $model->about_event=$request->post('about_event');
        $model->tags=$request->post('tags');
        $model->status=1;
        $model->is_approved = 0;
        $model->save();

        $result['status'] = true;
        $result['message'] = "Job has been Updated!";
        return response()->json($result);
    }
    
    
    public function orgupdatemovie(Request $request){
       
        $user_id = $request->post('user_id');  
        // return $request->post('id');
        //   return $request->post();
        if($request->post('user_id') > 0){
           $movie = movie::find($request->post('user_id'));
           $msg = "Movie Updated!";
       }else{
           
           $movie = new movie;
           $msg = "New Movie Uplaoded!";
       }
       if($request->hasfile('poster')){

            if($request->post('id')>0){
                $arrImage=DB::table('movies')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/movie/poster/' .$arrImage[0]->poster;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            // $file=$request->file('poster');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/movie/poster/';
            // $file->move($upload_path, $name);
            // $movie->poster=$name == null ? $request->post('poster') : $name;
            
            
            $x=1;
            $file=$request->file("poster");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/movie/poster/' . $file_name);
            $img->save($filePath, 30);
          $movie->poster=$file_name == null ? $request->post('poster') : $file_name;
        }
        
    //   $movie->representers_id = Session::get('organisation_ID');
    //   $model->representers_id=$user_id;
       $movie->title = $request->post('title');
       $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
       $movie->slug = $slug;
       $movie->about = $request->post('about');
       $movie->genre = json_encode($request->post('genre'));
       $movie->format = json_encode($request->post('format'));
       $movie->certificate = $request->post('certificate');
       $movie->language = json_encode($request->post('language'));
       $movie->release_date = $request->post('release_date');
       $movie->movie_hour = $request->post('movie_hour');
       $movie->movie_minute = $request->post('movie_minute');
       $movie->trailer_link = $request->post('trailer_link');
       $movie->save();
       
    //   Enter Your Movie Cast
       if(is_array($request->post('user_profile')))
       {
       foreach($request->post('user_profile') as $key=> $list){
           
           if(isset($request->post('cast_id')[$key])){
                   DB::table('movie_cast')
                   ->where('id', $request->post('cast_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'user_profile' => $request->post('user_profile')[$key],
                        'character_name' => $request->post('character_name')[$key],
                    ]);
                }
                else{
                     DB::table('movie_cast')->insert([
                        'movie_id' => $movie->id,
                        'user_profile' => $request->post('user_profile')[$key],
                        'character_name' =>$request->post('character_name')[$key],
                    ]);
                }
           
       }
       }
       
    //   return json_encode( $request->post('crew_type'));
    //   Enter Your Crew Members
        if(is_array($request->post('crew_profile')))
       {
       foreach($request->post('crew_profile') as $key=> $list){
           
           if(isset($request->post('crew_id')[$key])){
                   DB::table('movie_crew')
                   ->where('id', $request->post('crew_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'crew_profile' => $request->post('crew_profile')[$key],
                        'crew_type' => $request->post('crew_type')[$key],
                    ]);
                }
                else{
                     DB::table('movie_crew')->insert([
                        'movie_id' => $movie->id,
                        'crew_profile' => $request->post('crew_profile')[$key],
                        'crew_type' => $request->post('crew_type')[$key],
                    ]);
                }
           
       }
       }
       
       if(is_array($request->post('video')))
       {
            foreach($request->post('video') as $key=> $list){
           
           if(isset($request->post('video_id')[$key])){
                   DB::table('movie_video')
                   ->where('id', $request->post('video_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'video_link' => $request->post('video')[$key],
                    ]);
                }
                else{
                     DB::table('movie_video')->insert([
                        'movie_id' => $movie->id,
                        'video_link' => $request->post('video')[$key],
                    ]);
                }
           
            }
       }
       
       if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                
                
                 $x=1;
            $name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/movie/images/' . $name);
            $img->save($filePath, 30);
            
                // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                // $upload_path = 'assets/movie/images/';
                // $file->move($upload_path, $name);
        
                DB::table('movie_image')->insert([
                    'movie_id' => $movie->id,
                    'image' => $name,
                ]);
            }
        }
        $result['status'] = true;
        $result['message'] = "Job has been Updated!";
        return response()->json($result);
   }
   
   public function orginsertmovie(Request $request){

    $user_id = $request->post('user_id');  
    // return $request->post('id');
    //   return $request->post();
    $movie = new movie;
    $msg = "New Movie Uploaded!";

    if ($request->hasfile('poster')) {
        $x = 1;
        $file = $request->file("poster");
        $file_name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        $img = \Image::make($file);
        $filePath = public_path('assets/movie/poster/' . $file_name);
        $img->save($filePath, 30);
        $movie->poster = $file_name == null ? $request->post('poster') : $file_name;
    }

    $movie->title = $request->post('title');
    $slug = strtolower(str_replace(' ', '-', $request->post('title'))) . time() . rand(1, 100);
    $movie->slug = $slug;
    $movie->about = $request->post('about');
    $movie->genre = json_encode($request->post('genre'));
    $movie->format = json_encode($request->post('format'));
    $movie->certificate = $request->post('certificate');
    $movie->language = json_encode($request->post('language'));
    $movie->release_date = $request->post('release_date');
    $movie->movie_hour = $request->post('movie_hour');
    $movie->movie_minute = $request->post('movie_minute');
    $movie->trailer_link = $request->post('trailer_link');
    $movie->save();

    // Enter Your Movie Cast
    if (is_array($request->post('user_profile'))) {
        foreach ($request->post('user_profile') as $key => $list) {
            DB::table('movie_cast')->insert([
                'movie_id' => $movie->id,
                'user_profile' => $request->post('user_profile')[$key],
                'character_name' => $request->post('character_name')[$key],
            ]);
        }
    }

    // Enter Your Crew Members
    if (is_array($request->post('crew_profile'))) {
        foreach ($request->post('crew_profile') as $key => $list) {
            DB::table('movie_crew')->insert([
                'movie_id' => $movie->id,
                'crew_profile' => $request->post('crew_profile')[$key],
                'crew_type' => $request->post('crew_type')[$key],
            ]);
        }
    }

    if (is_array($request->post('video'))) {
        foreach ($request->post('video') as $key => $list) {
            DB::table('movie_video')->insert([
                'movie_id' => $movie->id,
                'video_link' => $request->post('video')[$key],
            ]);
        }
    }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $file) {
            $x = 1;
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img = \Image::make($file);
            $filePath = public_path('assets/movie/images/' . $name);
            $img->save($filePath, 30);

            DB::table('movie_image')->insert([
                'movie_id' => $movie->id,
                'image' => $name,
            ]);
        }
    }

    $result['status'] = true;
    $result['message'] = "Movie has been Uploaded!";
    return response()->json($result);
}

   
    
    public function orgupdatecource(Request $request)
    {
        $user_id = $request->post('user_id');
        $offer_name = $request->post('offer_name');
        $model=courseoffered::where(['representers_id'=>$user_id])->first();
        $model->offer_name = $request->post('offer_name');
        $model->save();
        $result['status'] = true;
        $result['message'] = "Courses Updated!";
        return response()->json($result);
    }
    
    public function orgaddcourse(Request $request)
    {
        $user_id = $request->post('user_id');
        $offer_name = $request->post('offer_name');
        
        $model=new courseoffered();
        $model->representers_id=$user_id;
        $model->offer_name = $request->post('offer_name');
        $model->save();
        
        $result['status'] = true;
        $result['message'] = "Courses Inserted!";
        return response()->json($result);
    }

    
      public function orgupdategallery(Request $request){

        $user_id = $request->post('user_id');
        // $representers_id = Session::get('organisation_ID');
        // return $request->all();
        $arr=user_representer::where(['id'=>$user_id])->first(); 

        // $result['id']=$arr->id;
        // $result['profile']=$arr->profile;
        // $result['name']=$arr->username;
        // $result['type']=$arr->type;
        
        $files = "";
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {

                // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                // $upload_path = 'assets/organize/gallery/'.$arr->name.'/';
                // $file->move($upload_path, $name);
                
                $x=1;
                $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $img=\Image::make($file);
                $directory = public_path('assets/organize/gallery/'.$arr->username.'/');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }
                
                $filePath = $directory . $file_name;
                                $img->save($filePath, 30);

                $representers_gallery = new representers_gallery;
                $representers_gallery->representers_id = $arr->id;
                $representers_gallery->image = $file_name;

                $user_representer = user_representer::find($arr->id);
                // $user_representer->is_approved = '0';
                $user_representer->save();
                $representers_gallery->save();

            }
        }
        // $request->session()->flash('message','Gallery has been Updated!');
        // return redirect('organize/manage_gallery');
    
        $result['status'] = true;
        $result['message'] = "gallery has been Updated!";
        return response()->json($result);
          
      }

    
     public function orgupdatevideos(Request $request){
    $user_id = $request->post('user_id');
    $videoarr = $request->post('video_link');
    $arr = user_representer::where(['id' => $user_id])->first(); 
    $request->validate([
        'video_link' => 'required',
    ]);

    foreach ($videoarr as $key => $video) {
        $str = $video;
        $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
        
        if (preg_match($pattern, $str)) {
            // Assuming 'representers_id' is a foreign key in 'representers_videos' table
            $model = representers_videos::where('representers_id', $user_id)->first();

            if ($model) {
                $model->video_link = $video;
                $model->save();
            }
        } else {
            $result['status'] = false;
            $result['message'] = "Please enter a valid YouTube link!";
            return response()->json($result);
        }
    }

    $result['status'] = true;
    $result['message'] = "Video has been updated!";
    return response()->json($result);
    }

    public function orginsertvideos(Request $request){
        $user_id = $request->post('user_id');
        $videoarr = $request->post('video_link');
        $arr = user_representer::where(['id' => $user_id])->first(); 
        $request->validate([
            'video_link' => 'required',
        ]);
    
        foreach ($videoarr as $key => $video) {
            $str = $video;
            $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
            
            if (preg_match($pattern, $str)) {
                $model = new representers_videos();
                $model->representers_id = $user_id;
                $model->video_link = $video;
                $model->save();
            } else {
                $result['status'] = false;
                $result['message'] = "Please enter a valid YouTube link!";
                return response()->json($result);
            }
        }
    
        $result['status'] = true;
        $result['message'] = "Videos have been inserted!";
        return response()->json($result);
    }



    
    
}

