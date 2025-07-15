@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Modifier le bon de commande</h1>
        <a href="{{ route('bons-de-commande.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('bons-de-commande.update', $bon) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Titre</label>
                <input type="text" name="titre" value="{{ old('titre', $bon->titre) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date du bon de commande</label>
                <input type="date" name="date_commande" value="{{ old('date_commande', $bon->date_commande->format('Y-m-d')) }}" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Fournisseur</label>
                <select name="fournisseur_id" class="w-full border border-gray-300 rounded px-4 py-2">
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ $bon->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom_societe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Fichier</label>
                <input type="file" name="fichier" class="w-full">
                @if ($bon->fichier)
                    <p class="text-sm mt-2 text-gray-600">Fichier actuel: <a href="{{ asset('storage/'.$bon->fichier) }}" class="text-blue-600 underline" target="_blank">Télécharger</a></p>
                @endif
            </div>
        </div>

        {{-- Ligne de commande (à personnaliser selon structure) --}}
        {{-- @include('bons-de-commande.partials.lignes-edit', ['lignes' => $bon->lignes]) --}}

        <div class="text-right mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Mettre à jour le bon de commande
            </button>
        </div>
    </form>
</div>
@endsection