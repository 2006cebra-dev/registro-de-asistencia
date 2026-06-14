@props(['disabled' => false])

<button {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200 disabled:opacity-50']) !!}>
    {{ $slot }}
</button>
