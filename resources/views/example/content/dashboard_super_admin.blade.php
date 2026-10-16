@extends('example.layouts.default.dashboard')
@section('content')

    {{-- ===== HEADER DASHBOARD - FIXED ===== --}}
    <div
        class="fixed top-16 left-0 right-0 z-30 px-4 py-3 bg-white/95 backdrop-blur-md border-b border-[#0194F3] dark:bg-gray-800/95 dark:border-[#33ADFF] shadow-sm lg:left-64">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-lg font-semibold text-[#0194F3] sm:text-xl dark:text-[#33ADFF] flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                    Dashboard
                </h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Selamat datang di dashboard admin!</p>
            </div>
        </div>
    </div>

    {{-- ===== SPACER agar konten tidak ketutup header fixed ===== --}}
    {{-- top-16 (navbar) + tinggi header dashboard (~64px) = ~128px --}}
    <div class="h-32"></div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
        <!-- Total Penginapan -->
        <div class="bg-white rounded-lg shadow-md p-5 border-l-4 border-[#0194F3] dark:bg-gray-800 dark:border-[#33ADFF]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Penginapan</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="totalAccommodations">0</p>
                </div>
                <div class="p-3 bg-[#E6F4FF] rounded-full dark:bg-gray-700">
                    <svg class="w-6 h-6 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500 dark:text-gray-400">Total data penginapan</span>
            </div>
        </div>

        <!-- Total Artikel -->
        <div class="bg-white rounded-lg shadow-md p-5 border-l-4 border-[#3B82F6] dark:bg-gray-800 dark:border-[#60A5FA]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Artikel</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="totalArticles">0</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-full dark:bg-gray-700">
                    <svg class="w-6 h-6 text-[#3B82F6] dark:text-[#60A5FA]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500 dark:text-gray-400">Total data artikel</span>
            </div>
        </div>

        <!-- Published Artikel -->
        <div class="bg-white rounded-lg shadow-md p-5 border-l-4 border-[#10B981] dark:bg-gray-800 dark:border-[#34D399]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Published Artikel</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="publishedArticles">0</p>
                </div>
                <div class="p-3 bg-green-50 rounded-full dark:bg-gray-700">
                    <svg class="w-6 h-6 text-[#10B981] dark:text-[#34D399]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500 dark:text-gray-400">Artikel yang dipublish</span>
            </div>
        </div>

        <!-- Draft Artikel -->
        <div class="bg-white rounded-lg shadow-md p-5 border-l-4 border-[#F59E0B] dark:bg-gray-800 dark:border-[#FBBF24]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Draft Artikel</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white" id="draftArticles">0</p>
                </div>
                <div class="p-3 bg-yellow-50 rounded-full dark:bg-gray-700">
                    <svg class="w-6 h-6 text-[#F59E0B] dark:text-[#FBBF24]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500 dark:text-gray-400">Artikel yang masih draft</span>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">
        <div class="bg-white rounded-lg shadow-md p-5 dark:bg-gray-800">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zm6-4a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zm6-3a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                </svg>
                Penginapan per Kategori
            </h3>
            <div class="h-64" id="chartAccommodationCategories">
                <canvas id="accommodationChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5 dark:bg-gray-800">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                <svg class="w-4 h-4 inline mr-2 text-[#3B82F6] dark:text-[#60A5FA]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z" />
                </svg>
                Status Penginapan
            </h3>
            <div class="h-64" id="chartStatusAccommodations">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Daftar Penginapan & Artikel Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4">
        <div class="bg-white rounded-lg shadow-md p-5 dark:bg-gray-800">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                <svg class="w-4 h-4 inline mr-2 text-[#0194F3] dark:text-[#33ADFF]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Penginapan Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#B3E0FF] dark:divide-gray-700">
                    <thead class="bg-[#E6F4FF] dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Foto</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Nama</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Kategori</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Tanggal</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#B3E0FF] dark:bg-gray-800 dark:divide-gray-700"
                        id="recentAccommodations">
                        <tr>
                            <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Memuat
                                data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5 dark:bg-gray-800">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                <svg class="w-4 h-4 inline mr-2 text-[#3B82F6] dark:text-[#60A5FA]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v2H6V6zm0 4h8v2H6v-2zm0 4h8v2H6v-2z"
                        clip-rule="evenodd" />
                </svg>
                Artikel Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#B3E0FF] dark:divide-gray-700">
                    <thead class="bg-[#E6F4FF] dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Foto</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Judul</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Kategori</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Tanggal</th>
                            <th scope="col"
                                class="px-3 py-2 text-left text-xs font-medium text-[#0194F3] uppercase dark:text-[#33ADFF]">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#B3E0FF] dark:bg-gray-800 dark:divide-gray-700"
                        id="recentArticles">
                        <tr>
                            <td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Memuat
                                data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Flash messages & script tetap sama seperti sebelumnya --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', timer: 3000, showConfirmButton: false });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/dashboard', {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dashboardData = data.data;
                        document.getElementById('totalAccommodations').textContent = dashboardData.totalAccommodations || 0;
                        document.getElementById('publishedArticles').textContent = dashboardData.publishedArticles || 0;
                        document.getElementById('totalArticles').textContent = dashboardData.totalArticles || 0;
                        document.getElementById('draftArticles').textContent = dashboardData.draftArticles || 0;
                        renderRecentAccommodations(dashboardData.accommodations || []);
                        renderRecentArticles(dashboardData.articles || []);
                        renderAccommodationChart(dashboardData.accommodations || []);
                        renderStatusChart(dashboardData.accommodations || []);
                    } else {
                        showError('Gagal memuat data dashboard');
                    }
                })
                .catch(error => { console.error('Error:', error); showError('Terjadi kesalahan saat memuat data'); });

            function formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            }

            function renderAccommodationChart(accommodations) {
                const ctx = document.getElementById('accommodationChart').getContext('2d');
                const categoryMap = {};
                accommodations.forEach(item => {
                    const category = item.category_name || 'Tanpa Kategori';
                    categoryMap[category] = (categoryMap[category] || 0) + 1;
                });
                const labels = Object.keys(categoryMap);
                const values = Object.values(categoryMap);
                const colors = ['#0194F3', '#0064D2', '#33ADFF', '#3B82F6', '#8B5CF6', '#EC4899', '#14B8A6', '#F97316', '#6366F1', '#84CC16'];
                new Chart(ctx, {
                    type: 'bar',
                    data: { labels, datasets: [{ label: 'Jumlah Penginapan', data: values, backgroundColor: colors.slice(0, labels.length), borderColor: colors.slice(0, labels.length).map(c => c + 'cc'), borderWidth: 1 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }

            function renderStatusChart(accommodations) {
                const ctx = document.getElementById('statusChart').getContext('2d');
                const statusCount = { 'Available': 0, 'Full': 0, 'Maintenance': 0 };
                accommodations.forEach(item => { if (item.status && statusCount.hasOwnProperty(item.status)) statusCount[item.status]++; });
                const labels = Object.keys(statusCount);
                const values = Object.values(statusCount);
                const colors = ['#10B981', '#EF4444', '#F59E0B'];
                new Chart(ctx, {
                    type: 'doughnut',
                    data: { labels, datasets: [{ data: values, backgroundColor: colors, borderColor: colors.map(c => c + 'cc'), borderWidth: 1 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } } }
                });
            }

            function renderRecentAccommodations(accommodations) {
                const container = document.getElementById('recentAccommodations');
                if (!accommodations || accommodations.length === 0) {
                    container.innerHTML = `<tr><td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada penginapan</td></tr>`;
                    return;
                }
                const statusColors = {
                    'Available': 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                    'Full': 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                    'Maintenance': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                };
                container.innerHTML = accommodations.map(a => `
                        <tr class="hover:bg-[#E6F4FF] dark:hover:bg-gray-700 transition-colors">
                            <td class="px-3 py-3 text-sm">
                                ${a.thumbnail ? `<img src="{{ asset('') }}${a.thumbnail.replace(/^public\//, '')}" alt="${a.title}" class="w-20 h-12 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">` : `<div class="w-20 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Image</div>`}
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-900 dark:text-white font-medium truncate max-w-[120px]">${a.title || '-'}</td>
                            <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400">${a.category_name || '-'}</td>
                            <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">${formatDate(a.created_at)}</td>
                            <td class="px-3 py-3 text-sm">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${statusColors[a.status] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'}">${a.status || '-'}</span>
                            </td>
                        </tr>
                    `).join('');
            }

            function renderRecentArticles(articles) {
                const container = document.getElementById('recentArticles');
                if (!articles || articles.length === 0) {
                    container.innerHTML = `<tr><td colspan="5" class="px-3 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada artikel</td></tr>`;
                    return;
                }
                container.innerHTML = articles.map(a => `
                        <tr class="hover:bg-[#E6F4FF] dark:hover:bg-gray-700 transition-colors">
                            <td class="px-3 py-3 text-sm">
                                ${a.thumbnail ? `<img src="{{ asset('') }}${a.thumbnail.replace(/^public\//, '')}" alt="${a.title}" class="w-20 h-12 object-cover rounded-lg border border-[#B3E0FF] dark:border-gray-600">` : `<div class="w-20 h-12 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Image</div>`}
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-900 dark:text-white truncate max-w-[120px]">${a.title || '-'}</td>
                            <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400">${a.category_name || '-'}</td>
                            <td class="px-3 py-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">${formatDate(a.created_at)}</td>
                            <td class="px-3 py-3 text-sm">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${a.status === 'Published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'}">${a.status || 'Draft'}</span>
                            </td>
                        </tr>
                    `).join('');
            }

            function showError(message) {
                Swal.fire({ icon: 'error', title: 'Gagal!', text: message, timer: 3000, showConfirmButton: false });
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

        #recentArticles tr:hover,
        #recentAccommodations tr:hover {
            background-color: #E6F4FF;
            transition: background-color 0.2s ease;
        }

        .dark #recentArticles tr:hover,
        .dark #recentAccommodations tr:hover {
            background-color: #374151;
        }

        #accommodationChart,
        #statusChart {
            max-height: 250px;
        }
    </style>
@endsection