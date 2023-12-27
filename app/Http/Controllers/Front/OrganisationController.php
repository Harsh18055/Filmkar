<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\representer;
use App\Models\User;
use Session;
use App\Models\user_gallery;
use App\Models\user_category;
use App\Models\user_videos;
use App\Models\job_application;
use App\Models\Admin\event_category;
use App\Models\representers_videos;
use App\Models\user_representer;
use App\Models\job_posts;
use App\Models\courseoffered;
use App\Models\joboffered;
use DB,File;
use App\Models\user_social;
use Illuminate\Support\Facades\URL;
use DateTime;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Banner;
use Illuminate\Support\Facades\Mail;

class OrganisationController extends Controller
{
    public function chatbotshow()
    {
        return view('front/chatbot');
    }
    public function index(Request $request){


        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->first();
       
        $result['email_varify']=$arr->email_varify;
        $result['logo']=$arr->logo;
        $result['type']=$arr->type;
        $result['category']=Category::where('parent_id',null)->get();
        $result['banner']=Banner::where('status','1')->get();

        if($arr->referral_code == null){
            $arr->referral_code = $this->generateReferralCode($arr->name);
            $arr->save();
            $result['referral_code']= $arr->referral_code;
            
        }else{
        $result['referral_code']=$arr->referral_code;
        }
        $result['reffer_url'] = URL::to('/register-organisation?referral_code=');

        $result['eventcount'] = DB::table('events')->where('representers_id',$arr->id)->count();
        $result['jobpostscount'] = DB::table('job_posts')->where('representers_id',$arr->id)->count();
        $result['reffral_count'] = DB::table('representer_referrals')->where('referred_id',$arr->id)->count();
        $result['points'] = DB::table('user_representers')->where('id',$arr->id)->first()->points;
        $result['movies'] = DB::table('movies')->where('representers_id',$organisation_ID)->count();

        return view('front/organize/dashboard',$result);

    }
    function generateReferralCode($name) {
        $characters = date('YmdHis').time().'abcdefghijklmnopqrstuvwxyz';
        $referralCode = '';
        for ($i = 0; $i < 4; $i++) {
          $referralCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $name.'_'.$referralCode;
      }

    public function manage_profile(Request $request){
       
        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['type']=$arr['0']->type;
        $result['organize_user'] = user_representer::where(['id'=>$organisation_ID])->first(); 

        $result['representers'] = representer::all();

        $result['usercity']= city::join('user_representers', 'cities.id', '=', 'user_representers.city_id')
            ->select('cities.*')
            ->where('user_representers.id', $organisation_ID)
            ->first();
        $result['cityarr']= city::join('user_representers', 'cities.state_id', '=', 'user_representers.state_id')
            ->select('cities.*')
            ->where('user_representers.id', $organisation_ID)
            ->get();
        $result['state']=state::orderby('name')->get();
        $result['category']=Category::where('parent_id',null)->orderby('category_name')->get();
        
        
        return view('front/organize/manage_profile',$result);

    }

    public function manage_profile_process(Request $request){
        
        //  return $request->all();

        request()->validate([
            'username' => 'required|unique:user_representers,username,'.$request->input('id'),
            'email' => 'required|unique:user_representers,email,'.$request->input('id'),
           
        ]);
        
        
    //   $user_representer = user_representer::orwhere('username', '=', $request->input('username'))
    //     ->orwhere('email', '=', $request->input('email'))
    //     ->where('id', '!=', $request->input('id'))
    //     ->first();
        
    //     if($user_representer){
           
    //          $request->session()->flash('error',"This email or username alredy been taken."   );
        
    //         return redirect('organize/manage_profile');
    //     }

        $id = $request->post('id');
        $username = $request->post('username');
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

        

        $user_representer = user_representer::find($id);
        
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
        Session::flash('success', 'Mail Send successful!');
        
        $request->session()->put('organisation_ID',$user_representer->id);
        $request->session()->put('organisation_NAME',$user_representer->username);
        
         $request->session()->flash('message',"Thanks for the updates! It's been submitted to admin for approval."   );
        
        return redirect('organize/manage_profile');

    }
    
    public function manage_profile_image(Request $request){
        
        $id = $request->post('id');
        
         $user_representer = user_representer::find($id);

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
        // $user_representer->is_approved = '0';
        $user_representer->save();
        // $request->session()->flash('message','Profile has been Updated!');
        return redirect('organize/manage_profile');

    }

    public function change_password(){
       
        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get();
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/organize/change_password',$result);

    }

    public function change_password_process(Request $request){

        $request->validate([
            'current_password'=>'required',
            'password'=>'required',
            'c_password'=>'required',
        ]);

        $id = $request->post('id');
        $current_password = $request->post('current_password');
        $password = $request->post('password');
        $c_password = $request->post('c_password');

        $result=user_representer::find($id);
        if($result){
            if(Hash::check($current_password,$result->password)){
                
                if($password != $c_password){

                    $request->session()->flash('error','Please enter correct Confirm password');
                    return redirect('organize/confirm_password');
                }else{
                    $user = user_representer::find($id);
                    $user->password = hash::make($password);
                    $user->save();
                    $request->session()->flash('message','Password has been Updated!');
                    return redirect('organize/confirm_password');
                }

            }else{
                $request->session()->flash('error','Current password does not match!');
                return redirect()->back();
            }
        }
        
    }

    public function job_posts(Request $request){

        $organisation_ID = Session::get('organisation_ID');

        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
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

        return view('front/organize/job_posts',$result);
    }

    public function manage_job_posts(Request $request,$id=''){

        $organisation_ID = Session::get('organisation_ID');

        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;

        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();
        
        if($id>0){
            $arr=job_posts::where('id',$id)->where('representers_id',$organisation_ID)->first();
            $result['title']=$arr->title;
            $result['slug']=$arr->slug;
            $result['description']=$arr->description;
            $result['job_role_id']=$arr->job_role_id;
            $result['job_type']=$arr->job_type;
            $result['gender']=$arr->gender;
            $result['MinAge']=$arr->MinAge;
            $result['MaxAge']=$arr->MaxAge;
            $result['audition_required']=$arr->audition_required;
            $result['budget']=$arr->budget;
            $result['budget_duration']=$arr->budget_duration;
            $result['job_start']=$arr->job_start;
            $result['last_date']=$arr->last_date;
            $result['job_end']=$arr->job_end;
            $result['No_of_vacancies']=$arr->No_of_vacancies;
            $result['state_id']=$arr->state_id;
            $result['city_id']=$arr->city_id;
            $result['phone_no']=$arr->phone_no;
            $result['zipcode']=$arr->zipcode;
            $result['tags']=$arr->tags;
            $result['representers_id']=$arr->representers_id;
            $result['id']=$arr->id;

        $result['usercity']= city::join('job_posts', 'cities.id', '=', 'job_posts.city_id')
            ->select('cities.*')
            ->where('job_posts.id', $id)
            ->first();
        $result['cityarr']= city::join('job_posts', 'cities.state_id', '=', 'job_posts.state_id')
            ->select('cities.*')
            ->where('job_posts.id', $id)
            ->get();
        }else{
            $result['title']='';
            $result['slug']='';
            $result['description']='';
            $result['job_role_id']='';
            $result['job_type']='';
            $result['gender']='';
            $result['MinAge']='';
            $result['MaxAge']='';
            $result['audition_required']='';
            $result['budget']='';
            $result['budget_duration']='';
            $result['job_start']='';
            $result['last_date']='';
            $result['job_end']='';
            $result['No_of_vacancies']='';
            $result['state_id']='';
            $result['city_id']='';
            $result['phone_no']='';
            $result['zipcode']='';
            $result['tags']='';
            $result['tags']='';
            $result['representers_id']='';
            $result['id']='';
        }
        return view('front/organize/manage_job_posts',$result);
    }

    public function manage_job_process(Request $request){
    
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
        $organisation_ID = Session::get('organisation_ID');

        if($request->post('id')>0){
            $model=job_posts::find($request->post('id'));
            $msg="Thank you for update Job. Your Job will be live after Admin approval.";
            $model->slug=$model->slug;
        }else{
            $model=new job_posts();
            $msg="Thank you for uploading new Job. Your Job will be live after Admin approval.";
            $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
            $model->slug=$slug;

            $per_job = DB::table('points_setting')->where('key','per_job')->first()->value;
            $points = DB::table('user_representers')->where('id',$organisation_ID)->first()->points;

            $sum = $points - $per_job;
            DB::table('user_representers')->where('id', $organisation_ID)->update(['points' => $sum]);
        }

        $model->representers_id=$organisation_ID;
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

        $request->session()->flash('message',$msg);
        return redirect('organize/job_posts');
    }

    public function job_posts_delete(Request $request,$id){

        $model=job_posts::find($id);

        $job_application = job_application::where('job_posts_id',$model->id)->delete();
        $model->delete();
        $request->session()->flash('message','Post Deleted!.');
        return redirect('organize/job_posts');

    }

    public function applied_user_list(Request $request,$id){

        $result['category']=Category::where('parent_id',null)->get();

        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;

        $result['applied_users'] = job_application::
        leftjoin('users', 'job_applications.user_id', '=', 'users.id')
        ->leftjoin('job_posts', 'job_applications.job_posts_id', '=', 'job_posts.id')
        ->select('users.username','users.id as user_id', 'users.profile')
        ->where('representer_id',$organisation_ID)
        ->where('job_posts.id',$id)
        ->get();

        return view('front/organize/applied_user_list', $result);
    }

    public function course_offered(Request $request){

        $result['category']=Category::where('parent_id',null)->get();

        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;

        $result['corsearr']=courseoffered::where('representers_id',$organisation_ID)->get();

        return view('front/organize/course_offered', $result);

    }

    public function course_offered_process(Request $request){

        $ids = $request->post('id');
        
        $offer_name = $request->post('offer_name');
        // $user_id = Session::get('USER_ID');
        $organisation_ID = Session::get('organisation_ID');
        $request->validate([
            'offer_name'=>'required',
        ]);

        // return $offer_name;
        
        foreach($offer_name as $key => $offer){
            

            if(isset($ids[$key])){
                $model=courseoffered::find($ids[$key]);
                $model->offer_name=$offer;
                $model->save();
            }
            else{
                $model=new courseoffered();
                $model->representers_id=Session::get('organisation_ID');
                $model->offer_name=$offer;
                $model->save();
            }
        }
        // die;
        
        $request->session()->flash('message','Courses Updated!');
        return redirect('organize/course_offered');

    }

    public function course_offered_delete(Request $request, $id){

        $organisation_ID = Session::get('organisation_ID');
        
        $query = courseoffered::where('id',$id)->where('representers_id',$organisation_ID)->delete();

        return redirect('organize/course_offered');
    }

    public function job_offered(Request $request){

        $result['category']=Category::where('parent_id',null)->get();

        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;

        $result['jobarr']=joboffered::all();

        return view('front/organize/job_offered', $result);

    }

    public function job_offered_process(Request $request){

        $ids = $request->post('id');
        
        $job_name = $request->post('job_name');
        // $user_id = Session::get('USER_ID');
        $organisation_ID = Session::get('organisation_ID');
        $request->validate([
            'job_name'=>'required',
        ]);

        // return $offer_name;
        
        foreach($job_name as $key => $job){
            

            if(isset($ids[$key])){
                $model=joboffered::find($ids[$key]);
                $model->job_name=$job;
                $model->save();
            }
            else{
                $model=new joboffered();
                $model->representers_id=Session::get('organisation_ID');
                $model->job_name=$job;
                $model->save();
            }
        }
        // die;
        
        $request->session()->flash('message','Offer has been Updated!');
        return redirect('organize/job_offered');

    }

    public function job_offered_delete(Request $request, $id){

        $organisation_ID = Session::get('organisation_ID');
        
        $query = joboffered::where('id',$id)->where('representers_id',$organisation_ID)->delete();

        return redirect('organize/job_offered');
    }

    public function manage_videos(Request $request,$id=''){
        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['name']=$arr['0']->name;
        $result['type']=$arr['0']->type;
        $result['category']=Category::where('parent_id',null)->get();

        $result['videosArr'] = representers_videos::where('representers_id',$organisation_ID)->get();

        // return $result['videosArr'];

        return view('front/organize/manage_videos',$result);

    }

    public function manage_videos_process(Request $request){

        $ids = $request->post('id');
        $videoarr = $request->post('video_link');
        // $user_id = Session::get('USER_ID');

        $request->validate([
            'video_link'=>'required',
        ]);
        
        foreach($videoarr as $key => $video){
            
            $str = $video;
            $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
            if(preg_match($pattern, $str)){

                if(isset($ids[$key])){
                    $model=representers_videos::find($ids[$key]);
                    $model->video_link=$video;
                    $model->save();
                }
                else{
                    $model=new representers_videos();
                    $model->representers_id=Session::get('organisation_ID');
                    $user_representers = user_representer::find(Session::get('organisation_ID'));
                    // $user_representers->is_approved = '0';
                    $user_representers->save();
                    $model->video_link=$video;
                    $model->save();
                }
            }else{
                $request->session()->flash('error','Please enter a youtube link!');
                return redirect('user/manage_videos');
            }
            

        }

        $request->session()->flash('message','Profile has been Updated!');
        return redirect('organize/manage_videos');

    }
    
    public function changeemail(Request $request){
        
        // return base64_decode($request->email);
        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->first();
        $arr->email = base64_decode($request->email);
        $arr->save();
         $request->session()->flash('message','Mail Chnaged Succsess!');
         return redirect()->route('organize.manage_profile');
    }
}
