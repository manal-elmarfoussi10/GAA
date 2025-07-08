@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Ajouter un devis</h1>
        <a href="{{ route('devis.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('devis.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Client</label>
                <select name="client_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">-- Sélectionner un client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom_assure }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Titre</label>
                <input type="text" name="titre" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Titre du devis">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date du devis</label>
                <input type="date" name="date_devis" value="{{ date('Y-m-d') }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Valide jusqu'au</label>
                <input type="date" name="date_validite" value="{{ date('Y-m-d', strtotime('+30 days')) }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Produits</h2>

        <table class="w-full text-sm border rounded shadow-sm mb-6">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">Produit</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Prix unitaire</th>
                    <th class="px-4 py-2">Remise (%)</th>
                    <th class="px-4 py-2">Total HT</th>
                </tr>
            </thead>
            <tbody id="itemsTable">
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <input type="text" name="items[0][produit]" class="w-full border border-gray-300 rounded px-2 py-1" placeholder="Produit">
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" name="items[0][quantite]" value="1" class="w-full border border-gray-300 rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" step="0.01" name="items[0][prix_unitaire]" value="0" class="w-full border border-gray-300 rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" step="0.01" name="items[0][remise]" value="0" class="w-full border border-gray-300 rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 text-right text-gray-500">
                        Auto
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Créer le devis
            </button>
        </div>
    </form>
</div>

<script>
    // You can enhance this by adding JS for dynamically adding/removing rows
</script>
@endsection