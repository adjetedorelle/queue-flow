<aside class="bg-[#223243] h-screen w-64 fixed left-0 top-0 overflow-y-auto z-50 flex flex-col py-6 shadow-2xl hidden md:flex">
    <div class="px-8 mb-10 flex items-center gap-3">
        <div class="w-8 h-8 bg-primary-container rounded-lg flex items-center justify-center">
            <span class="material-symbols-outlined text-white text-xl" data-icon="rocket_launch">rocket_launch</span>
        </div>
        <div class="flex flex-col">
            <span class="text-xl font-bold text-white tracking-tight">QueueFlow</span>
            <span class="text-[10px] text-slate-400 font-medium tracking-widest uppercase">Management Suite</span>
        </div>
    </div>

    <nav class="flex-1 space-y-1">

        @php
            $navLink = fn($active) => $active
                ? 'flex items-center gap-3 text-[#f97316] border-l-4 border-[#f97316] bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out'
                : 'flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out';
        @endphp

        <a class="{{ $navLink(request()->routeIs('dashboard')) }}" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Dashboard</span>
        </a>

        <a class="{{ $navLink(request()->routeIs('tickets*')) }}" href="#">
            <span class="material-symbols-outlined" data-icon="confirmation_number">confirmation_number</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Tickets</span>
        </a>

        <a class="{{ $navLink(request()->routeIs('files_disponibles*')) }}" href="{{ route('files_disponibles') }}">
            <span class="material-symbols-outlined" data-icon="queue_play_next">queue_play_next</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Files d'attente</span>
        </a>
       @if (auth()->user()->role === 'super-admin'||auth()->user()->role === 'admin')

        <a class="{{ $navLink(request()->routeIs('statistiques*')) }}" href="#">
            <span class="material-symbols-outlined" data-icon="bar_chart">bar_chart</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Statistiques</span>
        </a>

        <a class="{{ $navLink(request()->routeIs('service_liste*')) }}" href="{{ route('service_liste') }}">
            <span class="material-symbols-outlined" data-icon="settings_suggest">settings_suggest</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Services</span>
        </a>
        <a class="{{ $navLink(request()->routeIs('liste_personnel*')) }}" href="{{ route('liste_personnel') }}">
            <span class="material-symbols-outlined" data-icon="group">group</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Personnel</span>
        </a>
          @endif
        @if (auth()->user()->role === 'super-admin')
            <a class="{{ $navLink(request()->routeIs('liste_entreprises*')) }}" href="{{ route('liste_entreprises') }}">
                <span class="material-symbols-outlined" data-icon="business">business</span>
                <span class="font-manrope text-sm font-medium tracking-tight">Entreprises</span>
            </a>
        
            <a class="{{ $navLink(request()->routeIs('parametres*')) }}" href="#">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                <span class="font-manrope text-sm font-medium tracking-tight">Paramètres</span>
            </a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a onclick="event.preventDefault(); this.closest('form').submit();"
               class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
               href="{{ route('logout') }}">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                <span class="font-manrope text-sm font-medium tracking-tight">Déconnexion</span>
            </a>
        </form>
      <a class="{{ $navLink(request()->routeIs('Acceuil*')) }}" href="{{ route('Acceuil') }}">
                <span class="material-symbols-outlined" data-icon="home">home</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Retour à l'acceuil</span>
        </a>
    </nav>

    <div class="mt-auto px-6 py-6 border-t border-white/5">
        <div class="p-4 bg-white/5 rounded-2xl">
            <p class="text-xs text-slate-400 mb-2">System Status</p>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs text-white font-semibold">Live Servers Active</span>
            </div>
        </div>
    </div>
</aside>