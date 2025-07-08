@extends('layout')

@section('content')
<div class="px-8 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Créer un avoir</h1>
        <a href="{{ route('avoirs.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('avoirs.store') }}" method="POST">
        @csrf
        <input type="hidden" name="facture_id" value="{{ $facture->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Facture associée</label>
                <input type="text" disabled class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100" 
                       value="Facture #{{ $facture->id }} - {{ $facture->client->nom_assure ?? 'Client inconnu' }}">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Montant de l'avoir (€)</label>
                <input type="number" name="montant" step="0.01" min="0" class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Enregistrer l’avoir
            </button>
        </div>
    </form>
</div>
@endsection