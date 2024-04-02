<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Models\TourBooking;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;



class TouresController extends Controller
{
    public function toures(Request $request){

        $packages = Package::query()->with('packageCategory');
    
        if ($request->has('tour') && $request->has('id') && $request->query('id') != '') {
            $packages->where('package_category_id', $request->query('id'));
        }
    
        $packages = $packages->get();

        return view('frontend/pages/toures',compact('packages'));

    }

    public function singleTour($id){
        $package=Package::with('packageCategory')->findOrfail($id);

        return view('frontend/pages/tour-single',compact('package'));

    }

    public function bookTour(Request $request,$id){

        $package=Package::with('packageCategory')->findOrfail($id);

        $paymentGateWays=PaymentGateway::where('status','active')->get();

        if($request->isMethod('GET')){

            return view('frontend/pages/tour-book',compact('package','paymentGateWays'));

        }
    
        $request->validate([
            'full_name'=>'required|string|max:50',
            'country_code'=>'required|numeric',
            'contact_no'=>'required|numeric',
            'email'=>'required|email',
            'payment_gateway' => ['required', 'numeric', 'exists:payment_gateway,id']

        ]);

            // Check if a user with the given email exists in the users table
            $userByEmail = User::where('email', $request->input('email'))->first();
        
            if ($userByEmail) {
                $userId = $userByEmail->id;
            } else {
                // Create a new user
                $newUser = User::create([
                    'name' => $request->input('full_name'),
                    'email' => $request->input('email'),
                    'password'=>Hash::make(12345678),
                    'status'=>'inactive',
                    'mobile'=>$request->input('country_code').'-'.$request->input('contact_no'),
                    'affiliate_code' => $request->input('full_name').'_'.Str::random(6),
                ]);
                $newUser->assignRole('B2C');
                $userId = $newUser->id;
            }

        $tourBooking=New TourBooking;

        $tourBooking->user_id=$userId;
        $tourBooking->package_id=$id;
        $tourBooking->booking_status='pending';
        $tourBooking->payment_status='pending';
        $tourBooking->ref_code='tour_'.Str::random(5);
        $tourBooking->total_amount=$package->total_package_price;
        $tourBooking->currency=$package->packageCategory->currency;

        $tourBooking->save();

        // now adding booking details in generic booking table

        $genericBooking = new Booking([
            'booking_type' => 'tour',
            'booking_id' => $tourBooking->id,
            'user_id' => $tourBooking->user_id,
            'ref_code'=>$tourBooking->ref_code,
            'booking_date' => now(),

            'price'=>$tourBooking->total_amount,
            'currency'=>$tourBooking->currency,
            'status'=>$tourBooking->booking_status,
            'bookingable_type' => 'tour',
            'bookingable_id' => $tourBooking->id,
            
        ]);
        $genericBooking->save();
        Session::put('ticket_id',$tourBooking->id);
       
        Session::put('booking_type','tour');
        Session::put('payment_gateway_id',$request->input('payment_gateway'));
        return redirect()->route('/payment-initialize',$tourBooking->id);
   
    }


    // backend methods  

    public function index(Request $request) {
        // Check if the authenticated user has the 'manage all bookings' permission
        if (auth()->user()->hasPermissionTo('manage all bookings')) {
            // User has permission to manage all bookings
            $query = Tourbooking::with('user','package')->orderBy('created_at', 'desc');
        } else {
            // User does not have permission to manage all bookings
            // Fetch only the tickets linked to the authenticated user
            $query = Tourbooking::with('user','package')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        }
    
        // Check if a 'booking_status' parameter is provided in the query string
        if ($request->has('booking_status')) {
            $status = $request->query('booking_status');
            $query->where('status', $status);
        }
    
        // You can add more conditions for other query parameters here if needed
        $tickets = $query->get();

        return view('backend/bookings/tour/index', compact('tickets'));
    }

    public function edit($id){

        $query = Tourbooking::with('user','package.packageCategory')->findOrfail($id);

        if (!auth()->user()->hasPermissionTo('manage all bookings') && $query->user_id!=auth()->user()->id) {
            return redirect()->route('tour-bookings.index')->with('error','You does not have the right permission.');

        }else{
            // User has permission to manage all bookings or own booking
            return view('backend/bookings/tour/update', compact('query'));

        } 
    }
    
    public function update(Request $request ,$id){
        $ticket=TourBooking::findorfail($id);

        if (!auth()->user()->hasPermissionTo('manage all bookings')) {
            return redirect()->route('tour-bookings.index')->with('error','You does not have the right permission.');
        }
        $rules = [
            'payment_status' => ['required', 'string' ,Rule::in(['completed', 'pending'])],
            'booking_status' => ['required', 'string' ,Rule::in(['canceled', 'pending','confirmed'])],
            'payment_method'=>['sometimes','nullable','string'],
            'trx_id'=>['sometimes','nullable','string'],
            'paid_amount' => ['sometimes', 'nullable', 'string', 'max:50'],
            'currency' => ['required', 'string', 'max:3'],
        ];
        $validatedData = $request->validate($rules);

        // Update the ticket data with the validated data
        $ticket->update($validatedData);

         // also update the generic booking table status 
         $genericBooking=Booking::where('booking_id',$ticket->id)->first();
         $genericBooking->status=$ticket->booking_status;
         $genericBooking->currency=$ticket->currency;
         $genericBooking->save();

        return redirect()->route('tour-bookings.index')->with('success','Tour data updated');
    }
    
}
