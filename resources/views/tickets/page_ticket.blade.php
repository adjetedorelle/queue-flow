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
        
        /* Receipt Effect */
        .receipt-container {
            filter: drop-shadow(0 20px 25px rgb(0 0 0 / 0.1));
            position: relative;
            background: #ffffff;
        }

        .receipt-zigzag-top {
            position: absolute;
            top: -12px;
            left: 0;
            width: 100%;
            height: 12px;
            background: linear-gradient(-135deg, transparent 6px, #ffffff 0),
                        linear-gradient(135deg, transparent 6px, #ffffff 0);
            background-size: 12px 12px;
            transform: rotate(180deg);
        }

        .receipt-zigzag-bottom {
            position: absolute;
            bottom: -12px;
            left: 0;
            width: 100%;
            height: 12px;
            background: linear-gradient(-135deg, transparent 6px, #ffffff 0),
                        linear-gradient(135deg, transparent 6px, #ffffff 0);
            background-size: 12px 12px;
        }

        .receipt-paper {
            background-image: 
                radial-gradient(#e5e7eb 0.5px, transparent 0.5px),
                radial-gradient(#e5e7eb 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-attachment: fixed;
        }

        /* Print styles for thermal printer format */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            
            .receipt-container {
                filter: none;
                box-shadow: none;
                width: 80mm;
                margin: 0 auto;
                padding: 5mm;
            }
            
            .receipt-zigzag-top,
            .receipt-zigzag-bottom {
                display: none;
            }
            
            @page {
                margin: 0;
                size: 80mm auto;
            }
        }
    </style>
<style>
    body {
      min-height: 100dvh;
      background-color: #f3f4f6; /* Subtle grey background to make the white receipt pop */
    }
  </style>
  </head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex items-center justify-center p-4 md:p-8">
<!-- Central Receipt Container -->
<main class="w-full max-w-md receipt-container flex flex-col my-8">
    <!-- Receipt Zigzag Top -->
    <div class="receipt-zigzag-top"></div>

    <!-- Receipt Content -->
    <div class="bg-white px-6 py-10 md:px-8">
        <!-- Enterprise Header -->
        <header class="text-center mb-10">
            <h2 class="text-2xl font-black text-on-surface uppercase tracking-tighter mb-1">
                {{ $ticket->service->entreprise->nom_ent ?? 'QueueFlow' }}
            </h2>
            <p class="text-xs text-on-surface-variant font-medium uppercase tracking-widest opacity-70">
                {{ $ticket->service->entreprise->adresse ?? 'Service de Gestion de File' }}
            </p>
            <div class="mt-4 border-y border-dashed border-outline-variant/30 py-2 flex justify-between items-center px-2">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                <span class="text-[10px] font-bold text-on-surface-variant uppercase">{{ \Carbon\Carbon::now()->format('H:i') }}</span>
            </div>
        </header>

        <!-- Main Ticket Number -->
        <section class="text-center mb-10 relative">
            @if ($ticket->type === 'vip')
            <div class="mb-4 inline-flex items-center gap-2 bg-gradient-to-r from-yellow-100 to-orange-100 px-4 py-2 rounded-full border border-yellow-300">
                <span class="material-symbols-outlined text-yellow-600 text-sm" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                <span class="text-xs font-bold text-yellow-800 uppercase tracking-wider">VIP</span>
            </div>
            @endif
            <span class="text-[10px] font-black text-primary tracking-[0.2em] uppercase mb-4 block">Numéro de Passage</span>
            <div class="text-7xl md:text-8xl font-black text-on-surface tracking-tighter py-4">
                {{ $ticket->numero }}
            </div>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="h-2 w-2 rounded-full bg-primary-container animate-pulse"></span>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">En attente</span>
            </div>
            
            <!-- Decorative Barcode-like lines -->
            <div class="mt-8 flex justify-center gap-1 opacity-20">
                @for($i = 0; $i < 40; $i++)
                    <div class="h-8 w-[2px] bg-on-surface" style="width: {{ rand(1, 4) }}px"></div>
                @endfor
            </div>
        </section>

        <!-- Queue Details -->
        <section class="space-y-4 mb-10">
            <div class="flex justify-between items-end border-b border-dashed border-outline-variant/30 pb-2">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Position</span>
                <span class="text-lg font-black text-on-surface">{{ $ticket->fileAttente->nb_client_restant }} personne(s)</span>
            </div>
            <div class="flex justify-between items-end border-b border-dashed border-outline-variant/30 pb-2">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Service</span>
                <span class="text-sm font-bold text-on-surface uppercase">{{ $ticket->service->libelle }}</span>
            </div>
            <div class="flex justify-between items-end border-b border-dashed border-outline-variant/30 pb-2">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Client</span>
                <span class="text-sm font-bold text-on-surface truncate ml-4">{{ $ticket->client->utilisateur->nom ?? 'N/A' }} {{ $ticket->client->utilisateur->prenom ?? '' }}</span>
            </div>
            <div class="flex justify-between items-end border-b border-dashed border-outline-variant/30 pb-2">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Temps Estimé</span>
                <span class="text-sm font-bold text-on-surface">{{ $ticket->service->temps_estime }} min</span>
            </div>
            @if ($ticket->type === 'vip' && $ticket->motif)
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-3 mt-4">
                <span class="text-xs font-bold text-yellow-800 uppercase tracking-wider block mb-1">Motif VIP</span>
                <span class="text-sm text-yellow-900">{{ $ticket->motif }}</span>
            </div>
            @endif
        </section>

        <!-- QR Code / Visual Placeholder -->
        <div class="flex flex-col items-center justify-center py-6 border-2 border-dashed border-outline-variant/20 rounded-2xl bg-surface-container-lowest mb-10">
            <span class="material-symbols-outlined text-6xl text-on-surface/10 mb-2" style="font-variation-settings: 'opsz' 48;">qr_code_2</span>
            <span class="text-[8px] font-bold text-on-surface-variant/40 uppercase tracking-[0.3em]">Scannez pour suivre votre rang</span>
        </div>

        <!-- Action Buttons (No Print) -->
        <div class="flex flex-col gap-3 no-print">
            <a href="{{ route('tickets.pdf', $ticket->id) }}" class="w-full py-4 bg-on-surface text-white font-black text-xs uppercase tracking-[0.2em] rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">download</span>
                Télécharger
            </a>
            <button class="w-full py-4 border-2 border-outline-variant text-on-surface font-black text-xs uppercase tracking-[0.2em] rounded-xl hover:bg-surface-container-low transition-all">
                Détails de la file
            </button>
        </div>
    </div>

    <!-- Bottom Branding -->
    <footer class="text-center py-8 px-6">
        <div class="flex flex-col items-center gap-1 opacity-30">
            <span class="text-[9px] font-black uppercase tracking-[0.4em]">QueueFlow Monolith</span>
            <span class="text-[7px] font-bold uppercase tracking-widest">Digital Queue Management Systems</span>
        </div>
    </footer>

    <!-- Receipt Zigzag Bottom -->
    <div class="receipt-zigzag-bottom"></div>
</main>
</body></html>