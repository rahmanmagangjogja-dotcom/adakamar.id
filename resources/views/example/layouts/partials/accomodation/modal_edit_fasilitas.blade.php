<!-- Modal Edit Fasilitas -->
<div id="editFasilitasModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeEditFasilitasModal()"></div>

        <div
            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] rounded-xl shadow-2xl dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

            {{-- ===== HEADER MODAL — GRADIENT ===== --}}
            <div class="relative overflow-hidden px-6 py-4 bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2]">
                {{-- Pattern dots subtle --}}
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
                </div>
                {{-- Blob dekoratif --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/20 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                        <i data-lucide="pencil-line" class="w-6 h-6"></i>
                        Edit Fasilitas
                    </h3>
                    <button type="button" onclick="closeEditFasilitasModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="#" method="POST" id="editFasilitasForm">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <input type="hidden" name="edit_id" id="editFasilitasId">

                        <!-- Nama Fasilitas -->
                        <div>
                            <label for="editNamaFasilitas"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Nama Fasilitas
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="editNamaFasilitas"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan nama fasilitas" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ===== ICON FASILITAS (Lucide) ===== -->
                        <div>
                            <label for="editIconFasilitas"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Icon Fasilitas
                                <span class="text-red-500">*</span></label>

                            <div class="flex items-stretch gap-2">
                                {{-- Input icon --}}
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i data-lucide="shapes"
                                            class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                    </div>
                                    <input type="text" name="icon" id="editIconFasilitas"
                                        class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full pl-10 p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                        placeholder="contoh: wifi, waves, utensils" required
                                        oninput="updateEditIconPreview(this.value)">
                                </div>

                                {{-- Preview icon live --}}
                                <div
                                    class="inline-flex items-center justify-center w-11 h-11 rounded-lg
                                           bg-gradient-to-br from-[#E6F4FF] to-[#F0F9FF]
                                           dark:from-gray-700 dark:to-gray-700
                                           border border-[#B3E0FF] dark:border-gray-600 shadow-sm flex-shrink-0"
                                    id="editIconPreviewWrap" title="Preview icon">
                                    <span id="editIconPreview" class="inline-flex">
                                        <i data-lucide="minus" class="w-5 h-5 text-gray-400 dark:text-gray-500"></i>
                                    </span>
                                </div>
                            </div>

                            <p class="mt-1 text-xs text-[#687176] dark:text-gray-400">
                                Masukkan nama icon dari
                                <a href="https://lucide.dev/icons" target="_blank" rel="noopener"
                                    class="text-[#0194F3] hover:underline font-semibold dark:text-[#33ADFF]">
                                    lucide.dev/icons
                                </a>
                                (mis. <code>wifi</code>, <code>waves</code>, <code>utensils</code>).
                            </p>

                            {{-- Quick picks Lucide --}}
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                @foreach ([
        'wifi' => 'WiFi',
        'waves' => 'Kolam',
        'utensils' => 'Restoran',
        'car' => 'Parkir',
        'snowflake' => 'AC',
        'tv' => 'TV',
        'washing-machine' => 'Laundry',
        'dumbbell' => 'Gym',
        'square-parking' => 'Parkir',
        'bath' => 'Kamar Mandi',
    ] as $key => $label)
                                    <button type="button" onclick="pickEditIcon('{{ $key }}')"
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-white dark:bg-gray-700
                                               border border-[#B3E0FF] dark:border-gray-600
                                               hover:bg-[#E6F4FF] dark:hover:bg-gray-600 text-xs transition-all"
                                        title="{{ $label }}">
                                        <i data-lucide="{{ $key }}"
                                            class="w-4 h-4 text-[#0194F3] dark:text-[#33ADFF]"></i>
                                        <span class="text-[#0F294D] dark:text-gray-300">{{ $label }}</span>
                                    </button>
                                @endforeach
                            </div>

                            @error('icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="editDeskripsiFasilitas"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Deskripsi</label>
                            <textarea name="description" id="editDeskripsiFasilitas" rows="3"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan deskripsi fasilitas"></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ===== FOOTER — GRADIENT ===== --}}
                    <div
                        class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-6 pt-4 border-t border-[#B3E0FF] dark:border-gray-700 bg-gradient-to-r from-transparent via-[#F7F9FC]/50 to-transparent dark:via-gray-800/50 -mx-6 px-6 pb-2">
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 w-full sm:w-auto transition-all duration-200">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditFasilitasModal()"
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
    // ===== CLOSE =====
    function closeEditFasilitasModal() {
        document.getElementById('editFasilitasModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ===== ICON PREVIEW (Lucide) =====
    function updateEditIconPreview(value) {
        const preview = document.getElementById('editIconPreview');
        if (!preview) return;

        value = (value || '').trim();

        if (!value) {
            preview.innerHTML = '<i data-lucide="minus" class="w-5 h-5 text-gray-400 dark:text-gray-500"></i>';
        } else {
            // Deteksi fallback format lama (SVG path / emoji)
            const isSvg = /^[Mm]/.test(value) || value.startsWith('<');
            const isEmoji = !isSvg && !/^[a-z0-9-]+$/i.test(value);

            if (isSvg) {
                let pathData = value;
                const match = value.match(/d="([^"]+)"/);
                if (match) pathData = match[1];

                preview.innerHTML = `
                    <svg class="w-5 h-5 text-[#0194F3] dark:text-[#33ADFF]" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              stroke-width="2" d="${pathData}"/>
                    </svg>`;
            } else if (isEmoji) {
                preview.innerHTML = `<span class="text-lg">${value}</span>`;
            } else {
                preview.innerHTML =
                    `<i data-lucide="${value}" class="w-5 h-5 text-[#0194F3] dark:text-[#33ADFF]"></i>`;
            }
        }

        // Render ulang Lucide
        if (window.renderLucide) {
            window.renderLucide();
        } else if (window.lucide) {
            lucide.createIcons();
        }
    }

    // ===== QUICK PICK LUCIDE =====
    function pickEditIcon(name) {
        const input = document.getElementById('editIconFasilitas');
        if (!input) return;
        input.value = name;
        updateEditIconPreview(name);
        input.focus();
    }

    // ===== CLOSE ON ESC =====
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditFasilitasModal();
        }
    });

    // ===== CLOSE ON CLICK OUTSIDE =====
    document.querySelector('#editFasilitasModal .fixed.inset-0')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditFasilitasModal();
        }
    });

    // Render Lucide saat halaman pertama load
    document.addEventListener('DOMContentLoaded', function() {
        if (window.renderLucide) {
            window.renderLucide();
        } else if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>

<style>
    #editFasilitasModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editFasilitasModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editFasilitasModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
</style>