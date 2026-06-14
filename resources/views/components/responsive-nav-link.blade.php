@props(['active' => false])

@php
$classes = $active
    ? 'block w-full px-4 py-3 text-sm font-medium text-white bg-white/15 border-l-4 border-yellow-500 transition-all duration-200'
    : 'block w-full px-4 py-3 text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 border-l-4 border-transparent hover:border-yellow-500/50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
