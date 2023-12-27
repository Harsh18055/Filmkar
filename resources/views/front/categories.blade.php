@extends('front/layout')
@section('page_title','Home')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container') 

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Categories</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Categories</p>
    </div>
  </div>
</div>
<section class="utf_job_category_area">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="heading">
               <h2>Categories</h2>
               <p>Discover the diverse tapestry of film expertise, from actors to directors, musicians to technicians, and delve into every facet of the vibrant film industry with Filmkar's comprehensive profiles.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            @foreach($category_count as $list)
            <div class="col-md-3 col-sm-6">
               <a href="{{ route('details', [$list['category_slug']]) }}" title="">
                  <div class="utf_category_box_area">
                     <div class="utf_category_desc">
                        <div class="category-detail utf_category_desc_text">
                           <h4>{{$list['category_name']}}</h4>
                           <p>{{$list['count']}}</p>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            @endforeach
             
         </div>
      </div>
   </div>
</section>

<div><a href="#" class="scrollup">Scroll</a></div>
<!-- Jquery js--> 
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="assets/plugins/bootstrap/js/bootsnav.js"></script> 
<script src="assets/js/viewportchecker.js"></script> 
<script src="assets/js/slick.js"></script> 
<script src="assets/plugins/bootstrap/js/wysihtml5-0.3.0.js"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap-wysihtml5.js"></script> 
<script src="assets/plugins/aos-master/aos.js"></script> 
<script src="assets/plugins/nice-select/js/jquery.nice-select.min.js"></script> 
<script src="assets/js/custom.js"></script> 
<script>
   $(window).load(function() {
     $(".page_preloader").fadeOut("slow");;
   });
   AOS.init();
</script>
@endsection