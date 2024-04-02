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
        Schema::create('transfer', function (Blueprint $table) {
            $table->id('transfer_id');
            $table->string('sender_user_id', 255)->nullable();
            $table->string('receiver_user_id', 255)->nullable();
            $table->float('amount')->nullable();
            $table->float('fees')->default(0);
            $table->string('request_ip', 45)->nullable();
            $table->date('date')->nullable();
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('status');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer');
    }
};
