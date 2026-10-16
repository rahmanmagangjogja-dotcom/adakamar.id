@extends('landingpage.layouts.default.baseof')

@section('main')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('landingpage.layouts.partials.navbar-dashboard')

    <!-- Main Content - TANPA padding & background -->
    <main>
        @yield('content')
    </main>

    @include('landingpage.layouts.partials.footer-dashboard')
@endsection