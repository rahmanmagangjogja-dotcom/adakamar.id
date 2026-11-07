@extends('landingpage.layouts.default.baseof')

@section('main')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
      $isHeroPage = request()->routeIs('landingpage') || request()->is('/');
      $homeUrl = Route::has('landingpage') ? route('landingpage') : url('/');
      $navHref = function($id) use ($isHeroPage, $homeUrl) {
          return $isHeroPage ? '#' . $id : $homeUrl . '#' . $id;
      };
    @endphp

    @include('landingpage.layouts.partials.navbar-dashboard', compact('isHeroPage', 'homeUrl', 'navHref'))

    <!-- Main Content - TANPA padding & background -->
    <main>
        @yield('content')
    </main>

    @include('landingpage.layouts.partials.footer-dashboard', compact('isHeroPage', 'homeUrl', 'navHref'))
@endsection