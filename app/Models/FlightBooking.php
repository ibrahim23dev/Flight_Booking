<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function passengers()
    {
        return $this->hasMany(Passenger::class,'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     // Define the reverse of the polymorphic relationship in the Booking model
     public function booking()
     {
         return $this->morphOne(Booking::class, 'bookingable');
     }
}
