<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index(){
        $payments=PaymentGateway::OrderBy('id','desc')->get();
        return view('backend/payments/payment_methods/payment-methods',compact('payments'));

    }
    public function create(){
        return view('backend/payments/payment_methods/create');
        
    }
    public function store(Request $request){
    
        $request->validate([
            'identity' => ['required', 'string', 'max:50'],
            'agent' => ['required', 'string',  'max:100'],
            'public_key' => ['sometimes', 'nullable','string'],
            'secret_key' => ['sometimes', 'nullable','string'],
            'private_key' => ['sometimes', 'nullable','string'],
            'shop_id' => ['sometimes', 'nullable','string','max:100'],
            'status'=> ['required', Rule::in(['active', 'inactive'])],
            'icon' => ['nullable','file', 'mimes:jpg,jpeg,png,gif'],
        ]);
        $data = $request->all();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $path = 'images/payments/payment_icons/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $data['icon'] = $fullFilePath; // Store the relative path in the data array
        }
        
        PaymentGateway::create($data);
        return redirect()->route('payment-methods.index')->with('success','Payment method created successfully');
    }

    public function edit(Request $reques, $id){
        $payment=PaymentGateway::findOrfail($id);
        return view('backend/payments/payment_methods/update',compact('payment'));

    }
    public function update(Request $request,$id){
      $validatedData =  $request->validate([
            'identity' => ['required', 'string', 'max:50'],
            'agent' => ['required', 'string',  'max:100'],
            'public_key' => ['sometimes', 'nullable','string'],
            'secret_key' => ['sometimes', 'nullable','string'],
            'private_key' => ['sometimes', 'nullable','string'],
            'shop_id' => ['sometimes', 'nullable','string','max:100'],
            'status'=> ['required', Rule::in(['active', 'inactive'])],
            'icon' => ['nullable','file', 'mimes:jpg,jpeg,png,gif'],

        ]);

        $paymentGateway = PaymentGateway::findOrFail($id);
        // Update the image if a new one is uploaded
        if ($request->hasFile('icon')) {
            // Delete the old file if it exists
            if ($paymentGateway->icon) {
                Storage::disk('public')->delete($paymentGateway->icon);
            }
    
            $file = $request->file('icon');
            $path = 'images/payments/payment_icons/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            // $paymentGateway->icon = $fullFilePath; 
            $validatedData['icon']=$fullFilePath;
        }
        $paymentGateway->update($validatedData);
        return redirect()->route('payment-methods.index')->with('success','Payment method updated successfully');
    }

    public function destroy($id){
        $payment=PaymentGateway::findOrfail($id);
        $payment->delete();
        return redirect()->route('payment-methods.index')->with('success','Payment method deleted successfully');
    }

    public function changeStatus($id) {
        try {
            $status = request('status'); // Get the 'status' parameter from the request
            
            // Check if the status is valid (active or inactive)
            if ($status !== 'active' && $status !== 'inactive') {
                return response()->json(['success' => false, 'error' => 'Invalid status value', 'message' => 'Status must be active or inactive'], 422);
            }
    
            // Update the status of the PaymentMethod with the given ID
            $paymentMethod = PaymentGateway::findOrFail($id);
            $paymentMethod->status = $status;
            $paymentMethod->save();
    
            return response()->json(['success' => true, 'message' => 'Status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Status update failed', 'message' => $e->getMessage()], 400);
        }
    }
    
    
    
}
