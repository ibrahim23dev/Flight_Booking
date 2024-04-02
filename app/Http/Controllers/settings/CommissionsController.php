<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function index(){
        $commissions=CommissionSetting::with('updater')->get();
       return view('backend/commissions/commissions',compact('commissions'));
    }

    public function create(){
       return view('backend/commissions/create');

    }
    public function store(Request $request){
        $request->validate([
            'fare_type' => ['required', 'in:markup,discount'],
            'type' => ['required', 'in:flights,cars,hotels'],
            'status' => ['required', 'in:active,inactive'],
            'price'=>['required','numeric'],
          
        ]);
        $create = new CommissionSetting([
            'fare_type' => $request->input('fare_type'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'price'=>$request->input('price'),
            'updated_by'=>auth()->user()->id
        ]);
        $create->save();
        return redirect()->route('commissions.index')->with('success', 'commission created successfully.');

    }

    public function edit($id){
        $update=CommissionSetting::findOrfail($id);
       return view('backend/commissions/update',compact('update'));

    }
    public function update(Request $request, $id){
        $update=CommissionSetting::findOrfail($id);
        $request->validate([
            'fare_type' => ['required', 'in:markup,discount'],
            'type' => ['required', 'in:flights,cars,hotels'],
            'status' => ['required', 'in:active,inactive'],
            'price'=>['required','numeric'],
        ]);
        $update->fare_type=$request->input('fare_type');
        $update->type=$request->input('type');
        $update->status=$request->input('status');
        $update->price=$request->input('price');
        $update->updated_by=auth()->user()->id;


        $update->save();
        return redirect()->route('commissions.index')->with('success', 'commission updated successfully.');

    }
    
}
