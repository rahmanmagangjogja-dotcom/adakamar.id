@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ==================== GLOBAL PAGE LOADER ==================== -->
    <div id="globalLoader"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-opacity duration-500">
        <div class="flex flex-col items-center gap-3 sm:gap-4">
            <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20">
                <div class="absolute inset-0 rounded-full border-4 border-[#E6F4FF] dark:border-gray-700"></div>
                <div
                    class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0194F3] border-r-[#0194F3] animate-spin">
                </div>
                <div class="absolute inset-2 rounded-full border-4 border-transparent border-b-[#33ADFF] animate-spin"
                    style="animation-direction: reverse; animation-duration: 1.5s;"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-[#0194F3] animate-pulse" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
            <div class="text-center px-4">
                <p class="text-xs sm:text-sm md:text-base font-bold text-[#0F294D] dark:text-white mb-1">Memuat Halaman</p>
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

        $hasContact = $accommodation->hasContact() ?? (!empty($accommodation->phone) || !empty($accommodation->whatsapp) || !empty($accommodation->email));
        $hasSosmed = $accommodation->hasSocialMedia() ?? (!empty($accommodation->facebook) || !empty($accommodation->instagram) || !empty($accommodation->youtube) || !empty($accommodation->x) || !empty($accommodation->tiktok));

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

        {{-- Dekorasi background — pakai translate + clip agar tidak overflow --}}
        <div class="absolute top-0 right-0 w-56 h-56 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-96 sm:h-96 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none -translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        <div class="container mx-auto px-3 xs:px-4 relative z-10 w-full min-w-0">

            {{-- TOMBOL KEMBALI + BREADCRUMB --}}
            <div class="reveal-on-scroll relative z-20 mb-4 sm:mb-6 flex items-center justify-between gap-2 min-w-0">
                <a href="{{ route('landingpage') }}#penginapan"
                    class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-white dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] border border-[#0194F3]/20 hover:bg-[#0194F3] hover:text-white transition-all shadow-sm hover:shadow-md font-semibold text-xs sm:text-sm group flex-shrink-0"
                    title="Kembali ke Daftar Penginapan">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali</span>
                </a>

                {{-- Breadcrumb singkat (desktop & tablet) --}}
                <nav aria-label="Breadcrumb" class="hidden xs:flex items-center gap-1 text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 truncate min-w-0 flex-1 justify-end">
                    <a href="{{ route('landingpage') }}" class="hover:text-[#0194F3] transition-colors">Beranda</a>
                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('landingpage') }}#penginapan" class="hover:text-[#0194F3] transition-colors truncate max-w-[120px] sm:max-w-none">Penginapan</a>
                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-[#0F294D] dark:text-white font-semibold truncate">{{ Str::limit($accommodation->title, 30) }}</span>
                </nav>
            </div>

            {{-- HEADER --}}
            <div class="reveal-on-scroll flex flex-col md:flex-row md:items-start md:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6 min-w-0">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 mb-2 sm:mb-3">
                        <span
                            class="inline-block bg-[#0194F3] text-white text-[9px] sm:text-[10px] font-bold px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full uppercase tracking-wider shadow-md">
                            {{ $categoryName }}
                        </span>
                        <span
                            class="inline-flex items-center gap-1 sm:gap-1.5 {{ $statusBg }} text-white text-[9px] sm:text-[10px] font-bold px-2.5 sm:px-3 py-0.5 sm:py-1 rounded-full uppercase tracking-wider shadow-md">
                            {{ $statusText }}
                        </span>
                    </div>
                    <h1 class="text-xl xs:text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight break-words line-clamp-2 sm:line-clamp-none">
                        {{ $accommodation->title }}
                    </h1>

                    @if($accommodation->address)
                        <p class="mt-1.5 sm:mt-2 text-xs sm:text-sm text-[#687176] dark:text-gray-400 flex items-start gap-1.5">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0 mt-0.5 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="leading-snug break-words">{{ $accommodation->address }}</span>
                        </p>
                    @endif

                    {{-- ============ RATING DISPLAY + BUTTON ULASAN ============ --}}
                    <div class="mt-3 sm:mt-4 flex flex-wrap items-center gap-2 sm:gap-3">
                        <div
                            class="inline-flex items-center gap-1.5 sm:gap-2 bg-white dark:bg-gray-800 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full border border-[#0194F3]/20 shadow-sm">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @elseif($i == $fullStars + 1 && $hasHalfStar)
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" viewBox="0 0 20 20">
                                            <defs>
                                                <linearGradient id="halfStarGradient">
                                                    <stop offset="50%" stop-color="#FFD700" />
                                                    <stop offset="50%" stop-color="#D1D5DB" />
                                                </linearGradient>
                                            </defs>
                                            <path fill="url(#halfStarGradient)"
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-300 dark:text-gray-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white">
                                {{ number_format($avgRating, 1) }}
                            </span>
                            <span class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">
                                ({{ $totalReviews }})
                            </span>
                        </div>

                        <button type="button" id="openRatingModal"
                            class="inline-flex items-center gap-1 sm:gap-1.5 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white text-[11px] sm:text-xs font-semibold shadow-md hover:shadow-lg hover:scale-105 active:scale-95 transition-all">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Tulis Ulasan
                        </button>
                    </div>
                    {{-- ============ END RATING ============ --}}
                </div>

                {{-- ============ SHARE ============ --}}
                <div class="mt-3 sm:mt-4 flex flex-wrap items-center gap-2 sm:gap-3">
                    
                    <button type="button"
                        onclick="showShareLink()"
                        class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-[#0194F3] hover:bg-[#0064D2] text-white text-xs sm:text-sm font-semibold rounded-full shadow-sm transition-all duration-300">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="18" cy="5" r="3"/>
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="19" r="3"/>
                            <line x1="8.6" y1="10.5" x2="15.4" y2="6.5"/>
                            <line x1="8.6" y1="13.5" x2="15.4" y2="17.5"/>
                        </svg>

                        Bagikan
                    </button>
                </div>
            </div>

            {{-- GALLERY — Mobile: 2 foto grid, Desktop: mosaic 4-col --}}
            @if($totalImages > 0)
                <div class="reveal-on-scroll grid grid-cols-2 md:grid-cols-4 gap-1.5 sm:gap-3 mb-5 sm:mb-8 w-full min-w-0">
                    <div class="col-span-2 md:col-span-3 md:row-span-2 relative group overflow-hidden rounded-xl sm:rounded-2xl bg-gray-200 shadow-lg min-w-0">
                        <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                            data-photos='@json($allPhotoUrls)' data-index="0">
                            <img src="{{ asset($images[0]->image) }}" alt="{{ $images[0]->alt }}"
                                class="w-full h-48 xs:h-56 sm:h-80 md:h-[480px] object-cover group-hover:scale-105 transition-transform duration-500">
                        </button>

                        @if($totalImages > 1)
                            <span
                                class="absolute bottom-2 sm:bottom-3 right-2 sm:right-3 bg-black/60 backdrop-blur-sm text-white text-[10px] sm:text-xs font-semibold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full flex items-center gap-1 sm:gap-1.5 pointer-events-none">
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $totalImages }} Foto
                            </span>
                        @endif
                    </div>

                    @foreach($sideImages as $index => $img)
                        <div class="relative group overflow-hidden rounded-xl sm:rounded-2xl bg-gray-200 shadow-lg min-w-0">
                            <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                                data-photos='@json($allPhotoUrls)' data-index="{{ $index + 1 }}">
                                <img src="{{ asset($img->image) }}" alt="{{ $img->alt }}"
                                    class="w-full h-24 xs:h-32 sm:h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                            </button>

                            @if($hasExtra && $index === $sideImages->count() - 1)
                                <button type="button"
                                    class="open-gallery-btn absolute inset-0 bg-black/55 hover:bg-black/70 backdrop-blur-[2px] flex flex-col items-center justify-center text-white font-semibold transition-colors duration-200 group/btn"
                                    data-photos='@json($allPhotoUrls)' data-index="2">
                                    <svg class="w-5 h-5 sm:w-7 sm:h-7 mb-0.5 sm:mb-1.5 group-hover/btn:scale-110 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm sm:text-base font-bold">+{{ $extraCount }}</span>
                                    <span class="hidden sm:block text-[10px] uppercase tracking-wider opacity-80 mt-0.5">Lihat Semua</span>
                                </button>
                            @endif
                        </div>
                    @endforeach

                    @if($sideImages->count() < 2 && $totalImages <= 2)
                        @for($i = $sideImages->count(); $i < 2; $i++)
                            <div class="hidden md:block rounded-2xl bg-gray-100 dark:bg-gray-800"></div>
                        @endfor
                    @endif
                </div>
            @endif

            {{-- KONTEN UTAMA — Mobile: info card di atas, Desktop: side-by-side --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 w-full min-w-0">

                {{-- KIRI: MAIN CONTENT --}}
                <div class="lg:col-span-2 space-y-4 sm:space-y-6 order-2 lg:order-1 min-w-0">

                    {{-- Spesifikasi --}}
                    <div
                        class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                        <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-3 sm:mb-5 flex items-center gap-2">
                            <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
                            Informasi Penginapan
                        </h2>

                        <div class="grid grid-cols-4 gap-2">
                            <div
                                class="bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl p-2.5 sm:p-3.5 text-center border border-[#0194F3]/15 hover:shadow-md transition-shadow min-w-0">
                                <div
                                    class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[8px] xs:text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">
                                    Kapasitas</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">
                                    {{ $accommodation->capacity ?? '-' }} <span class="hidden xs:inline">Orang</span>
                                </p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl p-2.5 sm:p-3.5 text-center border border-[#0194F3]/15 hover:shadow-md transition-shadow min-w-0">
                                <div
                                    class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-gradient-to-br from-[#33ADFF] to-[#0194F3] rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[8px] xs:text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">
                                    Kamar</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">
                                    {{ $accommodation->bedroom ?? '-' }}
                                </p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl p-2.5 sm:p-3.5 text-center border border-[#0194F3]/15 hover:shadow-md transition-shadow min-w-0">
                                <div
                                    class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-gradient-to-br from-[#0064D2] to-[#0194F3] rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[8px] xs:text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">
                                    K. Mandi</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">
                                    {{ $accommodation->bathroom ?? '-' }}
                                </p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl p-2.5 sm:p-3.5 text-center border border-[#0194F3]/15 hover:shadow-md transition-shadow min-w-0">
                                <div
                                    class="w-8 h-8 sm:w-9 sm:h-9 mx-auto mb-1.5 sm:mb-2 bg-gradient-to-br from-[#0194F3] to-[#33ADFF] rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[8px] xs:text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-0.5 sm:mb-1">
                                    Ukuran</p>
                                <p class="text-[11px] sm:text-xs font-bold text-[#0F294D] dark:text-white break-words">
                                    {{ $accommodation->size ?: '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    @if($accommodation->description)
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2 sm:mb-3 flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
                                Deskripsi
                            </h2>
                            <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 leading-relaxed whitespace-pre-line break-words">
                                {{ $accommodation->description }}
                            </p>
                        </div>
                    @endif

                    {{-- ==================== ULASAN PENGGUNA ==================== --}}
                    <div
                        class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                        <div class="flex items-center justify-between mb-3 sm:mb-4 flex-wrap gap-2">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
                                Ulasan Pengguna
                            </h2>
                            <button type="button" id="openRatingModalInline"
                                class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] text-[10px] sm:text-xs font-semibold hover:bg-[#0194F3] hover:text-white transition-all">
                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Ulasan
                            </button>
                        </div>

                        @if($reviews->count() > 0)
                            {{-- Ringkasan rating besar --}}
                            <div
                                class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 mb-3 sm:mb-4 bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl border border-[#0194F3]/15 min-w-0">
                                <div class="text-center flex-shrink-0">
                                    <div class="text-2xl xs:text-3xl sm:text-4xl font-bold text-[#0194F3] dark:text-[#33ADFF]">
                                        {{ number_format($avgRating, 1) }}
                                    </div>
                                    <div class="flex items-center justify-center gap-0.5 mt-0.5 sm:mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-2.5 h-2.5 xs:w-3 xs:h-3 sm:w-3.5 sm:h-3.5 {{ $i <= $fullStars ? 'text-[#FFD700]' : 'text-gray-300 dark:text-gray-600' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-[9px] sm:text-[10px] text-[#687176] dark:text-gray-400 mt-0.5 sm:mt-1">
                                        {{ $totalReviews }} ulasan
                                    </p>
                                </div>
                                <div class="flex-1 text-[11px] sm:text-xs text-[#687176] dark:text-gray-400 leading-relaxed break-words min-w-0">
                                    Berdasarkan ulasan dari tamu yang pernah menginap di
                                    <span class="font-semibold text-[#0F294D] dark:text-white">{{ $accommodation->title }}</span>.
                                </div>
                            </div>

                            {{-- List ulasan --}}
                            <div id="reviewsContainer" class="space-y-2 sm:space-y-3">
                                @foreach($reviews as $index => $review)
                                    <div class="review-item p-3 sm:p-4 bg-[#F7F9FC] dark:bg-gray-700/50 rounded-lg sm:rounded-xl border border-[#0194F3]/10 {{ $index >= 5 ? 'hidden' : '' }} min-w-0"
                                        data-index="{{ $index }}">
                                        <div class="flex items-start justify-between gap-2 mb-1.5 sm:mb-2">
                                            <div class="flex items-center gap-2 min-w-0 flex-1">
                                                <div
                                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-[#0194F3] to-[#0064D2] text-white flex items-center justify-center text-[10px] sm:text-xs font-bold flex-shrink-0">
                                                    {{ strtoupper(substr($review->nama ?? 'A', 0, 1)) }}
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-xs sm:text-sm font-semibold text-[#0F294D] dark:text-white truncate">
                                                        {{ strtoupper(substr($review->nama ?? 'Anonim', 0, 1)) . str_repeat('*', 4) }}
                                                    </p>
                                                    @if(!empty($review->email))
                                                        <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 truncate">
                                                            {{ preg_replace('/^(.).+(@.+)$/', '$1****$2', $review->email) }}
                                                        </p>
                                                    @endif
                                                    <p class="text-[9px] sm:text-[10px] text-[#687176] dark:text-gray-400">
                                                        {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-0.5 flex-shrink-0">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 {{ $i <= ($review->bintang ?? 0) ? 'text-[#FFD700]' : 'text-gray-300 dark:text-gray-600' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        @if(!empty($review->keterangan))
                                            <p class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-300 leading-relaxed break-words">
                                                {{ $review->keterangan }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            {{-- Tombol Lihat Semua / Sembunyikan Ulasan --}}
                            @if($totalReviews > 5)
                                <div class="text-center mt-3 sm:mt-4">
                                    <button type="button" id="toggleAllReviews"
                                        class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] text-[11px] sm:text-xs font-semibold hover:bg-[#0194F3] hover:text-white transition-all">
                                        <span id="toggleReviewsText">Lihat semua ulasan ({{ $totalReviews }})</span>
                                        <svg id="toggleReviewsIcon" class="w-3 h-3 sm:w-3.5 sm:h-3.5 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        @else
                            {{-- Belum ada ulasan --}}
                            <div class="text-center py-6 sm:py-8">
                                <div
                                    class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2 sm:mb-3 rounded-full bg-[#E6F4FF] dark:bg-[#0194F3]/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#0194F3] dark:text-[#33ADFF]" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <p class="text-xs sm:text-sm font-semibold text-[#0F294D] dark:text-white mb-1">
                                    Belum ada ulasan
                                </p>
                                <p class="text-[11px] sm:text-xs text-[#687176] dark:text-gray-400 mb-3 sm:mb-4 px-4">
                                    Jadilah yang pertama memberikan ulasan untuk penginapan ini.
                                </p>
                                <button type="button" id="openRatingModalEmpty"
                                    class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 rounded-full bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white text-[11px] sm:text-xs font-semibold shadow-md hover:shadow-lg hover:scale-105 active:scale-95 transition-all">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Tulis Ulasan Pertama
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- KONTAK & SOSIAL MEDIA --}}
                    @if($hasContact || $hasSosmed)
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-3 sm:mb-4 flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
                                Kontak & Sosial Media
                            </h2>

                            @if($hasContact)
                                <div class="space-y-2 sm:space-y-3 mb-4 sm:mb-5">
                                    @if(!empty($accommodation->phone))
                                        <a href="{{ $accommodation->phone_url ?? 'tel:' . preg_replace('/[^0-9+]/', '', $accommodation->phone) }}"
                                            class="flex items-center gap-2.5 sm:gap-3 p-2.5 sm:p-3 bg-gradient-to-r from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl hover:shadow-md border border-[#0194F3]/15 transition-all group min-w-0">
                                            <div
                                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[9px] sm:text-[10px] font-bold text-[#0194F3] uppercase tracking-wider mb-0.5">
                                                    Telepon
                                                </p>
                                                <p class="text-xs sm:text-sm font-semibold text-[#0F294D] dark:text-white break-words">
                                                    {{ $accommodation->phone }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif

                                    @if(!empty($accommodation->whatsapp))
                                        <a href="{{ $accommodation->whatsapp_url ?? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $accommodation->whatsapp) }}"
                                            target="_blank" rel="noopener noreferrer"
                                            class="flex items-center gap-2.5 sm:gap-3 p-2.5 sm:p-3 bg-gradient-to-r from-[#E8F8EE] to-white dark:from-[#25D366]/10 dark:to-gray-800 rounded-lg sm:rounded-xl hover:shadow-md border border-[#25D366]/15 transition-all group min-w-0">
                                            <div
                                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-[#25D366] to-[#128C7E] rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[9px] sm:text-[10px] font-bold text-[#25D366] uppercase tracking-wider mb-0.5">
                                                    WhatsApp
                                                </p>
                                                <p class="text-xs sm:text-sm font-semibold text-[#0F294D] dark:text-white break-words">
                                                    {{ $accommodation->whatsapp }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif

                                    @if(!empty($accommodation->email))
                                        <a href="{{ $accommodation->email_url ?? 'mailto:' . $accommodation->email }}"
                                            class="flex items-center gap-2.5 sm:gap-3 p-2.5 sm:p-3 bg-gradient-to-r from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-lg sm:rounded-xl hover:shadow-md border border-[#0194F3]/15 transition-all group min-w-0">
                                            <div
                                                class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-[#33ADFF] to-[#0194F3] rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[9px] sm:text-[10px] font-bold text-[#0194F3] uppercase tracking-wider mb-0.5">
                                                    Email
                                                </p>
                                                <p class="text-xs sm:text-sm font-semibold text-[#0F294D] dark:text-white break-all">
                                                    {{ $accommodation->email }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endif

                            @if($hasSosmed)
                                <div class="pt-3 sm:pt-4 border-t border-[#0194F3]/10">
                                    <p class="text-[10px] sm:text-xs font-bold text-[#687176] dark:text-gray-400 uppercase tracking-wider mb-2 sm:mb-3">
                                        Ikuti Kami
                                    </p>
                                    <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                        @if(!empty($accommodation->facebook))
                                            <a href="{{ $accommodation->facebook }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-[#1877F2] text-white flex items-center justify-center hover:scale-110 active:scale-95 transition-transform shadow-md"
                                                title="Facebook">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M22.675 0h-21.35C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if(!empty($accommodation->instagram))
                                            <a href="{{ $accommodation->instagram }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-gradient-to-br from-[#E1306C] to-[#C13584] text-white flex items-center justify-center hover:scale-110 active:scale-95 transition-transform shadow-md"
                                                title="Instagram">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if(!empty($accommodation->youtube))
                                            <a href="{{ $accommodation->youtube }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-[#FF0000] text-white flex items-center justify-center hover:scale-110 active:scale-95 transition-transform shadow-md"
                                                title="YouTube">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if(!empty($accommodation->x))
                                            <a href="{{ $accommodation->x }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-black text-white flex items-center justify-center hover:scale-110 active:scale-95 transition-transform shadow-md"
                                                title="X (Twitter)">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if(!empty($accommodation->tiktok))
                                            <a href="{{ $accommodation->tiktok }}" target="_blank" rel="noopener noreferrer"
                                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl bg-black text-white flex items-center justify-center hover:scale-110 active:scale-95 transition-transform shadow-md"
                                                title="TikTok">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Fasilitas --}}
                    @if($accommodation->relationLoaded('facilities') && $accommodation->facilities->count())
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2.5 sm:mb-3 flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
                                Fasilitas
                            </h2>
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                @foreach($accommodation->facilities as $facility)
                                    <span
                                        class="inline-flex items-center gap-1 sm:gap-1.5 px-2.5 sm:px-3 py-1 sm:py-1.5 bg-[#E6F4FF] text-[#0194F3] rounded-full text-[10px] sm:text-xs font-medium border border-[#B3E0FF]">
                                        <i class="{{ $facility->icon ?: 'fas fa-check' }} w-3 h-3 flex-shrink-0"></i>
                                        {{ $facility->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Peraturan --}}
                    @if($accommodation->relationLoaded('rules') && $accommodation->rules->count())
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-red-200 dark:border-red-900/40 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-3 sm:mb-4 flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-red-500 to-red-700 rounded-full flex-shrink-0"></span>
                                Aturan Penginapan
                            </h2>

                            <ul class="space-y-2 sm:space-y-3">
                                @foreach($accommodation->rules as $rule)
                                    <li
                                        class="flex items-start gap-2.5 sm:gap-3 p-2.5 sm:p-3 bg-red-50 dark:bg-red-900/10 rounded-lg sm:rounded-xl border border-red-200 dark:border-red-800/40 min-w-0">
                                        <div
                                            class="flex-shrink-0 w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-red-500 flex items-center justify-center shadow-sm mt-0.5">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
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
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-md hover:shadow-lg border border-[#0194F3]/10 p-4 sm:p-6 transition-shadow min-w-0 overflow-hidden">
                            <h2 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2.5 sm:mb-3 flex items-center gap-2">
                                <span class="w-1 h-4 sm:h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full flex-shrink-0"></span>
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
                                <div class="rounded-lg sm:rounded-xl overflow-hidden border border-[#0194F3]/20">
                                    {!! $embed !!}
                                </div>
                            @endif

                            @if($accommodation->google_maps_url)
                                <a href="{{ $accommodation->google_maps_url }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 mt-2.5 sm:mt-3 text-[11px] sm:text-xs text-[#0194F3] dark:text-[#33ADFF] hover:underline font-semibold">
                                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka di Google Maps
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- KANAN: INFO CARD — Mobile order-1 agar muncul di atas --}}
                <div class="lg:col-span-1 order-1 lg:order-2 w-full min-w-0">
                    <div
                        class="reveal-on-scroll lg:sticky lg:top-24 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow-xl border border-[#0194F3]/15 overflow-hidden w-full">

                        <div class="relative bg-gradient-to-br from-[#0194F3] via-[#0064D2] to-[#0F294D] p-4 sm:p-6 overflow-hidden">
                            <div class="absolute inset-0 opacity-10"
                                style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                            </div>
                            <div class="absolute -top-10 -right-10 w-24 h-24 sm:w-32 sm:h-32 bg-white/10 rounded-full blur-2xl"></div>

                            <div class="relative">
                                <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-white/80 font-bold mb-0.5 sm:mb-1">
                                    Harga per malam
                                </p>
                                <div class="flex items-baseline gap-1 flex-wrap">
                                    <span class="text-2xl xs:text-2xl sm:text-3xl font-bold text-white">
                                        Rp {{ number_format($accommodation->price ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs sm:text-sm text-white/70">/malam</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-6">
                            <div class="space-y-2.5 sm:space-y-3 text-xs sm:text-sm">
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-[#687176] dark:text-gray-400 flex-shrink-0">Kategori</span>
                                    <span class="font-semibold text-[#0F294D] dark:text-white text-right break-words min-w-0">{{ $categoryName }}</span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-[#687176] dark:text-gray-400 flex-shrink-0">Kapasitas</span>
                                    <span class="font-semibold text-[#0F294D] dark:text-white text-right">
                                        {{ $accommodation->capacity ?? '-' }} orang
                                    </span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-[#687176] dark:text-gray-400 flex-shrink-0">Rating</span>
                                    <span class="inline-flex items-center gap-1 font-semibold text-[#0F294D] dark:text-white">
                                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ number_format($avgRating, 1) }}
                                        <span class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">({{ $totalReviews }})</span>
                                    </span>
                                </div>
                                <div class="flex justify-between items-center gap-2">
                                    <span class="text-[#687176] dark:text-gray-400 flex-shrink-0">Status</span>
                                    <span
                                        class="inline-flex items-center gap-1 font-semibold {{ $accommodation->status === 'Available' ? 'text-[#00DD73]' : 'text-red-500' }}">
                                        <span
                                            class="w-1.5 h-1.5 rounded-full {{ $accommodation->status === 'Available' ? 'bg-[#00DD73]' : 'bg-red-500' }}"></span>
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 sm:mt-6 space-y-2 sm:space-y-3">
                                <button type="button" id="openRatingModalCta"
                                    class="w-full inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white font-semibold rounded-lg text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Tulis Ulasan
                                </button>

                                @if($categorySlug)
                                    <a href="{{ $categoryUrl }}"
                                        class="w-full inline-flex items-center justify-center gap-1.5 sm:gap-2 border-2 border-[#0194F3] text-[#0194F3] hover:bg-[#0194F3] hover:text-white font-semibold rounded-lg text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 transition-all">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Lihat {{ $categoryName }} Lainnya
                                    </a>
                                @endif
                            </div>

                            <p class="mt-3 sm:mt-4 text-[10px] sm:text-xs text-gray-400 text-center">
                                Harga dapat berubah sewaktu-waktu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== MODAL GALERI ===================== --}}
    <div id="galleryModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-2 xs:p-3 sm:p-4 opacity-0 transition-opacity duration-300 overflow-hidden">

        <div class="relative w-full sm:max-w-5xl max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-xl sm:rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300"
            id="galleryModalContent">

            <div
                class="flex items-center justify-between px-3 xs:px-4 sm:px-5 py-2.5 sm:py-3.5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-900 flex-shrink-0">
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div
                        class="w-8 h-8 sm:w-9 sm:h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3] dark:text-[#33ADFF]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white truncate">
                            Galeri {{ $accommodation->title }}
                        </h3>
                        <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">
                            <span id="galleryCounter">1</span> dari <span id="galleryTotal">{{ $totalImages }}</span> foto
                        </p>
                    </div>
                </div>

                <button type="button" id="closeGalleryModal"
                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-[#687176] dark:text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 transition-colors flex-shrink-0"
                    title="Tutup (Esc)">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[250px] sm:min-h-[300px]">
                <button type="button" id="galleryPrev"
                    class="absolute left-1.5 sm:left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all hover:scale-110">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <img id="galleryMainImage" src="" alt="Foto"
                    class="max-w-full max-h-[50vh] xs:max-h-[55vh] sm:max-h-[60vh] object-contain transition-opacity duration-300 select-none">

                <button type="button" id="galleryNext"
                    class="absolute right-1.5 sm:right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all hover:scale-110">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <button type="button" id="galleryFullscreen"
                    class="absolute top-1.5 sm:top-3 right-1.5 sm:right-3 z-10 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all"
                    title="Buka di tab baru">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </button>
            </div>

            <div class="px-2 xs:px-3 sm:px-5 py-2 sm:py-3 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-700 flex-shrink-0">
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

        /* Clip semua section agar dekorasi blur tidak meluber */
        section {
            overflow-x: clip;
            width: 100%;
            max-width: 100vw;
        }

        /* ============================================
           CONTAINER — AMAN DI SEMUA BREAKPOINT
           ============================================ */
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

        /* ============================================
           SEMUA GRID — CEGAH OVERFLOW
           ============================================ */
        .grid {
            min-width: 0;
        }

        .grid > * {
            min-width: 0;
        }

        /* ============================================
           TEXT OVERFLOW FIX
           ============================================ */
        h1, h2, h3, h4, h5, h6, p, span, a {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        /* ============================================
           GALLERY THUMB SCROLLBAR
           ============================================ */
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

        /* ============================================
           REVEAL ANIMATION
           ============================================ */
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

        /* ============================================
           SAFE AREA (iPhone notch / home indicator)
           ============================================ */
        @supports (padding: env(safe-area-inset-bottom)) {
            body {
                padding-bottom: env(safe-area-inset-bottom);
            }
        }

        /* ============================================
           XS BREAKPOINT SUPPORT (<400px)
           ============================================ */
        @media (max-width: 400px) {
            .container {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        /* ============================================
           HAPUS TAP HIGHLIGHT DI MOBILE
           ============================================ */
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
                        btn.className = 'gallery-thumb-item flex-shrink-0 w-14 h-14 xs:w-16 xs:h-16 sm:w-20 sm:h-20 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-all hover:scale-105';
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
                            iconEl.style.transform = 'rotate(180deg)';
                        } else {
                            textEl.textContent = 'Lihat semua ulasan ({{ $totalReviews }})';
                            iconEl.style.transform = 'rotate(0deg)';
                            const reviewSection = document.getElementById('reviewsContainer');
                            if (reviewSection) {
                                reviewSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        }
                    });
                }

                /* ============================================================
                 * DEBUG: DETEKSI ELEMEN OVERFLOW (hapus setelah fix)
                 * ============================================================ */
                if (window.innerWidth <= 768) {
                    setTimeout(function () {
                        const viewportWidth = document.documentElement.clientWidth;
                        const overflows = [];
                        document.querySelectorAll('*').forEach(el => {
                            const rect = el.getBoundingClientRect();
                            if (rect.right > viewportWidth + 2 || rect.left < -2) {
                                overflows.push({
                                    tag: el.tagName,
                                    cls: (el.className || '').toString().substring(0, 80),
                                    right: rect.right.toFixed(1),
                                    left: rect.left.toFixed(1)
                                });
                            }
                        });
                        if (overflows.length) {
                            console.group('⚠️ ELEMEN OVERFLOW DITEMUKAN:', overflows.length);
                            console.table(overflows);
                            console.groupEnd();
                        } else {
                            console.log('✅ Tidak ada elemen overflow — horizontal scroll fixed!');
                        }
                    }, 1000);
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
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50 text-gray-700"
                                >
                                <button
                                    type="button"
                                    onclick="copyShareLink()"
                                    class="px-4 py-2 bg-[#0194F3] hover:bg-[#0064D2] text-white text-sm font-semibold rounded-lg whitespace-nowrap">
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
            });
        </script>
    @endpush
@endsection