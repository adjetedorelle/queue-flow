<!DOCTYPE html>

<html class="h-full" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>QueueFlow | Connexion Client</title>
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
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#004b74",
                        "tertiary": "#006398",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#582200",
                        "error": "#ba1a1a",
                        "primary-container": "#f97316",
                        "on-secondary-container": "#773a16",
                        "secondary": "#8f4d27",
                        "primary": "#9d4300",
                        "tertiary-container": "#00a2f4",
                        "secondary-fixed": "#ffdbca",
                        "inverse-on-surface": "#e9f1ff",
                        "error-container": "#ffdad6",
                        "surface-dim": "#cbdcf2",
                        "secondary-container": "#fda77a",
                        "surface-bright": "#f8f9ff",
                        "surface": "#f8f9ff",
                        "on-surface": "#0c1d2d",
                        "on-primary-fixed-variant": "#783200",
                        "on-secondary-fixed": "#341100",
                        "on-background": "#0c1d2d",
                        "on-primary-fixed": "#341100",
                        "primary-fixed": "#ffdbca",
                        "on-tertiary-container": "#003554",
                        "tertiary-fixed": "#cde5ff",
                        "inverse-surface": "#223243",
                        "on-tertiary": "#ffffff",
                        "surface-variant": "#d3e4fa",
                        "background": "#f8f9ff",
                        "surface-container-low": "#eef4ff",
                        "surface-container-high": "#daeaff",
                        "outline-variant": "#e0c0b1",
                        "surface-container-highest": "#d3e4fa",
                        "on-error": "#ffffff",
                        "surface-tint": "#9d4300",
                        "on-surface-variant": "#584237",
                        "on-secondary-fixed-variant": "#713612",
                        "tertiary-fixed-dim": "#93ccff",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed": "#001d32",
                        "primary-fixed-dim": "#ffb690",
                        "outline": "#8c7164",
                        "surface-container": "#e4efff",
                        "secondary-fixed-dim": "#ffb690",
                        "inverse-primary": "#ffb690",
                        "on-secondary": "#ffffff"
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
            }
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #faf9fe;
            /* Request mandated specific color */
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .input-group:focus-within label {
            color: #f97316;
        }

        .input-group:focus-within .material-symbols-outlined {
            color: #f97316;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6">
    <!-- Login Container -->
    <div class="w-full max-w-md animate-fade-in">
        <div class="bg-surface-container-lowest rounded-xl shadow-2xl overflow-hidden">
            <!-- Form Header & Decorative Icon -->
            <div class="p-8 pb-4 text-center">
                @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                @endif
                <div
                    class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-surface-container-low text-primary-container">
                    <span class="material-symbols-outlined text-4xl"
                        data-icon="confirmation_number">confirmation_number</span>
                </div>
                <h1 class="text-on-surface text-3xl font-bold tracking-tight mb-2">Connectez-vous</h1>
                <p class="text-on-surface-variant text-sm font-medium">Veuillez entrer vos informations pour continuer
                </p>
            </div>
            <!-- Form Body -->
            <form action="{{route('page_otp.post')}}" class="p-8 pt-4 space-y-6" method="POST">@csrf
                
                <!-- Input: Téléphone -->
                <div class="input-group relative">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1"
                        for="phone">
                        Numéro de téléphone <span class="text-primary">*</span>
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200">
                            <span class="material-symbols-outlined text-on-surface-variant"
                                data-icon="phone">phone</span>
                        </div>
                        <input
                            class="block w-full pl-12 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent text-on-surface placeholder-slate-400 rounded-t-md transition-all duration-300 focus:ring-0 focus:bg-surface-container-lowest focus:border-primary-container"
                            id="phone" name="tel" placeholder="06 12 34 56 78" required="" type="tel" />
                    </div>
                    
                </div>

                <div class="input-group relative">
                    <label class="block text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2 ml-1"
                        for="email">
                        Email 
                    </label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200">
                            <span class="material-symbols-outlined text-on-surface-variant"
                                data-icon="email">email</span>
                        </div>
                        <input
                            class="block w-full pl-12 pr-4 py-4 bg-surface-container-low border-0 border-b-2 border-transparent text-on-surface placeholder-slate-400 rounded-t-md transition-all duration-300 focus:ring-0 focus:bg-surface-container-lowest focus:border-primary-container"
                            id="email" name="email" placeholder="email@example.com" type="email" />
                    </div>

                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button
                        class="group relative w-full flex justify-center items-center py-4 px-6 border border-transparent rounded-md text-sm font-extrabold text-white bg-gradient-to-br from-primary to-primary-container hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-primary-container/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-container active:scale-95"
                        type="submit">
                        <span class="mr-2">Valider</span>
                        <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform"
                            data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </div>
            </form>
            
    </div>
</body>

</html>
