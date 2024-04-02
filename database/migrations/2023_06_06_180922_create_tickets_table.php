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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('details')->nullable();
            $table->text('live_details')->nullable();
            $table->string('pnr_no')->nullable();
            $table->string('status')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('bags')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('format')->nullable();
            $table->string('ticket_num')->nullable();
            $table->string('company')->nullable();
            $table->string('destinations')->nullable();
            $table->string('departure_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('p_name')->nullable();
            $table->string('p_surname')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('issued_from')->nullable();
            $table->string('ticket_status')->nullable();
            $table->decimal('collector_profit', 8, 2)->nullable();
            $table->decimal('collector_sale_price', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('received', 8, 2)->nullable();
            $table->decimal('admin_price', 8, 2)->nullable();
            $table->decimal('admin_profit', 8, 2)->nullable();
            $table->string('payment_iata')->nullable();
            $table->text('remarks')->nullable();
            $table->date('reminder')->nullable();
            $table->string('last_ticketing_date')->nullable();
            $table->string('tripType')->nullable();
            $table->string('api_status')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
