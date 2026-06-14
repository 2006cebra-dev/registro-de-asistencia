<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Asistencia QR') - Sistema de Asistencia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script data-cfasync="false" src="https://cdn.tailwindcss.com"></script>
    <script data-cfasync="false" defer src="https://cdn.jsdelivr.net/npm/alpinejs@3/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Figtree', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #0a1628 0%, #132347 50%, #1a3a6b 100%); }
        .gold-accent { color: #d4a843; }
        .gold-bg { background-color: #d4a843; }

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
    </style>
</head>
<body class="font-sans antialiased">
    <div id="toast-container" class="fixed top-4 right-4 z-[100] flex flex-col gap-3 pointer-events-none"></div>

    <div class="min-h-screen gradient-bg flex flex-col items-center justify-center px-4">
        <div class="mb-8 text-center">
            <div class="w-16 h-16 gold-bg rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h1 class="text-3xl font-bold text-white">Asistencia <span class="gold-accent">QR</span></h1>
            <p class="text-gray-400 mt-1">Sistema de registro de asistencia</p>
        </div>
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

    <div id="confirm-overlay" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm hidden" onclick="if(event.target===this){document.getElementById('confirm-overlay').classList.add('hidden');if(confirmResolve)confirmResolve(false);}" style="animation: fadeIn 0.2s ease-out;">
        <div id="confirm-dialog" class="bg-[#132347] border border-white/10 rounded-2xl shadow-2xl shadow-yellow-500/10 p-6 max-w-sm mx-4 w-full" style="animation: scaleIn 0.25s ease-out;">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-600 to-yellow-800 flex items-center justify-center shadow-lg shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
                <div>
                    <p id="confirm-title" class="text-white font-bold text-sm">Confirmar acción</p>
                    <p id="confirm-message" class="text-gray-400 text-xs mt-0.5">¿Estás seguro?</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button id="confirm-cancel" class="flex-1 px-4 py-2.5 border border-white/20 text-gray-300 rounded-xl text-sm font-medium hover:bg-white/10 hover:text-white transition-all cursor-pointer">Cancelar</button>
                <button id="confirm-ok" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-xl text-sm font-bold shadow-lg hover:from-yellow-500 hover:to-yellow-700 transition-all cursor-pointer">Confirmar</button>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    </style>

    <script data-cfasync="false">
        let confirmResolve = null;

        function showConfirm(message) {
            return new Promise((resolve) => {
                document.getElementById('confirm-message').textContent = message;
                document.getElementById('confirm-overlay').classList.remove('hidden');
                confirmResolve = resolve;
            });
        }

        document.getElementById('confirm-ok').addEventListener('click', function() {
            document.getElementById('confirm-overlay').classList.add('hidden');
            if (confirmResolve) confirmResolve(true);
        });

        document.getElementById('confirm-cancel').addEventListener('click', function() {
            document.getElementById('confirm-overlay').classList.add('hidden');
            if (confirmResolve) confirmResolve(false);
        });
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
                '<button onclick="this.closest(\'.pointer-events-auto\').remove()" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>';
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
