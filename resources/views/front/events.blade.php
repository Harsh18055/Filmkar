@extends('front/layout')
@section('page_title','Events')
@section('event_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
   .contact-box {
    position: relative;
    margin-bottom: 30px;
    overflow: hidden;
}
.contact-img {
    position: relative;
}
.contact-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    background: linear-gradient(to top, rgba(0,0,0,1), rgba(255,0,0,1));
    color: #fff;
    font-size: 14px;
}
.contact-caption a {
    color: #fff;
    font-size: 18px;
    font-weight: bold;
}
@media (max-width: 767px) {
    .contact-img {
        height: 200px;
    }
}
@media (min-width: 768px) {
    .contact-img {
        height: 300px;
    }
}
    .zoomable-image {
        overflow: hidden;
        transition: transform 0.3s;
    }

    .zoomable-image img {
        transition: transform 0.3s;
    }

    .zoomable-image:hover {
        transform: scale(1.1);
    }

    .zoomable-image:hover img {
        transform: scale(1.1);
    }
   </style>
<div class="page-title">
   <div class="container">
      <div class="page-caption text-center">
         <h2>Browse Events</h2>
         <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Browse Events</p>
      </div>
   </div>
</div>
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
      <form action="{{route('events.search')}}" method="get">

         <div class="col-md-3 col-sm-5">
            <div class="widget-boxed padd-bot-0">
               <div class="widget-boxed-body">
                  <div class="search_widget_job">
                     <div class="field_w_search">
                         <h4>Search Event</h4>
                        <input type="text" name="keyword" class="form-control" value="{{request()->get('keyword')}}" placeholder="Search Event">
                     </div>
                  </div>
               </div>
            </div>
               <div class="widget-boxed padd-bot-0">
                  <div class="widget-boxed-header">
                     <h4>Category</h4>
                     <select class="wide form-control br-1" name="category_id">
                        <option value="" selected>Select Category</option>
                        @foreach($event_categories as $list)
                        <option value="{{$list->id}}">
                           
                           {{$list->category_name}}
                        </option>
                        @endforeach
                     </select>
                     <h4>Event Type</h4>
                     <select class="form-control" name="event_type">
                        <option value="" selected>Select Type</option>
                        <option value="online">online</option>
                        <option value="offline">offline</option>
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
                           {{$list->name}}
                        </option>
                        @endforeach
                     </select>
                     <h4>City</h4>
                     <select class="form-control" id="city_id" name="city_id">
                        <option value="" selected>Select City</option>
                     </select>
                  </div>
                  <Button type="submit" class="btn btn-m theme-btn full-width">Filter</button>&nbsp;
          <a href="{{route('events')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
            </form>
            </div>
         </div>
         <!-- Start Job List -->
         <div class="col-md-9 col-sm-7">
            <div class="row mrg-bot-20">
               <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                  <h4 class="job_vacancie"> Event</h4>
               </div>
            </div>
            <!-- Single Verticle job -->
            @if(count($events) > 0)
            @foreach($events as $list)
            <a href="{{route('events.details', [$list->slug])}}">
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px; padding-left: 5px;">
               <div class="contact-box">
                  <div class="" style="width: 100%; position: relative; height: 250px; overflow: hidden;">
    @if($list->thumbnail != '')
    <div class="zoomable-image">
        <img src="{{asset('assets/event/thumbnail/'.$list->thumbnail)}}" alt="" style="width: 100%; height: 170px; display: block;">
    </div>
    @else
    <div class="zoomable-image">
        <img src="{{asset('assets/profile/default_avatar.jpg')}}" alt="" style="width: 100%; height: 100%; display: block;">
    </div>
    @endif
    <div class="contact-caption" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 10px; background: linear-gradient(to top, rgba(255, 0, 0, 1), rgba(255, 0, 0, 0.6)); transition: background 0.3s;">
        <p href="#" style="color: #fff; font-size: 18px; font-weight: bold;">{{$list->title}}</p>
        <div class="" style="color: #fff; font-size: 14px;">{{ Carbon\Carbon::parse($list->start_date)->format('d M') }} <b>|</b> {{$list->category_name}} <b>|</b>  @if($list->state != ''){{ $list->state }} ({{ $list->city }}) @endif  </div>
    </div>
</div>



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
           <div class="utf_flexbox_area padd-0">
			<!--<ul class="pagination">-->
			<!--  <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">«</span> <span class="sr-only">Previous</span> </a> </li>-->
			<!--  <li class="page-item active"><a class="page-link" href="#">1</a></li>-->
			<!--  <li class="page-item"><a class="page-link" href="#">2</a></li>-->
			<!--  <li class="page-item"><a class="page-link" href="#">3</a></li>-->
			<!--  <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">»</span> <span class="sr-only">Next</span> </a> </li>-->
			<!--</ul>-->
			<ul class="pagination">
            @if ($events->currentPage() > 1)
                <li class="page-item "><a href="{{ $events->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $events->lastPage(); $i++)
                <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }}"><a href="{{ $events->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($events->currentPage() < $events->lastPage())
                <li class="page-item "><a href="{{ $events->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
		</div>
         </div>
      </div>
      <!-- End Row --> 
   </div>
</section>
<div><a href="#" class="scrollup">Scroll</a></div>
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
@endsection