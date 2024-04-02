<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use Illuminate\Validation\Rule;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks=Bank::all();
        return view('backend/payments/banks/banks',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend/payments/banks/create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'bank_name' => ['required', 'string', 'max:150'],
            'account_number' => ['required', 'string',  'max:100'],
            'account_title' => ['required','string','max:150'],
            'swift_code' => ['sometimes', 'nullable','string','max:191'],
            'branch_code' => ['required', 'string','max:191'],
            'branch_name' => ['required', 'string','max:100'],
            'bank_address' => ['sometimes', 'nullable'],
            'status'=> ['required', Rule::in(['active', 'inactive'])],
        ]);
      
        $bank = new Bank([
            'bank_name' => $request->input('bank_name'),
            'account_number' => $request->input('account_number'),
            'account_title' => $request->input('account_title'),
            'swift_code' => $request->input('swift_code'),
            'branch_code' => $request->input('branch_code'),
            'branch_name' => $request->input('branch_name'),
            'bank_address' => $request->input('bank_address'),
            'status' => $request->input('status'), // or 'inactive'
        ]);
        $bank->save();
        return redirect()->route('banks.index')->with('success','Bank created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bank=Bank::findOrfail($id);
        return view('backend/payments/banks/update',compact('bank'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $bank = Bank::findOrFail($id);
        
        $request->validate([
            'bank_name' => ['required', 'string', 'max:150'],
            'account_number' => ['required', 'string',  'max:100'],
            'account_title' => ['required', 'string', 'max:150'],
            'swift_code' => ['sometimes', 'nullable', 'string', 'max:191'],
            'branch_code' => ['required', 'string', 'max:191'],
            'branch_name' => ['required', 'string', 'max:100'],
            'bank_address' => ['sometimes', 'nullable'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);
        
        // Update only the attributes that have changed
        $bank->update([
            'bank_name' => $request->input('bank_name'),
            'account_number' => $request->input('account_number'),
            'account_title' => $request->input('account_title'),
            'swift_code' => $request->input('swift_code'),
            'branch_code' => $request->input('branch_code'),
            'branch_name' => $request->input('branch_name'),
            'bank_address' => $request->input('bank_address'),
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('banks.index')->with('success', 'Bank updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back()->with('error','Oops.! This method is not active yet.');
    }
}
