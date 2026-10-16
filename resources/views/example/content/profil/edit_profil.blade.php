@extends('example.layouts.default.dashboard')
@section('content')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#0194F3] lg:mt-1.5 dark:bg-gray-800 dark:border-[#33ADFF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF]">
                    <svg class="w-6 h-6 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                    Edit Profil
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola informasi akun dan keamanan Anda</p>
            </div>
        </div>
    </div>

    <div class="p-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom Kiri: Foto Profil & Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                    <h3
                        class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 pb-2 border-b border-[#B3E0FF] dark:border-gray-700">
                        <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        Foto Profil
                    </h3>

                    <!-- Current Photo -->
                    <div class="flex flex-col items-center mb-4">
                        @if($user->photo)
                            <img id="currentPhoto" src="{{ asset($user->photo) }}" alt="{{ $user->name }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-[#B3E0FF] dark:border-gray-600 mb-3">
                        @else
                            <div id="defaultPhoto"
                                class="w-32 h-32 rounded-full bg-[#E6F4FF] dark:bg-gray-700 border-4 border-[#B3E0FF] dark:border-gray-600 flex items-center justify-center mb-3">
                                <svg class="w-16 h-16 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif

                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>

                    <!-- Info Akun -->
                    <div class="bg-[#E6F4FF] dark:bg-gray-700/50 p-3 rounded-lg">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Bergabung sejak</span>
                            <span class="font-medium text-gray-900 dark:text-white">
                                {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Edit Profil -->
            <div class="lg:col-span-2">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Dasar -->
                    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 mb-6">
                        <h3
                            class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 pb-2 border-b border-[#B3E0FF] dark:border-gray-700">
                            <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M2 4a1 1 0 011-1h14a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zm2 0v12h12V4H4z" />
                                <path d="M5 6h10v2H5V6zm0 4h10v2H5v-2zm0 4h6v2H5v-2z" />
                            </svg>
                            Informasi Dasar
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nama -->
                            <div class="sm:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] @error('name') border-red-500 @enderror"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <span class="text-red-500 text-xs error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="sm:col-span-2">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] @error('email') border-red-500 @enderror"
                                    placeholder="Masukkan email" required>
                                @error('email')
                                    <span class="text-red-500 text-xs error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Foto Profil -->
                    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 mb-6">
                        <h3
                            class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 pb-2 border-b border-[#B3E0FF] dark:border-gray-700">
                            <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Foto Profil
                        </h3>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                            Kosongkan jika tidak ingin mengganti foto. Format: JPG, JPEG, PNG, WEBP (Maks. 2MB)
                        </p>

                        <!-- Preview Foto Baru -->
                        <div id="photoPreviewContainer" class="hidden mb-3">
                            <div class="flex items-center gap-3 p-3 bg-[#E6F4FF] dark:bg-gray-700/50 rounded-lg">
                                <img id="photoPreview" src="#" alt="Preview"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-[#B3E0FF] dark:border-gray-600">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white" id="photoFileName">-</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400" id="photoFileSize">-</p>
                                </div>
                                <button type="button" onclick="removePhoto()"
                                    class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Upload Area -->
                        <div id="photoUploadArea"
                            class="w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-[#E6F4FF] border-[#B3E0FF] hover:bg-[#D6ECFF] dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors @error('photo') border-red-500 @enderror">
                            <label for="photo"
                                class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-[#0194F3] dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold">Klik untuk upload</span> foto profil
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, WEBP (Maks. 2MB)</p>
                                </div>
                                <input type="file" id="photo" name="photo" accept="image/*" class="hidden">
                            </label>
                        </div>
                        @error('photo')
                            <span class="text-red-500 text-xs error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ubah Password -->
                    <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800 mb-6">
                        <h3
                            class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 pb-2 border-b border-[#B3E0FF] dark:border-gray-700">
                            <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Ubah Password
                        </h3>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                            Kosongkan jika tidak ingin mengubah password. Minimal 8 karakter.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Password Baru -->
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Password Baru
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] @error('password') border-red-500 @enderror"
                                        placeholder="Masukkan password baru">
                                    <button type="button" onclick="togglePassword('password')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="text-red-500 text-xs error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="shadow-sm bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                        placeholder="Konfirmasi password baru">
                                    <button type="button" onclick="togglePassword('password_confirmation')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg id="password_confirmation-eye" class="w-5 h-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <button type="submit"
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] w-full sm:w-auto">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 hover:text-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 w-full sm:w-auto inline-block">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== PHOTO UPLOAD ==========
        const photoInput = document.getElementById('photo');
        const photoUploadArea = document.getElementById('photoUploadArea');
        const photoPreviewContainer = document.getElementById('photoPreviewContainer');
        const photoPreview = document.getElementById('photoPreview');
        const photoFileName = document.getElementById('photoFileName');
        const photoFileSize = document.getElementById('photoFileSize');

        if (photoInput) {
            photoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];

                if (file) {
                    // Validasi ukuran
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Ukuran file maksimal 2MB'
                        });
                        this.value = '';
                        return;
                    }

                    // Validasi tipe
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Format file harus JPG, JPEG, PNG atau WEBP.'
                        });
                        this.value = '';
                        return;
                    }

                    // Preview
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        photoPreview.src = event.target.result;
                        photoUploadArea.classList.add('hidden');
                        photoPreviewContainer.classList.remove('hidden');

                        photoFileName.textContent = file.name;
                        const sizeInKB = (file.size / 1024).toFixed(2);
                        if (sizeInKB > 1024) {
                            photoFileSize.textContent = (sizeInKB / 1024).toFixed(2) + ' MB';
                        } else {
                            photoFileSize.textContent = sizeInKB + ' KB';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // ========== REMOVE PHOTO ==========
        window.removePhoto = function () {
            document.getElementById('photo').value = '';
            document.getElementById('photoUploadArea').classList.remove('hidden');
            document.getElementById('photoPreviewContainer').classList.add('hidden');
        };

        // ========== TOGGLE PASSWORD ==========
        window.togglePassword = function (inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(inputId + '-eye');

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            } else {
                input.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        };

        // ========== SUBMIT FORM - VALIDASI PASSWORD ==========
        const profileForm = document.getElementById('profileForm');
        if (profileForm) {
            profileForm.addEventListener('submit', function (e) {
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;

                // Validasi konfirmasi password
                if (password && password !== passwordConfirmation) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Password dan konfirmasi password tidak sama!'
                    });
                    return false;
                }

                // Validasi minimal 8 karakter
                if (password && password.length < 8) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Password minimal 8 karakter!'
                    });
                    return false;
                }
            });
        }
    });
</script>

<style>
    .dark .bg-\[\#E6F4FF\] {
        background-color: #1f2937 !important;
    }

    .dark .border-\[\#B3E0FF\] {
        border-color: #374151 !important;
    }

    .dark .text-\[\#0194F3\] {
        color: #33ADFF !important;
    }

    .error-message {
        margin-top: 4px;
        display: block;
    }

    #photoPreviewContainer {
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