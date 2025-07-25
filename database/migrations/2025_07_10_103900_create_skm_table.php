<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('skm', function (Blueprint $table) {
            $table->id();
            $table->float('total_skor')->min(1)->max(10);
            $table->enum('skor_layanan', ['kurang', 'cukup', 'puas', 'sangat puas']);
            $table->integer('skor_fasilitas')->min(1)->max(10)->default(1);
            $table->integer('skor_petugas')->min(1)->max(10)->default(1);
            $table->integer('skor_aksesibilitas')->min(1)->max(10)->default(1);
            $table->text('komentar')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksi')
                ->onDelete('cascade');
            $table->dateTime('tanggal_survey');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skm');
    }
}; 