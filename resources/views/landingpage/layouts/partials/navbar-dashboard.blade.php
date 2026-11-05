@php
  $isHeroPage = $isHeroPage ?? (request()->routeIs('landingpage') || request()->is('/'));
  $homeUrl = $homeUrl ?? (Route::has('landingpage') ? route('landingpage') : url('/'));
  $navHref = $navHref ?? fn($id) => $isHeroPage ? '#' . $id : $homeUrl . '#' . $id;
@endphp

{{-- ============================================================
     HEADER NAVBAR — FIXED DI ATAS
     ============================================================ --}}
<nav id="mainNavbar" class="fixed top-0 left-0 right-0 z-50 w-full transition-all duration-300 {{ !$isHeroPage ? 'navbar-scrolled' : '' }}"
  data-hero-page="{{ $isHeroPage ? 'true' : 'false' }}">

  <div class="px-3 xs:px-4 py-2 sm:py-2.5 lg:px-6 lg:py-3">
    <div class="flex items-center justify-between gap-2 sm:gap-3
                lg:grid lg:grid-cols-3">

      <!-- LEFT: Logo + Brand -->
      <div class="flex items-center gap-1.5 xs:gap-2 min-w-0 justify-start">
        <a href="{{ $homeUrl }}" class="flex items-center min-w-0">
          @if(!empty($setting?->logo))
            <img src="{{ asset($setting->logo) }}" class="h-6 xs:h-7 sm:h-8 mr-1.5 xs:mr-2 sm:mr-3 object-contain flex-shrink-0" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
          @else
            <img src="{{ asset('landingpage/home.png') }}" class="h-6 xs:h-7 sm:h-8 mr-1.5 xs:mr-2 sm:mr-3 object-contain flex-shrink-0" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
          @endif
          <span id="navbarBrand"
            class="text-base xs:text-lg sm:text-xl lg:text-2xl font-semibold truncate transition-colors duration-300">
            {{ $setting->site_name ?? 'adakamar.id' }}
          </span>
        </a>
      </div>

      <!-- CENTER: Desktop Menu -->
      <div class="hidden lg:flex items-center justify-center space-x-6 xl:space-x-8">
        <a href="{{ $navHref('beranda') }}" data-scroll="beranda"
          class="nav-link nav-text font-medium transition-colors duration-300">Beranda</a>
        <a href="{{ $navHref('tentang') }}" data-scroll="tentang"
          class="nav-link nav-text font-medium transition-colors duration-300">Tentang</a>
        <a href="{{ $navHref('penginapan') }}" data-scroll="penginapan"
          class="nav-link nav-text font-medium transition-colors duration-300">Penginapan</a>
        <a href="{{ $navHref('galeri') }}" data-scroll="galeri"
          class="nav-link nav-text font-medium transition-colors duration-300">Galeri</a>
        <a href="{{ $navHref('artikel') }}" data-scroll="artikel"
          class="nav-link nav-text font-medium transition-colors duration-300">Artikel</a>
        <a href="{{ $navHref('kontak') }}" data-scroll="kontak"
          class="nav-link nav-text font-medium transition-colors duration-300">Kontak</a>
      </div>

      <!-- RIGHT: Theme Toggle -->
      <div class="flex items-center justify-end flex-shrink-0">
        <button id="theme-toggle" type="button" aria-label="Toggle Theme"
          class="nav-text text-sm p-2 sm:p-2.5 min-w-[40px] min-h-[40px] sm:min-w-[44px] sm:min-h-[44px] rounded-lg hover:bg-white/20 transition-colors duration-300 flex items-center justify-center">
          <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>

    </div>
  </div>
</nav>

{{-- ============================================================
     BOTTOM NAVIGATION BAR — FIXED DI PALING BAWAH (Mobile Only)
     Menu di CENTER horizontal
     ============================================================ --}}
<div id="mobileMenuBar"
  class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-t border-gray-200 dark:border-gray-700 shadow-[0_-2px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_-2px_10px_rgba(0,0,0,0.4)]"
  style="padding-bottom: env(safe-area-inset-bottom);">

  {{-- Wrapper scroll horizontal --}}
  <div class="relative">
    {{-- Fade gradient kiri --}}
    <div class="mobile-tab-fade-left pointer-events-none absolute left-0 top-0 bottom-0 w-6 z-10"></div>

    {{-- Scroll area — CENTER content --}}
    <div id="mobileMenuScroll" class="overflow-x-auto scrollbar-hide">
      <div class="flex items-center justify-center gap-0 px-2 xs:px-3 min-w-max mx-auto">
        <a href="{{ $navHref('beranda') }}" data-scroll="beranda"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Beranda
        </a>
        <a href="{{ $navHref('tentang') }}" data-scroll="tentang"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Tentang
        </a>
        <a href="{{ $navHref('penginapan') }}" data-scroll="penginapan"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Penginapan
        </a>
        <a href="{{ $navHref('galeri') }}" data-scroll="galeri"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Galeri
        </a>
        <a href="{{ $navHref('artikel') }}" data-scroll="artikel"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Artikel
        </a>
        <a href="{{ $navHref('kontak') }}" data-scroll="kontak"
          class="mobile-nav-tab relative whitespace-nowrap px-3 xs:px-4 sm:px-5 py-2 xs:py-2.5 text-[11px] xs:text-[12px] sm:text-sm font-semibold transition-colors duration-200 flex-shrink-0 flex items-center justify-center">
          Kontak
        </a>
      </div>
    </div>

    {{-- Fade gradient kanan --}}
    <div class="mobile-tab-fade-right pointer-events-none absolute right-0 top-0 bottom-0 w-6 z-10"></div>
  </div>
</div>

<style>
  /* ============================================
     PREVENT HORIZONTAL OVERFLOW
     ============================================ */
  #mainNavbar {
    max-width: 100vw;
    overflow-x: hidden;
  }

  /* ============================================
     NAVBAR DEFAULT: TRANSPARAN (HERO PAGE)
     ============================================ */
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) {
    background-color: transparent !important;
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-text,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #navbarBrand,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #theme-toggle {
    color: #ffffff !important;
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link:hover,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #theme-toggle:hover {
    color: #33ADFF !important;
  }

  /* ============================================
     NAVBAR SETELAH SCROLL / BUKAN HERO PAGE: SOLID
     ============================================ */
  #mainNavbar.navbar-scrolled {
    background-color: #ffffff !important;
    background: #ffffff !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
  }

  #mainNavbar.navbar-scrolled .nav-text,
  #mainNavbar.navbar-scrolled .nav-link {
    color: #0F294D !important;
  }

  #mainNavbar.navbar-scrolled #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar.navbar-scrolled .nav-text:hover,
  #mainNavbar.navbar-scrolled .nav-link:hover {
    color: #0194F3 !important;
  }

  #mainNavbar.navbar-scrolled #theme-toggle {
    color: #0F294D !important;
  }

  #mainNavbar.navbar-scrolled #theme-toggle:hover {
    color: #0194F3 !important;
  }

  /* ============================================
     DARK MODE SETELAH SCROLL / BUKAN HERO PAGE
     ============================================ */
  .dark #mainNavbar.navbar-scrolled {
    background-color: #111827 !important;
  }

  .dark #mainNavbar.navbar-scrolled .nav-text,
  .dark #mainNavbar.navbar-scrolled .nav-link {
    color: #d1d5db !important;
  }

  .dark #mainNavbar.navbar-scrolled #navbarBrand {
    color: #33ADFF !important;
  }

  .dark #mainNavbar.navbar-scrolled .nav-text:hover,
  .dark #mainNavbar.navbar-scrolled .nav-link:hover {
    color: #33ADFF !important;
  }

  .dark #mainNavbar.navbar-scrolled #theme-toggle {
    color: #d1d5db !important;
  }

  .dark #mainNavbar.navbar-scrolled #theme-toggle:hover {
    color: #33ADFF !important;
  }

  /* ============================================
     FALLBACK: Halaman bukan hero (langsung solid)
     ============================================ */
  #mainNavbar[data-hero-page="false"] {
    background-color: #ffffff !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text,
  #mainNavbar[data-hero-page="false"] .nav-link {
    color: #0F294D !important;
  }

  #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text:hover,
  #mainNavbar[data-hero-page="false"] .nav-link:hover {
    color: #0194F3 !important;
  }

  #mainNavbar[data-hero-page="false"] #theme-toggle {
    color: #0F294D !important;
  }

  #mainNavbar[data-hero-page="false"] #theme-toggle:hover {
    color: #0194F3 !important;
  }

  .dark #mainNavbar[data-hero-page="false"] {
    background-color: #111827 !important;
  }

  .dark #mainNavbar[data-hero-page="false"] .nav-text,
  .dark #mainNavbar[data-hero-page="false"] .nav-link {
    color: #d1d5db !important;
  }

  .dark #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #33ADFF !important;
  }

  .dark #mainNavbar[data-hero-page="false"] .nav-text:hover,
  .dark #mainNavbar[data-hero-page="false"] .nav-link:hover {
    color: #33ADFF !important;
  }

  .dark #mainNavbar[data-hero-page="false"] #theme-toggle {
    color: #d1d5db !important;
  }

  .dark #mainNavbar[data-hero-page="false"] #theme-toggle:hover {
    color: #33ADFF !important;
  }

  /* ============================================
     BOTTOM NAVIGATION BAR — YOUTUBE STYLE
     ============================================ */
  #mobileMenuBar {
    background-color: #ffffff;
  }

  .dark #mobileMenuBar {
    background-color: #111827;
    border-top-color: #374151 !important;
  }

  /* Tab item — default */
  .mobile-nav-tab {
    color: #606060;
    background-color: transparent;
    transition: color 0.2s ease;
  }

  .mobile-nav-tab:hover {
    color: #0F0F0F;
  }

  /* Tab active — underline seperti YouTube */
  .mobile-nav-tab.active {
    color: #0F0F0F;
    font-weight: 700;
  }

  .mobile-nav-tab.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0.5rem;
    right: 0.5rem;
    height: 3px;
    background: linear-gradient(90deg, #0194F3 0%, #0064D2 100%);
    border-radius: 3px 3px 0 0;
  }

  /* Dark mode */
  .dark .mobile-nav-tab {
    color: #AAAAAA;
  }

  .dark .mobile-nav-tab:hover {
    color: #FFFFFF;
  }

  .dark .mobile-nav-tab.active {
    color: #FFFFFF;
  }

  .dark .mobile-nav-tab.active::after {
    background: linear-gradient(90deg, #33ADFF 0%, #0194F3 100%);
  }

  /* ============================================
     FADE GRADIENT KIRI-KANAN
     ============================================ */
  .mobile-tab-fade-left {
    background: linear-gradient(to right, #ffffff 0%, rgba(255, 255, 255, 0) 100%);
    opacity: 0;
    transition: opacity 0.2s ease;
  }

  .mobile-tab-fade-right {
    background: linear-gradient(to left, #ffffff 0%, rgba(255, 255, 255, 0) 100%);
  }

  .dark .mobile-tab-fade-left {
    background: linear-gradient(to right, #111827 0%, rgba(17, 24, 39, 0) 100%);
  }

  .dark .mobile-tab-fade-right {
    background: linear-gradient(to left, #111827 0%, rgba(17, 24, 39, 0) 100%);
  }

  /* ============================================
     SCROLLBAR HIDE
     ============================================ */
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }

  /* ============================================
     BODY PADDING BOTTOM — Supaya konten tidak tertutup menu bar
     ============================================ */
  @media (max-width: 1023.98px) {
    body {
      padding-bottom: calc(56px + env(safe-area-inset-bottom, 0px));
    }
  }

  /* ============================================
     ACTIVE MENU DESKTOP (UNDERLINE)
     ============================================ */
  .nav-link {
    position: relative;
    padding-bottom: 4px;
  }

  .nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #0194F3;
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.3s ease;
    border-radius: 2px;
  }

  .nav-link:hover::after,
  .nav-link.active::after {
    transform: scaleX(1);
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link.active::after {
    background-color: #33ADFF;
  }

  .dark #mainNavbar.navbar-scrolled .nav-link.active::after,
  .dark #mainNavbar[data-hero-page="false"] .nav-link.active::after {
    background-color: #33ADFF;
  }

  /* ============================================
     TAP HIGHLIGHT REMOVAL
     ============================================ */
  #mainNavbar button,
  #mainNavbar a,
  #mobileMenuBar a {
    -webkit-tap-highlight-color: transparent;
  }

  /* ============================================
     SMOOTH SCROLL BEHAVIOR
     ============================================ */
  html {
    scroll-behavior: smooth;
  }

  /* ============================================
     EXTRA SMALL (<360px) — COMPACT
     ============================================ */
  @media (max-width: 359px) {
    #navbarBrand {
      font-size: 0.875rem !important;
    }
    #mainNavbar .px-3 {
      padding-left: 0.5rem !important;
      padding-right: 0.5rem !important;
    }
    .mobile-nav-tab {
      padding-left: 0.5rem !important;
      padding-right: 0.5rem !important;
      font-size: 0.625rem !important;
    }
  }

  /* ============================================
     TABLET LANDSCAPE (1024-1280px) — BRAND TRUNCATE
     ============================================ */
  @media (min-width: 1024px) and (max-width: 1279px) {
    #mainNavbar #navbarBrand {
      font-size: 1.125rem !important;
      max-width: 180px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    #mainNavbar .nav-link.nav-text {
      font-size: 0.875rem !important;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');
    const isHeroPage = navbar.dataset.heroPage === 'true';

    // ========== NAVBAR SCROLL EFFECT ==========
    function handleNavbarScroll() {
      if (!isHeroPage) return;
      if (window.scrollY > 50) {
        navbar.classList.add('navbar-scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
      }
    }

    handleNavbarScroll();
    window.addEventListener('scroll', handleNavbarScroll, { passive: true });

    // ========== SMOOTH SCROLL KE SECTION ==========
    document.querySelectorAll('a[data-scroll]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        const targetId = this.getAttribute('data-scroll');
        const targetEl = document.getElementById(targetId);

        if (!targetEl) return;

        e.preventDefault();

        const navbarHeight = navbar.offsetHeight;
        const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 10;

        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
      });
    });

    // ========== HANDLE HASH SAAT LANDING PAGE DIBUKA DARI HALAMAN LAIN ==========
    if (isHeroPage && window.location.hash) {
      const id = window.location.hash.substring(1);
      const targetEl = document.getElementById(id);
      if (targetEl) {
        setTimeout(function () {
          const navbarHeight = navbar.offsetHeight;
          const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 10;
          window.scrollTo({ top: targetPosition, behavior: 'smooth' });

          if (history.replaceState) {
            history.replaceState(null, '', window.location.pathname + window.location.search);
          }
        }, 150);
      }
    }

    // ========== ACTIVE MENU SAAT SCROLL ==========
    if (isHeroPage) {
      const sections = document.querySelectorAll('section[id], div[id="beranda"]');
      const desktopLinks = document.querySelectorAll('.nav-link');
      const mobileTabs = document.querySelectorAll('.mobile-nav-tab');
      const mobileScroll = document.getElementById('mobileMenuScroll');
      const fadeLeft = document.querySelector('.mobile-tab-fade-left');
      const fadeRight = document.querySelector('.mobile-tab-fade-right');

      function updateActiveMenu() {
        let currentSection = '';
        const scrollPosition = window.scrollY + navbar.offsetHeight + 50;

        sections.forEach(function (section) {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.offsetHeight;

          if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
          }
        });

        if (window.scrollY < 100) {
          currentSection = 'beranda';
        }

        desktopLinks.forEach(function (link) {
          link.classList.remove('active');
          if (link.getAttribute('data-scroll') === currentSection) {
            link.classList.add('active');
          }
        });

        mobileTabs.forEach(function (tab) {
          tab.classList.remove('active');
          if (tab.getAttribute('data-scroll') === currentSection) {
            tab.classList.add('active');

            // Auto-scroll tab aktif ke tengah
            if (mobileScroll) {
              const tabRect = tab.getBoundingClientRect();
              const containerRect = mobileScroll.getBoundingClientRect();

              const isTabVisible = tabRect.left >= containerRect.left && tabRect.right <= containerRect.right;

              if (!isTabVisible) {
                const scrollLeft = tab.offsetLeft - (mobileScroll.clientWidth / 2) + (tab.clientWidth / 2);
                mobileScroll.scrollTo({ left: scrollLeft, behavior: 'smooth' });
              }
            }
          }
        });
      }

      if (sections.length > 0) {
        updateActiveMenu();
        window.addEventListener('scroll', updateActiveMenu, { passive: true });
      }

      // ========== FADE INDICATOR ==========
      function updateFadeIndicators() {
        if (!mobileScroll || !fadeLeft || !fadeRight) return;

        const scrollLeft = mobileScroll.scrollLeft;
        const scrollWidth = mobileScroll.scrollWidth;
        const clientWidth = mobileScroll.clientWidth;
        const maxScroll = scrollWidth - clientWidth;

        fadeLeft.style.opacity = scrollLeft > 10 ? '1' : '0';
        fadeRight.style.opacity = (scrollLeft < maxScroll - 10) ? '1' : '0';
      }

      if (mobileScroll) {
        mobileScroll.addEventListener('scroll', updateFadeIndicators, { passive: true });
        window.addEventListener('resize', updateFadeIndicators);
        setTimeout(updateFadeIndicators, 100);
      }
    }
  });
</script>