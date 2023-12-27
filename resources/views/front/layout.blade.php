<!DOCTYPE html>
<html  lang="en">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Jan 2023 04:02:07 GMT -->
<head>

<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

 
<title>FILMKAR - @yield('page_title')</title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="{{asset('assets/setting/Filmkar.png')}}" />

<!-- CSS -->
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap-select.min.css')}}">
<link href="{{asset('assets/plugins/icons/css/icons.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap/css/bootsnav.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/nice-select/css/nice-select.css')}}">
<link href="{{asset('assets/plugins/aos-master/aos.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>







<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css'>

<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/crop-image/iEdit.css?v=1')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/range.css')}}">

<!--Data tables-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<!--Chatbot-->

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/harsh.css')}}">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    
   
<style>
.swal2-confirm {
        background-color: #ED2024 !important;
    }
/* Import Google font - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

.chatbot {
    position: absolute;
    z-index: 1000; 
}
.chatbot-toggler {
  z-index: 999; 
}
.chatbot-toggler {
  position: fixed;
  bottom: 30px;
  right: 35px;
  outline: none;
  border: none;
  height: 50px;
  width: 50px;
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: red;
  transition: all 0.2s ease;
}
body.show-chatbot .chatbot-toggler {
  transform: rotate(90deg);
}
.chatbot-toggler span {
  color: #fff;
  position: absolute;
}
.chatbot-toggler span:last-child,
body.show-chatbot .chatbot-toggler span:first-child  {
  opacity: 0;
}
body.show-chatbot .chatbot-toggler span:last-child {
  opacity: 1;
}
.chatbot {
  position: fixed;
  right: 35px;
  bottom: 90px;
  width: 420px;
  background: #fff;
  border-radius: 15px;
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.5);
  transform-origin: bottom right;
  box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
              0 32px 64px -48px rgba(0,0,0,0.5);
  transition: all 0.1s ease;
}
body.show-chatbot .chatbot {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1);
}
.chatbot header {
  padding: 16px 0;
  position: relative;
  text-align: center;
  color: #fff;
  background: red;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.chatbot header span {
  position: absolute;
  right: 15px;
  top: 50%;
  display: none;
  cursor: pointer;
  transform: translateY(-50%);
}
header h2 {
  font-size: 1.4rem;
}
.chatbot .chatbox {
    overflow-y: auto;
    height: 380px ;
    padding: 30px 20px 100px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar {
  width: 6px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar-track {
  background: #fff;
  border-radius: 25px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 25px;
}
.chatbox .chat {
  display: flex;
  list-style: none;
}
.chatbox .outgoing {
  margin: 20px 0;
  justify-content: flex-end;
}
.chatbox .incoming span {
  width: 32px;
  height: 32px;
  color: #fff;
  cursor: default;
  text-align: center;
  line-height: 32px;
  align-self: flex-end;
  background: red;
  border-radius: 4px;
  margin: 0 10px 7px 0;
}
.chatbox .chat p {
  white-space: pre-wrap;
  padding: 12px 16px;
  border-radius: 10px 10px 0 10px;
  max-width: 75%;
  color: #fff;
  font-size: 0.95rem;
  background: #724ae8;
}
.chatbox .incoming p {
  border-radius: 10px 10px 10px 0;
}
.chatbox .chat p.error {
  color: #721c24;
  background: #f8d7da;
}
.chatbox .incoming p {
  color: #000;
  background: #f2f2f2;
}
.chatbot .chat-input {
  display: flex;
  gap: 5px;
  position: absolute;
  bottom: 0;
  width: 100%;
  background: #fff;
  padding: 3px 20px;
  border-top: 1px solid #ddd;
}
.chat-input textarea {
  height: 55px;
  width: 100%;
  border: none;
  outline: none;
  resize: none;
  max-height: 180px;
  padding: 15px 15px 15px 0;
  font-size: 0.95rem;
}
.chat-input span {
  align-self: flex-end;
  color: #724ae8;
  cursor: pointer;
  height: 55px;
  display: flex;
  align-items: center;
  visibility: hidden;
  font-size: 1.35rem;
}
.chat-input textarea:valid ~ span {
  visibility: visible;
}

@media (max-width: 490px) {
  .chatbot-toggler {
    right: 20px;
    bottom: 20px;
  }
  .chatbot {
    right: 0;
    bottom: 0;
    height: 100%;
    border-radius: 0;
    width: 100%;
  }
  .chatbot .chatbox {
    height: 90%;
    padding: 25px 15px 100px;
  }
  .chatbot .chat-input {
    padding: 5px 15px;
  }
  .chatbot header span {
    display: block;
  }
}
</style>
</head>
<body class="utf_skin_area">
<!--<div class="page_preloader"></div>-->
<!-- ======================= Start Navigation ===================== -->
<!-- class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav" -->
<nav class="navbar navbar-default navbar-mobile navbar-fixed @yield('nav_class') bootsnav">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
      <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('assets/setting/logo_white.png')}}" style="height: 60px; padding-bottom: 15px;" class="logo logo-display" alt=""> <img src="{{asset('assets/setting/logo_black.png')}}" style="height: 60px; padding-bottom: 15px;" class="logo logo-scrolled" alt=""> </a> 
	</div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
        <li class="dropdown @yield('home_select')"> <a href="{{route('home')}}">Home</a> </li>
        <!--<li class="dropdown"> -->
        <!--  <a href="{{route('talent.browse')}}"  id="browseTalentLink" class="dropdown-toggle btn-signup " data-toggle="dropdown">Browse talent</a>-->
        <!--  <ul id="talentDropdownMenu" class="dropdown-menu animated fadeOutUp" style="height: 300px; overflow: scroll; display: none;">-->
        <!--    @foreach(DB::table('categories')->where('parent_id',null)->orderby('category_name')->get(); as $list)-->
        <!--    <li><a href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></li>-->
        <!--    @endforeach-->
        <!--  </ul>-->
        <!--</li>-->
        <li class="dropdown"><a href="{{route('talent.browse')}}" class="" id="browseTalentLink" >Browse talent <span class="caret"></span></a>
        <ul id="talentDropdownMenu" class="dropdown-menu animated fadeOutUp" style="height: 300px; overflow: scroll; display: none;">
            @foreach(DB::table('categories')->where('parent_id',null)->orderby('category_name')->get(); as $list)
            <li><a href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></li>
            @endforeach
        </ul>
        </li>
        <li class="dropdown @yield('job_select')"> <a href="{{route('jobs')}}">Jobs</a> </li>
        <li class="dropdown @yield('event_select')"> <a href="{{route('events')}}">Events</a> </li>
        <li class="dropdown @yield('movie_select')"> <a href="{{route('movies')}}">Movies</a> </li>
        <li class="dropdown @yield('institute_select')"> <a href="{{route('institutes')}}">Organisation</a> </li>
        <li class="dropdown @yield('contact_select')"> <a href="{{route('contact')}}">Contact</a> </li>
        <li class="dropdown @yield('blog_select')"> <a href="{{route('blog')}}">Blog</a> </li>
        <!--<li class="dropdown @yield('discussion_select')"> <a href="{{route('discussion')}}">Discussion</a> </li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(session()->has('USER_ID'))
      <li class="dropdown sign-up"> 
		  <a class="dropdown-toggle btn-signup red-btn" data-toggle="dropdown" href="#"> 
			<img src="" class="img-responsive img-circle" alt="">{{ Session::get('USER_NAME')}}
		  </a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="{{route('user.dashboard')}}">Profile</a></li>
            <li><a href="{{route('user.logout')}}">Logout</a></li>
          </ul>
        </li>
          @elseif(session()->has('organisation_ID'))
          <li class="dropdown sign-up"> 
          <a class="dropdown-toggle btn-signup red-btn" data-toggle="dropdown" href="#"> 
          <img src="" class="img-responsive img-circle" alt="">{{ Session::get('organisation_NAME')}}
          </a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="{{route('organize.dashboard')}}">Profile</a></li>
            <li><a href="{{route('user.logout')}}">Logout</a></li>
          </ul>
        </li>
          @else
          
        <li class="br-right"><a class="btn-signup red-btn" href="javascript:void(0)" data-toggle="modal" data-target="#signin"><i class="login-icon ti-user"></i>Login</a></li>
        <li class="dropdown"><a class="btn-signup red-btn" id="registertoggle" ><span class="ti-briefcase"></span>Register As</a>
        <ul id="registerDropdownMenu" class="dropdown-menu animated fadeOutUp" style="width:100px">
            <li class="sign-up"><a class="btn-signup red-btn" style="text-align:unset" href="{{route('user.register')}}"><span class="ti-user"></span>&nbsp;&nbsp;Talent</a>
            <li class="sign-up"><a class="btn-signup red-btn" style="text-align:unset" href="{{route('user.register.organisation')}}"><span class="fa-solid fa-building"></span>&nbsp;&nbsp;Organisation</a>
        </ul>
        </li>
        
        </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- ======================= End Navigation ===================== --> 
@section('container')
@show
<!-- ================= footer start ========================= -->
<footer class="footer" style="background-color: #F0F8FF;">
  <div class="container"> 
    <div class="row">
	  <div class="col-md-3 col-sm-4">
    <a href="/"><img class="footer-logo" src="{{asset('assets/setting/logo-color.png')}}" alt=""></a>
        <p>{{ DB::table('settings')->first()->footer_text }}</p>
        
      </div>	
      <div class="col-md-9 col-sm-8">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <h4>Comapny</h4>
            <ul>
              <li><a href="{{route('home')}}"><i class="fa fa-angle-double-right"></i> Home</a></li>
              <li><a href="{{route('pages.aboutus')}}"><i class="fa fa-angle-double-right"></i> About</a></li>
              <li><a href="{{route('blog')}}"><i class="fa fa-angle-double-right"></i> Blogs</a></li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="{{route('talent.browse')}}"><i class="fa fa-angle-double-right"></i> Browse Talent</a></li>
              <li><a href="{{route('jobs')}}"><i class="fa fa-angle-double-right"></i> Jobs</a></li>
              <li><a href="{{route('events')}}"><i class="fa fa-angle-double-right"></i> Events</a></li>
              <li><a href="{{route('movies')}}"><i class="fa fa-angle-double-right"></i> Movies</a></li>
              <li><a href="{{route('institutes')}}"><i class="fa fa-angle-double-right"></i> Organisations</a></li>
            </ul>
          </div>
          <div class="col-md-3 col-sm-6">
            <h4>Help</h4>
            <ul>
              <li><a href="{{route('pages.privacypolicy')}}"><i class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
              <li><a href="{{route('pages.terms_and_conditions')}}"><i class="fa fa-angle-double-right"></i> Terms and Conditions</a></li>
              <li><a href="{{route('contact')}}"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
            </ul>
          </div>
		 <div class="col-md-3 col-sm-6">
    <h4>Stay Connected</h4>
    <div class="f-social-box" style="margin-left: -2px;">
        <ul>
            <li><a href="{{ DB::table('settings')->first()->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
        </ul>
    </div>
</div>

        </div>
      </div>      
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="copyright text-center">
          <p>Copyright © 2021 All Rights Reserved.</p>		  
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="myModalLabel1">
      <div class="modal-body1">
        <!-- Nav tabs -->
       <ul class="nav nav-tabs  " role="tablist" style="margin:10px auto 30px;margin-left: 105px;border: none; border-radius: 6px;">
          <li class="nav-item active"> <a class="nav-link" data-toggle="tab" href="#employer" role="tab" style="border-radius: 7px;  "> <i class="ti-user" ></i> Login as Talent</a> </li>
          
          <li class="nav-item" style="margin-left: 10px;"> <a class="nav-link" data-toggle="tab" href="#candidate" role="tab" style="border-radius: 7px;"> <i class="fa-solid fa-building"></i> Login as Organisation</a> </li>
        </ul>
        <!-- Nav tabs --> 
        <!-- Tab panels -->
        <div class="tab-content"> 
          <!-- Employer Panel 1-->
          <div class="tab-pane fade in show active" id="employer" role="tabpanel" style="backgound-color:red;">
          <form  action="{{route('user.checklogintelent')}}" method="post" id="login_telent">
          <!-- <form  method="POST"  id="login_telent"> -->
            @csrf
            <p style="color:red">Login as Talent</p>
            <p id="msg_telent"></p>
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email address or usernames">
              </div>
              <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
              <div class="form-group"> <span class="custom-checkbox">
                <input type="checkbox" id="4">
                <label for="4"></label>
                Remember Me </span> <a href="#" id="forgot_telent" title="Forget" class="fl-right">Forgot Password?</a> 
                
			        </div>
			        <a href="{{route('user.register')}}" id="forgot_telent" title="Forget" class="fl-right" style="margin-bottom: 10px;">Not yet Registered.Register now</a> 
              <div class="form-group text-center">
              <button type="submit" id="btn_login_telent" class="btn theme-btn full-width btn-m">Login</button>
              <!-- <input type="submit" id="login_telent" class="btn theme-btn full-width btn-m" value="LogIn"> -->
              </div>
            </form>
          </div>
          <!--/.Panel 1--> 
          
          <!-- Candidate Panel 2-->
          <div class="tab-pane fade" id="candidate" role="tabpanel">
          <form  action="{{route('user.checkloginorganize')}}" method="post" id="form_login_organize">
          <!-- <form  method="post" > -->
            @csrf
            <p style="color:red">Login as Organisation</p>
            <p id="msg_organize"></p>
              <div class="form-group">
                <input type="text" name="email" id="email2" class="form-control" placeholder="Enter your email address or username">
              </div>
              <div class="form-group">
                <input type="password" name="password" id="password2" class="form-control" placeholder="Password">
              </div>
              <div class="form-group"> <span class="custom-checkbox">
                <input type="checkbox" id="44">
                <label for="44"></label>
                Remember Me </span> <a href="#" id="forgot_organize" title="Forget" class="fl-right">Forgot Password?</a> 
			  </div>
			  <a href="{{route('user.register.organisation')}}" id="forgot_telent" title="Forget" class="fl-right" style="margin-bottom: 10px;">Not yet Registered.Register now</a> 
              <div class="form-group text-center">
              <button type="submit" id="btn_login_organize" class="btn theme-btn full-width btn-m">Login</button>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="telent-forgot" role="tabpanel">
          <form action="{{route('user.telentforgotpassword')}}" method="post" id="telent_forgot_form">
            @csrf
            <h2 class="text-center">Forgot Password</h2>
            <p id="msg_telent_forgot" style="color:red;"></p>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" required class="form-control" placeholder="Email Address">
              </div>
              <div class="form-group text-center">
                <input type="submit" id="telentforgot" class="btn theme-btn full-width btn-m" value="Submit">
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="organize-forgot" role="tabpanel">
          <form action="{{route('user.organizeforgotpassword')}}" method="post" id="organize_forgot_form">
            @csrf
            <h2 class="text-center">Forgot Password</h2>
            <p id="msg_organize_forgot" style="color:red;"></p>
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email2" required class="form-control" placeholder="Email Address">
              </div>
              <div class="form-group text-center">
                <input type="submit" id="organizeforgot" class="btn theme-btn full-width btn-m" value="Submit">
              </div>
            </form>
          </div>
        </div>
        <!-- Tab panels --> 
        
      </div>
    </div>
  </div>
</div>
@php
$que = DB::table('chatbot')->get();
@endphp
<!--<div><a href="#"><img src="assets/img/page.png" alt="Scroll Up" class="scrollup"></a></div>-->
<button class="chatbot-toggler">
      <span class="material-symbols-rounded">mode_comment</span>
      <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
      <header>
        <h2 style="color:white;margin: 3px;text-align: center;">FILMKAR</h2>
        <span class="close-btn material-symbols-outlined">close</span>
      </header>
      <ul class="chatbox">
      @foreach($que as $key => $oneque)
          <li class="chat incoming">
            <span class="material-symbols-outlined">smart_toy</span>
            <a href="#" onclick="getreplay('{{$oneque->id}}','{{$key}}')">{{$oneque->question}}</a>
          </li>
          <div id="replay{{$key}}"></div>
        @endforeach
        

      </ul>
      <div class="chat-input">
        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
        <span id="send-btn" class="material-symbols-rounded">send</span>
      </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Jquery js--> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script> 
<script src="{{asset('assets/js/login.js')}}"></script> 
<script src="{{asset('assets/js/range.js')}}"></script> 
<script src="{{asset('assets/js/jobapplied.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootsnav.js')}}"></script> 
<script src="{{asset('assets/js/viewportchecker.js')}}"></script> 
<script src="{{asset('assets/js/slick.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/wysihtml5-0.3.0.js')}}"></script> 
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap-wysihtml5.js')}}"></script> 
<script src="{{asset('assets/plugins/aos-master/aos.js')}}"></script> 
<script src="{{asset('assets/plugins/nice-select/js/jquery.nice-select.min.js')}}"></script> 
<script src="{{asset('assets/plugins/crop-image/iEdit.js?v=1')}}"></script>
<script src="{{asset('assets/plugins/crop-image/script.js')}}"></script>
<script src="{{asset('assets/js/validate.js?v='.now())}}"></script>

<!--<script src="assets/js/custom.js"></script> -->

<script>

function getreplay(que,key){
        $.get("/getreplay/"+que, function(data){
        $("#replay"+key).append(data);
    });
    }

$(document).ready(function() {
  $("#browseTalentLink").click(function(e) {
    var windowWidth = $(window).width();
    if (windowWidth <= 992) {
        e.preventDefault();
      $("#talentDropdownMenu").toggle();
    }
  });
  $("#registertoggle").click(function(e) {
    var windowWidth = $(window).width();
    if (windowWidth <= 992) {
        e.preventDefault();
      $("#registerDropdownMenu").toggle();
    }
  });
});

$(document).ready(function(){
		"use strict";
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.scrollup').fadeIn();
			} else {
				$('.scrollup').fadeOut();
			}
		});
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
	});
</script>
 
<script>
    const chatbotToggler = document.querySelector(".chatbot-toggler");
const closeBtn = document.querySelector(".close-btn");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");

let userMessage = null; // Variable to store user's message
const API_KEY = "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"; // Paste your API key here
const inputInitHeight = chatInput.scrollHeight;

const createChatLi = (message, className) => {
    // Create a chat <li> element with passed message and className
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", `${className}`);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;
    return chatLi; // return chat <li> element
}

const generateResponse = (chatElement) => {
    const API_URL = "https://api.openai.com/v1/chat/completions";
    const messageElement = chatElement.querySelector("p");

    // Define the properties and message for the API request
    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{role: "user", content: userMessage}],
        })
    }

    // Send POST request to API, get response and set the reponse as paragraph text
    fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
        messageElement.textContent = data.choices[0].message.content.trim();
    }).catch(() => {
        messageElement.classList.add("error");
        messageElement.textContent = "Oops! Something went wrong. Please try again.";
    }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
}

const handleChat = () => {
    userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
    if(!userMessage) return;

    // Clear the input textarea and set its height to default
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`;

    // Append the user's message to the chatbox
    chatbox.appendChild(createChatLi(userMessage, "outgoing"));
    chatbox.scrollTo(0, chatbox.scrollHeight);
    
    setTimeout(() => {
        // Display "Thinking..." message while waiting for the response
        const incomingChatLi = createChatLi("Thinking...", "incoming");
        chatbox.appendChild(incomingChatLi);
        chatbox.scrollTo(0, chatbox.scrollHeight);
        generateResponse(incomingChatLi);
    }, 600);
}

chatInput.addEventListener("input", () => {
    // Adjust the height of the input textarea based on its content
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});

chatInput.addEventListener("keydown", (e) => {
    // If Enter key is pressed without Shift key and the window 
    // width is greater than 800px, handle the chat
    if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handleChat();
    }
});

sendChatBtn.addEventListener("click", handleChat);
closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
</script>
</body>

</html>