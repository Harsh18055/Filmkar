@extends('front/layout')
@section('page_title','Jobs')
@section('job_select','active')
@section('nav_class','white no-background')
@section('container')

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Browse Job</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Browse Job</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-3 col-sm-5">
        
        <form action="{{route('jobs.filter')}}" method="get">
        <div class="widget-boxed padd-bot-0">
          <div class="widget-boxed-header">
              <h4>Search Job</h4>
              <input type="text" class="form-control" name="keyword" placeholder="Search Job" value="{{request()->get('keyword')}}">
            <h4>Category</h4>
            <select class="wide form-control br-1" name="category_id" value="{{request()->get('category_id')}}">
              <option value="" selected>Select Category</option>
              @foreach($category as $list)
                @if(request()->get('category_id')==$list->id)
                <option selected value="{{$list->id}}">
                  @else
                <option value="{{$list->id}}">
                  @endif
                  {{$list->category_name}}</option>
              @endforeach
            </select>
            <h4>Gender</h4>
            <select class="form-control" name="gender">
              <option value="" selected>Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <h4>State</h4>
            <select class="form-control" id="state_id" name="state_id">
              <option value="" selected>Select State</option>
              @foreach($state as $list)
              @if(request()->get('state_id')==$list->id)
                <option selected value="{{$list->id}}">
                  @else
                <option value="{{$list->id}}">
                  @endif
                {{$list->name}}</option>
              @endforeach
            </select>
            <h4>City</h4>
            <select class="form-control" id="city_id" name="city_id">
              <option value="" selected>Select City</option>
              
            </select>
            
          </div>
          <div class="widget-boxed-body">
            <div class="side-list no-border">
          <h4>Age Range</h4>
            <div id="RangeSlider" class="range-slider">
              <div>
                <div class="range-slider-val-left"></div>
                <div class="range-slider-val-right"></div>
                <div class="range-slider-val-range"></div>

                <span class="range-slider-handle range-slider-handle-left"></span>
                <span class="range-slider-handle range-slider-handle-right"></span>

                <div class="range-slider-tooltip range-slider-tooltip-left">
                  <span class="range-slider-tooltip-text"></span>
                </div>

                <div class="range-slider-tooltip range-slider-tooltip-right">
                  <span class="range-slider-tooltip-text"></span>
                </div>
              </div>

              <input type="range" name="MinAge"  class="range-slider-input-left" tabindex="0" max="100" min="0" step="1">
              <input type="range" name="MaxAge"  class="range-slider-input-right" tabindex="0" max="100" min="0" step="1">
            </div>
            </div>
          </div><br>
          <Button type="submit" class="btn btn-m theme-btn full-width" >Filter</button>&nbsp;
          <a href="{{route('jobs')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
        </form>
        </div>
        </div>
      
      <!-- Start Job List -->
      <div class="col-md-9 col-sm-7">
        <div class="row mrg-bot-20">
          <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
            <h4 class="job_vacancie">{{count($job_posts)}} Jobs &amp; Vacancies</h4>
          </div>
         
        </div>
        
        <!-- Single Verticle job -->
        @if(count($job_posts) > 0)
        @foreach($job_posts as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <input type="hidden" id="job_posts_id" value="{{$list->id}}">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/institute/logo/'.$list->logo)}}" class="img-responsive" alt="" /></div>
              <div style="float:right;"> {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div>
              <div><h4><a href="{{route('job.details', [$list->slug])}}">{{$list->title}}</a></h4></div>
              <span class="com-tagline">{{$list->category_name}}<br>&nbsp;</span>
              <div  >
                  <!--@if(!session()->has('organisation_ID'))-->
                  <!--@if(session()->has('USER_ID'))-->
                  <!-- <a href="javascript:void(0)" onclick="confirm({{$list->id}})"  class="btn-job theme-btn job-apply">Apply Now</a>-->
                  <!--@else-->
                  <!--<button href="javascript:void(0)"  data-toggle="modal" data-target="#signin" class="btn-job theme-btn job-apply">Apply Now</button>-->
                  <!--@endif-->
                  <!--@endif-->
                  <ul style="float:left; margin-top:20px;">
                      <li><strong>Posted By :</strong> {{$list->company}}</li>
                      <li><strong>Location :</strong> {{$list->state}} ({{$list->city}})</li>
                      
                  </ul>
                  <a style="float:right; margin:5px;" href="{{route('job.details', [$list->slug])}}" class="btn-job light-gray-btn">View Job</a>
                </div>
			      </div>
                   
         </div>        
        </div> 
        @endforeach
        @else
                <div class="col-md-10 text-center user_profile_img">
                    <img src="{{asset('assets/profile/noresult.png')}}" style=" width: 70%;"  alt="">
                </div>
        @endif
        <!--<div class="clearfix">{!! $job_posts->links() !!}</div>-->
        <div class="clearfix"></div>
		 <div class="utf_flexbox_area padd-0">
			<!--<ul class="pagination">-->
			<!--  <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a> </li>-->
			<!--  <li class="page-item active"><a class="page-link" href="#">1</a></li>-->
			<!--  <li class="page-item"><a class="page-link" href="#">2</a></li>-->
			<!--  <li class="page-item"><a class="page-link" href="#">3</a></li>-->
			<!--  <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a> </li>-->
			<!--</ul>-->
			<ul class="pagination">
            @if ($job_posts->currentPage() > 1)
                <li class="page-item "><a href="{{ $job_posts->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $job_posts->lastPage(); $i++)
                <li class="page-item {{ $job_posts->currentPage() == $i ? 'active' : '' }}"><a href="{{ $job_posts->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($job_posts->currentPage() < $job_posts->lastPage())
                <li class="page-item "><a href="{{ $job_posts->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
		</div>
</div>

</div>

      </div>
    </div>
    <!-- End Row --> 
  </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script>
  $("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});
</script>
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
          Swal.fire('You Are Alredy applied!')
        }
    });
    
  }
})
}

</script>
@endsection