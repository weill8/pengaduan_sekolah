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
        Schema::create('tb_aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');

            $table->unsignedBigInteger('id_pelaporan');
            $table->foreign('id_pelaporan')
                ->references('id_pelaporan')
                ->on('tb_input_aspirasi')
                ->cascadeOnDelete();

            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->string('feedback', 1000)->nullable();

            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('tb_admin')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_aspirasi');
    }
};
