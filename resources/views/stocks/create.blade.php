@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Nouveau produit</h1>
        <a href="{{ route('stocks.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        

            <div>
                <label class="block mb-1 font-medium text-gray-700">Fournisseur</label>
                <select name="fournisseur_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">-- Choisir --</option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom_societe }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Sélectionner le poseur</label>
                <select name="poseur_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">-- Choisir --</option>
                    @foreach($poseurs as $poseur)
                        <option value="{{ $poseur->id }}">{{ $poseur->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Produit</label>
                <select name="produit_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">-- Choisir --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Référence</label>
                <input type="text" name="reference" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Statut</label>
                <select name="statut" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="À COMMANDER">À COMMANDER</option>
                    <option value="COMMANDÉ">COMMANDÉ</option>
                    <option value="LIVRÉ">LIVRÉ</option>
                    <option value="POSÉ">POSÉ</option>
                    <option value="A RETOURNER">A RETOURNER</option>
                    <option value="CASSÉ À LA LIVRAISON">CASSÉ À LA LIVRAISON</option>
                    <option value="CASSÉ POSÉ">CASSÉ POSÉ</option>
                    <option value="RETOURNÉ">RETOURNÉ</option>
                    <option value="STOCKÉ">STOCKÉ</option>
                    <option value="ATTENTE REMBOURSEMENT">ATTENTE REMBOURSEMENT</option>
                    <option value="REMBOURSÉ">REMBOURSÉ</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date</label>
                <input type="date" name="date" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Ajouter
            </button>
        </div>
    </form>
</div>
@endsection
