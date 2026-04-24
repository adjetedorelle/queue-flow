@extends('layouts.frontend')
@section('content')
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .signature-glow {
            background: linear-gradient(135deg, #9d4300 0%, #f97316 100%);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>


    <body class="bg-surface text-on-surface">
        <main class="max-w-6xl mx-auto py-10 px-6">
            <!-- Header Section -->
            <header class="mb-12 text-center">
                <div class="inline-flex items-center justify-center p-3 mb-6 bg-inverse-surface rounded-xl shadow-lg">
                    <span class="material-symbols-outlined text-orange-500 text-3xl hover:scale-110 transition">
                        account_balance</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-on-surface tracking-tighter mb-4">
                    Services - {{ $services[0]->entreprise->nom_ent }} </h1>
                @foreach ($services as $service)
                    {{ $service->nom_ent }}
                @endforeach
                <p class="text-on-surface-variant text-lg max-w-2xl mx-auto">
                    Choisissez un service pour obtenir votre ticket et suivez votre progression en temps réel.
                </p>
            </header>
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                @foreach ($services as $service)
                    <div
                        class="group bg-surface-container-lowest rounded-xl shadow-lg p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl relative overflow-hidden">
                        <div class="flex justify-between items-start mb-6">

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                                Disponible
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-on-surface mb-2">{{ $service->libelle }}</h3>

                        <div class="flex items-center text-on-surface-variant text-sm mb-8">
                            <span class="material-symbols-outlined text-lg mr-2" data-icon="schedule">schedule</span>
                            <span class="font-medium">{{ $service->temps_estime }}</span>
                        </div>

                        <button
                            @if (!auth()->check() || auth()->user()->role !== 'client') onclick="window.location.href='{{ route('connexion_client') }}'"
    @else
        onclick="window.location.href='{{ route('formulaire_date') }}'" @endif
                            class="signature-glow text-white w-full py-4 rounded-xl font-bold tracking-tight transition-transform active:scale-95 flex items-center justify-center gap-2 group-hover:shadow-lg group-hover:shadow-primary/20">
                            Prendre un ticket
                            <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endsection
