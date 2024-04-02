<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Module;
use App\Models\ModuleApiSetting;
use Illuminate\Validation\Rule;

class ModulesApiController extends Controller
{
    public function index(){
        $modulesApis=ModuleApiSetting::orderBy("id","desc")->with('module')->get();
        return view('backend/modules/module_apis/index',compact('modulesApis'));

    }
    public function create(){
        $modules=Module::all();
        return view('backend/modules/module_apis/create',compact('modules'));
    }

    public function store(Request $request) {
        $request->validate([
            'module' => 'required|exists:modules,id',
            'api_name' => [
                'required','string'
                
            ],
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'api_endpoint' => 'nullable',
            'api_test_key' => 'string|nullable',
            'api_test_secret_key' => 'string|nullable',
            'api_test_endpoint' => 'string|nullable',
            'api_mode' => 'required|in:test,live',
            'status' => 'required|in:active,inactive',
            'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048|nullable',
        ]);
        $module=Module::where('id',$request->input('module'))->first();
        $moduleApiSetting = new ModuleApiSetting([
            'module_id' => $request->input('module'),
            'api_type'=> $module->type,
            'api_name' => $request->input('api_name'),
            'api_key' => $request->input('api_key'),
            'api_secret' => $request->input('api_secret'),
            'api_endpoint' => $request->input('api_endpoint'),
            'api_test_key' => $request->input('api_test_key'),
            'api_test_secret_key' => $request->input('api_test_secret_key'),
            'api_test_endpoint' => $request->input('api_test_endpoint'),
            'api_mode' => $request->input('api_mode'),
            'status' => $request->input('status'),
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'api_' . time() . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/modules', $imageName, 'public');
            $moduleApiSetting->image = $imageName;
        }
    
        $moduleApiSetting->save();
        
        $apiType = $moduleApiSetting->api_type; 
        $status=$moduleApiSetting->status;
        // If the new status is 'active', update the status of all other APIs of the same type to inactive
        if ($status === 'active') {
            ModuleApiSetting::where('api_type', $apiType)->where('id', '!=', $moduleApiSetting->id)->update(['status' => 'inactive']);
        }

        return redirect()->route('modules-apis.index')->with('success', 'Module API setting created successfully.');
    }

    public function edit($id){
        $modules=Module::all();
        $api=ModuleApiSetting::findOrfail($id);
        return view('backend/modules/module_apis/update',compact('modules','api'));

    }

    public function update(Request $request, $id) {

        $request->validate([
            'module' => 'required|exists:modules,id',
            'api_name' => 'required|string',
            'api_key' => 'sometimes|nullable|string',
            'api_secret' => 'nullable|string',
            'api_endpoint' => 'nullable', // You can add more specific validation for URLs if needed
            'api_test_key' => 'string|nullable',
            'api_test_secret_key' => 'string|nullable',
            'api_test_endpoint' => 'string|nullable',
            'api_mode' => 'required|in:test,live',
            'status' => 'required|in:active,inactive',
            'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048|nullable',
        ]);

        $status=$request->input('status');
        $moduleApiSetting = ModuleApiSetting::find($id);
    
        if (!$moduleApiSetting) {
            return redirect()->route('modules-apis.index')->with('error', 'Module API setting not found.');
        }

        $apiType = $moduleApiSetting->api_type; 

        // If the new status is 'active', update the status of all other APIs of the same type to inactive
        if ($status === 'active') {
            ModuleApiSetting::where('api_type', $apiType)->where('id', '!=', $id)->update(['status' => 'inactive']);
        }

        $module=Module::where('id',$request->input('module'))->first();
        
        $moduleApiSetting->module_id = $request->input('module');
        $moduleApiSetting->api_type = $module->type;
        $moduleApiSetting->api_name = $request->input('api_name');
        $moduleApiSetting->api_key = $request->input('api_key');
        $moduleApiSetting->api_secret = $request->input('api_secret');
        $moduleApiSetting->api_endpoint = $request->input('api_endpoint');
        $moduleApiSetting->api_test_key = $request->input('api_test_key');
        $moduleApiSetting->api_test_secret_key = $request->input('api_test_secret_key');
        $moduleApiSetting->api_test_endpoint = $request->input('api_test_endpoint');
        $moduleApiSetting->api_mode = $request->input('api_mode');
        $moduleApiSetting->status = $request->input('status');
    
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($moduleApiSetting->image) {
                Storage::disk('public')->delete('images/modules/' . $moduleApiSetting->image);
            }
    
            // Upload and store the new image
            $image = $request->file('image');
            $imageName = 'api_' . time() . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/modules', $imageName, 'public');
            $moduleApiSetting->image = $imageName;
        }
    
        $moduleApiSetting->save();
    
        return redirect()->route('modules-apis.index')->with('success', 'Module API setting updated successfully.');
    }

    public function changeStatus($id) {
        try {
            $status = request('status'); // Get the 'status' parameter from the request
    
            // Check if the status is valid (active or inactive)
            if ($status !== 'active' && $status !== 'inactive') {
                return response()->json(['success' => false, 'error' => 'Invalid status value', 'message' => 'Status must be active or inactive'], 422);
            }
    
            // Find the current Module API
            $moduleApi = ModuleApiSetting::findOrFail($id);
    
            if ($moduleApi) {
                $apiType = $moduleApi->api_type; 
    
                // If the new status is 'active', update the status of all other APIs of the same type to inactive
                if ($status === 'active') {
                     // checking if api's module is active when status is active 
                     $moduleStatus=$moduleApi->module->status;
                     if($moduleStatus != 'active') {
                        return response()->json(['success' => false, 'error' => 'Module inactive', 'message' => 'Status cannot be changed for inactive module'], 404);
                     }
                    ModuleApiSetting::where('api_type', $apiType)->where('id', '!=', $id)->update(['status' => 'inactive']);
                    
                }

               
    
                // Update the status of the current API
                $moduleApi->status = $status;
                $moduleApi->save();
    
                return response()->json(['success' => true, 'message' => 'Status updated successfully'], 200);
            } else {
                return response()->json(['success' => false, 'error' => 'Module API not found', 'message' => 'The specified Module API does not exist'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Status update failed', 'message' => $e->getMessage()], 400);
        }
    }
    
    
    

}
