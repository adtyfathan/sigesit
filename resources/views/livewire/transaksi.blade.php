<div class="min-h-screen bg-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi</h1>
                    <p class="text-gray-600 mt-1">Order ID: {{ $transaksi->order_id }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-4 py-2 rounded-full text-sm font-medium border {{ $this->getStatusColorClass() }}">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Product Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-lg font-semibold text-blue-900 flex items-center">
                            Informasi Produk
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row gap-6">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 bg-gray-200 rounded-lg overflow-hidden">
                                    @if($produk->gambar_produk)
                                        <img src="{{ asset('storage/' . $produk->gambar_produk) }}" 
                                             alt="{{ $produk->nama_produk }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $produk->nama_produk }}</h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Kategori:</span>
                                        <span class="ml-2 font-medium text-gray-900">
                                            {{ $produk->kategori->nama_kategori ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Harga:</span>
                                        <span class="ml-2 font-bold text-blue-600">
                                            {{ $this->formatCurrency($produk->harga_produk) }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Wilayah:</span>
                                        <span class="ml-2 font-medium text-gray-900">
                                            {{ $produk->wilayah_peta ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Total Terjual:</span>
                                        <span class="ml-2 font-medium text-gray-900">
                                            {{ number_format($produk->jumlah_terjual) }}
                                        </span>
                                    </div>
                                </div>
                                
                                @if($produk->deskripsi_produk)
                                    <div class="mt-4">
                                        <span class="text-gray-600">Deskripsi:</span>
                                        <p class="text-gray-800 mt-1 text-sm leading-relaxed">
                                            {{ Str::limit($produk->deskripsi_produk, 200) }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-lg font-semibold text-blue-900 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Detail Transaksi
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Transaction ID</label>
                                    <div class="mt-1 p-3 bg-gray-50 rounded-lg border">
                                        <code class="text-sm text-gray-900 font-mono">{{ $transaksi->transaction_id ?? 'N/A' }}</code>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Order ID</label>
                                    <div class="mt-1 p-3 bg-gray-50 rounded-lg border">
                                        <code class="text-sm text-gray-900 font-mono">{{ $transaksi->order_id }}</code>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Metode Pembayaran</label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($transaksi->payment_type ?? 'N/A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tanggal Transaksi</label>
                                    <div class="mt-1 flex items-center text-gray-900">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $this->formatDate($transaksi->tanggal_transaksi) }}
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Jumlah Transaksi</label>
                                    <div class="mt-1">
                                        <span class="text-2xl font-bold text-blue-600">
                                            {{ $this->formatCurrency($transaksi->jumlah_transaksi) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Status</label>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $this->getStatusColorClass() }}">
                                            {{ ucfirst($transaksi->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-lg font-semibold text-blue-900 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Pelanggan
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $transaksi->user->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $transaksi->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-lg font-semibold text-blue-900">Ringkasan</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga Produk:</span>
                                <span class="font-medium text-gray-900">{{ $this->formatCurrency($produk->harga_produk) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Admin:</span>
                                <span class="font-medium text-gray-900">
                                    {{ $this->formatCurrency($transaksi->jumlah_transaksi - $produk->harga_produk) }}
                                </span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between">
                                    <span class="font-semibold text-gray-900">Total:</span>
                                    <span class="font-bold text-blue-600 text-lg">
                                        {{ $this->formatCurrency($transaksi->jumlah_transaksi) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($transaksi->status === "success")
                    @if (!$submittedSkm)
                    <a href="{{ route('skm.create', $transaksi->id) }}" wire:navigate
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                        <span>Isi SKM</span>
                    </a>
                    @else
                        <button disabled 
                            class="w-full bg-gray-600 text-white font-semibold py-3 px-4 rounded-lg flex items-center justify-center space-x-2">
                            Sudah Mengisi SKM
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>