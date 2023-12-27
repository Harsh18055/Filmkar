@extends('front/organize/layout')
@section('page_title','Applied User List')
@section('job_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')

<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
	  <div class="col-md-9">
      <h1>Applied Users</h1>
    <div id="dashboard_listing_blcok">
      @foreach($applied_users as $user)
		  <div class="col-md-4 col-sm-4">
          <div class="contact-box">
            
            <div class="contact-img">
            @if($user->profile != null)
                     <img src="{{asset('assets/profile/'.$user->profile)}}" style="height: 150px; width: 150px;"  alt=""> 
                 @else
                 <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 150px;"  alt=""> 
                 @endif
             </div>
            <div class="contact-caption">
              <a href="#">{{$user->username}}</a>
              <div class="contact-caption">
                  <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$user->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div>
                     
                     <!-- <span>Catterline AB3 9TR</span>  -->
                  </div>
			</div>
          </div>
		  </div>
		  @endforeach
		</div>
      </div>	  
    </div>
  </div>
</section>
@endsection
