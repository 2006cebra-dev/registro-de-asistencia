@props(['active' => false])

@php
$classes = $active
    ? 'inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-white/15 rounded-lg transition-all duration-200'
    : 'inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
