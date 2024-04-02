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


class RoomsController extends Controller
{
    public function index(Property $property)
    {
        // Check user's permissions
        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }
    
        // Fetch the rooms associated with the property
        $rooms = $property->roomTypes;
        return view('backend.properties.rooms.rooms', compact('rooms', 'property'));
    }
    
    public function create(Property $property){

        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }
        return view('backend/properties/rooms/create', compact('property'));

    }

    public function store(Request $request,Property $property)
    {
        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }

        $request->validate([
            'type' => ['required', 'string', 'max:191'],
            'bed_type' => ['required', 'string', 'max:191'],
            'room_size' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'tax' => ['sometimes','nullable', 'numeric', 'min:0'],
            'breakfast' => ['required','string'],
            'num_of_rooms' => ['required', 'integer'],
            'remaining_rooms' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'images.*' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif'],
        ]);
    
        // Create a new property instance
        $room = new RoomType([
            'type' => $request->input('type'),
            'bed_type' => $request->input('bed_type'),
            'room_size' => $request->input('room_size'),
            'price' => $request->input('price'),
            'tax' => $request->input('tax'),
            'breakfast' => $request->input('breakfast'),
            'num_of_rooms' => $request->input('num_of_rooms'),
            'remaining_rooms' => $request->input('remaining_rooms'),
            'description' => $request->input('description'),
            'property_id'=>$property->id
        ]);
    
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $path = 'images/properties/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public');
                $fullFilePath = $path . $fileName;
                $images[] = $fullFilePath;
            }
            $room->images = json_encode($images);
        }
        $room->amenities=defaultRoomJsonData();
        $room->save();
    
        return redirect()->route('rooms.index', ['property' => $property->id])->with('success', 'Room created successfully.');
    }

    public function edit(Request $request,Property $property,$id){
        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }
        $room=RoomType::findOrfail($id);
        return view('backend/properties/rooms/update', compact('property','room'));
        
    }

    public function update(Request $request,Property $property, RoomType $room){
        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }

        $request->validate([
            'type' => ['required', 'string', 'max:191'],
            'bed_type' => ['required', 'string', 'max:191'],
            'room_size' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'tax' => ['sometimes','nullable', 'numeric', 'min:0'],
            'breakfast' => ['required','string'],
            'num_of_rooms' => ['required', 'integer'],
            'remaining_rooms' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'images.*' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png,gif'],
        ]);

        $room->type = $request->input('type');
        $room->bed_type = $request->input('bed_type');
        $room->room_size = $request->input('room_size');
        $room->price = $request->input('price');
        $room->tax = $request->input('tax');
        $room->breakfast = $request->input('breakfast');
        $room->num_of_rooms = $request->input('num_of_rooms');
        $room->remaining_rooms = $request->input('remaining_rooms');
        $room->description = $request->input('description');

        if ($request->hasFile('images')) {
            $images = json_decode($room->images, true) ?? []; // Decode the existing images or initialize as an empty array
            foreach ($request->file('images') as $file) {
                $path = 'images/properties/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs($path, $fileName, 'public');
                $fullFilePath = $path . $fileName;
                $images[] = $fullFilePath;
            }
            $room->images = json_encode($images);
        }
        $room->save();
        return redirect()->route('rooms.index', ['property' => $property->id])->with('success', 'Room Updated successfully.');
    }

    public function deleteImage(Property $property,$roomid, $index)
    {

        $user = Auth::user();
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return redirect()->route('properties.index')->with('error', 'You are not authorized.');

        }
      try {
          $room = RoomType::findOrFail($roomid);
  
          $images = json_decode($room->images);
  
          // Delete the image file from storage
          Storage::disk('public')->delete($images[$index]);
  
  
          // Remove the image path from the array
          unset($images[$index]);
  
          // Reindex the array if it becomes empty
          if (empty($images)) {
              $room->images = null; // Reset to NULL if no images are left
          } else {
              $room->images = array_values($images); // Reindex the array
          }
          $room->save();
  
          return response()->json(['message' => 'Image deleted successfully','redirect'=>route('rooms.edit', ['property' => $property->id,'room'=>$roomid])], 200);
      } catch (\Exception $e) {
          return response()->json(['message' => 'Image deletion failed'], 500);
      }
    }

    public function updateAmenities(Request $request, $propertyId,$roomId)
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
        $room = RoomType::findOrFail($roomId);
        
        if (!($user->hasPermissionTo('manage all properties') || $property->user_id === $user->id)) {
            return response()->json(['error' => 'You are not authorized to update this room.'], 403);
        }
    
        // Update the amenities data
        $amenitiesData = $request->input('amenities');
        $room->amenities = $amenitiesData;
        $room->save();
    
        return response()->json(['success' => 'Amenities updated successfully.']);
    }
}
