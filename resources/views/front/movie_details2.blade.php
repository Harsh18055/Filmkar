<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Jan 2023 04:02:07 GMT -->

<head>

    <meta name="author" content="">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>FILMKAR - Movies</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="https://www.filmkar.com/assets/setting/Filmkar.png" />
 
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
     <link href="https://www.filmkar.com/assets/plugins/icons/css/icons.css" rel="stylesheet">
    <link href="https://www.filmkar.com/assets/plugins/bootstrap/css/bootsnav.css" rel="stylesheet">
    <link href="https://www.filmkar.com/assets/css/style.css" rel="stylesheet">
    <link href="https://www.filmkar.com/assets/css/responsive.css" rel="stylesheet">
      <link href="https://www.filmkar.com/assets/plugins/animate/animate.css" rel="stylesheet">
 
    <link href="https://www.filmkar.com/assets/plugins/bootstrap/css/bootsnav.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.filmkar.com/assets/plugins/nice-select/css/nice-select.css">
    <link href="https://www.filmkar.com/assets/plugins/aos-master/aos.css" rel="stylesheet">
   
     
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Jquery js-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.filmkar.com/assets/js/jquery.min.js"></script>
<script src="https://www.filmkar.com/assets/js/login.js"></script>
<script src="https://www.filmkar.com/assets/js/range.js"></script>
<script src="https://www.filmkar.com/assets/js/jobapplied.js"></script>
 
    <!-- CSS -->
  
   
   <link href="images/favicon.png" rel="icon">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" type="text/css" href="public/bootstrap.min.css">
    <!-- END BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- OWL CAROUSEL -->  
    <link rel="stylesheet" type="text/css" href="public/owl.carousel.css">
    <!-- END OWL CAROUSEL -->

    <!-- FONT CSS -->
    <link rel="stylesheet" type="text/css" href="public/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/icofont.min.css">

    <link rel="stylesheet" type="text/css" href="public/animated.css">
    <link rel="stylesheet" type="text/css" href="public/video.popup.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" type="text/css" href="public/style.css">
    <!-- END STYLE CSS -->

    <!-- RESPONSIVE CSS -->
    <link rel="stylesheet" type="text/css" href="public/responsive.css">
    <!-- END RESPONSIVE CSS -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CPoppins:200,300,400,500,600,700,800,900"
        rel="stylesheet">
    <style>
        .swal2-confirm {
            background-color: #ED2024 !important;
        }

        /* Import Google font - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        .chatbot {
            position: absolute;
            z-index: 1000;
        }

        .chatbot-toggler {
            z-index: 999;
        }

        .chatbot-toggler {
            position: fixed;
            bottom: 30px;
            right: 35px;
            outline: none;
            border: none;
            height: 50px;
            width: 50px;
            display: flex;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: red;
            transition: all 0.2s ease;
        }

        body.show-chatbot .chatbot-toggler {
            transform: rotate(90deg);
        }

        .chatbot-toggler span {
            color: #fff;
            position: absolute;
        }

        .chatbot-toggler span:last-child,
        body.show-chatbot .chatbot-toggler span:first-child {
            opacity: 0;
        }

        body.show-chatbot .chatbot-toggler span:last-child {
            opacity: 1;
        }

        .chatbot {
            position: fixed;
            right: 35px;
            bottom: 90px;
            width: 420px;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
            transform: scale(0.5);
            transform-origin: bottom right;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
            transition: all 0.1s ease;
        }

        body.show-chatbot .chatbot {
            opacity: 1;
            pointer-events: auto;
            transform: scale(1);
        }

        .chatbot header {
            padding: 16px 0;
            position: relative;
            text-align: center;
            color: #fff;
            background: red;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .chatbot header span {
            position: absolute;
            right: 15px;
            top: 50%;
            display: none;
            cursor: pointer;
            transform: translateY(-50%);
        }

        header h2 {
            font-size: 1.4rem;
        }

        .chatbot .chatbox {
            overflow-y: auto;
            height: 380px;
            padding: 30px 20px 100px;
        }

        .chatbot :where(.chatbox, textarea)::-webkit-scrollbar {
            width: 6px;
        }

        .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-track {
            background: #fff;
            border-radius: 25px;
        }

        .chatbot :where(.chatbox, textarea)::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 25px;
        }

        .chatbox .chat {
            display: flex;
            list-style: none;
        }

        .chatbox .outgoing {
            margin: 20px 0;
            justify-content: flex-end;
        }

        .chatbox .incoming span {
            width: 32px;
            height: 32px;
            color: #fff;
            cursor: default;
            text-align: center;
            line-height: 32px;
            align-self: flex-end;
            background: red;
            border-radius: 4px;
            margin: 0 10px 7px 0;
        }

        .chatbox .chat p {
            white-space: pre-wrap;
            padding: 12px 16px;
            border-radius: 10px 10px 0 10px;
            max-width: 75%;
            color: #fff;
            font-size: 0.95rem;
            background: #724ae8;
        }

        .chatbox .incoming p {
            border-radius: 10px 10px 10px 0;
        }

        .chatbox .chat p.error {
            color: #721c24;
            background: #f8d7da;
        }

        .chatbox .incoming p {
            color: #000;
            background: #f2f2f2;
        }

        .chatbot .chat-input {
            display: flex;
            gap: 5px;
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #fff;
            padding: 3px 20px;
            border-top: 1px solid #ddd;
        }

        .chat-input textarea {
            height: 55px;
            width: 100%;
            border: none;
            outline: none;
            resize: none;
            max-height: 180px;
            padding: 15px 15px 15px 0;
            font-size: 0.95rem;
        }

        .chat-input span {
            align-self: flex-end;
            color: #724ae8;
            cursor: pointer;
            height: 55px;
            display: flex;
            align-items: center;
            visibility: hidden;
            font-size: 1.35rem;
        }

        .chat-input textarea:valid~span {
            visibility: visible;
        }

        @media (max-width: 490px) {
            .chatbot-toggler {
                right: 20px;
                bottom: 20px;
            }

            .chatbot {
                right: 0;
                bottom: 0;
                height: 100%;
                border-radius: 0;
                width: 100%;
            }

            .chatbot .chatbox {
                height: 90%;
                padding: 25px 15px 100px;
            }

            .chatbot .chat-input {
                padding: 5px 15px;
            }

            .chatbot header span {
                display: block;
            }
        }
    </style>
</head>

<body class="utf_skin_area">
     <div class="zmovo-main dark-bg">
    <!--<div class="page_preloader"></div>-->
    <!-- ======================= Start Navigation ===================== -->
    <!-- class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav" -->
    <header class="zmovo-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 zmovo-logos">
                        <div class="zmovo-logo">
                            <a class="navbar-brand" href="https://www.filmkar.com"> <img
                                    src="https://www.filmkar.com/assets/setting/logo_white.png"
                                    style="height: 60px; padding-bottom: 15px;" class="logo logo-display" alt=""> <img
                                    src="https://www.filmkar.com/assets/setting/logo_black.png"
                                    style="height: 60px; padding-bottom: 15px;" class="logo logo-scrolled" alt=""> </a>
                        </div>
                    </div>
                    <div class="col-lg-10 zmovo-menus">
                        <div class="main-menu">
                            <div class="navigation">
                                <div class="menu-container">
                                    <div id="navigation">
                                        <ul>
                                            <li class="dropdown "> <a href="https://www.filmkar.com">Home</a> </li>
                                            </li>

                                            <li class="has-sub"><span class="submenu-button"></span><a
                                                    href="index.html">Browse talent</a>

                                                <ul>
                                                    <li><a href="https://www.filmkar.com/category/actors">Actors</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/anchor">Anchor</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/animator">Animator</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/asst.-director">Asst.
                                                            Director</a></li>
                                                    <li><a href="https://www.filmkar.com/category/camera-crew">Camera
                                                            Crew</a></li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/choreographer">Choreographer</a>
                                                    </li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/cinematographer">Cinematographer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/costumer">Costumer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/dancers">Dancers</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/di-colorist">Di
                                                            Colorist</a></li>
                                                    <li><a href="https://www.filmkar.com/category/director">Director</a>
                                                    </li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/distributor">Distributor</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/dubbing-engineer">Dubbing
                                                            Engineer</a></li>
                                                    <li><a href="https://www.filmkar.com/category/editor">Editor</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/groomers">Groomers</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/hair-stylists">Hair
                                                            Stylists</a></li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/influencer">Influencer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/lyricist">Lyricist</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/makeup-artists">Makeup
                                                            Artists</a></li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/manicurist">Manicurist</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/marketing-manager">Marketing
                                                            Manager</a></li>
                                                    <li><a href="https://www.filmkar.com/category/models">Models</a>
                                                    </li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/musicians">Musicians</a>
                                                    </li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/photographers">Photographers</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/producer">Producer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/production-manager">Production
                                                            Manager</a>
                                                    </li>
                                                    <li><a
                                                            href="https://www.filmkar.com/category/public-relation-officer-%28pro%29">Public
                                                            Relation Officer (PRO)</a></li>
                                                    <li><a href="https://www.filmkar.com/category/set-designers">Set
                                                            Designers</a></li>
                                                    <li><a href="https://www.filmkar.com/category/singer">Singer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/sound-crew">Sound
                                                            Crew</a></li>
                                                    <li><a href="https://www.filmkar.com/category/sound-designers">Sound
                                                            Designers</a></li>
                                                    <li><a href="https://www.filmkar.com/category/storyboard-artist">Storyboard
                                                            Artist</a></li>
                                                    <li><a href="https://www.filmkar.com/category/vfx-artist">Vfx
                                                            artist</a></li>
                                                    <li><a href="https://www.filmkar.com/category/writer">Writer</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/category/dubbing-artists">Dubbing
                                                            Artists</a></li>



                                                </ul>
                                            </li>
                                            <li class="dropdown "> <a href="https://www.filmkar.com/jobs">Jobs</a> </li>
                                            <li class="dropdown "> <a href="https://www.filmkar.com/events">Events</a>
                                            </li>
                                            <li class="dropdown  "> <a
                                                    href="https://www.filmkar.com/movies">Movies</a> </li>
                                            <li class="dropdown "> <a
                                                    href="https://www.filmkar.com/organisations">Organisation</a> </li>
                                            <li class="dropdown "> <a href="https://www.filmkar.com/contact">Contact</a>
                                            </li>
                                            <li class="dropdown "> <a href="https://www.filmkar.com/blog">Blog</a> </li>
                                            <li class="dropdown zmovo-login"><a href="javascript:void(0)" data-toggle="modal" style="background-color: red; color: #fff; padding: 11px !important; position: relative !important;
    top: 15px;
    left: 16px;
    border-radius: 7px;"
                            data-target="#signin"  ><span class="fa fa-user" ></span> Login</a> </li>
                                            
                                            <li class="has-sub"><span class="submenu-button"></span><a style="background-color: red; color: #fff; padding: 11px !important; position: relative !important;
    top: 15px;
    left: 40px;
    border-radius: 7px;"  class="btn-signup red-btn">Register As</a>
                                                <ul>
                                                    <li><a href="https://www.filmkar.com/register">Talent</a>
                                                    </li>
                                                    <li><a href="https://www.filmkar.com/register-organisation">Organisation</a>
                                                    </li>
                                                   
                                                </ul>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </header>
           
    <!-- ======================= End Navigation ===================== -->
    <style>
        .contact-box {
            position: relative;
            margin-bottom: 30px;
            overflow: hidden;
            padding: 26px;
        }

        .contact-img {
            position: relative;
        }

        .contact-caption {
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            padding: 10px;
            color: #fff;
            font-size: 14px;
        }

        .contact-caption p {
            color: red !important;
        }

        .contact-caption a {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }

        @media (max-width: 767px) {
            .contact-img {
                height: 200px;
            }
        }

        @media (min-width: 768px) {
            .contact-img {
                height: 300px;
            }
        }

        .zoom-container {
            width: 100%;
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .zoomable-image {
            overflow: hidden;
            transition: transform 0.3s;
        }

        .zoomable-image img {
            transition: transform 0.3s;
        }

        .zoomable-image:hover {
            transform: scale(1.1);
        }

        .zoomable-image:hover img {
            transform: scale(1.1);
        }
    </style>
<div class="zmovo-breadcroumb-area">
            <div class="zmovo-breadcroumb-bg">
                <div class="container">
                    <div class="zmovo-breadcroumb-inner text-center">
                        <h2>Movie Trailer</h2>
                        <span>Movie Trailer</span>
                    </div>
                </div>
            </div>
        </div>
 <div class="zmoto-inner-page">
            <div class="zmovo-trailor-page">
                <div class="zmovo-trailor pt-50">
                    <div class="container">
                        <div class="zmovo-trailor-slides" id="trailor">
                            <div class="item">
                                <div class="zmovo-trailor-img">
                                    <img src="./103621128.webp" alt="">
                                    <div class="zmovo-slide-ply-btn text-center">
                                        <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                            class="video-popup"><img src="images/play-button.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-trailor-img">
                                    <img src="images/1_1.jpg" alt="">
                                    <div class="zmovo-slide-ply-btn text-center">
                                        <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                            class="video-popup"><img src="images/play-button.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="zmovo-trailor-info pt-30">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="zmovo-trailor-contents">
                                        <div class="row">
                                            <div class="offset-lg-1 col-lg-11">
                                                <div class="zmoto-trailor-content">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-5">
                                                            <div class="zmovo-trailor-img-slides"
                                                                id="trailor-img-slide">
                                                                <div class="item">
                                                                    <div class="zmovo-trailor-img-slide">
                                                                        <span>premium</span>
                                                                        <img src="images/1_2.jpg" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="item">
                                                                    <div class="zmovo-trailor-img-slide">
                                                                        <span>premium</span>
                                                                        <img src="images/1_2.jpg" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="item">
                                                                    <div class="zmovo-trailor-img-slide">
                                                                        <span>premium</span>
                                                                        <img src="images/1_2.jpg" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="item">
                                                                    <div class="zmovo-trailor-img-slide">
                                                                        <span>premium</span>
                                                                        <img src="images/1_2.jpg" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 offset-lg-1">
                                                            <div class="zmovo-trailor-meta-info">
                                                                <div class="dec-review-dec">
                                                                    <div class="details-title">
                                                                        <a href="">Test Test 22</a>
                                                                    </div>
                                                                    <div class="ratting">
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <span class="fa fa-star"></span>
                                                                        <a href="">6/5 ratitng</a>
                                                                    </div>
                                                                    <div class="dec-review-meta">
                                                                        <ul>
                                                                            <li><strong>Genre: </strong><a href="">Animation, Biography, Comedy</a></li>
                                                                            <li><strong>Format: </strong>
                                                                              <a href="">  3D, ICE 3D, 4DX, 4DX 3D</a>
                                                                            </li>
                                                                            <li><strong>Language: </strong>
                                                                             <a href=""> BHOJPURI, BENGALI, BIHARI,
                                                                                CHHATTISGARHI, DECCANI</a>  
                                                                            </li>
                                                                            <li><strong>Censor Certificate: </strong><a href="">A</a>
                                                                            </li>
                                                                            <li><strong>Release Date:
                                                                                </strong><a href="">2023-08-01</a></li>
                                                                            <li><strong>Duration of Movie: </strong><a href="">2
                                                                                hour 2 min</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="social-links">
                                                                        
                                                                        <a type="button"
                                                                            style="background: red; border-radius: 2px; color: aliceblue;"
                                                                            class="btn theme-btn btn-m"
                                                                            href="javascript:void(0)"
                                                                            data-toggle="modal" data-target="#signin"><i
                                                                                class="star-icon ti-star"></i> Rate
                                                                            Now</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="zmovo-trailor-story">
                                                    <h2>About Movie</h2>
                                                    <div class="zmovo-trailor-dec">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FULL WIDHT BANNER -->
                <div class="zmovo-fullwidht-banner pt-50">
                    <div class="zmovo-fullwidth-b-inner">
                        <div class="zmovo-full-banner-bg">
                            <div class="zmovo-slide-content">
                                <div class="container">
                                    <div class="items" id="banner">
                                        <div class="item">
                                            <div class="zmovo-slide-ply-btn text-center">
                                                <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                    class="video-popup"><img src="images/play-button.png" alt=""></a>
                                            </div>
                                            <div class="zmovo-slider-contetn">
                                                <div class="zmovo-slider-premium-tag">
                                                    <span class="c1-bg">Trailer</span>
                                                </div>
                                                <h2>Upcoming Movies 2019</h2>
                                                <a href="">The Happy Nutcracker and the Four Realms</a>
                                                <div class="zmovo-v-tag c2">
                                                    <span>Romance, English, 2019</span>
                                                </div>
                                                <div class="movie-time"><i class="fa fa-clock-o"></i><span>2 Hr 3
                                                        Min</span></div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="zmovo-slide-ply-btn text-center">
                                                <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                    class="video-popup"><img src="images/play-button.png" alt=""></a>
                                            </div>
                                            <div class="zmovo-slider-contetn">
                                                <div class="zmovo-slider-premium-tag">
                                                    <span class="c1-bg">Trailer</span>
                                                </div>
                                                <h2>Upcoming Movies 2019</h2>
                                                <a href="">The Happy Nutcracker and the Four Realms</a>
                                                <div class="zmovo-v-tag c2">
                                                    <span>Romance, English, 2019</span>
                                                </div>
                                                <div class="movie-time"><i class="fa fa-clock-o"></i><span>2 Hr 3
                                                        Min</span></div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="zmovo-slide-ply-btn text-center">
                                                <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                    class="video-popup"><img src="images/play-button.png" alt=""></a>
                                            </div>
                                            <div class="zmovo-slider-contetn">
                                                <div class="zmovo-slider-premium-tag">
                                                    <span class="c1-bg">Trailer</span>
                                                </div>
                                                <h2>Upcoming Movies 2019</h2>
                                                <a href="">The Happy Nutcracker and the Four Realms</a>
                                                <div class="zmovo-v-tag c2">
                                                    <span>Romance, English, 2019</span>
                                                </div>
                                                <div class="movie-time"><i class="fa fa-clock-o"></i><span>2 Hr 3
                                                        Min</span></div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="zmovo-slide-ply-btn text-center">
                                                <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                    class="video-popup"><img src="images/play-button.png" alt=""></a>
                                            </div>
                                            <div class="zmovo-slider-contetn">
                                                <div class="zmovo-slider-premium-tag">
                                                    <span class="c1-bg">Trailer</span>
                                                </div>
                                                <h2>Upcoming Movies 2019</h2>
                                                <a href="">The Happy Nutcracker and the Four Realms</a>
                                                <div class="zmovo-v-tag c2">
                                                    <span>Romance, English, 2019</span>
                                                </div>
                                                <div class="movie-time"><i class="fa fa-clock-o"></i><span>2 Hr 3
                                                        Min</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FULL WIDHT BANNER -->
                <!-- team member -->
                <div class="zmovo-team-section arow-icon">
                    <div class="container">
                        <div class="zmovo-hadidng pt-50 pb-30">
                            <h2><span>Movie Cast</span></h2>
                        </div>
                        <div class="zmovo-teams" id="team">
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/1_3.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/2.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/3_1.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/4.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="zmovo-team-section arow-icon">
                    <div class="container">
                        <div class="zmovo-hadidng pt-50 pb-30">
                            <h2><span>Movie Crew</span></h2>
                        </div>
                        <div class="zmovo-teams" id="team1">
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/1_3.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/2.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/3_1.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="zmovo-team">
                                    <img src="images/4.jpg" alt="">
                                    <div class="zmovo-team-content">
                                        <div class="zmovo-team-social">
                                            <ul>
                                                <li class="tfb"><a href=""><span class="fa fa-facebook"></span></a></li>
                                                <li class="ttw"><a href=""><span class="fa fa-twitter"></span></a></li>
                                                <li class="tin"><a href=""><span class="fa fa-instagram"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="zmovo-team-title">
                                            <a href="">Jon kmpro kellys</a>
                                            <h4>director</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end team member -->
                <div class="zmovo-Popular-item arow-icon">
                    <div class="container">
                        <div class="zmovo-Popular-items">
                            <div class="zmovo-hadidng pt-50 pb-30">
                                <h2><span class="text-uppercase">Movie Trailer</span></h2>
                            </div>
                            <!-- items -->
                            <div class="items" id="popular-shows">
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">Clue of the Invisible Hand action movie</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/2_1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">A Millipede Dreams of mas Four Realms</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/3.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">Alice B. Toklas in Wonder land Happy </a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/4_1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">the Four Realms Conned, Some Are Concact</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/5.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">The Days of Promise, Days of Hope</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                            </div>
                            <!-- end items -->
                            <!-- ALL VIEW -->
                            
                            <!-- END ALL VIEW -->
                        </div>
                    </div>
                </div>
                <div class="zmovo-Popular-item arow-icon">
                    <div class="container">
                        <div class="zmovo-Popular-items">
                            <div class="zmovo-hadidng pt-50 pb-30">
                                <h2><span class="text-uppercase">Related Movie</span></h2>
                            </div>
                            <!-- items -->
                            <div class="items" id="popular-shows1">
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">Clue of the Invisible Hand action movie</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/2_1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">A Millipede Dreams of mas Four Realms</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/3.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">Alice B. Toklas in Wonder land Happy </a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/4_1.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">the Four Realms Conned, Some Are Concact</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                                <!-- ITEM -->
                                <div class="item">
                                    <div class="zmovo-video-item-box">
                                        <div class="zmovo-video-box-inner">
                                            <div class="zmovo-v-box-img gradient">
                                                <img src="images/5.jpg" alt="">
                                                <div class="ply-btns">
                                                    <a href=""
                                                        data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA"
                                                        class="ply-btn video-popup"><img src="images/play-button.png"
                                                            alt=""></a>
                                                </div>
                                                <div class="zmovo-v-box-content">
                                                    <a href="">The Days of Promise, Days of Hope</a>
                                                    <div class="zmovo-v-tag c2">
                                                        <span>Romance, English, 2019</span>
                                                    </div>
                                                    <div class="movie-time"><i class="fa fa-clock-o c1"></i><span>2 Hr 3
                                                            Min</span></div>
                                                    <div class="like-icon">
                                                        <a href=""><span class="fa fa-heart-o"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END ITEM -->
                            </div>
                            <!-- end items -->
                            <!-- ALL VIEW -->
                            <div class="button pt-50 text-center">
                                <a href="" class="btn btn-radus">view all <span class="fa fa-angle-right"></span></a>
                            </div>
                            <!-- END ALL VIEW -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="zmovo-slider-area">
            <div class="items" id="slider">
                <div class="item">
                    <div class="zmovo-slider-contents">
                        <img src=" " alt="" style="height: 500px;">
                        <div class="zmovo-slide-content" style="top: 36%;
                    "> 
                            <div class="container">
                                <div class="zmovo-slider-contetn" style="text-align: center;">
                                    <div class="zmovo-slider-premium-tag">
                                        <span class="c2-bg">Reviews</span>
                                        <label>Period Adventure</label>
                                    </div>
                                    <a href="">Rebort Action Story 5</a>
                                    <div class="zmovo-slide-cat">
                                        <ul>
                                            <li><span>Category : </span>English Movies - 2019</li>
                                            <li><span>Genre : </span>Action, Drama </li>
                                        </ul>
                                    </div>
                                    <div class="zmovo-slide-ply-btn">
                                        <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA" class="video-popup"><img src="image/play-button.png" alt="">Play Trailer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="zmovo-slider-contents">
                        <img src=" " alt="" style="height: 500px;">
                        <div class="zmovo-slide-content" style="top: 36%;
                        "> 
                                <div class="container">
                                    <div class="zmovo-slider-contetn" style="text-align: center;">
                                        <div class="zmovo-slider-premium-tag">
                                        <span class="c2-bg">Reviews</span>
                                        <label>Period Adventure</label>
                                    </div>
                                    <a href="">Rebort Action Story 5</a>
                                    <div class="zmovo-slide-cat">
                                        <ul>
                                            <li><span>Category : </span>English Movies - 2019</li>
                                            <li><span>Genre : </span>Action, Drama </li>
                                        </ul>
                                    </div>
                                    <div class="zmovo-slide-ply-btn">
                                        <a href="" data-video-url="https://www.youtube.com/watch?v=CsVJoCKc9rA" class="video-popup"><img src="image/play-button.png" alt="">Play Trailer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    

 
   <footer class="footer" style="background-color: #F0F8FF;">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <a href="/"><img class="footer-logo" src="https://www.filmkar.com/assets/setting/logo-color.png"
                        alt=""></a>
                <p>Filmkar is the only network of qualified filmmakers where you can connect them directly. We
                    connect you with the best film crew, technicians, and vendors, wherever you need them.</p>

            </div>
            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Comapny</h4>
                        <ul>
                            <li><a href="https://www.filmkar.com"><i class="fa fa-angle-double-right"></i>
                                    Home</a></li>
                            <li><a href="https://www.filmkar.com/about-us"><i
                                        class="fa fa-angle-double-right"></i> About</a></li>
                            <li><a href="https://www.filmkar.com/blog"><i class="fa fa-angle-double-right"></i>
                                    Blogs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="https://www.filmkar.com/talent/browse"><i
                                        class="fa fa-angle-double-right"></i> Browse Talent</a></li>
                            <li><a href="https://www.filmkar.com/jobs"><i class="fa fa-angle-double-right"></i>
                                    Jobs</a></li>
                            <li><a href="https://www.filmkar.com/events"><i
                                        class="fa fa-angle-double-right"></i> Events</a></li>
                            <li><a href="https://www.filmkar.com/movies"><i
                                        class="fa fa-angle-double-right"></i> Movies</a></li>
                            <li><a href="https://www.filmkar.com/organisations"><i
                                        class="fa fa-angle-double-right"></i> Organisations</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="https://www.filmkar.com/privacy-policy"><i
                                        class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
                            <li><a href="https://www.filmkar.com/terms-and-conditions"><i
                                        class="fa fa-angle-double-right"></i> Terms and Conditions</a></li>
                            <li><a href="https://www.filmkar.com/contact"><i
                                        class="fa fa-angle-double-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4>Stay Connected</h4>
                        <div class="f-social-box" style="margin-left: -2px;">
                            <ul>
                                <li><a href="https://www.facebook.com" target="_blank"><i
                                            class="fab fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li><a href="Linkedin" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="Twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright text-center">
                    <p>Copyright © 2021 All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="myModalLabel1">
            <div class="modal-body1">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs  " role="tablist"
                    style="margin:10px auto 30px;margin-left: 105px;border: none; border-radius: 6px;">
                    <li class="nav-item active"> <a class="nav-link" data-toggle="tab" href="#employer"
                            role="tab" style="border-radius: 7px;  "> <i class="ti-user"></i> Login as
                            Talent</a> </li>

                    <li class="nav-item" style="margin-left: 10px;"> <a class="nav-link" data-toggle="tab"
                            href="#candidate" role="tab" style="border-radius: 7px;"> <i
                                class="fa-solid fa-building"></i> Login as Organisation</a> </li>
                </ul>
                <!-- Nav tabs -->
                <!-- Tab panels -->
                <div class="tab-content">
                    <!-- Employer Panel 1-->
                    <div class="tab-pane fade in show active" id="employer" role="tabpanel"
                        style="backgound-color:red;">
                        <form action="https://www.filmkar.com/checklogintelent" method="post" id="login_telent">
                            <!-- <form  method="POST"  id="login_telent"> -->
                            <input type="hidden" name="_token" value="2BkIkzbr1eMtVTlXqbhAHxCuACd4kAdCOYavxCiY">
                            <p style="color:red">Login as Talent</p>
                            <p id="msg_telent"></p>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Enter your email address or usernames" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" required> 
                            </div>
                            <div class="form-group"> <span class="custom-checkbox"  style="color:black">
                                    <input type="checkbox" id="4" >
                                    <label for="4"></label>
                                    Remember Me </span> <a href="#" id="forgot_telent" title="Forget"
                                    class="fl-right">Forgot Password?</a>

                            </div>
                            <a href="https://www.filmkar.com/register" id="forgot_telent" title="Forget"
                                class="fl-right" style="margin-bottom: 10px;">Not yet Registered.Register
                                now</a>
                            <div class="form-group text-center">
                                <button type="submit" id="btn_login_telent"
                                    class="btn theme-btn full-width btn-m"  style="color:red !important; border:1px solid red ">Login</button>
                                <!-- <input type="submit" id="login_telent" class="btn theme-btn full-width btn-m" value="LogIn"> -->
                            </div>
                        </form>
                    </div>
                    <!--/.Panel 1-->

                    <!-- Candidate Panel 2-->
                    <div class="tab-pane fade" id="candidate" role="tabpanel">
                        <form action="https://www.filmkar.com/checkloginorganize" method="post"
                            id="form_login_organize">
                            <!-- <form  method="post" > -->
                            <input type="hidden" name="_token" value="2BkIkzbr1eMtVTlXqbhAHxCuACd4kAdCOYavxCiY">
                            <p style="color:red">Login as Organisation</p>
                            <p id="msg_organize"></p>
                            <div class="form-group">
                                <input type="text" name="email" id="email2" class="form-control"
                                    placeholder="Enter your email address or username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password2" class="form-control"
                                    placeholder="Password">
                            </div>
                            <div class="form-group"> <span class="custom-checkbox">
                                    <input type="checkbox" id="44">
                                    <label for="44"></label>
                                    Remember Me </span> <a href="#" id="forgot_organize" title="Forget"
                                    class="fl-right">Forgot Password?</a>
                            </div>
                            <a href="https://www.filmkar.com/register-organisation" id="forgot_telent"
                                title="Forget" class="fl-right" style="margin-bottom: 10px;">Not yet
                                Registered.Register now</a>
                            <div class="form-group text-center">
                                <button type="submit" id="btn_login_organize"
                                    class="btn theme-btn full-width btn-m">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="telent-forgot" role="tabpanel">
                        <form action="https://www.filmkar.com/telentforgotpassword" method="post"
                            id="telent_forgot_form">
                            <input type="hidden" name="_token" value="2BkIkzbr1eMtVTlXqbhAHxCuACd4kAdCOYavxCiY">
                            <h2 class="text-center">Forgot Password</h2>
                            <p id="msg_telent_forgot" style="color:red;"></p>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" required class="form-control"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" id="telentforgot" class="btn theme-btn full-width btn-m"
                                    value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="organize-forgot" role="tabpanel">
                        <form action="https://www.filmkar.com/organizeforgotpassword" method="post"
                            id="organize_forgot_form">
                            <input type="hidden" name="_token" value="2BkIkzbr1eMtVTlXqbhAHxCuACd4kAdCOYavxCiY">
                            <h2 class="text-center">Forgot Password</h2>
                            <p id="msg_organize_forgot" style="color:red;"></p>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email2" required class="form-control"
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" id="organizeforgot" class="btn theme-btn full-width btn-m"
                                    value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tab panels -->

            </div>
        </div>
    </div>
</div>

<!--<div><a href="#"><img src="assets/img/page.png" alt="Scroll Up" class="scrollup"></a></div>-->
<button class="chatbot-toggler">
    <span class="material-symbols-rounded">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
</button>
<div class="chatbot">
    <header>
        <h2 style="color:white;margin: 3px;text-align: center;">FILMKAR</h2>
        <span class="close-btn material-symbols-outlined">close</span>
    </header>
    <ul class="chatbox">
        <li class="chat incoming">
            <span class="material-symbols-outlined">smart_toy</span>
            <p>Hi there 👋<br>How can I help you today?</p>
        </li>
    </ul>
    <div class="chat-input">
        <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
        <span id="send-btn" class="material-symbols-rounded">send</span>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Jquery js-->
    <script src="public/modernizr-3.5.0.js"></script>
    <script src="public/jquery-3.3.1.min.js"></script>
    <script src="public/popper.min.js"></script>
    <script src="public/video.popup.js"></script>
    <script src="public/bootstrap.min.js"></script>
    <script src="public/owl.carousel.min.js"></script>
    <script src="public/menumaker.js"></script>
    <script src="public/swiper.min.js"></script>
    <script src="public/jquery-ui.min.js"></script>
    <script src="public/main.js"></script>


<!--<script src="assets/js/custom.js"></script> -->

<script>
    $(document).ready(function () {
        $("#browseTalentLink").click(function (e) {
            var windowWidth = $(window).width();
            if (windowWidth <= 992) {
                e.preventDefault();
                $("#talentDropdownMenu").toggle();
            }
        });
        $("#registertoggle").click(function (e) {
            var windowWidth = $(window).width();
            if (windowWidth <= 992) {
                e.preventDefault();
                $("#registerDropdownMenu").toggle();
            }
        });
    });

    $(document).ready(function () {
        "use strict";
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
        $('.scrollup').click(function () {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    });
</script>

<script>
    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const closeBtn = document.querySelector(".close-btn");
    const chatbox = document.querySelector(".chatbox");
    const chatInput = document.querySelector(".chat-input textarea");
    const sendChatBtn = document.querySelector(".chat-input span");

    let userMessage = null; // Variable to store user's message
    const API_KEY = "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"; // Paste your API key here
    const inputInitHeight = chatInput.scrollHeight;

    const createChatLi = (message, className) => {
        // Create a chat <li> element with passed message and className
        const chatLi = document.createElement("li");
        chatLi.classList.add("chat", `${className}`);
        let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
        chatLi.innerHTML = chatContent;
        chatLi.querySelector("p").textContent = message;
        return chatLi; // return chat <li> element
    }

    const generateResponse = (chatElement) => {
        const API_URL = "https://api.openai.com/v1/chat/completions";
        const messageElement = chatElement.querySelector("p");

        // Define the properties and message for the API request
        const requestOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${API_KEY}`
            },
            body: JSON.stringify({
                model: "gpt-3.5-turbo",
                messages: [{ role: "user", content: userMessage }],
            })
        }

        // Send POST request to API, get response and set the reponse as paragraph text
        fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
            messageElement.textContent = data.choices[0].message.content.trim();
        }).catch(() => {
            messageElement.classList.add("error");
            messageElement.textContent = "Oops! Something went wrong. Please try again.";
        }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
    }

    const handleChat = () => {
        userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
        if (!userMessage) return;

        // Clear the input textarea and set its height to default
        chatInput.value = "";
        chatInput.style.height = `${inputInitHeight}px`;

        // Append the user's message to the chatbox
        chatbox.appendChild(createChatLi(userMessage, "outgoing"));
        chatbox.scrollTo(0, chatbox.scrollHeight);

        setTimeout(() => {
            // Display "Thinking..." message while waiting for the response
            const incomingChatLi = createChatLi("Thinking...", "incoming");
            chatbox.appendChild(incomingChatLi);
            chatbox.scrollTo(0, chatbox.scrollHeight);
            generateResponse(incomingChatLi);
        }, 600);
    }

    chatInput.addEventListener("input", () => {
        // Adjust the height of the input textarea based on its content
        chatInput.style.height = `${inputInitHeight}px`;
        chatInput.style.height = `${chatInput.scrollHeight}px`;
    });

    chatInput.addEventListener("keydown", (e) => {
        // If Enter key is pressed without Shift key and the window 
        // width is greater than 800px, handle the chat
        if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
            e.preventDefault();
            handleChat();
        }
    });

    sendChatBtn.addEventListener("click", handleChat);
    closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
    chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
</script>
</body>

</html>
