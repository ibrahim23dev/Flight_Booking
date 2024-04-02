@extends('frontend.layouts.main')
@section('main-container')
   @section('styles')

    <style>
           .package-content table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .package-content th,
        .package-content td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .package-content thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .package-content tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
    </style>

   @endsection
    <!---------------------- Destination Area Start -------------------->
    <section class="destinations py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2><span> {{ $package->package_name }} </span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="tour-image">
                    <img src="{{ asset('storage/'.$package->image) }}"
                                    alt="{{ $package->packageCategory->location }}" class="w-100 br-5" />
                    </div>
                </div>
                <div class="col-lg-6">

                    <h3> {{ $package->package_name }}</h3>
                    <h5 class="mt-2"><b>Duration: </b> {{ $package->duration }} Days</h5>
                    <h5 class="mt-2"><b>price: </b> {{ number_format($package->total_package_price) }}-{{ $package->packageCategory->currency }}</h5>
                    <h5 class="mt-2"><b>Availability: </b>

                        <span> {{ $package->status=='active' ? 'Available' : 'Not-Available' }}
                        </span>
                        </h5>

                        @if ($package->status=='active')
                            
                        <div class="continue-btn text-center mb-2">
                   
                            <a href="{{ route('tours.book',$package->package_id) }}" class="button ladda-button m-auto has-spinner" data-style="slide-left"><span class="button-text">Proceed to Booking</span></a>

                        </div>

                        @endif

                </div>
            </div>

            <div class="row col-lg-12">
              
                <h2 class="mt-2"><span><b class="main-color"> About Package  </b></span></h2>
                    
                <div class="package-content">
                    {!! $package->description !!}
                </div>
            </div>
        </div>
    </section>

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
