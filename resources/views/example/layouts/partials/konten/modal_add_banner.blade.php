<!-- Modal Tambah Banner -->
<div id="addBannerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddBannerModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Tambah Banner Baru
                    </h3>
                    <button type="button" onclick="closeAddBannerModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addBannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="addTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="addTitle"
                                class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan judul banner" required>
                            <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                        </div>

                        <!-- Subjudul -->
                        <div>
                            <label for="addSubtitle"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Subjudul
                            </label>
                            <input type="text" name="subtitle" id="addSubtitle"
                                class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan subjudul banner (opsional)">
                            <span class="text-red-500 text-xs error-message" id="add_subtitle_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Gambar <span class="text-red-500">*</span>
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Format: JPG, JPEG, PNG, WEBP (Maks.
                                1GB)</p>

                            <div id="addImageUploadArea"
                                class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#E6F4FF] border-[#B3E0FF] hover:bg-[#D6ECFF] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="addImageUpload"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik untuk upload</span> gambar
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, JPEG, PNG, WEBP (Maks.
                                            1GB)</p>
                                    </div>
                                    <input type="file" id="addImageUpload" name="image" accept="image/*" class="hidden"
                                        required>
                                </label>
                            </div>

                            <!-- Preview Gambar -->
                            <div id="addImagePreviewContainer" class="hidden relative w-full mt-2">
                                <img id="addImagePreview" src="#" alt="Preview Gambar"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                <div
                                    class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="addImageFileName"></span>
                                    <span class="mx-2">|</span>
                                    <span id="addImageFileSize"></span>
                                </div>
                                <button type="button" onclick="removeAddImage()"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div
                                    class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none">
                                </div>
                                <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terupload
                                </div>
                            </div>
                            <span class="text-red-500 text-xs error-message" id="add_image_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="button" onclick="submitAddBanner()"
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Banner
                        </button>
                        <button type="button" onclick="closeAddBannerModal()"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto">
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
    window.openAddBannerModal = function () {
        const modal = document.getElementById('addBannerModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Reset form
        const form = document.getElementById('addBannerForm');
        form.reset();

        // Reset image
        document.getElementById('addImageUploadArea').classList.remove('hidden');
        document.getElementById('addImagePreviewContainer').classList.add('hidden');
        document.getElementById('addImageUpload').value = '';

        // Reset error messages
        document.querySelectorAll('#addBannerForm .error-message').forEach(el => el.textContent = '');

        setTimeout(() => document.getElementById('addTitle').focus(), 100);
    };

    window.closeAddBannerModal = function () {
        document.getElementById('addBannerModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ========== IMAGE UPLOAD ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('addImageUpload');
        const uploadArea = document.getElementById('addImageUploadArea');
        const previewContainer = document.getElementById('addImagePreviewContainer');
        const preview = document.getElementById('addImagePreview');
        const fileName = document.getElementById('addImageFileName');
        const fileSize = document.getElementById('addImageFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (e.target.files.length > 1) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Hanya boleh upload 1 gambar.'
                    });
                    const firstFile = e.target.files[0];
                    const dt = new DataTransfer();
                    dt.items.add(firstFile);
                    this.files = dt.files;
                }

                if (file) {
                    const maxSize = 1024 * 1024 * 1024; // 1 GB dalam bytes
                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 1GB'
                        });
                        this.value = '';
                        return;
                    }

                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
                        });
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');

                        fileName.textContent = file.name;

                        const sizeInBytes = file.size;
                        const sizeInKB = sizeInBytes / 1024;
                        const sizeInMB = sizeInKB / 1024;
                        const sizeInGB = sizeInMB / 1024;

                        if (sizeInGB >= 1) {
                            fileSize.textContent = sizeInGB.toFixed(2) + ' GB';
                        } else if (sizeInMB >= 1) {
                            fileSize.textContent = sizeInMB.toFixed(2) + ' MB';
                        } else {
                            fileSize.textContent = sizeInKB.toFixed(2) + ' KB';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeAddImage = function () {
            document.getElementById('addImageUpload').value = '';
            document.getElementById('addImageUploadArea').classList.remove('hidden');
            document.getElementById('addImagePreviewContainer').classList.add('hidden');
            document.getElementById('add_image_error').textContent = '';
        };
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddBanner = async function () {
        console.log('=== SUBMIT BANNER ===');

        document.querySelectorAll('#addBannerForm .error-message').forEach(el => el.textContent = '');

        const title = document.getElementById('addTitle').value.trim();
        const image = document.getElementById('addImageUpload').files[0];

        if (!title) {
            document.getElementById('add_title_error').textContent = 'Judul wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Judul wajib diisi' });
            document.getElementById('addTitle').focus();
            return;
        }

        if (!image) {
            document.getElementById('add_image_error').textContent = 'Gambar wajib diupload';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Gambar wajib diupload' });
            return;
        }

        console.log('Validasi berhasil');

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            Swal.fire({ icon: 'error', title: 'Error!', text: 'CSRF token tidak ditemukan.' });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        const form = document.getElementById('addBannerForm');
        const formData = new FormData(form);

        console.log('Data yang dikirim:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + (pair[0] === 'image' ? '[FILE]' : pair[1]));
        }

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            const response = await fetch('{{ route('banners.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            console.log('HTTP Status:', response.status);
            console.log('Content-Type:', response.headers.get('content-type'));

            const contentType = response.headers.get('content-type') || '';

            if (!contentType.includes('application/json')) {
                const text = await response.text();
                console.error('Response bukan JSON:', text.substring(0, 500));
                throw new Error('Server mengembalikan response bukan JSON. Pastikan controller meresponse dengan JSON untuk AJAX request.');
            }

            const data = await response.json();
            console.log('Response JSON:', data);

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Banner berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeAddBannerModal();
                    location.reload();
                });
                return;
            }

            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorEl = document.getElementById('add_' + key + '_error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data.errors[key];
                    }
                });
                const firstError = Object.values(data.errors)[0];
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: Array.isArray(firstError) ? firstError[0] : firstError
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Gagal menambahkan banner'
                });
            }

        } catch (error) {
            console.error('=== ERROR SUBMIT ===', error);

            let errorMessage = 'Terjadi kesalahan: ' + error.message;
            if (error.message.includes('bukan JSON')) {
                errorMessage += '\n\nCoba periksa: \n1. Apakah route sudah benar?\n2. Apakah controller meresponse JSON untuk AJAX?\n3. Coba refresh halaman dan coba lagi.';
            }

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage
            });
        }
    };

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('addBannerModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddBannerModal();
            }
        }
    });

    document.querySelector('#addBannerModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeAddBannerModal();
    });
</script>

<style>
    #addBannerModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addBannerModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addBannerModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addBannerModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #addBannerModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #addBannerModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #addBannerModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addBannerModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
    }

    .error-message {
        margin-top: 4px;
        display: block;
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
</style>