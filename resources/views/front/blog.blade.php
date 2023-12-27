@extends('front/layout')
@section('page_title','Blog')
@section('blog_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
  .col-md-3 {
    position: relative;
    overflow: hidden;
  }

  .img-zoom {
    transition: transform 0.3s;
  }

  .col-md-3:hover .img-zoom {
    transform: scale(1.1);
  }

    .blogname:hover{
        color:red;
    }
</style>

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Our Blogs</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i>Our Blogs</p>
    </div>
  </div>
</div>

<section class="padd-top-80 padd-bot-80">
  <div class="container"> 
    <!-- Tab panels -->
	<div class="row">
     <div class="tab-content">
     <section class="padd-top-80 padd-bot-50">

     @foreach($blog as $list)
  <div class="container">
    <a href="{{route('blog.blogdetails', [$list->slug])}}">
	<div class="user_acount_info">
	<div class="col-md-3 col-sm-5">
  <div class="emp-pic">
    <img class="img-responsive width-450 img-zoom" src="{{asset('assets/blog/'.$list->thumbnail)}}" alt="">
  </div>
</div>
		<div class="col-md-9 col-sm-7">
		  <div class="emp-des">
			<h2 class="blogname">{{$list->title}}</h2>
			<span class="theme-cl">{{ Carbon\Carbon::parse($list->created_at)->format('d-m-Y') }}</span>
			@php
			$blogContent = preg_replace('/<img[^>]+>/i', '', $list->blog);
            $limitedContent = Str::limit($blogContent, 350, ' ...');
			@endphp
      <p>{!! $limitedContent !!}</p>
		  </div>      
		</div> 
	</div> 	
    </a>
  </div>
        @endforeach
</section>


		<div class="clearfix"></div>
        <div class="utf_flexbox_area padd-0">
			
			<ul class="pagination">
            @if ($blog->currentPage() > 1)
                <li class="page-item "><a href="{{ $blog->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $blog->lastPage(); $i++)
                <li class="page-item {{ $blog->currentPage() == $i ? 'active' : '' }}"><a href="{{ $blog->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($blog->currentPage() < $blog->lastPage())
                <li class="page-item "><a href="{{ $blog->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
		</div>
     </div>
	</div>
    <!-- Tab panels -->     
  </div>
</section>
@endsection