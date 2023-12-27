<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\state;

class StateController extends Controller
{
  public function index()
    {
        $result['data']=state::all();
        return view('admin/state/list',$result);
    }

    public function manage_state(Request $request,$id='')
    {
        if($id>0){
            $arr=state::where(['id'=>$id])->get(); 

            $result['name']=$arr['0']->name;
            $result['id']=$arr['0']->id;
        }else{
            $result['name']='';
            $result['id']=0;
            
        }
        return view('admin/state/manage_state',$result);
    }

    public function manage_state_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'name'=>'required'
        ]);

        if($request->post('id')>0){
            $model=state::find($request->post('id'));
            $msg="state updated";
        }else{
            $model=new state();
            $msg="state inserted";
        }
       
        $model->name=$request->post('name');
        $model->country_id = 0;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/state');
        
    }

    public function delete(Request $request,$id){
        $model=state::find($id);
        $model->delete();
        $request->session()->flash('message','state deleted');
        return redirect('admin/state');
    }
}
