<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;
    protected $primaryKey = 'earning_id';

        // Define the relationship to the User model
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
}
