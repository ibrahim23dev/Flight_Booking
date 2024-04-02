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
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->decimal('monthly_price', 10, 2);
            $table->string('currency_code',3);
            $table->integer('validity'); // Number of months
            $table->string('description',191);
            $table->string('short_title',80);
            $table->json('points'); // JSON column for points
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_plans');
    }
};
