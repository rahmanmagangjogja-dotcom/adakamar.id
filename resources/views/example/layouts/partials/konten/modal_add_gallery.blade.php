<!-- Modal Tambah Galeri -->
<div id="addGalleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddGalleryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                </div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative flex items-center justify-between">
                    <h3
                        class="text-lg sm:text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1h1zM7 3a1 1 0 011 1v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4a1 1 0 011-1h2zM10 3a1 1 0 011 1v12a1 1 0 01-1 1H8a1 1 0 01-1-1V4a1 1 0 011-1h2z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Galeri
                    </h3>
                    <button type="button" onclick="closeAddGalleryModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4">
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data"
                    id="addGalleryForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="addTitle" class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="addTitle"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF]/50 text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan judul galeri" required maxlength="255">
                            <span class="text-red-500 text-xs error-message block mt-1" id="add_title_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="addImageUpload"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">
                                Gambar <span class="text-red-500">*</span>
                            </label>

                            <!-- Preview Image -->
                            <div id="addImagePreviewContainer" class="hidden relative w-full mb-3">
                                <div class="relative w-full bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700 rounded-lg overflow-hidden border-2 border-[#B3E0FF] dark:border-gray-600"
                                    style="aspect-ratio: 16 / 9;">
                                    <img id="addImagePreview" src="#" alt="Preview Gambar"
                                        class="absolute inset-0 w-full h-full object-cover">
                                </div>

                                <div class="mt-2 flex items-center justify-between gap-2">
                                    <div class="flex-1 min-w-0 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span id="addImageFileName"
                                                class="truncate max-w-[150px] sm:max-w-[200px] inline-block"></span>
                                            <span class="opacity-60 hidden sm:inline">|</span>
                                            <span id="addImageFileSize" class="whitespace-nowrap"></span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removeAddImage()"
                                        class="flex-shrink-0 bg-red-600 text-white rounded-lg w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg"
                                        title="Hapus gambar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div
                                    class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg shadow">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Siap Diupload
                                </div>
                            </div>

                            <!-- Upload Area -->
                            <div id="addImageUploadArea"
                                class="w-full h-36 border-2 border-dashed rounded-lg cursor-pointer bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-[#B3E0FF] hover:from-[#D6ECFF] hover:to-[#E6F4FF] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="addImageUpload"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer px-3">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-[#687176] dark:text-gray-400">
                                            <span class="font-semibold text-[#0194F3] dark:text-[#33ADFF]">Klik untuk
                                                upload</span> gambar
                                        </p>
                                        <p class="text-xs text-[#687176] dark:text-gray-400">
                                            JPG, JPEG, PNG, GIF, WEBP (Maks. 1 GB)
                                        </p>
                                    </div>
                                    <input type="file" id="addImageUpload" name="image"
                                        accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="hidden"
                                        required>
                                </label>
                            </div>

                            <span class="text-red-500 text-xs error-message block mt-1" id="add_image_error"></span>
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="addSortOrder"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">Urutan</label>
                            <input type="number" name="sort_order" id="addSortOrder"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF]/50 text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan urutan" min="0">
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">
                                Urutan yang lebih kecil akan tampil lebih dulu
                            </p>
                            <span class="text-red-500 text-xs error-message block mt-1"
                                id="add_sort_order_error"></span>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">Status</label>
                            <label for="addIsActive" class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="addIsActive" value="1" checked
                                    class="w-4 h-4 text-[#0194F3] bg-[#E6F4FF] border-[#B3E0FF] rounded focus:ring-[#0194F3] focus:ring-2 dark:focus:ring-[#33ADFF] dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                <span class="text-sm text-[#0F294D] dark:text-gray-300">Aktifkan galeri</span>
                            </label>
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">
                                Jika tidak dicentang, galeri akan berstatus <span class="font-semibold">Tidak
                                    Aktif</span>
                            </p>
                            <span class="text-red-500 text-xs error-message block mt-1" id="add_is_active_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="submit" id="addGallerySubmitBtn"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 transition-all duration-200 w-full sm:w-auto inline-flex items-center justify-center disabled:opacity-60 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="btn-text">Simpan Galeri</span>
                            <svg class="btn-spinner hidden animate-spin w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </button>
                        <button type="button" onclick="closeAddGalleryModal()"
                            class="text-[#0194F3] bg-white border-2 border-[#0194F3] hover:bg-[#0194F3] hover:text-white focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-[#33ADFF] dark:border-[#33ADFF] dark:hover:bg-[#33ADFF] dark:hover:text-white transition-all duration-200 w-full sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== OPEN/CLOSE MODAL ==========
    function openAddGalleryModal() {
        document.getElementById('addGalleryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addGalleryForm').reset();
        document.getElementById('addImagePreviewContainer').classList.add('hidden');
        document.getElementById('addImageUploadArea').classList.remove('hidden');
        document.getElementById('addIsActive').checked = true;
        document.querySelectorAll('#addGalleryForm .error-message').forEach(function (el) {
            el.textContent = '';
        });
        resetAddGallerySubmitBtn();
        setTimeout(function () {
            document.getElementById('addTitle').focus();
        }, 100);
    }

    function closeAddGalleryModal() {
        document.getElementById('addGalleryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== SUBMIT STATE ==========
    function setAddGallerySubmitLoading(isLoading) {
        var btn = document.getElementById('addGallerySubmitBtn');
        if (!btn) return;
        var text = btn.querySelector('.btn-text');
        var spinner = btn.querySelector('.btn-spinner');
        btn.disabled = isLoading;
        if (isLoading) {
            text.textContent = 'Menyimpan...';
            spinner.classList.remove('hidden');
        } else {
            text.textContent = 'Simpan Galeri';
            spinner.classList.add('hidden');
        }
    }

    function resetAddGallerySubmitBtn() {
        setAddGallerySubmitLoading(false);
    }

    // ========== IMAGE PREVIEW & SUBMIT ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('addImageUpload');
        var previewContainer = document.getElementById('addImagePreviewContainer');
        var preview = document.getElementById('addImagePreview');
        var fileName = document.getElementById('addImageFileName');
        var fileSize = document.getElementById('addImageFileSize');

        // Sesuai controller: max:1048576 KB = 1 GB
        var MAX_FILE_SIZE = 1048576 * 1024;
        var VALID_TYPES = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

        if (upload) {
            upload.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (!file) return;

                if (file.size > MAX_FILE_SIZE) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Ukuran file maksimal 1 GB'
                    });
                    this.value = '';
                    return;
                }

                if (VALID_TYPES.indexOf(file.type) === -1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Format file harus JPG, JPEG, PNG, GIF, atau WEBP.'
                    });
                    this.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                    document.getElementById('addImageUploadArea').classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeAddImage = function () {
            document.getElementById('addImageUpload').value = '';
            document.getElementById('addImageUploadArea').classList.remove('hidden');
            document.getElementById('addImagePreviewContainer').classList.add('hidden');
            document.getElementById('add_image_error').textContent = '';
        };

        // ========== AJAX SUBMIT — FIX DOUBLE SUBMIT ==========
        var form = document.getElementById('addGalleryForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                // ⚠️⚠️⚠️ INI KUNCI PERBAIKANNYA ⚠️⚠️⚠️
                // Tanpa 2 baris ini, form akan submit 2x:
                // 1. via AJAX (fetch)
                // 2. via native browser (karena tombol type="submit")
                e.preventDefault();
                e.stopPropagation();

                // Reset error
                document.querySelectorAll('#addGalleryForm .error-message').forEach(function (el) {
                    el.textContent = '';
                });

                setAddGallerySubmitLoading(true);

                var formData = new FormData(form);
                var action = form.getAttribute('action');

                fetch(action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token')
                    },
                    body: formData
                })
                    .then(function (response) {
                        return response.json().then(function (data) {
                            return { status: response.status, data: data };
                        });
                    })
                    .then(function (result) {
                        if (result.status === 422 && result.data.errors) {
                            Object.keys(result.data.errors).forEach(function (field) {
                                var errEl = document.getElementById('add_' + field + '_error');
                                if (errEl) {
                                    errEl.textContent = result.data.errors[field][0];
                                }
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: 'Periksa kembali data yang Anda masukkan.'
                            });
                            setAddGallerySubmitLoading(false);
                            return;
                        }

                        if (result.data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: result.data.message || 'Galeri berhasil ditambahkan.',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function () {
                                window.location.href = '{{ route('galleries.index') }}';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: result.data.message || 'Terjadi kesalahan.'
                            });
                            setAddGallerySubmitLoading(false);
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menyimpan data.'
                        });
                        setAddGallerySubmitLoading(false);
                    });
            });
        }
    });

    // ========== FORMAT FILE SIZE ==========
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        if (bytes < 1024 * 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addGalleryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddGalleryModal();
            }
        }
    });

    document.querySelector('#addGalleryModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddGalleryModal();
        }
    });
</script>

<style>
    #addGalleryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addGalleryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addGalleryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addImagePreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .error-message {
        display: block;
    }

    #addImagePreview {
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }
</style>