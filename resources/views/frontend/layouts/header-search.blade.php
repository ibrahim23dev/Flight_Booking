<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Title -->
    <title>AdbiyasTour Travel Official Site | Travel Deals and More</title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Lato:300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/font-mytravel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/custombox/dist/custombox.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/hs-megamenu/src/hs.megamenu.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/fancybox/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/documentation/assets/vendor/jquery-ui/themes/base/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/documentation/assets/vendor/prism/prism.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/dzsparallaxer/dzsparallaxer.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/vendor/ion-rangeslider/css/ion.rangeSlider.css') }}">

    <!-- CSS MyTravel Template -->
    <link rel="stylesheet" href="{{ url('assets/frontend/css/theme.css') }}">
    <script>
        baseUrl="{{url('')}}"
  </script>
  <style>
      .search-results{

    background-color: #fff;
    max-height: 200px;
    position: absolute;
    z-index: 999;
    width: 100%;
    top: 3.5rem;
    border-radius: 5px;

    }
    .overflow-Class{
    overflow-y: scroll;
    }
    .testing_purpose{

    cursor: pointer;
    padding: 10px 5px 6px 5px;
    border-radius: 0px;

    }
    .testing_purpose h6{
    color: #163c8c;
    font-size: 12px;

    }
    .testing_purpose h6 i{
    color: #163c8c;

    }
    .testing_purpose:hover{
    background-color: rgba(187, 187, 187, 0.89);
    }
    .highlighted {
    color: #101010;
    line-height: 1.45;
    font-weight: 600;
    font-size: 12px !important;
    }
    .radio-buttons input[type="radio"] {
  display: none; /* Hide the actual radio buttons */
}

.radio-buttons label {
  display: inline-block;
  padding: 2px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  cursor: pointer;
  text-align: center;
  user-select: none;
}

.radio-buttons input[type="radio"]:checked + label {
  background-color: #297cbb;
  color: #fff;
}
.disable-element{
display: none;

pointer-events: none;
}
/* spiner css  */
.has-spinner {
position: relative;
}

.has-spinner .spinner {
display: none;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
animation: spinner-rotation 1s infinite linear;
}

.has-spinner.loading .spinner {
display: block;
}

.has-spinner.loading .button-text {
visibility: hidden;
}

.has-spinner .spinner:before {
content: "\f110";
font-family: "Font Awesome 5 Free";
font-weight: 900;
font-size: 18px;
}

@keyframes spinner-rotation {
0% {
  transform: translate(-50%, -50%) rotate(0deg);
}
100% {
  transform: translate(-50%, -50%) rotate(360deg);
}
}

.opacity-0{
    visibility: hidden;
   
}
/* Styles for large screens */
@media screen and (min-width: 768px) {
  .price-element-return {
    margin-top: -50px;
  }
  .price-element-single {
    margin-top: 0;
  }
}

/* Styles for small screens (e.g., mobile devices) */
@media screen and (max-width: 767px) {
  .price-element-return {
   margin-top: -70px;

  }
  .price-element-single {
    margin-top: 0;
  }
}
.w-8{
    width: 8rem; 
}
.login-box {
  
  @media (min-width: 769px) {
      width: 500px;
      margin: 0 auto; 
  }
}
.nav-item-color {

  @media (max-width: 769px) {
      color: #67747c !important;
     
  }
}
.navbar-nav {

    @media (max-width: 769px) {
      padding-left:2rem !important;
     
  }
}
::-webkit-scrollbar {
        width: 10px;
    }
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px lightgray;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #ffc107;
        border-radius: 10px;
    }
        ::-webkit-scrollbar-thumb:hover {
        background: #ffc107;
    }
    /* Media query for small devices */
    @media (max-width: 767px) {
        /* Hide list items where the child div does not have class bg-primary */
        .list-group-item:not(:has(> div.bg-primary)) {
            display: none;
        }
        .d-sm-flex{
            display: flex;
        }
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
      border-radius: 0;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label {
      border-color: #007bff;
      background-color: #007bff;
      color: #fff;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::before {
      border-color: #007bff;
    }

    .custom-radio .custom-control-input:checked~.custom-control-label::after {
      background-color: #007bff;
    }

    .custom-control-input {
      position: absolute;
      clip: rect(0, 0, 0, 0);
    }
    .custom-radio{
        padding: .3rem;
        margin:.2rem;
    }
    .btn-group-toggle{
        display: flex;
        flex-wrap: wrap;

    }
    .btn-group-toggle .custom-control{
        font-size: 12px;
    }
  </style>
    </head>
    <body style="background-color: #1a0b24">
        <!-- ========== HEADER ========== -->
        <header id="header" class="u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl" data-header-fix-moment="500" data-header-fix-effect="slide" >
            <div class="u-header__section u-header__shadow-on-show-hide py-4 py-xl-0" style="background-color: #1a0b24;">
               

                <div id="logoAndNav" class="container-fluid py-1 py-xl-0">
                    <!-- Nav -->
                    <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space">
                        <!-- My Account -->
                        <a href="#" class="text-white d-xl-none font-size-20 scroll-icon">
                            <i class="flaticon-user"></i>
                        </a>
                        <!-- End My Account -->
  
                        <!-- Logo -->
                        <a class="navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5" href="{{ url('/') }}" aria-label="MyTravel">
                           
                            <span class="u-header__navbar-brand-text">
                              <img src="{{ url('storage/images/site_identity/'.getSiteIdentity()->logo_image) }}" width="170px" alt="" style="margin-left:28% !important">
                            </span>
                        </a>
                       
  
                        <!-- Responsive Toggle Button -->
                        <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--white order-2 ml-3" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                            <span id="hamburgerTrigger" class="u-hamburger__box">
                                <span class="u-hamburger__inner"></span>
                            </span>
                        </button>
                        <!-- End Responsive Toggle Button -->
  
                        <!-- Navigation -->
                        <div id="navBar" class="navbar-collapse u-header__navbar-collapse collapse order-2 order-xl-0 pt-4 p-xl-0 position-relative mx-n3 mx-xl-0">
                            <ul class="navbar-nav u-header__navbar-nav">
                               
                                  <!-- About -->
                              <li class="nav-item u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                                  <a id="yachtMenu" class="nav-link u-header__nav-link  u-header__nav-link-border text-white" href="https://wa.me/+441213181100" aria-haspopup="true" aria-expanded="false" > <span class="fab fa-whatsapp mr-2"> </span>Chat With Us</a>
                                  
                              </li>
                              <!-- End About -->
                                <!-- About -->
                                <li class="nav-item u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                                    <a id="yachtMenu" class="nav-link u-header__nav-link  u-header__nav-link-border text-white" href="{{ route('/about') }}" aria-haspopup="true" aria-expanded="false" >About Us</a>
                                   
                                </li>
                                <!-- End About -->
  
                                <!-- About -->
                                <li class="nav-item u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                                  <a id="yachtMenu" class="nav-link u-header__nav-link  u-header__nav-link-border text-white" href="{{ route('/contact') }}" aria-haspopup="true" aria-expanded="false" >Contact Us</a>
                                 
                                </li>
  
                      
                                <ul class="list-inline mb-0 mr-2 pr-1">
                                    @foreach(json_decode(getSiteIdentity()->social_links) as $key => $value)
                                      <li class="list-inline-item ">
                                          <a class="btn btn-sm btn-icon btn-pill btn-white btn-soci transition-3d-hover nav-item-color" href="{{ $value->social_url }}" target="_blank">
                                              <span class="{{ getSocialMediaIconClass($value->social_name) }} btn-icon__inner"></span>
                                          </a>
                                      </li>
                                  @endforeach
                              </ul>
  
                              <li class="nav-item u-header__nav-item" data-event="hover" data-animation-in="slideInUp" data-animation-out="fadeOut">
                                 
                                 
                                  <a id="hotelMenu" class="nav-link  u-header__nav-link u-header__nav-link-border font-size-24  font-weight-lighter text-white" href="tel:01213181100" aria-haspopup="true" aria-expanded="false" aria-labelledby="hotelSubMenu">
                                      <i class="fas fa-phone " style="transform: rotate(90deg)"></i>
                                      <span style="margin-bottom: 1px">0121 318 1100</span>
                                  </a>
                                 
                                </li>
  
                              <li class="nav-item u-header__nav-item" data-event="hover" data-animation-in="slideUp" data-animation-out="fadeOut">
  
                                  @if (!auth()->user())
                                
                                  <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                                      <a id="signUpDropdownInvoker"  href="javascript:;" class="d-flex align-items-center text-white  py-3 nav-item-color" aria-controls="signUpDropdown" aria-haspopup="true" aria-expanded="true" data-unfold-event="click" data-unfold-target="#signUpDropdown" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="false" data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                          <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                                          <span class="d-inline-block font-size-14 mr-1">Sign in</span>
                                      </a>
                                      <div id="signUpDropdown" class="dropdown-menu dropdown-unfold dropdown-menu-right py-0 mt-0 login-box" aria-labelledby="signUpDropdownInvoker" >
                                          <div class="card rounded-xs">
                                              <form class="js-validate" novalidate="novalidate" method="post" action="{{ route('login') }}" id="login-form">
                                                @csrf
                                                  <!-- Login -->
                                                  <div id="login" style="opacity: 1;" data-target-group="idForm" class="animated fadeIn">
                                                      <!-- Header -->
                                                      <div class="card-header text-center">
                                                          <h3 class="h5 mb-0 font-weight-semi-bold">Login</h3>
                                                      </div>
                                                      <div class="message-box text-center"></div>
                                                      <!-- End Header -->
                                                      <div class="card-body pt-3 pb-4">
                                                          <!-- Form Group -->
                                                          <div class="form-group pb-1">
                                                              <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                  <label class="sr-only" for="signinSrEmail">Email</label>
                                                                  <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                      <input type="email" class="form-control" name="email" id="signinSrEmail" placeholder="Email Or Username" aria-label="Email Or Username" aria-describedby="signinEmail" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                      <div class="input-group-append">
                                                                          <span class="input-group-text" id="signinEmail">
                                                                              <span class="far fa-envelope font-size-20"></span>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Form Group -->
                                                          <!-- Form Group -->
                                                          <div class="form-group pb-1">
                                                              <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                  <label class="sr-only" for="signinSrPassword">Password</label>
                                                                  <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                      <input type="password" class="form-control" name="password" id="signinSrPassword" placeholder="Password" aria-label="Password" aria-describedby="signinPassword" required="" data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                      <div class="input-group-prepend">
                                                                          <span class="input-group-text" id="signinPassword">
                                                                              <span class="flaticon-password font-size-20"></span>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Form Group -->
                                                          <div class="mb-3 pb-1">
                                                              <button type="submit" class="btn btn-md btn-block btn-blue-1 rounded-xs font-weight-bold transition-3d-hover has-spinner"><span class="button-text">Login</span></button>
                                                          </div>
                                                          <div class="d-flex justify-content-between mb-1">
                                                              <div class="custom-control custom-checkbox custom-control-inline">
                                                                  <input type="checkbox" id="customCheckboxInline1" name="customCheckboxInline1" class="custom-control-input">
                                                                  <label class="custom-control-label" for="customCheckboxInline1">Remember me</label>
                                                              </div>
                                                              <a class="js-animation-link text-primary font-size-14" href="javascript:;" data-target="#forgotPassword" data-link-group="idForm" data-animation-in="fadeIn"><u>Forgot Password?</u></a>
                                                          </div>
                                                          
                                                          <hr>
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <a href="{{ route('login.provider', ['provider' => 'google']) }}

                                                                "> <img src="{{ asset('assets/frontend/img/web_google.svg') }}" alt=""></a>

                                                                <a href="{{ route('login.provider', ['provider' => 'facebook']) }}

                                                                    "> <img src="{{ asset('assets/frontend/img/web_facebook.png') }}" alt="" style="width: 10rem"></a>

                                                               
                                                        </div>
                                                      </div>
                                                      <div class="card-footer p-0">
                                                        
                                                          <div class="card-footer__bottom p-4 text-center font-size-14">
                                                              <span class="text-gray-1">Do not have an account?</span>
                                                              <a class="js-animation-link font-weight-bold" href="javascript:;" data-target="#signup" data-link-group="idForm" data-animation-in="fadeIn">Sign Up</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </form>
        
                                                  <!-- End Login -->
        
                                                <form action="{{ route('register') }}" method="post" id="signup-form">
                                                    @csrf
                                                  <!-- Signup -->
                                                  <div id="signup" style="opacity: 0; display: none;" data-target-group="idForm">
                                                      <!-- Header -->
                                                      <div class="card-header text-center">
                                                          <h3 class="h5 mb-0 font-weight-semi-bold">Register</h3>
                                                      </div>
        
                                                      <div class="message-box text-center"></div>
        
                                                      <!-- End Header -->
                                                      <div class="card-body pt-5 pb-4">
                                                          <ul class="nav nav-default nav-pills nav-white nav-justified nav-rounded-pill font-weight-medium px-6 pb-5" role="tablist">
                                                              <li class="nav-item">
                                                                  <a class="js-animation-link font-weight-bold text-right" href="javascript:;" data-target="#login" data-link-group="idForm" data-animation-in="fadeIn">Return To Login</a>
                                                              </li>
                                                            
                                                          </ul>
                                                         
                                                          <div class="tab-content">
                                                              <div class="tab-pane fade active show" id="pills-one-code-sample" role="tabpanel" aria-labelledby="pills-one-code-sample-tab">
                                                                 
        
                                                                  <div class="form-group pb-1">
                                                                      <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                          <label class="sr-only" for="name">Full Name</label>
                                                                          <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                              <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" aria-label="Full Name" aria-describedby="normalname" required="" data-msg="Please enter a valid name." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                              <div class="input-group-append">
                                                                                  <span class="input-group-text" id="normalname">
                                                                                      <span class="flaticon-browser-1 font-size-20"></span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <!-- End Form Group -->
        
                                                                  <!-- Form Group -->
                                                                  <div class="form-group pb-1">
                                                                      <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                          <label class="sr-only" for="signupSrEmail">Email</label>
                                                                          <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                              <input type="email" class="form-control" name="email" id="signupSrEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmail" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                              <div class="input-group-append">
                                                                                  <span class="input-group-text" id="signupEmail">
                                                                                      <span class="far fa-envelope font-size-20"></span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <!-- End Form Group -->
        
                                                                  <!-- Form Group -->
                                                                  <div class="form-group pb-1">
                                                                      <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                          <label class="sr-only" for="signupSrPassword">Password</label>
                                                                          <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                              <input type="password" class="form-control" name="password" id="signupSrPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPassword" required="" data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                              <div class="input-group-prepend">
                                                                                  <span class="input-group-text" id="signupPassword">
                                                                                      <span class="flaticon-password font-size-20"></span>
                                                                                  </span>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <!-- End Form Group -->
                                                                  <div class="mb-3 pb-1">
                                                                      <button type="submit" class="btn btn-md btn-block btn-blue-1 rounded-xs font-weight-bold transition-3d-hover has-spinner"><span class="button-text">Register</span></button>
                                                                  </div>
                                                                  <div class="d-flex justify-content-between mb-1">
                                                                      <div class="custom-control custom-checkbox custom-control-inline">
                                                                          <input type="checkbox" id="termsAndPrivacy" name="termsAndPrivacy" class="custom-control-input">
                                                                          <label class="custom-control-label" for="termsAndPrivacy">I have read and accept the <a href="#">Terms and Privacy Policy</a></label>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          
                                                          </div>
                                                      </div>
                                                     
                                                  </div>
                                                </form>
                                                  <!-- End Signup -->
                                                <form action="">
                                                  <!-- Forgot Passwrd -->
                                                  <div id="forgotPassword" style="opacity: 0; display: none;" data-target-group="idForm">
                                                      <!-- Header -->
                                                      <div class="card-header bg-light text-center py-3 px-5">
                                                          <h3 class="h6 mb-0 font-weight-semi-bold">Recover password</h3>
                                                      </div>
                                                      <!-- End Header -->
                                                      <div class="card-body px-10 py-5">
                                                          <!-- Form Group -->
                                                          <div class="form-group">
                                                              <div class="js-form-message js-focus-state border border-width-2 border-color-8 rounded-sm">
                                                                  <label class="sr-only" for="recoverSrEmail">Your email</label>
                                                                  <div class="input-group input-group-tranparent input-group-borderless input-group-radiusless">
                                                                      <input type="email" class="form-control" name="email" id="recoverSrEmail" placeholder="Your email" aria-label="Your email" aria-describedby="recoverEmail" required="" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                                                                      <div class="input-group-append">
                                                                          <span class="input-group-text" id="recoverEmail">
                                                                              <span class="far fa-envelope font-size-20"></span>
                                                                          </span>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- End Form Group -->
                                                          <div class="mb-2">
                                                              <button type="submit" class="btn btn-sm btn-block btn-blue-1 rounded-xs font-weight-bold transition-3d-hover">Recover Password</button>
                                                          </div>
                                                          <div class="text-center font-size-14">
                                                              <span class="text-gray-1">Remember your password?</span>
                                                              <a class="js-animation-link font-weight-bold" href="javascript:;" data-target="#login" data-link-group="idForm" data-animation-in="fadeIn">Log In</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <!-- End Forgot Passwrd -->
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                  @else 
                                 
                                  @can('access dashboard')
                                   
                                  <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white  py-3 nav-item-color" >
                                        <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                                        <span class="d-inline-block font-size-14 mr-1">Dashboard</span>
                                    </a> 
                                </div>
                                @endcan  
  
                                @cannot('access dashboard')
  
                                <div class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                                  <a href="{{ route('logout') }}" class="d-flex align-items-center text-white  py-3 nav-item-color" >
                                      <span>{{ auth()->user()->name }}</span> -
                                      <span class="d-inline-block font-size-14 mr-1">Logout</span>
                                  </a> 
                              </div>
  
                                @endcannot
  

                               @endif   
  
                              </li>
                              <!-- End About -->
  
                            </ul>
                        </div>
                        <!-- End Navigation -->
  
                       
                      
                    </nav>
                    <!-- End Nav -->
                </div>
            </div>
        </header>