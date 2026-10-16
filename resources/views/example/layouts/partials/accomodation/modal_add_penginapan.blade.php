<!-- Modal Tambah Penginapan -->
<div id="addPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Tambah Penginapan Baru
                    </h3>
                    <button type="button" onclick="closeAddPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="addPenginapanForm" enctype="multipart/form-data">
                    @csrf

                    <!-- Tab Navigation -->
                    <div class="border-b border-[#B3E0FF] dark:border-gray-700 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="addPenginapanTab"
                            role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg border-[#0194F3] text-[#0194F3] dark:border-[#33ADFF] dark:text-[#33ADFF]"
                                    data-tab="add-utama" role="tab" type="button" onclick="switchAddTab('add-utama')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                        <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                                    </svg>
                                    Informasi Utama
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-kontak" role="tab" type="button" onclick="switchAddTab('add-kontak')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                    Kontak & Sosmed
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-maps" role="tab" type="button" onclick="switchAddTab('add-maps')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Lokasi & Maps
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-media" role="tab" type="button" onclick="switchAddTab('add-media')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Media & SEO
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="add-fasilitas" role="tab" type="button"
                                    onclick="switchAddTab('add-fasilitas')">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z" />
                                    </svg>
                                    Fasilitas & Aturan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">

                        {{-- ============ TAB 1: INFORMASI UTAMA ============ --}}
                        <div id="add-utama" class="add-tab-content">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Informasi
                                Penginapan</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Kategori -->
                                <div class="sm:col-span-2">
                                    <label for="addCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <select id="addCategory" name="category_id" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="add_category_id_error"></span>
                                </div>

                                <!-- Title -->
                                <div class="sm:col-span-2 lg:col-span-3">
                                    <label for="addTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                        Penginapan <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="addTitle"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan nama penginapan" required>
                                    <span class="text-red-500 text-xs error-message" id="add_title_error"></span>
                                </div>

                                <!-- Slug -->
                                <div class="col-span-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="addSlug"
                                            class="text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                        <button type="button" onclick="generateSlugFromTitle()"
                                            class="text-xs text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#33ADFF] font-medium">
                                            Generate dari Nama
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="addSlug"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <span class="text-red-500 text-xs error-message" id="add_slug_error"></span>
                                </div>

                                <!-- Address -->
                                <div class="col-span-full">
                                    <label for="addAddress"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="address" id="addAddress"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan alamat lengkap" required>
                                    <span class="text-red-500 text-xs error-message" id="add_address_error"></span>
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="addPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per
                                        Malam <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" id="addPrice"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="350000" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_price_error"></span>
                                </div>

                                <!-- Capacity -->
                                <div>
                                    <label for="addCapacity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kapasitas
                                        (Orang) <span class="text-red-500">*</span></label>
                                    <input type="number" name="capacity" id="addCapacity"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="4" required min="1">
                                    <span class="text-red-500 text-xs error-message" id="add_capacity_error"></span>
                                </div>

                                <!-- Bedroom -->
                                <div>
                                    <label for="addBedroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Tidur
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bedroom" id="addBedroom"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="2" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bedroom_error"></span>
                                </div>

                                <!-- Bathroom -->
                                <div>
                                    <label for="addBathroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kamar Mandi
                                        <span class="text-red-500">*</span></label>
                                    <input type="number" name="bathroom" id="addBathroom"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="1" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="add_bathroom_error"></span>
                                </div>

                                <!-- Size -->
                                <div>
                                    <label for="addSize"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran
                                        (m²)</label>
                                    <input type="text" name="size" id="addSize"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="45">
                                    <span class="text-red-500 text-xs error-message" id="add_size_error"></span>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="addStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status
                                        <span class="text-red-500">*</span></label>
                                    <select id="addStatus" name="status" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
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
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                                        <span class="text-red-500">*</span></label>
                                    <textarea name="description" id="addDescription" rows="3"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan deskripsi lengkap" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_description_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 2: KONTAK & SOSIAL MEDIA ============ --}}
                        <div id="add-kontak" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-2">Kontak & Sosial
                                Media</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                Semua field di bawah ini <strong>opsional</strong> — boleh dikosongi jika tidak ada.
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                {{-- Telepon --}}
                                <div>
                                    <label for="addPhone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                        Telepon</label>
                                    <input type="text" name="phone" id="addPhone"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="(021) 1234-5678">
                                    <span class="text-red-500 text-xs error-message" id="add_phone_error"></span>
                                </div>

                                {{-- WhatsApp --}}
                                <div>
                                    <label for="addWhatsapp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                        WhatsApp</label>
                                    <input type="text" name="whatsapp" id="addWhatsapp"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="0812-3456-7890">
                                    <span class="text-red-500 text-xs error-message" id="add_whatsapp_error"></span>
                                </div>

                                {{-- Email --}}
                                <div class="sm:col-span-2">
                                    <label for="addEmail"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="addEmail"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="info@adakamar.id">
                                    <span class="text-red-500 text-xs error-message" id="add_email_error"></span>
                                </div>

                                {{-- Facebook --}}
                                <div>
                                    <label for="addFacebook"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook</label>
                                    <input type="text" name="facebook" id="addFacebook"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="facebook.com/adakamar">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanpa https:// juga bisa
                                    </p>
                                    <span class="text-red-500 text-xs error-message" id="add_facebook_error"></span>
                                </div>

                                {{-- Instagram --}}
                                <div>
                                    <label for="addInstagram"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram</label>
                                    <input type="text" name="instagram" id="addInstagram"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="instagram.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_instagram_error"></span>
                                </div>

                                {{-- YouTube --}}
                                <div>
                                    <label for="addYoutube"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">YouTube</label>
                                    <input type="text" name="youtube" id="addYoutube"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="youtube.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_youtube_error"></span>
                                </div>

                                {{-- X (Twitter) --}}
                                <div>
                                    <label for="addX"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">X
                                        (Twitter)</label>
                                    <input type="text" name="x" id="addX"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="x.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_x_error"></span>
                                </div>

                                {{-- TikTok --}}
                                <div class="sm:col-span-2">
                                    <label for="addTiktok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TikTok</label>
                                    <input type="text" name="tiktok" id="addTiktok"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="tiktok.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="add_tiktok_error"></span>
                                </div>


                            </div>
                        </div>

                        {{-- ============ TAB 3: LOKASI & MAPS ============ --}}
                        <div id="add-maps" class="add-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Lokasi & Google
                                Maps</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="addMapEmbed"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps
                                        Embed</label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Salin kode embed dari
                                        Google Maps</p>
                                    <textarea name="maps_embed" id="addMapEmbed" rows="3"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="<iframe src='https://www.google.com/maps/embed?...'></iframe>"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="add_map_embed_error"></span>
                                </div>

                                <div>
                                    <label for="addGoogleMapsUrl"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps
                                        URL</label>
                                    <input type="url" name="google_maps_url" id="addGoogleMapsUrl"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
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
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Thumbnail
                                    <span class="text-red-500">*</span></h4>
                                <div class="flex flex-col items-center">
                                    <div id="addThumbnailUploadArea"
                                        class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 border-gray-300 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                        <label for="addThumbnailUpload"
                                            class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Klik untuk upload</span> thumbnail
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP
                                                    (Maks. 1MB)</p>
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
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                        <div
                                            class="absolute inset-0 bg-green-500/10 border-2 border-green-500 rounded-lg pointer-events-none">
                                        </div>
                                        <div
                                            class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Terupload
                                        </div>
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="add_thumbnail_error"></span>
                                </div>
                            </div>

                            {{-- Galeri --}}
                            <div>
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Galeri Foto
                                    <span class="text-red-500">*</span></h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Upload minimal 2 dan maksimal
                                    10 foto</p>
                                <div id="addGalleryContainer"
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                </div>
                                <div id="addUploadGaleriContainer">
                                    <label id="addUploadGaleriBtn"
                                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#0194F3] text-white rounded-lg hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF]">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
                                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                                        </svg>
                                        Tambah Foto Galeri
                                        <input type="file" id="addGalleryUpload" name="gallery[]" accept="image/*"
                                            multiple class="hidden">
                                    </label>
                                    <span id="addGalleryCounter" class="ml-3 text-sm text-gray-500 dark:text-gray-400">0
                                        / 10 foto</span>
                                </div>
                                <p id="addGalleryError" class="mt-1 text-sm text-red-600 hidden">Minimal upload 2 foto
                                    galeri</p>
                                <span class="text-red-500 text-xs error-message" id="add_gallery_error"></span>
                            </div>

                            {{-- SEO --}}
                            <div class="mt-6 pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">SEO (Search
                                    Engine Optimization)</h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="addMetaTitle"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                            Title</label>
                                        <input type="text" name="meta_title" id="addMetaTitle"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                            placeholder="Meta Title">
                                        <span class="text-red-500 text-xs error-message"
                                            id="add_meta_title_error"></span>
                                    </div>

                                    <div>
                                        <label for="addMetaDescription"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                            Description</label>
                                        <textarea name="meta_description" id="addMetaDescription" rows="2"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
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
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Fasilitas</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Pilih fasilitas yang tersedia
                                </p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @if(isset($facilities) && $facilities->count())
                                        @foreach($facilities as $facility)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="facility_ids[]" value="{{ $facility->id }}"
                                                    class="rounded border-gray-300 text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700">
                                                <span
                                                    class="text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada
                                            fasilitas tersedia</p>
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="add_facility_ids_error"></span>
                            </div>

                            <div class="pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Aturan</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Pilih aturan yang berlaku</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @if(isset($rules) && $rules->count())
                                        @foreach($rules as $rule)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="rule_ids[]" value="{{ $rule->id }}"
                                                    class="rounded border-gray-300 text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700">
                                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $rule->name }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">Tidak ada aturan
                                            tersedia</p>
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="add_rule_ids_error"></span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="button" onclick="submitAddPenginapan()"
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Simpan Penginapan
                        </button>
                        <button type="button" onclick="closeAddPenginapanModal()"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let addGalleryPhotos = [];

    // ========== TAB FUNCTION ==========
    function switchAddTab(tabId) {
        document.querySelectorAll('.add-tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.remove('hidden');
        }

        // Reset semua tab ke state non-aktif
        document.querySelectorAll('#addPenginapanTab button').forEach(btn => {
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
        const activeBtn = document.querySelector(`#addPenginapanTab button[data-tab="${tabId}"]`);
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
    window.openAddPenginapanModal = function () {
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

        setTimeout(() => document.getElementById('addTitle').focus(), 100);
    };

    window.closeAddPenginapanModal = function () {
        document.getElementById('addPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // ========== SLUG GENERATOR ==========
    function generateSlugFromTitle() {
        const title = document.getElementById('addTitle').value.trim();
        const slugInput = document.getElementById('addSlug');

        if (!title) {
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Masukkan nama penginapan terlebih dahulu' });
            document.getElementById('addTitle').focus();
            return;
        }

        const slug = title.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
        slugInput.value = slug;

        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Slug telah digenerate', timer: 1500, showConfirmButton: false });
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('addThumbnailUpload');
        const uploadArea = document.getElementById('addThumbnailUploadArea');
        const previewContainer = document.getElementById('addThumbnailPreviewContainer');
        const preview = document.getElementById('addThumbnailPreview');
        const fileName = document.getElementById('addThumbnailFileName');
        const fileSize = document.getElementById('addThumbnailFileSize');

        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Ukuran file maksimal 5MB' });
                        this.value = '';
                        return;
                    }
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.' });
                        this.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        preview.src = event.target.result;
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                        fileName.textContent = file.name;
                        const sizeInKB = (file.size / 1024).toFixed(2);
                        fileSize.textContent = sizeInKB > 1024 ? (sizeInKB / 1024).toFixed(2) + ' MB' : sizeInKB + ' KB';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeAddThumbnail = function () {
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
        const maxPhotos = 10;
        counter.textContent = `${addGalleryPhotos.length} / ${maxPhotos} foto`;
        if (addGalleryPhotos.length >= maxPhotos) {
            uploadBtn.style.opacity = '0.5';
            uploadBtn.style.cursor = 'not-allowed';
            document.getElementById('addGalleryUpload').disabled = true;
        } else {
            uploadBtn.style.opacity = '1';
            uploadBtn.style.cursor = 'pointer';
            document.getElementById('addGalleryUpload').disabled = false;
        }
        if (addGalleryPhotos.length >= 2) {
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
                <div class="col-span-full text-center py-8 text-gray-400 dark:text-gray-500 border-2 border-dashed border-[#B3E0FF] dark:border-gray-600 rounded-lg">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Belum ada foto galeri</p>
                    <p class="text-xs">Minimal 2 foto</p>
                </div>
            `;
            return;
        }
        addGalleryPhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${photo.url}" alt="Galeri ${index + 1}" class="w-full h-32 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                <button type="button" onclick="removeAddGalleryPhoto(${index})" class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition-colors opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <span class="absolute bottom-2 left-2 bg-black/60 text-white text-xs px-2 py-1 rounded">${index + 1}</span>
            `;
            container.appendChild(div);
        });
    }

    function removeAddGalleryPhoto(index) {
        addGalleryPhotos.splice(index, 1);
        renderAddGallery();
        updateAddGalleryCounter();
        if (addGalleryPhotos.length < 2) {
            document.getElementById('addGalleryError').classList.remove('hidden');
        }
    }

    function addAddGalleryPhoto(file) {
        if (addGalleryPhotos.length >= 10) {
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Maksimal 10 foto galeri!' });
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Ukuran file maksimal 5MB' });
            return;
        }
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Format file harus JPG, JPEG, PNG, GIF atau WEBP.' });
            return;
        }
        const reader = new FileReader();
        reader.onload = function (event) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const targetWidth = 240;
                const targetHeight = 160;
                const imgRatio = img.width / img.height;
                const targetRatio = targetWidth / targetHeight;
                let cropWidth, cropHeight, offsetX = 0, offsetY = 0;
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
                addGalleryPhotos.push({ id: Date.now() + addGalleryPhotos.length, url: imageDataUrl, file: file });
                renderAddGallery();
                updateAddGalleryCounter();
                if (addGalleryPhotos.length >= 2) {
                    document.getElementById('addGalleryError').classList.add('hidden');
                }
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('addGalleryUpload');
        if (upload) {
            upload.addEventListener('change', function (e) {
                const files = e.target.files;
                for (let i = 0; i < files.length; i++) { addAddGalleryPhoto(files[i]); }
                this.value = '';
            });
        }

        const container = document.getElementById('addUploadGaleriContainer');
        if (container) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                container.addEventListener(eventName, function (e) { e.preventDefault(); e.stopPropagation(); });
            });
            container.addEventListener('dragover', function () { this.classList.add('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('dragleave', function () { this.classList.remove('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg'); });
            container.addEventListener('drop', function (e) {
                this.classList.remove('ring-4', 'ring-[#0194F3]', 'ring-offset-2', 'rounded-lg');
                const files = e.dataTransfer.files;
                for (let i = 0; i < files.length; i++) { addAddGalleryPhoto(files[i]); }
            });
        }

        const titleInput = document.getElementById('addTitle');
        const slugInput = document.getElementById('addSlug');
        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                if (slugInput.value === '') {
                    const slug = this.value.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }

        console.log('Modal Tambah Penginapan siap digunakan.');
    });

    // ========== SUBMIT FUNCTION ==========
    window.submitAddPenginapan = async function () {
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
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kategori wajib dipilih' });
            document.getElementById('addCategory').focus();
            return;
        }
        if (!title) {
            document.getElementById('add_title_error').textContent = 'Nama penginapan wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Nama penginapan wajib diisi' });
            document.getElementById('addTitle').focus();
            return;
        }
        if (!address) {
            document.getElementById('add_address_error').textContent = 'Alamat wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Alamat wajib diisi' });
            document.getElementById('addAddress').focus();
            return;
        }
        if (!price || Number(price) <= 0) {
            document.getElementById('add_price_error').textContent = 'Harga wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Harga wajib diisi' });
            document.getElementById('addPrice').focus();
            return;
        }
        if (!capacity || Number(capacity) <= 0) {
            document.getElementById('add_capacity_error').textContent = 'Kapasitas wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kapasitas wajib diisi' });
            document.getElementById('addCapacity').focus();
            return;
        }
        if (bedroom === '' || Number(bedroom) < 0) {
            document.getElementById('add_bedroom_error').textContent = 'Kamar tidur wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kamar tidur wajib diisi' });
            document.getElementById('addBedroom').focus();
            return;
        }
        if (bathroom === '' || Number(bathroom) < 0) {
            document.getElementById('add_bathroom_error').textContent = 'Kamar mandi wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kamar mandi wajib diisi' });
            document.getElementById('addBathroom').focus();
            return;
        }
        if (!status) {
            document.getElementById('add_status_error').textContent = 'Status wajib dipilih';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Status wajib dipilih' });
            document.getElementById('addStatus').focus();
            return;
        }
        if (!description) {
            document.getElementById('add_description_error').textContent = 'Deskripsi wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Deskripsi wajib diisi' });
            document.getElementById('addDescription').focus();
            return;
        }
        if (!thumbnail) {
            document.getElementById('add_thumbnail_error').textContent = 'Thumbnail wajib diupload';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Thumbnail wajib diupload' });
            return;
        }
        if (addGalleryPhotos.length < 2) {
            document.getElementById('addGalleryError').classList.remove('hidden');
            document.getElementById('add_gallery_error').textContent = 'Minimal upload 2 foto galeri';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Minimal upload 2 foto galeri' });
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
            didOpen: () => { Swal.showLoading(); }
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
                    const errorEl = document.getElementById('add_' + key + '_error');
                    if (errorEl) {
                        errorEl.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data.errors[key];
                    }
                });
                const firstError = Object.values(data.errors)[0];
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: Array.isArray(firstError) ? firstError[0] : firstError
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: data.message || 'Gagal menambahkan penginapan' });
            }
        } catch (error) {
            console.error('=== ERROR SUBMIT ===', error);
            Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan: ' + error.message });
        }
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('addPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeAddPenginapanModal();
            }
        }
    });

    document.querySelector('#addPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeAddPenginapanModal();
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
        background: #f1f1f1;
        border-radius: 3px;
    }

    #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark #addPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
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