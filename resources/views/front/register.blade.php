@extends('front/layout')
@section('page_title','Register')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
  .d-none{
    display: none;
  }
  .switch {
position: relative;
display: inline-block;
width: 40px;
height: 20px;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 14px;
width: 14px;
left: 3px;
bottom: 3px;
background-color: white;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:checked + .slider:before {
transform: translateX(18px);
}

.slider.round {
border-radius: 20px;
}

.slider.round:before {
border-radius: 50%;
}

.toggle-password {
    float: right;
    cursor: pointer;
    margin-right: 10px;
    margin-top: -50px;
}

  </style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Register as Talent</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Register as Talent</p>
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
        <form class=
        <form class="log-form" action="{{route('user.user_register')}}" method="post" onsubmit="return validate()">
            @csrf
            <input type="hidden" name="referral_code" value="{{ request()->get('referral_code') }}">
           <div class="col-md-12">
  <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" onkeypress="return AvoidSpace(event);" onblur="validateUsername()" class="form-control" placeholder="username" id="username">
    @error('username')
    <span class="text-danger">{{ $message }}</span>
@enderror
  </div>
</div>
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname">
                    @error('firstname')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" placeholder="last name" id="lastname">
                @error('lastname')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                @error('email')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
            </div>
            
             <div class="col-md-6">
              <div class="form-group">
                <label>Phone no</label>
                <input type="number" name="phonenumber" class="form-control" oninput="validatePhoneNumber(this)" placeholder="Phone no" id="phonenumber">
                
                @error('phonenumber')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6" class="form-control" placeholder="Password" id="password">
                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                @error('password')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
              <p style="background-color: lightyellow;"> 1. Atleast One Capital.<br>
                  2. Atleast One Character.<br>
                  3. Atleast One Number.<br>
              </p>
            </div><br>
            <div class="col-md-6">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="c_password" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$" minlength="6" class="form-control" placeholder="confirm Password" id="confirmpassword">
                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                @error('c_password')
    <span class="text-danger">{{ $message }}</span>
@enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Sign Up</button>
              </div>
            </div>
			<div class="clearfix"></div>			
        </form>
      </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>

<!--Register Validation Code-->
<script>
     function validate() {
  const fields = ["username","First Name","Last Name","email","phonenumber","password","confirmpassword"];

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

$("#categories").change(function(){

    var selected = [];
    var selectedtext = [];
    for (var option of document.getElementById('categories').options)
    {
        if (option.selected) {
            selected.push(option.value);
            selectedtext.push(option.text.toLowerCase());
        }
    }

    // var category_box_1 = document.getElementById('category_box_1').value;
    // alert(category_box_1);
    $.get("/getsubcat?array="+selected, function(data){
        $("#subcat").html(data);
    });

    $.get("/getisattrcategory?array="+selected, function(data){
        if(data == 1){
          $("#div").removeClass("d-none");
          $("#eyecolor").attr('required', ''); 
          $("#haircolor").attr('required', ''); 
          $("#dresssize").attr('required', ''); 
          $("#shoesize").attr('required', ''); 
          $("#hairtype").attr('required', ''); 
          $("#talent_height_in_CM").attr('required', ''); 
          $("#waist_in_CM").attr('required', ''); 
        }else{
          $("#div").addClass("d-none");
          $("#eyecolor").removeAttr('required', ''); 
          $("#haircolor").removeAttr('required', ''); 
          $("#dresssize").removeAttr('required', ''); 
          $("#shoesize").removeAttr('required', ''); 
          $("#hairtype").removeAttr('required', ''); 
          $("#talent_height_in_CM").removeAttr('required', ''); 
          $("#waist_in_CM").removeAttr('required', ''); 
        }
    });
    
    $(this).parent().css({
    'height' : 'auto'
    });
    
    $("#subcat").parent().css({
    'height' : 'auto'
    });
   
});
</script>
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
//   $(document).ready(function () {
//   CKEDITOR.replace('aboutyou');
   
// });
   </script>
<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#aboutyou' ),{
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
        }
            })
            .catch( error => {
                console.error( error );
            } );
    </script>

<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js'></script>
    <script id="rendered-js">
        $('.label.ui.dropdown').
        dropdown();

        $('.no.label.ui.dropdown').
        dropdown({
            useLabels: false
        });


        $('.ui.button').on('click', function() {
            $('.ui.dropdown').
            dropdown('restore defaults');
        });
        //# sourceURL=pen.js

        /* Not Allow Spcace Type in textbox */
function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32) return false;
}

/* Remove Blank Space Automatically Before, After & middle of String */

function removeSpaces(string) {
 return string.split(' ').join('');
}

var today = new Date().toISOString().split('T')[0];
  document.getElementById('birthdate').setAttribute('max', today);
    </script>
<!--<script>-->
<!--  function validateUsername() {-->
<!--    var input = document.getElementById("username");-->
<!--    var username = input.value.trim();-->

<!--    if (!/^[a-zA-Z]+(_[a-zA-Z]+)?$/.test(username)) {-->
<!--      Swal.fire('Username must be in the format');-->
<!--      input.value = ""; -->
<!--    }-->
<!--  }-->
<!--</script>-->

<script>

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

function validatePhoneNumber(input) {
  // Remove non-digit characters
  var phoneNumber = input.value.replace(/\D/g, '');
  
  // Limit to 10 digits
  if (phoneNumber.length > 10) {
    phoneNumber = phoneNumber.slice(0, 10);
  }

  // Update the input value
  input.value = phoneNumber;
}
</script>


@endsection
