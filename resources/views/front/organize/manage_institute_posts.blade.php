@extends('front/organize/layout')
@section('page_title','Manage Job')
@section('institute_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')

<form action="{{route('organize.manage_institute_process')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="representers_id" value="{{$id}}">
    <input type="hidden" name="id" value="{{$id}}">
<div class="profile_detail_block">
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
            <div class="col-md-12">
			  <div class="form-group">
				<label>Title</label>
				<input type="text" name="title" required value="{{$title}}" class="form-control" placeholder="Enter Title">
			  </div>
			</div>
      <div class="col-md-12">
			  <div class="form-group">
				<label>Thumbnail</label>
				<input type="file" name="thumbnail" value="{{$thumbnail}}" class="form-control" placeholder="select thumbnail">
			  </div>
			</div>
          
            <div class="col-md-12">
			  <div class="form-group">
				<label>Address</label>
				<textarea name="address" id="address" class="form-control" placeholder="Select Address">{{$address}}</textarea>
			  </div>
			</div>
			<div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <div id="output"></div>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    
                    @foreach($state as $list)
				@if($state_id==$list->id)
				<option selected value="{{$list->id}}">
					@else
				<option value="{{$list->id}}">
					@endif
					{{$list->name}}
				</option>
				@endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" required>
                <option disabled selected>Please Select City</option>
                @if(isset($usercity) != null)
				<option selected value="{{$usercity->id}}">{{$usercity->city}}
                @foreach($cityarr as $list)
					<option value="{{$list->id}}">{{$list->city}}</option>
					@endforeach
				@endif
					
					
				</option>
                </select>
              </div>
              </div>
            <div class="col-md-12">
			  <div class="form-group">
				<label>About</label>
				<textarea name="about" id="description" class="form-control" placeholder="Select Address">{{$address}}</textarea>
			  </div>
			</div>
            <div class="col-md-4">
			  <div class="form-group">
				<label>Phone Number</label>
				<input type="text" name="contact_no" id="contact_no" value="{{$contact_no}}" class="form-control" placeholder="Enter Phone Number">
			  </div>
			</div>
            <div class="col-md-4">
			  <div class="form-group">
				<label>Email</label>
				<input type="text" name="email" id="email" value="{{$email}}" class="form-control" placeholder="Enter Email">
			  </div>
			</div>
            <div class="col-md-4">
			  <div class="form-group">
				<label>Website</label>
				<input type="text" name="website" id="website" value="{{$website}}" class="form-control" placeholder="Enter Website">
			  </div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Submit"></div>
		</div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
   var loadFile = function(event) {
     var reader = new FileReader();
     reader.onload = function(){
       var output = document.getElementById('output');
       output.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
   };
   $(document).ready(function () {
   CKEDITOR.replace('description');
   
});
</script>
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
