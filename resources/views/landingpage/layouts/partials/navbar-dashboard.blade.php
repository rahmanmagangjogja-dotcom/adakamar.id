@php
  $isHeroPage = isset($isHeroPage) ? $isHeroPage : (request()->routeIs('landingpage') || request()->is('/'));
  $homeUrl = isset($homeUrl) ? $homeUrl : (Route::has('landingpage') ? route('landingpage') : url('/'));
  $navHref = isset($navHref) ? $navHref : function($id) use ($isHeroPage, $homeUrl) {
      return $isHeroPage ? '#' . $id : $homeUrl . '#' . $id;
  };
@endphp

{{-- ============================================================
     HEADER NAVBAR — FIXED DI ATAS
     ============================================================ --}}
<nav id="mainNavbar" class="fixed top-0 left-0 right-0 z-50 w-full transition-all duration-300 border-b border-gray-200 dark:border-gray-800 {{ !$isHeroPage ? 'navbar-scrolled' : '' }}"
  data-hero-page="{{ $isHeroPage ? 'true' : 'false' }}">

  <div class="px-4 py-2.5 lg:px-6 lg:py-3">
    <div class="flex items-center justify-between gap-2 sm:gap-3 lg:grid lg:grid-cols-3">

      <!-- LEFT: Logo + Brand -->
      <div class="flex items-center gap-2 min-w-0 justify-start">
        <a href="{{ $homeUrl }}" class="flex items-center min-w-0">
          @if(!empty($setting?->logo))
            <img src="{{ asset($setting->logo) }}" class="h-7 sm:h-8 mr-2 object-contain flex-shrink-0" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
          @else
            <img src="{{ asset('landingpage/home.png') }}" class="h-7 sm:h-8 mr-2 object-contain flex-shrink-0" alt="{{ $setting->site_name ?? 'adakamar.id' }} Logo" />
          @endif
          <span id="navbarBrand" class="text-base sm:text-lg lg:text-xl font-bold truncate transition-colors duration-300 uppercase tracking-wide">
            {{ $setting->site_name ?? 'adakamar.id' }}
          </span>
        </a>
      </div>

      <!-- CENTER: Desktop Menu -->
      <div class="hidden lg:flex items-center justify-center space-x-6 xl:space-x-8">
        <a href="{{ $navHref('beranda') }}" data-scroll="beranda" class="nav-link nav-text text-sm font-bold uppercase tracking-wide transition-colors duration-300">Beranda</a>
        <a href="{{ route('accommodationlanding.semua') }}"
          class="nav-link nav-text text-sm font-bold uppercase tracking-wide whitespace-nowrap transition-colors duration-300 {{ request()->routeIs('accommodationlanding.semua') ? 'active' : '' }}">Cari Penginapan</a>
        <a href="{{ $navHref('galeri') }}" data-scroll="galeri" class="nav-link nav-text text-sm font-bold uppercase tracking-wide transition-colors duration-300">Galeri</a>
        
        <a href="{{ $navHref('kontak') }}" data-scroll="kontak" class="nav-link nav-text text-sm font-bold uppercase tracking-wide transition-colors duration-300">Kontak</a>
      </div>

      <!-- RIGHT: Theme Toggle -->
      <div class="flex items-center justify-end flex-shrink-0">
        <button id="theme-toggle" type="button" aria-label="Toggle Theme"
          class="nav-text p-2 rounded-sm border border-transparent hover:border-gray-300 dark:hover:border-gray-600 transition-colors duration-300 flex items-center justify-center">
          <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>

    </div>
  </div>
</nav>

{{-- ============================================================
     BOTTOM NAVIGATION BAR — FIXED DI PALING BAWAH (Mobile Only)
     ============================================================ --}}
<div id="mobileMenuBar"
  class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700"
  style="padding-bottom: env(safe-area-inset-bottom);">

  <div class="flex items-center justify-around px-1 py-1">
    <a href="{{ $navHref('beranda') }}" data-scroll="beranda" class="mobile-nav-tab flex flex-col items-center justify-center w-full py-1.5 text-[10px] font-bold uppercase tracking-wider transition-colors duration-200">
      <i data-lucide="home" class="w-5 h-5 mb-0.5"></i>
      <span>Beranda</span>
    </a>
    <a href="{{ route('accommodationlanding.semua') }}"
        class="mobile-nav-tab flex flex-col items-center justify-center w-full py-1.5 text-[10px] font-bold uppercase tracking-wider whitespace-nowrap transition-colors duration-200 {{ request()->routeIs('accommodationlanding.semua') ? 'active' : '' }}">
        <i data-lucide="search" class="w-5 h-5 mb-0.5"></i>
        Cari Penginapan
    </a>
    <a href="{{ $navHref('galeri') }}" data-scroll="galeri" class="mobile-nav-tab flex flex-col items-center justify-center w-full py-1.5 text-[10px] font-bold uppercase tracking-wider transition-colors duration-200">
      <i data-lucide="image" class="w-5 h-5 mb-0.5"></i>
      <span>Galeri</span>
    </a>

    <a href="{{ $navHref('kontak') }}" data-scroll="kontak" class="mobile-nav-tab flex flex-col items-center justify-center w-full py-1.5 text-[10px] font-bold uppercase tracking-wider transition-colors duration-200">
      <i data-lucide="phone" class="w-5 h-5 mb-0.5"></i>
      <span>Kontak</span>
    </a>
  </div>
</div>

<style>
  /* ============================================
     NAVBAR DEFAULT: TRANSPARAN (HERO PAGE)
     ============================================ */
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) {
    background-color: transparent !important;
    box-shadow: none !important;
    border-bottom: none !important;
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-text,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #navbarBrand,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #theme-toggle {
    color: #ffffff !important;
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link:hover,
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #theme-toggle:hover {
    color: #E6F4FF !important;
  }

  /* ============================================
     NAVBAR SETELAH SCROLL / BUKAN HERO PAGE: SOLID
     ============================================ */
  #mainNavbar.navbar-scrolled {
    background-color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
    border-bottom: 1px solid #e5e7eb !important;
  }

  .dark #mainNavbar.navbar-scrolled {
    background-color: #111827 !important;
    border-bottom: 1px solid #374151 !important;
  }

  #mainNavbar.navbar-scrolled .nav-text,
  #mainNavbar.navbar-scrolled .nav-link {
    color: #4b5563 !important;
  }

  #mainNavbar.navbar-scrolled #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar.navbar-scrolled .nav-text:hover,
  #mainNavbar.navbar-scrolled .nav-link:hover {
    color: #0194F3 !important;
  }

  #mainNavbar.navbar-scrolled #theme-toggle {
    color: #4b5563 !important;
  }

  .dark #mainNavbar.navbar-scrolled .nav-text,
  .dark #mainNavbar.navbar-scrolled .nav-link,
  .dark #mainNavbar.navbar-scrolled #theme-toggle {
    color: #d1d5db !important;
  }

  .dark #mainNavbar.navbar-scrolled #navbarBrand {
    color: #33ADFF !important;
  }

  /* ============================================
     FALLBACK: Halaman bukan hero (langsung solid)
     ============================================ */
  #mainNavbar[data-hero-page="false"] {
    background-color: #ffffff !important;
    border-bottom: 1px solid #e5e7eb !important;
  }

  .dark #mainNavbar[data-hero-page="false"] {
    background-color: #111827 !important;
    border-bottom: 1px solid #374151 !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text,
  #mainNavbar[data-hero-page="false"] .nav-link {
    color: #4b5563 !important;
  }

  #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text:hover,
  #mainNavbar[data-hero-page="false"] .nav-link:hover {
    color: #0194F3 !important;
  }

  .dark #mainNavbar[data-hero-page="false"] .nav-text,
  .dark #mainNavbar[data-hero-page="false"] .nav-link {
    color: #d1d5db !important;
  }

  .dark #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #33ADFF !important;
  }

  /* ============================================
     BOTTOM NAVIGATION BAR — FORMAL STYLE
     ============================================ */
  .mobile-nav-tab {
    color: #6b7280;
    transition: color 0.2s ease;
  }

  .mobile-nav-tab:hover {
    color: #0F294D;
  }

  .dark .mobile-nav-tab {
    color: #9ca3af;
  }

  .dark .mobile-nav-tab:hover {
    color: #ffffff;
  }

  /* Active State */
  .mobile-nav-tab.active {
    color: #0194F3;
  }

  .dark .mobile-nav-tab.active {
    color: #33ADFF;
  }

  /* Active State Icon Fill (Opsional, jika menggunakan Lucide bisa diatur via CSS) */
  .mobile-nav-tab.active i {
    stroke-width: 2.5;
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
    border-radius: 0; /* Kaku, tanpa rounded */
  }

  .nav-link:hover::after,
  .nav-link.active::after {
    transform: scaleX(1);
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-link.active::after {
    background-color: #ffffff;
  }

  .dark #mainNavbar.navbar-scrolled .nav-link.active::after,
  .dark #mainNavbar[data-hero-page="false"] .nav-link.active::after {
    background-color: #33ADFF;
  }

  /* ============================================
     SCROLLBAR HIDE & BODY PADDING
     ============================================ */
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }

  @media (max-width: 1023.98px) {
    body {
      padding-bottom: calc(60px + env(safe-area-inset-bottom, 0px));
    }
  }

  /* ============================================
     SMOOTH SCROLL BEHAVIOR
     ============================================ */
  html {
    scroll-behavior: smooth;
  }

  /* ============================================
     TAP HIGHLIGHT REMOVAL
     ============================================ */
  #mainNavbar button,
  #mainNavbar a,
  #mobileMenuBar a {
    -webkit-tap-highlight-color: transparent;
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
          }
        });
      }

      if (sections.length > 0) {
        updateActiveMenu();
        window.addEventListener('scroll', updateActiveMenu, { passive: true });
      }
    }

    // Render Lucide Icons
    if (window.renderLucide) {
      window.renderLucide();
    } else if (window.lucide) {
      lucide.createIcons();
    }
  });
</script>