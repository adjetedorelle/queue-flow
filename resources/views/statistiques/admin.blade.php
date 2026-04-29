<x-app-layout>
    <div class="mb-10">
        <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Statistiques & Rapports</h2>
        <p class="text-on-surface-variant text-sm mt-1">Exportez les données de {{ $entreprise->nom_ent }}.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Export Tickets admin --}}
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-surface-container hover:shadow-md transition-shadow">
            <div class="p-3 bg-orange-50 rounded-lg w-fit mb-4">
                <span class="material-symbols-outlined text-orange-600 text-3xl">confirmation_number</span>
            </div>
            <h3 class="text-lg font-bold mb-1">Tickets de mon entreprise</h3>
            <p class="text-sm text-on-surface-variant mb-6">
                Exportez tous les tickets générés par votre entreprise avec le service, la date exacte et le numéro de ticket.
            </p>
            <a href="{{ route('export.tickets.admin') }}"
                class="group relative inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white overflow-hidden shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 transition-all duration-300 hover:scale-105"
                style="background: linear-gradient(135deg, #9d4300 0%, #f97316 60%, #fb923c 100%)">
                <span class="material-symbols-outlined text-sm transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5">download</span>
                Exporter en Excel
                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300 rounded-xl"></span>
            </a>
        </div>

    </div>
</x-app-layout>