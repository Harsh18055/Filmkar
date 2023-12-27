@extends('front/layout')
@section('page_title','Home')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container') 




<style>

.title{
    white-space: nowrap; 
  width: 250px; 
  overflow: hidden;
  text-overflow: ellipsis; 
}
    .image-container {
    position: relative;
    display: inline-block;
    overflow: hidden; 
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0);
    transition: background-color 0.3s ease-in-out;
    opacity: 0;
}

.image-container:hover .overlay {
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 1;
}

.image-container:hover img {
    transform: scale(0.9); 
    transition: transform 0.3s ease-in-out;
}

/*New Data Start*/
 body {
        font-family: Arial;
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    img {
        vertical-align: middle;
    }

    
    .container {
        position: relative;
    }

   
    .mySlides {
        display: none;
    }

    
    .cursor {
        cursor: pointer;
    }


    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

   
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

   
    .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    
    .column {
        float: left;
        width: 16.66%;
    }

   
    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

   .carousel {
      width: 100%;
      max-width: 100%;
      overflow: hidden;
   }

   .carousel-inner {
      position: relative;
      width: 100%;
      max-width: 100%;
      overflow: hidden;
   }

   .carousel-item {
      display: none;
   }

   .carousel-item.active {
      display: block;
   }

   .carousel-img {
      width: 100%;
      height: auto;
   }

    
   .carousel-caption {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      text-align: center;
   }

   .caption h2 {
      font-size: 40px;
      line-height: 1.2;
   }

   .caption p {
      font-size: 18px;
   }
   
   @media screen and (max-width: 768px) {
        .utf_main_banner_area {
            padding: 20px; 
        }

        .col-md-8 {
            width: 100%; 
            text-align: center; 
        }

        .form-control {
            width: 100%; 
            margin-bottom: 10px; 
        }

        .padd-0 {
            padding: 0; 
        }

        .m-clear {
            margin-top: 10px; 
        }
    }

  .title:hover {
    color: red; 
}

.jobstitle:hover{
    color:red;
}
  .talenttitle:hover{
      color:red;
  }

.organisationtitle:hover{
    color:red;
}

.zoomable-image {
    height: 250px;
    width: 250px;
    transition: transform 0.3s ease-in-out;
}

.zoomable-image:hover {
    transform: scale(1.1); 
}

/*Start Poster*/
  .widget-boxed {
            text-align: center;
        }

        .widget-boxed-body {
            max-width: 100%; /* Ensure the content doesn't overflow on smaller screens */
            margin: 0 auto; /* Center the content horizontally */
            padding: 10px; /* Add some padding for better readability */
        }

        .side-list {
            list-style: none; /* Remove list bullets */
            padding: 0;
        }

        .side-list li img {
            max-width: 100%; /* Make the image responsive */
            height: auto; /* Maintain aspect ratio */
        }

        /* Media query for screens with a maximum width of 768px (typical for mobile devices) */
        @media (max-width: 768px) {
            .widget-boxed-body {
                padding: 5px; /* Reduce padding for smaller screens */
            }

            .side-list li img {
                width: 100%; /* Make the image take up the full width of the container */
                height: auto;
            }
        }
/*End Poster*/
</style>
<!-- ======================= Start Banner ===================== -->

<div class="container-fluid">
    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

            <div class="carousel-inner" role="listbox">
                   <div class="item active ">
                            @if ($testimage)
                       <div class="utf_main_banner_area" style="background-image:url({{ asset('assets/slider/talent/' . $testimage)}})" data-overlay="8">
                           @endif
            <div class="container">
                <div class="col-md-8 col-sm-10">
                    <div class="caption cl-white home_two_slid">
                        <h2 style="font-size:40px;">Connect, Collaborate, and Create with <span class="theme-cl">Filmkar</span>
                            across the country</h2>
                        <p>Trending Talent Category:
                            @foreach($setting as $list)
                            <span class="trending_key"><a
                                    href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></span>
                            @endforeach
                        </p>
                    </div>
                    <form action="{{route('filterusers')}}" method="get">
                        <fieldset class="utf_home_form_one">
                            <div class="col-md-4 col-sm-4 padd-0">
                                <input type="text" class="form-control br-1" name="keyword" placeholder="Search Keywords..." />
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control br-1" name="category_id">
                                    <option data-display="All Categories" value="">All Categories</option>
                                    @foreach($category as $list)
                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control" name="gender">
                                    <option data-display="Gender" value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
                
                 <div class="item ">
                            @if ($jobimage)
                       <div class="utf_main_banner_area" style="background-image:url({{ asset('assets/slider/job/' . $jobimage)}})" data-overlay="8">
                           @endif
            <div class="container">
                <div class="col-md-8 col-sm-10">
                    <div class="caption cl-white home_two_slid">
                        <h2 style="font-size:40px;">Connect, Collaborate, and Create with <span class="theme-cl">Filmkar</span>
                            across the country</h2>
                        <p>Trending Talent Category:
                            @foreach($setting as $list)
                            <span class="trending_key"><a
                                    href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></span>
                            @endforeach
                        </p>
                    </div>
                    <form action="{{route('filterusers')}}" method="get">
                        <fieldset class="utf_home_form_one">
                            <div class="col-md-4 col-sm-4 padd-0">
                                <input type="text" class="form-control br-1" name="keyword" placeholder="Search Keywords..." />
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control br-1" name="category_id">
                                    <option data-display="All Categories" value="">All Categories</option>
                                    @foreach($category as $list)
                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control" name="gender">
                                    <option data-display="Gender" value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
                 <div class="item ">
                            @if ($eventimage)
                       <div class="utf_main_banner_area" style="background-image:url({{ asset('assets/slider/event/' . $eventimage)}})" data-overlay="8">
                           @endif
            <div class="container">
                <div class="col-md-8 col-sm-10">
                    <div class="caption cl-white home_two_slid">
                        <h2 style="font-size:40px;">Connect, Collaborate, and Create with <span class="theme-cl">Filmkar</span>
                            across the country</h2>
                        <p>Trending Talent Category:
                            @foreach($setting as $list)
                            <span class="trending_key"><a
                                    href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></span>
                            @endforeach
                        </p>
                    </div>
                    <form action="{{route('filterusers')}}" method="get">
                        <fieldset class="utf_home_form_one">
                            <div class="col-md-4 col-sm-4 padd-0">
                                <input type="text" class="form-control br-1" name="keyword" placeholder="Search Keywords..." />
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control br-1" name="category_id">
                                    <option data-display="All Categories" value="">All Categories</option>
                                    @foreach($category as $list)
                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control" name="gender">
                                    <option data-display="Gender" value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
                 <div class="item ">
                            @if ($moiveimage)
                       <div class="utf_main_banner_area" style="background-image:url({{asset('assets/slider/moive/' . $moiveimage) }})" data-overlay="8">
                           @endif
            <div class="container">
                <div class="col-md-8 col-sm-10">
                    <div class="caption cl-white home_two_slid">
                        <h2 style="font-size:40px;">Connect, Collaborate, and Create with <span class="theme-cl">Filmkar</span>
                            across the country</h2>
                        <p>Trending Talent Category:
                            @foreach($setting as $list)
                            <span class="trending_key"><a
                                    href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></span>
                            @endforeach
                        </p>
                    </div>
                    <form action="{{route('filterusers')}}" method="get">
                        <fieldset class="utf_home_form_one">
                            <div class="col-md-4 col-sm-4 padd-0">
                                <input type="text" class="form-control br-1" name="keyword" placeholder="Search Keywords..." />
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control br-1" name="category_id">
                                    <option data-display="All Categories" value="">All Categories</option>
                                    @foreach($category as $list)
                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control" name="gender">
                                    <option data-display="Gender" value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
                 <div class="item ">
                            @if ($organisationimage)
                       <div class="utf_main_banner_area" style="background-image:url({{asset('assets/slider/organisation/' . $organisationimage)}})" data-overlay="8">
                           @endif
            <div class="container">
                <div class="col-md-8 col-sm-10">
                    <div class="caption cl-white home_two_slid">
                        <h2 style="font-size:40px;">Connect, Collaborate, and Create with <span class="theme-cl">Filmkar</span>
                            across the country</h2>
                        <p>Trending Talent Category:
                            @foreach($setting as $list)
                            <span class="trending_key"><a
                                    href="{{ route('details', [$list->category_slug]) }}">{{$list->category_name}}</a></span>
                            @endforeach
                        </p>
                    </div>
                    <form action="{{route('filterusers')}}" method="get">
                        <fieldset class="utf_home_form_one">
                            <div class="col-md-4 col-sm-4 padd-0">
                                <input type="text" class="form-control br-1" name="keyword" placeholder="Search Keywords..." />
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control br-1" name="category_id">
                                    <option data-display="All Categories" value="">All Categories</option>
                                    @foreach($category as $list)
                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 padd-0">
                                <select class="wide form-control" name="gender">
                                    <option data-display="Gender" value="">Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<!--Banner Home Page 1-->
<div class="widget-boxed">
        <a href="{{ DB::table('banners')->where('key', 'home_1')->first()->link }}" target="_blank">
            <div class="widget-boxed-body">
                <div class="side-list no-border">
                    <ul>
                        <li>
                            <img src="{{asset('assets/banner/'.DB::table('banners')->where('key','home_1')->first()->value)}}" class="posterimg" style="width: 1200px;height:200px;">
                        </li>
                    </ul>
                </div>
            </div>
        </a>
    </div>


  



<!-- ======================= End Banner ===================== --> 
<!-- ================= Job start ========================= -->
<!-- Featured Job -->
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Talent</h2>
               <p>Discover captivating performers, musicians, dancers, and artists who bring magic and flair to the world of film.</p>
            </div>
            @foreach($vendor as $list)
            <a href="{{route('user.vendordetails', [$list->username])}}" class="">
        <div class="col-md-3 col-sm-9">
        <div class="utf_grid_job_widget_area"> 
          <div class="u-content">
         <div class="contact-img">
    @if($list->profile != null)
        <img class="zoomable-image" src="{{asset('assets/profile/'.$list->profile)}}" alt=""> 
    @else
        <img class="zoomable-image" src="{{asset('assets/profile/default_avatar.jpg')}}" alt=""> 
    @endif
</div>

            <h5 class="talenttitle">{{$list->firstname.' '.$list->lastname}}</h5>
            @php
            $bday = new DateTime($list->birthdate); // Your date of birth
            $today = new Datetime(date('m.d.y'));
            $diff = $today->diff($bday);
            $yearsold = $diff->y;
            @endphp
            <p class="text-muted">{{$list->states_name}} ({{($list->city)}}),{{$yearsold}}</p>
          </div>
          <!-- <div class="utf_apply_job_btn_item"> <a href="{{route('user.vendordetails', [$list->username])}}" class="btn job-browse-btn btn-radius br-light">See Profile</a> </div> -->
        </div>
      </div>
      </a>
            @endforeach
         </div>
      </div>
      <!-- Tab panels --> 
      <div class="col-md-12 mrg-top-20 text-center">
         <a href="{{route('talent.browse')}}" class="btn theme-btn btn-m">Browse All Talents</a>
      </div>
   </div>
</section>
</div>
</div>
</section>
<!--Start Banner Home 2-->
 <div class="widget-boxed">
        <a href="{{ DB::table('banners')->where('key', 'home_1')->first()->link }}" target="_blank">
            <div class="widget-boxed-body">
                <div class="side-list no-border">
                    <ul>
                        <li>
                            <img src="{{asset('assets/banner/'.DB::table('banners')->where('key','home_2')->first()->value)}}" class="posterimg" style="width: 1200px;height:200px;">
                        </li>
                    </ul>
                </div>
            </div>
        </a>
    </div>

<!--End Banner Home 2-->
<!-- ================= Category start ========================= -->
<section class="utf_job_category_area">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="heading">
               <h2>Categories</h2>
               <p>Discover the diverse tapestry of film expertise, from actors to directors, musicians to technicians, and delve into every facet of the vibrant film industry with Filmkar's comprehensive profiles.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            @foreach($category_count as $list)
            <div class="col-md-3 col-sm-6">
               <a href="{{ route('details', [$list['category_slug']]) }}" title="">
                  <div class="utf_category_box_area">
                     <div class="utf_category_desc">
                        <div class="category-detail utf_category_desc_text">
                           <h4>{{$list['category_name']}}</h4>
                           <p>{{$list['count']}}</p>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            @endforeach
             <div class="col-md-12 mrg-top-20 text-center"> 
             <a href="{{route('categories')}}" class="btn theme-btn btn-m">View All Categories</a> 
             </div> 
         </div>
      </div>
   </div>
</section>
<!--Start Banner Home 3-->
 <div class="widget-boxed">
        <a href="{{ DB::table('banners')->where('key', 'home_1')->first()->link }}" target="_blank">
            <div class="widget-boxed-body">
                <div class="side-list no-border">
                    <ul>
                        <li>
                            <img src="{{asset('assets/banner/'.DB::table('banners')->where('key','home_3')->first()->value)}}" class="posterimg" style="width: 1200px;height:200px;">
                        </li>
                    </ul>
                </div>
            </div>
        </a>
    </div>

<!--End Banner Home 3-->
@if(count($jobs) > 0)
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Jobs</h2>
               <p>Explore exciting projects and talented professionals with compelling opportunities in the ever- evolving world of cinema. </p>
            </div>
            @foreach($jobs as $list)
            <a href="{{route('job.details', [$list->slug])}}">
                <div class="col-md-3 col-sm-6">
                    <div class="utf_grid_job_widget_area"> <span class="job-type full-type ">{{$list->job_type}}</span><br><br>
                  <div class="utf_job_like">
                    <label class="toggler toggler-danger">
                      <input type="checkbox">
                      <i class="fa fa-star"></i> </label>
                  </div>
                  <div class="u-content">
                            <div class="avatar box-80" style="height: 90px; width: 140px; background-image: url('{{ $list->logo != '' ? asset('assets/institute/logo/'.$list->logo) : asset('assets/profile/default_avatar.jpg') }}'); background-size: cover; background-position: center;"> 
                            </div>
                            @php
                                $string = $list->title;
                                $words = str_word_count($string, 1, '0123456789');
                                $first_five_words = implode(' ', array_slice($words, 0, 5)); 
                            @endphp
                            <h3 class="jobstitle">{{$first_five_words}}</h3>
                            <li>{{$list->state}} ({{$list->city}})</li>
                  </div>
                  
                </div>
                </div>
            </a>
            
            @endforeach
         </div>
      </div>
      <!-- Tab panels --> 
      <div class="col-md-12 mrg-top-20 text-center">
         <a href="{{route('jobs')}}" class="btn theme-btn btn-m">Browse All Jobs</a>
      </div>
   </div>
</section>
@endif
<!--Start Featured Movies-->
@if(!empty($movies) && count($movies) > 0)
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Movies</h2>
               <p>Elevate your movie to new heights with Filmkar. Showcase your cinematic masterpiece to a wide audience, gain visibility, and engage with film enthusiasts, opening doors to success and recognition in the industry.</p>
            </div>
         </div>
         <div class="container">
  <div class="row">
    @foreach($movies as $list)
             <a href="{{route('movies.details', [$list->slug])}}">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="contact-box">
            
            <div class="contact-img">
             @if($list->poster != '')
            <img src="{{asset('assets/movie/poster/'.$list->poster)}}" style="height: 200px; width: 350px;"  alt="">
            @else
            <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 200px; width: 350px;"  alt="">
            @endif 
            </div>
            <div class="contact-caption">
                <a href="{{route('movies.details', [$list->slug])}}">{{$list->title}}</a>
            </div>

        </div>
    </div>
    </a>
    @endforeach
		</div>
  </div>
         <!-- Tab panels --> 
         <div class="col-md-12 mrg-top-20 text-center">
            <a href="{{route('movies')}}" class="btn theme-btn btn-m">Browse All Movies</a>
         </div>
      </div>
   </div>
</section>
@else
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="col-md-10 text-center user_profile_img">
            <img src="{{asset('assets/profile/noresult.png')}}" style="width: 70%;" alt="">
         </div>
      </div>
   </div>
</section>
@endif
</div>
</div>
</section>
<!--End  Featured Movies-->
<!--Start Featured Organisation-->
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Organisation</h2>
               <p>Explore production houses and event organizers that bring extraordinary visions to life. Stay updated on their latest ads, upcoming events, and exciting movie releases, fueling your passion for the film industry.</p>
            </div>
            @if(count($institutes) > 0)
            @foreach($institutes as $list)
            <div class="col-md-3 col-sm-3" style="height:260px;">
               <div class="utf_grid_job_widget_area">
                  <a href="{{ route('institutes.details', [$list->id]) }}">
                     <div class="u-content">
                        <div class="avatar box-80" style="height: 90px; width: 140px; background-image: url('{{ $list->logo != '' ? asset('assets/institute/logo/'.$list->logo) : asset('assets/profile/default_avatar.jpg') }}'); background-size: cover; background-position: center;"> 
                        </div>
                        <h5 class="organisationtitle" style="text-overflow : ellipsis;white-space: nowrap;  overflow: hidden;">{{$list->company}}</h5>
                        <p class="text-muted">{{ $list->state }} ({{ $list->city }})</p>
                     </div>
                  </a>
               </div>
            </div>
            @endforeach
            @else
                <div class="col-md-10 text-center user_profile_img">
                    <img src="{{asset('assets/profile/noresult.png')}}" style=" width: 70%;"  alt="">
                </div>
            @endif
         </div>
         <!-- Tab panels -->
         <div class="col-md-12 mrg-top-20 text-center">
            <a href="{{route('institutes')}}" class="btn theme-btn btn-m">Browse All Organisations</a>
         </div>
      </div>
   </div>
</section>
@if(count($institutes) == 0)
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="col-md-10 text-center user_profile_img">
            <img src="{{asset('assets/profile/noresult.png')}}" style="width: 70%;" alt="">
         </div>
      </div>
   </div>
</section>
@endif
</div>
</div>
</section>

<!--End Featured Organisation-->

@if(count($events) > 0)
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Events</h2>
               <p>Take the pulse of the film industry with Filmkar's Featured Live Events. Explore exclusive screenings, premieres, festivals, and engaging experiences that celebrate the magic of cinema.</p>
            </div>
            @foreach($events as $list)
            <a href="{{route('events.details', [$list->slug])}}">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="contact-box">
            
            <div class="contact-img">
            @if($list->thumbnail != '')
            <img src="{{asset('assets/event/thumbnail/'.$list->thumbnail)}}" style="height: 200px; width: 350px;"  alt="">
            @else
            <img src="{{asset('assets/profile/default_avatar.jpg')}}" style="height: 200px; width: 350px;"  alt="">
            @endif 
            </div>
            <div class="contact-caption">
                <a href="{{route('events.details', [$list->slug])}}">{{$list->title}}</a>
            <div class="">{{ Carbon\Carbon::parse($list->start_date)->format('d M') }} | {{$list->category_name}} | @if($list->state) {{$list->state}} @endif </div>
            </div>

        </div>
    </div>
    </a>
    @endforeach
         </div>
      </div>
      <!-- Tab panels --> 
      <div class="col-md-12 mrg-top-20 text-center">
         <a href="{{route('events')}}" class="btn theme-btn btn-m">Browse All Events</a>
      </div>
   </div>
</section>
@endif
<!--Start Featured Blog-->
@if(count($data) > 0)
<section class="padd-top-80 padd-bot-80">
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div class="heading">
               <h2>Featured Blog</h2>
               <p>Take the pulse of the film industry with Filmkar's Featured Live Events. Explore exclusive screenings, premieres, festivals, and engaging experiences that celebrate the magic of cinema.</p>
            </div>
            </div>
      </div>
       <div class="container">
  <div class="row">
     @foreach($data as $list)
     	<div class="col-md-3 col-sm-5" style="padding:20px;">
		
       <a href="{{route('blog.blogdetails', [$list->slug])}}">
		  <div class="image-container">
    <img class="img-responsive width-450" src="{{ asset('assets/blog/'.$list->thumbnail) }}" alt="" width="450" height="300">
    <div class="overlay"></div>
</div>

			<h4 class="title">{{$list->title}}</h4>
			 </a>
		</div>
		 @endforeach
		</div>
  </div>
          

      <!-- Tab panels --> 
      <div class="col-md-12 mrg-top-20 text-center">
         <a href="{{route('blog')}}" class="btn theme-btn btn-m">Browse All Blogs</a>
      </div>
   </div>
</section>
@endif
<!--End Featured Blog-->
<section class="newsletter theme-bg" style="background-image:url(assets/img/bg-new.png)">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="heading light">
               <h2>Subscribe Our Newsletter</h2>
               <p>Get the latest updates, exclusive industry insights, and exciting opportunities delivered straight to your inbox, ensuring you never miss a beat in the film world.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
            <div class="newsletter-box text-center">
                <form action="{{route('subscribe')}}" method="post" id="subscribe">
                    @csrf
               <div class="input-group"> <span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
                  <input type="email" name="email" class="form-control" placeholder="Enter your Email..." required>
               </div>
               <button type="submit" id="btn_subscribe" class="btn theme-btn btn-radius btn-m">Subscribe</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Jquery js--> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<script src="assets/plugins/bootstrap/js/bootsnav.js"></script> 
<script src="assets/js/viewportchecker.js"></script> 
<script src="assets/js/slick.js"></script> 
<script src="assets/js/subscribe.js"></script> 
<script src="assets/plugins/bootstrap/js/wysihtml5-0.3.0.js"></script> 
<script src="assets/plugins/bootstrap/js/bootstrap-wysihtml5.js"></script> 
<script src="assets/plugins/aos-master/aos.js"></script> 
<script src="assets/plugins/nice-select/js/jquery.nice-select.min.js"></script> 
<script src="assets/js/custom.js"></script> 

@endsection