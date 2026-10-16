@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_banner')
    @include('example.layouts.partials.konten.modal_edit_banner')

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-[#0194F3] lg:mt-1.5 dark:bg-gray-800 dark:border-[#33ADFF]">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF]">Daftar Banner</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <!-- Bagian Kiri: Informasi -->
                <div class="flex items-center w-full sm:w-auto">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Total <span class="font-semibold text-gray-900 dark:text-white">{{ $banners->count() }}</span>
                        banner
                        @if($banners->count() >= 1)
                            <span
                                class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
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
                            class="text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] focus:outline-none dark:focus:ring-[#33ADFF] inline-flex items-center w-full sm:w-auto justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Banner
                        </button>
                    @else
                        <div class="text-sm text-gray-500 dark:text-gray-400 italic">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Banner sudah ada (maksimal 1)
                        </div>
                    @endif
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
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF] w-[200px]">
                                    Gambar
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                    Judul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                    Subjudul
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-[#0194F3] uppercase dark:text-[#33ADFF] w-[180px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#B3E0FF] dark:bg-gray-800 dark:divide-gray-700"
                            id="table-body">
                            @forelse($banners as $index => $banner)
                                <tr data-id="{{ $banner->id }}">
                                    <td class="p-4 text-xs text-gray-500 dark:text-gray-400 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($banner->image)
                                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}"
                                                class="w-32 h-20 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                        @else
                                            <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-gray-900 dark:text-white font-medium">
                                        {{ $banner->title }}
                                    </td>
                                <td class="p-4 text-xs text-gray-500 dark:text-gray-400 max-w-[200px]">
                                    <div class="relative group inline-block max-w-full">
                                        <span class="cursor-help truncate block">
                                            {{ $banner->subtitle ?? '-' }}
                                        </span>

                                        @if($banner->subtitle)
                                            <div
                                                class="hidden group-hover:block absolute z-50 bottom-full left-0 mb-2 w-[350px] p-3 rounded-lg bg-white dark:bg-gray-800 border border-[#B3E0FF] dark:border-gray-700 shadow-2xl pointer-events-none">
                                                <div class="flex items-center gap-1.5 font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-1.5">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Subtitle Banner
                                                </div>
                                                <div class="text-xs text-gray-600 dark:text-gray-300 whitespace-normal break-words leading-relaxed">
                                                    {{ $banner->subtitle }}
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
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openEditBannerModal({{ $banner->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-[#0194F3] hover:bg-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg dark:bg-[#33ADFF] dark:hover:bg-[#0194F3] dark:focus:ring-[#33ADFF] min-w-[55px]">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 min-w-[55px]"
                                                data-id="{{ $banner->id }}" data-name="{{ $banner->title }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-6 text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-3 text-gray-300 dark:text-gray-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-base font-medium text-gray-700 dark:text-gray-300">Belum ada data
                                                banner</p>
                                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Klik tombol "Tambah Banner"
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

    <!-- Info Banner Maksimal 1 -->
    @if($banners->count() >= 1)
        <div class="fixed bottom-4 right-4 z-50">
            <div
                class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-lg dark:bg-yellow-900/30 dark:border-yellow-500 dark:text-yellow-300 max-w-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">
                            Hanya 1 banner yang diperbolehkan
                        </p>
                        <p class="text-xs opacity-75">Edit banner yang ada atau hapus untuk menambah yang baru</p>
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

    #table-body tr:hover {
        background-color: #E6F4FF;
        transition: background-color 0.2s ease;
    }

    .dark #table-body tr:hover {
        background-color: #374151;
    }

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

    .fixed.bottom-4.right-4.z-50 {
        animation: slideInUp 0.5s ease-out;
    }
</style>