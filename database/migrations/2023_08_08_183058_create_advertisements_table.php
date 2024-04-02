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

        Schema::create('advertisements', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('created_by');
            $table->string('name');
            $table->enum('position', ['left', 'top', 'right', 'bottom'])->default('top');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('link');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
