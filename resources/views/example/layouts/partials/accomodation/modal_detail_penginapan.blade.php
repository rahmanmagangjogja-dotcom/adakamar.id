<!-- Modal Detail Penginapan -->
<div id="detailPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeDetailPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">

            {{-- HEADER --}}
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF] flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span id="detailPenginapanTitle">Detail Penginapan</span>
                    </h3>
                    <button type="button" onclick="closeDetailPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">

                <!-- Tab Navigation -->
                <div class="border-b border-[#B3E0FF] dark:border-gray-700 mb-6">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="detailPenginapanTab"
                        role="tablist">
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg border-[#0194F3] text-[#0194F3] dark:border-[#33ADFF] dark:text-[#33ADFF]"
                                data-tab="detail-utama" type="button" onclick="switchDetailTab('detail-utama')">
                                Informasi
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-kontak" type="button" onclick="switchDetailTab('detail-kontak')">
                                Kontak & Sosmed
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-lokasi" type="button" onclick="switchDetailTab('detail-lokasi')">
                                Lokasi
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-media" type="button" onclick="switchDetailTab('detail-media')">
                                Media
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-fasilitas" type="button" onclick="switchDetailTab('detail-fasilitas')">
                                Fasilitas
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                data-tab="detail-seo" type="button" onclick="switchDetailTab('detail-seo')">
                                SEO
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="space-y-6">

                    {{-- ============ TAB 1: INFORMASI ============ --}}
                    <div id="detail-utama" class="detail-tab-content">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {{-- Thumbnail --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Thumbnail
                                </label>
                                <img id="detailThumbnail" src="#" alt="Thumbnail"
                                    class="w-full h-56 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600 bg-[#E6F4FF] dark:bg-gray-700">
                            </div>

                            {{-- Informasi --}}
                            <div class="space-y-3">
                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama
                                        Penginapan</label>
                                    <p class="text-gray-900 dark:text-white font-medium text-lg" id="detailTitle">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</label>
                                    <p class="text-gray-900 dark:text-white font-medium" id="detailCategory">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</label>
                                    <p id="detailStatus"></p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alamat</label>
                                    <p class="text-gray-900 dark:text-white text-sm" id="detailAddress">-</p>
                                </div>

                                <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                    <label
                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga
                                        / Malam</label>
                                    <p class="text-[#0194F3] dark:text-[#33ADFF] font-bold text-lg" id="detailPrice">-
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Kamar --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Kapasitas</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white" id="detailCapacity">-</p>
                            </div>
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Kamar</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white" id="detailBedroom">-</p>
                            </div>
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">K. Mandi</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white" id="detailBathroom">-</p>
                            </div>
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg text-center">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Ukuran</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white" id="detailSize">-</p>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6 bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                            <label
                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Deskripsi</label>
                            <p class="text-gray-900 dark:text-white text-sm whitespace-pre-line" id="detailDescription">
                                -</p>
                        </div>
                    </div>

                    {{-- ============ TAB 2: KONTAK & SOSMED ============ --}}
                    <div id="detail-kontak" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Kontak & Sosial Media
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- Kontak --}}
                            <div class="sm:col-span-2">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Kontak</h5>
                                <div class="space-y-2">

                                    {{-- Telepon --}}
                                    <div id="detailPhoneContainer"
                                        class="flex items-center gap-2 p-3 bg-[#E6F4FF] dark:bg-gray-700/50 rounded-lg">
                                        <svg class="w-5 h-5 text-[#0194F3] flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">No. Telepon</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate"
                                                id="detailPhone">-</p>
                                        </div>
                                    </div>

                                    {{-- WhatsApp --}}
                                    <div id="detailWhatsappContainer"
                                        class="flex items-center gap-2 p-3 bg-[#E6F4FF] dark:bg-gray-700/50 rounded-lg">
                                        <svg class="w-5 h-5 text-[#25D366] flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">No. WhatsApp</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate"
                                                id="detailWhatsapp">-</p>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div id="detailEmailContainer"
                                        class="flex items-center gap-2 p-3 bg-[#E6F4FF] dark:bg-gray-700/50 rounded-lg">
                                        <svg class="w-5 h-5 text-[#0194F3] flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Email</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate"
                                                id="detailEmail">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Sosial Media --}}
                            <div class="sm:col-span-2">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Sosial Media
                                </h5>
                                <div id="detailSosmedContainer" class="flex flex-wrap gap-3">
                                    {{-- Facebook --}}
                                    <a id="detailFacebookBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-[#1877F2] text-white rounded-lg hover:bg-[#0A66C2] transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M22.675 0h-21.35C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.691v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.658-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z" />
                                        </svg>
                                        <span class="text-sm font-medium">Facebook</span>
                                    </a>

                                    {{-- Instagram --}}
                                    <a id="detailInstagramBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-gradient-to-br from-[#E1306C] to-[#C13584] text-white rounded-lg hover:opacity-90 transition-opacity">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                        </svg>
                                        <span class="text-sm font-medium">Instagram</span>
                                    </a>

                                    {{-- YouTube --}}
                                    <a id="detailYoutubeBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-[#FF0000] text-white rounded-lg hover:bg-[#CC0000] transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                        <span class="text-sm font-medium">YouTube</span>
                                    </a>

                                    {{-- X (Twitter) --}}
                                    <a id="detailXBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                        </svg>
                                        <span class="text-sm font-medium">X</span>
                                    </a>

                                    {{-- TikTok --}}
                                    <a id="detailTiktokBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                        </svg>
                                        <span class="text-sm font-medium">TikTok</span>
                                    </a>
                                </div>
                                <p id="detailNoSosmed" class="hidden text-sm text-gray-500 dark:text-gray-400 italic">
                                    Tidak ada sosial media yang tersedia.
                                </p>
                            </div>


                        </div>
                    </div>

                    {{-- ============ TAB 3: LOKASI ============ --}}
                    <div id="detail-lokasi" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Lokasi</h4>

                        <div class="space-y-3 mb-4">
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Alamat Lengkap</p>
                                <p class="text-sm text-gray-900 dark:text-white" id="detailAddressFull">-</p>
                            </div>

                            <div id="detailGoogleMapsLinkContainer" class="hidden">
                                <a id="detailGoogleMapsLink" href="#" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 text-sm text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#0194F3] font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka di Google Maps
                                </a>
                            </div>
                        </div>

                        <div id="detailMapContainer"
                            class="hidden rounded-xl overflow-hidden border border-[#B3E0FF] dark:border-gray-700">
                            <div id="detailMapEmbed"></div>
                        </div>

                        <p id="detailNoMap"
                            class="hidden text-sm text-gray-500 dark:text-gray-400 italic text-center py-8">
                            Tidak ada peta lokasi yang tersedia.
                        </p>
                    </div>

                    {{-- ============ TAB 4: MEDIA ============ --}}
                    <div id="detail-media" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Galeri Foto</h4>
                        <div id="detailGalleryContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        </div>
                        <p id="detailNoGallery"
                            class="hidden text-sm text-gray-500 dark:text-gray-400 italic text-center py-8">
                            Tidak ada foto galeri.
                        </p>
                    </div>

                    {{-- ============ TAB 5: FASILITAS & ATURAN ============ --}}
                    <div id="detail-fasilitas" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Fasilitas</h4>
                        <div id="detailFacilitiesContainer" class="flex flex-wrap gap-2 mb-6">
                        </div>
                        <p id="detailNoFacilities" class="hidden text-sm text-gray-500 dark:text-gray-400 italic mb-6">
                            Tidak ada fasilitas.
                        </p>

                        <h4
                            class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                            Aturan Penginapan
                        </h4>
                        <div id="detailRulesContainer" class="flex flex-wrap gap-2">
                        </div>
                        <p id="detailNoRules" class="hidden text-sm text-gray-500 dark:text-gray-400 italic">
                            Tidak ada aturan.
                        </p>
                    </div>

                    {{-- ============ TAB 6: SEO ============ --}}
                    <div id="detail-seo" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">SEO (Search Engine
                            Optimization)</h4>

                        <div class="space-y-3">
                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Meta Title</p>
                                <p class="text-sm text-gray-900 dark:text-white" id="detailMetaTitle">-</p>
                            </div>

                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Meta Description</p>
                                <p class="text-sm text-gray-900 dark:text-white" id="detailMetaDescription">-</p>
                            </div>

                            <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-4 rounded-lg">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase mb-1">Slug</p>
                                <p class="text-sm font-mono text-gray-900 dark:text-white break-all" id="detailSlug">-
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div
                class="px-6 py-4 bg-[#F7F9FC] dark:bg-gray-900/50 border-t border-[#B3E0FF] dark:border-gray-700 flex justify-end">
                <button type="button" onclick="closeDetailPenginapanModal()"
                    class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 hover:text-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== TAB FUNCTION ==========
    function switchDetailTab(tabId) {
        document.querySelectorAll('.detail-tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId)?.classList.remove('hidden');

        // Reset semua tab ke state non-aktif
        document.querySelectorAll('#detailPenginapanTab button').forEach(btn => {
            btn.classList.remove(
                'border-[#0194F3]', 'text-[#0194F3]',
                'dark:border-[#33ADFF]', 'dark:text-[#33ADFF]'
            );
            btn.classList.add(
                'border-transparent',
                'text-gray-600', 'hover:text-gray-900', 'hover:border-gray-300',
                'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:border-gray-500'
            );
        });

        // Set tab aktif
        const activeBtn = document.querySelector(`#detailPenginapanTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove(
                'border-transparent',
                'text-gray-600', 'hover:text-gray-900', 'hover:border-gray-300',
                'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:border-gray-500'
            );
            activeBtn.classList.add(
                'border-[#0194F3]', 'text-[#0194F3]',
                'dark:border-[#33ADFF]', 'dark:text-[#33ADFF]'
            );
        }
    }

    // ========== OPEN/CLOSE MODAL ==========
    function openDetailPenginapanModal(id) {
        const url = '{{ route('accommodations.show', ':id') }}'.replace(':id', id);

        // Buka modal + loading
        document.getElementById('detailPenginapanModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        switchDetailTab('detail-utama');

        document.getElementById('detailPenginapanTitle').textContent = 'Memuat data...';

        const thumbnailImg = document.getElementById('detailThumbnail');
        thumbnailImg.src = '{{ asset('landingpage/home.png') }}';

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (!data.success) throw new Error('Data penginapan tidak ditemukan.');

                const acc = data.data;
                console.log('Detail accommodation:', acc);

                // ========== HEADER ==========
                document.getElementById('detailPenginapanTitle').textContent = acc.title || 'Detail Penginapan';

                // ========== TAB 1: INFORMASI ==========
                if (acc.thumbnail) {
                    thumbnailImg.src = '{{ asset('') }}' + acc.thumbnail.replace(/^public\//, '');
                } else {
                    thumbnailImg.src = '{{ asset('landingpage/home.png') }}';
                }

                document.getElementById('detailTitle').textContent = acc.title || '-';
                document.getElementById('detailCategory').textContent = acc.category?.name || '-';
                document.getElementById('detailAddress').textContent = acc.address || '-';
                document.getElementById('detailPrice').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(acc.price || 0) + ' / malam';
                document.getElementById('detailCapacity').textContent = (acc.capacity || 0) + ' Orang';
                document.getElementById('detailBedroom').textContent = acc.bedroom || 0;
                document.getElementById('detailBathroom').textContent = acc.bathroom || 0;
                document.getElementById('detailSize').textContent = acc.size || '-';
                document.getElementById('detailDescription').textContent = acc.description || '-';
                document.getElementById('detailAddressFull').textContent = acc.address || '-';

                // Status Badge
                const statusColors = {
                    'Available': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'Full': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    'Maintenance': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                };
                const statusClass = statusColors[acc.status] || 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                document.getElementById('detailStatus').innerHTML = `<span class="${statusClass}">${acc.status || '-'}</span>`;

                // ========== TAB 2: KONTAK & SOSMED ==========
                document.getElementById('detailPhone').textContent = acc.phone || '-';
                document.getElementById('detailWhatsapp').textContent = acc.whatsapp || '-';
                document.getElementById('detailEmail').textContent = acc.email || '-';

                // Sembunyikan container jika kosong
                document.getElementById('detailPhoneContainer').style.display = acc.phone ? 'flex' : 'none';
                document.getElementById('detailWhatsappContainer').style.display = acc.whatsapp ? 'flex' : 'none';
                document.getElementById('detailEmailContainer').style.display = acc.email ? 'flex' : 'none';

                // Sosial media buttons
                const sosmedMap = [
                    { key: 'facebook', id: 'detailFacebookBtn' },
                    { key: 'instagram', id: 'detailInstagramBtn' },
                    { key: 'youtube', id: 'detailYoutubeBtn' },
                    { key: 'x', id: 'detailXBtn' },
                    { key: 'tiktok', id: 'detailTiktokBtn' }
                ];

                let hasSosmed = false;

                sosmedMap.forEach(({ key, id }) => {
                    const el = document.getElementById(id);
                    const value = acc[key];
                    if (value && value.trim() !== '') {
                        el.href = value;
                        el.classList.remove('hidden');
                        el.classList.add('inline-flex');
                        hasSosmed = true;
                    } else {
                        el.classList.add('hidden');
                        el.classList.remove('inline-flex');
                    }
                });

                document.getElementById('detailNoSosmed').classList.toggle('hidden', hasSosmed);


                // ========== TAB 3: LOKASI ==========
                const mapContainer = document.getElementById('detailMapContainer');
                const mapEmbed = document.getElementById('detailMapEmbed');
                const noMap = document.getElementById('detailNoMap');
                const mapsLinkContainer = document.getElementById('detailGoogleMapsLinkContainer');
                const mapsLink = document.getElementById('detailGoogleMapsLink');

                if (acc.maps_embed && acc.maps_embed.trim() !== '') {
                    let embed = acc.maps_embed.trim();

                    if (embed.startsWith('<iframe')) {
                        // Bersihkan dan tambahkan class responsif
                        embed = embed.replace(/\s*width="[^"]*"/i, '');
                        embed = embed.replace(/\s*height="[^"]*"/i, '');
                        embed = embed.replace(/\s*style="[^"]*"/i, '');
                        embed = embed.replace(/<iframe/i, '<iframe class="w-full h-72 sm:h-96 border-0 block"');
                    } else if (embed.startsWith('http') || embed.startsWith('//')) {
                        embed = `<iframe src="${embed}" class="w-full h-72 sm:h-96 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>`;
                    } else {
                        embed = `<iframe src="${embed}" class="w-full h-72 sm:h-96 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>`;
                    }

                    mapEmbed.innerHTML = embed;
                    mapContainer.classList.remove('hidden');
                    noMap.classList.add('hidden');
                } else {
                    mapContainer.classList.add('hidden');
                    noMap.classList.remove('hidden');
                }

                if (acc.google_maps_url && acc.google_maps_url.trim() !== '') {
                    mapsLink.href = acc.google_maps_url;
                    mapsLinkContainer.classList.remove('hidden');
                } else {
                    mapsLinkContainer.classList.add('hidden');
                }

                // ========== TAB 4: MEDIA / GALLERY ==========
                const galleryContainer = document.getElementById('detailGalleryContainer');
                const noGallery = document.getElementById('detailNoGallery');
                galleryContainer.innerHTML = '';

                if (acc.images && acc.images.length > 0) {
                    acc.images.forEach(img => {
                        const imageUrl = img.image ? '{{ asset('') }}' + img.image.replace(/^public\//, '') : '';
                        if (imageUrl) {
                            const div = document.createElement('div');
                            div.className = 'relative group overflow-hidden rounded-lg';
                            div.innerHTML = `
                            <img src="${imageUrl}" alt="Galeri"
                                class="w-full h-32 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600 hover:scale-105 transition-transform duration-300">
                        `;
                            galleryContainer.appendChild(div);
                        }
                    });
                    noGallery.classList.add('hidden');
                } else {
                    noGallery.classList.remove('hidden');
                }

                // ========== TAB 5: FASILITAS & ATURAN ==========
                const facilitiesContainer = document.getElementById('detailFacilitiesContainer');
                const noFacilities = document.getElementById('detailNoFacilities');
                facilitiesContainer.innerHTML = '';

                if (acc.facilities && acc.facilities.length > 0) {
                    acc.facilities.forEach(f => {
                        const span = document.createElement('span');
                        span.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#E6F4FF] dark:bg-[#0194F3]/20 text-[#0194F3] dark:text-[#33ADFF] rounded-full text-xs font-medium border border-[#B3E0FF] dark:border-[#33ADFF]/30';
                        span.innerHTML = `
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                        ${f.name}
                    `;
                        facilitiesContainer.appendChild(span);
                    });
                    noFacilities.classList.add('hidden');
                } else {
                    noFacilities.classList.remove('hidden');
                }

                const rulesContainer = document.getElementById('detailRulesContainer');
                const noRules = document.getElementById('detailNoRules');
                rulesContainer.innerHTML = '';

                if (acc.rules && acc.rules.length > 0) {
                    acc.rules.forEach(r => {
                        const span = document.createElement('span');
                        span.className = 'inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#FEF3C7] dark:bg-yellow-900/30 text-[#92400E] dark:text-yellow-300 rounded-full text-xs font-medium border border-[#FDE68A] dark:border-yellow-700/50';
                        span.innerHTML = `
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        ${r.name}
                    `;
                        rulesContainer.appendChild(span);
                    });
                    noRules.classList.add('hidden');
                } else {
                    noRules.classList.remove('hidden');
                }

                // ========== TAB 6: SEO ==========
                document.getElementById('detailMetaTitle').textContent = acc.meta_title || '-';
                document.getElementById('detailMetaDescription').textContent = acc.meta_description || '-';
                document.getElementById('detailSlug').textContent = acc.slug || '-';
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('detailPenginapanTitle').textContent = 'Error!';
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengambil data: ' + error.message,
                    timer: 3000,
                    showConfirmButton: false
                });
            });
    }

    function closeDetailPenginapanModal() {
        document.getElementById('detailPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('detailPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) closeDetailPenginapanModal();
        }
    });

    document.querySelector('#detailPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeDetailPenginapanModal();
    });
</script>

<style>
    #detailPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #detailPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #detailPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
    }
</style>