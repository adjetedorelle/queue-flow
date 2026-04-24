@extends('layouts.frontend')
@section('content')
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .kinetic-glow {
            background: linear-gradient(135deg, #9d4300 0%, #f97316 100%);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);

        }
    </style>
    </head>

    <body class="bg-surface font-body text-on-surface">
        <main class="max-w-7xl mx-auto px-6 py-20">
            <!-- Header Section -->
            <header class="mb-16 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#0B1C2C] tracking-tight mb-4">
                    Entreprises disponibles
                </h1>
                <p class="text-on-surface-variant text-lg max-w-2xl mx-auto">
                    Choisissez une entreprise et prenez un ticket rapidement pour éviter l'attente.
                </p>
            </header>
            <!-- Business Directory Grid -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Business Card 1 -->
                @foreach ($entreprises as $entreprise)
                    <article
                        class="bg-surface-container-lowest rounded-xl shadow-[0px_32px_64px_rgba(34,50,67,0.06)] overflow-hidden transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-48 overflow-hidden">
                            <img alt="{{ $entreprise->nom_ent }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                src="{{ asset('storage/' . $entreprise->image) }}" />
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-xs font-bold text-tertiary flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></span>
                                    Ouvert
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-on-surface">{{ $entreprise->nom_ent }}</h3>
                            </div>
                            <div class="flex items-center text-on-surface-variant text-sm gap-3">
                                <p><strong>Adresse : </strong>{{ $entreprise->adresse }}</p>
                            </div>
                            <div class="flex items-center text-on-surface-variant text-sm gap-3">

                                <p><strong>Description : </strong>{{ $entreprise->bio }}</p>
                            </div>
                            <div class="space-y-3 mb-8">
                                <div class="flex items-center text-on-surface-variant text-sm gap-3">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="calendar_month">calendar_month</span>
                                    <p><strong>Jour d'ouverture :</strong>{{ $entreprise->jour_ouv }}</p>
                                </div>
                                <div class="flex items-center text-on-surface-variant text-sm gap-3">
                                    <span class="material-symbols-outlined text-lg" data-icon="schedule">schedule</span>
                                    <p><strong>Horaires : </strong>{{ $entreprise->heure_ouv }}
                                        {{ $entreprise->heure_ferm }}</p>
                                </div>

                            </div>
                            <button
                                class="w-full kinetic-glow text-white font-bold py-4 rounded-lg flex items-center justify-center gap-2 transition-all duration-300 shadow-lg shadow-primary-container/20 hover:shadow-primary-container/40"
                                onclick="window.location.href='{{ route('services_disponibles', ['id_entreprise' => $entreprise->id]) }}'">
                                voir les services
                                
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination / Load More (Subtle Tonal Shift) -->
            <div class="mt-16 flex justify-center">
                {{ $entreprises->links() }}
            </div>


        </main>
    @endsection
