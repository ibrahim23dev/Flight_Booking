<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Flight;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FlightPackagesController extends Controller
{    public function index(){
    $flights=Flight::with('package')->get();

    return view('backend/packages/flights/flights',compact('flights'));
   }

   public function create(){
    $packages=Package::where('package_type','flights')->get();
    return view('backend/packages/flights/create',compact('packages'));
    
   }

   public function store(Request $request)
   {

       $request->validate([
           'airline' => ['required', 'string', 'max:191'],
           'package_type' => ['required',Rule::in(Package::where('package_type','flights')->pluck('package_id')->all())],
           'departure_city' => ['nullable', 'string'],
           'arrival_city' => ['required', 'string'],
           'arrival_iataCode' => ['required', 'string','max:3'],
           'price'=>['required','numeric'],
           'currency'=>['required','string'],
           'status'=>['required','in:active,inactive'],
       ]);

       $package = new Flight([
           'airline' => $request->input('airline'),
           'package_id' => $request->input('package_type'),
           'departure_city' => $request->input('departure_city'),
           'arrival_city' => $request->input('arrival_city'),
           'price'=>$request->input('price'),
           'currency'=>$request->input('currency'),
           'arrival_iataCode'=>$request->input('arrival_iataCode'),
           'status'=>$request->input('status'),
       ]);
   
       $package->save();
   
       return redirect()->route('flight-packages.index')->with('success', 'Package created successfully.');
   }

   public function edit($id){
    $flight=Flight::findOrfail($id);
    $packages=Package::where('package_type','flights')->get();

    return view('backend/packages/flights/update',compact('packages','flight'));

   }

   public function update(Request $request, $id)
   {
        $flight=Flight::findOrfail($id);
          $request->validate([
            'airline' => ['required', 'string', 'max:191'],
            'package_type' => ['required',Rule::in(Package::where('package_type','flights')->pluck('package_id')->all())],
            'departure_city' => ['nullable', 'string'],
            'arrival_city' => ['required', 'string'],
            'arrival_iataCode' => ['required', 'string','max:3'],
            'price'=>['required','numeric'],
            'currency'=>['required','string'],
            'status'=>['required','in:active,inactive'],
        ]);

           $flight->airline = $request->input('airline');
           $flight->package_id =$request->input('package_type');
           $flight->departure_city = $request->input('departure_city');
           $flight->arrival_city = $request->input('arrival_city');
           $flight->arrival_iataCode = $request->input('arrival_iataCode');
           $flight->price=$request->input('price');
           $flight->currency=$request->input('currency');
           $flight->status=$request->input('status');
    
           $flight->save();
   
       return redirect()->route('flight-packages.index')->with('success', 'package updated successfully.');
   }

   public function destroy($id)
   {
       try {
           $package = Flight::findOrFail($id);

           // Delete the package
           $package->delete();
   
           return redirect()->back()->with('success', 'Package deleted successfully.');
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'An error occurred while deleting.');
       }
   }
}
