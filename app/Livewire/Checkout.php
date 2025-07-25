<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use App\Models\Produk;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;

class Checkout extends Component
{
    public $produk;
    public $snapToken;
    public $isProcessing = false;
    public $currentTransaction;
    public $paymentStatus = null;
    
    public function mount($produkId){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }
        $this->produk = Produk::with('kategori')->find($produkId);
        
        if (!$this->produk) {
            abort(404, 'Produk tidak ditemukan.');
        }
    }

    public function createPayment()
    {
        $this->isProcessing = true;
        $this->paymentStatus = null;
        
        try {
            // Create transaction record
            $transaction = Transaksi::create([
                'jumlah_transaksi' => $this->produk->harga_produk,
                'tanggal_transaksi' => now(),
                'status' => 'pending',
                'user_id' => Auth::id(),
                'produk_id' => $this->produk->id
            ]);

            $this->currentTransaction = $transaction;

            // Generate unique order ID
            $orderId = 'ORDER-' . $transaction->id . '-' . time();

            // Set Midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Prepare transaction parameters
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $this->produk->harga_produk,
                ],
                'item_details' => [
                    [
                        'id' => $this->produk->id,
                        'price' => (int) $this->produk->harga_produk,
                        'quantity' => 1,
                        'name' => $this->produk->nama_produk,
                        'category' => $this->produk->kategori->nama_kategori
                    ]
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'callbacks' => [
                    // 
                    'finish' => route('checkout.success', ['orderId' => $orderId]),
                    'error' => route('checkout.error', ['orderId' => $orderId]),
                    'pending' => route('checkout.pending', ['orderId' => $orderId])
                    // 
                ]
            ];

            // Get snap token
            $snapToken = Snap::getSnapToken($params);
            
            // Update transaction with order_id
            $transaction->update(['order_id' => $orderId]);
            
            $this->snapToken = $snapToken;
            $this->isProcessing = false;
            
            // Dispatch browser event to show payment modal
            $this->dispatch('show-payment-modal', ['snapToken' => $snapToken, 'orderId' => $orderId]);
            
        } catch (\Exception $e) {
            $this->isProcessing = false;
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function checkPaymentStatus($orderId){
         // Check if status has been updated via webhook
        $cachedStatus = cache()->get(key: "transaction_status_{$orderId}");
        // dd($orderId);
        // dd($cachedStatus);

        if ($cachedStatus) {
            $this->paymentStatus = $cachedStatus['status'];
            
            // Update local transaction record
            if ($this->currentTransaction) {
                $this->currentTransaction->refresh();
            }
            
            // Clear cache after reading
            cache()->forget("transaction_status_{$orderId}");
            
            // Show appropriate message based on status
            switch ($cachedStatus['status']) {
                case 'success':
                    session()->flash('success', 'Pembayaran berhasil dikonfirmasi!');
                    $this->dispatch('payment-confirmed', ['status' => 'success']);
                    break;
                case 'pending':
                    session()->flash('info', 'Pembayaran sedang diproses. Mohon tunggu konfirmasi.');
                    break;
                case 'failed':
                    session()->flash('error', 'Pembayaran gagal. Silakan coba lagi.');
                    $this->dispatch('payment-confirmed', ['status' => 'failed']);
                    break;
            }
            
            return true;
         }
        
         return false;
    }

    public function handlePaymentSuccess($result)
    {
        // Find transaction by order_id
        $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        if ($transaction) {
            // Don't update status immediately, let webhook handle it
            // Just show temporary success message
            session()->flash('info', 'Pembayaran sedang diproses. Mohon tunggu konfirmasi.');
            
            // Start polling for status update
            $this->dispatch('start-status-polling', ['orderId' => $result['order_id']]);
        }
    }

    public function handlePaymentPending($result)
    {
         $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        
        if ($transaction) {
            session()->flash('info', 'Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
            $this->dispatch('start-status-polling', ['orderId' => $result['order_id']]);
        }
    }

    public function handlePaymentError($result)
    {
        $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        
        if ($transaction) {
            session()->flash('error', 'Pembayaran gagal. Silakan coba lagi.');

        }
    }

    public function redirectToReview(){
        if ($this->currentTransaction) {
            return $this->redirect(route('transaksi.show', $this->currentTransaction->id), navigate: true);
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.checkout');
    }   
}