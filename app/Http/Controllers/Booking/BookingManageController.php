<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\airlines;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class BookingManageController extends Controller
{
    public function index(Request $request) {
        // Check if the authenticated user has the 'manage all bookings' permission
        if (auth()->user()->hasPermissionTo('manage all bookings')) {
            // User has permission to manage all bookings
            $query = Booking::with('user')->orderBy('created_at', 'desc');
        } else {
            // User does not have permission to manage all bookings
            // Fetch only the tickets linked to the authenticated user
            $query = Booking::with('user')->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc');
        }
    
        // Check if a 'booking_status' parameter is provided in the query string
        if ($request->has('booking_status')) {
            $status = $request->query('booking_status');
            $query->where('status', $status);
        }
    
        // You can add more conditions for other query parameters here if needed
    
        $tickets = $query->get();
    
        return view('backend/bookings/booking-list', compact('tickets'));
    }
    
    

    public function viewTicket($id){
        $ticket=Ticket::with('passengers')->find($id);

        return view('backend/bookings/ticket-view',compact('ticket'));

    }

    public function editTicket($id){
        $ticket=Ticket::with('passengers')->findorfail($id);
        return view('backend/bookings/ticket-edit',compact('ticket'));
    }

    public function updatePassengers(Request $request, $id)
    {
        $passengerData = $request->only(['title', 'name', 'surname']);
        $ticket=Ticket::find($id);
        foreach ($passengerData['title'] as $index => $title) {
            $passengerId = $request->input('passenger_ids')[$index];
            $ticket->passengers()->where('id', $passengerId)->update([
                'title' => $title,
                'name' => $passengerData['name'][$index],
                'surname' => $passengerData['surname'][$index],
            ]);
        }
    
        return redirect()->route('/booking-list')->with('success','Passengers data updated');

    }

    public function cancelbooking($id){
        $user=auth()->user();
        $ticket = Ticket::findOrFail($id);

        if (!($user->hasPermissionTo('manage all bookings') || $ticket->user_id === $user->id)) {
            return redirect()->back()->with('error', 'You are not authorized to  this .');
        }
       
        // Check if the ticket is already cancelled
        if ($ticket->ticket_status == 'cancelled') {
            return redirect()->route('/booking-list')->with('error', 'Ticket is already cancelled');
        }
    
        // Update the ticket status to 'cancelled'
        $ticket->ticket_status = 'cancelled';
        $ticket->save();
    
        return redirect()->route('/booking-list')->with('success', 'Booking cancelled');
    }
    
    public function bookingInquiry($id = null)
    {
        // Get the authenticated user ID
        $authUserId = Auth::id();
    
        if ($id) {
            // Fetch the inquiry by ID with the 'viewedBy' relationship
            $inquiries = Inquiry::with('viewedBy')->find($id);
    
            if ($inquiries) {
                // Set the status to 'inactive'
                $inquiries->status = 'inactive';
    
                // Set the 'view_by' column to the authenticated user's ID
                $inquiries->view_by = $authUserId;
    
                // Save the changes
                $inquiries->save();
            }
            $query=$inquiries;
            return view('backend/bookings/inquiries/inquiry-single', compact('query'));
        } else {
            // Fetch all inquiries with the 'viewedBy' relationship
            $inquiries = Inquiry::with('viewedBy')->orderBy('created_at')->get();
    
            return view('backend/bookings/inquiries/inquiry-list', compact('inquiries'));
        }
    }
    
    public function bookingInquiryUpdate(Request $request,$id){
        $request->validate([
            'comment' => 'sometimes|string|nullable',
        
        ]);
        $inquiry=Inquiry::findOrfail($id);
        $inquiry->comment=$request->input('comment');
        $inquiry->view_by=Auth::id();
        $inquiry->save();
        return redirect()->route('booking-inquiry')->with('success','Inquiry Updated Successfully');
    }
    
}
