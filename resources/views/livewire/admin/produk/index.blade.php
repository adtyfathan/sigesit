 <div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl text-black font-bold">Data Produk</h2>
                    <a href="{{ route('admin.produk.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                        Tambah Produk
                    </a>
                </div>

                <div class=" overflow-x-auto relative">
                    <table class="w-full text-sm text-center text-gray-500">
                        <!-- Table Header -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nama Produk
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Harga
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Gambar
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Kategori
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Diupload Pada
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                    
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($produks as $produk)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $produk->nama_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($produk->harga_per_jam, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $produk->kategori->nama_kategori }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $produk->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.produk.show', $produk->id) }}"
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors"
                                                wire:navigate>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                               class="text-yellow-600 hover:text-yellow-900 px-3 py-1 rounded-md bg-yellow-50 hover:bg-yellow-100 transition-colors"
                                                wire:navigate>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.451z" />
                                                </svg>
                                            </a>
                                            @if (!$produk->transaksi()->exists())
                                                <button wire:click="delete({{ $produk->id }})" 
                                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md bg-red-50 hover:bg-red-100 transition-colors"
                                                    wire:confirm="Anda yakin menghapus produk ini?"
                                                    wire:navigate>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 7h12m-9 4v6m6-6v6M9 4h6a1 1 0 011 1v1H8V5a1 1 0 011-1zM5 7l1 12a2 2 0 002 2h8a2 2 0 002-2l1-12H5z" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
