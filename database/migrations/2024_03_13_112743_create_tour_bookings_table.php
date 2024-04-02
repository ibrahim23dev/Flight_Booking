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
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->enum('booking_status', ['confirmed', 'pending', 'canceled'])->default('pending');
            $table->enum('payment_status', ['completed', 'pending'])->default('pending');
            $table->string('ref_code')->nullable();
            $table->string('total_amount',30);
            $table->string('payment_method')->nullable();
            $table->string('trx_id')->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('package_id')->references('package_id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_bookings');
    }
};
