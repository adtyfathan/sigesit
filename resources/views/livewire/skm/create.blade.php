<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between text-white">
                    <span class="text-sm font-medium">Survey</span>
                    <span class="text-sm font-medium">5 pertanyaan</span>
                </div>
            </div>

            <form wire:submit="store" class="p-6 sm:p-8">
                @if($transaksi)
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 mb-8 shadow-sm">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <h3 class="text-lg font-semibold text-blue-900">Detail Transaksi</h3>
                            </div>
                            <div class="{{ $transaksi->status == 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $transaksi->status }}
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 items-start">
                            <div class="md:col-span-1">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $transaksi->produk->gambar_produk) }}"
                                         alt="{{ $transaksi->produk->nama_produk }}"
                                         class="w-full h-32 md:h-40 object-cover rounded-lg shadow-md">
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-3">
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900 mb-1">{{ $transaksi->produk->nama_produk }}</h4>
                                    <p class="text-sm text-gray-600">Rp {{ number_format($transaksi->jumlah_transaksi, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex gap-4 text-sm">
                                    <div class="bg-white bg-opacity-50 rounded-lg p-3 flex-1">
                                        <div class="text-gray-500 text-xs font-medium uppercase mb-1">ID Pemesanan</div>
                                        <div class="text-gray-900 font-semibold">{{ $transaksi->order_id }}</div>
                                    </div>
                                    <div class="bg-white bg-opacity-50 rounded-lg p-3 flex-1">
                                        <div class="text-gray-500 text-xs font-medium uppercase mb-1">Tanggal Transaksi</div>
                                        <div class="text-gray-900 font-semibold">{{ $transaksi->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-blue-200 border-opacity-50">
                            <div class="flex items-center space-x-2 text-sm text-blue-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Mohon berikan penilaian untuk transaksi di atas</span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="block text-lg font-semibold text-gray-900">
                            1. Seberapa puas Anda dengan fasilitas yang tersedia? (1-10)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Penilaian terhadap kualitas dan kelengkapan fasilitas</p>

                        <input type="number" min="1" max="10" wire:model="skorFasilitas"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               placeholder="Masukkan nilai 1-10">
                        @error('skorFasilitas')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-lg font-semibold text-gray-900">
                            2. Seberapa puas Anda dengan petugas yang melayani? (1-10)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Penilaian terhadap sikap dan profesionalisme petugas</p>

                        <input type="number" min="1" max="10" wire:model="skorPetugas"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               placeholder="Masukkan nilai 1-10">
                        @error('skorPetugas')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-lg font-semibold text-gray-900">
                            3. Seberapa puas Anda dengan aksesibilitas layanan kami? (1-10)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Kemudahan akses lokasi, platform, dan sistem layanan</p>

                        <input type="number" min="1" max="10" wire:model="skorAksesibilitas"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               placeholder="Masukkan nilai 1-10">
                        @error('skorAksesibilitas')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="space-y-3">
                        <label class="block text-lg font-semibold text-gray-900">
                            4. Seberapa puas Anda dengan proses pengiriman layanan kami? (1-10)
                        </label>
                        <p class="text-sm text-gray-600 mb-4">Penilaian terhadap kecepatan, keamanan, dan kondisi produk saat diterima</p>

                        <input type="number" min="1" max="10" wire:model="skorPengiriman"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                               placeholder="Masukkan nilai 1-10">
                        @error('skorPengiriman')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="block text-lg font-semibold text-gray-900">
                            5. Komentar & Saran Tambahan
                        </label>
                        <p class="text-sm text-gray-600">Berikan masukan atau saran untuk membantu kami meningkatkan
                            pelayanan (opsional)</p>

                        <textarea wire:model="komentar" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none"
                                  placeholder="Tuliskan komentar atau saran Anda di sini..."></textarea>
                        @error('komentar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-200">
                    <div class="flex justify-end flex-col sm:flex-row gap-4">
                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Survey
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>