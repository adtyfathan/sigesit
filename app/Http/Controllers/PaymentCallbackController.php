<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class PaymentCallbackController extends Controller
{
    public function success($orderId)
    {
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        return view('payment.success', compact('transaction'));
    }

    public function error($orderId)
    {
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        return view('payment.error', compact('transaction'));
    }

    public function pending($orderId)
    {
        $transaction = Transaksi::where('order_id', $orderId)->first();
        
        return view('payment.pending', compact('transaction'));
    }
}