<form class="position-relative" action="{{ route('flight-list') }}">
    @if(!empty($data))
                    <?php

                    $journeyType = $data['journeyType'] ?? '';
                    $departureFull = $data['departureFull'] ?? '';
                    $arrivalFull = $data['arrivalFull'] ?? '';
                    $departureCode = $data['departureCode'] ?? '';
                    $arrivalCode = $data['arrivalCode'] ?? '';
                    $departureDate = $data['departureDate'] ?? '';
                    $returnDate = $data['returnDate'] ?? '';
                    $adult = $data['adult'] ?? 0;
                    $child = $data['child'] ?? 0;
                    $infant = $data['infant'] ?? 0;
                    $travelClass = $data['travelClass'] ?? ''; 
                    $totalPax = $adult + $child + $infant;
                    $fromArray=$data['from'];
                    $toArray=$data['to'];
                    $multiDatesArray=$data['multiDatesArray'];
                    ?>
                @else
                    <?php
                    // Set default values
                    $journeyType = 1;
                    $departureFull = '';
                    $arrivalFull = '';
                    $departureCode = '';
                    $arrivalCode = '';
                    $departureDate = '';
                    $returnDate = '';
                    $adult = 1;
                    $child = 0;
                    $infant = 0;
                    $travelClass = 'Economy';
                    $totalPax = 1;
                    $fromArray=[];
                    $toArray=[];
                    $multiDatesArray=[];
                    
                    ?>
    @endif
    <input type="hidden" name="departure_code" id="from-0_code" value="{{ $departureCode }}">
    <input type="hidden" name="arrival_code" id="to-0_code" value="{{ $arrivalCode }}">
   
  
    <input id="flt-people-adult-f" type="hidden" name="Adults" value="1" />
    <input id="flt-people-child-f" type="hidden" name="Children" value="0" />
    <input id="flt-people-infant-f" type="hidden" name="Infants" value="0" />
    <div class="search-panel">
        <div class="search-section">
            <div class="search-box flex-column mx-2">

                

                <div class="bulletpoint">
                    <div class="me-3">
                        <label class="form-check-label" for="JourneyType1">
                            <input class="form-check-input" type="radio" name="JourneyType"
                                value="1" id="JourneyType1"  {{ $journeyType=='1' ? 'checked' : '' }}>

                            One way
                        </label>
                    </div>
                    <div class="me-3">

                        <label class="form-check-label" for="JourneyType2">
                            <input class="form-check-input" type="radio" name="JourneyType" value="2"
                                id="JourneyType2" {{ $journeyType=='2' ? 'checked' : '' }}>

                            Round-trip
                        </label>
                    </div>
                    <div>

                        <label class="form-check-label" for="JourneyType3">
                            <input class="form-check-input" type="radio" name="JourneyType" value="3"
                                id="JourneyType3"  {{ $journeyType=='3' ? 'checked' : '' }}>
                            <span>Multi-city</span>
                        </label>
                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong>

                        {{ session('error') }}

                    </div>
                @endif
                <!-- end section-tab -->
                <div class="journey-details position-relative pb-3 jt-oneway" id="mc-0">

                    <div class="left-part">

                        <div class="search-body">

                            <h6>From</h6>
                            <input id="from-0" data-id="-1" value="{{ $departureFull }}" name="departure_full"
                                placeholder="Flying form airport ..."
                               type="text" class="form-control search-input"
                                autocomplete="off">

                            <div class="flt-swapper position-absolute">
                                <a href="#!" class=" ">
                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr031.svg-->
                                    <div class="swpBtn">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                    <!--end::Svg Icon-->
                                </a>
                            </div>
                        </div>

                        <div class="search-body">
                            <div class="">
                                <h6>To</h6>
                                <input id="to-0" data-id="0" name="arrival_full"
                                    placeholder="Flying to airport ..." 
                                    spellcheck="false" type="text"
                                    class="form-control search-input" autocomplete="off" value="{{ $arrivalFull }}">

                            </div>
                        </div>

                        <div class="search-body date-picker-container">
                            <h6 class="arrowDown">JOURNEY DATE</h6>
                            <input type="hidden" id="depDate" value="{{ now()->format('m/d/Y') }}" name="departure_date" />
                            <input id="dp-0" value="{{ $departureDate }}" name="dp-0" data-next=""
                                data-start="{{ now()->format('M d, Y') }}" data-end="" type="text" autocomplete="off"
                                placeholder="Depart Date" data-val-required="Depart date required" data-val="true"
                                class="form-control date-input" data-id="0">


                            <div data-valmsg-replace="true" data-valmsg-for="dp-0" class="field-validation-valid">
                            </div>
                            <div data-valmsg-replace="true" data-valmsg-for="dp-0v" class="field-validation-valid">
                            </div>

                        </div>
                        <div class="search-body date-picker-container returnDate">
                            <h6 class="arrowDown">RETURN DATE</h6>
                            <input type="hidden" id="retDate" value="{{ $returnDate }}" name="return_date" />
                            <input id="dp-1" value="{{ formatTime($returnDate,'M d, Y') }}" name="dp-1" data-next="dp-2"
                                data-start="" data-end="" readonly="readonly" type="text"
                                autocomplete="false" placeholder="Return Date"
                                data-val-required="Return date required" data-val="true"
                                class="form-control date-inputn" data-id="1">


                            <div data-valmsg-replace="true" data-valmsg-for="rt-0" class="field-validation-valid">
                            </div>
                            <div data-valmsg-replace="true" data-valmsg-for="rt-0v" class="field-validation-valid">
                            </div>

                        </div>
                        <div class="search-body">
                            <div class="round-pass">
                                <div class="passenger_info">
                                    <h6>traveller</h6>
                                    <input name="PeopleTxt" id="traveller-summary" value="{{ $totalPax }} traveller, {{ $travelClass }}"
                                        class="form-control guest-summary open-select text-truncate"
                                        placeholder="{{ $totalPax }} traveller, {{ $travelClass }}" type="text" readonly="readonly"
                                        autocomplete="off">

                                    <div class="selector-box-flight">
                                        <div class="room-cls">
                                            <div class="qty-box">
                                                <label class="me-0">adult</label>
                                                <input id="flt-people-adult" class="t-spinner text-center"
                                                    readonly="readonly" type="text" value="{{ $adult }}"
                                                    name="adult">
                                            </div>
                                            <div class="qty-box">
                                                <label class="me-0">children</label>
                                                <input id="flt-people-child" class="t-spinner text-center"
                                                    readonly="readonly" type="text" value="{{ $child }}"
                                                    name="child">
                                            </div>
                                            <div class="qty-box">
                                                <label class="me-0">infant</label>
                                                <input id="flt-people-infant" class="t-spinner text-center"
                                                    readonly="readonly" type="text" value="{{ $infant }}"
                                                    name="infant">
                                            </div>
                                        </div>
                                        <div class="flight-class pt-3">

                                            <div class="form-group">
                                                <label>Travel Class</label>
                                                <select data-control="select2" data-hide-search="true"
                                                    name="travel_class" id="travel-class-select"
                                                    class="form-select travel-class-select" data-live-search="true">
                                                    <option value="Economy" {{ $travelClass=='Economy' ? 'selected' : '' }}>Economy</option>
                                                    <option value="Business" {{ $travelClass=='Business' ? 'selected' : '' }}>Business</option>
                                                    <option value="First" {{ $travelClass=='First' ? 'selected' : '' }}>First</option>
                                                    <option value="PremiumEconomy" {{ $travelClass=='PremiumEconomy' ? 'selected' : '' }}>Premium Economy</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="" id="mc-box">
                    @php
                    if ($fromArray!=null || !empty($fromArray)) {
                       
                    // Extracting data from arrays
                    // $fromAirports = array_merge(...$fromArray);
                
                    // $toAirports = array_merge(...$toArray);
                
                    // $departureDates = array_merge(...$multiDatesArray);

                    $fromAirports =$fromArray;
                
                    $toAirports = $toArray;
                
                    $departureDates =$multiDatesArray;


                    if (!empty($departureDates) && !empty($toAirports) && !empty($fromAirports)) {
                       
                    // Loop through each set of data
                    for ($i = 0; $i < count($fromAirports); $i++) {
                        // Check if any value is empty
                        if (!empty($fromAirports[$i]) && !empty($toAirports[$i]) && !empty($departureDates[$i])) {
                            // Create separate variables for each group
                            ${'from_' . $i} = $fromAirports[$i];
                            ${'to_' . $i} = $toAirports[$i];
                            ${'departure_date_' . $i} = $departureDates[$i];
                        } 
                    }
                }
            }

                @endphp
                
                    <div class="left-part mc-boxes jt-oneway" id="mc-2" style="display:none">
                        <input id="s-2" class="journey-sn" type="hidden" value="-1"
                            name="OriginDestinationInformation[2].SequenceNumber" />
                        <div class="search-body">
                            <input id="s-0" type="hidden" value="-1"
                                name="OriginDestinationInformation[0].SequenceNumber" />
                            <h6>from</h6>
                            <input id="from-2" data-id="-1"
                                name="from[]"
                                placeholder="Flying form airport ..." data-val-required="Flying from is required"
                                data-val="true" spellcheck="false" type="text"
                                class="form-control search-input" autocomplete="off"
                                value="{{ isset($from_0) ? $from_0 : '' }}">
                            
                            
                        </div>
                        <div class="search-body">
                            <div class="">
                                <h6>To</h6>
                                <input id="to-2" data-id="2"
                                    name="to[]"
                                    placeholder="Flying to airport ..." data-val-required="Flying to is required"
                                    data-val="true" spellcheck="false" type="text"
                                    class="form-control search-input to-lookup"
                                    autocomplete="off"
                                    value="{{ isset($to_0) ? $to_0 : '' }}">
                             
                            </div>
                        </div>
                        <div class="search-body">
                            <h6>departure</h6>

                            <input type="hidden" value="03/03/2024"
                                name="OriginDestinationInformation[2].DepartureDateTime" />
                            <input id="dp-2" data-next="dp-3" data-id="2" 
                                name="multi_departure_date[]" data-start="Feb 26, 2024" data-end="Feb 26, 2025" readonly="readonly"
                                type="text" autocomplete="false" placeholder="Depart Date"
                                data-val-required="Depart date required" data-val="true"
                                class="form-control date-input date-inputn ms" value="{{ isset($departure_date_0) ? formatTime($departure_date_0,'M d, Y') :now()->format('M d, Y') }}">
                            <span data-valmsg-replace="true" data-valmsg-for="dp-2"
                                class="field-validation-valid"></span>
                        </div>
                        <div class="search-body">
                            <div class="multi-pass">

                            </div>
                        </div>
                    </div>

                    <div class="left-part mc-boxes jt-oneway" id="mc-3" style="display:none">
                        <input id="s-3" class="journey-sn" type="hidden" value="-1"
                            name="OriginDestinationInformation[3].SequenceNumber" />
                        <div class="search-body">
                            <input id="s-0" type="hidden" value="-1"
                                name="OriginDestinationInformation[0].SequenceNumber" />
                            <h6>from</h6>
                            <input id="from-3" data-id="-1"
                                name="from[]"
                                placeholder="Flying form airport ..." data-val-required="Flying from is required"
                                data-val="true" spellcheck="false" type="text"
                                class="form-control search-input" autocomplete="off"
                                value="{{ isset($from_1) ? $from_1 : '' }}">
                          
                        </div>
                        <div class="search-body">
                            <div class="">
                                <h6>To</h6>
                                <input id="to-3" data-id="3"
                                    name="to[]"
                                    placeholder="Flying to airport ..." data-val-required="Flying to is required"
                                    data-val="true" spellcheck="false" type="text"
                                    class="form-control search-input to-lookup"
                                    autocomplete="off"
                                    value="{{ isset($to_1) ? $to_1 : '' }}">
                                
                            </div>
                        </div>
                        <div class="search-body">
                            <h6>departure</h6>

                            <input type="hidden" value="03/06/2024"
                                name="OriginDestinationInformation[3].DepartureDateTime" />
                            <input id="dp-3" data-next="dp-4" data-id="3" 
                                name="multi_departure_date[]" data-start="Feb 26, 2024" data-end="Feb 26, 2025" readonly="readonly"
                                type="text" autocomplete="false" placeholder="Depart Date"
                                data-val-required="Depart date required" data-val="true"
                                class="form-control date-input date-inputn ms"
                                value="{{ isset($departure_date_1) ? formatTime($departure_date_1,'M d, Y') : now()->format('M d, Y') }}">
                            <span data-valmsg-replace="true" data-valmsg-for="dp-3"
                                class="field-validation-valid"></span>
                        </div>
                        <div class="search-body bg-transparent bgWhite border-0">
                            <a href="#" id="r-3" data-id="3"
                                class="city-remove-btn me-2 btn btn-danger d-none" style="display: none;"><i
                                    class="fa-remove fa"></i></a>
                            <a href="#" id="a-3" data-id="3" class="btn btn-primary city-add-btn "
                                style="display: none;"><i class="fa-plus fa"></i></a>
                        </div>
                    </div>

                    <div class="left-part mc-boxes jt-oneway" id="mc-4"  style="{{ isset($from_2) ? '' : 'display:none' }}">
                       
                        <div class="search-body">
                           
                            <h6>from</h6>
                            <input id="from-4" data-id="-1"
                                name="from[]"
                                placeholder="Flying form airport ..." data-val-required="Flying from is required"
                                data-val="true" spellcheck="false" type="text"
                                class="form-control search-input remove-value" autocomplete="off"
                                value="{{ isset($from_2) ? $from_2 : '' }}">
                           
                        </div>
                        <div class="search-body">
                            <div class="">
                                <h6>To</h6>
                                <input id="to-4" data-id="4"
                                    name="to[]"
                                    placeholder="Flying to airport ..." data-val-required="Flying to is required"
                                    data-val="true" spellcheck="false" type="text"
                                    class="form-control search-input to-lookup remove-value"
                                    autocomplete="off"
                                    value="{{ isset($to_2) ? $to_2 : '' }}">
                               
                            </div>
                        </div>
                        <div class="search-body">
                            <h6>departure</h6>

                            <input type="hidden" value="01/01/0001"
                                name="OriginDestinationInformation[4].DepartureDateTime" />
                            <input id="dp-4" data-next="dp-5" data-id="4"
                                name="multi_departure_date[]" data-start="Feb 26, 2024" data-end="Feb 26, 2025" readonly="readonly"
                                type="text" autocomplete="false" placeholder="Depart Date"
                                data-val-required="Depart date required" data-val="true"
                                class="form-control date-input date-inputn ms"
                                value="{{ isset($departure_date_2) ? formatTime($departure_date_2,'M d, Y') : now()->format('M d, Y')}}">
                            <span data-valmsg-replace="true" data-valmsg-for="dp-4"
                                class="field-validation-valid"></span>
                        </div>
                        <div class="search-body bg-transparent bgWhite border-0">
                            <a href="#" id="r-4" data-id="4"
                                class="city-remove-btn me-2 btn btn-danger "  style="{{ isset($from_2) ? '' : 'display:none' }}"><i
                                    class="fa-remove fa"></i></a>
                            <a href="#" id="a-4" data-id="4" class="btn btn-primary city-add-btn "
                            style="{{ isset($from_2) ? '' : 'display:none' }}"><i class="fa-plus fa"></i></a>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

    </div>
    <div class="search-button d-flex justify-content-center">
       
        <button type="submit" class="button ladda-button has-spinner" data-style="zoom-in"><span class="button-text"> Search Flight</span></button>
    </div>
   
</form>
