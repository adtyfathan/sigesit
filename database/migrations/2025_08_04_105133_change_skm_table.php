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
        Schema::table('skm', function (Blueprint $table) {
            $table->dropColumn('total_skor');
            $table->float('skor_layanan')->default(value: 1)->change();
            $table->integer('skor_pengiriman')->default(1)->after('skor_aksesibilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
