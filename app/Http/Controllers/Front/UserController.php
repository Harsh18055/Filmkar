<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\User;
use App\Models\user_category;
use App\Models\user_language;
use App\Models\user_representer;
use App\Models\Referral;
use App\Models\Referral_Representer;
use App\Models\user_attr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Mail\Eventapprovalmail;
use Session;
use DB;

class UserController extends Controller
{

    public function index(Request $request){
        $result['category']=Category::where('parent_id',null)->get();
        
        return view('front/login',$result);

    }
    
    
public function user_register(Request $request){

        // return $request->post();
        
        $request->validate([
            'username'=>'required|unique:users',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users',
            'phonenumber'=>'required',
            'password'=>'required',
            'c_password'=>'required',
            
        ]);

        $username = $request->post('username');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $phonenumber = $request->post('phonenumber');
        $password = $request->post('password');
        $c_password = $request->post('c_password');



        

        if($password != $c_password){

            $request->session()->flash('error','Please enter correct Confirm password');
            return redirect('register');
        }

        $user = new User;
        $user->username = strtolower($username);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phonenumber = $phonenumber;
        $user->email_varify = 1;
        $user->password = hash::make($password);
        $user->save();

       if($request->get('referral_code'))
       {
            $validatedData = $request->validate([
                'referral_code' => 'required|exists:users,referral_code',
            ]);
            $referral_code = $request->get('referral_code');
    
            if($referral_code != null){
                $referral = new Referral;
                $referral->referrer_id = $user->id;
                $referredUser = User::where('referral_code', $referral_code)->first();
                $referral->referred_id = $referredUser->id;
                $referral->save();
    
                $reffered_points = DB::table('points_setting')->where('key', 'per_reffered')->first()->value;
                $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
    
                DB::table('users')->where('id', $user->id)->update(['points' => $referrer_points]);
    
                $sum = $reffered_points + $referredUser->points;
                DB::table('users')->where('id', $referredUser->id)->update(['points' => $sum]);
            }else{
                $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
                DB::table('users')->where('id', $user->id)->update(['points' => '3']);
            }
       }


       
        // return "hii";
         $verificationUrl = "https://filmkar.com/varify?email=" . base64_encode($email)."&type=1";
        $details = [
            'username' => $username,
            'email' => $email,
            'subject' => "Varify email For Filmaker",
            'message' => "Please click the following link to verify your account: " . $verificationUrl

        ];
       Mail::to($email)->send(new Eventapprovalmail($details));
        // dd(\Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details)));
        Session::flash('success', 'Mail Send successful!');
              
        $request->session()->put('USER_ID',$user->id);
        $request->session()->put('USER_NAME',$user->username);
        return redirect('user/dashboard');
    }
    
    public function varify_account(Request $request)
    {
        $type = $request->get('type');
        
        if($type == 1)
        {
            $user = User::where('email', base64_decode($request->get('email')))->first();
            if($user)
            {
                $user->email_varify = 1;
                $user->save();
                
                session()->put('USER_ID',$user->id);
                session()->put('USER_NAME',$user->username);
                return redirect('user/dashboard');
            }
            else
            {
                return "Invalid parameter U can't varify your account";
            }
        }
        elseif($type == 2)
        {
            $user_representer = user_representer::where('email', base64_decode($request->get('email')))->first();
            if($user_representer)
            {
                $user_representer->email_varify = 1;
                $user_representer->save();
                
                session()->put('organisation_ID',$user_representer->id);
                session()->put('organisation_NAME',$user_representer->username);
                return redirect('organize/dashboard');
            }
            else
            {
                return "Invalid parameter U can't varify your account";
            }
        }
        
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=User::where(['email'=>$email])->first();
        
        if($result){
            // if($result->status == '0'){
            //     $request->session()->flash('error','Your account is unactive plz contact admin.');
            //     return redirect('/login');
            // }
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('USER_ID',$result->id);
                $request->session()->put('USER_NAME',$result->username);
                return redirect('/');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/login');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/login');
        }
    }

    public function organisation_user_auth(Request $request){

        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=user_representer::where(['email'=>$email])->first();
        
        if($result){
            if($result->status == '0'){
                $request->session()->flash('error','Your account is unactive plz contact admin.');
                return redirect('/login');
            }
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('organisation_ID',$result->id);
                $request->session()->put('organisation_NAME',$result->name);
                return redirect('/');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/login');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/login');
        }
    }

    public function organisation_register(Request $request){

        // return $request->post();

        $request->validate([
            'username'=>'required|unique:user_representers',
            'email'=>'required|unique:user_representers',
            'password'=>'required',
            'cpassword'=>'required',
            'company'=>'required',
        ]);

        $username = $request->post('username');
        $email = $request->post('email');
        $password = $request->post('password');
        $cpassword = $request->post('cpassword');
        $company = $request->post('company');
        

        if($password != $cpassword){
            $request->session()->flash('error','Please enter valid password!');
            return redirect()->back();
        }

        $user_representer = new user_representer;
        $user_representer->username = strtolower($username);
        $user_representer->email = $email;
        $user_representer->password = hash::make($password);
        $user_representer->company = $company;
        $user_representer->save();

       

        $referral_code = $request->post('referral_code');

        if($referral_code != ''){

            $validatedData = $request->validate([
                'referral_code' => 'exists:user_representers,referral_code',
            ]);

            $Referral_Representer = new Referral_Representer;
            $Referral_Representer->referrer_id = $user_representer->id;
            $referredUser = user_representer::where('referral_code', $validatedData['referral_code'])->first();
            $Referral_Representer->referred_id = $referredUser->id;
            $Referral_Representer->save();
        }

        $referral_code = $request->get('referral_code');

        if($referral_code != null){
            $Referral_Representer = new Referral_Representer;
            $Referral_Representer->referrer_id = $user_representer->id;
            $referredUser = user_representer::where('referral_code', $validatedData['referral_code'])->first();
            $Referral_Representer->referred_id = $referredUser->id;
            $Referral_Representer->save();

            $reffered_points = DB::table('points_setting')->where('key', 'per_reffered')->first()->value;
            $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;

            DB::table('user_representers')->where('id', $user_representer->id)->update(['points' => $referrer_points]);

            $sum = $reffered_points + $referredUser->points;
            DB::table('user_representers')->where('id', $referredUser->id)->update(['points' => $sum]);
        }else{
            $referrer_points = DB::table('points_setting')->where('key', 'per_referrer')->first()->value;
            DB::table('user_representers')->where('id', $user_representer->id)->update(['points' => '3']);
        }
        
        // $verificationUrl = "https://filmkar.com/varify?email=" . base64_encode($email)."&type=2";
        // $details = [
        //     'username' => $username,
        //     'email' => $email,
        //     'subject' => "Varify email For Filmaker",
        //     'message' => "Please click the following link to verify your account: " . $verificationUrl

        // ];
       
        // \Mail::to($email)->send(new \App\Mail\Eventapprovalmail($details));
        // Session::flash('success', 'Mail Send successful!');
        
        $request->session()->put('organisation_ID',$user_representer->id);
        $request->session()->put('organisation_NAME',$user_representer->username);
        return redirect('organize/dashboard');
        // $request->session()->flash('message','Register Succsess!');
        // return redirect('/login');
    }

    public function checklogintelent(Request $request){

        $email = $request->post('email');
        $password = $request->post('password');

        $checkemail=User::where('email',$email)->first();
        $checkusername=User::where('username',$email)->first();
        if($checkemail){
            // if($checkemail->status == '0'){
            //     return response()->json(['success' => false,'msg' => 'Your account is unactive plz contact admin.']);

            // }
            if(Hash::check($request->post('password'),$checkemail->password)){
                $request->session()->put('USER_ID',$checkemail->id);
                $request->session()->put('USER_NAME',$checkemail->username);
                return response()->json(['success' => true,'msg' => 'Login Succsess.']);

            }else{
                return response()->json(['success' => false,'msg' => 'Please enter correct password.']);

            }
        }elseif($checkusername){
            if($checkusername->status == '0'){
                return response()->json(['success' => false,'msg' => 'Your account is unactive plz contact admin.']);

            }
            if(Hash::check($request->post('password'),$checkusername->password)){
                $request->session()->put('USER_ID',$checkusername->id);
                $request->session()->put('USER_NAME',$checkusername->username);
                return response()->json(['success' => true,'msg' => 'Login Succsess.']);
            }else{
                return response()->json(['success' => false,'msg' => 'Please enter correct password.']);
            }
        }
        else{
            return response()->json(['success' => false,'msg' => 'Please enter valid login details.']);

        }
        
    }

    public function checkloginorganize(Request $request){

        $email = $request->post('email');
        $password = $request->post('password');

        $checkemail=user_representer::where('email',$email)->first();
        $checkusername=user_representer::where('username',$email)->first();
        if($checkemail){
            // if($checkemail->status == '0'){
            //     return response()->json(['success' => false,'msg' => 'Your account is unactive plz contact admin.']);

            // }
            if(Hash::check($request->post('password'),$checkemail->password)){
                $request->session()->put('organisation_ID',$checkemail->id);
                $request->session()->put('organisation_NAME',$checkemail->username);
                return response()->json(['success' => true,'msg' => 'Login Succsess.']);

            }else{
                return response()->json(['success' => false,'msg' => 'Please enter correct password.']);

            }
        }elseif($checkusername){
            if($checkusername->status == '0'){
                return response()->json(['success' => false,'msg' => 'Your account is unactive plz contact admin.']);

            }
            if(Hash::check($request->post('password'),$checkusername->password)){
                $request->session()->put('organisation_ID',$checkusername->id);
                $request->session()->put('organisation_NAME',$checkusername->username);
                return response()->json(['success' => true,'msg' => 'Login Succsess.']);
            }else{
                return response()->json(['success' => false,'msg' => 'Please enter correct password.']);
            }
        }
        else{
            return response()->json(['success' => false,'msg' => 'Please enter valid login details.']);

        }
        
    }

    public function telentforgotpassword(Request $request){
        $email = $request->get('email');
        $user_type = 'telent';

        $User = User::where('email',$email)->first();
            if($User){
                $User = User::find($User->id);
                $token = time() . rand(1, 100);
                $User->remember_token = $token;
                $User->save();
    
                $url_parms = URL::to('/chnagepassword?email=').$email.'&'.'token='.$token.'&'.'user_type='.$user_type;
                // return $url_parms;
    
                $details = [
                    'username' => $User->username,
                    'email' => $User->email,
                    'url' => $url_parms
                ];
            //    return $email;
                \Mail::to($email)->send(new \App\Mail\forgotmail($details));
                return response()->json(['success' => true,'msg' => 'Email Sent Succsessfully.']);

            }else{
                return response()->json(['success' => false,'msg' => 'Email Not Found!.']);

            }   
    }

    public function organizeforgotpassword(Request $request){
        $email = $request->get('email');
        $user_type = 'organize';

        $User = user_representer::where('email',$email)->first();
            if($User){
                $User = user_representer::find($User->id);
                $token = time() . rand(1, 100);
                $User->remember_token = $token;
                $User->save();
    
                $url_parms = URL::to('/chnagepassword?email=').$email.'&'.'token='.$token.'&'.'user_type='.$user_type;
                // return $url_parms;
    
                $details = [
                    'username' => $User->username,
                    'email' => $User->email,
                    'url' => $url_parms
                ];
            //    return $email;
                \Mail::to($email)->send(new \App\Mail\forgotmail($details));
                return response()->json(['success' => true,'msg' => 'Email Sent Succsessfully.']);

            }else{
                return response()->json(['success' => false,'msg' => 'Email Not Found!.']);

            }   
    }
}
