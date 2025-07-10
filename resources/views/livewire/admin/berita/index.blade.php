<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl text-black font-bold">Data Berita</h2>
                    <a href="{{ route('admin.berita.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                        Tambah Berita
                    </a>
                </div>

                <div class=" overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500">
                        <!-- Table Header -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Judul Berita
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Gambar
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Isi Berita
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Tanggal Publikasi
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($beritas as $berita)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $berita->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                                                <img src="{{ asset('storage/' . $berita->gambar_berita) }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        <p class="truncate whitespace-nowrap overflow-hidden text-ellipsis">{{ $berita->isi_berita }}</p>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $berita->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.berita.show', $berita->id) }}"
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors"
                                                wire:navigate>
                                                Lihat
                                            </a>
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 px-3 py-1 rounded-md bg-yellow-50 hover:bg-yellow-100 transition-colors"
                                                wire:navigate>
                                                Edit
                                            </a>
                                            <button wire:click="delete({{ $berita->id }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Anda yakin menghapus berita ini?')"
                                                wire:navigate>
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