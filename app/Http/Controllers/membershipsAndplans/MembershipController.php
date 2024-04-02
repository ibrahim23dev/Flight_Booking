<?php

namespace App\Http\Controllers\membershipsAndplans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rule;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $planId = $request->input('plan_id'); // Get the plan_id parameter from the URL
    
        $query = Subscription::with(['user', 'membershipPlan']);
    
        if ($planId) {
            $query->where('plan_id', $planId);
        }
    
        $memberships = $query->get();
    
        return view('backend/membershipAndplans/memberships/memberships', compact('memberships', 'planId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        $plans=MembershipPlan::all();
        return view('backend/membershipAndplans/memberships/create',compact('users','plans'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'plan_id' => ['required', 'exists:membership_plans,id'],
            'status' => ['required', 'in:active,inactive'],
        ]);
        Subscription::create($validatedData);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership created successfully.');
    }

    /**
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
           'status' => 'required|string|max:50',
        ]);

        $membershipPlan = Subscription::findOrFail($id);
        $membershipPlan->update($validatedData);

        return redirect()->back()->with('success', 'Membership status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
