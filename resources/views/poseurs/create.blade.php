@extends('layout')

@section('content')
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

<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ajouter un poseur</h1>
        <a href="{{ route('poseurs.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('poseurs.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Mot de passe (accès planning)</label>
                <input type="password" name="mot_de_passe" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Couleur (planning)</label>
                <div class="flex items-center gap-4">
                    <input type="color" name="couleur" value="#000000" class="h-10 w-16 border border-gray-300 rounded">
                    <span class="text-sm text-gray-500">Utilisé pour l’agenda</span>
                </div>
            </div>

            <div class="flex items-center mt-4">
                <input type="checkbox" name="actif" id="actif" class="mr-2" checked>
                <label for="actif" class="font-medium text-gray-700">Poseur actif</label>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Adresse</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Rue</label>
                <input type="text" name="rue" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Code postal</label>
                <input type="text" name="code_postal" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Ville</label>
                <input type="text" name="ville" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Informations supplémentaires</label>
            <textarea name="info" rows="3" class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Départements couverts</label>
            <select name="departements[]" multiple class="w-full border border-gray-300 rounded px-4 py-2 h-40">
                @for ($i = 1; $i <= 95; $i++)
                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                @endfor
            </select>
            <p class="text-sm text-gray-500 mt-1">Maintenez CTRL (Windows) ou CMD (Mac) pour sélectionner plusieurs.</p>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer le poseur
            </button>
        </div>
    </form>
</div>
@endsection