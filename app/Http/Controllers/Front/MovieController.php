<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\movie;
use App\Models\User;
use App\Models\user_representer;
use Session, DB,File;

class MovieController extends Controller
{
   public function movie_posts(){
       
       $organisation_ID = Session::get('organisation_ID');
       
        // $result['category']=Category::where('parent_id',null)->get();
        
        $movies = Movie::where('representers_id',$organisation_ID)->orderBy('created_at', 'desc')->paginate(3);
        
       return view('front/organize/movie_list', ['movies' => $movies]);
   }
   
   public function manage_movie(Request $request,$id=""){
       
       $organisation_ID = Session::get('organisation_ID');
       
       $result['genre_type'] = DB::table('genre_type')->get(); 
       $result['format_type'] = DB::table('format_type')->get(); 
       $result['crew_type'] = DB::table('crew_type')->get();
       $result['languages'] = DB::table('languages')->where('status','1')->get(); 
      
    //   return $result['genre'];
       if($id > 0){
            
           $arr=movie::where('id',$id)->where('representers_id',$organisation_ID)->first();
           $result['movie_castarr'] = DB::table('movie_cast')->where('movie_id',$arr->id)->get();
           $result['movie_crewarr'] = DB::table('movie_crew')->where('movie_id',$arr->id)->get();
           $result['movie_videoarr'] = DB::table('movie_video')->where('movie_id',$arr->id)->get();
           $result['movie_image'] = DB::table('movie_image')->where('movie_id',$arr->id)->get();
            $result['title']=$arr->title;
            $result['poster']=$arr->poster;
            $result['about']=$arr->about;
            $result['genre']=$arr->genre;
            $result['format']=$arr->format;
            $result['certificate']=$arr->certificate;
            $result['language']=$arr->language;
            $result['release_date']=$arr->release_date;
            $result['movie_hour']=$arr->movie_hour;
            $result['movie_minute']=$arr->movie_minute;
            $result['trailer_link']=$arr->trailer_link;
            $result['id']=$arr->id;
            
            $result['casts']=DB::table('movie_cast')->where('movie_id',$arr->id)->pluck('user_profile')
    ->toArray();
            // return $result['casts'];
       }else{
           $result['title']="";
            $result['poster']="";
            $result['about']="";
            $result['genre']="";
            $result['format']="";
            $result['certificate']="";
            $result['language']="";
            $result['release_date']="";
            $result['movie_hour']="";
            $result['movie_minute']="";
            $result['trailer_link']= "";
            $result['id']=" ";
            $result['casts']=[];
            $result['movie_castarr']=[];
            $result['movie_crewarr']=[];
            $result['movie_videoarr']=[];
            $result['movie_image']=[];
       }
       return view('front/organize/manage_movie', $result);
   }
   
   public function manage_movie_process(Request $request){
       
      // return $request->post('id');
    //   return $request->post();
       if($request->post('id') > 0){
           $movie = movie::find($request->post('id'));
           $msg = "Movie Updated!";
       }else{
           $movie = new movie;
           $msg = "New Movie Uplaoded!";
       }
       if($request->hasfile('poster')){

            if($request->post('id')>0){
                $arrImage=DB::table('movies')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/movie/poster/' .$arrImage[0]->poster;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            // $file=$request->file('poster');
            // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            // $upload_path = 'assets/movie/poster/';
            // $file->move($upload_path, $name);
            // $movie->poster=$name == null ? $request->post('poster') : $name;
            
            
            $x=1;
            $file=$request->file("poster");
            $file_name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/movie/poster/' . $file_name);
            $img->save($filePath, 30);
          $movie->poster=$file_name == null ? $request->post('poster') : $file_name;
        }
       $movie->representers_id = Session::get('organisation_ID');
       $movie->title = $request->post('title');
       $slug = strtolower(str_replace(' ', '-', $request->post('title'))).time() . rand(1, 100);
       $movie->slug = $slug;
       $movie->about = $request->post('about');
       $movie->genre = json_encode($request->post('genre'));
       $movie->format = json_encode($request->post('format'));
       $movie->certificate = $request->post('certificate');
       $movie->language = json_encode($request->post('language'));
       $movie->release_date = $request->post('release_date');
       $movie->movie_hour = $request->post('movie_hour');
       $movie->movie_minute = $request->post('movie_minute');
       $movie->trailer_link = $request->post('trailer_link');
       $movie->save();
       
    //   Enter Your Movie Cast
       if(is_array($request->post('user_profile')))
       {
       foreach($request->post('user_profile') as $key=> $list){
           
           if(isset($request->post('cast_id')[$key])){
                   DB::table('movie_cast')
                   ->where('id', $request->post('cast_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'user_profile' => $request->post('user_profile')[$key],
                        'character_name' => $request->post('character_name')[$key],
                    ]);
                }
                else{
                     DB::table('movie_cast')->insert([
                        'movie_id' => $movie->id,
                        'user_profile' => $request->post('user_profile')[$key],
                        'character_name' =>$request->post('character_name')[$key],
                    ]);
                }
           
       }
       }
       
    //   return json_encode( $request->post('crew_type'));
    //   Enter Your Crew Members
        if(is_array($request->post('crew_profile')))
       {
       foreach($request->post('crew_profile') as $key=> $list){
           
           if(isset($request->post('crew_id')[$key])){
                   DB::table('movie_crew')
                   ->where('id', $request->post('crew_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'crew_profile' => $request->post('crew_profile')[$key],
                        'crew_type' => $request->post('crew_type')[$key],
                    ]);
                }
                else{
                     DB::table('movie_crew')->insert([
                        'movie_id' => $movie->id,
                        'crew_profile' => $request->post('crew_profile')[$key],
                        'crew_type' => $request->post('crew_type')[$key],
                    ]);
                }
           
       }
       }
       
       if(is_array($request->post('video')))
       {
            foreach($request->post('video') as $key=> $list){
           
           if(isset($request->post('video_id')[$key])){
                   DB::table('movie_video')
                   ->where('id', $request->post('video_id')[$key])
                   ->update([
                        'movie_id' => $movie->id,
                        'video_link' => $request->post('video')[$key],
                    ]);
                }
                else{
                     DB::table('movie_video')->insert([
                        'movie_id' => $movie->id,
                        'video_link' => $request->post('video')[$key],
                    ]);
                }
           
            }
       }
       
       if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                
                
                 $x=1;
            $name=time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $filePath = public_path('assets/movie/images/' . $name);
            $img->save($filePath, 30);
            
                // $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                // $upload_path = 'assets/movie/images/';
                // $file->move($upload_path, $name);
        
                DB::table('movie_image')->insert([
                    'movie_id' => $movie->id,
                    'image' => $name,
                ]);
            }
        }
        $request->session()->flash('message',$msg);
       return redirect('organize/movie_posts');
   }
   
   public function movie_delete(Request $request,$id){
       
       $movie = movie::find($id);
       $movie->delete();
       
       return redirect('organize/movie_posts');
   }
   
   public function search_user(Request $request){
       
        $query = $request->get('query');
        // return $query;

      // Perform the search using your Laravel model or database query
      $results = User::where('username', 'LIKE', '%' . $query . '%')->get();
    
      // Return the search results as a JSON response
     foreach($results as $list){
        echo "<option value=".$list->id.">$list->username</option>";
        }
   }
   
   public function delete_cast(Request $request,$id){
       DB::table('movie_cast')
        ->where('id', $id)
        ->delete();
        
        return redirect()->back();
   }
   
   public function delete_crew(Request $request,$id){
       DB::table('movie_crew')
        ->where('id', $id)
        ->delete();
        
        return redirect()->back();
   }
   
   public function delete_video(Request $request,$id){
       DB::table('movie_video')
        ->where('id', $id)
        ->delete();
        
        return redirect()->back();
   }
   
   public function delete_image(Request $request,$id){
       DB::table('movie_image')
        ->where('id', $id)
        ->delete();
        
        return redirect()->back();
   }
}
