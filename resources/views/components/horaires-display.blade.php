@props(['entreprise', 'format' => 'compact', 'showModal' => true])

@php
    $horaires = $entreprise->horaires ?? [];
    $joursOuverts = $entreprise->getJoursOuvertsTexte();
    $horairesResume = $entreprise->getHorairesResume();
    $modalId = 'modal-horaires-' . $entreprise->id;
@endphp

@if($format === 'compact')
    {{-- Format compact pour les cartes --}}
    <div class="space-y-2">
        <div class="flex items-center text-on-surface-variant text-sm gap-3">
            <span class="material-symbols-outlined text-lg">calendar_month</span>
            <p><strong>Jours :</strong> {{ $joursOuverts }}</p>
        </div>
        <div class="flex items-center text-on-surface-variant text-sm gap-3">
            <span class="material-symbols-outlined text-lg">schedule</span>
            <p><strong>Horaires :</strong> {{ $horairesResume }}</p>
            @if($showModal && !empty($horaires))
                <button type="button" 
                        onclick="openHorairesModal('{{ $modalId }}')"
                        class="text-primary hover:text-primary-container transition-colors"
                        title="Voir les détails">
                    <span class="material-symbols-outlined text-[18px]">info</span>
                </button>
            @endif
        </div>
    </div>
@else
    {{-- Format table pour le tableau admin --}}
    <div class="flex flex-col gap-1">
        <span class="text-sm font-semibold text-on-surface">{{ $joursOuverts }}</span>
        <span class="text-xs text-on-surface-variant">{{ $horairesResume }}</span>
        @if($showModal && !empty($horaires))
            <button type="button" 
                    onclick="openHorairesModal('{{ $modalId }}')"
                    class="text-xs text-primary hover:text-primary-container transition-colors text-left mt-1 flex items-center gap-1">
                <span class="material-symbols-outlined text-[14px]">visibility</span>
                Voir détails
            </button>
        @endif
    </div>
@endif

@if($showModal && !empty($horaires))
    {{-- Modal avec les détails complets --}}
    <div id="{{ $modalId }}" 
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4"
         onclick="if(event.target === this) closeHorairesModal('{{ $modalId }}')">
        <div class="bg-surface-container-lowest rounded-xl shadow-2xl max-w-md w-full max-h-[80vh] overflow-y-auto"
             onclick="event.stopPropagation()">
            {{-- Header --}}
            <div class="sticky top-0 bg-surface-container-lowest border-b border-surface-container-high p-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-on-surface">Horaires d'ouverture</h3>
                <button type="button" 
                        onclick="closeHorairesModal('{{ $modalId }}')"
                        class="text-on-surface-variant hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            {{-- Body --}}
            <div class="p-6 space-y-3">
                @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour)
                    @php
                        $jourData = $horaires[$jour] ?? ['ferme' => true, 'plages' => []];
                        $ferme = $jourData['ferme'] ?? true;
                        $plages = $jourData['plages'] ?? [];
                    @endphp
                    <div class="flex items-start justify-between py-2 border-b border-surface-container-low last:border-0">
                        <span class="font-semibold text-on-surface min-w-[100px]">{{ $jour }}</span>
                        <div class="text-right">
                            @if($ferme || empty($plages))
                                <span class="text-on-surface-variant italic">Fermé</span>
                            @else
                                <div class="space-y-1">
                                    @foreach($plages as $plage)
                                        <div class="text-on-surface font-medium">
                                            {{ substr($plage['debut'], 0, 5) }} - {{ substr($plage['fin'], 0, 5) }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
