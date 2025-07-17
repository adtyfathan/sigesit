<div>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Laporan Lengkap Survei Kepuasan Masyarakat (SKM)</h1>
            <p class="text-lg text-gray-600 mb-10">
                Halaman ini menyajikan detail dan statistik mendalam dari hasil survei kepuasan masyarakat.
                Informasi ini kami gunakan untuk terus meningkatkan kualitas pelayanan kami.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-12">
                <div class="bg-indigo-50 p-6 rounded-lg shadow-md flex flex-col justify-center transform hover:scale-105 transition duration-300">
                    <p class="text-5xl font-bold text-indigo-700 mb-2">87.5</p>
                    <p class="text-xl font-semibold text-gray-800">Indeks Kepuasan Masyarakat (IKM)</p>
                    <p class="text-md text-gray-600 mt-2">Kategori: <span class="font-bold text-green-700">Sangat Baik</span></p>
                    <p class="text-sm text-gray-500 mt-4">
                        Total Responden: <span class="font-medium">1.500</span><br>
                        Periode: <span class="font-medium">Januari - Juni 2025</span>
                    </p>
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

            {{-- TOMBOL KE FORM SURVEI --}}
            <div class="mt-8 mb-12 flex justify-center">
                <a href="#form-survei-section" class="inline-flex items-center px-6 py-3 border border-indigo-600 text-base font-medium rounded-md shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Isi Survei Kepuasan Anda
                </a>
            </div>
            {{-- END TOMBOL KE FORM SURVEI --}}

            <div class="bg-white p-8 rounded-lg shadow-md mb-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-left">Analisis Tren Kepuasan Masyarakat</h3>
                <div class="relative h-96">
                    <canvas id="skmTrendChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md mb-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-left">Detail Responden & Masukan</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Responden</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori Layanan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentRespondents as $respondent)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SKM-{{ str_pad($respondent->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($respondent->survey_date)->translatedFormat('d F Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $respondent->service_aspect }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-700 font-bold">{{ $respondent->ikm_score }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $respondent->comment ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada data survei.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Form Survei Kepuasan Masyarakat --}}
            <div id="form-survei-section" class="bg-indigo-50 p-8 rounded-lg shadow-lg mb-12 text-left">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Isi Survei Kepuasan Anda</h2>
                <p class="text-lg text-gray-600 mb-8 text-center">
                    Bantu kami meningkatkan kualitas layanan dengan memberikan masukan Anda.
                </p>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Terjadi Kesalahan!</strong>
                        <span class="block sm:inline">Mohon periksa kembali input Anda.</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('skm.submit_survey') }}" method="POST">
                    @csrf {{-- CSRF Token untuk keamanan Laravel --}}

                    <div class="mb-6">
                        <label for="ikm_score" class="block text-gray-700 text-base font-semibold mb-2">
                            1. Berapa nilai kepuasan Anda secara keseluruhan terhadap layanan kami? (Skala 0-100)
                        </label>
                        {{-- Menggunakan input type="number" untuk nilai 0-100 --}}
                        <input type="number" id="ikm_score" name="ikm_score" min="0" max="100" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('ikm_score') border-red-500 @enderror" placeholder="Contoh: 85" value="{{ old('ikm_score') }}">
                        @error('ikm_score')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="service_aspect" class="block text-gray-700 text-base font-semibold mb-2">
                            2. Layanan mana yang Anda gunakan atau berikan penilaian?
                        </label>
                        <select id="service_aspect" name="service_aspect" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('service_aspect') border-red-500 @enderror">
                            <option value="">Pilih Aspek Layanan</option>
                            <option value="Informasi Publik" {{ old('service_aspect') == 'Informasi Publik' ? 'selected' : '' }}>Informasi Publik</option>
                            <option value="Pengaduan" {{ old('service_aspect') == 'Pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                            <option value="Pelayanan Online" {{ old('service_aspect') == 'Pelayanan Online' ? 'selected' : '' }}>Pelayanan Online</option>
                            <option value="Konsultasi" {{ old('service_aspect') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                            <option value="Lainnya" {{ old('service_aspect') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('service_aspect')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="comment" class="block text-gray-700 text-base font-semibold mb-2">
                            3. Berikan komentar atau saran tambahan Anda (opsional):
                        </label>
                        <textarea id="comment" name="comment" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') border-red-500 @enderror" placeholder="Tulis masukan Anda di sini...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            Kirim Survei
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('livewire:navigated', () => {
            const ctx = document.getElementById('skmTrendChart');
            if (window.skmChartInstance) {
                window.skmChartInstance.destroy();
            }

            if (ctx) {
                window.skmChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Rata-rata IKM Bulanan',
                            data: @json($chartData),
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.2)',
                            tension: 0.3,
                            fill: true,
                            pointBackgroundColor: '#4f46e5',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: '#4f46e5',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += context.parsed.y + '%';
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                title: {
                                    display: true,
                                    text: 'Nilai IKM Rata-rata (%)'
                                },
                                min: 60,
                                max: 100
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan dan Tahun'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</div>