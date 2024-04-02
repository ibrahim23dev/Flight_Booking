@extends('frontend.layouts.main')
@section('main-container')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/themes/custom/search-results.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    <style>
        .noUi-connect {
          background: #61045f  !important;
        }
    
        .noUi-handle {
          border-radius: 50%;
          /* background: #297cbb !important; */
        }
        .noUi-horizontal .noUi-handle{
            width: 24px !important;
            height: 24px !important;
        }

      </style>
@endsection
<div>
    <div class="container">
        <div class="filter-bar mb-3 modify-search py-2 text-black">
            <div class="row top-d">
                <div class="col-10">
                    <div class="row">
                        <div class="col-md-8 col-5">
                            <div class="d-flex flex-column flex-md-row justify-content-around">
                                <div class="align-items-center d-flex font-weight-bolder pt-2 pt-md-0 dest-info">{{ session('searchParams.departure_code') }} -
                                    {{ session('searchParams.arrival_code') }}</div>
                                <div class="pt-2">
                                    <div class="small">
                                        <i class="fa-solid fa-users"></i>

                                        {{ session('searchParams.adult') }} ADT

                                    </div>
                                    <div class="d-none d-md-block">
                                        <div class="badge bg-info">{{ session('searchParams.trave_class') }}</div>
                                        <div class="badge bg-info">
                                            {{ session('searchParams.JourneyType') == '1' ? 'One Way' : (session('searchParams.JourneyType') == '2' ? 'Round' : 'Multi') }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-7">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <div class="text-black-50 pt-2">
                                        Departure
                                    </div>
                                    <div class="font-weight-bold fs-6 fw-700">
                                         {{ session('searchParams.departure_date') }} 
                                    </div>
                                </div>
                                <div>
                                    <div class="font-size-13 text-black-50 pt-2">
                                        Return
                                    </div>

                                    <div class="font-weight-bold fs-6 fw-700">
                                        
                                        {{ session('searchParams.JourneyType')=='1' ? '---' : session('searchParams.return_date') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex justify-content-end align-items-center h-100">
                        <button id="modify-search-btn" class="btn btn-primary" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Modify Search">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="search-form" class="modify-search-form pt-3 mb-5" style="display:block;">
                <div id="search-widget" class="a4-modify-search border-0 shadow-none">
                    <div class="modify-search-box">
                        <section id="modify-search"
                            class="section bg-white modify-search hide-mob p-0 m-0 overflow-visible">
                            <div class="modify-area">
                                <div class="container">
                                    @php
                                        $formData=[
                                            'journeyType'=>session('searchParams.JourneyType'),
                                            'departureFull'=>session('searchParams.departure_full'),
                                            'arrivalFull'=>session('searchParams.arrival_full'),
                                            'departureCode'=>session('searchParams.departure_code'),
                                            'arrivalCode'=>session('searchParams.arrival_code'),
                                            'departureDate'=>session('searchParams.departure_date'),
                                            'returnDate'=>session('searchParams.return_date'),
                                            'adult'=>session('searchParams.adult'),
                                            'child'=>session('searchParams.child'),
                                            'infant'=>session('searchParams.infant'),
                                            'travelClass'=>session('searchParams.travel_class'),
                                            'from'=>session('searchParams.from'),
                                            'to'=>session('searchParams.to'),
                                            'multiDatesArray'=>session('searchParams.multi_departure_date'),
                                        ];
                                       
                                    @endphp

                                    @include('frontend.flight.partials.search-form',['data'=>$formData])

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section start -->
<section class="pt-0 bg-inner small-section" style="background-color: #F9F5FD;">

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left-sidebar">
                    <div class="back-btn">
                        back
                    </div>
                    <div class="middle-part collection-collapse-block open">
                        <a href="javascript:void(0)" class="section-title collapse-block-title mb-2">
                            <h5>latest filter</h5>
                            <img src="/Content/themes/a4atripploytrv/common/images/icon/adjust.png"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <div class="collection-collapse-block-content ">
                            <div class="filter-block">
                                <div class="collection-collapse-block open">
                                    <h6 class="collapse-block-title">airlines</h6>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            @php

                                            if (!empty($data['response'])){
                                                    $airlines=[];
                                                foreach ($data['response']['offersGroup'] as $offer){
                                                    foreach ($offer['offer']['paxSegmentList'] as $segments){
                                                            $segments=$segments['paxSegment'];
                                                            if (!in_array($segments['marketingCarrierInfo']['carrierDesigCode'],$airlines)) {
                                                                $airlines[$segments['marketingCarrierInfo']['carrierDesigCode']]=
                                                                $segments['marketingCarrierInfo']['carrierName'];
                                                            }
                                                    }
                                                }
                                            }

                                            @endphp
                                            @if (!empty($airlines))
                                                @foreach ($airlines as $airlineCode =>$airlineName)
                                                    
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="airline-{{ $airlineCode }}" value="{{ $airlineCode }}" autocomplete="off" name="airlineFilter">
                                                <label class="form-check-label" for="airline-{{ $airlineCode }}">{{ $airlineName }}</label>
                                            </div>

                                               @endforeach
                                                
                                            @endif
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-block">
                                <div class="collection-collapse-block open">
                                    <h6 class="collapse-block-title">price</h6>
                                    <div class="collection-collapse-block-content">
                                        <div class="wrapper">

                                            <div class="js-price-rangeSlider">
                                                <div class="text-14 fw-500 "></div>
                          
                                                <div class="d-flex">
                                                  <div class=" w-100 text-center">
                                                    <span class="js-lower"></span>
                                                    -
                                                    <span class="js-upper"></span>
                                                  </div>
                                                </div>
                          
                                                <div class="px-1">
                                                  <div class="js-slider"></div>
                                                </div>
                                              </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-block">
                                <div class="collection-collapse-block open">
                                    <h6 class="collapse-block-title">stops</h6>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="s0" value="0" autocomplete="off" name="stopFilter">
                                                <label class="form-check-label" for="s0">non stop</label>
                                            </div>
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="s1" value="1" autocomplete="off" name="stopFilter">
                                                <label class="form-check-label" for="s1">1 stop</label>
                                            </div>
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="s2" value="2" autocomplete="off" name="stopFilter">
                                                <label class="form-check-label" for="s2">2 stops</label>
                                            </div>
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="s3" value="3" autocomplete="off" name="stopFilter">
                                                <label class="form-check-label" for="s3" >3 stops</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-block">
                                <div class="collection-collapse-block open">
                                    <h6 class="collapse-block-title">Onward flight Departure</h6>
                                    <div class="collection-collapse-block-content">
                                        <div class="collection-brand-filter">

                                            <div class="form-check collection-filter-checkbox custom-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk" id="12am_6am" value="12am_6am" autocomplete="off" name="departureTime">
                                                <label class="form-check-label" for="12am_6am">12 am to 6:00 am</label>
                                            </div>

                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="6am_12pm" value="6am_12pm" autocomplete="off" name="departureTime">
                                                <label class="form-check-label" for="6am_12pm">6:00 am to 12 pm</label>
                                            </div>
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="12pm_6pm" value="12pm_6pm" autocomplete="off" name="departureTime">
                                                <label class="form-check-label" for="12pm_6pm">12:00 pm to 6:00 pm</label>
                                            </div>
                                            <div class="form-check collection-filter-checkbox">
                                                <input type="checkbox" class="form-check-input stops-chk"
                                                    id="after_6pm" value="after_6pm" autocomplete="off" name="departureTime">
                                                <label class="form-check-label" for="after_6pm">6:00 pm to 12 pm</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="filter-block">
                                <div class="collection-collapse-block open">
                                    <h6 class="collapse-block-title">Onward flight take-off</h6>
                                    <div class="collection-collapse-block-content">

                                        <div class="row onward-takeoff-chk mb-2">
                                            <div class="col-6">
                                                <a href="#" data-id="1"
                                                    class="align-items-center btn btn-lower btn-outline-info d-flex flex-column font-size-12 justify-content-center text-center mb-2"><i
                                                        class="bi bi-sunrise me-1"></i><span>12 am to 6:00 am</span></a>

                                            </div>
                                            <div class="col-6">
                                                <a href="#" data-id="2"
                                                    class="align-items-center btn btn-lower btn-outline-info d-flex flex-column font-size-12 justify-content-center text-center mb-2"><i
                                                        class="bi bi-brightness-high me-1"></i><span>6:00 AM to 12:00
                                                        PM</span></a>

                                            </div>
                                            <div class="col-6">
                                                <a href="#" data-id="3"
                                                    class="align-items-center btn btn-lower btn-outline-info d-flex flex-column font-size-12 justify-content-center text-center mb-2"><i
                                                        class="bi bi-sunset me-1"></i><span>12:00 PM to 6:00
                                                        PM</span></a>

                                            </div>
                                            <div class="col-6">
                                                <a href="#" data-id="4"
                                                    class="align-items-center btn btn-lower btn-outline-info d-flex flex-column font-size-12 justify-content-center text-center mb-2"><i
                                                        class="bi bi-moon-stars me-1"></i><span>After 6:00
                                                        PM</span></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 ratio3_2">
                <div class="row">
                    <div class="col-12">
                        <a href="javascript:void(0)" class="mobile-filter border-top-0">
                            <div class="fs-8 fw-700 pe-2 text-body">Filter</div>
                            <img src="/Content/themes/a4atripploytrv/common/images/icon/adjust.png"
                                class="img-fluid blur-up lazyload" alt="">
                        </a>
                    </div>
                    <div class="col-12">
                        <div class="top-bar-flight row">
                            <div class="airline-name d-flex flex-grow-1 flex-column justify-content-between pb-0">
                                <div class="d-flex justify-content-between pb-2">
                                    <div class="flightSort dropdown">
                                        <button class="btn btn-primary btn-lower dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="sortSelect">Sort by</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item price sortClass" href="#" data-id="1"
                                                data-title="Sort by Price">Price</a>
                                            <a class="dropdown-item duration sortClass" href="#" data-id="4"
                                                data-title="Sort by Total Duration">Flight Duration</a>
                                            <a class="dropdown-item depart sortClass" href="#" data-id="5"
                                                data-title="Sort by Depart time">Departure Time</a>
                                            <a class="dropdown-item arrival sortClass" href="#" data-id="3"
                                                data-title="Sort by Arrival time">Arrival Time</a>
                                            <a class="dropdown-item airlines sortClass" href="#" data-id="2"
                                                data-title="Sort by Airlines names">Airlines Name</a>
                                        </div>
                                    </div><!-- end dropdown -->
                                    <div class="bg-body flex-grow-1 fw-bold ms-3 px-2 py-1 rounded top-loader">

                                        <span id="loader-box"></span>
                                        <span id="count-box">
                                             @if (!empty($data['response']))
                                                {{ count($data['response']['offersGroup']) }} Flights Found
                                            @endif
                                             </span>
                                    </div>

                                </div>
                                <div
                                    class="filter-bar-filter d-flex flex-wrap align-items-center overflow-hidden mb-3">
                                    <ul class="d-flex overflow-auto p-2" id="lowest-price-filter-box">
                                    </ul>
                                </div>
                                <!-- end filter-top-filter -->

                            </div><!-- end filter-bar -->
                        </div>
                    </div>
                </div>
                <div class="flight-detail-sec mt-0">
                    <div class="detail-bar flight-search-wrapper">
                        <div class="result-placeholder box-0" style="display: none;">
                            <div class="result-first box-placeholder">
                                <div class="simmer-effect-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="wrapper p-1">
                                                <div class="loader-wrap row d-flex">
                                                    <div
                                                        class="col-2 d-flex align-items-center justify-content-center">
                                                        <div class="b-skeleton b-skeleton-text b-skeleton-animate-fade"
                                                            style="width: 50px; height: 50px"></div>
                                                    </div>
                                                    <div class="col-10 py-3">
                                                        <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                            style="width: 15%; height: 10px"></div>
                                                        <div class="content-md">
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 100%; height: 10px"></div>
                                                            <div class="d-flex justify-content-between">
                                                                <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                    style="width: 40%; height: 10px"></div>
                                                                <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                    style="width: 40%; height: 10px"></div>
                                                            </div>
                                                        </div>
                                                        <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                            style="width: 15%; height: 10px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div id="flights-list-container">
                           
                            @if (!empty($data['response']))
                             @foreach ($data['response']['offersGroup'] as $offerKey => $offer)
                                
                             @php
                                 $segmentTypes = [];
                                 $airlineCodes = []; // Array to store unique airline codes
                                    // Organize segments into groups
                                    foreach ($offer['offer']['paxSegmentList'] as $segmentData) {
                                        $segment = $segmentData['paxSegment'];
                                        $segmentGroup = $segment['segmentGroup'];

                                        if (!isset($segmentTypes[$segmentGroup])) {
                                            $segmentTypes[$segmentGroup] = [];
                                        }

                                        $segmentTypes[$segmentGroup][] = $segmentData;

                                         // Extract and store unique airline codes
                                        $airlineCode = $segment['marketingCarrierInfo']['carrierDesigCode'];
                                        if (!in_array($airlineCode, $airlineCodes)) {
                                            $airlineCodes[] = $airlineCode;
                                        }
                                    }
                                  
                             @endphp        
                            
                            <div class="result flight-list-main" data-price="{{ bdt_to_usd($offer['offer']['price']['totalPayable']['total']) }}" data-stop="{{ count($segmentTypes[0])-1 }}"  @foreach ($airlineCodes as $airlineCount => $airlineCode) data-airline{{ $airlineCount+1 }}="{{ $airlineCode }}"  @endforeach data-departuretime="{{ $segmentTypes[0][0]['paxSegment']['departure']['aircraftScheduledDateTime'] }}">

                                <!---->
                                <div class="card flight-result-first search-result-wrapper">
                                    <div class="flight-info-wrapper">
                                        <div class="row">
                                       
                                            @foreach ($segmentTypes as $segmentGroup => $segments)
                                            @php
                                                // Get the first and last segments of the group
                                                $totalSegments=count($segments);
                                                $firstSegment = reset($segments);
                                                $firstSegment=$firstSegment['paxSegment'];
                                                $lastSegment = end($segments);
                                                $lastSegment=$lastSegment['paxSegment'];
                                            @endphp
                                            <div class="col-lg-9 ">
                                                <div class="p-2">
                                                    <div class="badge-price">
                                                        <span class="badge text-bg-{{ $offer['offer']['refundable'] ? 'success' : 'danger' }}">{{ $offer['offer']['refundable'] ? 'Refundable' : 'Non-Refundable' }}</span>
                                                    </div>
                                                    <div class="row  ">
                                                        <div class="col-lg-12">
                                                            <div class="left-side">
                                                                <div class="row d-flex align-items-center">
                                                                    <div
                                                                        class="col-lg-4 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start">
                                                                        <div class="airlines-details text-center">
                                                                            <img alt="" title="{{ $firstSegment['marketingCarrierInfo']['carrierName'] }}"
                                                                                src="{{ asset('assets/frontend/images/airlines/'.$firstSegment['marketingCarrierInfo']['carrierDesigCode']) }}.png"
                                                                                class="img-fluid blur-up airlines-icon lazyloaded">
                                                                            <p>{{ $firstSegment['marketingCarrierInfo']['carrierName'] }}</p>
                                                                            <span>{{ $firstSegment['marketingCarrierInfo']['carrierDesigCode'].'-'.$firstSegment['marketingCarrierInfo']['marketingCarrierFlightNumber'] }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-8">
                                                                        <div class="row d-flex align-items-center">
                                                                            <div class="col-4">
                                                                                <div class="flight-info">
                                                                                    <h5 class="flight-time"> {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime']) }}
                                                                                    </h5>
                                                                                    <p class="flight-date"> {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime'],'M d, Y') }}</p>
                                                                                    <h4 class="dept-airport"
                                                                                        >
                                                                                        {{ $firstSegment['departure']['iatA_LocationCode'] }} 
                                                                                    </h4>
                                                                                    {{-- <p class="airport-name">
                                                                                        Quaid E Azam International
                                                                                    </p> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4 text-center">
                                                                                <p class="interval-time">
                                                                                    {{ formatTimeDifference($firstSegment['departure']['aircraftScheduledDateTime'],$lastSegment['arrival']['aircraftScheduledDateTime']) }}
                                                                                </p>
                                                                                <div class="interval-dots">
                                                                                    <div class="dots">
                                                                                        <svg class="svg1"
                                                                                            width="9"
                                                                                            height="10"
                                                                                            viewBox="0 0 9 10"
                                                                                            fill="#ffc610"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <circle cx="4.35644"
                                                                                                cy="4.72949"
                                                                                                r="4.35644"
                                                                                                fill="#ffc610">
                                                                                            </circle>
                                                                                        </svg>
                                                                                        <svg class="svg2"
                                                                                            width="21"
                                                                                            height="20"
                                                                                            viewBox="0 0 21 20"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M20.6357 10.3165C20.6357 11.1515 19.9617 11.8238 19.1318 11.8167L13.6128 11.8167L8.59743 19.8204L6.58988 19.8274L9.10819 11.8238L3.575 11.8238L2.0782 13.8265L0.567215 13.8194L1.57454 10.3236L0.567215 6.81355L2.08529 6.7994L3.59628 8.83039L9.08691 8.83039L6.58988 0.805509L8.59743 0.812586L13.6128 8.81623L19.1318 8.81623C19.9405 8.80208 20.6498 9.50974 20.6357 10.3165Z"
                                                                                                fill="black"
                                                                                                fill-opacity="0.7">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                                {{ $totalSegments > 1 ? $totalSegments-1 .' Stops ' : 'Non Stop' }}
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="flight-info">
                                                                                    <h5 class="flight-time"> {{ formatTime($lastSegment['arrival']['aircraftScheduledDateTime']) }}
                                                                                    </h5>
                                                                                    <p class="flight-date"> {{ formatTime($lastSegment['arrival']['aircraftScheduledDateTime'],'M d, Y') }}</p>
                                                                                    <h4 class="dept-airport"
                                                                                        title="Lahore Arpt, Lahore">
                                                                                        {{ $lastSegment['arrival']['iatA_LocationCode'] }} 
                                                                                    </h4>
                                                                                    {{-- <p class="airport-name">Lahore Arpt
                                                                                    </p> --}}
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
                                           @endforeach
                                            <div class="col-lg-3 d-flex justify-content-center justify-content-lg-end">
                                                <div class="right-side">
                                                    <div class="flight-price text-center">
                                                        <h4> 
                                                          {{$offer['offer']['price']['totalPayable']['total']}} 
                                                        <span class="currencySm">
                                                           USD
                                                        </span>
                                                        {{ number_format(bdt_to_usd($offer['offer']['price']['totalPayable']['total']),2) }}
                                                    </h4>
                                                    </div>

                                                    <div class="book-area">
                                                        <form action="{{ route('/flight-book') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="selectedFlightData" value='{{ json_encode($offer) }}'>
                                                            <input type="hidden" name="traceId" value='{{ $data['response']['traceId'] }}'>
                                                            <button data-id="1-1"
                                                            class="btn button ladda-button select-flight-btn"
                                                            data-style="zoom-in">Book Now</button>  
                                                        </form>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight-details-area">
                                        <div class="flight-book">
                                            <div class="row">
                                                <div class="col-lg-12 d-flex">
                                                    <div class="result-footer">
                                                        <div class="flight-count">
                                                            <p class="mb-0">
                                                                <i class="fa-solid fa-users"></i>
                                                                <span>{{ session('searchParams.adult') }} ADT</span>
                                                            </p>

                                                            <p class="mb-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="20" height="20" x="0" y="0"
                                                                    viewBox="0 0 43.349 43.349"
                                                                    style="enable-background: new 0 0 512 512"
                                                                    xml:space="preserve" fill-rule="evenodd"
                                                                    class="">
                                                                    <g>
                                                                        <path
                                                                            d="M16.003 24.711h17.396a3.669 3.669 0 0 1 3.658 3.658 3.669 3.669 0 0 1-3.658 3.658H16.002a3.669 3.669 0 0 1-3.657-3.658 3.669 3.669 0 0 1 3.657-3.658zM17.95 32.801l-1.747 7.334a2.516 2.516 0 0 0 .502 2.223 2.58 2.58 0 0 0 2.075.991h11.842a2.58 2.58 0 0 0 2.075-.991 2.515 2.515 0 0 0 .501-2.223L31.452 32.8z"
                                                                            fill="#ffffff" opacity="1"
                                                                            data-original="#ffffff" class="">
                                                                        </path>
                                                                        <path
                                                                            d="M16.441 13.752h12.722a1.49 1.49 0 0 1 1.486 1.486v1.486H17.24l1.937 7.213h-3.176c-1.613 0-3.03.872-3.805 2.168-.43-1.578-.839-3.056-1.278-4.697L7.567 8.9l-.464-1.731-.687-2.564A3.669 3.669 0 0 1 9.003.124a3.669 3.669 0 0 1 4.48 2.587l.124.462 1.659 6.192.325 1.213z"
                                                                            fill="#ffffff" opacity="1"
                                                                            data-original="#ffffff" class="">
                                                                        </path>
                                                                        <path
                                                                            d="M16.39 10.57c.995-.275 1.675-.982 1.515-1.58l-1.397-5.212c-.16-.598-1.102-.87-2.102-.611z"
                                                                            fill="#ffffff" opacity="1"
                                                                            data-original="#ffffff" class="">
                                                                        </path>
                                                                    </g>
                                                                </svg>
                                                                <span> {{ $offer['offer']['seatsRemaining'] }} Seats</span>
                                                            </p>

                                                            <p class="mb-0">
                                                                <i class="fa-solid fa-suitcase-rolling"></i>
                                                                <span>
                                                                    {{ $offer['offer']['baggageAllowanceList'][0]['baggageAllowance']['checkIn'][0]['allowance'] }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <!--  -->
                                                        <div class="">
                                                            <div>
                                                                <a class="collaspsebtn flightDetails collapsed"
                                                                    data-bs-toggle="collapse" href="#b-{{ $offerKey }}"
                                                                    role="button" aria-expanded="false"
                                                                    aria-controls="collapseExample">
                                                                    Flight Details
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight-book-details">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="collapseBody collapse" id="b-{{ $offerKey }}" style="">
                                                        <div class="card card-body collapseContent">
                                                            <ul class="nav nav-pills flightDetailsTab mb-3"
                                                                id="pills-tab" role="tablist">
                                                                <li class="nav-item navItem" role="presentation">
                                                                    <button class="nav-link navLink active"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#pills-{{ $offerKey }}" type="button"
                                                                        role="tab" aria-controls="pills-home"
                                                                        aria-selected="true">
                                                                        <i class="fas fa-clipboard-list"></i>
                                                                        <span class="tabIcon">
                                                                            Itineraries
                                                                        </span>
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item navItem" role="presentation">
                                                                    <button class="nav-link navLink"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#pills-2-{{ $offerKey }}" type="button"
                                                                        role="tab" aria-controls="pills-contact"
                                                                        aria-selected="false" data-id="1-1"
                                                                        data-isloaded="true">
                                                                        <i class="fas fa-suitcase-rolling"></i>
                                                                        <span class="tabIcon">
                                                                            Baggages
                                                                        </span>


                                                                    </button>
                                                                </li>

                                                                <li class="nav-item navItem" role="presentation">
                                                                    <button class="nav-link navLink"
                                                                        data-bs-toggle="pill"
                                                                        data-bs-target="#pills-3-{{ $offerKey }}" type="button"
                                                                        role="tab" aria-controls="pills-profile"
                                                                        aria-selected="false" data-id="1-1">
                                                                        <i class="fas fa-tags"></i>
                                                                        <span class="tabIcon">
                                                                            Fare Details
                                                                        </span>

                                                                    </button>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade active show"
                                                                    id="pills-{{ $offerKey }}" role="tabpanel"
                                                                    aria-labelledby="pills-home-tab" tabindex="0">


                                                                    <div class="segmentBody">

                                                                        <!-- flight schedule -->
                                                                        @foreach ($segmentTypes as $segmentGroup => $segments)
                                                                        @php
                                                                            // Get the first and last segments of the group
                                                                            $totalSegments=count($segments);
                                                                            $firstSegment = reset($segments);
                                                                            $firstSegment=$firstSegment['paxSegment'];
                                                                            $lastSegment = end($segments);
                                                                            $lastSegment=$lastSegment['paxSegment'];
                                                                        @endphp
                                                                            <div class="">
                                                                                <div class="itineraries-destinations">
                                                                                    <div class="destination">
                                                                                        <i class="fa-solid fa-plane"></i>
                                                                                        {{ $firstSegment['departure']['iatA_LocationCode'] }} to  {{ $lastSegment['arrival']['iatA_LocationCode'] }}
                                                                                    </div>
                                                                                    <div class="flighttime">
                                                                                        <i
                                                                                            class="fa-regular fa-calendar"></i>
                                                                                            {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime'],'M d, Y') }} <i
                                                                                            class="fa-regular fa-clock"></i>
                                                                                            {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime'],'h:i a') }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="all-result-details">
                                                                                    <div class="flightdetail">
                                                                                        <strong>
                                                                                            {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime'],'M d, Y') }}  {{ formatTime($firstSegment['departure']['aircraftScheduledDateTime'],'h:i a') }}
                                                                                        </strong>
                                                                                        <span>
                                                                                            {{ $firstSegment['departure']['iatA_LocationCode'] }}
                                                                                        
                                                                                        </span>
                                                                                        <p class="m-0">
                                                                                            {{ $firstSegment['marketingCarrierInfo']['carrierName']}}  ({{ $firstSegment['marketingCarrierInfo']['carrierDesigCode'].'-'.$firstSegment['flightNumber']}})
                                                                                        </p>
                                                                                        <p class="m-0">RBD - {{ $firstSegment['rbd'] }} </p>
                                                                                    </div>


                                                                                    <div class="connectiondetail">
                                                                                        <div class="connectiondetailbg">
                                                                                            <label>Duration 
                                                                                                ( {{ formatTimeDifference($firstSegment['departure']['aircraftScheduledDateTime'],$lastSegment['arrival']['aircraftScheduledDateTime']) }})
                                                                                            </label>
                                                                                          
                                                                                            <p class="text-body">
                                                                                               


                                                                                                @php
 $layoverCount = 0;
        $lastArrivalLocation = null;
        for ($i = 0; $i < $totalSegments - 1; $i++) {
            $currentSegment = $segments[$i]['paxSegment'];
            $nextSegment = $segments[$i + 1]['paxSegment'];
            
            $currentArrivalTime = new DateTime($currentSegment['arrival']['aircraftScheduledDateTime']);
            $nextDepartureTime = new DateTime($nextSegment['departure']['aircraftScheduledDateTime']);
            
            $currentArrivalLocation = $currentSegment['arrival']['iatA_LocationCode'];
            $nextDepartureLocation = $nextSegment['departure']['iatA_LocationCode'];
            
            if ($lastArrivalLocation !== $nextDepartureLocation) {
                $layoverTime = $currentArrivalTime->diff($nextDepartureTime);
                $layoverHours = $layoverTime->format('%d d %h h %i m');
                
                if ($layoverTime->invert === 0) { // Check if the layover is non-negative
                    $layoverCount++;
                    echo "Layover $layoverCount: At $nextDepartureLocation for $layoverHours\n";
                }
            }
            
            $lastArrivalLocation = $currentSegment['arrival']['iatA_LocationCode'];
        }
        if ($layoverCount === 0) {
            echo "Non-stop flight\n";
        }
                                                                                                @endphp

                                                                                            </p>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flightdetail">
                                                                                        <strong>
                                                                                            {{ formatTime($lastSegment['arrival']['aircraftScheduledDateTime'],'M d, Y') }}  {{ formatTime($lastSegment['arrival']['aircraftScheduledDateTime'],'h:i a') }}
                                                                                        </strong>
                                                                                        <span>

                                                                                            {{ $lastSegment['arrival']['iatA_LocationCode'] }}
                                                                                            
                                                                                        </span>
                                                                                        <p class="m-0">
                                                                                        {{ $lastSegment['marketingCarrierInfo']['carrierDesigCode'].'-'.$lastSegment['flightNumber']}}
                                                                                        </p>
                                                                                        <p class="m-0">RBD -  {{ $lastSegment['rbd'] }} </p>
                                                                                    </div>



                                                                                    <div class="reached mb-3">
                                                                                        <strong>  {{ $lastSegment['arrival']['iatA_LocationCode'] }} </strong>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            @endforeach
                                                                        <!-- flight schedule -->

                                                                    </div>



                                                                </div>
                                                                <div class="tab-pane fade" id="pills-2-{{ $offerKey }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="pills-profile-tab"
                                                                    tabindex="0">

                                                                    <div class="details-content-box baggagesBody">
                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class="table table-sm table-row-bordered">
                                                                                <thead>
                                                                                    <tr
                                                                                        class="fs-6 fw-bolder text-body border-bottom-3">
                                                                                        <th colspan="3"
                                                                                            class="details-box-title"
                                                                                            style=" padding-left: 0 !important; padding-top: 0 !important;">
                                                                                            <i class="fa fa-plane"
                                                                                                style="margin-right: 10px;"></i>
                                                                                            <span>Karachi to
                                                                                                Lahore</span>
                                                                                        </th>
                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody class="mt-2">
                                                                                    @foreach ($offer['offer']['baggageAllowanceList'] as $baggage)
                                                                                        
                                                                                    <tr>
                                                                                        <td>

                                                                                            <div
                                                                                                class="airlines-info">
                                                                                                <div>

                                                                                                </div>
                                                                                               
                                                                                                <div
                                                                                                    class="airline-details">
                                                                                                   
                                                                                                    <div
                                                                                                        class="plane-model">
                                                                                                        <p>
                                                                                                            {{ $baggage['baggageAllowance']['departure'] }}- {{ $baggage['baggageAllowance']['arrival'] }}</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>


                                                                                            <div class="font-size-13">
                                                                                                <div
                                                                                                    class="baggage-inner">
                                                                                                    <p>Check in</p>
                                                                                                    <span> {{ $baggage['baggageAllowance']['checkIn'][0]['paxType'] }}: </span>
                                                                                                    <strong>{{ $baggage['baggageAllowance']['checkIn'][0]['allowance'] }}
                                                                                                        baggage
                                                                                                        included</strong>

                                                                                                </div>
                                                                                            </div>


                                                                                        </td>
                                                                                        <td>

                                                                                            <div class="font-size-13">
                                                                                                <div
                                                                                                    class="baggage-inner">
                                                                                                    <p>Cabin Baggage</p>
                                                                                                    <span>{{ $baggage['baggageAllowance']['cabin'][0]['paxType'] }}: </span>
                                                                                                    <strong>{{ $baggage['baggageAllowance']['cabin'][0]['allowance'] }} 
                                                                                                        </strong>

                                                                                                </div>
                                                                                            </div>

                                                                                        </td>
                                                                                    </tr>

                                                                                    @endforeach

                                                                                  
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="tab-pane fade" id="pills-3-{{ $offerKey }}"
                                                                    role="tabpanel"
                                                                    aria-labelledby="pills-contact-tab"
                                                                    tabindex="0">



                                                                    <div
                                                                        class="details-content-box fare-details-table">
                                                                        <div class="table-responsive">
                                                                            <table class="table border table-striped table-row-bordered g-3 table-sm" id="fd-1-1">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="details-box-title" colspan="3" style="">Fare Details</th>
                                                                                        <th colspan="4" style="text-align:right; font-size:11px;font-weight: normal;color: #ed1c24;">
                                                                                            All amounts are in USD
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr class="fw-bolder fs-6 text-body border-bottom border-gray-200 fareDetailsBg">
                                                                                        <th>Passenger</th>
                                                                                        <th class="text-right">Base Fare </th>
                                                                                        <th class="text-right">(-) Discount</th>
                                                                                        <th class="text-right">Taxes</th>
                                                                                        <th class="text-right">Single</th>
                                                                                        <th class="text-center">Qty.</th>
                                                                                        <th class="text-right">Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $totalAmount=0;
                                                                                    @endphp
                                                                                    @foreach ($offer['offer']['fareDetailList'] as $fareDetail)
                                                                                                @php
                                                                                                    $totalAmount+=bdt_to_usd($fareDetail['fareDetail']['subTotal'])
                                                                                                @endphp
                                                                                        <tr>
                                                                                            <td>{{ $fareDetail['fareDetail']['paxType'] }}</td>
                                                                                            <td class="text-right">
                                                                                                <small>USD</small> {{ number_format(bdt_to_usd($fareDetail['fareDetail']['baseFare']),2) }}
                                                                                            </td>
                                                                                            <td class="text-right">
                                                                                                (<small>USD</small> {{ number_format(bdt_to_usd($fareDetail['fareDetail']['discount']),2) }})
                                                                                            </td>
                                                                                            <td class="text-right">
                                                                                                <small>USD</small> {{ number_format(bdt_to_usd($fareDetail['fareDetail']['tax']+$fareDetail['fareDetail']['vat']),2) }}
                                                                                            </td>
                                                                                            <td class="text-right">
                                                                                                <small>USD</small>
                                                                                                 {{ number_format(
                                                                                                    bdt_to_usd($fareDetail['fareDetail']['baseFare'])
                                                                                                    + bdt_to_usd($fareDetail['fareDetail']['tax'])
                                                                                                    + bdt_to_usd($fareDetail['fareDetail']['vat'])
                                                                                                    - bdt_to_usd($fareDetail['fareDetail']['discount']), 2)
                                                                                                }}
                                                                                                
                                                                                            </td>
                                                                                            <td class="text-center">{{ $fareDetail['fareDetail']['paxCount'] }}</td>
                                                                                            <td class="text-right">
                                                                                                <small>USD</small> {{ number_format(bdt_to_usd($fareDetail['fareDetail']['subTotal']),2) }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                <tfoot class="fw-bolder fs-6">
                                                                                    <tr>
                                                                                        <th class="text-uppercase text-right" style="font-size:13px" colspan="6">Total Price</th>
                                                                                        <th class="doller-td text-right" style="font-size:13px" id="tp-1-1">
                                                                                            <small>USD</small> {{ number_format($totalAmount,2) }}
                                                                                        </th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                            
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
                                </div>
                                <!---->
                            </div>

                            @endforeach 

                            @endif

                           
                        </div>
                        {{-- <div>

                            <div class="result-placeholder box-1" style="display: none;">
                                <div class="result-first box-placeholder">
                                    <div class="simmer-effect-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="wrapper p-1">
                                                    <div class="loader-wrap row d-flex">
                                                        <div
                                                            class="col-2 d-flex align-items-center justify-content-center">
                                                            <div class="b-skeleton b-skeleton-text b-skeleton-animate-fade"
                                                                style="width: 50px; height: 50px"></div>
                                                        </div>
                                                        <div class="col-10 py-3">
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                            <div class="content-md">
                                                                <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                    style="width: 100%; height: 10px"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                </div>
                                                            </div>
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-placeholder box-7" style="display: none;">
                                <div class="result-first box-placeholder">
                                    <div class="simmer-effect-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="wrapper p-1">
                                                    <div class="loader-wrap row d-flex">
                                                        <div
                                                            class="col-2 d-flex align-items-center justify-content-center">
                                                            <div class="b-skeleton b-skeleton-text b-skeleton-animate-fade"
                                                                style="width: 50px; height: 50px"></div>
                                                        </div>
                                                        <div class="col-10 py-3">
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                            <div class="content-md">
                                                                <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                    style="width: 100%; height: 10px"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                </div>
                                                            </div>
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-placeholder box-82" style="display: none;">
                                <div class="result-first box-placeholder">
                                    <div class="simmer-effect-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="wrapper p-1">
                                                    <div class="loader-wrap row d-flex">
                                                        <div
                                                            class="col-2 d-flex align-items-center justify-content-center">
                                                            <div class="b-skeleton b-skeleton-text b-skeleton-animate-fade"
                                                                style="width: 50px; height: 50px"></div>
                                                        </div>
                                                        <div class="col-10 py-3">
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                            <div class="content-md">
                                                                <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                    style="width: 100%; height: 10px"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                    <div class="b-skeleton b-skeleton-text b-skeleton-animate-wave"
                                                                        style="width: 40%; height: 10px"></div>
                                                                </div>
                                                            </div>
                                                            <div class="b-skeleton mt-1 b-skeleton-text b-skeleton-animate-wave"
                                                                style="width: 15%; height: 10px"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->

<div id="model-1" class="default-modal zoom-anim-dialog mfp-hide" style="display: none;">
    <div class="small-dialog-header small-dialog-header-sr">
        <h3 id="modal-1-header"></h3>
    </div>
    <div id="modal-1-content">
    </div>
    <button title="Close (Esc)" type="button" class="mfp-close"></button>
</div>

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>

<script src="{{ url('assets/frontend/js/filters.js') }}"></script>

<script>

var priceLow = 0;
var priceHigh = 1500000;
var min = parseFloat(priceLow); // Remove .toFixed(2)
var max = parseFloat(priceHigh); // Remove .toFixed(2)
var curr = "BDT";

// $(document).ready(function() {
//     $("#range-slider").ionRangeSlider({
//         keyboard: true,
//         type: "double",
//         grid: false,
//         min: min,
//         max: max,
//         from: min,
//         to: max,
//         prefix: curr,
//         step: 1000,
//         onFinish: function(data) {
//             console.log(data);
//         }
//     });
// });


</script>
@endsection
<!-- ========== END MAIN CONTENT ========== -->
@endsection
