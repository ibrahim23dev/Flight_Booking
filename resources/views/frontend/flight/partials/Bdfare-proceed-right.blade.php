<div class="col-lg-4 res-margin">
    <div class="sticky-cls-top">
        <div class="review-section" id="summary">

            {{-- <div class="review_box">
                <div class="title-top position-relative">
                    <h5>Time Remaining</h5>
                </div>
                <div id="countdown-box" class="time-counter">
                    <ul>
                        <li><i class="fa-regular fa-clock me-2"></i><span id="count-down">10 min 33 sec
                            </span></li>
                    </ul>

                    <span>In this session</span>
                </div>
            </div> --}}


            <div class="review_box">
                <div class="title-top position-relative">
                    <h5>booking summery</h5>
                    {{-- <a href="#" title="Change Flight"
                        class="back-to-search-link btn btn-solid rounded text-capitalize"><i
                            class="fa-solid fa-edit"></i></a> --}}

                </div>
                <div class="flight_detail">
                    <div class="summery_box">
                        <table class="table table-sm">

                            <tbody>
                                @foreach ($selectedFlightData->offer->fareDetailList as $fareKey=> $fareList)
                                    
                                <tr>
                                    <td><a href="#" class="dropdown-link fw-bold text-body"
                                            data-cls="Adult-{{$fareKey}}">{{ $fareList->fareDetail->paxType }} X {{ $fareList->fareDetail->paxCount }} <i
                                                class="fas fa-chevron-down"></i></a></td>
                                    <td class="text-end"><small>USD </small> <strong>{{ number_format(bdt_to_usd($fareList->fareDetail->subTotal)) }}</strong></td>
                                </tr>
                                <tr style="font-size:.9em;" class="Adult-{{$fareKey}}">
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-6">Base Fare</div>
                                            <div class="col-6 text-end gray"><small>USD</small>
                                                {{ number_format(bdt_to_usd($fareList->fareDetail->baseFare)) }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                Taxes
                                            </div>
                                            <div class="col-6 text-end gray"><small>USD</small>  {{ number_format(bdt_to_usd($fareList->fareDetail->tax)) }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">AIT</div>
                                            <div class="col-6 text-end gray"><small>USD</small> {{ number_format(bdt_to_usd($fareList->fareDetail->vat)) }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">Discount</div>
                                            <div class="col-6 text-end gray"><small>USD</small> {{ number_format(bdt_to_usd($fareList->fareDetail->discount)) }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><strong>{{ $fareList->fareDetail->paxType }} Single</strong></div>
                                            <div class="col-6 text-end gray"><small>USD</small>
                                                <strong>{{
                                                       number_format(bdt_to_usd($fareList->fareDetail->subTotal)/$fareList->fareDetail->paxCount)
                                                    }}</strong></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                               
                                <tr style="font-size:15px;">
                                    <td style="border:0"><strong>Payable</strong></td>
                                    <td style="border:0" class="text-end gray"><small>USD</small> <strong
                                            id="payable">{{ number_format(bdt_to_usd($selectedFlightData->offer->price->totalPayable->total)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex flex-column mt-3 pt-3 align-items-center promo-section"
                        style="border-top: 1px solid #ccc;">
                        <div class="fw-bold">
                            Have A Promo Code?
                        </div>

                        <input class="form-control my-2 text-center" id="promoCode" type="text"
                            placeholder="Enter Promo Code">

                        <button data-bookingid="35" id="promoApplyBtn" type="button"
                            class="button ladda-button" data-style="slide-left">
                            APPLY CODE
                        </button>
                      
                    </div>
                    <hr id="hrtaghide">
                   
                </div>
            </div>

        </div>
    </div>
</div>