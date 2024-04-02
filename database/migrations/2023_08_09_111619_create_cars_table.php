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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->unsignedBigInteger('package_id');
            $table->string('car_type');
            $table->string('rental_agency')->nullable();
            $table->decimal('rental_price', 10, 2);
            $table->string('num_of_days');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
