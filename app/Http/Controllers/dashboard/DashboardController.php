<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\FlightBooking;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Str;
use App\Models\Ticket;


class DashboardController extends Controller
{
    use HasRoles, HasPermissions;

    public function index(){

        $usersCount=User::count();
       // Check if the authenticated user has the 'manage all bookings' permission
        if (auth()->user()->hasPermissionTo('manage all bookings')) {
            // User has permission to manage all bookings
            $query = Booking::with('user')
                ->orderBy('created_at', 'desc') // Order by the created_at date in descending order
                ->limit(5); // Limit the results to the latest 5 bookings
        } else {
            // User does not have permission to manage all bookings
            // Fetch only the tickets linked to the authenticated user
            $query = Booking::with('user')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc') // Order by the created_at date in descending order
                ->limit(5); // Limit the results to the latest 5 bookings
        }

        $tickets = $query->get();
        
        return view('backend/dashboard',compact('usersCount','tickets'));
    }
}
