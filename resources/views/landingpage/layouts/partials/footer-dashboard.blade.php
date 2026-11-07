@php
  $isHeroPage = isset($isHeroPage) ? $isHeroPage : (request()->routeIs('landingpage') || request()->is('/'));
  $homeUrl = isset($homeUrl) ? $homeUrl : (Route::has('landingpage') ? route('landingpage') : url('/'));
  $navHref = isset($navHref) ? $navHref : function($id) use ($isHeroPage, $homeUrl) {
      return $isHeroPage ? '#' . $id : $homeUrl . '#' . $id;
  };
@endphp

<!-- Footer -->
<footer class="bg-[#0F294D] text-white py-10 sm:py-12 dark:bg-gray-950 border-t border-gray-700">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

            {{-- =============== KOLOM 1: BRAND + TAGLINE + SOSIAL MEDIA =============== --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <h3 class="text-base font-bold mb-3 text-white flex items-center gap-2 uppercase tracking-wide">
                    @if(!empty($setting->logo))
                        <img src="{{ asset($setting->logo) }}" class="h-6 w-auto object-contain" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
                    @else
                        <img src="{{ asset('landingpage/home.png') }}" class="h-6 w-auto object-contain" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
                    @endif
                    <span class="break-words">{{ $setting->site_name ?? 'adakamar.id' }}</span>
                </h3>           

                <p class="text-xs sm:text-sm text-gray-400 leading-relaxed max-w-md">
                    {{ $setting->tagline ?? 'Platform penginapan terpercaya untuk kebutuhan menginap Anda.' }}
                </p>

                <div class="flex flex-wrap gap-3 mt-5">
                    @if(!empty($setting->facebook))
                        <a href="{{ $setting->facebook }}" target="_blank" rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center rounded-sm border border-gray-600 text-gray-400 hover:text-white hover:bg-[#0194F3] hover:border-[#0194F3] transition-colors" title="Facebook">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                    @endif
                    @if(!empty($setting->twitter))
                        <a href="{{ $setting->twitter }}" target="_blank" rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center rounded-sm border border-gray-600 text-gray-400 hover:text-white hover:bg-[#0194F3] hover:border-[#0194F3] transition-colors" title="Twitter / X">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                    @endif
                    @if(!empty($setting->instagram))
                        <a href="{{ $setting->instagram }}" target="_blank" rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center rounded-sm border border-gray-600 text-gray-400 hover:text-white hover:bg-[#0194F3] hover:border-[#0194F3] transition-colors" title="Instagram">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                    @endif
                    @if(!empty($setting->youtube))
                        <a href="{{ $setting->youtube }}" target="_blank" rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center rounded-sm border border-gray-600 text-gray-400 hover:text-white hover:bg-[#0194F3] hover:border-[#0194F3] transition-colors" title="YouTube">
                            <i data-lucide="youtube" class="w-4 h-4"></i>
                        </a>
                    @endif
                    @if(!empty($setting->tiktok))
                        <a href="{{ $setting->tiktok }}" target="_blank" rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center rounded-sm border border-gray-600 text-gray-400 hover:text-white hover:bg-[#0194F3] hover:border-[#0194F3] transition-colors" title="TikTok">
                            <i data-lucide="music-2" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- =============== KOLOM 2 & 3: MENU + INFORMASI =============== --}}
            <div class="grid grid-cols-2 gap-8 sm:contents">
                {{-- Kolom 2: MENU --}}
                <div>
                    <h4 class="font-bold mb-4 text-white text-xs sm:text-sm uppercase tracking-wider border-b border-gray-700 pb-2">Menu</h4>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-400">
                        <li><a href="{{ $navHref('beranda') }}" class="hover:text-[#33ADFF] transition-colors">Beranda</a></li>
                        <li><a href="{{ $navHref('tentang') }}" class="hover:text-[#33ADFF] transition-colors">Tentang</a></li>
                        <li><a href="{{ route('accommodationlanding.semua') }}" class="hover:text-[#33ADFF] transition-colors">Cari Penginapan</a></li>
                        <li><a href="{{ $navHref('galeri') }}" class="hover:text-[#33ADFF] transition-colors">Galeri</a></li>
                        <li><a href="{{ $navHref('artikel') }}" class="hover:text-[#33ADFF] transition-colors">Artikel</a></li>
                        <li><a href="{{ $navHref('kontak') }}" class="hover:text-[#33ADFF] transition-colors">Kontak</a></li>
                    </ul>
                </div>

            </div>

            {{-- =============== KOLOM 4: KONTAK =============== --}}
            <div class="sm:col-span-2 lg:col-span-1">
                <h4 class="font-bold mb-4 text-white text-xs sm:text-sm uppercase tracking-wider border-b border-gray-700 pb-2">Hubungi Kami</h4>
                <ul class="space-y-3 text-xs sm:text-sm text-gray-400">

                    {{-- Email --}}
                    @if(!empty($setting->email))
                        <li class="flex items-start gap-2.5">
                            <i data-lucide="mail" class="w-4 h-4 text-[#0194F3] flex-shrink-0 mt-0.5"></i>
                            <a href="mailto:{{ $setting->email }}" class="hover:text-[#33ADFF] transition-colors break-all">
                                {{ $setting->email }}
                            </a>
                        </li>
                    @endif

                    {{-- Telepon --}}
                    @if(!empty($setting->phone))
                        <li class="flex items-start gap-2.5">
                            <i data-lucide="phone" class="w-4 h-4 text-[#0194F3] flex-shrink-0 mt-0.5"></i>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->phone) }}" class="hover:text-[#33ADFF] transition-colors break-all">
                                {{ $setting->phone }}
                            </a>
                        </li>
                    @endif

                    {{-- WhatsApp --}}
                    @if(!empty($setting->whatsapp))
                        <li class="flex items-start gap-2.5">
                            <i data-lucide="message-circle" class="w-4 h-4 text-[#0194F3] flex-shrink-0 mt-0.5"></i>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#33ADFF] transition-colors break-all">
                                {{ $setting->whatsapp }}
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>

        {{-- =============== COPYRIGHT =============== --}}
        @if(!empty($setting->copyright))
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-[11px] sm:text-xs text-gray-500">
                <p class="px-2">{{ $setting->copyright }}</p>
            </div>
        @endif
    </div>
</footer>