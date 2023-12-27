<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title')</title>
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
<div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('admin/dashboard')}}">
                            <img src="{{asset('admin_assets/logo/Filmkar.png')}}" alt="CoolAdmin" width="100px" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                    <li class="@yield('dashboard_select')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        
                        @if(DB::table('admins')->where('id',Session::get('ADMIN_ID'))->first()->is_superadmin == '1')
                        <li class="@yield('slider')">
                            <a href="{{url('admin/slider')}}">
                                <i class="fas fa-sliders-h"></i>Slider</a>
                        </li>
                        <li class="@yield('language_select')">
                            <a href="{{url('admin/language')}}">
                                <i class="fas fa-language"></i>Language</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/subcategory')}}">
                                <i class="fas fa-list"></i>Sub Category</a>
                        </li>
                        <li class="@yield('admin_select')">
                            <a href="{{url('admin/admins')}}">
                                <i class="fas fa-user"></i>Admins</a>
                        </li>
                        <li class="@yield('setting_select')">
                            <a href="{{url('admin/setting')}}">
                                <i class="fas fa-bolt"></i>Settings</a>
                        </li>
                    
                        @endif
                        <li class="has-sub @yield('user_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Users</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('admin/users/pending')}}">Pendding Users</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/users/approved')}}">Approved Users</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub @yield('organize_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Organize Users</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                
                                <li>
                                    <a href="{{url('admin/organize/pending')}}">Pendding Organize</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/organize/approved')}}">Approved Organize</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="@yield('representers_select')">
                            <a href="{{url('admin/representer')}}">
                                <i class="fas fa-language"></i>Representers</a>
                        </li>
                        <li class="@yield('job_select')">
                            <a href="{{url('admin/job_posts')}}">
                                <i class="fas fa-briefcase"></i>Job Posts</a>
                        </li>
                        <li class="@yield('event_category_select')">
                            <a href="{{url('admin/event_category')}}">
                                <i class="fas fa-briefcase"></i>Event Category</a>
                        </li>
                        <li class="@yield('event_select')">
                            <a href="{{url('admin/event')}}">
                                <i class="fas fa-briefcase"></i>Event</a>
                        </li>
                        <li class="@yield('institute_select')">
                            <a href="{{url('admin/moive')}}">
                                <i class="fas fa-briefcase"></i>Movie</a>
                        </li>
                        <li class="@yield('blog_select')">
                            <a href="{{url('admin/blog')}}">
                                <i class="fas fa-language"></i>Blogs</a>
                        </li>
                        <li class="@yield('page_select')">
                            <a href="{{url('admin/pages')}}">
                                <i class="fas fa-language"></i>Pages</a>
                        </li>
                        
                        <li class="@yield('setting_select')">
                            <a href="{{url('admin/banner')}}">
                                <i class="fas fa-bolt"></i>Banner</a>
                        </li>
                        <li class="@yield('chatbot_select')">
                            <a href="{{url('admin/chatbot')}}">
                                <i class="fas fa-bolt"></i>Chatbot</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{url('admin/dashboard')}}">
                    <img src="{{asset('admin_assets/logo/Filmkar.png')}}" width="100px" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_select')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        @if(DB::table('admins')->where('id',Session::get('ADMIN_ID'))->first()->is_superadmin == '1')
                        <li class="@yield('slider_select')">
                            <a href="{{url('admin/slider')}}">
                                <i class="fas fa-sliders-h"></i>Slider</a>
                        </li>
                        <li class="@yield('state_select')">
                            <a href="{{url('admin/state')}}">
                                <i class="fas fa-globe"></i>State</a>
                        </li>
                        <li class="@yield('city_select')">
                            <a href="{{url('admin/city')}}">
                                <i class="fas fa-globe"></i>City</a>
                        </li>
                        <li class="@yield('language_select')">
                            <a href="{{url('admin/language')}}">
                                <i class="fas fa-language"></i>Language</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/subcategory')}}">
                                <i class="fas fa-list"></i>Sub Category</a>
                        </li>
                        <li class="@yield('admin_select')">
                            <a href="{{url('admin/admins')}}">
                                <i class="fas fa-user"></i>Admins</a>
                        </li>
                        <li class="@yield('setting_select')">
                            <a href="{{url('admin/setting')}}">
                                <i class="fas fa-bolt"></i>Settings</a>
                        </li>
                        @endif
                        <li class="has-sub @yield('user_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Talents  @if(DB::table('users')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('admin/users/pending')}}">Pendding Talents</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/users/approved')}}">Approved Talents</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub @yield('organize_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Organisations @if(DB::table('user_representers')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('admin/organize/pending')}}">Pending Organisation</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/organize/approved')}}">Approved Organisation</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="@yield('representers_select')">
                            <a href="{{url('admin/representer')}}">
                                <i class="fas fa-language"></i>Representers</a>
                        </li>
                        <li class="@yield('job_select')">
                            <a href="{{url('admin/job_posts')}}">
                                <i class="fas fa-briefcase"></i>Job Posts @if(DB::table('job_posts')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                        </li>
                        <li class="@yield('event_category_select')">
                            <a href="{{url('admin/event_category')}}">
                                <i class="fas fa-briefcase"></i>Event Category @if(DB::table('event_categories')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                        </li>
                        <!-- <li class="@yield('event_select')">
                            <a href="{{url('admin/event')}}">
                                <i class="fas fa-briefcase"></i>Event</a>
                        </li> -->
                        <li class="has-sub @yield('event_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Event @if(DB::table('events')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('admin/event/pending?type=0')}}">Pendding Event</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/event/approved?type=1')}}">Approved Event</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="@yield('institute_select')">
                            <a href="{{url('admin/institute')}}">
                                <i class="fas fa-briefcase"></i>Institute</a>
                        </li> -->
                        <li class="has-sub @yield('institute_select')">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Movie @if(DB::table('movies')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('admin/moive/pending?type=0')}}">Pendding Movie</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/moive/approved?type=1')}}">Approved Movie</a>
                                </li>
                            </ul>
                        </li>
                        <li class="@yield('blog_select')">
                            <a href="{{url('admin/blog')}}">
                                <i class="fas fa-language"></i>Blogs @if(DB::table('blogs')->where('is_view','0')->count() > 0) <i class="fa fa-circle" aria-hidden="true" style="color:red;"></i>@endif</a>
                        </li>
                        <li class="@yield('page_select')">
                            <a href="{{url('admin/pages')}}">
                                <i class="fas fa-language"></i>Pages</a>
                        </li>
                        
                        <li class="@yield('setting_select')">
                            <a href="{{url('admin/banner')}}">
                                <i class="fas fa-bolt"></i>Banner</a>
                        </li>
                            <li class="@yield('chatbot_select')">
                            <a href="{{url('admin/chatbot')}}">
                                <i class="fas fa-bolt"></i>Chatbot</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                              
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                           
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{url('admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @section('container')
                        @show
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--<script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>-->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/main.js')}}"></script>
</body>
</html>