<?php

namespace App\Http\Controllers\properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surrounding;
use App\Models\Property;
use App\Models\PropertySurrounding;
use App\Models\RoomType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index()
  {
    $user = Auth::user();
    
    // Check if the user has permission to manage all properties
    if ($user->hasPermissionTo('manage all properties')) {
        $properties = Property::with(['user', 'roomTypes'])->get();
    } else {
        $properties = Property::where('user_id', $user->id)
            ->with(['user', 'roomTypes'])
            ->get();
    }

    return view('backend/properties/properties', compact('properties'));
  }

    public function create(){
        $surroundings=Surrounding::all();
        return view('backend/properties/create', compact('surroundings'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:191'],
            'type' => ['required', 'in:hotel,villah,apartment,guest house'],
            'location' => ['required', 'string', 'max:191'],
            'cordinates' => ['required', 'regex:/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'cancellation_charges' => ['required', 'numeric', 'min:0'],
            'payment_allowed' => ['required', 'in:cash,card,both'],
            'check_in_time' => ['required', 'date_format:H:i:s'],
            'check_out_time' => ['required', 'date_format:H:i:s'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['required', 'string'],
            'images.*' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif'],
        ]);
    
        // Create a new property instance
        $property = new Property([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'location' => $request->input('location'),
            'cordinates' => $request->input('cordinates'),
            'price_per_night' => $request->input('price_per_night'),
            'cancellation_charges' => $request->input('cancellation_charges'),
            'payment_allowed' => $request->input('payment_allowed'),
            'check_in_time' => $request->input('check_in_time'),
            'check_out_time' => $request->input('check_out_time'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
        ]);
    
        $property->user_id = auth()->id(); // Assuming you're using authenticated user's ID
    
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $path = 'images/properties/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public');
                $fullFilePath = $path . $fileName;
                $images[] = $fullFilePath;
            }
            $property->images = json_encode($images);
        }
        $property->amenities=defaultAmenityJsonData(); // storing default json data 
        $property->surroundings=defaultSurroundingsJsonData(); // storing default json data 

        $property->save();
    
        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    public function edit($id)
     {
        $property = Property::with(['user', 'roomTypes'])->findOrFail($id);

        $user = Auth::user();

        // echo "<pre>";print_r(json_decode($property->amenities));exit;

        if ($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id) {
            return view('backend/properties/update', compact('property'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to edit this property.');
        }

     }


    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        
        $user = Auth::user();
        
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->back()->with('error', 'You are not authorized to update this property.');
        }

        $request->validate([
            'title' => ['required', 'string', 'max:191'],
            'type' => ['required', 'in:hotel,villah,apartment,guest house'],
            'location' => ['required', 'string', 'max:191'],
            'cordinates' => ['required', 'regex:/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'cancellation_charges' => ['required', 'numeric', 'min:0'],
            'payment_allowed' => ['required', 'in:cash,card,both'],
            'check_in_time' => ['required', 'date_format:H:i:s'],
            'check_out_time' => ['required', 'date_format:H:i:s'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['required', 'string'],
            'images.*' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif'],
        ]);

        $property->title = $request->input('title');
        $property->type = $request->input('type');
        $property->location = $request->input('location');
        $property->cordinates = $request->input('cordinates');
        $property->price_per_night = $request->input('price_per_night');
        $property->cancellation_charges = $request->input('cancellation_charges');
        $property->payment_allowed = $request->input('payment_allowed');
        $property->check_in_time = $request->input('check_in_time');
        $property->check_out_time = $request->input('check_out_time');
        $property->status = $request->input('status');
        $property->description = $request->input('description');

        if ($request->hasFile('images')) {
            $images = json_decode($property->images, true) ?? []; // Decode the existing images or initialize as an empty array
            foreach ($request->file('images') as $file) {
                $path = 'images/properties/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public');
                $fullFilePath = $path . $fileName;
                $images[] = $fullFilePath;
            }
            $property->images = json_encode($images);
        }

        $property->save();

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }


     ///////// for deleting property images ///////
     public function deleteImage($propertyId, $index)
     {
       try {
           $property = Property::findOrFail($propertyId);
   
           $images = json_decode($property->images);
   
           // Delete the image file from storage
           Storage::disk('public')->delete($images[$index]);
   
   
           // Remove the image path from the array
           unset($images[$index]);
   
           // Reindex the array if it becomes empty
           if (empty($images)) {
               $property->images = null; // Reset to NULL if no images are left
           } else {
               $property->images = array_values($images); // Reindex the array
           }
           $property->save();
   
           return response()->json(['message' => 'Image deleted successfully','redirect'=>route('properties.edit',$propertyId)], 200);
       } catch (\Exception $e) {
           return response()->json(['message' => 'Image deletion failed'], 500);
       }
     }

     //// update amenieties 

     public function updateAmenities(Request $request, $propertyId)
     {
        // return response()->json(['ok' =>$request->input('amenities')]);

         // Validate the input
         $validator = Validator::make($request->all(), [
            'amenities' => 'required|array',
            'amenities.*' => 'required|array',
            'amenities.*.heading' => 'required|string', // 'heading' is now just a string
            'amenities.*.points' => 'required|array|min:1', // Use 'points' array instead of 'heading' array
            'amenities.*.points.*.point' => 'required|string',
            'amenities.*.points.*.available' => 'required|boolean',
        ]);
        
         if ($validator->fails()) {
             return response()->json(['success' => false, 'error' => 'validation error']);
         }
     
         // Check user's permissions
         $user = Auth::user();
         $property = Property::findOrFail($propertyId);
     
         if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
             return response()->json(['error' => 'You are not authorized to update this property.'], 403);
         }
     
         // Update the amenities data
         $amenitiesData = $request->input('amenities');
         $property->amenities = $amenitiesData;
         $property->save();
     
         return response()->json(['success' => 'Amenities updated successfully.']);
     }
     

    public function editSurrounding($id)
     {
        $property = Property::with(['user', 'roomTypes'])->findOrFail($id);
        $user = Auth::user();

        // echo "<pre>";print_r(json_decode($property->amenities));exit;

        if ($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id) {
            return view('backend/properties/surroundings', compact('property'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to edit this property.');
        }

     }
     public function updateSurrounding(Request $request, $propertyId)
     {
         // Validate the input
         $validator = Validator::make($request->all(), [
             'surroundings' => 'required|array',
             'surroundings.*' => 'required|array',
             'surroundings.*.heading' => 'required|string',
             'surroundings.*.points' => 'required|array|min:1',
             'surroundings.*.points.*.location' => 'required|string',
             'surroundings.*.points.*.distance' => 'required|string',
         ]);
     
         if ($validator->fails()) {
             return response()->json(['success' => false, 'error' => 'validation error']);
         }
     
         // Check user's permissions
         $user = Auth::user();
         $property = Property::findOrFail($propertyId);
     
         if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
             return response()->json(['error' => 'You are not authorized to update this property.'], 403);
         }
     
         // Update the surroundings data
         $surroundingsData = $request->input('surroundings');
         $property->surroundings = $surroundingsData;
         $property->save();
     
         return response()->json(['success' => 'Surroundings updated successfully.']);
     }
     
   
    
}
