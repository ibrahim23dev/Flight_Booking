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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('cordinates')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->enum('status', ['active', 'inactive']);
            $table->unsignedBigInteger('user_id'); // Owner of the property
            $table->json('images')->nullable();
            $table->json('amenities')->nullable();
            $table->json('surroundings')->nullable();
            $table->enum('payment_allowed', ['cash', 'cards', 'both']);
            $table->decimal('cancellation_charges', 10, 2);
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
