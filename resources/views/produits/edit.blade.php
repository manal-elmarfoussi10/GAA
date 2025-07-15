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
        <h1 class="text-2xl font-bold text-gray-800">Modifier un produit</h1>
        <a href="{{ route('produits.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('produits.update', $produit) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom du produit</label>
                <input type="text" name="nom" value="{{ old('nom', $produit->nom) }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Code produit</label>
                <input type="text" name="code" value="{{ old('code', $produit->code) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Prix (HT)</label>
                <input type="number" name="prix_ht" step="0.01" value="{{ old('prix_ht', $produit->prix_ht) }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Montant TVA</label>
                <input type="number" name="montant_tva" step="0.01" value="{{ old('montant_tva', $produit->montant_tva) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Sélectionner...</option>
                    @php
                        $categories = [
                            'Assurance',
                            'Partenaires',
                            "Avoirs Virements clients (709 Rabais, remises et ristournes accordés par l'entreprise)",
                            'Service (706)',
                            'Autres charges sociales (647)',
                            'Charges de sécurité sociale et de prévoyance (645)',
                            "Cotisations à l'URSSAF (6451)",
                            'Rémunération du personnel (641)',
                            'Note de frais (625)',
                            'Cadeaux à la clientèle (6234)',
                            'Honoraires (6226)',
                            'Autres (618)',
                            'Services bancaires et assimilés (627)',
                            'Frais postaux et de télécommunications (626)',
                            'Locations (613)',
                            'Sous-traitance générale (611)',
                            'Achats de marchandises (607)',
                            "Comptes transitoires ou d'attente (47)",
                            'Rabais, remises, ristournes à accorder et autres avoirs à établir (4198)',
                            'Emprunts et dettes assimilées (16)',
                            "Main d'oeuvre (611)"
                        ];
                    @endphp
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('categorie', $produit->categorie) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center mt-4">
                <input type="checkbox" name="actif" id="actif" class="mr-2" {{ old('actif', $produit->actif) ? 'checked' : '' }}>
                <label for="actif" class="font-medium text-gray-700">Produit actif</label>
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