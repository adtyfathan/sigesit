<div>
    {{-- Hero Section --}}
    <div class="relative h-screen flex items-center justify-center text-center
                 bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset('images/banner4.jpg') }}');"> {{-- ADDED THIS LINE --}}
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative z-10 text-white px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Badan Informasi Geospasial</h1>
            <p class="text-lg md:text-xl">Satu Data, Satu Peta, Untuk Indonesia Maju</p>
        </div>
    </div>

    {{-- TERPOPULER Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">TERPOPULER</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('images/batas_wilayah.png') }}"
                        alt="Data Batas Wilayah">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium text-center">Data Batas Wilayah</p>
                        <span>
                            <a href="https://geoservices.big.go.id/portal/apps/webappviewer/index.html?id=cb58db080712468cb4bfd408dbde3d70"
                                target="_blank">
                                <div class="flex justify-center items-center">
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        <span>Unduh Data</span>
                                    </button>
                                </div>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('images/rbi_25k.png') }}"
                        alt="Data RBI Cetak 25K">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium text-center">Data RBI Cetak 25K</p>
                        <span>
                            <a href="https://tanahair.indonesia.go.id/portal-web/login?page=/unduh/rbi-cetak-25k"
                                target="_blank">
                                <div class="flex justify-center items-center">
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        <span>Unduh Data</span>
                                    </button>
                                </div>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('images/rbi_wilayah.png') }}"
                        alt="Data RBI per Wilayah">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium text-center">Data RBI per Wilayah</p>
                        <span>
                            <a href="https://tanahair.indonesia.go.id/portal-web/login?page=/unduh/rbi-wilayah"
                                target="_blank">
                                <div class="flex justify-center items-center">
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        <span>Unduh Data</span>
                                    </button>
                                </div>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('images/data_ksp.png') }}" alt="Data KSP">
                    <div class="p-4">
                        <p class="text-gray-900 font-medium text-center">Data KSP</p>
                        <span>
                            <a href="https://onemap.big.go.id/"
                                target="_blank">
                                <div class="flex justify-center items-center">
                                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                        <span>Unduh Data</span>
                                    </button>
                                </div>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Hasil SKM Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Hasil Survei Kepuasan Masyarakat (SKM)</h2>
            <p class="text-lg text-gray-600 mb-10">Kami berkomitmen untuk terus meningkatkan kualitas pelayanan berdasarkan masukan dari Anda.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                <div class="bg-indigo-50 p-6 rounded-lg shadow-md flex flex-col justify-center transform hover:scale-105 transition duration-300">
                    <p class="text-5xl font-bold text-indigo-700 mb-2">87.5</p>
                    <p class="text-xl font-semibold text-gray-800">Indeks Kepuasan Masyarakat (IKM)</p>
                    <p class="text-md text-gray-600 mt-2">Kategori: <span class="font-bold text-green-700">Sangat Baik</span></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md space-y-4 col-span-2">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 text-left">Penilaian Aspek Layanan (Tahun Berjalan)</h3>
                    <div class="flex items-center">
                        <span class="w-1/3 text-left font-medium text-gray-700">Kualitas Pelayanan</span>
                        <div class="w-2/3 bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full" style="width: 90%;"></div>
                        </div>
                        <span class="ml-4 font-semibold text-blue-700">90%</span>
                    </div>
                    <div class="flex items-center mt-4">
                        <span class="w-1/3 text-left font-medium text-gray-700">Kecepatan Respon</span>
                        <div class="w-2/3 bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full" style="width: 85%;"></div>
                        </div>
                        <span class="ml-4 font-semibold text-blue-700">85%</span>
                    </div>
                    <div class="flex items-center mt-4">
                        <span class="w-1/3 text-left font-medium text-gray-700">Keramahan Staf</span>
                        <div class="w-2/3 bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full" style="width: 92%;"></div>
                        </div>
                        <span class="ml-4 font-semibold text-blue-700">92%</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-6 text-left">Berdasarkan <span class="font-medium">1.500</span> responden pada periode Januari - Juni 2025.</p>
                </div>
            </div>

            <a href="/laporan-skm-lengkap" class="mt-12 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                Lihat Laporan SKM Lengkap
                <svg class="ml-2 -mr-0.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>


    {{-- FAQ Section --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-gray-800">Pertanyaan Umum (FAQ)</h2>

            <div class="max-w-3xl mx-auto">
                <div class="border-b border-gray-200 py-4">
                    <button class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800 hover:text-blue-600 focus:outline-none"
                            onclick="toggleFAQ('faq1')">
                        <span>Apa itu Badan Informasi Geospasial (BIG)?</span>
                        <svg id="icon-faq1" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="faq1" class="mt-2 text-gray-600 hidden">
                        <p class="text-justify">Badan Informasi Geospasial (BIG) adalah lembaga pemerintah non-kementerian yang bertugas menyelenggarakan informasi geospasial dasar secara nasional.</p>
                    </div>
                </div>

                <div class="border-b border-gray-200 py-4">
                    <button class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800 hover:text-blue-600 focus:outline-none"
                            onclick="toggleFAQ('faq2')">
                        <span>Bagaimana cara mengakses data geospasial dari BIG?</span>
                        <svg id="icon-faq2" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="faq2" class="mt-2 text-gray-600 hidden">
                        <p class="text-justify">Anda dapat mengakses data geospasial melalui portal resmi BIG, seperti <a href="https://tanahair.indonesia.go.id" class="text-blue-600 hover:underline" target="_blank">Tanahair Indonesia</a> atau melalui layanan <a href="https://geoservices.big.go.id" class="text-blue-600 hover:underline" target="_blank">GeoPortal BIG</a>.</p>
                    </div>
                </div>

                <div class="border-b border-gray-200 py-4">
                    <button class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800 hover:text-blue-600 focus:outline-none"
                            onclick="toggleFAQ('faq3')">
                        <span>Apakah data geospasial BIG gratis untuk umum?</span>
                        <svg id="icon-faq3" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="faq3" class="mt-2 text-gray-600 hidden">
                        <p class="text-justify">Sebagian besar data geospasial dasar yang disediakan oleh BIG dapat diakses dan diunduh secara gratis oleh publik untuk berbagai keperluan non-komersial. Namun, ada beberapa data khusus yang mungkin memerlukan registrasi atau permohonan khusus.</p>
                    </div>
                </div>

                <div class="border-b border-gray-200 py-4">
                    <button class="flex justify-between items-center w-full text-left font-semibold text-lg text-gray-800 hover:text-blue-600 focus:outline-none"
                            onclick="toggleFAQ('faq4')">
                        <span>Bagaimana cara menghubungi Badan Informasi Geospasial?</span>
                        <svg id="icon-faq4" class="w-6 h-6 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="faq4" class="mt-2 text-gray-600 hidden">
                        <p class="text-justify">Anda bisa mengunjungi halaman "Hubungi Kami" di website resmi BIG untuk informasi kontak, alamat kantor, atau formulir pertanyaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
       <section class="py-16 bg-[#2E86DE] text-white"> {{-- Menggunakan Light Blue dari palet Anda --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Menjelajahi Informasi Geospasial?</h2>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10">
                Temukan kekayaan data, layanan inovatif, dan wawasan geospasial yang Anda butuhkan untuk mendukung pembangunan Indonesia.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('layanan.index') }}" wire:navigate
                   class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-md shadow-lg text-white bg-[#0F3057] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0F3057] transition duration-300 ease-in-out transform hover:-translate-y-1">
                    Jelajahi Layanan Kami
                </a>
                <a href="{{ route('hubungi') }}" wire:navigate
                   class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-base font-bold rounded-md shadow-lg text-white hover:bg-white hover:text-[#2E86DE] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition duration-300 ease-in-out transform hover:-translate-y-1">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</div>