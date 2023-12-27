<?php

namespace App\Http\Controllers\Front;

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
use App\Models\Institute;
use App\Models\Event;
use Session, DB,File;

class InstituteController extends Controller
{
    public function institute_posts(Request $request){

        $organisation_ID = Session::get('organisation_ID');


        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;
        // $result['event_category']=event_category::all();
        $result['category']=Category::where('parent_id',null)->get();

        $result['institute_posts']=Institute::where('institutes.representers_id',$result['id'])
        ->paginate(3);

        return view('front/organize/institute_list', $result);
    }

    public function manage_institute_posts(Request $request,$id=''){

        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['type']=$arr['0']->type;
        $result['state']=state::all();
        $result['city']=city::all();
        // $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        // $result['id']=$arr['0']->id;
        $result['category']=Category::where('parent_id',null)->get();
        
        if($id>0){
            $arr=Institute::where('id',$id)->where('representers_id',$organisation_ID)->first();
            $result['title']=$arr->title;
            $result['thumbnail']=$arr->thumbnail;
            $result['about']=$arr->about;
            $result['address']=$arr->address;
            $result['state_id']=$arr->state_id;
            $result['city_id']=$arr->city_id;
            $result['contact_no']=$arr->contact_no;
            $result['email']=$arr->email;
            $result['website']=$arr->website;            
            $result['id']=$arr->id;

            $result['usercity']= city::join('Institutes', 'cities.id', '=', 'Institutes.city_id')
            ->select('cities.*')
            ->where('Institutes.id', $id)
            ->first();
            $result['cityarr']= city::join('Institutes', 'cities.state_id', '=', 'Institutes.state_id')
            ->select('cities.*')
            ->where('Institutes.id', $id)
            ->get();
        }else{
            $result['title']='';
            $result['thumbnail']='';
            $result['about']='';
            $result['address']='';
            $result['state_id']='';
            $result['city_id']='';
            $result['contact_no']='';
            $result['email']='';
            $result['website']='';
            $result['id']='';
        }
        return view('front/organize/manage_institute_posts',$result);
    }

    public function manage_institute_process(Request $request){


        // return $request->post();
        $request->validate([
            'title'=>'required',
            'about'=>'required',
            'address'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'contact_no'=>'required',
            'email'=>'required',
            'website'=>'required',
        ]);


        if($request->post('id')>0){
            $model=Institute::find($request->post('id'));
            $msg="Institute Posts Updated";
            $model->slug=$model->slug;
        }else{
            $model=new Institute();
            $msg="Institute Posts Inserted";
            $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
            $model->is_approved='0';
            $model->slug=$slug;
        }

        if($request->hasfile('thumbnail')){

            if($request->post('id')>0){
                $arrImage=DB::table('institutes')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/event/thumbnail/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            $file=$request->file('thumbnail');
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $upload_path = 'assets/institute/thumbnail/';
            $file->move($upload_path, $name);
            $model->thumbnail=$name == null ? $request->post('thumbnail') : $name;
        }
        
        $organisation_ID = Session::get('organisation_ID');

        $model->representers_id=$organisation_ID;
        $model->title=$request->post('title');
        $model->about=$request->post('about');
        $model->address=$request->post('address');
        $model->state_id=$request->post('state_id');
        $model->city_id=$request->post('city_id');
        $model->contact_no=$request->post('contact_no');
        $model->email=$request->post('email');
        $model->website=$request->post('website');
        $model->status=1;
        $model->save();

        $request->session()->flash('message',$msg);
        return redirect('organize/institute_posts');
    }

    public function institute_posts_delete(Request $request,$id){

        $model=Institute::find($id);
         $arrImage=DB::table('institutes')->where('id',$model->id)->get();
                $old_profile = 'assets/institute/thumbnail/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
        $model->delete();
        $request->session()->flash('message','Post Deleted!.');
        return redirect('organize/institute_posts');

    }
}
