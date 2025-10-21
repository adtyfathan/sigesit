<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl text-black font-bold">Data Kategori</h2>
                    <a href="{{ route('admin.kategori.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:navigate>
                        Tambah Kategori
                    </a>
                </div>

                <div class=" overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500">
                        <!-- Table Header -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="text-center">
                            @foreach ($kategoris as $kategori)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $kategori->nama_kategori }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 px-3 py-1 rounded-md bg-yellow-50 hover:bg-yellow-100 transition-colors"
                                                wire:navigate>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.313l-4.5 1.125 1.125-4.5 12.737-12.451z" />
                                                </svg>
                                            </a>
                                            @if (!$kategori->produk()->exists())
                                                <button wire:click="delete({{ $kategori->id }})"
                                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md bg-red-50 hover:bg-red-100 transition-colors"
                                                    wire:confirm="Anda yakin menghapus kategori ini?"
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