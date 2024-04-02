<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;
use App\Models\PromoCodeUsage;
use Illuminate\Support\Str;
class PromoCodesController extends Controller
{
    public function index(){
        $promoCodes = PromoCode::withCount('usages')->get();
        return view('backend/promo_codes/index',compact('promoCodes'));
        
    }
    public function create(){
        return view('backend/promo_codes/create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive', 
            'discount_type' => 'required|in:percentage,value', 
        ]);
        $code = Str::random(5); // Generate a 5-character random code
        while (PromoCode::where('code', $code)->exists()) {
            $code = Str::random(5); // Regenerate until a unique code is found
        }
        $promoCode = new PromoCode();
        $promoCode->code = $code;
        $promoCode->discount = $request->input('discount');
        $promoCode->expiry_date = $request->input('expiry_date');
        $promoCode->usage_limit = $request->input('usage_limit');
        $promoCode->status = $request->input('status'); 
        $promoCode->discount_type = $request->input('discount_type'); 
        $promoCode->save();

        return redirect()->route('promo-codes.index')->with('success', 'Promo code created successfully');
    }

    public function edit($id){
        $promo=PromoCode::findOrfail($id);
        return view('backend/promo_codes/update',compact('promo'));

    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive', 
            'discount_type' => 'required|in:percentage,value', 
        ]);
       
        $promoCode = PromoCode::findOrfail($id);
      
        $promoCode->discount = $request->input('discount');
        $promoCode->expiry_date = $request->input('expiry_date');
        $promoCode->usage_limit = $request->input('usage_limit');
        $promoCode->status = $request->input('status'); 
        $promoCode->discount_type = $request->input('discount_type'); 
        $promoCode->save();

        return redirect()->route('promo-codes.index')->with('success', 'Promo code updated successfully');
    }


    public function promoUsages($id = null)
    {
        // Retrieve all promo code usages with their related user and promo code information
        $query = PromoCodeUsage::with(['user', 'promoCode']);
    
        if ($id) {
            // If $id is provided, retrieve only the specified promo code usage
            $promoCodeUsages = $query->where('promo_code_id', $id)->get();
    
            // Count the total usages for the specified promo code
            $totalUsedCount = $promoCodeUsages->count();
        } else {
            // If no $id is provided, retrieve all promo code usages
            $promoCodeUsages = $query->get();
    
            // Since there is no specific promo code, we won't calculate totalUsedCount here
            $totalUsedCount = null;
        }
    
        // Pass the promoCodeUsages data and totalUsedCount to the view
        return view('backend/promo_codes/usages', compact('promoCodeUsages', 'totalUsedCount'));
    }
    

}
