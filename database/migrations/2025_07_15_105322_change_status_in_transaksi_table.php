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
            $table->enum('status', ['failure', 'expire', 'cancel', 'deny', 'settlement', 'capture', 'pending', 'success', 'verfikasi operator', 'verifikasi bendahara', 'selesai'])->change();
            $table->string('order_id')->nullable()->after('status');
            $table->string('transaction_id')->nullable()->after('order_id');
            $table->string('payment_type')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            //
        });
    }
};