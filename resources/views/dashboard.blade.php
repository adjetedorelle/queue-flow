<x-app-layout>
   
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "on-secondary-container": "#773a16",
                            "on-primary-fixed": "#341100",
                            "tertiary-fixed": "#cde5ff",
                            "surface-container-lowest": "#ffffff",
                            "inverse-primary": "#ffb690",
                            "secondary-fixed-dim": "#ffb690",
                            "on-primary": "#ffffff",
                            "background": "#f8f9ff",
                            "outline": "#8c7164",
                            "outline-variant": "#e0c0b1",
                            "surface-container-highest": "#d3e4fa",
                            "on-primary-container": "#582200",
                            "surface-variant": "#d3e4fa",
                            "surface-container-high": "#daeaff",
                            "surface-tint": "#9d4300",
                            "primary-fixed": "#ffdbca",
                            "on-secondary-fixed": "#341100",
                            "on-error-container": "#93000a",
                            "on-secondary": "#ffffff",
                            "secondary-fixed": "#ffdbca",
                            "tertiary": "#006398",
                            "on-error": "#ffffff",
                            "on-tertiary-fixed-variant": "#004b74",
                            "surface-bright": "#f8f9ff",
                            "surface": "#f8f9ff",
                            "primary-container": "#f97316",
                            "tertiary-fixed-dim": "#93ccff",
                            "inverse-surface": "#223243",
                            "surface-dim": "#cbdcf2",
                            "secondary-container": "#fda77a",
                            "on-secondary-fixed-variant": "#713612",
                            "error-container": "#ffdad6",
                            "secondary": "#8f4d27",
                            "on-background": "#0c1d2d",
                            "on-tertiary-fixed": "#001d32",
                            "tertiary-container": "#00a2f4",
                            "on-tertiary-container": "#003554",
                            "inverse-on-surface": "#e9f1ff",
                            "on-surface-variant": "#584237",
                            "surface-container": "#e4efff",
                            "on-primary-fixed-variant": "#783200",
                            "primary": "#9d4300",
                            "on-tertiary": "#ffffff",
                            "surface-container-low": "#eef4ff",
                            "primary-fixed-dim": "#ffb690",
                            "on-surface": "#0c1d2d",
                            "error": "#ba1a1a"
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
            }

            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }

            .signature-glow {
                background: linear-gradient(135deg, #9d4300 0%, #f97316 100%);
            }

            .sidebar-active-pill {
                width: 4px;
                height: 24px;
                border-radius: 0 4px 4px 0;
                background-color: #f97316;
                position: absolute;
                left: 0;
            }
        </style>
    </head>

        
       
            <!-- Welcome Header -->
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Tableau de bord</h2>
                <p class="text-on-surface-variant text-sm mt-1">Vue d'ensemble de l'écosystème QueueFlow.</p>
            </div>
            <!-- Stats Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Card 1 -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <span class="material-symbols-outlined text-orange-600">business</span>
                        </div>
                        <span class="text-emerald-600 text-xs font-bold flex items-center">
                            <span class="material-symbols-outlined text-sm mr-0.5">trending_up</span> +12%
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Entreprises</p>
                    <h3 class="text-2xl font-black mt-1">{{ $nbentreprises }}</h3>
                </div>
                <!-- Card 2 -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <span class="material-symbols-outlined text-tertiary">admin_panel_settings</span>
                        </div>
                        <span class="text-emerald-600 text-xs font-bold flex items-center">
                            <span class="material-symbols-outlined text-sm mr-0.5">trending_up</span> +5%
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Admins</p>
                    <h3 class="text-2xl font-black mt-1">{{ $nbadmins }}</h3>
                </div>
                <!-- Card 3 -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500/40">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <span class="material-symbols-outlined text-orange-600">confirmation_number</span>
                        </div>
                        <span class="text-rose-600 text-xs font-bold flex items-center">
                            <span class="material-symbols-outlined text-sm mr-0.5">trending_down</span> -2%
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Tickets (24h)</p>
                    <h3 class="text-2xl font-black mt-1">{{ $nbtickets }}</h3>
                </div>
                <!-- Card 4 -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary/40">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <span class="material-symbols-outlined text-tertiary">queue</span>
                        </div>
                        <span class="text-emerald-600 text-xs font-bold flex items-center">
                            <span class="material-symbols-outlined text-sm mr-0.5">trending_up</span> +8%
                        </span>
                    </div>
                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Files Actives</p>
                    <h3 class="text-2xl font-black mt-1">{{ $files->count()}}</h3>
                </div>
                <!-- Card 5 -->
               
            </div>
            <div class="grid grid-cols-1 gap-8 mb-10">
              <div class="space-y-8 mb-10">
    <!-- Tableau Entreprises -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden w-full">
        <div class="px-8 py-6 flex justify-between items-center border-b border-surface-container">
            <div>
                <h3 class="text-lg font-bold">Gestion des Entreprises</h3>
                <p class="text-xs text-on-surface-variant">Entreprises ajoutées récemment.</p>
            </div>
            <button
                onclick="window.location.href='{{ route('ajout_entreprise') }}'"
                class="signature-glow text-white px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined text-sm">add</span>
                Ajouter entreprise
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-8 py-4">Nom entreprise</th>
                        <th class="px-4 py-4">Statut</th>
                      
                        <th class="px-4 py-4 text-center">Services</th>
                        <th class="px-4 py-4 text-center">Agents</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container">
                    @foreach ($entreprisesrecentes as $entreprise)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-8 py-4">
                            <p class="text-sm font-bold">{{ $entreprise->nom_ent }}</p>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full">{{ $entreprise->statut }}</span>
                        </td>
                        <td class="px-4 py-4 text-center text-sm font-medium">{{ $entreprise->services->count() }}</td>
                        <td class="px-4 py-4 text-center text-sm font-medium">{{ $entreprise->personnels->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 bg-surface-container-low flex justify-center">
            <button onclick="window.location.href='{{ route('liste_entreprises') }}'"
                class="text-primary text-xs font-bold hover:underline">Voir toutes les entreprises</button>
        </div>
    </div>

    <!-- Tableau Admins -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden w-full">
        <div class="px-8 py-6 border-b border-surface-container">
            <h3 class="text-lg font-bold">Administrateurs</h3>
            <p class="text-xs text-on-surface-variant">Derniers administrateurs ajoutés au système.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-8 py-4">Nom</th>
                        <th class="px-4 py-4">Email</th>
                        <th class="px-4 py-4">Entreprise</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container">
                    @foreach ($adminsrecents as $admin)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-8 py-4 text-sm font-bold">{{ $admin->utilisateur->nom }} {{ $admin->utilisateur->prenom }}</td>
                        <td class="px-4 py-4 text-sm">{{ $admin->utilisateur->email }}</td>
                        <td class="px-4 py-4 text-sm font-medium text-tertiary">{{ $admin->entreprise->nom_ent }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
            <!-- Advanced Stats Placeholder -->
            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                <div class="flex justify-between items-end mb-10">
                    <div>
                        <h3 class="text-xl font-extrabold tracking-tight">Analyse de Trafic</h3>
                        <p class="text-sm text-on-surface-variant">Évolution quotidienne des tickets et flux
                            d'utilisateurs.</p>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1.5 bg-surface-container text-on-surface-variant text-[10px] font-bold rounded-md">7
                            JOURS</button>
                        <button
                            class="px-3 py-1.5 bg-orange-500 text-white text-[10px] font-bold rounded-md shadow-lg shadow-orange-500/20">30
                            JOURS</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Daily Tickets Graph Placeholder -->
                    <div class="h-64 flex flex-col justify-between">
                        <div class="flex-1 flex items-end gap-2 px-2">
                            <div class="flex-1 bg-surface-container-low h-[40%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Lundi: 1,200"></div>
                            <div class="flex-1 bg-surface-container-low h-[55%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Mardi: 1,600"></div>
                            <div class="flex-1 bg-surface-container-low h-[45%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Mercredi: 1,350"></div>
                            <div class="flex-1 bg-orange-500 h-[85%] rounded-t-sm relative group cursor-help"
                                title="Jeudi: 2,400">
                                <div
                                    class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                    2,4k</div>
                            </div>
                            <div class="flex-1 bg-surface-container-low h-[70%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Vendredi: 2,100"></div>
                            <div class="flex-1 bg-surface-container-low h-[30%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Samedi: 850"></div>
                            <div class="flex-1 bg-surface-container-low h-[20%] rounded-t-sm hover:bg-orange-200 transition-colors cursor-help"
                                title="Dimanche: 400"></div>
                        </div>
                        <div
                            class="flex justify-between text-[10px] font-bold text-on-surface-variant mt-4 uppercase tracking-widest border-t border-surface-container pt-4">
                            <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
                        </div>
                        <p
                            class="text-center text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.2em] mt-2">
                            Volume Quotidien de Tickets</p>
                    </div>
                    <!-- Traffic Evolution Placeholder -->
                    <div
                        class="relative h-64 overflow-hidden rounded-xl bg-slate-50 flex items-center justify-center border border-dashed border-slate-200">
                        <img alt="Traffic Evolution Chart"
                            class="absolute inset-0 w-full h-full object-cover opacity-20"
                            data-alt="a clean minimalist line chart showing upward growth trends with orange and blue accents over a light background"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIrLsUQPY0iW2gUQ9lTwLG1fYFN0lHaSlE5C9Nf-FBaD_XwuzBa1fJWSmrDAvrmVIfXw9qL7PrgEDkPSwwLpSXQLu_tziz83DbTv14LD1FUFMPtvQvbjxqEdOeWmFI1j6sJxfmrmU6HuZsy1v1XN0mhhbziIQ5njXat4PvkykK2kcmk0OAAAkWbYAjFTwMwMTeESYpKNAJ0PKTLHnjv0wkiNnGKdG-zkuwK0-WrtSYgu3M7aZY3ho3_1diC1HnHENKmEAD6HhIwOM" />
                        <div class="relative z-10 text-center">
                            <span class="material-symbols-outlined text-4xl text-orange-600 mb-2">insights</span>
                            <p class="text-sm font-bold text-slate-800">Visualisation du Flux Réseau</p>
                            <p class="text-[10px] text-slate-500">Génération des métriques en temps réel...</p>
                        </div>
                    </div>
                </div>
            </div>
        
</x-app-layout>
