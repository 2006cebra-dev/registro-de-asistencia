<x-app-layout>
    <x-slot name="header">
        <div>
            <span class="text-white text-lg font-bold tracking-tight">Escanear QR del Curso</span>
            <p class="text-sm text-gray-400">Escanea el código QR para registrar tu entrada</p>
        </div>
    </x-slot>

    <div id="success-overlay" class="fixed inset-0 z-[200] bg-black/70 backdrop-blur-sm flex items-center justify-center hidden transition-all duration-500">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl sm:rounded-3xl border border-green-500/30 p-6 sm:p-10 text-center max-w-xs sm:max-w-sm mx-4 shadow-2xl shadow-green-500/10">
            <div class="w-16 sm:w-20 h-16 sm:h-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mx-auto mb-4 sm:mb-5 shadow-lg shadow-green-500/20">
                <svg class="w-8 sm:w-10 h-8 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-white mb-1" id="success-title">¡Asistencia Registrada!</h3>
            <p class="text-xs sm:text-sm text-gray-400" id="success-message">Tu entrada ha sido registrada correctamente.</p>
            <div class="mt-6 w-full bg-white/5 rounded-full h-1 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-400 rounded-full" id="success-progress" style="width:0%; transition: width 2.5s linear;"></div>
            </div>
        </div>
    </div>

    <div class="max-w-lg mx-auto">
        <div class="bg-gradient-to-br from-[#1a3a6b] to-[#0a1628] rounded-2xl shadow-lg border border-white/10 p-6 sm:p-8 text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg card-3d">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
            </div>
            <h2 class="text-xl font-bold text-white mb-1">Marcar Asistencia</h2>
            <p class="text-sm text-white/80 mb-6">Escanea el código QR del curso para registrar tu entrada</p>

            <div id="qr-reader" class="mx-auto max-w-xs rounded-xl overflow-hidden border-2 border-dashed border-white/20 bg-black/20 mb-4"></div>

            <div class="flex flex-col items-center gap-3">
                <button id="scan_btn"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-yellow-600 to-yellow-800 text-white rounded-xl font-semibold text-sm shadow-lg hover:shadow-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span id="scan_btn_text">Abrir Cámara</span>
                </button>
                <p id="scan_status" class="text-xs text-gray-500"></p>
            </div>

            <form id="qr_form" action="{{ route('asistencias.marcar') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="codigo" id="codigo_input">
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
    (function() {
        const scanBtn = document.getElementById('scan_btn');
        const scanBtnText = document.getElementById('scan_btn_text');
        const statusText = document.getElementById('scan_status');
        const form = document.getElementById('qr_form');
        const input = document.getElementById('codigo_input');
        const overlay = document.getElementById('success-overlay');
        const progress = document.getElementById('success-progress');
        let html5QrCode = null;
        let isScanning = false;

        function playSuccessSound() {
            try {
                const ctx = new (window.AudioContext || window.webkitAudioContext)();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(880, ctx.currentTime);
                osc.frequency.setValueAtTime(1100, ctx.currentTime + 0.1);
                gain.gain.setValueAtTime(0.3, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.3);
            } catch(e) {}
        }

        function showSuccessOverlay(msg) {
            overlay.classList.remove('hidden');
            overlay.style.opacity = '0';
            setTimeout(() => { overlay.style.opacity = '1'; }, 10);
            playSuccessSound();
            setTimeout(() => { progress.style.width = '100%'; }, 50);
            setTimeout(() => {
                overlay.style.opacity = '0';
                progress.style.width = '0%';
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    form.submit();
                }, 400);
            }, 2800);
        }

        function onScanSuccess(decodedText) {
            input.value = decodedText;
            if (html5QrCode) {
                html5QrCode.stop();
                isScanning = false;
            }
            statusText.textContent = '✓ Código detectado';
            showSuccessOverlay();
        }

        const flashSuccess = {!! json_encode(session('success')) !!};
        const flashError = {!! json_encode(session('error')) !!};
        if (flashSuccess) showSuccessOverlay(flashSuccess);
        if (flashError && document.getElementById('scan_status')) {
            document.getElementById('scan_status').textContent = '✕ ' + flashError;
            document.getElementById('scan_status').classList.add('text-red-400');
        }

        scanBtn.addEventListener('click', function() {
            if (isScanning) {
                if (html5QrCode) { html5QrCode.stop(); }
                isScanning = false;
                scanBtnText.textContent = 'Abrir Cámara';
                statusText.textContent = '';
                return;
            }

            const readerEl = document.getElementById('qr-reader');
            readerEl.innerHTML = '';

            html5QrCode = new Html5Qrcode("qr-reader");
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 220, height: 220 } },
                onScanSuccess
            ).then(() => {
                isScanning = true;
                scanBtnText.textContent = 'Detener Cámara';
                statusText.textContent = 'Escanea el código QR del curso...';
            }).catch(err => {
                statusText.textContent = 'Error: ' + err;
            });
        });
    })();
    </script>
</x-app-layout>