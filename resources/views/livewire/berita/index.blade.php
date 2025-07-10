<div>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Berita Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($beritas as $berita)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                        <img class="w-full h-56 object-cover" src="" alt="Judul Berita 1">
                        <div class="p-6">
                            <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->translatedFormat('l, d F Y H:i') }}</p>
                            <h3 class="font-bold text-xl text-gray-900 mb-2 truncate">{{ $berita->judul }}</h3>
                            <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                                {{ $berita->isi_berita }}
                            </p>
                            <a href="#" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Baca Selengkapnya
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
