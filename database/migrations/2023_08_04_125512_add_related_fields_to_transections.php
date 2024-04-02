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
        Schema::table('transections', function (Blueprint $table) {
            $table->unsignedBigInteger('releted_id');
            $table->string('releted_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transections', function (Blueprint $table) {
            $table->dropColumn(['releted_id', 'releted_type']);
        });
    }
};
