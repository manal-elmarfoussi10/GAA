@extends('layout')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-orange-500">
            {{ isset($fournisseur) ? 'Modifier' : 'Ajouter' }} un fournisseur
        </h1>
    </div>

    <form action="{{ isset($fournisseur) ? route('fournisseurs.update', $fournisseur) : route('fournisseurs.store') }}" method="POST">
        @csrf
        @if(isset($fournisseur))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom de la société</label>
                <input type="text" name="nom_societe" value="{{ old('nom_societe', $fournisseur->nom_societe ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email principal</label>
                <input type="email" name="email" value="{{ old('email', $fournisseur->email ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $fournisseur->telephone ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Catégorie</label>
                <select name="categorie" class="w-full border border-gray-300 rounded px-4 py-2">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ (old('categorie', $fournisseur->categorie ?? '') == $cat) ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Adresse</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Rue</label>
                <input type="text" name="rue" value="{{ old('rue', $fournisseur->rue ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Code postal</label>
                <input type="text" name="code_postal" value="{{ old('code_postal', $fournisseur->code_postal ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $fournisseur->ville ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <h2 class="text-xl font-semibold text-orange-500 mb-2">Contact</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Nom du contact</label>
                <input type="text" name="contact_nom" value="{{ old('contact_nom', $fournisseur->contact_nom ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email du contact</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $fournisseur->contact_email ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Téléphone du contact</label>
                <input type="text" name="contact_telephone" value="{{ old('contact_telephone', $fournisseur->contact_telephone ?? '') }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                {{ isset($fournisseur) ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
        </div>
    </form>
</div>
@endsection
