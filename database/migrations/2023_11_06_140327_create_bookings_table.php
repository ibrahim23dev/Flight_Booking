<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_type'); // Type of booking (flight, hotel, car, activity, tour)
            $table->unsignedBigInteger('booking_id'); // Reference to specific booking in its table
            $table->unsignedBigInteger('user_id'); // Reference to the user who made the booking
            $table->string('ref_code'); // Reference code
            $table->date('booking_date');
            $table->date('checkin_date')->nullable(); // Add additional nullable columns for specific booking details
            $table->date('checkout_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('pickup_location')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->unsignedInteger('number_of_guests')->nullable();
            $table->string('seat_class')->nullable();
            $table->string('price',40); 
            $table->string('currency',20); 
            $table->string('status'); // Booking status (e.g., pending, confirmed, cancelled, completed)
            $table->timestamps();

            // Indexes and foreign keys can be added here if needed

            // For the polymorphic relationship, you may use these columns
            $table->string('bookingable_type'); // Type of the bookingable model
            $table->unsignedBigInteger('bookingable_id'); // ID of the bookingable model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
