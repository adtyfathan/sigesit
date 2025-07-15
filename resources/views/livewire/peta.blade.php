<div class="w-full h-full relative"> {{-- Menggunakan w-full dan h-full untuk mengisi slot layout, dan relative untuk posisi tombol fullscreen --}}
    {{-- Container untuk peta --}}
    <div id="mapid" class="w-full h-full"></div> {{-- Peta akan mengisi penuh div ini --}}

    {{-- Tombol Fullscreen --}}
    {{-- Menambahkan border untuk visibilitas dan memastikan z-index tinggi --}}
    <button id="fullscreenButton" class="absolute bottom-4 right-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105 z-[9999] border-2 border-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 0h-4m4 0l-5-5" />
        </svg>
    </button>

    @push('styles')
        {{-- CSS untuk Leaflet tanpa integrity --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
        <style>
            /* Pastikan peta mengisi container div */
            #mapid {
                /* Tidak perlu min-height di sini karena h-full akan bekerja dengan layout h-full */
            }
            /* Style untuk mode fullscreen */
            .map-fullscreen {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 9999; /* Pastikan peta muncul di atas elemen lain */
                background-color: #fff; /* Latar belakang saat fullscreen */
            }
        </style>
    @endpush

    @push('scripts')
        {{-- JavaScript untuk Leaflet --}}
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('livewire:navigated', () => {
                // Inisialisasi peta setelah Livewire selesai memuat atau menavigasi
                var mapContainer = document.getElementById('mapid');
                var mymap = L.map(mapContainer).setView([-6.2088, 106.8456], 13); // Contoh koordinat Jakarta

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mymap);

                // Tambahkan event listener untuk penyesuaian ukuran peta saat jendela diubah ukurannya
                window.addEventListener('resize', function() {
                    mymap.invalidateSize();
                });

                // Logika Fullscreen
                var fullscreenButton = document.getElementById('fullscreenButton');

                if (fullscreenButton) { // Pastikan tombol ditemukan sebelum menambahkan event listener
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
                document.addEventListener('fullscreenchange', function() {
                    mymap.invalidateSize();
                });
                document.addEventListener('mozfullscreenchange', function() {
                    mymap.invalidateSize();
                });
                document.addEventListener('webkitfullscreenchange', function() {
                    mymap.invalidateSize();
                });
                document.addEventListener('msfullscreenchange', function() {
                    mymap.invalidateSize();
                });
            });
        </script>
    @endpush
</div>
