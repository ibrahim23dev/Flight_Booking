<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ContactUs;

class GeneralController extends Controller
{
    public function contactQueries(){
        $queries=ContactUs::orderBy('created_at', 'desc')->get()->toArray();
        return view('backend/general/contact-queries',compact('queries'));
    }

    public function updateMessageStatus(Request $request)
    {
        $messageId = $request->input('messageId');
        $contactUs = ContactUs::find($messageId);

        if ($contactUs) {
            $contactUs->status = 'inactive';
            $contactUs->save();

            // Return the updated status and class in the response
            return response()->json([
                'status' => 'inactive', // Updated status text
                'statusClass' => 'bg-red-3 text-red-2' // Updated status class
            ]);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }

    public function deleteMessage(Request $request,$id){
            $message=ContactUs::findOrfail($id);
            $message->delete();
            return redirect()->back()->with('success','Deleted Successfully');
    }
}
