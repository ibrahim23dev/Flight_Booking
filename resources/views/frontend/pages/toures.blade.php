@extends('frontend.layouts.main')
@section('main-container')
    

    <!---------------------- Destination Area Start -------------------->
    <section class="destinations py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2><span>Latest Toures {{ request('tour') && request('tour')!='' ? 'In '.request('tour') : '' }} </span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme" id="destination-slider">
                    @if (!empty($packages))
                        
                    @foreach ($packages as $package)
                        
                    <div class="item p-3">
                        <a href="{{ route('tours.single', $package->package_id) }}">

                        <div class="tour-packageWrapper" >
                            <div class="thumb">
                                <img src="{{ asset('storage/'.$package->image) }}"
                                    alt="{{ $package->package_category_name }}" class="img-fluid" />
                            </div>

                            <div class="wrapper-content" title="{{ $package->package_name }}">
                                <b>{{ Str::words($package->package_name, 8, '...') }}</b>
                                <p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                           <span class="text-dark fw-700">Price:</span> {{ number_format($package->total_package_price) }}-{{ $package->packageCategory->currency }}
                                        </div>
                                        <div>
                                             <span class="text-dark fw-700">Duration</span>: {{ $package->duration }} Days
                                        </div>
                                    </div>
                                    
                               </p>
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
