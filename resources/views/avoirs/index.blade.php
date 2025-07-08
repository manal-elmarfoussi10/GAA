@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Mes Avoirs</h1>
        <a href="{{ route('avoirs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un Avoir
        </a>
    </div>

    <div class="flex items-center gap-4 mb-4">
        <div class="relative">
            <button onclick="toggleColumnMenu()" class="border px-4 py-2 rounded shadow text-sm">
                Colonne visible
            </button>
            <div id="columnMenu" class="absolute left-0 mt-2 w-64 bg-white border rounded shadow-lg z-50 p-4 hidden">
                <ul>
                    @foreach([
                        'col-avoir' => '1: Avoir',
                        'col-date' => '2: Date',
                        'col-dossier' => '3: Dossier',
                        'col-ht' => '4: Montant HT',
                        'col-ttc' => '5: Montant TTC',
                        'col-paye' => '6: Paiement encaissé',
                        'col-facture' => '7: Facture associé',
                        'col-annee' => '8: Année fiscale',
                        'col-rdv' => '9: Date de RDV',
                        'col-actions' => '10: Actions'
                    ] as $class => $label)
                        <li><label><input type="checkbox" class="column-toggle" data-column="{{ $class }}" checked> {{ $label }}</label></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <a href="{{ route('avoirs.export.excel') }}" class="border px-4 py-2 rounded shadow text-sm">Export en Excel</a>
        <a href="{{ route('avoirs.export.pdf') }}" class="border px-4 py-2 rounded shadow text-sm">Export en PDF</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-date">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-dossier">Dossier</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-actions">Actions</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-avoir">Avoir</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ht">HT</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ttc">TTC</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-paye">Paiement encaissé</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-facture">Facture associé</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-annee">Année fiscale</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-rdv">Date de RDV</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($avoirs as $avoir)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm col-date">{{ $avoir->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm col-dossier">{{ $avoir->facture->client->nom_assure ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-orange-600 space-y-1 col-actions">
                            <a href="{{ route('avoirs.edit', $avoir->id) }}">Modifier</a><br>
                            <form action="{{ route('avoirs.destroy', $avoir->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm col-avoir">
                            <a href="#" class="bg-teal-100 text-teal-700 px-2 py-1 rounded">Télécharger</a>
                        </td>
                        <td class="px-6 py-4 text-sm col-ht">{{ number_format($avoir->montant ?? 0, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-ttc">{{ number_format($avoir->montant ?? 0, 2) }} €</td>
                        <td class="px-6 py-4 text-sm col-paye">-</td>
                        <td class="px-6 py-4 text-sm col-facture">{{ $avoir->facture->numero ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm col-annee">{{ $avoir->created_at->year }}</td>
                        <td class="px-6 py-4 text-sm col-rdv">
                            {{ optional($avoir->facture->client->rdvs->first())->start_time ?? '-' }}
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
        const menu = document.getElementById('columnMenu');
        const button = document.querySelector('button[onclick="toggleColumnMenu()"]');
        if (!menu.contains(e.target) && !button.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    document.querySelectorAll('.column-toggle').forEach(toggle => {
        toggle.addEventListener('change', function () {
            const col = this.dataset.column;
            document.querySelectorAll('.' + col).forEach(cell => {
                cell.style.display = this.checked ? '' : 'none';
            });
        });
    });
</script>
@endsection