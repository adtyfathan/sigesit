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
        
        try {
            // Create transaction record
            $transaction = Transaksi::create([
                'jumlah_transaksi' => $this->produk->harga_produk,
                'tanggal_transaksi' => now(),
                'status' => 'pending',
                'user_id' => Auth::id(),
                'produk_id' => $this->produk->id
            ]);

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
                ]
            ];

            // Get snap token
            $snapToken = Snap::getSnapToken($params);
            
            // Update transaction with order_id
            $transaction->update(['order_id' => $orderId]);
            
            $this->snapToken = $snapToken;
            $this->isProcessing = false;
            
            // Dispatch browser event to show payment modal
            $this->dispatch('show-payment-modal', ['snapToken' => $snapToken]);
            
        } catch (\Exception $e) {
            $this->isProcessing = false;
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function handlePaymentSuccess($result)
    {
        // Find transaction by order_id
        $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        
        if ($transaction) {
            $transaction->update([
                'status' => 'sukses',
                'payment_type' => $result['payment_type'] ?? null,
                'transaction_id' => $result['transaction_id'] ?? null,
            ]);
            
            session()->flash('success', 'Pembayaran berhasil!');
            return redirect()->route('dashboard'); // Adjust route as needed
        }
    }

    public function handlePaymentPending($result)
    {
        $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        
        if ($transaction) {
            $transaction->update([
                'status' => 'pending',
                'payment_type' => $result['payment_type'] ?? null,
                'transaction_id' => $result['transaction_id'] ?? null,
            ]);
            
            session()->flash('info', 'Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
        }
    }

    public function handlePaymentError($result)
    {
        $transaction = Transaksi::where('order_id', $result['order_id'])->first();
        
        if ($transaction) {
            $transaction->update([
                'status' => 'gagal',
                'payment_type' => $result['payment_type'] ?? null,
                'transaction_id' => $result['transaction_id'] ?? null,
            ]);
            
            session()->flash('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.checkout');
    }
}