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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->renameColumn('jumlah_transaksi', 'total_harga');
            $table->dateTime('waktu_awal_pemesanan')->after('tanggal_transaksi');
            $table->dateTime('waktu_akhir_pemesanan')->after('waktu_awal_pemesanan');
            $table->unsignedBigInteger('stasiun_id');
            $table->foreign('stasiun_id')
                ->references('id')
                ->on('stasiun')
                ->onDelete('cascade');
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
