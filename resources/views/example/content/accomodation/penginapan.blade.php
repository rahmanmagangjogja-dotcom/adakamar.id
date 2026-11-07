@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.accomodation.modal_add_penginapan')
    @include('example.layouts.partials.accomodation.modal_edit_penginapan')
    @include('example.layouts.partials.accomodation.modal_detail_penginapan')

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
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Daftar Penginapan
                </h1>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Bagian Kiri: Search + Filter Kategori -->
                <div class="flex items-center w-full sm:w-auto flex-wrap gap-2">
                    <form class="flex-1 sm:flex-none flex flex-col sm:flex-row items-stretch sm:items-center gap-2"
                        action="{{ route('accommodations.index') }}" method="GET" id="searchForm">

                        {{-- Search Input --}}
                        <div class="relative w-full sm:w-64 xl:w-80">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#0194F3] dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" id="search-input" value="{{ request('keyword') }}"
                                class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full pl-10 p-2.5 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] transition-all duration-200">
                        </div>

                        {{-- Filter Kategori --}}
                        <div class="relative w-full sm:w-56">
                            <select name="category_id" id="category-filter"
                                class="bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] border border-[#B3E0FF] text-[#0F294D] text-sm rounded-lg focus:ring-[#0194F3] focus:border-[#0194F3] block w-full p-2.5 pr-10 dark:from-gray-700 dark:to-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-[#33ADFF] dark:focus:border-[#33ADFF] appearance-none cursor-pointer transition-all duration-200">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-[#0194F3] dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <button type="submit" class="hidden">Cari</button>
                    </form>
                </div>

                <!-- Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    <button onclick="openAddPenginapanModal()"
                        class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Penginapan
                    </button>
                </div>
            </div>

            {{-- Info Filter Aktif --}}
            @if (request('keyword') || request('category_id'))
                <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-[#687176] dark:text-gray-400">
                    <span>Filter aktif:</span>

                    @if (request('keyword'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-[#0194F3]/20 dark:to-[#0194F3]/10 text-[#0194F3] dark:text-[#33ADFF] border border-[#B3E0FF] dark:border-[#33ADFF]/30 font-medium">
                            🔍 "{{ request('keyword') }}"
                        </span>
                    @endif

                    @if (request('category_id'))
                        @php
                            $activeCategory = $categories->firstWhere('id', request('category_id'));
                        @endphp
                        @if ($activeCategory)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-[#0194F3]/20 dark:to-[#0194F3]/10 text-[#0194F3] dark:text-[#33ADFF] border border-[#B3E0FF] dark:border-[#33ADFF]/30 font-medium">
                                {{ $activeCategory->name }}
                            </span>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="flex flex-col">

        <!-- ========== DESKTOP TABLE — GRADIENT SEPERTI SIDEBAR ========== -->
        <div class="hidden md:block overflow-x-auto bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow-lg shadow-[#0194F3]/5">
                    <table class="min-w-full divide-y divide-[#B3E0FF] table-fixed dark:divide-gray-600">
                        <thead class="bg-gradient-to-r from-[#0194F3] via-[#0194F3] to-[#0064D2] dark:from-[#0194F3] dark:via-[#0194F3] dark:to-[#0064D2]">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[60px]">
                                    No</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Nama</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Kategori</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[150px]">
                                    Foto</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Alamat</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Harga</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Kapasitas</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[120px]">
                                    Status</th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[220px]">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700"
                            id="table-body">
                            @forelse($accommodations as $index => $accommodation)
                                <tr data-id="{{ $accommodation->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $accommodations->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium">
                                        {{ $accommodation->title }}
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white">
                                        {{ $accommodation->category->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs align-middle">
                                        @if ($accommodation->thumbnail)
                                            <div style="width:96px;height:64px;min-width:96px;min-height:64px;aspect-ratio:3/2;overflow:hidden;border-radius:0.5rem;background:#f3f4f6;border:1px solid #B3E0FF;flex-shrink:0;">
                                                <img src="{{ asset($accommodation->thumbnail) }}"
                                                    alt="{{ $accommodation->title }}"
                                                    loading="lazy"
                                                    style="display:block;width:100%;height:100%;object-fit:cover;object-position:center;">
                                            </div>
                                        @else
                                            <div style="width:96px;height:64px;min-width:96px;min-height:64px;aspect-ratio:3/2;background:linear-gradient(135deg,#E6F4FF,#B3E0FF);border-radius:0.5rem;display:flex;align-items:center;justify-content:center;color:#0194F3;font-size:11px;flex-shrink:0;">
                                                Tidak ada foto
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white">
                                        <div class="relative group max-w-[200px]">
                                            <div class="truncate cursor-pointer">
                                                {{ $accommodation->address ?? '-' }}
                                            </div>
                                            <div class="hidden group-hover:block absolute z-20
                                                        bottom-full left-0 mb-2
                                                        w-[200px] max-w-[calc(100vw-32px)]
                                                        p-4
                                                        rounded-lg
                                                        bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-900
                                                        border border-[#B3E0FF] dark:border-gray-700
                                                        shadow-xl">
                                                <div class="font-semibold text-[#0194F3] mb-1">
                                                    Alamat Lengkap
                                                </div>
                                                <div class="text-xs text-[#687176] dark:text-gray-300
                                                            whitespace-normal break-words leading-relaxed">
                                                    {{ $accommodation->address ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                                        Rp {{ number_format($accommodation->price, 0, ',', '.') }} <span
                                            class="text-[#687176] dark:text-gray-400 text-xs font-normal">/malam</span>
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white text-center">
                                        {{ $accommodation->capacity }} orang
                                    </td>
                                    <td class="p-4 text-xs">
                                        @php
                                            $statusColors = [
                                                'Available' => 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white',
                                                'Full' => 'bg-[#0064D2]/20 text-[#0064D2] dark:bg-[#0064D2]/30 dark:text-[#33ADFF]',
                                                'Maintenance' => 'bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]',
                                            ];
                                            $statusColor = $statusColors[$accommodation->status] ?? 'bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] text-[#0194F3] dark:from-gray-700 dark:to-gray-700 dark:text-gray-300';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                            {{ $accommodation->status ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            <button onclick="openDetailPenginapanModal({{ $accommodation->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#33ADFF] to-[#0194F3] hover:from-[#0194F3] hover:to-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Detail
                                            </button>
                                            <button onclick="openEditPenginapanModal({{ $accommodation->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $accommodation->id }}"
                                                data-name="{{ $accommodation->title }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        @if (request('keyword') || request('category_id'))
                                            Tidak ada penginapan yang sesuai dengan filter yang dipilih.
                                        @else
                                            Belum ada data penginapan.
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
        <div class="md:hidden p-3 space-y-3 bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
            @forelse($accommodations as $index => $accommodation)
                <div class="relative overflow-hidden border border-[#B3E0FF] dark:border-gray-600 rounded-xl bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 shadow-lg shadow-[#0194F3]/10 hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300">
                    {{-- Blob dekoratif --}}
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-8 -left-8 w-20 h-20 bg-[#33ADFF]/10 rounded-full blur-2xl pointer-events-none"></div>

                    @if ($accommodation->thumbnail)
                        <div class="relative w-full h-40 bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            <img src="{{ asset($accommodation->thumbnail) }}"
                                alt="{{ $accommodation->title }}"
                                loading="lazy"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="relative w-full h-40 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <span class="text-[#0194F3] dark:text-gray-400 text-xs">Tidak ada foto</span>
                        </div>
                    @endif

                    <div class="relative p-3">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <span class="text-[10px] text-[#687176] dark:text-gray-400">
                                #{{ $accommodations->firstItem() + $index }}
                            </span>
                            @php
                                $statusColors = [
                                    'Available' => 'bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white',
                                    'Full' => 'bg-[#0064D2]/20 text-[#0064D2] dark:bg-[#0064D2]/30 dark:text-[#33ADFF]',
                                    'Maintenance' => 'bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]',
                                ];
                                $statusColor = $statusColors[$accommodation->status] ?? 'bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] text-[#0194F3] dark:from-gray-700 dark:to-gray-700 dark:text-gray-300';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium {{ $statusColor }}">
                                {{ $accommodation->status ?? '-' }}
                            </span>
                        </div>

                        <h3 class="text-sm font-semibold text-[#0F294D] dark:text-white mb-1 truncate">
                            {{ $accommodation->title }}
                        </h3>

                        <p class="text-xs text-[#687176] dark:text-gray-400 mb-2">
                            {{ $accommodation->category->name ?? '-' }}
                        </p>

                        <div class="grid grid-cols-2 gap-2 text-xs mb-2">
                            <div>
                                <span class="text-[#687176] dark:text-gray-400">Harga:</span>
                                <p class="font-semibold text-[#0194F3] dark:text-[#33ADFF]">
                                    Rp {{ number_format($accommodation->price, 0, ',', '.') }}
                                    <span class="text-[#687176] dark:text-gray-400 text-[10px] font-normal">/malam</span>
                                </p>
                            </div>
                            <div>
                                <span class="text-[#687176] dark:text-gray-400">Kapasitas:</span>
                                <p class="font-medium text-[#0F294D] dark:text-white">
                                    {{ $accommodation->capacity }} orang
                                </p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <span class="text-xs text-[#687176] dark:text-gray-400">Alamat:</span>
                            <p class="text-xs text-[#0F294D] dark:text-white leading-relaxed break-words">
                                {{ $accommodation->address ?? '-' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-2 pt-3 border-t border-[#B3E0FF]/60 dark:border-gray-600">
                            <button onclick="openDetailPenginapanModal({{ $accommodation->id }})"
                                class="inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#33ADFF] to-[#0194F3] hover:from-[#0194F3] hover:to-[#0064D2] rounded-lg shadow-sm transition-all duration-200">
                                Detail
                            </button>
                            <button onclick="openEditPenginapanModal({{ $accommodation->id }})"
                                class="inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] rounded-lg shadow-sm transition-all duration-200">
                                Edit
                            </button>
                            <button
                                class="delete-btn inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm transition-all duration-200"
                                data-id="{{ $accommodation->id }}"
                                data-name="{{ $accommodation->title }}">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 text-[#687176] dark:text-gray-400 text-sm bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-700 rounded-xl">
                    @if (request('keyword') || request('category_id'))
                        Tidak ada penginapan yang sesuai dengan filter yang dipilih.
                    @else
                        Belum ada data penginapan.
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination — GRADIENT SEPERTI SIDEBAR -->
    @if (method_exists($accommodations, 'hasPages') && $accommodations->hasPages())
        <div class="relative overflow-hidden p-3 sm:p-4 bg-gradient-to-r from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 shadow-inner">
            {{-- Pattern dots subtle --}}
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(circle, #0194F3 1.5px, transparent 1.5px); background-size: 24px 24px;"></div>

            <div class="relative flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 text-center sm:text-left">
                    Menampilkan
                    <span class="font-semibold text-[#0F294D] dark:text-white">{{ $accommodations->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-[#0F294D] dark:text-white">{{ $accommodations->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-[#0F294D] dark:text-white">{{ $accommodations->total() }}</span>
                    data
                    @if (request('keyword') || request('category_id'))
                        <span class="text-[#0194F3] dark:text-[#33ADFF] block sm:inline">
                            (Hasil filter)
                        </span>
                    @endif
                </div>
                <div class="w-full sm:w-auto flex justify-center sm:justify-end">
                    {{ $accommodations->appends(request()->query())->links() }}
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

        // ========== FILTER KATEGORI ==========
        const categoryFilter = document.getElementById('category-filter');

        if (categoryFilter) {
            categoryFilter.addEventListener('change', function () {
                searchForm.submit();
            });
        }

        // ========== DELETE CONFIRMATION ==========
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const id = this.dataset.id;
                const name = this.dataset.name || 'penginapan ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus penginapan "${name}" secara permanen!`,
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
                        form.action = '{{ route('accommodations.destroy', '') }}/' + id;
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

        console.log('Halaman penginapan siap digunakan.');
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

    /* ===== TABLE HOVER (sudah diganti inline di <tr>) ===== */

    /* Anti-gepeng: img di tabel */
    #table-body td img {
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        width: 100% !important;
        height: 100% !important;
    }

    /* Mobile card hover */
    @media (hover: hover) and (max-width: 767px) {
        .md\:hidden > div:hover {
            box-shadow: 0 8px 16px -4px rgba(1, 148, 243, 0.25);
        }
    }
</style>