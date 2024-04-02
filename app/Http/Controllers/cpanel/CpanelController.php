<?php

namespace App\Http\Controllers\cpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WhmApiService;
use Illuminate\Validation\Rules;


class CpanelController extends Controller
{
    public function index(){
        return view('backend/cpanel/index');

    }
    public function create(){
        return view('backend/cpanel/create');
    }
    public function store(Request $request){

        $validated=$request->validate([
            'user_name'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'mobile'=>'nullable|string|max:30',
            'password' => ['required', Rules\Password::defaults()],
            'domain'=>'required|string|max:191'
        ]);
       $validated['domain'] = str_replace(' ', '', trim($validated['domain']));
       $validated['user_name'] = str_replace(' ', '', trim($validated['user_name']));
        $result=$this->createCPanelAccount($validated);
    //    echo "<pre>"; print_r($result);

       if(!$result['success']){
            return redirect()->back()->with('error','Error happend: '. $result['message']);
       }
        $rawData=$result['response']['result'][0]['rawout'];
        $message=$result['message'];
       return view('backend/cpanel/success',compact('rawData','message'));


    }

    // Bobbienell9
    public function createCPanelAccount(array $data)
    {
        $whmService = new WhmApiService('https://162.240.54.144:2087','GXO1ZRAHOJ6GCSR1T3MLBUK7SMXHY5P6');
        $cutomData=[
            'plan'=>'default',
            'quota'=>3072, // in mbs
            'maxsubdomains'=>0, // number of maximum subdomains can add this account
            'maxaddondomain'=>1 // number of maximum domains can add this account by default it should be 1
        ];
        $result = $whmService->createCPanelAccount($data['user_name'],$data['email'], $data['domain'], $data['password'],$cutomData);
        // Handle the API response here
        return $result;
    }

    public function test(){

        $user = "root";
        $token = "GXO1ZRAHOJ6GCSR1T3MLBUK7SMXHY5P6";
    
        $query = "https://162.240.54.144:2087/json-api/listaccts?api.version=1";
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    
        $header[0] = "Authorization: whm $user:$token";
        curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
        curl_setopt($curl, CURLOPT_URL, $query);
    
        $result = curl_exec($curl);
    
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status != 200) {
            echo "[!] Error: " . $http_status . " returned\n";
        } else {
            $json = json_decode($result);
            echo "[+] Current cPanel users on the system:\n";
            foreach ($json->{'data'}->{'acct'} as $userdetails) {
                echo "\t" . $userdetails->{'user'} . "\n";
            }

            
        }
    
        curl_close($curl);
    
        }
}
