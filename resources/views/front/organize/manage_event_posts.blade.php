@extends('front/organize/layout')
@section('page_title','Manage Job')
@section('event_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<style>
   .d-none{
    display: none;
   } 
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
    <div style="background-color: lightyellow; padding: 10px;">
<h2>Welcome to Filmkar – Best place to post your events.</h2>
<p>Filmkar is a one-stop platform to post your events for free and increase your reach. We’re offering an intuitive platform to help you post and promote your events online.
You can grow your events business with confidence. Filmkar gives you right targated audience to take your event and your events business to the next level.</p>
    </div>
<form action="{{route('organize.manage_event_process')}}" method="post" enctype="multipart/form-data" onsubmit="return validate()">
    @csrf
    <input type="hidden" name="representers_id" value="{{$id}}">
    <input type="hidden" name="id" id="id" value="{{$id}}">
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
			                         <!--    <div class="col-md-6">-->
                            <!--    <select name="image_format" class="form-control">-->
                            <!--        <option value=".jpg">JPG</option>-->
                            <!--        <option value=".webp">WEBP</option>-->
                            <!--        <option value=".png">PNG</option>-->
                            <!--    </select>-->
                                
                            <!--</div>-->
            <div class="col-md-12">
			  <div class="form-group">
				<label>Thumbnail</label>
				<input type="file" name="thumbnail" value="{{$thumbnail}}" id="thumbnail" class="form-control" placeholder="select thumbnail">
			  </div>
			</div>
			<div class="col-md-12">
              <div class="form-group">
                <label>Event Category</label>
                <select class="wide form-control br-1 chosen-select"  name="event_cat_id" id="Please Select Category" >
                    <option disabled selected value="">Please Select Category</option>
                    
                    @foreach($event_category as $list)
				@if($event_cat_id==$list->id)
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
            <div class="col-md-3">
			  <div class="form-group">
				<label>Start Date</label>
				<input type="date"  name="start_date" id="Start_Date" value="{{$start_date}}" class="form-control" placeholder="Select date">
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>End Date</label>
				<input type="date"  name="end_date" id="end_date" value="{{$end_date}}" class="form-control" placeholder="Select date">
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>Start Time</label>
				<input type="time" name="start_time" id="start_time"  value="{{$start_time}}" class="form-control" placeholder="Select time">
			  </div>
			</div>
            <div class="col-md-3">
			  <div class="form-group">
				<label>End Time</label>
				<input type="time" name="end_time" id="end_time"  value="{{$end_time}}" class="form-control" placeholder="Select time">
			  </div>
			</div>
            <div class="col-md-6">
			  <div class="form-group">
				<label>Entry Fee (₹)</label>
				<input type="text" name="price" id="Price"  value="{{$price}}" class="form-control" placeholder="Enter Price" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4)"  title="Please enter exactly three digits (0-9)">
			  </div>
			</div>
            <div class="col-md-6">
			  <div class="form-group">
				<label>Event Type</label>
                <select class="form-control"  name="event_type" id="event_type">
                    @if($event_type == 'online')
                    <option value="online" selected >Online</option>
                    <option value="offline">offline</option>
                    @else
                    <option value="online">Online</option>
                    <option value="offline" selected >offline</option>
                    @endif
                </select>
			  </div>
			</div>
            <div id="vanue" class="{{$dnone}}">
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <div id="output"></div>
                <select class="wide form-control br-1 chosen-select" name="state_id" id="state_id">
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
                <select class="wide form-control br-1" name="city_id" id="city_id">
                <option disabled selected >Please Select City</option>
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
				<label>Address</label>
				<textarea name="address" id="address" class="form-control" placeholder="Enter Address">{{$address}}</textarea>
			  </div>
			</div>
            <div class="col-md-6">
			  <div class="form-group">
				<label>Pin Code</label>
				<input type="text" name="pin_code" id="pin_code" value="{{$pin_code}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6)" class="form-control" placeholder="Enter Pin Code" maxlength="6" >

			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label>Event Venue</label>
				<input type="text" name="event_venue" id="event_venue"  value="{{$event_venue}}" class="form-control" placeholder="Enter Event Venue">
			  </div>
			</div>
            <div class="col-md-6">
			  <div class="form-group">
				<label>Phone Number</label>
				<input type="text" name="phone_number" value="{{$phone_number}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" class="form-control" placeholder="Enter Phone Number" maxlength="10" id="phone_number" >

			  </div>
			</div>
            <div class="col-md-6">
			  <div class="form-group">
				<label>Email</label>
				<input type="email" name="email" id="email"  value="{{$email}}" class="form-control" placeholder="Enter Email">
			  </div>
			</div>
            </div>
            
            <div class="col-md-12">
			  <div class="form-group">
				<label>About Event</label>
				<textarea name="about_event" id="about_event"  class="form-control" placeholder="Enter About Of Event">{{$about_event}}</textarea>
			  </div>
			</div>
            <div class="col-md-12 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label>Tags</label>
                @php
                $tag = ['html','php'];
                $result = "'" . implode ( "', '", $tag ) . "'";
                @endphp
                <input type="text" name="tags" id="tags" value="{{$tags}}" class="form-control"  placeholder="Ex.Dancer, Actor">
			  </div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Submit"></div>
		</div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<!--Manage_Event_Posts Alert Box-->



<script>
//  const requiredFields = [
//         { id: "title", message: "Title is required" },
//         { id: "thumbnail", message: "Thumbnail is required"}
//     ];
   function validate() {
    var event_type = document.getElementById('event_type').value;
    var fields;

    if (typeof event_type !== 'undefined' && event_type === 'online') {
        fields = ["title", "thumbnail", "Please Select Category", "Start_Date", "end_date", "start_time", "end_time", "Price", "about_event", "tags", "event_type"];
    } else {
        fields = ["title", "thumbnail", "Please Select Category", "Start_Date", "end_date", "start_time", "end_time", "Price", "state_id", "city_id", "address", "pin_code", "event_venue", "phone_number", "email", "about_event", "tags", "event_type"];
    }

    for (let field of fields) {
        const value = document.getElementById(field).value;
        if (value === '') {
            Swal.fire(`${getFieldName(field)} is required`);
            return false;
        }
    }

    return true; // Return true if all fields are filled
}

</script>
<script>
// function checkInput() {
//   var input = document.getElementById("pin_code").value;
//   if (input.length > 6) {
//     alert("Error: Only 6 digits are allowed.");
//   }
// }
$("#state_id").change(function(){
    var state_id = document.getElementById('state_id').value;
    // alert(state_id);
    $.get("/getcitybystate/"+state_id, function(data){
        $("#city_id").html(data);
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
   $(document).ready(function () {
   CKEDITOR.replace('description');
   
});

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
    duplicate: false
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
    $("#event_type").change(function(){
    var event_type = document.getElementById('event_type').value;
    
    if(event_type == 'online'){
        $("#vanue").addClass("d-none");
        $("#address").removeAttr('required', ''); 
        $("#pin_code").removeAttr('required', ''); 
        $("#phone_number").removeAttr('required', ''); 
        $("#email").removeAttr('required', '');
    }else{
    $("#vanue").removeClass("d-none");
	  $("#address").attr('required', ''); 
	  $("#pin_code").attr('required', ''); 
	  $("#phone_number").attr('required', ''); 
	  $("#email").attr('required', ''); 

    }
    
   
});
</script>
<script>

 window.onload = function() {
     var id = document.getElementById('id');
    if(id == ''){
  
}
}
var startDateInput = document.getElementById('Start_Date');
var endDateInput = document.getElementById('end_date');
  
  // Set min attribute of start date input to today's date
  startDateInput.min = new Date().toISOString().split('T')[0];

  startDateInput.addEventListener('input', function() {
    endDateInput.min = startDateInput.value;
    if (startDateInput.value > endDateInput.value) {
      endDateInput.setCustomValidity('End date must be after start date');
    } else {
      endDateInput.setCustomValidity('');
    }
  });

  endDateInput.addEventListener('input', function() {
    if (startDateInput.value > endDateInput.value) {
      endDateInput.setCustomValidity('End date must be after start date');
    } else {
      endDateInput.setCustomValidity('');
    }
  });


</script>
@endsection
