@extends('front/layout')
@section('page_title','Talent Details')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
*, *:before, *:after {
  box-sizing: border-box;
}


.range-slider {
  margin: 60px 0 0 0;
}

.range-slider {
  width: 100%;
}

.range-slider__range {
  -webkit-appearance: none;
  width: calc(100% - (73px));
  height: 10px;
  border-radius: 5px;
  background: #d7dcdf;
  outline: none;
  padding: 0;
  margin: 0;
}
.range-slider__range::-webkit-slider-thumb {
  -webkit-appearance: none;
          appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #2c3e50;
  cursor: pointer;
  -webkit-transition: background 0.15s ease-in-out;
  transition: background 0.15s ease-in-out;
}
.range-slider__range::-webkit-slider-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-webkit-slider-thumb {
  background: #1abc9c;
}
.range-slider__range::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border: 0;
  border-radius: 50%;
  background: #2c3e50;
  cursor: pointer;
  -moz-transition: background 0.15s ease-in-out;
  transition: background 0.15s ease-in-out;
}
.range-slider__range::-moz-range-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-moz-range-thumb {
  background: #1abc9c;
}
.range-slider__range:focus::-webkit-slider-thumb {
  box-shadow: 0 0 0 3px #fff, 0 0 0 6px #1abc9c;
}

.range-slider__value {
  display: inline-block;
  position: relative;
  width: 60px;
  color: #fff;
  line-height: 20px;
  text-align: center;
  border-radius: 3px;
  background: red;
  padding: 5px 10px;
  margin-left: 8px;
}
.range-slider__value:after {
  position: absolute;
  top: 8px;
  left: -7px;
  width: 0;
  height: 0;
  border-top: 7px solid transparent;
  border-right: 7px solid #2c3e50;
  border-bottom: 7px solid transparent;
  content: "";
}

::-moz-range-track {
  background: red;
  border: 0;
}

input::-moz-focus-inner,
input::-moz-focus-outer {
  border: 0;
}
  </style>
   @php
                $baseurl = $_SERVER['REQUEST_URI'];
                $parts = explode('/', $baseurl);
                
                $path = end($parts);
              @endphp
<div class="page-title">
  <div class="container">
    <div class="page-caption text-center">
      <h2>{{ucfirst($path)}}</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Explore {{ucfirst($path)}}</p>
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
            <!-- <h4>Category</h4> -->
            <!-- <select class="wide form-control br-1" name="category">
              <option value="" selected>Select Category</option>
              @foreach($category as $list)
              <option value="{{$list->id}}">{{$list->category_name}}</option>
              @endforeach
            </select> -->
            <h4>Search Keywords</h4>
             <input type="text" class="form-control" name="keyword" placeholder="Search Keywords">
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
              <option value="{{$list->id}}">{{$list->name}}</option>
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
              <option value="{{$list->id}}">{{$list->language}}</option>
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
          <input type="submit" class="btn btn-m theme-btn full-width" value="Filter">&nbsp;
          <a href="{{route('talent.browse')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
        </form>
        </div>
        </div>

      
      <!-- Start Job List -->
      <div class="col-md-9 col-sm-7">
        <div class="row mrg-bot-20">
          <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
             
            <h4 class="job_vacancie">{{$vendorcount}}  @if(request()->get('category_id') > 0) {{DB::table('categories')->where('id',request()->get('category_id'))->first()->category_name}} @else {{ucfirst($path)}} @endif</h4>
          </div>
         
        </div>
        
        <!-- Single Verticle job -->
        @if(count($vendor) > 0)
        @foreach($vendor as $list)
        <a href="{{route('user.vendordetails', [$list->username])}}" class="">
        <div class="col-md-4 col-sm-9">
        <div class="utf_grid_job_widget_area"> 
          <div class="u-content">
          <div class="contact-img">
                @if($list->profile != null)
                     <img src="{{asset('assets/profile/'.$list->profile)}}" style="height: 250px; width: 250px;"  alt=""> 
                 @else
                 <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 250px; width: 250px;"  alt=""> 
                 @endif
                  </div>
            <h5>{{$list->firstname.' '.$list->lastname}}</h5>
            @php
            $bday = new DateTime($list->birthdate); // Your date of birth
            $today = new Datetime(date('m.d.y'));
            $diff = $today->diff($bday);
            $yearsold = $diff->y;
            @endphp
            <p class="text-muted">{{$list->state}} ({{($list->city)}})@if($list->is_birthdate_enable == 1),{{$yearsold}}@endif</p>
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
        <div class="clearfix"></div>
		<!-- <div class="utf_flexbox_area padd-0">
			<ul class="pagination">
			  <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a> </li>
			  <li class="page-item active"><a class="page-link" href="#">1</a></li>
			  <li class="page-item"><a class="page-link" href="#">2</a></li>
			  <li class="page-item"><a class="page-link" href="#">3</a></li>
			  <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a> </li>
			</ul>
		</div> -->
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
  var rangeSlider = function () {
  var slider = $(".range-slider"),
    range = $(".range-slider__range"),
    value = $(".range-slider__value");

  slider.each(function () {
    value.each(function () {
      var value = $(this).prev().attr("value");
      $(this).html(value);
    });

    range.on("input", function () {
      $(this).next(value).html(this.value);
    });
  });
};

rangeSlider();

</script>
@endsection