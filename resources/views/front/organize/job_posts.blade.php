@extends('front/organize/layout')
@section('page_title','Manage Job')
@section('job_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
@if($job_posts)
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
        <a href="{{route('organize.manage_job_posts')}}" id="myDiv" class="btn-job theme-btn job-apply">Add Job</a> 
      @foreach($job_posts as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/setting/logo-color.png')}}" class="img-responsive" alt="" /></div>
              <h4><a href="{{route('job.details', [$list->slug])}}">{{$list->title}}</a><div style="float:right;"> {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div></h4>
              <div style="float:right;">@if($list->is_approved == '0')<p class="label label-warning">Approval Pending</p>@else <p class="label label-info">Approved</p> @endif </div>
              
              
              <span class="com-tagline">Actor</span>
			      </div>
            <div class="vertical-job-body">
              <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <ul class="can-skils">
                    <li><strong>Gender </strong>{{$list->gender}}</li>
                    <li><strong>Age Range: </strong>{{$list->MinAge}}-{{$list->MaxAge}}</li>
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
                    <li><strong>Budget: </strong>{{$list->budget}}</li>
                    <li><strong>Location: </strong>{{$list->state}}({{$list->city}})</li>
                  </ul>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                     
                  <div class="vrt-job-act">
                 
                  <a href="{{route('organize.manage_job_posts_parm', [$list->id])}}" title="" class="btn-job light-gray-btn">Edit Job</a>
                  <a href="{{route('organize.job_posts_delete', [$list->id])}}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn-job theme-btn job-apply">Delete Job</a>
                  <a href="{{route('organize.applied_user_list', [$list->id])}}" class="btn-job light-gray-btn"><p class="label label-success">{{$list->num_applications}}</p> New Application</a>
                   
                 </div>
                </div>
              </div>
            </div>        
         </div>        
        </div> 
        
      @endforeach
  <div class="utf_flexbox_area padd-0">
			
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
@endif
@endsection
