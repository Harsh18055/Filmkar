@extends('front/organize/layout')
@section('page_title','Manage Institute')
@section('institute_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<div class="col-md-9 col-sm-7">
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success">
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
        <a href="{{route('organize.manage_institute_posts')}}" class="btn-job theme-btn job-apply">Add Institute</a> 
        @foreach($institute_posts as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/setting/logo-color.png')}}" class="img-responsive" alt="" /></div>
              <h4><a href="{{route('organize.applied_user_list', [$list->id])}}">{{$list->title}}</a></h4>
              <span class="com-tagline">Actor</span>
			      </div>
            <div class="vertical-job-body">
              <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <ul class="can-skils">
                    <li><strong>Address: </strong>{{$list->address}}</li>
                    <li><strong>Contact Number: </strong>{{$list->contact_no}}</li>
                    <li><strong>Email: </strong>{{$list->email}}</li>
                    <li><strong>Website: </strong>{{$list->website}}</li>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                  <div class="vrt-job-act">
                  <a href="{{route('organize.manage_institute_posts_parm', [$list->id])}}" title="" class="btn-job light-gray-btn">Edit Institute</a>
                  <a href="{{route('organize.institute_posts_delete', [$list->id])}}" class="btn-job theme-btn job-apply">Delete Institute</a> 
                 </div>
                </div>
              </div>
            </div>        
         </div>        
        </div> 
        
      @endforeach
      {!! $institute_posts->links() !!} 
  
</div>        
@endsection
