<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $primaryKey = 'transfer_id';
        // Define the relationship to the User model for sender
        public function sender()
        {
            return $this->belongsTo(User::class, 'sender_user_id', 'id');
        }
    
        // Define the relationship to the User model for receiver
        public function receiver()
        {
            return $this->belongsTo(User::class, 'receiver_user_id', 'id');
        }
}
