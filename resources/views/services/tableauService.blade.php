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
                    services</h1>
                    <p class="text-on-surface-variant max-w-md text-lg">
                     @if (auth()->check() && auth()->user()->role === 'admin')
                        Gérez les services de votre entreprise.
                        @else
                        Découvrez les services proposés par les entrepriss inscrites sur la plateforme.
                    @endif
                    </p>
                   
            </div>
             @if (auth()->check() && auth()->user()->role === 'admin')

             <button onclick="window.location.href='{{ route ('service_ajout') }}'" class="signature-glow text-white px-8 py-4 rounded-xl flex items-center justify-center gap-3 font-bold transition-all duration-300 hover:scale-[1.03] active:scale-95 shadow-lg shadow-orange-500/20 group">
                <span class="material-symbols-outlined text-white transition-transform group-hover:rotate-90"
                    data-icon="add">add</span>
                Ajouter un service
            </button>
            @endif
        </div>
        <!-- Filters Section -->
        <div class="px-8 py-6 bg-surface-container-low/30">
            <div class="relative max-w-md group">
              
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
                            Nom du Service</th>
                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Temps estimé</th>
                         @if (auth()->check() && auth()->user()->role === 'super-admin')

                        <th class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">
                            Entreprise</th>
                        @endif
                         @if (auth()->check() && auth()->user()->role === 'admin')
                        <th
                            class="px-8 py-5 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant text-right">
                            Actions</th>
                            @endif
                    </tr>
                </thead>

                <tbody class="divide-y divide-surface-container-low">
                    @foreach ($services as $service)
                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                            <td class="px-8 py-6 text-on-surface-variant font-medium">{{ $loop->index + 1 }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                                    <span class="material-symbols-outlined" >sell</span>  </div>
                                    <span class="font-bold text-on-surface">{{ $service->libelle }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant max-w-[200px] truncate">
                                {{ $service->temps_estime }}</td>
                                @if (auth()->check() && auth()->user()->role === 'super-admin')
                                <td class="px-8 py-6 text-on-surface-variant max-w-[200px] truncate">
                                {{ $service->entreprise->nom_ent}}</td>     
                                @endif
                                 @if (auth()->check() && auth()->user()->role === 'admin')

                            <td class="px-8 py-6 text-right">
                                <div
                                    class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        onclick="window.location.href='{{ route('formulaire_service',['id_service'=>$service->id]) }}'"
                                        class="p-2 hover:bg-surface-container-high rounded-lg text-on-surface-variant transition-colors">
                                        <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                    </button>
                                     <form action="{{route('supprimer_service',['id_service'=>$service->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                            <span class="material-symbols-outlined text-xl"
                                                data-icon="delete">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Footer -->
        <div
            class="px-8 py-6 bg-surface-container-low/10 flex items-center justify-between border-t border-surface-container-low">
            {{ $services->links() }}
        </div>
    </div>
    </div>



</x-app-layout>
