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

    @php
        $images = collect();

        if (!empty($accommodation->thumbnail)) {
            $images->push((object) ['image' => $accommodation->thumbnail, 'alt' => $accommodation->title]);
        }

        if ($accommodation->relationLoaded('images') && $accommodation->images->count()) {
            foreach ($accommodation->images as $img) {
                $images->push((object) ['image' => $img->image, 'alt' => $accommodation->title]);
            }
        }

        $images = $images->filter(fn($i) => !empty($i->image))->values();

        $statusMap = [
            'Available' => ['bg-[#00DD73]', 'Tersedia'],
            'Full' => ['bg-red-500', 'Tidak Tersedia'],
            'Maintenance' => ['bg-yellow-500', 'Maintenance'],
        ];
        [$statusBg, $statusText] = $statusMap[$accommodation->status] ?? ['bg-gray-500', $accommodation->status];

        $categoryName = $accommodation->category->name ?? 'Penginapan';
        $categorySlug = $accommodation->category->slug ?? null;

        if ($categorySlug) {
            $categoryUrl = \Illuminate\Support\Facades\Route::has('accommodationlanding.category')
                ? route('accommodationlanding.category', $categorySlug)
                : url('kategori-penginapanlanding/' . $categorySlug);
        } else {
            $categoryUrl = '/';
        }

        $totalImages = $images->count();
        $sideImages = $images->slice(1, 2)->values();
        $extraImages = $images->slice(3)->values();
        $extraCount = $extraImages->count();
        $hasExtra = $extraCount > 0;

        $allPhotoUrls = $images->map(fn($i) => asset($i->image))->values()->all();

        // Kontak & Sosial Media Pengelola (Murni dari database penginapan ini, null jika tidak diisi)
        $accPhone = !empty(trim((string) ($accommodation->phone ?? ''))) ? trim((string) $accommodation->phone) : null;
        $accWa = !empty(trim((string) ($accommodation->whatsapp ?? ''))) ? trim((string) $accommodation->whatsapp) : null;
        $accEmail = !empty(trim((string) ($accommodation->email ?? ''))) ? trim((string) $accommodation->email) : null;

        $accFb = !empty(trim((string) ($accommodation->facebook ?? ''))) ? trim((string) $accommodation->facebook) : null;
        $accIg = !empty(trim((string) ($accommodation->instagram ?? ''))) ? trim((string) $accommodation->instagram) : null;
        $accYt = !empty(trim((string) ($accommodation->youtube ?? ''))) ? trim((string) $accommodation->youtube) : null;
        $accX = !empty(trim((string) ($accommodation->x ?? ''))) ? trim((string) $accommodation->x) : null;
        $accTiktok = !empty(trim((string) ($accommodation->tiktok ?? ''))) ? trim((string) $accommodation->tiktok) : null;

        $hasContact = !empty($accPhone) || !empty($accWa) || !empty($accEmail);
        $hasSosmed = !empty($accFb) || !empty($accIg) || !empty($accYt) || !empty($accX) || !empty($accTiktok);

        // Nomor WhatsApp untuk pemesanan/booking penginapan
        $rawWa = $accWa ?: ($accPhone ?: '');
        $cleanWa = preg_replace('/[^0-9]/', '', (string) $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        } elseif (!empty($cleanWa) && !str_starts_with($cleanWa, '62')) {
            $cleanWa = '62' . $cleanWa;
        }

        // Template pesan WhatsApp booking
        $pageUrl = url()->current();
        $formattedPrice = 'Rp ' . number_format($accommodation->price ?? 0, 0, ',', '.') . '/malam';
        $waMessage = "Halo, saya ingin memesan/booking penginapan berikut:\n\n"
            . "*Nama Penginapan:* " . $accommodation->title . "\n"
            . "*Kategori:* " . ($categoryName ?? 'Penginapan') . "\n"
            . "*Harga:* " . $formattedPrice . "\n"
            . "*Link Halaman:* " . $pageUrl . "\n\n"
            . "Mohon informasi ketersediaan kamar dan prosedur pemesanannya. Terima kasih!";
        $bookingWaUrl = !empty($cleanWa) 
            ? 'https://wa.me/' . $cleanWa . '?text=' . rawurlencode($waMessage) 
            : null;

        // ===================== RATING =====================
        $avgRating = $accommodation->average_rating
            ?? ($accommodation->relationLoaded('ratings')
                ? round($accommodation->ratings->avg('bintang') ?? 0, 1)
                : 0);

        $totalReviews = $accommodation->total_reviews
            ?? ($accommodation->relationLoaded('ratings')
                ? $accommodation->ratings->count()
                : 0);

        $fullStars = (int) floor($avgRating);
        $hasHalfStar = ($avgRating - $fullStars) >= 0.5;

        $reviews = $accommodation->relationLoaded('ratings')
            ? $accommodation->ratings->sortByDesc('created_at')
            : collect();
    @endphp

    <!-- ==================== SECTION DETAIL ==================== -->
    <section
        class="pt-20 sm:pt-24 pb-8 sm:pb-12 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative min-h-screen overflow-hidden">

        {{-- Dekorasi background --}}
        <div class="absolute top-0 right-0 w-56 h-56 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-96 sm:h-96 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none -translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        <div class="container mx-auto px-3 xs:px-4 relative z-10 w-full min-w-0">

            {{-- TOMBOL KEMBALI + BREADCRUMB --}}
            <div class="reveal-on-scroll relative z-20 mb-4 sm:mb-6 flex items-center justify-between gap-2 min-w-0">
                <a href="{{ route('accommodationlanding.semua') }}"
                    class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-sm bg-white dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] border border-gray-300 dark:border-gray-600 hover:bg-[#0194F3] hover:text-white transition-all shadow-sm font-bold text-xs sm:text-sm group flex-shrink-0 uppercase tracking-wide"
                    title="Kembali ke Daftar Penginapan">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>

                {{-- Breadcrumb --}}
                <nav aria-label="Breadcrumb" class="hidden xs:flex items-center gap-1 text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 truncate min-w-0 flex-1 justify-end font-medium">
                    <a href="{{ route('landingpage') }}" class="hover:text-[#0194F3] transition-colors">Beranda</a>
                    <i data-lucide="chevron-right" class="w-3 h-3 flex-shrink-0"></i>
                    <a href="{{ route('landingpage') }}#penginapan" class="hover:text-[#0194F3] transition-colors truncate max-w-[120px] sm:max-w-none">Penginapan</a>
                    <i data-lucide="chevron-right" class="w-3 h-3 flex-shrink-0"></i>
                    <span class="text-[#0F294D] dark:text-white font-bold truncate">{{ Str::limit($accommodation->title, 30) }}</span>
                </nav>
            </div>

            {{-- HEADER --}}
            <div class="reveal-on-scroll flex flex-col md:flex-row md:items-start md:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6 min-w-0">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                        <span class="inline-block bg-[#0194F3] text-white text-[9px] sm:text-[10px] font-bold px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-sm uppercase tracking-wider shadow-sm">
                            {{ $categoryName }}
                        </span>
                        <span class="inline-flex items-center gap-1 sm:gap-1.5 {{ $statusBg }} text-white text-[9px] sm:text-[10px] font-bold px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-sm uppercase tracking-wider shadow-sm">
                            {{ $statusText }}
                        </span>
                    </div>
                    <h1 class="text-xl xs:text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight break-words line-clamp-2 sm:line-clamp-none">
                        {{ $accommodation->title }}
                    </h1>

                    @if($accommodation->address)
                        <p class="mt-1.5 sm:mt-2 text-xs sm:text-sm text-[#687176] dark:text-gray-400 flex items-start gap-1.5">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0 mt-0.5 text-[#0194F3]"></i>
                            <span class="leading-snug break-words">{{ $accommodation->address }}</span>
                        </p>
                    @endif

                    {{-- RATING DISPLAY + BUTTON ULASAN --}}
                    <div class="mt-3 sm:mt-4 flex flex-wrap items-center gap-2 sm:gap-3">
                        <div class="inline-flex items-center gap-1.5 sm:gap-2 bg-white dark:bg-gray-800 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-sm border border-gray-300 dark:border-gray-600 shadow-sm">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <i data-lucide="star" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#FFD700]" style="fill:#FFD700;"></i>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <defs>
                                                <linearGradient id="halfStarGradient">
                                                    <stop offset="50%" stop-color="#FFD700" />
                                                    <stop offset="50%" stop-color="#D1D5DB" />
                                                </linearGradient>
                                            </defs>
                                            <polygon fill="url(#halfStarGradient)" stroke="#FFD700" stroke-width="1"
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                        </svg>
                                    @else
                                        <i data-lucide="star" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-300 dark:text-gray-600"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">({{ $totalReviews }})</span>
                        </div>

                        <button type="button" id="openRatingModal"
                            class="inline-flex items-center gap-1 sm:gap-1.5 px-3 sm:px-4 py-1 sm:py-1.5 rounded-sm bg-[#0194F3] hover:bg-[#0064D2] text-white text-[11px] sm:text-xs font-bold uppercase tracking-wide shadow-sm transition-all">
                            <i data-lucide="star" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                            Tulis Ulasan
                        </button>
                    </div>
                </div>

                {{-- SHARE --}}
                <div class="mt-3 sm:mt-4 flex flex-wrap items-center gap-2 sm:gap-3">
                    <button type="button" onclick="showShareLink()"
                        class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-[#0194F3] hover:bg-[#0064D2] text-white text-xs sm:text-sm font-bold uppercase tracking-wide rounded-sm shadow-sm transition-all">
                        <i data-lucide="share-2" class="w-4 h-4"></i>
                        Bagikan
                    </button>
                </div>
            </div>

            {{-- GALLERY --}}
            @if($totalImages > 0)
                <div class="reveal-on-scroll grid grid-cols-2 md:grid-cols-4 gap-1.5 sm:gap-2 mb-5 sm:mb-8 w-full min-w-0">
                    <div class="col-span-2 md:col-span-3 md:row-span-2 relative group overflow-hidden rounded-sm bg-gray-200 shadow-sm border border-gray-300 dark:border-gray-600 min-w-0">
                        <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                            data-photos='@json($allPhotoUrls)' data-index="0">
                            <img src="{{ asset($images[0]->image) }}" alt="{{ $images[0]->alt }}"
                                class="w-full h-48 xs:h-56 sm:h-80 md:h-[480px] object-cover group-hover:scale-105 transition-transform duration-500">
                        </button>

                        @if($totalImages > 1)
                            <span class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] sm:text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-sm flex items-center gap-1 sm:gap-1.5 pointer-events-none border border-white/20">
                                <i data-lucide="image" class="w-3 h-3 sm:w-3.5 sm:h-3.5"></i>
                                {{ $totalImages }} Foto
                            </span>
                        @endif
                    </div>

                    @foreach($sideImages as $index => $img)
                        <div class="relative group overflow-hidden rounded-sm bg-gray-200 shadow-sm border border-gray-300 dark:border-gray-600 min-w-0">
                            <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                                data-photos='@json($allPhotoUrls)' data-index="{{ $index + 1 }}">
                                <img src="{{ asset($img->image) }}" alt="{{ $img->alt }}"
                                    class="w-full h-24 xs:h-32 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                            </button>

                            @if($hasExtra && $index === $sideImages->count() - 1)
                                <button type="button"
                                    class="open-gallery-btn absolute inset-0 bg-black/55 hover:bg-black/70 backdrop-blur-[2px] flex flex-col items-center justify-center text-white font-bold transition-colors duration-200 group/btn"
                                    data-photos='@json($allPhotoUrls)' data-index="2">
                                    <i data-lucide="images" class="w-5 h-5 sm:w-7 sm:h-7 mb-0.5 sm:mb-1.5 group-hover/btn:scale-110 transition-transform"></i>
                                    <span class="text-sm sm:text-base font-bold">+{{ $extraCount }}</span>
                                    <span class="hidden sm:block text-[10px] uppercase tracking-wider opacity-80 mt-0.5">Lihat Semua</span>
                                </button>
                            @endif
                        </div>
                    @endforeach

                    @if($sideImages->count() < 2 && $totalImages <= 2)
                        @for($i = $sideImages->count(); $i < 2; $i++)
                            <div class="hidden md:block rounded-sm bg-gray-100 dark:bg-gray-800"></div>
                        @endfor
                    @endif
                </div>
            @endif

            {{-- KONTEN UTAMA --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 w-full min-w-0">

                {{-- KIRI: MAIN CONTENT --}}
                <div class="lg:col-span-2 space-y-4 sm:space-y-6 order-2 lg:order-1 min-w-0">

                    {{-- Spesifikasi --}}
                    <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                        <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-3 sm:mb-5 flex items-center gap-2 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                            <span class="w-1 h-4 sm:h-5 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                            Informasi Penginapan
                        </h2>

                        <div class="grid grid-cols-4 gap-2">
                            <div class="bg-gray-50 dark:bg-gray-900 rounded-sm p-2.5 sm:p-3.5 text-center border border-gray-300 dark:border-gray-600 min-w-0">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    <i data-lucide="users" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                </div>
                                <p class="text-[8px] xs:text-[9px] text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">Kapasitas</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">{{ $accommodation->capacity ?? '-' }} <span class="hidden xs:inline">Orang</span></p>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900 rounded-sm p-2.5 sm:p-3.5 text-center border border-gray-300 dark:border-gray-600 min-w-0">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    <i data-lucide="home" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                </div>
                                <p class="text-[8px] xs:text-[9px] text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">Kamar</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">{{ $accommodation->bedroom ?? '-' }}</p>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900 rounded-sm p-2.5 sm:p-3.5 text-center border border-gray-300 dark:border-gray-600 min-w-0">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    <i data-lucide="bath" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                </div>
                                <p class="text-[8px] xs:text-[9px] text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">K. Mandi</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">{{ $accommodation->bathroom ?? '-' }}</p>
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900 rounded-sm p-2.5 sm:p-3.5 text-center border border-gray-300 dark:border-gray-600 min-w-0">
                                <div class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    <i data-lucide="maximize" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                </div>
                                <p class="text-[8px] xs:text-[9px] text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">Ukuran</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">{{ $accommodation->size ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    @if($accommodation->description)
                        <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2 sm:mb-3 flex items-center gap-2 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                                <span class="w-1 h-4 sm:h-5 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                                Deskripsi
                            </h2>
                            <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 leading-relaxed whitespace-pre-line break-words text-justify">
                                {{ $accommodation->description }}
                            </p>
                        </div>
                    @endif

                    {{-- ULASAN PENGGUNA --}}
                    <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                        <div class="flex items-center justify-between mb-3 sm:mb-4 flex-wrap gap-2 border-b border-gray-200 dark:border-gray-700 pb-2">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white flex items-center gap-2 uppercase tracking-wide">
                                <span class="w-1 h-4 sm:h-5 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                                Ulasan Pengguna
                            </h2>
                            <button type="button" id="openRatingModalInline"
                                class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-sm bg-gray-100 dark:bg-gray-700 text-[#0F294D] dark:text-gray-300 text-[10px] sm:text-xs font-bold uppercase tracking-wide hover:bg-[#0194F3] hover:text-white transition-all border border-gray-300 dark:border-gray-600">
                                <i data-lucide="plus" class="w-3 h-3 sm:w-3.5 sm:h-3.5"></i>
                                Tambah Ulasan
                            </button>
                        </div>

                        @if($reviews->count() > 0)
                            {{-- Ringkasan rating --}}
                            <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 mb-3 sm:mb-4 bg-gray-50 dark:bg-gray-900 rounded-sm border border-gray-300 dark:border-gray-600 min-w-0">
                                <div class="text-center flex-shrink-0">
                                    <div class="text-2xl xs:text-3xl sm:text-4xl font-bold text-[#0194F3] dark:text-[#33ADFF]">
                                        {{ number_format($avgRating, 1) }}
                                    </div>
                                    <div class="flex items-center justify-center gap-0.5 mt-0.5 sm:mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" class="w-2.5 h-2.5 xs:w-3 xs:h-3 sm:w-3.5 sm:h-3.5 {{ $i <= $fullStars ? 'text-[#FFD700]' : 'text-gray-300 dark:text-gray-600' }}" @if($i <= $fullStars) style="fill:#FFD700;" @endif></i>
                                        @endfor
                                    </div>
                                    <p class="text-[9px] sm:text-[10px] text-gray-500 dark:text-gray-400 mt-0.5 sm:mt-1">
                                        {{ $totalReviews }} ulasan
                                    </p>
                                </div>
                                <div class="flex-1 text-[11px] sm:text-xs text-gray-600 dark:text-gray-400 leading-relaxed break-words min-w-0">
                                    Berdasarkan ulasan dari tamu yang pernah menginap di
                                    <span class="font-bold text-[#0F294D] dark:text-white">{{ $accommodation->title }}</span>.
                                </div>
                            </div>

                            {{-- List ulasan --}}
                            <div id="reviewsContainer" class="space-y-2 sm:space-y-3">
                                @foreach($reviews as $index => $review)
                                    <div class="review-item p-3 sm:p-4 bg-gray-50 dark:bg-gray-700/50 rounded-sm border border-gray-300 dark:border-gray-600 {{ $index >= 5 ? 'hidden' : '' }} min-w-0"
                                        data-index="{{ $index }}">
                                        <div class="flex items-start justify-between gap-2 mb-1.5 sm:mb-2">
                                            <div class="flex items-center gap-2 min-w-0 flex-1">
                                                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-sm bg-[#0194F3] text-white flex items-center justify-center text-[10px] sm:text-xs font-bold flex-shrink-0">
                                                    {{ strtoupper(substr($review->nama ?? 'A', 0, 1)) }}
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white truncate">
                                                        {{ strtoupper(substr($review->nama ?? 'Anonim', 0, 1)) . str_repeat('*', 4) }}
                                                    </p>
                                                    @if(!empty($review->email))
                                                        <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 truncate">
                                                            {{ preg_replace('/^(.).+(@.+)$/', '$1****$2', $review->email) }}
                                                        </p>
                                                    @endif
                                                    <p class="text-[9px] sm:text-[10px] text-gray-400 dark:text-gray-500">
                                                        {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-0.5 flex-shrink-0">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i data-lucide="star" class="w-2.5 h-2.5 sm:w-3 sm:h-3 {{ $i <= ($review->bintang ?? 0) ? 'text-[#FFD700]' : 'text-gray-300 dark:text-gray-600' }}" @if($i <= ($review->bintang ?? 0)) style="fill:#FFD700;" @endif></i>
                                                @endfor
                                            </div>
                                        </div>
                                        @if(!empty($review->keterangan))
                                            <p class="text-[11px] sm:text-xs text-gray-600 dark:text-gray-300 leading-relaxed break-words">
                                                {{ $review->keterangan }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            {{-- Tombol Lihat Semua --}}
                            @if($totalReviews > 5)
                                <div class="text-center mt-3 sm:mt-4">
                                    <button type="button" id="toggleAllReviews"
                                        class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-sm bg-gray-100 dark:bg-gray-700 text-[#0F294D] dark:text-gray-300 text-[11px] sm:text-xs font-bold uppercase tracking-wide hover:bg-[#0194F3] hover:text-white transition-all border border-gray-300 dark:border-gray-600">
                                        <span id="toggleReviewsText">Lihat semua ulasan ({{ $totalReviews }})</span>
                                        <i data-lucide="chevron-down" id="toggleReviewsIcon" class="w-3 h-3 sm:w-3.5 sm:h-3.5 transition-transform duration-300"></i>
                                    </button>
                                </div>
                            @endif
                        @else
                            {{-- Belum ada ulasan --}}
                            <div class="text-center py-6 sm:py-8">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2 sm:mb-3 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center border border-gray-300 dark:border-gray-600">
                                    <i data-lucide="message-circle" class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400"></i>
                                </div>
                                <p class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white mb-1 uppercase tracking-wide">
                                    Belum ada ulasan
                                </p>
                                <p class="text-[11px] sm:text-xs text-gray-500 dark:text-gray-400 mb-3 sm:mb-4 px-4">
                                    Jadilah yang pertama memberikan ulasan untuk penginapan ini.
                                </p>
                                <button type="button" id="openRatingModalEmpty"
                                    class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 rounded-sm bg-[#0194F3] text-white text-[11px] sm:text-xs font-bold uppercase tracking-wide shadow-sm hover:bg-[#0064D2] transition-all">
                                    <i data-lucide="star" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                    Tulis Ulasan Pertama
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Fasilitas --}}
                    @if($accommodation->relationLoaded('facilities') && $accommodation->facilities->count())
                        <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-4 flex items-center gap-2 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                                <span class="w-1 h-4 sm:h-5 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                                Fasilitas 
                            </h2>
                            
                            <div class="grid grid-cols-2 gap-y-4 sm:gap-y-5 gap-x-4 sm:gap-x-6">
                                @foreach($accommodation->facilities as $facility)
                                    <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
                                        <div class="flex-shrink-0 flex items-center justify-center text-[#0194F3] dark:text-[#33ADFF]">
                                            @php
                                                $iconRaw    = $facility->icon;
                                                $iconLucide = $iconRaw && preg_match('/^[a-z0-9-]+$/i', $iconRaw);
                                                $iconSvg    = $iconRaw && (Str::startsWith($iconRaw, ['M', 'm']) || Str::startsWith($iconRaw, '<'));
                                                $iconEmoji  = $iconRaw && !$iconLucide && !$iconSvg;
                                            @endphp

                                            @if($iconLucide)
                                                <i data-lucide="{{ $iconRaw }}" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                                            @elseif($iconSvg)
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $iconRaw }}" />
                                                </svg>
                                            @elseif($iconEmoji)
                                                <span class="text-lg sm:text-xl leading-none">{{ $iconRaw }}</span>
                                            @else
                                                <i data-lucide="check" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                                            @endif
                                        </div>

                                        <span class="text-[13px] sm:text-sm text-[#0F294D] dark:text-gray-300 truncate">
                                            {{ $facility->name }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Peraturan --}}
                    @if($accommodation->relationLoaded('rules') && $accommodation->rules->count())
                        <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-3 sm:mb-4 flex items-center gap-2 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                                <span class="w-1 h-4 sm:h-5 bg-red-500 rounded-sm flex-shrink-0"></span>
                                Aturan Penginapan
                            </h2>

                            <ul class="space-y-2 sm:space-y-3">
                                @foreach($accommodation->rules as $rule)
                                    <li class="flex items-start gap-2.5 sm:gap-3 p-2.5 sm:p-3 bg-red-50 dark:bg-red-900/10 rounded-sm border border-red-200 dark:border-red-800/40 min-w-0">
                                        <div class="flex-shrink-0 w-6 h-6 sm:w-7 sm:h-7 rounded-sm bg-red-500 flex items-center justify-center shadow-sm mt-0.5">
                                            <i data-lucide="alert-circle" class="w-3 h-3 sm:w-4 sm:h-4 text-white"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs sm:text-sm font-bold text-red-700 dark:text-red-300 leading-tight break-words">
                                                {{ $rule->name }}
                                            </p>
                                            @if(!empty($rule->description))
                                                <p class="mt-0.5 sm:mt-1 text-[11px] sm:text-xs text-red-600 dark:text-red-200/80 leading-relaxed break-words">
                                                    {{ $rule->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Google Maps --}}
                    @if($accommodation->maps_embed || $accommodation->google_maps_url)
                        <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-sm shadow-sm border border-gray-300 dark:border-gray-600 p-4 sm:p-6 min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2.5 sm:mb-3 flex items-center gap-2 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                                <span class="w-1 h-4 sm:h-5 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                                Lokasi
                            </h2>

                            @if($accommodation->maps_embed)
                                @php
                                    $embed = trim($accommodation->maps_embed);
                                    if (stripos($embed, '<iframe') === 0) {
                                        $embed = preg_replace('/\s*width="[^"]*"/i', '', $embed);
                                        $embed = preg_replace('/\s*height="[^"]*"/i', '', $embed);
                                        $embed = preg_replace('/\s*style="[^"]*"/i', '', $embed);
                                        $embed = preg_replace(
                                            '/<iframe/i',
                                            '<iframe class="w-full h-56 xs:h-64 sm:h-72 md:h-80 border-0 block"',
                                            $embed
                                        );
                                    } else {
                                        $embed = '<iframe src="' . e($embed) . '" class="w-full h-56 xs:h-64 sm:h-72 md:h-80 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>';
                                    }
                                @endphp
                                <div class="rounded-sm overflow-hidden border border-gray-300 dark:border-gray-600">
                                    {!! $embed !!}
                                </div>
                            @endif

                            @if($accommodation->google_maps_url)
                                <a href="{{ $accommodation->google_maps_url }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 mt-2.5 sm:mt-3 text-[11px] sm:text-xs text-[#0194F3] dark:text-[#33ADFF] hover:underline font-bold uppercase tracking-wide">
                                    <i data-lucide="external-link" class="w-3 h-3 sm:w-3.5 sm:h-3.5"></i>
                                    Buka di Google Maps
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- KANAN: INFO CARD --}}
                <div class="lg:col-span-1 order-1 lg:order-2 w-full min-w-0">
                    <div class="reveal-on-scroll lg:sticky lg:top-24 bg-white dark:bg-gray-800 rounded-sm shadow-md border border-gray-300 dark:border-gray-600 overflow-hidden w-full">

                        <div class="relative bg-[#0F294D] p-4 sm:p-6 overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;"></div>

                            <div class="relative">
                                <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-300 font-bold mb-0.5 sm:mb-1">
                                    Harga per malam
                                </p>
                                <div class="flex items-baseline gap-1 flex-wrap">
                                    <span class="text-2xl xs:text-2xl sm:text-3xl font-bold text-white">
                                        Rp {{ number_format($accommodation->price ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs sm:text-sm text-gray-400">/malam</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-6">
                            <div class="space-y-2.5 sm:space-y-3 text-xs sm:text-sm">
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-gray-500 dark:text-gray-400 flex-shrink-0 font-medium">Kategori</span>
                                    <span class="font-bold text-[#0F294D] dark:text-white text-right break-words min-w-0">{{ $categoryName }}</span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-gray-500 dark:text-gray-400 flex-shrink-0 font-medium">Kapasitas</span>
                                    <span class="font-bold text-[#0F294D] dark:text-white text-right">
                                        {{ $accommodation->capacity ?? '-' }} orang
                                    </span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-gray-500 dark:text-gray-400 flex-shrink-0 font-medium">Rating</span>
                                    <span class="inline-flex items-center gap-1 font-bold text-[#0F294D] dark:text-white">
                                        <i data-lucide="star" class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#FFD700]" style="fill:#FFD700;"></i>
                                        {{ number_format($avgRating, 1) }}
                                        <span class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">({{ $totalReviews }})</span>
                                    </span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-gray-500 dark:text-gray-400 flex-shrink-0 font-medium">Status</span>
                                    <span class="inline-flex items-center gap-1 font-bold {{ $accommodation->status === 'Available' ? 'text-[#00DD73]' : 'text-red-500' }}">
                                        <span class="w-1.5 h-1.5 rounded-sm {{ $accommodation->status === 'Available' ? 'bg-[#00DD73]' : 'bg-red-500' }}"></span>
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 sm:mt-6 space-y-2 sm:space-y-3">
                                @if(!empty($bookingWaUrl))
                                    <a href="{{ $bookingWaUrl }}" target="_blank" rel="noopener noreferrer"
                                        class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold rounded-sm text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 shadow-sm hover:shadow-md transition-all uppercase tracking-wide group">
                                        <i data-lucide="message-circle" class="w-4 h-4 sm:w-5 sm:h-5 group-hover:scale-110 transition-transform"></i>
                                        <span>Pesan Melalui WhatsApp</span>
                                    </a>
                                @endif

                                <a href="{{ route('accommodationlanding.semua') }}"
                                    class="w-full inline-flex items-center justify-center gap-1.5 sm:gap-2 border border-[#0194F3] text-[#0194F3] hover:bg-[#0194F3] hover:text-white font-bold rounded-sm text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 transition-all uppercase tracking-wide">
                                    <i data-lucide="layout-list" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                    Lihat Penginapan Lainnya
                                </a>
                            </div>

                            <p class="mt-3 sm:mt-4 text-[10px] sm:text-xs text-gray-400 text-center">
                                Harga dapat berubah sewaktu-waktu
                            </p>

                            {{-- ==================== SELENGKAPNYA TENTANG PENGELOLA ==================== --}}
                            {{-- Hanya tampil jika penginapan memiliki kontak atau sosial media (tidak null) --}}
                            @if($hasContact || $hasSosmed)
                                <div class="mt-5 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <h3 class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white mb-3 flex items-center gap-2 uppercase tracking-wide">
                                        <span class="w-1 h-3.5 sm:h-4 bg-[#0194F3] rounded-sm flex-shrink-0"></span>
                                        Selengkapnya tentang pengelola
                                    </h3>

                                    {{-- Kontak Penginapan (hanya tampil jika tidak null) --}}
                                    @if($hasContact)
                                        <div class="space-y-2 mb-3">
                                            @if(!empty($accPhone))
                                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $accPhone) }}"
                                                    class="flex items-center gap-2.5 p-2 sm:p-2.5 bg-gray-50 dark:bg-gray-900 rounded-sm border border-gray-300 dark:border-gray-600 hover:border-[#0194F3] transition-all group min-w-0">
                                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                                        <i data-lucide="phone" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3]"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-[9px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">Telepon</p>
                                                        <p class="text-xs font-bold text-[#0F294D] dark:text-white truncate">{{ $accPhone }}</p>
                                                    </div>
                                                </a>
                                            @endif

                                            @if(!empty($accWa))
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $accWa) }}"
                                                    target="_blank" rel="noopener noreferrer"
                                                    class="flex items-center gap-2.5 p-2 sm:p-2.5 bg-gray-50 dark:bg-gray-900 rounded-sm border border-gray-300 dark:border-gray-600 hover:border-[#25D366] transition-all group min-w-0">
                                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-[#25D366]/10 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#25D366]/30">
                                                        <i data-lucide="message-circle" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#25D366]"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-[9px] font-bold text-[#25D366] uppercase tracking-wider mb-0.5">WhatsApp</p>
                                                        <p class="text-xs font-bold text-[#0F294D] dark:text-white truncate">{{ $accWa }}</p>
                                                    </div>
                                                </a>
                                            @endif

                                            @if(!empty($accEmail))
                                                <a href="mailto:{{ $accEmail }}"
                                                    class="flex items-center gap-2.5 p-2 sm:p-2.5 bg-gray-50 dark:bg-gray-900 rounded-sm border border-gray-300 dark:border-gray-600 hover:border-[#0194F3] transition-all group min-w-0">
                                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                                        <i data-lucide="mail" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#0194F3]"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-[9px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-0.5">Email</p>
                                                        <p class="text-xs font-bold text-[#0F294D] dark:text-white truncate">{{ $accEmail }}</p>
                                                    </div>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Sosial Media Penginapan (hanya tampil jika tidak null) --}}
                                    @if($hasSosmed)
                                        <div class="pt-2.5 border-t border-gray-200 dark:border-gray-700">
                                            <p class="text-[9px] sm:text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">
                                                Sosial Media
                                            </p>
                                            <div class="flex flex-wrap gap-1.5">
                                                @if(!empty($accFb))
                                                    <a href="{{ $accFb }}" target="_blank" rel="noopener noreferrer"
                                                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-sm bg-[#1877F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm"
                                                        title="Facebook">
                                                        <i data-lucide="facebook" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                                    </a>
                                                @endif

                                                @if(!empty($accIg))
                                                    <a href="{{ $accIg }}" target="_blank" rel="noopener noreferrer"
                                                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-sm bg-[#E1306C] text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm"
                                                        title="Instagram">
                                                        <i data-lucide="instagram" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                                    </a>
                                                @endif

                                                @if(!empty($accYt))
                                                    <a href="{{ $accYt }}" target="_blank" rel="noopener noreferrer"
                                                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-sm bg-[#FF0000] text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm"
                                                        title="YouTube">
                                                        <i data-lucide="youtube" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                                    </a>
                                                @endif

                                                @if(!empty($accX))
                                                    <a href="{{ $accX }}" target="_blank" rel="noopener noreferrer"
                                                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-sm bg-black text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm"
                                                        title="X (Twitter)">
                                                        <i data-lucide="twitter" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                                    </a>
                                                @endif

                                                @if(!empty($accTiktok))
                                                    <a href="{{ $accTiktok }}" target="_blank" rel="noopener noreferrer"
                                                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-sm bg-black text-white flex items-center justify-center hover:opacity-90 transition-opacity shadow-sm"
                                                        title="TikTok">
                                                        <i data-lucide="music-2" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== MODAL GALERI ===================== --}}
    <div id="galleryModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-2 xs:p-3 sm:p-4 opacity-0 transition-opacity duration-300 overflow-hidden">

        <div class="relative w-full sm:max-w-5xl max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-sm shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 border border-gray-600"
            id="galleryModalContent">

            <div class="flex items-center justify-between px-3 xs:px-4 sm:px-5 py-2.5 sm:py-3.5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 flex-shrink-0">
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                        <i data-lucide="image" class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3] dark:text-[#33ADFF]"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white truncate uppercase tracking-wide">
                            Galeri {{ $accommodation->title }}
                        </h3>
                        <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400">
                            <span id="galleryCounter">1</span> dari <span id="galleryTotal">{{ $totalImages }}</span> foto
                        </p>
                    </div>
                </div>

                <button type="button" id="closeGalleryModal"
                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-sm flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 transition-colors flex-shrink-0 border border-transparent hover:border-red-200"
                    title="Tutup (Esc)">
                    <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>
            </div>

            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[250px] sm:min-h-[300px]">
                <button type="button" id="galleryPrev"
                    class="absolute left-1.5 sm:left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 sm:w-11 sm:h-11 rounded-sm bg-gray-800/80 hover:bg-gray-700 backdrop-blur-md text-white flex items-center justify-center transition-all border border-gray-600">
                    <i data-lucide="chevron-left" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                </button>

                <img id="galleryMainImage" src="" alt="Foto"
                    class="max-w-full max-h-[50vh] xs:max-h-[55vh] sm:max-h-[60vh] object-contain transition-opacity duration-300 select-none">

                <button type="button" id="galleryNext"
                    class="absolute right-1.5 sm:right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 sm:w-11 sm:h-11 rounded-sm bg-gray-800/80 hover:bg-gray-700 backdrop-blur-md text-white flex items-center justify-center transition-all border border-gray-600">
                    <i data-lucide="chevron-right" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                </button>

                <button type="button" id="galleryFullscreen"
                    class="absolute top-1.5 sm:top-3 right-1.5 sm:right-3 z-10 w-8 h-8 sm:w-10 sm:h-10 rounded-sm bg-gray-800/80 hover:bg-gray-700 backdrop-blur-md text-white flex items-center justify-center transition-all border border-gray-600"
                    title="Buka di tab baru">
                    <i data-lucide="external-link" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>
            </div>

            <div class="px-2 xs:px-3 sm:px-5 py-2 sm:py-3 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                <div id="galleryThumbs" class="flex gap-1.5 sm:gap-2 overflow-x-auto pb-1"></div>
            </div>
        </div>
    </div>

    {{-- ===================== MODAL TAMBAH RATING / ULASAN ===================== --}}
    @include('landingpage.layouts.partials.modal_add_rating', ['accommodation' => $accommodation])

    <style>
        /* ============================================
           GLOBAL: PREVENT HORIZONTAL SCROLL
           ============================================ */
        html {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
            max-width: 100vw;
            width: 100%;
            position: relative;
        }

        section {
            overflow-x: clip;
            width: 100%;
            max-width: 100vw;
        }

        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            width: 100%;
            box-sizing: border-box;
        }

        @media (min-width: 400px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        .grid {
            min-width: 0;
        }

        .grid > * {
            min-width: 0;
        }

        h1, h2, h3, h4, h5, h6, p, span, a {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        #galleryThumbs::-webkit-scrollbar {
            height: 6px;
        }
        #galleryThumbs::-webkit-scrollbar-track {
            background: transparent;
        }
        #galleryThumbs::-webkit-scrollbar-thumb {
            background: rgba(1, 148, 243, 0.4);
            border-radius: 3px;
        }
        #galleryThumbs::-webkit-scrollbar-thumb:hover {
            background: rgba(1, 148, 243, 0.7);
        }

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

        #ratingModal {
            isolation: isolate;
        }

        .review-item {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        @supports (padding: env(safe-area-inset-bottom)) {
            body {
                padding-bottom: env(safe-area-inset-bottom);
            }
        }

        @media (max-width: 400px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }
    </style>

    @push('scripts')
        <script>
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
                    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
                    revealElements.forEach(el => revealObserver.observe(el));
                } else {
                    revealElements.forEach(el => el.classList.add('is-visible'));
                }

                /* ============================================================
                 * GALLERY MODAL
                 * ============================================================ */
                const modal = document.getElementById('galleryModal');
                const modalContent = document.getElementById('galleryModalContent');
                const mainImage = document.getElementById('galleryMainImage');
                const thumbsWrap = document.getElementById('galleryThumbs');
                const counterEl = document.getElementById('galleryCounter');
                const totalEl = document.getElementById('galleryTotal');
                const closeBtn = document.getElementById('closeGalleryModal');
                const prevBtn = document.getElementById('galleryPrev');
                const nextBtn = document.getElementById('galleryNext');
                const fullscreenBtn = document.getElementById('galleryFullscreen');

                let photos = [];
                let current = 0;

                function openModal(images, startIndex) {
                    photos = images;
                    current = startIndex || 0;
                    totalEl.textContent = photos.length;
                    buildThumbs();
                    showPhoto(current);
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    requestAnimationFrame(() => {
                        modal.classList.remove('opacity-0');
                        modalContent.classList.remove('scale-95');
                        modalContent.classList.add('scale-100');
                    });
                    document.body.style.overflow = 'hidden';
                }

                function closeModal() {
                    modal.classList.add('opacity-0');
                    modalContent.classList.remove('scale-100');
                    modalContent.classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                        document.body.style.overflow = '';
                    }, 250);
                }

                function showPhoto(index) {
                    if (!photos.length) return;
                    if (index < 0) index = photos.length - 1;
                    if (index >= photos.length) index = 0;
                    current = index;
                    mainImage.style.opacity = '0';
                    setTimeout(() => {
                        mainImage.src = photos[current];
                        mainImage.style.opacity = '1';
                    }, 150);
                    counterEl.textContent = current + 1;
                    document.querySelectorAll('#galleryThumbs .gallery-thumb-item').forEach((el, i) => {
                        el.classList.toggle('ring-2', i === current);
                        el.classList.toggle('ring-[#0194F3]', i === current);
                        el.classList.toggle('opacity-50', i !== current);
                    });
                    const activeThumb = document.querySelectorAll('#galleryThumbs .gallery-thumb-item')[current];
                    if (activeThumb) {
                        activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                }

                function buildThumbs() {
                    thumbsWrap.innerHTML = '';
                    photos.forEach((src, i) => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'gallery-thumb-item flex-shrink-0 w-14 h-14 xs:w-16 xs:h-16 sm:w-20 sm:h-20 rounded-sm overflow-hidden border border-gray-300 dark:border-gray-600 transition-all hover:scale-105';
                        btn.innerHTML = `<img src="${src}" class="w-full h-full object-cover" alt="Thumb ${i + 1}" loading="lazy">`;
                        btn.addEventListener('click', () => showPhoto(i));
                        thumbsWrap.appendChild(btn);
                    });
                }

                document.querySelectorAll('.open-gallery-btn').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const data = this.dataset.photos;
                        const idx = parseInt(this.dataset.index || '0', 10);
                        let parsed = [];
                        try { parsed = JSON.parse(data); } catch (err) { parsed = []; }
                        if (parsed.length) openModal(parsed, idx);
                    });
                });

                if (closeBtn) closeBtn.addEventListener('click', closeModal);
                if (modal) modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });
                if (prevBtn) prevBtn.addEventListener('click', () => showPhoto(current - 1));
                if (nextBtn) nextBtn.addEventListener('click', () => showPhoto(current + 1));
                if (fullscreenBtn) fullscreenBtn.addEventListener('click', () => {
                    if (photos[current]) window.open(photos[current], '_blank');
                });

                document.addEventListener('keydown', function (e) {
                    if (!modal || modal.classList.contains('hidden')) return;
                    if (e.key === 'Escape') closeModal();
                    if (e.key === 'ArrowLeft') showPhoto(current - 1);
                    if (e.key === 'ArrowRight') showPhoto(current + 1);
                });

                let touchStartX = 0;
                if (mainImage) {
                    mainImage.addEventListener('touchstart', e => {
                        touchStartX = e.changedTouches[0].screenX;
                    }, { passive: true });
                    mainImage.addEventListener('touchend', e => {
                        const diff = e.changedTouches[0].screenX - touchStartX;
                        if (Math.abs(diff) > 50) {
                            showPhoto(diff > 0 ? current - 1 : current + 1);
                        }
                    }, { passive: true });
                }

                /* ============================================================
                 * MODAL TAMBAH RATING
                 * ============================================================ */
                const ratingModal = document.getElementById('ratingModal')
                    || document.getElementById('modalAddRating')
                    || document.getElementById('addRatingModal')
                    || document.getElementById('modal_add_rating');

                if (ratingModal && ratingModal.parentNode !== document.body) {
                    document.body.appendChild(ratingModal);
                }

                function openRatingModal() {
                    if (!ratingModal) {
                        console.warn('[Rating] Modal rating tidak ditemukan.');
                        return;
                    }
                    ratingModal.classList.remove('hidden');
                    ratingModal.classList.add('flex');
                    requestAnimationFrame(() => {
                        ratingModal.classList.remove('opacity-0');
                    });
                    document.body.style.overflow = 'hidden';
                }

                function closeRatingModal() {
                    if (!ratingModal) return;
                    ratingModal.classList.add('opacity-0');
                    setTimeout(() => {
                        ratingModal.classList.add('hidden');
                        ratingModal.classList.remove('flex');
                        document.body.style.overflow = '';
                    }, 200);
                }

                ['openRatingModal', 'openRatingModalInline', 'openRatingModalEmpty', 'openRatingModalCta'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.addEventListener('click', openRatingModal);
                });

                if (ratingModal) {
                    ratingModal.addEventListener('click', function (e) {
                        if (e.target === ratingModal) closeRatingModal();
                    });

                    ratingModal.querySelectorAll(
                        '[data-close-rating-modal], #closeRatingModal, #closeRatingModalBtn, .close-rating-modal, [data-modal-close]'
                    ).forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            closeRatingModal();
                        });
                    });
                }

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && ratingModal && !ratingModal.classList.contains('hidden')) {
                        closeRatingModal();
                    }
                });

                @if($errors->has('bintang') || $errors->has('nama') || $errors->has('email') || $errors->has('keterangan'))
                    openRatingModal();
                @endif

                /* ============================================================
                 * TOGGLE SEMUA ULASAN
                 * ============================================================ */
                const toggleBtn = document.getElementById('toggleAllReviews');
                if (toggleBtn) {
                    let isExpanded = false;
                    toggleBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const allReviews = document.querySelectorAll('.review-item');
                        const textEl = document.getElementById('toggleReviewsText');
                        const iconEl = document.getElementById('toggleReviewsIcon');

                        isExpanded = !isExpanded;

                        allReviews.forEach((item, index) => {
                            if (index >= 5) {
                                if (isExpanded) {
                                    item.classList.remove('hidden');
                                    item.style.opacity = '0';
                                    item.style.transform = 'translateY(10px)';
                                    setTimeout(() => {
                                        item.style.opacity = '1';
                                        item.style.transform = 'translateY(0)';
                                    }, 30 + (index - 5) * 40);
                                } else {
                                    item.classList.add('hidden');
                                    item.style.opacity = '';
                                    item.style.transform = '';
                                }
                            }
                        });

                        if (isExpanded) {
                            textEl.textContent = 'Sembunyikan ulasan';
                            if (iconEl) iconEl.style.transform = 'rotate(180deg)';
                        } else {
                            textEl.textContent = 'Lihat semua ulasan ({{ $totalReviews }})';
                            if (iconEl) iconEl.style.transform = 'rotate(0deg)';
                            const reviewSection = document.getElementById('reviewsContainer');
                            if (reviewSection) {
                                reviewSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        }
                    });
                }

                // ==================== SHARE LINK PENGINAPAN ====================
                window.showShareLink = function () {
                    const link = window.location.href;

                    if (typeof Swal === 'undefined') {
                        console.error('SweetAlert2 belum dimuat.');
                        return;
                    }

                    Swal.fire({
                        title: 'Bagikan Penginapan',
                        html: `
                            <div class="flex items-center gap-2 mt-3">
                                <input
                                    type="text"
                                    id="shareLink"
                                    value="${link}"
                                    readonly
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-sm bg-gray-50 text-gray-700"
                                >
                                <button
                                    type="button"
                                    onclick="copyShareLink()"
                                    class="px-4 py-2 bg-[#0194F3] hover:bg-[#0064D2] text-white text-sm font-bold uppercase tracking-wide rounded-sm whitespace-nowrap">
                                    Salin Link
                                </button>
                            </div>
                        `,
                        showConfirmButton: false,
                        showCloseButton: true
                    });
                };

                window.copyShareLink = function () {
                    const input = document.getElementById('shareLink');

                    if (!input) return;

                    input.select();
                    input.setSelectionRange(0, 99999);

                    navigator.clipboard.writeText(input.value)
                        .then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Link Berhasil Disalin!',
                                text: 'Link penginapan berhasil disalin.',
                                confirmButtonColor: '#0194F3'
                            });
                        })
                        .catch(() => {
                            document.execCommand('copy');

                            Swal.fire({
                                icon: 'success',
                                title: 'Link Berhasil Disalin!',
                                confirmButtonColor: '#0194F3'
                            });
                        });
                };
                
                // Render Lucide Icons
                if (window.renderLucide) {
                    window.renderLucide();
                } else if (window.lucide) {
                    lucide.createIcons();
                }
            });
        </script>
    @endpush
@endsection