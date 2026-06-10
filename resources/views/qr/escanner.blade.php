<x-app-layout>
    <x-slot name="header">Escanear Código QR</x-slot>
    <div class="max-w-xl mx-auto">
        <div class="card p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 gold-bg rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Marcar Asistencia</h2>
                <p class="text-sm text-gray-500 mt-1">Escanea el código QR o ingresa el código manualmente</p>
            </div>

            <form action="{{ route('asistencias.marcar') }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Código QR</label>
                    <div class="flex space-x-3">
                        <input type="text" name="codigo" id="codigo_input" class="input-field flex-1 text-center text-lg font-mono" placeholder="Escanear o escribir código..." autofocus required>
                    </div>
                </div>
                <button type="submit" class="w-full py-3 gold-bg text-white font-bold rounded-lg hover:bg-yellow-500 transition-all shadow-lg text-lg">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Marcar Asistencia
                </button>
            </form>

            <div class="border-t border-gray-200 pt-6 text-center">
                <p class="text-sm text-gray-500 mb-4">O usa la cámara para escanear</p>
                <div id="qr-reader" class="mx-auto max-w-sm"></div>
                <button id="scan_btn" class="btn-primary mt-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span id="scan_btn_text">Iniciar Cámara</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
    (function() {
        const input = document.getElementById('codigo_input');
        const scanBtn = document.getElementById('scan_btn');
        const scanBtnText = document.getElementById('scan_btn_text');
        let html5QrCode = null;
        let isScanning = false;

        function onScanSuccess(decodedText) {
            input.value = decodedText;
            if (html5QrCode) {
                html5QrCode.stop();
                isScanning = false;
                scanBtnText.textContent = 'Iniciar Cámara';
            }
            input.form.submit();
        }

        scanBtn.addEventListener('click', function() {
            if (isScanning) {
                if (html5QrCode) { html5QrCode.stop(); }
                isScanning = false;
                scanBtnText.textContent = 'Iniciar Cámara';
                return;
            }
            html5QrCode = new Html5Qrcode("qr-reader");
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess
            ).then(() => {
                isScanning = true;
                scanBtnText.textContent = 'Detener Cámara';
            }).catch(err => {
                alert('Error al acceder a la cámara: ' + err);
            });
        });
    })();
    </script>
</x-app-layout>
