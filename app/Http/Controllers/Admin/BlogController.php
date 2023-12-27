<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\blog;
use DB, File;
class BlogController extends Controller
{
    public function index()
    {
        $result['data']=blog::all();
        
        $result['new']=blog::where('is_view','0')->update(['is_view'=>'1']);
        return view('admin/blog',$result);
    }

    public function manage_blog(Request $request,$id='')
    {
        if($id>0){
            $arr=blog::where(['id'=>$id])->get(); 

            $result['title']=$arr['0']->title;
            $result['thumbnail']=$arr['0']->thumbnail;
            $result['slug']=$arr['0']->slug;
            $result['blog']=$arr['0']->blog;
            $result['id']=$arr['0']->id;
        }else{
            $result['title']='';
            $result['thumbnail']='';
            $result['slug']='';
            $result['blog']='';
            $result['id']=0;
            
        }
        return view('admin/manage_blog',$result);
    }

    public function manage_blog_process(Request $request)
    {
        
        
        $request->validate([
            'title'=>'required',
            'slug'=>'required|unique:blogs,slug,'.$request->post('id'),
            'blog'=>'required',
        ]);

        if($request->post('id')>0){
            $model=blog::find($request->post('id'));
            $msg="blog updated";
        }else{
            $model=new blog();
            $msg="blog inserted";
        }

        if($request->hasfile('thumbnail')){

            if($request->post('id')>0){
                $arrImage=DB::table('blogs')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/blog/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }
            // $file=$request->file('thumbnail');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/blog/';
            // $file->move($upload_path, $name);
            // $model->thumbnail=$name == null ? $request->post('thumbnail') : $name;
            
            
            $x=1;
            $file=$request->file('thumbnail');
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/blog/' . $file_name);
            $img->save($filePath, 30);
            $model->thumbnail=$file_name == null ? $request->post('thumbnail') : $file_name;
        }
       
        $model->title=$request->post('title');
        $model->slug=strtolower(str_replace(' ', '-', $request->post('slug')));
        $model->blog=$request->post('blog');
        $model->status=0;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/blog');
        
    }

    public function delete(Request $request,$id){
        $model=blog::find($id);
        $model->delete();
        $request->session()->flash('message','blog deleted');
        return redirect('admin/blog');
    }

    public function status(Request $request,$status,$id){
        $model=blog::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','blog status updated');
        return redirect('admin/blog');
    }

     public function uploader(Request $request){
        
        if ($request->hasFile('upload')) {
            // $originName = $request->file('upload')->getClientOriginalName();
            // $fileName = pathinfo($originName, PATHINFO_FILENAME);
            // $extension = $request->file('upload')->getClientOriginalExtension();
            $file=$request->file("upload");
            $fileName=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('media/' . $fileName);
            $img->save($filePath, 30);
    
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
    
    public function isfeatured(Request $request,$isfeatured,$id){
        $model=blog::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','status updated');
        return redirect()->back();

    }
}
