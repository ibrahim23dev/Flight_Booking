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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('deposited_from')->nullable();
            $table->string('date_of_deposit',30);
            $table->enum('mode', ['cash', 'check', 'dd', 'etransfer']);
            $table->string('deposited_bank',100);
            $table->string('branch',100);
            $table->string('city')->nullable();
            $table->string('transaction_no',50);
            $table->enum('status', ['pending', 'accepted','rejected'])->default('pending');
            $table->text('remarks')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            
            $table->foreign('deposited_from')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
