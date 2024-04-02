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
use App\Models\Conversation;
use App\Models\User;
use App\Models\Message;
use App\Models\ChMessage;

class ChatController extends Controller
{
  
    public function chat()
    {

        return view('backend.chat.chat');
    }
    // public function index()
    // {
    //     $user = auth()->user();
    //     $conversations = $user->conversations;

    //     $conversationsHtml = view('backend.chat.conversations', compact('conversations'))->render();
        
    //     return response()->json(['conversationsHtml' => $conversationsHtml]);
    // }
        public function index()
    {
        $user = auth()->user();
        $conversations = $user->conversations()->with(['messages' => function ($query) {
            $query->latest();
        }])->get();

        // Sort the conversations based on the latest chat
        $conversations = $conversations->sortByDesc(function ($conversation) {
            return optional($conversation->messages->first())->created_at;
        });

        $conversationsHtml = view('backend.chat.conversations', compact('conversations'))->render();
            
        return response()->json(['conversationsHtml' => $conversationsHtml]);
    }   


    public function show($userId)
    {
        $user = auth()->user();
        $otherUser = User::findOrFail($userId);
    
        $conversation = Conversation::where(function ($query) use ($user, $otherUser) {
            $query->where('user1_id', $user->id)->where('user2_id', $otherUser->id);
        })->orWhere(function ($query) use ($user, $otherUser) {
            $query->where('user1_id', $otherUser->id)->where('user2_id', $user->id);
        })->first();
    
        if (!$conversation) {
            // Create a new conversation if none exists
            $conversation = new Conversation();
            $conversation->user1()->associate($user);
            $conversation->user2()->associate($otherUser);
            $conversation->save();
        }
    
        $messages = $conversation->messages;
        $messagesHtml = view('backend.chat.messages', compact('user', 'conversation', 'messages'))->render();
    
        return response()->json(['messagesHtml' => $messagesHtml,'conversation'=>$conversation]);
    }
    


        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'content' => 'required|string',
            ]);
    
            $message = new Message([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $this->getReceiverId($validatedData['conversation_id']),
                'conversation_id' => $validatedData['conversation_id'],
                'content' => $validatedData['content'],
            ]);
            $message->save();
            // Update the conversation's last read timestamp for the receiver
            $conversation=Conversation::find($validatedData['conversation_id']);
            $conversation->updateLastRead(auth()->user()->id);
            return response()->json(['success' => true]);
        }
    
        public function fetch(Conversation $conversation)
        {
            $messages = $conversation->messages()->with('sender')->get();
            $userId=auth()->user()->id;
            Message::where('conversation_id', $conversation->id)
            ->where('receiver_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

            $messagesHtml = view('backend.chat.messages_loop', compact('messages', 'conversation'))->render();
            
            return response()->json(['messagesHtml' => $messagesHtml,'messages'=>$messages]);
        }
        
    
        // Helper method to determine the receiver ID based on the conversation
        private function getReceiverId($conversationId)
        {
            $conversation = Conversation::find($conversationId);
            return $conversation->user1_id === auth()->user()->id ? $conversation->user2_id : $conversation->user1_id;
        }

        // for header messages 
        public function fetchUnreadMessages()
        {
            $user = auth()->user();
        
            // Get the latest unread message for each conversation
            $unreadConversations = Conversation::with(['messages' => function ($query) use ($user) {
                $query->where('receiver_id', $user->id)
                    ->where('is_read', false)
                    ->latest()
                    ->with('sender');
            }, 'user1', 'user2'])
                ->whereHas('messages', function ($query) use ($user) {
                    $query->where('receiver_id', $user->id)
                        ->where('is_read', false);
                })
                ->get();
        
            return response()->json(['unreadConversations' => $unreadConversations]);
        }
        

        public function deleteConversation($id) {
            $user = auth()->user();
            $conversation = Conversation::find($id);
        
            if (!$conversation) {
                return redirect()->route('chat')->with('error', 'Conversation not found.');
            }
        
            // Check if the authenticated user is a participant in the conversation
            if ($user->id != $conversation->user1_id && $user->id != $conversation->user2_id) {

                return redirect()->route('chat')->with('error', 'You are not authorized to delete this conversation.');

            }
        
            // Delete the conversation and its messages
            $conversation->messages()->delete();
            $conversation->delete();
    
            return redirect()->route('chat')->with('success', 'Conversation deleted successfully.');


        }
        
  
}
