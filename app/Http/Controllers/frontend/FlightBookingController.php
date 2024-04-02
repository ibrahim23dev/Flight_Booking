<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\ModuleApiSetting;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\CommissionSetting;
use App\Models\FlightBooking;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

use Carbon\Carbon;

class FlightBookingController extends Controller
{
    public function book(Request $request){
       
        if ($request->isMethod('post')) {

            $selectedFlightData = json_decode($request->input('selectedFlightData',true));
           
            // Check if either dictionaries or traceId are present in the request
        if ($request->has('dictionaries') || $request->has('traceId')) {
            $dictionaries = $request->has('dictionaries') ? json_decode($request->input('dictionaries')) : null;
            $traceId = $request->has('traceId') ? $request->input('traceId') : null;

            // Set data in session
            Session::put('selectedFlightData', $selectedFlightData);
            if ($dictionaries !== null) {
                Session::put('dictionaries', $dictionaries);
            }
            if ($traceId !== null) {
                Session::put('traceId', $traceId);
            }
        } else {
            return redirect()->route('home');
        }
        
        // Redirect to the booking page
        return redirect()->route('/flight-book');
    } elseif(session()->has('selectedFlightData')) {
            // Retrieve the selected data from the session
            $selectedFlightData = Session::get('selectedFlightData');
            $dictionaries= Session::get('dictionaries');
            $apiMethodName = Session::get('apiMethodName');
            $traceId = Session::get('traceId');

            $countries=Countries::all();
            $paymentGateWays=PaymentGateway::where('status','active')->get();
            // echo "<pre>";print_r($selectedFlightData);exit;

             // Display the booking page with the selected data
            return view('frontend/flights/'.$apiMethodName.'/proceed', compact('selectedFlightData','countries','dictionaries','traceId','paymentGateWays'));
        }else{
            return redirect()->route('home');
        }
    }

    public function bookingForm(Request $request){
      
        $request->validate([
            'first_name.*' => ['required', 'string', 'max:191'],
            'last_name.*' => ['sometimes','nullable', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'contact_no' => ['required', 'string', 'max:30'],
            'country_code' => ['required', 'string', 'max:4'],
            'passType.*' => ['required', 'string'],
            'title.*' => ['required', 'string'],
            'gender.*' => ['required', 'in:Male,Female'],
            // 'name.*' => ['required', 'string'],
            // 'surname.*' => ['required', 'string'],
            'pidno.*' => ['required', 'string'],
            'pied.*' => [
                'sometimes','required',
                'date',
                'after:' . now()->format('Y-m-d'), // Ensures the date is in the future
            ],
            'dob.*' => [
                'sometimes','required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $index = str_replace('dob.', '', $attribute);
                    $passType = $request->input("passType.$index");
        
                    $dob = new \DateTime($value);
                    $today = new \DateTime();
                    $age = $today->diff($dob)->y;
        
                    if ($passType === 'ADULT') {
                        if ($age < 12) {
                            $fail('The passenger must be 12 or older on the date of departure for ADULT type.');
                        }
                    } elseif ($passType === 'CHILD') {
                        if ($age <= 2 || $age >= 12) {
                            $fail('The passenger must be older than 2 and younger than 12 on the date of departure for CHILD type.');
                        }
                    } elseif ($passType === 'INFANT') {
                        if ($age > 2) {
                            $fail('The passenger must be 2 or younger on the date of departure for INFANT type.');
                        }
                    }
                },
            ],
            'country.*' => ['required', 'string'],
            'payment_gateway' => ['required', 'numeric', 'exists:payment_gateway,id']

        ]);
        
        // Additional check for a single adult passenger
        if (count($request->passType) == 1 && $request->passType[0] === 'ADULT') {
            $request->validate([
                'dob.0' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            ]);
        }
        $searchSess=Session::get('searchParams');
        $selectedData=Session::get('selectedFlightData');
        $traceId=Session::get('traceId');
        $apiUsed=session('apiMethodName');
        $api=ModuleApiSetting::where('api_name',$apiUsed)->where('api_type','flights')->first();

        if($searchSess['JourneyType']=='2'){
            $tripType='round';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'].'-'.$searchSess['departure_code'];

            $departureDate=date('Y-m-d',strtotime($searchSess['departure_date']));

        }else  if($searchSess['JourneyType']=='1'){
            $tripType='single';
            $destinations=$searchSess['departure_code'].'-'.$searchSess['arrival_code'];
            $departureDate=date('Y-m-d',strtotime($searchSess['departure_date']));
            
        }else{
            $tripType='multi';
            $departureDate=$searchSess['multi_departure_date'][0];
            $destinationsMulti = [
                $searchSess['from'],
                $searchSess['to'],
                $searchSess['multi_departure_date']
            ];
            $departureDate=date('Y-m-d',strtotime($searchSess['multi_departure_date'][0]));
        }

        // $userId = null;

        // // Check if the user is authenticated
        // if (auth()->check()) {
        //     $userId = auth()->user()->id;
        // } else {
        //     // Check if a user with the given email exists in the users table
        //     $userByEmail = User::where('email', $request->input('email'))->first();
        
        //     if ($userByEmail) {
        //         $userId = $userByEmail->id;
        //     } else {
        //         // Create a new user
        //         $newUser = User::create([
        //             'name' =>'New Name',
        //             'email' => $request->input('email'),
        //             'password'=>Hash::make(12345678),
        //             'status'=>'inactive'
        //         ]);
        
        //         $userId = $newUser->id;
        //     }
        // }

        //  //  generate a random 6-digit PNR
        //  $pnrNo =  Str::random(6);
        // $totalAmount=session('selectedFlightData.total_amount');

        // $flightAmounts = calculateFlightAmounts($totalAmount);
        // $adminProfit = null;
        // $actualAmount = $totalAmount; // Initialize it with the total amount
        // $adminPrice = $totalAmount;

        // if ($flightAmounts['settingsAvailable']) {
        //     // Commission settings are available, access the values
        //     $totalAmount = $flightAmounts['totalAmount'];
        //     $adminProfit = $flightAmounts['adminProfit'];
        //     $actualAmount = $flightAmounts['actualAmount'];
        //     $adminPrice=$flightAmounts['adminPrice'];

        // }
        

        //  $flightBooking = FlightBooking::create([
        //     'user_id' => $userId,
        //     'details' =>json_encode(session('selectedFlightData')),
        //     'pnr_no' => $pnrNo,
        //     'booking_status' => 'pending',
        //     'payment_status' => 'pending',
        //     'destinations' => $destinations,
        //     'departure_date' => $searchSess['departure_date'],
        //     'return_date' => $searchSess['return_date'],
        //     'email' => $request->input('email'),
        //     'contact_no' => $request->input('contact_no'),
        //     'ticket_status' => 'processing',
        //     'amount'=>$actualAmount,
        //     'currency'=>session('selectedFlightData.total_currency'),
        //     'total_amount' => $totalAmount,
        //     'admin_price' => $adminPrice,
        //     'admin_profit' => $adminProfit,
        //     'api_amount'=>session('selectedFlightData.total_amount'),
        //     'last_ticketing_date' => session('selectedFlightData.expires_at'),
        //     'tripType' => $tripType,
        //     'api_used' => $apiUsed,

        // ]);

        // // Insert passengers into the passengers table with a relation to the flight booking
        // for ($i=0; $i < count($request->input('title')) ; $i++) { 
        //     $passenger=new Passenger;
        //     $passenger->ticket_id =$flightBooking->id;
        //     $passenger->title=$request->title[$i];
        //     $passenger->name=$request->name[$i];
        //     $passenger->surname=$request->surname[$i];
        //     $passenger->passType=$request->passType[$i];
        //     $passenger->gender=$request->gender[$i];
        //     $passenger->dob=$request->dob[$i];
        //     $passenger->pidno= $request->pidno[$i];
        //     $passenger->pied=  $request->pied[$i];
        //     $passenger->country=  $request->country[$i];
        //     $passenger->save();
        // }

        // // Insert data into your generic booking table
        // $genericBooking = new Booking([
        //     'booking_type' => 'flight',
        //     'booking_id' => $flightBooking->id,
        //     'user_id' => $flightBooking->user_id,
        //     'ref_code'=>$flightBooking->pnr_no,
        //     'booking_date' => now(),
        //     'departure_date' => $flightBooking->departure_date,
        //     'arrival_date' => $flightBooking->return_date,
        //     'number_of_guests'=>count($request->input('title')),
        //     'price'=>$adminPrice,
        //     'currency'=>$flightBooking->currency,
        //     'status'=>$flightBooking->booking_status,
        //     'bookingable_type' => 'flight',
        //     'bookingable_id' => $flightBooking->id,
            
        // ]);
        // $genericBooking->save();
        
        // Session::put('ticket_id',$flightBooking->id);
        // Session::put('booking_type','flight');
        // return redirect()->route('/payment-initialize',$flightBooking->id);

        // continue to booking on amadeus api 
        $confirmPrice=$this->confrimPriceBdfare($traceId,$selectedData->offer->offerId,$api);
          
        if (!$confirmPrice['success']) {
            // Dump and die with errors
    
             // Construct the base URL
            $baseUrl = url('flight/list');
            
            // Append the query string
            $urlWithQuery = $baseUrl . '?' . http_build_query($searchSess);
            
            return redirect()->back()->with('error', '<b>Price Error </b> '.$confirmPrice['error']. ' Please search again. <br>' . '<a href="' . $urlWithQuery . '" class="button ladda-button m-auto">Search Again</a>');
        }

        $bookingResult = $this->orderSellBdfare($confirmPrice['response']['response']['traceId'],$confirmPrice['response']['response']['offersGroup'][0]['offer']['offerId'],$request->input(),$api);
        
        // print_r($confirmPrice['response']['response']['traceId']);
        // echo("<br>");
        // print_r($confirmPrice['response']['response']['offersGroup'][0]['offer']['offerId']);
        //  echo("$bookingResult");
        // exit();
       if (!$bookingResult['success']) {
          // Dump and die with errors
          return redirect()->back()->with('error','<b>Order Sell Error </b> '.$bookingResult['error']);
      }

      $orderCreate = $this->orderCreateBdfare($bookingResult['response']['response']['traceId'],$bookingResult['response']['response']['offersGroup'][0]['offer']['offerId'],$request->input(),$api);
        
      if (!$orderCreate['success']) {
         // Dump and die with errors
         return redirect()->back()->with('error',' <b>Order Create Error </b> '. $orderCreate['error']);
     }

        $results=$orderCreate['response']['response'];

        $orderReference=$results['orderReference'];
        $queuingOfficeId=$orderReference;
        $pnr=$results['orderItem'][0]['paxSegmentList'][0]['paxSegment']['airlinePNR']!='' ? $results['orderItem'][0]['paxSegmentList'][0]['paxSegment']['airlinePNR'] : $orderReference;
        $userId = null;

        // Check if the user is authenticated
        if (auth()->check()) {
            $userId = auth()->user()->id;
        } else {
            // Check if a user with the given email exists in the users table
            $userByEmail = User::where('email', $request->input('email'))->first();
        
            if ($userByEmail) {
                $userId = $userByEmail->id;
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => 'Guest',
                    'email' => $request->input('email'),
                    'password'=>Hash::make(12345678),
                    'status'=>'inactive',
                    'affiliate_code' => 'Guest'.'_'.Str::random(6),
                ]);
                $newUser->assignRole('B2C');
                $userId = $newUser->id;
            }
        }

        $ticket = new FlightBooking;
        $ticket->user_id = $userId;
        $ticket->pnr_no = $pnr;

        $ticket->details = json_encode($selectedData);
        $ticket->live_details = json_encode($results);
        $ticket->queuingOfficeId=$queuingOfficeId;
        $ticket->p_name=$request->input('first_name')[0];
        $ticket->p_surname=$request->input('last_name')[0];
        $ticket->contact_no=$request->input('country_code').'-'.$request->input('contact_no');
        $ticket->total_amount=round(bdt_to_usd($results['orderItem'][0]['price']['totalPayable']['total']));
        $ticket->admin_price=round(bdt_to_usd($results['orderItem'][0]['price']['totalPayable']['total']));
        $ticket->amount=bdt_to_usd($results['orderItem'][0]['price']['totalPayable']['total']);
        $ticket->currency='USD';
        $ticket->email=$request->input('email');
        $ticket->departure_date=$departureDate;
        $ticket->return_date=$searchSess['JourneyType']=='2' ? date('Y-m-d',strtotime($searchSess['return_date'])) : null;
        $ticket->tripType=$tripType;
        $ticket->destinations=$searchSess['JourneyType']!='3' ? $destinations : json_encode($destinationsMulti);
        $ticket->last_ticketing_date=$results['paymentTimeLimit'];
        $ticket->booking_status='pending';
        $ticket->payment_status='pending';

        $ticket->api_used = $apiUsed;
        $ticket->save();

        $lastInsertedId = $ticket->id;
        for ($i=0; $i < count($request->input('title')) ; $i++) { 
            $passenger=new Passenger;
            $passenger->ticket_id =$lastInsertedId;
            $passenger->title=$request->title[$i];
            $passenger->name=$request->first_name[$i];
            $passenger->surname=$request->last_name[$i];
            $passenger->passType=$request->passType[$i];
            $passenger->gender=$request->gender[$i];
            $passenger->dob=date('Y-m-d',strtotime($request->dob[$i]));
            // adding dummy data if orignal not available
            $passenger->pidno=strtoupper(isset($request->pidno[$i]) &&  $request->pidno[$i] !== null &&  $request->pidno[$i] !== '' ?  $request->pidno[$i] : "abc123");

            $passenger->pied=isset($request->pied[$i]) && $request->pied[$i] !== null && $request->pied[$i] !== '' ? $request->pied[$i] : date('Y-m-d');

            $passenger->country=strtoupper(isset($request->country[$i]) && $request->country[$i] !== null &&   $request->country[$i] !== '' ?   $request->country[$i] : "US");
            $passenger->save();
        }

         // // Insert data into your generic booking table
        $genericBooking = new Booking([
            'booking_type' => 'flight',
            'booking_id' => $ticket->id,
            'user_id' => $ticket->user_id,
            'ref_code'=>$ticket->pnr_no,
            'booking_date' => now(),
            'departure_date' => $ticket->departure_date,
            'arrival_date' => $ticket->return_date,
            'number_of_guests'=>count($request->input('title')),
            'price'=>$ticket->total_amount,
            'currency'=>$ticket->currency,
            'status'=>$ticket->booking_status,
            'bookingable_type' => 'flight',
            'bookingable_id' => $ticket->id,
            
        ]);
        $genericBooking->save();

        Session::put('ticket_id',$lastInsertedId);
        // return redirect()->route('/flight-final',$lastInsertedId);

        Session::put('booking_type','flight');
        Session::put('payment_gateway_id',$request->input('payment_gateway'));
        return redirect()->route('/payment-initialize',$ticket->id);

    }

    public function final($id){
        $sessId=Session::get('ticket_id');
        if($id!=$sessId){
            return redirect()->back();

        }else{
            $result = FlightBooking::with('passengers')->find($id);
    }
    dd($result);
}


    // function to get api credentials based on provided api from db 
    private function getApiCredentials($api)
    {
        
        $apiMode = $api->api_mode;

        // Define  API data based on modes
        $apiData = [
            'test' => [
                'api_url' => $api->api_test_endpoint,
                'api_key' => $api->api_test_key,
                'api_secret' => $api->api_test_secret_key,
                'api_mode' => 'test',
            ],
            'live' => [
                'api_url' => $api->api_endpoint,
                'api_key' => $api->api_key,
                'api_secret' => $api->api_secret,
                'api_mode' => 'live',
            ],
        ];

        // Return the data based on the provided mode, default to test if mode is not recognized
        return $apiData[$apiMode] ?? $apiData['test'];
    }

    // function to make booking on Bdfare api 
    private function confrimPriceBdfare($traceId, $offerId,$apiModel) {
        // Retrieve API credentials
        
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OfferPrice';
        $credentials = $this->getApiCredentials($apiModel);
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],   
        ];
    
        $url = $endpoint;
        $client = new Client;
      $results=['success'=>false,'error'=>''];
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
            $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
            $logMessage = '';
        
            if (isset($errors['error'])) {
                $logMessage = $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'];
                $results = ['error' => $logMessage, 'success' => false];
            } elseif (empty($errors) || $errors == '') {
                $logMessage = $e->getMessage();
                $results = ['error' => $logMessage, 'success' => false];
            }
        
            // Log the error message
            Log::error("Price Confirm Error : $logMessage");
        }
        return $results;

    }
        
    // function to make booking on Bdfare api 
    private function orderSellBdfare($traceId, $offerId, $postData, $apiModel) {
        // Retrieve API credentials
        $credentials = $this->getApiCredentials($apiModel);
    
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderSell';
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],
            'request' => [
                'contactInfo' => [
                    'phone' => [
                        'phoneNumber' => $postData['contact_no'],
                        'countryDialingCode' => $postData['country_code']
                    ],
                    'emailAddress' => $postData['email']
                ],
                'paxList' => []
            ]
        ];
    
        // Populate passenger data in the request body
        for ($i = 0; $i < count($postData['passType']); $i++) {
            $passenger = [
                'ptc' => strtolower(ucfirst($postData['passType'][$i])),
                'individual' => [
                    // 'title' => $postData['title'][$i],
                    'givenName' => $postData['first_name'][$i],
                    'surname' => $postData['last_name'][$i],
                    'gender' => $postData['gender'][$i],
                    'birthdate' => date('Y-m-d', strtotime($postData['dob'][$i])),
                    'nationality' => $postData['country'][$i],
                    'identityDoc' => [
                        'identityDocType' => 'Passport', // Assuming always passport
                        'identityDocID' => $postData['pidno'][$i],
                        'expiryDate' => date('Y-m-d', strtotime($postData['pied'][$i]))
                    ],
                    // 'associatePax' => [
                    //     'givenName' => $postData['first_name'][$i],
                    //     'surname' => $postData['last_name'][$i],
                    // ],
                ]
            ];
            $body['request']['paxList'][] = $passenger;
        }

        $url = $endpoint;
        $client = new Client;
        $results=['success'=>false,'error'=>''];
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
  
            $errors = json_decode($e->getResponse()->getBody()->getContents(), true);
            $logMessage = '';
        
            if (isset($errors['error'])) {
                $logMessage = $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'];
                $results = ['error' => $logMessage, 'success' => false];
            } elseif (empty($errors) || $errors == '') {
                $logMessage = $e->getMessage();
                $results = ['error' => $logMessage, 'success' => false];
            }
        
            // Log the error message
            Log::error("Order Sell Error : $logMessage");
        }
        return $results;
    }
    
    private function orderCreateBdfare($traceId, $offerId, $postData, $apiModel) {
        // Retrieve API credentials
        $credentials = $this->getApiCredentials($apiModel);
    
        $endpoint = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderCreate';
        
        // Construct the request body
        $body = [
            'traceId' => $traceId,
            'offerId' => [$offerId],
            'request' => [
                'contactInfo' => [
                    'phone' => [
                        'phoneNumber' => $postData['contact_no'],
                        'countryDialingCode' => $postData['country_code']
                    ],
                    'emailAddress' => $postData['email']
                ],
                'paxList' => []
            ]
        ];
    
        // Populate passenger data in the request body
        for ($i = 0; $i < count($postData['passType']); $i++) {
            $passenger = [
                'ptc' => strtolower(ucfirst($postData['passType'][$i])),
                'individual' => [
                    // 'title' => $postData['title'][$i],
                    'givenName' => $postData['first_name'][$i],
                    'surname' => $postData['last_name'][$i],
                    'gender' => $postData['gender'][$i],
                    'birthdate' => date('Y-m-d', strtotime($postData['dob'][$i])),
                    'nationality' => $postData['country'][$i],
                    'identityDoc' => [
                        'identityDocType' => 'Passport', // Assuming always passport
                        'identityDocID' => $postData['pidno'][$i],
                        'expiryDate' => date('Y-m-d', strtotime($postData['pied'][$i]))
                    ],
                    // 'associatePax' => [
                    //     'givenName' => $postData['first_name'][$i],
                    //     'surname' => $postData['last_name'][$i],
                    // ],
                ]
            ];
            $body['request']['paxList'][] = $passenger;
        }

        $url = $endpoint;
        $client = new Client;
       $results=['success'=>false,'error'=>''];
        try {
            $response = $client->post($url, [
                'headers' => [
                    'X-Api-Key' => $credentials['api_key'],
                    'Content-Type' => 'application/json',
                ],
                'json' => $body,
            ]);
    
            $decodedResult = json_decode($response->getBody()->getContents(), true);

            if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];
            } else {
                $results = ['response' => $decodedResult, 'success' => true, 'error' => null];
            }
        } catch (RequestException $e) {
             $errors=json_decode($e->getResponse()->getBody()->getContents(),true);

             if (isset($errors['error'])) {
                $results = ['error' => $errors['error']['errorCode'] . ' : ' . $errors['error']['errorMessage'], 'success' => false];
            }
        }
        return $results;
    }
    private function liveBooking($flightsData, $token, $postData)
    {

        $endpoint = 'https://test.api.amadeus.com/v1/booking/flight-orders';
        $uriParam = [
            "forceClass" => 'false',
        ];

        $remarks = [
            "general" => [
                [
                    "subType" => "GENERAL_MISCELLANEOUS",
                    "text" => "ONLINE BOOKING FROM MYTRAVEL"
                ]
            ]
        ];
        $ticketingAgreement = [
            "option" => "DELAY_TO_CANCEL",
            "delay" => "6D"
        ];

        $contacts = [
            "addresseeName" => [
                "firstName" => "MY",
                "lastName" => "TRAVEL"
            ],
            "companyName" => "MYTRAVEL",
            "purpose" => "INVOICE",
            "phones" => [
                [
                    "deviceType" => "LANDLINE",
                    "countryCallingCode" => "1",
                    "number" => "771626247"
                ],
                [
                    "deviceType" => "MOBILE",
                    "countryCallingCode" => "1",
                    "number" => "950379967"
                ]
            ],
            "emailAddress" => "info@mytravel.com",
            "address" => [
                "lines" => [
                    "test address"
                ],
                "postalCode" => "12345",
                "cityName" => "test city",
                "countryCode" => "US"
            ]
        ];
        $travelers_array = [];

        for ($i = 0; $i < count($postData['name']); $i++) {
            $travelers_array []= [
                "id" => $i + 1,
                "dateOfBirth" => $this->getDobBasedOnPassType($postData['dob'][$i],$postData['passType'][$i]),
                "name" => [
                    "firstName" => strtoupper($postData['name'][$i]),
                    "lastName" => strtoupper($postData['surname'][$i])
                ],
                "gender" => strtoupper($postData['gender'][$i]),
                "contact" => [
                    "emailAddress" => strtoupper($postData['email']),
                    "phones" => [
                        [
                            "deviceType" => "MOBILE",
                            "countryCallingCode" => "92",
                            "number" => '1234567890'
                        ]
                    ]
                ],
                "documents" => [
                    [
                        "documentType" => "PASSPORT",
                        "number" => strtoupper(isset($postData['pidno'][$i]) && $postData['pidno'][$i] !== null && $postData['pidno'][$i] !== '' ? $postData['pidno'][$i] : "abc123"),
                        "expiryDate" => isset($postData['pied'][$i]) && $postData['pied'][$i] !== null && $postData['pied'][$i] !== '' ? $postData['pied'][$i] : date('Y-m-d'),
                        "issuanceCountry" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "validityCountry" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "nationality" => strtoupper(isset($postData['country'][$i]) && $postData['country'][$i] !== null && $postData['country'][$i] !== '' ? $postData['country'][$i] : "US"),
                        "holder" => true
                    ]
                ]
                

            ];
        }
        $travel=[];
        foreach ($travelers_array as $key => $value) {
            $travel[]=$value;
        }

        $body = json_encode([
            "data" => [
                "type" => "flight-order",
                "flightOffers" => [$flightsData['data']['flightOffers'][0]],
                "travelers" => $travel,
                "remarks" => $remarks,
                "ticketingAgreement" => $ticketingAgreement,
                "contacts" => [$contacts],
            ],
        ]);

        $params = http_build_query($uriParam);
        $url = $endpoint . '?' . $params;

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        try {
            $response = Http::withHeaders($headers)->timeout(40)->post($url, json_decode($body, true));

            return ['response' => $response->body(), 'errors' => null];
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return ['response' => null, 'errors' => $exception->response->body()];
        }
    }

    private function confirmPrice($flightsData, $token)
    {
        $endpoint = 'https://test.api.amadeus.com/v1/shopping/flight-offers/pricing';
        $uriParam = [
            "forceClass" => 'true',
        ];
    
        $body = json_encode([
            "data" => [
                "type" => "flight-offers-pricing",
                "flightOffers" => [$flightsData],
            ],
        ]);
    
        $params = http_build_query($uriParam);
        $url = $endpoint . '?' . $params;
    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
    
        $response = Http::withHeaders($headers)->post($url, json_decode($body, true));
    
        return json_decode($response->body(),true);
    }
    // private function to get token from amadeus api for api call
    private function getToken($client, $api)
    {
        $credentials = $this->getApiCredentials($api);

        $url = 'https://test.api.amadeus.com/v1/security/oauth2/token';
    
        try {
            $response = $client->post($url, [
                'headers'      => ['Accept' => 'application/json'],
                'form_params'  => [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $credentials['api_key'],
                    'client_secret' => $credentials['api_secret'],
                ],
            ]);
    
            $responseBody = json_decode($response->getBody(), true);
    
            // Check if the token retrieval was successful
            if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
                return $responseBody;
            } else {
                return ['error' => $responseBody['title'] ?? 'Token retrieval failed.'];
            }
        } catch (RequestException $exception) {
            if ($exception->hasResponse()) {
                $errorResponse = json_decode($exception->getResponse()->getBody(), true);
    
                // Return the error response
                // return ['error' => $errorResponse['title'] . ': ' . $errorResponse['detail']];
                return ['error' => $errorResponse];

            } else {
                return ['error' => $exception->getMessage()];
            }
        }
    }

    public function getDobBasedOnPassType($dob, $passType) {
        if (empty($dob) || is_null($dob) || $dob == '') {
            switch ($passType) {
                case 'ADULT':
                    // Set dynamic date for an adult (over 18 years old)
                    return Carbon::now()->subYears(20)->format('Y-m-d');
                case 'CHILD':
                    // Set dynamic date for a child (between 2 and 12 years old)
                    return Carbon::now()->subYears(6)->format('Y-m-d');
                case 'HELD_INFANT':
                    // Set dynamic date for an infant (less than 2 years old)
                    return Carbon::now()->subYears(1)->format('Y-m-d');
                default:
                    // Set a default dynamic date for other cases
                    return Carbon::now()->subYears(20)->format('Y-m-d');
            }
        }
    
        return $dob;
    }
}
