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
        Schema::create('transections', function (Blueprint $table) {
            $table->id('transection_id');
            $table->string('user_id', 255)->nullable();
            $table->string('transection_category', 255)->nullable();
            $table->string('releted_id', 255)->nullable();
            $table->float('amount')->nullable();
            $table->timestamp('transection_date_timestamp')->nullable();
            $table->tinyText('comments')->nullable();
            $table->unsignedInteger('status')->default(1);
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transections');
    }
};
