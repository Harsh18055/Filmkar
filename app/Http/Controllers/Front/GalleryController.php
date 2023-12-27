<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\representers_gallery;
use App\Models\Admin\Category;
use Session, DB;
use App\Models\user_representer;

class GalleryController extends Controller
{
    public function manage_gallery(Request $request){

        $id = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$id])->get(); 
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['name']=$arr['0']->username;
        $result['type']=$arr['0']->type;
        $result['category']=Category::where('parent_id',null)->get();
        
        $result['galleryArr'] = representers_gallery::where('representers_id',$id)->get();

        return view('front/organize/manage_gallery',$result);
    }

    public function manage_gallery_process(Request $request){
        
        $representers_id = Session::get('organisation_ID');
        // return $request->all();
        $arr=user_representer::where(['id'=>$representers_id])->first(); 

        $result['id']=$arr->id;
        $result['profile']=$arr->profile;
        $result['name']=$arr->username;
        $result['type']=$arr->type;
        
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
                                // $img->save($filePath, 30);
                         $encodedImage = $img->encode('png');
                        file_put_contents($filePath, $encodedImage);

                $representers_gallery = new representers_gallery;
                $representers_gallery->representers_id = $arr->id;
                $representers_gallery->image = $file_name;

                $user_representer = user_representer::find($arr->id);
                // $user_representer->is_approved = '0';
                $user_representer->save();
                $representers_gallery->save();
            }
        }
        $request->session()->flash('message','Gallery has been Updated!');
        return redirect('organize/manage_gallery');
    }

    public function manage_gallery_delete(Request $request, $id){
        
        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->first(); 

        $result['id']=$arr->id;
        $result['profile']=$arr->profile;
        $result['name']=$arr->name;
        $result['type']=$arr->type;
        $query = representers_gallery::where('id',$id)->where('representers_id',$organisation_ID)->first();
        if($query){

                $old_profile = 'assets/organize/gallery/'.$result['name'].'/'.$query->image;

                // return $old_profile;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
                $query->delete();
            $request->session()->flash('message','Photo Deleted!');
        }else{
            $request->session()->flash('error','something went wrong!');
        }
        return redirect('organize/manage_gallery');
    }
}
