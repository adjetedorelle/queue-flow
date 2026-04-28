<x-app-layout>
        <script id="tailwind-config">
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "on-tertiary-fixed": "#001d32",
                            "primary-container": "#f97316",
                            "secondary-container": "#fda77a",
                            "inverse-primary": "#ffb690",
                            "on-secondary-fixed": "#341100",
                            "on-secondary": "#ffffff",
                            "on-primary-container": "#582200",
                            "on-surface-variant": "#584237",
                            "tertiary-container": "#00a2f4",
                            "surface-container-high": "#daeaff",
                            "surface-container": "#e4efff",
                            "background": "#f8f9ff",
                            "surface-variant": "#d3e4fa",
                            "secondary": "#8f4d27",
                            "on-primary-fixed-variant": "#783200",
                            "error-container": "#ffdad6",
                            "on-surface": "#0c1d2d",
                            "primary": "#9d4300",
                            "on-error-container": "#93000a",
                            "inverse-on-surface": "#e9f1ff",
                            "surface-container-low": "#eef4ff",
                            "on-secondary-container": "#773a16",
                            "on-primary-fixed": "#341100",
                            "on-tertiary": "#ffffff",
                            "error": "#ba1a1a",
                            "secondary-fixed": "#ffdbca",
                            "on-tertiary-container": "#003554",
                            "on-tertiary-fixed-variant": "#004b74",
                            "tertiary-fixed": "#cde5ff",
                            "outline-variant": "#e0c0b1",
                            "surface-container-lowest": "#ffffff",
                            "surface": "#f8f9ff",
                            "on-primary": "#ffffff",
                            "primary-fixed": "#ffdbca",
                            "on-secondary-fixed-variant": "#713612",
                            "outline": "#8c7164",
                            "on-background": "#0c1d2d",
                            "tertiary-fixed-dim": "#93ccff",
                            "secondary-fixed-dim": "#ffb690",
                            "primary-fixed-dim": "#ffb690",
                            "surface-dim": "#cbdcf2",
                            "surface-container-highest": "#d3e4fa",
                            "inverse-surface": "#223243",
                            "surface-tint": "#9d4300",
                            "surface-bright": "#f8f9ff",
                            "tertiary": "#006398",
                            "on-error": "#ffffff"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "1.5rem",
                            "full": "9999px"
                        },
                        "fontFamily": {
                            "headline": ["Manrope"],
                            "display": ["Manrope"],
                            "body": ["Manrope"],
                            "label": ["Manrope"]
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
                vertical-align: middle;
            }

            .kinetic-depth-card {
                box-shadow: 0 10px 40px -10px rgba(12, 29, 45, 0.08);
            }

            .orange-gradient {
                background: linear-gradient(135deg, #9d4300 0%, #f97316 100%);
            }
        </style>
        <style>
            body {
                min-height: max(884px, 100dvh);
            }
        </style>
   

   
            <!-- Header Section -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                
                <div
                    class="flex items-center gap-2 text-on-surface-variant bg-surface-container-low px-4 py-2 rounded-md">
                    <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                    <span class="text-sm font-medium">{{now()->format('d/m/Y')}}</span>
                </div>
            </div>
            <!-- Section 1: Ticket en cours -->
            <section class="mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <!-- Main Ticket Card -->
                    <div
                        class="lg:col-span-8 bg-surface-container-lowest rounded-xl kinetic-depth-card p-8 relative overflow-hidden">
                        <!-- Background Accent -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-surface-container-low rounded-bl-full opacity-50 -mr-16 -mt-16">
                        </div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-10">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full orange-gradient flex items-center justify-center text-white shadow-lg">
                                        <span class="material-symbols-outlined">person</span>
                                    </div>
                                    <div>
                                        <h2
                                            class="text-on-surface-variant text-[11px] font-bold uppercase tracking-[0.1em]">
                                            Client Actuel</h2>
                                        <p class="text-2xl font-bold text-on-surface">{{$ticket_encour->client->utilisateur->nom ?? '-'}}  {{$ticket_encour->client->utilisateur->prenom ?? '-'}}  </p>
                                    </div>
                                </div>
                                <span
                                    class="bg-tertiary/10 text-tertiary px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></span>
                                   {{ $ticket_encour->statut ?? 'Aucun ticket en cours' }}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="space-y-1">
                                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">
                                        Numéro de ticket</p>
                                    <p class="text-4xl font-black text-primary-container tracking-tighter">{{$ticket_encour->numero ?? '-'}}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">
                                        Service</p>
                                    <p class="text-xl font-semibold text-on-surface">{{$ticket_encour->service->libelle ?? '-'}}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">
                                        Début d'appel</p>
                                    <p class="text-xl font-semibold text-on-surface">{{$ticket_encour->date_debut_traitement ?? '-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Section 2: Actions -->
                    <div class="lg:col-span-4 flex flex-col gap-4 h-full">
                        <button
                        onclick="window.location.href='{{ route('appeler_prochain',['id_service'=>$tickets->first()?->service_id]) }}'"
                            class="w-full h-1/2 flex items-center justify-center gap-3 orange-gradient text-white font-bold rounded-xl shadow-xl shadow-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all duration-300 py-8 lg:py-0">
                            <span class="material-symbols-outlined text-2xl"
                                style="font-variation-settings: 'FILL' 1;">campaign</span>
                            <span class="text-lg">Appeler prochain ticket</span>
                        </button>
                    </div>
                  </div>
            </section>
            <!-- Section 2: Tickets en attente -->
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h3 class="text-xl font-bold text-on-surface">Tickets non traités</h3>
                        <span
                            class="bg-surface-container-highest text-on-surface-variant px-2.5 py-0.5 rounded-md text-xs font-bold">{{$count}}</span>
                    </div>
                   
                </div>
                <div class="bg-surface-container-lowest rounded-xl kinetic-depth-card overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low">
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Numéro</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Nom</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Prénom</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Heure de création</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Statut</th>
                                <th
                                    class="px-8 py-4 text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low">
                            @foreach ($tickets as $ticket)
                             <tr class="hover:bg-surface-container-low/30 transition-colors group">
                                <td class="px-8 py-5 font-bold text-primary">{{ $ticket->numero }}</td>
                                <td class="px-8 py-5 font-medium text-on-surface">{{$ticket->client->utilisateur->nom}}</td>
                                <td class="px-8 py-5 font-medium text-on-surface">{{$ticket->client->utilisateur->prenom}}</td>
                                <td class="px-8 py-5 text-on-surface-variant">{{ $ticket->created_at }}</td>
                                <td class="px-8 py-5">
                                    <span
                                        class="bg-surface-container-high text-on-primary-fixed-variant px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider">{{ $ticket->statut }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <button
                                        class="p-2 rounded-full hover:bg-white text-on-surface-variant opacity-0 group-hover:opacity-100 transition-all">
                                        <span class="material-symbols-outlined">more_horiz</span>
                                    </button>
                                </td>
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-8 py-4 bg-surface-container-low/20 text-center">
                       
                    </div>
                </div>
            </section>
</x-app-layout>
