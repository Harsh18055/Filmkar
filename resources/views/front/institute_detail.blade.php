@extends('front/layout')
@section('page_title','Organisation')
@section('institute_select','active')
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
@media (max-width: 768px) {
    .col-md-8 {
        width: 100%; 
    }
}

@media (max-width: 576px) {
    .col-md-4 {
        width: 100%; 
    }
    .detail-wrapper-body img {
        max-width: 100%; 
    }
}
.detail-wrapper-body iframe {
    max-width: 100%;
    height: auto; 
}
</style>
<div class="page-title">
   <div class="container">
      <div class="page-caption">
         <h2>Organisation Detail</h2>
         <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Organisation Detail</p>
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
                  <div style="text-align:center;">
                     <h4 style="margin:10px; font-size:20px; font-weight: bold;"><strong></strong>{{$institute_post->company}}</h4>
                  </div>
                  <div class="row">
                     <div class="col-md-10 text-center user_profile_img">
                        @if($institute_post->thumbnail != '')
                        <img src="{{asset('assets/institute/thumbnail/'.$institute_post->thumbnail)}}" style=" width: 100%;"  alt="">
                        @else
                        <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 150px; width: 300px;"  alt="">
                        @endif
                        <h2>{{$institute_post->title}}</h2>
                        <!--<span>{{$institute_post->state}} ({{$institute_post->city}})</span> -->
                        <div class="text-center">
                           <!--<button type="button" data-toggle="modal" data-target="#signin" class="btn-job theme-btn job-apply">Apply Now</button>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="detail-wrapper">
               <div class="detail-wrapper-header">
                  <h4>About Organisation</h4>
               </div>
               <div class="detail-wrapper-body">
                  <p>{!! $institute_post->about_company !!}</p>
               </div>
               
            </div>
            @if(count($courseoffered) > 0)
            <div class="detail-wrapper">
               <div class="detail-wrapper-header">
                  @if(DB::table('user_representers')->where('id',$institute_post->id)->first()->type == 'Educational')
                  <h4>Courses Offered</h4>
                  @else
                  <h4>Job Offered</h4>
                  @endif
               </div>
               <div class="detail-wrapper-body">
                  <ul>
                     @foreach($courseoffered as $list)
                     <li>{{$list->offer_name ?? ''}}</li>
                     @endforeach
                  </ul>
               </div>
            </div>
            @endif
            <div class="detail-wrapper">
               <div class="detail-wrapper-header">
                  <h4>Location</h4>
               </div>
               <div class="detail-wrapper-body">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15551.834000836915!2d77.5621856!3d12.9584009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae3e03a3e7df8d%3A0x91a10b7d7a38e43b!2sMacwin%20Studios!5e0!3m2!1sen!2sin!4v1658888430212!5m2!1sen!2sin" width="700" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
               </div>
            </div>
           @if(count($galleryArr) > 0)
    <div class="detail-wrapper">
        <div class="detail-wrapper-header">
            <h4>Gallery</h4>
        </div>
        <div class="detail-wrapper-body">
            <div id="gallery" class="container-fluid">
                <div class="row">
                    @foreach($galleryArr as $index =>  $list)
                    <div class="col-md-12">
                        <a data-fancybox="gallery" href="{{asset('assets/organize/gallery/'.$institute_post->user_name.'/'.$list->image)}}">
                            <div class="img-wraps">
                                <img src="{{asset('assets/organize/gallery/'.$institute_post->user_name.'/'.$list->image)}}" class="img-responsive">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

 @if(count($videosarr) > 0)
<div class="detail-wrapper">
    <div class="detail-wrapper-header">
        <h4>Videos</h4>
    </div>
    <div class="detail-wrapper-body">
        <div class="row">
        @foreach($videosarr as $list)
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
                           <div class="item @if($index == 0) active @endif">
                               @if(session()->has('organisation_ID'))
                                    @php
                                        $organisation_ID = Session::get('organisation_ID');
                                        $useremail = DB::table('user_representers')->where('id', $organisation_ID)->first()->email;
                                    @endphp
                                    @if($useremail == $list->email)
                                        <div style="display: flex;">
                                            <button class="edit-button btn btn-success" data-toggle="modal" data-target="#rateedit" data-review-id="{{$list->id}}" style="margin-left: 30%;">Edit</button>
                                        </div>
                                    @endif
                                @endif
                                @if(Session::get('USER_ID'))
                                    @php
                                        $user_id = Session::get('USER_ID');
                                        $useremail = DB::table('users')->where('id', $user_id)->first()->email;
                                    @endphp
                                    @if($useremail == $list->email)
                                        <div style="display: flex;">
                                            <button class="edit-button btn btn-success" data-toggle="modal" data-target="#rateedit" data-review-id="{{$list->id}}" style="margin-left: 30%;">Edit</button>
                                        </div>
                                    @endif
                                @endif
                              <div class="review">
                                <h3>Review {{$index+1}} </h3>
                                <p>{{$list->review}}</p>
                                 <p style="font-weight: bold;">
                                @if($list->profile == null)
                                {{$list->username}}</p>
                                <p><img  src="{{asset('assets/institute/logo/'.$list->logo)}}" class="img-fluid custom-img-zoom  " style="height: 100px;width: 100px;border-radius: 80px"></p>
                                @else
                                {{$list->talentUsername}}</p>
                                 <p><img  src="{{asset('assets/profile/'.$list->profile)}}" class="img-fluid custom-img-zoom  " style="height: 100px;width: 100px;border-radius: 80px"></p>
                                @endif
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
         <!-- Sidebar -->
         <div class="col-md-4 col-sm-5">
            <div class="sidebar">
               <!-- Start: Job Overview -->
               <div class="widget-boxed">
                  <div class="widget-boxed-header">
                     <h4 style="color:black;"><i class="ti-location-pin padd-r-10"></i>Organization Details</h4>
                  </div>
                  <div class="widget-boxed-body">
                     <div class="side-list no-border">
                        <ul>
                           <li><i class="ti-credit-card padd-r-10"></i>Name: {{$institute_post->company}}</li>
                           <li><i class="ti-credit-card padd-r-10"></i>Location: {{$institute_post->state}} ({{$institute_post->city}})</li>
                           <li><i class="ti-world padd-r-10"></i>Address: {{$institute_post->address}}</li>
                           @if(session()->has('USER_ID') || session()->has('organisation_ID'))
                           <li><i class="ti-mobile padd-r-10"></i>{{$institute_post->phone_no}}</li>
                           <li><i class="ti-email padd-r-10"></i>{{$institute_post->email}}</li>
                           <li><i class="ti-world padd-r-10"></i>{{$institute_post->website}}</li>
                           @else
                           <div class="">
                              <li><i class="ti-mobile padd-r-10"></i>{{substr($institute_post->phone_no, 0, 4) . "******";}}</li>
                              <li><i class="ti-email padd-r-10"></i>{{substr($institute_post->email, 0, 4) . "******";}}</li>
                              <li><i class="ti-world padd-r-10"></i>{{substr($institute_post->website, 0, 4) . "******";}}</li>
                              <br>
                              <a href="#" data-toggle="modal" data-target="#signin" >
                                 <p class="login">Login to see the Contact Details</p>
                              </a>
                           </div>
                           @endif
                        </ul>
                     </div>
                  </div>
                     <div style="margin:12px 0px;"><span style="font-size:24px;"> <i style="color:red;" class="fa fa-star"></i> {{$ratings_average}}/10  </span> {{ $ratings_count }} votes</div>
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
                       @if(DB::table('organisation_rattings')->where('organisation_id',$institute_post->id)->where('email',$useremail)->first())
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" onclick="alreadyrate()"><i class="star-icon ti-star"></i> Rate Now</a>
                        @else
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#ratenow"><i class="star-icon ti-star"></i> Rate Now</a>
                        @endif
                    @else
                   
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#signin"><i class="star-icon ti-star"></i> Rate Now</a>
                    @endif
                  </div>
               </div>
               <div class="widget-boxed">
                  <!-- <div class="widget-boxed-header">
                     <h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
                     </div> -->
                     <a href="{{ DB::table('banners')->where('key', 'organisation_detail_page_1')->first()->link }}" target="_blank">
                  <div class="widget-boxed-body">
                     <div class="side-list no-border">
                        <ul>
                           <li><img width="100%" src="{{asset('assets/banner/'.DB::table('banners')->where('key','organisation_detail_page_1')->first()->value)}}"></li>
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
      <div class="row">
         <div class="col-md-12">
            <h4 class="mrg-bot-30">Similar Jobs</h4>
         </div>
      </div>
      <div class="row">
         <!-- Single Job -->
         @if(count($similar_institute) == 0)
         <div class="col-md-3 col-sm-6">
            <p class="text-muted">No records for now. We are working on it to bring best to you. Stay Tuned with us.</p>
         </div>
         @endif
         <div class="row">
            <div class="col-md-12">
               <h3 class="mrg-bot-30" >Similar organisations</h3>
            </div>
         </div>
         <div class="col-md-8">
         @foreach($similar_institute as $list)
         <div class="col-md-3">
            <div class="utf_grid_job_widget_area ">
               <a href="{{ route('institutes.details', [$list->id]) }}">
                  <div class="u-content">
                     <div class="avatar box-80" style="height: 90px; width: 140px; background-image: url('{{ $list->logo != '' ? asset('assets/institute/logo/'.$list->logo) : asset('assets/profile/default_avatar.jpg') }}'); background-size: cover; background-position: center;"> 
                     </div>
                     <h5>{{$list->company}}</h5>
                     <p class="text-muted">{{ $list->state }} ({{ $list->city }})</p>
                  </div>
               </a>
            </div>
            </div>
         @endforeach
         </div>
      </div>
   </div>
</section>

<div class="modal fade in" id="ratenow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="myModalLabel1">
         <div class="modal-body1">
            <div class="tab-content">
               <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                  <form action="{{ route('organisation.rattingform') }}" method="post" id="ratting_form" style="">
                      @csrf
                     <p id="msg_telent"></p>
                     <div class="form-group">
                        <input type="number" name="ratting" id="ratting" class="form-control" placeholder="Enter Rating" min="1" max="10" required>
                     </div>
                     <!--<input type="text" style="display:none;" name="ratting_email" id="ratting_email" class="form-control" placeholder="Enter Ratting">-->
                     <input type="hidden" name="id" id="id" value="{{$institute_post->id ?? ''}}" class="form-control">
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
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>
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
//   $("img").click(function(){
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