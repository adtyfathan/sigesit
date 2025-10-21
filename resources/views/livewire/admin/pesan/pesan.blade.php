<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl text-black font-bold">Pesan Masuk</h2>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pesan..."
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                @if (session()->has('message'))
                    <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-md text-center" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-center" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-center text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">Pengirim</th>
                                <th scope="col" class="py-3 px-6 text-center">Email</th>
                                <th scope="col" class="py-3 px-6 text-center">Subjek</th>
                                <th scope="col" class="py-3 px-6 text-center">Pesan Singkat</th>
                                <th scope="col" class="py-3 px-6 text-center">Diterima Pada</th>
                                <th scope="col" class="py-3 px-6 text-center">Status</th>
                                <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($messages as $message)
                                <tr class="bg-white border-b hover:bg-gray-50 {{ $message->is_read ? 'opacity-90' : 'font-semibold' }}">
                                    <td class="px-6 py-4 text-left">
                                        {{ $message->name }}
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        {{ $message->email }}
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        {{ $message->subject ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        {{ \Illuminate\Support\Str::limit($message->message, 70) }}
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        {{ $message->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $message->is_read ? 'bg-gray-200 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $message->is_read ? 'Sudah Dibaca' : 'Baru' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center space-x-2">
                                            <button wire:click="viewMessage({{ $message->id }})"
                                                class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded-md bg-blue-50 hover:bg-blue-100 transition-colors"
                                                aria-label="Lihat pesan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>

                                            @if ($message->is_read)
                                                <button wire:click="deleteMessage({{ $message->id }})" 
                                                    wire:confirm="Apakah Anda yakin ingin menghapus pesan ini?"
                                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded-md bg-red-50 hover:bg-red-100 transition-colors"
                                                    wire:navigate aria-label="Hapus pesan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12m-9 4v6m6-6v6M9 4h6a1 1 0 011 1v1H8V5a1 1 0 011-1zM5 7l1 12a2 2 0 002 2h8a2 2 0 002-2l1-12H5z"/>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-gray-500">Belum ada pesan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>

                <!-- Modal untuk Detail Pesan -->
                @if ($showModal && $selectedMessage)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
                        <div class="relative p-6 bg-white w-full max-w-2xl mx-auto rounded-2xl shadow-lg border border-gray-200/50">
                            <div class="mb-4 flex justify-between items-start">
                                <h3 class="text-xl font-bold">Detail Pesan</h3>
                                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">✕</button>
                            </div>

                            <div class="space-y-3">
                                <p><span class="font-semibold">Dari:</span> {{ $selectedMessage->name }} ({{ $selectedMessage->email }})</p>
                                <p><span class="font-semibold">Subjek:</span> {{ $selectedMessage->subject ?? '-' }}</p>
                                <p><span class="font-semibold">Tanggal:</span> {{ $selectedMessage->created_at->format('d M Y H:i') }}</p>

                                <div class="p-4 bg-gray-50 rounded-md border border-gray-100">
                                    <p class="whitespace-pre-wrap text-left">{{ $selectedMessage->message }}</p>
                                </div>
                            </div>

                            <div class="mt-6 text-right">
                                <button wire:click="closeModal"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>