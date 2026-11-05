<!-- Modal Edit Artikel -->
<div id="editArticleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditArticleModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">

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
                        Edit Artikel
                    </h3>
                    <button type="button" onclick="closeEditArticleModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form action="#" method="POST" enctype="multipart/form-data" id="editArticleForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editArticleId">

                    <!-- Tab Navigation — GRADIENT ACTIVE -->
                    <div
                        class="mb-6 rounded-xl bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 p-2 shadow-inner">
                        <ul class="flex flex-wrap gap-1 text-sm font-medium text-center" id="editArticleTab"
                            role="tablist">
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30 transition-all duration-200"
                                    data-tab="edit-artikel-utama" role="tab" type="button"
                                    onclick="switchEditArticleTab('edit-artikel-utama')">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                        <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                    </svg>
                                    Informasi Utama
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="edit-artikel-media" role="tab" type="button"
                                    onclick="switchEditArticleTab('edit-artikel-media')">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Media
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="edit-artikel-seo" role="tab" type="button"
                                    onclick="switchEditArticleTab('edit-artikel-seo')">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
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
                        <div id="edit-artikel-utama" class="edit-article-tab-content">
                            <h4
                                class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                Informasi Artikel
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Judul -->
                                <div class="sm:col-span-2">
                                    <label for="editTitle"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Judul
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="editTitle"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan judul artikel" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="sm:col-span-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="editSlug"
                                            class="text-sm font-medium text-[#0F294D] dark:text-white">Slug</label>
                                        <button type="button" onclick="generateEditSlugFromTitle()"
                                            class="text-xs text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#B3E0FF] font-medium">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                            Generate dari Judul
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="editSlug"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">Biarkan kosong untuk
                                        auto-generate atau edit sesuai keinginan</p>
                                    <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="editCategory"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="editCategory" required
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_category_id_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="editStatus"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select name="status" id="editStatus" required
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                        <option value="Draft">Draft</option>
                                        <option value="Published">Published</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_status_error"></span>
                                </div>

                                <!-- Published At -->
                                <div>
                                    <label for="editPublishedAt"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Tanggal
                                        Publikasi</label>
                                    <input type="date" name="published_at" id="editPublishedAt"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_published_at_error"></span>
                                </div>

                                <!-- Excerpt -->
                                <div class="sm:col-span-2">
                                    <label for="editExcerpt"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Ringkasan</label>
                                    <textarea name="excerpt" id="editExcerpt" rows="2"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan ringkasan artikel"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_excerpt_error"></span>
                                </div>

                                <!-- Content -->
                                <div class="sm:col-span-2">
                                    <label for="editContent"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Konten
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="content" id="editContent" rows="6"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan konten artikel" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_content_error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Media (Thumbnail) -->
                        <div id="edit-artikel-media" class="edit-article-tab-content hidden">
                            <h4
                                class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                Thumbnail
                            </h4>
                            <p class="text-sm text-[#687176] dark:text-gray-400 mb-3">Kosongkan jika tidak ingin
                                mengganti thumbnail</p>
                            <div class="flex flex-col items-center">
                                <!-- Preview Image -->
                                <div id="editThumbnailPreviewContainer" class="hidden relative w-full">
                                    <img id="editThumbnailPreview" src="#" alt="Preview Thumbnail"
                                        class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                    <div
                                        class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                        <span id="editThumbnailFileName"></span>
                                        <span class="mx-2">|</span>
                                        <span id="editThumbnailFileSize"></span>
                                    </div>
                                    <button type="button" onclick="removeEditThumbnail()"
                                        class="absolute top-2 right-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center transition-all shadow-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
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

                                <!-- Upload Area -->
                                <div id="editThumbnailUploadArea"
                                    class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-[#B3E0FF] hover:from-[#B3E0FF] hover:to-[#E6F4FF] dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:hover:border-[#33ADFF] transition-colors">
                                    <label for="editThumbnailUpload"
                                        class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="mb-1 text-sm text-[#687176] dark:text-gray-400">
                                                <span class="font-semibold text-[#0194F3]">Klik untuk upload</span>
                                                thumbnail baru
                                            </p>
                                            <p class="text-xs text-[#687176] dark:text-gray-400">PNG, JPG, WEBP (Maks.
                                                100MB)</p>
                                        </div>
                                        <input type="file" id="editThumbnailUpload" name="thumbnail" accept="image/*"
                                            class="hidden">
                                    </label>
                                </div>

                                <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                            </div>
                        </div>

                        <!-- Tab 3: SEO -->
                        <div id="edit-artikel-seo" class="edit-article-tab-content hidden">
                            <h4
                                class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                SEO (Search Engine Optimization)
                            </h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editMetaTitle"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Meta
                                        Title</label>
                                    <input type="text" name="meta_title" id="editMetaTitle"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Meta Title">
                                    <span class="text-red-500 text-xs error-message" id="edit_meta_title_error"></span>
                                </div>
                                <div>
                                    <label for="editMetaDescription"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Meta
                                        Description</label>
                                    <textarea name="meta_description" id="editMetaDescription" rows="2"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Meta Description"></textarea>
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_description_error"></span>
                                </div>
                                <div>
                                    <label for="editMetaKeywords"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Meta
                                        Keywords</label>
                                    <input type="text" name="meta_keywords" id="editMetaKeywords"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Meta Keywords (pisahkan dengan koma)">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_meta_keywords_error"></span>
                                </div>
                            </div>
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
                            Update Artikel
                        </button>
                        <button type="button" onclick="closeEditArticleModal()"
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
    // ========== KONSTANTA BATAS UKURAN ==========
    var EDIT_ARTICLE_MAX_IMAGE_SIZE = 104857600; // 100 MB
    var EDIT_ARTICLE_MAX_IMAGE_SIZE_LABEL = '100 MB';

    // ========== HELPER ==========
    function formatEditArticleFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function isValidEditArticleImageType(file) {
        var validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        return validTypes.indexOf(file.type) !== -1;
    }

    function isValidEditArticleFileSize(file) {
        return file.size <= EDIT_ARTICLE_MAX_IMAGE_SIZE;
    }

    // ========== TAB FUNCTION — GRADIENT ACTIVE ==========
    function switchEditArticleTab(tabId) {
        document.querySelectorAll('.edit-article-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        document.querySelectorAll('#editArticleTab button').forEach(btn => {
            btn.classList.remove(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );
            btn.classList.add(
                'text-[#687176]', 'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );
        });

        const activeBtn = document.querySelector(`#editArticleTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove(
                'text-[#687176]', 'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );
            activeBtn.classList.add(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );
        }
    }

    // ========== OPEN/CLOSE MODAL ==========
    function openEditArticleModal(id) {
        var url = '{{ route('articles.show', '') }}/' + id;

        Swal.fire({
            title: 'Memuat data...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status}`);
                }
                return response.json();
            })
            .then(function (data) {
                Swal.close();

                if (data.success) {
                    var article = data.data;

                    document.getElementById('editArticleId').value = article.id;
                    document.getElementById('editTitle').value = article.title || '';
                    document.getElementById('editSlug').value = article.slug || '';
                    document.getElementById('editCategory').value = article.category_id || '';
                    document.getElementById('editStatus').value = article.status || 'Draft';

                    if (article.published_at) {
                        var date = new Date(article.published_at);
                        var formattedDate = date.getFullYear() + '-' +
                            String(date.getMonth() + 1).padStart(2, '0') + '-' +
                            String(date.getDate()).padStart(2, '0');
                        document.getElementById('editPublishedAt').value = formattedDate;
                    } else {
                        document.getElementById('editPublishedAt').value = '';
                    }

                    document.getElementById('editExcerpt').value = article.excerpt || '';
                    document.getElementById('editContent').value = article.content || '';
                    document.getElementById('editMetaTitle').value = article.meta_title || '';
                    document.getElementById('editMetaDescription').value = article.meta_description || '';
                    document.getElementById('editMetaKeywords').value = article.meta_keywords || '';

                    var previewContainer = document.getElementById('editThumbnailPreviewContainer');
                    var preview = document.getElementById('editThumbnailPreview');
                    var uploadArea = document.getElementById('editThumbnailUploadArea');
                    var fileNameEl = document.getElementById('editThumbnailFileName');
                    var fileSizeEl = document.getElementById('editThumbnailFileSize');

                    document.getElementById('editThumbnailUpload').value = '';

                    if (article.thumbnail) {
                        var thumbnailPath = article.thumbnail.replace(/^public\//, '');
                        preview.src = '{{ asset('') }}' + thumbnailPath;
                        previewContainer.classList.remove('hidden');
                        uploadArea.classList.add('hidden');
                        if (fileNameEl) fileNameEl.textContent = 'Thumbnail saat ini';
                        if (fileSizeEl) fileSizeEl.textContent = '';
                    } else {
                        previewContainer.classList.add('hidden');
                        uploadArea.classList.remove('hidden');
                    }

                    document.getElementById('editArticleForm').action = '{{ route('articles.update', '') }}/' + article.id;

                    document.querySelectorAll('#editArticleForm .error-message').forEach(function (el) {
                        el.textContent = '';
                    });

                    switchEditArticleTab('edit-artikel-utama');

                    document.getElementById('editArticleModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Gagal memuat data artikel'
                    });
                }
            })
            .catch(function (error) {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message
                });
            });
    }

    function closeEditArticleModal() {
        document.getElementById('editArticleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ========== SLUG GENERATOR ==========
    function generateEditSlugFromTitle() {
        const title = document.getElementById('editTitle').value.trim();
        const slugInput = document.getElementById('editSlug');

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Masukkan judul artikel terlebih dahulu'
            });
            document.getElementById('editTitle').focus();
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
        var upload = document.getElementById('editThumbnailUpload');
        var uploadArea = document.getElementById('editThumbnailUploadArea');
        var previewContainer = document.getElementById('editThumbnailPreviewContainer');
        var preview = document.getElementById('editThumbnailPreview');
        var fileName = document.getElementById('editThumbnailFileName');
        var fileSize = document.getElementById('editThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (file) {
                    if (!isValidEditArticleFileSize(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar!',
                            html: 'Ukuran file: <b>' + formatEditArticleFileSize(file.size) + '</b><br>' +
                                'Maksimal yang diizinkan: <b>' + EDIT_ARTICLE_MAX_IMAGE_SIZE_LABEL + '</b>'
                        });
                        this.value = '';
                        return;
                    }
                    if (!isValidEditArticleImageType(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format Tidak Didukung!',
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
                        fileSize.textContent = formatEditArticleFileSize(file.size);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeEditThumbnail = function () {
            document.getElementById('editThumbnailUpload').value = '';
            document.getElementById('editThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('editThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('edit_thumbnail_error').textContent = '';
        };
    });

    // ========== AUTO GENERATE SLUG ==========
    document.addEventListener('DOMContentLoaded', function () {
        var titleInput = document.getElementById('editTitle');
        var slugInput = document.getElementById('editSlug');

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

    // Close modal with Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('editArticleModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditArticleModal();
            }
        }
    });

    document.querySelector('#editArticleModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeEditArticleModal();
        }
    });
</script>

<style>
    #editArticleModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editArticleModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editArticleModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #E6F4FF;
        border-radius: 3px;
    }

    #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #0194F3, #0064D2);
        border-radius: 3px;
    }

    .dark #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #editArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #33ADFF, #0194F3);
    }

    #editThumbnailPreviewContainer {
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