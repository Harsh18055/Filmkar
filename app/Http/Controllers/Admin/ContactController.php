<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
     public function contact_process(Request $request){
        // return $request->all();
        
        if($_SERVER["REQUEST_METHOD"] === "POST")
{
  
    $recaptcha_secret = "{6LdY8sYoAAAAAPvqEsm8jUKMqb_VEaLFnuCBjwO8}";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
    $response = json_decode($response, true);
  
    if($response["success"] === true){
        echo "Form Submit Successfully.";
    }else{
        echo "You are a robot";
    }
  
}
$this->validate($request, [
    'g-recaptcha-response' => 'required'
], [
    'g-recaptcha-response.required' => 'Invalid captcha'
]);

        
        $details = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
        \Mail::to('web@filmkar.com')->send(new \App\Mail\ContactUs($details));
        
        $request->session()->flash('message','Thank you for contacting us. We will get back to you soon.');
        return redirect('/contact');
    }
}
