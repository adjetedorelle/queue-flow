<x-app-layout>

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

        .kinetic-depth {
            box-shadow: 0 32px 64px -12px rgba(12, 29, 45, 0.06);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>

    <div class="bg-surface-container-lowest rounded-xl kinetic-depth overflow-hidden">
        <!-- Header Section -->
        <div
            class="p-8 md:p-12 border-b border-surface-container-low flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>

                <h1 class="text-4xl font-extrabold text-on-surface tracking-tight leading-none mb-4">Liste des
                    entreprises</h1>
                <p class="text-on-surface-variant max-w-md text-lg">Gérez les entreprises inscrites sur la
                    plateforme QueueFlow, supervisez leurs accès et surveillez leur activité en temps réel.</p>
            </div>
            <button onclick="window.location.href='{{ route('ajout_entreprise') }}'"
                class="signature-glow text-white px-8 py-4 rounded-xl flex items-center justify-center gap-3 font-bold transition-all duration-300 hover:scale-[1.03] active:scale-95 shadow-lg shadow-orange-500/20 group">
                <span class="material-symbols-outlined text-white transition-transform group-hover:rotate-90"
                    data-icon="add">add</span>
                Ajouter une entreprise
            </button>
        </div>
        <!-- Filters Section -->
        <div class="px-8 py-6 bg-surface-container-low/30">
            <div class="relative max-w-md group">
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary"
                    data-icon="search">search</span>
                <input
                    class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-0 rounded-xl focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all text-on-surface placeholder:text-on-surface-variant/50"
                    placeholder="Rechercher une entreprise ou un administrateur..." type="text" />
            </div>
        </div>
        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high/50">
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            #</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Nom</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Adresse</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Jour d'ouverture</th>

                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Statut</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Heures</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Administrateur</th>
                        <th
                            class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant text-right">
                            Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-surface-container-low">
                   @foreach ($entreprises as $entreprise)
                     <tr class="hover:bg-surface-container-low/40 transition-colors group">
                        <td class="px-8 py-6 text-on-surface-variant font-medium">{{$loop->index +1}}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                                    <span class="material-symbols-outlined" data-icon="storefront">storefront</span>
                                </div>
                                <span class="font-bold text-on-surface">{{$entreprise->nom_ent}}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-on-surface-variant max-w-[200px] truncate">{{$entreprise->adresse}}</td>
                        <td class="px-8 py-6 text-on-surface-variant max-w-[200px] truncate">{{$entreprise->jour_ouv}}</td>
                        <td class="px-8 py-6">

                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold ring-1 ring-emerald-600/10">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                               {{$entreprise->statut}}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold text-on-surface">{{$entreprise->heure_ouv}}-{{$entreprise->heure_ferm}}</span>

                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">

                                <span class="text-sm font-medium text-on-surface">{{$entreprise->admin->utilisateur->nom}} {{$entreprise->admin->utilisateur->prenom}}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div
                                class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="window.location.href='{{ route('formulaire_entreprise',['id_entreprise'=>$entreprise->id]) }}'"
                                    class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                </button>
                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="delete">delete</span>
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
            class="px-8 py-6 bg-surface-container-low/10 flex items-center justify-between border-t border-surface-container-low">
            {{$entreprises->links()}}
            </div>
        </div>
    </div>



</x-app-layout>
