<!-- Modal Edit Penginapan -->
<div id="editPenginapanModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditPenginapanModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="px-6 py-4 border-b border-[#B3E0FF] dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                        <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Penginapan
                    </h3>
                    <button type="button" onclick="closeEditPenginapanModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                <form id="editPenginapanForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <!-- Tab Navigation -->
                    <div class="border-b border-[#B3E0FF] dark:border-gray-700 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="editPenginapanTab"
                            role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 rounded-t-lg border-[#0194F3] text-[#0194F3] dark:border-[#33ADFF] dark:text-[#33ADFF]"
                                    data-tab="edit-utama" type="button" onclick="switchEditTab('edit-utama')">
                                    Informasi Utama
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="edit-kontak" type="button" onclick="switchEditTab('edit-kontak')">
                                    Kontak & Sosmed
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="edit-maps" type="button" onclick="switchEditTab('edit-maps')">
                                    Lokasi & Maps
                                </button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="edit-media" type="button" onclick="switchEditTab('edit-media')">
                                    Media & SEO
                                </button>
                            </li>
                            <li role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-gray-900 hover:border-gray-300 dark:text-gray-400 dark:hover:text-white dark:hover:border-gray-500"
                                    data-tab="edit-fasilitas" type="button" onclick="switchEditTab('edit-fasilitas')">
                                    Fasilitas & Aturan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="space-y-6">

                        {{-- ============ TAB 1: INFORMASI UTAMA ============ --}}
                        <div id="edit-utama" class="edit-tab-content">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Informasi
                                Penginapan</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="sm:col-span-2">
                                    <label for="editCategory"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="editCategory" name="category_id" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                        <option value="">Pilih Kategori</option>
                                        @if(isset($categories) && $categories->count())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_category_id_error"></span>
                                </div>

                                <div class="sm:col-span-2 lg:col-span-3">
                                    <label for="editTitle"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Nama Penginapan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="title" id="editTitle"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan nama penginapan" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_title_error"></span>
                                </div>

                                <div class="col-span-full">
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="editSlug"
                                            class="text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                                        <button type="button" onclick="generateEditSlugFromTitle()"
                                            class="text-xs text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#33ADFF] font-medium">
                                            Generate dari Nama
                                        </button>
                                    </div>
                                    <input type="text" name="slug" id="editSlug"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Kosongkan untuk auto-generate">
                                    <span class="text-red-500 text-xs error-message" id="edit_slug_error"></span>
                                </div>

                                <div class="col-span-full">
                                    <label for="editAddress"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Alamat <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="address" id="editAddress"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan alamat lengkap" required>
                                    <span class="text-red-500 text-xs error-message" id="edit_address_error"></span>
                                </div>

                                <div>
                                    <label for="editPrice"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Harga per Malam <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="price" id="editPrice"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="350000" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_price_error"></span>
                                </div>

                                <div>
                                    <label for="editCapacity"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Kapasitas (Orang) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="capacity" id="editCapacity"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="4" required min="1">
                                    <span class="text-red-500 text-xs error-message" id="edit_capacity_error"></span>
                                </div>

                                <div>
                                    <label for="editBedroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Kamar Tidur <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="bedroom" id="editBedroom"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="2" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_bedroom_error"></span>
                                </div>

                                <div>
                                    <label for="editBathroom"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Kamar Mandi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="bathroom" id="editBathroom"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="1" required min="0">
                                    <span class="text-red-500 text-xs error-message" id="edit_bathroom_error"></span>
                                </div>

                                <div>
                                    <label for="editSize"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran
                                        (m²)</label>
                                    <input type="text" name="size" id="editSize"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="45">
                                    <span class="text-red-500 text-xs error-message" id="edit_size_error"></span>
                                </div>

                                <div>
                                    <label for="editStatus"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="editStatus" name="status" required
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]">
                                        <option value="">Pilih Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Full">Full</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                    <span class="text-red-500 text-xs error-message" id="edit_status_error"></span>
                                </div>

                                <div class="col-span-full">
                                    <label for="editDescription"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="description" id="editDescription" rows="3"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Masukkan deskripsi lengkap" required></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_description_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 2: KONTAK & SOSMED ============ --}}
                        <div id="edit-kontak" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-2">Kontak & Sosial
                                Media</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                Semua field di bawah ini <strong>opsional</strong> — boleh dikosongi.
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                {{-- Telepon --}}
                                <div>
                                    <label for="editPhone"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                        Telepon</label>
                                    <input type="text" name="phone" id="editPhone"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="(021) 1234-5678">
                                    <span class="text-red-500 text-xs error-message" id="edit_phone_error"></span>
                                </div>

                                {{-- WhatsApp --}}
                                <div>
                                    <label for="editWhatsapp"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                        WhatsApp</label>
                                    <input type="text" name="whatsapp" id="editWhatsapp"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="0812-3456-7890">
                                    <span class="text-red-500 text-xs error-message" id="edit_whatsapp_error"></span>
                                </div>

                                {{-- Email --}}
                                <div class="sm:col-span-2">
                                    <label for="editEmail"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="editEmail"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="info@adakamar.id">
                                    <span class="text-red-500 text-xs error-message" id="edit_email_error"></span>
                                </div>

                                {{-- Facebook --}}
                                <div>
                                    <label for="editFacebook"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook</label>
                                    <input type="text" name="facebook" id="editFacebook"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="facebook.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="edit_facebook_error"></span>
                                </div>

                                {{-- Instagram --}}
                                <div>
                                    <label for="editInstagram"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram</label>
                                    <input type="text" name="instagram" id="editInstagram"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="instagram.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="edit_instagram_error"></span>
                                </div>

                                {{-- YouTube --}}
                                <div>
                                    <label for="editYoutube"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">YouTube</label>
                                    <input type="text" name="youtube" id="editYoutube"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="youtube.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="edit_youtube_error"></span>
                                </div>

                                {{-- X (Twitter) --}}
                                <div>
                                    <label for="editX"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">X
                                        (Twitter)</label>
                                    <input type="text" name="x" id="editX"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="x.com/adakamar">
                                    <span class="text-red-500 text-xs error-message" id="edit_x_error"></span>
                                </div>

                                {{-- TikTok --}}
                                <div class="sm:col-span-2">
                                    <label for="editTiktok"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TikTok</label>
                                    <input type="text" name="tiktok" id="editTiktok"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="tiktok.com/@adakamar">
                                    <span class="text-red-500 text-xs error-message" id="edit_tiktok_error"></span>
                                </div>


                            </div>
                        </div>

                        {{-- ============ TAB 3: LOKASI & MAPS ============ --}}
                        <div id="edit-maps" class="edit-tab-content hidden">
                            <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Lokasi & Google
                                Maps</h4>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label for="editMapEmbed"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps
                                        Embed</label>
                                    <textarea name="maps_embed" id="editMapEmbed" rows="4"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="<iframe src='https://www.google.com/maps/embed?...'></iframe>"></textarea>
                                    <span class="text-red-500 text-xs error-message" id="edit_maps_embed_error"></span>
                                </div>

                                <div>
                                    <label for="editGoogleMapsUrl"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps
                                        URL</label>
                                    <input type="url" name="google_maps_url" id="editGoogleMapsUrl"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="https://maps.google.com/...">
                                    <span class="text-red-500 text-xs error-message"
                                        id="edit_google_maps_url_error"></span>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 4: MEDIA & SEO ============ --}}
                        <div id="edit-media" class="edit-tab-content hidden">
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Thumbnail</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Kosongkan jika tidak ingin
                                    mengganti thumbnail</p>
                                <div class="flex flex-col items-center">
                                    <div id="editThumbnailUploadArea"
                                        class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 border-gray-300 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors">
                                        <label for="editThumbnailUpload"
                                            class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Klik untuk upload</span> thumbnail baru
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP
                                                    (Maks. 5MB)</p>
                                            </div>
                                            <input type="file" id="editThumbnailUpload" name="thumbnail"
                                                accept="image/*" class="hidden">
                                        </label>
                                    </div>

                                    <div id="editThumbnailPreviewContainer" class="hidden relative w-full">
                                        <img id="editThumbnailPreview" src="#" alt="Preview Thumbnail"
                                            class="w-full h-48 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                                        <button type="button" onclick="removeEditThumbnail()"
                                            class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-700 transition-colors shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="text-red-500 text-xs error-message" id="edit_thumbnail_error"></span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Galeri Foto
                                </h4>
                                <div id="editGalleryContainer"
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                                </div>
                                <div id="editUploadGaleriContainer">
                                    <label id="editUploadGaleriBtn"
                                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-[#0194F3] text-white rounded-lg hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF]">
                                        Tambah Foto Galeri
                                        <input type="file" id="editGalleryUpload" name="gallery[]" accept="image/*"
                                            multiple class="hidden">
                                    </label>
                                    <span id="editGalleryCounter"
                                        class="ml-3 text-sm text-gray-500 dark:text-gray-400">0 / 10 foto</span>
                                </div>
                                <span class="text-red-500 text-xs error-message" id="edit_gallery_error"></span>
                            </div>

                            <div class="pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">SEO (Search
                                    Engine Optimization)</h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="editMetaTitle"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                            Title</label>
                                        <input type="text" name="meta_title" id="editMetaTitle"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                            placeholder="Meta Title">
                                        <span class="text-red-500 text-xs error-message"
                                            id="edit_meta_title_error"></span>
                                    </div>

                                    <div>
                                        <label for="editMetaDescription"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta
                                            Description</label>
                                        <textarea name="meta_description" id="editMetaDescription" rows="2"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                            placeholder="Meta Description"></textarea>
                                        <span class="text-red-500 text-xs error-message"
                                            id="edit_meta_description_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ============ TAB 5: FASILITAS & ATURAN ============ --}}
                        <div id="edit-fasilitas" class="edit-tab-content hidden">
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Fasilitas</h4>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @if(isset($facilities) && $facilities->count())
                                        @foreach($facilities as $facility)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="facility_ids[]" value="{{ $facility->id }}"
                                                    class="edit-facility-checkbox rounded border-gray-300 text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700">
                                                <span
                                                    class="text-sm text-gray-700 dark:text-gray-300">{{ $facility->name }}</span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="edit_facility_ids_error"></span>
                            </div>

                            <div class="pt-6 border-t border-[#B3E0FF] dark:border-gray-700">
                                <h4 class="text-lg font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-4">Aturan</h4>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @if(isset($rules) && $rules->count())
                                        @foreach($rules as $rule)
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="rule_ids[]" value="{{ $rule->id }}"
                                                    class="edit-rule-checkbox rounded border-gray-300 text-[#0194F3] focus:ring-[#0194F3] dark:border-gray-600 dark:bg-gray-700">
                                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $rule->name }}</span>
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <span class="text-red-500 text-xs error-message" id="edit_rule_ids_error"></span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700">
                        <button type="button" onclick="submitEditPenginapan()"
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] w-full sm:w-auto">
                            Update Penginapan
                        </button>
                        <button type="button" onclick="closeEditPenginapanModal()"
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
    let editGalleryPhotos = [];
    let editExistingGallery = [];
    const maxEditGalleryPhotos = 10;
    let editAccommodationId = null;
    let isThumbnailChanged = false;

    // ========== TAB FUNCTION ==========
    function switchEditTab(tabId) {
        document.querySelectorAll('.edit-tab-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId)?.classList.remove('hidden');

        // Reset semua tab ke state non-aktif
        document.querySelectorAll('#editPenginapanTab button').forEach(btn => {
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
        const activeBtn = document.querySelector(`#editPenginapanTab button[data-tab="${tabId}"]`);
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
    function openEditPenginapanModal(id) {
        editAccommodationId = id;
        isThumbnailChanged = false;

        Swal.fire({
            title: 'Memuat data...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const url = '{{ route('accommodations.show', ':id') }}'.replace(':id', id);

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
                Swal.close();

                if (data.success) {
                    const acc = data.data;

                    // Informasi Utama
                    document.getElementById('editId').value = acc.id;
                    document.getElementById('editCategory').value = acc.category_id || '';
                    document.getElementById('editTitle').value = acc.title || '';
                    document.getElementById('editSlug').value = acc.slug || '';
                    document.getElementById('editAddress').value = acc.address || '';
                    document.getElementById('editPrice').value = acc.price || '';
                    document.getElementById('editCapacity').value = acc.capacity || '';
                    document.getElementById('editBedroom').value = acc.bedroom || '';
                    document.getElementById('editBathroom').value = acc.bathroom || '';
                    document.getElementById('editSize').value = acc.size || '';
                    document.getElementById('editStatus').value = acc.status || '';
                    document.getElementById('editDescription').value = acc.description || '';

                    // Kontak & Sosmed
                    document.getElementById('editPhone').value = acc.phone || '';
                    document.getElementById('editWhatsapp').value = acc.whatsapp || '';
                    document.getElementById('editEmail').value = acc.email || '';
                    document.getElementById('editFacebook').value = acc.facebook || '';
                    document.getElementById('editInstagram').value = acc.instagram || '';
                    document.getElementById('editYoutube').value = acc.youtube || '';
                    document.getElementById('editX').value = acc.x || '';
                    document.getElementById('editTiktok').value = acc.tiktok || '';

                    // Maps & SEO
                    document.getElementById('editMapEmbed').value = acc.maps_embed || '';
                    document.getElementById('editGoogleMapsUrl').value = acc.google_maps_url || '';
                    document.getElementById('editMetaTitle').value = acc.meta_title || '';
                    document.getElementById('editMetaDescription').value = acc.meta_description || '';

                    // Thumbnail
                    const uploadArea = document.getElementById('editThumbnailUploadArea');
                    const previewContainer = document.getElementById('editThumbnailPreviewContainer');
                    const preview = document.getElementById('editThumbnailPreview');

                    if (acc.thumbnail) {
                        preview.src = '{{ asset('') }}' + acc.thumbnail.replace(/^public\//, '');
                        uploadArea.classList.add('hidden');
                        previewContainer.classList.remove('hidden');
                    } else {
                        uploadArea.classList.remove('hidden');
                        previewContainer.classList.add('hidden');
                    }

                    // Facilities
                    document.querySelectorAll('.edit-facility-checkbox').forEach(cb => cb.checked = false);
                    const facilityIds = acc.facility_ids || (acc.facilities ? acc.facilities.map(f => f.id) : []);
                    document.querySelectorAll('.edit-facility-checkbox').forEach(cb => {
                        if (facilityIds.includes(parseInt(cb.value))) cb.checked = true;
                    });

                    // Rules
                    document.querySelectorAll('.edit-rule-checkbox').forEach(cb => cb.checked = false);
                    const ruleIds = acc.rule_ids || (acc.rules ? acc.rules.map(r => r.id) : []);
                    document.querySelectorAll('.edit-rule-checkbox').forEach(cb => {
                        if (ruleIds.includes(parseInt(cb.value))) cb.checked = true;
                    });

                    // Gallery
                    editExistingGallery = [];
                    if (acc.images && acc.images.length > 0) {
                        editExistingGallery = acc.images.map(g => ({
                            id: g.id,
                            image: g.image,
                            image_url: g.image ? '{{ asset('') }}' + g.image.replace(/^public\//, '') : null
                        }));
                    }

                    editGalleryPhotos = [];
                    renderEditGallery();
                    updateEditGalleryCounter();

                    document.querySelectorAll('#editPenginapanForm .error-message').forEach(el => el.textContent = '');

                    switchEditTab('edit-utama');

                    document.getElementById('editPenginapanModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal!', text: data.message || 'Gagal memuat data' });
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan: ' + error.message });
            });
    }

    function closeEditPenginapanModal() {
        document.getElementById('editPenginapanModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        editGalleryPhotos = [];
        editExistingGallery = [];
        renderEditGallery();
        updateEditGalleryCounter();
    }

    // ========== SLUG GENERATOR ==========
    function generateEditSlugFromTitle() {
        const title = document.getElementById('editTitle').value.trim();
        if (!title) {
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Masukkan nama penginapan terlebih dahulu' });
            return;
        }
        const slug = title.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
        document.getElementById('editSlug').value = slug;
        Swal.fire({ icon: 'success', title: 'Berhasil!', timer: 1500, showConfirmButton: false });
    }

    // ========== THUMBNAIL ==========
    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editThumbnailUpload');
        if (upload) {
            upload.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Ukuran file maksimal 5MB' });
                        this.value = '';
                        return;
                    }
                    isThumbnailChanged = true;
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        document.getElementById('editThumbnailPreview').src = event.target.result;
                        document.getElementById('editThumbnailUploadArea').classList.add('hidden');
                        document.getElementById('editThumbnailPreviewContainer').classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        window.removeEditThumbnail = function () {
            document.getElementById('editThumbnailUpload').value = '';
            document.getElementById('editThumbnailUploadArea').classList.remove('hidden');
            document.getElementById('editThumbnailPreviewContainer').classList.add('hidden');
            isThumbnailChanged = true;
        };
    });

    // ========== GALLERY ==========
    function updateEditGalleryCounter() {
        const total = editExistingGallery.length + editGalleryPhotos.length;
        document.getElementById('editGalleryCounter').textContent = `${total} / ${maxEditGalleryPhotos} foto`;
    }

    function renderEditGallery() {
        const container = document.getElementById('editGalleryContainer');
        container.innerHTML = '';

        const allPhotos = [
            ...editExistingGallery.map(p => ({ ...p, isExisting: true })),
            ...editGalleryPhotos.map(p => ({ id: 'new', url: p.url, isExisting: false }))
        ];

        if (allPhotos.length === 0) {
            container.innerHTML = `<div class="col-span-full text-center py-8 text-gray-400 dark:text-gray-500 border-2 border-dashed border-[#B3E0FF] dark:border-gray-600 rounded-lg">
                <p>Belum ada foto galeri</p>
            </div>`;
            return;
        }

        allPhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${photo.image_url || photo.url}" class="w-full h-32 object-cover rounded-lg border-2 border-[#B3E0FF] dark:border-gray-600">
                <button type="button" onclick="removeEditGalleryPhoto(${index})"
                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                ${photo.isExisting ? '<span class="absolute bottom-2 left-2 bg-green-600/80 text-white text-xs px-2 py-1 rounded">Existing</span>' : ''}
            `;
            container.appendChild(div);
        });
    }

    function removeEditGalleryPhoto(index) {
        const totalExisting = editExistingGallery.length;
        if (index < totalExisting) {
            editExistingGallery.splice(index, 1);
        } else {
            editGalleryPhotos.splice(index - totalExisting, 1);
        }
        renderEditGallery();
        updateEditGalleryCounter();
    }

    function addEditGalleryPhoto(file) {
        if (editExistingGallery.length + editGalleryPhotos.length >= maxEditGalleryPhotos) {
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Maksimal 10 foto!' });
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            Swal.fire({ icon: 'error', title: 'Gagal!', text: 'Ukuran file maksimal 5MB' });
            return;
        }
        const reader = new FileReader();
        reader.onload = function (event) {
            editGalleryPhotos.push({ url: event.target.result, file: file });
            renderEditGallery();
            updateEditGalleryCounter();
        };
        reader.readAsDataURL(file);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const upload = document.getElementById('editGalleryUpload');
        if (upload) {
            upload.addEventListener('change', function (e) {
                for (let file of e.target.files) addEditGalleryPhoto(file);
                this.value = '';
            });
        }
    });

    // ========== SUBMIT ==========
    window.submitEditPenginapan = async function () {
        document.querySelectorAll('#editPenginapanForm .error-message').forEach(el => el.textContent = '');

        const category = document.getElementById('editCategory').value;
        const title = document.getElementById('editTitle').value.trim();
        const address = document.getElementById('editAddress').value.trim();
        const price = document.getElementById('editPrice').value;

        if (!category) {
            document.getElementById('edit_category_id_error').textContent = 'Kategori wajib dipilih';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Kategori wajib dipilih' });
            return;
        }
        if (!title) {
            document.getElementById('edit_title_error').textContent = 'Nama penginapan wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Nama penginapan wajib diisi' });
            return;
        }
        if (!address) {
            document.getElementById('edit_address_error').textContent = 'Alamat wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Alamat wajib diisi' });
            return;
        }
        if (!price || Number(price) <= 0) {
            document.getElementById('edit_price_error').textContent = 'Harga wajib diisi';
            Swal.fire({ icon: 'warning', title: 'Peringatan!', text: 'Harga wajib diisi' });
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const id = document.getElementById('editId').value;
        const form = document.getElementById('editPenginapanForm');
        const formData = new FormData(form);

        formData.delete('gallery[]');
        editExistingGallery.forEach(p => formData.append('existing_gallery_ids[]', p.id));
        editGalleryPhotos.forEach(p => { if (p.file) formData.append('gallery[]', p.file); });

        Swal.fire({ title: 'Mengupdate...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        try {
            const url = '{{ route('accommodations.update', ':id') }}'.replace(':id', id);

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Penginapan berhasil diupdate!', timer: 2000, showConfirmButton: false })
                    .then(() => { closeEditPenginapanModal(); location.reload(); });
            } else if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const el = document.getElementById('edit_' + key + '_error');
                    if (el) el.textContent = Array.isArray(data.errors[key]) ? data.errors[key][0] : data.errors[key];
                });
                const firstError = Object.values(data.errors)[0];
                Swal.fire({ icon: 'error', title: 'Validasi Gagal!', text: Array.isArray(firstError) ? firstError[0] : firstError });
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: data.message || 'Gagal mengupdate' });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan: ' + error.message });
        }
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('editPenginapanModal');
            if (modal && !modal.classList.contains('hidden')) closeEditPenginapanModal();
        }
    });

    document.querySelector('#editPenginapanModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeEditPenginapanModal();
    });
</script>

<style>
    #editPenginapanModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editPenginapanModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editPenginapanModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar {
        width: 6px;
    }

    #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #0194F3;
        border-radius: 3px;
    }

    .dark #editPenginapanModal .max-h-\[70vh\]::-webkit-scrollbar-thumb {
        background: #33ADFF;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }
</style>