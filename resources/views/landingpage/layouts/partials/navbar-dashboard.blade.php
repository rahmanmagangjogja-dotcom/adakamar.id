@php
  // Cek apakah saat ini di landing page (hero section)
  $isHeroPage = request()->routeIs('landingpage') || request()->is('/');
@endphp

<nav id="mainNavbar" class="fixed z-50 w-full transition-all duration-300 {{ !$isHeroPage ? 'navbar-scrolled' : '' }}"
  data-hero-page="{{ $isHeroPage ? 'true' : 'false' }}">
  <div class="px-4 py-3 lg:px-6">
    <div class="flex items-center justify-between">

      <!-- LEFT: Mobile Toggle + Logo -->
      <div class="flex items-center gap-2">
        <button id="mobileMenuButton" type="button" aria-label="Toggle Menu"
          class="nav-text p-2 rounded-lg lg:hidden hover:bg-white/20 focus:bg-white/20 focus:ring-2 focus:ring-[#0194F3] transition-colors duration-300">
          <svg id="mobileMenuIconOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg id="mobileMenuIconClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>

        <a href="{{ url('/') }}" class="flex items-center">
          <img src="{{ asset('landingpage/home.png') }}" class="h-8 mr-2 sm:mr-3" alt="adakamar.id Logo" />
          <span id="navbarBrand"
            class="text-lg sm:text-xl lg:text-2xl font-semibold whitespace-nowrap transition-colors duration-300">
            adakamar.id
          </span>
        </a>
      </div>

      <!-- CENTER: Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
        <a href="#beranda" data-scroll="beranda"
          class="nav-link nav-text font-medium transition-colors duration-300">Beranda</a>
        <a href="#tentang" data-scroll="tentang"
          class="nav-link nav-text font-medium transition-colors duration-300">Tentang</a>
        <a href="#penginapan" data-scroll="penginapan"
          class="nav-link nav-text font-medium transition-colors duration-300">Penginapan</a>
        <a href="#galeri" data-scroll="galeri"
          class="nav-link nav-text font-medium transition-colors duration-300">Galeri</a>
        <a href="#artikel" data-scroll="artikel"
          class="nav-link nav-text font-medium transition-colors duration-300">Artikel</a>
        <a href="#kontak" data-scroll="kontak"
          class="nav-link nav-text font-medium transition-colors duration-300">Kontak</a>
      </div>

      <!-- RIGHT: Theme Toggle -->
      <div class="flex items-center">
        <button id="theme-toggle" type="button" aria-label="Toggle Theme"
          class="nav-text text-sm p-2.5 rounded-lg hover:bg-white/20 transition-colors duration-300">
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

  <!-- Mobile Menu Dropdown -->
  <div id="mobileMenu" class="hidden lg:hidden bg-white dark:bg-gray-900 shadow-lg">
    <div class="flex flex-col px-4 py-3">
      <a href="#beranda" data-scroll="beranda"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3 border-b border-[#E6F4FF] dark:border-gray-700">Beranda</a>
      <a href="#tentang" data-scroll="tentang"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3 border-b border-[#E6F4FF] dark:border-gray-700">Tentang</a>
      <a href="#penginapan" data-scroll="penginapan"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3 border-b border-[#E6F4FF] dark:border-gray-700">Penginapan</a>
      <a href="#galeri" data-scroll="galeri"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3 border-b border-[#E6F4FF] dark:border-gray-700">Galeri</a>
      <a href="#artikel" data-scroll="artikel"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3 border-b border-[#E6F4FF] dark:border-gray-700">Artikel</a>
      <a href="#kontak" data-scroll="kontak"
        class="nav-link text-[#0F294D] hover:text-[#0194F3] dark:text-gray-300 dark:hover:text-[#33ADFF] font-medium transition-colors py-3">Kontak</a>
    </div>
  </div>
</nav>

<style>
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
  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) #navbarBrand {
    color: #ffffff !important;
  }

  #mainNavbar[data-hero-page="true"]:not(.navbar-scrolled) .nav-text:hover {
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

  #mainNavbar.navbar-scrolled .nav-text {
    color: #0F294D !important;
  }

  #mainNavbar.navbar-scrolled #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar.navbar-scrolled .nav-text:hover {
    color: #0194F3 !important;
  }

  /* ============================================
     DARK MODE SETELAH SCROLL / BUKAN HERO PAGE
     ============================================ */
  .dark #mainNavbar.navbar-scrolled {
    background-color: #111827 !important;
  }

  .dark #mainNavbar.navbar-scrolled .nav-text {
    color: #d1d5db !important;
  }

  .dark #mainNavbar.navbar-scrolled #navbarBrand {
    color: #33ADFF !important;
  }

  .dark #mainNavbar.navbar-scrolled .nav-text:hover {
    color: #33ADFF !important;
  }

  /* ============================================
     FALLBACK: Halaman bukan hero (langsung solid)
     ============================================ */
  #mainNavbar[data-hero-page="false"] {
    background-color: #ffffff !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text {
    color: #0F294D !important;
  }

  #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #0194F3 !important;
  }

  #mainNavbar[data-hero-page="false"] .nav-text:hover {
    color: #0194F3 !important;
  }

  .dark #mainNavbar[data-hero-page="false"] {
    background-color: #111827 !important;
  }

  .dark #mainNavbar[data-hero-page="false"] .nav-text {
    color: #d1d5db !important;
  }

  .dark #mainNavbar[data-hero-page="false"] #navbarBrand {
    color: #33ADFF !important;
  }

  .dark #mainNavbar[data-hero-page="false"] .nav-text:hover {
    color: #33ADFF !important;
  }

  /* ============================================
     ACTIVE MENU (SECTION YANG SEDANG DILIHAT)
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

  .dark #mainNavbar.navbar-scrolled .nav-link.active::after {
    background-color: #33ADFF;
  }

  /* Smooth scroll behavior */
  html {
    scroll-behavior: smooth;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');
    const isHeroPage = navbar.dataset.heroPage === 'true';

    // ========== NAVBAR SCROLL EFFECT (HANYA UNTUK HALAMAN HERO) ==========
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

    // ========== MOBILE MENU TOGGLE ==========
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const iconOpen = document.getElementById('mobileMenuIconOpen');
    const iconClose = document.getElementById('mobileMenuIconClose');

    function closeMobileMenu() {
      mobileMenu.classList.add('hidden');
      iconOpen.classList.remove('hidden');
      iconClose.classList.add('hidden');
    }

    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', function (e) {
        e.stopPropagation();
        const isHidden = mobileMenu.classList.toggle('hidden');
        if (isHidden) {
          iconOpen.classList.remove('hidden');
          iconClose.classList.add('hidden');
        } else {
          iconOpen.classList.add('hidden');
          iconClose.classList.remove('hidden');
        }
      });

      document.addEventListener('click', function (event) {
        if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
          closeMobileMenu();
        }
      });
    }

    // ========== SMOOTH SCROLL KE SECTION ==========
    document.querySelectorAll('a[data-scroll]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        const targetId = this.getAttribute('data-scroll');
        const targetEl = document.getElementById(targetId);

        if (targetEl) {
          e.preventDefault();

          // Hitung offset navbar (navbar fixed)
          const navbarHeight = navbar.offsetHeight;
          const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 10;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
          });

          // Tutup mobile menu setelah klik
          if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenu();
          }
        }
      });
    });

    // ========== ACTIVE MENU SAAT SCROLL ==========
    const sections = document.querySelectorAll('section[id], div[id="beranda"]');
    const navLinks = document.querySelectorAll('.nav-link');

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

      // Jika di paling atas, aktifkan Beranda
      if (window.scrollY < 100) {
        currentSection = 'beranda';
      }

      navLinks.forEach(function (link) {
        link.classList.remove('active');
        if (link.getAttribute('data-scroll') === currentSection) {
          link.classList.add('active');
        }
      });
    }

    if (sections.length > 0) {
      updateActiveMenu();
      window.addEventListener('scroll', updateActiveMenu, { passive: true });
    }
  });
</script>