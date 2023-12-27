@extends('front/user/layout')
@section('page_title','Manage Videos')
@section('gallery_select','active')
@section('nav_class','white no-background')
@section('usercontainer')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<style>
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
 #gallery img,#gallery video {
   width:211px;
   height:120px;
   margin: 4% auto;
   box-shadow:-3px 5px 15px #000;
   cursor: pointer;
   -webkit-transition: all 0.2s;
   transition: all 0.2s;
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
<style>
    body {
		font-family: sans-serif;
	}
	#dropBox {
		min-width: 320px;
		max-width: 75%;
		min-height: 250px;
		border: 3px dashed black;
		text-align: center;
		background: lightgrey;
		padding: 3em;
		margin: auto;
	}
	#dropBox.hover {
	  border-color: darkslateblue;
	  background: aliceblue;
	}
	.button {
		display: inline-block;
		padding: .5em 1em;
		background: black;
		cursor: pointer;
		border-radius: 5px;
		border: 1px solid darkslateblue;
		color: #fff;
		transition: .4s;
	}
	.button:hover {
		background: darkslateblue;
	}
	#imgUpload {
		display: none;
	}
	#gallery {
		text-align: center;
		margin-top: 1.5em;
	}
	#gallery div {
		display: inline-block;
		margin: .5em 1em;
	}
	#gallery img {
		max-height: 150px;
	}
	#gallery .fName,
	#gallery .fSize {
		display: block;
	}
	#gallery .fName {
		color: brown;
	}
	#gallery .fSize {
		font-size: .8em;
	}
	#gallery .fType {
		font-size: .7em;
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
    <!--<div class="col-md-12 col-sm-12 col-xs-12">-->
<form action="{{route('user.manage_gallery_process')}}" method="post" enctype="multipart/form-data">
   @csrf
   <div class="col-md-12 col-sm-12 col-xs-12">
      <label>Select Photos</label>
      <!--<input type="file" name="image[]" class="form-control" multiple id="gallery-photo-add">-->
      <div id="dropBox">
    <!--<p>Drag & Drop Images Here...</p>-->
        <input type="file" id="imgUpload" name="image[]" multiple accept="image/*" id="gallery-photo-add" onchange="filesManager(this.files)">
        <label class="button" for="imgUpload"> Upload Your Image</label>
    <div id="gallery"></div>
</div>
      <div class="gallery" ></div>
      <div class="col-md-12 padd-top-10 text-center"> <input type="submit" class="btn btn-m theme-btn full-width" value="Update"></div>
   </div>
</form>
<!--</div>-->
<br>
<h1>Gallery</h1><hr>

  <!--@if($galleryArr != '')-->
  <!--<div class="row">-->
  <!--  @foreach($galleryArr as $list)-->
  <!--  <div class="col-md-3" style="width: 150px; hight: 150px;">-->
  <!--    <a href="{{asset('assets/gallery/'.$username.'/'.$list->image)}}" class="fancybox" data-fancybox="gallery">-->
  <!--        <a href="{{url('user/gallery/delete/')}}/{{$list->id}}" class="closes" style="float:right;" title="Delete">×</a>-->
  <!--      <img src="{{asset('assets/gallery/'.$username.'/'.$list->image)}}" class="img-responsive">-->
  <!--    </a>-->
  <!--  </div>-->
  <!--  @endforeach-->
  <!--  </div>-->
  <!--@endif-->
  
  <div class="detail-wrapper style="height: 35px; width: 35px;"">
    <div class="detail-wrapper-header">
    <div class="container">
        <h1></h1>
        </div>
    </div>
    <div class="detail-wrapper-body">
        <div id="gallery" class="container-fluid">
            @if($galleryArr != '')
              <div class="row">
                @foreach($galleryArr as $list)
                <div class="col-md-3" style="width: 150px; hight: 150px;">
                  <a href="{{asset('assets/gallery/'.$username.'/'.$list->image)}}" class="fancybox" data-fancybox="gallery">
                      <a href="{{url('user/gallery/delete/')}}/{{$list->id}}" class="closes" style="float:right;" title="Delete">×</a>
                    <img src="{{asset('assets/gallery/'.$username.'/'.$list->image)}}" class="img-responsive">
                  </a>
                </div>
                @endforeach
                </div>
             @endif
        </div>
    </div>
</div>
 </div>
</div>




<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<script>
    let dropBox = document.getElementById('dropBox');

// modify all of the event types needed for the script so that the browser
// doesn't open the image in the browser tab (default behavior)
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
    dropBox.addEventListener(evt, prevDefault, false);
});
function prevDefault (e) {
    e.preventDefault();
    e.stopPropagation();
}

// remove and add the hover class, depending on whether something is being
// actively dragged over the box area
['dragenter', 'dragover'].forEach(evt => {
    dropBox.addEventListener(evt, hover, false);
});
['dragleave', 'drop'].forEach(evt => {
    dropBox.addEventListener(evt, unhover, false);
});
function hover(e) {
    dropBox.classList.add('hover');
}
function unhover(e) {
    dropBox.classList.remove('hover');
}

// the DataTransfer object holds the data being dragged. it's accessible
// from the dataTransfer property of drag events. the files property has
// a list of all the files being dragged. put it into the filesManager function
dropBox.addEventListener('drop', mngDrop, false);
function mngDrop(e) {
    let dataTrans = e.dataTransfer;
    let files = dataTrans.files;
    filesManager(files);
}


function upFile(file) {
    //only allow images to be dropped
    let imageType = /image.*/;
    if (file.type.match(imageType)) {
        let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
        // create a FormData object
        let formData = new FormData();
        formData.append('file', file);

        // standard file upload fetch setup
        fetch(url, {
            method: 'put',
            body: formData
        })
        .then(response => response.json())
        .then(result => { console.log('Success:', result); })
        .catch(error => { console.error('Error:', error); });
    } else {
        console.error("Only images are allowed!", file);
    }
}


// use the FileReader API to get the image data, create an img element, and add
// it to the gallery div. The API is asynchronous so onloadend is used to get the
// result of the API function
function previewFile(file) {
    // only allow images to be dropped
    let imageType = /image.*/;
    if (file.type.match(imageType)) {
        let fReader = new FileReader();
        let gallery = document.getElementById('gallery');
        // reads the contents of the specified Blob. the result attribute of this
        // with hold a data: URL representing the file's data
        fReader.readAsDataURL(file);
        // handler for the loadend event, triggered when the reading operation is
        // completed (whether success or failure)
        fReader.onloadend = function() {
            let wrap = document.createElement('div');
            let img = document.createElement('img');
            // set the img src attribute to the file's contents (from read operation)
            img.src = fReader.result;
            let imgCapt = document.createElement('p');
            // the name prop of the file contains the file name, and the size prop
            // the file size. convert bytes to KB for the file size
            let fSize = (file.size / 1000) + ' KB';
            imgCapt.innerHTML = `<span class="fName">${file.name}</span><span class="fSize">${fSize}</span><span class="fType">${file.type}</span>`;
            gallery.appendChild(wrap).appendChild(img);
            gallery.appendChild(wrap).appendChild(imgCapt);
        }
    } else {
        console.error("Only images are allowed!", file);
    }
}

function filesManager(files) {
    // spread the files array from the DataTransfer.files property into a new
    // files array here
    files = [...files];
    // send each element in the array to both the upFile and previewFile
    // functions
    files.forEach(upFile);
    files.forEach(previewFile);
}
</script>
<script>
   // Wait for the document to load
   $(document).ready(function() {
      // Initialize the Slick Slider after images have been loaded
      $('#gallery').slick({
         dots: false, // Show navigation dots
         infinite: true, // Loop the slider
         speed: 500, // Animation speed
         slidesToShow: 1, // Number of slides to show at a time
         slidesToScroll: 1 // Number of slides to scroll at a time
      });
   });
   </script>
<script>
//   $(function() {
//   // Multiple images preview in browser
//   var imagesPreview = function(input, placeToInsertImagePreview) {
   
//       if (input.files) {
//           var filesAmount = input.files.length;
   
//           for (i = 0; i < filesAmount; i++) {
//               var reader = new FileReader();
   
//               reader.onload = function(event) {
//                   $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'imagesize').appendTo(placeToInsertImagePreview);
//               }
   
//               reader.readAsDataURL(input.files[i]);
//           }
//       }
   
//   };
   
//   $('#gallery-photo-add').on('change', function() {
//       imagesPreview(this, 'div.gallery');
//   });
//   });

//   $(document).ready(function(){
//   $("img").click(function(){
//   var t = $(this).attr("src");
//   $(".modal-body").html("<img src='"+t+"' class='modal-img'>");
//   $("#myModal").modal();
// });

$("video").click(function(){
  var v = $("video > source");
  var t = v.attr("src");
  $(".modal-body").html("<video class='model-vid' controls><source src='"+t+"' type='video/mp4'></source></video>");
  $("#myModal").modal();  
});
});//EOF Document.ready
</script>
@endsection