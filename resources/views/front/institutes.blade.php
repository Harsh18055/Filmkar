@extends('front/layout')
@section('page_title','Organisations')
@section('institute_select','active')
@section('nav_class','white no-background')
@section('container')

<style>
    .institutesname:hover{
        color:red;
    }
</style>

<div class="page-title">
  <div class="container-fluid">
    <div class="page-caption text-center">
      <h2>Browse Organisations</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Browse Organisations</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
      <form action="{{route('institutes.search')}}" method="get">

         <div class="col-md-3 col-sm-5">
            <div class="widget-boxed padd-bot-0">
               <div class="widget-boxed-body">
                  <div class="search_widget_job">
                     <div class="field_w_search">
                         <h4>Search Organisation</h4>
                        <input type="text" name="keyword" class="form-control" placeholder="Search Organisation" value="{{ request()->get('keyword')}}">
                     </div>
                  </div>
               </div>
            </div>
               <div class="widget-boxed padd-bot-0">
                  <div class="widget-boxed-header">
                     <!--<h4>Category</h4>-->
                     <!--<select class="wide form-control br-1" name="category_id">-->
                     <!--   <option value="" selected>Select Category</option>-->
                     <!--   @foreach($category as $list)-->
                     <!--   @if(request()->get('category_id')==$list->id)-->
                     <!--   <option selected value="{{$list->id}}">-->
                     <!--      @else-->
                     <!--   <option value="{{$list->id}}">-->
                     <!--      @endif-->
                     <!--      {{$list->category_name}}-->
                     <!--   </option>-->
                     <!--   @endforeach-->
                     <!--</select>-->
                     <h4>Organisations Type</h4>
                     <select class="form-control" name="type">
                        <option value="" selected>Select Type</option>
                        <option value="Educational">Educational</option>
                        <option value="NonEducational">NonEducational</option>
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
          <a href="{{route('institutes')}}" class="btn btn-m theme-btn full-width" value="Filter">Clear Filter</a>
            </form>
            </div>
         </div>
         <!-- Start Job List -->
         <div class="col-md-9 col-sm-7">
            <div class="row mrg-bot-20">
               <div class="col-md-4 col-sm-12 col-xs-12 browse_job_tlt">
                  <h4 class="job_vacancie">{{$count}} Organisations</h4>
               </div>
            </div>
            <!-- Single Verticle job -->
            @if(count($institutes) > 0)
            @foreach($institutes as $list)
            <div class="col-md-3 col-sm-3" style="height:260px;">
               <div class="utf_grid_job_widget_area">
                  <a href="{{ route('institutes.details', [$list->id]) }}">
                     <div class="u-content">
                        <div class="avatar box-80" style="height: 90px; width: 140px; background-image: url('{{ $list->logo != '' ? asset('assets/institute/logo/'.$list->logo) : asset('assets/profile/default_avatar.jpg') }}'); background-size: cover; background-position: center;"> 
                        </div>
                        <h5 class="institutesname" style="text-overflow : ellipsis;white-space: nowrap;  overflow: hidden;">{{$list->company}}</h5>
                        <p class="text-muted">{{ $list->state }} ({{ $list->city }})</p>
                     </div>
                  </a>
               </div>
            </div>
            @endforeach
            @else
                <div class="col-md-10 text-center user_profile_img">
                    <img src="{{asset('assets/profile/noresult.png')}}" style=" width: 70%;"  alt="">
                </div>
            @endif
            <div class="clearfix"></div>
            <div class="utf_flexbox_area padd-0">
			
			<ul class="pagination">
            @if ($institutes->currentPage() > 1)
                <li class="page-item "><a href="{{ $institutes->previousPageUrl() }}" class="pagination-link"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
            @endif

            @for ($i = 1; $i <= $institutes->lastPage(); $i++)
                <li class="page-item {{ $institutes->currentPage() == $i ? 'active' : '' }}"><a href="{{ $institutes->url($i) }}" class="pagination-link ">{{ $i }}</a></li>
            @endfor

            @if ($institutes->currentPage() < $institutes->lastPage())
                <li class="page-item "><a href="{{ $institutes->nextPageUrl() }}" class="pagination-link"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
            @endif
        </ul>
		</div>
         </div>
        
        
        
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
