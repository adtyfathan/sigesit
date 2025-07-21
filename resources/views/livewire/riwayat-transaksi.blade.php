<div class="py-12 items-center">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl text-black font-bold">Data Riwayat Transaksi</h2>
                </div>

                <div class=" overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Id Pesanan
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Gambar Produk
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nama Produk
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Kategori
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Jumlah Harga
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Tanggal Transaksi
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($transaksis as $transaksi)
                                <tr class="bg-white border-b hover:bg-gray-50 text-center">
                                    <td class="px-6 py-4">
                                        {{ $transaksi->order_id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center">
                                            <div
                                                class="h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                                                <img src="{{ asset('storage/' . $transaksi->produk->gambar_produk) }}"
                                                    class="object-cover h-full w-full">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaksi->produk->nama_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaksi->produk->kategori->nama_kategori }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($transaksi->jumlah_transaksi, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaksi->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $this->getStatusColorClass($transaksi->status) }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2 justify-center">
                                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors"
                                                wire:navigate>
                                                Detail Transaksi
                                            </a>
                                            <a href=""
                                                class="text-green-600 hover:text-green-900 px-3 py-1 rounded-md bg-green-50 hover:bg-green-100 transition-colors"
                                                wire:navigate>
                                                Isi SKM
                                            </a>
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