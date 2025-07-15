@extends('layout')

@section('content')
<div class="px-8 py-10">
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <strong>Erreur(s) :</strong>
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un produit</h1>
        <a href="{{ route('produits.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('produits.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom du produit</label>
                <input type="text" name="nom" value="{{ old('nom') }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Code produit</label>
                <input type="text" name="code" value="{{ old('code') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Prix (HT)</label>
                <input type="number" name="prix_ht" value="{{ old('prix_ht') }}" step="0.01" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Montant TVA</label>
                <input type="number" name="montant_tva" value="{{ old('montant_tva') }}" step="0.01" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Sélectionner...</option>
                    <option value="Assurance">Assurance</option>
                    <option value="Partenaires">Partenaires</option>
                    <option value="Avoirs Virements clients (709)">Avoirs Virements clients (709 Rabais, remises et ristournes accordés par l'entreprise)</option>
                    <option value="Service (706)">Service (706 Prestations de services)</option>
                    <option value="Autres charges sociales (647)">Autres charges sociales (647)</option>
                    <option value="Charges de sécurité sociale et de prévoyance (645)">Charges de sécurité sociale et de prévoyance (645)</option>
                    <option value="Cotisations à l'URSSAF (6451)">Cotisations à l'URSSAF (6451)</option>
                    <option value="Rémunération du personnel (641)">Rémunération du personnel (641)</option>
                    <option value="Note de frais (625)">Note de frais (625 Déplacements, missions et réceptions)</option>
                    <option value="Cadeaux à la clientèle (6234)">Cadeaux à la clientèle (6234)</option>
                    <option value="Honoraires (6226)">Honoraires (6226)</option>
                    <option value="Autres (618)">Autres (618 Divers)</option>
                    <option value="Services bancaires et assimilés (627)">Services bancaires et assimilés (627)</option>
                    <option value="Frais postaux et de télécommunications (626)">Frais postaux et de télécommunications (626)</option>
                    <option value="Locations (613)">Locations (613)</option>
                    <option value="Sous-traitance générale (611)">Sous-traitance générale (611)</option>
                    <option value="Achats de marchandises (607)">Achats de marchandises (607)</option>
                    <option value="Comptes transitoires ou d'attente (47)">Comptes transitoires ou d'attente (47)</option>
                    <option value="Rabais, remises, ristournes à accorder (4198)">Rabais, remises, ristournes à accorder et autres avoirs à établir (4198)</option>
                    <option value="Emprunts et dettes assimilées (16)">Emprunts et dettes assimilées (16)</option>
                    <option value="Main d'oeuvre (611)">Main d'oeuvre (611 Sous-traitance générale)</option>
                </select>
            </div>

            <div class="flex items-center mt-6">
                {{-- FIXED: hidden input ensures false is submitted when unchecked --}}
                <input type="hidden" name="actif" value="0">
                <input type="checkbox" name="actif" value="1" id="actif" class="mr-2" {{ old('actif', true) ? 'checked' : '' }}>
                <label for="actif" class="font-medium text-gray-700">Produit actif</label>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer le produit
            </button>
        </div>
    </form>
</div>
@endsection