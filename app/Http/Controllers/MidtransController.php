<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function handle(Request $request)
    {
        try {
            Log::info('Midtrans Webhook Received', $request->all());

            $serverKey = config('midtrans.server_key');
            $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashedKey !== $request->signature_key) {
                Log::warning('Signature key mismatch', [
                    'expected' => $hashedKey,
                    'provided' => $request->signature_key,
                ]);
                return response()->json(['message' => 'Invalid signature key'], 403);
            }

            $transactionStatus = $request->transaction_status;
            $orderId = $request->order_id;

            Log::info('Looking for transaction', ['order_id' => $orderId]);

            $transaction = Transaksi::with('produk')->where('order_id', $orderId)->first();

            $produk = $transaction->produk;

            if (!$transaction) {
                Log::error('Transaction not found', ['order_id' => $orderId]);
                return response()->json(['message' => 'Order not found'], 404);
            }

            $status = $transaction->status;

            Log::info('Current transaction status', [
                'before' => $status,
                'transaction_status' => $transactionStatus,
            ]);

            switch ($transactionStatus) {
                case 'capture':
                    $status = $request->fraud_status === 'challenge' ? 'pending' : 'success';
                    break;
                case 'settlement':
                    $status = 'success';
                    break;
                case 'pending':
                    $status = 'pending';
                    break;
                case 'deny':
                    $status = 'failed';
                    break;
                case 'expire':
                    $status = 'expired';
                    break;
                case 'cancel':
                    $status = 'canceled';
                    break;
                default:
                    $status = 'unknown';
            }

            Log::info('Updating transaction status', ['new_status' => $status]);

            $transaction->update([
                'status'=> $status,
                'payment_type' => $request->payment_type,
                'transaction_id' => $request->transaction_id,
            ]);

            $jumlahTerjual = $produk->jumlah_terjual;

            if($status === 'capture' || $status === 'settlement') {
                $produk->update([
                    'jumlah_terjual' => $jumlahTerjual + 1,
                ]);
            }

            $this->broadcastStatusUpdate($transaction);

            Log::info('Transaction updated and broadcasted');

            return response()->json(['message' => 'Callback received successfully'], 200);        
        } catch (\Throwable $e) {
            Log::error('Midtrans Webhook Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);
            return response()->json(['message' => 'Server error'], 500);
        }
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