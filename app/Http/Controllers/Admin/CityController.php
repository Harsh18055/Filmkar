<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\city;
use App\Models\Admin\state;

class CityController extends Controller
{
   public function index()
    {
        $result['data']=city::leftjoin('states','states.id','=','cities.state_id')->select('cities.*','states.name as state')->get();
        return view('admin/city/list',$result);
    }

    public function manage_city(Request $request,$id='')
    {
        if($id>0){
            $arr=city::where(['id'=>$id])->get(); 

            $result['city']=$arr['0']->city;
            $result['state_id']=$arr['0']->state_id;
            $result['id']=$arr['0']->id;
        }else{
            $result['city']='';
             $result['state_id']=0;
            $result['id']=0;
            
        }
         $result['states']=state::all(); 
        return view('admin/city/manage_city',$result);
    }

    public function manage_city_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'city'=>'required',
             'state_id'=>'required'
        ]);

        if($request->post('id')>0){
            $model=city::find($request->post('id'));
            $msg="city updated";
        }else{
            $model=new city();
            $msg="city inserted";
        }
        $model->state_id=$request->post('state_id');
        $model->city=$request->post('city');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/city');
        
    }

    public function delete(Request $request,$id){
        $model=city::find($id);
        $model->delete();
        $request->session()->flash('message','city deleted');
        return redirect('admin/city');
    }
}
