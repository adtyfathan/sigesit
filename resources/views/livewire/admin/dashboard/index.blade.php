<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-10">
    <div class="bg-white shadow-sm border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Administrator</h1>
                <p class="mt-2 text-sm text-gray-600">Selamat datang kembali {{ auth()->user()->name }}!</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($users) }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-6 2.24-6 5v1h12v-1c0-2.76-2.69-5-6-5z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Pengguna Keseluruhan</span>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Layanan & Produk</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($produks) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-blue-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Layanan tersedia</span>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Kategori</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($kategoris) }}</p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-orange-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Kategori Layanan</span>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Penjualan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($transaksis) }}</p>
                    </div>
                    <div class="bg-emerald-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-emerald-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Total penjualan</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 border border-blue-100 mb-8 mt-8">
            <h2 class="text-2xl font-bold text-gray-900">Visualisasi SKM</h2>
            <p class="text-gray-600 mt-2">Grafik Visualisasi Hasil Survey Kepuasan Masyarakat</p>

            @if ($chartData && count($chartData['kepuasanOverall']) > 0 && array_sum($chartData['kepuasanOverall']) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <div class="min-w-[300px] max-w-full h-96 relative">
                        <h3 class="text-lg font-semibold mb-2">Nilai Rata-rata per Bidang</h3>
                        <canvas id="barChart"></canvas>
                    </div>
                    <div class="min-w-[300px] max-w-full h-96 relative">
                        <h3 class="text-lg font-semibold mb-2">Tren Kepuasan Masyarakat</h3>
                        <canvas id="trenChart"></canvas>
                    </div>
                    <div class="min-w-[300px] max-w-full h-96 relative">
                        <h3 class="text-lg font-semibold mb-2">Distribusi Responden per Layanan</h3>
                        <canvas id="distribusiChart"></canvas>
                    </div>
                    <div class="min-w-[300px] max-w-full h-96 relative">
                        <h3 class="text-lg font-semibold mb-2">Kepuasan Layanan</h3>
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-96">
                    <p class="text-xl text-gray-500">Belum ada data survey untuk ditampilkan.</p>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-8 border border-blue-100 mb-8 mt-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Data SKM</h2>
                <p class="text-gray-600 mt-2">Data Pengisian Survey Kepuasan Masyarakat</p>

                <div class="mt-4 overflow-x-auto relative">
                    <table class="w-full text-sm text-center text-gray-500 mb-4">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nama Pengguna
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Layanan
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Tanggal Pengisian
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nilai Layanan
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nilai Fasilitas
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nilai Petugas
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nilai Aksesibilitas
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nilai Pengiriman
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Komentar
                                </th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach ($skms as $skm)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $skm->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->transaksi->produk->nama_produk }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->created_at->translatedFormat('l, d F Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ round((($skm->skor_fasilitas ?? 0) + ($skm->skor_petugas ?? 0) + ($skm->skor_aksesibilitas ?? 0) + ($skm->skor_pengiriman ?? 0)) / 4, 1) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->skor_fasilitas }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->skor_petugas }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->skor_aksesibilitas }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $skm->skor_pengiriman }}
                                    </td>
                                    <td>
                                        {{ $skm->komentar ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
        
                    {{ $skms->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            const chartData = @json($chartData);

            if (chartData && Object.keys(chartData.kepuasanOverall).length > 0 && Object.values(chartData.kepuasanOverall).reduce((sum, val) => sum + val, 0) > 0) {
                // Bar Chart (Nilai Rata-rata per Bidang)
                const ctxBar = document.getElementById('barChart');
                new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: ['Fasilitas', 'Petugas', 'Aksesibilitas', 'Pengiriman'],
                        datasets: [{
                            label: 'Grafik Hasil Survey per Bidang',
                            data: [chartData.avgFasilitas, chartData.avgPetugas, chartData.avgAksesibilitas, chartData.avgPengiriman],
                            backgroundColor: [
                                'rgba(34, 197, 94, 0.7)',
                                'rgba(168, 85, 247, 0.7)',
                                'rgba(249, 115, 22, 0.7)',
                                'rgba(239, 68, 68, 0.7)'
                            ],
                            borderColor: [
                                'rgb(34, 197, 94)',
                                'rgb(168, 85, 247)',
                                'rgb(249, 115, 22)',
                                'rgb(239, 68, 68)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 10
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Pie Chart (Kepuasan Layanan)
                const ctxPie = document.getElementById('pieChart');
                new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: ['Kurang', 'Cukup', 'Puas', 'Sangat Puas'],
                        datasets: [{
                            label: 'Kepuasan Layanan',
                            data: Object.values(chartData.kepuasanOverall),
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.8)',
                                'rgba(251, 191, 36, 0.8)',
                                'rgba(34, 197, 94, 0.8)',
                                'rgba(59, 130, 246, 0.8)'
                            ],
                            borderColor: [
                                'rgba(239, 68, 68, 1)',
                                'rgba(251, 191, 36, 1)',
                                'rgba(34, 197, 94, 1)',
                                'rgba(59, 130, 246, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const total = tooltipItem.dataset.data.reduce((sum, val) => sum + val, 0);
                                        const currentValue = tooltipItem.raw;
                                        const percentage = parseFloat((currentValue / total * 100).toFixed(1));
                                        return `${tooltipItem.label}: ${currentValue} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });

                // Line Chart (Tren Kepuasan Masyarakat)
                const ctxTren = document.getElementById('trenChart');
                new Chart(ctxTren, {
                    type: 'line',
                    data: {
                        labels: chartData.trendLabels,
                        datasets: [{
                            label: 'Fasilitas',
                            data: chartData.trendFasilitasData,
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        }, {
                            label: 'Petugas',
                            data: chartData.trendPetugasData,
                            borderColor: 'rgb(168, 85, 247)',
                            backgroundColor: 'rgba(168, 85, 247, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        }, {
                            label: 'Aksesibilitas',
                            data: chartData.trendAksesibilitasData,
                            borderColor: 'rgb(249, 115, 22)',
                            backgroundColor: 'rgba(249, 115, 22, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        }, {
                            label: 'Pengiriman',
                            data: chartData.trendPengirimanData,
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 10,
                                title: {
                                    display: true,
                                    text: 'Rata-rata Skor'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }
                    }
                });

                // Bar Chart (Distribusi Responden per Layanan)
                const ctxDistribusi = document.getElementById('distribusiChart');
                new Chart(ctxDistribusi, {
                    type: 'bar',
                    data: {
                        labels: chartData.distribusiLabels,
                        datasets: [{
                            label: 'Grafik Distribusi Responden per Layanan',
                            data: chartData.distribusiDatas,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 206, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(153, 102, 255)',
                                'rgb(255, 159, 64)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Survey'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Nama Layanan'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush