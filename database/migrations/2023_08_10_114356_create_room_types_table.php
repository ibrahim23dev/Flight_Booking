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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('type');
            $table->decimal('price', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->json('images')->nullable();
            $table->string('bed_type',30)->nullable();
            $table->string('room_size',30)->nullable();
            $table->string('breakfast',30)->nullable();
            $table->integer('num_of_rooms')->nullable();
            $table->integer('remaining_rooms')->nullable();
            $table->json('amenities')->nullable();
            // Add other columns you may need
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
