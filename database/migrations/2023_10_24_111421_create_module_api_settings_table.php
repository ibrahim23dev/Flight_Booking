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
        Schema::create('module_api_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules');
            $table->string('api_type');
            $table->string('api_name');
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('api_endpoint')->nullable();
            $table->string('api_test_key')->nullable();
            $table->string('api_test_secret_key')->nullable();
            $table->string('api_test_endpoint')->nullable();
            $table->enum('api_mode', ['test', 'live'])->default('test');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('image')->nullable();


            // Add other API configuration fields as needed.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_api_settings');
    }
};
