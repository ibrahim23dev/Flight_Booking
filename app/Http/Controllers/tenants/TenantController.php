<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants=Tenant::with('domains')->get();

        return view('backend/tenants/index',compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend/tenants/create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'mobile'=>'nullable|string|max:30',
            'password' => ['required', Rules\Password::defaults()],
            'domain_name'=>'required|string|max:191|unique:domains,domain'
        ]);
        // Trim spaces and replace with hyphens in 'domain_name'
       $validated['domain_name'] = str_replace(' ', '-', trim($validated['domain_name']));
       $tenant=Tenant::create($validated);
       $tenant->domains()->create([
        'domain'=>$validated['domain_name'].'.'.config('app.domain')
       ]);

       return redirect()->route('tenants.index')->with('success','Tenant Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
