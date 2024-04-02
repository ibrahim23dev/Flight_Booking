<?php

namespace App\Http\Controllers\membershipsAndplans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans=MembershipPlan::all();
        return view('backend/membershipAndplans/plans',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend/membershipAndplans/create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_name' => 'required|string|max:255',
            'monthly_price' => 'required|numeric',
            'validity' => 'required|integer',
            'description' => 'required|string',
            'short_title' => 'required|string|max:50',
            'currency_code' => 'required|string|max:3',
        ]);
        $validatedData['points']=defaultPlansJsonData();
        MembershipPlan::create($validatedData);

        return redirect()->route('plans.index')
            ->with('success', 'Membership plan created successfully. You can edit key point of plan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $plan=MembershipPlan::findOrfail($id);
        return view('backend/membershipAndplans/update',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'plan_name' => 'required|string|max:255',
            'monthly_price' => 'required|numeric',
            'validity' => 'required|integer',
            'description' => 'required|string',
            'short_title' => 'required|string|max:50',
        ]);

        $membershipPlan = MembershipPlan::findOrFail($id);
        $membershipPlan->update($validatedData);

        return redirect()->back()->with('success', 'Membership plan updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updatePlans(Request $request, $id)
    {
       // Validate the input
        $validator = Validator::make($request->all(), [
           'amenities' => 'required|array',
           'amenities.*' => 'required|array',
           'amenities.*.heading' => 'required|string', // 'heading' is now just a string
           'amenities.*.points' => 'required|array|min:1', // Use 'points' array instead of 'heading' array
           'amenities.*.points.*.point' => 'required|string',
       ]);
       
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => 'validation error']);
        }

        // Check user's permissions
        $plan = MembershipPlan::findOrFail($id);
        if (!$plan) {
            return response()->json(['error' => 'Plan not found.'], 404);
        }
        if (!(auth()->user()->hasPermissionTo('manage plans'))) {
            return response()->json(['error' => 'You are not authorized to update this property.'], 403);
        }
    
        // Update the amenities data
        $amenitiesData = $request->input('amenities');
        $plan->points = $amenitiesData;
        $plan->save();
    
        return response()->json(['success' => 'Amenities updated successfully.']);
    }
}
