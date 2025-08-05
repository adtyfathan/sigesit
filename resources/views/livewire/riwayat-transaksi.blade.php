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
                                    Nama Produk
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Stasiun
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Waktu Awal
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Waktu Akhir
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Total Harga
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
                                        {{ $transaksi->produk->nama_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaksi->stasiun->nama_stasiun }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span>
                                            {{ \Carbon\Carbon::parse($transaksi->waktu_awal_pemesanan)->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span>
                                            {{ \Carbon\Carbon::parse($transaksi->waktu_akhir_pemesanan)->format('d M Y, H:i') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
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
                                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors flex-1 flex items-center justify-center"
                                                wire:navigate>
                                                Detail Transaksi
                                            </a>
                                            @if (!$this->submittedSkm($transaksi->id))
                                                <a href="{{ route('skm.create', $transaksi->id) }}"
                                                    class="text-green-600 hover:text-green-900 px-3 py-1 rounded-md bg-green-50 hover:bg-green-100 transition-colors flex-1 flex items-center justify-center"
                                                    wire:navigate>
                                                    Isi SKM
                                                </a>
                                            @elseif ($this->submittedSkm($transaksi->id))
                                                <button disabled
                                                    class="text-white px-3 py-1 rounded-md bg-gray-500 flex-1 flex items-center justify-center">
                                                    SKM Terkirim
                                                </button>
                                            @elseif ($transaksi->status !== "success")
                                                <button disabled class="text-white px-3 py-1 rounded-md bg-gray-500 flex-1 flex items-center justify-center">
                                                    Isi SKM
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