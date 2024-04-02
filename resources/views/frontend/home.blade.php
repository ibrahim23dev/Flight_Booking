@extends('frontend.layouts.main')
@section('main-container')
    <section class="hero-area"
        style="background-image: url({{ asset('assets/frontend/images/2c0c2e7c-4616-4c66-bc54-701f56bbb669.jpg') }}); padding: 350px 0; background-position: center; background-size: cover;">
    </section>
    <!--Hero Area End-->
    <!--Flight search area start-->
    <section class="container flight-search-panel">
        <div class="flight-search-inner">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-flight-tab" data-bs-toggle="tab" data-bs-target="#nav-flight"
                        type="button" role="tab" aria-controls="nav-flight" aria-selected="true">
                        <span class="me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <path
                                        d="M482.1 129.834a133.8 133.8 0 0 0-106.292 6.472l-61.222 30.143-112.51-41.333a5.994 5.994 0 0 0-5.187.506l-30.922 18.808a6 6 0 0 0-.133 10.169l74.841 48.24-87.242 42.954-50.486-34.9a69.578 69.578 0 0 0-65.3-7.47l-23.855 9.444a6 6 0 0 0-1.572 10.237l93.165 75.635a70.493 70.493 0 0 0 44.315 16q1.01 0 2.021-.031a38.607 38.607 0 0 0 13.331-2.459l81.453-31.369-38.281 101.238a6 6 0 0 0 5.612 8.122h49.893a6 6 0 0 0 5.192-2.993l87.239-150.659 126.712-50.167a30.273 30.273 0 0 0-.773-56.587zM180.389 149.7l20.264-12.326 99.062 36.393-46.483 22.886zm79.881 228.54h-37.75l46.961-124.188 81.282-32.091zm218.184-202.976-112.6 44.579 3.93-6.786a6 6 0 0 0-7.4-8.588l-99.785 39.4a6 6 0 0 0-3.409 3.458l-7 18.506-91.509 35.241a26.843 26.843 0 0 1-9.328 1.643 58.344 58.344 0 0 1-38.415-13.286l-85.2-69.173 14.321-5.67a57.606 57.606 0 0 1 54.062 6.185l53.385 36.9a6 6 0 0 0 6.061.448l225.618-111.088a121.815 121.815 0 0 1 96.8-5.926 18.273 18.273 0 0 1 .467 34.157z"
                                        fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </span>
                        <span class="d-sm-block d-none">Flight</span>
                    </button>

                    <button class="nav-link" id="nav-tour-tab" data-bs-toggle="tab" data-bs-target="#nav-tour"
                        type="button" role="tab" aria-controls="nav-tour" aria-selected="false">
                        <span class="me-1">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0"
                                viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve"
                                class="">
                                <g>
                                    <path
                                        d="M328 464a8 8 0 0 0 0-16h-64a8 8 0 0 0 0 16ZM24 464h64a8 8 0 0 0 0-16H24a8 8 0 0 0 0 16ZM224 480a8 8 0 0 0 0 16h32a8 8 0 0 0 0-16ZM56 488a8 8 0 0 0 8 8h112a8 8 0 0 0 0-16H64a8 8 0 0 0-8 8Z"
                                        fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                    <path
                                        d="M472.833 202.217C459.655 195.628 442.313 192 424 192a133.936 133.936 0 0 0-16.323.99l45.98-45.981a8 8 0 0 0 0-11.313c-8.3-8.3-21.595-9.96-37.442-4.678-13.976 4.659-28.8 14.356-41.754 27.305q-3.387 3.387-6.461 6.936V104a8 8 0 0 0-8-8c-11.736 0-22.313 8.228-29.783 23.167C323.628 132.345 320 149.687 320 168a128.6 128.6 0 0 0 2.718 26.721A129.142 129.142 0 0 0 296 192c-18.313 0-35.655 3.628-48.833 10.217C232.228 209.687 224 220.264 224 232a8 8 0 0 0 8 8h55.535c-17.06 24.332-20.651 48.845-7.839 61.657a8 8 0 0 0 11.313 0l40.764-40.764A23.96 23.96 0 0 0 368 265.869c.36.322.731.631 1.109.932 9.38 23.343 14.707 49.954 15.547 77.49-19.536 1.469-38.352 8.771-54.812 21.367-1 .766-1.988 1.556-2.967 2.357-44.939.3-85.4 18.523-107.032 47.985H24v16h336c32.051 0 56 12.671 56 24s-23.949 24-56 24a8 8 0 0 0 0 16c18.313 0 35.655-3.628 48.833-10.217C423.772 478.313 432 467.736 432 456c0-8.968-4.819-17.255-13.752-24H488a8 8 0 0 0 7.408-11.02c-9.206-22.585-23.471-41.715-41.252-55.322A107.989 107.989 0 0 0 430.811 352H432c0-40.181-8.012-78.611-23.25-112H488a8 8 0 0 0 8-8c0-11.736-8.228-22.313-23.167-29.783ZM352 115.737v72.989a81.176 81.176 0 0 0-5.71 14.26c-.485-.257-.957-.519-1.457-.769a76.118 76.118 0 0 0-4.071-1.872A106.939 106.939 0 0 1 336 168c0-24.545 7.431-44.339 16-52.263Zm-22.954 125.256-41.079 41.078c-.46-10.125 6.01-26.1 19.885-42.071h21.524a23.56 23.56 0 0 0-.33.993ZM243.737 224c7.924-8.569 27.718-16 52.263-16s44.339 7.431 52.263 16ZM352 256a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Zm8.5-43.368c1.886-12.752 11.441-29.166 25.27-42.995 17.357-17.358 36.594-26.108 48.27-25.642l-57.621 57.625c-.417.2-.842.392-1.252.6a53.186 53.186 0 0 0-14.667 10.412ZM384 256a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Zm-93.259 160h-49.752c16.533-16.258 41.331-27.394 68.795-30.852A137.934 137.934 0 0 0 290.741 416Zm153.692-37.636A112.675 112.675 0 0 1 475.493 416H308.507a112.675 112.675 0 0 1 31.06-37.636C355.267 366.35 373.4 360 392 360s36.733 6.35 52.433 18.364Zm-28.5-31.386a98.117 98.117 0 0 0-15.263-2.586 249.179 249.179 0 0 0-12.7-72.726 23.97 23.97 0 0 0 13.442-7.168 259.817 259.817 0 0 1 14.518 82.48ZM371.737 224c7.924-8.569 27.718-16 52.263-16s44.339 7.431 52.263 16Z"
                                        fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                    <path
                                        d="M216 448h-80a8 8 0 0 0 0 16h80a8 8 0 0 0 0-16ZM144 64a40 40 0 1 0 40 40 40.045 40.045 0 0 0-40-40Zm0 64a24 24 0 1 1 24-24 24.028 24.028 0 0 1-24 24ZM152 40V24a8 8 0 0 0-16 0v16a8 8 0 0 0 16 0ZM232 104a8 8 0 0 0-8-8h-16a8 8 0 0 0 0 16h16a8 8 0 0 0 8-8ZM152 184v-16a8 8 0 0 0-16 0v16a8 8 0 0 0 16 0ZM56 104a8 8 0 0 0 8 8h16a8 8 0 0 0 0-16H64a8 8 0 0 0-8 8ZM104.4 53.088 93.088 41.775a8 8 0 0 0-11.313 11.313L93.088 64.4A8 8 0 1 0 104.4 53.088ZM194.912 64.4l11.313-11.314a8 8 0 0 0-11.313-11.313L183.6 53.088A8 8 0 0 0 194.912 64.4ZM194.912 166.225a8 8 0 0 0 11.313-11.313L194.912 143.6a8 8 0 1 0-11.312 11.312ZM81.775 154.912a8 8 0 1 0 11.313 11.313l11.312-11.313A8 8 0 1 0 93.088 143.6ZM120 272a8.009 8.009 0 0 1 8 8 8 8 0 0 0 16 0 8 8 0 0 1 16 0 8 8 0 0 0 16 0 23.988 23.988 0 0 0-40-17.874A23.988 23.988 0 0 0 96 280a8 8 0 0 0 16 0 8.009 8.009 0 0 1 8-8ZM32 328a8 8 0 0 0 16 0 8 8 0 0 1 16 0 8 8 0 0 0 16 0 8 8 0 0 1 16 0 8 8 0 0 0 16 0 23.988 23.988 0 0 0-40-17.874A23.988 23.988 0 0 0 32 328Z"
                                        fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                </g>
                            </svg>
                        </span>

                        <span class="d-sm-block d-none">Tour</span>
                    </button>
                  
                  
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-flight" role="tabpanel" aria-labelledby="nav-flight-tab"
                    tabindex="0">
                    <div>


                        @include('frontend.flight.partials.search-form',['data'=>[]])
                        

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tour" role="tabpanel" aria-labelledby="nav-tour-tab"
                    tabindex="0">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="220" height="220" x="0" y="0" viewBox="0 0 64 64"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <path
                                    d="M20.875 11.5A1.877 1.877 0 0 0 19 13.375v1.75a1.875 1.875 0 0 0 3.75 0v-1.75a1.877 1.877 0 0 0-1.875-1.875z"
                                    fill="#46027f" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M60.75 6.25H3.25a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h57.5a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3zM14.125 17a1.863 1.863 0 0 0 1.248-.489.75.75 0 1 1 1 1.115 3.365 3.365 0 0 1-5.627-2.5v-1.75a3.365 3.365 0 0 1 5.627-2.5.75.75 0 1 1-1 1.115 1.864 1.864 0 0 0-3.123 1.386v1.75A1.877 1.877 0 0 0 14.125 17zm10.125-1.875a3.375 3.375 0 0 1-6.75 0v-1.75a3.375 3.375 0 0 1 6.75 0zm9.125 2.625a.75.75 0 0 1-1.5 0v-4.621l-1.7 2.426a.751.751 0 0 1-1.229 0l-1.7-2.426v4.621a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 1.364-.43l2.448 3.5 2.449-3.5a.75.75 0 0 1 1.364.43zm2.875 0a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 1.5 0zm8.25 0a.75.75 0 0 1-1.35.45l-3.9-5.2v4.75a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 1.35-.45l3.9 5.2v-4.75a.75.75 0 0 1 1.5 0zm4.937.75a3.816 3.816 0 0 1-3.812-3.812v-.875a3.809 3.809 0 0 1 6.536-2.664.75.75 0 1 1-1.072 1.051 2.31 2.31 0 0 0-3.964 1.615v.875a2.313 2.313 0 0 0 4.5.75h-1.75a.75.75 0 0 1 0-1.5H52.5a.75.75 0 0 1 .75.75 3.816 3.816 0 0 1-3.813 3.81zM27.125 32a1.877 1.877 0 0 0-1.875 1.875v1.75a1.875 1.875 0 0 0 3.75 0v-1.75A1.877 1.877 0 0 0 27.125 32z"
                                    fill="#46027f" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M60.75 27.75H3.25a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h57.5a3 3 0 0 0 3-3v-8a3 3 0 0 0-3-3zM20.25 34a2.5 2.5 0 0 1 0 5H18.5a.75.75 0 0 1 0-1.5h1.75a1 1 0 0 0 0-2 2.5 2.5 0 0 1 0-5H22a.75.75 0 0 1 0 1.5h-1.75a1 1 0 0 0 0 2zm10.25 1.625a3.375 3.375 0 0 1-6.75 0v-1.75a3.375 3.375 0 0 1 6.75 0zm8 0a3.375 3.375 0 0 1-6.75 0v-1.75a3.375 3.375 0 0 1 6.75 0zm7.75 2.625a.75.75 0 0 1-1.35.45L41 33.5v4.75a.75.75 0 0 1-1.5 0v-7a.75.75 0 0 1 1.35-.45l3.9 5.2v-4.75a.75.75 0 0 1 1.5 0z"
                                    fill="#46027f" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M35.125 32a1.877 1.877 0 0 0-1.875 1.875v1.75a1.875 1.875 0 0 0 3.75 0v-1.75A1.877 1.877 0 0 0 35.125 32zM15 60.75H9a2 2 0 0 0-2 2V63a.75.75 0 0 0 .75.75h8.5A.75.75 0 0 0 17 63v-.25a2 2 0 0 0-2-2zM55 60.75h-6a2 2 0 0 0-2 2V63a.75.75 0 0 0 .75.75h8.5A.75.75 0 0 0 57 63v-.25a2 2 0 0 0-2-2zM50 23.75h4v2.5h-4zM50 43.25h4v16h-4zM54 2.25a2 2 0 0 0-4 0v2.5h4zM14 2.25a2 2 0 0 0-4 0v2.5h4zM10 23.75h4v2.5h-4zM10 43.25h4v16h-4z"
                                    fill="#46027f" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <section class="ad-banner pt-0">
        <div class="container">
            <div class="owl-carousel owl-theme" id="ads-slider">
                <div class="item p-3">
                    <div class="ads-content">
                        <a href="#">
                            <img src="{{ asset('assets/frontend/images/banner_1.jpeg') }}"
                                alt="top banner 1" class="img-fluid" />
                        </a>
                    </div>
                </div>
                <div class="item p-3">
                    <div class="ads-content">
                        <a href="#">
                            <img src="{{ asset('assets/frontend/images/banner_2.jpeg') }}"
                                alt="top banner 1" class="img-fluid" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------------------- Destination Area Start -------------------->

    <section class="hot-deals py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Top Destination</h2>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-theme" id="hot-deals-offers">
                @foreach (json_decode(getSectionContent('safe_travel_with_us')->section_content) as $secKey => $secValue)

                <div class="item p-3">
                    <div class="tour-packageWrapper">
                        <div class="thumb">
                            <img src="{{ url('storage/images/sections/'.$secValue->image) }}"
                                alt="{{ $secValue->title }}" class="img-fluid" />
                        </div>

                        <div class="wrapper-content">
                            <h4>{{ $secValue->title }}</h4>
                           
                        </div>
                    </div>
                </div>

                @endforeach
              
            </div>
        </div>
    </section>

    <!---------------------- Destination Area Start -------------------->
    <section class="destinations py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2><span>Latest Tour</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme" id="destination-slider">
                    @if (!empty($packages))
                        
                    @foreach ($packages as $package)
                        
                    <div class="item p-3">
                     <a href="{{ route('tours.list',['tour'=>$package->location,'id'=>$package->id]) }}">
                        <div class="tour-packageWrapper">
                            <div class="thumb">
                                <img src="{{ asset('storage/'.$package->image) }}"
                                    alt="{{ $package->package_category_name }}" class="img-fluid" />
                            </div>

                            <div class="wrapper-content">
                                <h4>{{ $package->package_category_name }}</h4>
                                <p>{{ $package->packages_count }} Package's <span>Starting : {{ number_format($package->starting_price) }}-{{ $package->currency }}</span></p>
                            </div>
                        </div>
                      </a>
                    </div>
                    @endforeach
                    @endif
                   
                </div>
            </div>
        </div>
    </section>


    <!---------------------- Services Area Start -------------------->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="choose-content">
                        <div class="choose-top-icon">
                            <img src="https://tripploytravel.s3-ap-southeast-1.amazonaws.com/upload/cms/a4a15623-7a68-4cc4-b8ab-d61d0301b0f1.png"
                                alt="Flights" class="img-fluid" />
                        </div>

                        <h4>Flights</h4>
                        <p>Adbiyas Tour is one of the fastest growing websites to provide best and budgeted fare deals on flights and tour bookings for passengers to travel accross the world.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="choose-content">
                        <div class="choose-top-icon">
                            <img src="https://tripploytravel.s3-ap-southeast-1.amazonaws.com/upload/cms/73562861-1d3e-4d98-a746-4d79abb95106.png"
                                alt="Visa Processing" class="img-fluid" />
                        </div>

                        <h4>Tours</h4>
                        <p>Adbiyas is also trusted and reliable tour and travel agency among all the leading and updated tour-operating services in New York City, United States.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="choose-content">
                        <div class="choose-top-icon">
                            <img src="https://tripploytravel.s3-ap-southeast-1.amazonaws.com/upload/cms/49c86d8a-575d-455b-8baf-b9af49c5174e.png"
                                alt="Visa Services" class="img-fluid" />
                        </div>

                        <h4>Visa Services</h4>
                        <p>
                            We are a highly experienced online visa consultancy company with years of track. We aim to make the visa application process simple, efficient, and accurate.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="choose-content">
                        <div class="choose-top-icon">
                            <img src="https://tripploytravel.s3-ap-southeast-1.amazonaws.com/upload/cms/0d1beaf7-a8bd-4c25-ab4c-1ee5995ee6eb.png"
                                alt="Holidays" class="img-fluid" />
                        </div>

                        <h4>Holidays</h4>
                        <p>Our cheap holiday package from New York City brings everything together in one place from the flight, visa, accommodations, meals, snacks, transportation, etc.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="popular-flight">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Popular flights From Dhaka</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />

                                </span>
                                <p>Chittagong</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/ctg.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Cox's Bazar</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/coxs.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Bangkok</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-bankok.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Dubai</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-dubai.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Istanbul</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-istambul.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Jakarta</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-jakarta.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>London</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-london.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>New York</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-newyork.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Singapur</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/dhaka-jakarta.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Sidney</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/sidny.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Makkah</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/saudi.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3">
                    <a href="#">
                        <div class="flight-single-wrapper">
                            <div class="content">
                                <p>Dhaka</p>
                                <span>
                                    <img src="Content/themes/home/img/flights/airplane.png" alt=""
                                        class="img-fluid" />
                                </span>
                                <p>Seoul</p>
                            </div>
                            <div class="thumb">
                                <img src="Content/themes/home/img/flights/seoul.jpg" alt="" />
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="partner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Airlines Partner</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @php
                        $airlinePartners=[
                            'AC'=>'Air Canada',
                            'AF'=>'Air France',
                            'AK'=>'AirAsia',
                            'BA'=>'British Airways',
                            'CX'=>'Cathay Pacific',
                            'EK'=>'Emirates',
                            'BR'=>'EVA Air',
                            'FZ'=>'flydubai',
                            'MH'=>'Malaysia Airlines',
                            'VQ'=>'Novoair',
                            'QR'=>'Qatar Airways',
                            'TK'=>'Turkish Airlines',
                            'UA'=>'United Airlines',
                            'VA'=>'Virgin Australia',
                        ];
                    @endphp
                    <div class="owl-carousel owl-theme" id="airlines-partner">
                        @foreach ($airlinePartners as $iataCode => $airlineName)
                            
                        <div class="item p-3">
                            <img src="{{ asset('assets/frontend/images/airlines_partner/'.$airlineName.'.png') }}"
                                alt="{{ $airlineName }}" />
                        </div>

                        @endforeach

                       
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="choose-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Why Choose Us</h2>
                    </div>
                </div>
            </div>

            <div class="row d-flex d-flex justify-content-between">
                @foreach (json_decode(getSectionContent('why_choose_us')->section_content) as $secKey => $secValue)
                <div class="col-lg-3 col-sm-6">
                    <div class="featureIcon text-center">
                        <div class="d-flex justify-center">
                            <img width="70" height="70"
                                src="{{ url('storage/images/sections/'.$secValue->image) }}"
                                style="color: transparent" alt="Best Price Guarantee" />
                        </div>
                        <div class="text-center mt-30">
                            <h4 class="featureIcon-header">{{ $secValue->title }}</h4>
                            <p class="featureIcon-text">
                                {{ $secValue->description }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

                
            </div>
        </div>
    </section>


    <!---------------- News Letter AREA Start ----------------->
    <section class="newsletter-area py-60 d-none">
        <div class="container">
            <div class="newsletter-body">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center justify-content-lg-start justify-content-center">
                        <div class="news-letter-content">
                            <h3>Newsletter subscription</h3>
                            <p>
                                Subscribe to our newsletter today and stay updates<br />
                                about our latest flight deals and offers.
                            </p>

                            <div class="news-letter-form">
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" />
                                <button class="btn btn-filled">Subscribe</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-contenlg-t-end justify-content-center">
                        <div>
                            <img src="Content/themes/home/img/bg/news-letter.png" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---------------- News Letter AREA End ----------------->
   


    <svg style="visibility: hidden; position: absolute;" width="0" height="0"
        xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="round">
                <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                    result="goo" />
                <feComposite in="SourceGraphic" in2="goo" operator="atop" />
            </filter>
        </defs>
    </svg>
@endsection
