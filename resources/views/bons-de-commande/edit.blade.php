@extends('layout')

@section('content')
<div class="px-8 py-10">
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <strong>Erreur(s) :</strong>
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Modifier le bon de commande</h1>
        <a href="{{ route('bons-de-commande.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('bons-de-commande.update', $bon) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            {{-- LEFT SIDE: Form Inputs --}}
            <div class="md:col-span-2 space-y-6">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Titre</label>
                    <input type="text" name="titre" value="{{ $bon->titre }}" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Sélectionner le fournisseur *</label>
                    <select name="fournisseur_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" @selected($fournisseur->id == $bon->fournisseur_id)>
                                {{ $fournisseur->nom_societe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Fichier</label>
                    <input type="file" name="fichier" class="w-full">
                    @if($bon->fichier)
                        <p class="text-sm text-gray-500 mt-1">
                            Fichier actuel:
                            <a href="{{ Storage::url($bon->fichier) }}" target="_blank" class="text-blue-500 underline">Voir le fichier</a>
                        </p>
                    @endif
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Date du bon de commande</label>
                    <input type="date" name="date_commande" value="{{ \Carbon\Carbon::parse($bon->date_commande)->format('Y-m-d') }}" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                {{-- Lignes --}}
                @include('bons-de-commande._lignes', ['lignes' => $bon->lignes])
            </div>

            {{-- RIGHT SIDE: Total Card --}}
            <div class="bg-gray-50 p-4 rounded shadow-md">
                <div class="mb-3">
                    <label class="block text-sm font-medium">Sous Total</label>
                    <input type="text" id="sous-total" name="total_ht" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" value="{{ $bon->total_ht }}">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Taxe</label>
                    <div class="flex items-center">
                        <input type="number" id="tva" name="tva" value="{{ $bon->tva }}" class="w-full border border-gray-300 rounded px-3 py-1.5 text-right">
                        <span class="ml-2">%</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Montant de la taxe</label>
                    <input type="text" id="taxe-montant" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium">Total TTC</label>
                    <input type="text" id="ttc" name="total_ttc" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" value="{{ $bon->total_ttc }}">
                </div>
            </div>
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Mettre à jour
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        updateTotals();
    });
</script>
@endsection