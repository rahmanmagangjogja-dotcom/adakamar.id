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

    <!-- ==================== DAFTAR SEMUA PENGINAPAN ==================== -->
    <section class="reveal-on-scroll pt-24 pb-12 sm:pb-16 lg:pb-20 bg-gradient-to-b from-[#E6F4FF] via-[#F7F9FC] to-white dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 min-h-screen relative overflow-hidden">

        {{-- Background decorative blobs --}}
        <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>

        {{-- ===================== CONTAINER UTAMA ===================== --}}
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">

            {{-- ===================== HEADER SECTION ===================== --}}
            <div
                class="reveal-on-scroll flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10 gap-4 sm:gap-6 border-b border-gray-300 dark:border-gray-600 pb-4">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-1">
                        — Direktori
                    </span>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2">
                        Katalog <span class="text-[#0194F3]">Akomodasi</span>
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Akses beragam opsi penginapan berkualitas untuk menunjang kenyamanan Anda
                    </p>
                </div>
                <a href="{{ route('landingpage') }}#penginapan"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-sm bg-white dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] border border-gray-300 dark:border-gray-600 hover:bg-[#0194F3] hover:text-white transition-all shadow-sm font-bold text-xs sm:text-sm group self-start sm:self-auto uppercase tracking-wide">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- ===================== SEARCH & FILTER BAR ===================== --}}
            <div class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-md shadow-sm p-4 mb-8 border border-gray-300 dark:border-gray-600">
                <form action="{{ route('accommodationlanding.semua') }}" method="GET" class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3">

                    {{-- 1. Input Nama / Lokasi --}}
                    <div class="flex-1 relative flex items-center bg-gray-50 dark:bg-gray-700/50 rounded-sm px-3.5 py-2.5 border border-gray-300 dark:border-gray-600 focus-within:border-[#0194F3] focus-within:ring-1 focus-within:ring-[#0194F3] transition-all">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 mr-2.5 flex-shrink-0"></i>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-0.5">Cari Penginapan</label>
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Nama Penginapan"
                                class="w-full p-0 border-0 bg-transparent text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 font-medium">
                        </div>
                    </div>

                    {{-- 2. Custom Dropdown Kategori --}}
                    <div class="w-full lg:w-48 xl:w-52 relative bg-gray-50 dark:bg-gray-700/50 rounded-sm px-3.5 py-2.5 border border-gray-300 dark:border-gray-600 focus-within:border-[#0194F3] focus-within:ring-1 focus-within:ring-[#0194F3] transition-all" id="heroCategoryWrapDesktop">
                        <div class="flex items-center gap-1.5 mb-0.5">
                            <i data-lucide="layout-grid" class="w-3.5 h-3.5 text-gray-400"></i>
                            <label class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Kategori</label>
                        </div>

                        {{-- Hidden native select (menyimpan value untuk form) --}}
                        <select name="category_id" id="heroCategoryDesktop" class="sr-only" tabindex="-1">
                            <option value="">Semua Kategori</option>
                            @if(isset($categories) && $categories->count())
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id || request('category') === $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>

                        {{-- Tombol Trigger --}}
                        <button type="button" id="heroCategoryTriggerDesktop"
                            class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                            <span id="heroCategoryLabelDesktop" class="truncate">
                                @php
                                    $selectedCatName = 'Semua Kategori';
                                    if(isset($categories) && request('category_id')) {
                                        $foundCat = $categories->firstWhere('id', request('category_id'));
                                        if($foundCat) $selectedCatName = $foundCat->name;
                                    } elseif(isset($categories) && request('category')) {
                                        $foundCat = $categories->firstWhere('slug', request('category'));
                                        if($foundCat) $selectedCatName = $foundCat->name;
                                    }
                                @endphp
                                {{ $selectedCatName }}
                            </span>
                            <i data-lucide="chevron-down" id="heroCategoryChevronDesktop" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                        </button>

                        {{-- Panel Dropdown --}}
                        <div id="heroCategoryPanelDesktop"
                            class="hidden absolute left-0 top-full mt-2 z-50 w-52 bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                            <ul class="py-1 max-h-56 overflow-y-auto text-sm">
                                <li>
                                    <button type="button" data-value="" data-label="Semua Kategori"
                                        class="hero-cat-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 {{ !request('category_id') && !request('category') ? 'is-selected bg-[#E6F4FF] dark:bg-[#0194F3]/20' : '' }}">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon {{ !request('category_id') && !request('category') ? '' : 'opacity-0' }}"></i>
                                        Semua Kategori
                                    </button>
                                </li>
                                @if(isset($categories) && $categories->count())
                                    @foreach($categories as $category)
                                    @php
                                        $isCatSelected = (string) request('category_id') === (string) $category->id || request('category') === $category->slug;
                                    @endphp
                                    <li>
                                        <button type="button" data-value="{{ $category->id }}" data-label="{{ $category->name }}"
                                            class="hero-cat-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 {{ $isCatSelected ? 'is-selected bg-[#E6F4FF] dark:bg-[#0194F3]/20' : '' }}">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon {{ $isCatSelected ? '' : 'opacity-0' }}"></i>
                                            {{ $category->name }}
                                        </button>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- 3. Custom Dropdown Fasilitas --}}
                    <div class="w-full lg:w-48 xl:w-52 relative bg-gray-50 dark:bg-gray-700/50 rounded-sm px-3.5 py-2.5 border border-gray-300 dark:border-gray-600 focus-within:border-[#0194F3] focus-within:ring-1 focus-within:ring-[#0194F3] transition-all" id="heroFacilityWrapDesktop">
                        <div class="flex items-center gap-1.5 mb-0.5">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-gray-400"></i>
                            <label class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Fasilitas</label>
                        </div>

                        {{-- Hidden native select (menyimpan value untuk form) --}}
                        <select name="facility_id" id="heroFacilityDesktop" class="sr-only" tabindex="-1">
                            <option value="">Semua Fasilitas</option>
                            @if(isset($facilities) && $facilities->count())
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}" {{ (string) request('facility_id') === (string) $facility->id || request('facility') === $facility->name ? 'selected' : '' }}>
                                        {{ $facility->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>

                        {{-- Tombol Trigger --}}
                        <button type="button" id="heroFacilityTriggerDesktop"
                            class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                            <span id="heroFacilityLabelDesktop" class="truncate">
                                @php
                                    $selectedFacName = 'Semua Fasilitas';
                                    if(isset($facilities) && request('facility_id')) {
                                        $foundFac = $facilities->firstWhere('id', request('facility_id'));
                                        if($foundFac) $selectedFacName = $foundFac->name;
                                    } elseif(isset($facilities) && request('facility')) {
                                        $foundFac = $facilities->firstWhere('name', request('facility'));
                                        if($foundFac) $selectedFacName = $foundFac->name;
                                    }
                                @endphp
                                {{ $selectedFacName }}
                            </span>
                            <i data-lucide="chevron-down" id="heroFacilityChevronDesktop" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                        </button>

                        {{-- Panel Dropdown --}}
                        <div id="heroFacilityPanelDesktop"
                            class="hidden absolute left-0 top-full mt-2 z-50 w-52 bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                            <ul class="py-1 max-h-56 overflow-y-auto text-sm">
                                <li>
                                    <button type="button" data-value="" data-label="Semua Fasilitas"
                                        class="hero-fac-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 {{ !request('facility_id') && !request('facility') ? 'is-selected bg-[#E6F4FF] dark:bg-[#0194F3]/20' : '' }}">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon {{ !request('facility_id') && !request('facility') ? '' : 'opacity-0' }}"></i>
                                        Semua Fasilitas
                                    </button>
                                </li>
                                @if(isset($facilities) && $facilities->count())
                                    @foreach($facilities as $facility)
                                    @php
                                        $isFacSelected = (string) request('facility_id') === (string) $facility->id || request('facility') === $facility->name;
                                    @endphp
                                    <li>
                                        <button type="button" data-value="{{ $facility->id }}" data-label="{{ $facility->name }}"
                                            class="hero-fac-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 {{ $isFacSelected ? 'is-selected bg-[#E6F4FF] dark:bg-[#0194F3]/20' : '' }}">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon {{ $isFacSelected ? '' : 'opacity-0' }}"></i>
                                            {{ $facility->name }}
                                        </button>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- 3. Filter Harga Maksimal --}}
                    <div class="w-full lg:w-64 relative bg-gray-50 dark:bg-gray-700/50 rounded-sm px-3.5 py-2.5 border border-gray-300 dark:border-gray-600 focus-within:border-[#0194F3] focus-within:ring-1 focus-within:ring-[#0194F3] transition-all">
                        <div class="flex items-center justify-between mb-1">
                            <label class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Harga Max/malam</label>
                            <span id="pagePricePreview" class="text-xs font-bold text-[#0194F3] dark:text-[#33ADFF]">
                                @if(request('max_price') && (float) request('max_price') < 10000000 && (float) request('max_price') > 50000)
                                    s/d Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                                @else
                                    Hingga 10 jt
                                @endif
                            </span>
                        </div>
                        <input type="range" name="max_price" id="pagePriceSlider" min="50000" max="10000000" step="50000"
                            value="{{ request('max_price') && (float) request('max_price') < 10000000 ? request('max_price') : 10000000 }}"
                            class="w-full h-1.5 bg-gray-200 dark:bg-gray-600 rounded-sm appearance-none cursor-pointer accent-[#0194F3]">
                    </div>

                    {{-- 4. Action Buttons --}}
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 bg-[#0194F3] hover:bg-[#0064D2] text-white px-5 py-3 rounded-sm font-bold text-sm shadow-sm transition-all cursor-pointer">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Cari</span>
                        </button>

                        @if(request()->hasAny(['keyword', 'category_id', 'category', 'facility_id', 'facility', 'max_price', 'min_price']))
                            <a href="{{ route('accommodationlanding.semua') }}" title="Reset Filter"
                                class="inline-flex items-center justify-center p-3 rounded-sm bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 transition-colors border border-gray-300 dark:border-gray-600">
                                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Active Filter Tags & Count --}}
                @if(request()->hasAny(['keyword', 'category_id', 'category', 'facility_id', 'facility', 'max_price', 'min_price']))
                    @php
    $activeCat = null;
    if (isset($categories)) {
        if (request('category_id')) {
            $activeCat = $categories->firstWhere('id', request('category_id'));
        } elseif (request('category')) {
            $activeCat = $categories->firstWhere('slug', request('category'));
        }
    }
    $activeFac = null;
    if (isset($facilities)) {
        if (request('facility_id')) {
            $activeFac = $facilities->firstWhere('id', request('facility_id'));
        } elseif (request('facility')) {
            $activeFac = $facilities->firstWhere('name', request('facility'));
        }
    }
                    @endphp
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 flex flex-wrap items-center justify-between gap-3 text-xs">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wide">Filter aktif:</span>
                            @if(request('keyword'))
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-sm bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] font-bold border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    "{{ request('keyword') }}"
                                </span>
                            @endif
                            @if($activeCat)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-sm bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] font-bold border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    Kategori: {{ $activeCat->name }}
                                </span>
                            @endif
                            @if($activeFac)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-sm bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] font-bold border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    Fasilitas: {{ $activeFac->name }}
                                </span>
                            @endif
                            @if(request('max_price') && (float) request('max_price') < 10000000 && (float) request('max_price') > 50000)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-sm bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] font-bold border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                    Max: Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                                </span>
                            @endif
                            <a href="{{ route('accommodationlanding.semua') }}" class="text-red-500 hover:text-red-600 hover:underline font-bold ml-1 flex items-center gap-1">
                                <i data-lucide="x" class="w-3 h-3"></i> Hapus semua
                            </a>
                        </div>
                        <span class="text-gray-500 dark:text-gray-400 font-medium">
                            Ditemukan <strong class="text-[#0F294D] dark:text-white">{{ $accommodations->total() }}</strong> penginapan
                        </span>
                    </div>
                @endif
            </div>

            {{-- ===================== GRID PENGINAPAN ===================== --}}
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

        // ====== RATING ======
        if (isset($accommodation->avg_rating) || isset($accommodation->total_ratings)) {
            $avgRating = round($accommodation->avg_rating ?? 0, 1);
            $reviewCount = $accommodation->total_ratings ?? 0;
        } elseif ($accommodation->relationLoaded('ratings')) {
            $avgRating = $accommodation->ratings->count() ? round($accommodation->ratings->avg('bintang'), 1) : 0;
            $reviewCount = $accommodation->ratings->count();
        } else {
            $avgRating = round($accommodation->ratings()->avg('bintang') ?? 0, 1);
            $reviewCount = $accommodation->ratings()->count();
        }

        // ====== FASILITAS ======
        $facilitiesData = $accommodation->relationLoaded('facilities')
            ? $accommodation->facilities
            : $accommodation->facilities()->get();
                        @endphp

                        <div class="accommodation-card reveal-on-scroll bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-300 dark:border-gray-600 hover:border-[#0194F3] group flex flex-col {{ !$isAvailable ? 'opacity-75' : '' }}"
                            data-price="{{ $accommodation->price }}">

                            {{-- BAGIAN GAMBAR --}}
                            <div class="relative overflow-hidden flex-shrink-0 border-b border-gray-200 dark:border-gray-700">
                                @if($accommodation->thumbnail)
                                    <img src="{{ asset($accommodation->thumbnail) }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @else
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @endif

                                <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/70 via-black/20 to-transparent pointer-events-none"></div>

                                {{-- RATING BADGE --}}
                                <div class="absolute top-3 left-3 inline-flex items-center gap-1 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-2.5 py-1 rounded-sm shadow-sm border border-gray-200 dark:border-gray-600">
                                    @if($reviewCount > 0)
                                        <i data-lucide="star" class="w-3.5 h-3.5 text-[#FFD700]" style="fill:#FFD700;"></i>
                                        <span class="text-xs font-bold text-[#0F294D] dark:text-white">{{ number_format($avgRating, 1) }}</span>
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400">({{ $reviewCount }})</span>
                                    @else
                                        <i data-lucide="star" class="w-3.5 h-3.5 text-gray-400"></i>
                                        <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase">Baru</span>
                                    @endif
                                </div>

                                {{-- STATUS BADGE --}}
                                <span class="absolute top-3 right-3 {{ $status[0] }} text-white px-2.5 py-1 rounded-sm text-[10px] font-bold uppercase shadow-sm tracking-wide">
                                    {{ $status[1] }}
                                </span>

                                {{-- KATEGORI --}}
                                <span class="absolute bottom-3 left-3 bg-[#0194F3] text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-sm shadow-sm">
                                    {{ $accommodation->category->name ?? 'Penginapan' }}
                                </span>
                            </div>

                            {{-- BAGIAN KONTEN --}}
                            <div class="p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-[#0F294D] dark:text-white text-base mb-1.5 truncate group-hover:text-[#0194F3] transition-colors">
                                    {{ $accommodation->title }}
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 text-[11px] sm:text-xs mb-3 flex items-center gap-1.5 truncate">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#0194F3] flex-shrink-0"></i>
                                    {{ Str::limit($accommodation->address, 35) }}
                                </p>

                                {{-- FASILITAS DINAMIS --}}
                                <div class="flex flex-wrap items-center gap-1.5 mb-4 h-8">
                                    @if($facilitiesData->count() > 0)
                                        @foreach($facilitiesData->take(5) as $facility)
                                            <div class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 dark:bg-gray-700 rounded-sm border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300" title="{{ $facility->name }}">
                                                @php
                $iconRaw = $facility->icon;
                $iconLucide = $iconRaw && preg_match('/^[a-z0-9-]+$/i', $iconRaw);
                $iconSvg = $iconRaw && (Str::startsWith($iconRaw, ['M', 'm']) || Str::startsWith($iconRaw, '<'));
                $iconEmoji = $iconRaw && !$iconLucide && !$iconSvg;
                                                @endphp

                                                @if($iconLucide)
                                                    <i data-lucide="{{ $iconRaw }}" class="w-3.5 h-3.5"></i>
                                                @elseif($iconSvg)
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconRaw }}" />
                                                    </svg>
                                                @elseif($iconEmoji)
                                                    <span class="text-xs leading-none">{{ $iconRaw }}</span>
                                                @else
                                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                                @endif
                                            </div>
                                        @endforeach

                                        @if($facilitiesData->count() > 5)
                                            <div class="inline-flex items-center justify-center px-1.5 h-7 bg-gray-200 dark:bg-gray-700 rounded-sm text-[10px] font-bold text-gray-600 dark:text-gray-300" title="Fasilitas lainnya">
                                                +{{ $facilitiesData->count() - 5 }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-[10px] text-gray-400 dark:text-gray-500 italic">Tidak ada fasilitas</span>
                                    @endif
                                </div>

                                {{-- HARGA & TOMBOL --}}
                                <div class="mt-auto border-t border-gray-200 dark:border-gray-700 pt-3">
                                    <div class="flex items-baseline gap-1 mb-3">
                                        <span class="text-[#0194F3] font-bold text-lg">Rp {{ number_format($accommodation->price, 0, ',', '.') }}</span>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs font-bold">/malam</span>
                                    </div>

                                    @if($isAvailable)
                                        <a href="{{ route('accommodationlanding.detail', $accommodation->slug) }}"
                                            class="block w-full text-center bg-[#0194F3] text-white py-2 rounded-sm hover:bg-[#0064D2] transition-colors text-xs font-bold uppercase tracking-wide">
                                            Lihat Detail
                                        </a>
                                    @else
                                        <button disabled class="block w-full text-center bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 py-2 rounded-sm cursor-not-allowed text-xs font-bold uppercase tracking-wide border border-gray-300 dark:border-gray-600">
                                            Tidak Tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ===================== PAGINATION ===================== --}}
                @if($accommodations->hasPages())
                    <div class="reveal-on-scroll mt-10 sm:mt-14 flex justify-center">
                        {{ $accommodations->links() }}
                    </div>
                @endif
            @else
                {{-- ===================== EMPTY STATE ===================== --}}
                <div class="reveal-on-scroll text-center py-16 sm:py-20 bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-300 dark:border-gray-600">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <i data-lucide="search-x" class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400"></i>
                    </div>

                    @if(request()->hasAny(['keyword', 'category_id', 'category', 'facility_id', 'facility', 'max_price', 'min_price']))
                        <h3 class="text-lg font-bold text-[#0F294D] dark:text-white mb-2 uppercase tracking-wide">Penginapan Tidak Ditemukan</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6 px-4">
                            Tidak ada penginapan yang cocok dengan kriteria pencarian Anda. Silakan coba ubah kata kunci atau reset filter.
                        </p>
                        <a href="{{ route('accommodationlanding.semua') }}"
                            class="inline-flex items-center gap-2 bg-[#0194F3] text-white px-5 py-2 rounded-sm font-bold text-xs uppercase tracking-wide hover:bg-[#0064D2] transition-all shadow-sm">
                            <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset Filter Pencarian
                        </a>
                    @else
                        <h3 class="text-lg font-bold text-[#0F294D] dark:text-white mb-2 uppercase tracking-wide">Belum Ada Penginapan</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6 px-4">
                            Saat ini belum ada penginapan yang tersedia. Silakan periksa kembali nanti.
                        </p>
                        <a href="{{ route('landingpage') }}"
                            class="inline-flex items-center gap-2 bg-[#0194F3] text-white px-5 py-2 rounded-sm font-bold text-xs uppercase tracking-wide hover:bg-[#0064D2] transition-all shadow-sm">
                            <i data-lucide="home" class="w-4 h-4"></i> Kembali ke Beranda
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // ==================== GLOBAL LOADER ====================
                const loader = document.getElementById('globalLoader');
                if (loader) {
                    setTimeout(() => {
                        loader.classList.add('opacity-0', 'pointer-events-none');
                        setTimeout(() => loader.remove(), 500);
                    }, 300);
                }

                // ==================== SLIDER HARGA ====================
                const pageSlider = document.getElementById('pagePriceSlider');
                const pagePreview = document.getElementById('pagePricePreview');
                if (pageSlider && pagePreview) {
                    pageSlider.addEventListener('input', function() {
                        const val = parseInt(this.value, 10);
                        if (val >= 10000000) {
                            pagePreview.textContent = 'Hingga 10 jt';
                        } else if (val >= 1000000) {
                            const jt = val / 1000000;
                            pagePreview.textContent = 's/d ' + (jt % 1 === 0 ? jt : jt.toFixed(1)) + ' jt';
                        } else {
                            pagePreview.textContent = 's/d ' + (val / 1000) + ' rb';
                        }
                    });
                }

                // ==================== CUSTOM DROPDOWNS (KATEGORI & FASILITAS) ====================
                function setupPageDropdown(wrapId, triggerId, panelId, labelId, chevronId, selectId, optClass) {
                    const wrap = document.getElementById(wrapId);
                    const trigger = document.getElementById(triggerId);
                    const panel = document.getElementById(panelId);
                    const label = document.getElementById(labelId);
                    const chevron = document.getElementById(chevronId);
                    const nativeSelect = document.getElementById(selectId);
                    const options = document.querySelectorAll('.' + optClass);

                    if (wrap && trigger && panel) {
                        // Toggle panel saat trigger diklik
                        trigger.addEventListener('click', function (e) {
                            e.stopPropagation();
                            const isHidden = panel.classList.contains('hidden');

                            // Tutup panel dropdown lain jika sedang terbuka
                            ['heroCategoryPanelDesktop', 'heroFacilityPanelDesktop'].forEach(pId => {
                                if (pId !== panelId) {
                                    const otherP = document.getElementById(pId);
                                    if (otherP) otherP.classList.add('hidden');
                                }
                            });
                            ['heroCategoryChevronDesktop', 'heroFacilityChevronDesktop'].forEach(cId => {
                                if (cId !== chevronId) {
                                    const otherC = document.getElementById(cId);
                                    if (otherC) otherC.style.transform = 'rotate(0deg)';
                                }
                            });

                            panel.classList.toggle('hidden');
                            if (chevron) {
                                chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                            }
                            if (isHidden && window.lucide) {
                                lucide.createIcons();
                            }
                        });

                        // Handle pilihan opsi
                        options.forEach(opt => {
                            opt.addEventListener('click', function (e) {
                                e.stopPropagation();
                                const value = this.dataset.value;
                                const textLabel = this.dataset.label;

                                // Update label teks trigger
                                if (label) label.textContent = textLabel;

                                // Update hidden native select
                                if (nativeSelect) {
                                    nativeSelect.value = value;
                                    nativeSelect.dispatchEvent(new Event('change'));
                                }

                                // Update visual tanda centang
                                options.forEach(o => {
                                    const icon = o.querySelector('.check-icon');
                                    if (icon) icon.classList.add('opacity-0');
                                    o.classList.remove('is-selected', 'bg-[#E6F4FF]', 'dark:bg-[#0194F3]/20');
                                });
                                const activeIcon = this.querySelector('.check-icon');
                                if (activeIcon) activeIcon.classList.remove('opacity-0');
                                this.classList.add('is-selected', 'bg-[#E6F4FF]', 'dark:bg-[#0194F3]/20');

                                // Tutup panel
                                panel.classList.add('hidden');
                                if (chevron) chevron.style.transform = 'rotate(0deg)';
                            });
                        });

                        // Tutup dropdown jika klik di luar area
                        document.addEventListener('click', function (e) {
                            if (!wrap.contains(e.target)) {
                                panel.classList.add('hidden');
                                if (chevron) chevron.style.transform = 'rotate(0deg)';
                            }
                        });
                    }
                }

                setupPageDropdown('heroCategoryWrapDesktop', 'heroCategoryTriggerDesktop', 'heroCategoryPanelDesktop', 'heroCategoryLabelDesktop', 'heroCategoryChevronDesktop', 'heroCategoryDesktop', 'hero-cat-opt-desktop');
                setupPageDropdown('heroFacilityWrapDesktop', 'heroFacilityTriggerDesktop', 'heroFacilityPanelDesktop', 'heroFacilityLabelDesktop', 'heroFacilityChevronDesktop', 'heroFacilityDesktop', 'hero-fac-opt-desktop');

                // ==================== REVEAL ON SCROLL ====================
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