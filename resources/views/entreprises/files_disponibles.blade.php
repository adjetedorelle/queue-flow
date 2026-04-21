<x-app-layout>
   
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "inverse-surface": "#223243",
                            "error": "#ba1a1a",
                            "on-surface": "#0c1d2d",
                            "surface-dim": "#cbdcf2",
                            "primary-fixed-dim": "#ffb690",
                            "tertiary-fixed-dim": "#93ccff",
                            "on-tertiary": "#ffffff",
                            "surface-bright": "#f8f9ff",
                            "secondary-fixed": "#ffdbca",
                            "primary-fixed": "#ffdbca",
                            "on-secondary-container": "#773a16",
                            "on-primary-fixed": "#341100",
                            "surface-container": "#e4efff",
                            "on-error": "#ffffff",
                            "on-secondary-fixed": "#341100",
                            "on-secondary": "#ffffff",
                            "error-container": "#ffdad6",
                            "outline-variant": "#e0c0b1",
                            "surface-container-highest": "#d3e4fa",
                            "on-surface-variant": "#584237",
                            "surface-tint": "#9d4300",
                            "on-tertiary-fixed": "#001d32",
                            "on-error-container": "#93000a",
                            "on-tertiary-fixed-variant": "#004b74",
                            "surface-container-high": "#daeaff",
                            "surface": "#f8f9ff",
                            "on-tertiary-container": "#003554",
                            "background": "#f8f9ff",
                            "primary": "#9d4300",
                            "tertiary-fixed": "#cde5ff",
                            "inverse-primary": "#ffb690",
                            "on-primary": "#ffffff",
                            "surface-container-lowest": "#ffffff",
                            "on-primary-container": "#582200",
                            "secondary-container": "#fda77a",
                            "secondary": "#8f4d27",
                            "outline": "#8c7164",
                            "secondary-fixed-dim": "#ffb690",
                            "surface-container-low": "#eef4ff",
                            "tertiary": "#006398",
                            "surface-variant": "#d3e4fa",
                            "inverse-on-surface": "#e9f1ff",
                            "on-secondary-fixed-variant": "#713612",
                            "on-background": "#0c1d2d",
                            "tertiary-container": "#00a2f4",
                            "on-primary-fixed-variant": "#783200",
                            "primary-container": "#f97316"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "1.5rem",
                            "full": "9999px"
                        },
                        "fontFamily": {
                            "headline": ["Manrope", "sans-serif"],
                            "body": ["Manrope", "sans-serif"],
                            "label": ["Manrope", "sans-serif"]
                        }
                    }
                }
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

            .glass-header {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }

            .kinetic-shadow {
                box-shadow: 0 20px 40px -15px rgba(12, 29, 45, 0.08);
            }

            .status-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: .5;
                }
            }
        </style>
        <style>
            body {
                min-height: max(884px, 100dvh);
            }
        </style>
    </head>

    
        
            <header class="mb-12 space-y-2">
                
                <h1 class="text-4xl font-extrabold tracking-tight text-on-surface lg:text-5xl">
                    Files d’attente-
                </h1>
                <p class="text-lg text-on-surface-variant max-w-2xl font-medium">
                    Suivez et gérez les files d’attente des services de l’entreprise en temps réel. Optimisez le flux et
                    réduisez les temps d’attente.
                </p>
            </header>
            <!-- Stats Overview (Bento Style) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl kinetic-shadow border border-white/50 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-1">Total Clients
                        </p>
                        <p class="text-3xl font-black text-on-surface">1,284</p>
                    </div>
                    <div
                        class="h-12 w-12 rounded-lg bg-surface-container-high flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-3xl">groups</span>
                    </div>
                </div>
                <div
                    class="bg-inverse-surface p-6 rounded-xl kinetic-shadow flex items-center justify-between text-white">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-surface-dim mb-1">Files Actives</p>
                        <p class="text-3xl font-black">12</p>
                    </div>
                    <div
                        class="h-12 w-12 rounded-lg bg-white/10 flex items-center justify-center text-primary-container">
                        <span class="material-symbols-outlined text-3xl">bolt</span>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl kinetic-shadow border border-white/50 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-1">Temps Moyen
                        </p>
                        <p class="text-3xl font-black text-on-surface">14 min</p>
                    </div>
                    <div
                        class="h-12 w-12 rounded-lg bg-surface-container-high flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined text-3xl">schedule</span>
                    </div>
                </div>
            </div>
            <!-- Table Container -->
            <div class="bg-surface-container-lowest rounded-xl kinetic-shadow border border-white/40 overflow-hidden">
                <!-- Table Controls -->
                <div
                    class="p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-surface-container-low">
                    <div class="relative group max-w-md w-full">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">search</span>
                        <input
                            class="w-full pl-10 pr-4 py-2.5 bg-surface-container-low border-0 rounded-md focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all text-sm font-medium"
                            placeholder="Rechercher une file ou un service..." type="text" />
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="flex items-center gap-2 px-4 py-2.5 text-sm font-bold text-on-surface hover:bg-surface-container-low rounded-md transition-colors">
                            <span class="material-symbols-outlined">filter_list</span> Filtrer
                        </button>
                       
                    </div>
                </div>
                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant">
                                    Date de la file</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant">
                                    Service concerné</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant">
                                    Total Clients</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant text-center">
                                    Clients restants</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant">
                                    Statut</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black uppercase tracking-[0.1em] text-on-surface-variant text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low">
                            @foreach ($files as $file)       
                            <!-- Row 1: Active -->
                            <tr class="group hover:bg-surface-container-low/30 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 rounded-lg bg-surface-container-high flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">description</span>
                                        </div>
                                        <span class="font-bold text-on-surface">{{ $file->date}}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span
                                        class="px-3 py-1 rounded-full bg-surface-container-high text-[11px] font-bold text-on-tertiary-fixed-variant uppercase tracking-wider">{{$file->service->libelle}}</span>
                                </td>
                                <td class="px-6 py-5 font-semibold text-on-surface">{{ $file->nb_total}}</td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="font-black text-primary text-lg">{{ $file->nb_client_restants}}</span>
                                        <div class="w-16 h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                            <div class="h-full bg-primary-container w-[95%]"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    @if ($file->statut === 'ouverte')
                                       <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500 status-pulse"></span>
                                        {{ $file->statut}}
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 text-orange-700 text-xs font-bold border border-orange-100">
                                      <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                                   {{ $file->statut}}
                                </span> 
                                    @endif
                                    
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            class="p-2 rounded-md hover:bg-surface-container-high text-tertiary transition-colors"
                                            title="Consulter">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </button>
                                        <button class="p-2 rounded-md hover:bg-error/10 text-error transition-colors"
                                            title="Clôturer">
                                            <span class="material-symbols-outlined">lock_open</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                 
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Pagination Footer -->
                <div
                    class="p-6 bg-surface-container-low/30 border-t border-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                  {{ $files->links() }}
                </div>
            </div>
            
        



</x-app-layout>
