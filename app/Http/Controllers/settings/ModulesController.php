<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Module;
use App\Models\ModuleApiSetting;
use Illuminate\Validation\Rule;
class ModulesController extends Controller
{
    public function index(){
        $modules = Module::all();
        return view('backend/modules/modules',compact('modules'));
    }
    public function create(){
        return view('backend/modules/create');
    }

    public function store(Request $request){
        $request->validate([
           
            'type' => [
                'required',
                Rule::unique('modules', 'type'), // Check for uniqueness in the 'modules' table
                'in:flights,hotels,cars,tours,activity',
            ],
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048', // Validating image format and size

        ]);

        $image = $request->file('image');
        $imageName ='module_'. time() . $image->getClientOriginalName();
        $imagePath = $image->storeAs('images/modules', $imageName, 'public');
        
        $module = new Module([
            'name' => $request->input('type'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'description' => $request->input('description'),
            'image'=>$imageName,
        ]);
         // Save the testimonial to the database
          $module->save();
    
         // Redirect back with a success message
         return redirect()->route('modules.index')->with('success', 'Module created successfully.');

    }
    public function edit($id){
        $module=Module::findOrfail($id);
        return view('backend/modules/update',compact('module'));

    }

    public function update(Request $request, $id) {
        $request->validate([
            'type' => [
                'required',
                Rule::unique('modules', 'type')->ignore($id),
                'in:flights,hotels,cars,tours,activity',
            ],
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $module = Module::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($module->image) {
                Storage::disk('public')->delete('images/modules/' . $module->image);
            }

            // Upload and save the new image
            $image = $request->file('image');
            $imageName = 'module_' . time() . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/modules', $imageName, 'public');
            $module->image = $imageName;
        }

        $module->type = $request->input('type');
        $module->status = $request->input('status');
        $module->description = $request->input('description');
        $module->save();

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    public function changeStatus($id) {
        try {
            $status = request('status'); // Get the 'status' parameter from the request
    
            // Check if the status is valid (active or inactive)
            if ($status !== 'active' && $status !== 'inactive') {
                return response()->json(['success' => false, 'error' => 'Invalid status value', 'message' => 'Status must be active or inactive'], 422);
            }
    
            // Update the status of the Module with the given ID
            $module = Module::findOrFail($id);
            $module->status = $status;
            $module->save();
    
            // If the new status is 'inactive', update the status of all associated APIs
            if ($status === 'inactive') {
                $module->apiSettings()->update(['status' => 'inactive']);
            }
    
            return response()->json(['success' => true, 'message' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Status update failed', 'message' => $e->getMessage()], 400);
        }
    }
    
}
