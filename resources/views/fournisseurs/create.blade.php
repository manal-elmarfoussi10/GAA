@extends('layout')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-orange-500">Ajouter/Modifier un fournisseur</h1>
    </div>

    <form action="{{ route('fournisseurs.store') }}" method="POST">
        @csrf

        <!-- Informations générales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de la société</label>
                <input type="text" name="nom_societe" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email principal</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Numéro de téléphone principal</label>
                <input type="text" name="telephone" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="form-select w-full border border-gray-300 rounded px-4 py-2">
                    <option value="">Sélectionner...</option>
                    <option value="Assurance">Assurance</option>
                    <option value="Partenaires">Partenaires</option>
                    <option value="Avoirs Virements clients (709)">Avoirs Virements clients (709)</option>
                    <option value="Service (706)">Service (706)</option>
                    <option value="Autres charges sociales (647)">Autres charges sociales (647)</option>
                    <option value="Charges de sécurité sociale et de prévoyance (645)">Charges de sécurité sociale et de prévoyance (645)</option>
                    <option value="Cotisations à l'URSSAF (6451)">Cotisations à l'URSSAF (6451)</option>
                    <option value="Rémunération du personnel (641)">Rémunération du personnel (641)</option>
                    <option value="Note de frais (625)">Note de frais (625)</option>
                    <option value="Cadeaux à la clientèle (6234)">Cadeaux à la clientèle (6234)</option>
                    <option value="Honoraires (6226)">Honoraires (6226)</option>
                    <option value="Autres (618)">Autres (618)</option>
                    <option value="Services bancaires et assimilés (627)">Services bancaires et assimilés (627)</option>
                    <option value="Frais postaux et de télécommunications (626)">Frais postaux et de télécommunications (626)</option>
                    <option value="Locations (613)">Locations (613)</option>
                    <option value="Sous-traitance générale (611)">Sous-traitance générale (611)</option>
                    <option value="Achats de marchandises (607)">Achats de marchandises (607)</option>
                    <option value="Comptes transitoires ou d'attente (47)">Comptes transitoires ou d'attente (47)</option>
                    <option value="Rabais, remises, ristournes à accorder (4198)">Rabais/remises à accorder (4198)</option>
                    <option value="Emprunts et dettes assimilées (16)">Emprunts et dettes assimilées (16)</option>
                    <option value="Main d'oeuvre (611)">Main d'oeuvre (611)</option>
                </select>
            </div>
        </div>

        <!-- Adresse -->
        <h2 class="text-xl font-semibold text-orange-500 mb-2">Adresses</h2>
        <div class="mb-4">
            <label class="block mb-1 font-medium text-gray-700">Nom de l'adresse</label>
            <input type="text" name="adresse_nom[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Rue</label>
            <input type="text" name="adresse_rue[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Code postal</label>
            <input type="text" name="adresse_cp[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Ville</label>
            <input type="text" name="adresse_ville[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <div class="flex gap-4 mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_facturation[]" class="mr-2"> Facturation
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_livraison[]" class="mr-2"> Livraison
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_devis[]" class="mr-2"> Devis
                </label>
            </div>
        </div>

        <!-- Contact -->
        <h2 class="text-xl font-semibold text-orange-500 mb-2 mt-8">Contacts</h2>
        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Nom du contact</label>
            <input type="text" name="contact_nom[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Email du contact</label>
            <input type="email" name="contact_email[]" class="w-full border border-gray-300 rounded px-4 py-2">

            <label class="block mb-1 mt-4 font-medium text-gray-700">Téléphone du contact</label>
            <input type="text" name="contact_telephone[]" class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection