@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_banner')
    @include('example.layouts.partials.konten.modal_edit_banner')

    {{-- ===== HEADER — GRADIENT SEPERTI SIDEBAR ===== --}}
    <div
        class="relative overflow-hidden p-4 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] block sm:flex items-center justify-between shadow-lg shadow-[#0194F3]/10 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:shadow-black/40 lg:mt-1.5">
        {{-- Pattern dots subtle --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>
        {{-- Blob dekoratif --}}
        <div class="absolute -top-16 -right-16 w-48 h-48 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF] flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                            clip-rule="evenodd" />
                    </svg>
                    Daftar Banner
                </h1>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Bagian Kiri: Informasi -->
                <div class="flex items-center w-full sm:w-auto">
                    <span class="text-sm text-[#687176] dark:text-gray-400 flex flex-wrap items-center gap-2">
                        <span>Total <span class="font-semibold text-[#0F294D] dark:text-white">{{ $banners->count() }}</span>
                            banner</span>
                        @if($banners->count() >= 1)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Maksimal 1 Banner
                            </span>
                        @endif
                    </span>
                </div>

                <!-- Bagian Kanan: Tombol Tambah (Hilang jika sudah ada banner) -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    @if($banners->count() < 1)
                        <button onclick="openAddBannerModal()"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Banner
                        </button>
                    @else
                        <div
                            class="w-full sm:w-auto text-sm text-[#687176] dark:text-gray-400 italic inline-flex items-center justify-center sm:justify-start gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700/50 dark:to-gray-700/30 border border-[#B3E0FF]/50 dark:border-gray-600/50">
                            <svg class="w-4 h-4 flex-shrink-0 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Banner sudah ada (maksimal 1)</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">

        <!-- ========== DESKTOP TABLE — GRADIENT ========== -->
        <div class="hidden md:block overflow-x-auto bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow-lg shadow-[#0194F3]/5">
                    <table class="min-w-full divide-y divide-[#B3E0FF] table-fixed dark:divide-gray-600">
                        <thead class="bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2] dark:from-[#0194F3] dark:via-[#0194F3] dark:to-[#0064D2]">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[60px]">
                                    No
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[200px]">
                                    Gambar
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Subjudul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700"
                            id="table-body">
                            @forelse($banners as $index => $banner)
                                <tr data-id="{{ $banner->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($banner->image)
                                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"
                                                class="w-32 h-20 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                        @else
                                            <div class="w-32 h-20 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-[#B3E0FF] dark:border-gray-600 flex items-center justify-center">
                                                <span class="text-[#0194F3] text-[10px]">No img</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium">
                                        {{ $banner->title }}
                                    </td>
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 max-w-[200px]">
                                        <div class="relative group inline-block max-w-full">
                                            <span class="cursor-help truncate block">
                                                {{ $banner->subtitle ?? '-' }}
                                            </span>

                                            @if($banner->subtitle)
                                                <div
                                                    class="hidden group-hover:block absolute z-50 bottom-full left-0 mb-2 w-[350px] max-w-[calc(100vw-32px)] p-3 rounded-lg bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-900 border border-[#B3E0FF] dark:border-gray-700 shadow-2xl pointer-events-none">
                                                    <div
                                                        class="flex items-center gap-1.5 font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Subtitle Banner
                                                    </div>
                                                    <div
                                                        class="text-xs text-[#687176] dark:text-gray-300 whitespace-normal break-words leading-relaxed">
                                                        {{ $banner->subtitle }}
                                                    </div>
                                                    {{-- Arrow --}}
                                                    <div
                                                        class="absolute top-full left-4 -mt-1 w-2 h-2 rotate-45 bg-white dark:bg-gray-900 border-r border-b border-[#B3E0FF] dark:border-gray-700">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditBannerModal({{ $banner->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $banner->id }}" data-name="{{ $banner->title }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 mb-3 rounded-full bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-[#0194F3] dark:text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="text-base font-medium text-[#0F294D] dark:text-gray-300">Belum ada data
                                                banner</p>
                                            <p class="text-sm text-[#687176] dark:text-gray-500 mt-1">Klik tombol "Tambah Banner"
                                                untuk menambahkan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========== MOBILE CARD — GRADIENT ========== -->
        <div class="md:hidden p-3 space-y-3 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            @forelse($banners as $index => $banner)
                <div
                    class="relative overflow-hidden border border-[#B3E0FF] dark:border-gray-600 rounded-xl bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 shadow-lg shadow-[#0194F3]/10 hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300">
                    {{-- Blob dekoratif --}}
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>

                    {{-- Gambar banner full width --}}
                    @if($banner->image)
                        <div class="relative w-full aspect-video bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" loading="lazy"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="relative w-full aspect-video bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <span class="text-[#0194F3] dark:text-gray-400 text-xs">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="relative p-3">
                        {{-- Nomor --}}
                        <div class="flex items-center justify-between mb-1.5">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-sm">
                                Banner #{{ $index + 1 }}
                            </span>
                        </div>

                        {{-- Judul --}}
                        <h3 class="text-base font-semibold text-[#0F294D] dark:text-white mb-1.5 leading-snug break-words">
                            {{ $banner->title }}
                        </h3>

                        {{-- Subjudul --}}
                        @if($banner->subtitle)
                            <div class="mb-3">
                                <p class="text-xs text-[#687176] dark:text-gray-400 uppercase tracking-wide mb-0.5 font-medium">
                                    Subjudul
                                </p>
                                <p class="text-sm text-[#0F294D] dark:text-gray-300 leading-relaxed break-words">
                                    {{ $banner->subtitle }}
                                </p>
                            </div>
                        @else
                            <p class="text-xs text-[#687176] dark:text-gray-500 italic mb-3">
                                Tidak ada subjudul
                            </p>
                        @endif

                        {{-- Aksi: 2 tombol full-width --}}
                        <div class="grid grid-cols-2 gap-2 pt-3 border-t border-[#B3E0FF]/60 dark:border-gray-600">
                            <button onclick="openEditBannerModal({{ $banner->id }})"
                                class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] rounded-lg shadow-sm transition-all duration-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </button>
                            <button
                                class="delete-btn inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm transition-all duration-200"
                                data-id="{{ $banner->id }}" data-name="{{ $banner->title }}">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 text-[#687176] dark:text-gray-400 bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-700 rounded-xl">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 mb-3 rounded-full bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#0194F3] dark:text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-base font-medium text-[#0F294D] dark:text-gray-300">Belum ada data banner</p>
                        <p class="text-sm text-[#687176] dark:text-gray-500 mt-1 px-4">
                            Klik tombol "Tambah Banner" di atas untuk menambahkan
                        </p>
                    </div>
                </div>
            @endforelse
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

    <!-- Info Banner Maksimal 1 (Floating) -->
    @if($banners->count() >= 1)
        <div class="fixed bottom-3 right-3 left-3 sm:left-auto sm:bottom-4 sm:right-4 z-50">
            <div
                class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border-l-4 border-[#0194F3] text-[#0F294D] p-3 sm:p-4 rounded-lg shadow-lg dark:from-gray-800 dark:to-gray-700 dark:border-[#33ADFF] dark:text-gray-200 sm:max-w-sm">
                <div class="flex items-start sm:items-center">
                    <div class="flex-shrink-0 text-[#0194F3] dark:text-[#33ADFF]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 min-w-0">
                        <p class="text-sm font-medium">
                            Hanya 1 banner yang diperbolehkan
                        </p>
                        <p class="text-xs opacity-75 mt-0.5">
                            Edit banner yang ada atau hapus untuk menambah yang baru
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name || 'banner ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus banner "${name}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#0194F3',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const url = '{{ route('banners.destroy', ':id') }}'.replace(':id', id);

                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });

        console.log('Halaman banner siap digunakan.');
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

    /* ===== TABLE HOVER (inline di <tr>) ===== */

    /* Animasi untuk floating notification */
    @keyframes slideInUp {
        from {
            transform: translateY(100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .fixed.bottom-3,
    .fixed.sm\:bottom-4 {
        animation: slideInUp 0.5s ease-out;
    }

    /* Mobile card hover */
    @media (hover: hover) and (max-width: 767px) {
        .md\:hidden>div:hover {
            box-shadow: 0 8px 16px -4px rgba(1, 148, 243, 0.25);
        }
    }

    /* Pastikan gambar mobile card proporsional */
    .md\:hidden img {
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
    }
</style>