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
            <h1 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2">Ajouter un personnel</h1>
            <p class="text-on-surface-variant body-md max-w-md mx-auto">
                Remplissez les informations pour enregistrer un personnel de votre entreprise.
            </p>
        </div>
        <!-- Form Start -->
        <form action="{{ route('enregistrer_personnel') }}" class="p-8 space-y-8" method="POST" >@csrf
            <section class="space-y-6 pt-4">
                <header class="flex items-center gap-2">

                    <h2 class="text-sm font-bold uppercase tracking-wider text-on-surface">Informations du
                    Personnel</h2>
                </header>
                <div class="space-y-4">
                     <!-- Nom -->
                     <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="admin_email">
                            Nom du Personel <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="account">account_circle</span>
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="nom" name="nom" placeholder="DUPOND" required=""
                                type="text" />
                        </div>
                    </div>
                       
                     <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="admin_email">
                            Prenom du Personnel <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="account">account_circle</span>
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="prenom" name="prenom" placeholder="Jean" required type="text" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="admin_email">
                            Email du personnel <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="mail">mail</span>
                            <input class="sunken-input w-full pl-12 pr-4 py-3.5 rounded-lg text-on-surface font-medium"
                                id="email" name="email" placeholder="admin@queueflow.com" required type="email" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label class="block text-xs font-bold text-on-surface-variant mb-1 ml-1" for="password">
                            Mot de passe <span class="text-primary">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary-container transition-colors"
                                data-icon="lock">lock</span>
                            <input class="sunken-input w-full pl-12 pr-12 py-3.5 rounded-lg text-on-surface font-medium"
                                id="password" name="password" placeholder="••••••••" required type="password" />
                            <button
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary-container transition-colors"
                                type="button">
                                <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Actions -->
            <div class="flex flex-col md:flex-row gap-4 pt-6">
                <button
                    class="flex-1 signature-glow text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all duration-200 order-1 md:order-2 flex items-center justify-center gap-2"
                    type="submit">
                    <span>Créer le personnel</span>
                    <span class="material-symbols-outlined text-xl" data-icon="arrow_forward">arrow_forward</span>
                </button>
                <button type="submit" onclick="window.location.href='{{ route('liste_personnel') }}'"
                    class="flex-1 bg-transparent border-2 border-surface-container-high text-on-surface-variant font-bold py-4 px-6 rounded-lg hover:bg-surface-container-low transition-all duration-200 order-2 md:order-1 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Annuler
            </button>
            </div>
        </form>


        
        

        
</x-app-layout>
