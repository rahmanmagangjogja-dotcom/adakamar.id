@php
    $iconName = $icon ?? null;
    $size = $size ?? 20;
    $wrapperClass = $wrapperClass ?? '';
    $colorClass = $colorClass ?? 'text-[#0194F3] dark:text-[#33ADFF]';

    // Deteksi format lama sebagai fallback
    $isSvgPath = $iconName && (Str::startsWith($iconName, ['M', 'm']) || Str::startsWith($iconName, '<'));
    $isEmoji = $iconName && !$isSvgPath && !preg_match('/^[a-z0-9-]+$/i', $iconName);
@endphp

@if ($iconName && !$isSvgPath && !$isEmoji)
    {{-- Lucide icon (nama) --}}
    <span class="inline-flex items-center justify-center {{ $wrapperClass }}" title="{{ $iconName }}">
        <i data-lucide="{{ $iconName }}" style="width:{{ $size }}px;height:{{ $size }}px;"
            class="{{ $colorClass }}"></i>
    </span>
@elseif ($isSvgPath)
    {{-- Fallback: SVG path lama --}}
    <span class="inline-flex items-center justify-center {{ $wrapperClass }}" title="{{ $iconName }}">
        <svg style="width:{{ $size }}px;height:{{ $size }}px;" class="{{ $colorClass }}" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconName }}" />
        </svg>
    </span>
@elseif ($isEmoji)
    {{-- Fallback: emoji lama --}}
    <span class="inline-flex items-center justify-center {{ $wrapperClass }} text-lg" title="{{ $iconName }}">
        {{ $iconName }}
    </span>
@else
    {{-- Kosong --}}
    <span class="inline-flex items-center justify-center {{ $wrapperClass }} text-gray-400 dark:text-gray-500"
        title="Tidak ada icon">
        <i data-lucide="minus" style="width:{{ $size }}px;height:{{ $size }}px;"></i>
    </span>
@endif