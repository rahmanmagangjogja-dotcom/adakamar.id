@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.accomodation.modal_add_kategori')
    @include('example.layouts.partials.accomodation.modal_edit_kategori')

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
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd" />
                    </svg>
                    Daftar Kategori
                </h1>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('accommodation-categories.index') }}" method="GET"
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
                                placeholder="Cari kategori...">
                        </div>
                    </form>
                    @if (request('keyword'))
                        <a href="{{ route('accommodation-categories.index') }}"
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
                    <a href="#" onclick="openAddKategoriModal()"
                        class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Kategori
                    </a>
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
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Nama Kategori
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Slug
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[150px]">
                                    Thumbnail
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Deskripsi
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700"
                            id="table-body">
                            @forelse($categories as $index => $category)
                                <tr data-id="{{ $category->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $categories->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium">
                                        {{ $category->name }}
                                    </td>
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if ($category->thumbnail)
                                            <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}"
                                                class="w-24 h-16 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                        @else
                                            <div class="w-24 h-16 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-[#B3E0FF] dark:border-gray-600 flex items-center justify-center">
                                                <span class="text-[#0194F3] dark:text-gray-400 text-[10px]">No img</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white">
                                        <div class="relative group inline-block">
                                            <div class="truncate cursor-pointer max-w-[250px]">
                                                {{ $category->description ?? '-' }}
                                            </div>

                                            <div class="hidden group-hover:block absolute z-20
                                                                        bottom-full left-0 mb-2
                                                                        w-[350px] max-w-[calc(100vw-32px)]
                                                                        p-3
                                                                        rounded-lg
                                                                        bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-900
                                                                        border border-[#B3E0FF] dark:border-gray-700
                                                                        shadow-xl">
                                                <div class="font-semibold text-[#0194F3] mb-1">
                                                    Deskripsi
                                                </div>
                                                <div class="text-xs text-[#687176] dark:text-gray-300
                                                                            whitespace-normal break-words leading-relaxed">
                                                    {{ $category->description ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditKategoriModal({{ $category->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        @if (request('keyword'))
                                            Tidak ada kategori dengan nama "{{ request('keyword') }}"
                                        @else
                                            Belum ada data kategori.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========== MOBILE CARD — GRADIENT SEPERTI SIDEBAR ========== -->
        <div
            class="md:hidden p-3 space-y-3 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            @forelse($categories as $index => $category)
                <div
                    class="relative overflow-hidden border border-[#B3E0FF] dark:border-gray-600 rounded-xl bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 shadow-lg shadow-[#0194F3]/10 hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300">
                    {{-- Blob dekoratif --}}
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-8 -left-8 w-20 h-20 bg-[#33ADFF]/10 rounded-full blur-2xl pointer-events-none"></div>

                    {{-- Thumbnail full width di atas --}}
                    @if ($category->thumbnail)
                        <div class="relative w-full h-40 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            <img src="{{ asset($category->thumbnail) }}" alt="{{ $category->name }}" loading="lazy"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="relative w-full h-40 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <span class="text-[#0194F3] dark:text-gray-400 text-xs">Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="relative p-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[10px] text-[#687176] dark:text-gray-400">
                                #{{ $categories->firstItem() + $index }}
                            </span>
                        </div>

                        <h3 class="text-base font-semibold text-[#0F294D] dark:text-white mb-1 break-words">
                            {{ $category->name }}
                        </h3>

                        <div class="mb-2">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-[#0194F3]/20 dark:to-[#0194F3]/10 text-[#0194F3] dark:text-[#33ADFF] border border-[#B3E0FF] dark:border-[#33ADFF]/30">
                                {{ $category->slug }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-xs text-[#687176] dark:text-gray-400">Deskripsi:</span>
                            <p class="text-xs text-[#0F294D] dark:text-white leading-relaxed break-words mt-0.5">
                                {{ $category->description ?? '-' }}
                            </p>
                        </div>

                        {{-- Aksi: 2 tombol full-width --}}
                        <div class="grid grid-cols-2 gap-2 pt-3 border-t border-[#B3E0FF]/60 dark:border-gray-600">
                            <button onclick="openEditKategoriModal({{ $category->id }})"
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
                                data-id="{{ $category->id }}" data-name="{{ $category->name }}">
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
                <div class="text-center p-6 text-[#687176] dark:text-gray-400 text-sm bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-700 rounded-xl">
                    @if (request('keyword'))
                        Tidak ada kategori dengan nama "{{ request('keyword') }}"
                    @else
                        Belum ada data kategori.
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination — GRADIENT SEPERTI SIDEBAR -->
    @if (method_exists($categories, 'hasPages') && $categories->hasPages())
        <div class="relative overflow-hidden p-3 sm:p-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-inner">
            {{-- Pattern dots subtle --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 text-center sm:text-left">
                    Menampilkan
                    <span class="font-semibold text-[#0F294D] dark:text-white">{{ $categories->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-[#0F294D] dark:text-white">{{ $categories->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-[#0F294D] dark:text-white">{{ $categories->total() }}</span>
                    data
                    @if (request('keyword'))
                        <span class="text-[#0194F3] dark:text-[#33ADFF] block sm:inline">
                            (Hasil: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div class="w-full sm:w-auto flex justify-center sm:justify-end">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
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
                const name = this.dataset.name || 'kategori ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus kategori "${name}" secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0194F3',
                    cancelButtonColor: '#687176',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ route('accommodation-categories.destroy', '') }}/${id}`;
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

        // ========== EDIT MODAL ==========
        window.openEditKategoriModal = function (id) {
            const url = `{{ url('/accommodation-categories') }}/${id}/edit`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP Error: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.success) {
                        throw new Error('Data kategori tidak ditemukan.');
                    }

                    const category = data.data;

                    document.getElementById('editId').value = category.id;
                    document.getElementById('editNama').value = category.name;
                    document.getElementById('editSlug').value = category.slug || '';
                    document.getElementById('editDeskripsi').value = category.description || '';

                    document.getElementById('editKategoriForm').action =
                        `{{ url('/accommodation-categories') }}/${category.id}`;

                    const previewImage = document.getElementById('editPreviewImage');

                    if (category.thumbnail) {
                        previewImage.src = `{{ asset('storage') }}/${category.thumbnail}`;
                        previewImage.classList.remove('hidden');
                    } else {
                        previewImage.src = '#';
                        previewImage.classList.add('hidden');
                    }

                    document.getElementById('editModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal mengambil data kategori.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
        };

        window.closeEditModal = function () {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });

        document.querySelector('#editModal .fixed.inset-0')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Preview image for edit
        const editFotoInput = document.getElementById('editFoto');
        const editPreviewImage = document.getElementById('editPreviewImage');

        if (editFotoInput) {
            editFotoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        editPreviewImage.src = event.target.result;
                        editPreviewImage.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Auto generate slug from name for add modal
        const addNamaInput = document.getElementById('addNama');
        const addSlugInput = document.getElementById('addSlug');

        if (addNamaInput && addSlugInput) {
            addNamaInput.addEventListener('input', function () {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                addSlugInput.value = slug;
            });
        }

        // Auto generate slug from name for edit modal
        const editNamaInput = document.getElementById('editNama');
        const editSlugInput = document.getElementById('editSlug');

        if (editNamaInput && editSlugInput) {
            editNamaInput.addEventListener('input', function () {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                editSlugInput.value = slug;
            });
        }
    });

    // ========== NOTIFICATION ==========
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

<style>
    /* Dark mode support */
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

    /* ===== TABLE HOVER (sudah inline di <tr>) ===== */

    /* Modal animation */
    #editModal .transition-all {
        transition: all 0.3s ease-out;
    }

    #editModal .sm\:align-middle {
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    #editModal:not(.hidden) .sm\:align-middle {
        transform: scale(1);
        opacity: 1;
    }

    /* Mobile card hover */
    @media (hover: hover) and (max-width: 767px) {
        .md\:hidden>div:hover {
            box-shadow: 0 8px 16px -4px rgba(1, 148, 243, 0.25);
        }
    }
</style>