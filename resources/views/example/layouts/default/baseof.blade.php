<!doctype html>
<html lang="en" class="dark">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('example.layouts.partials.header')

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@0.507.0/dist/umd/lucide.min.js"></script>
</head>

@php
$whiteBg = isset($params['white_bg']) && $params['white_bg'];
@endphp

<body class="{{ $whiteBg ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }}">

    @yield('main')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif

    <script>
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function() {
            history.pushState(null, null, location.href);
        });
    </script>

    {{-- Script global --}}
    @include('example.layouts.partials.scripts')

    {{-- Script dari setiap halaman --}}
    @stack('scripts')

    {{-- ===== INIT LUCIDE GLOBAL ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) lucide.createIcons();
        });

        // Global helper
        window.renderLucide = function() {
            if (window.lucide) lucide.createIcons();
        };
    </script>

</body>

</html>