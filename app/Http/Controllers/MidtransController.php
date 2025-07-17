<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');    
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }
         
        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $transaction = Transaksi::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    if ($request->fraud_status == 'challenge') {
                        $transaction->update(['status' => 'pending']);
                    } else {
                        $transaction->update(['status' => 'success']);
                    }
                }
                break;
            case 'settlement':
                $transaction->update(['status' => 'success']);
                break;
            case 'pending':
                $transaction->update(['status' => 'pending']);
                break;
            case 'deny':
                $transaction->update(['status' => 'failed']);
                break;
            case 'expire':
                $transaction->update(['status' => 'expired']);
                break;
            case 'cancel':
                $transaction->update(['status' => 'canceled']);
                break;
            default:
                $transaction->update(['status' => 'unknown']);
                break;
        }

        $transaction->update([
            'payment_type' => $request->payment_type,
            'transaction_id' => $request->transaction_id,
            'updated_at' => now(),
        ]);

        $this->broadcastStatusUpdate($transaction);

        return response()->json(['message' => 'Callback received successfully'], 200);        
    }

    private function broadcastStatusUpdate($transaction)
    {
        cache()->put("transaction_status_{$transaction->order_id}", [
            'status' => $transaction->status,
            'payment_type' => $transaction->payment_type,
            'transaction_id' => $transaction->transaction_id,
            'updated_at' => $transaction->updated_at,
        ], now()->addMinutes(30));
    }
} 