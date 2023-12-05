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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nis')->unique();
            $table->string('username');
            $table->string('nm_siswa');
            $table->enum('j_kelamin', ['laki-laki', 'perempuan']);
            $table->longText('alamat');
            $table->string('no_hp');
            $table->foreignId('kelas_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
