@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .landing-redesign { --brand:#0194F3; --brand-deep:#0064D2; --ink:#0F294D; --mist:#E6F4FF; }
        .landing-redesign section:not(#beranda) { scroll-margin-top: 5rem; }
        .landing-redesign #beranda { min-height: min(780px, 92vh); border-radius: 0 0 36px 36px; overflow:hidden; }
        .landing-redesign #beranda > .absolute:nth-child(2) { background:linear-gradient(90deg,rgba(8,31,57,.82),rgba(0,100,210,.42),rgba(1,148,243,.18)); }
        .landing-redesign #beranda > .absolute:nth-child(3) { background:linear-gradient(0deg,rgba(8,31,57,.7),transparent 48%); }
        .landing-redesign #beranda .bg-white.dark\\:bg-gray-800 { border-radius:18px; padding:12px; box-shadow:0 24px 60px rgba(4,35,69,.25); }
        .landing-redesign section:not(#beranda) { padding-top:clamp(3.5rem,7vw,6rem); padding-bottom:clamp(3.5rem,7vw,6rem); }
        .landing-redesign .accommodation-card { border-radius:18px; border-color:rgba(15,41,77,.08); box-shadow:0 8px 30px rgba(15,41,77,.07); }
        .landing-redesign .accommodation-card img { transition:transform .5s ease; }
        .landing-redesign .accommodation-card:hover img { transform:scale(1.045); }
        .landing-redesign a, .landing-redesign button { transition-duration: .22s; }
        @media(max-width:640px){.landing-redesign #beranda{min-height:760px;border-radius:0 0 24px 24px}.landing-redesign section:not(#beranda){padding-top:3.25rem;padding-bottom:3.25rem}}
    </style>
    <div class="landing-redesign">

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

        <!-- ==================== HERO SECTION ==================== -->
    <section id="beranda"
        class="reveal-on-scroll relative min-h-[600px] sm:min-h-[660px] lg:min-h-screen flex items-center justify-center pt-24 sm:pt-28 lg:pt-24 pb-12 sm:pb-16 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ $banner && $banner->image ? asset($banner->image) : asset('landingpage/herosection.jpg') }}'); background-size: cover; background-position: center;">

        {{-- Overlay gradients & backdrop --}}
        <div class="absolute inset-0 bg-black/30 dark:bg-black/50"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0064D2]/75 via-[#0194F3]/45 to-[#0064D2]/40 dark:from-[#0B1B33]/90 dark:via-[#0E2340]/70 dark:to-[#0B1B33]/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F294D]/80 via-transparent to-black/20 dark:from-[#0B1B33] dark:via-transparent dark:to-black/40"></div>

        <div class="relative container mx-auto px-4 sm:px-6 z-10">
            <div class="max-w-4xl mx-auto text-center text-white">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md border border-white/25 text-white text-[11px] sm:text-xs font-bold px-3.5 py-1.5 rounded-sm mb-4 sm:mb-5 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#0194F3] animate-pulse"></span>
                    <span class="uppercase tracking-wide">#caridisiniaja</span>
                </div>

                {{-- Judul & Deskripsi (Font Sama dengan Deskripsi) --}}
                @if($banner)
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 sm:mb-5 drop-shadow-lg tracking-tight">
                        {{ $banner->title }}
                    </h1>
                    @if($banner->subtitle)
                        <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto mb-8 sm:mb-10 drop-shadow leading-relaxed font-normal">
                            {{ $banner->subtitle }}
                        </p>
                    @endif
                @else
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4 sm:mb-5 drop-shadow-lg tracking-tight">
                        Temukan Penginapan <br class="hidden sm:block">Terbaik untuk Anda
                    </h1>
                    <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto mb-8 sm:mb-10 drop-shadow leading-relaxed font-normal">
                        Nikmati pengalaman menginap yang nyaman dengan berbagai pilihan kamar, villa, dan guest house berkualitas.
                    </p>
                @endif

                {{-- SEARCH BAR --}}
                <div class="bg-white dark:bg-gray-800 rounded-md shadow-2xl p-1.5 sm:p-2 mb-8 sm:mb-10 max-w-5xl mx-auto border border-gray-300 dark:border-gray-600 text-left">
                    {{-- DESKTOP --}}
                    <div class="hidden lg:flex items-stretch divide-x divide-gray-300 dark:divide-gray-600">
                        <div class="flex-1 min-w-0 relative px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-l-md transition-colors">
                            <div class="flex items-center gap-1.5 mb-0.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Mau ke mana?</span>
                            </div>
                            <input type="text" id="heroSearchInputDesktop" placeholder="Cari nama penginapan..." autocomplete="off"
                                class="w-full p-0 border-0 bg-transparent text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 font-medium" />
                        </div>

                        {{-- Custom Dropdown Desktop --}}
                        <div class="w-48 relative px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" id="heroCategoryWrapDesktop">
                            <div class="flex items-center gap-1.5 mb-0.5">
                                <i data-lucide="layout-grid" class="w-3.5 h-3.5 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tipe</span>
                            </div>
                            <select id="heroCategoryDesktop" class="sr-only">
                                <option value="">Semua Kategori</option>
                                @if(isset($categories) && $categories->count())
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" id="heroCategoryTriggerDesktop"
                                class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                                <span id="heroCategoryLabelDesktop" class="truncate">Semua Kategori</span>
                                <i data-lucide="chevron-down" id="heroCategoryChevronDesktop" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                            </button>
                            <div id="heroCategoryPanelDesktop"
                                class="hidden absolute left-0 top-full mt-2 z-50 w-52 bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                                <ul class="py-1 max-h-56 overflow-y-auto text-sm">
                                    <li>
                                        <button type="button" data-value="" data-label="Semua Kategori"
                                            class="hero-cat-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 is-selected">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon"></i>
                                            Semua Kategori
                                        </button>
                                    </li>
                                    @if(isset($categories) && $categories->count())
                                        @foreach($categories as $category)
                                        <li>
                                            <button type="button" data-value="{{ $category->id }}" data-label="{{ $category->name }}"
                                                class="hero-cat-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2">
                                                <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon opacity-0"></i>
                                                {{ $category->name }}
                                            </button>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        {{-- Custom Dropdown Fasilitas Desktop --}}
                        <div class="w-48 relative px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" id="heroFacilityWrapDesktop">
                            <div class="flex items-center gap-1.5 mb-0.5">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Fasilitas</span>
                            </div>
                            <select id="heroFacilityDesktop" class="sr-only">
                                <option value="">Semua Fasilitas</option>
                                @if(isset($facilities) && $facilities->count())
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" id="heroFacilityTriggerDesktop"
                                class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                                <span id="heroFacilityLabelDesktop" class="truncate">Semua Fasilitas</span>
                                <i data-lucide="chevron-down" id="heroFacilityChevronDesktop" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                            </button>
                            <div id="heroFacilityPanelDesktop"
                                class="hidden absolute left-0 top-full mt-2 z-50 w-52 bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                                <ul class="py-1 max-h-56 overflow-y-auto text-sm">
                                    <li>
                                        <button type="button" data-value="" data-label="Semua Fasilitas"
                                            class="hero-fac-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 is-selected">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon"></i>
                                            Semua Fasilitas
                                        </button>
                                    </li>
                                    @if(isset($facilities) && $facilities->count())
                                        @foreach($facilities as $facility)
                                        <li>
                                            <button type="button" data-value="{{ $facility->id }}" data-label="{{ $facility->name }}"
                                                class="hero-fac-opt-desktop w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2">
                                                <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon opacity-0"></i>
                                                {{ $facility->name }}
                                            </button>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="w-60 xl:w-72 relative px-4 py-1.5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex items-center justify-between mb-0.5">
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Harga/malam</span>
                                <span id="heroPricePreviewDesktop" class="text-xs font-bold text-[#0194F3] dark:text-[#33ADFF] bg-[#E6F4FF] dark:bg-[#0194F3]/20 px-2 py-0.5 rounded-sm text-center min-w-[90px]">
                                    50.000 - 10 jt
                                </span>
                            </div>
                            <div class="relative h-5 flex items-center">
                                <div class="absolute inset-x-0 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-sm"></div>
                                <div id="heroSliderFillDesktop" class="absolute left-0 h-1.5 bg-[#0194F3] rounded-sm pointer-events-none" style="width: 0%;"></div>
                                <input type="range" id="heroPriceSliderDesktop" min="50000" max="10000000" step="50000" value="50000" class="hero-price-slider absolute inset-0 w-full h-full cursor-pointer" />
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400 dark:text-gray-400 font-bold px-0.5">
                                <span>50.000</span>
                                <span>10 jt</span>
                            </div>
                        </div>

                        <div class="p-1">
                            <button type="button" id="heroSearchBtnDesktop"
                                class="w-full h-full inline-flex items-center justify-center gap-2 bg-[#0194F3] hover:bg-[#0064D2] text-white px-6 py-3 rounded-md font-bold text-sm shadow-sm hover:shadow-md transition-all whitespace-nowrap flex-shrink-0 cursor-pointer">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                Cari
                            </button>
                        </div>
                    </div>

                    {{-- MOBILE --}}
                    <div class="lg:hidden flex flex-col gap-0 divide-y divide-gray-200 dark:divide-gray-700 text-left">
                        <div class="relative p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex items-center gap-1.5 mb-1">
                                <i data-lucide="map-pin" class="w-4 h-4 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Mau ke mana?</span>
                            </div>
                            <input type="text" id="heroSearchInputMobile" placeholder="Cari nama penginapan..." autocomplete="off"
                                class="w-full p-0 border-0 bg-transparent text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 font-medium" />
                        </div>

                        {{-- Custom Dropdown Mobile --}}
                        <div class="relative p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" id="heroCategoryWrapMobile">
                            <div class="flex items-center gap-1.5 mb-1">
                                <i data-lucide="layout-grid" class="w-4 h-4 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tipe</span>
                            </div>
                            <select id="heroCategoryMobile" class="sr-only">
                                <option value="">Semua Kategori</option>
                                @if(isset($categories) && $categories->count())
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" id="heroCategoryTriggerMobile"
                                class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                                <span id="heroCategoryLabelMobile" class="truncate">Semua Kategori</span>
                                <i data-lucide="chevron-down" id="heroCategoryChevronMobile" class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                            </button>
                            <div id="heroCategoryPanelMobile"
                                class="hidden absolute left-0 top-full mt-2 z-50 w-full bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                                <ul class="py-1 max-h-48 overflow-y-auto text-sm">
                                    <li>
                                        <button type="button" data-value="" data-label="Semua Kategori"
                                            class="hero-cat-opt-mobile w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 is-selected">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon"></i>
                                            Semua Kategori
                                        </button>
                                    </li>
                                    @if(isset($categories) && $categories->count())
                                        @foreach($categories as $category)
                                        <li>
                                            <button type="button" data-value="{{ $category->id }}" data-label="{{ $category->name }}"
                                                class="hero-cat-opt-mobile w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2">
                                                <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon opacity-0"></i>
                                                {{ $category->name }}
                                            </button>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        {{-- Custom Dropdown Fasilitas Mobile --}}
                        <div class="relative p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" id="heroFacilityWrapMobile">
                            <div class="flex items-center gap-1.5 mb-1">
                                <i data-lucide="sparkles" class="w-4 h-4 text-[#FFB800]"></i>
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Fasilitas</span>
                            </div>
                            <select id="heroFacilityMobile" class="sr-only">
                                <option value="">Semua Fasilitas</option>
                                @if(isset($facilities) && $facilities->count())
                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="button" id="heroFacilityTriggerMobile"
                                class="w-full flex items-center justify-between gap-1 text-sm font-bold text-[#0F294D] dark:text-white bg-transparent border-0 p-0 cursor-pointer focus:outline-none">
                                <span id="heroFacilityLabelMobile" class="truncate">Semua Fasilitas</span>
                                <i data-lucide="chevron-down" id="heroFacilityChevronMobile" class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200"></i>
                            </button>
                            <div id="heroFacilityPanelMobile"
                                class="hidden absolute left-0 top-full mt-2 z-50 w-full bg-white dark:bg-gray-800 rounded-sm shadow-xl border border-gray-300 dark:border-gray-600 overflow-hidden">
                                <ul class="py-1 max-h-48 overflow-y-auto text-sm">
                                    <li>
                                        <button type="button" data-value="" data-label="Semua Fasilitas"
                                            class="hero-fac-opt-mobile w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2 is-selected">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon"></i>
                                            Semua Fasilitas
                                        </button>
                                    </li>
                                    @if(isset($facilities) && $facilities->count())
                                        @foreach($facilities as $facility)
                                        <li>
                                            <button type="button" data-value="{{ $facility->id }}" data-label="{{ $facility->name }}"
                                                class="hero-fac-opt-mobile w-full text-left px-4 py-2.5 font-bold text-[#0F294D] dark:text-white hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/20 hover:text-[#0194F3] dark:hover:text-[#33ADFF] transition-colors flex items-center gap-2">
                                                <i data-lucide="check" class="w-3.5 h-3.5 text-[#0194F3] check-icon opacity-0"></i>
                                                {{ $facility->name }}
                                            </button>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Harga/malam</span>
                                <span id="heroPricePreviewMobile" class="text-xs font-bold text-[#0194F3] dark:text-[#33ADFF] bg-[#E6F4FF] dark:bg-[#0194F3]/20 px-2 py-0.5 rounded-sm text-center min-w-[90px]">
                                    50.000 - 10 jt
                                </span>
                            </div>
                            <div class="relative h-5 flex items-center">
                                <div class="absolute inset-x-0 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-sm"></div>
                                <div id="heroSliderFillMobile" class="absolute left-0 h-1.5 bg-[#0194F3] rounded-sm pointer-events-none" style="width: 0%;"></div>
                                <input type="range" id="heroPriceSliderMobile" min="50000" max="10000000" step="50000" value="50000" class="hero-price-slider absolute inset-0 w-full h-full cursor-pointer" />
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-gray-400 dark:text-gray-400 font-bold px-0.5 mt-1">
                                <span>50.000</span>
                                <span>10 jt</span>
                            </div>
                        </div>

                        <div class="p-3 bg-gray-50/50 dark:bg-gray-800/50 rounded-b-md">
                            <button type="button" id="heroSearchBtnMobile"
                                class="w-full inline-flex items-center justify-center gap-2 bg-[#0194F3] text-white px-4 py-3 rounded-md font-bold text-sm shadow-sm hover:shadow-md transition-all cursor-pointer">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                Cari Penginapan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- CTA (Hanya 1 Tombol) --}}
                <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                    <a href="#penginapan"
                        class="inline-flex items-center justify-center gap-2 bg-[#0194F3] text-white px-6 sm:px-8 py-3 rounded-md font-bold text-xs sm:text-sm hover:bg-[#0064D2] transition-all shadow-sm hover:shadow-md uppercase tracking-wide">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        <span>Jelajahi Penginapan</span>
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 mt-8 sm:mt-10 pt-6 sm:pt-8 border-t border-white/20">
                    @foreach(['Terpercaya', 'Harga Terbaik', 'Terupdate'] as $trust)
                        <div class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-sm border border-white/20">
                            <div class="w-5 h-5 bg-[#0194F3] rounded-sm flex items-center justify-center">
                                <i data-lucide="check" class="w-3 h-3 text-white"></i>
                            </div>
                            <span class="text-[10px] sm:text-xs text-white font-bold uppercase tracking-wide drop-shadow">{{ $trust }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

       <!-- ==================== KATEGORI / PENGINAPAN ==================== -->
    <section id="penginapan" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-[#E6F4FF] via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10 gap-4 sm:gap-6 border-b border-gray-300 dark:border-gray-600 pb-4">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-1">— Penginapan</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2">
                        Jelajahi <span class="text-[#0194F3]">Penginapan</span>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Temukan berbagai pilihan penginapan yang sesuai dengan kebutuhan Anda</p>
                </div>

                {{-- TOMBOL LIHAT SEMUA (KANAN HEADER) --}}
                @if($accommodations->count() > 0)
                    <a href="{{ route('accommodationlanding.semua') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md border border-[#0194F3] text-[#0194F3] hover:bg-[#0194F3] hover:text-white transition-all duration-300 font-bold text-xs sm:text-sm uppercase tracking-wide group self-start sm:self-auto flex-shrink-0">
                        <span>Lihat Semua</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"></i>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="accommodationGrid">
                @forelse($accommodations->take(4) as $accommodation)
                    @php
                        $statusColors = [
                            'Available' => ['bg-[#00DD73]', 'Tersedia'],
                            'Full' => ['bg-red-500', 'Tidak Tersedia'],
                            'Maintenance' => ['bg-yellow-500', 'Maintenance'],
                        ];
                        $status = $statusColors[$accommodation->status] ?? ['bg-gray-500', $accommodation->status];
                        $isAvailable = $accommodation->status === 'Available';

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
                        $fullStars = (int) floor($avgRating);
                        $hasHalfStar = ($avgRating - $fullStars) >= 0.5;

                        $facilitiesData = $accommodation->relationLoaded('facilities') 
                            ? $accommodation->facilities 
                            : $accommodation->facilities()->get();
                    @endphp

                    <div class="accommodation-card reveal-on-scroll bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-300 dark:border-gray-600 hover:border-[#0194F3] group flex flex-col {{ !$isAvailable ? 'opacity-75' : '' }}" data-price="{{ $accommodation->price }}">
                        
                        {{-- BAGIAN GAMBAR --}}
                        <div class="relative overflow-hidden flex-shrink-0 border-b border-gray-200 dark:border-gray-700">
                            @if($accommodation->thumbnail)
                                <img src="{{ asset($accommodation->thumbnail) }}" alt="{{ $accommodation->title }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                            @else
                                <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $accommodation->title }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
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

                        {{-- BAGIAN KONTEN TEKS --}}
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
                                                $iconRaw    = $facility->icon;
                                                $iconLucide = $iconRaw && preg_match('/^[a-z0-9-]+$/i', $iconRaw);
                                                $iconSvg    = $iconRaw && (Str::startsWith($iconRaw, ['M', 'm']) || Str::startsWith($iconRaw, '<'));
                                                $iconEmoji  = $iconRaw && !$iconLucide && !$iconSvg;
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
                @empty
                    <div class="col-span-full text-center py-12 sm:py-16 bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                            <i data-lucide="building-2" class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400"></i>
                        </div>
                        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-400 font-bold">Belum ada data penginapan</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- ==================== GALERI ==================== -->
    <section id="galeri" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-[#E6F4FF] via-[#F0F9FF] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        <div class="absolute top-1/2 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#0194F3]/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            {{-- HEADER SECTION --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10 gap-4 sm:gap-6 border-b border-gray-300 dark:border-gray-600 pb-4">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-1">— Galeri</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2">
                        Koleksi <span class="text-[#0194F3]">Foto</span> Terbaik
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Koleksi foto penginapan terbaik kami</p>
                </div>
                @if($galleries->count())
                    <div class="inline-flex items-center gap-2 bg-[#0194F3] px-4 py-1.5 rounded-sm shadow-sm self-start sm:self-auto">
                        <i data-lucide="image" class="w-4 h-4 text-white"></i>
                        <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wide">{{ $galleries->count() }} Foto</span>
                    </div>
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
                            class="gallery-open-btn reveal-on-scroll text-left relative overflow-hidden rounded-sm group cursor-pointer shadow-sm border border-gray-300 dark:border-gray-600 aspect-[4/3] w-full"
                            data-image="{{ asset($gallery->image) }}" data-title="{{ $gallery->title ?? 'Foto Galeri' }}" data-index="{{ $index }}">
                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F294D]/90 via-[#0F294D]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-3 sm:p-5">
                                <div class="transform translate-y-3 group-hover:translate-y-0 transition-transform duration-500">
                                    <span class="inline-block bg-[#0194F3] text-white text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-sm mb-1 sm:mb-2">Galeri</span>
                                    <h3 class="text-white font-bold text-xs sm:text-base leading-snug line-clamp-2">{{ $gallery->title }}</h3>
                                </div>
                            </div>

                            <div class="absolute top-2 right-2 sm:top-4 sm:right-4 w-8 h-8 sm:w-10 sm:h-10 bg-white/20 backdrop-blur-sm rounded-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 scale-75 group-hover:scale-100">
                                <i data-lucide="zoom-in" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                            </div>
                        </button>
                    @endforeach
                </div>

                @if($totalPages > 1)
                    <div class="mt-8 sm:mt-12 flex items-center justify-center gap-1.5 sm:gap-2 flex-wrap">
                        <a href="{{ request()->fullUrlWithQuery(['page' => max(1, $currentPage - 1)]) }}#galeri"
                            class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-[#0194F3] hover:text-white hover:border-[#0194F3] transition-all shadow-sm {{ $currentPage <= 1 ? 'pointer-events-none opacity-40' : '' }}">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>

                        @for($i = 1; $i <= $totalPages; $i++)
                            @if($i == 1 || $i == $totalPages || abs($i - $currentPage) <= 1)
                                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}#galeri"
                                    class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-sm font-bold text-xs sm:text-sm transition-all shadow-sm {{ $i == $currentPage ? 'bg-[#0194F3] text-white border border-[#0194F3]' : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                                    {{ $i }}
                                </a>
                            @elseif(abs($i - $currentPage) == 2)
                                <span class="px-1 sm:px-2 text-gray-400 text-xs sm:text-sm">...</span>
                            @endif
                        @endfor

                        <a href="{{ request()->fullUrlWithQuery(['page' => min($totalPages, $currentPage + 1)]) }}#galeri"
                            class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-[#0194F3] hover:text-white hover:border-[#0194F3] transition-all shadow-sm {{ $currentPage >= $totalPages ? 'pointer-events-none opacity-40' : '' }}">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <p class="text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-3 sm:mt-4 font-medium">
                        Menampilkan <span class="font-bold text-[#0F294D] dark:text-white">{{ $offset + 1 }}</span>–<span class="font-bold text-[#0F294D] dark:text-white">{{ min($offset + $perPage, $totalItems) }}</span> dari <span class="font-bold text-[#0F294D] dark:text-white">{{ $totalItems }}</span> foto
                    </p>
                @endif
            @else
                <div class="text-center py-12 sm:py-16 bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <i data-lucide="image-off" class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-[#0F294D] dark:text-gray-300 mb-2 uppercase tracking-wide">Belum Ada Galeri</h3>
                    <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Belum ada foto galeri yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===================== MODAL GALERI ===================== --}}
    <div id="galleryPopup" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-2 sm:p-4 opacity-0 transition-opacity duration-300">
        <div id="galleryPopupContent" class="relative w-full max-w-5xl max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-md shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 border border-gray-600">
            <div class="flex items-center justify-between px-3 sm:px-5 py-2.5 sm:py-3.5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 flex-shrink-0">
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0">
                        <i data-lucide="image" class="w-4 h-4 sm:w-5 sm:h-5 text-[#0194F3] dark:text-[#33ADFF]"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 id="galleryPopupTitle" class="text-xs sm:text-sm font-bold text-[#0F294D] dark:text-white truncate uppercase tracking-wide">Foto Galeri</h3>
                        <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 hidden sm:block">Tekan ESC untuk menutup</p>
                    </div>
                </div>
                <button type="button" id="closeGalleryPopup" class="w-8 h-8 sm:w-9 sm:h-9 rounded-sm flex items-center justify-center text-gray-500 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 transition-colors flex-shrink-0" title="Tutup (Esc)">
                    <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>
            </div>

            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[200px] sm:min-h-[300px]">
                <img id="galleryPopupImage" src="" alt="Foto" class="max-w-full max-h-[60vh] sm:max-h-[70vh] object-contain transition-opacity duration-300 select-none">
                <button type="button" id="galleryPopupFullscreen" class="absolute top-2 right-2 sm:top-3 sm:right-3 z-10 w-9 h-9 sm:w-10 sm:h-10 rounded-sm bg-gray-800/80 hover:bg-gray-700 backdrop-blur-md text-white flex items-center justify-center transition-all border border-gray-600" title="Buka di tab baru">
                    <i data-lucide="external-link" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== ARTIKEL ==================== -->
    <section id="artikel" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-[#E6F4FF] via-white to-[#E6F4FF] dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-1/4 w-72 h-72 bg-[#0194F3]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-[#33ADFF]/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            {{-- HEADER SECTION --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10 gap-4 sm:gap-6 border-b border-gray-300 dark:border-gray-600 pb-4">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-1">— Blog</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2">
                        Artikel <span class="text-[#0194F3]">Terbaru</span>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tips dan informasi menarik seputar penginapan</p>
                </div>
                @if($articles->count() > 0)
                    <a href="{{ route('article.semua') }}" class="inline-flex items-center gap-2 bg-[#0194F3] text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-sm font-bold text-sm sm:text-base hover:bg-[#0064D2] transition-all shadow-sm group self-start sm:self-auto uppercase tracking-wide">
                        Lihat Semua
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @endif
            </div>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($articles as $article)
                        <article class="group cursor-pointer h-full">
                            <div class="bg-white dark:bg-gray-800 rounded-md overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-300 dark:border-gray-600 h-full flex flex-col">
                                <div class="relative overflow-hidden h-48 sm:h-56 flex-shrink-0 border-b border-gray-200 dark:border-gray-700">
                                    @if($article->thumbnail)
                                        <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    @else
                                        <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    @endif

                                    @if($article->category)
                                        <span class="absolute top-3 left-3 bg-[#0194F3] text-white text-[10px] font-bold uppercase px-2.5 py-1 rounded-sm shadow-sm tracking-wide">{{ $article->category->name }}</span>
                                    @endif

                                    <span class="absolute top-3 right-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm text-[#0F294D] dark:text-gray-200 text-[10px] font-bold px-2 py-1 rounded-sm shadow-sm flex items-center gap-1 border border-gray-200 dark:border-gray-600">
                                        <i data-lucide="clock" class="w-3 h-3 text-[#0194F3]"></i>
                                        {{ max(1, ceil(str_word_count(strip_tags($article->content ?? '')) / 200)) }} min
                                    </span>
                                </div>

                                <div class="p-4 sm:p-5 flex flex-col flex-1">
                                    <div class="flex items-center gap-1.5 mb-2 text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wide">
                                        <i data-lucide="calendar" class="w-3 h-3 text-[#0194F3]"></i>
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                    </div>

                                    <h3 class="text-base font-bold text-[#0F294D] dark:text-white mb-2 group-hover:text-[#0194F3] transition-colors line-clamp-2 leading-snug">
                                        {{ $article->title }}
                                    </h3>

                                    <p class="text-gray-600 dark:text-gray-400 text-xs mb-4 line-clamp-3 flex-1 text-justify">
                                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 120) }}
                                    </p>

                                    <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700 mt-auto">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-sm bg-[#0194F3] flex items-center justify-center text-white text-[10px] font-bold">
                                                {{ strtoupper(substr($article->author->name ?? $setting->site_name ?? 'A', 0, 1)) }}
                                            </div>
                                            <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide truncate max-w-[80px]">
                                                {{ $article->author->name ?? $setting->site_name ?? 'Admin' }}
                                            </span>
                                        </div>
                                        <a href="{{ route('article.detail', $article->slug) }}" class="inline-flex items-center gap-1 text-[#0194F3] font-bold text-xs uppercase tracking-wide group-hover:gap-2 transition-all">
                                            Baca
                                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 sm:py-16 bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-sm bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <i data-lucide="newspaper" class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-[#0F294D] dark:text-white mb-2 uppercase tracking-wide">Belum Ada Artikel</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Artikel akan segera hadir. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>

       <!-- ==================== KONTAK ==================== -->
    <section id="kontak" class="reveal-on-scroll py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-[#E6F4FF] via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-[#0194F3]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 sm:w-80 sm:h-80 bg-[#33ADFF]/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            {{-- HEADER SECTION --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-10 gap-4 sm:gap-6 border-b border-gray-300 dark:border-gray-600 pb-4">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-1">— Kontak</span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2">
                        Lokasi & <span class="text-[#0194F3]">Kontak</span>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Kunjungi kantor kami atau hubungi kami untuk informasi lebih lanjut</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
                {{-- KIRI: INFO KONTAK --}}
                <div class="lg:col-span-5 space-y-4">
                    @if(!empty($setting->address))
                        <div class="bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600 p-4 sm:p-5 flex items-start gap-4 shadow-sm">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                <i data-lucide="map-pin" class="w-5 h-5 sm:w-6 sm:h-6 text-[#0194F3] dark:text-[#33ADFF]"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] sm:text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Alamat Kantor</p>
                                <p class="font-bold text-[#0F294D] dark:text-white text-sm mb-1">Kantor Pusat</p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm leading-relaxed break-words">{{ $setting->address }}</p>
                            </div>
                        </div>
                    @endif

                    @if(!empty($setting->email))
                        <a href="mailto:{{ $setting->email }}" class="block bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600 p-4 sm:p-5 flex items-start gap-4 shadow-sm hover:border-[#0194F3] transition-colors">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                <i data-lucide="mail" class="w-5 h-5 sm:w-6 sm:h-6 text-[#0194F3] dark:text-[#33ADFF]"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] sm:text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Email Resmi</p>
                                <p class="font-bold text-[#0F294D] dark:text-white text-sm mb-1">Kirim Pesan</p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm break-all">{{ $setting->email }}</p>
                            </div>
                        </a>
                    @endif

                    @if(!empty($setting->phone))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->phone) }}" class="block bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600 p-4 sm:p-5 flex items-start gap-4 shadow-sm hover:border-[#0194F3] transition-colors">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#B3E0FF] dark:border-[#0194F3]/30">
                                <i data-lucide="phone" class="w-5 h-5 sm:w-6 sm:h-6 text-[#0194F3] dark:text-[#33ADFF]"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] sm:text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                                <p class="font-bold text-[#0F294D] dark:text-white text-sm mb-1">Hubungi Kami</p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm break-all">{{ $setting->phone }}</p>
                            </div>
                        </a>
                    @endif

                    @if(!empty($setting->whatsapp))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="block bg-white dark:bg-gray-800 rounded-md border border-gray-300 dark:border-gray-600 p-4 sm:p-5 flex items-start gap-4 shadow-sm hover:border-[#0194F3] transition-colors">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#25D366]/10 rounded-sm flex items-center justify-center flex-shrink-0 border border-[#25D366]/30">
                                <i data-lucide="message-circle" class="w-5 h-5 sm:w-6 sm:h-6 text-[#25D366]"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] sm:text-xs font-bold text-[#25D366] uppercase tracking-wider mb-1">WhatsApp</p>
                                <p class="font-bold text-[#0F294D] dark:text-white text-sm mb-1">Chat Sekarang</p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm break-all">{{ $setting->whatsapp }}</p>
                            </div>
                        </a>
                    @endif
                </div>

                {{-- KANAN: MAPS --}}
                <div class="lg:col-span-7">
                    <div class="relative rounded-md shadow-sm overflow-hidden h-full min-h-[300px] lg:min-h-[450px] border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800">
                        @if(!empty($setting->maps_embed))
                            @php
                                $embed = trim($setting->maps_embed);
                                if (stripos($embed, '<iframe') === 0) {
                                    $embed = preg_replace('/\s*width="[^"]*"/i', '', $embed);
                                    $embed = preg_replace('/\s*height="[^"]*"/i', '', $embed);
                                    $embed = preg_replace('/\s*style="[^"]*"/i', '', $embed);
                                    $embed = preg_replace('/<iframe/i', '<iframe class="absolute inset-0 w-full h-full border-0"', $embed);
                                } else {
                                    $embed = '<iframe src="' . e($embed) . '" class="absolute inset-0 w-full h-full border-0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi ' . e($setting->site_name ?? '') . '"></iframe>';
                                }
                            @endphp
                            {!! $embed !!}
                        @else
                            <div class="absolute inset-0 bg-gray-50 dark:bg-gray-900 flex flex-col items-center justify-center text-center p-6 sm:p-8">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-full flex items-center justify-center mb-4">
                                    <i data-lucide="map" class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]"></i>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-[#0F294D] dark:text-white mb-2">Lokasi Belum Tersedia</h3>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 max-w-sm">Peta lokasi akan ditampilkan setelah Anda mengisi field <strong>Maps Embed</strong> di pengaturan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .container { max-width: 1200px; margin-left: auto; margin-right: auto; }
        section { scroll-margin-top: 80px; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #E6F4FF; }
        ::-webkit-scrollbar-thumb { background: #0194F3; border-radius: 4px; }
        .dark ::-webkit-scrollbar-track { background: #1f2937; }
        .dark ::-webkit-scrollbar-thumb { background: #33ADFF; }
        body { overflow-x: hidden; }
        .reveal-on-scroll { opacity: 0; transform: translateY(30px); transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
        .reveal-on-scroll.is-visible { opacity: 1; transform: translateY(0); }
        #globalLoader.loader-hidden { opacity: 0; pointer-events: none; }
        @keyframes spin-slow { to { transform: rotate(360deg); } }
        .animate-spin-slow { animation: spin-slow 20s linear infinite; }
        body.loading-active { overflow: hidden; }
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
                    if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:') || link.target === '_blank' || link.hasAttribute('download')) return;
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
                                }, index * 80);
                                revealObserver.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
                    revealElements.forEach(el => revealObserver.observe(el));
                } else {
                    revealElements.forEach(el => el.classList.add('is-visible'));
                }

                const popup = document.getElementById('galleryPopup');
                const popupContent = document.getElementById('galleryPopupContent');
                const popupImage = document.getElementById('galleryPopupImage');
                const popupTitle = document.getElementById('galleryPopupTitle');
                const closeBtn = document.getElementById('closeGalleryPopup');
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

                const heroSliderDesktop = document.getElementById('heroPriceSliderDesktop');
                const heroPreviewDesktop = document.getElementById('heroPricePreviewDesktop');
                const heroFillDesktop = document.getElementById('heroSliderFillDesktop');
                const heroSliderMobile = document.getElementById('heroPriceSliderMobile');
                const heroPreviewMobile = document.getElementById('heroPricePreviewMobile');
                const heroFillMobile = document.getElementById('heroSliderFillMobile');

                function formatCompactPrice(num) {
                    if (num >= 1000000) {
                        const jt = num / 1000000;
                        return (jt % 1 === 0 ? jt : jt.toFixed(1)) + ' jt';
                    }
                    if (num >= 1000) {
                        return (num / 1000) + ' rb';
                    }
                    return num.toString();
                }

                function updateHeroSlider(val) {
                    const min = 50000;
                    const max = 10000000;
                    const num = parseInt(val) || min;
                    const percent = Math.max(0, Math.min(100, ((num - min) / (max - min)) * 100));

                    let previewText = '50.000 - 10 jt';
                    if (num > min && num < max) {
                        previewText = `50.000 - ${formatCompactPrice(num)}`;
                    } else if (num >= max) {
                        previewText = '50.000 - 10 jt';
                    }

                    if (heroPreviewDesktop) heroPreviewDesktop.textContent = previewText;
                    if (heroPreviewMobile) heroPreviewMobile.textContent = previewText;
                    if (heroFillDesktop) heroFillDesktop.style.width = percent + '%';
                    if (heroFillMobile) heroFillMobile.style.width = percent + '%';

                    if (heroSliderDesktop && parseInt(heroSliderDesktop.value) !== num) heroSliderDesktop.value = num;
                    if (heroSliderMobile && parseInt(heroSliderMobile.value) !== num) heroSliderMobile.value = num;
                }

                if (heroSliderDesktop) heroSliderDesktop.addEventListener('input', function() { updateHeroSlider(this.value); });
                if (heroSliderMobile) heroSliderMobile.addEventListener('input', function() { updateHeroSlider(this.value); });
                updateHeroSlider(50000);

                const heroCategoryDesktop = document.getElementById('heroCategoryDesktop');
                const heroCategoryMobile = document.getElementById('heroCategoryMobile');
                if (heroCategoryDesktop && heroCategoryMobile) {
                    heroCategoryDesktop.addEventListener('change', function() {
                        if (heroCategoryMobile) heroCategoryMobile.value = this.value;
                    });
                    heroCategoryMobile.addEventListener('change', function() {
                        if (heroCategoryDesktop) heroCategoryDesktop.value = this.value;
                    });
                }

                const heroSearchInputDesktop = document.getElementById('heroSearchInputDesktop');
                const heroSearchInputMobile = document.getElementById('heroSearchInputMobile');
                if (heroSearchInputDesktop && heroSearchInputMobile) {
                    heroSearchInputDesktop.addEventListener('input', function() {
                        if (heroSearchInputMobile) heroSearchInputMobile.value = this.value;
                    });
                    heroSearchInputMobile.addEventListener('input', function() {
                        if (heroSearchInputDesktop) heroSearchInputDesktop.value = this.value;
                    });
                }

                function handleHeroSearch(categorySelectId, facilitySelectId, searchInputId, sliderId) {
                    const catSelect = document.getElementById(categorySelectId);
                    const facSelect = document.getElementById(facilitySelectId);
                    const searchInput = document.getElementById(searchInputId);
                    const slider = document.getElementById(sliderId);

                    const keyword = searchInput ? searchInput.value.trim() : '';
                    const categoryVal = catSelect ? catSelect.value : '';
                    const facilityVal = facSelect ? facSelect.value : '';
                    const sliderVal = slider ? parseInt(slider.value, 10) : 50000;

                    const baseUrl = "{{ route('accommodationlanding.semua') }}";
                    const params = new URLSearchParams();

                    if (keyword) params.set('keyword', keyword);
                    if (categoryVal) params.set('category_id', categoryVal);
                    if (facilityVal) params.set('facility_id', facilityVal);
                    if (sliderVal > 50000 && sliderVal < 10000000) params.set('max_price', sliderVal);

                    const finalUrl = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;
                    window.location.href = finalUrl;
                }


                // ===== CUSTOM DROPDOWNS =====
                function setupCategoryDropdown(triggerId, panelId, chevronId, labelId, selectId, optClass) {
                    const trigger  = document.getElementById(triggerId);
                    const panel    = document.getElementById(panelId);
                    const chevron  = document.getElementById(chevronId);
                    const label    = document.getElementById(labelId);
                    const select   = document.getElementById(selectId);
                    if (!trigger || !panel) return;

                    trigger.addEventListener('click', function (e) {
                        e.stopPropagation();
                        const isOpen = !panel.classList.contains('hidden');
                        
                        // Close other panels
                        ['heroCategoryPanelDesktop','heroCategoryPanelMobile','heroFacilityPanelDesktop','heroFacilityPanelMobile'].forEach(function(pid) {
                            if (pid !== panelId) {
                                const otherP = document.getElementById(pid);
                                if (otherP) otherP.classList.add('hidden');
                            }
                        });
                        ['heroCategoryChevronDesktop','heroCategoryChevronMobile','heroFacilityChevronDesktop','heroFacilityChevronMobile'].forEach(function(cid) {
                            if (cid !== chevronId) {
                                const otherC = document.getElementById(cid);
                                if (otherC) otherC.style.transform = '';
                            }
                        });

                        panel.classList.toggle('hidden');
                        chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
                        if (!isOpen && window.lucide) lucide.createIcons();
                    });

                    document.querySelectorAll('.' + optClass).forEach(function (btn) {
                        btn.addEventListener('click', function () {
                            const value = this.dataset.value;
                            const lbl   = this.dataset.label;
                            label.textContent = lbl;
                            select.value = value;
                            // Update checked state
                            document.querySelectorAll('.' + optClass).forEach(function (b) {
                                const icon = b.querySelector('.check-icon');
                                if (b.dataset.value === value) {
                                    icon && icon.classList.remove('opacity-0');
                                } else {
                                    icon && icon.classList.add('opacity-0');
                                }
                            });
                            panel.classList.add('hidden');
                            chevron.style.transform = '';
                        });
                    });
                }
                setupCategoryDropdown('heroCategoryTriggerDesktop','heroCategoryPanelDesktop','heroCategoryChevronDesktop','heroCategoryLabelDesktop','heroCategoryDesktop','hero-cat-opt-desktop');
                setupCategoryDropdown('heroCategoryTriggerMobile','heroCategoryPanelMobile','heroCategoryChevronMobile','heroCategoryLabelMobile','heroCategoryMobile','hero-cat-opt-mobile');
                setupCategoryDropdown('heroFacilityTriggerDesktop','heroFacilityPanelDesktop','heroFacilityChevronDesktop','heroFacilityLabelDesktop','heroFacilityDesktop','hero-fac-opt-desktop');
                setupCategoryDropdown('heroFacilityTriggerMobile','heroFacilityPanelMobile','heroFacilityChevronMobile','heroFacilityLabelMobile','heroFacilityMobile','hero-fac-opt-mobile');

                // Close dropdowns when clicking outside
                document.addEventListener('click', function () {
                    ['heroCategoryPanelDesktop','heroCategoryPanelMobile','heroFacilityPanelDesktop','heroFacilityPanelMobile'].forEach(function (id) {
                        const p = document.getElementById(id);
                        if (p) p.classList.add('hidden');
                    });
                    ['heroCategoryChevronDesktop','heroCategoryChevronMobile','heroFacilityChevronDesktop','heroFacilityChevronMobile'].forEach(function(id) {
                        const c = document.getElementById(id);
                        if (c) c.style.transform = '';
                    });
                });
                // ===== END CUSTOM DROPDOWNS =====

                const heroSearchBtnDesktop = document.getElementById('heroSearchBtnDesktop');
                if (heroSearchBtnDesktop) {
                    heroSearchBtnDesktop.addEventListener('click', function() {
                        handleHeroSearch('heroCategoryDesktop', 'heroFacilityDesktop', 'heroSearchInputDesktop', 'heroPriceSliderDesktop');
                    });
                }

                const heroSearchBtnMobile = document.getElementById('heroSearchBtnMobile');
                if (heroSearchBtnMobile) {
                    heroSearchBtnMobile.addEventListener('click', function() {
                        handleHeroSearch('heroCategoryMobile', 'heroFacilityMobile', 'heroSearchInputMobile', 'heroPriceSliderMobile');
                    });
                }

                if (heroSearchInputDesktop) {
                    heroSearchInputDesktop.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            handleHeroSearch('heroCategoryDesktop', 'heroFacilityDesktop', 'heroSearchInputDesktop', 'heroPriceSliderDesktop');
                        }
                    });
                }

                if (heroSearchInputMobile) {
                    heroSearchInputMobile.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            handleHeroSearch('heroCategoryMobile', 'heroFacilityMobile', 'heroSearchInputMobile', 'heroPriceSliderMobile');
                        }
                    });
                }
                
                if (window.renderLucide) {
                    window.renderLucide();
                } else if (window.lucide) {
                    lucide.createIcons();
                }
            });
        </script>
    @endpush
    </div>
@endsection
