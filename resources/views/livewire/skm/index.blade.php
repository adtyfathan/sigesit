<div class="min-h-screen bg-gray-50">
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📊 Survey Kepuasan Masyarakat</h1>
                    <p class="mt-2 text-gray-600">Visualisasi hasil survey kepuasan layanan peta digital</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium text-blue-600">Total Survey: {{ count($skmDatas) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @php
$skmDatasCollection = collect($skmDatas);

// Menghitung rata-rata dari 4 skor aspek
$avgFasilitas = round($skmDatasCollection->avg('skor_fasilitas'), 1);
$avgPetugas = round($skmDatasCollection->avg('skor_petugas'), 1);
$avgAksesibilitas = round($skmDatasCollection->avg('skor_aksesibilitas'), 1);
$avgPengiriman = round($skmDatasCollection->avg('skor_pengiriman'), 1);


$kepuasanOverall = [
    'kurang' => 0,
    'cukup' => 0,
    'puas' => 0,
    'sangat_puas' => 0,
];

foreach ($skmDatasCollection as $data) {
    // Perbarui logika untuk menghitung skor_layanan
    $calculatedLayanan = (isset($data->skor_fasilitas) && isset($data->skor_petugas) && isset($data->skor_aksesibilitas) && isset($data->skor_pengiriman))
        ? ($data->skor_fasilitas + $data->skor_petugas + $data->skor_aksesibilitas + $data->skor_pengiriman) / 4
        : 0;

    $kepuasanLayanan = '';
    if ($calculatedLayanan > 8) {
        $kepuasanLayanan = 'sangat puas';
    } elseif ($calculatedLayanan > 6) {
        $kepuasanLayanan = 'puas';
    } elseif ($calculatedLayanan > 4) {
        $kepuasanLayanan = 'cukup';
    } else {
        $kepuasanLayanan = 'kurang';
    }

    switch ($kepuasanLayanan) {
        case 'kurang':
            $kepuasanOverall['kurang']++;
            break;
        case 'cukup':
            $kepuasanOverall['cukup']++;
            break;
        case 'puas':
            $kepuasanOverall['puas']++;
            break;
        case 'sangat puas':
            $kepuasanOverall['sangat_puas']++;
            break;
    }
}

// Hitung rata-rata bulanan
$getMonthlyAverages = function ($scoreColumn) use ($skmDatasCollection) {
    return $skmDatasCollection->groupBy(function ($data) {
        if (isset($data->tanggal_survey) && !empty($data->tanggal_survey)) {
            try {
                return \Carbon\Carbon::parse($data->tanggal_survey)->format('Y-m');
            } catch (\Exception $e) {
                return 'invalid-date';
            }
        }
        return 'no-date';
    })->filter(function ($group, $key) {
        return $key !== 'invalid-date' && $key !== 'no-date';
    })->map(function ($group) use ($scoreColumn) {
        $validScores = $group->filter(function ($item) use ($scoreColumn) {
            return isset($item->$scoreColumn) && is_numeric($item->$scoreColumn);
        })->pluck($scoreColumn);
        return $validScores->count() > 0 ? round($validScores->avg(), 1) : null;
    })->filter();
};

$rawMonthlyFasilitasScores = $getMonthlyAverages('skor_fasilitas');
$rawMonthlyPetugasScores = $getMonthlyAverages('skor_petugas');
$rawMonthlyAksesibilitasScores = $getMonthlyAverages('skor_aksesibilitas');
$rawMonthlyPengirimanScores = $getMonthlyAverages('skor_pengiriman');

$trendLabels = [];
$trendFasilitasData = [];
$trendPetugasData = [];
$trendAksesibilitasData = [];
$trendPengirimanData = [];


// Generate semua bulan dalam rentang yang ditentukan
$startDateForChart = \Carbon\Carbon::create(2025, 1, 1)->startOfMonth();
$endDateForChart = \Carbon\Carbon::create(2025, 12, 1)->endOfMonth();
$currentMonth = $startDateForChart->copy();
while ($currentMonth->lessThanOrEqualTo($endDateForChart)) {
    $monthKey = $currentMonth->format('Y-m');
    $trendLabels[] = $currentMonth->format('M Y');

    $trendFasilitasData[] = $rawMonthlyFasilitasScores->get($monthKey);
    $trendPetugasData[] = $rawMonthlyPetugasScores->get($monthKey);
    $trendAksesibilitasData[] = $rawMonthlyAksesibilitasScores->get($monthKey);
    $trendPengirimanData[] = $rawMonthlyPengirimanScores->get($monthKey);


    $currentMonth->addMonth();
}
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Fasilitas</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $avgFasilitas }}<span
                                class="text-lg text-gray-500">/10</span></p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-green-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ ($avgFasilitas / 10) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Petugas</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $avgPetugas }}<span
                                class="text-lg text-gray-500">/10</span></p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-purple-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ ($avgPetugas / 10) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-100 to-orange-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Aksesibilitas</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $avgAksesibilitas }}<span
                                class="text-lg text-gray-500">/10</span></p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-orange-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ ($avgAksesibilitas / 10) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zM10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>


                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pengiriman</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $avgPengiriman }}<span
                                class="text-lg text-gray-500">/10</span></p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div class="bg-red-600 h-2 rounded-full transition-all duration-300"
                                style="width: {{ ($avgPengiriman / 10) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Seberapa Puas Anda dengan Layanan Kami?</h2>
                <div class="relative h-64">
                    <canvas id="overallSatisfactionChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Perbandingan Rata-rata Skor Aspek Layanan</h2>
                <div class="relative h-64">
                    <canvas id="aspectsComparisonChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Tren Rata-rata Skor Kepuasan (Aspek)</h2>
            <div class="relative h-96">
                <canvas id="satisfactionTrendChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('livewire:navigated', function() {
        const skmData = {
            kepuasanOverall: @json($kepuasanOverall),
            avgFasilitas: {{ $avgFasilitas }},
            avgPetugas: {{ $avgPetugas }},
            avgAksesibilitas: {{ $avgAksesibilitas }},
            avgPengiriman: {{ $avgPengiriman }},
            trendLabels: @json($trendLabels),
            trendFasilitasData: @json($trendFasilitasData),
            trendPetugasData: @json($trendPetugasData),
            trendAksesibilitasData: @json($trendAksesibilitasData),
            trendPengirimanData: @json($trendPengirimanData)
        };

        // --- Custom Plugin untuk Menampilkan Persentase (Tanpa Plugin Eksternal) ---
        const percentageTextPlugin = {
            id: 'percentageTextPlugin',
            afterDraw: function(chart) {
                if (chart.config.type !== 'doughnut' && chart.config.type !== 'pie') {
                    return;
                }

                const data = chart.data.datasets[0].data;
                const total = data.reduce((sum, val) => sum + val, 0);

                if (total === 0) return;

                const ctx = chart.ctx;
                ctx.save();
                
                // Dapatkan titik pusat chart area
                const xCenter = (chart.chartArea.left + chart.chartArea.right) / 2;
                const yCenter = (chart.chartArea.top + chart.chartArea.bottom) / 2;
                
                // Iterasi melalui setiap elemen data (slice)
                chart.getDatasetMeta(0).data.forEach((element, index) => {
                    const value = data[index];
                    if (value === 0) return;

                    const percentage = (value / total * 100).toFixed(1);
                    const label = percentage + '%';
                    
                    // Hitung sudut tengah (mid-angle)
                    const angle = element.startAngle + (element.endAngle - element.startAngle) / 2;
                    
                    // Tentukan radius untuk posisi teks (di tengah tebalnya donut)
                    const outerRadius = element.outerRadius;
                    const innerRadius = element.innerRadius; 
                    const radius = (outerRadius + innerRadius) / 2;
                    
                    // Hitung posisi (x, y) final
                    const finalX = xCenter + radius * Math.cos(angle);
                    const finalY = yCenter + radius * Math.sin(angle);

                    // --- PENYESUAIAN GAYA TULISAN DI SINI ---
                    ctx.fillStyle = '#fff'; // Warna Teks: Putih
                    
                    // MENGHAPUS BOLD: Ganti 'bold 14px Arial' menjadi hanya '12px Arial'
                    ctx.font = '12px Arial'; 
                    
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    
                    // MENGURANGI KETEBALAN OUTLINE: Ganti lineWidth dari 2 menjadi 1 atau hapus
                    ctx.strokeStyle = '#333'; // Ganti warna outline menjadi abu-abu gelap
                    ctx.lineWidth = 1; // Kurangi ketebalan outline menjadi 1
                    
                    // Gambar outline teks
                    ctx.strokeText(label, finalX, finalY);

                    // Gambar teks
                    ctx.fillText(label, finalX, finalY);
                    // ----------------------------------------
                });

                ctx.restore();
            }
        };

        // Daftarkan plugin kustom
        Chart.register(percentageTextPlugin);


        // 1. Overall Satisfaction Donut Chart
        const overallSatisfactionCtx = document.getElementById('overallSatisfactionChart');
        if (overallSatisfactionCtx) {
            new Chart(overallSatisfactionCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Kurang', 'Cukup', 'Puas', 'Sangat Puas'],
                    datasets: [{
                        data: [
                            skmData.kepuasanOverall.kurang,
                            skmData.kepuasanOverall.cukup,
                            skmData.kepuasanOverall.puas,
                            skmData.kepuasanOverall.sangat_puas
                        ],
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
                            position: 'bottom',
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
        }

        // 2. Bar Chart for Specific Aspects
        const aspectsComparisonCtx = document.getElementById('aspectsComparisonChart');
        if (aspectsComparisonCtx) {
            new Chart(aspectsComparisonCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Fasilitas', 'Petugas', 'Aksesibilitas', 'Pengiriman'],
                    datasets: [{
                        label: 'Rata-rata Skor /10',
                        data: [skmData.avgFasilitas, skmData.avgPetugas, skmData.avgAksesibilitas, skmData.avgPengiriman],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(239, 68, 68, 0.7)'
                        ],
                        borderColor: [
                            'rgba(34, 197, 94, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(249, 115, 22, 1)',
                            'rgba(239, 68, 68, 1)'
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
                            max: 10,
                            title: {
                                display: true,
                                text: 'Skor'
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

        // 3. Satisfaction Trend Line Chart
        const satisfactionTrendCtx = document.getElementById('satisfactionTrendChart');
        if (satisfactionTrendCtx) {
            new Chart(satisfactionTrendCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: skmData.trendLabels,
                    datasets: [
                        {
                            label: 'Rata-rata Fasilitas',
                            data: skmData.trendFasilitasData,
                            borderColor: 'rgb(34, 197, 94)',
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Rata-rata Petugas',
                            data: skmData.trendPetugasData,
                            borderColor: 'rgb(168, 85, 247)',
                            backgroundColor: 'rgba(168, 85, 247, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Rata-rata Aksesibilitas',
                            data: skmData.trendAksesibilitasData,
                            borderColor: 'rgb(249, 115, 22)',
                            backgroundColor: 'rgba(249, 115, 22, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Rata-rata Pengiriman',
                            data: skmData.trendPengirimanData,
                            borderColor: 'rgb(239, 68, 68)',
                            backgroundColor: 'rgba(239, 68, 68, 0.2)',
                            tension: 0.1,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 7
                        }
                    ]
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
        }
    });
</script>