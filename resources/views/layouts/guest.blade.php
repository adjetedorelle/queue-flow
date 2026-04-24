<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>QueueFlow - Connexion</title>
    <!-- Google Fonts: Manrope & Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@700;800&amp;display=swap"
        rel="stylesheet" />
    <!-- Material Symbols Outlined -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "#e8e7ec",
                        "outline-variant": "#c4c6d0",
                        "surface-container-highest": "#e3e2e7",
                        "primary-fixed-dim": "#a9c7ff",
                        "on-error-container": "#93000a",
                        "outline": "#747780",
                        "on-primary-fixed": "#001b3d",
                        "on-tertiary-fixed-variant": "#005312",
                        "secondary-container": "#d5e0f9",
                        "primary": "#001736",
                        "surface-tint": "#405f91",
                        "surface-dim": "#dad9de",
                        "primary-container": "#002b5b",
                        "on-tertiary-container": "#55a454",
                        "on-surface": "#1a1c1f",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-container": "#586379",
                        "tertiary-container": "#003408",
                        "error": "#ba1a1a",
                        "tertiary-fixed-dim": "#88d982",
                        "on-tertiary-fixed": "#002204",
                        "on-primary-container": "#7594ca",
                        "secondary-fixed-dim": "#bcc7e0",
                        "on-secondary-fixed-variant": "#3c475c",
                        "tertiary-fixed": "#a3f69c",
                        "surface": "#faf9fe",
                        "primary-fixed": "#d6e3ff",
                        "surface-container": "#eeedf2",
                        "secondary": "#545f74",
                        "on-background": "#1a1c1f",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "surface-container-low": "#f4f3f8",
                        "background": "#faf9fe",
                        "on-primary": "#ffffff",
                        "inverse-on-surface": "#f1f0f5",
                        "inverse-surface": "#2f3034",
                        "tertiary": "#001d03",
                        "on-secondary-fixed": "#101c2e",
                        "inverse-primary": "#a9c7ff",
                        "secondary-fixed": "#d8e3fc",
                        "on-error": "#ffffff",
                        "on-surface-variant": "#43474f",
                        "on-primary-fixed-variant": "#264778",
                        "surface-variant": "#e3e2e7",
                        "surface-bright": "#faf9fe"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
            display: inline-block;
            vertical-align: middle
        }

        .bg-login-hero {
        background-image:  url('/images/connexion.jpeg');
        background-size: cover;
        background-position: center;
    }
    </style>
</head>

<body class="bg-surface font-body text-on-surface antialiased overflow-hidden">
    <!-- Header Navigation (Simplified for Transactional Page) -->
    <header class="absolute top-0 w-full flex justify-between items-center px-8 py-6 z-50">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#002B5B] dark:text-blue-400" data-icon="layers">layers</span>
            <span class="text-2xl font-black font-headline tracking-tight">
                <span class="text-[#002B5B] dark:text-blue-400">Queue</span><span class="text-[#FF6B00]">Flow</span>
            </span>
        </div>
        
    </header>
    <main class="flex h-screen w-full">
        <!-- Left Side: Visual/Editorial Content -->
        <section class="hidden lg:flex lg:w-1/2 relative bg-login-hero flex-col justify-end p-16 overflow-hidden"
            data-alt="Modern office lobby with abstract digital glow lines representing a seamless flow of people and data in a professional environment">
            <!-- Architectural Overlay -->
            <div class="absolute inset-0 bg-primary/20 backdrop-blur-[2px]"></div>
            <div class="relative z-10 space-y-6">
                <h1 class="font-headline text-5xl font-extrabold text-white leading-tight max-w-lg">
                    La fluidité au cœur de votre service client.
                </h1>
                <p class="text-white/80 font-body text-lg max-w-md">
                    Gérez vos flux de visiteurs avec une élégance architecturale et une précision numérique sans
                    précédent.
                </p>
                <div class="flex items-center space-x-8 pt-8">
                    <div class="flex flex-col">
                        <span class="font-headline text-3xl text-tertiary-fixed font-bold">12k+</span>
                        <span class="text-white/60 text-xs uppercase tracking-widest font-label">Utilisateurs
                            actifs</span>
                    </div>
                    <div class="w-px h-12 bg-white/20"></div>
                    <div class="flex flex-col">
                        <span class="font-headline text-3xl text-tertiary-fixed font-bold">99.9%</span>
                        <span class="text-white/60 text-xs uppercase tracking-widest font-label">Temps de réponse</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Right Side: Login Form -->
        <section class="w-full lg:w-1/2 flex items-center justify-center bg-surface-container-low px-6 sm:px-12">
            {{$slot}}
        </section>
    </main>
    <!-- Simple Footer Copyright -->
    <footer class="absolute bottom-0 w-full flex justify-end px-8 py-4 pointer-events-none">
        <p class="font-label text-[10px] uppercase tracking-widest text-slate-400/50">
            © 2024 QueueFlow Systems
        </p>
    </footer>

