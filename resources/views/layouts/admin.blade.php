<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <livewire:layout.admin-navigation />

        <!-- Main Layout Container -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside
                class="bg-white border-r border-gray-200 w-80 flex flex-col fixed lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-30 h-screen lg:h-auto"
                id="sidebar">
                <!-- Navigation Menu -->
                <div class="flex-1 overflow-y-auto">
                    <nav class="p-4 space-y-2">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard.index') }}" wire:navigate
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.produk.index') }}" wire:navigate
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <span>Produk</span>
                        </a>

                        <a href="{{ route('admin.berita.index') }}" wire:navigate
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <span>Berita</span>
                        </a>

                        <a href="{{ route('admin.akun.index') }}" wire:navigate
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <span>Akun</span>
                        </a>

                        <a href="{{ route('admin.kategori.index') }}" wire:navigate
                            class="flex items-center gap-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <span>Kategori</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Mobile sidebar overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden" id="sidebar-overlay"
                style="display: none;"></div>

            <!-- Main Content Area -->
            <div class="flex-1 lg:ml-0 flex flex-col min-h-0">
                <main class="flex-1 p-4 lg:p-6 min-h-0">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Mobile sidebar toggle script -->
    <script>
        // Mobile sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.style.display = 'block';
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.style.display = 'none';
            }
        }

        // Close sidebar when clicking overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function () {
            toggleSidebar();
        });

        // Handle window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebar-overlay').style.display = 'none';
            }
        });
    </script>
</body>

</html>