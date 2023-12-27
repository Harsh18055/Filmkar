<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\movie;
use App\Models\job_posts;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\user_gallery;
use App\Models\user_category;
use App\Models\user_videos;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\user_representer;
use App\Models\Admin\Category;
use App\Mail\Eventapprovalmail;
use DateTime;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('admin');
        }
    }

    public function dashboard()
    {

        $pendding_users = User::where('status','0')->count();
        $approved_users = User::where('status','1')->count();
        $pendding_movies = user_representer::where('is_approved','0')->count();
        $approved_movies = user_representer::where('is_approved','1')->count();
        $pendding_evnts = Event::where('is_approved','0')->count();
        $approved_evnts =Event::where('is_approved','1')->count();
        $pendding_mov = movie::where('is_approved','0')->count();
        $approved_mov =movie::where('is_approved','1')->count();
        $pendding_job = job_posts::where('is_approved','0')->count();
         $approved_job =job_posts::where('is_approved','1')->count();
        return view('admin.dashboard',compact('pendding_users','approved_users','pendding_movies','approved_movies','pendding_evnts','approved_evnts','pendding_mov','approved_mov','approved_job','pendding_job'));
    }

    public function create(Request $request){

        // $model = new Admin();
        // $model->email = "admin@admin.com";
        $request->validate([
            'email'=>'required',
        ]);

        if($request->post('id')>0){
            $model=Admin::find($request->post('id'));
            $msg="Admin updated";
        }else{
            $model = new Admin();
            $msg="Admin Added.";
            $model->password = hash::make($request->post('password'));
        }

        $model->email = $request->post('email');
        $model->name=$request->post('name');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/admins');
        
    }

    public function pending_users(){

        $result['pendding_users'] = User::where('status','0')->orwhere('status','2')->get();
         $result['new']=User::where('is_view','0')->update(['is_view'=>'1']);
        return view('admin.pending_users',$result);

    }

    public function approved_users(){

        $result['pendding_users'] = DB::table('users')
        ->select('users.id','users.status','users.isfeatured','users.username','users.email','users.phonenumber', DB::raw('COALESCE(count(referrals.id), 0) as reffral_count'))
        ->leftJoin('referrals', 'users.id', '=', 'referrals.referred_id')
        ->groupBy('users.id','.status','users.isfeatured','users.username','users.email','users.phonenumber')
        ->where('status','1')
        ->get();

        return view('admin.approved_users',$result);

    }

    public function pending_organize(){

        $result['pending_organize'] = user_representer::where('is_approved','0')->latest('updated_at')->get();
        $result['new']=user_representer::where('is_view','0')->update(['is_view'=>'1']);
        return view('admin.pending_organize',$result);

    }

    public function approved_organize(){

        $result['approved_organize'] = user_representer::where('is_approved','1')->latest('updated_at')->get();

        $result['pendding_users'] = DB::table('user_representers')
        ->select('user_representers.id','user_representers.is_approved','user_representers.username','user_representers.email','user_representers.type','user_representers.company', DB::raw('COALESCE(count(representer_referrals.id), 0) as reffral_count'))
        ->leftJoin('representer_referrals', 'user_representers.id', '=', 'representer_referrals.referred_id')
        ->groupBy('user_representers.id','user_representers.is_approved','user_representers.username','user_representers.email','user_representers.type','user_representers.company')
        ->where('is_approved','1')
        ->get();

        // return $result['pendding_users'];
        return view('admin.approved_organize',$result);

    }

    public function userstatus(Request $request,$status,$id){
        $model=User::find($id);
        $model->status=$status;
        $model->save();
        
        if($status == '1'){
        $details = [
                'username' => $model->username,
                'message' => 'Thank you for your Patience. Your Profile is approved & live now.'
            ];
        \Mail::to($model->email)->send(new \App\Mail\Eventapprovalmail($details));
        }else{
        $details = [
                'username' => $model->username,
                'message' => 'Thank you for your Patience. Your Profile is Disapproved by the Admin. Pls do the necessary Changes to make it live.'
            ];
        \Mail::to($model->email)->send(new \App\Mail\Eventapprovalmail($details));
        }
        $request->session()->flash('message','status updated');

        if($status == '1'){
            return redirect('admin/users/pending');
        }else{
        return redirect('admin/users/approved');
        }
    }

    public function organizestatus(Request $request,$is_approved,$id){
        $model=user_representer::find($id);
        $model->is_approved=$is_approved;
        $model->save();
        $request->session()->flash('message','status updated');

        if($is_approved == 1){
            return redirect('admin/organize/pending');
        }else{
        return redirect('admin/organize/approved');
        }
    }

    public function isfeatured(Request $request,$isfeatured,$id){
        $model=User::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','status updated');
        return redirect('admin/users/approved');

    }

    public function organize_isfeatured(Request $request,$isfeatured,$id){
        $model=user_representer::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','status updated');
        return redirect('admin/organize/approved');

    }

    public function userdetails(Request $request,$id){

        $result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::leftjoin('states', 'users.state_id', '=', 'states.id')
        ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
        ->select('users.*','states.name as state','cities.city as city')
        ->where('users.id',$id)
        ->first();


        $result['galleryArr'] = user_gallery::where('user_id',$result['vendor']->id)->get();

        $bday = new DateTime($result['vendor']->birthdate); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $result['yearsold'] = $diff->y;

       
        
        foreach($result['vendor']->categories as $list){

            $result['categoryname'][] = $list->category_name;
        }
        
        // return $result['categoryname'];
        $result['videosarr'] = user_videos::where('user_id',$result['vendor']->id)->get();

        // return $result['vendor'];
        return view('admin/user_details',$result);

    }

  public function organizedetails(Request $request, $id){
    $result['category'] = Category::where('parent_id', null)->get();
        
    $result['vendor'] = user_representer::leftjoin('states', 'user_representers.state_id', '=', 'states.id')
        ->leftjoin('cities', 'user_representers.city_id', '=', 'cities.id')
        ->select('user_representers.*','states.name as state','cities.city as city')
        ->where('user_representers.id', $id)
        ->first();
        
    if ($result['vendor']) {
        $result['galleryArr'] = user_gallery::where('user_id', $result['vendor']->id)->get();

        $bday = new DateTime($result['vendor']->birthdate); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $result['yearsold'] = $diff->y;

        $result['categoryname'] = [];
        if ($result['vendor']->categories) {
            foreach ($result['vendor']->categories as $list) {
                $result['categoryname'][] = $list->category_name;
            }
        }

        $result['videosarr'] = user_videos::where('user_id', $result['vendor']->id)->get();
    }

    return view('admin/user_details', $result);
}


    public function admins(){
        
        $result['data']=Admin::where('is_superadmin','0')->get();
        return view('admin/admins',$result);
    }

    public function manage_admins(Request $request,$id=''){
        if($id>0){
            $arr=Admin::where(['id'=>$id])->get(); 

            $result['email']=$arr['0']->email;
            $result['password']=$arr['0']->password;
            $result['name']=$arr['0']->name;
            $result['id']=$arr['0']->id;
        }else{
            $result['email']='';
            $result['password']='';
            $result['name']='';
            $result['id']='';
        }
        return view('admin/manage_admins',$result);
    }

    public function admindelete(Request $request,$id){
        Admin::where('id',$id)->delete();
        return redirect('admin/admins');
    }

    public function birthday_wish(){
        $today_date = date('md');
        // return $today_date;
        $user = User::whereRaw("DATE_FORMAT(birthdate, '%m%d') = $today_date")->get();

        foreach($user as $list){

            $details = [
                'username' => $list->username,
            ];
            \Mail::to($list->email)->send(new \App\Mail\birthdaywishmail($details));
        }
    }
    
    public function delete_user(Request $request,$id){
        $model=User::find($id);
        $model->delete();
        $request->session()->flash('message','User deleted');
        return redirect()->back();
    }
    
    public function delete_organize(Request $request,$id){
        $model=user_representer::find($id);
        $model->delete();
        $request->session()->flash('message','Organize deleted');
        return redirect()->back();
    }
}
