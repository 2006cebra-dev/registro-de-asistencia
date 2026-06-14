@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full rounded-lg bg-white/10 border border-white/20 text-white px-3 py-2.5 text-sm focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-500 outline-none transition-all placeholder:text-gray-500 disabled:opacity-50']) !!}>
