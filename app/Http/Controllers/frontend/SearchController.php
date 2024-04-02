<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\ModuleApiSetting;

use App\Models\Inquiry;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        

        $module=$this->getActiveModule('flights'); // getting active module for flight
        if(!$module){
            return redirect()->route('home')->with('error','Opps! It seems the module for flights is not active yet.');
           
        }
        
        // continue to get api regarding module 
        $api=$this->getActiveModuleApi($module);
        if(!$api){
            return redirect()->route('home')->with('error','Opps! It seems the module api for flights is not active yet.');   
        }
   
        $query = [
            'departure_full' => $request->query('departure_full'),
            'departure_code' => $request->query('departure_code'),
            'arrival_full'   => $request->query('arrival_full'),
            'arrival_code'   => $request->query('arrival_code'),
            'departure_date' => $request->query('departure_date'),
            'return_date'    => $request->query('return_date'),
            'JourneyType'    => $request->query('JourneyType'),
            'adult'          => $request->query('adult'),
            'child'          => $request->query('child'),
            'infant'         => $request->query('infant'),
            'travel_class'   => $request->query('travel_class'),
            'from'=>$request->query('from'),
            'to'=>$request->query('to'),
            'multi_departure_date'=>$request->query('multi_departure_date'),
            
        ];
        Session::forget('searchParams'); // removing old session 
        Session::put('searchParams',$query);
      
        $apiNameArr=ModuleApiSetting::where('api_type','flights')->pluck('api_name')->toArray();
        
        $apiMethodName=$this->matchApiName($apiNameArr,$api->api_name);
    
        if (!$apiMethodName || !method_exists($this, $apiMethodName)) {
                 dd($apiMethodName);
            // return if api name not matched with given array
            return redirect()->route('home')->with('error', 'Opps! Api method not Found. ');
        }
    
        $response=$this->$apiMethodName($query,$api);
        // echo "<pre>";print_r($response); exit;
        // dd($response);
        
        if(!$response){
            // curl error
        return redirect()->route('home')->with('error','Opps! There is an server issue please try again.');
        }
        if(!$response['success']){
            // api error
            return redirect()->route('home')->with('error',$response['error']);
        }
        Session::put('apiMethodName',$apiMethodName);
        $response=$response['response'];
        // echo "<pre>";print_r($response);exit;

        return view('frontend/flights/'.$apiMethodName.'/list', ['data' => $response,'apiMethodName'=>$apiMethodName]);

    }

   // function to get active module based on name 
    private function getActiveModule(string $name){
        $module=Module::where('name',$name)->where('status','active')->first();
        return $module;
    }

    // function to get active module api  based on module 
    private function getActiveModuleApi($module){
        $api=ModuleApiSetting::where('api_type',$module->name)->where('status','active')->first();
        return $api;
    }

    // function to get matched api name with privided api and array of names 
    private function matchApiName(array $apiNameArr, $apiName)
    {
        $apiNameLower = strtolower($apiName);
    
        foreach ($apiNameArr as $name) {
            $lowerCaseName = strtolower($name);
    
            // Check if the lowercased $apiName is part of the lowercased $name
            if (strpos($lowerCaseName, $apiNameLower) !== false) {
                // Extract the first word from the matched name and return it in lowercase
                $matchedWords = explode(' ', $lowerCaseName, 2);
                return $matchedWords[0];
            }
        }
    
        // If no match found, you can return a default or handle it as needed
        return null;
    }

        //////// private function to curl call for amadeus seach ////////////

    /**
     * Summary of amadeus
     * @param array $params
     * @return mixed
     */
   
    //////// private function to curl call for bdfare search ////////////

    /**
     * Summary of amadeus
     * @param array $params
     * @return mixed
     */
    
     private function Bdfare(array $params, $api)
     {
        
         // Retrieve API credentials
         $credentials = $this->getApiCredentials($api);
         $url = $credentials['api_url'];
         $requestDataArray=[];

          // Determine the trip type based on the presence of a return date
       
        $tripType = isset($params['JourneyType']) ? ($params['JourneyType'] === '2' ? 'Return' : ($params['JourneyType'] === '3' ? 'Circle' : 'Oneway')) : 'Oneway';

        // getting single or double payload
        if ($tripType === 'Oneway' || $tripType === 'Return') {
            $requestDataArray = $this->getSingleReturnPayLoadBdFare($params, $tripType);

        } else if ($tripType === 'Circle') {
            $requestDataArray = $this->getMultiPayLoadBdFare($params, $tripType);
        }

         $client = new Client();
         $results = [];

         try {
             $response = $client->post($url, [
                 'headers' => [
                     'X-Api-Key' => $credentials['api_key'],
                     'Content-Type' => 'application/json',
                 ],
                 'json' => $requestDataArray,
             ]);
             
             $decodedResult = json_decode($response->getBody()->getContents(), true);
                // return $decodedResult;
             if (isset($decodedResult['error'])) {
                $results = ['error' => $decodedResult['error']['errorCode'] . ' : ' . $decodedResult['error']['errorMessage'], 'success' => false];

            } elseif (isset($decodedResult['error'])) {
                $results = ['error' => 'Invalid Data Provided', 'success' => false];
   
            } else {
                $results = ['response' => $decodedResult, 'success' => true];
            }

         } catch (RequestException $e) {
             // Handle API request exceptions
             $errorMessage=json_decode($e->getResponse()->getBody()->getContents());
             if(empty($errorMessage) || $errorMessage!=''){
                 $results = ['error' => $e->getMessage(), 'success' => false];
             }else{
                 $results = ['error' => json_decode($e->getResponse()->getBody()->getContents()), 'success' => false];
             }
             
             
              \Log::error($e->getMessage());
            //   $results = ['error' => 'Opps! There is a server issue, please try again.', 'success' => false];

         }
         return $results;
  
     }
    
    //////// private function to curl call for duffel seach ////////////

    /**
     * Summary of duffel
     * @param array $searchParams
     * @return mixed
     */
    private function duffel(array $searchParams,$api)
    {

        $apiData=$this->getApiCredentials($api);
        
        $timeOut = ($searchParams['return_date'] != '') ? 10000 : 5000;
    
        $url = $apiData['api_url'].'&supplier_timeout=' . $timeOut;
        $headers = [
            'Content-Type: application/json',
            'Duffel-Version: v1',
            'Authorization: Bearer '.$apiData['api_key']
        ];
        $adultCount = $searchParams['adult'];
        $childCount = $searchParams['child'];
        $infantCount = $searchParams['infant'];
        $data = [
            'data' => [
                'slices' => [
                    [
                        'origin' => $searchParams['departure_code'],
                        'origin_type' => 'airport',
                        'destination' => $searchParams['arrival_code'],
                        'destination_type' => 'airport',
                        'departure_date' => $searchParams['departure_date'],
                    ],
                ],
                'passengers' => [],
                'cabin_class' => $searchParams['travel_class']
            ]
        ];
    
        // Add adult passengers
        for ($i = 0; $i < $adultCount; $i++) {
            $data['data']['passengers'][] = ['type' => 'adult'];
        }
    
        // Add child passengers
        for ($i = 0; $i < $childCount; $i++) {
            $data['data']['passengers'][] = ['type' => 'child'];
        }
    
        // Add infant passengers
        for ($i = 0; $i < $infantCount; $i++) {
            $data['data']['passengers'][] = ['type' => 'infant_without_seat'];
        }
    
        if (!empty($searchParams['return_date'])) {
            $returnSlice = [
                'origin' => $searchParams['arrival_code'],
                'origin_type' => 'airport',
                'destination' => $searchParams['departure_code'],
                'destination_type' => 'airport',
                'departure_date' => $searchParams['return_date'],
            ];
    
            $data['data']['slices'][] = $returnSlice;
        }
    
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
    
        if ($response === false) {
            // curl error
           
            return ['error'=>'Opps! There is a server issue, please try again.'];
        } else {
            $info = curl_getinfo($ch);
            $contentEncoding = isset($info['content_encoding']) ? $info['content_encoding'] : '';
            if ($contentEncoding === 'gzip') {
                $response = gzdecode($response);
            }
            $result = json_decode($response, true);
        }
    
        curl_close($ch);
    
        // Check if response has errors
        if (isset($result['errors']) && !empty($result['errors'])) {
            // Some API error, which can be validation errors as well
            return ['error'=>$result['errors'][0]['title'] . ' : ' . $result['errors'][0]['message']];

        }
    
        return $result;
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

    private function insertInquiry($query)
    {
        // Insert the data into the 'inquiries' table
        Inquiry::create($query);
        // Return true to indicate successful insertion
        return true;
    }

    // getting pax array for Bdfare api 
   private function generatePaxArray($adultCount, $childCount, $infantCount) {
        $paxArray = [];
    
        // Add adult passengers
        for ($i = 1; $i <= $adultCount; $i++) {
            $paxArray[] = [
                'paxID' => 'PAX'.$i,
                'ptc' => 'ADT',
            ];
        }
    
        // Add child passengers
        for ($i = 1; $i <= $childCount; $i++) {
            $paxArray[] = [
                'paxID' => 'PAX'.($i + $adultCount),
                'ptc' => 'CHD',
            ];
        }
    
        // Add infant passengers
        for ($i = 1; $i <= $infantCount; $i++) {
            $paxArray[] = [
                'paxID' => 'PAX'.($i + $adultCount + $childCount),
                'ptc' => 'INF',
            ];
        }
    
        return $paxArray;
    }

    private function getSingleReturnPayLoadBdFare(array $params,$tripType){

        $requestDataArray = [
            'airShoppingRequest' => 'BD',
            'PointOfSale' => 'BD',
            'request' => [
                'originDest' => [
                    [
                        'originDepRequest' => [
                            'iatA_LocationCode' => $params['departure_code'],
                            'date' => date('Y-m-d', strtotime($params['departure_date'])), // Convert date to proper format
                        ],
                        'destArrivalRequest' => [
                            'iatA_LocationCode' => $params['arrival_code'],
                        ],
                    ],
                ],
                'pax' => $this->generatePaxArray($params['adult'], $params['child'], $params['infant']),
                'shoppingCriteria' => [
                    'tripType' =>$tripType,
                    'travelPreferences' => [
                       
                        'cabinCode' => $params['travel_class'],
                    ],
                    'returnUPSellInfo' => false,
                ],
            ],
        ];
       // If trip type is 'Return', include return journey details
       if ($tripType === 'Return') {
           $requestDataArray['request']['originDest'][] = [
               'originDepRequest' => [
                   'iatA_LocationCode' => $params['arrival_code'], // Reverse the departure and arrival codes for return journey
                   'date' => date('Y-m-d', strtotime($params['return_date'])), // Convert return date to proper format
               ],
               'destArrivalRequest' => [
                   'iatA_LocationCode' => $params['departure_code'],
               ],
           ];
       }
       return $requestDataArray;
    }

    private function getMultiPayloadBdFare(array $params, $tripType) {
        $requestDataArray = [
            'airShoppingRequest' => 'BD',
            'PointOfSale' => 'BD',
            'request' => [
                'originDest' => [],
                'pax' => $this->generatePaxArray($params['adult'], $params['child'], $params['infant']),
                'shoppingCriteria' => [
                    'tripType' =>$tripType,
                    'travelPreferences' => [
                        'cabinCode' => $params['travel_class'],
                    ],
                    'returnUPSellInfo' => false,
                ],
            ],
        ];
    
        // Loop through each leg of the journey
        for ($i = 0; $i < count($params['from']); $i++) {
            // Check if values are not null or empty
            if (!empty($params['from'][$i]) && !empty($params['to'][$i]) && !empty($params['multi_departure_date'][$i])) {
                $requestDataArray['request']['originDest'][] = [
                    'originDepRequest' => [
                        'iatA_LocationCode' => extractIataCode($params['from'][$i]), // Get IATA code for departure airport
                        'date' => date('Y-m-d', strtotime($params['multi_departure_date'][$i])), // Convert date to proper format
                    ],
                    'destArrivalRequest' => [
                        'iatA_LocationCode' => extractIataCode($params['to'][$i]), // Get IATA code for arrival airport
                    ],
                ];
            }
        }
    
        return $requestDataArray;
    }
    
    
}
