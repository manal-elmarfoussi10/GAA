@extends('layout')

@section('content')
@if ($errors->any())
    <div class="mb-4 text-red-600 bg-red-100 border border-red-300 rounded p-4">
        <ul class="list-disc pl-6">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un fournisseur</h1>
        <a href="{{ route('fournisseurs.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
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
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="w-full border border-gray-300 rounded px-4 py-2" required>
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
        </div>

        <!-- Adresse -->
        <h2 class="text-xl font-semibold text-orange-500 mb-4">Adresse</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de l'adresse</label>
                <input type="text" name="adresse_nom" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Rue</label>
                <input type="text" name="adresse_rue" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Code postal</label>
                <input type="text" name="adresse_cp" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Ville</label>
                <input type="text" name="adresse_ville" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-medium text-gray-700 mb-2">Types d'adresse</label>
            <div class="flex gap-6">
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_facturation" class="mr-2"> Facturation
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_livraison" class="mr-2"> Livraison
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="adresse_devis" class="mr-2"> Devis
                </label>
            </div>
        </div>

        <!-- Contact -->
        <h2 class="text-xl font-semibold text-orange-500 mb-4">Contact</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom du contact</label>
                <input type="text" name="contact_nom" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email du contact</label>
                <input type="email" name="contact_email" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone du contact</label>
                <input type="text" name="contact_telephone" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
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