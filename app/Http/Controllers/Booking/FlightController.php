<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\User;
use App\Models\FlightBooking;
use App\Models\ModuleApiSetting;

use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
class FlightController extends Controller
{
    public function index(Request $request) {
        // Check if the authenticated user has the 'manage all bookings' permission
        if (auth()->user()->hasPermissionTo('manage all bookings')) {
            // User has permission to manage all bookings
            $query = FlightBooking::with('user','passengers')->orderBy('created_at', 'desc');
        } else {
            // User does not have permission to manage all bookings
            // Fetch only the tickets linked to the authenticated user
            $query = FlightBooking::with('user','passengers')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        }
    
        // Check if a 'booking_status' parameter is provided in the query string
        if ($request->has('booking_status')) {
            $status = $request->query('booking_status');
            $query->where('status', $status);
        }
    
        // You can add more conditions for other query parameters here if needed
        $tickets = $query->get();
        
       
        return view('backend/bookings/flight/index', compact('tickets'));
    }

    public function edit($id){

        if (auth()->user()->hasPermissionTo('manage all bookings')) {
            // User has permission to manage all bookings
            $query = FlightBooking::with('user','passengers')->findOrfail($id);
             
            //  print_r($query);
            //  exit();
          
             return view('backend/bookings/flight/update', compact('query'));

        }else{
            return redirect()->back()->with('error','You does not have right permission.');
        } 
    }

    public function update(Request $request ,$id){
        $ticket=FlightBooking::findorfail($id);
        $rules = [
            'pnr_no' => ['sometimes', 'string', 'nullable', 'max:255', Rule::unique('flight_bookings')->ignore($ticket->id)],
            'company' => ['sometimes', 'string', 'nullable', 'max:255'],
            'destinations' => ['sometimes', 'string', 'nullable', 'max:255'],
            'departure_date' => ['sometimes', 'nullable', 'string'],
            'return_date' => ['sometimes', 'nullable', 'string'],
            'bags' => ['sometimes', 'nullable', 'string', 'max:15'],
            'tripType' => ['sometimes', 'required', 'string',Rule::in(['round', 'oneway'])],
            'ticket_status' => ['sometimes', 'nullable', 'string' ,Rule::in(['processing', 'issued','canceled'])],
            'paid_amount' => ['sometimes', 'nullable', 'string', 'max:50'],
            'payment_status' => ['sometimes', 'nullable', 'string' ,Rule::in(['completed', 'pending'])],
            'booking_status' => ['sometimes', 'nullable', 'string' ,Rule::in(['canceled', 'pending','confirmed'])],
            'ticket_num' => ['sometimes', 'nullable', 'string', 'max:15'],
            'issued_from' => ['sometimes', 'nullable', 'string', 'max:30'],


        ];
        $validatedData = $request->validate($rules);

        // Update the ticket data with the validated data
        $ticket->update($validatedData);

        return redirect()->route('flight.index')->with('success','Ticket data updated');
    }

    public function updatePassengers(Request $request, $id)
    {

        $passengerData = $request->only(['title', 'name', 'surname','passType','gender','dob','contact_no']);
        $ticket=FlightBooking::find($id);
        foreach ($passengerData['title'] as $index => $title) {
            $passengerId = $request->input('passenger_ids')[$index];
            $ticket->passengers()->where('id', $passengerId)->update([
                'title' => $title,
                'name' => $passengerData['name'][$index],
                'surname' => $passengerData['surname'][$index],
                'passType' => $passengerData['passType'][$index],
                'gender' => $passengerData['gender'][$index],
                'dob' => $passengerData['dob'][$index],
                'contact_no' => $passengerData['contact_no'][$index],
            ]);
        }
    
        return redirect()->route('flight.index')->with('success','Passengers data updated');

    }

    public function show($id){

        if (auth()->user()->hasPermissionTo('cancel all bookings')) {
            // User has permission to manage all bookings
            $query = FlightBooking::with('user','passengers')->findOrfail($id);
   
            return view('backend/bookings/flight/manage', compact('query'));

        }else if(auth()->user()->hasPermissionTo('cancel bookings')){

            $query = FlightBooking::with('user','passengers')->findOrfail($id);
            if($query->user_id!=auth()->user()->id){

                return redirect()->route('flight.index')->with('error','You are not authorized.');

            }
            return view('backend/bookings/flight/manage', compact('query'));

        }
         else{
            return redirect()->route('flight.index')->with('error','You does not have right permission.');
        }
    }

    /// function to cancel booking
    public function cancelBooking(Request $request, $id)
    {
        $booking = FlightBooking::with('user','booking')->findOrFail($id);
        $user = auth()->user();

            // Check if departure date is in the past
        $departureDate = Carbon::parse($booking->departure_date);

        if ($departureDate->isPast()) {
            return redirect()->route('flight.index')->with('error', 'You cannot cancel a booking with a past departure date.');
        }
        if($booking->status=='canceled'){
            return redirect()->route('flight.index')->with('error', 'Booking Status is already canceled.');
        }
        
        $api=ModuleApiSetting::where('api_name',$booking->api_used)->where('api_type','flights')->first();

        $client=new Client;
        $token=$this->getToken($client,$api); // generating token 
         // Check if the token retrieval was successful
         if (isset($tokenResponse['error'])) {

            return redirect()->back()->with('error','Token retrieval failed: ' . $token['error']);

        }
        $access_token = $token['access_token'];
        $details=json_decode($booking->live_details);
        $orderId=($details->data->id);
       
        // Check authorization to cancel specific booking
        if ($user->hasPermissionTo('cancel all bookings')) {
            // Proceed to cancel 

            $cancel=$this->cancelOrder($access_token,$orderId);

        } elseif ($user->hasPermissionTo('cancel bookings')) {

            if ($booking->user_id !== $user->id) {
                return redirect()->route('flight.index')->with('error','You are not authorized.');

            }
            // Proceed to cancel
            $cancel=$this->cancelOrder($access_token,$orderId);

        } else {
            return redirect()->route('flight.index')->with('error','You does not have right permission.');

        }
   
        if($cancel['success'] && $cancel['status']==204){

            // Update the booking status to 'canceled'
            $booking->booking_status = 'canceled';
            $booking->ticket_status = null;
            $booking->save();
            
            // also update the generic booking table status 
            $genericBooking=Booking::where('booking_id',$booking->id)->first();
            $genericBooking->status=$booking->booking_status;
            $genericBooking->save();
            return redirect()->route('flight.index')->with('success','Booking has been canceled successfully.');

        }else{
            return redirect()->route('flight.index')->with('error',$cancel['error']['title'].' : '. $cancel['error']['message']);
        }
 
    }

   
    private function cancelOrder($token, $orderId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('https://test.api.amadeus.com/v1/booking/flight-orders/'.$orderId);
    
        $responseData = $response->json();
    
        return [
            'success' => $response->successful(),
            'data' => $responseData,
            'status' => $response->status(),
            'error' => !$response->successful() ? [
                'status' => $response->status(),
                'code' => $responseData['errors'][0]['code'] ?? 'Unknown error code ',
                'title' => $responseData['errors'][0]['title'] ?? 'Unknown error title ',
                'message' => $responseData['errors'][0]['detail'] ?? 'Unknown error message ',
            ] : null,
        ];
    }
    

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

    
}
