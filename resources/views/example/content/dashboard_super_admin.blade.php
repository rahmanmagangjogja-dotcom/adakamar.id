@extends('example.layouts.default.dashboard')
@section('content')

    {{-- ===== HEADER DASHBOARD - FIXED (SHADOW, TANPA GARIS) ===== --}}
    <div
        class="fixed top-16 left-0 right-0 z-30 px-4 py-3 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] backdrop-blur-md dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-lg shadow-[#0194F3]/10 dark:shadow-black/40 lg:left-64">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-[#0194F3] sm:text-xl dark:text-[#33ADFF] flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                    Dashboard
                </h1>
                <p class="text-xs text-[#687176] dark:text-gray-400 mt-0.5">Selamat datang di dashboard admin!</p>
            </div>
        </div>
    </div>

    {{-- ===== SPACER ===== --}}
    <div class="h-28"></div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 p-3 sm:p-4">
        <!-- Total Penginapan -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-white via-[#F0F9FF] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300 p-4 sm:p-5 border-l-4 border-[#0194F3] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 dark:border-[#33ADFF]">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-[#687176] dark:text-gray-400 truncate">Total Penginapan</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#0F294D] dark:text-white" id="totalAccommodations">0</p>
                </div>
                <div class="p-2.5 sm:p-3 bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-full shadow-lg shadow-[#0194F3]/30 shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="relative mt-2">
                <span class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-400">Total data penginapan</span>
            </div>
        </div>

        <!-- Total Artikel -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-white via-[#F0F9FF] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-xl hover:shadow-[#33ADFF]/20 transition-all duration-300 p-4 sm:p-5 border-l-4 border-[#33ADFF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 dark:border-[#33ADFF]">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#33ADFF]/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-[#687176] dark:text-gray-400 truncate">Total Artikel</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#0F294D] dark:text-white" id="totalArticles">0</p>
                </div>
                <div class="p-2.5 sm:p-3 bg-gradient-to-br from-[#33ADFF] to-[#0194F3] rounded-full shadow-lg shadow-[#33ADFF]/30 shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="relative mt-2">
                <span class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-400">Total data artikel</span>
            </div>
        </div>

        <!-- Published Artikel -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-white via-[#F0F9FF] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-xl hover:shadow-[#0064D2]/20 transition-all duration-300 p-4 sm:p-5 border-l-4 border-[#0064D2] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 dark:border-[#33ADFF]">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0064D2]/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-[#687176] dark:text-gray-400 truncate">Published Artikel
                    </p>
                    <p class="text-xl sm:text-2xl font-bold text-[#0F294D] dark:text-white" id="publishedArticles">0</p>
                </div>
                <div class="p-2.5 sm:p-3 bg-gradient-to-br from-[#0064D2] to-[#0194F3] rounded-full shadow-lg shadow-[#0064D2]/30 shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="relative mt-2">
                <span class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-400">Artikel yang dipublish</span>
            </div>
        </div>

        <!-- Draft Artikel -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-white via-[#F0F9FF] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300 p-4 sm:p-5 border-l-4 border-[#0194F3]/60 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 dark:border-[#33ADFF]/60">
            <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-[#687176] dark:text-gray-400 truncate">Draft Artikel</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#0F294D] dark:text-white" id="draftArticles">0</p>
                </div>
                <div class="p-2.5 sm:p-3 bg-gradient-to-br from-[#0194F3]/70 to-[#33ADFF] rounded-full shadow-lg shadow-[#0194F3]/20 shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="relative mt-2">
                <span class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-400">Artikel yang masih draft</span>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4 px-3 sm:px-4">
        <div class="relative overflow-hidden bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-lg hover:shadow-[#0194F3]/10 transition-all duration-300 p-4 sm:p-5 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#0194F3]/5 rounded-full blur-3xl pointer-events-none"></div>
            <h3 class="relative text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3 sm:mb-4 flex items-center">
                <svg class="w-4 h-4 mr-2 shrink-0 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
                <span class="truncate">Penginapan per Kategori</span>
            </h3>
            <div class="relative w-full h-56 sm:h-64" id="chartAccommodationCategories">
                <canvas id="accommodationChart"></canvas>
            </div>
        </div>

        <div class="relative overflow-hidden bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-lg hover:shadow-[#0194F3]/10 transition-all duration-300 p-4 sm:p-5 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#33ADFF]/5 rounded-full blur-3xl pointer-events-none"></div>
            <h3 class="relative text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3 sm:mb-4 flex items-center">
                <svg class="w-4 h-4 mr-2 shrink-0 text-[#33ADFF] dark:text-[#33ADFF]" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z" />
                </svg>
                <span class="truncate">Status Penginapan</span>
            </h3>
            <div class="relative w-full h-56 sm:h-64" id="chartStatusAccommodations">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Daftar Penginapan & Artikel Terbaru -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-3 sm:gap-4 p-3 sm:p-4">

        {{-- ===== PENGINAPAN TERBARU ===== --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-lg hover:shadow-[#0194F3]/10 transition-all duration-300 p-4 sm:p-5 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#0194F3]/5 rounded-full blur-3xl pointer-events-none"></div>
            <h3 class="relative text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3 sm:mb-4 flex items-center">
                <svg class="w-4 h-4 mr-2 shrink-0 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="truncate">Penginapan Terbaru</span>
            </h3>

            <div class="relative overflow-x-auto rounded-lg bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm">
                <table class="w-full min-w-[560px] divide-y divide-[#B3E0FF] dark:divide-gray-600">
                    <thead class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700">
                        <tr>
                            <th scope="col"
                                class="w-24 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Foto</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Nama</th>
                            <th scope="col"
                                class="w-32 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Kategori</th>
                            <th scope="col"
                                class="w-24 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#B3E0FF]/40 dark:divide-gray-700"
                        id="recentAccommodations">
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-sm text-[#687176] dark:text-gray-400">
                                Memuat data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===== ARTIKEL TERBARU ===== --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-lg shadow-md hover:shadow-lg hover:shadow-[#0194F3]/10 transition-all duration-300 p-4 sm:p-5 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700">
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#33ADFF]/5 rounded-full blur-3xl pointer-events-none"></div>
            <h3 class="relative text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3 sm:mb-4 flex items-center">
                <svg class="w-4 h-4 mr-2 shrink-0 text-[#33ADFF] dark:text-[#33ADFF]" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                        clip-rule="evenodd" />
                </svg>
                <span class="truncate">Artikel Terbaru</span>
            </h3>

            <div class="relative overflow-x-auto rounded-lg bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm">
                <table class="w-full min-w-[560px] divide-y divide-[#B3E0FF] dark:divide-gray-600">
                    <thead class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700">
                        <tr>
                            <th scope="col"
                                class="w-24 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Foto</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Judul</th>
                            <th scope="col"
                                class="w-32 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Kategori</th>
                            <th scope="col"
                                class="w-24 px-3 py-2 text-left text-[11px] sm:text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#B3E0FF]/40 dark:divide-gray-700"
                        id="recentArticles">
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-sm text-[#687176] dark:text-gray-400">
                                Memuat data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', timer: 3000, showConfirmButton: false });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ============================================================
            // DEBUG MODE — set true untuk lihat log di console
            // ============================================================
            const DEBUG = true;
            const log = (...args) => DEBUG && console.log('[Dashboard]', ...args);

            // ============================================================
            // HELPER: Resolve URL thumbnail — handle SEMUA format
            // ============================================================
            const BASE_URL = "{{ rtrim(asset(''), '/') }}/";
            log('BASE_URL:', BASE_URL);

            const FALLBACK_IMG = "data:image/svg+xml;charset=UTF-8," + encodeURIComponent(
                `<svg xmlns="http://www.w3.org/2000/svg" width="160" height="90" viewBox="0 0 160 90">
                    <rect width="160" height="90" fill="#f3f4f6"/>
                    <g fill="none" stroke="#9ca3af" stroke-width="2">
                        <rect x="55" y="32" width="50" height="30" rx="3"/>
                        <circle cx="67" cy="42" r="4"/>
                        <path d="M58 60l12-12 8 8 6-6 15 10"/>
                    </g>
                    <text x="80" y="80" font-family="sans-serif" font-size="10" fill="#9ca3af" text-anchor="middle">No Image</text>
                </svg>`
            );

            /**
             * Ambil path dari item — handle semua kemungkinan format JSON:
             * - string: "accommodations/foto.jpg"
             * - object: { image: "...", path: "...", url: "..." }
             * - field alternative: thumbnail_url, image, image_path, foto
             */
            function extractImagePath(item) {
                if (!item) return null;
                if (typeof item === 'string') return item;

                // Coba berbagai field yang mungkin
                const candidates = [
                    item.thumbnail,
                    item.image,
                    item.thumbnail_url,
                    item.image_url,
                    item.image_path,
                    item.foto,
                    item.foto_url,
                ];

                for (let c of candidates) {
                    if (!c) continue;
                    if (typeof c === 'string') return c;
                    // Jika object { image: "..." } atau { url: "..." }
                    if (typeof c === 'object') {
                        if (typeof c.image === 'string') return c.image;
                        if (typeof c.url === 'string') return c.url;
                        if (typeof c.path === 'string') return c.path;
                    }
                }
                return null;
            }

            function resolveThumbnail(rawPath) {
                if (!rawPath || typeof rawPath !== 'string') {
                    log('resolveThumbnail: empty/invalid path', rawPath);
                    return FALLBACK_IMG;
                }
                let path = rawPath.trim();
                if (!path) return FALLBACK_IMG;

                // Jika sudah URL absolut
                if (/^https?:\/\//i.test(path)) {
                    log('resolveThumbnail: absolute URL →', path);
                    return path;
                }

                // Jika path mulai dengan 'data:' (base64)
                if (/^data:/i.test(path)) return path;

                // Buang prefix 'public/' berulang & leading slash
                const original = path;
                path = path.replace(/^(?:\/)?public\/+/i, '').replace(/^\/+/, '');

                // Jika path mulai dengan 'storage/' biarkan apa adanya (Laravel storage)
                const finalUrl = BASE_URL + path;
                log('resolveThumbnail:', { original, cleaned: path, finalUrl });
                return finalUrl;
            }

            function escapeAttr(str) {
                return String(str ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            // ============================================================
            // BUILD HTML THUMBNAIL — anti-gepeng & anti-rusak
            // ============================================================
            function buildThumbHtml(item, altText) {
                const rawPath = extractImagePath(item);
                const url = resolveThumbnail(rawPath);
                const alt = escapeAttr(altText || 'Thumbnail');

                // Debug
                log('buildThumbHtml:', { rawPath, url, alt });

                return `
                    <div class="table-thumb">
                        <img src="${url}"
                             alt="${alt}"
                             loading="lazy"
                             decoding="async"
                             onerror="this.onerror=null;this.src='${FALLBACK_IMG}';">
                    </div>
                `;
            }

            // ============================================================
            // FETCH DASHBOARD DATA
            // ============================================================
            fetch('/dashboard', {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dashboardData = data.data;

                        // LOG: Lihat struktur data pertama
                        log('SAMPLE ACCOMMODATION:', dashboardData.accommodations?.[0]);
                        log('SAMPLE ARTICLE:', dashboardData.articles?.[0]);

                        document.getElementById('totalAccommodations').textContent = dashboardData.totalAccommodations || 0;
                        document.getElementById('publishedArticles').textContent = dashboardData.publishedArticles || 0;
                        document.getElementById('totalArticles').textContent = dashboardData.totalArticles || 0;
                        document.getElementById('draftArticles').textContent = dashboardData.draftArticles || 0;

                        renderRecentAccommodations(dashboardData.accommodations || []);
                        renderRecentArticles(dashboardData.articles || []);
                        renderAccommodationChart(dashboardData.accommodations || []);
                        renderStatusChart(dashboardData.accommodations || []);
                    } else {
                        showError('Gagal memuat data dashboard');
                    }
                })
                .catch(error => { console.error('Error:', error); showError('Terjadi kesalahan saat memuat data'); });

            let accommodationChartInstance = null;
            let statusChartInstance = null;

            // ========== CHART: PENGINAPAN PER KATEGORI (LINE CHART) ==========
            function renderAccommodationChart(accommodations) {
                const ctx = document.getElementById('accommodationChart').getContext('2d');
                const categoryMap = {};
                accommodations.forEach(item => {
                    const category = item.category_name || 'Tanpa Kategori';
                    categoryMap[category] = (categoryMap[category] || 0) + 1;
                });
                const labels = Object.keys(categoryMap);
                const values = Object.values(categoryMap);

                const isDark = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#9CA3AF' : '#64748B';
                const gridColor = isDark ? 'rgba(75, 85, 99, 0.2)' : 'rgba(226, 232, 240, 0.8)';

                const gradient = ctx.createLinearGradient(0, 0, 0, 260);
                gradient.addColorStop(0, 'rgba(1, 148, 243, 0.35)');
                gradient.addColorStop(1, 'rgba(1, 148, 243, 0.0)');

                if (accommodationChartInstance) accommodationChartInstance.destroy();
                accommodationChartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Jumlah Penginapan',
                            data: values,
                            borderColor: '#0194F3',
                            backgroundColor: gradient,
                            borderWidth: 3,
                            pointBackgroundColor: '#0194F3',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: '#0194F3',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2,
                            tension: 0.35,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#1F2937' : '#0F172A',
                                titleFont: { size: 12, weight: '600' },
                                bodyFont: { size: 12 },
                                padding: 10,
                                cornerRadius: 6,
                                displayColors: false,
                                callbacks: {
                                    label: function (context) {
                                        return `${context.parsed.y ?? 0} Penginapan`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: gridColor, drawBorder: false },
                                ticks: { stepSize: 1, precision: 0, color: textColor, font: { size: 11 } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { color: textColor, font: { size: 11 }, autoSkip: true, maxRotation: 45, minRotation: 0 }
                            }
                        }
                    }
                });
            }

            // ========== CHART: STATUS PENGINAPAN (DOUGHNUT) ==========
            function renderStatusChart(accommodations) {
                const ctx = document.getElementById('statusChart').getContext('2d');
                const statusCount = { 'Available': 0, 'Full': 0, 'Maintenance': 0 };
                accommodations.forEach(item => { if (item.status && statusCount.hasOwnProperty(item.status)) statusCount[item.status]++; });
                const labels = Object.keys(statusCount);
                const values = Object.values(statusCount);
                const colors = ['#0194F3', '#0064D2', '#33ADFF'];

                if (statusChartInstance) statusChartInstance.destroy();
                statusChartInstance = new Chart(ctx, {
                    type: 'doughnut',
                    data: { labels, datasets: [{ data: values, backgroundColor: colors, borderColor: colors.map(c => c + 'cc'), borderWidth: 1 }] },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15, font: { size: 11 } } } }
                    }
                });
            }

            // ========== RENDER PENGINAPAN TERBARU ==========
            function renderRecentAccommodations(accommodations) {
                const container = document.getElementById('recentAccommodations');

                if (!accommodations || accommodations.length === 0) {
                    container.innerHTML = `
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-sm text-[#687176] dark:text-gray-400">Belum ada penginapan</td>
                            </tr>
                        `;
                    return;
                }

                const statusColors = {
                    'Available': 'bg-[#E6F4FF] text-[#0194F3] dark:bg-[#0194F3]/20 dark:text-[#33ADFF]',
                    'Full': 'bg-[#0194F3]/20 text-[#0064D2] dark:bg-[#0064D2]/30 dark:text-[#33ADFF]',
                    'Maintenance': 'bg-[#E6F4FF]/60 text-[#33ADFF] dark:bg-[#33ADFF]/20 dark:text-[#B3E0FF]'
                };

                container.innerHTML = accommodations.map(accommodation => `
                        <tr class="hover:bg-[#E6F4FF]/60 dark:hover:bg-gray-700/60 transition-colors">
                            <td class="px-3 py-2 sm:py-3 align-middle">
                                ${accommodation.thumbnail
                                    ? `<div style="width:80px;height:45px;min-width:80px;min-height:45px;aspect-ratio:16/9;overflow:hidden;border-radius:0.5rem;background:#f3f4f6;border:1px solid #B3E0FF;flex-shrink:0;">
                                        <img src="{{ asset('') }}${accommodation.thumbnail}"
                                                alt="${accommodation.title}"
                                                loading="lazy"
                                                style="display:block;width:100%;height:100%;object-fit:cover;object-position:center;">
                                    </div>`
                                    : `<div style="width:80px;height:45px;min-width:80px;min-height:45px;aspect-ratio:16/9;background:#e5e7eb;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:10px;flex-shrink:0;">
                                        No Image
                                    </div>`
                                }
                            </td>
                            <td class="px-3 py-2 sm:py-3 text-sm text-[#0F294D] dark:text-white">
                                <div class="group relative max-w-[160px]">
                                    <div class="truncate cursor-pointer">${escapeAttr(accommodation.title || '-')}</div>
                                    <div class="hidden group-hover:block mt-2
                                                w-[350px]
                                                p-3
                                                rounded-lg
                                                bg-white dark:bg-gray-800
                                                border border-[#FFD4D4] dark:border-gray-700
                                                shadow-xl">

                                        <div class="font-semibold text-[#0194F3] mb-1">
                                            Nama
                                        </div>

                                        <div class="text-xs text-gray-600 dark:text-gray-300
                                                    whitespace-normal break-words leading-relaxed">
                                            ${accommodation.description || accommodation.title || '-'}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 sm:py-3 text-sm text-[#687176] dark:text-gray-400">${escapeAttr(accommodation.category_name || '-')}</td>
                            <td class="px-3 py-2 sm:py-3 text-sm">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium ${statusColors[accommodation.status] || 'bg-[#E6F4FF] text-[#0194F3] dark:bg-gray-700 dark:text-gray-300'}">
                                    ${escapeAttr(accommodation.status || '-')}
                                </span>
                            </td>
                        </tr>
                    `).join('');
            }

            // ========== RENDER ARTIKEL TERBARU ==========
            function renderRecentArticles(articles) {
                const container = document.getElementById('recentArticles');

                if (!articles || articles.length === 0) {
                    container.innerHTML = `
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-sm text-[#687176] dark:text-gray-400">Belum ada artikel</td>
                            </tr>
                        `;
                    return;
                }

                container.innerHTML = articles.map(article => `
                        <tr class="hover:bg-[#E6F4FF]/60 dark:hover:bg-gray-700/60 transition-colors">
                            <td class="px-3 py-2 sm:py-3 align-middle">
                                ${buildThumbHtml(article.thumbnail || article, article.title)}
                            </td>
                            <td class="px-3 py-2 sm:py-3 text-sm text-[#0F294D] dark:text-white">
                                <div class="group relative max-w-[160px]">
                                    <div class="truncate cursor-pointer">${escapeAttr(article.title || '-')}</div>
                                    <div class="hidden group-hover:block mt-2
                                                w-[350px]
                                                p-3
                                                rounded-lg
                                                bg-white dark:bg-gray-800
                                                border border-[#FFD4D4] dark:border-gray-700
                                                shadow-xl">

                                        <div class="font-semibold text-[#0194F3] mb-1">
                                            Judul
                                        </div>

                                        <div class="text-xs text-gray-600 dark:text-gray-300
                                                    whitespace-normal break-words leading-relaxed">
                                            ${article.description || article.title || '-'}
                                        </div>
                                    </div> 
                                </div>
                            </td>
                            <td class="px-3 py-2 sm:py-3 text-sm text-[#687176] dark:text-gray-400">${escapeAttr(article.category_name || '-')}</td>
                            <td class="px-3 py-2 sm:py-3 text-sm">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-medium ${article.status === 'Published' ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white' : 'bg-[#E6F4FF] text-[#0194F3] dark:bg-[#0194F3]/20 dark:text-[#33ADFF]'}">
                                    ${escapeAttr(article.status || 'Draft')}
                                </span>
                            </td>
                        </tr>
                    `).join('');
            }

            function showError(message) {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: message, timer: 3000, showConfirmButton: false });
            }
        });
    </script>

    <style>
        .dark .bg-\[\#E6F4FF\] {
            background-color: #1f2937 !important;
        }

        .dark .border-\[\#B3E0FF\] {
            border-color: #374151 !important;
        }

        .dark .text-\[\#0194F3\] {
            color: #33ADFF !important;
        }

        #recentArticles tr:hover,
        #recentAccommodations tr:hover {
            background-color: rgba(230, 244, 255, 0.6);
            transition: background-color 0.2s ease;
        }

        .dark #recentArticles tr:hover,
        .dark #recentAccommodations tr:hover {
            background-color: rgba(55, 65, 81, 0.6);
        }

        #chartAccommodationCategories canvas,
        #chartStatusAccommodations canvas {
            max-height: 100% !important;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #B3E0FF;
            border-radius: 3px;
        }

        .dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #4B5563;
        }

        /* ============================================
           TABLE THUMBNAIL — KONSISTEN SEMUA DEVICE
           ============================================ */
        .table-thumb {
            width: 80px;
            height: 45px;
            min-width: 80px;
            min-height: 45px;
            aspect-ratio: 16 / 9;
            border-radius: 0.5rem;
            overflow: hidden;
            background: #f3f4f6;
            border: 1px solid #B3E0FF;
            flex-shrink: 0;
            display: block;
            box-sizing: border-box;
        }

        .dark .table-thumb {
            background: #1f2937;
            border-color: #374151;
        }

        .table-thumb img {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            max-width: 100%;
            max-height: 100%;
        }

        @media (max-width: 640px) {
            .table-thumb {
                width: 64px;
                height: 36px;
                min-width: 64px;
                min-height: 36px;
            }
        }

        #recentAccommodations td:first-child,
        #recentArticles td:first-child {
            width: 96px;
            max-width: 96px;
        }

        @media (max-width: 640px) {
            #recentAccommodations td:first-child,
            #recentArticles td:first-child {
                width: 76px;
                max-width: 76px;
            }
        }
    </style>
@endsection