<!-- Modal Detail Artikel -->
<div id="detailArticleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeDetailArticleModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF] flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span id="detailArticleTitle">Detail Artikel</span>
                    </h3>
                    <button type="button" onclick="closeDetailArticleModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <!-- Tab Navigation -->
                <div class="border-b border-[#B3E0FF] dark:border-gray-700 mb-6">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="detailArticleTab"
                        role="tablist">
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg border-[#0194F3] text-[#0194F3] dark:border-[#33ADFF] dark:text-[#33ADFF]"
                                data-tab="detail-artikel-utama" role="tab" type="button"
                                onclick="switchDetailArticleTab('detail-artikel-utama')">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                    <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                </svg>
                                Informasi
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-artikel-konten" role="tab" type="button"
                                onclick="switchDetailArticleTab('detail-artikel-konten')">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z" />
                                </svg>
                                Konten
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-artikel-seo" role="tab" type="button"
                                onclick="switchDetailArticleTab('detail-artikel-seo')">
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
                    <!-- Tab 1: Informasi -->
                    <div id="detail-artikel-utama" class="detail-article-tab-content">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Kolom Kiri: Thumbnail -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd"
                                            d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm2 0v10h8V5H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Thumbnail
                                </label>
                                <img id="detailArticleThumbnail" src="#" alt="Thumbnail"
                                    class="w-full h-56 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600 bg-[#E6F4FF] dark:bg-gray-700">
                            </div>

                            <!-- Kolom Kanan: Informasi -->
                            <div class="space-y-3">
                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Judul
                                        Artikel</label>
                                    <p class="text-gray-900 dark:text-white font-medium text-lg"
                                        id="detailArticleJudul">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</label>
                                    <p class="text-gray-900 dark:text-white font-medium" id="detailArticleKategori">-
                                    </p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</label>
                                    <p id="detailArticleStatus"></p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Penulis</label>
                                    <p class="text-gray-900 dark:text-white font-medium" id="detailArticlePenulis">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal
                                        Publish</label>
                                    <p class="text-gray-900 dark:text-white font-medium" id="detailArticleTanggal">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ringkasan</label>
                                    <p class="text-gray-900 dark:text-white text-sm leading-relaxed"
                                        id="detailArticleExcerpt">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Konten -->
                    <div id="detail-artikel-konten" class="detail-article-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Konten Artikel</h4>
                        <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                            <div class="max-w-none" id="detailArticleContent">
                                <p class="text-gray-500 dark:text-gray-400">Loading...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: SEO -->
                    <div id="detail-artikel-seo" class="detail-article-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">SEO (Search Engine
                            Optimization)</h4>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Meta
                                    Title</label>
                                <p class="text-gray-900 dark:text-white font-medium" id="detailArticleMetaTitle">-</p>
                            </div>

                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Meta
                                    Description</label>
                                <p class="text-gray-900 dark:text-white" id="detailArticleMetaDescription">-</p>
                            </div>

                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Meta
                                    Keywords</label>
                                <p class="text-gray-900 dark:text-white" id="detailArticleMetaKeywords">-</p>
                            </div>

                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <label
                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Slug</label>
                                <p class="text-gray-900 dark:text-white font-mono text-sm" id="detailArticleSlug">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#B3E0FF] dark:border-gray-700">
                <div class="flex justify-end">
                    <button type="button" onclick="closeDetailArticleModal()"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== TAB FUNCTION ==========
    function switchDetailArticleTab(tabId) {
        document.querySelectorAll('.detail-article-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        // Reset semua tab ke state non-aktif
        document.querySelectorAll('#detailArticleTab button').forEach(btn => {
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
        const activeBtn = document.querySelector(`#detailArticleTab button[data-tab="${tabId}"]`);
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
    function openDetailArticleModal(id) {
        const url = '{{ route('articles.show', ':id') }}'.replace(':id', id);

        document.getElementById('detailArticleModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        switchDetailArticleTab('detail-artikel-utama');

        document.getElementById('detailArticleTitle').textContent = 'Loading...';
        const thumbnailImg = document.getElementById('detailArticleThumbnail');
        thumbnailImg.src = '{{ asset('landingpage/home.png') }}';
        thumbnailImg.classList.add('opacity-50');

        document.getElementById('detailArticleContent').innerHTML = '<p class="text-gray-500 dark:text-gray-400">Loading...</p>';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (!data.success) throw new Error('Data artikel tidak ditemukan.');

                const article = data.data;

                console.log('Data article:', article);

                document.getElementById('detailArticleTitle').textContent = 'Detail Artikel';
                document.getElementById('detailArticleJudul').textContent = article.title || '-';

                document.getElementById('detailArticleKategori').textContent = article.category_name || article.category?.name || '-';
                document.getElementById('detailArticlePenulis').textContent = article.author_name || article.user?.name || '-';
                document.getElementById('detailArticleTanggal').textContent = article.published_at_formatted || article.published_at || '-';
                document.getElementById('detailArticleExcerpt').textContent = article.excerpt || '-';

                const statusText = article.status || 'Draft';
                const statusColors = {
                    'Published': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'Draft': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                };
                document.getElementById('detailArticleStatus').innerHTML = `
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusColors[statusText] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'}">
                    ${statusText}
                </span>
            `;

                thumbnailImg.classList.remove('opacity-50');
                if (article.thumbnail) {
                    let thumbnailPath = article.thumbnail.replace(/^public\//, '');
                    thumbnailImg.src = '{{ asset('') }}' + thumbnailPath;
                } else {
                    thumbnailImg.src = '{{ asset('landingpage/home.png') }}';
                }

                const contentContainer = document.getElementById('detailArticleContent');
                if (article.content) {
                    contentContainer.innerHTML = article.content;
                } else {
                    contentContainer.innerHTML = '<p class="text-gray-400 dark:text-gray-500">Tidak ada konten</p>';
                }

                document.getElementById('detailArticleMetaTitle').textContent = article.meta_title || '-';
                document.getElementById('detailArticleMetaDescription').textContent = article.meta_description || '-';
                document.getElementById('detailArticleMetaKeywords').textContent = article.meta_keywords || '-';
                document.getElementById('detailArticleSlug').textContent = article.slug || '-';

            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('detailArticleTitle').textContent = 'Error!';
                thumbnailImg.classList.remove('opacity-50');

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data artikel: ' + error.message,
                    timer: 3000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    closeDetailArticleModal();
                }, 3000);
            });
    }

    function closeDetailArticleModal() {
        document.getElementById('detailArticleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('detailArticleModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeDetailArticleModal();
            }
        }
    });

    document.querySelector('#detailArticleModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeDetailArticleModal();
    });
</script>

<style>
    #detailArticleModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #detailArticleModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #detailArticleModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #detailArticleModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #detailArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    #detailArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #detailArticleModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #detailArticleModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
    }

    #detailArticleStatus .inline-flex {
        animation: fadeIn 0.3s ease-out;
    }

    #detailArticleThumbnail.opacity-50 {
        opacity: 0.5;
        transition: opacity 0.3s ease;
    }

    /* ===== Prose styling untuk konten artikel ===== */
    #detailArticleContent {
        font-size: 0.875rem;
        line-height: 1.7;
        color: #374151;
        /* text-gray-700 light */
    }

    .dark #detailArticleContent {
        color: #e5e7eb;
        /* text-gray-200 dark — kontras di bg gray-700/50 */
    }

    #detailArticleContent h1,
    #detailArticleContent h2,
    #detailArticleContent h3,
    #detailArticleContent h4,
    #detailArticleContent h5,
    #detailArticleContent h6 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: #111827;
        /* text-gray-900 */
    }

    .dark #detailArticleContent h1,
    .dark #detailArticleContent h2,
    .dark #detailArticleContent h3,
    .dark #detailArticleContent h4,
    .dark #detailArticleContent h5,
    .dark #detailArticleContent h6 {
        color: #ffffff;
    }

    #detailArticleContent h1 {
        font-size: 1.5rem;
    }

    #detailArticleContent h2 {
        font-size: 1.25rem;
    }

    #detailArticleContent h3 {
        font-size: 1.125rem;
    }

    #detailArticleContent p {
        margin-bottom: 1rem;
        color: inherit;
    }

    #detailArticleContent strong,
    #detailArticleContent b {
        color: #111827;
        font-weight: 700;
    }

    .dark #detailArticleContent strong,
    .dark #detailArticleContent b {
        color: #ffffff;
    }

    #detailArticleContent em,
    #detailArticleContent i {
        font-style: italic;
    }

    #detailArticleContent ul,
    #detailArticleContent ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }

    #detailArticleContent ul {
        list-style-type: disc;
    }

    #detailArticleContent ol {
        list-style-type: decimal;
    }

    #detailArticleContent li {
        margin-bottom: 0.25rem;
        color: inherit;
    }

    #detailArticleContent li::marker {
        color: #0194F3;
    }

    .dark #detailArticleContent li::marker {
        color: #33ADFF;
    }

    #detailArticleContent img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }

    #detailArticleContent blockquote {
        border-left: 4px solid #0194F3;
        padding-left: 1rem;
        margin: 1rem 0;
        font-style: italic;
        color: #4b5563;
    }

    .dark #detailArticleContent blockquote {
        color: #d1d5db;
        border-left-color: #33ADFF;
    }

    #detailArticleContent a {
        color: #0194F3;
        text-decoration: underline;
    }

    .dark #detailArticleContent a {
        color: #33ADFF;
    }

    #detailArticleContent code {
        background: #f3f4f6;
        padding: 0.15rem 0.4rem;
        border-radius: 0.25rem;
        font-size: 0.85em;
        color: #db2777;
    }

    .dark #detailArticleContent code {
        background: #374151;
        color: #f472b6;
    }

    #detailArticleContent pre {
        background: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1rem 0;
    }

    .dark #detailArticleContent pre {
        background: #111827;
    }

    #detailArticleContent pre code {
        background: transparent;
        color: inherit;
        padding: 0;
    }

    #detailArticleContent hr {
        border: none;
        height: 1px;
        background: #e5e7eb;
        margin: 1.5rem 0;
    }

    .dark #detailArticleContent hr {
        background: #4b5563;
    }

    #detailArticleContent table {
        width: 100%;
        border-collapse: collapse;
        margin: 1rem 0;
    }

    #detailArticleContent table th,
    #detailArticleContent table td {
        border: 1px solid #e5e7eb;
        padding: 0.5rem 0.75rem;
        text-align: left;
        color: inherit;
    }

    .dark #detailArticleContent table th,
    .dark #detailArticleContent table td {
        border-color: #4b5563;
    }

    #detailArticleContent table th {
        background-color: #f9fafb;
        font-weight: 600;
        color: #111827;
    }

    .dark #detailArticleContent table th {
        background-color: #374151;
        color: #ffffff;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>