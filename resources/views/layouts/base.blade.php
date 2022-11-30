<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8" />
        <title>{{  Str::title(str_replace('-', ' ', Request::segment(2))) }} | {{ config('app.name', 'Getwell Pharmacy') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/admin/assets/images/favicon.png')}}">

          <!-- third party css -->
        <link href="{{ asset('assets/admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <!-- App-dark css -->
        <link href="{{ asset('assets/admin/assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled"/>
        <link href="{{ asset('assets/admin/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled"/>

        <!-- icons -->
        <link href="{{ asset('assets/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .dt-buttons{
                display:none;
            }
        </style>
        @livewireStyles
    </head>

    <!-- body start -->
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

        <!-- Begin page -->
        <div id="wrapper">


            <!-- Topbar Start -->
            <div class="navbar-custom">
                    <ul class="list-unstyled topnav-menu float-end mb-0">

                        <li class="d-none d-lg-block">
                            <form class="app-search">
                                <div class="app-search-box">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search..." id="top-search">
                                        <button class="btn input-group-text" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
    
                        <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
            
                        {{--<li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">New user registered.
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>
    
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-secondary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>--}}
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                @if (Auth::user()->name) 
                                    <img src="{{ asset('assets/admin/assets/images/profiles')}}/{{ Auth::user()->name }}" alt="{{ Auth::user()->name}}" class="rounded-circle">
                                @else
                                     <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name}}" class="rounded-circle">
                                @endif
                                <span class="pro-user-name ms-1">
                                    {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="contacts-profile.html" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>
    
                                <!-- item-->
                                <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>
    
                                <div class="dropdown-divider"></div>
    
                                <!-- item-->
                                <a href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form') .submit();" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" method="POST" action="{{route('logout')}}">
                                  @csrf
                                </form>
                            </div>
                        </li>
    
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>
    
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="/" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/assets/images/getwell-logo.svg')}}" alt="{{ config('app.name', 'Getwell Pharmacy') }}" width="142" height="45">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/assets/images/getwell-logo.svg')}}" alt="{{ config('app.name', 'Getwell Pharmacy') }}" width="142" height="45">
                            </span>
                        </a>
                        <a href="/" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/admin/assets/images/getwell-logo.svg')}}" alt="{{ config('app.name', 'Getwell Pharmacy') }}" width="142" height="45">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/admin/assets/images/getwell-logo.svg')}}" alt="{{ config('app.name', 'Getwell Pharmacy') }}" width="142" height="45">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                        <li>
                            <button class="button-menu-mobile disable-btn waves-effect">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
    
                        <li>
                            <h4 class="page-title-main">{{  Str::title(str_replace('-', ' ', Request::segment(2))) }}</h4>
                        </li>
            
                    </ul>

                    <div class="clearfix"></div> 
               
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                     <!-- User box -->
                    <div class="user-box text-center">
                        @if (Auth::user()->name) 
                                    <img src="{{ asset('assets/admin/assets/images/profiles')}}/{{ Auth::user()->name }}" alt="{{ Auth::user()->name}}" class="rounded-circle img-thumbnail avatar-md">
                                @else
                                     <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name}}" class="rounded-circle">
                                @endif
                            <div class="dropdown">
                                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false">{{ Auth::user()->name}}</a>
                                <div class="dropdown-menu user-pro-dropdown">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-user me-1"></i>
                                        <span>My Account</span>
                                    </a>
        
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>Settings</span>
                                    </a>
        
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-lock me-1"></i>
                                        <span>Lock Screen</span>
                                    </a>
        
                                    <!-- item-->
                                    <a href="{{route('logout')}}" onclick="event.preventDefault();  document.getElementById('logout-form') .submit();" class="dropdown-item notify-item">
                                        <i class="fe-log-out me-1"></i>
                                        <span>Logout</span>
                                    </a>
                                     <form id="logout-form" method="POST" action="{{route('logout')}}">
                                        @csrf
                                     </form>
                                </div>
                            </div>

                        <p class="text-muted left-user-info">Admin Head</p>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted left-user-info">
                                    <i class="mdi mdi-cog"></i>
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="mdi mdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                
                            <li>
                                <a href="/dashboard">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span class="badge bg-success rounded-pill float-end"></span>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="#slider" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Sliders </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="slider">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/hero">All Sliders</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-hero">Add Slider</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#feature" data-bs-toggle="collapse">
                                    <i class="mdi mdi-clipboard-outline"></i>
                                    <span> Features </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="feature">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/features">All Features</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-feature">Add Feature</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#about" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> About us </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="about">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/about-us">About us</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-about">Add About us</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#department" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Department </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="department">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/department">All Department</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-department">Add Department</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#appointment" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Appointment </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="appointment">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/appointment">All Appointment</a>
                                        </li>
                                        <li>
                                            <a href="/admin/closed">Closed Appointment</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#team" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Team </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="team">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/team">All Team</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-team">Add Team</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#gallery" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Gallery </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="gallery">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/gallery">All Galleries</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-gallery">Add Gallery</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#before" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span>  Before After </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="before">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/before-after"> Before After</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-before">Add  Before After</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#testimonial" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span>  Testimonial </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="testimonial">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/testimonial"> All Testimonial</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-testimonial">Add  Testimonial</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#funfact" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span>  FunFact </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="funfact">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/funfact">All FunFact</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-funfact">Add  FunFact</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#faq" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> FAQ </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="faq">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/faq"> All FAQ</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-faq">Add  FAQ</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#category" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Category </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="category">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/category"> All Categories</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-category">Add  Category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#news" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> News letters</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="news">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/news"> All News letters</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#blog" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Blog </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="blog">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/blog"> All Blog</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-blog">Add  Blog</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#logo" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Logos </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="logo">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/logo"> All Logos</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-logo">Add  Logo</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                             <li>
                                <a href="#contact" data-bs-toggle="collapse">
                                    <i class="mdi mdi-book-open-page-variant-outline"></i>
                                    <span> Contact </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="contact">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/contact"> All Contact</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-contact">Add  Contact</a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-contact-form">Contact Form</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                    {{ $slot }}
                    </div><!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Getwell pharmacy 
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="{{ asset('assets/admin/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/feather-icons/feather.min.js')}}"></script>

        <!-- knob plugin -->
        <script src="{{ asset('assets/admin/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets/admin/assets/libs/morris.js06/morris.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/raphael/raphael.min.js')}}"></script>
  
        <!-- Dashboar init js-->
        <script src="{{ asset('assets/admin/assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/admin/assets/js/app.min.js')}}"></script>
        <!-- third party js -->
        <script src="{{ asset('assets/admin/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ asset('assets/admin/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="{{ asset('assets/admin/assets/js/pages/datatables.init.js')}}"></script>
        @livewireScripts
    </body>
</html>