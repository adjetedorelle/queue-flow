<!DOCTYPE html>

<html class="h-full" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>QueueFlow - Vérification OTP</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "inverse-on-surface": "#e9f1ff",
                        "on-secondary-fixed": "#341100",
                        "on-surface-variant": "#584237",
                        "on-secondary-fixed-variant": "#713612",
                        "primary-fixed-dim": "#ffb690",
                        "primary-fixed": "#ffdbca",
                        "inverse-primary": "#ffb690",
                        "secondary": "#8f4d27",
                        "on-tertiary-fixed-variant": "#004b74",
                        "surface-tint": "#9d4300",
                        "surface-container-highest": "#d3e4fa",
                        "tertiary-fixed-dim": "#93ccff",
                        "on-primary-fixed": "#341100",
                        "background": "#f8f9ff",
                        "on-secondary": "#ffffff",
                        "surface-dim": "#cbdcf2",
                        "on-tertiary-container": "#003554",
                        "on-background": "#0c1d2d",
                        "surface-container-low": "#eef4ff",
                        "error": "#ba1a1a",
                        "on-primary-container": "#582200",
                        "on-error": "#ffffff",
                        "surface-variant": "#d3e4fa",
                        "secondary-fixed-dim": "#ffb690",
                        "tertiary-fixed": "#cde5ff",
                        "tertiary-container": "#00a2f4",
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#783200",
                        "tertiary": "#006398",
                        "surface-container": "#e4efff",
                        "surface": "#f8f9ff",
                        "secondary-fixed": "#ffdbca",
                        "on-tertiary-fixed": "#001d32",
                        "error-container": "#ffdad6",
                        "primary": "#9d4300",
                        "secondary-container": "#fda77a",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#daeaff",
                        "outline-variant": "#e0c0b1",
                        "surface-bright": "#f8f9ff",
                        "on-secondary-container": "#773a16",
                        "outline": "#8c7164",
                        "primary-container": "#f97316",
                        "inverse-surface": "#223243",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#0c1d2d"
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
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #faf9fe ;
            
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .otp-input:focus {
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
            border-color: #F97316;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-6">
    <!-- Main Content Canvas -->
    <main class="w-full max-w-md">
        <!-- Verification Card -->
        <div class="bg-surface-container-lowest rounded-xl shadow-2xl p-8 md:p-12 transition-all duration-300">
            <!-- Header Section -->
            <div class="flex flex-col items-center text-center mb-10">
                <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-primary text-4xl" data-icon="shield_person">
                        shield_person
                    </span>
                </div>
                <h1 class="text-on-surface font-extrabold text-2xl tracking-tight mb-3">
                    Vérification
                </h1>
                
            </div>
            <!-- OTP Form -->
            <form action="#" class="space-y-10" method="POST">@csrf
                <!-- Input: Nom -->
                @if (!$utilisateurExistant) 
                <div class="input-group relative">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1"
                        for="last_name">
                        Nom <span class="text-primary">*</span>
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200">
                            <span class="material-symbols-outlined text-on-surface-variant"
                                data-icon="person">person</span>
                        </div>
                        <input
                            class="block w-full pl-12 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent text-on-surface placeholder-slate-400 rounded-t-md transition-all duration-300 focus:ring-0 focus:bg-surface-container-lowest focus:border-primary-container"
                            id="last_name" name="nom" placeholder="Ex: Martin" required="" type="text" />
                    </div>
                </div>
                <!-- Input: Prénom -->
                <div class="input-group relative">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1"
                        for="first_name">
                        Prénom <span class="text-primary">*</span>
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200">
                            <span class="material-symbols-outlined text-on-surface-variant"
                                data-icon="person_outline">person_outline</span>
                        </div>
                        <input
                            class="block w-full pl-12 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent text-on-surface placeholder-slate-400 rounded-t-md transition-all duration-300 focus:ring-0 focus:bg-surface-container-lowest focus:border-primary-container"
                            id="first_name" name="prenom" placeholder="Ex: Jean" required="" type="text" />
                    </div>
                </div>
                @endif
                <div class="flex flex-col items-center text-center mb-10">
                    <p class="text-on-surface-variant text-sm leading-relaxed max-w-[280px]">
                        Veuillez entrer le code de vérification envoyé à votre numéro
                    </p>
                </div>

                <!-- Input Row -->
                
                <div class="flex justify-between gap-2 sm:gap-4">
                    <input autofocus=""
                        class="otp-input w-12 h-12 sm:w-14 sm:h-14 text-center text-xl font-bold bg-surface-container-low border-0 rounded-md text-on-surface transition-all duration-200 outline-none"
                        maxlength="1" type="text" />
                    <input
                        class="otp-input w-12 h-12 sm:w-14 sm:h-14 text-center text-xl font-bold bg-surface-container-low border-0 rounded-md text-on-surface transition-all duration-200 outline-none"
                        maxlength="1" type="text" />
                    <input
                        class="otp-input w-12 h-12 sm:w-14 sm:h-14 text-center text-xl font-bold bg-surface-container-low border-0 rounded-md text-on-surface transition-all duration-200 outline-none"
                        maxlength="1" type="text" />
                    <input
                        class="otp-input w-12 h-12 sm:w-14 sm:h-14 text-center text-xl font-bold bg-surface-container-low border-0 rounded-md text-on-surface transition-all duration-200 outline-none"
                        maxlength="1" type="text" />
                </div>

                

                <!-- Primary Action -->
                <div class="space-y-6">
                    <button
                            onclick="window.location.href='{{ route('page_ticket') }}'"
                        class="w-full py-4 px-6 rounded-md bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold text-sm tracking-widest uppercase shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-150"
                        type="submit">
                        Valider
                    </button>
                    <!-- Secondary Action -->
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-xs text-on-surface-variant/60 font-medium">Vous n'avez pas reçu le code
                            ?</span>
                        <a class="text-primary text-sm font-bold hover:underline decoration-2 underline-offset-4 transition-all"
                            href="#">
                            Renvoyer le code
                        </a>
                    </div>
                </div>
            </form>
            
    </main>
    
</body>

</html>
