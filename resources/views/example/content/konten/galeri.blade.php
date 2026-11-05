@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_gallery')
    @include('example.layouts.partials.konten.modal_edit_gallery')

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
                    Daftar Galeri
                </h1>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('galleries.index') }}" method="GET"
                        id="searchForm">
                        <div class="relative w-full sm:w-64 xl:w-96">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#0194F3] dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="search-input" value="{{ request('keyword') }}"
                                class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full pl-10 p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Cari galeri...">
                        </div>
                    </form>
                    @if (request('keyword'))
                        <a href="{{ route('galleries.index') }}"
                            class="text-sm text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#B3E0FF] whitespace-nowrap font-medium transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            Hapus Filter
                        </a>
                    @endif
                </div>

                <!-- Bagian Kanan: Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <button onclick="openAddGalleryModal()"
                        class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Galeri
                    </button>
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
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[150px]">
                                    Gambar
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[100px]">
                                    Urutan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[100px]">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700"
                            id="table-body">
                            @forelse($galleries as $index => $gallery)
                                <tr data-id="{{ $gallery->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $galleries->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if ($gallery->image)
                                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                                class="w-24 h-16 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                        @else
                                            <div class="w-24 h-16 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-[#B3E0FF] dark:border-gray-600 flex items-center justify-center">
                                                <span class="text-[#0194F3] dark:text-gray-400 text-[10px]">No img</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium max-w-[200px] truncate">
                                        {{ $gallery->title }}
                                    </td>
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400">
                                        {{ $gallery->sort_order ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($gallery->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-sm">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditGalleryModal({{ $gallery->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $gallery->id }}" data-name="{{ $gallery->title }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        @if (request('keyword'))
                                            Tidak ada galeri dengan judul "{{ request('keyword') }}"
                                        @else
                                            Belum ada data galeri.
                                        @endif
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
            @forelse($galleries as $index => $gallery)
                <div class="relative overflow-hidden border border-[#B3E0FF] dark:border-gray-600 rounded-xl bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 shadow-lg shadow-[#0194F3]/10 hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300 p-3">
                    {{-- Blob dekoratif --}}
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative flex gap-3">
                        <!-- Gambar -->
                        <div class="flex-shrink-0">
                            @if ($gallery->image)
                                <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                    class="w-20 h-20 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                            @else
                                <div class="w-20 h-20 flex items-center justify-center bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                    <span class="text-[#0194F3] dark:text-gray-400 text-[10px] text-center">No<br>Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <span class="text-[10px] text-[#687176] dark:text-gray-400">
                                    #{{ $galleries->firstItem() + $index }}
                                </span>
                                @if($gallery->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white shadow-sm">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-sm font-medium text-[#0F294D] dark:text-white truncate mb-1">
                                {{ $gallery->title }}
                            </h3>
                            <p class="text-xs text-[#687176] dark:text-gray-400">
                                Urutan: <span class="font-medium">{{ $gallery->sort_order ?? '-' }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="relative flex items-center gap-2 mt-3 pt-3 border-t border-[#B3E0FF]/60 dark:border-gray-600">
                        <button onclick="openEditGalleryModal({{ $gallery->id }})"
                            class="flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] rounded-lg shadow-sm transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit
                        </button>
                        <button
                            class="delete-btn flex-1 inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm transition-all duration-200"
                            data-id="{{ $gallery->id }}" data-name="{{ $gallery->title }}">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 text-[#687176] dark:text-gray-400 text-sm bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-700 rounded-xl">
                    @if (request('keyword'))
                        Tidak ada galeri dengan judul "{{ request('keyword') }}"
                    @else
                        Belum ada data galeri.
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination — GRADIENT ===== -->
    @if (method_exists($galleries, 'hasPages') && $galleries->hasPages())
        <div class="relative overflow-hidden p-3 sm:p-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-inner">
            {{-- Pattern dots subtle --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 text-center sm:text-left">
                    Menampilkan
                    <span class="font-semibold text-[#0F294D] dark:text-white">{{ $galleries->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-[#0F294D] dark:text-white">{{ $galleries->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-[#0F294D] dark:text-white">{{ $galleries->total() }}</span>
                    data
                    @if (request('keyword'))
                        <span class="text-[#0194F3] dark:text-[#33ADFF] block sm:inline">
                            (Hasil: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div class="w-full sm:w-auto flex justify-center sm:justify-end">
                    {{ $galleries->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session('success'))
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

    @if (session('error'))
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
        // ========== SEARCH ==========
        const searchInput = document.getElementById('search-input');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    searchForm.submit();
                }, 500);
            });

            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });

            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && this.value !== '') {
                    this.value = '';
                    searchForm.submit();
                }
            });
        }

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name || 'gambar ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus galeri "${name}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#0194F3',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('galleries.destroy', '') }}/' + id;
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

        console.log('Halaman galeri siap digunakan.');
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

    /* ===== PAGINATION ===== */
    .pagination {
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #0194F3;
        background: linear-gradient(135deg, #E6F4FF, #F0F9FF);
        border: 1px solid #B3E0FF;
        transition: all 0.2s ease;
        text-decoration: none;
        min-width: 36px;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #0194F3, #0064D2);
        border-color: #0194F3;
        color: #ffffff;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(1, 148, 243, 0.3);
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, #0194F3, #0064D2);
        border-color: #0194F3;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(1, 148, 243, 0.4);
    }

    .pagination .active .page-link:hover {
        background: linear-gradient(135deg, #0064D2, #0194F3);
        border-color: #0064D2;
        color: #ffffff;
    }

    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f3f4f6;
        color: #9CA3AF;
        pointer-events: none;
    }

    .dark .pagination .page-link {
        background: linear-gradient(135deg, #1f2937, #374151);
        border-color: #374151;
        color: #33ADFF;
    }

    .dark .pagination .page-link:hover {
        background: linear-gradient(135deg, #33ADFF, #0194F3);
        border-color: #33ADFF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link {
        background: linear-gradient(135deg, #33ADFF, #0194F3);
        border-color: #33ADFF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link:hover {
        background: linear-gradient(135deg, #0194F3, #0064D2);
        border-color: #0194F3;
        color: #ffffff;
    }

    .dark .pagination .disabled .page-link {
        background: #374151;
        color: #6B7280;
    }

    @media (max-width: 640px) {
        .pagination {
            justify-content: center;
            gap: 3px;
        }

        .pagination .page-link {
            padding: 5px 10px;
            font-size: 12px;
            min-width: 32px;
        }
    }

    /* ===== TABLE HOVER (inline di <tr>) ===== */

    /* Mobile card hover */
    @media (hover: hover) and (max-width: 767px) {
        .md\:hidden > div:hover {
            box-shadow: 0 8px 16px -4px rgba(1, 148, 243, 0.25);
        }
    }
</style>