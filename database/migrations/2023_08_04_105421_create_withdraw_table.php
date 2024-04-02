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
        Schema::create('withdraw', function (Blueprint $table) {
            $table->id('withdraw_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('walletid');
            $table->string('method', 100);
            $table->float('charge')->default(0);
            $table->float('amount')->default(0);
            $table->float('fees');
            $table->timestamp('request_date')->useCurrent();
            $table->timestamp('success_date')->nullable();
            $table->timestamp('cancel_date')->nullable();
            $table->string('request_ip', 45)->nullable();
            $table->text('comments')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('walletid')->references('id')->on('user_balances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw');
    }
};
