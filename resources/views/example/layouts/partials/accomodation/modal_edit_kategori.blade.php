<!-- Modal Edit Kategori -->
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

            {{-- ===== HEADER MODAL — GRADIENT ===== --}}
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                {{-- Pattern dots subtle --}}
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                </div>
                {{-- Blob dekoratif --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Kategori
                    </h3>
                    <button type="button" onclick="closeEditModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="#" method="POST" enctype="multipart/form-data" id="editKategoriForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editId">

                        <!-- Nama Kategori -->
                        <div>
                            <label for="editNama"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Nama Kategori
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="editNama"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="edit_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="editSlug"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Slug <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="slug" id="editSlug"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="auto-generate dari nama" required>
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">Slug akan otomatis terisi dari
                                nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                        </div>

                        <!-- Foto dengan Preview -->
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Thumbnail</label>

                            <!-- Preview Image (untuk foto lama) -->
                            <div id="editPreviewContainer" class="hidden relative w-full mb-3">
                                <img id="editPreviewImage" src="#" alt="Preview Foto"
                                    class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                <div
                                    class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                    <span id="editFileName">Foto saat ini</span>
                                    <span class="mx-2">|</span>
                                    <span id="editFileSize"></span>
                                </div>
                                {{-- Badge "Terupload" — biru --}}
                                <div
                                    class="absolute top-2 left-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white text-xs px-2 py-1 rounded-lg shadow-md">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Terupload
                                </div>
                            </div>

                            <!-- Tombol Ganti Foto -->
                            <div id="editButtonContainer" class="hidden mb-3">
                                <button type="button" onclick="triggerEditFileInput()"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] text-white rounded-lg shadow-md shadow-[#0194F3]/30 focus:ring-4 focus:ring-[#B3E0FF] transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Ganti Foto
                                </button>
                                <button type="button" onclick="removeEditImage()"
                                    class="inline-flex items-center px-4 py-2 ml-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg shadow-md focus:ring-4 focus:ring-red-300 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Hapus Foto
                                </button>
                            </div>

                            <!-- Upload Area (hidden by default, muncul saat tombol ganti diklik) -->
                            <div id="editUploadArea"
                                class="hidden w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-[#B3E0FF] hover:from-[#B3E0FF] hover:to-[#E6F4FF] dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:hover:border-[#33ADFF] transition-colors">
                                <label for="editFoto"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-[#687176] dark:text-gray-400">
                                            <span class="font-semibold text-[#0194F3]">Klik untuk upload</span> foto
                                            kategori
                                        </p>
                                        <p class="text-xs text-[#687176] dark:text-gray-400">PNG, JPG, WEBP (Maks. 1 GB)
                                        </p>
                                    </div>
                                    <input type="file" name="thumbnail" id="editFoto" accept="image/*" class="hidden">
                                </label>
                            </div>

                            <!-- Tombol Batal Upload -->
                            <div id="editCancelUploadContainer" class="hidden mt-2">
                                <button type="button" onclick="cancelEditUpload()"
                                    class="text-sm text-[#687176] hover:text-[#0194F3] dark:text-gray-400 dark:hover:text-[#33ADFF] font-medium transition-colors">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal Upload
                                </button>
                            </div>

                            <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="editDeskripsi"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Deskripsi</label>
                            <textarea name="description" id="editDeskripsi" rows="3"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan deskripsi kategori"></textarea>
                            <span class="text-red-500 text-xs error-message" id="edit_description_error"></span>
                        </div>
                    </div>

                    {{-- ===== FOOTER — GRADIENT ===== --}}
                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700 bg-gradient-to-r from-transparent via-[#F7F9FC]/50 to-transparent dark:via-gray-800/50 -mx-6 px-6 pb-2">
                        <button type="submit"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 w-full sm:w-auto transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditModal()"
                            class="text-[#0194F3] bg-white border-2 border-[#0194F3] focus:outline-none hover:bg-[#0194F3] hover:text-white focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-[#33ADFF] dark:border-[#33ADFF] dark:hover:bg-[#33ADFF] dark:hover:text-white w-full sm:w-auto transition-all duration-200">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== PREVIEW IMAGE ==========
    function previewEditImage(file) {
        if (!file) return;

        // Validasi ukuran (1GB)
        if (file.size > 1024 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Ukuran file maksimal 1GB. Silakan pilih file yang lebih kecil.'
            });
            document.getElementById('editFoto').value = '';
            return;
        }

        // Validasi tipe
        var validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (validTypes.indexOf(file.type) === -1) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
            });
            document.getElementById('editFoto').value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function (event) {
            var previewImage = document.getElementById('editPreviewImage');
            var previewContainer = document.getElementById('editPreviewContainer');
            var uploadArea = document.getElementById('editUploadArea');
            var buttonContainer = document.getElementById('editButtonContainer');
            var cancelContainer = document.getElementById('editCancelUploadContainer');
            var fileName = document.getElementById('editFileName');
            var fileSize = document.getElementById('editFileSize');

            previewImage.src = event.target.result;
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            buttonContainer.classList.remove('hidden');

            fileName.textContent = file.name;
            var sizeInKB = (file.size / 1024).toFixed(2);
            if (sizeInKB > 1024) {
                var sizeInMB = sizeInKB / 1024;
                if (sizeInMB > 1024) {
                    fileSize.textContent = (sizeInMB / 1024).toFixed(2) + ' GB';
                } else {
                    fileSize.textContent = sizeInMB.toFixed(2) + ' MB';
                }
            } else {
                fileSize.textContent = sizeInKB + ' KB';
            }
        };
        reader.readAsDataURL(file);
    }

    function removeEditImage() {
        document.getElementById('editFoto').value = '';
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editPreviewContainer').classList.add('hidden');
        document.getElementById('editPreviewImage').src = '#';
        document.getElementById('editButtonContainer').classList.add('hidden');
        document.getElementById('edit_thumbnail_error').textContent = '';
    }

    function triggerEditFileInput() {
        document.getElementById('editFoto').click();
    }

    function cancelEditUpload() {
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editFoto').value = '';
    }

    // ========== SET EXISTING PREVIEW ==========
    function setEditPreviewImage(imageUrl) {
        var previewImage = document.getElementById('editPreviewImage');
        var previewContainer = document.getElementById('editPreviewContainer');
        var uploadArea = document.getElementById('editUploadArea');
        var buttonContainer = document.getElementById('editButtonContainer');
        var cancelContainer = document.getElementById('editCancelUploadContainer');
        var fileName = document.getElementById('editFileName');
        var fileSize = document.getElementById('editFileSize');

        console.log('setEditPreviewImage called with URL:', imageUrl);

        if (imageUrl && imageUrl !== '' && imageUrl !== 'null' && imageUrl !== '#') {
            previewImage.src = imageUrl;
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            buttonContainer.classList.remove('hidden');
            fileName.textContent = 'Foto saat ini';
            fileSize.textContent = '';
            console.log('Preview image set to:', previewImage.src);
        } else {
            uploadArea.classList.add('hidden');
            cancelContainer.classList.add('hidden');
            previewContainer.classList.add('hidden');
            buttonContainer.classList.add('hidden');
            previewImage.src = '#';
            console.log('No image to preview');
        }
    }

    // ========== OPEN EDIT MODAL ==========
    window.openEditKategoriModal = function (id) {
        console.log('Opening edit modal for ID:', id);

        // Reset form
        document.getElementById('editKategoriForm').reset();
        document.getElementById('editUploadArea').classList.add('hidden');
        document.getElementById('editCancelUploadContainer').classList.add('hidden');
        document.getElementById('editPreviewContainer').classList.add('hidden');
        document.getElementById('editButtonContainer').classList.add('hidden');
        document.getElementById('editPreviewImage').src = '#';
        document.querySelectorAll('#editKategoriForm .error-message').forEach(function (el) {
            el.textContent = '';
        });

        var url = '{{ url('/accommodation-categories') }}/' + id + '/edit';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log('Data received:', data);

                if (!data.success) {
                    throw new Error('Data kategori tidak ditemukan.');
                }

                var category = data.data;

                // Isi form
                document.getElementById('editId').value = category.id;
                document.getElementById('editNama').value = category.name || '';
                document.getElementById('editSlug').value = category.slug || '';
                document.getElementById('editDeskripsi').value = category.description || '';

                // Set action form
                document.getElementById('editKategoriForm').action = '{{ url('/accommodation-categories') }}/' + category.id;

                // Reset input file
                document.getElementById('editFoto').value = '';

                // ========== TAMPILKAN PREVIEW GAMBAR LAMA ==========
                console.log('Thumbnail from DB:', category.thumbnail);
                console.log('Thumbnail URL from DB:', category.thumbnail_url);

                var imageUrl = null;

                if (category.thumbnail_url) {
                    imageUrl = category.thumbnail_url;
                } else if (category.thumbnail) {
                    var cleanPath = category.thumbnail.replace(/^public\//, '');
                    imageUrl = '{{ asset('') }}' + cleanPath;
                }

                console.log('Final Image URL:', imageUrl);

                // Set preview image
                setEditPreviewImage(imageUrl);

                // Buka modal
                document.getElementById('editModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(function (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data kategori. Silakan coba lagi.'
                });
            });
    };

    // ========== CLOSE MODAL ==========
    window.closeEditModal = function () {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        removeEditImage();
    };

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var namaInput = document.getElementById('editNama');
        var slugInput = document.getElementById('editSlug');

        if (namaInput && slugInput) {
            namaInput.addEventListener('input', function () {
                var slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            });
        }

        // ========== EVENT LISTENER FOR FILE INPUT ==========
        var fotoInput = document.getElementById('editFoto');
        if (fotoInput) {
            fotoInput.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    previewEditImage(file);
                }
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#editModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
</script>

<style>
    #editModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    /* Upload Area */
    #editUploadArea {
        transition: all 0.3s ease;
    }

    #editUploadArea:hover {
        border-color: #0194F3;
    }

    /* Preview image container */
    #editPreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    #editPreviewImage {
        border: 2px solid #B3E0FF;
        border-radius: 8px;
        object-fit: cover;
        width: 100%;
        height: 192px;
    }

    .dark #editPreviewImage {
        border-color: #374151;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }

    /* Button Container */
    #editButtonContainer {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
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