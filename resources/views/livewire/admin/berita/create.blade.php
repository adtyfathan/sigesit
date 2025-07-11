<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Buat Berita Baru</h1>
            <p class="text-lg text-gray-600">Tambahkan artikel berita ke dalam sistem</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                <h2 class="text-2xl font-semibold text-white">Informasi Berita</h2>
            </div>

            <form wire:submit="store" class="p-8 space-y-8">
                <!-- News Title -->
                <div class="space-y-2">
                    <label for="judul" class="block text-sm font-semibold text-gray-700">
                        Judul Berita
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul" wire:model="judul"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400"
                        placeholder="Masukkan judul berita">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="space-y-2">
                    <label for="gambar_berita" class="block text-sm font-semibold text-gray-700">
                        Gambar Berita
                        <span class="text-gray-500 text-sm font-normal">(Opsional)</span>
                    </label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                        <input type="file" id="gambar_berita" wire:model="gambar_berita" class="hidden"
                            accept="image/*">
                        <label for="gambar_berita" class="cursor-pointer">
                            <div class="space-y-3">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-lg font-medium text-gray-700">Klik untuk upload gambar</p>
                                    <p class="text-sm text-gray-500">atau drag & drop file di sini</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF hingga 1MB</p>
                                </div>
                            </div>
                        </label>

                        @if ($gambar_berita)
                            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm font-medium text-blue-700">
                                    File terpilih: {{ $gambar_berita->getClientOriginalName() }}
                                </p>
                            </div>
                        @endif
                    </div>
                    @error('gambar_berita')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- News Content -->
                <div class="space-y-2">
                    <label for="isi_berita" class="block text-sm font-semibold text-gray-700">
                        Isi Berita
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea id="isi_berita" wire:model="isi_berita" rows="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 placeholder-gray-400 resize-none"
                        placeholder="Tulis konten berita di sini..."></textarea>
                    @error('isi_berita')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 border-t border-gray-200 flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Berita
                        </span>
                        <span wire:loading class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>

                    <a href="{{ route('admin.berita.index') }}"
                        class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition-all duration-200 text-center border border-gray-300 hover:border-gray-400"
                        wire:navigate>
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Enhanced drag and drop functionality
    const dropArea = document.querySelector('[wire\\:model="gambar_berita"]').closest('div');
    const fileInput = document.querySelector('#gambar_berita');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropArea.classList.add('border-blue-500', 'bg-blue-50');
    }

    function unhighlight(e) {
        dropArea.classList.remove('border-blue-500', 'bg-blue-50');
    }

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
</script>