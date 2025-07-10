<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('skm_results', function (Blueprint $table) {
            $table->id();
            $table->integer('ikm_score'); 
            $table->text('comment')->nullable(); 
            $table->string('service_aspect')->nullable(); 
            $table->timestamp('survey_date')->useCurrent(); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skm_results');
    }
}; 