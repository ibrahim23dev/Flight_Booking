<?php

namespace App\Http\Controllers\adds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoogleAd;

class GoogleAdController extends Controller
{
    public function index(){
        $ads=GoogleAd::all();
        return view('backend/adds/googleAds/advertisements',compact('ads'));

    }
    public function create(){
        return view('backend/adds/googleAds/create');

    }    public function store(Request $request)
    {
        $request->validate([
            'ad_code' => ['required', 'string'],
            'position' => ['required', 'in:top,bottom,left,right'],
            'status' => ['required', 'in:active,inactive'],
            
        ]);

        $advertisement = new GoogleAd([
            'ad_code' => $request->input('ad_code'),
            'position' => $request->input('position'),
            'status' => $request->input('status'),
            
        ]);
    
        $advertisement->save();
    
        return redirect()->route('google-ads.index')->with('success', 'advertisement created successfully.');
    }
    public function edit($id){
        $ad=GoogleAd::findOrfail($id);
        return view('backend/adds/googleAds/update',compact('ad'));

    }
    public function update(Request $request,$id){
        $ad=GoogleAd::findOrfail($id);
        $request->validate([
            'ad_code' => ['required', 'string'],
            'position' => ['required', 'in:top,bottom,left,right'],
            'status' => ['required', 'in:active,inactive'],
        ]);
        $ad->ad_code=$request->input('ad_code');
        $ad->position=$request->input('position');
        $ad->status=$request->input('status');

        $ad->save();

        return redirect()->route('google-ads.index')->with('success', 'advertisement updated successfully.');

    }
    public function destroy($id){
        $ad=GoogleAd::findOrfail($id);
        $ad->delete();
        return redirect()->route('google-ads.index')->with('success', 'advertisement deleted successfully.');

    }
}
