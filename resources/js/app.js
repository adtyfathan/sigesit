import './bootstrap';
import 'leaflet';
import Chart from 'chart.js/auto';
import moment from 'moment';

window.Chart = Chart;

//SKM
window.toggleFAQ = function(id) {
    const answer = document.getElementById(id);
    const icon = document.getElementById(`icon-${id}`);

    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        answer.classList.add('block'); // Show the answer
        icon.classList.remove('rotate-0');
        icon.classList.add('rotate-180'); // Rotate arrow up
    } else {
        answer.classList.remove('block');
        answer.classList.add('hidden'); // Hide the answer
        icon.classList.remove('rotate-180');
        icon.classList.add('rotate-0'); // Rotate arrow down
    }
};

//Peta
const INITIAL_CENTER = [-6.2088, 106.8456];
const INITIAL_ZOOM = 13;

function initializeMap() {
    var mapContainer = document.getElementById('mapid');
    
    if (!mapContainer) {
        if (window.leafletMapInstance) {
            window.leafletMapInstance.remove();
            window.leafletMapInstance = null;
        }
        return;
    }

    if (window.leafletMapInstance) {
        window.leafletMapInstance.remove(); 
        window.leafletMapInstance = null;
    }

    var mymap = L.map(mapContainer).setView(INITIAL_CENTER, INITIAL_ZOOM);

    // Definisikan layer dasar yang berbeda untuk tombol Layer Toggle
    var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    // Tambahkan layer OSM secara default
    osmLayer.addTo(mymap);
    var currentBaseLayer = 'osm'; // Untuk melacak layer aktif

    window.leafletMapInstance = mymap; 

    window.addEventListener('resize', function() {
        mymap.invalidateSize();
    });

    // --- LOGIKA TOMBOL INTERAKTIF ---

    // Logika Fullscreen
    var fullscreenButton = document.getElementById('fullscreenButton');
    if (fullscreenButton) {
        fullscreenButton.addEventListener('click', function() {
            if (!document.fullscreenElement) {
                if (mapContainer.requestFullscreen) mapContainer.requestFullscreen();
                else if (mapContainer.mozRequestFullScreen) mapContainer.mozRequestFullScreen();
                else if (mapContainer.webkitRequestFullscreen) mapContainer.webkitRequestFullscreen();
                else if (mapContainer.msRequestFullscreen) mapContainer.msRequestFullscreen();
            } else {
                if (document.exitFullscreen) document.exitFullscreen();
                else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
                else if (document.webkitExitFullscreen) document.webkitExitFullScreen();
                else if (document.msExitFullscreen) document.msExitFullscreen();
            }
        });
    } else {
        console.error("Tombol fullscreen tidak ditemukan di DOM.");
    }

    // Logika Tombol Reset View
    var resetViewButton = document.getElementById('resetViewButton');
    if (resetViewButton) {
        resetViewButton.addEventListener('click', function() {
            if (window.leafletMapInstance) {
                window.leafletMapInstance.setView(INITIAL_CENTER, INITIAL_ZOOM);
            } else {
                console.error("Instance peta tidak ditemukan.");
            }
        });
    } else {
        console.error("Tombol reset view tidak ditemukan di DOM.");
    }


    // Logika Tombol Layer (BARU)
    var toggleLayerButton = document.getElementById('toggleLayerButton');
    if (toggleLayerButton) {
        toggleLayerButton.addEventListener('click', function() {
            if (window.leafletMapInstance) {
                if (currentBaseLayer === 'osm') {
                    mymap.removeLayer(osmLayer);
                    satelliteLayer.addTo(mymap);
                    currentBaseLayer = 'satellite';
                    console.log("Beralih ke tampilan Satelit.");
                } else {
                    mymap.removeLayer(satelliteLayer);
                    osmLayer.addTo(mymap);
                    currentBaseLayer = 'osm';
                    console.log("Beralih ke tampilan OpenStreetMap.");
                }
            } else {
                console.error("Instance peta tidak ditemukan.");
            }
        });
    } else {
        console.error("Tombol toggle layer tidak ditemukan di DOM.");
    }

    // Logika Tombol Informasi/Identifikasi (BARU)
    var infoButton = document.getElementById('infoButton');
    let isInfoMode = false; // Status mode informasi

    // Fungsi handler klik peta untuk mode informasi
    function onMapClickForInfo(e) {
        if (isInfoMode) {
            L.popup()
                .setLatLng(e.latlng)
                .setContent(`
                    <b>Informasi Lokasi:</b><br>
                    Lintang: ${e.latlng.lat.toFixed(5)}<br>
                    Bujur: ${e.latlng.lng.toFixed(5)}<br>
                    ${e.originalEvent.target.tagName === 'PATH' ? 'Anda mengklik pada fitur (misalnya poligon/garis)!' : 'Anda mengklik pada peta kosong.'}
                    <br><small>Untuk informasi lebih detail, Anda perlu mengintegrasikan data GIS Anda.</small>
                `)
                .openOn(mymap);
            console.log("Klik di:", e.latlng);
        }
    }

    if (infoButton) {
        infoButton.addEventListener('click', function() {
            if (window.leafletMapInstance) {
                isInfoMode = !isInfoMode; // Toggle mode informasi

                if (isInfoMode) {
                    infoButton.classList.add('bg-red-500'); // Indikasi aktif
                    mymap.getContainer().style.cursor = 'help'; // Ubah kursor menjadi tanda tanya
                    console.log("Mode informasi aktif. Klik pada peta atau fitur untuk mendapatkan info.");
                    mymap.on('click', onMapClickForInfo);
                } else {
                    infoButton.classList.remove('bg-red-500'); // Indikasi tidak aktif
                    mymap.getContainer().style.cursor = ''; // Kembalikan kursor default
                    console.log("Mode informasi nonaktif.");
                    mymap.off('click', onMapClickForInfo);
                    mymap.closePopup(); // Tutup pop-up info jika ada
                }
            } else {
                console.error("Instance peta tidak ditemukan.");
            }
        });
    } else {
        console.error("Tombol informasi tidak ditemukan di DOM.");
    }

    // --- AKHIR LOGIKA TOMBOL INTERAKTIF ---

    document.addEventListener('fullscreenchange', function() { mymap.invalidateSize(); });
    document.addEventListener('mozfullscreenchange', function() { mymap.invalidateSize(); });
    document.addEventListener('webkitfullscreenchange', function() { mymap.invalidateSize(); });
    document.addEventListener('msfullscreenchange', function() { mymap.invalidateSize(); });

    mymap.invalidateSize();
    
}

    document.addEventListener('DOMContentLoaded', initializeMap);
    document.addEventListener('livewire:navigated', initializeMap);
