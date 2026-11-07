<nav
  class="fixed z-50 w-full bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-lg shadow-[#0194F3]/10 dark:shadow-black/40">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
          class="p-2 text-[#0194F3] rounded-lg cursor-pointer lg:hidden hover:text-white hover:bg-gradient-to-r hover:from-[#0194F3] hover:to-[#0064D2] focus:bg-[#E6F4FF] dark:focus:bg-gray-700 focus:ring-2 focus:ring-[#B3E0FF] dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white transition-all duration-200">
          <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <a href="{{ url('/') }}" class="flex items-center group">

          {{-- Logo dari Pengaturan Website --}}
          @if(!empty($setting?->logo))
            <img src="{{ asset($setting->logo) }}"
              class="h-8 mr-2 sm:mr-3 object-contain transition-transform duration-300 group-hover:scale-110"
              alt="{{ $setting->site_name ?? 'Logo' }}" />
          @else
            {{-- Logo fallback --}}
            <img src="{{ asset('landingpage/home.png') }}"
              class="h-8 mr-2 sm:mr-3 object-contain transition-transform duration-300 group-hover:scale-110"
              alt="{{ $setting->site_name ?? 'Logo' }}" />
          @endif

          {{-- Nama aplikasi dari Pengaturan Website --}}
          <span id="navbarBrand" class="text-lg sm:text-xl lg:text-2xl font-bold whitespace-nowrap 
                     text-[#0194F3] dark:text-[#33ADFF] 
                     transition-colors duration-300">
            {{ $setting->site_name ?? 'Adakamar.id' }}
          </span>

        </a>
      </div>
      <div class="flex items-center gap-1 sm:gap-2">

        <!-- Search mobile -->
        <button id="toggleSidebarMobileSearch" type="button"
          class="p-2 text-[#0194F3] rounded-lg lg:hidden hover:text-white hover:bg-gradient-to-r hover:from-[#0194F3] hover:to-[#0064D2] dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white transition-all duration-200">
          <span class="sr-only">Search</span>
        </button>


        <!-- Theme Toggle -->
        <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
          class="text-[#0194F3] dark:text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-[#0194F3] hover:to-[#0064D2] dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-[#B3E0FF] dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 transition-all duration-200">
          <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>


        <!-- Profile User - DINAMIS DARI DATABASE -->
        @auth
          <div class="flex items-center ml-1 sm:ml-2">
            <div>
              <button type="button"
                class="flex text-sm rounded-full ring-2 ring-[#B3E0FF] hover:ring-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] dark:focus:ring-gray-600 transition-all duration-200"
                id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">

                <span class="sr-only">Open user menu</span>

                @if(Auth::user()->photo)
                  <img class="w-8 h-8 rounded-full object-cover" src="{{ asset(Auth::user()->photo) }}"
                    alt="{{ Auth::user()->name }}">
                @else
                  <img class="w-8 h-8 rounded-full"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0194F3&color=ffffff&size=32"
                    alt="{{ Auth::user()->name }}">
                @endif
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="z-50 hidden my-4 text-base list-none bg-white dark:bg-gray-700 rounded-xl shadow-2xl shadow-[#0194F3]/20 dark:shadow-black/40 overflow-hidden"
              id="dropdown-2">

              <!-- Info User -->
              <div class="px-4 py-3 bg-gradient-to-r from-[#E6F4FF] to-white dark:from-[#0194F3]/20 dark:to-gray-700">
                <p class="text-sm font-bold text-gray-900 dark:text-white">
                  {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500 truncate dark:text-gray-300 mt-0.5">
                  {{ Auth::user()->email }}
                </p>

                <span
                  class="inline-block mt-1.5 text-[10px] font-bold uppercase tracking-wider text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] px-2 py-0.5 rounded-full">
                  {{ Auth::user()->role ?? 'Administrator' }}
                </span>
              </div>

              <ul class="py-1">

                <li>
                  <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#E6F4FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white transition-colors">
                    <svg class="w-4 h-4 inline mr-2 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                    Edit Profil
                  </a>
                </li>

                <li>
                  <button type="button" id="logout-button"
                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                      </path>
                    </svg>
                    Logout
                  </button>
                </li>

              </ul>
            </div>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // ========== LOGOUT CONFIRMATION ==========
    const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {
      logoutButton.addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
          title: 'Konfirmasi Logout',
          html: `
            <div class="text-left">
              <p class="mb-2">Apakah Anda yakin ingin logout dari akun?</p>
              <div class="bg-yellow-50 dark:bg-yellow-900/30 p-3 rounded-lg border border-yellow-200 dark:border-yellow-700">
                <p class="text-sm text-yellow-700 dark:text-yellow-300">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>
                  Anda akan keluar dari sistem dan perlu login kembali untuk mengakses halaman ini.
                </p>
              </div>
            </div>
          `,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0194F3',
          cancelButtonColor: '#687176',
          confirmButtonText: 'Ya, Logout!',
          cancelButtonText: 'Batal',
          reverseButtons: true,
          focusCancel: true,
          timerProgressBar: true
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Logout...',
              text: 'Anda sedang keluar dari sistem',
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });

            // Submit form logout
            setTimeout(() => {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout!',
                text: 'Anda telah keluar dari sistem',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
              }).then(() => {
                // Buat form untuk logout
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('logout') }}';
                form.innerHTML = `
                  @csrf
                `;
                document.body.appendChild(form);
                form.submit();
              });
            }, 1500);
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              icon: 'info',
              title: 'Dibatalkan',
              text: 'Anda tetap login',
              timer: 2000,
              showConfirmButton: false,
              timerProgressBar: true
            });
          }
        });
      });
    }
  });
</script>