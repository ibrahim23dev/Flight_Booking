<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ url('assets/backend') }}/css/vendors.css">
    <link rel="stylesheet" href="{{ url('assets/backend') }}/css/main.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
         @media print {
	
	@page {

        margin-bottom: 0;
    }
      body, .tavles_div {
        display: block !important;
        position: relative !important;
        width: auto !important;
        height: auto !important;
        overflow: visible !important;
        margin-left: 0 !important;
   }
   
}
    </style>
    <title>Flight connection internationl</title>
</head>

<body>
    <div class="preloader js-preloader">
        <div class="preloader__wrap">
            <div class="preloader__icon">
                <svg width="38" height="37" viewBox="0 0 38 37" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_41)">
                        <path
                            d="M32.9675 13.9422C32.9675 6.25436 26.7129 0 19.0251 0C11.3372 0 5.08289 6.25436 5.08289 13.9422C5.08289 17.1322 7.32025 21.6568 11.7327 27.3906C13.0538 29.1071 14.3656 30.6662 15.4621 31.9166V35.8212C15.4621 36.4279 15.9539 36.92 16.561 36.92H21.4895C22.0965 36.92 22.5883 36.4279 22.5883 35.8212V31.9166C23.6849 30.6662 24.9966 29.1071 26.3177 27.3906C30.7302 21.6568 32.9675 17.1322 32.9675 13.9422V13.9422ZM30.7699 13.9422C30.7699 16.9956 27.9286 21.6204 24.8175 25.7245H23.4375C25.1039 20.7174 25.9484 16.7575 25.9484 13.9422C25.9484 10.3587 25.3079 6.97207 24.1445 4.40684C23.9229 3.91841 23.6857 3.46886 23.4347 3.05761C27.732 4.80457 30.7699 9.02494 30.7699 13.9422ZM20.3906 34.7224H17.6598V32.5991H20.3906V34.7224ZM21.0007 30.4014H17.0587C16.4167 29.6679 15.7024 28.8305 14.9602 27.9224H16.1398C16.1429 27.9224 16.146 27.9227 16.1489 27.9227C16.152 27.9227 23.0902 27.9224 23.0902 27.9224C22.3725 28.8049 21.6658 29.6398 21.0007 30.4014ZM19.0251 2.19765C20.1084 2.19765 21.2447 3.33365 22.1429 5.3144C23.1798 7.60078 23.7508 10.6649 23.7508 13.9422C23.7508 16.6099 22.8415 20.6748 21.1185 25.7245H16.9322C15.2086 20.6743 14.2994 16.6108 14.2994 13.9422C14.2994 10.6649 14.8706 7.60078 15.9075 5.3144C16.8057 3.33365 17.942 2.19765 19.0251 2.19765V2.19765ZM7.28053 13.9422C7.28053 9.02494 10.3184 4.80457 14.6157 3.05761C14.3647 3.46886 14.1273 3.91841 13.9059 4.40684C12.7425 6.97207 12.102 10.3587 12.102 13.9422C12.102 16.7584 12.9462 20.7176 14.6126 25.7245H13.2259C9.33565 20.6126 7.28053 16.5429 7.28053 13.9422Z"
                            fill="#3554D1" />
                    </g>

                    <defs>
                        <clipPath id="clip0_1_41">
                            <rect width="36.92" height="36.92" fill="white" transform="translate(0.540039)" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
        </div>

        <div class="preloader__title">FCI</div>
    </div>

    <main>

        <section class="pt-20 layout-pb-lg bg-blue-2">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-xl-10 col-lg-11">
                        <div class="d-flex justify-end">
           
                            <button class="button h-50 px-24 -dark-1 bg-blue-1 text-white" onclick="printDiv('main_div')">
                              Print
                              <i class="icon-bed text-20 ml-10"></i>
                            </button>
                          </div>
                        <div class="bg-white rounded-4 mt-5" id="main_div">
                            <div class="pt-20 layout-pb-lg px-50">
                                <div class="row justify-between">
                                    <div class="col-auto">
                                        <img src="{{ url('assets/frontend') }}/img/general/fci dark.svg"
                                            alt="logo icon">
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="row justify-between items-center">
                                            <div class="col-auto">
                                                <div class="text-26 fw-600">PNR #</div>
                                            </div>

                                            <div class="col-auto">
                                                <div class="text-18 fw-500 text-light-1">{{ $ticket['pnr_no'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{-- 
                                <div class="row justify-between pt-20">
                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">Booking Date</div>
                                        <div class="text-15 fw-500 lh-15">
                                            {{ date('Y-m-d', strtotime($ticket['created_at'])) }}</div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="text-15 text-light-1">Booking Time</div>
                                        <div class="text-15 fw-500 lh-15">
                                            {{ date('h-i a', strtotime($ticket['created_at'])) }}</div>
                                    </div>
                                </div>

                                <div class="row justify-between pt-20">
                                    <div class="col-auto">
                                        <div class="text-20 fw-500">Payments</div>
                                        <div class="text-15 fw-500 mt-10">Status: {{ $ticket['payment_status'] }}</div>
                                        <div class="text-15 fw-500 mt-10">Method: {{ $ticket['payment_method'] }}</div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="text-20 fw-500">Customer</div>
                                        <div class="text-15 fw-500 mt-10">
                                            {{ $ticket['p_name'] . ' ' . $ticket['p_surname'] }}</div>
                                        <div class="text-15 fw-500 mt-10">{{ $ticket['email'] }}</div>
                                    </div>
                                </div> --}}

                                <div class="text-20 fw-500 mt-5">Passengers:</div>

                                <div class="row pt-20">
                                    <div class="col-12 table-responsive">
                                        <table class="table col-12">
                                            <thead class="bg-blue-1-05 text-blue-1">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Name</th>
                                                    <th>Sur Name</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ticket['passengers'] as $key => $passenger)
                                                    <tr>

                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $passenger['title'] }}</td>
                                                        <td>{{ $passenger['name'] }}</td>
                                                        <td>{{ $passenger['surname'] }}</td>
                                                        <td>{{ $passenger['passType'] }}</td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- tickets section  --}}
                                <div class="text-20 fw-500 mt-5">Ticket:</div>


                                <div class="js-accordion">
                                    <div class="accordion__item py-30 px-30 bg-white rounded-4 base-tr"
                                        data-x="flight-item-1" data-x-toggle="shadow-2">
                                        <div class="row y-gap-30 justify-between">
                                            <div class="col">
                                                @php
                                                    $details=json_decode($ticket['details'],true);
                                                @endphp
                                                @foreach ($details as $key=> $flight)
                                                <div class="col-auto">
                                                    @if ($key==0)
                                                       <span class="text-left"> {{' Outbound:'}}  </span>
                                                       
                                                       @foreach ($airlines as $airline)
                                                       @if ($airline['iata'] == $flight['Airline'])
                                                       <span class="text-blue-1">{{ $airline['name'] }}</span>
                                                       @endif
   
                                                   @endforeach
                                                   @else
                                                   <span class="text-left">  {{'Inbound:'}}</span>
                                                   @php
                                                   foreach ($airlines as $airline):
                                                       if($airline['iata'] == $flight['Airline']) {
                                                           echo '<span class="text-blue-1">'.$airline['name'].'</span>';
                                                       }
                                                   endforeach;
                                                   @endphp
                                                  @endif
                                               </div>
                                                <div class="row y-gap-10 items-center">
                                                

                                                    
                                                    <div class="col">
                                                        <div class="row x-gap-20 items-end">
                                                            <div class="col-sm-auto">
                                                                <img class="size-40"
                                                                    src="{{$flight['AirlineLogo']}}"
                                                                    alt="image">
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="lh-15 fw-500">{{$flight['DepartureTime']}}</div>
                                                                <div class="text-15 lh-15 text-light-1">{{$flight['Departure']}}</div>
                                                            </div>

                                                            <div class="col text-center">
                                                                <div class="text-15 lh-15 text-light-1 mt-10">Class:
                                                                    <span class="text-blue-1">{{$flight['FlightClassCode']}}</span></div>
                                                                {{-- <div class="flightLine">
                                                                    <div></div>
                                                                    <div></div>
                                                                </div> --}}
                                                               <i class="fa-solid fa-plane {{$key==1 ?'fa-rotate-180':''}} "></i>
                                                                <div class="text-15 lh-15 text-light-1 mt-10">
                                                                    {{$flight['FlightDate']}}</div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="lh-15 fw-500">{{$flight['ArrivalTime']}}</div>
                                                                <div class="text-15 lh-15 text-light-1">{{$flight['Arrival']}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-auto" style="border-left:1px solid #DDDDDD">                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                        : {{$flight['FreeBaggage']}}
                                                        <br>
                                                        Flight No: {{$flight['FlightNo']}}
                                                    </div>
                                                     </div>
                                                @endforeach

                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>




    <!-- JavaScript -->
    <!-- datatables -->
    <script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}

	</script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- bootstrap cdn -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <!-- --- -->
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script src="{{ url('assets/backend') }}/js/chart.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>

    <script src="{{ url('assets/backend') }}/js/vendors.js"></script>
    <script src="{{ url('assets/backend') }}/js/main.js"></script>

</body>


<!-- Mirrored from creativelayers.net/themes/gotrip-html/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 May 2023 04:57:50 GMT -->

</html>
