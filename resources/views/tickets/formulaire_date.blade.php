<x-guest-layout>
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
                        "2xl": "2rem",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .ticket-type-radio:checked + .ticket-type-card {
            border-color: #f97316;
            background-color: #fff7ed;
            box-shadow: 0 10px 15px -3px rgb(249 115 22 / 0.1);
        }

        .ticket-type-radio:checked + .ticket-type-card .radio-circle {
            background-color: #f97316;
            border-color: #f97316;
        }

        .ticket-type-radio:checked + .ticket-type-card .radio-circle::after {
            content: '';
            display: block;
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .vip-card:checked + .ticket-type-card {
            border-color: #fbbf24;
            background: linear-gradient(to bottom right, #fffdf2, #fffbeb);
        }

        .vip-card:checked + .ticket-type-card .radio-circle {
            background-color: #fbbf24;
            border-color: #fbbf24;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out forwards;
        }
    </style>

    <div class="w-full max-w-2xl animate-slide-up mx-auto">
        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl md:rounded-3xl shadow-[0_32px_64px_rgba(11,28,44,0.08)] overflow-hidden">
            <!-- Header with branding -->
            <div class="bg-on-surface p-6 md:p-8 text-center relative overflow-hidden">
                <!-- Decorative shapes -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-tertiary/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-white font-black text-2xl tracking-tighter uppercase">QueueFlow</span>
                        <div class="h-2 w-2 bg-primary-container rounded-full animate-pulse"></div>
                    </div>
                    <h1 class="text-white text-xl md:text-3xl font-black tracking-tight leading-tight mb-2 text-center uppercase">Prendre un ticket</h1>
                    <p class="text-slate-400 text-[10px] md:text-sm font-medium tracking-wide uppercase">Veuillez remplir les informations suivantes</p>
                </div>
            </div>

            <!-- Service Context Info -->
            @if ($service && $entreprise)
            <div class="px-6 md:px-8 pt-6 md:pt-8 pb-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 md:p-5 bg-surface-container-low rounded-2xl border border-outline-variant/20 gap-4">
                    <div class="flex items-center gap-3 md:gap-4 min-w-0">
                        <div class="flex-shrink-0 p-2.5 md:p-3 bg-white rounded-xl shadow-sm">
                            <span class="material-symbols-outlined text-primary text-xl md:text-2xl">store</span>
                        </div>
                        <div class="min-w-0">
                            <h2 class="text-on-surface font-black text-sm md:text-base leading-tight uppercase tracking-tight truncate">{{ $entreprise->nom_ent }}</h2>
                            <p class="text-on-surface-variant text-[9px] md:text-[10px] font-bold uppercase tracking-widest truncate">{{ $service->libelle }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 bg-white/60 px-3 md:px-4 py-1.5 md:py-2 rounded-full self-start sm:self-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-xs md:text-sm">schedule</span>
                        <span class="text-on-surface font-bold text-[9px] md:text-xs uppercase">{{ $service->temps_estime }} min</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="px-6 md:px-8 mt-4">
                <div class="bg-red-50 border border-red-100 p-4 rounded-xl md:rounded-2xl flex gap-3">
                    <span class="material-symbols-outlined text-red-500 flex-shrink-0">error</span>
                    <div class="text-sm text-red-700 font-bold break-words">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('formulaire_date.submit') }}" method="POST" class="p-6 md:p-8 pt-4 space-y-6 md:space-y-8">
                @csrf
                @if ($service)
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                @endif

                <!-- Date Selection -->
                <div class="space-y-3">
                    <label for="date" class="text-[10px] font-black uppercase tracking-[0.2em] text-on-surface-variant ml-1">Date et heure de passage <span class="text-primary">*</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-on-surface-variant/40">calendar_today</span>
                        </div>
                        <input type="datetime-local" name="jour_passage" id="date" required
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full pl-14 pr-6 py-4 bg-surface-container-low border-2 border-transparent focus:border-primary-container focus:bg-white focus:ring-0 rounded-2xl text-on-surface font-bold transition-all placeholder-slate-400 text-sm">
                    </div>
                </div>

                <!-- Ticket Type Selection -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between px-1">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-on-surface-variant">Type de ticket <span class="text-primary">*</span></label>
                        @if ($client && $client->vip)
                        <div class="flex items-center gap-1.5 bg-yellow-50 px-2.5 py-1 rounded-full border border-yellow-200">
                            <span class="material-symbols-outlined text-yellow-600 text-[14px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                            <span class="text-[9px] font-black text-yellow-800 uppercase tracking-tighter">Éligible VIP</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Standard Ticket Card -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="type_ticket" value="standard" class="ticket-type-radio hidden" checked>
                            <div class="ticket-type-card p-4 md:p-5 border-2 border-outline-variant/10 bg-surface-container-low rounded-2xl flex flex-col gap-4 transition-all hover:border-outline-variant/30 h-full">
                                <div class="flex justify-between items-start">
                                    <div class="p-2.5 bg-white rounded-xl shadow-sm">
                                        <span class="material-symbols-outlined text-on-surface-variant">confirmation_number</span>
                                    </div>
                                    <div class="radio-circle w-5 h-5 border-2 border-on-surface-variant/20 rounded-full flex items-center justify-center transition-all"></div>
                                </div>
                                <div>
                                    <h3 class="text-on-surface font-black text-sm uppercase tracking-tight">Standard</h3>
                                    <p class="text-on-surface-variant text-[10px] font-medium leading-normal mt-1">Accès classique à la file d'attente</p>
                                </div>
                            </div>
                        </label>

                        <!-- VIP Ticket Card (if eligible) -->
                        @if ($client && $client->vip)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="type_ticket" value="vip" class="ticket-type-radio vip-card hidden">
                            <div class="ticket-type-card p-4 md:p-5 border-2 border-outline-variant/10 bg-surface-container-low rounded-2xl flex flex-col gap-4 transition-all hover:border-outline-variant/30 h-full">
                                <div class="flex justify-between items-start">
                                    <div class="p-2.5 bg-white rounded-xl shadow-sm">
                                        <span class="material-symbols-outlined text-yellow-600" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                                    </div>
                                    <div class="radio-circle w-5 h-5 border-2 border-on-surface-variant/20 rounded-full flex items-center justify-center transition-all"></div>
                                </div>
                                <div>
                                    <h3 class="text-yellow-800 font-black text-sm uppercase tracking-tight">VIP Priority</h3>
                                    <p class="text-yellow-600/70 text-[10px] font-medium leading-normal mt-1">Passage prioritaire avec motif justifié</p>
                                </div>
                            </div>
                        </label>
                        @endif
                    </div>
                </div>

                <!-- Motif (for VIP) - Animates in via JS -->
                <div id="motif-container" class="space-y-3 hidden">
                    <label for="motif" class="text-[10px] font-black uppercase tracking-[0.2em] text-yellow-800 ml-1">Motif de priorité <span class="text-primary">*</span></label>
                    <div class="relative group">
                        <textarea name="motif" id="motif" rows="3" 
                            placeholder="Veuillez justifier votre demande de priorité..."
                            class="w-full px-6 py-4 bg-yellow-50/50 border-2 border-yellow-200/50 focus:border-yellow-400 focus:bg-white focus:ring-0 rounded-2xl text-on-surface font-bold transition-all placeholder-yellow-800/30 resize-none text-sm"></textarea>
                    </div>
                </div>

                <!-- Reminder Selection -->
                <div class="space-y-3">
                    <label for="rappel" class="text-[10px] font-black uppercase tracking-[0.2em] text-on-surface-variant ml-1">Rappel (minutes avant)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-on-surface-variant/40">alarm</span>
                        </div>
                        <input type="number" name="rappel_minutes" id="rappel" min="1" max="60"
                            placeholder="Ex: 15"
                            class="w-full pl-14 pr-6 py-4 bg-surface-container-low border-2 border-transparent focus:border-primary-container focus:bg-white focus:ring-0 rounded-2xl text-on-surface font-bold transition-all placeholder-slate-400 text-sm">
                    </div>
                    <p class="text-[9px] font-bold text-on-surface-variant/40 uppercase tracking-widest text-center">Notification par Email & WhatsApp</p>
                </div>

                <!-- Submit Action -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-on-surface text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-on-surface/20 flex items-center justify-center gap-3 group hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Obtenir mon ticket
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
            </form>

            <!-- Footer branding -->
            <div class="p-8 bg-surface-container-low/30 text-center border-t border-dashed border-outline-variant/30">
                <div class="flex items-center justify-center gap-2 mb-1">
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] opacity-30">Powered by QueueFlow</span>
                </div>
            </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeRadios = document.querySelectorAll('input[name="type_ticket"]');
            const motifContainer = document.getElementById('motif-container');
            const motifInput = document.getElementById('motif');

            function toggleMotifField() {
                const checkedRadio = document.querySelector('input[name="type_ticket"]:checked');
                if (!checkedRadio) return;
                
                const selectedType = checkedRadio.value;
                if (selectedType === 'vip') {
                    motifContainer.classList.remove('hidden');
                    motifInput.required = true;
                } else {
                    motifContainer.classList.add('hidden');
                    motifInput.required = false;
                    motifInput.value = '';
                }
            }

            typeRadios.forEach(radio => {
                radio.addEventListener('change', toggleMotifField);
            });

            toggleMotifField();
        });
    </script>
</x-guest-layout>
