@props(['id' => '', 'maxWidth' => '2xl'])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    id="{{ $id }}"
    class="fixed inset-0 z-[60] overflow-y-auto px-4 py-6 sm:px-0"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" x-on:click="show = false"></div>

    <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="mb-6 bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl border border-white/10 shadow-2xl overflow-hidden {{ $maxWidth }} mx-auto">
        {{ $slot }}
    </div>
</div>
