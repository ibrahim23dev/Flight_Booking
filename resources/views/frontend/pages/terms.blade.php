@include('frontend.layouts.header-search')

<!-- ========== MAIN CONTENT ========== -->
<main id="content">

    <div class=" terms_tab border-bottom border-color-8 pt-lg-1">
        <div class="container mb-4 mb-lg-11 pb-lg-1">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3">
                    <div class="py-4 border border-color-7 rounded-xs mb-4 mb-md-0">
                        <h6 class="text-gray-6 font-weight-bold font-size-17 px-4 ml-xl-1 mt-xl-1 mb-4 pb-1">Navigation</h6>
                        <!-- Tab Wrapper -->
                        <div class="tab-wrapper shadow-none">
                            <ul class="nav flex-column mb-0 tab-nav-list" id="pills-tab" role="tablist">
                                @foreach ($terms as $key=>$value)
                                    
                                <li class="nav-item mx-0 mb-2 pb-1">
                                    <a class="nav-link px-4 d-flex align-items-center @if ($key === 0) active @endif" id="pills-{{$key}}-example1-tab" data-toggle="pill" href="#pills-{{$key}}-example1" role="tab" aria-controls="pills-{{$key}}-example1" aria-selected="true">
                                        <i class="fas fa-chevron-right font-size-12 mr-1 text-gray-3"></i>
                                        <span class="font-weight-normal ml-1 text-gray-1">{{ $value->title }}</span>
                                    </a>
                                </li>
                                @endforeach


                            </ul>
                            <!-- Tab Content -->
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="tab-content" id="pills-tabContent">
                    @foreach ($terms as $subKey=>$subValue)
                        <div class="tab-pane fade show  @if ($subKey === 0) active @endif" id="pills-{{$subKey}}-example1" role="tabpanel" aria-labelledby="pills-{{$subKey}}-example1-tab">
                        @foreach (json_decode($subValue->points) as $p=> $point)
                            <h4 class="text-size-21 font-weight-semi-bold text-gray-3 mb-3 pb-1">{{ $point->heading }}</h4>
                            <p class="text-lh-lg text-gray-1">{{ $point->description }} </p>
                        @endforeach
                           
                        </div>
                    @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
