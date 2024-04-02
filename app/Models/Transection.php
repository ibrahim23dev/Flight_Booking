<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;
    protected $primaryKey = 'transection_id';
    protected $guarded = [];
        // Define the relationship to the User model
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

            // Define the relationship to UserBalance (Transection belongs to UserBalance)
        public function userBalance()
        {
            return $this->belongsTo(UserBalance::class, 'walletid', 'id');
        }

        public function releted()
        {
            return $this->morphTo('releted');
        }

}
