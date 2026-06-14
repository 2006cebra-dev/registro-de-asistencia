<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Asistencia') - Asistencia QR</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script data-cfasync="false" src="https://cdn.tailwindcss.com"></script>
    <script data-cfasync="false" defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; letter-spacing: 0.01em; }
        .gold-accent { color: #d4a843; }
        .gold-border { border-color: #d4a843; }
        .gold-bg { background-color: #d4a843; }
        .hover-gold:hover { color: #d4a843; }
        .nav-link { @apply px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200; }
        .nav-link:hover { @apply bg-white/10; }
        .nav-link-active { @apply bg-white/15 text-white; }
        .btn-primary { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1.25rem; background: linear-gradient(135deg, #d4a843, #a16207); color: #fff; border-radius: .5rem; font-weight: 600; font-size: .875rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,.1); transition: all .2s; }
        .btn-primary:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); background: linear-gradient(135deg, #eab308, #ca8a04); }
        .btn-success { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1.25rem; background: linear-gradient(135deg, #16a34a, #15803d); color: #fff; border-radius: .5rem; font-weight: 600; font-size: .875rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,.1); transition: all .2s; }
        .btn-success:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); }
        .btn-warning { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1.25rem; background: linear-gradient(135deg, #eab308, #a16207); color: #fff; border-radius: .5rem; font-weight: 600; font-size: .875rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,.1); transition: all .2s; }
        .btn-warning:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); }
        .btn-outline { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1.25rem; border: 2px solid rgba(255,255,255,.2); color: #d1d5db; border-radius: .5rem; font-weight: 600; font-size: .875rem; transition: all .2s; }
        .btn-outline:hover { background: rgba(255,255,255,.1); color: #fff; }
        .btn-gold { display: inline-flex; align-items: center; gap: .5rem; padding: .625rem 1.25rem; background: linear-gradient(135deg, #ca8a04, #a16207); color: #fff; border-radius: .5rem; font-weight: 600; font-size: .875rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,.1); cursor: pointer; transition: all .2s; }
        .btn-gold:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,.1); background: linear-gradient(135deg, #eab308, #ca8a04); }
        .table-header { padding: .75rem 1rem; text-align: left; font-size: .75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: .05em; }
        .table-cell { padding: .75rem 1rem; font-size: .875rem; color: #d1d5db; }
        .input-field { width: 100%; border-radius: .5rem; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); color: #fff; padding: .625rem .75rem; font-size: .875rem; transition: all .2s; }
        .input-field:focus { border-color: #d4a843; outline: none; box-shadow: 0 0 0 3px rgba(212,168,67,.25); }
        .input-field::placeholder { color: rgba(255,255,255,.35); }
        .input-label { display: block; font-size: .875rem; font-weight: 500; color: #d1d5db; margin-bottom: .25rem; }
        .bg-dark-card { background: #132347; }
        .bg-dark-bg { background: #0a1628; }
        .border-gold { border-color: #d4a843; }
        .text-gold { color: #d4a843; }

        @media (max-width: 767px) {
            * { backdrop-filter: none !important; -webkit-backdrop-filter: none !important; }
        }

        .toast-enter { animation: toastIn 0.4s ease-out forwards; }
        .toast-leave { animation: toastOut 0.3s ease-in forwards; }
        @keyframes toastIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes toastOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        .pagination-links { display: flex; gap: 0.375rem; flex-wrap: wrap; }
        .pagination-links a, .pagination-links span { padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-size: 0.875rem; transition: all 0.2s; }
        .pagination-links a { background: rgba(255,255,255,0.06); color: #9ca3af; border: 1px solid rgba(255,255,255,0.1); }
        .pagination-links a:hover { background: rgba(212,168,67,0.2); color: #d4a843; }
        .pagination-links span:first-child, .pagination-links span:last-child { background: rgba(255,255,255,0.06); color: #6b7280; border: 1px solid rgba(255,255,255,0.1); }
        .pagination-links .active span { background: rgba(212,168,67,0.25); color: #d4a843; border-color: rgba(212,168,67,0.25); }
    </style>
</head>
<body class="font-sans antialiased bg-[#0a1628]">
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-3 pointer-events-none">
    </div>

    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @isset($header)
            <header class="max-w-6xl mx-auto w-full mt-3 sm:mt-4 px-3 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-xl sm:rounded-2xl bg-[#132347] border border-white/10 py-3 sm:py-4 px-4 sm:px-6 text-white shadow-lg">
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-yellow-500/10 rounded-full blur-2xl"></div>
                    <div class="relative">
                        <h1 class="text-lg sm:text-2xl font-bold tracking-tight">{{ $header }}</h1>
                    </div>
                </div>
            </header>
        @endisset

        <main class="flex-1">
            <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-6 pt-14 md:pt-6 pb-20 md:pb-6">
                {{ $slot }}
            </div>
        </main>

        <footer class="border-t border-white/5 bg-[#0a1628]">
            <div class="max-w-6xl mx-auto px-4 py-5 text-center">
                <p class="text-white/30 text-xs">&copy; {{ date('Y') }} Sistema de Asistencia QR</p>
            </div>
        </footer>
    </div>

    <script data-cfasync="false">
        function showToast(type, message) {
            const container = document.getElementById('toast-container');
            const icons = {
                success: '<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                error: '<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                warning: '<svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>',
                info: '<svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            };
            const borders = {
                success: 'border-green-500',
                error: 'border-red-500',
                warning: 'border-yellow-500',
                info: 'border-blue-500'
            };

            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto flex items-start gap-3 max-w-sm backdrop-blur-xl bg-[#132347]/95 rounded-xl shadow-2xl border-l-4 ' + (borders[type] || borders.info) + ' p-4 toast-enter';
            toast.innerHTML = '<div class="flex-shrink-0 mt-0.5">' + (icons[type] || icons.info) + '</div>' +
                '<p class="text-sm text-gray-200 flex-1">' + message + '</p>' +
                '<button onclick="this.closest(\'.pointer-events-auto\').remove()" class="flex-shrink-0 text-gray-500 hover:text-gray-300 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>';

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-leave');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        const flashSuccess = {!! json_encode(session('success')) !!};
        const flashError = {!! json_encode(session('error')) !!};
        if (flashSuccess) showToast('success', flashSuccess);
        if (flashError) showToast('error', flashError);
    </script>
</body>
</html>