<!-- Modal Tambah Penginapan -->
<div id="addPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddPenginapanModal()"></div>

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
                        <i data-lucide="building-2" class="w-6 h-6"></i>
                        Tambah Penginapan Baru
                    </h3>
                    <button type="button" onclick="closeAddPenginapanModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addPenginapanForm" enctype="multipart/form-data">
                    @csrf

                    <!-- Tab Navigation — GRADIENT ACTIVE -->
                    <div class="mb-6 rounded-xl bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 p-2 shadow-inner">
                        <ul class="flex flex-wrap gap-1 text-sm font-medium text-center" id="addPenginapanTab"
                            role="tablist">
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-md shadow-[#0194F3]/30 transition-all duration-200"
                                    data-tab="add-utama" role="tab" type="button" onclick="switchAddTab('add-utama')">
                                    <i data-lucide="file-text" class="w-4 h-4"></i>
                                    Informasi Utama
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="add-kontak" role="tab" type="button" onclick="switchAddTab('add-kontak')">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                    Kontak & Sosmed
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="add-maps" role="tab" type="button" onclick="switchAddTab('add-maps')">
                                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                                    Lokasi & Maps
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="add-media" role="tab" type="button" onclick="switchAddTab('add-media')">
                                    <i data-lucide="image" class="w-4 h-4"></i>
                                    Media & SEO
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg text-[#687176] dark:text-gray-400 hover:bg-white hover:text-[#0194F3] dark:hover:bg-gray-700 dark:hover:text-[#33ADFF] transition-all duration-200"
                                    data-tab="add-fasilitas" role="tab" type="button"
                                    onclick="switchAddTab('add-fasilitas')">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                    Fasilitas & Aturan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">

                        {{-- ============ TAB 1: INFORMASI UTAMA ============ --}}
                        <div id="add-utama" class="add-tab-content">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                Informasi Penginapan
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Kategori -->
                                <div class="sm:col-span-2">
                                    <label for="addCategory"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select id="addCategory" name="category_id" required
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                        <option value="">Pilih Kategori</option>
                                        @if (isset($categories) && $categories->count())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_category_id_error"></span>
                                </div>

                                <!-- Title -->
                                <div class="sm:col-span-2 lg:col-span-3">
                                    <label for="addTitle"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Nama
                                        Penginapan <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="addTitle"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan nama penginapan" required>
                                    <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="col-span-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="addSlug"
                                            class="text-sm font-medium text-[#0F294D] dark:text-white">Slug</label>
                                        <button type="button" onclick="generateSlugFromTitle()"
                                            class="text-xs text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#B3E0FF] font-medium inline-flex items-center gap-1">
                                            <i data-lucide="wand-2" class="w-3 h-3"></i>
                                            Generate dari Nama
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="addSlug"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                                </div>

                                <!-- Address -->
                                <div class="col-span-full">
                                    <label for="addAddress"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Alamat
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="address" id="addAddress"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan alamat lengkap" required>
                                    <span class="text-red-500 text-xs error-message" id="add_address_error"></span>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="addPrice"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Harga per
                                        Malam <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" id="addPrice"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="350000" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_price_error"></span>
                                </div>

                                <!-- Capacity -->
                                <div>
                                    <label for="addCapacity"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Kapasitas
                                        (Orang) <span class="text-red-500">*</span></label>
                                    <input type="number" name="capacity" id="addCapacity"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="4" required min="1">
                                    <span class="text-red-500 text-xs error-message" id="add_capacity_error"></span>
                                </div>

                                <!-- Bedroom -->
                                <div>
                                    <label for="addBedroom"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Kamar Tidur
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bedroom" id="addBedroom"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="2" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bedroom_error"></span>
                                </div>

                                <!-- Bathroom -->
                                <div>
                                    <label for="addBathroom"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Kamar Mandi
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bathroom" id="addBathroom"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="1" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bathroom_error"></span>
                                </div>

                                <!-- Size -->
                                <div>
                                    <label for="addSize"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Ukuran
                                        (m²)</label>
                                    <input type="text" name="size" id="addSize"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="45">
                                    <span class="text-red-500 text-xs error-message" id="add_size_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="addStatus"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select id="addStatus" name="status" required
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                                        <option value="">Pilih Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Full">Full</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_status_error"></span>
                                </div>

                                <!-- Description -->
                                <div class="col-span-full">
                                    <label for="addDescription"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Deskripsi
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="description" id="addDescription" rows="3"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="Masukkan deskripsi lengkap" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_description_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 2: KONTAK & SOSIAL MEDIA ============ --}}
                        <div id="add-kontak" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-2 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                Kontak & Sosial Media
                            </h4>
                            <p class="text-xs text-[#687176] dark:text-gray-400 mb-4">
                                Semua field di bawah ini <strong>opsional</strong> — boleh dikosongi jika tidak ada.
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Telepon --}}
                                <div>
                                    <label for="addPhone"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">No.
                                        Telepon</label>
                                    <input type="text" name="phone" id="addPhone"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="(021) 1234-5678">
                                    <span class="text-red-500 text-xs error-message" id="add_phone_error"></span>
                                </div>

                                {{-- WhatsApp --}}
                                <div>
                                    <label for="addWhatsapp"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">No.
                                        WhatsApp</label>
                                    <input type="text" name="whatsapp" id="addWhatsapp"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="0812-3456-7890">
                                    <span class="text-red-500 text-xs error-message" id="add_whatsapp_error"></span>
                                </div>

                                {{-- Email --}}
                                <div class="sm:col-span-2">
                                    <label for="addEmail"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Email</label>
                                    <input type="email" name="email" id="addEmail"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="info@adakamar.id">
                                    <span class="text-red-500 text-xs error-message" id="add_email_error"></span>
                                </div>

                                {{-- Facebook --}}
                                <div>
                                    <label for="addFacebook"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Facebook</label>
                                    <input type="text" name="facebook" id="addFacebook"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://facebook.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_facebook_error"></span>
                                </div>

                                {{-- Instagram --}}
                                <div>
                                    <label for="addInstagram"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Instagram</label>
                                    <input type="text" name="instagram" id="addInstagram"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://instagram.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_instagram_error"></span>
                                </div>

                                {{-- YouTube --}}
                                <div>
                                    <label for="addYoutube"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">YouTube</label>
                                    <input type="text" name="youtube" id="addYoutube"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://youtube.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_youtube_error"></span>
                                </div>

                                {{-- X (Twitter) --}}
                                <div>
                                    <label for="addX"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">X
                                        (Twitter)</label>
                                    <input type="text" name="x" id="addX"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://x.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_x_error"></span>
                                </div>

                                {{-- TikTok --}}
                                <div class="sm:col-span-2">
                                    <label for="addTiktok"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">TikTok</label>
                                    <input type="text" name="tiktok" id="addTiktok"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://tiktok.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_tiktok_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 3: LOKASI & MAPS ============ --}}
                        <div id="add-maps" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                Lokasi & Google Maps
                            </h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addMapEmbed"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Google Maps
                                        Embed</label>
                                    <p class="text-xs text-[#687176] dark:text-gray-400 mb-2">Salin kode embed dari
                                        Google Maps</p>
                                    <textarea name="maps_embed" id="addMapEmbed" rows="3"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="<iframe src='https://www.google.com/maps/embed?...'></iframe>"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_map_embed_error"></span>
                                </div>

                                <div>
                                    <label for="addGoogleMapsUrl"
                                        class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Google Maps
                                        URL</label>
                                    <input type="url" name="google_maps_url" id="addGoogleMapsUrl"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="https://maps.google.com/...">
                                    <span class="text-red-500 text-xs error-message"
                                        id="add_google_maps_url_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 4: MEDIA & SEO ============ --}}
                        <div id="add-media" class="add-tab-content hidden">
                            {{-- Thumbnail --}}
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                    Thumbnail <span class="text-red-500">*</span>
                                </h4>
                                <div class="flex flex-col items-center">
                                    <div id="addThumbnailUploadArea"
                                        class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] border-[#B3E0FF] hover:from-[#B3E0FF] hover:to-[#E6F4FF] dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:hover:border-[#33ADFF] transition-colors">
                                        <label for="addThumbnailUpload"
                                            class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <i data-lucide="image-plus"
                                                    class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400"></i>
                                                <p class="mb-1 text-sm text-[#687176] dark:text-gray-400">
                                                    <span class="font-semibold text-[#0194F3]">Klik untuk upload</span> thumbnail
                                                </p>
                                                <p class="text-xs text-[#687176] dark:text-gray-400">PNG, JPG, WEBP
                                                    (Maks. 100MB)</p>
                                            </div>
                                            <input type="file" id="addThumbnailUpload" name="thumbnail" accept="image/*"
                                                class="hidden" required>
                                        </label>
                                    </div>

                                    <div id="addThumbnailPreviewContainer" class="hidden relative w-full">
                                        <img id="addThumbnailPreview" src="#" alt="Preview Thumbnail"
                                            class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                        <div
                                            class="absolute bottom-3 left-3 bg-black/70 text-white text-xs px-3 py-1.5 rounded-lg">
                                            <span id="addThumbnailFileName"></span>
                                            <span class="mx-2">|</span>
                                            <span id="addThumbnailFileSize"></span>
                                        </div>
                                        <button type="button" onclick="removeAddThumbnail()"
                                            class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                        {{-- Badge "Terupload" — biru --}}
                                        <div class="absolute top-2 left-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white text-xs px-2 py-1 rounded-lg shadow-md inline-flex items-center gap-1">
                                            <i data-lucide="check" class="w-3 h-3"></i>
                                            Terupload
                                        </div>
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
                                </div>
                            </div>

                            {{-- Galeri --}}
                            <div>
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                    Galeri Foto <span class="text-red-500">*</span>
                                </h4>
                                <p class="text-sm text-[#687176] dark:text-gray-400 mb-3">
                                    Upload minimal 2 dan maksimal 10 foto &middot; Maks. 100MB per foto (JPG, PNG, WEBP, GIF)
                                </p>
                                <div id="addGalleryContainer"
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                </div>
                                <div id="addUploadGaleriContainer">
                                    <label id="addUploadGaleriBtn"
                                        class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] text-white rounded-lg shadow-md shadow-[#0194F3]/30 transition-all">
                                        <i data-lucide="upload" class="w-5 h-5"></i>
                                        Tambah Foto Galeri
                                        <input type="file" id="addGalleryUpload" name="gallery[]" accept="image/*"
                                            multiple class="hidden">
                                    </label>
                                    <span id="addGalleryCounter" class="ml-3 text-sm text-[#687176] dark:text-gray-400">0
                                        / 10 foto</span>
                                </div>
                                <p id="addGalleryError" class="mt-1 text-sm text-red-600 hidden">Minimal upload 2 foto galeri</p>
                                <span class="text-red-500 text-xs error-message" id="add_gallery_error"></span>
                            </div>

                            {{-- SEO --}}
                            <div class="mt-6 pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                    SEO (Search Engine Optimization)
                                </h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="addMetaTitle"
                                            class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Meta
                                            Title</label>
                                        <input type="text" name="meta_title" id="addMetaTitle"
                                            class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                            placeholder="Meta Title">
                                        <span class="text-red-500 text-xs error-message"
                                            id="add_meta_title_error"></span>
                                    </div>

                                    <div>
                                        <label for="addMetaDescription"
                                            class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Meta
                                            Description</label>
                                        <textarea name="meta_description" id="addMetaDescription" rows="2"
                                            class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                            placeholder="Meta Description"></textarea>
                                        <span class="text-red-500 text-xs error-message"
                                            id="add_meta_description_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 5: FASILITAS & ATURAN ============ --}}
                        <div id="add-fasilitas" class="add-tab-content hidden">
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                    Fasilitas
                                </h4>
                                <p class="text-sm text-[#687176] dark:text-gray-400 mb-3">Pilih fasilitas yang tersedia</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 p-4 rounded-xl bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-800 dark:to-gray-700 border border-[#B3E0FF] dark:border-gray-600">
                                    @if (isset($facilities) && $facilities->count())
                                        @foreach ($facilities as $facility)
                                            <label
                                                class="flex items-center gap-2 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-600 transition-colors cursor-pointer border border-transparent hover:border-[#B3E0FF] dark:hover:border-gray-500">
                                                <input type="checkbox" name="facility_ids[]"
                                                    value="{{ $facility->id }}"
                                                    class="rounded border-[#B3E0FF] text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700 flex-shrink-0">

                                                {{-- ===== ICON FASILITAS (Lucide) ===== --}}
                                                @if ($facility->icon)
                                                    <span
                                                        class="inline-flex items-center justify-center w-7 h-7 rounded-md
                                                                 bg-white dark:bg-gray-700 border border-[#B3E0FF] dark:border-gray-600
                                                                 flex-shrink-0"
                                                        title="{{ $facility->icon }}">
                                                        @include('example.layouts.partials.accomodation._icon', [
                                                            'icon' => $facility->icon,
                                                            'size' => 16,
                                                        ])
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center justify-center w-7 h-7 rounded-md
                                                                 bg-gray-100 dark:bg-gray-600 border border-dashed border-gray-300 dark:border-gray-500
                                                                 text-gray-400 dark:text-gray-500 flex-shrink-0"
                                                        title="Tidak ada icon">
                                                        <i data-lucide="minus" class="w-3 h-3"></i>
                                                    </span>
                                                @endif

                                                <span
                                                    class="text-sm text-[#0F294D] dark:text-gray-300 leading-tight">{{ $facility->name }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-[#687176] dark:text-gray-400 col-span-full">Tidak ada fasilitas tersedia</p>
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="add_facility_ids_error"></span>
                            </div>

                            <div class="pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-gradient-to-b from-[#0194F3] to-[#0064D2] rounded-full"></span>
                                    Aturan
                                </h4>
                                <p class="text-sm text-[#687176] dark:text-gray-400 mb-3">Pilih aturan yang berlaku</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 p-4 rounded-xl bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-800 dark:to-gray-700 border border-[#B3E0FF] dark:border-gray-600">
                                    @if (isset($rules) && $rules->count())
                                        @foreach ($rules as $rule)
                                            <label
                                                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-600 transition-colors cursor-pointer">
                                                <input type="checkbox" name="rule_ids[]"
                                                    value="{{ $rule->id }}"
                                                    class="rounded border-[#B3E0FF] text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700">
                                                <span
                                                    class="text-sm text-[#0F294D] dark:text-gray-300">{{ $rule->name }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-[#687176] dark:text-gray-400 col-span-full">Tidak ada aturan tersedia</p>
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="add_rule_ids_error"></span>
                            </div>
                        </div>
                    </div>

                    {{-- ===== FOOTER MODAL — GRADIENT ===== --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700 bg-gradient-to-r from-transparent via-[#F7F9FC]/50 to-transparent dark:via-gray-800/50 -mx-6 px-6 pb-2">
                        <button type="button" onclick="submitAddPenginapan()"
                            class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 w-full sm:w-auto transition-all duration-200">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Simpan Penginapan
                        </button>
                        <button type="button" onclick="closeAddPenginapanModal()"
                            class="text-[#0194F3] bg-white border-2 border-[#0194F3] focus:outline-none hover:bg-[#0194F3] hover:text-white focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-[#33ADFF] dark:border-[#33ADFF] dark:hover:bg-[#33ADFF] dark:hover:text-white w-full sm:w-auto transition-all duration-200">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== KONSTANTA BATAS UKURAN ==========
    const MAX_IMAGE_SIZE = 104857600; // 100 MB
    const MAX_IMAGE_SIZE_LABEL = '100 MB';
    const MAX_GALLERY_PHOTOS = 10;
    const MIN_GALLERY_PHOTOS = 2;

    let addGalleryPhotos = [];

    // ========== HELPER ==========
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }

    function isValidImageType(file) {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        return validTypes.includes(file.type);
    }

    function isValidFileSize(file) {
        return file.size <= MAX_IMAGE_SIZE;
    }

    function renderLucideSafe() {
        if (window.renderLucide) {
            window.renderLucide();
        } else if (window.lucide) {
            lucide.createIcons();
        }
    }

    // ========== TAB FUNCTION — GRADIENT ACTIVE ==========
    function switchAddTab(tabId) {
        document.querySelectorAll('.add-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        document.querySelectorAll('#addPenginapanTab button').forEach(btn => {
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

        const activeBtn = document.querySelector(`#addPenginapanTab button[data-tab="${tabId}"]`);
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

        // Render ulang Lucide karena icon di tab yang baru aktif mungkin belum dirender
        renderLucideSafe();
    }

    // ========== OPEN/CLOSE MODAL ==========
    window.openAddPenginapanModal = function() {
        const modal = document.getElementById('addPenginapanModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('addPenginapanForm');
        form.reset();

        addGalleryPhotos = [];
        renderAddGallery();
        updateAddGalleryCounter();

        document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
        document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
        document.getElementById('addThumbnailUpload').value = '';

        document.querySelectorAll('#addPenginapanForm .error-message').forEach(el => el.textContent = '');
        document.getElementById('addGalleryError').classList.add('hidden');

        switchAddTab('add-utama');

        // Render Lucide untuk icon di modal
        renderLucideSafe();

        setTimeout(() => document.getElementById('addTitle').focus(), 100);
    };

    window.closeAddPenginapanModal = function() {
        document.getElementById('addPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ========== SLUG GENERATOR ==========
    function generateSlugFromTitle() {
        const title = document.getElementById('addTitle').value.trim();
        const slugInput = document.getElementById('addSlug');

        if (!title) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Masukkan nama penginapan terlebih dahulu'
            });
            document.getElementById('addTitle').focus();
            return;
        }

        const slug = title.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
        slugInput.value = slug;

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Slug telah digenerate',
            timer: 1500,
            showConfirmButton: false
        });
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function() {
        const upload = document.getElementById('addThumbnailUpload');
        const uploadArea = document.getElementById('addThumbnailUploadArea');
        const previewContainer = document.getElementById('addThumbnailPreviewContainer');
        const preview = document.getElementById('addThumbnailPreview');
        const fileName = document.getElementById('addThumbnailFileName');
        const fileSize = document.getElementById('addThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!isValidFileSize(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar!',
                            html: `Ukuran file: <b>${formatFileSize(file.size)}</b><br>Maksimal yang diizinkan: <b>${MAX_IMAGE_SIZE_LABEL}</b>`
                        });
                        this.value = '';
                        return;
                    }
                    if (!isValidImageType(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format Tidak Didukung!',
                            text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.'
                        });
                        this.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        renderLucideSafe();
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeAddThumbnail = function() {
            document.getElementById('addThumbnailUpload').value = '';
            document.getElementById('addThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('addThumbnailPreviewContainer').classList.add('hidden');
            document.getElementById('add_thumbnail_error').textContent = '';
        };
    });

    // ========== GALLERY ==========
    function updateAddGalleryCounter() {
        const counter = document.getElementById('addGalleryCounter');
        const uploadBtn = document.getElementById('addUploadGaleriBtn');
        counter.textContent = `${addGalleryPhotos.length} / ${MAX_GALLERY_PHOTOS} foto`;
        if (addGalleryPhotos.length >= MAX_GALLERY_PHOTOS) {
            uploadBtn.style.opacity = '0.5';
            uploadBtn.style.cursor = 'not-allowed';
            document.getElementById('addGalleryUpload').disabled = true;
        } else {
            uploadBtn.style.opacity = '1';
            uploadBtn.style.cursor = 'pointer';
            document.getElementById('addGalleryUpload').disabled = false;
        }
        if (addGalleryPhotos.length >= MIN_GALLERY_PHOTOS) {
            document.getElementById('addGalleryError').classList.add('hidden');
        }
        if (addGalleryPhotos.length > 0) {
            document.getElementById('add_gallery_error').textContent = '';
        }
    }

    function renderAddGallery() {
        const container = document.getElementById('addGalleryContainer');
        container.innerHTML = '';
        if (addGalleryPhotos.length === 0) {
            container.innerHTML = `
                <div class="col-span-full text-center py-8 text-[#687176] dark:text-gray-500 border-2 border-dashed border-[#B3E0FF] dark:border-gray-600 rounded-lg bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-800 dark:to-gray-700">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="image" class="w-12 h-12 text-[#0194F3]"></i>
                    </div>
                    <p>Belum ada foto galeri</p>
                    <p class="text-xs">Minimal 2 foto</p>
                </div>
            `;
            renderLucideSafe();
            return;
        }
        addGalleryPhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${photo.url}" alt="Galeri ${index + 1}" class="w-full h-32 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                <button type="button" onclick="removeAddGalleryPhoto(${index})" class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition-colors opacity-0 group-hover:opacity-100">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <span class="absolute bottom-2 left-2 bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white text-xs px-2 py-1 rounded">${index + 1}</span>
            `;
            container.appendChild(div);
        });
        renderLucideSafe();
    }

    function removeAddGalleryPhoto(index) {
        addGalleryPhotos.splice(index, 1);
        renderAddGallery();
        updateAddGalleryCounter();
        if (addGalleryPhotos.length < MIN_GALLERY_PHOTOS) {
            document.getElementById('addGalleryError').classList.remove('hidden');
        }
    }

    function addAddGalleryPhoto(file) {
        if (addGalleryPhotos.length >= MAX_GALLERY_PHOTOS) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: `Maksimal ${MAX_GALLERY_PHOTOS} foto galeri!`
            });
            return;
        }
        if (!isValidFileSize(file)) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran File Terlalu Besar!',
                html: `File: <b>${file.name}</b><br>Ukuran: <b>${formatFileSize(file.size)}</b><br>Maksimal: <b>${MAX_IMAGE_SIZE_LABEL}</b> per foto.`
            });
            return;
        }
        if (!isValidImageType(file)) {
            Swal.fire({
                icon: 'error',
                title: 'Format Tidak Didukung!',
                text: `"${file.name}" bukan format gambar yang didukung (JPG, JPEG, PNG, GIF, WEBP).`
            });
            return;
        }
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const targetWidth = 240;
                const targetHeight = 160;
                const imgRatio = img.width / img.height;
                const targetRatio = targetWidth / targetHeight;
                let cropWidth, cropHeight, offsetX = 0,
                    offsetY = 0;
                if (imgRatio > targetRatio) {
                    cropHeight = img.height;
                    cropWidth = img.height * targetRatio;
                    offsetX = (img.width - cropWidth) / 2;
                } else {
                    cropWidth = img.width;
                    cropHeight = img.width / targetRatio;
                    offsetY = (img.height - cropHeight) / 2;
                }
                canvas.width = targetWidth;
                canvas.height = targetHeight;
                ctx.drawImage(img, offsetX, offsetY, cropWidth, cropHeight, 0, 0, targetWidth, targetHeight);
                const imageDataUrl = canvas.toDataURL('image/jpeg', 0.9);
                addGalleryPhotos.push({
                    id: Date.now() + addGalleryPhotos.length,
                    url: imageDataUrl,
                    file: file
                });
                renderAddGallery();
                updateAddGalleryCounter();
                if (addGalleryPhotos.length >= MIN_GALLERY_PHOTOS) {
                    document.getElementById('addGalleryError').classList.add('hidden');
                }
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const upload = document.getElementById('addGalleryUpload');
        if (upload) {
            upload.addEventListener('change', function(e) {
                const files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    addAddGalleryPhoto(files[i]);
                }
                this.value = '';
            });
        }

        const container = document.getElementById('addUploadGaleriContainer');
        if (container) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                container.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
            container.addEventListener('dragover', function() {
                this.classList.add('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg');
            });
            container.addEventListener('dragleave', function() {
                this.classList.remove('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg');
            });
            container.addEventListener('drop', function(e) {
                this.classList.remove('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg');
                const files = e.dataTransfer.files;
                for (let i = 0; i < files.length; i++) {
                    addAddGalleryPhoto(files[i]);
                }
            });
        }

        const titleInput = document.getElementById('addTitle');
        const slugInput = document.getElementById('addSlug');
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function() {
                if (slugInput.value === '') {
                    const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }

        console.log('Modal Tambah Penginapan siap digunakan.');
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddPenginapan = async function() {
        document.querySelectorAll('#addPenginapanForm .error-message').forEach(el => el.textContent = '');
        document.getElementById('addGalleryError').classList.add('hidden');

        const category = document.getElementById('addCategory').value;
        const title = document.getElementById('addTitle').value.trim();
        const address = document.getElementById('addAddress').value.trim();
        const price = document.getElementById('addPrice').value;
        const capacity = document.getElementById('addCapacity').value;
        const bedroom = document.getElementById('addBedroom').value;
        const bathroom = document.getElementById('addBathroom').value;
        const status = document.getElementById('addStatus').value;
        const description = document.getElementById('addDescription').value.trim();
        const thumbnail = document.getElementById('addThumbnailUpload').files[0];

        if (!category) {
            document.getElementById('add_category_id_error').textContent = 'Kategori wajib dipilih';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kategori wajib dipilih'
            });
            document.getElementById('addCategory').focus();
            return;
        }
        if (!title) {
            document.getElementById('add_title_error').textContent = 'Nama penginapan wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Nama penginapan wajib diisi'
            });
            document.getElementById('addTitle').focus();
            return;
        }
        if (!address) {
            document.getElementById('add_address_error').textContent = 'Alamat wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Alamat wajib diisi'
            });
            document.getElementById('addAddress').focus();
            return;
        }
        if (!price || Number(price) <= 0) {
            document.getElementById('add_price_error').textContent = 'Harga wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Harga wajib diisi'
            });
            document.getElementById('addPrice').focus();
            return;
        }
        if (!capacity || Number(capacity) <= 0) {
            document.getElementById('add_capacity_error').textContent = 'Kapasitas wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kapasitas wajib diisi'
            });
            document.getElementById('addCapacity').focus();
            return;
        }
        if (bedroom === '' || Number(bedroom) < 0) {
            document.getElementById('add_bedroom_error').textContent = 'Kamar tidur wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kamar tidur wajib diisi'
            });
            document.getElementById('addBedroom').focus();
            return;
        }
        if (bathroom === '' || Number(bathroom) < 0) {
            document.getElementById('add_bathroom_error').textContent = 'Kamar mandi wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Kamar mandi wajib diisi'
            });
            document.getElementById('addBathroom').focus();
            return;
        }
        if (!status) {
            document.getElementById('add_status_error').textContent = 'Status wajib dipilih';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Status wajib dipilih'
            });
            document.getElementById('addStatus').focus();
            return;
        }
        if (!description) {
            document.getElementById('add_description_error').textContent = 'Deskripsi wajib diisi';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Deskripsi wajib diisi'
            });
            document.getElementById('addDescription').focus();
            return;
        }
        if (!thumbnail) {
            document.getElementById('add_thumbnail_error').textContent = 'Thumbnail wajib diupload';
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Thumbnail wajib diupload'
            });
            return;
        }
        if (!isValidFileSize(thumbnail)) {
            document.getElementById('add_thumbnail_error').textContent =
                `Ukuran thumbnail maksimal ${MAX_IMAGE_SIZE_LABEL}`;
            Swal.fire({
                icon: 'error',
                title: 'Ukuran Thumbnail Terlalu Besar!',
                html: `Ukuran: <b>${formatFileSize(thumbnail.size)}</b><br>Maksimal: <b>${MAX_IMAGE_SIZE_LABEL}</b>`
            });
            return;
        }
        if (addGalleryPhotos.length < MIN_GALLERY_PHOTOS) {
            document.getElementById('addGalleryError').classList.remove('hidden');
            document.getElementById('add_gallery_error').textContent =
                `Minimal upload ${MIN_GALLERY_PHOTOS} foto galeri`;
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: `Minimal upload ${MIN_GALLERY_PHOTOS} foto galeri`
            });
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const form = document.getElementById('addPenginapanForm');
        const formData = new FormData(form);
        formData.delete('gallery[]');

        addGalleryPhotos.forEach(photo => {
            if (photo.file) {
                formData.append('gallery[]', photo.file);
            }
        });

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const response = await fetch('{{ route('accommodations.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const contentType = response.headers.get('content-type') || '';
            let data;

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const text = await response.text();
                console.error('Response bukan JSON:', text);
                throw new Error(`Server mengembalikan response bukan JSON. HTTP ${response.status}`);
            }

            if (response.ok && data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Penginapan berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    closeAddPenginapanModal();
                    location.reload();
                });
                return;
            }

            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const normalizedKey = key.replace(/\.\d+/g, '');
                    const errorEl = document.getElementById('add_' + normalizedKey + '_error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data
                            .errors[key];
                    }
                });
                const firstError = Object.values(data.errors)[0];
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: Array.isArray(firstError) ? firstError[0] : firstError
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message || 'Gagal menambahkan penginapan'
                });
            }
        } catch (error) {
            console.error('=== ERROR SUBMIT ===', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan: ' + error.message
            });
        }
    };

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('addPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddPenginapanModal();
            }
        }
    });

    document.querySelector('#addPenginapanModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) closeAddPenginapanModal();
    });

    // Render Lucide saat halaman pertama load
    document.addEventListener('DOMContentLoaded', function() {
        renderLucideSafe();
    });
</script>

<style>
    #addPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #E6F4FF;
        border-radius: 3px;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #0194F3, #0064D2);
        border-radius: 3px;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #33ADFF, #0194F3);
    }

    #addGalleryContainer .group:hover button {
        opacity: 1 !important;
    }

    #addGalleryContainer .group button {
        transition: opacity 0.2s ease;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }

    #addThumbnailPreviewContainer {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>