@extends('front/user/layout')
@section('page_title','Manage Profile')
@section('manageprofile_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
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

.wide.form-control.label.ui.selection.fluid.dropdown.multiple {
    height: auto !important;
  }
</style>
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
<form action="{{route('user.manage_profile_process')}}" method="post" enctype="multipart/form-data" onsubmit="return validate()">
	@csrf
	<input name="id" type="hidden" value="{{$id}}">
<div class="profile_detail_block">
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" value="{{$username}}" placeholder="username" id="username">
			  </div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" id="email" value="{{$email}}" placeholder="mail@example.com">
			  </div>
			</div>
				<div class="col-md-2 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="switch">
				@if($is_email_enable == '1')
                <input name="is_email_enable" value="1" type="checkbox" checked>
				@else
                <input name="is_email_enable" value="0" type="checkbox">
				@endif
                <span class="slider round"></span>
              </label>
              <label>email visible</label>
              </div>
            </div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>First Name</label>
				<input type="text" class="form-control" id="firstname" name="firstname" value="{{$firstname}}" placeholder="Slogan">
			  </div>
			</div>  
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Last Name</label>
				<input type="text" class="form-control"id="lastname" name="lastname" value="{{$lastname}}" placeholder="mail@example.com">
			  </div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Phone</label>
		<input type="tel" class="form-control" id="phonenumber" name="phonenumber" value="{{$phonenumber}}" placeholder="Enter 10-digit number" required>

			  </div>
			  	<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="switch">
				@if($is_phoneno_enable == '1')
                <input name="is_phoneno_enable" value="1" type="checkbox" checked>
				@else
                <input name="is_phoneno_enable" value="0" type="checkbox">
				@endif
                <span class="slider round"></span>
              </label>
              <label>Phone Number visible</label>
              </div>
            </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label>Whatsapp No</label>
		<input type="tel" name="whatsapp_no" value="{{$whatsapp_no}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10);" class="form-control" placeholder="Whatsapp Number" maxlength="10" id="whatsapp_no">


			  </div>
			  </div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Gender</label>
				<select class="wide form-control" name="gender" id="gender">
				  @if($gender=='male')
				  <option value="male" selected>Male</option>
				  <option value="female">Female</option>
				  @else
				  <option value="female" selected>Female</option>
				  <option value="male">Male</option>
				  @endif
				</select>
			  </div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>Language</label>
				<select class="wide form-control label ui selection fluid dropdown" id="mylanguage" name="language[]" multiple="multiple" style="height:200px;">
				@foreach($languages as $onelan)
					@if(in_array($onelan->id, $lanarrselected))
					<option selected value="{{$onelan->id}}">
					@else
					<option value="{{$onelan->id}}">
					@endif
					{{$onelan->language}}</option>
					@endforeach
				</select>
			  </div>
			</div>
			<!--<div class="col-md-6 col-sm-6 col-xs-12">-->
			<!--  <div class="form-group">-->
			<!--	<label>Uplaod Profile Photo</label>-->
			<!--	<input type="file" name="profile" id="image" class="form-control" onchange="loadFile(event)">-->
			<!--	<textarea name="base_profile_img" id="base_profile_img" style="display: none;"></textarea>-->
			<!--  </div>-->
			<!--  <img style="width: 150px;" id="output"/>-->
			<!--</div>-->
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>State</label>
				<select class="wide form-control" name="state_id" id="state_id">
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
			<div class="col-md-6 col-sm-6 col-xs-12">
                <label>City</label>
                  <select class="wide form-control" id="city_id" name="city_id">
                    @if($usercity != null)
                      <option selected value="{{$usercity->id}}">
                        {{$usercity->city}}
                      </option>
                    @endif
                    @foreach($cityarr as $list)
                      <option value="{{$list->id}}">{{$list->city}}</option>
                    @endforeach
                  </select>
            </div>

			
            <div class="col-md-6 col-sm-6 col-xs-12" >
			  <div class="form-group" >
				<label>Categories</label>
				<select class="wide form-control label ui selection fluid dropdown" name="categories[]" id="categories" multiple="multiple" >
				@foreach($category as $onecat)
					@if(in_array($onecat->id, $catarrselected))
					<option selected value="{{$onecat->id}}" >
					@else
					<option value="{{$onecat->id}}" >
					@endif
					{{$onecat->category_name}}</option>
					@endforeach
				</select>
			  </div>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
			  <label>Subcategory</label>
				<select class="wide form-control label ui selection fluid dropdown" id="subcat" name="categories[]" multiple="multiple">
				@foreach($subcatselected as $onesubcat)
				@if(in_array($onesubcat->id, $catarrselected))
				<option selected value="{{$onesubcat->id}}">
				@else
					<option value="{{$onesubcat->id}}">
					@endif
					{{$onesubcat->category_name}}</option>
					@endforeach
				</option>
				
				</select>
			  </div>
			</div>
			<div id="div" class="{{$dnone}}">
				<input type="hidden" name="attr_id" value="{{$attr_id}}" id="attr_id">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Eye Color</label>
						<select class="wide form-control br-1 " id="eyecolor" name="eyecolor">
							<option value="Black" {{$eyecolor == 'Black' ? "selected" : ""}} >Black</option>
							<option value="Blue" {{$eyecolor == 'Blue' ? "selected" : ""}}>Blue</option>
							<option value="Brown" {{$eyecolor == 'Brown' ? "selected" : ""}}>Brown</option>
							<option value="Green" {{$eyecolor == 'Green' ? "selected" : ""}}>Green</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Hair Color</label>
						<select class="wide form-control br-1 " id="haircolor" name="haircolor">
							<option value="Black" {{$haircolor == 'Black' ? "selected" : ""}}>Black</option>
							<option value="Brown" {{$haircolor == 'Brown' ? "selected" : ""}}>Brown</option>
							<option value="Gray" {{$haircolor == 'Gray' ? "selected" : ""}}>Gray</option>
							<option value="Red" {{$haircolor == 'Red' ? "selected" : ""}}>Red</option>
                  		</select>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
						<label>Dress Size</label>
						<select class="wide form-control br-1 " id="dresssize" name="dresssize">
							<option value="XS/38" {{$dresssize == 'XS/38' ? "selected" : ""}}>XS/38</option>
							<option value="S/39" {{$dresssize == 'S/39' ? "selected" : ""}}>S/39</option>
							<option value="M/40" {{$dresssize == 'M/40' ? "selected" : ""}}>M/40</option>
							<option value="L/42" {{$dresssize == 'L/42' ? "selected" : ""}}>L/42</option>
							<option value="XL/44" {{$dresssize == 'XL/44' ? "selected" : ""}}>XL/44</option>
							<option value="2XL/46" {{$dresssize == '2XL/46' ? "selected" : ""}}>2XL/46</option>
						</select>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Shoe Size</label>
                		<input type="number" value="{{$shoesize}}" name="shoesize" id="shoesize" min="1" max="10" class="form-control" title="Please enter a value between 1 and 10">
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Hair Type</label>
						<select class="wide form-control br-1 " id="hairtype" name="hairtype">
							<option value="Short" {{$hairtype == 'Short' ? "selected" : ""}}>Short</option>
							<option value="Long" {{$hairtype == 'Long' ? "selected" : ""}}>Long</option>
							<option value="Medium" {{$hairtype == 'Medium' ? "selected" : ""}}>Medium</option>
						</select>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Talent Height in CM</label>
                		<input type="number" value="{{$talent_height_in_CM}}" name="talent_height_in_CM" id="talent_height_in_CM"  class="form-control"  title="Please enter exactly two digits (0-9)">
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="form-group">
					<label>Waist in CM</label>
                		<input type="number" value="{{$waist_in_CM}}" name="waist_in_CM" id="waist_in_CM"  class="form-control"  title="Please enter exactly two digits (0-9)">
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Birthdate</label>
				<input type="date" class="form-control" name="birthdate" value="{{$birthdate}}" placeholder="username" id="birthdate">
			  </div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
  <label>Year of experience</label>
 <input type="text" class="form-control" name="year_of_experience" value="{{$year_of_experience}}" placeholder="Slogan" id="year_of_experience" pattern="[0-9]{1,2}" title="Please enter exactly two digits (0-9)">
</div>

            
			</div>  
			<div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="switch">
				@if($is_birthdate_enable == '1')
                <input name="is_birthdate_enable" value="1" type="checkbox" checked>
				@else
                <input name="is_birthdate_enable" value="0" type="checkbox">
				@endif
                <span class="slider round"></span>
              </label>
              <label>Birthdate visible</label>
              </div>
            </div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>About You</label>
                <textarea type="text" id="aboutyou" name="about_you" class="form-control"  placeholder="Tell us about your self">{{$about_you}}</textarea>
			  </div>
			</div>    
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
		</div>
		</form>
		<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js'></script>
    <script>
        const yearOfExperienceInput = document.getElementById("year_of_experience");
        const waist_in_CM = document.getElementById("waist_in_CM");
         const shoesize = document.getElementById("shoesize");
          const talent_height_in_CM = document.getElementById("talent_height_in_CM");

  yearOfExperienceInput.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 2);
  });
    waist_in_CM.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 2);
  });
   shoesize.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 2);
  });
  talent_height_in_CM.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 3);
  });
  
    </script>
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
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<!--Manage profile -->
<script>
    function validate() {
  const fields = ["username","email","firstname","lastname","phonenumber","whatsapp_no","gender","mylanguage","state_id","city_id","categories","year_of_experience"];

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
// 	  $("#dresssize").attr('required', ''); 
// 	  $("#shoesize").attr('required', ''); 
	  $("#hairtype").attr('required', ''); 
// 	  $("#talent_height_in_CM").attr('required', ''); 
// 	  $("#waist_in_CM").attr('required', ''); 
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
//    var loadFile = function(event) {
//      var reader = new FileReader();
//      reader.onload = function(){
//        var output = document.getElementById('output');
//        output.src = reader.result;
//      };
//      reader.readAsDataURL(event.target.files[0]);
//    };
//   $(document).ready(function () {
//   CKEDITOR.replace('aboutyou');


   
// });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
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
<script>
    
    $("#mylanguage").change(function(){
        $(this).parent().css({
        'height' : 'auto'
        });
    });

var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
<script>
function limitToTwoDigits(inputElement) {
  // Get the entered value from the input field
  let inputValue = inputElement.value;

  // Check if the entered value is not empty and is a valid number
  if (inputValue !== '' && !isNaN(inputValue)) {
    // Convert the value to an integer
    let intValue = parseInt(inputValue);

    // Limit the value to two digits
    if (intValue < 10) {
      inputElement.value = '0' + intValue; // Add leading zero for single-digit numbers
    } else if (intValue > 99) {
      inputElement.value = '99'; // Cap the value to 99 for numbers exceeding two digits
    }
  }
}
</script>
<script>
    document.getElementById("phonenumber").addEventListener("input", function() {
        let input = this.value.replace(/\D/g, ""); // Remove non-numeric characters
        if (input.length > 10) {
            input = input.slice(0, 10); // Limit to 10 characters
        }
        this.value = input;
    });
</script>
@endsection