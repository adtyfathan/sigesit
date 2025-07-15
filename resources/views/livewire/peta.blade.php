<div class="w-full h-full relative z-0"> {{-- Tambahkan kelas 'z-0' di sini --}}
    <div id="mapid" class="w-full h-full"></div> {{-- Peta akan mengisi penuh div ini --}}

    {{-- Tombol Fullscreen --}}
    <button id="fullscreenButton" class="absolute bottom-4 right-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105 z-[9999] border-2 border-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 0h-4m4 0l-5-5" />
        </svg>
    </button>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
        <style>
            /* Tidak ada perubahan z-index di sini, karena sudah diatur di div parent */
            #mapid {
                /* Pastikan peta mengisi container div */
            }
            .map-fullscreen {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 9999; /* Ini z-index untuk mode fullscreen */
                background-color: #fff;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('livewire:navigated', () => {
                var mapContainer = document.getElementById('mapid');
                
                // Penting: Hancurkan instance peta yang lama jika sudah ada
                // Ini mencegah masalah duplikasi peta saat navigasi Livewire
                if (window.leafletMapInstance) {
                    window.leafletMapInstance.remove(); // Gunakan .remove() untuk instance Leaflet
                }

                // Jika container peta tidak ditemukan (misal sudah navigasi ke halaman lain), hentikan inisialisasi
                if (!mapContainer) {
                    return;
                }

                var mymap = L.map(mapContainer).setView([-6.2088, 106.8456], 13); // Contoh koordinat Jakarta

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mymap);

                // Simpan instance peta secara global agar bisa diakses dan dihancurkan di kemudian hari
                window.leafletMapInstance = mymap; 

                // Tambahkan event listener untuk penyesuaian ukuran peta saat jendela diubah ukurannya
                window.addEventListener('resize', function() {
                    mymap.invalidateSize();
                });

                // Logika Fullscreen
                var fullscreenButton = document.getElementById('fullscreenButton');

                if (fullscreenButton) {
                    fullscreenButton.addEventListener('click', function() {
                        if (!document.fullscreenElement) {
                            // Masuk mode fullscreen
                            if (mapContainer.requestFullscreen) {
                                mapContainer.requestFullscreen();
                            } else if (mapContainer.mozRequestFullScreen) { /* Firefox */
                                mapContainer.mozRequestFullScreen();
                            } else if (mapContainer.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                                mapContainer.webkitRequestFullscreen();
                            } else if (mapContainer.msRequestFullscreen) { /* IE/Edge */
                                mapContainer.msRequestFullscreen();
                            }
                        } else {
                            // Keluar mode fullscreen
                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.mozCancelFullScreen) { /* Firefox */
                                document.mozCancelFullScreen();
                            } else if (document.webkitExitFullscreen) { /* Chrome, Safari & Opera */
                                document.webkitExitFullScreen();
                            } else if (document.msExitFullscreen) { /* IE/Edge */
                                document.msExitFullscreen();
                            }
                        }
                    });
                } else {
                    console.error("Tombol fullscreen tidak ditemukan di DOM.");
                }

                // Perbarui ukuran peta saat masuk/keluar fullscreen
                document.addEventListener('fullscreenchange', function() { mymap.invalidateSize(); });
                document.addEventListener('mozfullscreenchange', function() { mymap.invalidateSize(); });
                document.addEventListener('webkitfullscreenchange', function() { mymap.invalidateSize(); });
                document.addEventListener('msfullscreenchange', function() { mymap.invalidateSize(); });
            });
        </script>
    @endpush
</div>