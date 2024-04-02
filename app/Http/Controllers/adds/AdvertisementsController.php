<?php

namespace App\Http\Controllers\adds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdvertisementsController extends Controller
{
    public function index(){
        $advertisements=Advertisement::with('createdByUser')->get();
        return view('backend/adds/advertisements',compact('advertisements'));
    }

    public function create(){
        return view('backend/adds/create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'position' => ['required', 'in:top,bottom,left,right'],
            'status' => ['required', 'in:active,inactive'],
            'link' => ['required', 'url', 'max:191'],
            'description' => ['nullable', 'string', 'max:191'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

        $user = auth()->user();
    
        $advertisement = new Advertisement([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'link' => $request->input('link'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'created_by'=>$user->id
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'images/adds/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $advertisement->image = $fullFilePath; // Store the relative path
        }
    
        $advertisement->save();
    
        return redirect()->route('advertisements.index')->with('success', 'advertisement created successfully.');
    }

    public function edit($id){
        $advertisement=Advertisement::findOrfail($id);
        return view('backend/adds/update',compact('advertisement'));

    }

    public function update(Request $request,$id)
    {
        $advertisement=Advertisement::findOrfail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'position' => ['required', 'in:top,bottom,left,right'],
            'status' => ['required', 'in:active,inactive'],
            'link' => ['required', 'url', 'max:191'],
            'description' => ['nullable', 'string', 'max:191'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

            $advertisement->name = $request->input('name');
            $advertisement->position = $request->input('position');
            $advertisement->link = $request->input('link');
            $advertisement->description = $request->input('description');
            $advertisement->status = $request->input('status');
       
        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old file if it exists
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
    
            $file = $request->file('image');
            $path = 'images/adds/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $advertisement->image = $fullFilePath; // Store the relative path
        }
    
        // Save the updated advertisements attributes
        $advertisement->save();

        return redirect()->route('advertisements.index')->with('success', 'advertisement updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $advertisement = Advertisement::findOrFail($id);
    
            // Delete the associated image
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
    
            // Delete the advertisement
            $advertisement->delete();
    
            return redirect()->route('advertisements.index')->with('success', 'Advertisement deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('advertisements.index')->with('error', 'An error occurred while deleting the advertisement.');
        }
    }
    
    
}
