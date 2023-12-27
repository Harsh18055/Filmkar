<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use App\Models\Admin\Category;
use App\Models\job_posts;
use App\Models\chatbot;
use File,DB,redirect;
class SettingController extends Controller
{
    public function setting(){
        $result['category']=Category::where('parent_id',null)->get();
        $setting = DB::table('settings')->find(1);

        if($setting){
            $result['logo_white']=$setting->logo_white;
            $result['logo_black']=$setting->logo_black;
            $result['slider']=$setting->slider;
            $result['trending_category']=explode(',',$setting->trending_category);
            $result['facebook']=$setting->facebook;
            $result['instagram']=$setting->instagram;
            $result['linkedin']=$setting->linkedin;
            $result['twitter']=$setting->twitter;
            $result['footer_text']=$setting->footer_text;
            $result['id']=$setting->id;
        }else{
            $result['logo_white']='';
            $result['logo_black']='';
            $result['slider']='';
            $result['trending_category']='';
            $result['facebook']='';
            $result['instagram']='';
            $result['linkedin']='';
            $result['twitter']='';
            $result['footer_text']='';
            $result['id']='';
        }

        $result['per_referred'] = DB::table('points_setting')->where('key', 'per_reffered')->first()->value;
        $result['per_referrer'] = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
        $result['per_job'] = DB::table('points_setting')->where('key', 'per_job')->first()->value;
        $result['per_apply'] = DB::table('points_setting')->where('key', 'per_apply')->first()->value;
        

        return view('admin/setting',$result);
    }

    public function manage_setting_process(Request $request)
    {
        //return $request->post();

        $model=Setting::find(1);
        $msg="setting updated";

        if($request->hasfile('logo_white')){

            $old_profile = 'assets/setting/logo_white.png';
            if(file_exists($old_profile)) {  
        
                File::delete($old_profile);
            }

            // $file=$request->file('logo_white');
            // $name = 'logo_white.png';
            // $upload_path = 'assets/setting/';
            // $file->move($upload_path, $name);
            // $model->logo_white=$name == null ? $request->post('logo_white') : $name;
            
            
            $x=1;
            $file=$request->file("logo_white");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/setting/' . $file_name);
            $img->save($filePath, 30);
            $model->logo_white=$name == null ? $request->post('logo_white') : $name;
        }
        if($request->hasfile('logo_black')){

            $old_profile = 'assets/setting/logo_black.png';
            if(file_exists($old_profile)) {  
        
                File::delete($old_profile);
            }

            $file=$request->file();
            $name = 'logo_black.png';
            $upload_path = 'assets/setting/';
            $file->move($upload_path, $name);
            $model->logo_black=$name == null ? $request->post('logo_black') : $name;
            
            
            $x=1;
            $file=$request->file("logo_bla");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/setting/' . $file_name);
            $img->save($filePath, 30);
            $model->logo_white=$name == null ? $request->post('logo_white') : $name;
        }
        if($request->hasfile('slider')){

            $old_profile = 'assets/setting/slider.png';
            if(file_exists($old_profile)) {  
        
                File::delete($old_profile);
            }

            $file=$request->file('slider');
            $name = 'slider.png';
            $upload_path = 'assets/setting/';
            $file->move($upload_path, $name);
            $model->slider=$name == null ? $request->post('slider') : $name;
            
            
            $x=1;
            $file=$request->file("slider");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/setting/' . $file_name);
            $img->save($filePath, 30);
            $model->logo_white=$name == null ? $request->post('logo_white') : $name;
        }

        $trending_category = $request->post('trending_category');
        $trending_categorys = '';
        foreach($trending_category as $one){
          $trending_categorys =  implode(", ", array_filter($_POST['trending_category']));
        }
        $model->trending_category=$trending_categorys;
        $model->facebook=$request->post('facebook');
        $model->instagram=$request->post('instagram');
        $model->linkedin=$request->post('linkedin');
        $model->twitter=$request->post('twitter');
        $model->footer_text=$request->post('footer_text');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/setting');
        
    }

    public function manage_points(Request $request){

        DB::table('points_setting')
        ->where('key', 'per_reffered')
        ->update(['value' => $request->post('per_reffered')]);

        DB::table('points_setting')
        ->where('key', 'per_referrer')
        ->update(['value' => $request->post('per_referrer')]);

        DB::table('points_setting')
        ->where('key', 'per_job')
        ->update(['value' => $request->post('per_job')]);

        DB::table('points_setting')
        ->where('key', 'per_apply')
        ->update(['value' => $request->post('per_apply')]);

        $request->session()->flash('message','Points Value Updated.');
        return redirect('admin/setting');
    }

    public function sendnewjobnoti(Request $request,$cat_id){


        $users = DB::table('users')
        ->leftjoin('user_categories','users.id','=','user_categories.user_id')
        ->where('user_categories.cat_id',$cat_id)
        ->select('users.*')
        ->get();

        foreach($users as $list){
            $details = [
                'username' => $list->firstname .' '. $list->lastname,
                'cat_id' => $cat_id,
            ];
            // $date = date('Y-m-d');
            $details['jobs']=DB::table('job_posts')
                // ->whereDate('created_at',$date)
                ->where('job_role_id',$cat_id)
                ->where('is_approved','1')
                ->where('is_email','0')
                ->get();
            $details['jobscount'] = $details['jobs']->count();
           
            \Mail::to($list->email)->send(new \App\Mail\NewJobMail($details));
  
        }
        foreach($details['jobs'] as $onejob){
            $jobs = job_posts::find($onejob->id);
            $jobs->is_email = '1';
            $jobs->save();
        }

        return 1;
    }
    
    
    //chatbot
    
    
    public function chatbot()
    {
        $result['data']=chatbot::all();
        return view('admin/chatbot',$result);
    }

    public function manage_chatbot(Request $request,$id='')
    {
        if($id>0){
            $arr=chatbot::where(['id'=>$id])->get(); 
            $result['answer']=$arr['0']->answer;
            $result['question']=$arr['0']->question;
            $result['id']=$arr['0']->id;
        }else{
            $result['answer']='';
            $result['question']='';
            $result['id']=0;
            
        }
        return view('admin/manage_chatbot',$result);
    }
    
    public function manage_chatbot_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'question'=>'required',
            'answer'=>'required'
        ]);

        if($request->post('id')>0){
            $model=chatbot::find($request->post('id'));
            $msg="chatbot updated";
        }else{
            $model=new chatbot();
            $msg="chatbot inserted";
        }
       
        $model->answer=$request->post('answer');   
        $model->question=$request->post('question');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/chatbot');
        
    }

    public function delete(Request $request,$id){
        $model=chatbot::find($id);
        $model->delete();
        $request->session()->flash('message','chatbot deleted');
        return redirect('admin/chatbot');
    }

    public function status(Request $request,$status,$id){
        $model=chatbot::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','chatbot status updated');
        return redirect('admin/chatbot');
    }
    
    
    
}
