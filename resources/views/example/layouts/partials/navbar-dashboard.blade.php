<nav class="fixed z-50 w-full bg-white border-b border-[#0194F3] dark:bg-gray-800 dark:border-[#33ADFF]">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar"
          class="p-2 text-[#0194F3] rounded cursor-pointer lg:hidden hover:text-[#0064D2] hover:bg-[#E6F4FF] focus:bg-[#E6F4FF] dark:focus:bg-gray-700 focus:ring-2 focus:ring-[#B3E0FF] dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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
        <a href="#" class="flex ml-2 md:mr-24 items-center">
          <img src="{{ asset('landingpage/home.png') }}" class="h-8 mr-3" alt="adakamar.id Logo" />
          <span
            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[#0194F3] dark:text-[#33ADFF]">adakamar.id</span>
        </a>
      </div>
      <div class="flex items-center">

        <!-- Search mobile -->
        <button id="toggleSidebarMobileSearch" type="button"
          class="p-2 text-[#0194F3] rounded-lg lg:hidden hover:text-[#0064D2] hover:bg-[#E6F4FF] dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <span class="sr-only">Search</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
              clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Notifications -->
        <button type="button" data-dropdown-toggle="notification-dropdown"
          class="p-2 text-[#0194F3] rounded-lg hover:text-[#0064D2] hover:bg-[#E6F4FF] dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
          <span class="sr-only">View notifications</span>
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
          </svg>
        </button>

        <!-- Dropdown menu notifications -->
        <div
          class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-[#B3E0FF] rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700"
          id="notification-dropdown">
          <div
            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-[#E6F4FF] dark:bg-gray-700 dark:text-gray-400">
            Notifications
          </div>
          <div>
            <a href="#" class="flex px-4 py-3 border-b hover:bg-[#E6F4FF] dark:hover:bg-gray-600 dark:border-gray-600">
              <div class="flex-shrink-0">
                <img class="rounded-full w-11 h-11" src="https://i.pravatar.cc/150?img=1" alt="Jese image">
                <div
                  class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 border border-white rounded-full bg-[#0194F3] dark:border-gray-700">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                    </path>
                    <path
                      d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                    </path>
                  </svg>
                </div>
              </div>
              <div class="w-full pl-3">
                <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">New message from <span
                    class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span>: "Hey, what's up? All set
                  for the presentation?"</div>
                <div class="text-xs font-medium text-[#0194F3] dark:text-[#33ADFF]">a few moments ago</div>
              </div>
            </a>
            <a href="#" class="flex px-4 py-3 border-b hover:bg-[#E6F4FF] dark:hover:bg-gray-600 dark:border-gray-600">
              <div class="flex-shrink-0">
                <img class="rounded-full w-11 h-11" src="https://i.pravatar.cc/150?img=2" alt="Jese image">
                <div
                  class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-gray-900 border border-white rounded-full dark:border-gray-700">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                    </path>
                  </svg>
                </div>
              </div>
              <div class="w-full pl-3">
                <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span
                    class="font-semibold text-gray-900 dark:text-white">Jese leos</span> and <span
                    class="font-medium text-gray-900 dark:text-white">5 others</span> started following you.</div>
                <div class="text-xs font-medium text-[#0194F3] dark:text-[#33ADFF]">10 minutes ago</div>
              </div>
            </a>
          </div>
        </div>

        <!-- Theme Toggle -->
        <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
          class="text-[#0194F3] dark:text-gray-400 hover:bg-[#E6F4FF] dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-[#B3E0FF] dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
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
        <div id="tooltip-toggle" role="tooltip"
          class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
          Toggle dark mode
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <!-- Profile User - DINAMIS DARI DATABASE -->
        @auth
          <div class="flex items-center ml-3">
            <div>
              <button type="button"
                class="flex text-sm bg-[#0194F3] rounded-full focus:ring-4 focus:ring-[#B3E0FF] dark:focus:ring-gray-600"
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
              class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-[#B3E0FF] rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
              id="dropdown-2">

              <!-- Info User -->
              <div class="px-4 py-3">
                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                  {{ Auth::user()->name }}
                </p>

                <p class="text-sm text-gray-500 truncate dark:text-gray-300">
                  {{ Auth::user()->email }}
                </p>

                <p class="text-xs text-[#0194F3] dark:text-[#33ADFF] mt-1">
                  {{ Auth::user()->role ?? 'Administrator' }}
                </p>
              </div>

              <ul class="py-1">

                <li>
                  <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#E6F4FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-4 h-4 inline mr-2 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                    Edit Profil
                  </a>
                </li>

                <li>
                  <button type="button" id="logout-button"
                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-gray-600">
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