<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed": "#001d32",
                        "on-surface-variant": "#584237",
                        "surface-container": "#e4efff",
                        "surface-container-highest": "#d3e4fa",
                        "secondary-fixed-dim": "#ffb690",
                        "secondary": "#8f4d27",
                        "primary-fixed-dim": "#ffb690",
                        "tertiary-container": "#00a2f4",
                        "on-primary-fixed-variant": "#783200",
                        "on-background": "#0c1d2d",
                        "on-tertiary-fixed-variant": "#004b74",
                        "on-secondary-container": "#773a16",
                        "on-secondary": "#ffffff",
                        "surface-bright": "#f8f9ff",
                        "surface": "#f8f9ff",
                        "on-error": "#ffffff",
                        "background": "#f8f9ff",
                        "primary-fixed": "#ffdbca",
                        "on-secondary-fixed": "#341100",
                        "surface-container-low": "#eef4ff",
                        "secondary-fixed": "#ffdbca",
                        "primary-container": "#f97316",
                        "outline-variant": "#e0c0b1",
                        "surface-tint": "#9d4300",
                        "on-tertiary-container": "#003554",
                        "on-primary-container": "#582200",
                        "on-error-container": "#93000a",
                        "surface-variant": "#d3e4fa",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#daeaff",
                        "on-tertiary": "#ffffff",
                        "primary": "#9d4300",
                        "on-surface": "#0c1d2d",
                        "inverse-on-surface": "#e9f1ff",
                        "tertiary-fixed": "#cde5ff",
                        "on-secondary-fixed-variant": "#713612",
                        "outline": "#8c7164",
                        "error": "#ba1a1a",
                        "inverse-surface": "#223243",
                        "surface-dim": "#cbdcf2",
                        "on-primary": "#ffffff",
                        "inverse-primary": "#ffb690",
                        "tertiary": "#006398",
                        "error-container": "#ffdad6",
                        "secondary-container": "#fda77a",
                        "tertiary-fixed-dim": "#93ccff",
                        "on-primary-fixed": "#341100"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.5rem",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .ticket-edge {
            background-image: radial-gradient(circle at center, transparent 0, transparent 8px, #ffffff 8px);
            background-size: 24px 24px;
            background-position: -12px -12px;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex items-center justify-center p-4">
<!-- Central Ticket Card -->
<main class="w-full max-w-2xl bg-surface-container-lowest rounded-2xl shadow-[0_32px_64px_rgba(11,28,44,0.12)] overflow-hidden flex flex-col">
<!-- Header Section -->
<header class="px-8 pt-8 pb-6 flex items-center justify-between border-b border-surface-container-low">
<div class="flex flex-col gap-1">
<span class="text-on-surface-variant font-label text-xs font-bold tracking-widest uppercase">STATUT DU RANG</span>
<h1 class="text-2xl font-extrabold tracking-tight text-on-surface">Votre ticket</h1>
</div>
<div class="flex items-center gap-2 bg-secondary-container/10 px-4 py-2 rounded-full">
<span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
<span class="text-primary font-semibold text-sm">En attente</span>
</div>
</header>
<!-- Ticket Core Content -->
<section class="relative px-8 py-12 flex flex-col items-center text-center">
<!-- Massive Ticket Number -->
<div class="mb-2">
<span class="text-on-surface-variant font-medium text-lg">ID UNIQUE</span>
</div>
<div class="text-6xl md:text-8xl font-black text-primary-container tracking-tighter drop-shadow-sm">
                #TK-2048
            </div>
<!-- Visual Element (Subtle Background Glow) -->
<div class="absolute inset-0 pointer-events-none flex justify-center items-center opacity-5">
<span class="material-symbols-outlined text-[240px]" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
</div>
<!-- Queue Summary -->
<div class="mt-8 bg-inverse-surface text-white px-6 py-4 rounded-xl flex items-center gap-4 shadow-lg z-10">
<span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">group</span>
<div class="text-left">
<p class="text-sm text-slate-300 font-medium">Position dans la file</p>
<p class="text-lg font-bold">3 personnes devant vous</p>
</div>
</div>
</section>
<!-- Perforated Line Visual -->
<div class="relative h-px w-full border-t border-dashed border-outline-variant opacity-40 px-4">
<div class="absolute -left-3 -top-3 w-6 h-6 rounded-full bg-surface"></div>
<div class="absolute -right-3 -top-3 w-6 h-6 rounded-full bg-surface"></div>
</div>
<!-- Secondary Grid Data -->
<section class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-low transition-colors hover:bg-surface-container-high">
<div class="p-2 rounded-lg bg-white shadow-sm">
<span class="material-symbols-outlined text-primary">person</span>
</div>
<div class="flex flex-col">
<span class="text-xs font-bold text-on-surface-variant tracking-wider uppercase">Client</span>
<span class="font-bold text-on-surface">Jean-Pierre Dupont</span>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-low transition-colors hover:bg-surface-container-high">
<div class="p-2 rounded-lg bg-white shadow-sm">
<span class="material-symbols-outlined text-primary">support_agent</span>
</div>
<div class="flex flex-col">
<span class="text-xs font-bold text-on-surface-variant tracking-wider uppercase">Service</span>
<span class="font-bold text-on-surface">Support Technique</span>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-low transition-colors hover:bg-surface-container-high">
<div class="p-2 rounded-lg bg-white shadow-sm">
<span class="material-symbols-outlined text-primary">schedule</span>
</div>
<div class="flex flex-col">
<span class="text-xs font-bold text-on-surface-variant tracking-wider uppercase">Heure d'arrivée</span>
<span class="font-bold text-on-surface">14:24 Today</span>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-low transition-colors hover:bg-surface-container-high">
<div class="p-2 rounded-lg bg-white shadow-sm">
<span class="material-symbols-outlined text-primary">hourglass_empty</span>
</div>
<div class="flex flex-col">
<span class="text-xs font-bold text-on-surface-variant tracking-wider uppercase">Attente estimée</span>
<span class="font-bold text-on-surface">~ 12 minutes</span>
</div>
</div>
</section>
<!-- Actions Section -->
<footer class="p-8 bg-surface-container-low/50 flex flex-col md:flex-row gap-4">
<button class="flex-1 py-4 px-8 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:opacity-90 transition-all active:scale-95">
<span class="material-symbols-outlined">download</span>
                Télécharger le ticket
            </button>
<button class="flex-1 py-4 px-8 border-2 border-outline-variant text-on-surface font-bold rounded-xl flex items-center justify-center gap-2 hover:bg-surface-container-lowest transition-all active:scale-95">
<span class="material-symbols-outlined">info</span>
                Voir les détails
            </button>
</footer>
<!-- Bottom Security Branding -->
<div class="pb-6 text-center">
<div class="flex items-center justify-center gap-2 text-on-surface-variant/40">
<span class="material-symbols-outlined text-sm">verified_user</span>
<span class="text-[10px] font-bold tracking-widest uppercase">Powered by QueueFlow Monolith System</span>
</div>
</div>
</main>
</body></html>