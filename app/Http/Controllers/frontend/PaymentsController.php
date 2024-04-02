<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\FlightBooking;
use App\Models\Booking;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\TourBooking;
use App\Models\Package;


class PaymentsController extends Controller
{
    public function paymentInitialize(Request $request,$id){
        $sessId=Session::get('ticket_id');
        if($id!=$sessId){
            return redirect()->back();
        }
        // strip payment intent to set false if other payment gateway choose.
        $paymentIntent=null; 
        $paypal=false;

        $paymentGatway = $this->getPaymentGateway(session('payment_gateway_id'));

        if(session('booking_type')=='flight'){
           
            $apiUsed=session('apiMethodName');

                 $result = FlightBooking::with('passengers')->find($id);
                //  dd($result);

                  $paymentData=$this->getPaymentData('flight',$result,$paymentGatway);

                  if($paymentData['gateway_name']==='stripe'){

                    $paymentIntent=$this->initializeStripe($paymentData);

                  }else if($paymentData['gateway_name']==='paypal'){
                    $paypal=true;
                  }

                Session::put('paymentData',$paymentData);

            $type='flight';

            $selectedFlightData= Session::get('selectedFlightData');

             return view('frontend/flights/'.$apiUsed.'/checkout',compact('selectedFlightData','paymentIntent','result','paymentData','type','paypal'));

            /////////////// case tour /////////////////

        }elseif(session('booking_type')=='tour'){
           
                 $result = TourBooking::with('user','package.packageCategory')->find($id);
                 $package=Package::with('packageCategory')->findOrfail($result->package->package_id);
                  $paymentData=$this->getPaymentData('tour',$result,$paymentGatway);
  
                  if($paymentData['gateway_name']==='stripe'){

                    $paymentIntent=$this->initializeStripe($paymentData);

                  }else if($paymentData['gateway_name']==='paypal'){
                    $paypal=true;
                  }

                Session::put('paymentData',$paymentData);

               $type='tour';

             return view('frontend/toures/checkout',compact('paymentIntent','result','paymentData','type','paypal','package'));
        }
    }
    public function paymentProceed($id){
          
        $sessId=Session::get('ticket_id');
        if($id!=$sessId){
            return redirect()->back();
        }else{
           
            $paymentData=Session::get('paymentData');

            if($paymentData['gateway_name']==='stripe'){

            $stripe= new \Stripe\StripeClient([
                'api_key'=>$paymentData['private_key'],
                ]);
            $paymentIntent=$stripe->paymentIntents->retrieve($_GET['payment_intent']);

            if($paymentData['type']=='flight'){

            $ticketUpdate = FlightBooking::find($id);

            $selectedFlightData= Session::get('selectedFlightData');

           if ($ticketUpdate) {
            // Update the payment_method field
            if($ticketUpdate->payment_status!=='completed'){

                $ticketUpdate->payment_method = 'stripe';
                $ticketUpdate->payment_status = $paymentIntent->status =='succeeded' ?'completed' :'pending';
                $ticketUpdate->trx_id = $paymentIntent->id;
                $ticketUpdate->paid_amount = $ticketUpdate->total_amount;
                $ticketUpdate->paid_amount_currency = strtoupper($paymentIntent->currency);

                $ticketUpdate->booking_status = $paymentIntent->status =='succeeded' ?'confirmed' :'pending';
                // Save the changes
                $ticketUpdate->save();

                 // changing booking in generic table 
                 $genericBooking=Booking::where('booking_id',$id)->first();

                 if($genericBooking){
                     $genericBooking->status=$ticketUpdate->booking_status;
                     $genericBooking->save();
                 }
            }
           }
           $ticketDetails = FlightBooking::with('passengers','user')->find($id);

               return view('frontend/flights/'.$ticketDetails->api_used.'/success',compact('selectedFlightData','id','ticketDetails'));
               //////////  tour case /////////
           }elseif($paymentData['type']=='tour'){

            $ticketUpdate = TourBooking::find($id);

           if ($ticketUpdate) {
            // Update the payment_method field
            if($ticketUpdate->payment_status!=='completed'){

                $ticketUpdate->payment_method = 'stripe';
                $ticketUpdate->payment_status = $paymentIntent->status =='succeeded' ?'completed' :'pending';
                $ticketUpdate->trx_id = $paymentIntent->id;
                $ticketUpdate->paid_amount = $ticketUpdate->total_amount;
                $ticketUpdate->currency = strtoupper($paymentIntent->currency);

                $ticketUpdate->booking_status = $paymentIntent->status =='succeeded' ?'confirmed' :'pending';
                // Save the changes
                $ticketUpdate->save();

                 // changing booking in generic table 
                 $genericBooking=Booking::where('booking_id',$id)->first();

                 if($genericBooking){
                     $genericBooking->status=$ticketUpdate->booking_status;
                     $genericBooking->save();
                 }
            }
           }
           $ticketDetails = TourBooking::with('user','package.packageCategory')->find($id);

           return view('frontend/toures/success',compact('ticketDetails','id'));
           } else {
                return redirect()->route('home')->with('error','Data not found');
           }

        }
           
        }
    }

    public function initializeStripe(array $result){
     

        $amount=$result['total_amount']*100;
		
		$stripe= new \Stripe\StripeClient([
		   'api_key'=>$result['private_key'], // secret key in stripe  case 
		   ]);
		   $paymentIntent= $stripe->paymentIntents->create(
			[
			  'description' => $result['description'],
			  'shipping' => [
				'name' => $result['name'],
				'address' => [
				  'line1' => 'jhonson street',
				  'postal_code' => '98140',
				  'city' => 'Paris',
				  'state' => 'state',
				  'country' => 'US',
				  
				],
			  ],
			  'amount' => $amount,
			  'currency' => $result['currency'],
			  'payment_method_types' => ['card'],
			  'receipt_email'=>$result['email'],
			  
			]
		  );
          return $paymentIntent;
     
    } 
   

    public function getPaymentGateway($id)
    {
        $paymentMethod = PaymentGateway::find($id);
       
        return $paymentMethod;
    }

    public function getPaymentData(string $type,$data,$paymentMethod){
        if($type=='flight'){
            return[
                'type'=>'flight',
                'gateway_name'=>$paymentMethod->identity,
                'private_key'=>$paymentMethod->private_key,
                'public_key'=>$paymentMethod->public_key,
                'description'=>'Flight Booking Details',
                'name'=>$data->p_name,
                'email'=>$data->email,
                'currency'=>$data->currency,
                'total_amount'=>$data->total_amount
            ];
        }elseif($type=='tour'){
            return[
                'type'=>'tour',
                'gateway_name'=>$paymentMethod->identity,
                'private_key'=>$paymentMethod->private_key,
                'public_key'=>$paymentMethod->public_key,
                'description'=>'Tour Booking Details',
                'name'=>$data->user->name,
                'email'=>$data->user->email,
                'currency'=>$data->currency,
                'total_amount'=>$data->total_amount
            ];
        }
    }


    public function paypalCheckout($id)
    {
        
        if(session('booking_type')=='flight'){

          $ticket= FlightBooking::findOrfail($id);

        }elseif(session('booking_type')=='tour'){

          $ticket= TourBooking::findOrfail($id);

        }else{
            return redirect()->back();
        }


        if($ticket->payment_status=='completed'){
            return redirect()->back()->with('error','Payment Already Completed.');
        }
        // Initialize PayPal client
        $provider = new PayPalClient($this->getPaypalCredentials());

        // Get access token
        $token = $provider->getAccessToken();
    
        // Prepare order data
        $data = [
            "intent" => "CAPTURE",
            "application_context"=>[
                "return_url"=>route('paypal.success',['booking_id'=>$ticket->id,'type'=>session('booking_type')]),
                "cancel_url"=>route('paypal.cancel',['booking_id'=>$ticket->id,'type'=>session('booking_type')]),
            ],
            "purchase_units" => [
                
                [
                    'reference_id'=>$ticket->id,
                    "amount" => [
                        "currency_code" => 'USD',
                        "value" => $ticket->total_amount
                    ]
                ]
            ]
        ];
    
        // Create order
        $order = $provider->createOrder($data);

        if(isset($order['id']) && $order['id']!=null){
             // Redirect the user to the PayPal payment URL
        return redirect($order['links'][1]['href']);
        }
        return redirect()->back()->with('error','Something went wrong. Payment Failed.');

    }

    public function success(Request $request){
        // Initialize PayPal client
        $provider = new PayPalClient($this->getPaypalCredentials());

        // Get access token
        $token = $provider->getAccessToken();
        $response=$provider->capturePaymentOrder($request->token);
       
        // capturing details 
        $id=$request->query('booking_id');
        $type=$request->query('type');
        if(isset($response['status']) && $response['status']=='COMPLETED'){
            if($type=='flight'){


            $ticketUpdate = FlightBooking::find($id);

            $selectedFlightData= Session::get('selectedFlightData');

           if ($ticketUpdate) {
            // Update the payment_method field
            if($ticketUpdate->payment_status!=='completed'){

                $ticketUpdate->payment_method = 'paypal';

                $ticketUpdate->payment_status =$response['status']=='COMPLETED' ?'completed' :'pending';

                $ticketUpdate->trx_id =$response['purchase_units'][0]['payments']['captures'][0]['id'];

                $ticketUpdate->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

                $ticketUpdate->paid_amount_currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];

                $ticketUpdate->booking_status = $response['status']=='COMPLETED' ?'confirmed' :'pending';

                $ticketUpdate->total_fee=$response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'];

                $ticketUpdate->fee_currency=$response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['currency_code'];
                // Save the changes
                $ticketUpdate->save();

                // changing booking in generic table 
                $genericBooking=Booking::where('booking_id',$id)->first();

                if($genericBooking){
                    $genericBooking->status=$ticketUpdate->booking_status;
                    $genericBooking->save();
                }
             }

             $ticketDetails = FlightBooking::with('passengers','user')->find($id);

               return view('frontend/flights/'.$ticketDetails->api_used.'/success',compact('selectedFlightData','id','ticketDetails'));
           }else{
              return redirect()->route('home')->with('error','Ticket data not found');
           }

          }elseif($type=='tour'){
                $ticketUpdate=TourBooking::findOrfail($id);
            if ($ticketUpdate) {
                // Update the payment_method field
                if($ticketUpdate->payment_status!=='completed'){
    
                    $ticketUpdate->payment_method = 'paypal';
    
                    $ticketUpdate->payment_status =$response['status']=='COMPLETED' ?'completed' :'pending';
    
                    $ticketUpdate->trx_id =$response['purchase_units'][0]['payments']['captures'][0]['id'];
    
                    $ticketUpdate->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
    
                    $ticketUpdate->paid_amount_currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
    
                    $ticketUpdate->booking_status = $response['status']=='COMPLETED' ?'confirmed' :'pending';
    
                    $ticketUpdate->total_fee=$response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'];
    
                    $ticketUpdate->fee_currency=$response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['currency_code'];
                    // Save the changes
                    $ticketUpdate->save();
    
                    // changing booking in generic table 
                    $genericBooking=Booking::where('booking_id',$id)->first();
    
                    if($genericBooking){
                        $genericBooking->status=$ticketUpdate->booking_status;
                        $genericBooking->save();
                    }
                 }
    
                 $ticketDetails = TourBooking::with('user','package.packageCategory')->find($id);

                  return view('frontend/toures/success',compact('ticketDetails','id'));
               }
          }
        }

        return redirect()->route('/payment-initialize',$id)->with('error','Something went wrong. Payment not success.');

  }
  public function cancel(Request $request){
     
      // capturing details from url
      return redirect()->back()->with('error','Oops!. Something went wrong. Payment not success.');

  }

  
  private function getPaypalCredentials(){

    $paypal= PaymentGateway::where('identity','paypal')->first();

    $config= [
        'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
        env('PAYPAL_MODE', 'sandbox') => [
            'client_id'         => $paypal->public_key,
            'client_secret'     => $paypal->secret_key,
            'app_id'            => $paypal->shop_id,
        ],
        
        'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
        'currency'       => env('PAYPAL_CURRENCY', 'USD'),
        'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
        'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
        'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', false), // Validate SSL when creating api client.
    ];

    return $config;
    
}
}
