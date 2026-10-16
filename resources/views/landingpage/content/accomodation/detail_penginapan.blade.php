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

    @php
        /*
        |--------------------------------------------------------------------------
        | Kumpulkan gambar: thumbnail + gallery
        |--------------------------------------------------------------------------
        */
        $images = collect();

        if (!empty($accommodation->thumbnail)) {
            $images->push((object) [
                'image' => $accommodation->thumbnail,
                'alt' => $accommodation->title,
            ]);
        }

        if ($accommodation->relationLoaded('images') && $accommodation->images->count()) {
            foreach ($accommodation->images as $img) {
                $images->push((object) [
                    'image' => $img->image,
                    'alt' => $accommodation->title,
                ]);
            }
        }

        $images = $images->filter(fn($i) => !empty($i->image))->values();

        /*
        |--------------------------------------------------------------------------
        | Status badge
        |--------------------------------------------------------------------------
        */
        $statusMap = [
            'Available' => ['bg-[#00DD73]', 'Tersedia'],
            'Full' => ['bg-red-500', 'Tidak Tersedia'],
            'Maintenance' => ['bg-yellow-500', 'Maintenance'],
        ];

        [$statusBg, $statusText] =
            $statusMap[$accommodation->status] ?? ['bg-gray-500', $accommodation->status];

        /*
        |--------------------------------------------------------------------------
        | URL Kembali ke halaman kategori (kamar.blade.php)
        |--------------------------------------------------------------------------
        */
        $categoryName = $accommodation->category->name ?? 'Penginapan';
        $categorySlug = $accommodation->category->slug ?? null;

        if ($categorySlug) {
            $categoryUrl = \Illuminate\Support\Facades\Route::has('accommodationlanding.category')
                ? route('accommodationlanding.category', $categorySlug)
                : url('kategori-penginapanlanding/' . $categorySlug);
        } else {
            $categoryUrl = '/';
        }

        /*
        |--------------------------------------------------------------------------
        | Logika galeri
        |--------------------------------------------------------------------------
        */
        $totalImages = $images->count();
        $sideImages = $images->slice(1, 2)->values();
        $extraImages = $images->slice(3)->values();
        $extraCount = $extraImages->count();
        $hasExtra = $extraCount > 0;

        /*
        |--------------------------------------------------------------------------
        | Array URL semua foto (untuk modal)
        |--------------------------------------------------------------------------
        */
        $allPhotoUrls = $images->map(fn($i) => asset($i->image))->values()->all();

        /*
        |--------------------------------------------------------------------------
        | Cek Kontak & Sosial Media
        |--------------------------------------------------------------------------
        */
        $hasContact = $accommodation->hasContact() ?? (!empty($accommodation->phone) || !empty($accommodation->whatsapp) || !empty($accommodation->email));
        $hasSosmed = $accommodation->hasSocialMedia() ?? (!empty($accommodation->facebook) || !empty($accommodation->instagram) || !empty($accommodation->youtube) || !empty($accommodation->x) || !empty($accommodation->tiktok));
    @endphp

    <section class="pt-24 pb-12 bg-white dark:bg-gray-900 min-h-screen">
        <div class="container mx-auto px-4">

            {{-- ===================== TOMBOL KEMBALI ===================== --}}
            <div class="reveal-on-scroll relative z-20 mb-6">
                <a href="{{ $categoryUrl }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#E6F4FF] dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] hover:bg-[#0194F3] hover:text-white dark:hover:bg-[#33ADFF] transition-colors shadow-sm font-semibold text-sm"
                    title="Kembali ke {{ $categoryName }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- ===================== HEADER ===================== --}}
            <div class="reveal-on-scroll flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                <div>
                    <span
                        class="inline-block bg-[#0194F3] text-white text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
                        {{ $categoryName }}
                    </span>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0F294D] dark:text-white leading-tight">
                        {{ $accommodation->title }}
                    </h1>

                    @if($accommodation->address)
                        <p class="mt-2 text-[#687176] dark:text-gray-400 flex items-start gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $accommodation->address }}</span>
                        </p>
                    @endif
                </div>

                <span
                    class="inline-flex items-center gap-1.5 {{ $statusBg }} text-white px-3.5 py-1.5 rounded-full text-xs font-bold shadow-lg uppercase tracking-wide self-start">
                    {{ $statusText }}
                </span>
            </div>

            {{-- ===================== GALLERY ===================== --}}
            @if($totalImages > 0)
                <div class="reveal-on-scroll grid grid-cols-1 md:grid-cols-4 gap-3 mb-8">

                    {{-- Gambar Utama --}}
                    <div class="md:col-span-3 md:row-span-2 relative group overflow-hidden rounded-2xl bg-gray-200">
                        <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                            data-photos='@json($allPhotoUrls)' data-index="0">
                            <img src="{{ asset($images[0]->image) }}" alt="{{ $images[0]->alt }}"
                                class="w-full h-72 sm:h-96 md:h-[480px] object-cover group-hover:scale-105 transition-transform duration-500">
                        </button>
                    </div>

                    {{-- Gambar Samping (max 2) --}}
                    @foreach($sideImages as $index => $img)
                        <div class="relative group overflow-hidden rounded-2xl bg-gray-200">
                            <button type="button" class="open-gallery-btn block w-full h-full cursor-pointer"
                                data-photos='@json($allPhotoUrls)' data-index="{{ $index + 1 }}">
                                <img src="{{ asset($img->image) }}" alt="{{ $img->alt }}"
                                    class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                            </button>

                            {{-- Overlay tombol "+N Foto" pada gambar samping terakhir --}}
                            @if($hasExtra && $index === $sideImages->count() - 1)
                                <button type="button"
                                    class="open-gallery-btn absolute inset-0 bg-black/55 hover:bg-black/70 backdrop-blur-[2px] flex flex-col items-center justify-center text-white font-semibold transition-colors duration-200 group/btn"
                                    data-photos='@json($allPhotoUrls)' data-index="2">
                                    <svg class="w-7 h-7 mb-1.5 group-hover/btn:scale-110 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-base">+{{ $extraCount }} Foto</span>
                                    <span class="text-[10px] uppercase tracking-wider opacity-80 mt-0.5">Lihat Semua</span>
                                </button>
                            @endif
                        </div>
                    @endforeach

                    {{-- Kalau gambar cuma 1-2, isi placeholder biar grid tetap rapi --}}
                    @if($sideImages->count() < 2 && $totalImages <= 2)
                        @for($i = $sideImages->count(); $i < 2; $i++)
                            <div class="hidden md:block rounded-2xl bg-gray-100 dark:bg-gray-800"></div>
                        @endfor
                    @endif
                </div>
            @endif

            {{-- ===================== KONTEN UTAMA ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- ============= KIRI ============= --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Spesifikasi --}}
                    <div
                        class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                        <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-5 flex items-center gap-2">
                            <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
                            Informasi Penginapan
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div
                                class="bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl p-3.5 text-center border border-gray-100 dark:border-gray-700">
                                <div
                                    class="w-9 h-9 mx-auto mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-1">
                                    Kapasitas</p>
                                <p class="text-xs font-bold text-[#0F294D] dark:text-white">
                                    {{ $accommodation->capacity ?? '-' }} Orang
                                </p>
                            </div>

                            <div
                                class="bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl p-3.5 text-center border border-gray-100 dark:border-gray-700">
                                <div
                                    class="w-9 h-9 mx-auto mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-1">
                                    Kamar</p>
                                <p class="text-xs font-bold text-[#0F294D] dark:text-white">
                                    {{ $accommodation->bedroom ?? '-' }}
                                </p>
                            </div>

                            <div
                                class="bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl p-3.5 text-center border border-gray-100 dark:border-gray-700">
                                <div
                                    class="w-9 h-9 mx-auto mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-1">
                                    K. Mandi</p>
                                <p class="text-xs font-bold text-[#0F294D] dark:text-white">
                                    {{ $accommodation->bathroom ?? '-' }}
                                </p>
                            </div>

                            <div
                                class="bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl p-3.5 text-center border border-gray-100 dark:border-gray-700">
                                <div
                                    class="w-9 h-9 mx-auto mb-2 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </div>
                                <p
                                    class="text-[9px] text-[#687176] dark:text-gray-400 uppercase tracking-wider font-bold mb-1">
                                    Ukuran</p>
                                <p class="text-xs font-bold text-[#0F294D] dark:text-white">
                                    {{ $accommodation->size ?: '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    @if($accommodation->description)
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                            <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
                                Deskripsi
                            </h2>
                            <p class="text-sm text-[#687176] dark:text-gray-400 leading-relaxed whitespace-pre-line">
                                {{ $accommodation->description }}
                            </p>
                        </div>
                    @endif

                    {{-- ============================================ --}}
                    {{-- KONTAK & SOSIAL MEDIA --}}
                    {{-- ============================================ --}}
                    @if($hasContact || $hasSosmed)
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                            <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
                                Kontak & Sosial Media
                            </h2>

                            {{-- ==== Kontak ==== --}}
                            @if($hasContact)
                                <div class="space-y-3 mb-5">

                                    {{-- Telepon --}}
                                    @if(!empty($accommodation->phone))
                                        <a href="{{ $accommodation->phone_url ?? 'tel:' . preg_replace('/[^0-9+]/', '', $accommodation->phone) }}"
                                            class="flex items-center gap-3 p-3 bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl hover:bg-[#E6F4FF] dark:hover:bg-gray-700/50 transition-colors group">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-[#0194F3] to-[#0064D2] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[10px] font-bold text-[#0194F3] uppercase tracking-wider mb-0.5">Telepon
                                                </p>
                                                <p class="text-sm font-semibold text-[#0F294D] dark:text-white truncate">
                                                    {{ $accommodation->phone }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif

                                    {{-- WhatsApp --}}
                                    @if(!empty($accommodation->whatsapp))
                                        <a href="{{ $accommodation->whatsapp_url ?? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $accommodation->whatsapp) }}"
                                            target="_blank" rel="noopener noreferrer"
                                            class="flex items-center gap-3 p-3 bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl hover:bg-[#E6F4FF] dark:hover:bg-gray-700/50 transition-colors group">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-[#25D366] to-[#128C7E] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[10px] font-bold text-[#25D366] uppercase tracking-wider mb-0.5">WhatsApp
                                                </p>
                                                <p class="text-sm font-semibold text-[#0F294D] dark:text-white truncate">
                                                    {{ $accommodation->whatsapp }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif

                                    {{-- Email --}}
                                    @if(!empty($accommodation->email))
                                        <a href="{{ $accommodation->email_url ?? 'mailto:' . $accommodation->email }}"
                                            class="flex items-center gap-3 p-3 bg-[#F7F9FC] dark:bg-gray-900/50 rounded-xl hover:bg-[#E6F4FF] dark:hover:bg-gray-700/50 transition-colors group">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-[#33ADFF] to-[#0194F3] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[10px] font-bold text-[#0194F3] uppercase tracking-wider mb-0.5">Email
                                                </p>
                                                <p class="text-sm font-semibold text-[#0F294D] dark:text-white truncate">
                                                    {{ $accommodation->email }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endif

                            {{-- ==== Sosial Media ==== --}}
                            @if($hasSosmed)
                                <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <p class="text-xs font-bold text-[#687176] dark:text-gray-400 uppercase tracking-wider mb-3">
                                        Ikuti Kami
                                    </p>
                                    <div class="flex flex-wrap gap-2">

                                        {{-- Facebook --}}
                                        @if(!empty($accommodation->facebook))
                                            <a href="{{ $accommodation->facebook }}" target="_blank" rel="noopener noreferrer"
                                                class="w-11 h-11 rounded-xl bg-[#1877F2] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md"
                                                title="Facebook">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M22.675 0h-21.35C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z" />
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- Instagram --}}
                                        @if(!empty($accommodation->instagram))
                                            <a href="{{ $accommodation->instagram }}" target="_blank" rel="noopener noreferrer"
                                                class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#E1306C] to-[#C13584] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md"
                                                title="Instagram">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- YouTube --}}
                                        @if(!empty($accommodation->youtube))
                                            <a href="{{ $accommodation->youtube }}" target="_blank" rel="noopener noreferrer"
                                                class="w-11 h-11 rounded-xl bg-[#FF0000] text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md"
                                                title="YouTube">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- X (Twitter) --}}
                                        @if(!empty($accommodation->x))
                                            <a href="{{ $accommodation->x }}" target="_blank" rel="noopener noreferrer"
                                                class="w-11 h-11 rounded-xl bg-black text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md"
                                                title="X (Twitter)">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- TikTok --}}
                                        @if(!empty($accommodation->tiktok))
                                            <a href="{{ $accommodation->tiktok }}" target="_blank" rel="noopener noreferrer"
                                                class="w-11 h-11 rounded-xl bg-black text-white flex items-center justify-center hover:scale-110 transition-transform shadow-md"
                                                title="TikTok">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
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
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                            <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
                                Fasilitas
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($accommodation->facilities as $facility)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#E6F4FF] text-[#0194F3] rounded-full text-xs font-medium border border-[#B3E0FF]">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $facility->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Peraturan (dengan deskripsi) --}}
                    @if($accommodation->relationLoaded('rules') && $accommodation->rules->count())
                        <div
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                            <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
                                Aturan Penginapan
                            </h2>

                            <ul class="space-y-3">
                                @foreach($accommodation->rules as $rule)
                                    <li
                                        class="flex items-start gap-3 p-3 bg-[#FFFBEB] dark:bg-yellow-900/10 rounded-xl border border-[#FDE68A] dark:border-yellow-800/30">
                                        <div
                                            class="flex-shrink-0 w-7 h-7 rounded-full bg-[#F59E0B] flex items-center justify-center shadow-sm mt-0.5">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-[#92400E] dark:text-yellow-300 leading-tight">
                                                {{ $rule->name }}
                                            </p>
                                            @if(!empty($rule->description))
                                                <p class="mt-1 text-xs text-[#78350F] dark:text-yellow-200/80 leading-relaxed">
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
                            class="reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                            <h2 class="text-lg font-bold text-[#0F294D] dark:text-white mb-3 flex items-center gap-2">
                                <span class="w-1 h-5 bg-[#0194F3] rounded-full"></span>
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
                                            '<iframe class="w-full h-72 sm:h-80 border-0 block"',
                                            $embed
                                        );
                                    } else {
                                        $embed = '<iframe src="' . e($embed) . '" class="w-full h-72 sm:h-80 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>';
                                    }
                                @endphp
                                <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                                    {!! $embed !!}
                                </div>
                            @endif

                            @if($accommodation->google_maps_url)
                                <a href="{{ $accommodation->google_maps_url }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 mt-3 text-xs text-[#0194F3] dark:text-[#33ADFF] hover:underline font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka di Google Maps
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- ============= KANAN: INFO CARD (TANPA BOOKING) ============= --}}
                <div class="lg:col-span-1">
                    <div
                        class="reveal-on-scroll lg:sticky lg:top-24 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6">

                        <p class="text-[10px] uppercase tracking-wider text-[#687176] dark:text-gray-400 font-bold">
                            Harga per malam</p>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-3xl font-bold text-[#0194F3]">
                                Rp {{ number_format($accommodation->price ?? 0, 0, ',', '.') }}
                            </span>
                            <span class="text-sm text-[#687176] dark:text-gray-400">/malam</span>
                        </div>

                        <hr class="my-5 border-gray-100 dark:border-gray-700">

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#687176] dark:text-gray-400">Kategori</span>
                                <span class="font-semibold text-[#0F294D] dark:text-white">{{ $categoryName }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#687176] dark:text-gray-400">Kapasitas</span>
                                <span class="font-semibold text-[#0F294D] dark:text-white">
                                    {{ $accommodation->capacity ?? '-' }} orang
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#687176] dark:text-gray-400">Status</span>
                                <span
                                    class="font-semibold {{ $accommodation->status === 'Available' ? 'text-[#00DD73]' : 'text-red-500' }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            @if($categorySlug)
                                <a href="{{ $categoryUrl }}"
                                    class="w-full inline-flex items-center justify-center gap-2 border border-[#0194F3] text-[#0194F3] hover:bg-[#E6F4FF] dark:hover:bg-gray-700 font-semibold rounded-lg text-sm px-5 py-3 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Lihat {{ $categoryName }} Lainnya
                                </a>
                            @endif
                        </div>

                        <p class="mt-4 text-xs text-gray-400 text-center">
                            Harga dapat berubah sewaktu-waktu
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== MODAL GALERI ===================== --}}
    <div id="galleryModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300">

        <div class="relative w-full max-w-5xl max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300"
            id="galleryModalContent">

            {{-- ===== HEADER ===== --}}
            <div
                class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-900 flex-shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <div
                        class="w-9 h-9 bg-[#E6F4FF] dark:bg-[#0194F3]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-[#0194F3] dark:text-[#33ADFF]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-sm font-bold text-[#0F294D] dark:text-white truncate">
                            Galeri {{ $accommodation->title }}
                        </h3>
                        <p class="text-xs text-[#687176] dark:text-gray-400">
                            <span id="galleryCounter">1</span> dari <span id="galleryTotal">{{ $totalImages }}</span> foto
                        </p>
                    </div>
                </div>

                <button type="button" id="closeGalleryModal"
                    class="w-9 h-9 rounded-full flex items-center justify-center text-[#687176] dark:text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 transition-colors flex-shrink-0"
                    title="Tutup (Esc)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- ===== FOTO BESAR ===== --}}
            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[300px]">

                <button type="button" id="galleryPrev"
                    class="absolute left-3 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <img id="galleryMainImage" src="" alt="Foto"
                    class="max-w-full max-h-[60vh] object-contain transition-opacity duration-300 select-none">

                <button type="button" id="galleryNext"
                    class="absolute right-3 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <button type="button" id="galleryFullscreen"
                    class="absolute top-3 right-3 z-10 w-10 h-10 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-md text-white flex items-center justify-center transition-all"
                    title="Buka di tab baru">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </button>
            </div>

            {{-- ===== THUMBNAIL STRIP ===== --}}
            <div class="px-5 py-3 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-700 flex-shrink-0">
                <div id="galleryThumbs" class="flex gap-2 overflow-x-auto pb-1"></div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
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
                 * 3. GALLERY MODAL (existing)
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
                        btn.className = 'gallery-thumb-item flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-all hover:scale-105';
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

                closeBtn.addEventListener('click', closeModal);

                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });

                prevBtn.addEventListener('click', () => showPhoto(current - 1));
                nextBtn.addEventListener('click', () => showPhoto(current + 1));

                fullscreenBtn.addEventListener('click', () => {
                    if (photos[current]) window.open(photos[current], '_blank');
                });

                document.addEventListener('keydown', function (e) {
                    if (modal.classList.contains('hidden')) return;

                    if (e.key === 'Escape') closeModal();
                    if (e.key === 'ArrowLeft') showPhoto(current - 1);
                    if (e.key === 'ArrowRight') showPhoto(current + 1);
                });

                let touchStartX = 0;
                mainImage.addEventListener('touchstart', e => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                mainImage.addEventListener('touchend', e => {
                    const diff = e.changedTouches[0].screenX - touchStartX;
                    if (Math.abs(diff) > 50) {
                        showPhoto(diff > 0 ? current - 1 : current + 1);
                    }
                }, { passive: true });

            });
        </script>
    @endpush
@endsection