<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurrencyExchangeRate;

class CurrencyExhangeController extends Controller
{
    public function index(){
        $currencies=CurrencyExchangeRate::all();
        return view('backend.contents.currency.index',compact('currencies'));
    }

    public function create(){
        return view('backend.contents.currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency_from' => 'required|string|size:3',
            'currency_to' => 'required|string|size:3',
            'exchange_rate' => 'required|numeric|min:0',
             'BDT_value' => 'required|numeric|min:0',
        ]);

        CurrencyExchangeRate::create([

            'currency_from'=>strtoupper($request->input('currency_from')),
            'currency_to'=>strtoupper($request->input('currency_to')),
            'exchange_rate'=>$request->input('exchange_rate'),
            'BDT_value'=>$request->input('BDT_value'),
        ]);

        return redirect()->route('currency-rates.index')->with('success','Currency exchange rate added successfully');
    }

    public function edit($id){
        $currency=CurrencyExchangeRate::findOrfail($id);
        return view('backend.contents.currency.update',compact('currency'));

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'currency_from' => 'required|string|size:3',
            'currency_to' => 'required|string|size:3',
            'exchange_rate' => 'required|numeric|min:0',
             'BDT_value' => 'required|numeric|min:0',
        ]);
        $currency=CurrencyExchangeRate::findOrfail($id);

        $currency->currency_from=strtoupper($request->input('currency_from'));
        $currency->currency_to=strtoupper($request->input('currency_to'));
        $currency->exchange_rate=$request->input('exchange_rate');
        $currency->BDT_value=$request->input('BDT_value');
        $currency->save();

        return redirect()->route('currency-rates.index')->with('success','Currency exchange rate updated successfully');
    }

    public function destroy($id){
        $currency=CurrencyExchangeRate::findOrfail($id);
        $currency->delete();
        return redirect()->route('currency-rates.index')->with('success','Currency exchange rate deleted successfully');
    }   
}
