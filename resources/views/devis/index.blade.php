@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Devis</h1>
        <a href="{{ route('devis.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un devis
        </a>
    </div>

    <div class="flex items-center gap-4 mb-4">
        <div class="relative">
            <button onclick="toggleColumnMenu()" class="border px-4 py-2 rounded shadow text-sm">
                Colonne visible
            </button>
            <div id="columnMenu" class="absolute left-0 mt-2 w-64 bg-white border rounded shadow-lg z-50 p-4 hidden">
                <ul>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-devis" checked> 1: Devis</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-date" checked> 2: Date</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-dossier" checked> 3: Dossier</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-ht" checked> 4: Montant HT</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-ttc" checked> 5: Montant TTC</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-rdv" checked> 6: Date de RDV</label></li>
                    <li><label><input type="checkbox" class="column-toggle" data-column="col-actions" checked> 7: Actions</label></li>
                </ul>
            </div>
        </div>
        <button class="border px-4 py-2 rounded shadow text-sm"><a href="{{ route('devis.export.excel') }}" class="btn">Export en Excel</a></button>
        <button class="border px-4 py-2 rounded shadow text-sm"><a href="{{ route('devis.export.pdf') }}" class="btn">Export en PDF</a></button>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-date">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-dossier">Dossier</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-actions">Actions</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-devis">Devis</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ht">HT</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-ttc">TTC</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 col-rdv">Date de RDV</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($devis as $item)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm col-date">{{ $item->date_devis }}</td>
                        <td class="px-6 py-4 text-sm col-dossier">{{ $item->client->nom_assure ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-orange-600 space-y-1 col-actions">
                            <a href="{{ route('devis.edit', $item->id) }}">Modifier</a><br>
                            <form action="{{ route('devis.generate.facture', $item->id) }}" method="POST" onsubmit="return confirm('Confirmer l’émission de la facture ?')">
                                @csrf
                                <button type="submit" class="text-red-600">Émettre la facture</button>
                            </form>
                            <form action="{{ route('devis.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm col-devis">
                            <a href="{{ route('devis.download.pdf', $item->id) }}" class="bg-teal-100 text-teal-700 px-2 py-1 rounded">Télécharger</a>
                        </td>
                        <td class="px-6 py-4 text-sm col-ht">{{ number_format($item->total_ht, 2) }}€</td>
                        <td class="px-6 py-4 text-sm col-ttc">{{ number_format($item->total_ttc, 2) }}€</td>
                        <td class="px-6 py-4 text-sm col-rdv">
                            {{ optional($item->client->rdvs->first())->start_time ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Aucun devis trouvé.</td>
                    </tr>
                @endforelse
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