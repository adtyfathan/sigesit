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
                    <table class="w-full text-sm text-left text-gray-500">
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
                                    Jumlah Terjual
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Wilayah Peta
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
                                        Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $produk->jumlah_terjual }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $produk->wilayah_peta }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $produk->kategori->nama_kategori }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $produk->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href=""
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors">
                                                Lihat
                                            </a>
                                            <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 px-3 py-1 rounded-md bg-yellow-50 hover:bg-yellow-100 transition-colors">
                                                Edit
                                            </a>
                                            <button wire:click="delete({{ $produk->id }})" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Anda yakin menghapus produk ini?')">
                                                Hapus
                                            </button>
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
