<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomFee;

class CustomeFeesController extends Controller
{
    public function index(){
        $custome=CustomFee::all();
        return view('backend/customeFees/custome_fees',compact('custome'));
    }

    public function create(){
        return view('backend/customeFees/create');

    }
    public function store(Request $request){
        $request->validate([
            'iata_code' => ['required', 'string'],
            'icao_code' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'price'=>['required','numeric'],
            'price_type' => ['required', 'in:extra,total'],
          
        ]);
        $create = new CustomFee([
            'iata_code' => $request->input('iata_code'),
            'icao_code' => $request->input('icao_code'),
            'status' => $request->input('status'),
            'price'=>$request->input('price'),
            'price_type'=>$request->input('price_type'),
        ]);
        $create->save();
        return redirect()->route('custom-fees.index')->with('success', 'custome fees created successfully.');

    }
    public function edit($id){
        $custom=CustomFee::findOrfail($id);
        return view('backend/customeFees/update',compact('custom'));

    }

    public function update(Request $request, $id){
        $update=CustomFee::findOrfail($id);
        $request->validate([
            'iata_code' => ['required', 'string'],
            'icao_code' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'price'=>['required','numeric'],
            'price_type' => ['required', 'in:extra,total'],
        ]);
        $update->iata_code=$request->input('iata_code');
        $update->icao_code=$request->input('icao_code');
        $update->status=$request->input('status');
        $update->price=$request->input('price');
        $update->price_type=$request->input('price_type');


        $update->save();
        return redirect()->route('custom-fees.index')->with('success', 'custom fees updated successfully.');

    }

}
