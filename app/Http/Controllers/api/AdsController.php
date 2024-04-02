<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GoogleAd;
use App\Models\Advertisement;
class AdsController extends Controller
{
    public function googleAds(Request $request)
    {
        try {
            // Retrieve Google Ads data with status 'active'.
            $googleAds = GoogleAd::where('status', 'active')->get();

            return response()->json(['data'=>$googleAds],200);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in GoogleAdsController: ' . $e->getMessage());

            // Return a generic error response.
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function customAds(Request $request){
        try {
            // Retrieve Google Ads data with status 'active'.
            $ads = Advertisement::where('status', 'active')
            ->select('name', 'position', 'link', 'image', 'description')
            ->get();

            $baseUrl = url('/');

            // Modify the 'image' field to include the complete URL with the domain and storage folder.
            $ads->transform(function ($ad) use ($baseUrl) {
                $ad['image'] = $baseUrl . Storage::url($ad['image']) ;
                return $ad;
            });

            return response()->json(['data'=>$ads],200);
        } catch (\Exception $e) {
            // Log the error for debugging.
            \Log::error('Error in GoogleAdsController: ' . $e->getMessage());

            // Return a generic error response.
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }
}
