@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Modifier le fournisseur</h1>
        <a href="{{ route('fournisseurs.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de la société</label>
                <input type="text" name="nom_societe" value="{{ old('nom_societe', $fournisseur->nom_societe) }}" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $fournisseur->email) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $fournisseur->telephone) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Sélectionner...</option>
                    @foreach([
                        'Assurance',
                        'Partenaires',
                        'Avoirs Virements clients (709 Rabais, remises et ristournes accordés par l\'entreprise)',
                        'Service (706 Prestations de services)',
                        'Autres charges sociales (647)',
                        'Charges de sécurité sociale et de prévoyance (645)',
                        'Cotisations à l\'URSSAF (6451)',
                        'Rémunération du personnel (641)',
                        'Note de frais (625 Déplacements, missions et réceptions)',
                        'Cadeaux à la clientèle (6234)',
                        'Honoraires (6226)',
                        'Autres (618 Divers)',
                        'Services bancaires et assimilés (627)',
                        'Frais postaux et de télécommunications (626)',
                        'Locations (613)',
                        'Sous-traitance générale (611)',
                        'Achats de marchandises (607)',
                        'Comptes transitoires ou d\'attente (47)',
                        'Rabais, remises, ristournes à accorder et autres avoirs à établir (4198)',
                        'Emprunts et dettes assimilées (16)',
                        'Main d\'oeuvre (611 Sous-traitance générale)'
                    ] as $cat)
                        <option value="{{ $cat }}" @selected($fournisseur->categorie === $cat)>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Adresse</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de l'adresse</label>
                <input type="text" name="adresse_nom" value="{{ old('adresse_nom', $fournisseur->adresse_nom) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Rue</label>
                <input type="text" name="adresse_rue" value="{{ old('adresse_rue', $fournisseur->adresse_rue) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Code postal</label>
                <input type="text" name="adresse_cp" value="{{ old('adresse_cp', $fournisseur->adresse_cp) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Ville</label>
                <input type="text" name="adresse_ville" value="{{ old('adresse_ville', $fournisseur->adresse_ville) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700 mb-2">Types d'adresse</label>
            <div class="flex gap-6">
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_facturation" class="mr-2" {{ $fournisseur->adresse_facturation ? 'checked' : '' }}> Facturation
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_livraison" class="mr-2" {{ $fournisseur->adresse_livraison ? 'checked' : '' }}> Livraison
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_devis" class="mr-2" {{ $fournisseur->adresse_devis ? 'checked' : '' }}> Devis
                </label>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Contact</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom du contact</label>
                <input type="text" name="contact_nom" value="{{ old('contact_nom', $fournisseur->contact_nom) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email du contact</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $fournisseur->contact_email) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone du contact</label>
                <input type="text" name="contact_telephone" value="{{ old('contact_telephone', $fournisseur->contact_telephone) }}" class="w-full border border-gray-300 rounded px-4 py-2">
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