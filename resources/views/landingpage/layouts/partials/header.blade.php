
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- SEO Title --}}
<title>{{ $metaTitle ?? $title ?? 'adakamar.id - Informasi Penginapan' }}</title>

{{-- Meta Description --}}
<meta name="description"
    content="{{ $metaDescription ?? 'Temukan informasi penginapan, artikel, dan berbagai informasi menarik di adakamar.id.' }}">

{{-- Meta Keywords --}}
@if(!empty($metaKeywords))
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif

{{-- Author --}}
<meta name="author" content="{{ $metaAuthor ?? 'adakamar.id' }}">
<meta name="generator" content="Laravel">

{{-- Canonical --}}
<link rel="canonical" href="{{ $canonical ?? url()->current() }}">

{{-- Robots --}}
@if(isset($robots) && $robots !== '')
    <meta name="robots" content="{{ $robots }}">
@elseif(isset($page->params['robots']))
    <meta name="robots" content="{{ $page->params['robots'] }}">
@else
    <meta name="robots" content="index, follow">
@endif

{{-- Open Graph --}}
<meta property="og:locale" content="id_ID">
<meta property="og:site_name" content="adakamar.id">
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:title" content="{{ $ogTitle ?? $metaTitle ?? $title ?? 'adakamar.id' }}">
<meta property="og:description"
    content="{{ $ogDescription ?? $metaDescription ?? 'Temukan informasi penginapan di adakamar.id.' }}">
<meta property="og:url" content="{{ $canonical ?? url()->current() }}">

@if(!empty($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:alt" content="{{ $ogImageAlt ?? $ogTitle ?? $metaTitle ?? $title ?? 'adakamar.id' }}">
@endif

{{-- Twitter / X Card --}}
<meta name="twitter:card" content="{{ !empty($ogImage) ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $ogTitle ?? $metaTitle ?? $title ?? 'adakamar.id' }}">
<meta name="twitter:description"
    content="{{ $ogDescription ?? $metaDescription ?? 'Temukan informasi penginapan di adakamar.id.' }}">

@if(!empty($ogImage))
    <meta name="twitter:image" content="{{ $ogImage }}">
@endif

{{-- Structured Data / JSON-LD --}}
@if(!empty($structuredData))
    <script type="application/ld+json">{!! json_encode(
            $structuredData,
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_HEX_TAG |
            JSON_HEX_AMP |
            JSON_HEX_APOS |
            JSON_HEX_QUOT
        ) !!}</script>
@endif

{{-- Load CSS and JS --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Existing partials --}}
@include('landingpage.layouts.partials.stylesheet')
@include('landingpage.layouts.partials.favicons')
@include('landingpage.layouts.partials.social')
@include('landingpage.layouts.partials.analytics')

{{-- Dark / Light Theme --}}
<script>
    (() => {
        try {
            const savedTheme = localStorage.getItem('color-theme');
            const prefersDark = window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches;

            const useDark = savedTheme
                ? savedTheme === 'dark'
                : prefersDark;

            document.documentElement.classList.toggle('dark', useDark);
        } catch (error) {
            // Jika localStorage tidak tersedia, biarkan CSS menentukan tema.
        }
    })();
</script>
