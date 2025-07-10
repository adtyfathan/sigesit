<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration // <--- Pastikan baris ini
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skm_results', function (Blueprint $table) {
            $table->id();
            $table->integer('ikm_score'); // Skor IKM untuk survei ini (misal 1-100)
            $table->text('comment')->nullable(); // Komentar dari responden
            $table->string('service_aspect')->nullable(); // Aspek layanan yang dinilai
            $table->timestamp('survey_date')->useCurrent(); // Tanggal survei dilakukan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skm_results');
    }
}; // <--- Jangan lupakan titik koma di sini