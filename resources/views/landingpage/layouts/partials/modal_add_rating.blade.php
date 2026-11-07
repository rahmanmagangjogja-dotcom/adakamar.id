{{-- ============================================================
     MODAL TAMBAH RATING / ULASAN
     Model: App\Models\AccommodationRating
     Fields: accommodation_id, nama, email, bintang, keterangan
     ============================================================ --}}

<div id="ratingModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300">

    <div class="relative w-full max-w-lg max-h-[95vh] flex flex-col bg-white dark:bg-gray-900 rounded-sm shadow-2xl overflow-hidden transform scale-95 transition-transform duration-300 border border-gray-600"
        id="ratingModalContent">

        {{-- ===================== HEADER ===================== --}}
        <div class="relative bg-[#0F294D] p-4 sm:p-5 overflow-hidden flex-shrink-0">
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 20px 20px;">
            </div>

            <div class="relative flex items-start justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 bg-white/20 rounded-sm flex items-center justify-center flex-shrink-0 border border-white/30">
                        <i data-lucide="star" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-bold text-white truncate uppercase tracking-wide">
                            Tulis Ulasan
                        </h3>
                        <p class="text-xs text-gray-300 truncate">
                            {{ $accommodation->title ?? 'Penginapan' }}
                        </p>
                    </div>
                </div>

                <button type="button" id="closeRatingModal" aria-label="Tutup"
                    class="w-8 h-8 rounded-sm bg-white/20 hover:bg-white/30 text-white flex items-center justify-center flex-shrink-0 transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        {{-- ===================== FORM ===================== --}}
        <form action="{{ route('accommodationlanding.rating.store', ['slug' => $accommodation->slug]) }}"
            method="POST" class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-5">
            @csrf

            <input type="hidden" name="accommodation_id" value="{{ $accommodation->id }}">

            {{-- Alert error --}}
            @if($errors->any())
                <div class="p-3 rounded-sm bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-xs text-red-700 dark:text-red-300">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert success --}}
            @if(session('rating_success'))
                <div class="p-3 rounded-sm bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/40 text-xs text-green-700 dark:text-green-300 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                    {{ session('rating_success') }}
                </div>
            @endif

            {{-- ===================== RATING BINTANG ===================== --}}
            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-2">
                    Rating <span class="text-red-500">*</span>
                </label>

                <div class="flex items-center justify-center gap-2 py-3 bg-gray-50 dark:bg-gray-800 rounded-sm border border-gray-300 dark:border-gray-600">
                    @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer star-label" for="star-{{ $i }}" data-star="{{ $i }}">
                            <input type="radio" id="star-{{ $i }}" name="bintang" value="{{ $i }}"
                                class="sr-only star-input" {{ old('bintang') == $i ? 'checked' : '' }}
                                {{ $i == 1 ? 'required' : '' }} />
                            <i data-lucide="star" class="w-8 h-8 sm:w-10 sm:h-10 transition-all duration-200 star-icon"></i>
                        </label>
                    @endfor
                </div>

                <p id="ratingHint" class="text-center text-xs font-bold text-gray-500 dark:text-gray-400 mt-2 h-4 uppercase tracking-wide">
                    {{ old('bintang') ? ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'][old('bintang')] : 'Pilih rating Anda' }}
                </p>

                @error('bintang')
                    <p class="text-xs text-red-500 text-center mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== NAMA ===================== --}}
            <div>
                <label for="rating-nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" id="rating-nama" name="nama" value="{{ old('nama') }}"
                        placeholder="Masukkan nama Anda" required maxlength="100" autocomplete="name"
                        class="w-full pl-9 pr-4 py-2 rounded-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0194F3] focus:border-[#0194F3] transition-all" />
                </div>
                @error('nama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== EMAIL ===================== --}}
            <div>
                <label for="rating-email" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="email" id="rating-email" name="email" value="{{ old('email') }}"
                        placeholder="email@contoh.com" required maxlength="150" autocomplete="email"
                        class="w-full pl-9 pr-4 py-2 rounded-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0194F3] focus:border-[#0194F3] transition-all" />
                </div>
                <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-1">
                    Email tidak akan dipublikasikan.
                </p>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===================== KETERANGAN / ULASAN ===================== --}}
            <div>
                <label for="rating-keterangan" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-2">
                    Ulasan <span class="text-red-500">*</span>
                </label>
                <textarea id="rating-keterangan" name="keterangan" rows="4" required minlength="10" maxlength="1000"
                    placeholder="Ceritakan pengalaman Anda menginap di sini..."
                    class="w-full px-3 py-2 rounded-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm text-[#0F294D] dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#0194F3] focus:border-[#0194F3] transition-all resize-none">{{ old('keterangan') }}</textarea>
                <div class="flex items-center justify-between mt-1">
                    <p class="text-[10px] text-gray-500 dark:text-gray-400">
                        Minimal 10 karakter.
                    </p>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400">
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
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-sm border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 font-bold text-xs uppercase tracking-wide hover:bg-gray-100 dark:hover:bg-gray-800 transition-all">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-sm bg-[#0194F3] text-white font-bold text-xs uppercase tracking-wide shadow-sm hover:bg-[#0064D2] transition-all">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ============ RATING STARS INTERAKTIF ============ */
    #ratingModal .star-icon {
        color: #D1D5DB;
    }

    .dark #ratingModal .star-icon {
        color: #4B5563;
    }

    #ratingModal .star-label.preview .star-icon,
    #ratingModal .star-label.selected .star-icon {
        color: #FFD700;
        fill: #FFD700;
        transform: scale(1.1);
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
        border-radius: 0;
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

            /* PINDAHKAN MODAL KE <body> */
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
            
            // Render Lucide
            if (window.renderLucide) {
                window.renderLucide();
            } else if (window.lucide) {
                lucide.createIcons();
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>