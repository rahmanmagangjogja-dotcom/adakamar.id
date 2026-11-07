@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <!-- ==================== GLOBAL PAGE LOADER ==================== -->
    <div id="globalLoader"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-opacity duration-500">
        <div class="flex flex-col items-center gap-3 sm:gap-4">
            <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20">
                <div class="absolute inset-0 rounded-full border-4 border-[#E6F4FF] dark:border-gray-700"></div>
                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0194F3] border-r-[#0194F3] animate-spin"></div>
                <div class="absolute inset-2 rounded-full border-4 border-transparent border-b-[#33ADFF] animate-spin"
                    style="animation-direction: reverse; animation-duration: 1.5s;"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i data-lucide="home" class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-[#0194F3] animate-pulse"></i>
                </div>
            </div>
            <div class="text-center px-4">
                <p class="text-xs sm:text-sm md:text-base font-bold text-[#0F294D] dark:text-white mb-1 uppercase tracking-wider">Memuat Halaman</p>
                <p class="text-[11px] sm:text-xs md:text-sm text-[#687176] dark:text-gray-400">Mohon tunggu sebentar...</p>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#0194F3] animate-bounce" style="animation-delay: 0s;"></span>
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#33ADFF] animate-bounce" style="animation-delay: 0.15s;"></span>
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#0064D2] animate-bounce" style="animation-delay: 0.3s;"></span>
            </div>
        </div>
    </div>
>
    </div>

    <!-- ==================== DETAIL ARTIKEL ==================== -->
    <section id="detail-artikel" class="reveal-on-scroll pt-24 pb-16 bg-gradient-to-b from-[#E6F4FF] via-[#F7F9FC] to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        
        {{-- Background Decoration --}}
        <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container mx-auto px-4 max-w-4xl relative z-10">


            <!-- Tombol Kembali -->
            <div class="reveal-on-scroll mb-6">
                <a href="{{ route('landingpage') }}#artikel"
                    class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wide text-gray-600 dark:text-gray-400 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors group border border-gray-300 dark:border-gray-600 px-3 py-1.5 rounded-sm bg-white dark:bg-gray-800 shadow-sm">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Artikel
                </a>
            </div>

            <!-- Header Artikel -->
            <header class="reveal-on-scroll mb-8 bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600">
                <!-- Kategori Badge -->
                @if($article->category)
                    <span class="inline-block bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] text-[10px] font-bold px-2.5 py-1 rounded-sm mb-4 uppercase tracking-wider border border-[#B3E0FF] dark:border-[#0194F3]/30">
                        {{ $article->category->name }}
                    </span>
                @endif

                <!-- Judul -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-6">
                    {{ $article->title }}
                </h1>

                <!-- Meta Info -->
                <div class="flex items-center gap-3 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="w-9 h-9 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center border border-gray-300 dark:border-gray-600">
                        <i data-lucide="calendar" class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Dipublikasikan</p>
                        <p class="text-sm font-bold text-[#0F294D] dark:text-white">
                            {{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </header>

            <!-- Thumbnail Utama -->
            @if($article->thumbnail)
                <div class="reveal-on-scroll relative rounded-sm overflow-hidden mb-8 shadow-sm border border-gray-300 dark:border-gray-600">
                    <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-auto max-h-[500px] object-cover">
                </div>
            @endif

            <!-- Excerpt -->
            @if($article->excerpt)
                <div class="reveal-on-scroll mb-8 p-4 bg-gray-50 dark:bg-gray-900 border-l-4 border-[#0194F3] rounded-r-sm border-y border-r border-gray-200 dark:border-gray-700">
                    <p class="text-sm sm:text-base text-[#0F294D] dark:text-gray-300 font-medium italic leading-relaxed text-justify">
                        {{ $article->excerpt }}
                    </p>
                </div>
            @endif

            <!-- Konten Artikel -->
            <article class="article-content reveal-on-scroll bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600">
                {!! $article->content !!}
            </article>

            <!-- Divider -->
            <div class="reveal-on-scroll my-10 flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-300 dark:bg-gray-700"></div>
                <span class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                    Selesai
                </span>
                <div class="flex-1 h-px bg-gray-300 dark:bg-gray-700"></div>
            </div>

            <!-- Share / Aksi -->
            <div class="reveal-on-scroll flex flex-wrap items-center justify-between gap-4 mb-10 p-5 bg-white dark:bg-gray-800 rounded-sm border border-gray-300 dark:border-gray-600 shadow-sm">
                <div>
                    <p class="text-sm font-bold text-[#0F294D] dark:text-white mb-1 uppercase tracking-wide">Bagikan artikel ini</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Bantu orang lain menemukan informasi ini</p>
                </div>
                <div class="flex items-center gap-2">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-9 h-9 rounded-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 flex items-center justify-center text-[#1877F2] hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-all">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>

                    <!-- Twitter/X -->
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="w-9 h-9 rounded-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 flex items-center justify-center text-[#0F294D] dark:text-white hover:bg-[#0F294D] hover:text-white hover:border-[#0F294D] transition-all">
                        <i data-lucide="twitter" class="w-4 h-4"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="w-9 h-9 rounded-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 flex items-center justify-center text-[#25D366] hover:bg-[#25D366] hover:text-white hover:border-[#25D366] transition-all">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                    </a>

                    <!-- Copy Link -->
                    <button type="button" onclick="copyArticleLink(this)"
                        class="w-9 h-9 rounded-sm bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 flex items-center justify-center text-[#0194F3] hover:bg-[#0194F3] hover:text-white hover:border-[#0194F3] transition-all">
                        <i data-lucide="copy" class="w-4 h-4"></i>
                    </button>
                </div>
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
            color: #4b5563;
            line-height: 1.8;
            font-size: 1rem;
        }

        .dark .article-content {
            color: #d1d5db;
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
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
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

        .article-content h1 { font-size: 1.75rem; }
        .article-content h2 { font-size: 1.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb; }
        .dark .article-content h2 { border-bottom-color: #374151; }
        .article-content h3 { font-size: 1.25rem; }
        .article-content h4 { font-size: 1.125rem; }

        .article-content p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        .article-content a {
            color: #0194F3;
            text-decoration: none;
            font-weight: 600;
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
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .article-content ul { list-style-type: disc; }
        .article-content ol { list-style-type: decimal; }

        .article-content li {
            margin-bottom: 0.35rem;
            padding-left: 0.25rem;
        }

        .article-content li::marker {
            color: #0194F3;
            font-weight: bold;
        }

        .article-content blockquote {
            border-left: 4px solid #0194F3;
            background: #f9fafb;
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            border-radius: 0 0.25rem 0.25rem 0;
            font-style: italic;
            color: #0F294D;
        }

        .dark .article-content blockquote {
            background: #1f2937;
            color: #e5e7eb;
        }

        .article-content img {
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            border: 1px solid #e5e7eb;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .dark .article-content img {
            border-color: #374151;
        }

        .article-content figure { margin: 1.5rem 0; }

        .article-content figcaption {
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
            font-style: italic;
        }

        .dark .article-content figcaption { color: #9ca3af; }

        .article-content code {
            background: #f3f4f6;
            padding: 0.15rem 0.3rem;
            border-radius: 0.25rem;
            font-size: 0.9em;
            color: #0194F3;
            font-family: 'Courier New', monospace;
            border: 1px solid #e5e7eb;
        }

        .dark .article-content code {
            background: #1f2937;
            border-color: #374151;
            color: #33ADFF;
        }

        .article-content pre {
            background: #0F294D;
            color: #ffffff;
            padding: 1rem;
            border-radius: 0.25rem;
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
            background: #e5e7eb;
            margin: 2rem 0;
        }

        .dark .article-content hr { background: #374151; }

        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            border: 1px solid #e5e7eb;
        }

        .dark .article-content table { border-color: #374151; }

        .article-content table th {
            background: #f3f4f6;
            color: #0F294D;
            font-weight: 700;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }

        .dark .article-content table th {
            background: #1f2937;
            color: #ffffff;
            border-bottom-color: #374151;
        }

        .article-content table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9375rem;
        }

        .dark .article-content table td { border-bottom-color: #374151; }

        .article-content table tr:hover td { background: #f9fafb; }
        .dark .article-content table tr:hover td { background: rgba(31, 41, 55, 0.5); }

        .article-content iframe {
            width: 100%;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
            border: 1px solid #e5e7eb;
        }

        .dark .article-content iframe { border-color: #374151; }

        .article-content video {
            width: 100%;
            border-radius: 0.25rem;
            margin: 1.5rem 0;
        }

        @media (max-width: 640px) {
            .article-content { font-size: 0.9375rem; }
            .article-content h2 { font-size: 1.25rem; }
            .article-content h3 { font-size: 1.125rem; }
            .article-content h4 { font-size: 1rem; }
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

        #globalLoader.loader-hidden {
            opacity: 0;
            pointer-events: none;
        }

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
                    button.innerHTML = `<i data-lucide="check" class="w-4 h-4"></i>`;
                    if (window.lucide) lucide.createIcons();
                    
                    button.classList.add('bg-[#00DD73]', 'text-white', 'border-[#00DD73]');
                    button.classList.remove('text-[#0194F3]');

                    setTimeout(() => {
                        button.innerHTML = originalHTML;
                        if (window.lucide) lucide.createIcons();
                        button.classList.remove('bg-[#00DD73]', 'text-white', 'border-[#00DD73]');
                        button.classList.add('text-[#0194F3]');
                    }, 2000);
                }).catch(err => {
                    console.error('Gagal menyalin:', err);
                    alert('Gagal menyalin link. Silakan copy manual: ' + url);
                });
            }

            document.addEventListener('DOMContentLoaded', function () {
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
                    if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:') || link.target === '_blank' || link.hasAttribute('download')) return;

                    try {
                        const url = new URL(link.href, window.location.origin);
                        if (url.origin !== window.location.origin) return;
                    } catch (e) { return; }

                    link.addEventListener('click', function (e) {
                        if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
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
                    }, { threshold: 0.05, rootMargin: '0px 0px -50px 0px' });
                    revealElements.forEach(el => revealObserver.observe(el));
                } else {
                    revealElements.forEach(el => el.classList.add('is-visible'));
                }

                // Render Lucide
                if (window.renderLucide) {
                    window.renderLucide();
                } else if (window.lucide) {
                    lucide.createIcons();
                }
            });
        </script>
    @endpush
@endsection