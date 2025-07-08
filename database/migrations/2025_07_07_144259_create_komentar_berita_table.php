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
        Schema::create('komentar_berita', function (Blueprint $table) {
            $table->id();
            $table->text('isi_komentar');
            $table->dateTime('tanggal_komentar');
            $table->unsignedBigInteger('berita_id');
            $table->foreign('berita_id')
                ->references('id')
                ->on('berita')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_berita');
    }
};