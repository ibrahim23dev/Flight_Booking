<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Validator;

class EmailSettingsController extends Controller
{
    public function index(){
        $email=EmailSetting::first();
        return view('backend/emailSettings/create',compact('email'));
    }
    public function update(Request $request,$id)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:email_settings,id', 
                'smtp_host' => 'required|string',
                'smtp_username' => 'required|string',
                'smtp_password' => 'required|string',
                'smtp_port' => 'required|integer',
                'email_setting' => 'required|array',
                'email_setting.*.from_name' => 'required|string',
                'email_setting.*.from_email' => 'required|email',
                'email_setting.*.type' => 'required|string|in:general,booking,info',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 400);
            }

            // Data to store in your table
            $data = $request->all();

            $email=EmailSetting::find($id);
            $email->smtp_host=$data['smtp_host'];
            $email->smtp_port=$data['smtp_port'];
            $email->smtp_username=$data['smtp_username'];
            $email->smtp_password=$data['smtp_password'];
            $email->email_type_settings=json_encode($request->input('email_setting'));
            
            $email->save();

            return response()->json([
                'success' => true,
                'message' => 'Data successfully stored.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Error message: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
