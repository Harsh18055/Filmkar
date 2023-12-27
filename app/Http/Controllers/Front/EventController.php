<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_videos;use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\representer;
use App\Models\User;
use App\Models\user_representer;
use App\Models\Admin\event_category;
use App\Models\Event;
use Session, DB,File;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function event_posts(Request $request){

        $organisation_ID = Session::get('organisation_ID');

        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
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

        return view('front/organize/event_list', $result);
    }

    public function manage_event_posts(Request $request,$id=''){

        $organisation_ID = Session::get('organisation_ID');

        $arr=user_representer::where(['id'=>$organisation_ID])->first(); 
        $result['id']=$arr->id;
        $result['type']=$arr->type;
        $result['category']=Category::where('parent_id',null)->get();
        $result['event_category']=event_category::all();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();
        
        if($id>0){
            $arr=Event::where('id',$id)->where('representers_id',$organisation_ID)->first();
            $result['event_cat_id']=$arr->event_cat_id;
            $result['title']=$arr->title;
            $result['address']=$arr->address;
            $result['email']=$arr->email;
            $result['phone_number']=$arr->phone_number;
            $result['pin_code']=$arr->pin_code;
            $result['event_venue']=$arr->event_venue;
            $result['event_type']=$arr->event_type;
            $result['slug']=$arr->slug;
            $result['thumbnail']=$arr->thumbnail;
            $result['state_id']=$arr->state_id;
            $result['city_id']=$arr->city_id;
            $result['start_date']=$arr->start_date;
            $result['end_date']=$arr->end_date;
            $result['start_time']=$arr->start_time;
            $result['end_time']=$arr->end_time;
            $result['price']=$arr->price;
            $result['about_event']=$arr->about_event;
            $result['tags']=$arr->tags;
            $result['id']=$arr->id;

            if($arr->event_type == 'online'){
                $result['dnone'] = 'd-none';
            }else{
                $result['dnone'] = '';

            }

        $result['usercity']= city::join('events', 'cities.id', '=', 'events.city_id')
            ->select('cities.*')
            ->where('events.id', $id)
            ->first();
        $result['cityarr']= city::join('events', 'cities.state_id', '=', 'events.state_id')
            ->select('cities.*')
            ->where('events.id', $id)
            ->get();
        }else{
            $result['event_cat_id']='';
            $result['title']='';
            $result['email']='';
            $result['address']='';
            $result['phone_number']='';
            $result['pin_code']='';
            $result['event_venue']='';
            $result['event_type']='';
            $result['slug']='';
            $result['thumbnail']='';
            $result['state_id']='';
            $result['city_id']='';
            $result['start_date']='';
            $result['end_date']='';
            $result['start_time']='';
            $result['end_time']='';
            $result['price']='';
            $result['about_event']='';
            $result['tags']='';
            $result['id']='';
            $result['dnone'] = '';

            
        }
        return view('front/organize/manage_event_posts',$result);
    }

    public function manage_event_process(Request $request){


        // return $request->post();
        $request->validate([
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'price'=>'required',
            'about_event'=>'required',
            'tags'=>'required',
        ]);


        if($request->post('id')>0){
            $model=Event::find($request->post('id'));
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

            if($request->post('id')>0){
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
        $organisation_ID = Session::get('organisation_ID');

        $model->representers_id=$organisation_ID;
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

        $request->session()->flash('message',$msg);
        return redirect('organize/event_posts');
    }

    public function event_posts_delete(Request $request,$id){

        $model=Event::find($id);
         $arrImage=DB::table('events')->where('id',$model->id)->get();
                $old_profile = 'assets/event/thumbnail/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
        $model->delete();
        $request->session()->flash('message','Post Deleted!.');
        return redirect('organize/event_posts');

    }
}
