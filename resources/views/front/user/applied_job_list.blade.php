@extends('front/user/layout')
@section('page_title','Change Password')
@section('applied_job_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
@foreach($applied_jobs as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/setting/logo-color.png')}}" class="img-responsive" alt="" /></div>
              <h4><a href="{{route('job.details', [$list->slug])}}">{{$list->title}}</a></h4>
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
                  <a href="{{route('job.details', [$list->slug])}}" title="" class="btn-job light-gray-btn">View Job</a>
                 </div>
                </div>
              </div>
            </div>        
         </div>        
        </div> 
        
      @endforeach

@endsection
