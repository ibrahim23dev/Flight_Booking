<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
class SupportController extends Controller
{
    use HasRoles, HasPermissions;

    public function index()
    {
        $user = Auth::user();

        // Check if the user has the permission to view all support tickets
        $viewAllTicketsPermission = Permission::where('name', 'View all support tickets')->first();

        if ( $user->hasPermissionTo($viewAllTicketsPermission)) {
           // User has the permission to view all support tickets
           $openTickets = SupportTicket::with('user')->where('status', 'open')->orderBy('id','desc')->get();
           $closedTickets = SupportTicket::with('user')->where('status', 'closed')->orderBy('id','desc')->get();
        } else {
            // User does not have the permission, so fetch only the tickets of the authenticated user
            $openTickets = SupportTicket::where('user_id', $user->id)->where('status', 'open')->with('user')->orderBy('id','desc')->get();
            $closedTickets = SupportTicket::where('user_id', $user->id)->where('status', 'closed')->with('user')->orderBy('id','desc')->get();
        }
        return view('backend/support/support_tickets/support-tickets', [ 'openTickets' => $openTickets,
        'closedTickets' => $closedTickets,'user'=>$user]);
    }
    public function create(){
        return view('backend/support/support_tickets/create');
    }

    public function store(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Generate a unique ticket number
        $ticketNumber = 'T' . Str::random(8); // You can modify the format as needed

        // Create the support ticket
        $supportTicket = SupportTicket::create([
            'user_id' => auth()->user()->id, // Assuming the authenticated user is creating the ticket
            'ticket_number' => $ticketNumber,
            'subject' => $validatedData['subject'],
            'status' => 'open', // Set the initial status as 'open'
            // Add other ticket-related fields as needed
        ]);
       
        // Create the first ticket reply (optional)
        $supportTicket->replies()->create([
            'user_id' => auth()->user()->id, // Assuming the authenticated user is creating the ticket
            'reply_text' => $validatedData['message'],
        ]);

        // Redirect to the ticket details page or display a success message
        return redirect()->route('tickets.index')
            ->with('success', 'Support ticket created successfully!');
    }
    public function edit($id) // load the view of messages
    {
        $supportTicket = SupportTicket::with('user', 'replies')->findOrFail($id);
        $user = Auth::user();

        $user->update(['last_reply_seen_at' => now()]);
    
        if (!$user->hasPermissionTo('View all support tickets') && (int)$supportTicket->user_id !== (int)$user->id) {
                return redirect()->route('tickets.index')->with('error', 'You are not authorized to view this');
            }
    
            return view('backend/support/support_tickets/update', compact('supportTicket', 'user'));
     
    }

    public function update($id)
    {
        $supportTicket = SupportTicket::with('user', 'replies')->findOrFail($id);
        $user = Auth::user();
    
        $user->update(['last_reply_seen_at' => now()]);

        if ($supportTicket->status !== 'open') {
            return response()->json(['errors' => ['The ticket is not open and cannot be replied.']], 400);
        }
        if (request()->ajax()) {
            $validator = Validator::make(request()->all(), [
                'message' => 'required|string|max:500',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
    
            $reply = new TicketReply([
                'support_ticket_id' => $supportTicket->id,
                'user_id' => $user->id,
                'reply_text' => request('message'),
            ]);
            $reply->save();
    
            $supportTicket->update(['last_reply_at' => now()]);
    
            return response()->json(['success' => true], 200);
        } else {
                if (!$user->hasPermissionTo('View all support tickets') && (int)$supportTicket->user_id !== (int)$user->id) {
                return redirect()->route('tickets.index')->with('error', 'You are not authorized to view this');
            }
    
            return view('backend/support/support_tickets/update', compact('supportTicket', 'user'));
        }
    }

    public function changeStatus(Request $request, $id)
 {
    $supportTicket = SupportTicket::findOrFail($id);
    $user = Auth::user();


    // Check if the user has the "View All Support Tickets" permission
    if (!$user->hasPermissionTo('View all support tickets')) {
        // Make sure the ticket belongs to the user
        if ($supportTicket->user_id !== $user->id) {
            return redirect()->route('tickets.index')->with('error', 'You are not authorized to view this');
        }
    }

        // Change the status based on the request parameter (e.g., 'status')
        $newStatus = 'closed';
        $supportTicket->status = $newStatus;
        $supportTicket->closed_date =now();
        $supportTicket->save();

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
 }


    public function fetchMessages($id)
    {
        $supportTicket = SupportTicket::with('replies.user')->findOrFail($id);
        $user = Auth::user();
        // Load the messages view and pass the supportTicket
        $messagesView = View::make('backend/support/support_tickets/messages', compact('supportTicket','user'))->render();
        return response()->json(['messagesView' => $messagesView], 200);
    }

}
