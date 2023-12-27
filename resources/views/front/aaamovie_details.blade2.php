@extends('front/layout')
@section('page_title','Movie')
@section('movie_select','active')
@section('nav_class','white no-background')
@section('container')
<style>
   h1{
   font-family: Satisfy;
   font-size:50px;
   text-align:center;
   color:black;
   padding:1%;
   }
   h4{
    font-family: 'Poppins', sans-serif;
    margin: 0;
    font-weight: 500;
    color: #ffffff;
    font-size: 18px;
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
.icon{
   font-size: 25px;
   padding: 10px;
   margin: 0;
   background-color: #000;
   border-radius: 50px;
}
.watch-more {
    display: inline-block;
    color: #424B5A;
    font-size: 14px;
    text-decoration: none;
    margin-top: 15px;

    &:hover,
    &:focus,
    &:active {
        color: #626e84;
    }
}    

/* The Modal (background) */
.modal1 {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}
.video-popup {
    display: none;
    z-index: 2;
    position: fixed;
    top: 20%;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    border: 1px solid #ccc;
    padding: 10px 20px;
    background-color: #fff;
    border-radius: 4px;

    &.visible {
        display: block;
    }

    .close {
        position: absolute;
        right: 8px;
        top: -3px;
        font-weight: 900;
        font-size: 28px;
        color: black;
        padding: 5px 10px;
        border-bottom: none;
        cursor: pointer;
    }
}

.video-wrapper {
    width: 550px;
    margin: 30px auto;
    
    @media only screen and (max-width: 560px) {
      width: 250px;
    }

    .video-container {
        position: relative;
        padding-bottom: 55.25%;
        height: 0;
        overflow: hidden;

        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: auto;
            height: 100%;
        }
    }
}
body {
  background-color: #F5FEFF;
  margin: 0;
  color: #333;
  font-family: 'Ubuntu', sans-serif;
}

ul {
  list-style-type: none;
}

/* a {
  color: #404969;
  text-decoration: none;
  border-bottom: 1px solid #404969;
} */

a:hover {
  color: #166483;
  border-bottom: 2px solid #166483;
}


a.relative {
  float: left;
  position: relative;
  margin: 1%;
  padding: 10px;
  width: 20%;
  height: 200px;
} 

div.absolute {
  position: absolute;
  top: 0px;
  left: 2px;
  width: 100%;
  height: 200px;
}

@media screen and (max-width: 1024px) {
  .relative {
        width: 100% !important;
        margin: 0% 10%;
    }
}
.blur-overlay {
   color: transparent;
        text-shadow: 0 0 8px #000;
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
  }
  
</style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Movie Detail</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Movie Detail</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-60">
  <div class="container"> 
  
    <!-- row -->
    <div class="row">
          <div class="col-md-5 col-sm-12">
            <div class="detail-wrapper">
                <div class="detail-wrapper-body">
                     @if($movie_post->poster != '')
                    <img src="{{asset('assets/movie/poster/'.$movie_post->poster)}}" style="width: 100%; height:300px;"  alt="">
                    @else
                    <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 300px;"  alt="">
                    @endif
                </div>
          </div>
        </div>
        <div class="col-md-7 col-sm-12">
            <div class="detail-wrapper">
                <div class="detail-wrapper-body" style="height:342px;">
                    <div style="text-align:center; margin-bottom: 25px;">
                        <h4 style="margin:10px; font-size:25px; font-weight: bold;"><strong></strong>{{$movie_post->title}}</h4>
                     </div>
                     <li><strong>Genre: </strong>
                    @php
                        $genre_ids = json_decode($movie_post->genre);
                        $genre_names = [];
                        foreach ($genre_ids as $genre_id) {
                            $genre_name = DB::table('genre_type')->where('id', $genre_id)->value('name');
                            if ($genre_name) {
                                $genre_names[] = $genre_name;
                            }
                        }
                        $genre_names_string = implode(', ', $genre_names);
                    @endphp
                    
                    {{ $genre_names_string }}</li>
                    
            <li><strong>Format: </strong>
                    @php
                        $format_ids = json_decode($movie_post->format);
                        $format_names = [];
                        foreach ($format_ids as $format_id) {
                            $format_name = DB::table('format_type')->where('id', $format_id)->value('name');
                            if ($format_name) {
                                $format_names[] = $format_name;
                            }
                        }
                        $format_names_string = implode(', ', $format_names);
                    @endphp
                    
                    {{ $format_names_string }}</li>
                    
            <li><strong>Language: </strong>
                    @php
                        $format_ids = json_decode($movie_post->language);
                        $format_names = [];
                        foreach ($format_ids as $format_id) {
                            $format_name = DB::table('languages')->where('id', $format_id)->value('language');
                            if ($format_name) {
                                $format_names[] = $format_name;
                            }
                        }
                        $format_names_string = implode(', ', $format_names);
                    @endphp
                    
                    {{ $format_names_string }}</li>
                    
            <li><strong>Certificate: </strong>{{$movie_post->certificate}}</li>
            <li><strong>Release Date: </strong>{{$movie_post->release_date}}</li>
            <li><strong>Time Of Movie: </strong>{{$movie_post->movie_hour}} hour {{$movie_post->movie_minute}} min</li>
                </div>
          </div>
        </div>
    </div>
    <!-- End Row -->
    
    <!-- row -->
    <div class="row">
      <div class="col-md-12 col-sm-12">
        
        <div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4>About Movie</h4>
          </div>
          <div class="detail-wrapper-body">
            <p>{!! $movie_post->about !!}</p>
          </div>
        </div>
        
        @if(count($galleryArr) >0)
          <div class="detail-wrapper">
             <div class="detail-wrapper-header">
                <h4>Gallery</h4>
             </div>
             <div class="detail-wrapper-body">
                <div id="gallery" class="container-fluid">
                   @foreach($galleryArr as $list)
                   <div class="img-wraps">
                      <img src="{{asset('assets/movie/images/'.$list->image)}}" class="img-responsive">
                   </div>
                   @endforeach
                </div>
             </div>
          </div>
       @endif
       
       @if(count($videosArr) >0)
   <div class="detail-wrapper">
         <div class="detail-wrapper-header">
            <h4>Videos</h4>
         </div>
         <div class="detail-wrapper-body">
            @foreach($videosArr as $list)
            @php
            $url = $list->video_link;
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            if(isset($my_array_of_vars['v'])){
               $finl_url = $my_array_of_vars['v'];
            }else{
               preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
               $finl_url = $matches[1];
            }
            @endphp
            <a href="" class="column relative" style="width: 350px;">
               <iframe width="100%" height="100%" src="{{'https://www.youtube.com/embed/'.$finl_url}}" class="video-src"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
                  <div class="absolute watch-more"></div>
            </a>
               <!-- <div id="1" class="column relative" >
                  <iframe class="video-src"  src="{{'https://www.youtube.com/embed/'.$finl_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  <div class="absolute watch-more"></div>
               </div> -->
                  @endforeach
         </div>
      </div>
   @endif
       
        
      </div>
      </div>
     
    </div>
    <!-- End Row --> 
    
    
  </div>
  
</section>
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>

<div id="modal" class="modal1"></div>
    <div class="video-popup">
      <a class="close">&times;</a>
        <!-- Modal content -->
        <div class="video-wrapper">
            <div class="video-container">
               <iframe width="100%" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
     </div>
<script>
   $(document).ready(function(){
   $("img").click(function(){
   var t = $(this).attr("src");
   $(".modal-body").html("<img src='"+t+"' class='modal-img'>");
   $("#myModal").modal();
   });
   
   $("video").click(function(){
   var v = $("video > source");
   var t = v.attr("src");
   $(".modal-body").html("<video class='model-vid' controls><source src='"+t+"' type='video/mp4'></source></video>");
   $("#myModal").modal();  
   });
   });//EOF Document.ready

   $(document).ready(function() { 
// Watch More Link click handlers
    const $popup = $('.video-popup');
    const $modal = $('#modal');
    const $closeIcon = $('.close');
    const $watchMoreLink = $('.watch-more');
    const absolute = $('.absolute').parent().html();
    
    $('.absolute').click(function() {
       parentdiv = $(this).parent();
       var url = parentdiv.find("iframe").attr("src");
       $(".video-container").find("iframe").attr("src",url);
       //$("img").attr("width", "500");
       //alert(src);
    });

    $watchMoreLink.click(function(e) {
        $popup.fadeIn(200);
        $modal.fadeIn(200);
        e.preventDefault();
    });
    $closeIcon.click(function () {
        $popup.fadeOut(200);
        $modal.fadeOut(200);
    });
    // for escape key
    $(document).on('keyup',function(e) {
        if (e.key === "Escape") {
           $popup.fadeOut(200);
           $modal.fadeOut(200);
        }
    });
    // click outside of the popup, close it
    $modal.on('click', function(e){
        $popup.fadeOut(200);
        $modal.fadeOut(200);
    });
});
</script>
@endsection
