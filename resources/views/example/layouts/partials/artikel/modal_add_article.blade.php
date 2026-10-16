<!-- Modal Tambah Artikel -->
<div id="addArticleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddArticleModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm2 0v10h12V5H4z" />
                            <path d="M6 7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" />
                            <path d="M6 11a1 1 0 011-1h4a1 1 0 110 2H7a1 1 0 01-1-1z" />
                        </svg>
                        Tambah Artikel
                    </h3>
                    <button type="button" onclick="closeAddArticleModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addArticleForm" enctype="multipart/form-data">
                    @csrf
                    <!-- Tab Navigation -->
                    <div class="border-b border-[#B3E0FF] dark:border-gray-700 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="addArticleTab"
                            role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg border-[#0194F3] text-[#0194F3] dark:border-[#33ADFF] dark:text-[#33ADFF]"
                                    data-tab="add-artikel-utama" role="tab" type="button"
                                    onclick="switchAddArticleTab('add-artikel-utama')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                        <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                    </svg>
                                    Informasi Utama
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-artikel-media" role="tab" type="button"
                                    onclick="switchAddArticleTab('add-artikel-media')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Media
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-artikel-seo" role="tab" type="button"
                                    onclick="switchAddArticleTab('add-artikel-seo')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                    SEO
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">
                        <!-- Tab 1: Informasi Utama -->
                        <div id="add-artikel-utama" class="add-article-tab-content">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Informasi Artikel
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Judul -->
                                <div class="sm:col-span-2">
                                    <label for="addTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="addTitle"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan judul artikel" required>
                                    <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="sm:col-span-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="addSlug"
                                            class="text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                        <button type="button" onclick="generateAddSlugFromTitle()"
                                            class="text-xs text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#33ADFF] font-medium">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                            Generate dari Judul
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="addSlug"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong untuk
                                        auto-generate atau edit sesuai keinginan</p>
                                    <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="addCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="addCategory" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_category_id_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="addStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select name="status" id="addStatus" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                        <option value="Draft">Draft</option>
                                        <option value="Published">Published</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_status_error"></span>
                                </div>

                                <!-- Published At -->
                                <div>
                                    <label for="addPublishedAt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                        Publikasi</label>
                                    <input type="date" name="published_at" id="addPublishedAt"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                    <span class="text-red-500 text-xs error-message" id="add_published_at_error"></span>
                                </div>

                                <!-- Excerpt -->
                                <div class="sm:col-span-2">
                                    <label for="addExcerpt"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ringkasan</label>
                                    <textarea name="excerpt" id="addExcerpt" rows="2"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan ringkasan artikel"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_excerpt_error"></span>
                                </div>

                                <!-- Content -->
                                <div class="sm:col-span-2">
                                    <label for="addContent"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konten
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="content" id="addContent" rows="6"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan konten artikel" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_content_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Media (Thumbnail) -->
                        <div id="add-artikel-media" class="add-article-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Thumbnail</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Upload thumbnail artikel (Opsional)
                            </p>
                            <div class="flex flex-col items-center">
                                <!-- Preview Image -->
                                <div id="addThumbnailPreviewContainer" class="hidden relative w-full">
                                    <img id="addThumbnailPreview" src="#" alt="Preview Thumbnail"
                                        class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                    <div
                                        class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <span id="addThumbnailFileName"></span>
                                        <span class="mx-2">|</span>
                                        <span id="addThumbnailFileSize"></span>
                                    </div>
                                    <button type="button" onclick="removeAddThumbnail()"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div
                                        class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none">
                                    </div>
                                    <div
                                        class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                        <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terupload
                                    </div>
                                </div>

                                <!-- Upload Area -->
                                <div id="addThumbnailUploadArea"
                                    class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 border-gray-300 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                    <label for="addThumbnailUpload"
                                        class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Klik untuk upload</span> thumbnail
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks.
                                                5MB)</p>
                                        </div>
                                        <input type="file" id="addThumbnailUpload" name="thumbnail" accept="image/*"
                                            class="hidden">
                                    </label>
                                </div>

                                <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
                            </div>
                        </div>

                        <!-- Tab 3: SEO -->
                        <div id="add-artikel-seo" class="add-article-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">SEO (Search Engine
                                Optimization)</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addMetaTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="addMetaTitle"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="add_meta_title_error"></span>
                                </div>
                                <div>
                                    <label for="addMetaDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="addMetaDescription" rows="2"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_meta_description_error"></span>
                                </div>
                                <div>
                                    <label for="addMetaKeywords"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                        Keywords</label>
                                    <input type="text" name="meta_keywords" id="addMetaKeywords"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Meta Keywords (pisahkan dengan koma)">
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_meta_keywords_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="button" onclick="submitAddArticle()"
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Artikel
                        </button>
                        <button type="button" onclick="closeAddArticleModal()"
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
    // ========== TAB FUNCTION ==========
    function switchAddArticleTab(tabId) {
        document.querySelectorAll('.add-article-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        // Reset semua tab ke state non-aktif
        document.querySelectorAll('#addArticleTab button').forEach(btn => {
            btn.classList.remove(
                'border-[#0194F3]', 'text-[#0194F3]',
                'dark:border-[#33ADFF]', 'dark:text-[#33ADFF]'
            );
            btn.classList.add(
                'border-transparent',
                'text-gray-600', 'hover:text-gray-900', 'hover:border-gray-300',
                'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:border-gray-500'
            );
        });

        // Set tab aktif
        const activeBtn = document.querySelector(`#addArticleTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove(
                'border-transparent',
                'text-gray-600', 'hover:text-gray-900', 'hover:border-gray-300',
                'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:border-gray-500'
            );
            activeBtn.classList.add(
                'border-[#0194F3]', 'text-[#0194F3]',
                'dark:border-[#33ADFF]', 'dark:text-[#33ADFF]'
            );
        }
    }

    // ========== OPEN/CLOSE MODAL ==========
    function openAddArticleModal() {
        document.getElementById('addArticleModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addArticleForm').reset();
        document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
        document.getElementById('addThumbnailUploadArea').classList.remove('hidden');

        document.querySelectorAll('#addArticleForm .error-message').forEach(function (el) {
            el.textContent = '';
        });

        switchAddArticleTab('add-artikel-utama');

        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');
        document.getElementById('addPublishedAt').value = year + '-' + month + '-' + day;

        setTimeout(function () {
            document.getElementById('addTitle').focus();
        }, 100);
    }

    function closeAddArticleModal() {
        document.getElementById('addArticleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== SLUG GENERATOR ==========
    function generateAddSlugFromTitle() {
        const title = document.getElementById('addTitle').value.trim();
        const slugInput = document.getElementById('addSlug');

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Masukkan judul artikel terlebih dahulu'
            });
            document.getElementById('addTitle').focus();
            return;
        }

        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        slugInput.value = slug;

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Slug telah digenerate dari judul artikel',
            timer: 1500,
            showConfirmButton: false
        });
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        var upload = document.getElementById('addThumbnailUpload');
        var uploadArea = document.getElementById('addThumbnailUploadArea');
        var previewContainer = document.getElementById('addThumbnailPreviewContainer');
        var preview = document.getElementById('addThumbnailPreview');
        var fileName = document.getElementById('addThumbnailFileName');
        var fileSize = document.getElementById('addThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 5MB'
                        });
                        this.value = '';
                        return;
                    }
                    var validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (validTypes.indexOf(file.type) === -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
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
                        var sizeInKB = (file.size / 1024).toFixed(2);
                        if (sizeInKB > 1024) {
                            fileSize.textContent = (sizeInKB / 1024).toFixed(2) + ' MB';
                        } else {
                            fileSize.textContent = sizeInKB + ' KB';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeAddThumbnail = function () {
            document.getElementById('addThumbnailUpload').value = '';
            document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('add_thumbnail_error').textContent = '';
        };
    });

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var titleInput = document.getElementById('addTitle');
        var slugInput = document.getElementById('addSlug');

        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                if (slugInput.value === '') {
                    var slug = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddArticle = async function () {
        console.log('=== SUBMIT ARTICLE ===');

        document.querySelectorAll('#addArticleForm .error-message').forEach(el => el.textContent = '');

        // Validasi
        const title = document.getElementById('addTitle').value.trim();
        const category = document.getElementById('addCategory').value;
        const content = document.getElementById('addContent').value.trim();

        if (!title) {
            document.getElementById('add_title_error').textContent = 'Judul wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Judul wajib diisi' });
            document.getElementById('addTitle').focus();
            return;
        }

        if (!category) {
            document.getElementById('add_category_id_error').textContent = 'Kategori wajib dipilih';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kategori wajib dipilih' });
            document.getElementById('addCategory').focus();
            return;
        }

        if (!content) {
            document.getElementById('add_content_error').textContent = 'Konten wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Konten wajib diisi' });
            document.getElementById('addContent').focus();
            return;
        }

        console.log('Validasi berhasil');

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            Swal.fire({ icon: 'error', title: 'Error!', text: 'CSRF token tidak ditemukan.' });
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        const form = document.getElementById('addArticleForm');
        const formData = new FormData(form);

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            const response = await fetch('{{ route('articles.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            console.log('HTTP Status:', response.status);

            const contentType = response.headers.get('content-type') || '';
            let data;

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Response bukan JSON:', text);
                throw new Error(`Server mengembalikan response bukan JSON. HTTP ${response.status}`);
            }

            console.log('Response JSON:', data);

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message || 'Artikel berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeAddArticleModal();
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
                    text: data.message || 'Gagal menambahkan artikel'
                });
            }

        } catch (error) {
            console.error('=== ERROR SUBMIT ===', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan: ' + error.message
            });
        }
    };

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('addArticleModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddArticleModal();
            }
        }
    });

    document.querySelector('#addArticleModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeAddArticleModal();
        }
    });
</script>

<style>
    #addArticleModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addArticleModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addArticleModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
    }

    #addThumbnailPreviewContainer {
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
        margin-top: 4px;
        display: block;
    }
</style>