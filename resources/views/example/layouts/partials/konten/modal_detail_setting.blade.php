<!-- Modal Detail Setting -->
<div id="detailSettingModal" class="fixed inset-0 z-50 hidden overflow-y-auto">

    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <!-- Overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeDetailSettingModal()"></div>

        <!-- Modal -->
        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full">

            <!-- Header -->
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                </div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative flex items-center justify-between">

                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 002 0V6zm0 6a1 1 0 10-2 0 1 1 0 002 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Detail Pengaturan Website
                    </h3>

                    <button type="button"
                        onclick="closeDetailSettingModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>

                        </svg>
                    </button>
                </div>
            </div>


            <!-- Content -->
            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">

                <!-- Tab Navigation -->
                <div class="mb-6 rounded-xl bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 p-2 shadow-inner">

                    <ul class="flex flex-wrap gap-1 text-sm font-medium text-center"
                        id="detailSettingTab"
                        role="tablist">

                        <!-- Informasi -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30 transition-all duration-200"
                                data-tab="detailSettingInformasi"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingInformasi')">

                                <svg class="w-4 h-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">

                                    <path
                                        d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />

                                    <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />

                                </svg>

                                Informasi
                            </button>

                        </li>


                        <!-- Branding & Logo -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detailSettingBranding"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingBranding')">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                </svg>

                                Branding & Logo
                            </button>

                        </li>


                        <!-- Kontak -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detailSettingKontak"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingKontak')">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />

                                </svg>

                                Kontak
                            </button>

                        </li>


                        <!-- Sosial Media -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detailSettingSosial"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingSosial')">

                                <svg class="w-4 h-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V3z"
                                        clip-rule="evenodd" />

                                </svg>

                                Sosial Media
                            </button>

                        </li>


                        <!-- SEO -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detailSettingSeo"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingSeo')">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.15 7.5 7.5 0 0016.65 16.65z" />

                                </svg>

                                SEO
                            </button>

                        </li>


                        <!-- Footer -->
                        <li role="presentation">

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                data-tab="detailSettingFooter"
                                role="tab"
                                type="button"
                                onclick="switchDetailSettingTab('detailSettingFooter')">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4v16h16" />

                                </svg>

                                Footer
                            </button>

                        </li>

                    </ul>
                </div>


                <!-- Tab Content -->
                <div class="space-y-6">


                    <!-- ===================================================== -->
                    <!-- TAB 1 : INFORMASI -->
                    <!-- ===================================================== -->

                    <div id="detailSettingInformasi"
                        class="detail-setting-tab-content">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Informasi Website
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Nama Website -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Nama Website
                                </label>

                                <p id="detailSettingNama"
                                    class="text-[#0F294D] dark:text-white font-medium">
                                    -
                                </p>

                            </div>


                            <!-- Tagline -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Tagline
                                </label>

                                <p id="detailSettingTagline"
                                    class="text-[#0F294D] dark:text-white font-medium">
                                    -
                                </p>

                            </div>


                            <!-- Tentang -->
                            <div class="md:col-span-2 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Tentang Website
                                </label>

                                <p id="detailSettingDeskripsi"
                                    class="text-[#0F294D] dark:text-white whitespace-pre-line">
                                    -
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- ===================================================== -->
                    <!-- TAB 2 : BRANDING & LOGO -->
                    <!-- ===================================================== -->

                    <div id="detailSettingBranding"
                        class="detail-setting-tab-content hidden">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Branding & Logo
                        </h4>

                        <div class="grid grid-cols-1 gap-4">

                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-2 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Logo Website
                                </label>

                                <div class="flex items-center justify-center w-full min-h-[220px] bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-2 border-[#B3E0FF] rounded-lg dark:from-gray-700 dark:to-gray-700 dark:border-gray-600">

                                    <img id="detailSettingLogo"
                                        src=""
                                        alt="Logo Website"
                                        class="max-h-48 max-w-full object-contain rounded-lg hidden">

                                    <span id="detailSettingLogoEmpty"
                                        class="text-[#687176] dark:text-gray-400">
                                        Logo belum tersedia
                                    </span>

                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- ===================================================== -->
                    <!-- TAB 3 : KONTAK -->
                    <!-- ===================================================== -->

                    <div id="detailSettingKontak"
                        class="detail-setting-tab-content hidden">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Informasi Kontak
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Alamat -->
                            <div class="md:col-span-2 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Alamat
                                </label>

                                <p id="detailSettingAlamat"
                                    class="text-[#0F294D] dark:text-white whitespace-pre-line">
                                    -
                                </p>

                            </div>


                            <!-- Telepon -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Telepon
                                </label>

                                <p id="detailSettingPhone"
                                    class="text-[#0F294D] dark:text-white">
                                    -
                                </p>

                            </div>


                            <!-- WhatsApp -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    WhatsApp
                                </label>

                                <p id="detailSettingWhatsapp"
                                    class="text-[#0F294D] dark:text-white">
                                    -
                                </p>

                            </div>


                            <!-- Email -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Email
                                </label>

                                <p id="detailSettingEmail"
                                    class="text-[#0F294D] dark:text-white break-words">
                                    -
                                </p>

                            </div>


                            <!-- Maps Embed -->
                            <div class="md:col-span-2 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Maps Embed
                                </label>

                                <p id="detailSettingMapsEmbed"
                                    class="text-[#0F294D] dark:text-white whitespace-pre-line break-all">
                                    -
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- ===================================================== -->
                    <!-- TAB 4 : SOSIAL MEDIA -->
                    <!-- ===================================================== -->

                    <div id="detailSettingSosial"
                        class="detail-setting-tab-content hidden">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Sosial Media
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Facebook -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Facebook
                                </label>

                                <p id="detailSettingFacebook"
                                    class="text-[#0F294D] dark:text-white break-all">
                                    -
                                </p>

                            </div>


                            <!-- Instagram -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Instagram
                                </label>

                                <p id="detailSettingInstagram"
                                    class="text-[#0F294D] dark:text-white break-all">
                                    -
                                </p>

                            </div>


                            <!-- X -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    X (Twitter)
                                </label>

                                <p id="detailSettingTwitter"
                                    class="text-[#0F294D] dark:text-white break-all">
                                    -
                                </p>

                            </div>


                            <!-- YouTube -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    YouTube
                                </label>

                                <p id="detailSettingYoutube"
                                    class="text-[#0F294D] dark:text-white break-all">
                                    -
                                </p>

                            </div>


                            <!-- TikTok -->
                            <div class="md:col-span-2 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    TikTok
                                </label>

                                <p id="detailSettingTiktok"
                                    class="text-[#0F294D] dark:text-white break-all">
                                    -
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- ===================================================== -->
                    <!-- TAB 5 : SEO -->
                    <!-- ===================================================== -->

                    <div id="detailSettingSeo"
                        class="detail-setting-tab-content hidden">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            SEO Website
                        </h4>

                        <div class="grid grid-cols-1 gap-4">

                            <!-- Meta Title -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Meta Title
                                </label>

                                <p id="detailSettingMetaTitle"
                                    class="text-[#0F294D] dark:text-white break-words">
                                    -
                                </p>

                            </div>


                            <!-- Meta Description -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Meta Description
                                </label>

                                <p id="detailSettingMetaDescription"
                                    class="text-[#0F294D] dark:text-white whitespace-pre-line break-words">
                                    -
                                </p>

                            </div>


                            <!-- Meta Keywords -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Meta Keywords
                                </label>

                                <p id="detailSettingMetaKeywords"
                                    class="text-[#0F294D] dark:text-white break-words">
                                    -
                                </p>

                            </div>

                        </div>
                    </div>


                    <!-- ===================================================== -->
                    <!-- TAB 6 : FOOTER -->
                    <!-- ===================================================== -->

                    <div id="detailSettingFooter"
                        class="detail-setting-tab-content hidden">

                        <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                            Pengaturan Footer
                        </h4>

                        <div class="grid grid-cols-1 gap-4">

                            <!-- Footer Description -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Deskripsi Footer
                                </label>

                                <p id="detailSettingFooterDescription"
                                    class="text-[#0F294D] dark:text-white whitespace-pre-line break-words">
                                    -
                                </p>

                            </div>


                            <!-- Copyright -->
                            <div class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700 dark:to-gray-700/50 p-4 rounded-lg border border-[#B3E0FF]/50 dark:border-gray-600/50">

                                <label class="block mb-1 text-xs font-medium text-[#687176] dark:text-gray-400 uppercase tracking-wider">
                                    Copyright
                                </label>

                                <p id="detailSettingCopyright"
                                    class="text-[#0F294D] dark:text-white">
                                    -
                                </p>

                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!-- Footer -->
            <div class="px-6 py-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 border-t border-[#B3E0FF] dark:border-gray-700 flex justify-end">

                <button type="button"
                    onclick="closeDetailSettingModal()"
                    class="text-[#0194F3] bg-white border-2 border-[#0194F3] hover:bg-[#0194F3] hover:text-white focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-[#33ADFF] dark:border-[#33ADFF] dark:hover:bg-[#33ADFF] dark:hover:text-white transition-all duration-200">
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