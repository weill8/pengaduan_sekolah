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
        Schema::create('tb_input_aspirasi', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->unsignedBigInteger('nis');
            $table->foreign('nis')
                ->references('nis')
                ->on('tb_siswa')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('tb_kategori')
                ->cascadeOnDelete();
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_input_aspirasi');
    }
};
