@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-gray-300 rounded-lg text-sm font-medium hover:bg-white/20 hover:text-white transition-all border border-white/10 disabled:opacity-50']) !!}>
    {{ $slot }}
</button>
