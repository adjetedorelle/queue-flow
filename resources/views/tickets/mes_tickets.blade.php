@extends('layouts.frontend')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-surface via-background to-surface-bright py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-4xl font-bold text-on-surface tracking-tight">Mes Tickets</h1>
                        <p class="text-on-surface-variant mt-2">Consultez et gérez tous vos tickets de file d'attente</p>
                    </div>
                    <div class="bg-primary text-on-primary rounded-full px-6 py-3 font-semibold text-lg shadow-lg">
                        {{ $ticketsParStatut['tous'] }} {{ $ticketsParStatut['tous'] > 1 ? 'tickets' : 'ticket' }}
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('mes_tickets', ['statut' => 'tous']) }}" 
                       class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $filtre === 'tous' ? 'bg-primary text-on-primary shadow-lg scale-105' : 'bg-surface-container text-on-surface hover:bg-surface-container-high hover:shadow-md' }}">
                        Tous ({{ $ticketsParStatut['tous'] }})
                    </a>
                    <a href="{{ route('mes_tickets', ['statut' => 'en_attente']) }}" 
                       class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $filtre === 'en_attente' ? 'bg-yellow-500 text-white shadow-lg scale-105' : 'bg-surface-container text-on-surface hover:bg-surface-container-high hover:shadow-md' }}">
                        En attente ({{ $ticketsParStatut['en_attente'] }})
                    </a>
                    <a href="{{ route('mes_tickets', ['statut' => 'en_cours']) }}" 
                       class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $filtre === 'en_cours' ? 'bg-blue-500 text-white shadow-lg scale-105' : 'bg-surface-container text-on-surface hover:bg-surface-container-high hover:shadow-md' }}">
                        En cours ({{ $ticketsParStatut['en_cours'] }})
                    </a>
                    <a href="{{ route('mes_tickets', ['statut' => 'traite']) }}" 
                       class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $filtre === 'traite' ? 'bg-green-500 text-white shadow-lg scale-105' : 'bg-surface-container text-on-surface hover:bg-surface-container-high hover:shadow-md' }}">
                        Traités ({{ $ticketsParStatut['traite'] }})
                    </a>
                    <a href="{{ route('mes_tickets', ['statut' => 'annule']) }}" 
                       class="px-6 py-3 rounded-xl font-medium transition-all duration-200 {{ $filtre === 'annule' ? 'bg-gray-500 text-white shadow-lg scale-105' : 'bg-surface-container text-on-surface hover:bg-surface-container-high hover:shadow-md' }}">
                        Annulés ({{ $ticketsParStatut['annule'] }})
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-md">
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @if($tickets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tickets as $ticket)
                        @php
                            $statutColors = [
                                'en_attente' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-300', 'label' => 'En attente'],
                                'en_cours' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-300', 'label' => 'En cours'],
                                'traite' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-300', 'label' => 'Traité'],
                                'annule' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-300', 'label' => 'Annulé'],
                            ];
                            $statutStyle = $statutColors[$ticket->statut] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-300', 'label' => 'Inconnu'];
                        @endphp

                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-outline-variant hover:scale-105 transform">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <span class="inline-block {{ $statutStyle['bg'] }} {{ $statutStyle['text'] }} {{ $statutStyle['border'] }} border px-3 py-1 rounded-full text-xs font-semibold mb-2">
                                            {{ $statutStyle['label'] }}
                                        </span>
                                        @if($ticket->type === 'vip')
                                            <span class="inline-block bg-purple-100 text-purple-800 border border-purple-300 px-3 py-1 rounded-full text-xs font-semibold mb-2 ml-2">
                                                VIP
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3 class="text-3xl font-bold text-primary mb-1">{{ $ticket->numero }}</h3>
                                    <p class="text-sm text-on-surface-variant">Numéro de ticket</p>
                                </div>

                                <div class="space-y-3 mb-6">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-on-surface">{{ $ticket->service->libelle }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ $ticket->service->entreprise->nom_ent }}</p>
                                        </div>
                                    </div>

                                    @if($ticket->agence)
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-on-surface">{{ $ticket->agence->nom }}</p>
                                                <p class="text-xs text-on-surface-variant">Agence</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-primary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-on-surface">{{ \Carbon\Carbon::parse($ticket->jour_passage)->format('d/m/Y') }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ \Carbon\Carbon::parse($ticket->heure_exact)->format('H:i') }}</p>
                                        </div>
                                    </div>

                                    @if($ticket->statut === 'en_attente' && isset($ticket->position))
                                        @php
                                            $personnesAvant = $ticket->position - 1;
                                        @endphp
                                        <div class="flex items-start bg-surface-container rounded-lg p-3">
                                            <svg class="w-5 h-5 text-tertiary mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <div class="flex-1">
                                                @if($personnesAvant === 0)
                                                    <p class="text-sm font-bold text-green-600">🎉 Vous êtes le prochain !</p>
                                                @else
                                                    <p class="text-sm font-semibold text-tertiary">Position {{ $ticket->position }}</p>
                                                    <p class="text-xs text-on-surface-variant">{{ $personnesAvant }} {{ $personnesAvant > 1 ? 'personnes' : 'personne' }} avant vous</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if($ticket->rappel_minutes)
                                        <div class="flex items-center text-xs text-on-surface-variant bg-surface-container rounded-lg p-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                            </svg>
                                            Rappel {{ $ticket->rappel_minutes }} min avant
                                        </div>
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('page_ticket', $ticket->id) }}" 
                                       class="flex-1 bg-primary hover:bg-primary-container text-on-primary text-center py-3 px-4 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
                                        Voir détails
                                    </a>
                                    <a href="{{ route('tickets.pdf', $ticket->id) }}" 
                                       class="bg-surface-container hover:bg-surface-container-high text-on-surface p-3 rounded-xl transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5"
                                       title="Télécharger PDF">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                </div>
                                
                                @if(in_array($ticket->statut, ['en_attente', 'en_cours']))
                                    <button onclick="confirmerAnnulation({{ $ticket->id }})" 
                                            class="w-full mt-3 bg-red-500 hover:bg-red-600 text-white text-center py-3 px-4 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
                                        Annuler le ticket
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $tickets->appends(['statut' => $filtre])->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-outline mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-on-surface mb-2">Aucun ticket trouvé</h3>
                    <p class="text-on-surface-variant mb-6">
                        @if($filtre !== 'tous')
                            Vous n'avez aucun ticket avec le statut "{{ $filtre }}".
                        @else
                            Vous n'avez pas encore de tickets. Commencez par réserver un service.
                        @endif
                    </p>
                    <a href="{{ route('entreprises_disponibles') }}" 
                       class="inline-block bg-primary hover:bg-primary-container text-on-primary py-3 px-8 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
                        Découvrir les services
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de confirmation d'annulation -->
    <div id="modalAnnulation" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all">
            <div class="text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Annuler ce ticket ?</h3>
                <p class="text-gray-600">Êtes-vous sûr de vouloir annuler ce ticket ? Cette action est irréversible.</p>
            </div>
            
            <form id="formAnnulation" method="POST" action="">
                @csrf
                <div class="flex gap-3">
                    <button type="button" onclick="fermerModal()" 
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-4 rounded-xl font-semibold transition-all duration-200">
                        Garder le ticket
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 px-4 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg">
                        Confirmer l'annulation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function confirmerAnnulation(ticketId) {
            const modal = document.getElementById('modalAnnulation');
            const form = document.getElementById('formAnnulation');
            form.action = `/tickets/${ticketId}/annuler`;
            modal.classList.remove('hidden');
        }

        function fermerModal() {
            const modal = document.getElementById('modalAnnulation');
            modal.classList.add('hidden');
        }

        // Fermer le modal en cliquant en dehors
        document.getElementById('modalAnnulation').addEventListener('click', function(e) {
            if (e.target === this) {
                fermerModal();
            }
        });

        // Fermer le modal avec la touche Échap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                fermerModal();
            }
        });
    </script>
@endsection
