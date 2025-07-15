<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <!-- Product Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Detail Produk</h2>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                    class="w-20 h-20 object-cover rounded">
                <div class="flex-1">
                    <h3 class="text-lg font-medium text-gray-900">{{ $produk->nama_produk }}</h3>
                    <p class="text-gray-600">{{ $produk->kategori->nama_kategori ?? 'General' }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $produk->deskripsi_produk }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Pajak</span>
                    <span>Rp 0</span>
                </div>
                <div class="border-t pt-2">
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Button -->
        <div class="text-center">
            <button wire:click="createPayment" wire:loading.attr="disabled"
                class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105"
                {{ $isProcessing ? 'disabled' : '' }}>
                <span wire:loading.remove>
                    <i class="fas fa-credit-card mr-2"></i>
                    Bayar Sekarang
                </span>
                <span wire:loading>
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Memproses...
                </span>
            </button>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('info'))
            <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">
                {{ session('info') }}
            </div>
        @endif
    </div>
</div>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener('livewire:initialized', function () {
        // Listen for payment modal event
        Livewire.on('show-payment-modal', function (data) {
            const snapToken = data[0].snapToken;
            console.log('Snap Token:', snapToken);

            snap.pay(snapToken, {
                // Optional: Payment success callback
                onSuccess: function (result) {
                    console.log('Payment success:', result);
                    // Call Livewire method to handle success
                    @this.call('handlePaymentSuccess', result);
                },

                // Optional: Payment pending callback
                onPending: function (result) {
                    console.log('Payment pending:', result);
                    // Call Livewire method to handle pending
                    @this.call('handlePaymentPending', result);
                },

                // Optional: Payment error callback
                onError: function (result) {
                    console.log('Payment error:', result);
                    // Call Livewire method to handle error
                    @this.call('handlePaymentError', result);
                },

                // Optional: Payment close callback
                onClose: function () {
                    console.log('Payment popup closed');
                    // Reset processing state
                    @this.set('isProcessing', false);
                }
            });
        });
    });
</script>

@push('styles')
    <style>
        .container {
            min-height: 100vh;
        }

        /* Custom styles for payment button */
        .payment-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.75);
        }

        .payment-button:hover {
            box-shadow: 0 6px 20px 0 rgba(116, 79, 168, 0.90);
        }

        /* Loading animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fa-spin {
            animation: spin 2s linear infinite;
        }
    </style>
@endpush