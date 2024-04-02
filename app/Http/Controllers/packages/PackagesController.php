<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageCategory;

use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{
    public function index(){
        $packages=Package::with('packageCategory')->get();
        return view('backend/packages/package/index',compact('packages'));
    }

    public function create(){
        $packageCategories=PackageCategory::all();
        return view('backend/packages/package/create',compact('packageCategories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'package_name' => ['required', 'string', 'max:191'],
            'package_category_id'=>['required','exists:package_categories,id'],
            'package_type' => ['required','string'],
            'status' => ['required', 'in:active,inactive'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'total_package_price'=>['required','numeric'],
            'duration'=>['required','numeric'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

        $package = new Package([
            'package_name' => $request->input('package_name'),
            'package_category_id' => $request->input('package_category_id'),
            'package_type' => $request->input('package_type'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'status' => $request->input('status'),
            'total_package_price'=>$request->input('total_package_price'),
            'duration'=>$request->input('duration'),
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'images/packages/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $package->image = $fullFilePath; // Store the relative path
        }
    
        $package->save();
    
        return redirect()->route('packages.index')->with('success', 'package created successfully.');
    }

    public function edit($id){
        $package=Package::findOrfail($id);
        $packageCategories=PackageCategory::all();
        return view('backend/packages/package/update',compact('package','packageCategories'));

    }

    public function update(Request $request,$id)
    {
        $package=Package::findOrfail($id);
        $request->validate([
            'package_name' => ['required', 'string', 'max:191'],
            'package_category_id'=>['required','exists:package_categories,id'],
            'package_type' => ['required','string'],
            'status' => ['required', 'in:active,inactive'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'total_package_price'=>['required','numeric'],
            'duration'=>['required','numeric'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

            $package->package_name = $request->input('package_name');
            $package->package_category_id = $request->input('package_category_id');
            $package->package_type = $request->input('package_type');
            $package->description = $request->input('description');
            $package->short_description = $request->input('short_description');
            $package->duration = $request->input('duration');
            $package->total_package_price=$request->input('total_package_price');
            $package->status = $request->input('status');
       
        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old file if it exists
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
    
            $file = $request->file('image');
            $path = 'images/packages/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $package->image = $fullFilePath; // Store the relative path
        }
    
        // Save the updated advertisements attributes
        $package->save();

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }
    
}
