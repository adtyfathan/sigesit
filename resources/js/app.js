import './bootstrap';
import Chart from 'chart.js/auto';
import moment from 'moment'; // Pastikan moment.js terinstal dan digunakan jika diperlukan di bagian lain kode Anda

console.log(moment().format('MMMM Do YYYY, h:mm:ss a'));
// SKM - Chart Logic
document.addEventListener('DOMContentLoaded', function() {
    if (typeof window.skmData === 'undefined') {
        console.warn("window.skmData is not defined. Chart data will be missing.");
        return;
    }

    // DESTURCTURING DATA BARU: Ambil semua data tren yang baru
    const { 
        kepuasanOverall, 
        avgFasilitas, avgPetugas, avgAksesibilitas, 
        trendLabels, 
        trendTotalData, // Variabel baru
        trendFasilitasData, // Variabel baru
        trendPetugasData, // Variabel baru
        trendAksesibilitasData // Variabel baru
    } = window.skmData;

    // 1. Overall Satisfaction Donut Chart
    const overallSatisfactionCtx = document.getElementById('overallSatisfactionChart');
    if (overallSatisfactionCtx) {
        new Chart(overallSatisfactionCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Kurang', 'Cukup', 'Puas', 'Sangat Puas'],
                datasets: [{
                    data: [
                        kepuasanOverall.kurang,
                        kepuasanOverall.cukup,
                        kepuasanOverall.puas,
                        kepuasanOverall.sangat_puas
                    ],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)', // Red for Kurang
                        'rgba(251, 191, 36, 0.8)', // Yellow for Cukup
                        'rgba(34, 197, 94, 0.8)', // Green for Puas
                        'rgba(59, 130, 246, 0.8)' // Blue for Sangat Puas
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
    }

    // 2. Bar Chart for Specific Aspects
    const aspectsComparisonCtx = document.getElementById('aspectsComparisonChart');
    if (aspectsComparisonCtx) {
        new Chart(aspectsComparisonCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Fasilitas', 'Petugas', 'Aksesibilitas'],
                datasets: [{
                    label: 'Rata-rata Skor /10',
                    data: [avgFasilitas, avgPetugas, avgAksesibilitas],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(249, 115, 22, 0.7)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(168, 85, 247, 1)',
                        'rgba(249, 115, 22, 1)'
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

    // NEW & IMPROVED: 3. Satisfaction Trend Line Chart (Multiple Lines)
    const satisfactionTrendCtx = document.getElementById('satisfactionTrendChart');
    if (satisfactionTrendCtx) {
        new Chart(satisfactionTrendCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Rata-rata Skor Total',
                        data: trendTotalData,
                        borderColor: 'rgb(75, 192, 192)', // Biru Cyan
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1,
                        fill: false,
                        pointRadius: 5,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Rata-rata Fasilitas',
                        data: trendFasilitasData,
                        borderColor: 'rgb(34, 197, 94)', // Hijau Fasilitas
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        tension: 0.1,
                        fill: false,
                        pointRadius: 4,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Rata-rata Petugas',
                        data: trendPetugasData,
                        borderColor: 'rgb(168, 85, 247)', // Ungu Petugas
                        backgroundColor: 'rgba(168, 85, 247, 0.2)',
                        tension: 0.1,
                        fill: false,
                        pointRadius: 4,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Rata-rata Aksesibilitas',
                        data: trendAksesibilitasData,
                        borderColor: 'rgb(249, 115, 22)', // Oranye Aksesibilitas
                        backgroundColor: 'rgba(249, 115, 22, 0.2)',
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