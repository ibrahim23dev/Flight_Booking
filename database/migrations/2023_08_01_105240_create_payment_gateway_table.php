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
        Schema::create('payment_gateway', function (Blueprint $table) {
            $table->id();
            $table->string('identity', 50);
            $table->string('agent', 100);
            $table->string('public_key', 100);
            $table->string('private_key', 100);
            $table->string('shop_id', 100);
            $table->string('secret_key', 100);
            $table->unsignedInteger('status');
            $table->string('icon', 80);

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateway');
    }
};
