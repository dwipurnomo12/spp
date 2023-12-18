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
        Schema::create('tagihan_biaya', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tagihan_id');
            $table->unsignedBigInteger('biaya_id');
            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade');
            $table->foreign('biaya_id')->references('id')->on('biayas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_biaya');
    }
};