<div class="container mx-auto px-4 py-8">
    <!-- Search Section -->
    <div class="max-w-2xl mx-auto mb-8">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full pl-10 pr-12 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm text-gray-900 placeholder-gray-500"
                placeholder="Cari produk berdasarkan nama, deskripsi, atau lokasi...">

            <!-- Clear Button -->
            @if($search)
                <button wire:click="clearSearch"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Search Results Info -->
        @if($search)
            <div class="mt-3 text-sm text-gray-600 text-center">
                Menampilkan {{ count($produks) }} produk untuk pencarian "<span
                    class="font-semibold text-blue-600">{{ $search }}</span>"
            </div>
        @endif
    </div>

    <!-- No Results Message -->
    @if($search && count($produks) == 0)
        <div class="text-center py-12">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
            <p class="text-gray-600 mb-4">Coba ubah kata kunci pencarian Anda</p>
            <button wire:click="clearSearch"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                Lihat Semua Produk
            </button>
        </div>
    @endif

    <!-- Products Grid -->
    @if(count($produks) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($produks as $produk)
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                    <!-- produk Image -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                        <img src="{{ $produk['gambar_produk'] }}" alt="{{ $produk['nama_produk'] }}"
                            class="w-full h-full object-cover">

                        <!-- Sale Badge -->
                        @if($produk['jumlah_terjual'] > 0)
                            <div class="absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $produk['jumlah_terjual'] }} Terjual
                            </div>
                        @endif
                    </div>

                    <!-- produk Content -->
                    <div class="p-6">
                        <!-- produk Title -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                            {{ $produk['nama_produk'] }}
                        </h3>

                        <!-- Location -->
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $produk['wilayah_peta'] }}
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $produk['deskripsi_produk'] }}
                        </p>

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($produk['harga_produk'], 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Purchase Button -->
                        <button wire:click="purchase({{ $produk['id'] }})"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2">
                            <span>Beli Sekarang</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>