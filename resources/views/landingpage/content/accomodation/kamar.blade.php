@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ==================== GLOBAL PAGE LOADER ==================== -->
    <div id="globalLoader"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-opacity duration-500">
        <div class="flex flex-col items-center gap-4">
            <!-- Spinner -->
            <div class="relative w-16 h-16 sm:w-20 sm:h-20">
                <div class="absolute inset-0 rounded-full border-4 border-[#E6F4FF] dark:border-gray-700"></div>
                <div
                    class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0194F3] border-r-[#0194F3] animate-spin">
                </div>
                <div class="absolute inset-2 rounded-full border-4 border-transparent border-b-[#33ADFF] animate-spin"
                    style="animation-direction: reverse; animation-duration: 1.5s;"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#0194F3] animate-pulse" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>

            <!-- Loading text -->
            <div class="text-center">
                <p class="text-sm sm:text-base font-bold text-[#0F294D] dark:text-white mb-1">
                    Memuat Halaman
                </p>
                <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400">
                    Mohon tunggu sebentar...
                </p>
            </div>

            <!-- Progress dots -->
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0194F3] animate-bounce" style="animation-delay: 0s;"></span>
                <span class="w-2 h-2 rounded-full bg-[#33ADFF] animate-bounce" style="animation-delay: 0.15s;"></span>
                <span class="w-2 h-2 rounded-full bg-[#0064D2] animate-bounce" style="animation-delay: 0.3s;"></span>
            </div>
        </div>
    </div>

    <!-- Daftar Penginapan per Kategori -->
    <section id="daftar-penginapan" class="reveal-on-scroll py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">

            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('landingpage') }}"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#E6F4FF] dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] hover:bg-[#0194F3] hover:text-white dark:hover:bg-[#33ADFF] transition-colors shadow-sm"
                    title="Kembali ke Beranda">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>

            <!-- Header -->
            <div class="mb-5">
                <div class="text-center mb-5">
                    <h1 class="text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white mb-3">
                        {{ $category->name }}
                    </h1>
                    @if($category->description)
                        <p class="text-lg text-[#687176] dark:text-gray-400 max-w-2xl mx-auto">
                            {{ $category->description }}
                        </p>
                    @else
                        <p class="text-lg text-[#687176] dark:text-gray-400">
                            Pilih {{ strtolower($category->name) }} yang sesuai dengan kebutuhan dan budget Anda
                        </p>
                    @endif
                </div>
            </div>

            <!-- Filter Harga -->
            <div
                class="reveal-on-scroll mb-8 bg-[#F7F9FC] dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-9 h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#0194F3] dark:text-[#33ADFF]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-[#0F294D] dark:text-white whitespace-nowrap">
                            Filter Harga:
                        </span>
                    </div>

                    <div class="flex-1 w-full">
                        <input type="range" id="priceRange" min="50000" max="10000000" step="50000" value="10000000"
                            class="w-full h-2 bg-[#E6F4FF] dark:bg-gray-600 rounded-lg appearance-none cursor-pointer accent-[#0194F3]">
                        <div class="flex justify-between text-xs text-[#687176] dark:text-gray-400 mt-2 px-1">
                            <span>Rp 50.000</span>
                            <span class="font-semibold text-[#0194F3] dark:text-[#33ADFF]" id="priceLabel">Rp
                                10.000.000</span>
                        </div>
                    </div>

                    <button type="button" id="resetFilter"
                        class="hidden items-center gap-1 px-4 py-2 rounded-lg bg-white dark:bg-gray-700 text-[#0194F3] dark:text-[#33ADFF] border border-[#0194F3] dark:border-[#33ADFF] hover:bg-[#E6F4FF] dark:hover:bg-gray-600 transition-colors text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Info Hasil -->
            <div class="mb-6 text-sm text-[#687176] dark:text-gray-400 text-center">
                Menampilkan
                <span class="font-semibold text-[#0F294D] dark:text-white"
                    id="resultCount">{{ $accommodations->count() }}</span>
                penginapan
                <span id="filterInfo" class="hidden">
                    (Harga ≤ <span class="font-semibold text-[#0194F3] dark:text-[#33ADFF]" id="filterPriceInfo"></span>)
                </span>
            </div>

            <!-- ==================== GRID LOADING STATE (khusus filter & pagination) ==================== -->
            <div id="gridLoading" class="hidden py-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @for($i = 0; $i < 8; $i++)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md border border-gray-100 dark:border-gray-700 animate-pulse">
                            <div class="w-full h-52 bg-gray-200 dark:bg-gray-700"></div>
                            <div class="p-5 space-y-3">
                                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/2"></div>
                                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
                                <div class="h-9 bg-gray-200 dark:bg-gray-700 rounded mt-4"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Grid Card Penginapan -->
            @if($accommodations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="accommodationGrid">
                    @foreach($accommodations as $accommodation)
                        @php
                            $statusColors = [
                                'Available' => ['bg-[#00DD73]', 'Tersedia'],
                                'Full' => ['bg-red-500', 'Tidak Tersedia'],
                                'Maintenance' => ['bg-yellow-500', 'Maintenance'],
                            ];
                            $status = $statusColors[$accommodation->status] ?? ['bg-gray-500', $accommodation->status];
                            $isAvailable = $accommodation->status === 'Available';
                        @endphp

                        <div class="accommodation-card reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-700 group {{ !$isAvailable ? 'opacity-75' : '' }}"
                            data-price="{{ $accommodation->price }}">

                            <div class="relative overflow-hidden">
                                @if($accommodation->thumbnail)
                                    <img src="{{ asset($accommodation->thumbnail) }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @else
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @endif

                                <span
                                    class="absolute top-3 right-3 {{ $status[0] }} text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    {{ $status[1] }}
                                </span>
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold text-[#0F294D] dark:text-white text-base mb-1.5 truncate">
                                    {{ $accommodation->title }}
                                </h3>
                                <p class="text-[#687176] dark:text-gray-400 text-xs mb-4 flex items-center gap-1 truncate">
                                    <svg class="w-3.5 h-3.5 text-[#0194F3] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ Str::limit($accommodation->address, 30) }}
                                </p>

                                <div class="flex items-baseline gap-1 mb-4 pb-4 border-b border-gray-100 dark:border-gray-700">
                                    <span class="text-[#0194F3] font-bold text-lg">
                                        Rp {{ number_format($accommodation->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[#687176] dark:text-gray-400 text-xs">/malam</span>
                                </div>

                                @if($isAvailable)
                                    <a href="{{ route('accommodationlanding.detail', $accommodation->slug) }}"
                                        class="block w-full text-center bg-[#0194F3] text-white py-2.5 rounded-lg hover:bg-[#0064D2] transition-colors text-sm font-semibold shadow-sm hover:shadow-md">
                                        Lihat Detail
                                    </a>
                                @else
                                    <button disabled
                                        class="block w-full text-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 py-2.5 rounded-lg cursor-not-allowed text-sm font-semibold">
                                        Tidak Tersedia
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div id="paginationContainer"
                    class="hidden flex-col sm:flex-row items-center justify-between gap-4 mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
                    <div class="text-sm text-[#687176] dark:text-gray-400">
                        Menampilkan
                        <span class="font-semibold text-[#0F294D] dark:text-white" id="pageFrom">1</span>
                        -
                        <span class="font-semibold text-[#0F294D] dark:text-white" id="pageTo">8</span>
                        dari
                        <span class="font-semibold text-[#0F294D] dark:text-white" id="pageTotal">0</span>
                        penginapan
                    </div>
                    <nav class="flex items-center gap-1" aria-label="Pagination">
                        <button type="button" id="prevPage"
                            class="page-nav-btn disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div id="pageNumbers" class="flex items-center gap-1"></div>
                        <button type="button" id="nextPage"
                            class="page-nav-btn disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </nav>
                </div>

                <!-- Empty State Filter -->
                <div id="emptyFilterState" class="hidden text-center py-20">
                    <div
                        class="w-20 h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-10 h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#0F294D] dark:text-white mb-2">Tidak ada penginapan</h3>
                    <p class="text-[#687176] dark:text-gray-400 mb-4">
                        Tidak ada penginapan dengan harga di bawah
                        <span class="font-semibold text-[#0194F3] dark:text-[#33ADFF]" id="emptyPriceLabel"></span>.
                    </p>
                    <button type="button" onclick="document.getElementById('resetFilter').click()"
                        class="inline-block bg-[#0194F3] text-white px-6 py-2.5 rounded-lg hover:bg-[#0064D2] transition-colors text-sm font-semibold shadow-md hover:shadow-lg">
                        Reset Filter
                    </button>
                </div>
            @else
                <div class="text-center py-20">
                    <div
                        class="w-20 h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-10 h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-[#0F294D] dark:text-white mb-2">Belum ada penginapan</h3>
                    <p class="text-[#687176] dark:text-gray-400 mb-4">Belum ada penginapan untuk kategori
                        {{ $category->name }}.
                    </p>
                    <a href="{{ route('landingpage') }}"
                        class="inline-block bg-[#0194F3] text-white px-6 py-2.5 rounded-lg hover:bg-[#0064D2] transition-colors text-sm font-semibold shadow-md hover:shadow-lg">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </section>

    <style>
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Range Slider */
        input[type="range"] {
            -webkit-appearance: none;
            appearance: none;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0194F3;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border: 2px solid #ffffff;
        }

        input[type="range"]::-webkit-slider-thumb:hover {
            transform: scale(1.15);
            background: #0064D2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #0194F3;
            cursor: pointer;
            border: 2px solid #ffffff;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input[type="range"]:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 4px rgba(1, 148, 243, 0.2);
        }

        /* Card Animasi */
        .accommodation-card {
            animation: fadeInCard 0.3s ease-out;
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Page Nav */
        .page-nav-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #E6F4FF;
            color: #687176;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-nav-btn:hover:not(:disabled) {
            background: #0194F3;
            color: white;
            border-color: #0194F3;
        }

        .page-number-btn {
            min-width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #E6F4FF;
            color: #687176;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            background: white;
            cursor: pointer;
        }

        .page-number-btn:hover {
            background: #0194F3;
            color: white;
            border-color: #0194F3;
        }

        .page-number-btn.active {
            background: #0194F3;
            color: white;
            border-color: #0194F3;
            font-weight: 600;
        }

        .page-number-btn.dots {
            border: none;
            background: transparent;
            cursor: default;
            color: #999999;
        }

        /* Dark Mode */
        .dark .page-nav-btn {
            background: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }

        .dark .page-nav-btn:hover:not(:disabled) {
            background: #33ADFF;
            color: white;
            border-color: #33ADFF;
        }

        .dark .page-number-btn {
            background: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }

        .dark .page-number-btn:hover,
        .dark .page-number-btn.active {
            background: #33ADFF;
            color: white;
            border-color: #33ADFF;
        }

        /* ==================== REVEAL ON SCROLL ==================== */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
                transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loader fade out */
        #globalLoader.loader-hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Prevent scroll saat loading */
        body.loading-active {
            overflow: hidden;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ============================================================
             * 1. GLOBAL PAGE LOADER
             * ============================================================ */
            const globalLoader = document.getElementById('globalLoader');

            window.addEventListener('load', function () {
                setTimeout(() => {
                    if (globalLoader) {
                        globalLoader.classList.add('loader-hidden');
                        document.body.classList.remove('loading-active');
                        setTimeout(() => {
                            globalLoader.style.display = 'none';
                        }, 600);
                    }
                }, 300);
            });

            document.querySelectorAll('a[href]').forEach(link => {
                const href = link.getAttribute('href');

                if (
                    !href ||
                    href.startsWith('#') ||
                    href.startsWith('javascript:') ||
                    href.startsWith('mailto:') ||
                    href.startsWith('tel:') ||
                    link.target === '_blank' ||
                    link.hasAttribute('download')
                ) return;

                try {
                    const url = new URL(link.href, window.location.origin);
                    if (url.origin !== window.location.origin) return;
                } catch (e) { return; }

                link.addEventListener('click', function (e) {
                    if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

                    if (globalLoader) {
                        globalLoader.style.display = 'flex';
                        globalLoader.classList.remove('loader-hidden');
                        document.body.classList.add('loading-active');
                    }
                });
            });

            window.addEventListener('pageshow', function (e) {
                if (e.persisted && globalLoader) {
                    globalLoader.classList.add('loader-hidden');
                    document.body.classList.remove('loading-active');
                    setTimeout(() => {
                        globalLoader.style.display = 'none';
                    }, 600);
                }
            });

            /* ============================================================
             * 2. REVEAL ON SCROLL
             * ============================================================ */
            const revealElements = document.querySelectorAll('.reveal-on-scroll');

            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry, index) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => {
                                entry.target.classList.add('is-visible');
                            }, index * 60);

                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-visible'));
            }

            /* ============================================================
             * 3. FILTER + PAGINATION (existing, dengan loading state)
             * ============================================================ */
            const priceRange = document.getElementById('priceRange');
            const priceLabel = document.getElementById('priceLabel');
            const resetFilter = document.getElementById('resetFilter');
            const resultCount = document.getElementById('resultCount');
            const filterInfo = document.getElementById('filterInfo');
            const filterPriceInfo = document.getElementById('filterPriceInfo');
            const emptyFilterState = document.getElementById('emptyFilterState');
            const emptyPriceLabel = document.getElementById('emptyPriceLabel');
            const accommodationGrid = document.getElementById('accommodationGrid');
            const gridLoading = document.getElementById('gridLoading');
            const allCards = Array.from(document.querySelectorAll('.accommodation-card'));

            const paginationContainer = document.getElementById('paginationContainer');
            const pageFrom = document.getElementById('pageFrom');
            const pageTo = document.getElementById('pageTo');
            const pageTotal = document.getElementById('pageTotal');
            const prevPage = document.getElementById('prevPage');
            const nextPage = document.getElementById('nextPage');
            const pageNumbers = document.getElementById('pageNumbers');

            const MAX_PRICE = 10000000;
            const ITEMS_PER_PAGE = 8;

            let currentPage = 1;
            let filteredCards = [...allCards];
            let loadingTimeout = null;

            function formatRupiah(value) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }

            function updatePriceLabel(value) {
                priceLabel.textContent = parseInt(value) >= MAX_PRICE
                    ? 'Semua Harga'
                    : formatRupiah(parseInt(value));
            }

            function showGridLoading() {
                if (!accommodationGrid || !gridLoading) return;
                gridLoading.classList.remove('hidden');
                accommodationGrid.classList.add('hidden');
                if (paginationContainer) {
                    paginationContainer.classList.add('hidden');
                    paginationContainer.classList.remove('flex');
                }
            }

            function hideGridLoading() {
                if (!accommodationGrid || !gridLoading) return;
                gridLoading.classList.add('hidden');
                accommodationGrid.classList.remove('hidden');
            }

            function applyFilter(maxPrice, withLoading = true) {
                if (withLoading) {
                    showGridLoading();
                    clearTimeout(loadingTimeout);
                    loadingTimeout = setTimeout(() => {
                        doApplyFilter(maxPrice);
                        hideGridLoading();
                    }, 250);
                } else {
                    doApplyFilter(maxPrice);
                }
            }

            function doApplyFilter(maxPrice) {
                const isFiltered = maxPrice < MAX_PRICE;

                filteredCards = allCards.filter(card => {
                    const cardPrice = parseInt(card.dataset.price) || 0;
                    return cardPrice <= maxPrice;
                });

                currentPage = 1;

                if (isFiltered) {
                    filterInfo.classList.remove('hidden');
                    filterPriceInfo.textContent = formatRupiah(maxPrice);
                    resetFilter.classList.remove('hidden');
                    resetFilter.classList.add('inline-flex');
                } else {
                    filterInfo.classList.add('hidden');
                    resetFilter.classList.add('hidden');
                    resetFilter.classList.remove('inline-flex');
                }

                resultCount.textContent = filteredCards.length;
                renderPage();
            }

            function renderPage() {
                const total = filteredCards.length;
                allCards.forEach(card => card.style.display = 'none');

                if (total === 0) {
                    emptyFilterState.classList.remove('hidden');
                    accommodationGrid.classList.add('hidden');
                    paginationContainer.classList.add('hidden');
                    paginationContainer.classList.remove('flex');
                    emptyPriceLabel.textContent = formatRupiah(parseInt(priceRange.value));
                    return;
                }

                emptyFilterState.classList.add('hidden');
                accommodationGrid.classList.remove('hidden');

                const totalPages = Math.ceil(total / ITEMS_PER_PAGE);
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
                const endIndex = Math.min(startIndex + ITEMS_PER_PAGE, total);

                for (let i = startIndex; i < endIndex; i++) {
                    filteredCards[i].style.display = '';
                    // Trigger reveal untuk card yang baru muncul
                    filteredCards[i].classList.add('is-visible');
                }

                pageFrom.textContent = startIndex + 1;
                pageTo.textContent = endIndex;
                pageTotal.textContent = total;

                if (totalPages > 1) {
                    paginationContainer.classList.remove('hidden');
                    paginationContainer.classList.add('flex');
                } else {
                    paginationContainer.classList.add('hidden');
                    paginationContainer.classList.remove('flex');
                }

                renderPageNumbers(totalPages);
                prevPage.disabled = currentPage === 1;
                nextPage.disabled = currentPage === totalPages;

                if (currentPage > 1) {
                    document.getElementById('daftar-penginapan').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }

            function renderPageNumbers(totalPages) {
                pageNumbers.innerHTML = '';

                const maxVisible = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
                let endPage = Math.min(totalPages, startPage + maxVisible - 1);

                if (endPage - startPage + 1 < maxVisible) {
                    startPage = Math.max(1, endPage - maxVisible + 1);
                }

                if (startPage > 1) {
                    addPageButton(1);
                    if (startPage > 2) addDots();
                }

                for (let i = startPage; i <= endPage; i++) {
                    addPageButton(i);
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) addDots();
                    addPageButton(totalPages);
                }
            }

            function addPageButton(pageNum) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = pageNum;
                btn.className = 'page-number-btn' + (pageNum === currentPage ? ' active' : '');
                btn.addEventListener('click', function () {
                    currentPage = pageNum;
                    renderPage();
                });
                pageNumbers.appendChild(btn);
            }

            function addDots() {
                const span = document.createElement('span');
                span.textContent = '...';
                span.className = 'page-number-btn dots';
                pageNumbers.appendChild(span);
            }

            priceRange.addEventListener('input', function () {
                updatePriceLabel(this.value);
                applyFilter(parseInt(this.value), true);
            });

            resetFilter.addEventListener('click', function () {
                priceRange.value = MAX_PRICE;
                updatePriceLabel(MAX_PRICE);
                applyFilter(MAX_PRICE, true);
            });

            prevPage.addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    renderPage();
                }
            });

            nextPage.addEventListener('click', function () {
                const totalPages = Math.ceil(filteredCards.length / ITEMS_PER_PAGE);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderPage();
                }
            });

            updatePriceLabel(priceRange.value);
            applyFilter(MAX_PRICE, false);
        });
    </script>
@endsection