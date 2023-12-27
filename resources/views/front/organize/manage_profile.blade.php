@extends('front/organize/layout')
@section('page_title','Manage Profile')
@section('manageprofile_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="myDiv" class="log-form" action="{{route('organize.manage_profile_process')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$organize_user->id}}">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{$organize_user->email}}" class="form-control" placeholder="email" required>
              
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{$organize_user->username}}" class="form-control" placeholder="Username" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Organisation Name</label>
                <input type="text" name="company" value="{{$organize_user->company}}" class="form-control" placeholder="Company" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>Logo</label>
              <input type="file" name="logo" value="{{$organize_user->logo}}" class="form-control" placeholder="select thumbnail">
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" value="{{$organize_user->thumbnail}}" class="form-control" placeholder="select thumbnail">
              </div>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Representer</label>
                <select class="form-control" name="representer_id">
                    <option disabled selected>Select Representers</option>
                    @foreach($representers as $list)
                    @if($organize_user->representer_id==$list->id)
                    <option selected value="{{$list->id}}">
                        @else
                    <option value="{{$list->id}}">
                        @endif
                        {{$list->representers}}
                    </option>
                    @endforeach
                   
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>About Organisation</label>
                <textarea name="about_company" id="about_company" class="form-control" placeholder="About Company" required>{{$organize_user->about_company}}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    @foreach($state as $list)
				@if($organize_user->state_id==$list->id)
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
                      @if($usercity != null)
                        <option selected value="{{$usercity->id}}">{{$usercity->city}}</option>
                      @endif
                      @foreach($cityarr as $list)
                        <option value="{{$list->id}}">{{$list->city}}</option>
                      @endforeach
                    </select>
                  </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Complete Address</label>
                <textarea type="text" name="address" class="form-control" placeholder="Enter Address" required>{{$organize_user->address}}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Google Map Link</label>
                <textarea type="text" name="google_map_link" class="form-control" placeholder="Enter Google Map Link" required>{{$organize_user->google_map_link}}</textarea>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Zipcode</label>
                <input type="text" name="zipcode" value="{{$organize_user->zipcode}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6)" class="form-control" placeholder="zipcode" maxlength="6" required>

              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" pattern="^(https?://)?([\w\-]+\.)+[a-zA-Z]{2,}(\/\S*)?$" value="{{$organize_user->website}}" class="form-control" placeholder="website" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Phone No</label>
                <small>EX: 1234567890</small>
                <input type="text" name="phone_no" value="{{$organize_user->phone_no}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" class="form-control" placeholder="phonenumber" maxlength="10" required>

              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Whatsapp No</label>
                <small>EX: 1234567890</small>
                <input type="text" name="whatsapp_no" value="{{$organize_user->whatsapp_no}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" class="form-control" placeholder="whatsappnumber" maxlength="10" required>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">update</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
<script>
function checkInput() {
  var input = document.getElementById("zipcode").value;
  if (input.length > 6) {
    alert("Error: Only 6 digits are allowed.");
  }
}
$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});
$(document).ready(function () {
   CKEDITOR.replace('about_company');
   
});
</script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
@endsection
