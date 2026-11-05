@extends('example.layouts.default.dashboard')
@section('content')

    @include('example.layouts.partials.konten.modal_add_setting')
    @include('example.layouts.partials.konten.modal_edit_setting')
    @include('example.layouts.partials.konten.modal_detail_setting')

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
                <h1 class="text-lg sm:text-xl font-semibold text-[#0194F3] sm:text-2xl dark:text-[#33ADFF] flex items-start sm:items-center gap-2">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 mt-0.5 sm:mt-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Pengaturan Website</span>
                </h1>
                <p class="text-xs sm:text-sm text-[#687176] dark:text-gray-400 mt-1">Kelola pengaturan website secara terpusat</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Bagian Kiri: Informasi -->
                <div class="flex items-center w-full sm:w-auto">
                    <span class="text-sm text-[#687176] dark:text-gray-400 flex flex-wrap items-center gap-2">
                        <span>Total <span class="font-semibold text-[#0F294D] dark:text-white">{{ $settings->count() }}</span> pengaturan</span>
                        @if($settings->count() >= 1)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-[#E6F4FF] to-[#B3E0FF] text-[#0194F3] dark:from-[#33ADFF]/20 dark:to-[#33ADFF]/10 dark:text-[#B3E0FF]">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Maksimal 1
                            </span>
                        @endif
                    </span>
                </div>

                <!-- Bagian Kanan: Tombol Tambah -->
                <div class="flex items-center w-full sm:w-auto sm:justify-end">
                    @if($settings->count() < 1)
                        <button onclick="openAddSettingModal()"
                            class="text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] font-medium rounded-lg text-sm px-5 py-2.5 shadow-md shadow-[#0194F3]/30 focus:outline-none inline-flex items-center w-full sm:w-auto justify-center transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Pengaturan
                        </button>
                    @else
                        <div class="w-full sm:w-auto text-sm text-[#687176] dark:text-gray-400 italic inline-flex items-center justify-center sm:justify-start gap-1 px-3 py-2 rounded-lg bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700/50 dark:to-gray-700/30 border border-[#B3E0FF]/50 dark:border-gray-600/50">
                            <svg class="w-4 h-4 flex-shrink-0 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pengaturan sudah ada (maksimal 1)</span>
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
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[80px]">
                                    Logo
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Nama Website
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Tagline
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase">
                                    Email
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-white uppercase w-[220px]">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#B3E0FF] dark:divide-gray-700"
                            id="table-body">
                            @forelse($settings as $index => $setting)
                                <tr data-id="{{ $setting->id }}"
                                    class="bg-white/70 hover:bg-gradient-to-r hover:from-[#E6F4FF] hover:to-[#F0F9FF] dark:bg-gray-800/70 dark:hover:from-gray-700 dark:hover:to-gray-700 transition-all duration-200">
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        @if($setting->logo)
                                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}"
                                                class="w-12 h-12 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-[#B3E0FF] dark:border-gray-600 flex items-center justify-center">
                                                <span class="text-[#0194F3] text-[10px]">-</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-[#0F294D] dark:text-white font-medium">
                                        {{ $setting->site_name }}
                                    </td>
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400 max-w-[150px]">
                                        <div class="relative group inline-block max-w-full">
                                            <span class="cursor-help truncate block">
                                                {{ $setting->tagline ?? '-' }}
                                            </span>

                                            @if($setting->tagline)
                                                <div
                                                    class="hidden group-hover:block absolute z-50 bottom-full left-0 mb-2 w-[350px] max-w-[calc(100vw-32px)] p-3 rounded-lg bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-900 border border-[#B3E0FF] dark:border-gray-700 shadow-2xl pointer-events-none">
                                                    <div class="flex items-center gap-1.5 font-semibold text-[#0194F3] dark:text-[#33ADFF] mb-1.5">
                                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Tagline
                                                    </div>
                                                    <div class="text-xs text-[#687176] dark:text-gray-300 whitespace-normal break-words leading-relaxed">
                                                        {{ $setting->tagline }}
                                                    </div>
                                                    {{-- Arrow --}}
                                                    <div
                                                        class="absolute top-full left-4 -mt-1 w-2 h-2 rotate-45 bg-white dark:bg-gray-900 border-r border-b border-[#B3E0FF] dark:border-gray-700">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs text-[#687176] dark:text-gray-400">
                                        {{ $setting->email ?? '-' }}
                                    </td>
                                    <td class="p-4 text-xs">
                                        <div class="flex items-center gap-1.5">
                                            {{-- Detail — biru muda --}}
                                            <button
                                                onclick="openDetailSettingModal({{ $setting->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#33ADFF] to-[#0194F3] hover:from-[#0194F3] hover:to-[#0064D2] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Detail
                                            </button>
                                            <button onclick="openEditSettingModal({{ $setting->id }})"
                                                class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] focus:ring-4 focus:ring-[#B3E0FF] rounded-lg shadow-sm min-w-[55px] transition-all duration-200">
                                                Edit
                                            </button>
                                            <button
                                                class="delete-btn inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-center text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:ring-red-300 rounded-lg shadow-sm min-w-[55px] transition-all duration-200"
                                                data-id="{{ $setting->id }}" data-name="{{ $setting->site_name }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-6 text-[#687176] dark:text-gray-400 bg-white/70 dark:bg-gray-800/70">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 mb-3 rounded-full bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-[#0194F3] dark:text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-base font-medium text-[#0F294D] dark:text-gray-300">Belum ada
                                                pengaturan</p>
                                            <p class="text-sm text-[#687176] dark:text-gray-500 mt-1">Klik tombol "Tambah
                                                Pengaturan" untuk menambahkan</p>
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
            @forelse($settings as $index => $setting)
                <div class="relative overflow-hidden border border-[#B3E0FF] dark:border-gray-600 rounded-xl bg-gradient-to-br from-white via-[#F7F9FC] to-[#E6F4FF] dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 shadow-lg shadow-[#0194F3]/10 hover:shadow-xl hover:shadow-[#0194F3]/20 transition-all duration-300">
                    {{-- Blob dekoratif --}}
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-[#0194F3]/10 rounded-full blur-2xl pointer-events-none"></div>

                    {{-- Header: Logo + Nama + Nomor --}}
                    <div class="relative p-3 border-b border-[#B3E0FF]/60 dark:border-gray-600 bg-gradient-to-r from-[#E6F4FF] to-[#F0F9FF] dark:from-gray-700/40 dark:to-gray-700/20">
                        <div class="flex items-center gap-3">
                            {{-- Logo --}}
                            <div class="flex-shrink-0">
                                @if($setting->logo)
                                    <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}"
                                        loading="lazy"
                                        class="w-14 h-14 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">
                                @else
                                    <div class="w-14 h-14 flex items-center justify-center bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 rounded-lg border border-dashed border-[#B3E0FF] dark:border-gray-600">
                                        <svg class="w-6 h-6 text-[#0194F3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Nama + Nomor --}}
                            <div class="flex-1 min-w-0">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-gradient-to-r from-[#0194F3] to-[#0064D2] text-white mb-1 shadow-sm">
                                    #{{ $index + 1 }}
                                </span>
                                <h3 class="text-sm font-semibold text-[#0F294D] dark:text-white truncate">
                                    {{ $setting->site_name }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="relative p-3">
                        {{-- Tagline --}}
                        <div class="mb-2">
                            <span class="text-[10px] text-[#687176] dark:text-gray-400 uppercase tracking-wide font-medium">
                                Tagline
                            </span>
                            <p class="text-xs text-[#0F294D] dark:text-gray-300 leading-relaxed break-words mt-0.5">
                                {{ $setting->tagline ?? '-' }}
                            </p>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <span class="text-[10px] text-[#687176] dark:text-gray-400 uppercase tracking-wide font-medium">
                                Email
                            </span>
                            <p class="text-xs text-[#0F294D] dark:text-gray-300 break-all mt-0.5">
                                {{ $setting->email ?? '-' }}
                            </p>
                        </div>

                        {{-- Aksi: 3 tombol full-width --}}
                        <div class="grid grid-cols-3 gap-2 pt-3 border-t border-[#B3E0FF]/60 dark:border-gray-600">
                            <button onclick="openDetailSettingModal({{ $setting->id }})"
                                class="inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#33ADFF] to-[#0194F3] hover:from-[#0194F3] hover:to-[#0064D2] rounded-lg shadow-sm transition-all duration-200">
                                Detail
                            </button>
                            <button onclick="openEditSettingModal({{ $setting->id }})"
                                class="inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-[#0194F3] to-[#0064D2] hover:from-[#0064D2] hover:to-[#0194F3] rounded-lg shadow-sm transition-all duration-200">
                                Edit
                            </button>
                            <button
                                class="delete-btn inline-flex items-center justify-center px-2 py-2 text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm transition-all duration-200"
                                data-id="{{ $setting->id }}" data-name="{{ $setting->site_name }}">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-6 text-[#687176] dark:text-gray-400 bg-gradient-to-br from-white to-[#F7F9FC] dark:from-gray-800 dark:to-gray-700 rounded-xl">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-16 h-16 mb-3 rounded-full bg-gradient-to-br from-[#E6F4FF] to-[#B3E0FF] dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                            <svg class="w-8 h-8 text-[#0194F3] dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-base font-medium text-[#0F294D] dark:text-gray-300">Belum ada pengaturan</p>
                        <p class="text-sm text-[#687176] dark:text-gray-500 mt-1 px-4">
                            Klik tombol "Tambah Pengaturan" di atas untuk menambahkan
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

    <!-- Info Pengaturan Maksimal 1 (Floating) -->
    @if($settings->count() >= 1)
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
                            Hanya 1 pengaturan yang diperbolehkan
                        </p>
                        <p class="text-xs opacity-75 mt-0.5">
                            Edit pengaturan yang ada atau hapus untuk menambah yang baru
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
                const name = this.dataset.name || 'pengaturan ini';

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Anda akan menghapus pengaturan "${name}" secara permanen!`,
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
                        form.action = '{{ route('pengaturan.destroy', ':id') }}'.replace(':id', id);
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

        console.log('Halaman pengaturan siap digunakan.');
    });

    // =========================================================
    // OPEN DETAIL SETTING MODAL
    // =========================================================
    function openDetailSettingModal(id) {
        const modal = document.getElementById('detailSettingModal');

        if (!modal) {
            console.error('Modal detail setting tidak ditemukan.');
            return;
        }

        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        switchDetailSettingTab('detailSettingInformasi');

        const url = '{{ route('pengaturan.show', ':id') }}'.replace(':id', id);

        console.log('Mengambil data pengaturan:', url);

        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Status response:', response.status);

            if (!response.ok) {
                throw new Error('Gagal mengambil data pengaturan. Status: ' + response.status);
            }

            return response.json();
        })
        .then(result => {
            console.log('HASIL DATA PENGATURAN:', result);

            if (!result.success || !result.data) {
                throw new Error(result.message || 'Data pengaturan tidak ditemukan.');
            }

            const setting = result.data;

            setDetailText('detailSettingNama', setting.site_name);
            setDetailText('detailSettingTagline', setting.tagline);
            setDetailText('detailSettingDeskripsi', setting.about);

            const logo = document.getElementById('detailSettingLogo');
            const logoEmpty = document.getElementById('detailSettingLogoEmpty');

            if (logo) {
                if (setting.logo_url) {
                    logo.src = setting.logo_url;
                    logo.classList.remove('hidden');

                    if (logoEmpty) {
                        logoEmpty.classList.add('hidden');
                    }
                } else {
                    logo.src = '';
                    logo.classList.add('hidden');

                    if (logoEmpty) {
                        logoEmpty.classList.remove('hidden');
                    }
                }
            }

            setDetailText('detailSettingAlamat', setting.address);
            setDetailText('detailSettingPhone', setting.phone);
            setDetailText('detailSettingWhatsapp', setting.whatsapp);
            setDetailText('detailSettingEmail', setting.email);
            setDetailText('detailSettingMapsEmbed', setting.maps_embed);

            setDetailText('detailSettingFacebook', setting.facebook);
            setDetailText('detailSettingInstagram', setting.instagram);
            setDetailText('detailSettingTwitter', setting.x);
            setDetailText('detailSettingYoutube', setting.youtube);
            setDetailText('detailSettingTiktok', setting.tiktok);

            setDetailText('detailSettingMetaTitle', setting.meta_title);
            setDetailText('detailSettingMetaDescription', setting.meta_description);
            setDetailText('detailSettingMetaKeywords', setting.meta_keywords);

            setDetailText('detailSettingFooterDescription', setting.footer_description);
            setDetailText('detailSettingCopyright', setting.copyright);

            console.log('Data detail pengaturan berhasil ditampilkan.');
        })
        .catch(error => {
            console.error('ERROR MENGAMBIL DATA PENGATURAN:', error);

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data pengaturan gagal dimuat.'
            });
        });
    }

    function switchDetailSettingTab(tabId) {
        const contents = document.querySelectorAll('.detail-setting-tab-content');
        contents.forEach(content => {
            content.classList.add('hidden');
        });

        const buttons = document.querySelectorAll('#detailSettingTab button');
        buttons.forEach(button => {
            button.classList.remove(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );

            button.classList.add(
                'text-[#687176]',
                'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );
        });

        const activeContent = document.getElementById(tabId);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }

        const activeButton = document.querySelector(
            `#detailSettingTab button[data-tab="${tabId}"]`
        );

        if (activeButton) {
            activeButton.classList.remove(
                'text-[#687176]',
                'dark:text-gray-400',
                'hover:bg-white', 'hover:text-[#0194F3]',
                'dark:hover:bg-gray-700', 'dark:hover:text-[#33ADFF]'
            );

            activeButton.classList.add(
                'bg-gradient-to-r', 'from-[#0194F3]', 'to-[#0064D2]',
                'text-white', 'shadow-md', 'shadow-[#0194F3]/30'
            );
        }
    }

    function setDetailText(elementId, value) {
        const element = document.getElementById(elementId);
        if (element) {
            element.textContent = value ?? '-';
        }
    }

    function closeDetailSettingModal() {
        const modal = document.getElementById('detailSettingModal');
        if (modal) {
            modal.classList.add('hidden');
        }
        document.body.classList.remove('overflow-hidden');
    }
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
        .md\:hidden > div:hover {
            box-shadow: 0 8px 16px -4px rgba(1, 148, 243, 0.25);
        }
    }
</style>