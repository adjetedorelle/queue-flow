<x-app-layout>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-tint": "#9d4300",
                        "on-primary-container": "#582200",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#ffdbca",
                        "on-tertiary-fixed-variant": "#004b74",
                        "on-primary-fixed-variant": "#783200",
                        "secondary-fixed-dim": "#ffb690",
                        "outline": "#8c7164",
                        "surface-dim": "#cbdcf2",
                        "surface-variant": "#d3e4fa",
                        "surface-container": "#e4efff",
                        "surface-container-low": "#eef4ff",
                        "on-tertiary-container": "#003554",
                        "on-secondary-fixed-variant": "#713612",
                        "inverse-primary": "#ffb690",
                        "background": "#f8f9ff",
                        "tertiary-fixed": "#cde5ff",
                        "primary": "#9d4300",
                        "tertiary": "#006398",
                        "primary-container": "#f97316",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#d3e4fa",
                        "outline-variant": "#e0c0b1",
                        "primary-fixed-dim": "#ffb690",
                        "on-tertiary-fixed": "#001d32",
                        "on-error-container": "#93000a",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#e9f1ff",
                        "primary-fixed": "#ffdbca",
                        "on-background": "#0c1d2d",
                        "on-secondary-container": "#773a16",
                        "on-surface-variant": "#584237",
                        "surface": "#f8f9ff",
                        "on-surface": "#0c1d2d",
                        "tertiary-container": "#00a2f4",
                        "surface-container-high": "#daeaff",
                        "secondary": "#8f4d27",
                        "on-primary-fixed": "#341100",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "inverse-surface": "#223243",
                        "surface-bright": "#f8f9ff",
                        "secondary-container": "#fda77a",
                        "on-error": "#ffffff",
                        "tertiary-fixed-dim": "#93ccff",
                        "on-secondary-fixed": "#341100",
                        "on-primary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #f8f9ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* Custom scrollbar for the table */
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
    <body class="text-on-surface antialiased">
        <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-2">
                        Liste des tickets
                    </h1>
                    <p class="text-on-surface-variant font-medium text-lg">
                        Suivez en temps réel l’état des tickets des clients
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-3 flex items-center text-on-surface-variant group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </span>
                        <input
                            class="pl-10 pr-4 py-2.5 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all w-full md:w-64 text-sm font-medium"
                            placeholder="Rechercher un ticket..." type="text" />
                    </div>
                    
                </div>
            </div>
            <!-- Content Card -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-[0_20px_50px_rgba(12,29,45,0.08)] overflow-hidden">
                <!-- Table Controls / Filters -->
                <div class="px-8 py-6 flex items-center justify-between border-b border-surface-container-low">
                    <div class="flex items-center gap-6 overflow-x-auto no-scrollbar">
                        <button
                            class="text-primary font-bold border-b-2 border-primary pb-1 text-sm whitespace-nowrap">Tous
                            les tickets</button>
                        <button
                            class="text-on-surface-variant hover:text-on-surface font-medium pb-1 text-sm transition-colors whitespace-nowrap">Aujourd'hui</button>
                        <button
                            class="text-on-surface-variant hover:text-on-surface font-medium pb-1 text-sm transition-colors whitespace-nowrap">Prioritaires</button>
                    </div>
                    <div
                        class="hidden sm:flex items-center gap-2 text-on-surface-variant text-sm font-semibold uppercase tracking-wider">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filtrer
                    </div>
                </div>
                <!-- Table Section -->
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th
                                    class="px-8 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest">
                                    Numéro</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest">
                                    Client</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest">
                                    Service</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest">
                                    Statut</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-center">
                                    Passage</th>
                                <th
                                    class="px-6 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-center">
                                    Traitement</th>
                                <th
                                    class="px-8 py-5 text-xs font-bold text-on-surface-variant uppercase tracking-widest text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low">
                            @foreach ($tickets as $ticket)
                                
                            
                            <tr class="group hover:bg-surface-container-low/30 transition-all cursor-pointer">
                                <td class="px-8 py-6">
                                    <span
                                        class="font-bold text-on-surface bg-surface-container-high px-3 py-1.5 rounded-lg text-sm">{{$ticket->numero}}</span>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center overflow-hidden">
                                        </div>
                                        <div>
                                            <div class="font-bold text-on-surface">{{$ticket->client->utilisateur->nom}}</div>
                                            <div class="text-xs text-on-surface-variant font-medium">{{$ticket->client->utilisateur->prenom}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="flex items-center gap-2 text-sm font-semibold text-on-surface">
                                        <span class="material-symbols-outlined text-primary text-[18px]">payments</span>
                                        {{$ticket->service->libelle}}
                                    </span>
                                </td>
                                <td class="px-6 py-6">
                                    @if ($ticket->statut === 'en_cours')
                                      <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                        {{$ticket->statut}}
                                      </span>   
                                    @else
                                      @if ($ticket->statut === 'en_attente')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                          <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                           {{$ticket->statut}}
                                       </span>     
                                       @else
                                       @if ($ticket->statut === 'traite')
                                          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-100">
                                              <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                                {{$ticket->statut}}                               
                                         </span>                   
                                         @else
                                           <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-100">
                                                 <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                                    {{$ticket->statut}} 
                                          </span>  
                                         
                                      @endif 
                                      @endif       
                                    @endif
                                    
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="text-sm font-bold text-on-surface">14:30</div>
                                    <div class="text-[10px] text-on-surface-variant font-medium">{{$ticket->statut}}</div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <div class="text-xs font-bold text-on-surface">{{$ticket->date_debut_traitement}}-{{$ticket->date_fin_traitement}}</div>
                                    <div class="text-[10px] text-primary font-bold uppercase tracking-tighter">Depuis 12
                                        min</div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button
                                        class="p-2 hover:bg-surface-container-high rounded-full transition-colors text-on-surface-variant">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Footer Pagination -->
                <div
                    class="px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-surface-container-low bg-surface-container-low/20">
                    <p class="text-sm text-on-surface-variant font-medium">
                        Affichage de <span class="font-bold text-on-surface">1 à 5</span> sur <span
                            class="font-bold text-on-surface">42</span> tickets
                    </p>
                    <div class="flex items-center gap-1">
                        <button 
                            class="p-2 rounded-lg hover:bg-surface-container-high transition-colors text-on-surface-variant">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <button class="w-9 h-9 rounded-lg bg-primary text-on-primary font-bold text-sm">1</button>
                        <button
                            class="w-9 h-9 rounded-lg hover:bg-surface-container-high text-on-surface font-semibold text-sm transition-colors">2</button>
                        <button
                            class="w-9 h-9 rounded-lg hover:bg-surface-container-high text-on-surface font-semibold text-sm transition-colors">3</button>
                        <span class="px-2 text-on-surface-variant">...</span>
                        <button
                            class="w-9 h-9 rounded-lg hover:bg-surface-container-high text-on-surface font-semibold text-sm transition-colors">8</button>
                        <button
                            class="p-2 rounded-lg hover:bg-surface-container-high transition-colors text-on-surface-variant">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Quick Stats Bento Grid (Asymmetric) -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div
                    class="md:col-span-1 bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container-low flex flex-col justify-between hover:shadow-md transition-shadow">
                    <span class="material-symbols-outlined text-primary mb-4">timer</span>
                    <div>
                        <h3 class="text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-1">Temps
                            Moyen</h3>
                        <p class="text-2xl font-extrabold text-on-surface">14 min</p>
                    </div>
                </div>
                <div
                    class="md:col-span-1 bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container-low flex flex-col justify-between hover:shadow-md transition-shadow">
                    <span class="material-symbols-outlined text-green-500 mb-4">task_alt</span>
                    <div>
                        <h3 class="text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-1">Résolus
                            (H)</h3>
                        <p class="text-2xl font-extrabold text-on-surface">28</p>
                    </div>
                </div>
                <div
                    class="md:col-span-2 bg-gradient-to-br from-inverse-surface to-[#1a2938] p-6 rounded-xl shadow-xl flex items-center justify-between group overflow-hidden relative">
                    <div class="relative z-10">
                        <h3 class="text-sm font-bold text-surface-variant uppercase tracking-widest mb-1">Charge
                            actuelle</h3>
                        <p class="text-3xl font-extrabold text-white mb-2">Modérée</p>
                        <p class="text-xs text-surface-variant/80 max-w-[200px]">8 guichets ouverts, temps d'attente
                            estimé à 5 min.</p>
                    </div>
                    <div class="relative z-10 w-24 h-24 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle class="text-white/10" cx="48" cy="48" fill="transparent" r="38"
                                stroke="currentColor" stroke-width="8"></circle>
                            <circle class="text-primary-container" cx="48" cy="48" fill="transparent"
                                r="38" stroke="currentColor" stroke-dasharray="238.76" stroke-dashoffset="80"
                                stroke-width="8"></circle>
                        </svg>
                        <span class="absolute text-white font-bold text-xl">65%</span>
                    </div>
                    <!-- Decorative background pulse -->
                    <div
                        class="absolute -right-4 -bottom-4 w-32 h-32 bg-primary/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700">
                    </div>
                </div>
            </div>
</x-app-layout>
