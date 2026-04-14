<aside
    class="bg-[#223243] h-screen w-64 fixed left-0 top-0 overflow-y-auto z-50 flex flex-col py-6 shadow-2xl hidden md:flex">
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
        <!-- Dashboard Active -->
        <a class="flex items-center gap-3 text-[#f97316] border-l-4 border-[#f97316] bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Dashboard</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="confirmation_number">confirmation_number</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Tickets</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="queue_play_next">queue_play_next</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Files d'attente</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="bar_chart">bar_chart</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Statistiques</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="settings_suggest">settings_suggest</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Services</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="group">group</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Personnel</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="{{ route('liste_entreprises') }}">
            <span class="material-symbols-outlined" data-icon="business">business</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Entreprises</span>
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-white/5 py-3 px-6 transition-all duration-200 ease-in-out"
            href="#">
            <span class="material-symbols-outlined" data-icon="settings">settings</span>
            <span class="font-manrope text-sm font-medium tracking-tight">Paramètres</span>
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







{{-- <aside class="bg-[#223243] h-screen w-64 fixed left-0 top-0 hidden md:flex flex-col py-6">

    <div class="px-8 mb-10">
        <h1 class="text-white text-xl font-bold">QueueFlow</h1>
    </div>

    <nav class="space-y-2">

        <a href="{{ route('dashboard') }}" class="block px-6 py-3 text-orange-400 bg-white/5 border-l-4 border-orange-400">
            Dashboard
        </a>

        <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
            Tickets
        </a>

        <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
            Files d’attente
        </a>

        <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
            Statistiques
        </a> 

         ADMIN 
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin')
            <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
                Services
            </a>

            <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
                Personnel
            </a>
        @endif

        {{-- SUPER ADMIN
        @if (auth()->user()->role == 'superadmin')
            <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
                Entreprises
            </a>

            <a href="#" class="block px-6 py-3 text-slate-400 hover:text-white hover:bg-white/5">
                Paramètres
            </a>
        @endif

    </nav>

</aside> --}}
