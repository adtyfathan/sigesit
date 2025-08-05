<div
    class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
    <!-- Product Image -->
    <div class="relative overflow-hidden rounded-xl mb-6 bg-gradient-to-br from-blue-50 to-blue-100">
        <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
            class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300">
    </div>

    <!-- Product Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2 leading-tight">
            {{ $produk->nama_produk }}
        </h1>

        <!-- Price -->
        <div class="flex items-center justify-between mb-4">
            <div class="text-3xl font-bold text-blue-600">
                Rp {{ number_format($produk->harga_per_jam, 0, ',', '.') }}
            </div>
            <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $produk->kategori->nama_kategori }}
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Deskripsi Produk
        </h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-gray-700 leading-relaxed">{{ $produk->deskripsi_produk }}</p>
        </div>
    </div>
</div>