@extends('front/layout')
@section('page_title','Movies')
@section('movie_select','active')
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
    .zoom-container {
        width: 100%;
        position: relative;
        height: 250px;
        overflow: hidden;
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
         <h2>Browse Movies</h2>
         <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Browse Movies</p>
      </div>
   </div>
</div>
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
      <form action="{{route('movies.search')}}" method="get">

         <div class="col-md-3 col-sm-5">
            <div class="widget-boxed padd-bot-0">
               <div class="widget-boxed-body">
                  <div class="search_widget_job">
                     <div class="field_w_search">
                         <h4>Search Movie</h4>
                        <input type="text" name="keyword" class="form-control" placeholder="Search Movie" value="{{request()->get('keyword')}}">
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="widget-boxed padd-bot-0">
                  <div class="widget-boxed-header">
                     <h4>Genre</h4>
                     <select class="wide form-control br-1" name="genre_id">
                        <option value="" selected>Select Genre</option>
                        @foreach($genre_types as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                     </select>
                     <h4>Format</h4>
                     <select class="wide form-control br-1" name="format_id">
                        <option value="" selected>Select Format</option>
                         @foreach($format_types as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                     </select>
                     <h4>Language</h4>
                     <select class="form-control" name="language_id">
                        <option value="" selected>Select Language</option>
                         @foreach($languages as $list)
                            <option value="{{$list->id}}">{{$list->language}}</option>
                        @endforeach
                     </select>
                  </div>
                  <Button type="submit" class="btn btn-m theme-btn full-width">Filter</button>&nbsp;
          <a href="{{route('movies')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
            </form>
            </div>
               
         </div>
         <!-- Start Job List -->
         <div class="col-md-9 col-sm-7">
            <div class="row mrg-bot-20">
               <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                  <h4 class="job_vacancie"> Movies</h4>
               </div>
            </div>
            <!-- Single Verticle job -->
            @if(count($movies) > 0)
            @foreach($movies as $list)
            <a href="{{route('movies.details', [$list->slug])}}">
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px; padding-left: 5px;">
               <div class="contact-box">
                 <div class="zoom-container" style="width: 100%; position: relative; height: 250px; overflow: hidden;">
    @if($list->poster != '')
    <div class="zoomable-image">
        <img src="{{asset('assets/movie/poster/'.$list->poster)}}" alt="" style="width: 100%; height: 170px; display: block;">
    </div>
    @else
    <div class="zoomable-image">
        <img src="{{asset('assets/profile/default_avatar.jpg')}}" alt="" style="width: 100%; height: 100%; display: block;">
    </div>
    @endif
    <div class="contact-caption" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 10px; background: linear-gradient(to top, rgba(255, 0, 0, 1), rgba(255, 0, 0, 0.6)); transition: background 0.3s;">
        <p href="#" style="color: #fff; font-size: 18px; font-weight: bold;">{{$list->title}}</p>
        <div class="" style="color: #fff; font-size: 14px;">{{ Carbon\Carbon::parse($list->release_date)->format('d M') }}  </div>
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
			<ul class="pagination">
            @if ($movies->currentPage() > 1)
                <li class="page-item "><a href="{{ $movies->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $movies->lastPage(); $i++)
                <li class="page-item {{ $movies->currentPage() == $i ? 'active' : '' }}"><a href="{{ $movies->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($movies->currentPage() < $movies->lastPage())
                <li class="page-item "><a href="{{ $movies->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
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
@endsection
