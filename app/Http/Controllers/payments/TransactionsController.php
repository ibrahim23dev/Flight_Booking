<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;
use App\Models\Deposit;

class TransactionsController extends Controller
{
    public function index(){

        if (!Auth::user()->hasPermissionTo('manage all transactions')) {
            return redirect()->route('transactions.index')->with('error','You are not authorized to access it');

        }
        $transactions=  Transection::with('user', 'userBalance', 'releted')->get();

        foreach ($transactions as $transaction) {
   
        //     // Access related withdrawal or deposit
            $relatedModel = $transaction->releted; // This will be either a Withdraw or Deposit instance
    
            if ($relatedModel instanceof Withdraw) {
                // This is a withdrawal transaction
                $withdraw = $relatedModel;

            } elseif ($relatedModel instanceof Deposit) {
                // This is a deposit transaction
                $deposit = $relatedModel;

            }
        }
        
        return view('backend.payments.transactions.transactions', compact('transactions','deposit','withdraw'));
    
        
 }
    public function edit($id){
        $transaction=Transection::with('user')->findorfail($id);
        return view('backend/payments/transactions/update',compact('transaction'));

    }
    // public function update(Request $request ,$id){
        
    //     return redirect()->back()->with('error','Oops.! This function is currently deactivated.'); // deactivated 
    //     $validatedData =  $request->validate([
    //         'transection_category' => ['sometimes','nullable', 'string', 'max:190'],
    //         'comments' => ['sometimes', 'string', 'nullable'],
    //         'status'=> ['required', Rule::in(['pending', 'completed','canceled'])],
    //     ]);


    //     $transaction = Transection::findOrFail($id);

    //     $transaction->update($validatedData);
    //     return redirect()->route('transactions.index')->with('success','transaction updated successfully');
    // }

    public function destroy($id){
        return redirect()->back()->with('error','Oops.! This function is currently deactivated.');
        $payment=Transection::findOrfail($id);
        $payment->delete();
        return redirect()->route('transactions.index')->with('success','Transaction deleted successfully');
    }


}
