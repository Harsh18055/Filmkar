@extends('front/organize/layout')
@section('page_title','Manage Events')
@section('event_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<div class="col-md-9 col-sm-7">
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success" style="font-weight: bold; font-size:18px;">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 	
	@if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif
        <!-- Single Verticle job -->
        <a id="myDiv" href="{{route('organize.manage_event_posts')}}" class="btn-job theme-btn job-apply">Add Event</a> 
        @foreach($event_posts as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/setting/logo-color.png')}}" class="img-responsive" alt="" /></div>
               <h4><a href="{{route('events.details', [$list->slug])}}">{{$list->title}}</a><div style="float:right;"> {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div></h4>
              <div style="float:right;">@if($list->is_approved == '0')<p class="label label-warning">Approval Pending</p>@else <p class="label label-info">Approved</p> @endif</div>
             
              <span class="com-tagline">Actor</span>
			      </div>
            <div class="vertical-job-body">
              <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <ul class="can-skils">
                    <li><strong>Time: </strong>{{$list->start_time}} - {{$list->end_time}}</li>
                    <li><strong>Date: </strong>{{$list->start_date}} - {{$list->end_date}}</li>
                    <li><strong>Tags: </strong>
                     <div>
                      @php
                      $string = $list->tags; 
                      $str_arr = preg_split ("/\,/", $string); 
                      $array_tags =  $str_arr;
                      @endphp
                      @foreach($array_tags as $tag)
                      <span class="skill-tag">{{$tag}}</span>
                      @endforeach
                    </div> 
                    </li>
                    <li><strong>Budget: </strong>{{$list->price}}</li>
                    @if($list->event_type == 'ofline')
                    <li><strong>Location: </strong>{{$list->state}}({{$list->city}})</li>
                    @endif
                  </ul>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    
                  <div class="vrt-job-act">
                  <a href="{{route('organize.manage_event_posts_parm', [$list->id])}}" title="" class="btn-job light-gray-btn">Edit Event</a>
                  <a href="{{route('organize.event_posts_delete', [$list->id])}}"  onclick="return confirm('Are you sure you want to delete this item?');" class="btn-job theme-btn job-apply">Delete Event</a> 
                 </div>
                </div>
              </div>
            </div>        
         </div>        
        </div> 
        
      @endforeach
  <div class="utf_flexbox_area padd-0">
			
			<ul class="pagination">
            @if ($event_posts->currentPage() > 1)
                <li class="page-item "><a href="{{ $event_posts->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $event_posts->lastPage(); $i++)
                <li class="page-item {{ $event_posts->currentPage() == $i ? 'active' : '' }}"><a href="{{ $event_posts->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($event_posts->currentPage() < $event_posts->lastPage())
                <li class="page-item "><a href="{{ $event_posts->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
		</div>
</div>        
@endsection
