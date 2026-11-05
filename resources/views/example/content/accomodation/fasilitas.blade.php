@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.accomodation.modal_add_fasilitas')
    @include('example.layouts.partials.accomodation.modal_edit_fasilitas')

    {{-- ===== HEADER — GRADIENT SEPERTI SIDEBAR ===== --}}
    <div
        class="relative overflow-hidden p-4 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] block sm:flex items-center justify-between shadow-lg shadow-[#0194F3]/10 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 dark:shadow-black/40 lg:mt-1.5">
        {{-- Pattern dots subtle --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>
        {{-- Blob dekoratif --}}
        <div class="absolute -top-16 -right-16 w-48 h-48 bg-[#0194F3]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-40 h-40 bg-[#33ADFF]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF] flex items-center gap-2">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" />
                        <path
                            d="M8 6a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1zM8 10a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                    </svg>
                    Daftar Fasilitas
                </h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Search -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none" action="{{ route('facilities.index') }}" method="GET" id="searchForm">
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
                                class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] sm:text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full pl-10 p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200"
                                placeholder="Cari fasilitas...">
                        </div>
                    </form>
                    @if (request('keyword'))
                        <a href="{{ route('facilities.index') }}"
                            class="text-sm text-[#0194F3] hover:text-[#0064D2] dark:text-[#33ADFF] dark:hover:text-[#B3E0FF] font-medium transition-colors">
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
                    <a href="#" onclick="openAddFasilitasModal()"
                        class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">

        <!-- ========== CONTAINER TABEL — GRADIENT ========== -->
        <div
            class="overflow-x-auto bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow-lg shadow-[#0194F3]/5">
                    <table class="min-w-full divide-y divide-[#B3E0FF] table-fixed dark:divide-gray-600">
                        <thead
                            class="bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2] dark:from-[#0194F3] dark:via-[#0194F3] dark:to-[#0064D2]">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-white uppercase w-[60px]">
                                    No
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Nama Fasilitas
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Deskripsi
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-white uppercase w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700" id="table-body">
                            @forelse($facilities as $index => $facility)
                                <tr data-id="{{ $facility->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $facilities->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium">
                                        {{ $facility->name }}
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white">
                                        <div class="relative group inline-block">
                                            {{-- Deskripsi yang ditampilkan di tabel --}}
                                            <div class="truncate cursor-pointer">
                                                {{ $facility->description ?? '-' }}
                                            </div>

                                            {{-- Popup deskripsi lengkap (border biru, bg gradient) --}}
                                            <div class="hidden group-hover:block mt-2
                                                                bottom-full left-0 mb-2
                                                                w-[350px]
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
                                                    {{ $facility->description ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditFasilitasModal({{ $facility->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $facility->id }}" data-name="{{ $facility->name }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        @if (request('keyword'))
                                            Tidak ada fasilitas dengan nama "{{ request('keyword') }}"
                                        @else
                                            Belum ada data fasilitas.
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

    <!-- Pagination — GRADIENT SEPERTI SIDEBAR -->
    @if (method_exists($facilities, 'hasPages') && $facilities->hasPages())
        <div
            class="relative overflow-hidden p-3 sm:p-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-inner">
            {{-- Pattern dots subtle --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
                style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;">
            </div>

            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-[#687176] dark:text-gray-400">
                    Menampilkan
                    <span class="font-semibold text-[#0F294D] dark:text-white">{{ $facilities->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-[#0F294D] dark:text-white">{{ $facilities->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-[#0F294D] dark:text-white">{{ $facilities->total() }}</span>
                    data
                    @if (request('keyword'))
                        <span class="text-[#0194F3] dark:text-[#33ADFF]">
                            (Hasil pencarian: "{{ request('keyword') }}")
                        </span>
                    @endif
                </div>
                <div>
                    {{ $facilities->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

@endsection

<!-- Script untuk fungsi -->
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
                const name = this.dataset.name || 'fasilitas ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus fasilitas "${name}" secara permanen!`,
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
                        form.action = `{{ route('facilities.destroy', '') }}/${id}`;
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
        window.openEditFasilitasModal = function (id) {
            const url = `{{ url('/facilities') }}/${id}/edit`;

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
                        throw new Error('Data fasilitas tidak ditemukan.');
                    }

                    const facility = data.data;

                    document.getElementById('editFasilitasId').value = facility.id;
                    document.getElementById('editNamaFasilitas').value = facility.name;
                    document.getElementById('editDeskripsiFasilitas').value = facility.description || '';

                    document.getElementById('editFasilitasForm').action =
                        `{{ url('/facilities') }}/${facility.id}`;

                    document.getElementById('editFasilitasModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal mengambil data fasilitas.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
        };

        window.closeEditFasilitasModal = function () {
            document.getElementById('editFasilitasModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        };

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeEditFasilitasModal();
            }
        });

        // Click outside to close
        document.querySelector('#editFasilitasModal .fixed.inset-0')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeEditFasilitasModal();
            }
        });
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

    /* ===== TABLE HOVER (inline di <tr>) ===== */

    /* Modal animation */
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