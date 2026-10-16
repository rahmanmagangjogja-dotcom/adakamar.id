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
                    <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-[#0194F3] border-r-[#0194F3] animate-spin"></div>
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

        <!-- ==================== HERO SECTION (BERANDA) ==================== -->
        <section id="beranda"
            class="reveal-on-scroll relative min-h-[600px] sm:min-h-screen flex items-center pt-24 sm:pt-28 lg:pt-20 pb-12 sm:pb-16 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ $banner && $banner->image ? asset($banner->image) : asset('landingpage/herosection.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0064D2]/70 via-[#0194F3]/40 to-transparent sm:from-[#0064D2]/50 sm:via-[#0194F3]/20 dark:from-[#0B1B33]/80 dark:via-[#0E2340]/50 sm:dark:from-[#0B1B33]/60 sm:dark:via-[#0E2340]/30"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0064D2]/50 via-transparent to-transparent sm:from-[#0064D2]/30 dark:from-[#0B1B33]/50 sm:dark:from-[#0B1B33]/40"></div>

            <div class="relative container mx-auto px-4 sm:px-6 z-10">
                <div class="max-w-2xl text-white">
                    <span class="inline-block bg-[#0194F3] text-white text-[10px] sm:text-xs font-bold px-3 sm:px-4 py-1.5 rounded-full mb-4 sm:mb-5 shadow-lg">
                        #caridisiniaja
                    </span>

                    @if($banner)
                        <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 sm:mb-5 drop-shadow-lg">
                            {{ $banner->title }}
                        </h1>
                        @if($banner->subtitle)
                            <p class="text-sm sm:text-lg md:text-xl text-white/95 mb-6 sm:mb-8 drop-shadow">
                                {{ $banner->subtitle }}
                            </p>
                        @endif
                    @else
                        <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 sm:mb-5 drop-shadow-lg">
                            Temukan Penginapan <br class="hidden sm:block">Terbaik untuk Anda
                        </h1>
                        <p class="text-sm sm:text-lg md:text-xl text-white/95 mb-6 sm:mb-8 drop-shadow">
                            Nikmati pengalaman menginap yang nyaman dengan berbagai pilihan kamar, villa, dan guest house berkualitas.
                        </p>
                    @endif

                    <div class="flex flex-col sm:flex-row flex-wrap gap-3">
                        <a href="#penginapan"
                            class="inline-flex items-center justify-center gap-2 bg-[#0194F3] text-white px-5 sm:px-7 py-3 sm:py-3.5 rounded-lg font-semibold text-sm sm:text-base hover:bg-[#0064D2] transition-all shadow-lg hover:shadow-2xl sm:hover:-translate-y-0.5">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari Penginapan
                        </a>
                        <a href="#tentang"
                            class="inline-flex items-center justify-center gap-2 border-2 border-white text-white px-5 sm:px-7 py-3 sm:py-3.5 rounded-lg font-semibold text-sm sm:text-base hover:bg-white hover:text-[#0194F3] transition-all backdrop-blur-sm">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tentang Kami
                        </a>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-4 sm:gap-x-6 gap-y-3 mt-8 sm:mt-10 pt-6 border-t border-white/20">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-white font-medium drop-shadow">Terpercaya</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-white font-medium drop-shadow">Harga Terbaik</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-white font-medium drop-shadow">Booking Mudah</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- ==================== TENTANG KAMI ==================== -->
    <section id="tentang" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">

                {{-- ============== KIRI: LOGO ============== --}}
                <div class="order-2 lg:order-1">
                    <div class="relative flex items-center justify-center py-8 sm:py-10 lg:py-0">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-40 h-40 sm:w-56 sm:h-56 lg:w-72 lg:h-72 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-full">
                            </div>
                        </div>

                        <div
                            class="relative bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl p-6 sm:p-10 shadow-2xl border border-[#0194F3]/20 dark:border-gray-700">
                            @if(!empty($setting->logo))
                                <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name ?? '' }} Logo"
                                    class="w-32 h-32 sm:w-44 sm:h-44 lg:w-56 lg:h-56 object-contain">
                            @else
                                <img src="{{ asset('landingpage/home.png') }}" alt="{{ $setting->site_name ?? '' }} Logo"
                                    class="w-32 h-32 sm:w-44 sm:h-44 lg:w-56 lg:h-56 object-contain">
                            @endif
                        </div>

                        {{-- Badge Resmi --}}
                        <div
                            class="absolute top-0 right-0 sm:top-4 sm:right-4 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-4 sm:py-3 shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-2 sm:gap-3">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">Status</p>
                                <p class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white">Resmi</p>
                            </div>
                        </div>

                        {{-- Badge Artikel --}}
                        <div
                            class="absolute bottom-0 left-0 sm:bottom-4 sm:left-4 bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl px-3 py-2 sm:px-4 sm:py-3 shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-2 sm:gap-3">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400">Konten</p>
                                <p class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white">Terupdate</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============== KANAN: NAMA WEBSITE + TAGLINE + TENTANG ============== --}}
                <div class="order-1 lg:order-2">

                    {{-- Nama Website --}}
                    <h2
                        class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-3">
                        <span class="text-[#0194F3]">{{ $setting->site_name ?? '' }}</span>
                        <br>

                        {{-- Tagline --}}
                        @if(!empty($setting->tagline))
                            <span class="text-lg sm:text-2xl md:text-3xl text-[#687176] dark:text-gray-400">
                                {{ $setting->tagline }}
                            </span>
                        @endif
                    </h2>

                    {{-- Tentang --}}
                    @if(!empty($setting->about))
                        <p class="text-sm sm:text-base text-[#687176] dark:text-gray-400 leading-relaxed mb-6 sm:mb-8 mt-4">
                            {{ $setting->about }}
                        </p>
                    @endif

                    {{-- Keunggulan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                        <div
                            class="flex items-center gap-3 p-3 sm:p-4 bg-[#E6F4FF] dark:bg-[#0194F3]/10 rounded-2xl border border-[#0194F3]/20">
                            <div
                                class="w-10 h-10 bg-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm text-[#0F294D] dark:text-white font-semibold">Terpercaya</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 sm:p-4 bg-[#E6F4FF] dark:bg-[#0194F3]/10 rounded-2xl border border-[#0194F3]/20">
                            <div
                                class="w-10 h-10 bg-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>
                            <span class="text-sm text-[#0F294D] dark:text-white font-semibold">Mudah</span>
                        </div>

                        <div
                            class="flex items-center gap-3 p-3 sm:p-4 bg-[#E6F4FF] dark:bg-[#0194F3]/10 rounded-2xl border border-[#0194F3]/20">
                            <div
                                class="w-10 h-10 bg-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm text-[#0F294D] dark:text-white font-semibold">Terjangkau</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- ==================== PENGINAPAN - KATEGORI ==================== -->
        <section id="penginapan" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-[#F7F9FC] dark:bg-gray-800 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/5 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-4 sm:px-6 relative z-10">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-14 gap-4 sm:gap-6">
                    <div class="max-w-xl">
                        <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                            — Kategori
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2 sm:mb-3">
                            Jelajahi Berdasarkan <span class="text-[#0194F3]">Kategori</span>
                        </h2>
                        <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400">
                            Pilih kategori penginapan yang sesuai dengan kebutuhan Anda
                        </p>
                    </div>
                    @if($categories->count() > 3)
                        <a href="#" class="inline-flex items-center gap-2 text-[#0194F3] font-semibold text-sm sm:text-base hover:gap-3 transition-all group self-start sm:self-auto">
                            Lihat Semua Kategori
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    @endif
                </div>

                @if($categories->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 sm:gap-6">
                        @foreach($categories as $index => $category)
                            @php
        $layouts = [
            0 => 'sm:col-span-2 lg:col-span-7 lg:row-span-2 h-64 sm:h-80 lg:h-full lg:min-h-[500px]',
            1 => 'lg:col-span-5 h-56 sm:h-64 lg:h-60',
            2 => 'lg:col-span-5 h-56 sm:h-64 lg:h-60',
            3 => 'lg:col-span-4 h-56 sm:h-64 lg:h-72',
            4 => 'lg:col-span-4 h-56 sm:h-64 lg:h-72',
            5 => 'lg:col-span-4 h-56 sm:h-64 lg:h-72',
        ];
        $layout = $layouts[$index % 6] ?? 'lg:col-span-4 h-56 sm:h-64 lg:h-72';
                            @endphp

                            <a href="{{ route('accommodationlanding.category', $category->slug) }}"
                                class="reveal-on-scroll group relative overflow-hidden rounded-2xl sm:rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 lg:hover:-translate-y-2 {{ $layout }}">
                                @if($category->thumbnail)
                                    <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $category->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-[#0F294D] via-[#0F294D]/40 to-transparent group-hover:from-[#0194F3]/90 transition-all duration-500"></div>

                                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 lg:p-8">
                                    <h3 class="text-lg sm:text-2xl lg:text-3xl font-bold text-white mb-1 sm:mb-2 group-hover:text-white transition-colors">
                                        {{ $category->name }}
                                    </h3>
                                    @if($category->description)
                                        <p class="text-white/80 text-xs sm:text-sm line-clamp-2 mb-2 sm:mb-4">
                                            {{ Str::limit($category->description, 80) }}
                                        </p>
                                    @endif

                                    <span class="inline-flex items-center gap-1 text-white font-semibold text-xs sm:text-sm group-hover:gap-2 transition-all">
                                        Lihat Detail
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="absolute top-3 right-3 sm:top-4 sm:right-4 w-10 h-10 sm:w-12 sm:h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 sm:py-16">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <p class="text-base sm:text-lg text-[#687176] dark:text-gray-400">Belum ada kategori penginapan</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- ==================== GALERI ==================== -->
        <section id="galeri" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-[#F7F9FC] dark:bg-gray-800 relative overflow-hidden">
            <div class="absolute top-1/2 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#0194F3]/5 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-4 sm:px-6 relative z-10">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-14 gap-4 sm:gap-6">
                    <div class="max-w-xl">
                        <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                            — Galeri
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2 sm:mb-3">
                            Koleksi <span class="text-[#0194F3]">Foto</span> Terbaik
                        </h2>
                        <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400">
                            Koleksi foto penginapan terbaik kami
                        </p>
                    </div>
                    @if($galleries->count() > 0)

                    @endif
                </div>

                @if($galleries->count())
                    @php
    $perPage = 8;
    $currentPage = request()->get('page', 1);
    $totalItems = $galleries->count();
    $totalPages = ceil($totalItems / $perPage);
    $offset = ($currentPage - 1) * $perPage;
    $paginatedGalleries = $galleries->slice($offset, $perPage);
                    @endphp

                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
                        @foreach($paginatedGalleries as $index => $gallery)
                            <button type="button"
                                class="gallery-open-btn reveal-on-scroll text-left relative overflow-hidden rounded-xl sm:rounded-2xl group cursor-pointer shadow-md hover:shadow-2xl transition-all duration-500 aspect-[4/3] w-full"
                                data-image="{{ asset($gallery->image) }}"
                                data-title="{{ $gallery->title ?? 'Foto Galeri' }}"
                                data-index="{{ $index }}">
                                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    loading="lazy">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#0F294D]/90 via-[#0F294D]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-3 sm:p-5">
                                    <div class="transform translate-y-3 group-hover:translate-y-0 transition-transform duration-500">
                                        <span
                                            class="inline-block bg-[#0194F3] text-white text-[10px] sm:text-xs font-bold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full mb-1 sm:mb-2">
                                            Galeri
                                        </span>
                                        <h3 class="text-white font-bold text-xs sm:text-base leading-snug line-clamp-2">
                                            {{ $gallery->title }}
                                        </h3>
                                    </div>
                                </div>

                                <div
                                    class="absolute top-2 right-2 sm:top-4 sm:right-4 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 scale-75 group-hover:scale-100">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </button>
                        @endforeach
                    </div>

                    @if($totalPages > 1)
                        <div class="mt-8 sm:mt-12 flex items-center justify-center gap-1.5 sm:gap-2 flex-wrap">
                            <a href="{{ request()->fullUrlWithQuery(['page' => max(1, $currentPage - 1)]) }}#galeri"
                                class="inline-flex items-center justify-center w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-[#0F294D] dark:text-white hover:bg-[#0194F3] hover:text-white hover:border-[#0194F3] transition-all shadow-sm {{ $currentPage <= 1 ? 'pointer-events-none opacity-40' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            @for($i = 1; $i <= $totalPages; $i++)
                                @if($i == 1 || $i == $totalPages || abs($i - $currentPage) <= 1)
                                                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}#galeri"
                                                    class="inline-flex items-center justify-center w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl font-semibold text-xs sm:text-sm transition-all shadow-sm
                                                        {{ $i == $currentPage
                    ? 'bg-gradient-to-br from-[#0194F3] to-[#0064D2] text-white shadow-lg scale-105'
                    : 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-gray-800 hover:border-[#0194F3]' }}">
                                                    {{ $i }}
                                                </a>
                                @elseif(abs($i - $currentPage) == 2)
                                    <span class="px-1 sm:px-2 text-gray-400 text-xs sm:text-sm">...</span>
                                @endif
                            @endfor

                            <a href="{{ request()->fullUrlWithQuery(['page' => min($totalPages, $currentPage + 1)]) }}#galeri"
                                class="inline-flex items-center justify-center w-9 h-9 sm:w-11 sm:h-11 rounded-lg sm:rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-[#0F294D] dark:text-white hover:bg-[#0194F3] hover:text-white hover:border-[#0194F3] transition-all shadow-sm {{ $currentPage >= $totalPages ? 'pointer-events-none opacity-40' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <p class="text-center text-xs sm:text-sm text-[#687176] dark:text-gray-400 mt-3 sm:mt-4">
                            Menampilkan <span class="font-semibold text-[#0F294D] dark:text-white">{{ $offset + 1 }}</span>–<span
                                class="font-semibold text-[#0F294D] dark:text-white">{{ min($offset + $perPage, $totalItems) }}</span>
                            dari <span class="font-semibold text-[#0F294D] dark:text-white">{{ $totalItems }}</span> foto
                        </p>
                    @endif
                @else
                    <div class="text-center py-12 sm:py-16">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-[#0F294D] dark:text-gray-300 mb-2">Belum Ada Galeri</h3>
                        <p class="text-sm sm:text-base text-[#687176] dark:text-gray-400">Belum ada foto galeri yang tersedia.</p>
                    </div>
                @endif
            </div>

            <style>
                .line-clamp-2 {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }
            </style>
        </section>

        {{-- ===================== MODAL GALERI ===================== --}}
        <div id="galleryPopup"
            class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-2 sm:p-4 opacity-0 transition-opacity duration-300">

            <div id="galleryPopupContent"
                class="relative w-full max-w-5xl max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300">

                {{-- HEADER --}}
                <div class="flex items-center justify-between px-3 sm:px-5 py-2.5 sm:py-3.5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-900 flex-shrink-0">
                    <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3] dark:text-[#33ADFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 id="galleryPopupTitle" class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white truncate">
                                Foto Galeri
                            </h3>
                            <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 hidden sm:block">Tekan ESC untuk menutup</p>
                        </div>
                    </div>

                    <button type="button" id="closeGalleryPopup"
                        class="w-8 h-8 sm:w-9 sm:h-9 rounded-full flex items-center justify-center text-[#687176] dark:text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 transition-colors flex-shrink-0"
                        title="Tutup (Esc)">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- FOTO --}}
                <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[200px] sm:min-h-[300px]">
                    <img id="galleryPopupImage" src="" alt="Foto"
                        class="max-w-full max-h-[60vh] sm:max-h-[70vh] object-contain transition-opacity duration-300 select-none">

                    <button type="button" id="galleryPopupFullscreen"
                        class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all"
                        title="Buka di tab baru">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

       <!-- ==================== ARTIKEL TERBARU ==================== -->
        <section id="artikel" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-white dark:bg-gray-900">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-14 gap-4 sm:gap-6">
                    <div class="max-w-xl">
                        <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                            — Blog
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2 sm:mb-3">
                            Artikel <span class="text-[#0194F3]">Terbaru</span>
                        </h2>
                        <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400">
                            Tips dan informasi menarik seputar penginapan
                        </p>
                    </div>
                    @if($articles->count() > 0)
                        <a href="{{ route('article.semua') }}"
                            class="inline-flex items-center gap-2 text-[#0194F3] font-semibold text-sm sm:text-base hover:gap-3 transition-all group self-start sm:self-auto">
                            Lihat Semua Artikel
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    @endif
                </div>

                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        @foreach($articles as $article)
                            <article class="group cursor-pointer h-full">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 lg:hover:-translate-y-1 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
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
                                            <span class="absolute top-3 left-3 bg-[#0194F3] text-white text-[10px] sm:text-xs font-bold px-2.5 sm:px-3 py-1 rounded-full shadow-lg">
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="p-4 sm:p-6 flex flex-col flex-1">
                                        <p class="text-[10px] sm:text-xs text-[#687176] dark:text-gray-400 mb-2 flex items-center gap-1.5">
                                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#0194F3]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                        </p>

                                        <h3 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2 sm:mb-3 group-hover:text-[#0194F3] transition-colors line-clamp-2 leading-snug">
                                            {{ $article->title }}
                                        </h3>

                                        <p class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-3 flex-1">
                                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 120) }}
                                        </p>

                                        <a href="{{ route('article.detail', $article->slug) }}"
                                            class="inline-flex items-center gap-1 text-[#0194F3] font-semibold text-xs sm:text-sm group-hover:gap-2 transition-all mt-auto">
                                            Baca Selengkapnya
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 sm:py-16">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#E6F4FF] dark:bg-gray-800 flex items-center justify-center">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-[#0F294D] dark:text-white mb-2">
                            Belum Ada Artikel
                        </h3>
                        <p class="text-sm sm:text-base text-[#687176] dark:text-gray-400">
                            Artikel akan segera hadir. Silakan cek kembali nanti.
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <!-- ==================== KONTAK ==================== -->
        <section id="kontak" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-[#F7F9FC] dark:bg-gray-800 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/5 rounded-full blur-3xl"></div>

            <div class="container mx-auto px-4 sm:px-6 relative z-10">
                <div class="text-center mb-8 sm:mb-14">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                        — Kontak
                    </span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white mb-2 sm:mb-3">
                        Lokasi & <span class="text-[#0194F3]">Kontak</span>
                    </h2>
                    <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400 max-w-2xl mx-auto">
                        Kunjungi kantor kami atau hubungi kami untuk informasi lebih lanjut
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">

                    <div class="lg:col-span-5 space-y-3 sm:space-y-4">

                        @if(!empty($setting->address))
                            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-4 sm:p-5 flex items-start gap-3 sm:gap-4 hover:shadow-lg sm:hover:-translate-y-0.5 transition-all duration-300 group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] sm:text-xs font-bold text-[#0194F3] uppercase tracking-wider mb-1">Alamat</p>
                                    <p class="font-semibold text-[#0F294D] dark:text-white text-xs sm:text-sm mb-1">Kantor Pusat</p>
                                    <p class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm leading-relaxed break-words">
                                        {{ $setting->address }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if(!empty($setting->email))
                            <a href="mailto:{{ $setting->email }}"
                                class="block bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-4 sm:p-5 flex items-start gap-3 sm:gap-4 hover:shadow-lg sm:hover:-translate-y-0.5 transition-all duration-300 group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#33ADFF] to-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] sm:text-xs font-bold text-[#0194F3] uppercase tracking-wider mb-1">Email</p>
                                    <p class="font-semibold text-[#0F294D] dark:text-white text-xs sm:text-sm mb-1">Kirim Pesan</p>
                                    <p class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm break-all">
                                        {{ $setting->email }}
                                    </p>
                                </div>
                            </a>
                        @endif

                        @if(!empty($setting->phone))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->phone) }}"
                                class="block bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-4 sm:p-5 flex items-start gap-3 sm:gap-4 hover:shadow-lg sm:hover:-translate-y-0.5 transition-all duration-300 group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#0064D2] to-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] sm:text-xs font-bold text-[#0194F3] uppercase tracking-wider mb-1">Telepon</p>
                                    <p class="font-semibold text-[#0F294D] dark:text-white text-xs sm:text-sm mb-1">Hubungi Kami</p>
                                    <p class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm break-all">
                                        {{ $setting->phone }}
                                    </p>
                                </div>
                            </a>
                        @endif

                        @if(!empty($setting->whatsapp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}"
                                target="_blank" rel="noopener noreferrer"
                                class="block bg-white dark:bg-gray-900 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-4 sm:p-5 flex items-start gap-3 sm:gap-4 hover:shadow-lg sm:hover:-translate-y-0.5 transition-all duration-300 group">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#25D366] to-[#128C7E] rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[10px] sm:text-xs font-bold text-[#25D366] uppercase tracking-wider mb-1">WhatsApp</p>
                                    <p class="font-semibold text-[#0F294D] dark:text-white text-xs sm:text-sm mb-1">Chat Sekarang</p>
                                    <p class="text-[#687176] dark:text-gray-400 text-xs sm:text-sm break-all">
                                        {{ $setting->whatsapp }}
                                    </p>
                                </div>
                            </a>
                        @endif
                    </div>

                    <div class="lg:col-span-7">
                        <div class="relative rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden h-full min-h-[280px] sm:min-h-[400px] lg:min-h-[500px] group">

                            @if(!empty($setting->maps_embed))
                                @php
    $embed = trim($setting->maps_embed);
    if (stripos($embed, '<iframe') === 0) {
        $embed = preg_replace('/\s*width="[^"]*"/i', '', $embed);
        $embed = preg_replace('/\s*height="[^"]*"/i', '', $embed);
        $embed = preg_replace('/\s*style="[^"]*"/i', '', $embed);
        $embed = preg_replace(
            '/<iframe/i',
            '<iframe class="absolute inset-0 w-full h-full border-0"',
            $embed
        );
    } else {
        $embed = '<iframe src="' . e($embed) . '" class="absolute inset-0 w-full h-full border-0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi ' . e($setting->site_name ?? '') . '"></iframe>';
    }
                                @endphp

                                {!! $embed !!}
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-[#E6F4FF] to-[#F7F9FC] dark:from-gray-800 dark:to-gray-900 flex flex-col items-center justify-center text-center p-6 sm:p-8">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#0194F3]/10 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2">
                                        Lokasi Belum Tersedia
                                    </h3>
                                    <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 max-w-sm">
                                        Peta lokasi akan ditampilkan setelah Anda mengisi field <strong>Maps Embed</strong> di pengaturan.
                                    </p>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
                        </div>
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

            section {
                scroll-margin-top: 80px;
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #F7F9FC;
            }

            ::-webkit-scrollbar-thumb {
                background: #0194F3;
                border-radius: 4px;
            }

            .dark ::-webkit-scrollbar-track {
                background: #1f2937;
            }

            .dark ::-webkit-scrollbar-thumb {
                background: #33ADFF;
            }

            /* Prevent horizontal scroll on mobile */
            body {
                overflow-x: hidden;
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

            /* Spinner animation */
            @keyframes spin-slow {
                to { transform: rotate(360deg); }
            }
            .animate-spin-slow {
                animation: spin-slow 2s linear infinite;
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
                     * Muncul saat halaman dimuat & saat pindah halaman
                     * ============================================================ */
                    const globalLoader = document.getElementById('globalLoader');

                    // Sembunyikan loader setelah halaman selesai dimuat
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

                    // Tampilkan loader saat pindah halaman (klik link internal)
                    document.querySelectorAll('a[href]').forEach(link => {
                        const href = link.getAttribute('href');

                        // Skip: anchor (#), javascript:, mailto:, tel:, target blank, external
                        if (
                            !href ||
                            href.startsWith('#') ||
                            href.startsWith('javascript:') ||
                            href.startsWith('mailto:') ||
                            href.startsWith('tel:') ||
                            link.target === '_blank' ||
                            link.hasAttribute('download')
                        ) return;

                        // Cek apakah link internal (relatif atau domain sama)
                        try {
                            const url = new URL(link.href, window.location.origin);
                            if (url.origin !== window.location.origin) return;
                        } catch (e) { return; }

                        link.addEventListener('click', function (e) {
                            // Skip jika Ctrl/Cmd/Shift diklik (buka tab baru)
                            if (e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;

                            if (globalLoader) {
                                globalLoader.style.display = 'flex';
                                globalLoader.classList.remove('loader-hidden');
                                document.body.classList.add('loading-active');
                            }
                        });
                    });

                    // Handle tombol back/forward browser
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
                     * Animasi muncul saat section di-scroll
                     * ============================================================ */
                    const revealElements = document.querySelectorAll('.reveal-on-scroll');

                    if ('IntersectionObserver' in window) {
                        const revealObserver = new IntersectionObserver((entries) => {
                            entries.forEach((entry, index) => {
                                if (entry.isIntersecting) {
                                    // Delay bertingkat untuk efek stagger
                                    setTimeout(() => {
                                        entry.target.classList.add('is-visible');
                                    }, index * 80);

                                    revealObserver.unobserve(entry.target);
                                }
                            });
                        }, {
                            threshold: 0.1,
                            rootMargin: '0px 0px -50px 0px'
                        });

                        revealElements.forEach(el => revealObserver.observe(el));
                    } else {
                        // Fallback: langsung tampilkan
                        revealElements.forEach(el => el.classList.add('is-visible'));
                    }

                    /* ============================================================
                     * 3. GALLERY POPUP (existing)
                     * ============================================================ */
                    const popup         = document.getElementById('galleryPopup');
                    const popupContent  = document.getElementById('galleryPopupContent');
                    const popupImage    = document.getElementById('galleryPopupImage');
                    const popupTitle    = document.getElementById('galleryPopupTitle');
                    const closeBtn      = document.getElementById('closeGalleryPopup');
                    const fullscreenBtn = document.getElementById('galleryPopupFullscreen');

                    let currentImage = '';

                    function openPopup(image, title) {
                        currentImage = image;
                        popupImage.style.opacity = '0';
                        setTimeout(() => {
                            popupImage.src = image;
                            popupImage.style.opacity = '1';
                        }, 150);
                        popupTitle.textContent = title || 'Foto Galeri';
                        popup.classList.remove('hidden');
                        popup.classList.add('flex');
                        requestAnimationFrame(() => {
                            popup.classList.remove('opacity-0');
                            popupContent.classList.remove('scale-95');
                            popupContent.classList.add('scale-100');
                        });
                        document.body.style.overflow = 'hidden';
                    }

                    function closePopup() {
                        popup.classList.add('opacity-0');
                        popupContent.classList.remove('scale-100');
                        popupContent.classList.add('scale-95');
                        setTimeout(() => {
                            popup.classList.add('hidden');
                            popup.classList.remove('flex');
                            document.body.style.overflow = '';
                        }, 250);
                    }

                    document.querySelectorAll('.gallery-open-btn').forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            openPopup(this.dataset.image, this.dataset.title);
                        });
                    });

                    if (closeBtn) closeBtn.addEventListener('click', closePopup);

                    if (popup) {
                        popup.addEventListener('click', function (e) {
                            if (e.target === popup) closePopup();
                        });
                    }

                    if (fullscreenBtn) {
                        fullscreenBtn.addEventListener('click', function () {
                            if (currentImage) window.open(currentImage, '_blank');
                        });
                    }

                    document.addEventListener('keydown', function (e) {
                        if (!popup || popup.classList.contains('hidden')) return;
                        if (e.key === 'Escape') closePopup();
                    });

                    let touchStartY = 0;
                    if (popupImage) {
                        popupImage.addEventListener('touchstart', e => {
                            touchStartY = e.changedTouches[0].screenY;
                        }, { passive: true });

                        popupImage.addEventListener('touchend', e => {
                            const diff = e.changedTouches[0].screenY - touchStartY;
                            if (diff > 100) closePopup();
                        }, { passive: true });
                    }

                });
            </script>
        @endpush
@endsection