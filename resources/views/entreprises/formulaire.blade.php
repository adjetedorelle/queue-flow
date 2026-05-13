<x-app-layout>


    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #0B1C2C;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .signature-glow {
            background: linear-gradient(135deg, #9d4300 0%, #f97316 100%);
        }

        .sunken-input {
            background-color: #f3f4f6;
            border: 1px solid transparent;
            transition: all 0.2s ease-in-out;
        }

        .sunken-input:focus {
            background-color: #ffffff;
            border-color: rgba(249, 115, 22, 0.4);
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
            outline: none;
        }
    </style>
    </head>
    <!-- Main Card Container -->
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden">
        <!-- Header Section -->
        <div class="p-8 pb-0 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-surface-container-low mb-6">
                <span class="material-symbols-outlined text-primary-container text-4xl"
                    data-icon="corporate_fare">corporate_fare</span>
            </div>
            <h1 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2">Modifier une entreprise</h1>
            <p class="text-on-surface-variant body-md max-w-md mx-auto">
                Remplissez les informations pour modifier une entreprise et son administrateur.
            </p>
        </div>
        <!-- Form Start -->
        <form action="{{ route('modifier_entreprise', ['id_entreprise' => $entreprise->id]) }}" class="p-8 space-y-8"
            method="POST" enctype="multipart/form-data">@csrf @method('PUT')
            <!-- Section 1: Business Info -->
            <section class="space-y-6">
                <header class="flex items-center gap-2">

                    <h2 class="text-sm font-bold uppercase tracking-wider text-on-surface">Informations de l’entreprise
                    </h2>
                </header>
                <div class="space-y-4">
                    <!-- Nom de l'entreprise -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="company_name">
                            Nom de l’entreprise <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="domain">domain</span>
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="company_name" name="nom_ent" placeholder="Ex: Kinetic Slate Tech" required=""
                                type="text" value="{{ $entreprise->nom_ent }}" />
                        </div>
                    </div>
                    <!-- Adresse -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="address">
                            Adresse <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="location_on">location_on</span>
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="adresse" name="adresse" placeholder="123 Rue de l'Innovation, Paris"
                                required="" type="text" value="{{ $entreprise->adresse }}" />
                        </div>
                    </div>

                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="company_name">
                            Description <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon=""></span>
                            <textarea class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium" name="bio"
                                required="" type="text"> {{ $entreprise->bio }}</textarea>
                        </div>
                    </div>
                    <!-- Horaires par jour -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-3 ml-1">
                            Horaires d'ouverture <span class="text-primary">*</span>
                        </label>
                        <div class="space-y-4">
                            @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour)
                                @php
                                    $jourData = $entreprise->horaires[$jour] ?? ['ferme' => true, 'plages' => []];
                                    $ferme = $jourData['ferme'] ?? true;
                                    $plages = $jourData['plages'] ?? [];
                                    if (empty($plages)) {
                                        $plages = [['debut' => '', 'fin' => '']];
                                    }
                                @endphp
                                <div class="border border-surface-container-high rounded-lg p-4" data-jour="{{ $jour }}">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="font-bold text-on-surface">{{ $jour }}</h4>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" name="horaires[{{ $jour }}][ferme]" value="1" 
                                                   {{ $ferme ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span class="text-sm text-on-surface-variant font-medium">Fermé</span>
                                        </label>
                                    </div>
                                    <div class="plages-container space-y-2">
                                        @foreach($plages as $index => $plage)
                                            <div class="plage flex items-center gap-3">
                                                <div class="flex-1">
                                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Début</label>
                                                    <input type="time" 
                                                           name="horaires[{{ $jour }}][plages][{{ $index }}][debut]" 
                                                           value="{{ $plage['debut'] ?? '' }}"
                                                           class="sunken-input w-full px-4 py-2.5 rounded-lg text-on-surface font-medium">
                                                </div>
                                                <div class="flex-1">
                                                    <label class="block text-xs font-bold text-on-surface-variant mb-1">Fin</label>
                                                    <input type="time" 
                                                           name="horaires[{{ $jour }}][plages][{{ $index }}][fin]" 
                                                           value="{{ $plage['fin'] ?? '' }}"
                                                           class="sunken-input w-full px-4 py-2.5 rounded-lg text-on-surface font-medium">
                                                </div>
                                                <button type="button" 
                                                        class="supprimer-plage mt-6 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-bold"
                                                        title="Supprimer cette plage">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" 
                                            class="ajouter-plage mt-3 px-4 py-2 bg-primary-container text-white rounded-lg hover:bg-primary transition-colors text-sm font-bold flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">add</span>
                                        Ajouter une plage horaire
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1">
                            Image <span class="text-primary">*</span>
                        </label>

                        {{-- Afficher l'image actuelle --}}
                        @if ($entreprise->image)
                            <div class="mb-3">
                                <p class="text-xs text-on-surface-variant mb-1">Image actuelle :</p>
                                <img src="{{ asset('storage/' . $entreprise->image) }}"
                                    alt="{{ $entreprise->nom_ent }}"
                                    class="w-16 h-16 object-cover rounded-lg" />
                            </div>
                        @endif
                        <input
                            class="sunken-input w-full pl-4 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                            name="image" type="file" accept="image/*" />
                        <p class="text-xs text-on-surface-variant mt-1 ml-1">
                            Laissez vide pour conserver l'image actuelle.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Actions -->
            <div class="flex flex-col md:flex-row gap-4 pt-6">
                <button type="submit" onclick="window.location.href='{{ route('liste_entreprises') }}'"
                    class="flex-1 bg-transparent border-2 border-surface-container-high text-on-surface-variant font-bold py-4 px-6 rounded-lg hover:bg-surface-container-low transition-all duration-200 order-2 md:order-1 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Annuler
            </button>

                <button type="submit"
                    class="flex-1 signature-glow text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-200 order-1 md:order-2 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Modifier l'entreprise
                </button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/horaires-entreprise.js') }}"></script>


</x-app-layout>
