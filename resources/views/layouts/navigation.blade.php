<nav id="app-nav" class="gradient-bg shadow-lg border-b border-white/10">
    @php $foto = Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : null; @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 gold-bg rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-xl font-bold text-white">Asistencia <span class="gold-accent">QR</span></span>
                </a>
                <div class="hidden md:flex md:items-center md:ml-10 md:space-x-2">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Inicio
                    </a>
                    @if (Auth::user()->rol === 'docente')
                    <a href="{{ route('cursos.index') }}" class="nav-link {{ request()->routeIs('cursos.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Cursos
                    </a>
                    <a href="{{ route('estudiantes.index') }}" class="nav-link {{ request()->routeIs('estudiantes.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Estudiantes
                    </a>
                    @endif
                    <a href="{{ route('asistencias.index') }}" class="nav-link {{ request()->routeIs('asistencias.*') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Asistencias
                    </a>
                    <a href="{{ route('qr.escanner') }}" class="nav-link {{ request()->routeIs('qr.escanner') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01"/></svg>
                        Escanear QR
                    </a>
                    @if (Auth::user()->rol === 'docente')
                    <a href="{{ route('qr.index') }}" class="nav-link {{ request()->routeIs('qr.index') ? 'nav-link-active' : 'text-gray-300' }}">
                        <svg class="w-4 h-4 inline-block mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                        Mis QR
                    </a>
                    @endif
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="hidden md:flex items-center space-x-3 text-gray-300 text-sm">
                    @if ($foto)
                        <img src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-white/20">
                    @else
                        <div class="w-8 h-8 gold-bg rounded-full flex items-center justify-center text-white font-bold text-xs">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="text-white font-medium leading-tight">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded-full {{ Auth::user()->rol === 'docente' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-blue-500/20 text-blue-400' }} w-fit">{{ Auth::user()->rol === 'docente' ? 'Docente' : 'Estudiante' }}</span>
                    </div>
                </div>
                <button onclick="togglePanel()" class="text-white p-2 rounded-lg hover:bg-white/10 transition-all cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div id="panel-overlay" class="fixed inset-0 z-50 pointer-events-none">
        <div id="panel-bg" class="fixed inset-0 bg-black/60 opacity-0 transition-opacity duration-300" onclick="closePanel()"></div>
        <div id="panel-body" class="fixed top-0 right-0 h-full w-72 translate-x-full transition-transform duration-300 ease-out bg-gradient-to-b from-[#0a1628] to-[#132347] shadow-2xl overflow-y-auto rounded-l-2xl border-l border-white/10">
            <div class="p-5">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center space-x-3">
                        @if ($foto)
                            <img src="{{ $foto }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-white/20">
                        @else
                            <div class="w-10 h-10 gold-bg rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-gray-400 text-xs">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <button onclick="closePanel()" class="text-gray-400 hover:text-white p-1.5 hover:bg-white/10 rounded-lg transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="backdrop-blur-xl bg-white/10 rounded-xl p-4 mb-4 border border-white/10 shadow-lg">
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold mb-1">Rol</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full {{ Auth::user()->rol === 'docente' ? 'bg-yellow-400' : 'bg-blue-400' }} animate-pulse"></div>
                        <p class="text-white font-medium">{{ Auth::user()->rol === 'docente' ? 'Docente' : 'Estudiante' }}</p>
                    </div>
                </div>

                @if (Auth::user()->rol === 'docente')
                <div class="mb-4 border-b border-white/10 pb-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2 px-1">Gestión</p>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white' : '' }}">Inicio</a>
                    <a href="{{ route('cursos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('cursos.*') ? 'bg-white/15 text-white' : '' }}">Cursos</a>
                    <a href="{{ route('estudiantes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('estudiantes.*') ? 'bg-white/15 text-white' : '' }}">Estudiantes</a>
                    <a href="{{ route('asistencias.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('asistencias.*') ? 'bg-white/15 text-white' : '' }}">Asistencias</a>
                    <a href="{{ route('qr.escanner') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('qr.escanner') ? 'bg-white/15 text-white' : '' }}">Escanear QR</a>
                    <a href="{{ route('qr.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('qr.index') ? 'bg-white/15 text-white' : '' }}">Mis QR</a>
                </div>
                @else
                <div class="mb-4 border-b border-white/10 pb-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2 px-1">Navegación</p>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white' : '' }}">Inicio</a>
                    <a href="{{ route('asistencias.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('asistencias.*') ? 'bg-white/15 text-white' : '' }}">Asistencias</a>
                    <a href="{{ route('qr.escanner') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all text-sm {{ request()->routeIs('qr.escanner') ? 'bg-white/15 text-white' : '' }}">Escanear QR</a>
                </div>
                @endif

                <div class="border-t border-white/10 pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-all text-sm cursor-pointer group">
                            <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let panelOpen = false;

        function togglePanel() {
            panelOpen ? closePanel() : openPanel();
        }

        function openPanel() {
            panelOpen = true;
            const overlay = document.getElementById('panel-overlay');
            const bg = document.getElementById('panel-bg');
            const body = document.getElementById('panel-body');

            overlay.classList.remove('pointer-events-none');
            requestAnimationFrame(() => {
                bg.classList.remove('opacity-0');
                body.classList.remove('translate-x-full');
            });
        }

        function closePanel() {
            panelOpen = false;
            const bg = document.getElementById('panel-bg');
            const body = document.getElementById('panel-body');
            const overlay = document.getElementById('panel-overlay');

            bg.classList.add('opacity-0');
            body.classList.add('translate-x-full');
            setTimeout(() => {
                overlay.classList.add('pointer-events-none');
            }, 300);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closePanel();
        });
    </script>
</nav>
