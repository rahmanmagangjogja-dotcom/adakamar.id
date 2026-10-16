@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.artikel.modal_add_article_category')
    @include('example.layouts.partials.artikel.modal_edit_article_category')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#0194F3] lg:mt-1.5 dark:bg-gray-800 dark:border-[#33ADFF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF]">Daftar Kategori Artikel</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('article-categories.index') }}" method="GET"
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
                                class="bg-[#E6F4FF] border border-[#B3E0FF] text-gray-900 sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF]"
                                placeholder="Cari kategori artikel...">
                        </div>
                    </form>
                    @if (request('keyword'))
                        <a href="{{ route('article-categories.index') }}"
                            class="text-sm text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#33ADFF]">
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
                    <button onclick="openAddArticleCategoryModal()"
                        class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] focus:outline-none dark:focus:ring-[#33ADFF] inline-flex items-center w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Kategori
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-[#B3E0FF] table-fixed dark:divide-gray-600">
                        <thead class="bg-[#E6F4FF] dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF] w-[60px]">
                                    No
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                    Slug
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                    Deskripsi
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF] w-[100px]">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF] w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#B3E0FF] dark:bg-gray-800 dark:divide-gray-700"
                            id="table-body">
                            @forelse($articleCategories as $index => $category)
                                <tr data-id="{{ $category->id }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $articleCategories->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">
                                        {{ $category->name }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[200px]">
                                        <div class="relative group inline-block max-w-full">
                                            <span class="cursor-help truncate block">
                                                {{ $category->description ?? '-' }}
                                            </span>

                                            @if($category->description)
                                                <div
                                                    class="hidden group-hover:block absolute z-50 bottom-full left-0 mb-2 w-[350px] p-3 rounded-lg bg-white dark:bg-gray-800 border border-[#B3E0FF] dark:border-gray-700 shadow-2xl pointer-events-none">
                                                    <div class="flex items-center gap-1.5 font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Deskripsi Kategori
                                                    </div>
                                                    <div class="text-xs text-gray-600 dark:text-gray-300 whitespace-normal break-words leading-relaxed">
                                                        {{ $category->description }}
                                                    </div>
                                                    {{-- Arrow --}}
                                                    <div
                                                        class="absolute top-full left-4 -mt-1 w-2 h-2 rotate-45 bg-white dark:bg-gray-800 border-r border-b border-[#B3E0FF] dark:border-gray-700">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($category->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditArticleCategoryModal({{ $category->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] min-w-[55px]">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]"
                                                data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-gray-500 dark:text-gray-400">
                                        @if (request('keyword'))
                                            Tidak ada kategori artikel dengan nama "{{ request('keyword') }}"
                                        @else
                                            Belum ada data kategori artikel.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if (method_exists($articleCategories, 'hasPages') && $articleCategories->hasPages())
        <div class="p-4 bg-white border-t border-[#B3E0FF] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $articleCategories->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-900 dark:text-white">{{ $articleCategories->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-900 dark:text-white">{{ $articleCategories->total() }}</span>
                    data
                    @if (request('keyword'))
                        <span class="text-[#0194F3] dark:text-[#33ADFF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $articleCategories->appends(request()->query())->links() }}
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
                const name = this.dataset.name || 'kategori ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus kategori artikel "${name}" secara permanen!`,
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
                        form.action = '{{ route('article-categories.destroy', '') }}/' + id;
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

        console.log('Halaman kategori artikel siap digunakan.');
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

    .pagination {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        color: #0194F3;
        background-color: #E6F4FF;
        border: 1px solid #B3E0FF;
        transition: all 0.2s ease;
        text-decoration: none;
        min-width: 36px;
    }

    .pagination .page-link:hover {
        background-color: #0194F3;
        border-color: #0194F3;
        color: #ffffff;
        text-decoration: none;
    }

    .pagination .active .page-link {
        background-color: #0194F3;
        border-color: #0194F3;
        color: #ffffff;
    }

    .pagination .active .page-link:hover {
        background-color: #0064D2;
        border-color: #0064D2;
        color: #ffffff;
    }

    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f3f4f6;
        color: #9CA3AF;
        pointer-events: none;
    }

    .dark .pagination .page-link {
        background-color: #1f2937;
        border-color: #374151;
        color: #33ADFF;
    }

    .dark .pagination .page-link:hover {
        background-color: #33ADFF;
        border-color: #33ADFF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link {
        background-color: #33ADFF;
        border-color: #33ADFF;
        color: #ffffff;
    }

    .dark .pagination .active .page-link:hover {
        background-color: #0194F3;
        border-color: #0194F3;
        color: #ffffff;
    }

    .dark .pagination .disabled .page-link {
        background-color: #374151;
        color: #6B7280;
    }

    @media (max-width: 640px) {
        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            padding: 4px 10px;
            font-size: 12px;
            min-width: 30px;
        }
    }

    #table-body tr:hover {
        background-color: #E6F4FF;
        transition: background-color 0.2s ease;
    }

    .dark #table-body tr:hover {
        background-color: #374151;
    }
</style>