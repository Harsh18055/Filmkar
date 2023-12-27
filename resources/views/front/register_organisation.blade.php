@extends('front/layout')
@section('page_title','Register')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Register as Organisation</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Register as organisation</p>
    </div>
  </div>
</div>
@if(session()->has('error'))
    <div class="sufee-alert alert with-close alert-danger">
        {{session('error')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif 
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
        <form class="log-form" action="{{route('organisation.register')}}" method="post" onsubmit="return validate()">
            @csrf
            <input type="hidden" name="referral_code" value="{{ request()->get('referral_code') }}">
            <div class="col-md-12">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" onkeypress="return AvoidSpace(event);" onblur="this.value=removeSpaces(this.value);" class="form-control" placeholder="Enter Username" id="username">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Organisation Name</label>
                <input type="text" name="company" class="form-control" placeholder="Organisation Name" id="Organisation">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter Email" id="email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6" class="form-control" placeholder="password" id="password">
              </div>
              
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="cpassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6" class="form-control" placeholder="Confirm Password" id="conformpassword">
              </div>
            </div>
            <div class="col-md-12">
                <p style="background-color: lightyellow;"> 1. Atleast One Capital.<br>
                  2. Atleast One Character.<br>
                  3. Atleast One Number.<br>
              </p>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Representer</label>
                <select class="form-control" name="representer_id" id="Selectrepresenters">
                    <option disabled selected value="">Select Representers</option>
                    @foreach($representers as $list)
                    <option value="{{$list->id}}">{{$list->representers}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="type" id="SelectType">
                    <option disabled selected value="">Select Type</option>
                    <option value="Educational">Educational</option>
                    <option value="NonEducational">Non-Educational</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>About Organisation</label>
                <textarea name="about_company" class="form-control" placeholder="About Organisation" id="About Organisation"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" required>
                    <option disabled selected>Please Select State</option>
                    @foreach($state as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" required>
                <option disabled selected>Please Select City</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Zipcode</label>
                <input type="tel"  name="zipcode" id="zipcode" class="form-control" placeholder="zipcode" maxlength="6" oninput="this.value = this.value.replace(/[^0-6]/g, '').substring(0, 6);">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Website</label>
              <input type="url" name="website" class="form-control" placeholder="Website" id="website">

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone No</label>
                <input type="tel" name="phone_no"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);" class="form-control" placeholder="Phone Number" maxlength="10" id="phone_no">
                
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Whatsapp No</label>
                 <input type="tel" name="whatsapp_no"  oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);" class="form-control" placeholder="Enter whatsapp number" maxlength="10" id="whatsappnumber">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Register</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
      </div>
  </div>
</section>
<!--Rgister Organisation-->
<script>
    function validate() {
  const fields = ["username","Organisation","email","password","conformpassword","Selectrepresenters","SelectType","About Organisation","state_id","city_id","zipcode","phonenumber","whatsappnumber"];

  for (let field of fields) {
    const value = document.getElementById(field).value;
    if (value === '') {
      Swal.fire(`${getFieldName(field)} is required`);
      return false;
    }
  }
}
</script>


<script>

$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});

        /* Not Allow Spcace Type in textbox */
        function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}

/* Remove Blank Space Automatically Before, After & middle of String */

function removeSpaces(string) {
 return string.split(' ').join('');
}
</script>
@endsection