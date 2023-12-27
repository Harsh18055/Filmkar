@extends('front/layout')
@section('page_title','Event')
@section('event_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
.detail-wrapper-header h4{
    color:white;
}
  h4{
    font-family: 'Poppins', sans-serif;
    margin: 0;
    font-weight: 500;
    color: #ffffff;
    font-size: 18px;
  }
.login{
        color: #ed2024;
    background: rgba(38,174,97,.2);
    display: inline-block;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 4px;
    text-align: center;
}
  </style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Event Detail</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Event Detail</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-60">
  <div class="container"> 
    <!-- row -->
    <div class="row">
      <div class="col-md-8 col-sm-7">
        <div class="detail-wrapper">
          <div class="detail-wrapper-body">
              <div style="text-align:center; margin-bottom: 25px;">
                <h4 style="margin:10px; font-size:25px; font-weight: bold;"><strong></strong>{{$event_post->title}}</h4>
              </div>
			<div class="row">
				<div class="col-md-12 text-center user_profile_img">
                @if($event_post->thumbnail != '')
            <img src="{{asset('assets/event/thumbnail/'.$event_post->thumbnail)}}" style="width: 100%;"  alt="">
            @else
            <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 300px;"  alt="">
            @endif
				  <p> <h4 class="meg-0">{{$event_post->category_name}}</h4>
				  @if($event_post->event_type == 'offline')
				 {{$event_post->state}} ({{$event_post->city}})&nbsp;&nbsp;
				  @else
				  <span>Online Event</span> 
				  @endif
				  <strong>Date: </strong>{{ Carbon\Carbon::parse($event_post->start_date)->format('d M') }} - {{  Carbon\Carbon::parse($event_post->end_date)->format('d M') }} &nbsp;&nbsp;<strong>Time: </strong>{{$event_post->start_time}} - {{$event_post->end_time}}</p>
				</div>
				<div class=" text-center user_job_detail">
                            <p></p>
                            @php
                      $string = $event_post->tags; 
                      $str_arr = preg_split ("/\,/", $string); 
                      $array_tags =  $str_arr;
                      @endphp
                      @foreach($array_tags as $tag)
                      <span class="skill-tag">{{$tag}}</span>
                      @endforeach
				</div>
			</div>
          </div>
        </div>
        <div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4>About Event</h4>
          </div>
          <div class="detail-wrapper-body">
            <p>{!! $event_post->about_event !!}</p>
          </div>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-5">
        <div class="sidebar"> 
          <!-- Start: Job Overview -->
          <div class="widget-boxed">
            <div class="widget-boxed-header">
              <h3><i class="ti-location-pin padd-r-10"></i>Organisation Details</h3>
            </div>
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                  <li><i class="ti-credit-card padd-r-10"></i>Name: {{$event_post->user_name}}</li>
                  @if($event_post->event_type == 'offline')
                  <li><i class="ti-credit-card padd-r-10"></i>Entry Fee (₹): {{$event_post->price}}</li>
                  <li><i class="ti-world padd-r-10"></i>Pincode: {{$event_post->pin_code}}</li>
                  <li><i class="ti-mobile padd-r-10"></i>{{$event_post->phone_number}}</li>
                  <li><i class="ti-email padd-r-10"></i>{{$event_post->email}}</li>
                  @endif
                </ul>                
              </div>
            </div>
          </div>
          <!-- End: Job Overview --> 
        </div>
      </div>
      <div class="col-md-4 col-sm-5">
        <div class="sidebar"> 
          <!-- Start: Job Overview -->
          <div class="widget-boxed">
            <div class="widget-boxed-header">
              <h3><i class="ti-location-pin padd-r-10"></i>Organiser Details</h3>
            </div>
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                  <li><i class="ti-credit-card padd-r-10"></i>Name: {{$event_post->user_website}}</li>
                  <li><i class="ti-world padd-r-10"></i>{{$event_post->user_website}}</li>
                  <!--@if(session()->has('USER_ID') || session()->has('organisation_ID'))-->
                  <li><i class="ti-mobile padd-r-10"></i>{{$event_post->user_number}}</li>
                  <li><i class="ti-email padd-r-10"></i>{{$event_post->user_email}}</li>
                  <!--@else-->
                  <!--<div class="">-->
                  <!--<li><i class="ti-mobile padd-r-10"></i>{{substr($event_post->user_number, 0, 4) . "******";}}</li>-->
                  <!--<li><i class="ti-email padd-r-10"></i>{{substr($event_post->user_email, 0, 3) . "******";}}</li><br><a href="#" data-toggle="modal" data-target="#signin" ><p class="login">Login to see the Contact Details</p></a>-->
                  <!--</div>-->
                  <!--@endif-->
                </ul>                
              </div>
            </div>
          </div>
          <!-- End: Job Overview --> 
        </div>
      </div>
    </div>
    <!-- End Row --> 
    
    <div class="row">
      <div class="col-md-12">
        <h3 class="mrg-bot-30">Similar Events</h3>
      </div>
    </div>
    <div class="row"  > 
      <!-- Single Job -->
      @if(count($similar_event) == 0)
      <div class="col-md-3 col-sm-6">
      <p class="text-muted">No records for now. We are working on it to bring best to you. Stay Tuned with us.</p>
      </div>
      @endif
      @foreach($similar_event as $list)
      <div class="col-md-3 col-sm-6">
        <div class="utf_grid_job_widget_area" style="height: 300px;">
          <div class="u-content">
          @if($list->thumbnail != '')
            <img src="{{asset('assets/event/thumbnail/'.$list->thumbnail)}}" style="height: 150px; width: 250px;"  alt="">
            @else
            <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 300px;"  alt="">
            @endif
            <h5><a href="{{route('events.details', [$list->slug])}}">{{$list->title}} ({{$list->category_name}})</a></h5>
            <h5><a href="{{route('events.details', [$list->slug])}}"></a></h5>
            @if($list->state != '')
            <p class="text-muted">{{$list->state}} ({{$list->city}})</p>
            @else
            <p class="text-muted">Online Event</p>
            @endif
          </div>
          <!--<div class="utf_apply_job_btn_item"> <a href="#" class="btn job-browse-btn btn-radius br-light">Book Now</a> </div>-->
        </div>
      </div>
      @endforeach
    </div>
  </div>
  
</section>
@endsection
