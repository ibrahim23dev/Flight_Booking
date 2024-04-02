<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use Illuminate\Validation\Rule;
use App\Models\Deposit;
use Illuminate\Support\Facades\Storage;
use App\Models\Transection;

class DepositsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasPermissionTo('manage all deposits')) {
            $deposits = Deposit::with('depositor')->get(); // Fetch all deposits with associated users
        } else {
            $deposits = auth()->user()->deposits; // Fetch deposits of the current user
        }
        return view('backend/payments/deposits/deposits',compact('deposits'));
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banks=Bank::all();
        return view('backend/payments/deposits/create',compact('banks'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'mode' => ['required', 'in:cash,check,dd,etransfer'],
            'deposited_bank' => ['required', 'string', 'max:255'],
            'branch' => ['required', 'string', 'max:255'],
            'transaction_no' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'date_of_deposit' => ['required', 'date'],
            'image' => ['nullable','file', 'mimes:jpg,jpeg,png,pdf'], // Add mimes validation
        ]);
    
        $user = auth()->user();
    
        $depositRequest = new Deposit([
            'amount' => $request->input('amount'),
            'mode' => $request->input('mode'),
            'deposited_bank' => $request->input('deposited_bank'),
            'branch' => $request->input('branch'),
            'transaction_no' => $request->input('transaction_no'),
            'remarks' => $request->input('remarks'),
            'city'=>$request->input('city'),
            'status' => 'pending',
            'date_of_deposit'=>$request->input('date_of_deposit')
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'images/payments/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $depositRequest->image = $fullFilePath; // Store the relative path
        }
    
        $user->deposits()->save($depositRequest);
    
        return redirect()->route('deposits.index')->with('success', 'Deposit request submitted successfully.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo('manage all deposits')) {
            return redirect()->route('deposits.index')->with('error', 'You are not allowed to perform this action.');
        }
    
        $deposit = Deposit::with('depositor')->findOrFail($id);
        $banks=Bank::all();
        return view('backend/payments/deposits/update',compact('deposit','banks'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposit $deposit)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'mode' => ['required', 'in:cash,check,dd,etransfer'],
            'deposited_bank' => ['required', 'string', 'max:255'],
            'branch' => ['required', 'string', 'max:255'],
            'transaction_no' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'date_of_deposit' => ['required', 'date'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf'], // Add mimes validation
        ]);
    
        // Update the deposit attributes
        $deposit->amount = $request->input('amount');
        $deposit->mode = $request->input('mode');
        $deposit->deposited_bank = $request->input('deposited_bank');
        $deposit->branch = $request->input('branch');
        $deposit->transaction_no = $request->input('transaction_no');
        $deposit->remarks = $request->input('remarks');
        $deposit->city = $request->input('city');
        $deposit->date_of_deposit = $request->input('date_of_deposit');
    
        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old file if it exists
            if ($deposit->image) {
                Storage::disk('public')->delete($deposit->image);
            }
    
            $file = $request->file('image');
            $path = 'images/payments/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($path, $fileName, 'public');
            $fullFilePath = $path . $fileName;
            $deposit->image = $fullFilePath; // Store the relative path
        }
    
        // Save the updated deposit attributes
        $deposit->save();

        return redirect()->route('deposits.index')->with('success', 'Deposit request updated successfully.');
    }
    
    public function depositsAccept($id){



        if(!auth()->user()->hasPermissionTo('manage all deposits')){
            return redirect()->route('deposits.index')->with('error', 'You are not allowed to perform this action.');
        }
        $deposit = Deposit::with('depositor')->findOrFail($id);
        if($deposit->status!='accepted'){
    
             // Update the user's balance
             $user = $deposit->depositor;

             if ($user->balance) {
                 $user->balance()->update([
                     'balance_amount' => $user->balance->balance_amount + $deposit->amount,
                 ]);
             } else {
                 $user->balance()->create([
                     'balance_amount' => $deposit->amount,
                     'currency_code' => 'USD',
                 ]);
             }
                $deposit->update([
                    'status'=>'accepted'
                ]);

                // creating new transaction 
                    
                $transaction=Transection::create([
                    'user_id'=>$user->id,
                    'transection_category'=>'deposit',
                    'amount'=>$deposit->amount,
                    'transection_date_timestamp'=>now(),
                    'status'=>'completed',
                    'releted_id'=>$deposit->id,
                    'releted_type'=>'App\Models\Deposit',
                ]);
                $transaction->save();
     
             return redirect()->route('deposits.index')->with('success', 'Deposit accepted, and new transaction has been created successfully.');
        }else{
            return redirect()->route('deposits.index')->with('error', 'This deposit has already been accepted.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
