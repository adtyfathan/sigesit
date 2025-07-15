<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4">
            <div class="max-w-7xl mx-auto">
                <!-- Main Product Card -->
                <div
                    class="bg-white/70 rounded-3xl overflow-hidden border border-white/20 hover:shadow-3xl transition-all duration-500">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
        
                        <!-- Product Details Section -->
                        <div class="p-6 lg:px-8 relative">
                            <!-- Decorative Background -->
                            <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-blue-50/50 rounded-r-3xl"></div>
        
                            <div class="relative z-10 space-y-6">
                                <!-- Category Badge -->
                                <div
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 border border-blue-200/50 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                    </svg>
                                    {{ $produk->kategori->nama_kategori ?? 'Kategori' }}
                                </div>
        
                                <!-- Product Title -->
                                <h1
                                    class="text-4xl lg:text-5xl font-black text-gray-900 leading-tight tracking-tight bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                                    {{ $produk->nama_produk }}
                                </h1>
        
                                <!-- Stats Row -->
                                <div class="flex flex-wrap gap-6 text-sm">
                                    <div
                                        class="flex items-center gap-2 bg-green-50 px-3 py-2 rounded-full border border-green-200/50">
                                        <svg class="w-6 h-6 text-white bg-green-500 rounded-full p-1" viewBox="0 0 20 20" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 6.293a1 1 0 00-1.414 0L9 12.586 6.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <span class="text-green-700 font-medium">{{ $produk->jumlah_terjual }} terjual</span>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-full border border-purple-200/50">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-purple-700 font-medium">{{ $produk->wilayah_peta }}</span>
                                    </div>
                                </div>
        
                                <!-- Price Section -->
                                <div class="relative group">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                                    </div>
                                    <div
                                        class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl p-6 shadow-2xl transform hover:scale-105 transition-all duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/5 rounded-2xl">
                                        </div>
                                        <div class="relative">
                                            <p class="text-blue-100 text-sm font-small mb-1">Harga Produk</p>
                                            <p class="text-2xl lg:text-3xl font-black text-white tracking-tight">
                                                {{ $this->formatPrice($produk->harga_produk) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Action Buttons -->
                                <div class="space-y-4">
                                    <!-- Main Buy Button -->
                                    <button wire:click="beli({{ $produk->id }})"
                                        class="w-full relative group overflow-hidden bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/5 group-hover:from-white/20 group-hover:to-white/10 transition-all duration-300">
                                        </div>
                                        <div class="relative flex items-center justify-center gap-3">
                                            <svg class="w-6 h-6 transform group-hover:rotate-12 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9" />
                                            </svg>
                                            <span>Beli Sekarang</span>
                                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </div>
                                    </button>
        
                                    <!-- Share Section -->
                                    <div class="border-t border-gray-200 pt-8 pb-8">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                            <h3 class="text-lg font-semibold text-gray-900">Bagikan Produk</h3>
                                    
                                            <div class="flex flex-wrap items-center gap-3">
                                                <!-- Copy Link Button -->
                                                <button wire:click="copyLink" x-data="{ copied: false }" x-on:click="
                                                                    navigator.clipboard.writeText(window.location.href);
                                                                    copied = true;
                                                                    setTimeout(() => copied = false, 2000);
                                                                "
                                                    class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                                                </button>
                                    
                                                <!-- Social Media Share Buttons -->
                                                <a href="https://api.whatsapp.com/send?text={{ urlencode($produk->nama_produk . ' - ' . request()->url()) }}"
                                                    target="_blank"
                                                    class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                                    </svg>
                                                    <span class="hidden sm:inline">WhatsApp</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden mt-8 mb-8">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 bg-gray-50 px-6">
                        <nav class="flex space-x-8">
                            <button wire:click="setActiveTab('overview')"
                                class="py-4 px-2 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'overview' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Overview
                            </button>
                            <button wire:click="setActiveTab('description')"
                                class="py-4 px-2 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'description' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Deskripsi Detail
                            </button>
                            <button wire:click="setActiveTab('specifications')"
                                class="py-4 px-2 border-b-2 font-medium text-sm transition-all duration-300 {{ $activeTab === 'specifications' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Spesifikasi
                            </button>
                        </nav>
                    </div>
                
                    <!-- Tab Content -->
                    <div class="p-8">
                        @if($activeTab === 'overview')
                            <div class="space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Product Information -->
                                    <div class="space-y-6">
                                        <h3 class="text-2xl font-bold text-gray-900">Informasi Produk</h3>
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                                <span class="text-gray-600 font-medium">Wilayah Peta</span>
                                                <span class="text-gray-900 font-semibold">{{ $produk->wilayah_peta }}</span>
                                            </div>
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                                <span class="text-gray-600 font-medium">Kategori</span>
                                                <span
                                                    class="text-gray-900 font-semibold">{{ $produk->kategori->nama_kategori ?? 'Tidak tersedia' }}</span>
                                            </div>
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                                <span class="text-gray-600 font-medium">Total Penjualan</span>
                                                <span class="text-gray-900 font-semibold">{{ $produk->jumlah_terjual }} kali</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Key Features -->
                                    <div class="space-y-6">
                                        <h3 class="text-2xl font-bold text-gray-900">Fitur Unggulan</h3>
                                        <div class="space-y-4">
                                            <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl">
                                                <div
                                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700">Data geografis akurat dan terpercaya</span>
                                            </div>
                                            <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl">
                                                <div
                                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700">Format standar industri</span>
                                            </div>
                                            <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl">
                                                <div
                                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700">Update berkala dan maintenance</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                
                        @if($activeTab === 'description')
                            <div class="max-w-4xl">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Deskripsi Produk</h3>
                                <div class="prose prose-lg max-w-none">
                                    <div class="text-gray-700 leading-relaxed bg-gray-50 p-6 rounded-xl">
                                        @if($showFullDescription)
                                            <p class="whitespace-pre-line">{{ $produk->deskripsi_produk }}</p>
                                        @else
                                            <p class="whitespace-pre-line">{{ Str::limit($produk->deskripsi_produk, 400) }}</p>
                                        @endif

                                        @if(strlen($produk->deskripsi_produk) > 400)
                                            <button wire:click="toggleDescription"
                                                class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                                {{ $showFullDescription ? 'Lihat Lebih Sedikit' : 'Lihat Selengkapnya' }}
                                                <svg class="w-4 h-4 ml-1 transform {{ $showFullDescription ? 'rotate-180' : '' }} transition-transform duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                
                        @if($activeTab === 'specifications')
                            <div class="max-w-4xl">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Spesifikasi Teknis</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border border-blue-200">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 2v8H4V6h12z" />
                                            </svg>
                                            Format Data
                                        </h4>
                                        <p class="text-gray-700">Shapefile (.shp), GeoJSON, KML</p>
                                    </div>
                                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Sistem Koordinat
                                        </h4>
                                        <p class="text-gray-700">WGS84 (EPSG:4326)</p>
                                    </div>
                                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl border border-purple-200">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                            </svg>
                                            Resolusi
                                        </h4>
                                        <p class="text-gray-700">High Resolution (1:10,000)</p>
                                    </div>
                                    <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-2xl border border-amber-200">
                                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Ukuran File
                                        </h4>
                                        <p class="text-gray-700">~50MB (compressed)</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>