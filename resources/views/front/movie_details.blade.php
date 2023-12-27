@extends('front/layout')
@section('page_title','Movie')
@section('movie_select','active')
@section('nav_class','white no-background')
@section('container')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<style>
.detail-wrapper-header h4{
    color:white;
}
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
   width:600px;
   height:100px;
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
        width: 250px;
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
  .disabled-link {
  color: gray;
  pointer-events: none;
  text-decoration: none;
}
</style>
<div class="page-title">
   <div class="container">
      <div class="page-caption">
         <h2>Movie Detail</h2>
         <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Movie Detail</p>
      </div>
   </div>
</div>
<section class="padd-top-80 padd-bot-60">
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-8 col-sm-7">
            <div class="detail-wrapper">
               <div class="detail-wrapper-body">
                  <div class="row">
                     <div class="col-md-12 text-center user_profile_img">
                        @if($movie_post->poster != '')
                        <img src="{{asset('assets/movie/poster/'.$movie_post->poster)}}" style="width: 100%; height:400px;"  alt="">
                        @else
                        <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 300px;"  alt="">
                        @endif
                     </div>
                  </div>
               </div>
               <div class="detail-wrapper">
                  <div class="detail-wrapper-header">
                     <h4>About Movie</h4>
                  </div>
                  <div class="detail-wrapper-body">
                     <p>{!! $movie_post->about !!}</p>
                  </div>
               </div>
  @if(isset($cast))
   <div class="detail-wrapper">
      <div class="detail-wrapper-header">
         <h4>Movie Cast</h4>
      </div>
      <div class="detail-wrapper-body">
         @foreach($cast as $list)
         <a href="{{route('user.vendordetails', [$list->username])}}" class="">
            <div class="col-md-3 col-sm-9">
               <div class="utf_grid_job_widget_area">
                  <div class="u-content">
                     <div class="contact-img" style="border:0px;">
                        @if($list->profile != null)
                        <img src="{{asset('assets/profile/'.$list->profile)}}" style="height: 93px; width: 93px; border-radius:80px;"  alt=""> 
                        @else
                        <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 93px; width: 93px; border-radius:80px;"  alt=""> 
                        @endif
                     </div>
                     <h5 style="font-size: 12px;">{{$list->firstname.' '.$list->lastname}}</h5>
                     <p class="text-muted" style="font-size: 11px;">{{$list->character_name}}</p>
                  </div>
               </div>
            </div>
         </a>
         @endforeach
      </div>
   </div>
@endif

 
@if(isset($crew))
    <div class="detail-wrapper">
        <div class="detail-wrapper-header">
            <h4>Movie Crew</h4>
        </div>
        <div class="detail-wrapper-body">
            @foreach($crew as $list)
                <a href="{{ route('user.vendordetails', [$list->username]) }}" class="">
                    <div class="col-md-3 col-sm-9">
                        <div class="utf_grid_job_widget_area">
                            <div class="u-content">
                                <div class="contact-img" style="border:0px;">
                                    @if($list->profile != null)
                                        <img src="{{ asset('assets/profile/' . $list->profile) }}" style="height: 93px; width: 93px; border-radius:80px;" alt="">
                                    @else
                                        <img src="{{ asset('assets/profile/default_avatar.jpg') }}" style="height: 93px; width: 93px; border-radius:80px;" alt="">
                                    @endif
                                </div>
                                <h5 style="font-size: 12px;">{{ $list->firstname }} {{ $list->lastname }}</h5>
                                
                                    <p class="text-muted" style="font-size: 11px;">
                                        {{$list->crew_type}}
                                    </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

               <div class="detail-wrapper">
                  <div class="detail-wrapper-header">
                     <h4>Movie Trailer</h4>
                  </div>
                  <div class="detail-wrapper-body">
                     @php
                        $link = $movie_post->trailer_link;
                        $embed_link = convertYoutubeLink($link);
                        
                        function convertYoutubeLink($link)
                        {
                            $parts = parse_url($link);
                            
                            if(isset($parts['query'])) {
                                parse_str($parts['query'], $query);
                                $video_id = $query['v'];
                                return 'https://www.youtube.com/embed/' . $video_id;
                            }
                            
                            return '';
                        }
                    @endphp

                     <iframe width="100%" height="315" src="{{$embed_link ?? ''}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                     
                  </div>
               </div>
               @if(count($galleryArr) >0)
                <div class="detail-wrapper">
                    <div class="detail-wrapper-header">
                        <h4>Gallery</h4>
                    </div>
                    <div class="detail-wrapper-body">
                        <div id="gallery" class="container-fluid">
                            <div class="row">
                                @foreach($galleryArr as $list)
                                <div class="col-md-12">
                                    <a data-fancybox="gallery" href="{{asset('assets/movie/images/'.$list->image)}}"">
                                        <div class="img-wraps">
                                            <img src="{{asset('assets/movie/images/'.$list->image)}}"" class="img-responsive">
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
               @endif
 @if(count($videosArr) > 0)
<div class="detail-wrapper">
    <div class="detail-wrapper-header">
        <h4>Videos</h4>
    </div>
    <div class="detail-wrapper-body">
        <div class="row">
        @foreach($videosArr as $list)
        <div class="col-md-3">
        @php
        $url = $list->video_link;
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        if(isset($my_array_of_vars['v'])){
           $finl_url = $my_array_of_vars['v'];
        }else{
           preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
           $finl_url = $matches[1];
        }
        @endphp
        <a data-fancybox="video-gallery" href="{{ 'https://www.youtube.com/embed/'.$finl_url }}" style="width:300px;">
            <iframe width="100%" height="100%" src="{{'https://www.youtube.com/embed/'.$finl_url}}" class="video-src" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>
            <div class="absolute watch-more"></div>
        </a>
        </div>
        @endforeach
        </div>
    </div>
</div>
@endif



               <div class="detail-wrapper">
                  <div class="detail-wrapper-header">
                     <h4>Top reviews</h4>
                  </div>
                  <div class="detail-wrapper-body">
                     <div id="review-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner text-center">
                           @foreach($ratings as $index=>$list)
                           <div class="item  @if($index == 0) active @endif">
                              <div class="review">
                                 <h3>Review {{$index+1}}</h3>
                                 <p>{{$list->review}}</p>
                                  <p style="font-weight: bold;">{{$list->username}}</p>
                                <p><img  src="{{asset('assets/institute/logo/'.$list->logo)}}" class="img-fluid custom-img-zoom  " style="height: 100px;width: 100px;border-radius: 80px"></p>
                              </div>
                           </div>
                           @endforeach
                        </div>
                        <a class="left carousel-control" style="background-image:unset;color:red;" href="#review-carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" style="background-image:unset;color:red;" href="#review-carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Sidebar -->
         <div class="col-md-4 col-sm-5">
            <div class="sidebar">
               <!-- Start: Job Overview -->
               <div class="widget-boxed">
                  <div class="widget-boxed-header">
                     <h3><i class="ti-movie-pin padd-r-10"></i>{{$movie_post->title}}</h3>
                  </div>
                  <div class="widget-boxed-body">
                     <div class="side-list no-border">
                        <ul>
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
                              {{ $genre_names_string }}
                           </li>
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
                              {{ $format_names_string }}
                           </li>
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
                              {{ $format_names_string }}
                           </li>
                           <li><strong>Censor Certificate: </strong>{{$movie_post->certificate}}</li>
                           <li><strong>Release Date: </strong>{{$movie_post->release_date}}</li>
                           <li><strong>Duration of Movie: </strong>{{$movie_post->movie_hour}} hour {{$movie_post->movie_minute}} min</li>
                        </ul>
                        <div style="margin:12px 0px;"><span style="font-size:24px;"> <i style="color:red;" class="fa fa-star"></i> {{$ratings_average}}/10  </span>Total {{ $ratings_count }} votes</div>
                        @if(session()->has('USER_ID') || session()->has('organisation_ID'))
                    @php
                         $user_id = Session::get('USER_ID');
                        
                        $organisation_ID = Session::get('organisation_ID');
                        if($user_id){
                            $useremail = DB::table('users')->where('id', $user_id)->first()->email;
                        }else{
                            $useremail = DB::table('user_representers')->where('id', $organisation_ID)->first()->email;
                        }
                        @endphp
                        @if(DB::table('movie_rattings')->where('movie_id',$id)->where('email',$useremail)->first())
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" onclick="alreadyrate()"><i class="star-icon ti-star"></i> Rate Now</a>
                        @else
                    <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#ratenow"><i class="star-icon ti-star"></i> Rate Now</a>
                    @endif
                    @else
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#signin"><i class="star-icon ti-star"></i> Rate Now</a>
                    @endif
                       <!--<a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#ratenow"><i class="star-icon ti-star"></i> Rate Now</a>-->
                      

                     </div>
                  </div>
               </div>
               <div class="widget-boxed">
                  <!-- <div class="widget-boxed-header">
                     <h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
                     </div> -->
                     
                     <a href="{{ DB::table('banners')->where('key', 'movie_detail_page_1')->first()->link }}" target="_blank">


                  <div class="widget-boxed-body">
                     <div class="side-list no-border">
                         
                        <ul>
                           <li><img width="100%" src="{{asset('assets/banner/'.DB::table('banners')->where('key','movie_detail_page_1')->first()->value)}}"></li>
                        </ul>
                     </div>
                  </div>
                  </a>
               </div>
               <!-- End: Job Overview --> 
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
<div class="modal fade in" id="ratenow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="myModalLabel1">
         <div class="modal-body1">
            <div class="tab-content">
               <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                  <!--<form method="get" id="movie_ratting">-->
                  <!--   @csrf-->
                  <!--   <p id="msg_telent"></p>-->
                  <!--   <div class="form-group">-->
                  <!--      <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required>-->
                  <!--      <input type="hidden" name="id" value="{{$id}}" id="id" class="form-control" placeholder="Email Address">-->
                  <!--   </div>-->
                  <!--   <div class="form-group text-center">-->
                  <!--      <button type="submit" class="btn theme-btn full-width btn-m">Next</button>-->
                  <!--   </div>-->
                  <!--</form>-->
                  <form action="{{ route('movie.rattingform') }}" method="post" id="ratting_form">
                     @csrf
                     <p id="msg_telent"></p>
                     <div class="form-group">
                        <input type="number" name="ratting" id="ratting" class="form-control" placeholder="Enter Rating" min="1" max="10" required>
                     </div>
                     <input type="hidden" name="ratting_email" value="{{$useremail ?? ''}}" id="ratting_email" class="form-control" placeholder="Enter Ratting">
                     <input type="hidden" name="user_id" value="{{$user_id ?? ''}}" id="user_id" class="form-control" placeholder="Enter Ratting">
                     <input type="hidden" name="id" id="id" value="{{$id}}" class="form-control" placeholder="Enter Ratting">
                     <div class="form-group">
                        <input type="text" name="review" id="review" class="form-control" placeholder="Enter Review">
                     </div>
                     <div class="form-group text-center">
                        <button type="submit" class="btn theme-btn full-width btn-m">submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
//   $('#movie_ratting').on('submit', function() {
//         event.preventDefault();
//       var email = $('#email').val();
//       var id = $('#id').val();
//       var token = "{{ csrf_token() }}";
//       $.ajax({
//           url: "{{ route('movie.ratting') }}",
//           type: 'POST',
//           data: {_token: token,id:id,
//           email: email},
//           success: function(response) {
//               if(response == 'no')
//               {
//                   $('#movie_ratting').hide();
//                   $('#ratting_form').show();
//                   $('#ratting_email').val(email);
//               }
//               if(response == 'yes')
//               {
//                   alert("You have already given rating");
//                   location.reload();
//               }
//           }
//       });
       
//   });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<script>
    
    function alreadyrate(){
        Swal.fire('You have already given rating')
    }
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

//   $(document).ready(function(){
//   $("sdjcjdcjdc").click(function(){
//   var t = $(this).attr("src");
//   $(".modal-body").html("<img src='"+t+"' class='modal-img'>");
//   $("#myModal").modal();
//   });
    
   
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