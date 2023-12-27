@extends('front/layout')
@section('page_title','Film Maker')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
    .user_dashboard_pic {
  position: relative;
  /*width: 200px;*/
  /*height: 200px;*/
}

.user_dashboard_pic img.profile-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.user_dashboard_pic .profile-img-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  border-radius:20px;
}

.user_dashboard_pic:hover .profile-img-overlay {
  opacity: 1;
}

.user_dashboard_pic .change-profile-image {
  color: #fff;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 10px;
}

.hidden {
  display: none;
}

</style>

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Profile Settings</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Profile Settings</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    @if(DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->email_varify == 1)
    <div class="row"> 
      <div class="col-md-3">
		<div id="leftcol_item">
		    
			@if(DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->logo != '')
		  <!--<div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('assets/institute/logo/'.DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->logo)}}"> <span class="user-photo-action">{{ DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->company}}</span> </div>-->
		  <div class="user_dashboard_pic">
              <img alt="user photo" src="{{asset('assets/institute/logo/'.DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->logo)}}">
              <span class="user-photo-action">{{ DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->company}}</span>
              <div class="profile-img-overlay">
              <form id="profile_form" action="{{route('organize.manage_profile_image')}}" method="post" enctype="multipart/form-data">
	          @csrf
	           <input name="id" type="hidden" value="{{Session::get('organisation_ID')}}">
                <span class="change-profile-image">Change profile image</span>
                <input type="file" id="profile-image-upload" name="logo" class="hidden" accept="image/*" onchange="loadFile(event)">
            </form>
              </div>
            </div>
		  @else
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('assets/profile/default_avatar.jpg')}}"> <span class="user-photo-action">{{ DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->company}}</span> </div>
		  @endif
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li class="@yield('dashboard_select')"><a href="{{route('organize.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li class="@yield('manageprofile_select')"><a href="{{route('organize.manage_profile')}}"><i class="login-icon ti-user"></i> Edit Your Profile</a></li>
			<li class="@yield('job_select')"><a href="{{route('organize.job_posts')}}"><i class="login-icon ti-pin"></i> Upload New Job/ Audition</a></li>
			<li class="@yield('event_select')"><a href="{{route('organize.event_posts')}}"><i class="login-icon ti-list"></i> Upload New Events</a></li>
			<li class="@yield('movie_select')"><a href="{{route('organize.movie_posts')}}"><i class="login-icon ti-camera"></i> Upload your Movies</a></li>
			@if(DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->type == 'Educational')
			 <!--<li class="@yield('institute_select')"><a href="{{route('organize.institute_posts')}}"><i class="login-icon ti-list"></i>Promote Your Movie</a></li> -->
			<li class="@yield('courseoffered_select')"><a href="{{route('organize.course_offered')}}"><i class="login-icon ti-key"></i> Upload New Course offered</a></li>
			@else
			<li class="@yield('joboffered_select')"><a href="{{route('organize.job_offered')}}"><i class="login-icon ti-key"></i> Upload New Job offered</a></li>
			@endif
			<li class="@yield('gallery_select')"><a href="{{route('organize.manage_gallery')}}"><i class="login-icon ti-list"></i> Upload New Photos</a></li>
			<li class="@yield('videos_select')"><a href="{{route('organize.videos')}}"><i class="login-icon ti-camera"></i>Upload New Videos</a></li>
			
			<li class="@yield('password_select')"><a href="{{route('organize.change_password')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
			<li><a href="{{route('user.logout')}}"><i class="login-icon ti-power-off"></i> Logout</a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md-9">
	       @if(DB::table('user_representers')->where('id',Session::get('organisation_ID'))->first()->is_approved == '0')<h1 class="text-center text-danger"> Profile Sent for Approval</h1>@endif
      @section('organizecontainer')
    @show
      </div>	  
    </div>
    @else
        <div class="row"> 
            <div class="col-md-12">
                <h3>Please verify your email in order to access your account. We have sent an email to your email account. Thank you.</h3>
            </div>
        </div>
    @endif
  </div>
</section>

<script>
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        $('#profile_form').submit();
    };
    reader.readAsDataURL(event.target.files[0]);
  };
$(document).ready(function() {
  $('.change-profile-image').click(function() {
    $('#profile-image-upload').trigger('click');
  });
});

</script>
@endsection
