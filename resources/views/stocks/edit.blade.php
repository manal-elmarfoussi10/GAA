@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Modifier un stock</h1>
        <a href="{{ route('stocks.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Fournisseur</label>
                <select name="fournisseur_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ $stock->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom_societe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Poseur</label>
                <select name="poseur_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">-- Aucun --</option>
                    @foreach($poseurs as $poseur)
                        <option value="{{ $poseur->id }}" {{ $stock->poseur_id == $poseur->id ? 'selected' : '' }}>
                            {{ $poseur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Produit</label>
                <select name="produit_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}" {{ $stock->produit_id == $produit->id ? 'selected' : '' }}>
                            {{ $produit->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Référence</label>
                <input type="text" name="reference" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $stock->reference }}">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Statut</label>
                @php
                    $statuts = [
                        'À COMMANDER', 'COMMANDÉ', 'LIVRÉ', 'POSÉ', 'A RETOURNER',
                        'CASSÉ À LA LIVRAISON', 'CASSÉ POSÉ', 'RETOURNÉ',
                        'STOCKÉ', 'ATTENTE REMBOURSEMENT', 'REMBOURSÉ'
                    ];
                @endphp
                <select name="statut" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    @foreach($statuts as $statut)
                        <option value="{{ $statut }}" {{ $stock->statut === $statut ? 'selected' : '' }}>
                            {{ $statut }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date</label>
                <input type="date" name="date" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ \Carbon\Carbon::parse($stock->date)->format('Y-m-d') }}">
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection