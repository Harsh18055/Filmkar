@extends('front/organize/layout')
@section('page_title','Manage Movies')
@section('movie_select','active')
@section('nav_class','white no-background')
@section('organizecontainer')
<style>
.user-profiles {
  width: 100%;
  overflow-x: scroll;
  white-space: nowrap;
}

.scroll-container {
  display: inline-block;
}

.user-profile {
  display: inline-block;
  width: 80px;
  height: 80px;
  margin-right: 10px;
  border-radius: 50%;
  overflow: hidden;
  cursor: pointer;
}

.user-profile input[type=checkbox] {
  display: none;
}

.user-profile img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.user-profile input[type=checkbox]:checked + img {
  border: 5px solid red;
  border-radius: 50%;
}

   .imagesize{
   width: 150px;
   height: 150px;
   }
   @media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   { 
   .width{
   width: 330px;
   }
   .deletebtn{
    position: fixed;
    top: -185px;
    left: 290px;
    color: black;
    text-decoration: none;
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
   h1{
  font-family: Satisfy;
  font-size:50px;
  text-align:center;
  color:black;
  padding:1%;
}
#gallery{
  -webkit-column-count:4;
  -moz-column-count:4;
  column-count:4;
  
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
@media (max-width:1200px){
  #gallery{
  -webkit-column-count:3;
  -moz-column-count:3;
  column-count:3;
    
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
}
@media (max-width:800px){
  #gallery{
  -webkit-column-count:2;
  -moz-column-count:2;
  column-count:2;
    
  -webkit-column-gap:20px;
  -moz-column-gap:20px;
  column-gap:20px;
}
}
@media (max-width:600px){
  #gallery{
  -webkit-column-count:1;
  -moz-column-count:1;
  column-count:1;
}  
}
#gallery img,#gallery video {
  width:100%;
  height:auto;
  margin: 4% auto;
  box-shadow:-3px 5px 15px #000;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  transition: all 0.2s;
}
.modal-img,.model-vid{
  width:100%;
  height:auto;
}
.modal-body{
  padding:0px;
}
.img-wraps {
    position: relative;
    /* display: inline-block; */
    
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 10px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
     
    color: #000;
    font-weight: bold;
    cursor: pointer;
    
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    /* border-radius: 50%; */
    /* border:1px solid red; */
}
.img-wraps:hover .closes {
    opacity: 1;
}
</style>
<form action="{{route('organize.manage_movie_process')}}" method="post" enctype="multipart/form-data">
    @csrf
   <input type="hidden" name="id" value="{{$id}}">
   <div class="profile_detail_block">
      <div class="col-md-12">
         <div class="form-group">
            <label>Title of the Movie</label>
            <input type="text" name="title" value="{{$title}}" class="form-control" placeholder="Enter Title" required>
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label>Main Poster of the Movie (Horizontal)</label>
            <input type="file" name="poster" class="form-control" placeholder="Enter Poster" >
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label>About the movie</label>
            <textarea type="text" name="about" id="about" value="" class="form-control" placeholder="Enter About">{{$about}}</textarea>
         </div>
      </div>
      @php
      $json_decode_genre = json_decode($genre) == "" ? [] : json_decode($genre);
      $json_decode_format = json_decode($format) == "" ? [] : json_decode($format);
      $json_decode_language = json_decode($language) == "" ? [] : json_decode($language);
      @endphp
      <div class="col-md-12">
         <div class="form-group">
            <label>Genre of the Movie</label>
           <select id="genre" name="genre[]" class="wide form-control br-1 label ui selection fluid dropdown" multiple required>
               @foreach($genre_type as $list)
               @if(in_array($list->id,$json_decode_genre))
               <option value="{{$list->id}}" selected>
                @else
                <option value="{{$list->id}}">
                @endif
                   {{$list->name}}</option>
               @endforeach
           </select>
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label>Release Format</label>
           <select id="format" name="format[]" class="wide form-control br-1 label ui selection fluid dropdown" multiple required>
               @foreach($format_type as $list)
               @if(in_array($list->id,$json_decode_format))
               <option value="{{$list->id}}" selected>
                @else
                <option value="{{$list->id}}">
                @endif
                {{$list->name}}</option>
               @endforeach
           </select>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>Censor Certificate</label>
           <select id="certificate" name="certificate" class="form-control" required>
               <option {{$certificate == "U" ? "selected" : "" }} value="U">U</option>
               <option {{$certificate == "A" ? "selected" : "" }} value="A">A</option>
               <option {{$certificate == "U/A" ? "selected" : "" }} value="U/A">U/A</option>
               <option {{$certificate == "S" ? "selected" : "" }} value="S">S</option>
           </select>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>Release Date</label>
            <input type="date" name="release_date" value="{{$release_date}}" class="form-control" required>
         </div>
      </div>
      <div class="col-md-12">
         <div class="form-group">
            <label>Releasing Languages</label>
           <select id="language" name="language[]" class="wide form-control br-1 label ui selection fluid dropdown" multiple required>
               @foreach($languages as $list)
               @if(in_array($list->id,$json_decode_language))
               <option value="{{$list->id}}" selected>
                @else
                <option value="{{$list->id}}">
                @endif
                {{$list->language}}</option>
               @endforeach
           </select>
         </div>
      </div>
      
      <div class="col-md-3">
         <div class="form-group">
            <label>Total duration of movie</label>
            <input type="number" name="movie_hour" id="total" value="{{$movie_hour}}"  class="form-control" placeholder="Enter Hour" required pattern="[0-9]{2}" max="12" title="Please enter exactly three digits (0-9)">
         </div>
      </div>
       <div class="col-md-3">
         <div class="form-group">
            <label>&nbsp;</label>
            <input type="number" name="movie_minute" id="min" value="{{$movie_hour}}"  class="form-control" placeholder="Enter Min" required pattern="[0-9]{2}" max="59" title="Please enter exactly three digits (0-9)">
         </div>
      </div>
       <div class="col-md-6">
         <div class="form-group">
            <label>Trailer Links</label>
            <input type="text" name="trailer_link" value="{{$trailer_link}}" placeholder="Enter trailer youtube link" class="form-control" required>
         </div>
      </div>
     <div class="col-md-12">
    <label><b>Enter Your Crew Members</b></label>
</div>
    @php 
        $loop_count_num = 1;
    @endphp
    @foreach($movie_crewarr as $key => $val)
    @php 
        $loop_count_prev = $loop_count_num;
        $video = (array)$val;

        
    @endphp

    <input type="hidden" name="crew_id[]" value="{{ $val->id }}">
    <div class="col-md-6 cast_">
        <div class="form-group">
            <label>Cast</label>
            <input type="text" name="crew_profile[]" value="{{ $val->crew_profile }}" placeholder="Enter Crew member Filmkar Profile Link" class="form-control user_profile" required>
        </div>
    </div>
   <div class="col-md-4 cast_">
         <div class="form-group">
            <label>Character Name</label>
            <select  class="form-control" name="crew_type[]">
                <option value="Producer" {{ $val->crew_type == 'Producer' ? 'selected' : '' }}>Producer</option>
                  <option value="Director" {{ $val->crew_type == 'Director' ? 'selected' : '' }}>Director</option>
                  <option value="Cinematographer" {{ $val->crew_type == 'Cinematographer' ? 'selected' : '' }}>Cinematographer</option>
                  <option value="Editor" {{ $val->crew_type == 'Editor' ? 'selected' : '' }}>Editor</option>
                  <option value="Music Director" {{ $val->crew_type == 'Music Director' ? 'selected' : '' }}>Music Director</option>
                  <option value="Writer" {{ $val->crew_type == 'Writer' ? 'selected' : '' }}>Writer</option>
                  <option value="Choreographer" {{ $val->crew_type == 'Choreographer' ? 'selected' : '' }}>Choreographer</option>
                  <option value="Lyricist" {{ $val->crew_type == 'Lyricist' ? 'selected' : '' }}>Lyricist</option>
                   <option value="Backgroundscore" {{ $val->crew_type == 'Backgroundscore' ? 'selected' : '' }}>Background score</option>
                    <option value="Coproducer" {{ $val->crew_type == 'Coproducer' ? 'selected' : '' }}>Co-Producer</option>
            </select>
         </div>
      </div>



      
      <div class="col-md-2 cast_">
         <div class="form-group">
            <label> </label>
            <a href="{{route('movie.delete_crew',[$val->id])}}" class="btn btn-m theme-btn full-width">Delete</a>
         </div>
      </div>
      
    @endforeach
      <div id="crew_box"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<!-- <label>Add+</label> -->
			<button type="button" onclick="add_crew_more()" class="form-control">Add Crew+</button>
		  </div>
		</div>
      <div class="clearfix"></div>
       <div class="col-md-12">
        <label><b>Enter Your Movie Cast</b></label>
      </div>
      @php 
        $loop_count_num=1;
    @endphp
    @foreach($movie_castarr as $key=>$val)
    @php 
        $loop_count_prev=$loop_count_num;
        $video=(array)$val;
    @endphp
    <input type="hidden" name="cast_id[]" value="{{$val->id}}">
       <div class="col-md-6 cast_">
         <div class="form-group">
            <label>Cast</label>
            <input type="text" name="user_profile[]" id="" value="{{$val->user_profile}}" placeholder="Enter user profile link" class="form-control user_profile" required>
         </div>
      </div>
      <div class="col-md-4 cast_">
         <div class="form-group">
            <label>Character Name</label>
            <input type="text" name="character_name[]" value="{{$val->character_name}}" placeholder="Enter Character Name" class="form-control" required>
         </div>
      </div>
      <div class="col-md-2 cast_">
         <div class="form-group">
            <label> </label>
            <a href="{{route('movie.delete_cast',[$val->id])}}" class="btn btn-m theme-btn full-width">Delete</a>
         </div>
      </div>
      
    @endforeach
      <div id="cast_box"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<!-- <label>Add+</label> -->
			<button type="button" onclick="add_cast_more()" class="form-control">Add Cast+</button>
		  </div>
		</div>
      <div class="clearfix"></div>
        <div class="col-md-12">
        <label><b>Enter your Movie Song & other Promotional Videos</b></label>
      </div>    
      @php 
        $loop_count_num=1;
    @endphp
    @foreach($movie_videoarr as $key=>$val)
    @php 
        $loop_count_prev=$loop_count_num;
        $video=(array)$val;
    @endphp
    <input type="hidden" name="video_id[]" value="{{$val->id}}">
       <div class="col-md-10 cast_">
         <div class="form-group">
            <label>Video</label>
            <input type="text" name="video[]" id="" value="{{$val->video_link}}" placeholder="Enter user profile link" class="form-control user_profile" required>
         </div>
      </div>
      
      <div class="col-md-2 cast_">
         <div class="form-group">
            <label> </label>
            <a href="{{route('movie.delete_video',[$val->id])}}" class="btn btn-m theme-btn full-width">Delete</a>
         </div>
      </div>
      
    @endforeach
      <div id="video_box"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<!-- <label>Add+</label> -->
			<button type="button" onclick="add_video_more()" class="form-control">Add video+</button>
		  </div>
		</div>
      <div class="clearfix"></div>
      
      <div class="col-md-12">
         <div class="form-group">
            <label>Movie Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
         </div>
      </div>

        @if($movie_image != '')
        <div id="gallery" class="container-fluid">  
        @foreach($movie_image as $list)
        <div class="img-wraps">
          <img src="{{ asset('assets/movie/images/' . $list->image) }}" class="img-responsive">
          <!-- <a href="#" class="deletebtn"><i class="login-icon ti-trash"></i></a> -->
          <a href="{{route('movie.delete_image',[$list->id])}}" class="closes" title="Delete">×</a>
        </div>
        
        @endforeach
        
        </div>
        @endif
      
      <div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Submit"></div>
   </div>
   
</form>
  <script>
        const total = document.getElementById("total");
        const min = document.getElementById("min");
         


  total.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 2);
  });
    min.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 2);
  });

    </script>

<script>
		var count = 1;
		function add_cast_more(){
			count++;
			// alert(count)
			var html = '<div class="col-md-6 cast_'+count+'"><div class="form-group"><label>Cast of the Movie</label><input type="text" id="user_profile" name="user_profile[]" class="form-control" placeholder="Enter Cast member Filmkar Profile Link"></div></div>';

            html += '<div class="col-md-4 cast_'+count+'"><div class="form-group"><label>Character Name</label><input type="text" name="character_name[]" placeholder="Enter Character Name" class="form-control" required></div></div>';

			 html+= '<div class="col-md-2 cast_'+count+'"><div class="form-group"><label>Delete cast</label><button type="button"  onclick="remove_cast('+count+')" class="btn btn-m theme-btn full-width">Remove</button></div></div>';
			 jQuery('#cast_box').append(html)
		}

		function remove_cast(count){
    jQuery('.cast_'+count).remove();
}

        function add_crew_more(){
    			count++;
    			// alert(count)
    			var html = '<div class="col-md-6 crew_'+count+'"><div class="form-group"><label>Crew FIlmkar</label><input type="text" id="user_profile" name="crew_profile[]" class="form-control" placeholder="Enter user profile link"></div></div>';
    
                html += '<div class="col-md-4 crew_'+count+'"><div class="form-group"><label>Crew Type</label><select name="crew_type[]" class="form-control"   required><option value="Producer">Producer</option><option value="Director">Director</option><option value="Cinematographer">Cinematographer</option><option value="Editor">Editor</option><option value="Music Director">Music Director</option><option value="Choreographer">Choreographer</option><option value="Writer">Writer</option></option><option value="Lyricist">Lyricist</option><option value="Backgroundscore">Background Score</option><option value=" Coproducer">Co-Producer</option></select></div></div>';
    
    			 html+= '<div class="col-md-2 crew_'+count+'"><div class="form-group"><label>Delete Crew</label><button type="button"  onclick="remove_crew('+count+')" class="btn btn-m theme-btn full-width">Remove</button></div></div>';
    			 jQuery('#crew_box').append(html)
    		}
    
    	function remove_crew(count){
            jQuery('.crew_'+count).remove();
        }
        
        function add_video_more(){
    			count++;
    			// alert(count)
    			var html = '<div class="col-md-10 video_'+count+'"><div class="form-group"><label>Video</label><input type="text" id="video" name="video[]" class="form-control" placeholder="Enter Your Movie Video Link"></div></div>';
    
    			 html+= '<div class="col-md-2 video_'+count+'"><div class="form-group"><label>Delete Video</label><button type="button"  onclick="remove_video('+count+')" class="btn btn-m theme-btn full-width">Remove</button></div></div>';
    			 jQuery('#video_box').append(html)
    		}
    
    	function remove_video(count){
            jQuery('.video_'+count).remove();
        }


	</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
   $(document).ready(function () {
   CKEDITOR.replace('description');
   
   });
   
</script>
<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
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
        </script>
        
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        // ClassicEditor
        //     .create( document.querySelector( '#about' ),{
        //         ckfinder: {
        //             uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
        // }
        //     })
        //     .catch( error => {
        //         console.error( error );
        //     } );
    </script>
@endsection