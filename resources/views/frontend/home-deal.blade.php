@extends('frontend.layouts.main')
@section('main-container')


    <main id="content">
        <!-- ========== HERO ========== -->
        <div class="hero-block hero-v1 bg-img-hero-bottom gradient-overlay-half-black-gradient text-center z-index-2"
            style="background-image: url({{ asset('assets/frontend/img/bannerImage.webp') }});">
            <div class="container space-3 space-top-xl-2">
                <div class="row justify-content-md-center" style="margin-bottom: -8%;">
                    <!-- Info -->
                    <div class="py-8 py-xl-10 pb-5">
                        <h1 class="font-size-60 font-size-xs-30 text-white font-weight-bold">Flight To {{ $deal->arrival_city }}
                        </h1>
                        <p class="font-size-20 font-weight-normal text-white">Find best deals in {{ $deal->arrival_city }}</p>
                    </div>
                    <!-- End Info -->
                </div>
                <div class="mb-lg-n16 ">
                    <!-- Nav Classic -->
                    <ul class="nav tab-nav-rounded flex-nowrap pb-2 pb-md-4 tab-nav" role="tablist">


                        <li class="nav-item">
                            <a class="nav-link font-weight-medium active pl-md-5 pl-3" id="pills-seven-example2-tab"
                                data-toggle="pill" href="#pills-seven-example2" role="tab"
                                aria-controls="pills-seven-example2" aria-selected="true">
                                <div
                                    class="d-flex flex-column flex-md-row  position-relative  text-white align-items-center">
                                    <figure class="ie-height-40 d-md-block mr-md-3">
                                        <i class="icon flaticon-aeroplane font-size-3"></i>
                                    </figure>
                                    <span class="tabtext mt-2 mt-md-0 font-weight-semi-bold">Flights</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- End Nav Classic -->
                    <div class="tab-content hero-tab-pane">

                        @if (session('customErrors'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('customErrors')[0]->detail }}

                            </div>
                        @endif

                        @if (session('customError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong>
                                @if (isset(session('customError')->errors))
                                    @foreach (session('customError')->errors as $error)
                                        {{ $error->detail }}
                                        <br>
                                    @endforeach
                                @elseif(session('customError')->error_description)
                                    {{ session('customError')->error_description }}
                                @endif
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong>

                                {{ session('error') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="tab-pane fade  active show" id="pills-seven-example2" role="tabpanel"
                            aria-labelledby="pills-seven-example2-tab">
                            <!-- Search Jobs Form -->
                            <div class="card border-0 tab-shadow">
                                <div class="card-body">
                                    <ul class="nav tab-nav tab-nav-inner flex-nowrap pb-4 px-lg-3 px-2 pb-xl-0"
                                        role="tablist">


                                        <li class="nav-item">
                                            <a class="nav-link font-weight-medium active" id="pills-one-example2-tab"
                                                data-toggle="pill" href="#pills-one-example2" role="tab"
                                                aria-controls="pills-one-example2" aria-selected="true"
                                                onclick="updateDatePicker('range')">
                                                <div
                                                    class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                                    <span
                                                        class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ROUND-TRIP</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item ">
                                            <a class="nav-link font-weight-medium " id="pills-two-example2-tab"
                                                data-toggle="pill" href="#pills-two-example2" role="tab"
                                                aria-controls="pills-two-example2" aria-selected="true"
                                                onclick="updateDatePicker('single')">
                                                <div
                                                    class="d-flex flex-column flex-md-row  position-relative text-black align-items-center">
                                                    <span
                                                        class="tabtext mt-2 mt-md-0 font-size-12 font-weight-semi-bold">ONE-WAY</span>
                                                </div>
                                            </a>
                                        </li>

                                    </ul>

                                    <form class="js-validate" action="{{ route('flight-list') }}">
                                        <input type="hidden" name="departure_code" id="departure_code" value="LHR">
                                        <input type="hidden" name="arrival_code" id="arrival_code" value="{{ $deal->arrival_iataCode }}">
                                        <input type="hidden" name="inquiry" value="yes">
                                        <div class="row nav-select d-block d-lg-flex mb-lg-2 px-lg-3 px-2">
                                            <div class="col-sm-12 col-lg-2dot3 change-col mb-4 mb-lg-0 ">
                                                <!-- Input -->
                                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">From
                                                    where</span>
                                                <div class="js-focus-state">
                                                    <div class="input-group border-bottom border-width-2 border-color-1">
                                                        <i
                                                            class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                                        <input type="text"
                                                            class="form-control font-size-lg-16 shadow-none hero-form  border-0 pl-0 search-input"
                                                            placeholder="city or airport" aria-label="Keyword or title"
                                                            id="departure" name="departure_full" autocomplete="off"
                                                             required
                                                            onclick="this.value=''" value="Heathrow London, United Kingdom (LHR)">
                                                    </div>
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="col-sm-12 col-lg-2dot3 change-col mb-4 mb-lg-0 ">
                                                <!-- Input -->
                                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">To
                                                    where</span>
                                                <div class="js-focus-state">
                                                    <div class="input-group border-bottom border-width-2 border-color-1">
                                                        <i
                                                            class="flaticon-pin-1 d-flex align-items-center mr-2 text-primary font-weight-semi-bold"></i>
                                                        <input type="text"
                                                            class="form-control font-size-lg-16 shadow-none hero-form  border-0 pl-0 search-input"
                                                            placeholder="city or airport" aria-label="Keyword or title"
                                                            id="arrival" name="arrival_full" autocomplete="off"
                                                            required onclick="this.value=''" value="{{ $deal->airline }}">
                                                    </div>
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="col-sm-12 col-lg-2dot3 mb-4 mb-lg-0 " id="departure-date">
                                                <!-- Input -->
                                                <span
                                                    class="d-block text-gray-1 text-left font-weight-normal mb-0">Departure
                                                    Date </span>
                                                <div class="border-bottom border-width-2 border-color-1">
                                                    <div id="datepickerWrapperFromOne" class="u-datepicker input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="d-flex align-items-center mr-2">
                                                                <i
                                                                    class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                            </span>
                                                        </div>
                                                        <input
                                                            class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                                            type="date" data-rp-wrapper="#datepickerWrapperFromOne"
                                                            data-rp-type="single" data-rp-date-format="Y-m-d"
                                                            data-custom-datepicker="departure" placeholder="YYYY-MM-DD"
                                                            name="departure_date" id="departure_date_input">
                                                    </div>
                                                    <!-- End Datepicker -->
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div class="col-sm-12 col-lg-2 mb-4 mb-lg-0" id="return-date">
                                                <!-- Input -->
                                                <span class="d-block text-gray-1 text-left font-weight-normal mb-0">Return
                                                    Date </span>
                                                <div class="border-bottom border-width-2 border-color-1">
                                                    <div id="datepickerWrapperFromTwo" class="u-datepicker input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="d-flex align-items-center mr-2">
                                                                <i
                                                                    class="flaticon-calendar text-primary font-weight-semi-bold"></i>
                                                            </span>
                                                        </div>
                                                        <input
                                                            class="js-range-datepicker font-size-lg-16 shadow-none  form-control hero-form bg-transparent  border-0"
                                                            type="date" data-rp-wrapper="#datepickerWrapperFromTwo"
                                                            data-rp-type="single" data-rp-date-format="Y-m-d"
                                                            data-custom-datepicker="return" data-auto-open="true"
                                                            placeholder="YYYY-MM-DD" name="return_date"
                                                            id="return_date_input">
                                                    </div>
                                                    <!-- End Datepicker -->
                                                </div>
                                                <!-- End Input -->
                                            </div>

                                            <div
                                                class="col-sm-12 col-lg-3 travelers-col text-left mb-4 mb-lg-0 dropdown-custom">
                                                <!-- Input -->
                                                <span
                                                    class="d-block text-gray-1 text-left font-weight-normal mb-0">Travelers</span>
                                                <a id="basicDropdownClickInvoker"
                                                    class="dropdown-nav-link dropdown-toggle d-flex pt-3 pb-2"
                                                    href="javascript:;" role="button" aria-controls="basicDropdownClick"
                                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                                    data-unfold-target="#basicDropdownClick"
                                                    data-unfold-type="css-animation" data-unfold-duration="300"
                                                    data-unfold-delay="300" data-unfold-hide-on-scroll="false"
                                                    data-unfold-animation-in="slideInUp"
                                                    data-unfold-animation-out="fadeOut">
                                                    <i
                                                        class="flaticon-plus d-flex align-items-center mr-3 font-size-18 text-primary font-weight-semi-bold"></i>
                                                    <span class="text-black "><span id="adult-count1">1 adult,</span>
                                                        <span id="child-count1">0 child,</span> <span
                                                            id="infants-count1">0 infant</span> </span>
                                                </a>
                                                <div id="basicDropdownClick"
                                                    class="dropdown-menu dropdown-unfold col-11 m-0"
                                                    aria-labelledby="basicDropdownClickInvoker">

                                                    <div class="w-100 py-2 px-3 mb-3">
                                                        <div
                                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                                            <span
                                                                class="d-block font-size-16 text-secondary font-weight-medium">Adult</span>
                                                            <div class="d-flex">
                                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1"
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                                </a>
                                                                <input name="adult"
                                                                    class="adults1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                                    type="text" value="1">
                                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1"
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 py-2 px-3 mb-3">
                                                        <div
                                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                                            <span
                                                                class="d-block font-size-16 text-secondary font-weight-medium">Child</span>
                                                            <div class="d-flex">
                                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1 "
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                                </a>
                                                                <input name="child"
                                                                    class="children1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                                    type="text" value="0">
                                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1"
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 py-2 px-3">
                                                        <div
                                                            class="js-quantity mx-3 row align-items-center justify-content-between">
                                                            <span
                                                                class="d-block font-size-16 text-secondary font-weight-medium">Infant</span>
                                                            <div class="d-flex">
                                                                <a class="js-minus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1"
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-minus btn-icon__inner"></small>
                                                                </a>
                                                                <input name="infant"
                                                                    class="infants1 js-result form-control h-auto border-0 rounded p-0 max-width-6 text-center"
                                                                    type="text" value="0">
                                                                <a class="js-plus btn btn-icon btn-medium btn-outline-secondary rounded-circle travelers1"
                                                                    data-type="icon" href="javascript:;">
                                                                    <small class="fas fa-plus btn-icon__inner"></small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="container mt-5">
                                                        <div class="btn-group-toggle" data-toggle="buttons">
                                                          <label class="btn btn-outline-primary custom-control custom-radio">
                                                            <input type="radio" name="travel_class" id="option1" autocomplete="off" value="ECONOMY"> ECONOMY
                                                          </label>
                                                          <label class="btn btn-outline-primary custom-control custom-radio">
                                                            <input type="radio" name="travel_class" id="option2" autocomplete="off" value="PREMIUM_ECONOMY"> PREMIUM ECONOMY
                                                          </label>
                                                          <label class="btn btn-outline-primary custom-control custom-radio">
                                                            <input type="radio" name="travel_class" id="option3" autocomplete="off" value="BUSINESS"> BUSINESS
                                                          </label>
                                                          <label class="btn btn-outline-primary custom-control custom-radio">
                                                            <input type="radio" name="travel_class" id="option4" autocomplete="off" value="FIRST"> FIRST
                                                          </label>
                                                        </div>
                                                      </div>

                                                    <div class="text-primary font-weight-semi-bold font-size-16 travelers-done text-center" data-type="done" style="background: #fff;
                                                    border: white;" id="done-selection1" type="button">Done</div>
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="col-sm-12 col-lg-2dot3  mb-4 mb-lg-0 ">
                                                <!-- Input -->
                                                <span
                                                    class="d-block text-gray-1 text-left font-weight-normal mb-0">Name</span>
                                                <div class="js-focus-state">
                                                    <div class="input-group border-bottom border-width-2 border-color-1">

                                                        <input type="text"
                                                            class="form-control font-size-lg-16 shadow-none hero-form font-weight-bold border-0 pl-0 "
                                                            placeholder="Name" aria-label="Name " name="name"
                                                            autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="col-sm-12 col-lg-2dot3  mb-4 mb-lg-0 ">
                                                <!-- Input -->
                                                <span
                                                    class="d-block text-gray-1 text-left font-weight-normal mb-0">Email</span>
                                                <div class="js-focus-state">
                                                    <div class="input-group border-bottom border-width-2 border-color-1">

                                                        <input type="email"
                                                            class="form-control font-size-lg-16 shadow-none hero-form font-weight-bold border-0 pl-0 "
                                                            placeholder="Email" aria-label="email" name="email"
                                                            autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="col-sm-12 col-lg-2dot3  mb-4 mb-lg-0 ">
                                                <!-- Input -->
                                                <span
                                                    class="d-block text-gray-1 text-left font-weight-normal mb-0">Mobile</span>
                                                <div class="js-focus-state">
                                                    <div class="input-group border-bottom border-width-2 border-color-1">

                                                        <input type="text"
                                                            class="form-control font-size-lg-16 shadow-none hero-form font-weight-bold border-0 pl-0 mx-8"
                                                            placeholder="mobile" aria-label="mobile" name="mobile"
                                                            autocomplete="off" required id="phone-input">
                                                    </div>
                                                </div>
                                                <!-- End Input -->
                                            </div>
                                            <div class="col-sm-12 col-lg-1 text-left align-self-lg-end">
                                                <button type="submit"
                                                    class="btn btn-primary text-white border-radius-2 font-weight-bold  mb-xl-0 mb-lg-1 transition-3d-hover has-spinner">
                                                    <span class="button-text">Search</span></button>
                                            </div>
                                        </div>
                                        <!-- End Checkbox -->
                                    </form>
                                </div>
                            </div>
                            <!-- End Search Jobs Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== END HERO ========== -->

        <!-- Icon Block v1 -->
        <div class="container text-center space-top-lg-2">
            <!-- Title -->
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 pt-5 pb-md-6">
                <h2 class="section-title text-black font-size-30 font-weight-bold">Why Make My Booking !</h2>
            </div>
            <!-- End Title -->
            <!-- Features -->
            <div class="mb-6">
                <div class="row">
                    <!-- Icon Block -->
                    <div class="col-lg-4 pb-4 pb-lg-0">
                        <img class="img-fluid pb-5" src="{{ url('assets/frontend/img/img8.jpg') }}">
                        <div class="text-lg-left  w-lg-80 mx-auto">
                            <h5 class="font-size-21 text-dark font-weight-bold mb-2"><a href="#">Looking For
                                    Flight</a></h5>
                            <p class="text-gray-1">Being part of Global Distribution System
                                we offer Best flights Deals on over 550 airlines to choose from to worldwide destionations.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="col-lg-4 pb-4 pb-lg-0">
                        <img class="img-fluid pb-5" src="{{ url('assets/frontend/img/img9.jpg') }}">
                        <div class="text-lg-left w-lg-80 ml-auto">
                            <h5 class="font-size-21 text-dark font-weight-bold mb-2"><a href="#">Options To
                                    Choose</a></h5>
                            <p class="text-gray-1">We work with low-cost carriers to main worldwide airlines to provide
                                wide range of cheapest flights,
                                from economy to first class airfare deals.
                            </p>
                        </div>
                    </div>
                    <!-- End Icon Block -->

                    <!-- Icon Block -->
                    <div class="col-lg-4 pb-4 pb-lg-0">
                        <img class="img-fluid pb-5" src="{{ url('assets/frontend/img/img10.jpg') }}">
                        <div class="text-lg-left w-lg-80 mx-auto">
                            <h5 class="font-size-21 text-dark font-weight-bold mb-2"><a href="#">Book With
                                    Transparency </a></h5>
                            <p class="text-gray-1">Let the worries be gone because you always get what you have booked with
                                transparency of ice
                                no hidden charges no booking fee.</p>
                        </div>
                    </div>
                    <!-- End Icon Block -->
                </div>
            </div>
            <!-- End Features -->
        </div>
        <!-- End Icon Block v1 -->
        <div class="border-bottom border-color-8">
            <div class="container space-bottom-1 space-top-lg-3">
                <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-4 mb-xl-7 pb-xl-1">
                    <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">Looking For Cheap Flight To {{ $deal->arrival_city }}</h2>
                </div>
                <div class="w-lg-80 w-xl-60 mx-auto collapse_custom position-relative mb-4 pb-xl-1">
                    <p>In almost every trip flight ticket price cover most of the cost.
                        And due to Global inflation prices are increasing but our team continuously working
                        to get you the best deals on flight tickets.
                        If you are flying alone or with family one-way or return,
                        here are a few tips to book cheap flight.
                    </p>
                    <h4 class="font-size-21 font-weight-semi-bold text-gray-6 pb-1">Book In Advance :</h4>
                    <p>Normally you can book a flight up to one year before your departure date.
                        But best time to book the flight is 45 days before your departure.</p>

                    <h4 class="font-size-21 font-weight-semi-bold text-gray-6 pb-1">Flexibility In Dates :</h4>
                    <p>Prices of airline tickets always depend upon the seats and their availability on your desire dates.
                        In order to get the Cheap Flight be flexible with your traveling date (+/-3).</p>

                    <h4 class="font-size-21 font-weight-semi-bold text-gray-6 pb-1">Prefer Indriect Flight :</h4>
                    <p>Direct flight obviously save time but it comes with the price and most of the time indrect flights
                        are cheaper.
                        If you want to book flight ticket with cheap price then indrect (VIA) flight is the best option go
                        with.</p>

                    <div class="collapse" id="collapseLinkExample">

                        <h4 class="font-size-21 font-weight-semi-bold text-gray-6 pb-1">Book Return Ticket :</h4>
                        <p>It's good to go with return ticket because most of the time retrun ticket comes with cheap price.
                            If you are willing to come back later then some airlines provide free date with 1 year validity
                            from the date of travel.</p>

                        <h4 class="font-size-21 font-weight-semi-bold text-gray-6 pb-1">Speak With Specialist :</h4>
                        <p>As technology is chaging the world and people prefer to buy Flight Tickets online indeed it's
                            marvelous.
                            But if you want to book Cheap Flight Tickets then speaking with our customer care team will be
                            best because
                            they have the option to add more disscout or they can help you find Cheap Tickets cancelled by
                            other passengers.</p>

                    </div>

                    <a class="link-collapse link-collapse-custom gradient-overlay-half mb-5 d-inline-block border-bottom border-primary"
                        data-toggle="collapse" href="#collapseLinkExample" role="button" aria-expanded="false"
                        aria-controls="collapseLinkExample">
                        <span class="link-collapse__default font-size-14">View More <i
                                class="flaticon-down-chevron font-size-10 ml-1"></i></span>
                        <span class="link-collapse__active font-size-14">View Less <i
                                class="flaticon-arrow font-size-10 ml-1"></i></span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="banner-block ">
            <div class="container space-2 space-lg-3 space-top-xl-2 space-bottom-xl-0">
                <div class="row align-items-lg-center align-items-xl-start mt-xl-4 pt-1">
                    <div class="col mb-7 mb-lg-0 mt-xl-9">
                        <h5 class="font-size-xs-30 font-size-40 font-weight-bold text-black mb-2">Book with more ease</h5>
                        <h3 class="font-size-xs-30 font-size-25 font-weight-bold text-black mb-2">In 3 Steps</h3>
                        <p class="font-size-18 font-weight-normal text-black mb-4 mb-md-5 pb-lg-2"> Download, Search &amp;
                            Book with app and get 10% off on each package you book. </p>
                        <div class="d-flex flex-wrap">
                        <button type="button"
                            class="btn btn-wide rounded-xs transition-3d-hover btn-outline-black border-width-2 py-1 pl-lg-4 text-left mb-4 mb-md-0 mr-md-2 mr-lg-4 btngpas">
                            <span class="media align-items-center ml-1">
                                <span class="flaticon-apple font-size-35 mr-3"></span>
                                <span class="media-body">
                                    <strong class="font-weight-bold text-black">App Store</strong>
                                    <span class="d-block font-weight-normal text-black font-size-14">Available now on
                                        the</span>
                                </span>
                            </span>
                        </button>
                        <button type="button"
                            class="btn btn-wide rounded-xs transition-3d-hover btn-outline-black border-width-2 py-1 pl-lg-4 text-left btngpas btngpas">
                            <span class="media align-items-center ml-1">
                                <span class="flaticon-google-play font-size-35 mr-3"></span>
                                <span class="media-body">
                                    <strong class="font-weight-bold text-black">Google Play</strong>
                                    <span class="d-block font-weight-normal font-size-14 text-black">Get in on</span>
                                </span>
                            </span>
                        </button>

                    </div>
                </div>
                    <div class="col-lg-5 col-xl-6dot5 text-right mr-xl-n2">
                        <img class="img-fluid" src="{{ asset('assets/frontend/img/709x457/img1.png') }}"
                            alt="Image-Description">
                    </div>
                </div>
            </div>
        </div>
       
    </main>
@endsection
