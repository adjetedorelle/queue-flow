<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rebalancement Tickets VIP - QueueFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #f3f4f6;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Rebalancement Tickets VIP</h1>
            <p class="text-gray-600">Gérez et reclassifiez les tickets VIP en tickets standard</p>
        </div>

        <!-- Tickets List -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if ($ticketsVip->isEmpty())
                <div class="p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <p class="text-gray-500 text-lg">Aucun ticket VIP en attente</p>
                </div>
            @else
                <div class="divide-y divide-gray-200">
                    @foreach ($ticketsVip as $ticket)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-gradient-to-r from-yellow-100 to-orange-100 px-3 py-1 rounded-full border border-yellow-300">
                                        <span class="text-xs font-bold text-yellow-800 uppercase tracking-wider">VIP</span>
                                    </div>
                                    <span class="text-2xl font-black text-gray-900">#{{ $ticket->numero }}</span>
                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                    <span class="text-sm font-medium text-gray-600">En attente</span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Client</p>
                                        <p class="font-semibold text-gray-900">{{ $ticket->client->utilisateur->nom ?? 'N/A' }} {{ $ticket->client->utilisateur->prenom ?? '' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Service</p>
                                        <p class="font-semibold text-gray-900">{{ $ticket->service->libelle }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Date de passage</p>
                                        <p class="font-semibold text-gray-900">{{ $ticket->jour_passage->format('d/m/Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Entreprise</p>
                                        <p class="font-semibold text-gray-900">{{ $ticket->service->entreprise->nom_ent ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                @if ($ticket->motif)
                                <div class="mt-4 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-3">
                                    <p class="text-xs font-bold text-yellow-800 uppercase tracking-wider mb-1">Motif VIP</p>
                                    <p class="text-sm text-yellow-900">{{ $ticket->motif }}</p>
                                </div>
                                @endif
                            </div>

                            <div class="ml-6 flex flex-col gap-2">
                                <form action="{{ route('tickets.rebalancer', $ticket->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir reclasser ce ticket VIP en standard ? Le client sera notifié.');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-sm">swap_horiz</span>
                                        Reclasser en Standard
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('tickets_en_attente', ['id_service' => 1]) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour aux tickets
            </a>
        </div>
    </div>
</body>
</html>
