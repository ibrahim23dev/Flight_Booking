<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\User;
use App\Models\PaymentGateway;
use App\Models\CommissionSetting;
use App\Models\ModuleApiSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class FlightBookingController extends Controller
{
  

    public function createFlightBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'details' => 'required|array',
            'live_details' => 'nullable|array',
            'pnr_no' => 'sometimes|required|max:191',
            'bags' => 'nullable|max:15',
            'payment_method' => [
                'nullable',
                'max:191',
                Rule::in(PaymentGateway::pluck('identity')->toArray()), // Check if payment method exists in the database
            ],
            'trx_id' => $request->has('payment_method') ? 'required|max:191' : 'nullable',
            'currency' =>'required',
            'paid_amount' => $request->has('payment_method') ? 'required' : 'nullable',
            'company' => 'nullable|max:191',
            'destinations' => 'required|max:191',
            'departure_date' => 'required|date',
            'return_date' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tripType == 'round') {
                        if (empty($value)) {
                            $fail('The return date is required for round trips.');
                        } elseif (strtotime($value) < strtotime($request->departure_date)) {
                            $fail('The return date cannot be earlier than the departure date.');
                        }
                    } elseif ($request->tripType == 'oneway' && !empty($value)) {
                        $fail('The return date should not be provided for oneway trips.');
                    }
                },
            ],
            
            
            'p_name' => 'required|max:191',
            'p_surname' => 'required|max:191',
            'contact_no' => 'required|max:191',
            'total_amount' => 'required|numeric',
            'remarks' => 'nullable',
            'reminder' => 'nullable|date',
            'last_ticketing_date' => 'nullable|max:191',
            'tripType' => 'required|in:oneway,round',
            'email' => 'required|email|max:191',
            'passengers' => 'required|array',
            'passengers.*.title' => 'required|in:Mr,Mrs,Miss',
            'passengers.*.name' => 'required|max:191',
            'passengers.*.surname' => 'required|max:191',
            'passengers.*.passType' => 'required|in:Adult,Child,Infant',
            'passengers.*.gender' => 'required|in:male,female',
            'passengers.*.country' => 'required|exists:countries,shortname',
            'passengers.*.dob' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $passenger = collect($request->input('passengers'))->where('dob', $value)->first();
                    if ($passenger['passType'] === 'Adult' && strtotime($value) >= strtotime('-18 years')) {
                        $fail('Adult passengers must be at least 18 years old.');
                    } elseif ($passenger['passType'] === 'Child' && strtotime($value) >= strtotime('-2 years')) {
                        $fail('Child passengers must be under 2 years old.');
                    } elseif ($passenger['passType'] === 'Infant' && strtotime($value) <= strtotime('-2 years')) {
                        $fail('Infant passengers must be 2 years old or older.');
                    }
                },
            ],
            'passengers.*.passport_number' => 'required|max:191',
            'passengers.*.passport_expiry_date' => [
                'required',
                'date',
                'after:today',
            ],
            'passengers.*.contact_no' => 'nullable|max:191',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        try {
                // Check if the user_id is provided
                if ($request->has('user_id') &&  $request->user_id!=null ) {
                    $userId = $request->input('user_id');
                } else {
                    // Check if the email is provided
                    if ($request->has('email')) {
                        $email = $request->input('email');
                        $user = User::where('email', $email)->first();
                        if($user){
                            $userId=$user->id;
                        }else{

                            // Create a new user if the email doesn't exist
                            $user = User::create([
                                'name' => 'guest',
                                'email' => $email,
                                'password' =>  Hash::make(Str::random(8)), // Generate a random password and hash it
                                'status' => 'inactive',
                                'active_status' => false,
                                'avatar' => 'avatar.png',
                                'dark_mode' => false,
                            ]);
                             $user->save();

                            $userId = $user->id;
                       
                      }

                        
                    } else {
                        return response()->json(['success' => false, 'error' => 'Missing user_id and email'], 400);
                    }
                }

            
            // Check if the request contains a PNR, if not, generate a random 6-digit PNR
            $pnrNo = $request->has('pnr_no') ? $request->input('pnr_no') : Str::random(6);
                
            $commissionSettings = CommissionSetting::where('status', 'active')
            ->where('type', 'flights')
            ->whereIn('fare_type', ['markup', 'discount'])
            ->first();

            $adminPrice = $request->input('total_amount');
            $adminProfit = null;
            $actualAmount = $request->input('total_amount'); // Initialize it with the total amount
            
            if ($commissionSettings) {
                if ($commissionSettings->fare_type == 'markup') {
                    $markupAmount = $commissionSettings->price; // Change 'amount' to the actual column name in your commission settings table
                    $actualAmount = $request->input('total_amount') - $markupAmount;
                    $adminProfit =$request->input('total_amount') - $actualAmount;
                } elseif ($commissionSettings->fare_type == 'discount') {
                    $discountAmount = $commissionSettings->price; // Change 'amount' to the actual column name in your commission settings table
                    $actualAmount = $request->input('total_amount') + $discountAmount;
                    $adminProfit =$request->input('total_amount') - $actualAmount;
                }
            }
            // getting module api setting 
            $moduleSettings = ModuleApiSetting::where('status', 'active')
            ->where('api_type', 'flights')
            ->first();
            if($moduleSettings->api_mode=='test'){
                $apiStatus='test';
            }else{
                $apiStatus='live';
            }
            $apiUsed=$moduleSettings->api_name;
            $flightBooking = FlightBooking::create([
                'user_id' => $userId,
                'details' =>json_encode($request->input('details')),
                'live_details' => $request->input('live_details'),
                'pnr_no' => $pnrNo,
                'booking_status' => 'pending',
                'bags' => $request->input('bags'),
                'payment_method' => $request->input('payment_method'),
                'payment_status' => 'pending',
                'trx_id' => $request->input('trx_id'),
                'paid_amount' => $request->input('paid_amount'),
                'currency' => $request->input('currency'),
                'company' => $request->input('company'),
                'destinations' => $request->input('destinations'),
                'departure_date' => $request->input('departure_date'),
                'return_date' => $request->input('return_date'),
                'p_name' => $request->input('p_name'),
                'p_surname' => $request->input('p_surname'),
                'contact_no' => $request->input('contact_no'),
                'ticket_status' => 'processing',
                'amount'=>$actualAmount,
                // 'collector_profit' => $request->input('collector_profit'),
                // 'collector_sale_price' => $request->input('collector_sale_price'),
                'total_amount' => $request->input('total_amount'),
                'admin_price' => $adminPrice,
                'admin_profit' => $adminProfit,
                'payment_iata' => $request->input('payment_iata'),
                'remarks' => $request->input('remarks'),
                'reminder' => $request->input('reminder'),
                'last_ticketing_date' => $request->input('last_ticketing_date'),
                'tripType' => $request->input('tripType'),
                'api_used' => $apiUsed,
                'api_status' => $apiStatus,
                'email' => $request->input('email'),

            ]);

            // Insert passengers into the passengers table with a relation to the flight booking
            foreach ($request->input('passengers') as $passengerData) {
                Passenger::create([
                    'title' => $passengerData['title'],
                    'name' => $passengerData['name'],
                    'surname' => $passengerData['surname'],
                    'passType' => $passengerData['passType'],
                    'gender' => $passengerData['gender'],
                    'country' => $passengerData['country'],
                    'dob' => $passengerData['dob'],
                    'pidno' => $passengerData['passport_number'],
                    'pied' => $passengerData['passport_expiry_date'],
                    'contact_no' => $passengerData['contact_no'],
                    'ticket_id' => $flightBooking->id,
                ]);
            }
    
            // Insert data into your generic booking table
            $genericBooking = new Booking([
                'booking_type' => 'flight',
                'booking_id' => $flightBooking->id,
                'user_id' => $flightBooking->user_id,
                'ref_code'=>$flightBooking->pnr_no,
                'booking_date' => now(),
                'departure_date' => $flightBooking->departure_date,
                'arrival_date' => $flightBooking->return_date,
                'number_of_guests'=>count($request->input('passengers')),
                'price'=>$adminPrice,
                'currency'=>$flightBooking->currency,
                'status'=>$flightBooking->booking_status,
                'bookingable_type' => 'flight',
                'bookingable_id' => $flightBooking->id,
                
            ]);
            $genericBooking->save();
    
            return response()->json(['success' => true, 'message' => 'Flight booking created', 'data' => $flightBooking], 201);
        } catch (QueryException $e) {
            \Log::error('Error in flightBookingController: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Database error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error('Error in flightBookingController: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }
    
    
    
}
