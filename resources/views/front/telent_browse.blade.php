@extends('front/layout')
@section('page_title','Talent Details')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')

<style>

.image-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 250px;
  }

  .image-container img {
    width: 100%;
    height: 100%;
    transition: transform 0.3s ease; 
  }

  .image-container:hover img {
    transform: scale(1.1); 
  }
.u-content h5:hover{
	color:red;
}

    
.zoomable-container {
    width: 100%;
    height: 250px;
    overflow: hidden;
    position: relative;
}

.zoomable-image {
    width: 100%;
    height: 100%;
    transition: transform 0.3s ease-in-out;
}

.zoomable-container:hover .zoomable-image {
    transform: scale(1.1); 
}

.zoomed-out {
    max-width: 100%;
    height: auto;
    width: auto;
    max-height: 250px; 
    margin: auto;
    display: block;
}

</style>

<div class="page-title">
  <div class="container">
    <div class="page-caption text-center">
      <h2>Browse Talent</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Explore Talent</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-3 col-sm-5">
        
        <form action="{{route('filterusers')}}" method="get">
        <div class="widget-boxed padd-bot-0">
          <div class="widget-boxed-header">
              <h4>Search Name or Username</h4>
             <input type="text" class="form-control" name="keyword" placeholder="Search Name or Username" value="{{request()->get('keyword')}}">
            <h4>Category</h4>
            <select class="wide form-control br-1" name="category_id">
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
            <h4>Language Spoken</h4>
            <select class="form-control" name="language">
              <option value="" selected>Select Language</option>
              @foreach($language as $list)
              @if(request()->get('language')==$list->id)
                <option selected value="{{$list->id}}">
                  @else
                <option value="{{$list->id}}">
                  @endif
                  {{$list->language}}</option>
              @endforeach
            </select>
          </div>
          <div class="widget-boxed-body">
            <div class="side-list no-border">
            <h4>Experience</h4>
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

              <input type="range" name="year_of_experience_min" class="range-slider-input-left" tabindex="0" max="100" min="0" step="1">
              <input type="range" name="year_of_experience_max" class="range-slider-input-right" tabindex="0" max="100" min="0" step="1">
            </div>
            
            </div>
          </div><br>
          <input type="submit" class="btn btn-m theme-btn full-width" value="Filter"> &nbsp;
          <a href="{{route('talent.browse')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
        </form>
        </div>
        </div>

      
      <!-- Start Job List -->
      <div class="col-md-9 col-sm-7">
        <div class="row mrg-bot-20">
          <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
            <h4 class="job_vacancie">{{$vendorcount}} @if(request()->get('category_id') > 0) {{DB::table('categories')->where('id',request()->get('category_id'))->first()->category_name}} @else Member @endif</h4>
          </div>
          
        </div>
        @if(isset($_GET['keyword']))
            @if(count($vendor) > 0)
            @foreach($vendor as $list)
                <a href="{{route('user.vendordetails', [$list->username])}}" class="talentname">
        <div class="col-md-3 col-sm-9">
        <div class="utf_grid_job_widget_area"> 
          <div class="u-content">
          <div class="contact-img" style="width:200px">
              <div class="image-container">
                @if($list->profile != null)
                
                     <img src="{{asset('assets/profile/'.$list->profile)}}" style="height: 250px; width: 100%; margin:auto;"  alt=""  > 
                     
                 @else
                 <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 250px; width: 100%; margin:auto;"  alt="">
                 @endif
                 </div>
                  </div>
            <h5 >{{$list->firstname.' '.$list->lastname}}</h5>
            @php
            $bday = new DateTime($list->birthdate); // Your date of birth
            $today = new Datetime(date('m.d.y'));
            $diff = $today->diff($bday);
            $yearsold = $diff->y;
            @endphp
            <p class="text-muted">{{$list->name}} ({{($list->city)}}),{{$yearsold}}</p>
          </div>
          <!-- <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$list->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div> -->
        </div>
      </div>
        </a>
            @endforeach
            @else
               <div class="col-md-10 text-center user_profile_img">
                    <img src="{{asset('assets/profile/noresult.png')}}" style=" width: 70%;"  alt="">
                </div>
            @endif
        @else
        @if(count($featured_vendor) > 0)
            <h3>Featured Talent</h3>
            
            @foreach($featured_vendor as $list)
                <a href="{{route('user.vendordetails', [$list->username])}}" class="">
                <div class="col-md-3 col-sm-9">
                    <div class="utf_grid_job_widget_area"> 
                      <div class="u-content">
                      <div class="contact-img" style="width: 200px; overflow: hidden;">
                        @if($list->profile != null)
                            <div class="zoomable-container">
                                <img class="zoomable-image" src="{{asset('assets/profile/'.$list->profile)}}" alt="">
                            </div>
                        @else
                            <div class="zoomable-container">
                                <img class="zoomable-image" src="{{asset('assets/profile/default_avatar.jpg')}}" alt="">
                            </div>
                        @endif
                    </div>
                @php
                $bday = new DateTime($list->birthdate);
                $today = new Datetime(date('m.d.y'));
                $diff = $today->diff($bday);
                $yearsold = $diff->y;
                @endphp
                <h5 >{{$list->firstname.' '.$list->lastname}}@if($list->is_birthdate_enable == 1), ({{$yearsold}})@endif</h5>
                
                <p class="text-muted">{{$list->states_name}} ({{($list->city)}})</p>
              </div>
              <!-- <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$list->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div> -->
            </div>
          </div>
        </a>
            @endforeach
            
            </div>
            @endif
      <h3>Talent Member</h3>
      @if(count($vendor) > 0)
            @foreach($vendor as $list)
                <a href="{{route('user.vendordetails', [$list->username])}}" class="">
        <div class="col-md-3 col-sm-9">
        <div class="utf_grid_job_widget_area"> 
          <div class="u-content">
          <div class="contact-img" style="width: 200px; overflow: hidden;">
    @if($list->profile != null)
        <div class="zoomable-container">
            <img class="zoomable-image" src="{{asset('assets/profile/'.$list->profile)}}" alt="">
        </div>
    @else
        <div class="zoomable-container">
            <img class="zoomable-image" src="{{asset('assets/profile/default_avatar.jpg')}}" alt="">
        </div>
    @endif
</div>
@php
            $bday = new DateTime($list->birthdate); // Your date of birth
            $today = new Datetime(date('m.d.y'));
            $diff = $today->diff($bday);
            $yearsold = $diff->y;
            @endphp
           <h5 >{{$list->firstname.' '.$list->lastname}}@if($list->is_birthdate_enable == 1),({{$yearsold}})@endif</h5>
            
            
            <p class="text-muted"> {{($list->states_name)}}({{($list->city_name)}})</p>
          </div>
          <!-- <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$list->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div> -->
        </div>
      </div>
        </a>
            @endforeach
            @else
               <div class="col-md-10 text-center user_profile_img">
                    <img src="{{asset('assets/profile/noresult.png')}}" style=" width: 70%;"  alt="">
                </div>
            @endif
        @endif
       </div>
       <div class="clearfix"></div>
           <div class="utf_flexbox_area padd-0">
			<ul class="pagination">
            @if ($vendor->currentPage() > 1)
                <li class="page-item "><a href="{{ $vendor->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $vendor->lastPage(); $i++)
                <li class="page-item {{ $vendor->currentPage() == $i ? 'active' : '' }}"><a href="{{ $vendor->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($vendor->currentPage() < $vendor->lastPage())
                <li class="page-item "><a href="{{ $vendor->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
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
 
</script>
@endsection