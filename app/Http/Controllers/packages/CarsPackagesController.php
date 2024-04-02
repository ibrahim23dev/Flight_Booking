<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CarsPackagesController extends Controller
{
    public function index(){
        $cars=Car::with('package')->get();
        return view('backend/packages/cars/cars',compact('cars'));

    }
    public function create(){
        $packages=Package::where('package_type','cars')->get();
        return view('backend/packages/cars/create',compact('packages'));
        
       }

       public function store(Request $request)
       {
           $request->validate([
               'car_type' => ['required', 'string', 'max:191'],
               'package_type' => ['required',Rule::in(Package::where('package_type','cars')->pluck('package_id')->all())],
               'rental_agency' => ['required', 'string'],
               'num_of_days' => ['required', 'integer'],
               'rental_price'=>['required','numeric'],
               'images.*'=>['sometimes','nullable','image','mimes:jpeg,jpg,png,gif']

           ]);
    
           $package = new Car([
               'car_type' => $request->input('car_type'),
               'package_id' => $request->input('package_type'),
               'rental_agency' => $request->input('rental_agency'),
               'num_of_days' => $request->input('num_of_days'),
               'rental_price'=>$request->input('rental_price')
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
       
           return redirect()->route('car-packages.index')->with('success', 'package created successfully.');
       }

       public function edit($id){
        $car=Car::findOrfail($id);
        $packages=Package::where('package_type','cars')->get();
    
        return view('backend/packages/cars/update',compact('packages','car'));
    
       }

       public function update(Request $request,$id)
       {
            $package=Car::findOrfail($id);
            $request->validate([
               'car_type' => ['required', 'string', 'max:191'],
               'package_type' => ['required',Rule::in(Package::where('package_type','cars')->pluck('package_id')->all())],
               'rental_agency' => ['required', 'string'],
               'num_of_days' => ['required', 'integer'],
               'rental_price'=>['required','numeric'],
           ]);
 
               $package->car_type = $request->input('car_type');
               $package->package_id = $request->input('package_type');
               $package->rental_agency = $request->input('rental_agency');
               $package->num_of_days = $request->input('num_of_days');
               $package->rental_price=$request->input('rental_price');
           
               if ($request->hasFile('images')) {
                $images = json_decode($package->images, true) ?? []; // Decode the existing images or initialize as an empty array
                foreach ($request->file('images') as $file) {
                    $path = 'images/packages/';
                    $fileName = time() . '_' . Str::random(3) . $file->getClientOriginalName();
                    $file->storeAs($path, $fileName, 'public');
                    $fullFilePath = $path . $fileName;
                    $images[] = $fullFilePath; // Add the relative path of the new image
                }
                $package->images = json_encode($images); // Store the merged array of relative paths
            }

           $package->save();
       
           return redirect()->route('car-packages.index')->with('success', 'package updated successfully.');
       }

       public function destroy($id)
       {
           try {
               $package = Car::findOrFail($id);
    
               // Delete the package
               $package->delete();
       
               return redirect()->back()->with('success', 'Package deleted successfully.');
           } catch (\Exception $e) {
               return redirect()->back()->with('error', 'An error occurred while deleting.');
           }
       }

       public function deleteImage($carId, $index)
       {
         try {
             $car = Car::findOrFail($carId);
     
             $images = json_decode($car->images);
     
             // Delete the image file from storage
             Storage::disk('public')->delete($images[$index]);
     
     
             // Remove the image path from the array
             unset($images[$index]);
     
             // Reindex the array if it becomes empty
             if (empty($images)) {
                 $car->images = null; // Reset to NULL if no images are left
             } else {
                 $car->images = array_values($images); // Reindex the array
             }
             $car->save();
     
             return response()->json(['message' => 'Image deleted successfully','redirect'=>route('car-packages.edit',$carId)], 200);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Image deletion failed'], 500);
         }
       }

}
