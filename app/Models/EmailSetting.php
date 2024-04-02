<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;
    protected $table = 'email_settings';
    protected $fillable = ['smtp_host', 'smtp_port', 'smtp_user_name', 'smtp_password', 'email_type_settings'];

   
    public function getEmailConfig($type)
    {
        $emailSettings = EmailSetting::first();
    
        if ($emailSettings) {
            $settings = json_decode($emailSettings->email_type_settings, true);
    
            // Find the email setting with the matching type
            $config = collect($settings)->first(function ($setting) use ($type) {
                return $setting['type'] === $type;
            });
    
            if ($config) {
                // Get the SMTP configuration values from separate columns
                $smtpConfig = [
                    'smtp_username' => $emailSettings->smtp_username,
                    'smtp_password' => $emailSettings->smtp_password,
                    'smtp_host' => $emailSettings->smtp_host,
                    'smtp_port' => $emailSettings->smtp_port,
                ];
    
                // Merge the SMTP configuration with the email configuration
                $config = array_merge($config, $smtpConfig);
    
                return $config;
            }
        }
    
        return null; // Return null if no matching email setting is found.
    }
    
    
    
}
