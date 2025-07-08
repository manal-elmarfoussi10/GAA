@extends('layout')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-orange-500">Modifier un fournisseur</h1>
    </div>

    <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de la société</label>
                <input type="text" name="nom_societe" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('nom_societe', $fournisseur->nom_societe) }}">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email principal</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('email', $fournisseur->email) }}">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Numéro de téléphone principal</label>
                <input type="text" name="telephone" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('telephone', $fournisseur->telephone) }}">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    @php
                        $categories = [
                            'Assurance', 'Partenaires', 'Avoirs Virements clients (709)', 'Service (706)',
                            'Autres charges sociales (647)', 'Charges de sécurité sociale et de prévoyance (645)',
                            'Cotisations à l\'URSSAF (6451)', 'Rémunération du personnel (641)',
                            'Note de frais (625)', 'Cadeaux à la clientèle (6234)', 'Honoraires (6226)',
                            'Autres (618)', 'Services bancaires et assimilés (627)', 'Frais postaux et de télécommunications (626)',
                            'Locations (613)', 'Sous-traitance générale (611)', 'Achats de marchandises (607)',
                            'Comptes transitoires ou d\'attente (47)', 'Rabais, remises, ristournes à accorder (4198)',
                            'Emprunts et dettes assimilées (16)', 'Main d\'oeuvre (611)'
                        ];
                    @endphp
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $fournisseur->categorie === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Adresses</h2>
        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Nom de l'adresse</label>
            <input type="text" name="adresse_nom[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('adresse_nom.0', $fournisseur->adresse_nom[0] ?? '') }}">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Rue</label>
            <input type="text" name="adresse_rue[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('adresse_rue.0', $fournisseur->adresse_rue[0] ?? '') }}">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Code postal</label>
            <input type="text" name="adresse_cp[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('adresse_cp.0', $fournisseur->adresse_cp[0] ?? '') }}">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Ville</label>
            <input type="text" name="adresse_ville[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('adresse_ville.0', $fournisseur->adresse_ville[0] ?? '') }}">

            <div class="flex gap-4 mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_facturation[]" class="mr-2" {{ old('adresse_facturation.0') ? 'checked' : '' }}> Adresse de facturation
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_livraison[]" class="mr-2" {{ old('adresse_livraison.0') ? 'checked' : '' }}> Adresse de livraison
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_devis[]" class="mr-2" {{ old('adresse_devis.0') ? 'checked' : '' }}> Adresse pour devis
                </label>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2 mt-8">Contacts</h2>
        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Nom du contact</label>
            <input type="text" name="contact_nom[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('contact_nom.0', $fournisseur->contact_nom[0] ?? '') }}">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Email du contact</label>
            <input type="email" name="contact_email[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('contact_email.0', $fournisseur->contact_email[0] ?? '') }}">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Téléphone du contact</label>
            <input type="text" name="contact_telephone[]" class="w-full border border-gray-300 rounded px-4 py-2" value="{{ old('contact_telephone.0', $fournisseur->contact_telephone[0] ?? '') }}">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection