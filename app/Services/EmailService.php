<?php 

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmail($to, $subject, $view, $data, $config)
    {
        // Store the original mail configuration
        $originalConfig = Config::get('mail');
        // Set the custom SMTP credentials
        Config::set('mail.mailers.smtp.host', $config['smtp_host']);
        Config::set('mail.mailers.smtp.port', $config['smtp_port']);
        Config::set('mail.mailers.smtp.username', $config['smtp_username']);
        Config::set('mail.mailers.smtp.password', $config['smtp_password']);
        Config::set('mail.mailers.smtp.encryption', 'ssl');
        
        // Send the email with the updated configuration
        Mail::send($view, $data, function ($message) use ($to, $subject, $config) {
            $message->to($to)->subject($subject)
                ->from($config['smtp_username'], $config['from_name'])
                ->replyTo($config['smtp_username'], $config['from_name']);
        });

        // Reset the configuration to its original state after sending the email
        Config::set('mail', $originalConfig);
    }
}
