<!-- Modal Tambah Fasilitas -->
<div id="addFasilitasModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-90"
            onclick="closeAddFasilitasModal()"></div>

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
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                            <path
                                d="M8 6a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1zM8 10a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                        </svg>
                        Tambah Fasilitas Baru
                    </h3>
                    <button type="button" onclick="closeAddFasilitasModal()"
                        class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('facilities.store') }}" method="POST" id="addFasilitasForm">
                    @csrf
                    <div class="space-y-4">
                        <!-- Nama Fasilitas -->
                        <div>
                            <label for="addNamaFasilitas"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Nama Fasilitas
                                <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="addNamaFasilitas"
                                class="shadow-sm bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Masukkan nama fasilitas" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="addDeskripsiFasilitas"
                                class="block mb-2 text-sm font-medium text-[#0F294D] dark:text-white">Deskripsi</label>
                            <textarea name="description" id="addDeskripsiFasilitas" rows="3"
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
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md shadow-[#0194F3]/30 w-full sm:w-auto transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Fasilitas
                        </button>
                        <button type="button" onclick="closeAddFasilitasModal()"
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
    function openAddFasilitasModal() {
        document.getElementById('addFasilitasModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('addFasilitasForm').reset();
        document.getElementById('addNamaFasilitas').classList.remove('border-red-500');
        setTimeout(() => {
            document.getElementById('addNamaFasilitas').focus();
        }, 100);
    }

    function closeAddFasilitasModal() {
        document.getElementById('addFasilitasModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAddFasilitasModal();
    });

    document.querySelector('#addFasilitasModal .fixed.inset-0')?.addEventListener('click', function (e) {
        if (e.target === this) closeAddFasilitasModal();
    });
</script>

<style>
    #addFasilitasModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #addFasilitasModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #addFasilitasModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }
</style>