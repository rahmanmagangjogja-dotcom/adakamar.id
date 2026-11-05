<!-- Modal Tambah Kategori Artikel -->
<div id="addArticleCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddArticleCategoryModal()"></div>

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
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Kategori Artikel
                    </h3>
                    <button type="button" onclick="closeAddArticleCategoryModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('article-categories.store') }}" method="POST" enctype="multipart/form-data"
                    id="addArticleCategoryForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="addName"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Nama Kategori
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="addName"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan nama kategori" required>
                            <span class="text-red-500 text-xs error-message" id="add_name_error"></span>
                        </div>

                        <!-- Slug -->
                        <div>
                            <label for="addSlug"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Slug</label>
                            <input type="text" name="slug" id="addSlug"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Auto-generate dari nama">
                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">Slug akan otomatis terisi dari
                                nama
                                kategori</p>
                            <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="addIsActive"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Status</label>
                            <select name="is_active" id="addIsActive"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <span class="text-red-500 text-xs error-message" id="add_is_active_error"></span>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="addDescription"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Deskripsi</label>
                            <textarea name="description" id="addDescription" rows="3"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan deskripsi kategori"></textarea>
                            <span class="text-red-500 text-xs error-message" id="add_description_error"></span>
                        </div>
                    </div>

                    {{-- ===== FOOTER — GRADIENT ===== --}}
                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700 bg-gradient-to-r from-transparent via-[#F7F9FC]/50 to-transparent dark:via-gray-800/50 -mx-6 px-6 pb-2">
                        <button type="submit"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 w-full sm:w-auto transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Kategori
                        </button>
                        <button type="button" onclick="closeAddArticleCategoryModal()"
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
    function openAddArticleCategoryModal() {
        document.getElementById('addArticleCategoryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addArticleCategoryForm').reset();
        document.querySelectorAll('#addArticleCategoryForm .error-message').forEach(function (el) {
            el.textContent = '';
        });
        setTimeout(function () {
            document.getElementById('addName').focus();
        }, 100);
    }

    function closeAddArticleCategoryModal() {
        document.getElementById('addArticleCategoryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var namaInput = document.getElementById('addName');
        var slugInput = document.getElementById('addSlug');

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
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addArticleCategoryModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddArticleCategoryModal();
            }
        }
    });

    // Click outside to close
    document.querySelector('#addArticleCategoryModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddArticleCategoryModal();
        }
    });
</script>

<style>
    #addArticleCategoryModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addArticleCategoryModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addArticleCategoryModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }
</style>