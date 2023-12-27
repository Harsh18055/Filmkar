@extends('front/organize/layout')
@section('page_title','Manage Movies')
@section('movie_select','active')
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
        <a id="myDiv" href="{{route('organize.manage_movie')}}" class="btn-job theme-btn job-apply">Add Movie</a> 
        @foreach($movies as $list)
        <div class="job-verticle-list">
          <div class="vertical-job-card">
            <div class="vertical-job-header">
              <div class="vrt-job-cmp-logo"> <img src="{{asset('assets/setting/logo-color.png')}}" class="img-responsive" alt="" /></div>
              <h4><a href="{{route('movies.details', [$list->slug])}}">{{$list->title}}</a><div style="float:right;"> {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div></h4>
              <div style="float:right;">@if($list->is_approved == '0')<p class="label label-warning">Approval Pending</p>@else <p class="label label-info">Approved</p> @endif</div>
              <span class="com-tagline">Actor</span>
			      </div>
            <div class="vertical-job-body">
              <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12">
                  <ul class="can-skils">
                    <li><strong>About: </strong>{{strip_tags($list->about)}}</li>
                    
                    <li><strong>Genre: </strong>
                    @php
                        $genre_ids = json_decode($list->genre);
                        $genre_names = [];
                        foreach ($genre_ids as $genre_id) {
                            $genre_name = DB::table('genre_type')->where('id', $genre_id)->value('name');
                            if ($genre_name) {
                                $genre_names[] = $genre_name;
                            }
                        }
                        $genre_names_string = implode(', ', $genre_names);
                    @endphp
                    
                    {{ $genre_names_string }}</li>
                    
                    </li>
                    
                    <li><strong>Format: </strong>
                    @php
                        $format_ids = json_decode($list->format);
                        $format_names = [];
                        foreach ($format_ids as $format_id) {
                            $format_name = DB::table('format_type')->where('id', $format_id)->value('name');
                            if ($format_name) {
                                $format_names[] = $format_name;
                            }
                        }
                        $format_names_string = implode(', ', $format_names);
                    @endphp
                    
                    {{ $format_names_string }}</li>
                    
                    </li>
                    
                    <li><strong>Language: </strong>
                    @php
                        $format_ids = json_decode($list->language);
                        $format_names = [];
                        foreach ($format_ids as $format_id) {
                            $format_name = DB::table('languages')->where('id', $format_id)->value('language');
                            if ($format_name) {
                                $format_names[] = $format_name;
                            }
                        }
                        $format_names_string = implode(', ', $format_names);
                    @endphp
                    
                    {{ $format_names_string }}</li>
                    
                    </li>
                    <li><strong>Certificate: </strong>{{$list->certificate}}</li>
                    <li><strong>Release Date: </strong>{{$list->release_date}}</li>
                    <li><strong>Time Of Movie: </strong>{{$list->movie_hour}} hour {{$list->movie_minute}} minute</li>
                    <li><strong>Trailer: </strong><a href="https://{{$list->trailer_link}}" class="btn-job theme-btn job-apply">Watch trailer</a></li>
                  </ul>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    
                  <div class="vrt-job-act">
                  <a href="{{route('organize.manage_movie_parm', [$list->id])}}" title="" class="btn-job light-gray-btn">Edit Movie</a>
                  <a href="{{route('organize.movie_delete', [$list->id])}}" class="btn-job theme-btn job-apply" onclick="return confirm('Are you sure you want to permanentaly delete this item ?')">Delete Movie</a> 
                 </div>
                </div>
              </div>
            </div>        
         </div>        
        </div> 
        
      @endforeach
     
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
@endsection
