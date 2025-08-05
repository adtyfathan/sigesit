<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use Carbon\Carbon;

class Checkout extends Component
{
    public $transaksi;
    public $snapToken;
    public $isProcessing = false;
    public $paymentStatus = null;
    public $jamDifference;
    
    public function mount($transaksiId){
        if (!Auth::check() || Auth::user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $this->transaksi = Transaksi::with(
            'produk.kategori',
            'stasiun'
        )
        ->find($transaksiId);
        
        if (!$this->transaksi) {
            abort(404, 'Transaksi tidak ditemukan.');
        }

        $start = Carbon::parse($this->transaksi->waktu_awal_pemesanan);
        $end = Carbon::parse($this->transaksi->waktu_akhir_pemesanan);

        $this->jamDifference = $start->diffInHours($end);
    }

    public function createPayment()
    {
        $this->isProcessing = true;
        $this->paymentStatus = null;
        
        try {
            // Generate unique order ID
            $orderId = 'ORDER-' . $this->transaksi->id . '-' . time();

            // Set Midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Prepare transaction parameters
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $this->transaksi->total_harga,
                ],
                'item_details' => [
                    [
                        'id' => $this->transaksi->produk->id,
                        'price' => (int) $this->transaksi->produk->harga_per_jam,
                        'quantity' => $this->jamDifference,
                        'name' => $this->transaksi->produk->nama_produk,
                        'category' => $this->transaksi->produk->kategori->nama_kategori
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
            $this->transaksi->update(['order_id' => $orderId]);
            
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

        if ($cachedStatus) {
            $this->paymentStatus = $cachedStatus['status'];
            
            // Update local transaction record
            if ($this->transaksi) {
                $this->transaksi->refresh();
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

            return $this->redirect(route('transaksi.show', $this->transaksi->id), navigate: true);
        
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.checkout');
    }   
}