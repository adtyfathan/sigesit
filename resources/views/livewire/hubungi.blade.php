<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <div class="lg:text-center mb-12">
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Mari Bicara!
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                Kami selalu senang mendengar dari Anda. Apakah Anda memiliki pertanyaan, saran, atau ingin berkolaborasi, silakan hubungi kami.
            </p>
        </div>

        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <div class="mt-10 lg:mt-0 lg:col-span-1">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                <div class="space-y-6">
                    <p class="flex items-center text-gray-600">
                        <svg class="flex-shrink-0 h-6 w-6 text-indigo-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24" stroke="none">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span>Jl. Raya Jakarta - Bogor KM. 46, Kabupaten Bogor, 16911, Jawa Barat, Indonesia</span>
                    </p>
                    <p class="flex items-center text-gray-600">
                        <svg class="flex-shrink-0 h-6 w-6 text-indigo-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:info@sigesit.com" class="hover:underline">helpdesk.nsdi@big.go.id</a>
                    </p>
                    <p class="flex items-center text-gray-600">
                        <svg class="flex-shrink-0 h-6 w-6 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>021-8753155</span>
                    </p>
                    <p class="flex items-center text-gray-600">
                        <svg class="flex-shrink-0 h-6 w-6 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <rect x="5" y="6" width="14" height="15" rx="2" ry="2" stroke-width="1.5" /> <path d="M17 6L17 5.5C17 4.94772 16.5523 4.5 16 4.5H8C7.44772 4.5 7 4.94772 7 5.5V6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /> <path d="M12 2C9.79086 2 8 3.79086 8 6H16C16 3.79086 14.2091 2 12 2Z" fill="currentColor" /> <text x="12" y="15" font-family="Arial, Helvetica, sans-serif" font-size="6" font-weight="bold" text-anchor="middle" fill="currentColor">FAX</text>
                        </svg>
                        <span>021-87908988</span>
                    </p>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 mt-10 mb-6">Jam Operasional</h3>
                <ul class="text-gray-600 space-y-2">
                    <li>Senin - Kamis: <span class="font-medium">07:30 - 16:00 WIB</span></li>
                    <li>Jumat: <span class="font-medium">08:00 - 17:00 WIB</span></li>
                    <li>Sabtu - Minggu: <span class="font-medium">Tutup</span></li>
                </ul>
            </div>

            <div class="mt-10 bg-white shadow-lg rounded-xl p-8 lg:col-span-2">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan Anda</h3>
                <form wire:submit.prevent="submitForm" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="name" wire:model.defer="name" placeholder="Nama Anda"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                        @error('name') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" id="email" wire:model.defer="email" placeholder="contoh@email.com"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror">
                        @error('email') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subjek Pesan (Opsional)</label>
                        <input type="text" id="subject" wire:model.defer="subject" placeholder="Perihal pesan Anda"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('subject') border-red-500 @enderror">
                        {{-- TAMBAHKAN BARIS INI UNTUK NOTIFIKASI ERROR SUBJECT --}}
                        @error('subject') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                        <textarea id="message" wire:model.defer="message" rows="5" placeholder="Tulis pesan lengkap Anda di sini..."
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('message') border-red-500 @enderror"></textarea>
                        @error('message') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Kirim Pesan
                    </button>

                    {{-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN PESAN ERROR UMUM --}}
                    @if (session()->has('error'))
                        <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-center" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- AKHIR BLOK ERROR UMUM --}}

                    @if (session()->has('message'))
                        <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-md text-center" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Temukan Kami di Peta</h3>
            <div class="bg-gray-200 rounded-xl overflow-hidden shadow-md" style="height: 400px; width: 100%;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15863.029856641572!2d106.8407421!3d-6.4950348!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c0d12e62b01b%3A0x6b4f7a77e5c5457a!2sGR5X%2BMP%20Pakansari%2C%20Bogor%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>
        </div>

    </div>
</div>