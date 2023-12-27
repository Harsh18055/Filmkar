@extends('front/layout')
@section('page_title','Job')
@section('job_select','active')
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
      <h2>Job Details</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Job Details</p>
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
              <div style="text-align:center;">
                <h4 style="margin:10px; font-size:20px; font-weight: bold;"><strong></strong>{{$job_post->title}}</h4>
              </div>
			<div class="row">
				<div class="col-md-4 text-center user_profile_img"><a href="{{route('institutes.details', [$job_post->o_id])}}" target="_blank"><img src="{{asset('assets/institute/logo/'.$job_post->logo)}}" class="width-100"  alt=""/></a>
				  <h4 class="meg-0"><a href="{{route('institutes.details', [$job_post->o_id])}}" target="_blank">{{$job_post->company}}</a></h4>
				  <span>{{$job_post->state}} ({{$job_post->city}})</span> 
				  <div class="text-center">
          @if(!session()->has('organisation_ID'))
                  @if(session()->has('USER_ID'))
                   <a href="javascript:void(0)" onclick="confirm({{$job_post->id}})"  class="btn-job theme-btn job-apply">Apply Now</a>
                  @else
                  <button href="javascript:void(0)"  data-toggle="modal" data-target="#signin" class="btn-job theme-btn job-apply">Apply Now</button>
                  @endif
                  @endif
					<!-- <button type="button" data-toggle="modal" data-target="#signin" class="btn-job theme-btn job-apply">Apply Now</button> -->
				  </div>
				</div>
				<div class="col-md-4 user_job_detail">
                
                            <p><strong>Job Role : </strong>{{$job_post->category_name}}</p>
                            <p><strong>Gender : </strong>{{$job_post->gender}}</p>
                            <p><strong>MinAge : </strong>{{$job_post->MinAge}}</p>
                            <p><strong>MaxAge : </strong>{{$job_post->MaxAge}}</p>
                            <p><strong>Audition Required : </strong>{{$job_post->audition_required}}</p>
                            <!--<p><strong>Budget : </strong>{{$job_post->budget}}</p>-->
                            <!--<p><strong>Budget Duration : </strong>{{$job_post->budget_duration}}</p>-->
                            <!--<p><strong>Last Date For Apply : </strong>{{$job_post->last_date}}</p>-->
                            <!--<p><strong>Job Start : </strong>{{$job_post->job_start}}</p>-->
                            <!--<p><strong>Job End : </strong>{{$job_post->job_end}}</p>-->
                            <!--<p><strong>No Of Vacancies : </strong>{{$job_post->No_of_vacancies}}</p>-->
				</div>
				<div class="col-md-4 user_job_detail">
                <!--<h4><strong>Title : </strong>{{$job_post->title}}</h4>-->
                            <!--<p><strong>Job Role : </strong>{{$job_post->category_name}}</p>-->
                            <!--<p><strong>Gender : </strong>{{$job_post->gender}}</p>-->
                            <!--<p><strong>MinAge : </strong>{{$job_post->MinAge}}</p>-->
                            <!--<p><strong>MaxAge : </strong>{{$job_post->MaxAge}}</p>-->
                            <!--<p><strong>Audition Required : </strong>{{$job_post->audition_required}}</p>-->
                            <p><strong>Payment (₹): </strong>{{$job_post->budget}} {{$job_post->budget_duration}}</p>
                            <p><strong>Last Date For Apply : </strong>{{date('d-m-Y', strtotime($job_post->last_date))}}</p>
                            <p><strong>Job Start : </strong>{{date('d-m-Y', strtotime($job_post->last_date))}}</p>
                            <p><strong>Job End : </strong>{{date('d-m-Y', strtotime($job_post->last_date))}}</p>
                            <p><strong>No Of Vacancies : </strong>{{$job_post->No_of_vacancies}}</p>
				</div>
			</div>
          </div>
        </div>
        <div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4 >Job Description</h4>
          </div>
          <div class="detail-wrapper-body">
            <p>{!! $job_post->description !!}</p>
            <p>Do make sure that your Filmkar profile is complete. Incomplete profiles will be rejected. Hurry up, and send your entry today. Auditions are going on.</p>
          </div>
        </div>
        <div class="detail-wrapper">
          <div class="detail-wrapper-body" style="background-color: lightyellow;">
            <p><strong>Imp Note:</strong><br>
<li> Filmkar or its officials will never ask for money to provide work to you.</li>
<li> Do not Send Money without verification to Anyone. Avoid Scams and Fraud!</li>
<li> Stay away from people who are charging money for fraudulent activities like making artist card or buy any insurance to give work.</li>
<li> Beware of getting advance cheque and sending money back through Western unions Moneygram, wire transfer.</li>
<li> It's the duty of the talent or organisation to check identity and intention of the contact person as we cannot give guarantee of professional association or affiliation and human intention/behaviour.</li>
</p>
          </div>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-5">
        <div class="sidebar"> 
          <!-- Start: Job Overview -->
          <div class="widget-boxed">
            <div class="widget-boxed-header">
              <h3><i class="ti-location-pin padd-r-10"></i>Location</h3>
            </div>
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                  <li><i class="ti-credit-card padd-r-10"></i>Location: {{$job_post->state}} ({{$job_post->city}})</li>
                  <li><i class="ti-credit-card padd-r-10"></i>Job Type: {{$job_post->job_type}}</li>
                  
                  @if(session()->has('USER_ID') || session()->has('organisation_ID'))
                  <li><i class="ti-world padd-r-10"></i>{{$job_post->website}}</li>
                  <li><i class="ti-mobile padd-r-10"></i>{{$job_post->phone_no}}</li>
                  <li><i class="ti-email padd-r-10"></i>{{$job_post->email}}</li>
                  @else
                  <div class="">
                  <li><i class="ti-world padd-r-10"></i>{{substr($job_post->website, 0, 4) . "******";}}</li>
                  <li><i class="ti-mobile padd-r-10"></i>{{substr($job_post->phone_no, 0, 4) . "******";}}</li>
                  <li><i class="ti-email padd-r-10"></i>{{substr($job_post->email, 0, 3) . "******";}}<br></li>
                  <li><i class="ti-email padd-r-10"></i>{{substr($job_post->email, 0, 3) . "******";}}<br></li>
                  <a href="#" data-toggle="modal" data-target="#signin" ><p class="login">Login to see the Contact Details</p></a>
                  </div>
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
            <!-- <div class="widget-boxed-header">
              <h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
            </div> -->
             <a href="{{ DB::table('banners')->where('key', 'job_detail_page_1')->first()->link }}" target="_blank">
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                  
                  <li><img width="100%" src="{{asset('assets/banner/'.DB::table('banners')->where('key','job_detail_page_1')->first()->value)}}"></li>
                </ul>                
              </div>
            </div>
            </a>
          </div>
          <!-- End: Job Overview --> 
        </div>
      </div>
    </div>
    <!-- End Row --> 
    
    <div class="row">
      <div class="col-md-12">
        <h4 class="mrg-bot-30">Similar Jobs</h4>
      </div>
    </div>
    <div class="row"> 
      <!-- Single Job -->
      @if(count($similar_jobs) == 0)
      <div class="col-md-3 col-sm-6">
      <p class="text-muted">No records for now. We are working on it to bring best to you. Stay Tuned with us.</p>
      </div>
      @endif
      @foreach($similar_jobs as $list)
      <div class="col-md-3 col-sm-6">
        <div class="utf_grid_job_widget_area"> <span class="job-type full-type">New</span>
          <div class="u-content">
            <div class="avatar box-80" style="max-width:160px;"> <a href="employer-detail.html"> <img class="img-responsive" src="{{asset('assets/institute/logo/'.$list->logo)}}" alt=""> </a> </div>
            <h5><a href="employer-detail.html">{{$list->category_name}}</a></h5>
            <p class="text-muted">{{$list->state}} ({{$list->city}})</p>
          </div>
          <!--<div class="utf_apply_job_btn_item"> <a href="job-detail.html" class="btn job-browse-btn btn-radius br-light">Apply Now</a> </div>-->
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<script>
    var baseUrl = location.protocol + '//' + location.host;
  
function confirm(job_posts_id){
  Swal.fire({
  title: 'Are you sure?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Apply!'
}).then((result) => {
  if (result.isConfirmed) {

    var user_id = {{ Session::get('USER_ID') }};

    $.get(baseUrl+"/job/apply/"+user_id+'/'+job_posts_id, function(data){
        if(data == true){
          Swal.fire(
            'Applied!',
            'Your application has been applied.',
            'success'
          )
        }else{
          Swal.fire('You have Alredy applied!')
        }
    });
    
  }
})
}
</script>
@endsection
