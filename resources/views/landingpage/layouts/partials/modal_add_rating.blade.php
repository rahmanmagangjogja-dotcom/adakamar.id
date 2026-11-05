{{-- ============================================================
     MODAL TAMBAH RATING / ULASAN
     Model: App\Models\AccommodationRating
     Fields: accommodation_id, nama, email, bintang, keterangan
     ============================================================ --}}

<div id="ratingModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300">

    <div class="relative w-full max-w-lg max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300"
        id="ratingModalContent">

        {{-- ===================== HEADER ===================== --}}
        <div class="relative bg-gradient-to-br from-[#0194F3] via-[#0064D2] to-[#0F294D] p-5 overflow-hidden flex-shrink-0">
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
            </div>
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative flex items-start justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div
                        class="w-11 h-11 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0 border border-white/30">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-bold text-white truncate">
                            Tulis Ulasan
                        </h3>
                        <p class="text-xs text-white/80 truncate">
                            {{ $accommodation->title ?? 'Penginapan' }}
                        </p>
                    </div>
                </div>

                <button type="button" id="closeRatingModal" aria-label="Tutup"
                    class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white flex items-center justify-center flex-shrink-0 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ===================== FORM ===================== --}}
        {{-- PERBAIKAN: selalu kirim slug (bukan fallback ID), karena route pakai {slug} --}}
        <form action="{{ route('accommodationlanding.rating.store', ['slug' => $accommodation->slug]) }}"
            method="POST" class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-5">
            @csrf

            <input type="hidden" name="accommodation_id" value="{{ $accommodation->id }}">

            {{-- Alert error --}}
            @if($errors->any())
                <div
                    class="p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-xs text-red-700 dark:text-red-300">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert success --}}
            @if(session('rating_success'))
                <div
                    class="p-3 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/40 text-xs text-green-700 dark:text-green-300 flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('rating_success') }}
                </div>
            @endif

            {{-- ===================== RATING BINTANG ===================== --}}
            <div>
                <label class="block text-sm font-bold text-[#0F294D] dark:text-white mb-2">
                    Rating <span class="text-red-500">*</span>
                </label>

                <div
                    class="flex items-center justify-center gap-2 py-3 bg-gradient-to-br from-[#E6F4FF] to-white dark:from-[#0194F3]/10 dark:to-gray-800 rounded-xl border border-[#0194F3]/15">

                    @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer star-label" for="star-{{ $i }}" data-star="{{ $i }}">
                            <input type="radio" id="star-{{ $i }}" name="bintang" value="{{ $i }}"
                                class="sr-only star-input" {{ old('bintang') == $i ? 'checked' : '' }}
                                {{ $i == 1 ? 'required' : '' }} />

                            <svg class="w-10 h-10 sm:w-12 sm:h-12 transition-all duration-200 star-svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </label>
                    @endfor
                </div>

                <p id="ratingHint"
                    class="text-center text-xs font-semibold text-[#687176] dark:text-gray-400 mt-2 h-4">
                    {{ old('bintang') ? ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'][old('bintang')] : 'Pilih rating Anda' }}
                </p>

                @error('bintang')
                    <p class="text-xs text-red-500 text-center mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== NAMA ===================== --}}
            <div>
                <label for="rating-nama" class="block text-sm font-bold text-[#0F294D] dark:text-white mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="rating-nama" name="nama" value="{{ old('nama') }}"
                        placeholder="Masukkan nama Anda" required maxlength="100" autocomplete="name"
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[#0194F3]/20 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-[#687176] dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0194F3] focus:border-transparent transition-all" />
                </div>
                @error('nama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== EMAIL ===================== --}}
            <div>
                <label for="rating-email" class="block text-sm font-bold text-[#0F294D] dark:text-white mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-[#0194F3]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input type="email" id="rating-email" name="email" value="{{ old('email') }}"
                        placeholder="email@contoh.com" required maxlength="150" autocomplete="email"
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-[#0194F3]/20 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-[#687176] dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0194F3] focus:border-transparent transition-all" />
                </div>
                <p class="text-[10px] text-[#687176] dark:text-gray-400 mt-1">
                    Email tidak akan dipublikasikan.
                </p>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== KETERANGAN / ULASAN ===================== --}}
            <div>
                <label for="rating-keterangan" class="block text-sm font-bold text-[#0F294D] dark:text-white mb-2">
                    Ulasan <span class="text-red-500">*</span>
                </label>
                <textarea id="rating-keterangan" name="keterangan" rows="4" required minlength="10" maxlength="1000"
                    placeholder="Ceritakan pengalaman Anda menginap di sini..."
                    class="w-full px-4 py-2.5 rounded-xl border border-[#0194F3]/20 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-[#687176] dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0194F3] focus:border-transparent transition-all resize-none">{{ old('keterangan') }}</textarea>
                <div class="flex items-center justify-between mt-1">
                    <p class="text-[10px] text-[#687176] dark:text-gray-400">
                        Minimal 10 karakter.
                    </p>
                    <p class="text-[10px] text-[#687176] dark:text-gray-400">
                        <span id="charCount">0</span>/1000
                    </p>
                </div>
                @error('keterangan')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== ACTIONS ===================== --}}
            <div class="flex flex-col sm:flex-row gap-2 pt-2">
                <button type="button" id="cancelRatingModal"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-[#0194F3]/30 text-[#0194F3] dark:text-[#33ADFF] font-semibold text-sm hover:bg-[#E6F4FF] dark:hover:bg-[#0194F3]/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white font-semibold text-sm shadow-md hover:shadow-lg hover:scale-[1.02] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ============ RATING STARS INTERAKTIF ============ */
    #ratingModal .star-svg {
        color: #D1D5DB;
    }

    .dark #ratingModal .star-svg {
        color: #4B5563;
    }

    #ratingModal .star-label.preview .star-svg,
    #ratingModal .star-label.selected .star-svg {
        color: #FFD700;
        filter: drop-shadow(0 2px 4px rgba(255, 215, 0, 0.4));
        transform: scale(1.08);
    }

    /* Scrollbar halus untuk form */
    #ratingModal form::-webkit-scrollbar {
        width: 6px;
    }

    #ratingModal form::-webkit-scrollbar-track {
        background: transparent;
    }

    #ratingModal form::-webkit-scrollbar-thumb {
        background: rgba(1, 148, 243, 0.4);
        border-radius: 3px;
    }

    #ratingModal form::-webkit-scrollbar-thumb:hover {
        background: rgba(1, 148, 243, 0.7);
    }
</style>

<script>
    (function () {
        function init() {
            const modal = document.getElementById('ratingModal');
            if (!modal) return;

            /* ============================================================
             * PINDAHKAN MODAL KE <body> agar tidak ter-clip / ketutup
             * oleh stacking context section/card di halaman detail.
             * ============================================================ */
            if (modal.parentNode !== document.body) {
                document.body.appendChild(modal);
            }

            // ===================== STAR RATING INTERAKTIF =====================
            const starLabels = modal.querySelectorAll('.star-label');
            const ratingHint = document.getElementById('ratingHint');
            const hintTexts = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'];

            function updateStars(value) {
                starLabels.forEach((label) => {
                    const starNum = parseInt(label.dataset.star, 10);
                    label.classList.remove('selected');
                    if (starNum <= value) {
                        label.classList.add('selected');
                    }
                });
                if (ratingHint) {
                    ratingHint.textContent = value > 0 ? hintTexts[value] : 'Pilih rating Anda';
                }
            }

            starLabels.forEach((label) => {
                const starNum = parseInt(label.dataset.star, 10);

                label.addEventListener('mouseenter', function () {
                    starLabels.forEach((l) => {
                        const n = parseInt(l.dataset.star, 10);
                        l.classList.remove('preview');
                        if (n <= starNum) l.classList.add('preview');
                    });
                    if (ratingHint) ratingHint.textContent = hintTexts[starNum];
                });

                label.addEventListener('mouseleave', function () {
                    starLabels.forEach((l) => l.classList.remove('preview'));
                    const checked = modal.querySelector('.star-input:checked');
                    const value = checked ? parseInt(checked.value, 10) : 0;
                    if (ratingHint) {
                        ratingHint.textContent = value > 0 ? hintTexts[value] : 'Pilih rating Anda';
                    }
                });

                label.addEventListener('click', function () {
                    updateStars(starNum);
                });
            });

            const initialChecked = modal.querySelector('.star-input:checked');
            if (initialChecked) {
                updateStars(parseInt(initialChecked.value, 10));
            }

            // ===================== CHAR COUNTER =====================
            const textarea = document.getElementById('rating-keterangan');
            const charCount = document.getElementById('charCount');
            if (textarea && charCount) {
                function updateCount() {
                    charCount.textContent = textarea.value.length;
                }
                textarea.addEventListener('input', updateCount);
                updateCount();
            }

            // ===================== CLOSE BUTTONS =====================
            const closeBtn = document.getElementById('closeRatingModal');
            const cancelBtn = document.getElementById('cancelRatingModal');

            function closeModal() {
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.style.overflow = '';
                }, 200);
            }

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>