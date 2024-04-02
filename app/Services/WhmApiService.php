<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhmApiService
{
    private $ipUrl;
    private $token;
    private $user = "root";
    public function __construct($ipUrl, $token,$user='root')
    {
        $this->ipUrl = $ipUrl;
        $this->token = $token;
        $this->user = $user;
    }

      /**

     * @param string $ipUrl The Ip of WHM account with port Ex: https://127.0.0.1:2087.
     * @param string $username The username for cpanel you want to create.
     * @param string|null $email Optioninal email for the cpanel account. This can be used of contact email 
     * @param string $domain Domain name you want for you want to create cpanel account. Ex: example.com
     * @param string $password Password for cpanel account you want to create .This will be used to login to that cpanel account. Password must be strong.
     * @param string $plan Plan you want to set for new cpanel account you can plans in WHM .
     * @param string $token The Api token you obtained from WHM API Tokens.
     * @param array $data Extra data in array format you can add plan, custom ip option 'y','n',quota in mbs 
     * @return array This function returns  an array with json api response.
     */
    public function createCPanelAccount($username, $email = null, $domain, $password, array $data)
    {
        $url = $this->ipUrl . "/json-api/createacct";

        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'whm ' . $this->user . ':' . $this->token,
        ])->asForm()->post($url, [
            'username' => $username,
            'domain' => $domain,
            'password' => $password,
            'contactemail' => $email,
            'plan' => $data['plan'],
            'quota' => $data['quota'],
            'maxsub'=>$data['maxsubdomains'],
            'owner'=>$username,
            'maxaddon'=>$data['maxaddondomain']
        ]);
    
        $result = $response->json();
    
        return $this->processResponse($result);
    }
    
    private function processResponse($result)
    {
        $responseArray = ['success' => false, 'response' => $result, 'message' => 'Unknown error'];

        if (isset($result['result'][0]['status']) && $result['result'][0]['status'] == 1) {
            $responseArray['success'] = true;
            $responseArray['message'] = $result['result'][0]['statusmsg']; // success message
        }
         elseif (isset($result['cpanelresult']['error'])) {
            $responseArray['message'] = $result['cpanelresult']['error'];

        } elseif (isset($result['result'][0]['status']) && $result['result'][0]['status'] != 1) {
            $responseArray['message'] = $result['result'][0]['statusmsg'];
        }

        return $responseArray;
    }


    
}
