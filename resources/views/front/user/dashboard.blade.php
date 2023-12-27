@extends('front/user/layout')
@section('page_title','Dashboard')
@section('dashboard_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
@if($email_varify == 1)
<div class="col-md-12 col-sm-12 col-xs-12  ">
  <div class="form-group">
	<h3 class="text-center">Welcome to Filmkar, make sure to update all necessary fields provided along with Profile Photo.</h3>
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12  ">
  <div class="form-group">
	<p class="text-center" style="background-color:skyblue; padding: 10px; color:black;">To update Your Profile, go to Left side of Website and click on "Edit your Profile" option and you will see a form with all fields. Similarly you can upload your Gallery Photos & videos by clicking on respective options below there.</p>
	</div>
</div>
<div id="dashboard_listing_blcok">
    
	
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Job Applied</h3>
			  <div class="statusbox-content">
				<a href="{{asset('user/applied_job_list')}}" class="ic_status_item ic_col_two"><i class="fa fa-tasks"></i></a>
				<h2>{{$applied_job}}</h2>
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Total Referral</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-share"></i></p>
				<h2>{{$reffral_count}}</h2> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Total Points</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-star"></i></p>
				<h2>{{$points}}</h2> 
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="col-md-10 col-sm-10 col-xs-12  ">
			  <div class="form-group">
				<label style="font-size:large;font-weight:550">Your referral Link (share this link with your friends and earn the referral points)</label>
				<input type="text" id="myrefferlink"  class="form-control" style="font-weight: bold;" value="{{$reffer_url}}{{$referral_code}}" readonly>
			  </div>
			</div>
            <div class="col-md-2 col-sm-2 col-xs-12">
			  <div class="form-group">
			  <label>&nbsp;&nbsp;</label>
				<button onclick="copyText()" class="btn btn-m theme-btn ">Copy Link</button>
			  </div>
			</div>
			@foreach($banner as $list)
		@if($list->value != null && $list->key == 'user_dahboard_1')
		<div class="col-md-12 col-sm-12 col-xs-12  ">
			<div class="form-group">
			    <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">
			</a>
			</div>
		</div>
		@endif
		@if($list->value != null && $list->key == 'user_dahboard_2')
		<div class="col-md-6 col-sm-12 col-xs-6  ">
			<div class="form-group">
			  <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">
			</a>
			</div>
		</div>
		@endif
		@if($list->value != null && $list->key == 'user_dahboard_3')
		<div class="col-md-6 col-sm-12 col-xs-6  ">
			<div class="form-group">
			    <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">\
			</a>
			</div>
		</div>
		@endif
		@if($list->value != null && $list->key == 'user_dahboard_4')
		<div class="col-md-6 col-sm-6 col-xs-6  ">
			<div class="form-group">
			    <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">
			</a>
			</div>
		</div>
		@endif
		@if($list->value != null && $list->key == 'user_dahboard_5')
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="form-group">
			    <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">
			</a>
			</div>
		</div>
		@endif
		@if($list->value != null && $list->key == 'user_dahboard_6')
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
			    <a href="{{$list->link}}">
			<img src="{{asset('assets/banner/'.$list->value)}}" style="height: 100%; width: 100%;"  alt="">
			</a>
			</div>
		</div>
		@endif
		@endforeach
@endif
		<script>
    function copyText() {
      // Get the text field
      var copyText = document.getElementById("myrefferlink");

      // Select the text field
      copyText.select();

      // Copy the text inside the text field
      document.execCommand("copy");

      // Alert the copied text
    //   alert("Copied the text: " + copyText.value);
	  Swal.fire(
		'Link Copied',
		'Share the link to earn Referral Point',
		'success'
		)
    }
  </script>
@endsection
