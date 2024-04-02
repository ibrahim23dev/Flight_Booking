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
        Schema::create('payeer_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('m_operation_id');
            $table->unsignedInteger('m_operation_ps');
            $table->string('m_operation_date', 100);
            $table->string('m_operation_pay_date', 100);
            $table->unsignedInteger('m_shop');
            $table->string('m_orderid', 300);
            $table->string('m_amount', 100);
            $table->string('m_curr', 100);
            $table->string('m_desc', 300);
            $table->string('m_status', 100);
            $table->text('m_sign');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payeer_payments');
    }
};
