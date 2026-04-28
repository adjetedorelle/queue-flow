<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>QueueFlow | Gestion Intelligente des Files d'Attente</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#e3e2e7",
                        "on-surface-variant": "#43474f",
                        "on-secondary": "#ffffff",
                        "secondary-fixed": "#d8e3fc",
                        "on-tertiary-container": "#55a454",
                        "tertiary": "#001d03",
                        "inverse-surface": "#2f3034",
                        "on-error": "#ffffff",
                        "surface": "#faf9fe",
                        "on-background": "#1a1c1f",
                        "tertiary-fixed-dim": "#88d982",
                        "on-primary-container": "#7594ca",
                        "inverse-primary": "#a9c7ff",
                        "secondary": "#545f74",
                        "surface-container": "#eeedf2",
                        "secondary-container": "#d5e0f9",
                        "primary-fixed": "#d6e3ff",
                        "on-primary": "#ffffff",
                        "surface-tint": "#405f91",
                        "background": "#faf9fe",
                        "on-secondary-container": "#586379",
                        "on-surface": "#1a1c1f",
                        "inverse-on-surface": "#f1f0f5",
                        "tertiary-container": "#003408",
                        "primary-container": "#002b5b",
                        "on-secondary-fixed-variant": "#3c475c",
                        "surface-container-high": "#e8e7ec",
                        "on-secondary-fixed": "#101c2e",
                        "on-primary-fixed": "#001b3d",
                        "surface-container-low": "#f4f3f8",
                        "error": "#ba1a1a",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#264778",
                        "surface-container-lowest": "#ffffff",
                        "primary": "#001736",
                        "surface-bright": "#faf9fe",
                        "secondary-fixed-dim": "#bcc7e0",
                        "tertiary-fixed": "#a3f69c",
                        "outline-variant": "#c4c6d0",
                        "surface-dim": "#dad9de",
                        "primary-fixed-dim": "#a9c7ff",
                        "outline": "#747780",
                        "on-tertiary-fixed": "#002204",
                        "surface-container-highest": "#e3e2e7",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed-variant": "#005312"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-nav {
            background: rgba(250, 249, 254, 0.8);
            backdrop-filter: blur(12px);
        }

        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body selection:bg-primary-fixed selection:text-on-primary-fixed">
    <!-- TopAppBar -->
   <header class="w-full sticky top-0 z-50 bg-[#faf9fe] dark:bg-slate-950 transition-all duration-300 ease-in-out">
    <nav class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#002B5B] dark:text-blue-400" data-icon="layers">layers</span>
            <span class="text-2xl font-black font-headline tracking-tight">
                <span class="text-[#002B5B] dark:text-blue-400">Queue</span><span class="text-[#FF6B00]">Flow</span>
            </span>
        </div>

        <div class="hidden md:flex gap-8 items-center">

            @php
                $navItem = fn($active) => $active
                    ? 'text-[#002B5B] dark:text-blue-400 font-bold border-b-2 border-[#002B5B] dark:border-blue-400 font-headline text-sm'
                    : 'text-slate-600 dark:text-slate-400 font-medium hover:text-[#002B5B] dark:hover:text-blue-300 hover:border-b-2 hover:border-[#002B5B] transition-colors font-headline text-sm';
            @endphp

            <a class="{{ $navItem(request()->is('/')) }}" href="/">Accueil</a>
            <a class="{{ $navItem(request()->routeIs('entreprises_disponibles')) }}" href="{{ route('entreprises_disponibles') }}">Entreprises</a>
            <a class="{{ $navItem(request()->is('contactez-nous')) }}" href="/contactez-nous">Contactez-nous</a>

            @auth
                <a class="{{ $navItem(request()->is('profile')) }}" href="#">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-slate-600 dark:text-slate-400 font-medium hover:text-red-600 dark:hover:text-red-400 hover:border-b-2 hover:border-red-600 transition-colors font-headline text-sm">
                        Déconnexion
                    </button>
                </form>
            @endauth

            @guest
                <a class="bg-primary px-6 py-2 rounded-xl text-white font-bold hover:bg-primary-container transition-all" href="{{ route('connexion_client') }}">Login</a>
            @endguest

        </div>

        <button class="md:hidden text-[#002B5B]">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </nav>
</header>
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-[#002B5B] text-white pt-16 pb-8 px-6 md:px-12 lg:px-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Logo et description -->
            <div>
                <div class="flex items-center gap-2 mb-5">
                    <span class="material-symbols-outlined text-[#FF6B00]">layers</span>
                    <h2 class="text-2xl font-black tracking-tight">
                        <span class="text-white">Queue</span><span class="text-[#FF6B00]">Flow</span>
                    </h2>
                </div>
                <p class="text-gray-300 leading-7 text-sm">
                    Simplifiez la gestion des files d’attente dans les banques, universités, administrations et autres services à forte affluence.
                </p>

                
            </div>

            <!-- Navigation rapide -->
            <div>
                <h3 class="text-lg font-bold mb-5">Navigation</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li><a href="#accueil" class="hover:text-[#FF6B00] transition">Accueil</a></li>
                    <li><a href="#fonctionnalites" class="hover:text-[#FF6B00] transition">Fonctionnalités</a></li>
                    <li><a href="#secteurs" class="hover:text-[#FF6B00] transition">Secteurs d’activité</a></li>
                    <li><a href="#temoignages" class="hover:text-[#FF6B00] transition">Témoignages</a></li>
                    <li><a href="#contact" class="hover:text-[#FF6B00] transition">Contact</a></li>
                </ul>
            </div>

            <!-- Secteurs -->
            <div>
                <h3 class="text-lg font-bold mb-5">Secteurs concernés</h3>
                <ul class="space-y-3 text-gray-300 text-sm">
                    <li>Banques et microfinances</li>
                    <li>Universités et écoles</li>
                    <li>Administrations publiques</li>
                    <li>Agences télécoms</li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold mb-5">Contact</h3>
                <div class="space-y-4 text-gray-300 text-sm">
                    <p class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#FF6B00] text-lg">mail</span>
                        contact@queueflow.com
                    </p>
                    <p class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#FF6B00] text-lg">call</span>
                        +229 01 97 05 71 49 | +229 01 62 69 66 46
                    </p>
                    <p class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#FF6B00] text-lg">location_on</span>
                        Abomey-Calavi, Bénin
                    </p>
                </div>
            </div>
        </div>

        <!-- Ligne de séparation -->
        <div class="border-t border-white/10 mt-12 pt-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-400">
                <p>© 2026 QueueFlow. Tous droits réservés.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-[#FF6B00] transition">Politique de confidentialité</a>
                    <a href="#" class="hover:text-[#FF6B00] transition">Conditions d’utilisation</a>
                </div>
            </div>
        </div>
    </footer>

       
    <!-- BottomNavBar (Mobile Only) -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full glass-nav flex justify-around items-center px-4 pb-4 pt-2 z-50 rounded-t-[0.75rem] shadow-[0_-8px_32px_rgba(0,0,0,0.05)] border-t border-[#eeedf2]/15">
        <a class="flex flex-col items-center justify-center bg-[#002B5B] text-white rounded-[0.75rem] px-4 py-1.5 transition-transform scale-95 active:scale-90" href="#">
            <span class="material-symbols-outlined" data-icon="home">home</span>
            <span class="font-['Inter'] text-[11px] font-semibold uppercase tracking-wider">Accueil</span>
        </a>
        <a class="flex flex-col items-center justify-center text-slate-500 dark:text-slate-400 p-2 transition-transform active:scale-90" href="#">
            <span class="material-symbols-outlined" data-icon="grid_view">grid_view</span>
            <span class="font-['Inter'] text-[11px] font-semibold uppercase tracking-wider">Secteurs</span>
        </a>
        <a class="flex flex-col items-center justify-center text-slate-500 dark:text-slate-400 p-2 transition-transform active:scale-90" href="#">
            <span class="material-symbols-outlined" data-icon="chat">chat</span>
            <span class="font-['Inter'] text-[11px] font-semibold uppercase tracking-wider">Contactez-nous</span>
        </a>
    </nav>
</body>

</html>