<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Banner;
use File, DB;
class BannerController extends Controller
{
    public function banner(){

        $result['data']=Banner::all();
        return view('admin/banner',$result);
    }

    public function manage_banner(Request $request,$id='')
    {
        if($id>0){
            $arr=Banner::where(['id'=>$id])->get(); 

            $result['key']=$arr['0']->key;
            $result['value']=$arr['0']->value;
            $result['link']=$arr['0']->link;
            $result['id']=$arr['0']->id;
        }
        return view('admin/manage_banner',$result);
    }

    public function manage_banner_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'value'=>'required',
        ]);
        
        $request->validate([
            'link'=>'required',
        ]);

        if($request->post('id')>0){
            $model=Banner::find($request->post('id'));
            $msg="Banner updated";
        }

        if($request->hasfile('value')){

            if($request->post('id')>0){
                $arrImage=DB::table('banners')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/banner/' .$arrImage[0]->value;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }
            // $file=$request->file('value');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/banner/';
            // $file->move($upload_path, $name);
            // $model->value=$name == null ? $request->post('value') : $name;
            
            
            $x=1;
            $file=$request->file("value");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/banner/' . $file_name);
            $img->save($filePath, 30);
            $model->value=$file_name == null ? $request->post('value') : $file_name;
        }
        
        $model->link = $request->post('link');
        
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/banner');
        
    }

    public function status(Request $request,$status,$id){
        $model=Banner::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Banner status updated');
        return redirect('admin/banner');
    }
}
