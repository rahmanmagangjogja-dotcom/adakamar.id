<!-- Modal Detail Penginapan -->
<div id="detailPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeDetailPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">

            {{-- ===== HEADER MODAL — GRADIENT ===== --}}
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                {{-- Pattern dots subtle --}}
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;"></div>
                {{-- Blob dekoratif --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                        <i data-lucide="clipboard-list" class="w-6 h-6"></i>
                        <span id="detailPenginapanTitle">Detail Penginapan</span>
                    </h3>
                    <button type="button" onclick="closeDetailPenginapanModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">

                <!-- Tab Navigation — GRADIENT ACTIVE + IKON -->
                <div class="mb-6 rounded-xl bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 p-2 shadow-inner">
                    <ul class="flex flex-wrap gap-1 text-sm font-medium text-center" id="detailPenginapanTab"
                        role="tablist">
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30 transition-all duration-200"
                                data-tab="detail-utama" type="button" onclick="switchDetailTab('detail-utama')">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                Informasi
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detail-kontak" type="button" onclick="switchDetailTab('detail-kontak')">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                Kontak & Sosmed
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detail-lokasi" type="button" onclick="switchDetailTab('detail-lokasi')">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                Lokasi
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detail-media" type="button" onclick="switchDetailTab('detail-media')">
                                <i data-lucide="image" class="w-4 h-4"></i>
                                Media
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detail-fasilitas" type="button" onclick="switchDetailTab('detail-fasilitas')">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                                Fasilitas
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detail-seo" type="button" onclick="switchDetailTab('detail-seo')">
                                <i data-lucide="search" class="w-4 h-4"></i>
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
                                <label class="block text-sm font-medium text-[#0F294D] dark:text-gray-300 mb-2">
                                    Thumbnail
                                </label>
                                <img id="detailThumbnail" src="#" alt="Thumbnail"
                                    class="w-full h-56 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600 bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700">
                            </div>

                            {{-- Informasi --}}
                            <div class="space-y-3">
                                <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                    <label
                                        class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">Nama
                                        Penginapan</label>
                                    <p class="text-[#0F294D] dark:text-white font-medium text-lg" id="detailTitle">-</p>
                                </div>

                                <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                    <label
                                        class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">Kategori</label>
                                    <p class="text-[#0F294D] dark:text-white font-medium" id="detailCategory">-</p>
                                </div>

                                <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                    <label
                                        class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">Status</label>
                                    <p id="detailStatus"></p>
                                </div>

                                <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                    <label
                                        class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">Alamat</label>
                                    <p class="text-[#0F294D] dark:text-white text-sm" id="detailAddress">-</p>
                                </div>

                                <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                    <label
                                        class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">Harga
                                        / Malam</label>
                                    <p class="text-[#0194F3] dark:text-[#33ADFF] font-bold text-lg" id="detailPrice">-
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Detail Kamar --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">
                            <div class="bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg text-center border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Kapasitas</p>
                                <p class="text-sm font-bold text-[#0F294D] dark:text-white" id="detailCapacity">-</p>
                            </div>
                            <div class="bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg text-center border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Kamar</p>
                                <p class="text-sm font-bold text-[#0F294D] dark:text-white" id="detailBedroom">-</p>
                            </div>
                            <div class="bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg text-center border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">K. Mandi</p>
                                <p class="text-sm font-bold text-[#0F294D] dark:text-white" id="detailBathroom">-</p>
                            </div>
                            <div class="bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg text-center border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Ukuran</p>
                                <p class="text-sm font-bold text-[#0F294D] dark:text-white" id="detailSize">-</p>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mt-6 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                            <label
                                class="block text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider mb-2">Deskripsi</label>
                            <p class="text-[#0F294D] dark:text-white text-sm whitespace-pre-line" id="detailDescription">
                                -</p>
                        </div>
                    </div>

                    {{-- ============ TAB 2: KONTAK & SOSMED ============ --}}
                    <div id="detail-kontak" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Kontak & Sosial Media
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- Kontak --}}
                            <div class="sm:col-span-2">
                                <h5 class="text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3">Kontak</h5>
                                <div class="space-y-2">

                                    {{-- Telepon --}}
                                    <div id="detailPhoneContainer"
                                        class="flex items-center gap-2 p-3 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                        <i data-lucide="phone" class="w-5 h-5 text-[#0194F3] flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-[#687176] dark:text-gray-400">No. Telepon</p>
                                            <p class="text-sm font-medium text-[#0F294D] dark:text-white truncate"
                                                id="detailPhone">-</p>
                                        </div>
                                    </div>

                                    {{-- WhatsApp --}}
                                    <div id="detailWhatsappContainer"
                                        class="flex items-center gap-2 p-3 bg-gradient-to-r from-[#E8F8EE] to-[#F0FDF4] dark:from-[#25D366]/10 dark:to-gray-700/50 rounded-lg border border-[#25D366]/30 dark:border-[#25D366]/20">
                                        <i data-lucide="message-circle" class="w-5 h-5 text-[#25D366] flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-[#128C7E] dark:text-gray-400">No. WhatsApp</p>
                                            <p class="text-sm font-medium text-[#0F294D] dark:text-white truncate"
                                                id="detailWhatsapp">-</p>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div id="detailEmailContainer"
                                        class="flex items-center gap-2 p-3 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                        <i data-lucide="mail" class="w-5 h-5 text-[#0194F3] flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-[#687176] dark:text-gray-400">Email</p>
                                            <p class="text-sm font-medium text-[#0F294D] dark:text-white truncate"
                                                id="detailEmail">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Sosial Media --}}
                            <div class="sm:col-span-2">
                                <h5 class="text-sm font-semibold text-[#0F294D] dark:text-gray-300 mb-3">Sosial Media</h5>
                                <div id="detailSosmedContainer" class="flex flex-wrap gap-3">
                                    {{-- Facebook --}}
                                    <a id="detailFacebookBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-[#1877F2] text-white rounded-lg hover:bg-[#0A66C2] transition-colors">
                                        <i data-lucide="facebook" class="w-5 h-5"></i>
                                        <span class="text-sm font-medium">Facebook</span>
                                    </a>

                                    {{-- Instagram --}}
                                    <a id="detailInstagramBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-gradient-to-br from-[#E1306C] to-[#C13584] text-white rounded-lg hover:opacity-90 transition-opacity">
                                        <i data-lucide="instagram" class="w-5 h-5"></i>
                                        <span class="text-sm font-medium">Instagram</span>
                                    </a>

                                    {{-- YouTube --}}
                                    <a id="detailYoutubeBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-[#FF0000] text-white rounded-lg hover:bg-[#CC0000] transition-colors">
                                        <i data-lucide="youtube" class="w-5 h-5"></i>
                                        <span class="text-sm font-medium">YouTube</span>
                                    </a>

                                    {{-- X (Twitter) --}}
                                    <a id="detailXBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                        <i data-lucide="twitter" class="w-5 h-5"></i>
                                        <span class="text-sm font-medium">X</span>
                                    </a>

                                    {{-- TikTok --}}
                                    <a id="detailTiktokBtn" href="#" target="_blank" rel="noopener noreferrer"
                                        class="hidden items-center gap-2 px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition-colors">
                                        <i data-lucide="music-2" class="w-5 h-5"></i>
                                        <span class="text-sm font-medium">TikTok</span>
                                    </a>
                                </div>
                                <p id="detailNoSosmed" class="hidden text-sm text-[#687176] dark:text-gray-400 italic">
                                    Tidak ada sosial media yang tersedia.
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- ============ TAB 3: LOKASI ============ --}}
                    <div id="detail-lokasi" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Lokasi
                        </h4>

                        <div class="space-y-3 mb-4">
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-3 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Alamat Lengkap</p>
                                <p class="text-sm text-[#0F294D] dark:text-white" id="detailAddressFull">-</p>
                            </div>

                            <div id="detailGoogleMapsLinkContainer" class="hidden">
                                <a id="detailGoogleMapsLink" href="#" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 text-sm text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#0194F3] font-medium">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                    Buka di Google Maps
                                </a>
                            </div>
                        </div>

                        <div id="detailMapContainer"
                            class="hidden rounded-xl overflow-hidden border border-[#B3E0FF] dark:border-gray-700">
                            <div id="detailMapEmbed"></div>
                        </div>

                        <p id="detailNoMap"
                            class="hidden text-sm text-[#687176] dark:text-gray-400 italic text-center py-8">
                            Tidak ada peta lokasi yang tersedia.
                        </p>
                    </div>

                    {{-- ============ TAB 4: MEDIA ============ --}}
                    <div id="detail-media" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Galeri Foto
                        </h4>
                        <div id="detailGalleryContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        </div>
                        <p id="detailNoGallery"
                            class="hidden text-sm text-[#687176] dark:text-gray-400 italic text-center py-8">
                            Tidak ada foto galeri.
                        </p>
                    </div>

                    {{-- ============ TAB 5: FASILITAS & ATURAN ============ --}}
                    <div id="detail-fasilitas" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Fasilitas
                        </h4>
                        <div id="detailFacilitiesContainer" class="flex flex-wrap gap-2 mb-6">
                        </div>
                        <p id="detailNoFacilities" class="hidden text-sm text-[#687176] dark:text-gray-400 italic mb-6">
                            Tidak ada fasilitas.
                        </p>

                        <h4
                            class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 pt-4 border-t border-[#B3E0FF] dark:border-gray-700 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-red-500 to-red-700 rounded-full"></span>
                            Aturan Penginapan
                        </h4>
                        <div id="detailRulesContainer" class="flex flex-wrap gap-2">
                        </div>
                        <p id="detailNoRules" class="hidden text-sm text-[#687176] dark:text-gray-400 italic">
                            Tidak ada aturan.
                        </p>
                    </div>

                    {{-- ============ TAB 6: SEO ============ --}}
                    <div id="detail-seo" class="detail-tab-content hidden">
                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            SEO (Search Engine Optimization)
                        </h4>

                        <div class="space-y-3">
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Meta Title</p>
                                <p class="text-sm text-[#0F294D] dark:text-white" id="detailMetaTitle">-</p>
                            </div>

                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Meta Description</p>
                                <p class="text-sm text-[#0F294D] dark:text-white" id="detailMetaDescription">-</p>
                            </div>

                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase mb-1">Slug</p>
                                <p class="text-sm font-mono text-[#0F294D] dark:text-white break-all" id="detailSlug">-
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== FOOTER — GRADIENT ===== --}}
            <div class="px-6 py-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 border-t border-[#B3E0FF] dark:border-gray-700 flex justify-end">
                <button type="button" onclick="closeDetailPenginapanModal()"
                    class="inline-flex items-center gap-2 text-[#0194F3] bg-white border-2 border-[#0194F3] hover:bg-[#0194F3] hover:text-white focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-[#33ADFF] dark:border-[#33ADFF] dark:hover:bg-[#33ADFF] dark:hover:text-white transition-all duration-200">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== HELPER ==========
    function renderLucideSafeDetail() {
        if (window.renderLucide) {
            window.renderLucide();
        } else if (window.lucide) {
            lucide.createIcons();
        }
    }

    // ========== TAB FUNCTION — GRADIENT ACTIVE ==========
    function switchDetailTab(tabId) {
        document.querySelectorAll('.detail-tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId)?.classList.remove('hidden');

        document.querySelectorAll('#detailPenginapanTab button').forEach(btn => {
            btn.classList.remove(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );
            btn.classList.add(
                'text-[#687176]', 'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );
        });

        const activeBtn = document.querySelector(`#detailPenginapanTab button[data-tab="${tabId}"]`);
        if (activeBtn) {
            activeBtn.classList.remove(
                'text-[#687176]', 'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );
            activeBtn.classList.add(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );
        }

        // Re-render Lucide untuk icon di tab yang baru aktif
        renderLucideSafeDetail();
    }

    // ========== OPEN/CLOSE MODAL ==========
    function openDetailPenginapanModal(id) {
        const url = '{{ route('accommodations.show', ':id') }}'.replace(':id', id);

        document.getElementById('detailPenginapanModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        switchDetailTab('detail-utama');

        document.getElementById('detailPenginapanTitle').textContent = 'Memuat data...';

        const thumbnailImg = document.getElementById('detailThumbnail');
        thumbnailImg.src = '{{ asset('landingpage/home.png') }}';

        // Render Lucide awal
        renderLucideSafeDetail();

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

                // Status Badge — palet biru
                const statusColors = {
                    'Available': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-sm',
                    'Full': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0064D2]/20 text-[#0064D2] dark:bg-[#0064D2]/30 dark:text-[#33ADFF]',
                    'Maintenance': 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]'
                };
                const statusClass = statusColors[acc.status] ||
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E6F4FF] text-[#0194F3] dark:bg-gray-700 dark:text-gray-300';
                document.getElementById('detailStatus').innerHTML =
                    `<span class="${statusClass}">${acc.status || '-'}</span>`;

                // ========== TAB 2: KONTAK & SOSMED ==========
                document.getElementById('detailPhone').textContent = acc.phone || '-';
                document.getElementById('detailWhatsapp').textContent = acc.whatsapp || '-';
                document.getElementById('detailEmail').textContent = acc.email || '-';

                document.getElementById('detailPhoneContainer').style.display = acc.phone ? 'flex' : 'none';
                document.getElementById('detailWhatsappContainer').style.display = acc.whatsapp ? 'flex' : 'none';
                document.getElementById('detailEmailContainer').style.display = acc.email ? 'flex' : 'none';

                const sosmedMap = [{
                        key: 'facebook',
                        id: 'detailFacebookBtn'
                    },
                    {
                        key: 'instagram',
                        id: 'detailInstagramBtn'
                    },
                    {
                        key: 'youtube',
                        id: 'detailYoutubeBtn'
                    },
                    {
                        key: 'x',
                        id: 'detailXBtn'
                    },
                    {
                        key: 'tiktok',
                        id: 'detailTiktokBtn'
                    }
                ];

                let hasSosmed = false;

                sosmedMap.forEach(({
                    key,
                    id
                }) => {
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
                        embed = embed.replace(/\s*width="[^"]*"/i, '');
                        embed = embed.replace(/\s*height="[^"]*"/i, '');
                        embed = embed.replace(/\s*style="[^"]*"/i, '');
                        embed = embed.replace(/<iframe/i, '<iframe class="w-full h-72 sm:h-96 border-0 block"');
                    } else if (embed.startsWith('http') || embed.startsWith('//')) {
                        embed =
                            `<iframe src="${embed}" class="w-full h-72 sm:h-96 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>`;
                    } else {
                        embed =
                            `<iframe src="${embed}" class="w-full h-72 sm:h-96 border-0 block" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>`;
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
                        const imageUrl = img.image ? '{{ asset('') }}' + img.image.replace(/^public\//,
                            '') : '';
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
                        span.className =
                            'inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-[#0194F3]/20 dark:to-[#0194F3]/10 text-[#0194F3] dark:text-[#33ADFF] rounded-full text-xs font-medium border border-[#B3E0FF] dark:border-[#33ADFF]/30';

                        // Icon Lucide dari fasilitas, fallback ke "check"
                        const iconName = f.icon && /^[a-z0-9-]+$/i.test(f.icon) ? f.icon : 'check';

                        span.innerHTML = `
                        <i data-lucide="${iconName}" class="w-3.5 h-3.5"></i>
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

                // ATURAN — pakai warna MERAH (warning style)
                if (acc.rules && acc.rules.length > 0) {
                    acc.rules.forEach(r => {
                        const span = document.createElement('span');
                        span.className =
                            'inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-full text-xs font-medium border border-red-200 dark:border-red-800/50';
                        span.innerHTML = `
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
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

                // ========== RENDER LUCIDE SETELAH DATA TERISI ==========
                renderLucideSafeDetail();
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('detailPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) closeDetailPenginapanModal();
        }
    });

    document.querySelector('#detailPenginapanModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) closeDetailPenginapanModal();
    });

    // Render Lucide saat halaman pertama load
    document.addEventListener('DOMContentLoaded', function() {
        renderLucideSafeDetail();
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

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #E6F4FF;
        border-radius: 3px;
    }

    #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #0194F3, #0064D2);
        border-radius: 3px;
    }

    .dark #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #detailPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #33ADFF, #0194F3);
    }
</style>