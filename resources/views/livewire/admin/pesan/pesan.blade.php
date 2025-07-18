<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Pesan Masuk</h2>
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

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Pengirim</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Subjek</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Pesan Singkat</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Diterima Pada</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="{{ $message->is_read ? 'bg-gray-50' : 'bg-white font-semibold' }}">
                        <td class="py-2 px-4 border-b text-sm text-gray-900">{{ $message->name }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-900">{{ $message->email }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-900">{{ $message->subject ?? '-' }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-900">{{ Str::limit($message->message, 70) }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-900">{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $message->is_read ? 'bg-gray-200 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $message->is_read ? 'Sudah Dibaca' : 'Baru' }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b text-sm">
                            <button wire:click="viewMessage({{ $message->id }})"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs mr-2">Lihat</button>
                            <button wire:click="deleteMessage({{ $message->id }})"
                                wire:confirm="Apakah Anda yakin ingin menghapus pesan ini?"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Hapus</button>
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
            <div class="relative p-8 bg-white w-full max-w-md mx-auto rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4">Detail Pesan</h3>
                <p class="mb-2"><span class="font-semibold">Dari:</span> {{ $selectedMessage->name }} ({{ $selectedMessage->email }})</p>
                <p class="mb-2"><span class="font-semibold">Subjek:</span> {{ $selectedMessage->subject ?? '-' }}</p>
                <p class="mb-4"><span class="font-semibold">Tanggal:</span> {{ $selectedMessage->created_at->format('d M Y H:i') }}</p>
                <div class="p-4 bg-gray-100 rounded-md border border-gray-200">
                    <p class="whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
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