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

    <div class="mb-10">
        @if (auth()->user()->role === 'super-admin'|| auth()->user()->role === 'admin')
        <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Tableau de bord</h2>@endif
        <p class="text-on-surface-variant text-sm mt-1">
            @if (auth()->user()->role === 'super-admin')
                Vue d'ensemble de l'écosystème QueueFlow.
            @elseif (auth()->user()->role === 'admin')
                Vue d'ensemble de votre entreprise.
            @endif
        </p>
    </div>

    {{-- ===== SUPER-ADMIN ===== --}}
    @if (auth()->user()->role === 'super-admin')

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-50 rounded-lg">
                        <span class="material-symbols-outlined text-orange-600">business</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Entreprises</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbentreprises }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <span class="material-symbols-outlined text-tertiary">admin_panel_settings</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Admins</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbadmins }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500/40">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-50 rounded-lg">
                        <span class="material-symbols-outlined text-orange-600">confirmation_number</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Tickets</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbtickets }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary/40">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <span class="material-symbols-outlined text-tertiary">queue</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Files Actives</p>
                <h3 class="text-2xl font-black mt-1">{{ $files->count() }}</h3>
            </div>
        </div>

        {{-- Tableaux super-admin --}}
        <div class="space-y-8 mb-10">
            {{-- Tableau Entreprises --}}
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="px-8 py-6 flex justify-between items-center border-b border-surface-container">
                    <div>
                        <h3 class="text-lg font-bold">Gestion des Entreprises</h3>
                        <p class="text-xs text-on-surface-variant">Entreprises ajoutées récemment.</p>
                    </div>
                    <button onclick="window.location.href='{{ route('ajout_entreprise') }}'"
                        class="signature-glow text-white px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">add</span> Ajouter entreprise
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                                <th class="px-8 py-4">Nom entreprise</th>
                                <th class="px-4 py-4">Statut</th>
                                <th class="px-4 py-4 text-center">Services</th>
                                <th class="px-4 py-4 text-center">Agents</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @foreach ($entreprisesrecentes as $entreprise)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="px-8 py-4 text-sm font-bold">{{ $entreprise->nom_ent }}</td>
                                    <td class="px-4 py-4">
                                        <span
                                            class="px-2 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full">
                                            {{ $entreprise->statut }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center text-sm font-medium">
                                        {{ $entreprise->services->count() }}</td>
                                    <td class="px-4 py-4 text-center text-sm font-medium">
                                        {{ $entreprise->personnels->count() }}</td>
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

            {{-- Tableau Admins --}}
            <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-surface-container">
                    <h3 class="text-lg font-bold">Administrateurs</h3>
                    <p class="text-xs text-on-surface-variant">Derniers administrateurs ajoutés.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                                <th class="px-8 py-4">Nom</th>
                                <th class="px-4 py-4">Email</th>
                                <th class="px-4 py-4">Entreprise</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @foreach ($adminsrecents as $admin)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="px-8 py-4 text-sm font-bold">{{ $admin->utilisateur->nom }}
                                        {{ $admin->utilisateur->prenom }}</td>
                                    <td class="px-4 py-4 text-sm">{{ $admin->utilisateur->email }}</td>
                                    <td class="px-4 py-4 text-sm font-medium text-tertiary">
                                        {{ $admin->entreprise->nom_ent }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ===== ADMIN ===== --}}
    @elseif(auth()->user()->role === 'admin')
        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-50 rounded-lg">
                        <span class="material-symbols-outlined text-orange-600">room_service</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Mes Services</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbservices }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <span class="material-symbols-outlined text-tertiary">confirmation_number</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Tickets (24h)</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbtickets }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-orange-500/40">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-orange-50 rounded-lg">
                        <span class="material-symbols-outlined text-orange-600">groups</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Personnels</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbpersonnels }}</h3>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-b-4 border-tertiary/40">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <span class="material-symbols-outlined text-tertiary">queue</span>
                    </div>
                </div>
                <p class="text-on-surface-variant text-[10px] font-bold uppercase tracking-wider">Files Actives</p>
                <h3 class="text-2xl font-black mt-1">{{ $nbfiles }}</h3>
            </div>
        </div>

        {{-- Tableau Services --}}
        <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="px-8 py-6 flex justify-between items-center border-b border-surface-container">
                <div>
                    <h3 class="text-lg font-bold">Mes Services — {{ $entreprise->nom_ent }}</h3>
                    <p class="text-xs text-on-surface-variant">Services de votre entreprise.</p>
                </div>
                <button onclick="window.location.href='{{ route('service_ajout') }}'"
                    class="signature-glow text-white px-4 py-2 rounded-md text-sm font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span> Ajouter service
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                            <th class="px-8 py-4">Nom du service</th>
                            <th class="px-4 py-4 text-center">Temps estimé</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($servicesrecentes as $service)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-8 py-4 text-sm font-bold">{{ $service->libelle }}</td>
                                <td class="px-4 py-4 text-center text-sm font-medium">
                                    {{ $service->temps_estime }}
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-4 bg-surface-container-low flex justify-center">
                    <button onclick="window.location.href='{{ route('service_liste') }}'"
                        class="text-primary text-xs font-bold hover:underline">Voir tous les services</button>
                </div>
        </div>
         

        {{-- Tableau Personnels --}}
        <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-surface-container">
                <h3 class="text-lg font-bold">Personnels</h3>
                <p class="text-xs text-on-surface-variant">Agents de votre entreprise.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-surface-container-low text-on-surface-variant text-[10px] uppercase tracking-widest font-bold">
                            <th class="px-8 py-4">Nom & Prénom</th>
                            <th class="px-4 py-4">Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($personnels as $personnel)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-8 py-4 text-sm font-bold">{{ $personnel->utilisateur->nom }}
                                    {{ $personnel->utilisateur->prenom }}</td>
                                <td class="px-4 py-4 text-sm">{{ $personnel->utilisateur->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif


</x-app-layout>
