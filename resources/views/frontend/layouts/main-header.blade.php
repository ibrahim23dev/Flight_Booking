<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Keywords" content="Booking, Flight booking, cheap air tickets, domestic flights, international flights,  Hotels, Travel in USA, Holiday Packages, airline ticket, discount tickets, Air Tickets">
    <meta name="description" content="Get best travel deals for flights, hotels, holidays and visa services. Flight booking, cheap air tickets of domestic & international airlines with AdbiyasTour">
    <meta name="author" content="AdbiyasTour">
    <!--<link rel="icon" href="favicon.ico" type="image/x-icon">-->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdbiyasTour Travel Official Site | Travel Deals and More</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ url('images/favicon.ico') }}">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&amp;family=Quicksand:wght@300;400;500;600;700&amp;family=Special+Elite&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Vampiro+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&amp;display=swap" rel="stylesheet">

    <!-- Icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icons -->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/css/animate.css') }}" rel="stylesheet" />
    <!-- Date-time picker css -->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/css/datepicker.min.css') }}" rel="stylesheet" />
    <!--Slick slider css-->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/dist/assets/plugins/slick.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/dist/assets/plugins/slick-theme.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap css -->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/dist/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/lang-picker/js-lang-picker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <!-- Themify icon -->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/common/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- Theme css -->
    <link href="{{ asset('assets/frontend/Content/themes/a4atripploytrv/dist/assets/plugins/color1.min.css') }}" rel="stylesheet" />
    <!--home css-->
    <link href="{{ asset('assets/frontend/Content/tripploytrv/home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/tripploytrv/home/css/responsive.css') }}" rel="stylesheet" />
    <!--new css-->
    <link href="{{ asset('assets/frontend/Content/themes/home/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/home/css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/magnific/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/home/css/style.css') }}" rel="stylesheet" />
    <!--external css-->
    <link href="{{ asset('assets/frontend/Content/lib/ionrangeslider/ion.rangeSlider.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/ladda/ladda-themeless.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/sweetalert2/sweetalert2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/themes/custom/custom.css') }}" rel="stylesheet" />

    

    <link href="{{ asset('assets/frontend/Content/lib/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/easy-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/easy-autocomplete/flags.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/frontend/Content/lib/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/Content/lib/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    @yield('styles')
    <script>
              baseUrl="{{url('')}}"
    </script>
    <style>
        
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: contain;
                object-position: top right;
            }

        @media (min-width: 767px) {
            header.light_header {
                position: absolute;
                z-index: 3;
                background: transparent;
                border: none !important;
                box-shadow: none !important;
            }
        }

        header.fixed-header {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            background: #fff;
            z-index: 9;
            box-shadow: 0 2px 4px 0 #dedede !important;
        }
        .search-results{

        background-color: #fff;
        max-height: 200px;
        position: absolute;
        z-index: 999;
        /* width: 100%;
        top: 3.5rem; */
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
        /* font-size: 12px !important; */
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

        .br-5{
        border-radius: 5px;
        }
        .main-color{
            color: var(--main-color);
        }
    </style>

</head>

<!-- Body Start -->
<body>
    <!-- Navbar Section Start -->
    <section class="pt-0">
        <nav class="navbar navbar-expand-md bg-body-tertiary custom-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('') }}">
                    <img src="{{ url('storage/images/site_identity/'.getSiteIdentity()->logo_image) }}" alt="" class="nav-logo" />
                </a>
                <button class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                             <a aria-label="Chat on WhatsApp" href="https://wa.me/+13476986704"> <img style="width: 160px;" alt="Chat on WhatsApp" src="{{ url('WhatsAppButtonGreenSmall.png') }}" />
<a />
                             
                             </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <span class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         version="1.1"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24"
                                         height="24"
                                         x="0"
                                         y="0"
                                         viewBox="0 0 512 512"
                                         style="enable-background: new 0 0 512 512"
                                         xml:space="preserve"
                                         class="">
                                    <g>
                                    <path d="M503.765 274.64a71.442 71.442 0 0 1-68.23 74.36q-1.658.077-3.31.077a70.061 70.061 0 0 1-14.935-1.621 192.414 192.414 0 0 1-130.067 85.23 41.593 41.593 0 1 1-1.328-30.209A161.532 161.532 0 0 0 418.05 243.188c0-89.355-72.695-162.05-162.05-162.05S93.95 153.833 93.95 243.188a162.016 162.016 0 0 0 20.513 78.934 9.831 9.831 0 0 1 1.017 2.544 14.96 14.96 0 0 1-8.321 18.873 70.639 70.639 0 0 1-27.412 5.531q-1.662 0-3.331-.077a71.434 71.434 0 0 1-68.181-74.36c.319-7.535.141-14.258-.033-20.759-.162-6.121-.331-12.451-.053-19.056a71.5 71.5 0 0 1 71.782-68.287C109.587 98.679 177.34 51.138 256 51.138s146.414 47.541 176.07 115.394a71.443 71.443 0 0 1 71.78 68.275c.279 6.615.111 12.944-.053 19.065-.172 6.502-.351 13.228-.032 20.768Zm-121.96-31.452a125.854 125.854 0 0 1-158.119 121.6l-50.921 29.407a15 15 0 0 1-21.99-16.873l13.014-48.548a126.293 126.293 0 0 1-33.589-85.586c0-69.388 56.431-125.834 125.8-125.834S381.805 173.8 381.805 243.188Zm-160.78 0a15 15 0 0 0-15-15H206a15 15 0 1 0 15.028 15Zm49.978 0a14.2 14.2 0 0 0-.08-1.47 14 14 0 0 0-.219-1.46 11.356 11.356 0 0 0-.361-1.42c-.139-.47-.309-.93-.489-1.39s-.4-.89-.63-1.32a14.425 14.425 0 0 0-.75-1.26 14.625 14.625 0 0 0-.881-1.19 12.625 12.625 0 0 0-.989-1.09c-.34-.35-.71-.68-1.09-1-.381-.3-.781-.6-1.191-.87a14.408 14.408 0 0 0-1.259-.75c-.431-.23-.88-.44-1.331-.63a13.277 13.277 0 0 0-1.379-.49 13.138 13.138 0 0 0-2.88-.58 15.38 15.38 0 0 0-4.4.21 14.206 14.206 0 0 0-1.429.37 13.131 13.131 0 0 0-1.38.49c-.45.19-.9.4-1.33.63s-.85.48-1.261.75a14.59 14.59 0 0 0-2.279 1.87 12.813 12.813 0 0 0-.991 1.09 14.486 14.486 0 0 0-.869 1.19 14.272 14.272 0 0 0-.76 1.26 13.431 13.431 0 0 0-.621 1.32 14.706 14.706 0 0 0-.5 1.39c-.139.46-.259.94-.359 1.42a14.279 14.279 0 0 0-.221 1.46c-.049.49-.07.98-.07 1.47s.021.99.07 1.48a14.517 14.517 0 0 0 .221 1.45c.1.48.22.96.359 1.43a14.524 14.524 0 0 0 .5 1.38 13.6 13.6 0 0 0 .621 1.33c.229.43.49.85.76 1.26a14.327 14.327 0 0 0 .869 1.18 14.682 14.682 0 0 0 .991 1.1c.35.34.71.68 1.1.99a12.8 12.8 0 0 0 1.179.87c.411.27.83.53 1.261.76a16.568 16.568 0 0 0 2.71 1.12c.469.14.949.26 1.429.36a14.293 14.293 0 0 0 2.93.29 15.089 15.089 0 0 0 10.6-4.39 16.227 16.227 0 0 0 1.87-2.28q.405-.615.75-1.26c.23-.43.44-.88.63-1.33s.35-.92.489-1.38a11.972 11.972 0 0 0 .361-1.43 14.224 14.224 0 0 0 .219-1.45 14.389 14.389 0 0 0 .077-1.482Zm50 0a15 15 0 0 0-15-15h-.029a15 15 0 1 0 15.029 15Z"
                                          fill="#ffffff"
                                          opacity="1"
                                          data-original="#ffffff"
                                          class=""></path>
                                    </g>
                                 </svg>
                                </span>
                                Customer Service
                            </a>
                            <ul class="dropdown-menu">
                                <li class="w-100">
                                    <a class="dropdown-item" href="#">
                                        <span><i class="fa-solid fa-phone me-2"></i></span> {{ getContactDetails()->phone }}
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-solid fa-envelope me-2"></i>
                                        {{ getContactDetails()->email }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                            @if (!Auth::user())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             version="1.1"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24"
                                             height="24"
                                             x="0"
                                             y="0"
                                             viewBox="0 0 32 32"
                                             style="enable-background: new 0 0 512 512"
                                             xml:space="preserve"
                                             class="">
                                        <g>
                                        <path d="M13 17a9.936 9.936 0 0 1 7.073 2.927c.341.341.643.711.927 1.094V18.08A11.9 11.9 0 0 0 13 15C6.383 15 1 20.383 1 27v4h16.81l-2-2H3v-2c0-5.514 4.486-10 10-10z"
                                              fill="#ffffff"
                                              opacity="1"
                                              data-original="#ffffff"
                                              class=""></path>
                                        <path d="M24.173 17.565a3.97 3.97 0 0 0-.606 4.849l-5.758 5.758.707.707.707.707L20.638 31l1.414-1.414-1.414-1.414 1.414-1.414 1.414 1.414 1.414-1.414-1.414-1.414 1.511-1.511c1.132.669 2.531.759 3.715.177a3.74 3.74 0 0 0 1.138-.787 4.004 4.004 0 0 0 0-5.657 4.003 4.003 0 0 0-5.657-.001zm3.675 4.632a1.972 1.972 0 0 1-2.26-.389 1.979 1.979 0 0 1-.578-1.332c-.029-.554.182-1.1.578-1.496.78-.78 2.048-.78 2.828 0 .941.94.738 2.632-.568 3.217zM13 17c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm0-14C9.691 3 7 5.691 7 9s2.691 6 6 6 6-2.691 6-6-2.691-6-6-6z"
                                              fill="#ffffff"
                                              opacity="1"
                                              data-original="#ffffff"
                                              class=""></path>
                                       </g>
                                       </svg>
                                    </span>
                                    Login
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="w-100">
                                        <a class="dropdown-item" href="{{ route('login') }}"><i class="fa-solid fa-circle-user me-2"></i> Login</a>
                                    </li>
                                    <li class="w-100">
                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>
                                            Register
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             version="1.1"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24"
                                             height="24"
                                             x="0"
                                             y="0"
                                             viewBox="0 0 32 32"
                                             style="enable-background: new 0 0 512 512"
                                             xml:space="preserve"
                                             class="">
                                        <g>
                                        <path d="M13 17a9.936 9.936 0 0 1 7.073 2.927c.341.341.643.711.927 1.094V18.08A11.9 11.9 0 0 0 13 15C6.383 15 1 20.383 1 27v4h16.81l-2-2H3v-2c0-5.514 4.486-10 10-10z"
                                              fill="#ffffff"
                                              opacity="1"
                                              data-original="#ffffff"
                                              class=""></path>
                                        <path d="M24.173 17.565a3.97 3.97 0 0 0-.606 4.849l-5.758 5.758.707.707.707.707L20.638 31l1.414-1.414-1.414-1.414 1.414-1.414 1.414 1.414 1.414-1.414-1.414-1.414 1.511-1.511c1.132.669 2.531.759 3.715.177a3.74 3.74 0 0 0 1.138-.787 4.004 4.004 0 0 0 0-5.657 4.003 4.003 0 0 0-5.657-.001zm3.675 4.632a1.972 1.972 0 0 1-2.26-.389 1.979 1.979 0 0 1-.578-1.332c-.029-.554.182-1.1.578-1.496.78-.78 2.048-.78 2.828 0 .941.94.738 2.632-.568 3.217zM13 17c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm0-14C9.691 3 7 5.691 7 9s2.691 6 6 6 6-2.691 6-6-2.691-6-6-6z"
                                              fill="#ffffff"
                                              opacity="1"
                                              data-original="#ffffff"
                                              class=""></path>
                                       </g>
                                       </svg>
                                    </span>
                                    Dashboard
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="w-100">
                                        <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fa-solid fa-circle-user me-2"></i> Dashboard</a>
                                    </li>
                                    <li class="w-100">
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li> 
                            @endif
                           

                    </ul>
                </div>
            </div>
        </nav>
    </section>