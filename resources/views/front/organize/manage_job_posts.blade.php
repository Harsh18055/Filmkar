@extends('front/organize/layout')
@section('page_title','Manage Job')
@section('job_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<style>
    
.tags-input-wrapper{
    background: transparent;
    padding: 10px;
    border-radius: 4px;
    /* max-width: 400px; */
    border: 1px solid #ccc
}
.tags-input-wrapper input{
    border: none;
    background: transparent;
    outline: none;
    width: 140px;
    margin-left: 8px;
}
.tags-input-wrapper .tag{
    display: inline-block;
    background-color: #ED2024;
    color: white;
    border-radius: 40px;
    padding: 0px 3px 0px 7px;
    margin-right: 5px;
    margin-bottom:5px;
    /* box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7) */
}
.tags-input-wrapper .tag a {
    margin: 0 7px 3px;
    display: inline-block;
    cursor: pointer;
}
    </style>
<form action="{{route('organize.manage_job_process')}}" method="post" onsubmit="return validate()">
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
				<input type="text" name="title" id="title" value="{{$title}}" class="form-control" placeholder="Enter Title">
			  </div>
			</div>
				@error('title')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
		
			<div class="col-md-12">
			  <div class="form-group">
				<label>Description</label>
				<textarea name="description" id="description" class="form-control" placeholder="Enter Description">{{$description}}</textarea>
			  </div>
			</div>
			@error('description')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
			<div class="col-md-4">
			  <div class="form-group" >
				<label>Job Role</label>
				<select class="wide form-control" name="job_role_id" id="job_role_id" >
                <option disabled selected value="">Select Categories</option>
                @foreach($category as $list)
                    @if($job_role_id==$list->id)
                    <option selected value="{{$list->id}}">
                        @else
                    <option value="{{$list->id}}">
                        @endif
                        {{$list->category_name}}
                    </option>
                @endforeach
                </select>
			  </div>
			</div>	
			@error('job_role_id')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            <div class="col-md-4">
			  <div class="form-group">
				<label>Job Type</label>
				<select class="wide form-control" name="job_type" id="job_type">
				    <option disabled selected value="">Select Job Type</option>
				    <option {{$job_type=='Full Time' ? 'selected':''}} value="Full Time" >Full Time</option>
				    <option {{$job_type=='Part Time' ? 'selected':''}} value="Part Time">Part Time</option>
				    <option {{$job_type=='Internship' ? 'selected':''}} value="Internship">Internship</option>
				    <option {{$job_type=='Work from Home' ? 'selected':''}} value="Work from Home">Work from Home</option>
                </select>
			  </div>
			</div>
			@error('job_type')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            <div class="col-md-4">
			  <div class="form-group">
				<label>Gender</label>
				<select class="wide form-control" name="gender" id="gender" >
				    <option disabled selected value="">Select Gender</option>
				    <option {{$gender=='male' ? 'selected':''}} value="male" >Male</option>
				    <option {{$gender=='female' ? 'selected':''}} value="female">Female</option>
				    <option {{$gender=='Not Required' ? 'selected':''}} value="Not Required">Not Required</option>
                </select>
			  </div>
			</div>
			@error('gender')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            <div class="col-md-3">
			  <div class="form-group">
				<label>MinAge (Years)</label>
                <input type="text" name="MinAge" value="{{$MinAge}}" class="form-control" placeholder="Ex. 18" id="minage" pattern="[0-9]{1}{2}{3}" title="Please enter exactly three digits (0-9)">
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>MaxAge (in years)</label>
                <input type="text" name="MaxAge"  value="{{$MaxAge}}" class="form-control" placeholder="Ex.45" id="maxage" min="0" max="105" pattern="[0-9]{1}{2}{3}" title="Please enter exactly three digits (0-9)">
			  </div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
				<label>Payment (₹)</label>
                <input type="text" name="budget" value="{{$budget}}" class="form-control" placeholder="Ex.10000" id="budget"  pattern="[0-9]{2}{3}{4}{5}" title="Please enter exactly five digits (0-9)">
			  </div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
				<label>Payment Duration</label>
                <select class="wide form-control" name="budget_duration" id="budget_duration">
                <option disabled value="">Please Select</option>
                @if($budget_duration=='Per Day')
				  <option value="Per Day" selected>Per Day</option>
                  <option value="per week">per week</option>
                    <option value="per month">per month</option>
                    <option value="per project">per project</option>
				  @elseif($budget_duration=='Per Week')
                  <option value="per day">per day</option>
				  <option value="Per Week" selected>Per Week</option>
                  <option value="per month">per month</option>
                  <option value="per project">per project</option>
                  @elseif($budget_duration=='per project')
                  <option value="per day">per day</option>
				  <option value="Per Week">Per Week</option>
                  <option value="per month">per month</option>
                  <option value="per project" selected>per project</option>
                  @else
                  <option value="per day">per day</option>
                    <option value="per week">per week</option>
				  <option value="Per Month" selected>Per Month</option>
				  <option value="per project">per project</option>
				  @endif
                </select>
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>Audition Required</label>
				<select class="wide form-control" name="audition_required" id="audition_required">
                <option disabled value="">Please Select</option>
                @if($gender=='yes')
				  <option value="yes" selected>Yes</option>
				  <option value="no">no</option>
				  @else
				  <option value="no" selected>No</option>
				  <option value="yes">yes</option>
				  @endif
                </select>
			  </div>
			</div>	
			<div class="col-md-3">
			  <div class="form-group">
				<label>No Of Vacancies</label>
                <input type="number" name="No_of_vacancies" value="{{$No_of_vacancies}}" class="form-control" placeholder="Ex.2" id="No_of_vacancies" pattern="[0-9]{3}" title="Please enter exactly three digits (0-9)">
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>Last Date To Apply</label>
                <input type="date" name="last_date" value="{{$last_date}}" class="form-control" id="last_date" >
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>Job Start Date</label>
                <input type="date" name="job_start" value="{{$job_start}}" class="form-control" id="job_start">
			  </div>
			</div>
   <!--         <div class="col-md-3">-->
			<!--  <div class="form-group">-->
			<!--	<label>Job End Date</label>-->
   <!--             <input type="date" name="job_end" value="{{$job_end}}" class="form-control" >-->
			<!--  </div>-->
			<!--</div>-->
			@error('job_end')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <div id="output"></div>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id" >
                    <option disabled selected value="">Please Select State</option>
                    
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
            @error('state_id')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <select class="wide form-control br-1" name="city_id" id="city_id" >
                <option disabled selected value="">Please Select City</option>
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
            @error('city_id')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
             <div class="col-md-6">
              <div class="form-group">
                <label>Pin code</label>
                <input type="tel" name="zipcode" value="{{$zipcode}}" oninput="this.value = this.value.replace(/[^0-9]/g, ''); checkInput();" class="form-control" placeholder="Pin code" maxlength="6" id="zipcode">
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label>Phone No</label>
                <small>EX: 1234567890</small>
               <input type="tel" name="phone_no" value="{{$phone_no}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" placeholder="Phone Number" maxlength="10" id="phone_no">

              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>Tags</label>
                @php
                $tag = ['html','php'];
                $result = "'" . implode ( "', '", $tag ) . "'";
                @endphp
                <input type="text" name="tags" value="{{$tags}}" id="tags" class="form-control"  placeholder="ex. Filmmaking, Comedy, Actor, Acting etc"  >
			  </div>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit"   class="btn btn-m theme-btn full-width" value="Submit"></div>
		</div>
        </form>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
        const minage = document.getElementById("minage");
        const maxage = document.getElementById("maxage");
         const budget = document.getElementById("budget");
          const No_of_vacancies = document.getElementById("No_of_vacancies");


  minage.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 3);
  });
    maxage.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 3);
  });
   budget.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 6);
  });
  No_of_vacancies.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 3);
  });
    </script>
<script>
$(document).ready(function() {
  $("#minage, #maxage").on("change", function() {
    const minAgeValue = parseFloat($("#minage").val());
    const maxAgeValue = parseFloat($("#maxage").val());

    if (isNaN(minAgeValue) || isNaN(maxAgeValue)) {
      Swal.fire("Please enter valid numeric values for Min Age and Max Age.");
    } else if (minAgeValue > maxAgeValue) {
      Swal.fire("Min Age cannot be greater than Max Age.");
    } else {
       return false;
    }
  });
  
 
});




$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
    });
});

//validate
// function validate() {
    
//     const title = document.getElementById("title").value;
//     const description=document.getElementById("description").value;
//     const job_role_id=document.getElementById("job_role_id").value;
//     const job_type=document.getElementById("job_type").value;
//     const gender=document.getElementById("gender").value;
//     const state_id=document.getElementById("state_id").value;
//     const city_id=document.getElementById("city_id").value;
  

//     if (title.length <= 0)
//     {
//         Swal.fire('Title is required')
//         return false;
//     }
//     if (description.length <= 0)
//     {
//         Swal.fire('Description is required')
//         return false;
//     }
//     if (job_role_id === '')
//     {
//         Swal.fire('Job Role is required')
//         return false;
//     }
//     if (job_type === '')
//     {
//         Swal.fire('Job Typed is required')
//         return false;
//     }
//     if (gender === '')
//     {
//         Swal.fire('Gender is required')
//         return false;
//     }
//      if (city_id === '')
//     {
//         Swal.fire('City is required')
//         return false;
//     }
//      if (state_id === '')
//     {
//         Swal.fire('State is required')
//         return false;
//     }
    
    
// }
function validate() {
  const fields = ["title", "description", "job_role_id", "job_type", "gender", "state_id", "city_id"];

  for (let field of fields) {
    const value = document.getElementById(field).value;
    if (value === '') {
      Swal.fire(`${getFieldName(field)} is required`);
      return false;
    }
  }
}

// const requiredFields = [
//     { id: "title", message: "Title is required" },
//     { id: "description", message: "Description is required" },
//     { id: "job_role_id", message: "Job Role is required" },
//     { id: "job_type", message: "Job Type is required" },
//     { id: "gender", message: "Gender is required" },
//     { id: "city_id", message: "City is required" },
//     { id: "state_id", message: "State is required" }
// ];


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
//   CKEDITOR.replace('description');
   
// });

(function(){

"use strict"


// Plugin Constructor
var TagsInput = function(opts){
    this.options = Object.assign(TagsInput.defaults , opts);
    this.init();
}

// Initialize the plugin
TagsInput.prototype.init = function(opts){
    this.options = opts ? Object.assign(this.options, opts) : this.options;

    if(this.initialized)
        this.destroy();
        
    if(!(this.orignal_input = document.getElementById(this.options.selector)) ){
        console.error("tags-input couldn't find an element with the specified ID");
        return this;
    }

    this.arr = [];
    this.wrapper = document.createElement('div');
    this.input = document.createElement('input');
    init(this);
    initEvents(this);

    this.initialized =  true;
    return this;
}

// Add Tags
TagsInput.prototype.addTag = function(string){

    if(this.anyErrors(string))
        return ;

    this.arr.push(string);
    var tagInput = this;

    var tag = document.createElement('span');
    tag.className = this.options.tagClass;
    tag.innerText = string;

    var closeIcon = document.createElement('a');
    closeIcon.innerHTML = '&times;';
    
    // delete the tag when icon is clicked
    closeIcon.addEventListener('click' , function(e){
        e.preventDefault();
        var tag = this.parentNode;

        for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){
            if(tagInput.wrapper.childNodes[i] == tag)
                tagInput.deleteTag(tag , i);
        }
    })


    tag.appendChild(closeIcon);
    this.wrapper.insertBefore(tag , this.input);
    this.orignal_input.value = this.arr.join(',');

    return this;
}

// Delete Tags
TagsInput.prototype.deleteTag = function(tag , i){
    tag.remove();
    this.arr.splice( i , 1);
    this.orignal_input.value =  this.arr.join(',');
    return this;
}

// Make sure input string have no error with the plugin
TagsInput.prototype.anyErrors = function(string){
    if( this.options.max != null && this.arr.length >= this.options.max ){
        console.log('max tags limit reached');
        return true;
    }
    
    if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){
        console.log('duplicate found " '+string+' " ')
        return true;
    }

    return false;
}

// Add tags programmatically 
TagsInput.prototype.addData = function(array){
    var plugin = this;
    
    array.forEach(function(string){
        plugin.addTag(string);
    })
    return this;
}

// Get the Input String
TagsInput.prototype.getInputString = function(){
    return this.arr.join(',');
}


// destroy the plugin
TagsInput.prototype.destroy = function(){
    this.orignal_input.removeAttribute('hidden');

    delete this.orignal_input;
    var self = this;
    
    Object.keys(this).forEach(function(key){
        if(self[key] instanceof HTMLElement)
            self[key].remove();
        
        if(key != 'options')
            delete self[key];
    });

    this.initialized = false;
}

// Private function to initialize the tag input plugin
function init(tags){
    tags.wrapper.append(tags.input);
    tags.wrapper.classList.add(tags.options.wrapperClass);
    tags.orignal_input.setAttribute('hidden' , 'true');
    tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);
}

// initialize the Events
function initEvents(tags){
    tags.wrapper.addEventListener('click' ,function(){
        tags.input.focus();           
    });
    

    tags.input.addEventListener('keydown' , function(e){
        var str = tags.input.value.trim(); 

        if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )
        {
            e.preventDefault();
            tags.input.value = "";
            if(str != "")
                tags.addTag(str);
        }

    });
}


// Set All the Default Values
TagsInput.defaults = {
    selector : '',
    wrapperClass : 'tags-input-wrapper',
    tagClass : 'tag',
    max : null,
    duplicate: false,
}

window.TagsInput = TagsInput;

})();

var tagInput1 = new TagsInput({
        selector: 'tag-input1',
        duplicate : false,
        max : 10
    });
    var tag = $result;
    // alert(tag);
    tagInput1.addData([tag])

</script>
<script>
    var startDateInput = document.getElementById('last_date');
var endDateInput = document.getElementById('job_start');
  
  // Set min attribute of start date input to today's date
  startDateInput.min = new Date().toISOString().split('T')[0];

  startDateInput.addEventListener('input', function() {
    endDateInput.min = startDateInput.value;
    if (startDateInput.value > endDateInput.value) {
      endDateInput.setCustomValidity('Job Start Date must be after Last Date ');
    } else {
      endDateInput.setCustomValidity('');
    }
  });

  endDateInput.addEventListener('input', function() {
    if (startDateInput.value > endDateInput.value) {
      endDateInput.setCustomValidity('Job Start Date must be after Last Date ');
    } else {
      endDateInput.setCustomValidity('');
    }
  });
  


</script>
@endsection
