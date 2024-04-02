<?php

namespace App\Http\Controllers\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;
use App\Models\Transection;
class WithdrawController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasPermissionTo('manage all withdraws')) {
            // User has permission to manage all withdraws, fetch all withdrawals
            $withdraws = Withdraw::with('user', 'userBalance')->orderBy('withdraw_id','desc')->get();
        } else {
            // User does not have permission, fetch only their own withdrawals
            $withdraws = Withdraw::where('user_id', $user->id)
                ->with('userBalance')
                ->orderBy('withdraw_id','desc')
                ->get();
        }
        return view('backend/payments/withdraws/withdraws', compact('withdraws'));
    }

    public function create(){
        return view('backend/payments/withdraws/create');

    }

    public function store(Request $request){
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'method' => ['required', 'in:cash,check,dd,etransfer'],
            'comments'=>['sometimes','nullable','string']
        ]);

        $userBlanceData=auth()->user()->balance;
            if($userBlanceData->balance_amount < $request->input('amount')){
                return redirect()->back()->with('error','Your balance is not enough to withdraw');
            }

        $withdraw=Withdraw::create([
            'user_id'=>auth()->user()->id,
            'walletid'=>$userBlanceData->id,
            'method'=>$request->input('method'),
            'charge'=>5,
            'amount'=>$request->input('amount'),
            'fees'=>2,
            'remaining_balance'=>$userBlanceData->balance_amount-$request->input('amount'),
            'request_ip'=>$request->ip(),
            'comments'=>$request->input('comments'),
            'request_date'=>now(),
            'status'=>'pending'
        ]);
        $withdraw->save();
        return redirect()->route('withdraw.index')->with('success','Withdraw request created successfullly.');

    }

    public function edit($id){
        $withdraw=Withdraw::with('user')->findOrfail($id);
        return view('backend/payments/withdraws/update',compact('withdraw'));

    }

    public function withdrawAccept($id){

        if(!auth()->user()->hasPermissionTo('manage all withdraws')){
            return redirect()->route('withdraw.index')->with('error', 'You are not allowed to perform this action.');
        }
        $withdraw = Withdraw::with('user')->findOrFail($id);
        if($withdraw->status!='accepted'){
            
             // Update the user's balance
             $user = $withdraw->user;
            $deduct= $withdraw->amount + $withdraw->fees;
             if ($user->balance) {
                 $user->balance()->update([
                     'balance_amount' => $user->balance->balance_amount - $deduct,
                 ]);
             }
              else {
                return redirect()->route('withdraw.index')->with('error', 'User balance not found.');
             }
                $withdraw->update([
                    'status'=>'accepted'
                ]);

                // creating new transaction 
                    
                $transaction=Transection::create([
                    'user_id'=>$user->id,
                    'transection_category'=>'withdraw',
                    'amount'=>$withdraw->amount,
                    'transection_date_timestamp'=>now(),
                    'status'=>'completed',
                    'releted_id'=>$withdraw->withdraw_id,
                    'releted_type'=>'App\Models\Withdraw',
                ]);
                $transaction->save();
     
             return redirect()->route('withdraw.index')->with('success', 'Withdraw accepted, and new transaction has been created successfully.');
        }else{
            return redirect()->route('withdraw.index')->with('error', 'This Withdraw has already been accepted.');
        }
    }

}
