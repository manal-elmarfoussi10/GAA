@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter une facture</h1>
        <a href="{{ route('factures.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('factures.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Client</label>
                <select name="client_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Sélectionner un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom_assure }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date de facture</label>
                <input type="date" name="date_facture" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Produits / Services</h2>

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
                        <input type="text" name="items[0][produit]" class="w-full border border-gray-300 rounded px-2 py-1" required>
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" name="items[0][quantite]" class="w-full border border-gray-300 rounded px-2 py-1" value="1" required>
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" step="0.01" name="items[0][prix_unitaire]" class="w-full border border-gray-300 rounded px-2 py-1" required>
                    </td>
                    <td class="px-4 py-2">
                        <input type="number" step="0.01" name="items[0][remise]" class="w-full border border-gray-300 rounded px-2 py-1" value="0">
                    </td>
                    <td class="px-4 py-2 text-right text-gray-500">Automatique</td>
                </tr>
            </tbody>
        </table>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer la facture
            </button>
        </div>
    </form>
</div>
@endsection