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
            <h1 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2">Ajouter un service</h1>
            <p class="text-on-surface-variant body-md max-w-md mx-auto">
                Remplissez les informations pour enregistrer un nouveau servive .
            </p>
        </div>
        <!-- Form Start -->
        <form action="{{ route('service_enregistrer') }}" class="p-8 space-y-8" method="POST" enctype="multipart/form-data">@csrf
            <!-- Section 1: Business Info -->
            <section class="space-y-6">
                <header class="flex items-center gap-2">

                    <h2 class="text-sm font-bold uppercase tracking-wider text-on-surface">Informations du service
                    </h2>
                </header>
                <div class="space-y-4">
                    <!-- Nom du service -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="company_name">
                            Nom du service <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="company_name" name="libelle" placeholder="Ex: Retrait"
                                required="" type="text" />
                        </div>
                    </div>


                    <!-- Temps estmé -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="address">
                            Temps Estimé<span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="adresse" name="temps_estime" placeholder="10 min"
                                required="" type="text" />
                        </div>
                    </div>
                </div>
            </section>


            <!-- Actions -->
            <div class="flex flex-col md:flex-row gap-4 pt-6">
                <button
                    class="flex-1 signature-glow text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-200 order-1 md:order-2 flex items-center justify-center gap-2"
                    type="submit">
                    <span>Ajouter un Service</span>
                    <span class="material-symbols-outlined text-xl" data-icon="arrow_forward">arrow_forward</span>
                </button>
                <button
                    class="flex-1 bg-transparent border-2 border-surface-container-high text-on-surface-variant font-bold py-4 px-6 rounded-lg hover:bg-surface-container-low transition-all duration-200 order-2 md:order-1"
                    type="button">
                    Annuler
                </button>
            </div>
        </form>






</x-app-layout>