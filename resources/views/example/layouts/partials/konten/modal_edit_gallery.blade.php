<!-- Modal Edit Galeri -->
<div id="editGalleryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditGalleryModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                </div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative flex items-center justify-between">
                    <h3 class="text-lg sm:text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Galeri
                    </h3>
                    <button type="button" onclick="closeEditGalleryModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4">
                <form action="#" method="POST" enctype="multipart/form-data" id="editGalleryForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editId">

                        <!-- Judul -->
                        <div>
                            <label for="editTitle"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="editTitle"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF]/50 text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan judul galeri" required maxlength="255">
                            <span class="text-red-500 text-xs error-message block mt-1" id="edit_title_error"></span>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="editImageUpload"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">
                                Gambar <span class="text-xs font-normal text-[#687176] dark:text-gray-400">(opsional — kosongkan jika tidak ingin ganti)</span>
                            </label>

                            <!-- Flag untuk hapus gambar -->
                            <input type="hidden" name="remove_image" id="editRemoveImage" value="0">

                            <!-- Preview Image -->
                            <div id="editImagePreviewContainer" class="hidden relative w-full mb-3">
                                {{-- Container dengan aspect ratio agar gambar tidak gepeng --}}
                                <div class="relative w-full bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700 rounded-lg overflow-hidden border-2 border-[#B3E0FF] dark:border-gray-600"
                                    style="aspect-ratio: 16 / 9;">
                                    <img id="editImagePreview" src="#" alt="Preview Gambar"
                                        class="absolute inset-0 w-full h-full object-cover">
                                </div>

                                {{-- Info file + tombol hapus --}}
                                <div class="mt-2 flex items-center justify-between gap-2">
                                    <div class="flex-1 min-w-0 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span id="editImageFileName" class="truncate max-w-[150px] sm:max-w-[200px] inline-block">Gambar saat ini</span>
                                            <span class="opacity-60 hidden sm:inline">|</span>
                                            <span id="editImageFileSize" class="whitespace-nowrap"></span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removeEditImage()"
                                        class="flex-shrink-0 bg-red-600 text-white rounded-lg w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg"
                                        title="Hapus gambar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Badge status gambar --}}
                                <div id="editImageBadge"
                                    class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg shadow">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span id="editImageBadgeText">Gambar saat ini</span>
                                </div>
                            </div>

                            <!-- Upload Area -->
                            <div id="editImageUploadArea"
                                class="w-full h-36 border-2 border-dashed rounded-lg cursor-pointer bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-[#B3E0FF] hover:from-[#D6ECFF] hover:to-[#E6F4FF] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                <label for="editImageUpload"
                                    class="flex flex-col items-center justify-center w-full h-full cursor-pointer px-3">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 text-sm text-[#687176] dark:text-gray-400">
                                            <span class="font-semibold text-[#0194F3] dark:text-[#33ADFF]">Klik untuk upload</span> gambar baru
                                        </p>
                                        <p class="text-xs text-[#687176] dark:text-gray-400">
                                            JPG, JPEG, PNG, GIF, WEBP (Maks. 5 MB)
                                        </p>
                                    </div>
                                    <input type="file" id="editImageUpload" name="image"
                                        accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" class="hidden">
                                </label>
                            </div>

                            <span class="text-red-500 text-xs error-message block mt-1" id="edit_image_error"></span>
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="editSortOrder"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">Urutan</label>
                            <input type="number" name="sort_order" id="editSortOrder"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF]/50 text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Masukkan urutan" min="0">
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">
                                Urutan yang lebih kecil akan tampil lebih dulu
                            </p>
                            <span class="text-red-500 text-xs error-message block mt-1" id="edit_sort_order_error"></span>
                        </div>

                        <!-- Status (Checkbox) -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-gray-300">Status</label>
                            <label for="editIsActive"
                                class="inline-flex items-center gap-2 cursor-pointer select-none">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="editIsActive" value="1" checked
                                    class="w-4 h-4 text-[#0194F3] bg-[#E6F4FF] border-[#B3E0FF] rounded focus:ring-[#0194F3] focus:ring-2 dark:focus:ring-[#33ADFF] dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                <span class="text-sm text-[#0F294D] dark:text-gray-300">Aktifkan galeri</span>
                            </label>
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">
                                Jika tidak dicentang, galeri akan berstatus <span class="font-semibold">Tidak Aktif</span>
                            </p>
                            <span class="text-red-500 text-xs error-message block mt-1" id="edit_is_active_error"></span>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="submit" id="editGallerySubmitBtn"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 transition-all duration-200 w-full sm:w-auto inline-flex items-center justify-center disabled:opacity-60 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="btn-text">Update Galeri</span>
                            <svg class="btn-spinner hidden animate-spin w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="closeEditGalleryModal()"
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
    // ========== STATE ==========
    var editOriginalImage = null;

    // ========== OPEN MODAL ==========
    function openEditGalleryModal(id) {
        var url = '/galeri/' + id + '/edit';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }
                return response.json();
            })
            .then(function (data) {
                if (!data.success) {
                    throw new Error(data.message || 'Gagal memuat data galeri');
                }

                var gallery = data.data;

                // Reset form state
                editOriginalImage = gallery.image || null;
                document.getElementById('editRemoveImage').value = '0';
                document.getElementById('editImageUpload').value = '';

                // Isi field
                document.getElementById('editId').value = gallery.id;
                document.getElementById('editTitle').value = gallery.title || '';
                document.getElementById('editSortOrder').value = gallery.sort_order ?? '';
                document.getElementById('editIsActive').checked = !!gallery.is_active;

                // Preview image
                var previewContainer = document.getElementById('editImagePreviewContainer');
                var preview = document.getElementById('editImagePreview');
                var uploadArea = document.getElementById('editImageUploadArea');
                var fileName = document.getElementById('editImageFileName');
                var fileSize = document.getElementById('editImageFileSize');
                var badge = document.getElementById('editImageBadge');
                var badgeText = document.getElementById('editImageBadgeText');

                if (gallery.image) {
                    var imagePath = gallery.image.replace(/^public\//, '');
                    preview.src = '{{ asset('') }}' + imagePath;
                    fileName.textContent = 'Gambar saat ini';
                    fileSize.textContent = '';
                    badgeText.textContent = 'Gambar saat ini';
                    badge.className = 'absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg shadow';
                    previewContainer.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                } else {
                    previewContainer.classList.add('hidden');
                    uploadArea.classList.remove('hidden');
                }

                // Form action
                document.getElementById('editGalleryForm').action = '/galeri/' + gallery.id;

                // Reset errors & submit button
                document.querySelectorAll('#editGalleryForm .error-message').forEach(function (el) {
                    el.textContent = '';
                });
                resetEditGallerySubmitBtn();

                document.getElementById('editGalleryModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(function (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memuat data galeri: ' + error.message
                });
            });
    }

    function closeEditGalleryModal() {
        document.getElementById('editGalleryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== SUBMIT STATE ==========
    function setEditGallerySubmitLoading(isLoading) {
        var btn = document.getElementById('editGallerySubmitBtn');
        if (!btn) return;
        var text = btn.querySelector('.btn-text');
        var spinner = btn.querySelector('.btn-spinner');
        btn.disabled = isLoading;
        if (isLoading) {
            text.textContent = 'Menyimpan...';
            spinner.classList.remove('hidden');
        } else {
            text.textContent = 'Update Galeri';
            spinner.classList.add('hidden');
        }
    }

    function resetEditGallerySubmitBtn() {
        setEditGallerySubmitLoading(false);
    }

    // ========== IMAGE PREVIEW ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('editImageUpload');
        var previewContainer = document.getElementById('editImagePreviewContainer');
        var preview = document.getElementById('editImagePreview');
        var uploadArea = document.getElementById('editImageUploadArea');
        var fileName = document.getElementById('editImageFileName');
        var fileSize = document.getElementById('editImageFileSize');
        var badge = document.getElementById('editImageBadge');
        var badgeText = document.getElementById('editImageBadgeText');

        // Sesuai controller: max:5120 KB = 5 MB
        var MAX_FILE_SIZE = 5120 * 1024; // 5 MB
        // Sesuai controller: mimes:jpg,jpeg,png,gif,webp
        var VALID_TYPES = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

        if (upload) {
            upload.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (!file) return;

                if (file.size > MAX_FILE_SIZE) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Ukuran file maksimal 5 MB'
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
                    uploadArea.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    badgeText.textContent = 'Gambar baru';
                    // Reset flag remove_image karena user upload baru
                    document.getElementById('editRemoveImage').value = '0';
                };
                reader.readAsDataURL(file);
            });
        }

        // Hapus gambar
        window.removeEditImage = function () {
            var hasOriginalImage = !!editOriginalImage;

            if (hasOriginalImage) {
                // Ada gambar asli → konfirmasi hapus
                Swal.fire({
                    title: 'Hapus gambar?',
                    text: 'Gambar akan dihapus saat Anda menyimpan perubahan. Anda bisa upload gambar baru sebelum menyimpan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#687176',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        doRemoveEditImage();
                    }
                });
            } else {
                // Hanya file baru yang dipilih → hapus tanpa konfirmasi
                doRemoveEditImage();
            }
        };

        function doRemoveEditImage() {
            document.getElementById('editImageUpload').value = '';
            document.getElementById('editImagePreviewContainer').classList.add('hidden');
            document.getElementById('editImageUploadArea').classList.remove('hidden');
            document.getElementById('edit_image_error').textContent = '';

            // Jika ada gambar asli → set flag remove_image = 1
            if (editOriginalImage) {
                document.getElementById('editRemoveImage').value = '1';
            }
        }

        // ========== AJAX SUBMIT (HANDLE 422) ==========
        var form = document.getElementById('editGalleryForm');
        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Reset error
                document.querySelectorAll('#editGalleryForm .error-message').forEach(function (el) {
                    el.textContent = '';
                });

                setEditGallerySubmitLoading(true);

                var formData = new FormData(form);
                var action = form.getAttribute('action');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || formData.get('_token');

                fetch(action, {
                    method: 'POST', // Laravel method spoofing via _method=PUT
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
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
                            var errEl = document.getElementById('edit_' + field + '_error');
                            if (errEl) {
                                errEl.textContent = result.data.errors[field][0];
                            }
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            text: 'Periksa kembali data yang Anda masukkan.'
                        });
                        setEditGallerySubmitLoading(false);
                        return;
                    }

                    if (result.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: result.data.message || 'Galeri berhasil diperbarui.',
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
                        setEditGallerySubmitLoading(false);
                    }
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                    setEditGallerySubmitLoading(false);
                });
            });
        }
    });

    // ========== FORMAT FILE SIZE ==========
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    // ========== CLOSE MODAL ==========
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editGalleryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditGalleryModal();
            }
        }
    });

    document.querySelector('#editGalleryModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditGalleryModal();
        }
    });
</script>

<style>
    #editGalleryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editGalleryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editGalleryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editImagePreviewContainer {
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

    /* Pastikan gambar preview tidak pernah gepeng */
    #editImagePreview {
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }
</style>