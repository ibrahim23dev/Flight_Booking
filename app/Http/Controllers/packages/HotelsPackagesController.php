<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class HotelsPackagesController extends Controller
{
    public function index(){
        $hotels=Hotel::with('package')->get();
        return view('backend/packages/hotels/hotels',compact('hotels'));

    }
    public function create(){
        $packages=Package::where('package_type','hotels')->get();
        return view('backend/packages/hotels/create',compact('packages'));
        
       }
    
       public function store(Request $request)
       {

           $request->validate([
               'name' => ['required', 'string', 'max:191'],
               'package_type' => ['required',Rule::in(Package::where('package_type','hotels')->pluck('package_id')->all())],
               'location' => ['required', 'string'],
               'num_rooms' => ['required', 'integer'],
               'price_per_night'=>['required','numeric'],
               'images.*'=>['sometimes','nullable','image','mimes:jpeg,jpg,png,gif']
           ]);

           $package = new Hotel([
               'name' => $request->input('name'),
               'package_id' => $request->input('package_type'),
               'location' => $request->input('location'),
               'num_rooms' => $request->input('num_rooms'),
               'price_per_night'=>$request->input('price_per_night')
           ]);

           if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $path = 'images/packages/';
                $fileName = time() .'_'. Str::random(3) . $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public');
                $fullFilePath = $path . $fileName;
                $images[] = $fullFilePath; // Store the relative path for each image
            }
            $package->images = json_encode($images); // Store the array of relative paths
         }
       
           $package->save();
       
           return redirect()->route('hotel-packages.index')->with('success', 'package created successfully.');
       }
    
       public function edit($id){
        $hotel=Hotel::findOrfail($id);
        $packages=Package::where('package_type','hotels')->get();
    
        return view('backend/packages/hotels/update',compact('packages','hotel'));
    
       }
    
       public function update(Request $request, $id)
       {
           $hotel = Hotel::findOrFail($id);
       
           $request->validate([
               'name' => ['required', 'string', 'max:191'],
               'package_type' => ['required', Rule::in(Package::where('package_type', 'hotels')->pluck('package_id')->all())],
               'location' => ['required', 'string'],
               'num_rooms' => ['required', 'integer'],
               'price_per_night' => ['required', 'numeric'],
           ]);
       
           $hotel->name = $request->input('name');
           $hotel->package_id = $request->input('package_type');
           $hotel->location = $request->input('location');
           $hotel->num_rooms = $request->input('num_rooms');
           $hotel->price_per_night = $request->input('price_per_night');
       
           if ($request->hasFile('images')) {
               $images = json_decode($hotel->images, true) ?? []; // Decode the existing images or initialize as an empty array
               foreach ($request->file('images') as $file) {
                   $path = 'images/packages/';
                   $fileName = time() . '_' . Str::random(3) . $file->getClientOriginalName();
                   $file->storeAs($path, $fileName, 'public');
                   $fullFilePath = $path . $fileName;
                   $images[] = $fullFilePath; // Add the relative path of the new image
               }
               $hotel->images = json_encode($images); // Store the merged array of relative paths
           }
       
           $hotel->save();
       
           return redirect()->route('hotel-packages.index')->with('success', 'Package updated successfully.');
       }
       
       
    
       public function destroy($id)
       {
           try {
               $package = Hotel::findOrFail($id);
    
               // Delete the package
               $package->delete();
       
               return redirect()->back()->with('success', 'Package deleted successfully.');
           } catch (\Exception $e) {
               return redirect()->back()->with('error', 'An error occurred while deleting.');
           }
       }



   public function deleteImage($hotelId, $index)
  {
    try {
        $hotel = Hotel::findOrFail($hotelId);

        $images = json_decode($hotel->images);

        // Delete the image file from storage
        Storage::disk('public')->delete($images[$index]);


        // Remove the image path from the array
        unset($images[$index]);

        // Reindex the array if it becomes empty
        if (empty($images)) {
            $hotel->images = null; // Reset to NULL if no images are left
        } else {
            $hotel->images = array_values($images); // Reindex the array
        }
        $hotel->save();

        return response()->json(['message' => 'Image deleted successfully','redirect'=>route('hotel-packages.edit',$hotelId)], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Image deletion failed'], 500);
    }
  }


    
}
