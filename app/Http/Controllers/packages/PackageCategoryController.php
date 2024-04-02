<?php

namespace App\Http\Controllers\packages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
class PackageCategoryController extends Controller
{
    public function index(){
        $packages=PackageCategory::all();
        return view('backend/packages/category/index',compact('packages'));
    }

    public function create(){
        return view('backend/packages/category/create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'package_category_name' => ['required', 'string', 'max:191'],
            'currency' => ['required','max:3'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:191'],
            'starting_price'=>['required','numeric'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

        $package = new PackageCategory([
            'package_category_name' => $request->input('package_category_name'),
            'currency' => strtoupper($request->input('currency')),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'status' => $request->input('status'),
            'starting_price'=>$request->input('starting_price')
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'images/packages/';
            $fileName = time() . '_' . $file->getClientOriginalExtension();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $package->image = $fullFilePath; // Store the relative path
        }
    
        $package->save();
    
        return redirect()->route('categories.index')->with('success', 'Package category created successfully.');
    }

    public function edit($id){
        $package=PackageCategory::findOrfail($id);
        return view('backend/packages/category/update',compact('package'));

    }

    public function update(Request $request,$id)
    {

        $package=PackageCategory::findOrfail($id);
        $request->validate([
            'package_category_name' => ['required', 'string', 'max:191'],
            'currency' => ['required','max:3'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:191'],
            'starting_price'=>['required','numeric'],
            'image' => ['nullable','image', 'mimes:jpg,jpeg,png,gif'], // Add mimes validation
        ]);

            $package->package_category_name = $request->input('package_category_name');

            $package->description = $request->input('description');
            $package->currency = strtoupper($request->input('currency'));
            $package->location = $request->input('location');
            $package->starting_price=$request->input('starting_price');
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

        return redirect()->route('categories.index')->with('success', 'Package category updated successfully.');
    }
    
}
