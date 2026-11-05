@extends('landingpage.layouts.default.dashboard')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ==================== GLOBAL PAGE LOADER ==================== -->
    <div id="globalLoader"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 dark:bg-gray-900/95 backdrop-blur-md transition-opacity duration-500">
        <div class="flex flex-col items-center gap-4">
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

            <div class="text-center">
                <p class="text-sm sm:text-base font-bold text-[#0F294D] dark:text-white mb-1">
                    Memuat Penginapan
                </p>
                <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400">
                    Mohon tunggu sebentar...
                </p>
            </div>

            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#0194F3] animate-bounce" style="animation-delay: 0s;"></span>
                <span class="w-2 h-2 rounded-full bg-[#33ADFF] animate-bounce" style="animation-delay: 0.15s;"></span>
                <span class="w-2 h-2 rounded-full bg-[#0064D2] animate-bounce" style="animation-delay: 0.3s;"></span>
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

        <div class="container mx-auto px-4 sm:px-6 relative z-10">

            {{-- ===================== HEADER ===================== --}}
            <div class="reveal-on-scroll flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 sm:mb-12 gap-4 sm:gap-6">
                <div class="max-w-xl">
                    <span class="inline-block text-[#0194F3] text-xs sm:text-sm font-bold uppercase tracking-wider mb-2 sm:mb-3">
                        — Penginapan
                    </span>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F294D] dark:text-white leading-tight mb-2 sm:mb-3">
                        Semua <span class="text-[#0194F3]">Penginapan</span>
                    </h1>
                    <p class="text-sm sm:text-lg text-[#687176] dark:text-gray-400">
                        Jelajahi seluruh pilihan penginapan terbaik dan nyaman untuk liburan Anda
                    </p>
                </div>

                <a href="{{ route('landingpage') }}#penginapan"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-gray-800 text-[#0194F3] dark:text-[#33ADFF] border border-[#0194F3]/20 hover:bg-[#0194F3] hover:text-white transition-all shadow-sm hover:shadow-md font-semibold text-xs sm:text-sm group self-start sm:self-auto">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
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
                        @endphp

                        <div class="accommodation-card reveal-on-scroll bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-[#0194F3]/10 hover:border-[#0194F3]/30 group {{ !$isAvailable ? 'opacity-75' : '' }}"
                            data-price="{{ $accommodation->price }}">

                            <div class="relative overflow-hidden">
                                @if($accommodation->thumbnail)
                                    <img src="{{ asset($accommodation->thumbnail) }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @else
                                    <img src="{{ asset('landingpage/kamar.jpg') }}" alt="{{ $accommodation->title }}"
                                        class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500 {{ !$isAvailable ? 'grayscale' : '' }}">
                                @endif

                                {{-- Overlay gradient bawah gambar --}}
                                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/60 to-transparent pointer-events-none"></div>

                                {{-- ============ RATING BADGE (KIRI ATAS) ============ --}}
                                <div class="absolute top-3 left-3 inline-flex items-center gap-1 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-2 py-1 rounded-full shadow-lg border border-white/50">
                                    @if($reviewCount > 0)
                                        <svg class="w-3.5 h-3.5 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-xs font-bold text-[#0F294D] dark:text-white">
                                            {{ number_format($avgRating, 1) }}
                                        </span>
                                        <span class="text-[10px] text-[#687176] dark:text-gray-400">
                                            ({{ $reviewCount }})
                                        </span>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-[10px] font-medium text-[#687176] dark:text-gray-400">
                                            Baru
                                        </span>
                                    @endif
                                </div>
                                {{-- ============ END RATING BADGE ============ --}}

                                {{-- Status badge (KANAN ATAS) --}}
                                <span class="absolute top-3 right-3 {{ $status[0] }} text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                    {{ $status[1] }}
                                </span>

                                {{-- Label kategori pojok bawah gambar --}}
                                <span class="absolute bottom-3 left-3 bg-[#0194F3]/90 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">
                                    {{ $accommodation->category->name ?? 'Penginapan' }}
                                </span>
                            </div>

                            <div class="p-5">
                                <h3 class="font-bold text-[#0F294D] dark:text-white text-base mb-1.5 truncate group-hover:text-[#0194F3] transition-colors">
                                    {{ $accommodation->title }}
                                </h3>
                                <p class="text-[#687176] dark:text-gray-400 text-xs mb-3 flex items-center gap-1 truncate">
                                    <svg class="w-3.5 h-3.5 text-[#0194F3] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ Str::limit($accommodation->address, 30) }}
                                </p>

                                {{-- Fasilitas singkat (chip) --}}
                                <div class="flex flex-wrap items-center gap-1 mb-3">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-[#0194F3] bg-[#E6F4FF] dark:bg-[#0194F3]/20 px-2 py-0.5 rounded-full">
                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5H2v-5zM18 12v4h-4v-4a2 2 0 114 0z" />
                                        </svg>
                                        WiFi
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-[#0194F3] bg-[#E6F4FF] dark:bg-[#0194F3]/20 px-2 py-0.5 rounded-full">
                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12 1.586l6 6V18a2 2 0 01-2 2H4a2 2 0 01-2-2V7.586l6-6h4z" clip-rule="evenodd" />
                                        </svg>
                                        AC
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-[#0194F3] bg-[#E6F4FF] dark:bg-[#0194F3]/20 px-2 py-0.5 rounded-full">
                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16z" />
                                        </svg>
                                        Parkir
                                    </span>
                                </div>

                                <div class="flex items-baseline gap-1 mb-4 pb-4 border-b border-[#0194F3]/10">
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

                {{-- ===================== PAGINATION ===================== --}}
                @if($accommodations->hasPages())
                    <div class="reveal-on-scroll mt-10 sm:mt-14 flex justify-center">
                        {{ $accommodations->links() }}
                    </div>
                @endif
            @else
                {{-- ===================== EMPTY STATE ===================== --}}
                <div class="reveal-on-scroll text-center py-16 sm:py-20">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#0194F3]/10 flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#0F294D] dark:text-white mb-2">Belum Ada Penginapan</h3>
                    <p class="text-sm text-[#687176] dark:text-gray-400 max-w-md mx-auto mb-6">
                        Saat ini belum ada penginapan yang tersedia. Silakan periksa kembali nanti.
                    </p>
                    <a href="{{ route('landingpage') }}"
                        class="inline-flex items-center gap-2 bg-[#0194F3] text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-[#0064D2] transition-all shadow-md">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const loader = document.getElementById('globalLoader');
                if (loader) {
                    setTimeout(() => {
                        loader.classList.add('opacity-0', 'pointer-events-none');
                        setTimeout(() => loader.remove(), 500);
                    }, 300);
                }

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
            });
        </script>
    @endpush
@endsection

