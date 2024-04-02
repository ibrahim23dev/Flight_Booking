<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('pidname')->nullable();
            $table->date('dob')->nullable();
            $table->string('pidno')->nullable();
            $table->string('pied')->nullable();
            $table->timestamps();
    
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
