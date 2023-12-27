@extends('front/layout')
@section('page_title','Talent Details')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
 <link rel="stylesheet" href="path-to-your-bootstrap-css/bootstrap.min.css">
<style>
 .custom-img-zoom {
    transition: transform 0.3s ease;
  }

  .custom-img-zoom:hover {
    transform: scale(1.1);
  }
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
   height:200px;
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

/*From Model Start*/
.modal-body{
    margin-top: 18px;
    text-align: left;
    margin-left: 15px;
    
}
.modal-body input{
    width: 564px;
    margin-bottom: 12px;
    
}



/*From Model End*/
        
</style>
<div class="page-title">
   <div class="container">
      <div class="page-caption">
         <h2>Talent Detail </h2>
         <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Talent Detail </p>
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
               <div class="col-md-4 text-center user_profile_img">
                  <img src="{{asset('assets/profile/'.$vendor->profile)}}" class="width-200"  alt=""/>
                  <h4 class="meg-0">{{$vendor->username}}</h4>
                  <!-- <span>{!!$vendor->about_you!!}</span>  -->
                  <div class="text-center">
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
                        <a class="btn-job theme-btn job-apply" href="javascript:void(0)" onclick="alreadyrate()">Hire Now</a>
                        @else
                    <a class="btn-job theme-btn job-apply" href="javascript:void(0)" data-toggle="modal" data-target="#jobApplicationModal">Contact Now</a>
                    @endif
                    @else
                        <a class="btn-job theme-btn job-apply" href="javascript:void(0)" data-toggle="modal" data-target="#signin">Contact Now</a>
                    @endif
                     <!--<button type="button" class="btn-job theme-btn job-apply" data-toggle="modal" data-target="#jobApplicationModal"> Hire Now</button>-->
                     <!--Data Model Start-->
                        <div class="modal fade" id="jobApplicationModal" tabindex="-1" aria-labelledby="jobApplicationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="jobApplicationModalLabel" style="color:red;font-size:20px;"><b>Contact Now</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your job application form fields go here -->
                                    <form action="{{route('vendor.contact')}}" method="post">
                                      @csrf
                                      <input type="hidden" id="telent_name" name="telent_name" class="form-control" value="{{$vendor->firstname}}"><br>
                                    <input type="hidden" id="email" name="telent_email" class="form-control" value="{{$vendor->email}}"><br>
                                        <label for="name">Your Name</label><br>
                                        <input type="text" id="name" name="name" class="form-control" required><br>
                                        
                                        <label for="email">Your Email</label><br>
                                        <input type="email" id="email" name="email" class="form-control" required><br>
                                        
                                        <label for="phone">Your Phone</label><br>
                                        <input type="number" id="phone" name="phone" class="form-control" required><br>

                                        <label for="subject">Subject</label><br>
                                        <input type="text" id="subject" name="subject" class="form-control" required><br>
                                        
                                        <label for="message">Your Message</label><br>
                                        <textarea id="message" name="message" rows="4" cols="75" class="form-control" required></textarea>
                                        
                                        <input type="submit" class="btn btn-primary rounded">
                                    </form>
                                </div>
                                <div class="modal-footer" >
                                </div>
                            </div>
                        </div>
                    </div>
                     <!--Data Mdoel End-->
                     
                  </div>
               </div>
               <div class="col-md-8 user_job_detail">
                  <div class="col-sm-12 mrg-bot-10"><strong>Full Name : </strong>{{$vendor->firstname}} {{$vendor->lastname}}</div>
                  
                  <div class="col-sm-12 mrg-bot-10"><strong>Category : </strong>{{implode(", ",$categoryname)}} @if(count($subcategoryname) > 0) ({{implode(", ",$subcategoryname)}}) @endif</div>
                  @if(session()->has('USER_ID') || session()->has('organisation_ID'))
                     @if($vendor->is_phoneno_enable == '1')
                     <div class="col-sm-12 mrg-bot-10"><strong>Phone no: </strong>{{$vendor->phonenumber}}</div>
                     @endif
                     @if($vendor->is_email_enable == '1')
                     <div class="col-sm-12 mrg-bot-10"><strong>Email: </strong>{{$vendor->email}}</div>
                     @endif
                  @else
                  <div >
                      
                     @if($vendor->is_phoneno_enable == '1')
                     <div class="col-sm-12 mrg-bot-10"><strong>Phone no: </strong>{{substr($vendor->phonenumber, 0, 4) . "******" ;}}</div>
                     @endif
                     <div class="col-sm-12 mrg-bot-10"><strong>Email: </strong>{{substr($vendor->email, 0, 4) . "******";}}<br><a data-toggle="modal" data-target="#signin" class="meg-0"><h4>Login to see the Contact Details</h4></a></div>
                     
                  </div>
                  @endif
                  <div class="col-sm-12 mrg-bot-10"><strong>State: </strong>{{$vendor->state}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>City: </strong>{{$vendor->city}}</div>
                  @if($vendor->is_birthdate_enable == '1')
                  <div class="col-sm-12 mrg-bot-10"><strong>Age: </strong>{{$yearsold}} Years Old</div>
                  @endif
                  <div class="col-sm-12 mrg-bot-10"><strong>Gender: </strong>{{$vendor->gender}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Total Experience: </strong>{{$vendor->year_of_experience}} years</div>
                  @if($vendor_attr)
                  <div class="col-sm-12 mrg-bot-10"><strong>Eye Color: </strong>{{$vendor_attr->eyecolor}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Hair Color: </strong>{{$vendor_attr->haircolor}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Dress Size: </strong>{{$vendor_attr->dresssize}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Shoe Size: </strong>{{$vendor_attr->shoesize}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Hair Type: </strong>{{$vendor_attr->hairtype}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Talent Height In CM: </strong>{{$vendor_attr->talent_height_in_CM}}</div>
                  <div class="col-sm-12 mrg-bot-10"><strong>Waist In CM: </strong>{{$vendor_attr->waist_in_CM}}</div>
                  @endif
                  @if($user_social)
                  <div class="col-sm-12 mrg-bot-10"><strong>Social Media :
                     @if($user_social->facebook != '')
                      <a href="{{$user_social->facebook}}" target="_blank"><img src="{{asset('assets/setting/Facebook.png')}}" width="50px" height="50px"></a>
                      @endif
                     @if($user_social->instagram != '')
                     <a href="{{$user_social->instagram}}" target="_blank"><img src="{{asset('assets/setting/Instagram.png')}}" width="50px" height="50px"></a>
                     @endif
                     @if($user_social->linkedin != '')
                     <a href="{{$user_social->linkedin}}" target="_blank"><img src="{{asset('assets/setting/Linkdn.png')}}" width="50px" height="50px"></a>
                     @endif
                     @if($user_social->twitter != '')
                     <a href="{{$user_social->twitter}}" target="_blank"><img src="{{asset('assets/setting/Twitter.png')}}" width="50px" height="50px"></a>
                     @endif
                  </div>
                  @endif
                  <div class="col-sm-12 mrg-bot-10">
                      <div style="margin:12px 0px;"><span style="font-size:24px;"> <i style="color:red;" class="fa fa-star"></i> {{$ratings_average}}/10  </span> Total  {{ $ratings_count }} votes</div>
                    <!--<a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#ratenow"><i class="star-icon ti-star"></i> Rate Now</a>-->
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
                        @if(DB::table('user_rattings')->where('user_id',$vendor->id)->where('email',$useremail)->first())
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" onclick="alredyrate()"><i class="star-icon ti-star"></i> Rate Now</a>
                        @else
                    <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#ratenow"><i class="star-icon ti-star"></i> Rate Now</a>
                    @endif
                    @else
                        <a class="btn theme-btn btn-m" href="javascript:void(0)" data-toggle="modal" data-target="#signin"><i class="star-icon ti-star"></i> Rate Now</a>
                    @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <div class="detail-wrapper ">
         <div class="detail-wrapper-header">
            <h4 >About Me</h4>
         </div>
         <div class="detail-wrapper-body">
                  <p>{!!$vendor->about_you!!}</p>
         </div>
      </div>
      
@if(count($galleryArr) > 0)

<div class="detail-wrapper">
    <div class="detail-wrapper-header">
    <div class="container">
        </div>
    
        <h4>Gallery</h4>
    </div>
    <div class="detail-wrapper-body">
        <div id="gallery" class="container-fluid">
            <div class="row">
                @foreach($galleryArr as $list)
                <div class="col-md-12">
                    <a data-fancybox="gallery" href="{{asset('assets/gallery/'.$vendor->username.'/'.$list->image)}}">
                        <div class="img-wraps">
                            <img src="{{asset('assets/gallery/'.$vendor->username.'/'.$list->image)}}" class="img-responsive">
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
                {!! $galleryArr->links("pagination::bootstrap-4") !!}
    </div>
</div>

@endif
 @if(count($videosarr) > 0)
<div class="detail-wrapper">
    <div class="detail-wrapper-header">
        <div class="container">
        </div>
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
                      <div class="container">
        </div>
                     <h4 >Top reviews</h4>
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
   

   <div class="col-md-4 col-sm-5">
        <div class="sidebar"> 
          <!-- Start: Job Overview -->
          <div class="widget-boxed">
            <!-- <div class="widget-boxed-header">
              <h4><i class="ti-location-pin padd-r-10"></i>Location</h4>
            </div> -->
            <a href="{{ DB::table('banners')->where('key', 'user_details_page_1')->first()->link }}" target="_blank">
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                  
                  <li><img width="100%" src="{{asset('assets/banner/'.DB::table('banners')->where('key','user_details_page_1')->first()->value)}}"></li>
                </ul>                
              </div>
            </div>
            </a>
          </div>
          <!-- End: Job Overview --> 
        </div>
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
    <!--<div class="video-popup">-->
    <!--  <a class="close">&times;</a>-->
        <!-- Modal content -->
    <!--    <div class="video-wrapper">-->
    <!--        <div class="video-container">-->
    <!--           <iframe width="100%" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
    <!--        </div>-->
    <!--    </div>-->
    <!-- </div>-->
     
<div class="modal fade in" id="ratenow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="myModalLabel1">
         <div class="modal-body1">
            <div class="tab-content">
               <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                  <!--<form method="get" id="user_ratting">-->
                  <!--    @csrf-->
                  <!--   <p id="msg_telent"></p>-->
                  <!--   <div class="form-group">-->
                  <!--      <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required>-->
                  <!--      <input type="hidden" name="id" value="{{$id}}" id="id" class="form-control" placeholder="Email Address">-->
                  <!--   </div>-->
                  <!--   <div class="form-group text-center">-->
                  <!--      <button type="submit" class="btn theme-btn full-width btn-m">Next</button>-->
                  <!--   </div>-->
                  <!--</form>-->
                  <form action="{{ route('user.rattingform') }}" method="post" id="ratting_form" style="">
                      @csrf
                     <p id="msg_telent"></p>
                     <div class="form-group">
                        <input type="number" name="ratting" id="ratting" class="form-control" placeholder="Enter Rating" min="1" max="10" required>
                     </div>
                     <!--<input type="text" style="display:none;" name="ratting_email" id="ratting_email" class="form-control" placeholder="Enter Ratting">-->
                     <input type="text" style="display:none;" name="id" id="id" value="{{$id}}" class="form-control" placeholder="Enter Ratting">
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

<div class="modal fade in" id="rateedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="myModalLabel1">
         <div class="modal-body1">
            <div class="tab-content">
               <div class="tab-pane fade in show active" id="employer" role="tabpanel">
                  <form action="{{ route('user.rattingeditform') }}" method="post" id="ratting_form" style="">
                      @csrf
                     <p id="msg_telent"></p>
                     <div class="form-group">
                        
                        <input type="number" name="ratting" id="edit-ratting" class="form-control" placeholder="Enter Rating" min="1" max="10" required>


                     </div>
                     <!--<input type="text" style="display:none;" name="ratting_email" id="ratting_email" class="form-control" placeholder="Enter Ratting">-->
                     <input type="hidden"  name="id" id="edit-id" class="form-control">
                     <div class="form-group">
                        <input type="text" name="review" id="edit-review" class="form-control" placeholder="Enter Review">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="path-to-your-bootstrap-js/bootstrap.min.js"></script>

<script>
    function alreadyrate(){
        Swal.fire('You have already given rating')
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

    
    $('#user_ratting').on('submit', function() {
         event.preventDefault();
        var email = $('#email').val();
        var id = $('#id').val();
        var token = "{{ csrf_token() }}";
        $.ajax({
            url: "{{ route('user.ratting') }}",
            type: 'POST',
            data: {_token: token,id:id,
            email: email},
            success: function(response) {
                if(response == 'no')
                {
                    $('#user_ratting').hide();
                    $('#ratting_form').show();
                    $('#ratting_email').val(email);
                }
                if(response == 'yes')
                {
                    // alert("You have already given rating");
                    Swal.fire('You have already given rating')
                    location.reload();
                }
            }
        });
    });
    
    function alredyrate(){
        Swal.fire('You have already given rating')
    }
</script>
<script>

   $(document).ready(function(){
   $(".myimage").click(function(){
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

//   $(document).ready(function() { 
// // Watch More Link click handlers
//     const $popup = $('.video-popup');
//     const $modal = $('#modal');
//     const $closeIcon = $('.close');
//     const $watchMoreLink = $('.watch-more');
//     const absolute = $('.absolute').parent().html();
    
//     $('.absolute').click(function() {
//       parentdiv = $(this).parent();
//       var url = parentdiv.find("iframe").attr("src");
//       $(".video-container").find("iframe").attr("src",url);
//       //$("img").attr("width", "500");
//       //alert(src);
//     });

//     $watchMoreLink.click(function(e) {
//         $popup.fadeIn(200);
//         $modal.fadeIn(200);
//         e.preventDefault();
//     });
//     $closeIcon.click(function () {
//         $popup.fadeOut(200);
//         $modal.fadeOut(200);
//     });
//     // for escape key
//     $(document).on('keyup',function(e) {
//         if (e.key === "Escape") {
//           $popup.fadeOut(200);
//           $modal.fadeOut(200);
//         }
//     });
//     // click outside of the popup, close it
//     $modal.on('click', function(e){
//         $popup.fadeOut(200);
//         $modal.fadeOut(200);
//     });
// });
</script>
<script>
  $(document).ready(function() {
    $('#rateedit').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var reviewId = button.data('review-id'); // Extract the review ID from the button's data attribute
        
      // Use the review ID to retrieve the corresponding review data via AJAX or any other method
      // and then populate the form fields in the modal
      // Example code using jQuery's AJAX method:
      $.ajax({
        url: '/get-review',
        type: 'GET',
        data: {id: reviewId},
        success: function(response) {
            //alert(response);
          // Assuming the response contains the review data in JSON format
          $('#edit-id').val(reviewId); 
          $('#edit-ratting').val(response.ratting);
          $('#edit-review').val(response.review);
          
        },
        error: function() {
          // Handle error cases
        }
      });
    });
  });
</script>

<script>
    document.getElementById("phone").addEventListener("input", function () {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10); // truncate the value to 10 characters
        }
    });
</script>

@endsection