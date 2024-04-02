<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_type', 'booking_id', 'user_id', 'booking_date',
        'checkin_date', 'checkout_date', 'departure_date', 'arrival_date',
        'pickup_location', 'dropoff_location', 'number_of_guests',
        'seat_class', 'price', 'status','ref_code','bookingable_type','bookingable_id','currency'
    ];

    // Define the User relationship (a booking belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a polymorphic relationship to specific booking types
    public function bookingable()
    {
        return $this->morphTo('bookingable', 'booking_type', 'booking_id');
    }
}
