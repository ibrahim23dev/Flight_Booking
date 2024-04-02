<?php
use illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\Booking;
use App\Models\CommissionSetting;
use App\Models\Page;
use Illuminate\Support\Facades\Session;
if (!function_exists('set_active_route')) {

    function set_active_route($route_name, $active_class = 'active', $inactive_class = '', $additional_class = '') {
        $classes = '';
        $current_route = Route::currentRouteName();
        $current_route_prefix = trim(Route::getCurrentRoute()->getPrefix(), '/');
        // return $current_route;
        // Trim leading and trailing slashes from the route name
        $route_name = trim($route_name, '/');
    
        // Check if the current route matches the provided route_name or the prefix
        if ($current_route == $route_name || Str::startsWith($current_route, $route_name . '.') || $current_route_prefix == $route_name) {
            $classes .= $active_class . ' ' . $additional_class;
        } else {
            $classes .= $inactive_class;
        }
    
        return $classes;
    }
    
   
      
}

if (!function_exists('calculateTotalPrice')) {
    function calculateTotalPrice($fare, $fuelSurcharge) {
        return $fare + $fuelSurcharge;
    }
      
}
 
if (!function_exists('getTicketsCountByStatus')) {
    function getTicketsCountByStatus($status)
    {
        $user = Auth::user();
        $viewAllTicketsPermission = Permission::where('name', 'View all support tickets')->first();

        if ($user->hasPermissionTo($viewAllTicketsPermission)) {
            return SupportTicket::where('status', $status)->count();
        } else {
            return SupportTicket::where('user_id', $user->id)->where('status', $status)->count();
        }
    }
}

    if (!function_exists('getAuthUserBalance')) {
        function getAuthUserBalance()
        {
            $user = auth()->user();
            return $user->balance ? $user->balance->currency_code .' : '. $user->balance->balance_amount : 0;
        }
    }

    if (!function_exists('getDepositCountByStatus')) {
        function getDepositCountByStatus($status)
        {
            $user = Auth::user();
            $viewAllDepositsPermission = Permission::where('name', 'manage all deposits')->first();
    
            if ($user->hasPermissionTo($viewAllDepositsPermission)) {
                return Deposit::where('status', $status)->count();
            } else {
                return Deposit::where('deposited_from', $user->id)->where('status', $status)->count();
            }
        }
    
  }
    if (!function_exists('getAuthUserWithdraw')) {
        function getAuthUserWithdraw($status)
        {
            $user = Auth::user();
            $viewAllWithdrawPermission = Permission::where('name', 'manage all withdraws')->first();

            if ($user->hasPermissionTo($viewAllWithdrawPermission)) {
                return Withdraw::where('status', $status)->count();
            } else {
                return Withdraw::where('user_id', $user->id)->where('status', $status)->count();
            }
        }

    }
    if (!function_exists('defaultAmenityJsonData')) {
        function defaultAmenityJsonData()
        {
           $json='[ { "points": [ { "point": "test", "available": false } ], "heading": "Bathroom" }, { "points": [ { "point": "test", "available": true } ], "heading": "Media & Technology" }, { "points": [ { "point": "test", "available": false } ], "heading": "General" }, { "points": [ { "point": "test", "available": true } ], "heading": "Room Amenities" }, { "points": [ { "point": "test", "available": true } ], "heading": "Parking" } ]';
           return $json;
        }

    }
    if (!function_exists('defaultSurroundingsJsonData')) {
        function defaultSurroundingsJsonData()
        {
           $json='[ { "points": [ { "distance": "700 m", "location": "Property Name" } ], "heading": "What is Nearby" }, { "points": [ { "distance": "700 m", "location": "Property Name" } ], "heading": "Top Attractions" }, { "points": [ { "distance": "700 m", "location": "Property Name" } ], "heading": "Public transport" }, { "points": [ { "distance": "700 m", "location": "Property Name" } ], "heading": "Restaurants & cafes" }, { "points": [ { "distance": "700 m", "location": "Property Name" } ], "heading": "Closest airports" } ]';
           return $json;
        }

    }
    if (!function_exists('defaultRoomJsonData')) {
        function defaultRoomJsonData()
        {
           $json='[ { "points": [ { "point": "Seating Area", "available": true },  { "point": "Wardrobe or closet", "available": true } ], "heading": "Room Amenities" } ]';
           return $json;
        }

    }

    if (!function_exists('defaultPlansJsonData')) {
        function defaultPlansJsonData()
        {
           $json='[ { "points": [ { "point": "point 1" },  { "point": "point 1" } ], "heading": "Plans Key Points" } ]';
           return $json;
        }

    }


    if (!function_exists('getOtherUsers')) {
        function getOtherUsers()
        {
            return User::where('id', '!=', auth()->id())
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'can chats');
            })
            ->get();
        }
    }

    if (!function_exists('countBookingStatus')) {
        /**
         * Get the count of tickets based on the booking status, taking user permission into account.
         *
         * @param string|null $status
         * @return int
         */
        function countBookingStatus($status = null)
        {
            if (auth()->user()->hasPermissionTo('manage all bookings')) {
                // User has permission to manage all bookings
                $query = Booking::query();
            } else {
                // User does not have permission to manage all bookings
                // Fetch only the tickets linked to the authenticated user
                $query = Booking::where('user_id', auth()->user()->id);
            }
            
            if ($status) {
                $query->where('status', $status);
            }
            
            return $query->count();
        }
    }
    if (!function_exists('getSiteIdentity')) {
        function getSiteIdentity()
        {
           return App\Models\identity::first();
        }

    }
   
    if (!function_exists('formatDuration')) {
        function formatDuration($duration)
        {
            // Replace 'P', 'T', 'H', and 'M' with empty strings
            $result = str_replace(['P', 'T', 'H', 'M'], ['', ' ', ' h ', ' min '], $duration);
        
            // If 'D' is present, replace it with ' day'
            if (strpos($result, 'D') !== false) {
                $result = str_replace('D', ' day', $result);
            }
        
            // If ' h ' is not present, replace ' min ' with ' minutes'
            if (strpos($result, 'h') === false) {
                $result = str_replace('min', 'minutes', $result);
            }
        
            return trim($result);
        }
        
    }
    
    if (!function_exists('formatTime')) {
        function formatTime($dateTime, $format = 'h:i a')
        {
            return \Carbon\Carbon::parse($dateTime)->format($format);
        }
    }

    if (!function_exists('getCurrencySymbol')) {
        /**
         * Get currency symbol based on currency code.
         *
         * @param string $currencyCode
         * @return string|null
         */
        function getCurrencySymbol($currencyCode)
        {
            $symbols = [
                'USD' => '$',
                'EUR' => '€',
                'GBP' => '£',
                
            ];
    
            return $symbols[strtoupper($currencyCode)] ?? null;
        }
    }

    // Helpers.php
if (!function_exists('calculateDuffelLayover')) {
    // Helpers.php

function calculateDuffelLayover($slices, $currentSliceIndex, $currentSegmentIndex) {
    $layoverData = [];

    if ($currentSliceIndex > 0 || $currentSegmentIndex > 0) {
        $currentSegment = $slices[$currentSliceIndex]['segments'][$currentSegmentIndex];

        if ($currentSegmentIndex > 0) {
            $previousSegment = $slices[$currentSliceIndex]['segments'][$currentSegmentIndex - 1];

            $layover = strtotime($currentSegment['departing_at']) - strtotime($previousSegment['arriving_at']);
            $layoverDays = floor($layover / (24 * 3600));
            $layoverHours = floor(($layover % (24 * 3600)) / 3600);
            $layoverMinutes = floor(($layover % 3600) / 60);

            $layoverData = [
                'days' => $layoverDays,
                'hours' => $layoverHours,
                'minutes' => $layoverMinutes,
                'city' => $previousSegment['destination']['city_name'],
                'from' => formatTime($previousSegment['arriving_at'], 'M-d-Y H:i'),
                'to' => formatTime($currentSegment['departing_at'], 'M-d-Y H:i'),
            ];
        }
    }

    return $layoverData;
}

}



function calculateFlightAmounts($totalAmount)
{
    $commissionSettings = CommissionSetting::where('status', 'active')
        ->where('type', 'flights')
        ->whereIn('fare_type', ['markup', 'discount'])
        ->first();

    $adminProfit = null;
    $actualAmount = $totalAmount; // Initialize it with the total amount
    $commissionType = null;
    $displayDiscount = false;
    $settingsAvailable = false;
    $adminPrice = $totalAmount; // Admin price is initially set to total amount
    $discountPercentage = null; // Initialize discount percentage to null
    if ($commissionSettings) {
        $settingsAvailable = true;

        if ($commissionSettings->fare_type == 'markup') {
            $commissionType = 'markup';
            $markupAmount = $commissionSettings->price;
            $actualAmount = $totalAmount + $markupAmount; // Adjust actualAmount for markup
            $adminProfit = $markupAmount;
            $adminPrice = $actualAmount; // Update adminPrice after applying markup
        } elseif ($commissionSettings->fare_type == 'discount') {
            $commissionType = 'discount';
            $discountAmount = $commissionSettings->price;
            $actualAmount = $totalAmount - $discountAmount; // Adjust actualAmount for discount
            $displayDiscount = true;
            $adminPrice = $actualAmount; // Update adminPrice after applying discount
            $adminProfit = $adminPrice - $totalAmount;
            // Calculate discount percentage
            $discountPercentage = ($discountAmount / $totalAmount) * 100;
            $discountPercentage = round($discountPercentage, 1); // Round to two decimal places
        }
    }

    return [
        'totalAmount' => $totalAmount,
        'adminProfit' => $adminProfit,
        'actualAmount' => $actualAmount,
        'commissionType' => $commissionType,
        'displayDiscount' => $displayDiscount,
        'settingsAvailable' => $settingsAvailable,
        'adminPrice' => $adminPrice,
        'discountPercentage' => $discountPercentage,
    ];
}


if (!function_exists('getSectionContent')) {
    function getSectionContent($type)
    {
        return \App\Models\SectionsContent::where('section_type',$type)->first();
    }
}
 
// app/helpers.php

if (!function_exists('getCurrencySymbol')) {
    /**
     * Get currency symbol based on currency code.
     *
     * @param string $currencyCode
     * @return string|null
     */
    function getCurrencySymbol($currencyCode)
    {
        $symbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            
        ];

        return $symbols[strtoupper($currencyCode)] ?? null;
    }
}

if (!function_exists('getContactDetails')) {
    function getContactDetails()
    {
        return \App\Models\ContactDetail::first();
    }
}

if (!function_exists('getSocialMediaIconClass')) {
    function getSocialMediaIconClass($platform)
    {
        $platforms = [
            'facebook' => 'fa-facebook-f',
            'youtube' => 'fa-youtube',
            'instagram' => 'fa-instagram',
            'linkedin' => 'fa-linkedin-in',
            // Add more platforms as needed
        ];

        return $platforms[$platform] ?? '';
    }
}
if (!function_exists('formatMinutes')) {
    function formatMinutes($minutes)
    {
        $days = floor($minutes / (60 * 24)); // Calculate days
        $hours = floor(($minutes % (60 * 24)) / 60); // Calculate hours
        $remainingMinutes = $minutes % 60; // Calculate remaining minutes
        $formattedDuration = "";
    
        if ($days > 0) {
            $formattedDuration .= $days . "d "; // Add days if present
        }
    
        if ($hours > 0) {
            $formattedDuration .= $hours . "h "; // Add hours if present
        }
    
        if ($remainingMinutes > 0) {
            $formattedDuration .= $remainingMinutes . "m"; // Add minutes if present
        }
    
        return trim($formattedDuration);
    }
    
}

function formatTimeDifference($startDateTime, $endDateTime)
{
    // Parse the datetime strings into Carbon instances
    $start = \Carbon\Carbon::parse($startDateTime);
    $end = \Carbon\Carbon::parse($endDateTime);

    // Calculate the difference in minutes
    $minutesDiff = $end->diffInMinutes($start);

    // Calculate days, hours, and remaining minutes
    $days = floor($minutesDiff / (24 * 60));
    $hours = floor(($minutesDiff % (24 * 60)) / 60);
    $remainingMinutes = $minutesDiff % 60;

    // Initialize the formatted duration string
    $formattedDuration = "";

    // Append days if present
    if ($days > 0) {
        $formattedDuration .= $days . "d ";
    }

    // Append hours if present
    if ($hours > 0 || $days > 0) {
        $formattedDuration .= $hours . "h ";
    }

    // Append remaining minutes if present
    if ($remainingMinutes > 0 || $hours > 0 || $days > 0) {
        $formattedDuration .= $remainingMinutes . "m";
    }

    // Return the formatted duration string
    return trim($formattedDuration);
}

if (! function_exists('extractIataCode')) {
    /**
     * Extracts the IATA code from a string containing airport information.
     *
     * @param string $airportInfo The string containing airport information.
     * @return string|null The extracted IATA code, or null if not found.
     */
    function extractIataCode($airportInfo)
    {
        // Regular expression to match the IATA code within parentheses
        $pattern = '/\(([A-Z]{3})\)/';
        
        // Perform the regular expression match
        if (preg_match($pattern, $airportInfo, $matches)) {
            // Return the matched IATA code
            return $matches[1];
        }
        
        // If no match found, return null
        return null;
    }
}

if (!function_exists('getActivePages')) {
    /**
     * Get active pages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function getActivePages()
    {
        return Page::where('status', 'active')->get();
    }
}

// app/Helpers/currency_helpers.php

if (!function_exists('bdt_to_usd')) {
    function bdt_to_usd($amount)
    {
        $exchangeRate = get_exchange_rate('BDT', 'USD');

        if ($exchangeRate === null) {
            return null; // Handle error, exchange rate not found
        }

      
        return $amount / $exchangeRate;
    }
}

if (!function_exists('usd_to_bdt')) {
    function usd_to_bdt($amount)
    {
        $exchangeRate = get_exchange_rate('USD', 'BDT');

        if ($exchangeRate === null) {
            return null; // Handle error, exchange rate not found
        }

        return $amount / $exchangeRate;
    }
}

if (!function_exists('get_exchange_rate')) {
    function get_exchange_rate($fromCurrency, $toCurrency)
    {
        $exchangeRate = \App\Models\CurrencyExchangeRate::where('currency_from', $fromCurrency)
            ->where('currency_to', $toCurrency)
            ->value('exchange_rate');

        return $exchangeRate;
    }
}


