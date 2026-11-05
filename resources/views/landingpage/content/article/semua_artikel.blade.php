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
                    Memuat Artikel
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

    <section class="reveal-on-scroll pt-24 pb-12 sm:pb-16 lg:pb-20 bg-white dark:bg-gray-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6">

            {{-- ===================== HEADER ===================== --}}
            <div
                class="reveal-on-scroll flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-12 gap-4 sm:gap-6">
                <div class="max-w-xl">
                    <span
                        class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                        — Blog
                    </span>
                    <h1
                        class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2 sm:mb-3">
                        Semua <span class="text-[#0194F3]">Artikel</span>
                    </h1>
                    <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400">
                        Kumpulan tips dan informasi menarik seputar penginapan
                    </p>
                </div>

                <a href="{{ url('/') }}"
                    class="inline-flex items-center gap-2 text-[#0194F3] font-semibold text-sm sm:text-base hover:gap-3 transition-all group self-start sm:self-auto">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            {{-- ===================== DAFTAR ARTIKEL ===================== --}}
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($articles as $article)
                        <article class="reveal-on-scroll group cursor-pointer h-full">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 lg:hover:-translate-y-1 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
                                <div class="relative overflow-hidden h-48 sm:h-56 flex-shrink-0">
                                    @if($article->thumbnail)
                                        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            loading="lazy">
                                    @else
                                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            loading="lazy">
                                    @endif

                                    @if($article->category)
                                        <span
                                            class="absolute top-3 left-3 bg-[#0194F3] text-white text-[10px] sm:text-xs font-bold px-2.5 sm:px-3 py-1 rounded-full shadow-lg">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <div class="p-4 sm:p-6 flex flex-col flex-1">
                                    <p
                                        class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 mb-2 flex items-center gap-1.5">
                                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#0194F3]" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                    </p>

                                    <h3
                                        class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2 sm:mb-3 group-hover:text-[#0194F3] transition-colors line-clamp-2 leading-snug">
                                        {{ $article->title }}
                                    </h3>

                                    <p
                                        class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-3 flex-1">
                                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 120) }}
                                    </p>

                                    <a href="{{ route('article.detail', $article->slug) }}"
                                        class="inline-flex items-center gap-1 text-[#0194F3] font-semibold text-xs sm:text-sm group-hover:gap-2 transition-all mt-auto">
                                        Baca Selengkapnya
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- ===================== PAGINATION ===================== --}}
                @if($articles->hasPages())
                    <div class="reveal-on-scroll mt-10 sm:mt-14 flex justify-center">
                        {{ $articles->links() }}
                    </div>
                @endif
            @else
                {{-- ===================== EMPTY STATE ===================== --}}
                <div class="reveal-on-scroll text-center py-12 sm:py-16">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-800 flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-[#0F294D] dark:text-white mb-2">
                        Belum Ada Artikel
                    </h3>
                    <p class="text-sm sm:text-base text-[#687176] dark:text-gray-400 mb-6">
                        Artikel akan segera hadir. Silakan cek kembali nanti.
                    </p>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center gap-2 text-[#0194F3] font-semibold text-sm hover:gap-3 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
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

    @push('scripts')
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

                        // Skip anchor link yang sama halaman
                        try {
                            const url = new URL(link.href, window.location.origin);
                            if (url.pathname === window.location.pathname && url.hash) return;
                        } catch (err) { /* ignore */ }

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
                                }, index * 80);

                                revealObserver.unobserve(entry.target);
                            }
                        });
                    }, {
                        threshold: 0.05,
                        rootMargin: '0px 0px -50px 0px'
                    });

                    revealElements.forEach(el => revealObserver.observe(el));
                } else {
                    revealElements.forEach(el => el.classList.add('is-visible'));
                }

            });
        </script>
    @endpush
@endsection