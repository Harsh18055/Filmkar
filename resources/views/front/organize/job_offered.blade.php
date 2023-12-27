@extends('front/organize/layout')
@section('page_title','Manage course')
@section('joboffered_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<style>
@media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   { 
   .width{
   width: 330px;
   }
   }
   /* For 1024 Resolution */  
   @media only screen   
   and (min-width: 1370px)  
   and (max-width: 1605px) 
   { 
   .width{
	width: 1000px;
   }
   }  
	</style>
<form action="{{route('organize.job_offered_process')}}" method="post">
    @csrf
<div class="profile_detail_block width">
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
    @php 
    $loop_count_num=1;
    @endphp
    @foreach($jobarr as $key=>$val)
    @php 
    $loop_count_prev=$loop_count_num;
    $video=(array)$val;
    @endphp
    <input type="hidden" name="id[]" value="{{$val['id']}}">
            <div class="col-md-10 col-sm-10 col-xs-12  offer_">
			  <div class="form-group">
				<label>Enter Job Name</label>
				<input type="text" name="job_name[]" class="form-control" value="{{$val['job_name']}}" placeholder="Enter Job Name">
			  </div>
			</div>
            <div class="col-md-2 col-sm-2 col-xs-12">
			  <div class="form-group">
				<label>&nbsp;&nbsp;</label>
				<a href="{{url('organize/delete/job/')}}/{{$val['id']}}" class="btn btn-m theme-btn full-width">Delete</a>
			  </div><br>
			</div>
    @endforeach
			<div id="offer_box"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<!-- <label>Add+</label> -->
				<button type="button" onclick="add_offer_more()" class="form-control">Add+</button>
			  </div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
		</div>
        </form>

		<script>
			var count = 1;
			function add_offer_more(){
				count++;
				// alert(count)
				var html = '<div class="col-md-10 col-sm-10 col-xs-12 offer_'+count+'"><div class="form-group"><input type="text" name="job_name[]" class="form-control" placeholder="Enter job Name"></div></div>';

				 html+= '<div class="col-md-2 col-sm-2 col-xs-12 offer_'+count+'"><div class="form-group"><button type="button" name="job_name[]" onclick="remove_offer('+count+')" class="btn btn-m theme-btn full-width">Remove</button></div></div>';
				 jQuery('#offer_box').append(html)
			}

			function remove_offer(count){
        jQuery('.offer_'+count).remove();
   }
		</script>
		
@endsection
