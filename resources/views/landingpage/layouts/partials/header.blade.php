<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- SEO Title --}}
<title>{{ $title ?? 'adakamar.id' }}</title>

{{-- Meta Description --}}
<meta name="description"
    content="{{ $metaDescription ?? 'Temukan informasi penginapan, artikel, dan berbagai informasi menarik di adakamar.id.' }}">

{{-- Meta Keywords --}}
@if(isset($metaKeywords) && $metaKeywords)
    <meta name="keywords" content="{{ $metaKeywords }}">
@endif

{{-- Author --}}
<meta name="author" content="{{ $metaAuthor ?? 'adakamar.id' }}">

<meta name="generator" content="Laravel">

{{-- Canonical --}}
<link rel="canonical" href="{{ $canonical ?? url()->current() }}">

{{-- Robots --}}
@if(isset($robots))
    <meta name="robots" content="{{ $robots }}">
@elseif(isset($page->params['robots']))
    <meta name="robots" content="{{ $page->params['robots'] }}">
@else
    <meta name="robots" content="index, follow">
@endif

{{-- Open Graph --}}
<meta property="og:title" content="{{ $ogTitle ?? $title ?? 'adakamar.id' }}">

<meta property="og:description"
    content="{{ $ogDescription ?? $metaDescription ?? 'Temukan informasi penginapan, artikel, dan berbagai informasi menarik di adakamar.id.' }}">

@if(isset($ogImage) && $ogImage)
    <meta property="og:image" content="{{ $ogImage }}">
@endif

<meta property="og:url" content="{{ $canonical ?? url()->current() }}">

<meta property="og:type" content="{{ $ogType ?? 'website' }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])

@include('landingpage.layouts.partials.stylesheet')
@include('landingpage.layouts.partials.favicons')
@include('landingpage.layouts.partials.social')
@include('landingpage.layouts.partials.analytics')

<script>
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>