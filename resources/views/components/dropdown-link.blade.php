@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200']) }}>
    {{ $slot }}
</a>
