<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\event_category;
use App\Models\Event;
use App\Mail\Eventapprovalmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class EventCategoryController extends Controller
{
    public function index()
    {
        $result['data']=event_category::all();
        
         $result['new']=event_category::where('is_view','0')->update(['is_view'=>'1']);
        return view('admin/event_category',$result);
    }

    public function manage_event_category(Request $request,$id='')
    {
        if($id>0){
            $arr=event_category::where(['id'=>$id])->get(); 

            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug;
            $result['id']=$arr['0']->id;

        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['id']=0;
            
        }
        return view('admin/manage_event_category',$result);
    }

    public function manage_event_category_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:event_categories,category_slug,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=event_category::find($request->post('id'));
            $msg="Category updated";
        }else{
            $model=new event_category();
            $msg="Category inserted";
        }

        $model->category_name=$request->post('category_name');
        $model->category_slug=strtolower(str_replace(' ', '-', $request->post('category_slug')));
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/event_category');
        
    }

    public function delete_category(Request $request,$id){
        $model=event_category::find($id);
        $model->delete();
        $request->session()->flash('message','Category deleted');
        return redirect('admin/event_category');
    }
    
     public function delete_event(Request $request,$id){
        $model=event::find($id);
        $model->delete();
        $request->session()->flash('message','Events deleted');
        return redirect()->back();
    }

    public function status(Request $request,$status,$id){
        $model=event_category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Category status updated');
        return redirect('admin/event_category');
    }

   public function event(Request $request)
{
    $type = $request->get('type');

    if ($type == '1') {
        $result['data'] = Event::leftJoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
            ->select('events.*', 'user_representers.username as user_name')
            ->where('events.is_approved', $type)
            ->get();
    } else {
        $result['data'] = Event::leftJoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
            ->select('events.*', 'user_representers.username as user_name')
            ->where('events.is_approved', $type)
            ->get();
    }
    
    $result['new']=Event::where('is_view','0')->update(['is_view'=>'1']);

    return view('admin/event', $result);
}


    public function is_approved(Request $request,$is_approved,$id){
        $model=Event::find($id);
        $model->is_approved=$is_approved;
        $model->save();
        
        $user_representers = Event::leftjoin('user_representers','events.representers_id', '=', 'user_representers.id')
        ->select('user_representers.*')
        ->where('user_representers.id',$model->representers_id)
        ->first();
        
        if($is_approved == '1'){
        $details = [
                'username' => $user_representers->username,
                'message' => 'Your New Event is approved and its live now.'
            ];
        \Mail::to($user_representers->email)->send(new \App\Mail\Eventapprovalmail($details));
        }else{
        $details = [
                'username' => $user_representers->username,
                'message' => 'Thank you for your Patience. Your new Event is Disapproved by the Admin. Pls do the necessary Changes to make it live.'
            ];
        \Mail::to($user_representers->email)->send(new \App\Mail\Eventapprovalmail($details));
        }
        
        $request->session()->flash('message','event status updated');
        return redirect()->back();
    }

    public function isfeatured(Request $request,$isfeatured,$id){
        $model=Event::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','isfeatured status updated');
        return redirect()->back();
    }

    public function view_event(Request $request,$id){

       
        $result['event_post']=Event::leftjoin('states', 'events.state_id', '=', 'states.id')
        ->leftjoin('cities', 'events.city_id', '=', 'cities.id')
        ->leftjoin('user_representers', 'events.representers_id', '=', 'user_representers.id')
        ->leftjoin('event_categories', 'events.event_cat_id', '=', 'event_categories.id')
        ->select('events.*', 'states.name as state','cities.city as city','event_categories.category_name',
        'user_representers.website as user_website','user_representers.username as user_name','user_representers.email as user_email','user_representers.phone_no as user_number')
        ->where('events.id',$id)
        ->first();

        // return $result['event_post'];

        return view('admin/view_event',$result);
    }
}
