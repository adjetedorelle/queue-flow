<aside class="h-screen w-64 fixed left-0 top-0 overflow-y-auto z-50 flex flex-col py-6 shadow-2xl hidden md:flex">
    <div class="px-8 mb-10 flex items-center gap-3">
         <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#223243] dark:text-blue-400" data-icon="layers">layers</span>
            <span class="text-2xl font-black font-headline tracking-tight">
                <span class="text-[#223243] dark:text-blue-400">Queue</span><span class="text-[#FF6B00]">Flow</span>
            </span>
        </div>
    </div>

    <nav class="flex-1 space-y-1">

        @php
            $navLink = fn($active) => $active
                ? 'flex items-center gap-3 text-[#f97316] border-l-4 border-[#f97316] bg-[#223243]/5 py-3 px-6 transition-all duration-200 ease-in-out'
                : 'flex items-center gap-3 text-slate-400 hover:text-[#223243] hover:bg-[#223243]/5 py-3 px-6 transition-all duration-200 ease-in-out';
        @endphp
        @if (auth()->user()->role === 'super-admin'||auth()->user()->role === 'admin')

        <a class="{{ $navLink(request()->routeIs('dashboard')) }}" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Dashboard</span>
        </a>
        @endif
        <a class="{{ $navLink(request()->routeIs('tickets_disponibles*')) }}" href="{{ route('tickets_disponibles') }}">
            <span class="material-symbols-outlined" data-icon="confirmation_number">confirmation_number</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Tickets</span>
        </a>

        <a class="{{ $navLink(request()->routeIs('files_disponibles*')) }}" href="{{ route('files_disponibles') }}">
            <span class="material-symbols-outlined" data-icon="queue_play_next">queue_play_next</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Files d'attente</span>
        </a>
       @if (auth()->user()->role === 'super-admin'||auth()->user()->role === 'admin')

        <a class="{{ $navLink(request()->routeIs('statistiques*')) }}" href="{{ route('statistiques')}}">
            <span class="material-symbols-outlined" data-icon="bar_chart">bar_chart</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Statistiques & Rapports</span>
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
        
            
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a onclick="event.preventDefault(); this.closest('form').submit();"
               class="flex items-center gap-3 text-slate-400 hover:text-[#223243] hover:bg-[#223243]/10 py-3 px-6 transition-all duration-200 ease-in-out"
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

    
</aside>