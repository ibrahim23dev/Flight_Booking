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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id('earning_id');
            $table->string('user_id', 250);
            $table->string('Purchaser_id', 250)->nullable();
            $table->string('earning_type', 45);
            $table->string('package_id', 250)->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->string('date', 45);
            $table->string('amount', 45);
            $table->mediumText('comments')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};
