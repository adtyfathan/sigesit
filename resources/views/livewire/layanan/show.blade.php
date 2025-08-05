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
        
                                <!-- Product Title -->
                                <h1
                                    class="text-4xl font-black text-gray-900 leading-tight tracking-tight bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                                    {{ $produk->nama_produk }}
                                </h1>
        
                                <!-- Price Section -->
                                <div>
                                    <p class="text-gray-500 text-sm font-medium mb-1">Harga Data per Jam</p>
                                    <p class="text-3xl font-bold text-black">
                                        {{ $this->formatPrice($produk->harga_per_jam) }}
                                    </p>
                                </div>

                                <!-- Enhanced Input Form Section -->
                                <div class="space-y-6">
                                
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                            <!-- Stasiun Selection -->
                                            <div class="lg:col-span-2">
                                                <label for="stasiun_id" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    Stasiun Pasang Surut
                                                </label>
                                                <div class="relative">
                                                    <select name="stasiun_id" id="stasiun_id" wire:model="stasiun_id"
                                                        class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 appearance-none text-gray-700 font-medium shadow-sm hover:border-gray-300">
                                                        <option value="" class="text-gray-500">Pilih stasiun yang diinginkan</option>
                                                        @foreach ($stasiuns as $stasiun)
                                                            <option value="{{ $stasiun->id }}" class="text-gray-700">{{ $stasiun->kode_stasiun }} -
                                                                {{ $stasiun->nama_stasiun }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                
                                            <!-- Start Time -->
                                            <div class="space-y-3">
                                                <label for="waktu_awal_pemesanan"
                                                    class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Waktu Awal Pemesanan Data
                                                </label>
                                                <div class="relative">
                                                    <input type="datetime-local" name="waktu_awal_pemesanan" id="waktu_awal_pemesanan"
                                                        wire:model="waktu_awal_pemesanan"
                                                        class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 text-gray-700 font-medium shadow-sm hover:border-gray-300">
                                                </div>
                                            </div>
                                
                                            <!-- End Time -->
                                            <div class="space-y-3">
                                                <label for="waktu_akhir_pemesanan"
                                                    class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Waktu Akhir Pemesanan Data
                                                </label>
                                                <div class="relative">
                                                    <input type="datetime-local" name="waktu_akhir_pemesanan" id="waktu_akhir_pemesanan"
                                                        wire:model="waktu_akhir_pemesanan"
                                                        class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all duration-200 text-gray-700 font-medium shadow-sm hover:border-gray-300">
                                                </div>
                                            </div>
                                        </div>
                                </div>
        
                                <!-- Action Buttons -->
                                <div class="space-y-4">
                                    <!-- Main Buy Button -->
                                    <button wire:click="goToCheckout()"
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
                
                    <!-- Tab Content -->
                    <div class="p-8">
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

                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>