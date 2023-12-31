@extends('front/user/layout')
@section('page_title','Change Password')
@section('password_select','active')
@section('nav_class','white no-background')
@section('usercontainer')

<form action="{{route('user.change_password_process')}}" method="post">
    @csrf
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
     <h4>Note:</h4>
    <p style="background-color: lightyellow; margin:15px; padding:10px;"> 1. Atleast One Capital.<br>
                  2. Atleast One Character.<br>
                  3. Atleast One Number.<br>
    <div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>Current Password</label>
				<input type="password" name="current_password" class="form-control" placeholder="***********">
			  </div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>New Password</label>
				<input type="password" name="password" class="form-control" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6"  placeholder="***********">
			  </div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="c_password" class="form-control" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6"  placeholder="***********">
			  </div>
			</div>	
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
		</div>
        </form>
@endsection
