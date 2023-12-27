@extends('front/layout')
@section('page_title','Login')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
    .none{
        display: none;
    }
    </style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Change Password</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> chnage Password</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
      @if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 	
        <form class="log-form" action="{{route('telent.changepassword.process')}}" method="post" id="telent">
            @csrf
            <input type="hidden" name="email" value="{{ Request::get('email') }}">
            <input type="hidden" name="token" value="{{ Request::get('token') }}">
            <input type="hidden" name="user_type" value="{{ Request::get('user_type') }}">
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" placeholder="Enter Password" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" placeholder="Enter Confirm Password" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Change Password</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
        
      </div>
  </div>
</section>
@endsection
