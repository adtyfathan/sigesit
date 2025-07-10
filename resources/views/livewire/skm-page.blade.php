<div>
    {{-- Konten halaman SKM --}}
    <section class="py-16 bg-white"> {{-- Membungkus konten dalam section yang konsisten --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Laporan Lengkap Survei Kepuasan Masyarakat (SKM)</h1>
            <p class="text-lg text-gray-600 mb-10">
                Halaman ini menyajikan detail dan statistik mendalam dari hasil survei kepuasan masyarakat.
                Informasi ini kami gunakan untuk terus meningkatkan kualitas pelayanan kami.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-12">
                {{-- Kartu Ringkasan Periode Terakhir (Mirip Home) --}}
                <div class="bg-indigo-50 p-6 rounded-lg shadow-md flex flex-col justify-center transform hover:scale-105 transition duration-300">
                    <p class="text-5xl font-bold text-indigo-700 mb-2">87.5</p>
                    <p class="text-xl font-semibold text-gray-800">Indeks Kepuasan Masyarakat (IKM)</p>
                    <p class="text-md text-gray-600 mt-2">Kategori: <span class="font-bold text-green-700">Sangat Baik</span></p>
                    <p class="text-sm text-gray-500 mt-4">
                        Total Responden: <span class="font-medium">1.500</span><br>
                        Periode: <span class="font-medium">Januari - Juni 2025</span>
                    </p>
                </div>

                {{-- Kartu Detail Aspek Layanan (Mirip Home dengan sedikit penyesuaian) --}}
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

            {{-- Bagian Analisis Tren (Grafik Chart.js) --}}
            <div class="bg-white p-8 rounded-lg shadow-md mb-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-left">Analisis Tren Kepuasan Masyarakat</h3>
                <div class="relative h-96"> {{-- Tambahkan relative dan h-96 untuk tinggi grafik --}}
                    <canvas id="skmTrendChart"></canvas>
                </div>
            </div>

            {{-- Bagian Data Responden / Komentar (opsional, bisa Anda isi dari database) --}}
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
                            @php
                                $dummyRespondents = [
                                    ['SKM-001', '2025-01-15', 'Pelayanan Dokumen', 88, 'Pelayanan cepat dan ramah.'],
                                    ['SKM-002', '2025-02-20', 'Informasi Publik', 82, 'Informasi cukup jelas, perlu ditingkatkan respons.'],
                                    ['SKM-003', '2025-03-10', 'Pengaduan', 91, 'Respon sangat baik dan solutif.'],
                                    ['SKM-004', '2025-04-05', 'Pelayanan Online', 79, 'Website agak lambat, tapi pelayanan oke.'],
                                    ['SKM-005', '2025-05-22', 'Konsultasi', 93, 'Konsultan sangat membantu dan berpengetahuan luas.'],
                                ];
                            @endphp

                            @foreach($dummyRespondents as $respondent)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $respondent[0] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $respondent[1] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $respondent[2] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-700 font-bold">{{ $respondent[3] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $respondent[4] }}</td> {{-- Truncate jika komentar terlalu panjang --}}
                            </tr>
                            @endforeach
                            {{-- Ganti @foreach($dummyRespondents as $respondent) dengan @foreach($this->respondentData as $respondent) jika Anda mengambil data dari komponen --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('home') }}" class="mt-12 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                <svg class="ml-2 -mr-0.5 h-5 w-5 rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Rotate icon for back --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </section>

    @push('scripts')
    {{-- Import Chart.js library --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:navigated', () => { // Gunakan event ini untuk Livewire 3
            const ctx = document.getElementById('skmTrendChart');

            // Hancurkan chart sebelumnya jika ada, untuk menghindari duplikasi saat navigasi Livewire
            if (window.skmChartInstance) {
                window.skmChartInstance.destroy();
            }

            // Pastikan canvas ada sebelum inisialisasi chart
            if (ctx) {
                window.skmChartInstance = new Chart(ctx, { // Simpan instance di window agar bisa dihancurkan
                    type: 'line', // Jenis grafik: garis
                    data: {
                        labels: @json($chartLabels), // Data label dari komponen Livewire
                        datasets: [{
                            label: 'Rata-rata IKM Bulanan',
                            data: @json($chartData), // Data nilai dari komponen Livewire
                            borderColor: '#4f46e5', // Warna garis (indigo-600)
                            backgroundColor: 'rgba(79, 70, 229, 0.2)', // Warna area di bawah garis
                            tension: 0.3, // Kehalusan garis (0 = lurus, 1 = sangat halus)
                            fill: true, // Mengisi area di bawah garis
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
                        maintainAspectRatio: false, // Penting untuk mengontrol tinggi dengan h-96
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
                                min: 60, // Atur batas bawah yang masuk akal
                                max: 100 // Batas atas maksimum
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