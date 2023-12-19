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
        Schema::create('saldo_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('saldo_id');
            $table->foreign('saldo_id')->references('id')->on('saldos')->onDelete('cascade');
            $table->double('nominal');
            $table->longText('keterangan');
            $table->enum('status', ['in', 'out']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_histories');
    }
};
