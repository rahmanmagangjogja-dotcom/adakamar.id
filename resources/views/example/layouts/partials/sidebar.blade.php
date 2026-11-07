<aside id="sidebar"
  class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
  aria-label="Sidebar">
  <div
    class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gradient-to-b from-white via-[#F7F9FC] to-[#E6F4FF] shadow-xl shadow-[#0194F3]/10 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:shadow-black/40">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 divide-y divide-[#B3E0FF]/50 dark:divide-gray-700">
        <ul class="pb-2 space-y-2">

          <!-- Dashboard -->
          <li>
            <a href="{{ route('dashboard') }}"
              class="group flex items-center p-2 text-base rounded-lg transition-all duration-200
                {{ request()->routeIs('dashboard')
  ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-900 hover:bg-[#E6F4FF] hover:translate-x-0.5 hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700' }}">
              <svg class="w-6 h-6 transition duration-75 flex-shrink-0
                  {{ request()->routeIs('dashboard')
  ? 'text-white'
  : 'text-[#0194F3] group-hover:text-[#0064D2] dark:text-gray-400 dark:group-hover:text-white' }}"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
              <span class="ml-3 font-medium" sidebar-toggle-item>Dashboard</span>
            </a>
          </li>

          <!-- DATA PENGINAPAN -->
          <li>
            <a href="{{ route('accommodations.index') }}"
              class="group flex items-center w-full p-2 text-base rounded-lg transition-all duration-200
                {{ request()->routeIs('accommodations.*')
  ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-900 hover:bg-[#E6F4FF] hover:translate-x-0.5 hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700' }}">
              <svg class="flex-shrink-0 w-6 h-6 transition duration-75
                  {{ request()->routeIs('accommodations.*')
  ? 'text-white'
  : 'text-[#0194F3] group-hover:text-[#0064D2] dark:text-gray-400 dark:group-hover:text-white' }}"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap font-medium">
                Data Penginapan
              </span>
            </a>
          </li>

          <!-- DATA MASTER -->
          <li>
            <button type="button" class="group flex items-center w-full p-2 text-base rounded-lg transition-all duration-200
                {{ request()->routeIs('accommodation-categories.*') || request()->routeIs('rules.*') || request()->routeIs('facilities.*')
  ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-900 hover:bg-[#E6F4FF] hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700' }}"
              aria-controls="dropdown-master" data-collapse-toggle="dropdown-master">
              <svg class="flex-shrink-0 w-6 h-6 transition duration-75
                  {{ request()->routeIs('accommodation-categories.*') || request()->routeIs('rules.*') || request()->routeIs('facilities.*')
  ? 'text-white'
  : 'text-[#0194F3] group-hover:text-[#0064D2] dark:text-gray-400 dark:group-hover:text-white' }}"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                  clip-rule="evenodd" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap font-medium">Data Master</span>
              <svg class="w-5 h-5 transition-transform
                {{ request()->routeIs('accommodation-categories.*') || request()->routeIs('rules.*') || request()->routeIs('facilities.*')
  ? 'text-white rotate-180'
  : 'text-[#0194F3] group-hover:text-[#0064D2]' }}" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-master"
              class="space-y-1.5 py-2 pl-2 ml-4 bg-[#F0F9FF] dark:bg-gray-900/40 rounded-r-lg shadow-inner {{ request()->routeIs('accommodation-categories.*') || request()->routeIs('rules.*') || request()->routeIs('facilities.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('accommodation-categories.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('accommodation-categories.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg
                    class="w-4 h-4 mr-2 {{ request()->routeIs('accommodation-categories.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd"
                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="font-medium">Kategori Penginapan</span>
                </a>
              </li>
              <li>
                <a href="{{ route('rules.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('rules.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('rules.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="font-medium">Aturan</span>
                </a>
              </li>
              <li>
                <a href="{{ route('facilities.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('facilities.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('facilities.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                    <path
                      d="M8 6a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1zM8 10a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                  </svg>
                  <span class="font-medium">Fasilitas</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- ARTIKEL -->
          <li>
            <button type="button" class="group flex items-center w-full p-2 text-base rounded-lg transition-all duration-200
                {{ request()->routeIs('articles.*') || request()->routeIs('article-categories.*')
  ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-900 hover:bg-[#E6F4FF] hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700' }}"
              aria-controls="dropdown-artikel" data-collapse-toggle="dropdown-artikel">
              <svg class="flex-shrink-0 w-6 h-6 transition duration-75
                  {{ request()->routeIs('articles.*') || request()->routeIs('article-categories.*')
  ? 'text-white'
  : 'text-[#0194F3] group-hover:text-[#0064D2] dark:text-gray-400 dark:group-hover:text-white' }}"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                  clip-rule="evenodd" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap font-medium">Artikel</span>
              <svg class="w-5 h-5 transition-transform
                {{ request()->routeIs('articles.*') || request()->routeIs('article-categories.*')
  ? 'text-white rotate-180'
  : 'text-[#0194F3] group-hover:text-[#0064D2]' }}" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-artikel"
              class="space-y-1.5 py-2 pl-2 ml-4 bg-[#F0F9FF] dark:bg-gray-900/40 rounded-r-lg shadow-inner {{ request()->routeIs('articles.*') || request()->routeIs('article-categories.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('articles.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('articles.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('articles.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm2 0v10h12V5H4z" />
                    <path d="M6 7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1z" />
                    <path d="M6 11a1 1 0 011-1h4a1 1 0 110 2H7a1 1 0 01-1-1z" />
                  </svg>
                  <span class="font-medium">Daftar Artikel</span>
                </a>
              </li>
              <li>
                <a href="{{ route('article-categories.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('article-categories.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg
                    class="w-4 h-4 mr-2 {{ request()->routeIs('article-categories.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd"
                      d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="font-medium">Kategori Artikel</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- KONTEN -->
          <li>
            <button type="button" class="group flex items-center w-full p-2 text-base rounded-lg transition-all duration-200
                {{ request()->routeIs('galleries.*') || request()->routeIs('banners.*') || request()->routeIs('pengaturan.*')
  ? 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-900 hover:bg-[#E6F4FF] hover:shadow-sm dark:text-gray-200 dark:hover:bg-gray-700' }}"
              aria-controls="dropdown-konten" data-collapse-toggle="dropdown-konten">
              <svg class="flex-shrink-0 w-6 h-6 transition duration-75
                  {{ request()->routeIs('galleries.*') || request()->routeIs('banners.*') || request()->routeIs('pengaturan.*')
  ? 'text-white'
  : 'text-[#0194F3] group-hover:text-[#0064D2] dark:text-gray-400 dark:group-hover:text-white' }}"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                  clip-rule="evenodd" />
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap font-medium">Konten</span>
              <svg class="w-5 h-5 transition-transform
                {{ request()->routeIs('galleries.*') || request()->routeIs('banners.*') || request()->routeIs('pengaturan.*')
  ? 'text-white rotate-180'
  : 'text-[#0194F3] group-hover:text-[#0064D2]' }}" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </button>
            <ul id="dropdown-konten"
              class="space-y-1.5 py-2 pl-2 ml-4 bg-[#F0F9FF] dark:bg-gray-900/40 rounded-r-lg shadow-inner {{ request()->routeIs('galleries.*') || request()->routeIs('banners.*') || request()->routeIs('pengaturan.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('galleries.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('galleries.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('galleries.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M4 3a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1h1zM7 3a1 1 0 011 1v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4a1 1 0 011-1h2zM10 3a1 1 0 011 1v12a1 1 0 01-1 1H8a1 1 0 01-1-1V4a1 1 0 011-1h2z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="font-medium">Galeri</span>
                </a>
              </li>
              <li>
                <a href="{{ route('banners.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('banners.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('banners.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm2 0v10h10V5H5z" />
                    <path d="M7 7a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" />
                    <path d="M7 11a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" />
                  </svg>
                  <span class="font-medium">Banner</span>
                </a>
              </li>
              <li>
                <a href="{{ route('pengaturan.index') }}"
                  class="flex items-center p-2 text-sm rounded-lg transition-all duration-200
                    {{ request()->routeIs('pengaturan.*')
  ? 'bg-[#0194F3] text-white shadow-md shadow-[#0194F3]/30'
  : 'text-gray-700 hover:bg-white hover:text-[#0194F3] hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-700' }}">
                  <svg class="w-4 h-4 mr-2 {{ request()->routeIs('pengaturan.*') ? 'text-white' : 'text-[#0194F3]' }}"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="font-medium">Pengaturan Website</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>