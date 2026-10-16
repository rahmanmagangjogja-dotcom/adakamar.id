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

    <!-- ==================== DETAIL ARTIKEL ==================== -->
    <section id="detail-artikel" class="reveal-on-scroll pt-8 pb-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 max-w-4xl">

            <!-- Breadcrumb -->
            <nav class="reveal-on-scroll flex items-center gap-2 text-xs text-[#687176] dark:text-gray-400 mb-6 flex-wrap">
                <a href="{{ route('landingpage') }}" class="hover:text-[#0194F3] transition-colors">Beranda</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('landingpage') }}#artikel" class="hover:text-[#0194F3] transition-colors">Artikel</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-[#0F294D] dark:text-white font-semibold truncate max-w-[200px] sm:max-w-none">
                    {{ $article->title }}
                </span>
            </nav>

            <!-- Tombol Kembali -->
            <div class="reveal-on-scroll mb-6">
                <a href="{{ route('landingpage') }}#artikel"
                    class="inline-flex items-center gap-2 text-sm text-[#687176] dark:text-gray-400 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>

            <!-- Header Artikel -->
            <header class="reveal-on-scroll mb-8">
                <!-- Kategori Badge -->
                @if($article->category)
                    <span
                        class="inline-block bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] text-xs font-bold px-3 py-1.5 rounded-full mb-4 uppercase tracking-wider">
                        {{ $article->category->name }}
                    </span>
                @endif

                <!-- Judul -->
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-6">
                    {{ $article->title }}
                </h1>

                <!-- Meta Info: Hanya Tanggal Publikasi -->
                <div class="flex items-center gap-3 pb-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 rounded-full bg-[#E6F4FF] dark:bg-[#0194F3]/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#0194F3] dark:text-[#33ADFF]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#687176] dark:text-gray-400">Dipublikasikan</p>
                        <p class="text-sm font-semibold text-[#0F294D] dark:text-white">
                            {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </header>

            <!-- Thumbnail Utama -->
            @if($article->thumbnail)
                <div class="reveal-on-scroll relative rounded-2xl overflow-hidden mb-10 shadow-lg">
                    <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-auto max-h-[500px] object-cover">
                </div>
            @endif

            <!-- Excerpt -->
            @if($article->excerpt)
                <div
                    class="reveal-on-scroll mb-8 p-5 bg-[#E6F4FF] dark:bg-[#0194F3]/10 border-l-4 border-[#0194F3] rounded-r-xl">
                    <p class="text-base text-[#0F294D] dark:text-white font-medium italic leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                </div>
            @endif

            <!-- Konten Artikel -->
            <article class="article-content reveal-on-scroll">
                {!! $article->content !!}
            </article>

            <!-- Divider -->
            <div class="reveal-on-scroll my-12 flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-100 dark:bg-gray-700"></div>
                <span class="text-xs text-[#687176] dark:text-gray-400 uppercase tracking-widest font-semibold">
                    Selesai
                </span>
                <div class="flex-1 h-px bg-gray-100 dark:bg-gray-700"></div>
            </div>

            <!-- Share / Aksi -->
            <div
                class="reveal-on-scroll flex flex-wrap items-center justify-between gap-4 mb-12 p-5 bg-[#F7F9FC] dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                <div>
                    <p class="text-sm font-bold text-[#0F294D] dark:text-white mb-1">Bagikan artikel ini</p>
                    <p class="text-xs text-[#687176] dark:text-gray-400">Bantu orang lain menemukan informasi ini</p>
                </div>
                <div class="flex items-center gap-2">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center text-[#1877F2] hover:bg-[#1877F2] hover:text-white transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>

                    <!-- Twitter/X -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center text-[#0F294D] dark:text-white hover:bg-[#0F294D] hover:text-white transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center text-[#25D366] hover:bg-[#25D366] hover:text-white transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </a>

                    <!-- Copy Link -->
                    <button type="button" onclick="copyArticleLink(this)"
                        class="w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center text-[#0194F3] hover:bg-[#0194F3] hover:text-white transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- CTA -->
            <div
                class="reveal-on-scroll bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-2xl p-8 text-center text-white shadow-xl">
                <h3 class="text-2xl font-bold mb-2">Siap Mencari Penginapan?</h3>
                <p class="text-white/90 mb-6 max-w-lg mx-auto">
                    Temukan penginapan terbaik dengan harga terbaik hanya di adakamar.id
                </p>
                <a href="{{ route('landingpage') }}#unggulan"
                    class="inline-flex items-center gap-2 bg-white text-[#0194F3] px-7 py-3 rounded-lg hover:bg-[#E6F4FF] transition-all font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari Penginapan Sekarang
                </a>
            </div>
        </div>
    </section>

    <style>
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ===== STYLING KONTEN ARTIKEL ===== */
        .article-content {
            color: #687176;
            line-height: 1.8;
            font-size: 1.0625rem;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            color: #0F294D;
            font-weight: 700;
            line-height: 1.3;
            margin-top: 2rem;
            margin-bottom: 1rem;
            scroll-margin-top: 100px;
        }

        .dark .article-content h1,
        .dark .article-content h2,
        .dark .article-content h3,
        .dark .article-content h4,
        .dark .article-content h5,
        .dark .article-content h6 {
            color: #ffffff;
        }

        .article-content h1 {
            font-size: 2rem;
        }

        .article-content h2 {
            font-size: 1.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #E6F4FF;
        }

        .dark .article-content h2 {
            border-bottom-color: #1f2937;
        }

        .article-content h3 {
            font-size: 1.375rem;
        }

        .article-content h4 {
            font-size: 1.125rem;
        }

        .article-content p {
            margin-bottom: 1.25rem;
        }

        .article-content a {
            color: #0194F3;
            text-decoration: none;
            font-weight: 500;
            border-bottom: 1px dashed #0194F3;
            transition: all 0.2s;
        }

        .article-content a:hover {
            color: #0064D2;
            border-bottom-style: solid;
        }

        .article-content strong,
        .article-content b {
            color: #0F294D;
            font-weight: 700;
        }

        .dark .article-content strong,
        .dark .article-content b {
            color: #ffffff;
        }

        .article-content em,
        .article-content i {
            font-style: italic;
        }

        .article-content ul,
        .article-content ol {
            margin: 1.25rem 0;
            padding-left: 1.75rem;
        }

        .article-content ul {
            list-style-type: disc;
        }

        .article-content ol {
            list-style-type: decimal;
        }

        .article-content li {
            margin-bottom: 0.5rem;
            padding-left: 0.25rem;
        }

        .article-content li::marker {
            color: #0194F3;
            font-weight: bold;
        }

        .article-content blockquote {
            border-left: 4px solid #0194F3;
            background: #F7F9FC;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            border-radius: 0 0.75rem 0.75rem 0;
            font-style: italic;
            color: #0F294D;
            position: relative;
        }

        .article-content blockquote::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 15px;
            font-size: 3rem;
            color: #0194F3;
            opacity: 0.3;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .dark .article-content blockquote {
            background: #1f2937;
            color: #ffffff;
        }

        .article-content img {
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            max-width: 100%;
            height: auto;
            display: block;
        }

        .article-content figure {
            margin: 1.5rem 0;
        }

        .article-content figcaption {
            text-align: center;
            font-size: 0.875rem;
            color: #687176;
            margin-top: 0.5rem;
            font-style: italic;
        }

        .dark .article-content figcaption {
            color: #9ca3af;
        }

        .article-content code {
            background: #F7F9FC;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-size: 0.9em;
            color: #0194F3;
            font-family: 'Courier New', monospace;
            border: 1px solid #E6F4FF;
        }

        .dark .article-content code {
            background: #1f2937;
            border-color: #374151;
            color: #33ADFF;
        }

        .article-content pre {
            background: #0F294D;
            color: #ffffff;
            padding: 1.25rem;
            border-radius: 0.75rem;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .article-content pre code {
            background: transparent;
            color: inherit;
            padding: 0;
            border: none;
            font-size: inherit;
        }

        .article-content hr {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #E6F4FF, transparent);
            margin: 2.5rem 0;
        }

        .dark .article-content hr {
            background: linear-gradient(to right, transparent, #374151, transparent);
        }

        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .article-content table th {
            background: #E6F4FF;
            color: #0F294D;
            font-weight: 700;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .dark .article-content table th {
            background: #1f2937;
            color: #ffffff;
        }

        .article-content table td {
            padding: 0.75rem 1rem;
            border-top: 1px solid #E6F4FF;
            font-size: 0.9375rem;
        }

        .dark .article-content table td {
            border-top-color: #374151;
        }

        .article-content table tr:hover td {
            background: #F7F9FC;
        }

        .dark .article-content table tr:hover td {
            background: rgba(31, 41, 55, 0.5);
        }

        .article-content iframe {
            width: 100%;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .article-content video {
            width: 100%;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .article-content {
                font-size: 1rem;
            }

            .article-content h2 {
                font-size: 1.5rem;
            }

            .article-content h3 {
                font-size: 1.25rem;
            }

            .article-content h4 {
                font-size: 1.0625rem;
            }
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
            function copyArticleLink(button) {
                const url = window.location.href;

                navigator.clipboard.writeText(url).then(() => {
                    const originalHTML = button.innerHTML;
                    button.innerHTML = `
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    `;
                    button.classList.add('bg-[#00DD73]', 'text-white', 'border-[#00DD73]');
                    button.classList.remove('text-[#0194F3]');

                    setTimeout(() => {
                        button.innerHTML = originalHTML;
                        button.classList.remove('bg-[#00DD73]', 'text-white', 'border-[#00DD73]');
                        button.classList.add('text-[#0194F3]');
                    }, 2000);
                }).catch(err => {
                    console.error('Gagal menyalin:', err);
                    alert('Gagal menyalin link. Silakan copy manual: ' + url);
                });
            }

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

                        // Skip anchor link yang sama halaman (contoh: #artikel)
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