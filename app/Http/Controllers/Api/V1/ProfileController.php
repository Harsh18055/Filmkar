<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\User;
use App\Models\user_category;
use App\Models\user_attr;
use App\Models\job_application;
use App\Models\job_posts;
use App\Models\user_language;
use Session, DB;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\user_videos;
use App\Models\user_gallery;
use App\Models\user_social;
use Illuminate\Support\Facades\URL;
use App\Models\Admin\Banner;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;



    
    class ProfileController extends Controller
{
    public function userdashboard(){
        $pendding_users = User::where('status','0')->count();
        $approved_users = User::where('status','1')->count();
        $pendding_movies = user_representer::where('is_approved','0')->count();
        $approved_movies = user_representer::where('is_approved','1')->count();
        $pendding_evnts = Event::where('is_approved','0')->count();
        $approved_evnts =Event::where('is_approved','1')->count();
        $pendding_mov = movie::where('is_approved','0')->count();
        $approved_mov =movie::where('is_approved','1')->count();
        $pendding_job = job_posts::where('is_approved','0')->count();
        $approved_job =job_posts::where('is_approved','1')->count();
        
        if($event_posts){
            $result['status'] = true;
            $result['pendding_users'] = $pendding_users;
            $result['approved_users'] = $approved_users;
            $result['pendding_movies'] = $pendding_movies;
            $result['approved_movies'] = $approved_movies;
            $result['pendding_evnts'] = $pendding_evnts;
            $result['approved_evnts'] = $approved_evnts;
            $result['pendding_mov'] = $pendding_mov;
            $result['approved_mov'] = $approved_mov;
            $result['pendding_job'] = $pendding_job;
            $result['approved_job'] = $approved_job;
        }else{
            $result['status'] = false;
            $result['data'] = [];
        }

        return response()->json($result);
    }
    
     public function getprofiledata(Request $request){

        $id = $request->get('id');

        if($id>0){
            $arr=User::where(['id'=>$id])->get(); 
            $result['lanarr']= user_language::join('languages', 'user_languages.language_id', '=', 'languages.id')
            ->select('user_languages.*', 'languages.language')
            ->where('user_languages.user_id', $id)
            ->get();
            
            $result['catarr']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id', null)
            ->get();

            $result['subcatarr']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id','!=', null)
            ->get();
            
            $result['usersubcat']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id','!=', null)
            ->get();

            $result['usercity']= city::join('users', 'cities.id', '=', 'users.city_id')
            ->select('cities.*')
            ->where('users.id', $id)
            ->first();
            $result['cityarr']= city::join('users', 'cities.state_id', '=', 'users.state_id')
            ->select('cities.*')
            ->where('users.id', $id)
            ->get();

            $result['userattrarr']= user_attr::join('users', 'user_attrs.user_id', '=', 'users.id')
            ->select('user_attrs.*')
            ->where('users.id', $id)
            ->first();

            if($result['userattrarr'] != ""){

                $result['attr_id'] = $result['userattrarr']->id;
                $result['eyecolor'] = $result['userattrarr']->eyecolor;
                $result['haircolor'] = $result['userattrarr']->haircolor;
                $result['dresssize'] = $result['userattrarr']->dresssize;
                $result['shoesize'] = $result['userattrarr']->shoesize;
                $result['hairtype'] = $result['userattrarr']->hairtype;
                $result['talent_height_in_CM'] = $result['userattrarr']->talent_height_in_CM;
                $result['waist_in_CM'] = $result['userattrarr']->waist_in_CM;
                $result['dnone'] = '';
            }else{
                $result['attr_id'] = '';
                $result['eyecolor'] = '';
                $result['haircolor'] = '';
                $result['dresssize'] = '';
                $result['shoesize'] = '';
                $result['hairtype'] = '';
                $result['talent_height_in_CM'] = '';
                $result['waist_in_CM'] = '';
                $result['dnone'] = 'd-none';
            }


            $result['username']=$arr['0']->username;
            $result['firstname']=$arr['0']->firstname;
            $result['lastname']=$arr['0']->lastname;
            $result['email']=$arr['0']->email;
            $result['is_email_enable']=$arr['0']->is_email_enable;
            $result['email_varify']=$arr['0']->email_varify;
            $result['phonenumber']=$arr['0']->phonenumber;
            $result['whatsapp_no']=$arr['0']->whatsapp_no;
            $result['is_phoneno_enable']=$arr['0']->is_phoneno_enable;
            $result['is_birthdate_enable']=$arr['0']->is_birthdate_enable;
            $result['profile']=$arr['0']->profile;
            $result['gender']=$arr['0']->gender;
            $result['state_id']=$arr['0']->state_id;
            $result['city_id']=$arr['0']->city_id;
            $result['birthdate']=$arr['0']->birthdate;
            $result['year_of_experience']=$arr['0']->year_of_experience;
            $result['about_you']=$arr['0']->about_you;
            $result['id']=$arr['0']->id;


            $result['catarrselected']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->get();

            $catarrselected = array();
            foreach($result['catarrselected'] as $onecat){
                array_push($catarrselected,$onecat->id);
            }
            $result['catarrselected']=$catarrselected;
           
            $lanarrselected = array();
            foreach($result['lanarr'] as $onelan){
                array_push($lanarrselected,$onelan->language_id);
            }
            $result['lanarrselected']=$lanarrselected;
            $result['subcatselected']=Category::whereIn('parent_id',$catarrselected)->where('parent_id','!=',null)->get();

        }else{
            $result['username']='';
            $result['firstname']='';
            $result['lastname']='';
            $result['email']='';
            $result['is_email_enable']='';
            $result['email_varify ']='';
            $result['phonenumber']='';
            $result['whatsapp_no']='';
            $result['is_phoneno_enable']='';
            $result['is_birthdate_enable']='';
            $result['gender']='';
            $result['state_id']='';
            $result['city_id']='';
            $result['birthdate']='';
            $result['year_of_experience']='';
            $result['about_you']='';
            $result['id']=0;

            // $result['category']=DB::table('categories')->where(['status'=>1])->get();
            
        }
        $result['category']=Category::where('parent_id',null)->orderby('category_name')->get();
        $result['subcategory']=Category::where('parent_id','!=',null)->orderby('category_name')->get();
        $result['languages']=language::all();
        $result['state']=state::orderby('name')->get();
        $result['city']=city::orderby('city')->get();

        return response()->json($result);
    }
    
    
     public function updateprofiledata(Request $request){
        

        // return $request->post();
        $validator = Validator::make($request->all(), [
            'username'=>'required|unique:users,username,'.$request->post('id'),
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users,email,'.$request->post('id'),
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
            
             $result['status'] = 0;
            $result['message'] = $validator->errors()->first();
            return response()->json($result);
                
                
        }

        $id = $request->post('id');
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
            
        //     $result['status'] = 1;
        //     $result['message'] = "You need to atleast choose one category!";
        //     return response()->json($result);
        // }
        
          $languages = $request->post('language');
        // if($languages ==  null){
        //     // $request->session()->flash('error','You need to atleast choose one language!');
        //     // return redirect('user/manage_profile');
            
        //     $result['status'] = 1;
        //     $result['message'] = "You need to atleast choose one language!";
        //     return response()->json($result);
        // }
        // return $categories;
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
        
         if($user->email != $email){
             $verificationUrl = "https://filmkar.com/user/changeemail?email=" . base64_encode($email)."";
            $details = [
                'username' => $username,
                'email' => $email,
                'subject' => "Varify email For Filmaker",
                'message' => "Please click the following link to verify your email: " . $verificationUrl
    
            ];
           
            \Mail::to($email)->send(new \App\Mail\mailchange($details));
        
            $result['status'] = 1;
            $result['message'] = "Check your mail for change mail.";
            return response()->json($result);
            
        }

        // if($request->hasfile('profile')){

        //     if($request->post('id')>0){
        //         $arrImage=DB::table('users')->where('id',$id)->get();
        //         $old_profile = 'assets/profile/' .$arrImage[0]->profile;
        //         if(file_exists($old_profile)) {  
            
        //             File::delete($old_profile);
        //         }
        //     }

        //     $file=$request->file('profile');
        //     $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //     $upload_path = 'assets/profile/';
        //     $file->move($upload_path, $name);
        //     $user->profile=$name == null ? $request->post('profile') : $name;
        // }


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

        //  $verificationUrl = "https://digitalbhuro.com/varify?email=" . base64_encode($email)."&type=1";
        // $details = [
        //     'username' => $username,
        //     'email' => $email,
        //     'subject' => "Varify email For Filmaker",
        //     'message' => "Please click the following link to verify your account: " . $verificationUrl

        // ];
       
        // \Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details));
        // Session::flash('success', 'Mail Send successful!');
              
        // $request->session()->put('USER_ID',$user->id);
        // $request->session()->put('USER_NAME',$user->username);
        
        // $request->session()->flash('message','Profile has been Updated!');
        
        $result['status'] = 1;
        $result['message'] = "Profile has been Updated!";
        return response()->json($result);

    }
    
    
     public function getvideos(Request $request){

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
                    $model=user_videos::find($ids[$key]);
                    $model->video_link=$video;
                    $model->save();
                }
                else{
                    $model=new user_videos();
                    // $model->user_id=Session::get('USER_ID');
                     $model->USER_ID = 169;
                    $model->video_link=$video;
                    $model->save();
                }
                $id = Session::get('USER_ID');
                $arr=User::where(['id'=>$id])->first(); 
                // $arr->status = '2';
                $arr->save();
            }else{
                // $request->session()->flash('error','Please enter a youtube link!');
                // return redirect('user/manage_videos');
                
                $result['status'] = 0;
                $result['message'] = "Please enter a youtube link";
                return response()->json($result);

            }
        }

        // foreach($video_link as $video){
        //     $model=new user_videos();
        //     $model->user_id=Session::get('USER_ID');
        //     $model->video_link=$video;
        //     $model->save();
        // }
        
        // $request->session()->flash('message','Profile has been Updated!');
        // return redirect('user/manage_videos');
         
        $result['status'] = 1;
        $result['message'] = "Profile has been Updated!";
        return response()->json($result);

    }
    
    
    public function getgallery(Request $request){

        $user_id = Session::get('USER_ID');
        // return $request->post();
        $arr=User::where(['id'=>$user_id])->first(); 


        $files = "";
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                // $img = Image::make($file)->encode('webp',30);
                // $name = time() . rand(1, 100) . '.webp';
                // $upload_path = 'assets/gallery/'.$arr->username.'/';
                // $file->move($upload_path,$name, $img);

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
            $arr=User::where('id',Session::get('USER_ID'))->first(); 
            // $arr->status = '2';
            // $arr->save();
        }
        $request->session()->flash('message','Profile has been Updated!');
        return redirect('user/manage_gallery');
    }
    
}

