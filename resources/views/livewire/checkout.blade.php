<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <!-- Payment Status Indicator -->
        @if($paymentStatus)
                <div class="mb-6 p-4 rounded-lg border-l-4 
                        {{ $paymentStatus === 'success' ? 'bg-green-50 border-green-400' :
        ($paymentStatus === 'pending' ? 'bg-yellow-50 border-yellow-400' : 'bg-red-50 border-red-400') }}">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if($paymentStatus === 'success')
                                <i class="fas fa-check-circle text-green-400"></i>
                            @elseif($paymentStatus === 'pending')
                                <i class="fas fa-clock text-yellow-400"></i>
                            @else
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            @endif
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium 
                                    {{ $paymentStatus === 'success' ? 'text-green-800' :
        ($paymentStatus === 'pending' ? 'text-yellow-800' : 'text-red-800') }}">
                                Status Pembayaran:
                                <span class="capitalize">{{ $paymentStatus }}</span>
                            </p>
                        </div>
                    </div>
                </div>
        @endif

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
                    <p class="text-2xl font-bold text-blue-600">Rp
                        {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
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

        <!-- Status Check Loading -->
        <div id="status-checking" class="hidden mt-4 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-lg">
                <i class="fas fa-sync-alt fa-spin text-blue-600 mr-2"></i>
                <span class="text-blue-600">Memeriksa status pembayaran...</span>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('info'))
            <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">
                <i class="fas fa-info-circle mr-2"></i>
                {{ session('info') }}
            </div>
        @endif
    </div>
</div>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    let statusCheckInterval;

    document.addEventListener('livewire:initialized', function () {
        // Listen for payment modal event
        Livewire.on('show-payment-modal', function (data) {
            const snapToken = data[0].snapToken;
            const orderId = data[0].orderId;
            // console.log('Snap Token:', snapToken);

            snap.pay(snapToken, {
                onSuccess: function (result) {
                    // console.log('Payment success:', result);
                    @this.call('handlePaymentSuccess', result);
                },

                onPending: function (result) {
                    // console.log('Payment pending:', result);
                    @this.call('handlePaymentPending', result);
                },

                onError: function (result) {
                    // console.log('Payment error:', result);
                    @this.call('handlePaymentError', result);
                },

                onClose: function () {
                    // console.log('Payment popup closed');
                    @this.set('isProcessing', false);
                }
            });
        });

        // Listen for status polling start event
        Livewire.on('start-status-polling', function (data) {
            const orderId = data[0].orderId;
            startStatusPolling(orderId);
        });

        // Listen for payment confirmation
        Livewire.on('payment-confirmed', function (data) {
            const status = data[0].status;
            stopStatusPolling();

            if (status === 'success') {
                // Optionally redirect to success page
                setTimeout(() => {
                    @this.call('redirectToReview')
                }, 2000);
            }
        });
    });

    function startStatusPolling(orderId) {
        document.getElementById('status-checking').classList.remove('hidden');
        @this.call('checkPaymentStatus', orderId)
        // statusCheckInterval = setInterval(() => {
        //     @this.call('checkPaymentStatus', orderId).then(result => {
        //         if (result) {
        //             stopStatusPolling();
        //         }
        //     });
        // }, 3000); // Check every 3 seconds

        // // Stop polling after 5 minutes
        // setTimeout(() => {
        //     stopStatusPolling();
        // }, 300000);
    }

    function stopStatusPolling() {
        if (statusCheckInterval) {
            clearInterval(statusCheckInterval);
            statusCheckInterval = null;
        }
        document.getElementById('status-checking').classList.add('hidden');
    }
</script>

@push('styles')
    <style>
        .container {
            min-height: 100vh;
        }

        .payment-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px 0 rgba(116, 79, 168, 0.75);
        }

        .payment-button:hover {
            box-shadow: 0 6px 20px 0 rgba(116, 79, 168, 0.90);
        }

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

        /* Status indicator animation */
        .status-indicator {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush