<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
class PlansAndMembersController extends Controller
{


    public function plans($planId = null)
    {
        try {
            $query = MembershipPlan::select('id', 'plan_name', 'monthly_price', 'currency_code', 'validity', 'short_title', 'description', 'points');
    
            if (is_null($planId)) {
                $data = $query->get();
            } else {
                $data = $query->find($planId);
                if (!$data) {
                    return response()->json(['message' => 'Plan not found'], 404);
                }
            }
    
            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in PlansAndMembersController: ' . $e->getMessage());
    
            // Return a generic error response.
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
    
    

 
    public function subscribe(Request $request, $planId)
    {
        // Validate the request data.
        $validator = Validator::make($request->all(), [
            'plan_id' => ['required', 'exists:membership_plans,id'],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
    
        try {
            // Get the authenticated user.
            $user = auth()->user();
    
            // Check if the user is already subscribed to the plan.
            $existingSubscription = Subscription::where('user_id', $user->id)
                ->where('plan_id', $planId)
                ->first();
    
            if ($existingSubscription) {
                if ($existingSubscription->status == 'inactive') {
                    // User is already subscribed, but the status is inactive.
                    return response()->json(['message' => 'You are already subscribed to this plan, but the current status is inactive.'], 400);
                }
    
                // User is already subscribed.
                return response()->json(['message' => 'You are already subscribed to this plan.'], 400);
            }
    
            // Check if the selected plan is inactive.
            // $plan = MembershipPlan::where('status', 'inactive')->find($planId);
    
            // if ($plan) {
            //     return response()->json(['message' => 'The selected plan is inactive.'], 400);
            // }
    
            // If the user is not already subscribed and the plan is active, create a new subscription.
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $planId,
                'status' => 'active'
            ]);
    
            return response()->json(['message' => 'Subscription created successfully.'], 200);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in PlansAndMembersController: ' . $e->getMessage());
    
            // Return a generic error response.
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
    

    
    
}
