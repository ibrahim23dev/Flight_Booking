@php
$dictionaries = Session::get('dictionaries');
    
@endphp

<div class="col-lg-4 col-xl-3">
    <div class="shadow-soft bg-white rounded-sm">
        @foreach ($selectedFlightData->itineraries as $itiKey => $iti)
            @php
                $segmentsCount = $iti->segments;

                $num_segments = count($segmentsCount);

                $first_segment = $segmentsCount[0];

                $last_segment = $segmentsCount[$num_segments - 1];
            @endphp
            <div class="pt-5 pb-3 px-2 border-bottom">
                <a href="#" class="d-flex justify-content-center">
                    <img class="img-fluid rounded-xs"
                        src="{{ url('assets/frontend/img/airlines/' . $first_segment->carrierCode) }}.png"
                        alt="Image-Description" style="width: 5rem">
                </a>

                <div class="flex-content-center flex-column mb-1">
                    <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0">
                        {{ formatDuration($iti->duration) }}</h6>
                    <div class="width-60 border-top border-primary border-width-2 my-1"></div>
                    <div class="font-size-14 text-gray-1">
                   
                        <button type="button"
                                class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                data-toggle="collapse" data-target="#basicsCollapseTwo-{{$itiKey}}"
                                aria-expanded="true" aria-controls="basicsCollapseTwo-{{$itiKey}}">
                               
                                {{ $num_segments > 1 ? $num_segments-1 . ' Stops' : 'Non-Stop' }} 

                                <span class="card-btn-arrow font-size-14 text-dark">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                        </button>

                    <div id="basicsCollapseTwo-{{$itiKey}}" class="collapse" aria-labelledby="basicsHeadingOne"
                            data-parent="#basicsAccordion">
                            @foreach ($iti->segments as $segKey => $segment)
                            <div class="row pt-0">
                            
                                <div class="flex-horizontal-center justify-content-between w-100">
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i class="flaticon-aeroplane font-size-14 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 class="font-weight-bold font-size-12 text-gray-5 mb-0">
                                                {{ formatTime($segment->departure->at, 'H:i') }}</h6>
                                            <span
                                                class="font-size-12 font-weight-normal text-gray-1">{{ $segment->departure->iataCode }}</span>
                                        </div>
                                    </div>
    
                                    <div class="flex-horizontal-center">
                                        <div class="mr-2">
                                            <i class="d-block rotate-90 flaticon-aeroplane font-size-14 text-primary"></i>
                                        </div>
                                        <div class="text-lh-sm ml-1">
                                            <h6 class="font-weight-bold font-size-12 text-gray-5 mb-0">
                                                {{ formatTime($segment->arrival->at, 'H:i') }}</h6>
                                            <span
                                                class="font-size-12 font-weight-normal text-gray-1">{{ $segment->arrival->iataCode }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                     </div>

                    </div>
                </div>
                <div class="flex-horizontal-center" style="justify-content: space-evenly">
                    <div class="flex-horizontal-center">
                        <div class="mr-2">
                            <i class="flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ formatTime($first_segment->departure->at, 'H:i') }}</h6>
                            <span
                                class="font-size-14 font-weight-normal text-gray-1">{{ $first_segment->departure->iataCode }}</span>
                        </div>
                    </div>

                    <div class="flex-horizontal-center">
                        <div class="mr-2">
                            <i class="d-block rotate-90 flaticon-aeroplane font-size-30 text-primary"></i>
                        </div>
                        <div class="text-lh-sm ml-1">
                            <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0">
                                {{ formatTime($last_segment->arrival->at, 'H:i') }}</h6>
                            <span
                                class="font-size-14 font-weight-normal text-gray-1">{{ $last_segment->arrival->iataCode }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Basics Accordion -->
        <div id="basicsAccordion">
            <!-- Card -->
          
                <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                    <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingOne">
                        <h5 class="mb-0">
                            <button type="button"
                                class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                                data-toggle="collapse" data-target="#basicsCollapseOne"
                                aria-expanded="true" aria-controls="basicsCollapseOne">
                                Booking Detail

                                <span class="card-btn-arrow font-size-14 text-dark">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                  
                    <div id="basicsCollapseOne" class="collapse " aria-labelledby="basicsHeadingOne"
                        data-parent="#basicsAccordion">
                        <div class="card-body px-4 pt-0">
                            <!-- Fact List -->
                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                @foreach ($selectedFlightData->itineraries as $itiKey => $iti)
                                @php
                                    $segmentsCount = $iti->segments;
    
                                    $num_segments = count($segmentsCount);
    
                                    $first_segment = $segmentsCount[0];
    
                                    $last_segment = $segmentsCount[$num_segments - 1];
                                @endphp
                                
                                 <li class="d-flex justify-content-center py-2">
                                     <span class="font-weight-medium text-primary"></span>
                                     <span
                                         class="text-secondary"></span>
                                 </li>
                                @if ($itiKey==0)
                                    
                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Airline</span>
                                    <span class="text-secondary text-right">

                                        {{ $dictionaries->carriers->{$first_segment->carrierCode} }}

                                    </span>
                                </li>
                                
                                @endif

                            
                            @endforeach


                                <li class="d-flex justify-content-between py-2">
                                    <span class="font-weight-medium">Flight type</span>
                                    <span
                                        class="text-secondary">{{ session('searchParams.return_date')!='' ?'Round': 'OneWay' }}</span>
                                </li>


                            </ul>
                            <!-- End Fact List -->
                        </div>
                    </div>

                </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingThree">
                    <h5 class="mb-0">
                        <button type="button"
                            class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                            data-toggle="collapse" data-target="#basicsCollapseThree"
                            aria-expanded="true" aria-controls="basicsCollapseThree">
                            Baggage Details

                            <span class="card-btn-arrow font-size-14 text-dark">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </h5>
                </div>
              
                <div id="basicsCollapseThree" class="collapse " aria-labelledby="basicsHeadingThree"
                    data-parent="#basicsAccordion">
                    <div class="card-body px-4 pt-0">
                        <!-- Fact List -->
                        <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                           
                               @php
                               $displayedTypes = [];
                             @endphp
                            <li class="d-flex justify-content-center py-2">
                                <span class="font-weight-medium text-primary"></span>
                                <span
                                    class="text-secondary"></span>
                            </li>
                           @foreach ($selectedFlightData->travelerPricings as $priceData)
                               @if (!in_array($priceData->travelerType, $displayedTypes))
                            
                            
                             <li class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium">Per {{ $priceData->travelerType =='HELD_INFANT' ?'Infant' : $priceData->travelerType }}</span>
                              
                                @if (isset($priceData->fareDetailsBySegment[0]->includedCheckedBags))
                                <span class="text-secondary">
                                   
                                @php
                                $weight = $priceData->fareDetailsBySegment[0]->includedCheckedBags->weight ?? '';
                                $weightUnit = $priceData->fareDetailsBySegment[0]->includedCheckedBags->weightUnit ?? '';

                                if (empty($weight) && empty($weightUnit)) {
                                    $quantity = $priceData->fareDetailsBySegment[0]->includedCheckedBags->quantity ?? '';
                                    echo $quantity;
                                } else {
                                    echo $weight . ' ' . $weightUnit;
                                }
                                @endphp

                                </span>
                            @endif

                            </li>
                            @php
                            $displayedTypes[] = $priceData->travelerType;
                            @endphp
                             @endif
                             @endforeach
                            
                        </ul>
                        <!-- End Fact List -->
                    </div>
                </div>

            </div>
            <!-- End Card -->

            <!-- Card -->
            <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
                <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingFour">
                    <h5 class="mb-0">
                        <button type="button"
                            class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark"
                            data-toggle="collapse" data-target="#basicsCollapseFour"
                            aria-expanded="false" aria-controls="basicsCollapseFour">
                            Payment

                            <span class="card-btn-arrow font-size-14 text-dark">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </button>
                    </h5>
                </div>
                <div id="basicsCollapseFour" class="collapse" aria-labelledby="basicsHeadingFour"
                    data-parent="#basicsAccordion">
                    <div class="card-body px-4 pt-0">
                        <!-- Fact List -->
                        <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                            <li class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium">Base Price</span>
                                <span
                                    class="text-secondary">{{ getCurrencySymbol($selectedFlightData->price->currency) . '  ' . $selectedFlightData->price->base }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2">
                                <span class="font-weight-medium">Taxes</span>
                                <span
                                    class="text-secondary">{{ getCurrencySymbol($selectedFlightData->price->currency) . '  ' . $selectedFlightData->price->total - $selectedFlightData->price->base }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                <span class="font-weight-bold">Pay Amount</span>
                                <span
                                    class="">{{ getCurrencySymbol($selectedFlightData->price->currency) . '  ' . $selectedFlightData->price->grandTotal }}</span>
                            </li>
                        @if (isset($result))
                                <hr>
                            <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                <span class="font-weight-bold">PNR No</span>
                                <span
                                    class="">{{ $result->pnr_no }}</span>
                            </li>

                            <li class="d-flex justify-content-between py-2 font-size-17 font-weight-bold">
                                <span class="font-weight-bold">ID</span>
                                <span
                                    class="">{{ $result->queuingOfficeId }}</span>
                            </li>
                        @endif

                        </ul>
                        <!-- End Fact List -->
                    </div>
                </div>
            </div>
            
            <div class="bg-primary p-3"><i class="fas fa-clock mr-2"></i> Time remaining: <span id="timer">19:13</span></div>
            <!-- End Card -->
        </div>
        <!-- End Basics Accordion -->
    </div>
</div>

<div class="modal fade" id="priceChangeModal" tabindex="-1" role="dialog" aria-labelledby="priceChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="priceChangeModalLabel">Timeout</h5>
                <!-- Remove the close button from the header -->
            </div>
            <div class="modal-body">
                <p>Request timeout you need to refresh results now .</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="refreshPage()">Refresh</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('timer').innerHTML =
        15 + ":" + 01;
    startTimer();


    function startTimer() {
        var presentTime = document.getElementById('timer').innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        var m = timeArray[0];
        var s = checkSecond((timeArray[1] - 1));
        if(s==59){m=m-1}
        if(m<0){
            return
        }

        //show alert when time reaches to zeror
        if(m==00 && s== 00){

            // Function to show the modal

                $('#priceChangeModal').modal({
                    backdrop: 'static', // Prevents closing when clicking outside the modal
                    keyboard: false,     // Prevents closing with the keyboard
                });

                // Disable right-click on the whole document
                document.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                });

        }

        document.getElementById('timer').innerHTML =
            m + ":" + s;
        // console.log(m,s)
        setTimeout(startTimer, 1000);

    }

    function checkSecond(sec) {
        if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
        if (sec < 0) {sec = "59"};
        return sec;
    }
      // Function to refresh the page
      const refreshPage = () => {
        location.reload();
    };
</script>