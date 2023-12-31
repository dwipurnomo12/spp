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
        Schema::create('siswa_tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tagihan_id');
            $table->foreign('user_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade');
            $table->enum('status', ['belum_dibayar', 'lunas'])->default('belum_dibayar');
            $table->decimal('total_tagihan', 10, 2)->default(0.00);
            $table->enum('metode_pembayaran', ['cash', 'tabungan', 'mandiri']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_tagihan');
    }
};
