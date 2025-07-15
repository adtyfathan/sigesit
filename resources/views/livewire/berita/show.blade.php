<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white">
    {{-- Main Content Wrapper --}}
    {{-- Container ini akan membungkus header dan grid utama --}}
    <div class="max-w-full px-4 sm:px-6 lg:px-8 py-8"> 

        {{-- Header Berita Utama (Tanggal & Judul) - Dipindahkan ke atas grid --}}
        <header class="mb-8"> {{-- Tambahkan margin-bottom untuk jarak ke gambar/grid --}}
            <time class="text-sm text-gray-500 flex items-center gap-1 mb-2">
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y H:i') }} WIB
            </time>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                {{ $berita->judul }}
            </h1>
        </header>

        {{-- Grid Container untuk Layout 2 Kolom --}}
        {{-- Ini adalah grid yang sekarang akan sejajar dengan gambar --}}
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-8">

            {{-- Bagian Kiri: Konten Utama Berita (3/4 Lebar pada MD ke atas) --}}
            <div class="md:col-span-3">

                <article class="w-full">
                    {{-- Gambar sekarang adalah elemen pertama di dalam article/kolom grid --}}
                    @if($berita->gambar_berita)
                        <div class="relative w-full mb-8 rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ asset('storage/' . $berita->gambar_berita) }}" alt="{{ $berita->judul }}"
                                class="w-full h-auto object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @endif

                    {{-- Isi Artikel Berita --}}
                    <section class="mb-8">
                        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                            {!! nl2br(e($berita->isi_berita)) !!}
                        </div>
                    </section>

                    <section class="border-t border-b border-gray-200 py-6 mb-8">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <h3 class="text-lg font-semibold text-gray-900">Bagikan Artikel</h3>

                            <div class="flex flex-wrap items-center gap-3">
                                <button wire:click="copyLink"
                                        x-data="{ copied: false }"
                                        x-on:click="
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

                                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . request()->url()) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                    </svg>
                                    <span class="hidden sm:inline">WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </section>

                    <section class="border-t border-gray-200 pt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Komentar ({{ count($komentars) }})</h3>

                        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4">Tulis Komentar Anda</h4>
                            <div class="flex items-start gap-4">
                                @if (auth()->check() && auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Your Avatar"
                                        class="w-10 h-10 rounded-full flex-shrink-0 object-cover">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar"
                                        class="w-10 h-10 rounded-full flex-shrink-0 object-cover">
                                @endif

                                <div class="flex-1">
                                    <textarea wire:model="komentarBaru" placeholder="Tulis komentar Anda..." rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none @error('komentarBaru') border-red-500 @enderror"></textarea>
                                    @error('komentarBaru')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <div class="flex justify-end items-center mt-4">
                                        <button wire:click="storeComment"
                                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                            Kirim Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @forelse($komentars as $komentar)
                                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                                    <div class="flex items-start gap-4">
                                        @if ($komentar->user->avatar)
                                            <img src="{{ asset('storage/' . $komentar->user->avatar) }}" alt="{{ $komentar->user->name }}"
                                                class="w-10 h-10 rounded-full flex-shrink-0 object-cover">
                                        @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $komentar->user->name }}"
                                                class="w-10 h-10 rounded-full flex-shrink-0 object-cover">
                                        @endif

                                        <div class="flex-1">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
                                                <h4 class="font-semibold text-gray-900">{{ $komentar->user->name }}</h4>
                                                <span class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($komentar->created_at)->translatedFormat('d M Y, H:i') }} ({{ $komentar->created_at->diffForHumans() }})
                                                </span>
                                                @if ($komentar->updated_at != $komentar->created_at)
                                                    <span class="text-xs text-gray-400">(diperbarui)</span>
                                                @endif
                                            </div>
                                            
                                            @if (auth()->check() && $editingCommentId === $komentar->id)
                                                <div class="mb-3">
                                                    <textarea wire:model="editingCommentText" rows="3"
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none @error('editingCommentText') border-red-500 @enderror"></textarea>
                                                    @error('editingCommentText')
                                                        <p class="text-red-500 text-sm mt-1">{{ $komentar }}</p>
                                                    @enderror
                                                    <div class="flex gap-2 mt-3 justify-end">
                                                        <button wire:click="updateComment"
                                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 text-sm">
                                                            Simpan
                                                        </button>
                                                        <button wire:click="cancelEdit"
                                                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 text-sm">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="text-gray-700 mb-3">{{ $komentar->isi_komentar }}</p>
                                                
                                                @if (auth()->check() && $komentar->user_id === auth()->user()->id)
                                                    <div class="flex gap-2">
                                                        <button wire:click="editComment({{ $komentar->id }})"
                                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                            Edit
                                                        </button>
                                                        <button wire:click="deleteComment({{ $komentar->id }})"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium"
                                                            onclick="return confirm('Anda yakin menghapus komentar ini?')">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12 text-gray-500">
                                    <p class="text-lg">Belum ada komentar.</p>
                                    <p class="text-md">Jadilah yang pertama berkomentar!</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </article>
            </div>

            <aside class="md:col-span-1 mt-8 md:mt-0">
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Berita Lainnya</h3>
                    <div class="space-y-6">
                        @forelse($relatedBeritas as $relatedBerita)
                            <a href="{{ route('berita.show', $relatedBerita->id) }}" wire:navigate class="block hover:bg-gray-50 rounded-lg -mx-2 -my-2 p-2 transition duration-150 ease-in-out">
                                <div class="flex items-start gap-3">
                                    @if($relatedBerita->gambar_berita)
                                        <img src="{{ asset('storage/' . $relatedBerita->gambar_berita) }}" alt="{{ $relatedBerita->judul }}"
                                            class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-md flex-shrink-0 flex items-center justify-center text-gray-500 text-xs">No Image</div>
                                    @endif
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900 line-clamp-2 mb-1">
                                            {{ $relatedBerita->judul }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($relatedBerita->created_at)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500 text-sm">Tidak ada berita terkait lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:link-copied.window="show = true; message = 'Link berhasil disalin!'; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:comment-added.window="show = true; message = 'Komentar berhasil ditambahkan!'; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:comment-updated.window="show = true; message = 'Komentar berhasil diperbarui!'; type = 'success'; setTimeout(() => show = false, 3000)"
        x-on:comment-deleted.window="show = true; message = 'Komentar berhasil dihapus!'; type = 'success'; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white"
        :class="{ 'bg-green-500': type === 'success', 'bg-red-500': type === 'error' }">
        <span x-text="message"></span>
    </div>
</div>