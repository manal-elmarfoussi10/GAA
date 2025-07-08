@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Mes Factures</h1>
        <a href="{{ route('factures.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter une Facture
        </a>
    </div>

    <div class="flex items-center gap-4 mb-4">
        <div class="relative">
            <button onclick="toggleColumnMenu()" class="border px-4 py-2 rounded shadow text-sm">
                Colonne visible
            </button>
            <div id="columnMenu" class="absolute left-0 mt-2 w-64 bg-white border rounded shadow-lg z-50 p-4 hidden">
                <ul>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-facture" checked> Facture</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-date" checked> Date</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-dossier" checked> Dossier</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-ht" checked> Montant HT</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-ttc" checked> Montant TTC</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-avoir" checked> Total Avoir</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-reste" checked> RESTE</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-status" checked> Statut</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-actions" checked> Actions</label></li>
                </ul>
            </div>
        </div>
        <button class="border px-4 py-2 rounded shadow text-sm"><a href="{{ route('factures.export.excel') }}">Export en Excel</a></button>
        <button class="border px-4 py-2 rounded shadow text-sm"><a href="{{ route('factures.export.pdf') }}">Export en PDF</a></button>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-date">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-dossier">Dossier</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-facture">Facture</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ht">HT</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ttc">TTC</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-avoir">Avoir</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-reste">RESTE</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-status">Statut</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                    @php
                        $paye = $facture->paiements?->sum('montant') ?? 0;
                        $avoir = $facture->avoirs?->sum('montant') ?? 0;
                        $reste = $facture->total_ttc - $paye - $avoir;
                        $last = $facture->paiements?->sortByDesc('date')->first();
                    @endphp
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm col-date">{{ $facture->date_facture }}</td>
                        <td class="px-6 py-4 text-sm col-dossier">{{ $facture->client->nom_assure ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm col-facture">
                            <a href="{{ route('factures.download.pdf', $facture->id) }}" class="bg-black text-white px-2 py-1 rounded hover:bg-orange-500 transition">Télécharger</a>
                        </td>
                        <td class="px-6 py-4 text-sm col-ht">{{ number_format($facture->total_ht, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-ttc">{{ number_format($facture->total_ttc, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-avoir">{{ number_format($avoir, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-reste">{{ number_format($reste, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-status">
                            @if ($reste > 0)
                                <span class="text-red-500 font-semibold">Non acquittée</span>
                            @else
                                <span class="text-green-600 font-semibold">Acquittée</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm col-actions space-y-1 text-orange-600">
                            @if ($reste > 0)
                                <a href="{{ route('paiements.create', ['facture_id' => $facture->id]) }}">Déclarer un paiement</a><br>
                                <a href="{{ route('factures.acquitter', $facture->id) }}" class="text-red-600 hover:underline">Acquitter la facture</a><br>
                                <a href="{{ route('avoirs.create.fromFacture', $facture->id) }}">Créer un avoir</a>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleColumnMenu() {
        document.getElementById('columnMenu').classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const columnMenu = document.getElementById('columnMenu');
        const button = document.querySelector('button[onclick="toggleColumnMenu()"]');
        if (!columnMenu.contains(e.target) && !button.contains(e.target)) {
            columnMenu.classList.add('hidden');
        }
    });

    document.querySelectorAll('.column-toggle').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const columnClass = this.dataset.column;
            document.querySelectorAll('.' + columnClass).forEach(cell => {
                cell.style.display = this.checked ? '' : 'none';
            });
        });
    });
</script>
@endsection