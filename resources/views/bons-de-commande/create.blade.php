@extends('layout')

@section('content')
<div class="px-8 py-10">
    {{-- Erreurs --}}
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
        <h1 class="text-2xl font-bold text-gray-800">Nouveau bon de commande</h1>
        <a href="{{ route('bons-de-commande.index') }}" class="text-orange-500 hover:underline">&larr; Retour</a>
    </div>

    <form action="{{ route('bons-de-commande.store') }}" method="POST" enctype="multipart/form-data" id="commande-form">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Sélectionner le dossier *</label>
                <input type="text" name="client_search" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Tapez au moins 3 caractères...">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Titre</label>
                <input type="text" name="titre" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Sélectionner le fournisseur *</label>
                <select name="fournisseur_id" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom_societe }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Fichier</label>
                <input type="file" name="fichier" class="w-full">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Date du bon de commande</label>
                <input type="date" name="date_commande" class="w-full border border-gray-300 rounded px-4 py-2">
            </div>
        </div>

        {{-- Lignes --}}
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Lignes de commande</h2>
        <div class="overflow-x-auto mb-6">
            <table class="w-full table-auto border border-gray-200 text-sm" id="lignes-table">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">#</th>
                        <th class="px-3 py-2 border">Ajouter au stock</th>
                        <th class="px-3 py-2 border">Produit</th>
                        <th class="px-3 py-2 border">Quantité</th>
                        <th class="px-3 py-2 border">Prix (HT)</th>
                        <th class="px-3 py-2 border">Remise (%)</th>
                        <th class="px-3 py-2 border">Total HT</th>
                        <th class="px-3 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody id="lignes-body"></tbody>
            </table>

            <div class="flex items-center gap-4 mt-4">
                <button type="button" onclick="addLigne()" class="bg-gray-600 text-white px-4 py-2 rounded">+ Ajouter une ligne</button>
                <button type="button" onclick="removeLigne()" class="bg-gray-400 text-white px-4 py-2 rounded">- Supprimer une ligne</button>
            </div>
        </div>

        {{-- Totaux --}}
        <div class="flex justify-end">
            <div class="bg-gray-50 p-4 rounded shadow-md w-full md:w-1/3">
                <div class="mb-3">
                    <label class="block text-sm font-medium">Sous Total</label>
                    <input type="text" id="sous-total" name="total_ht" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" readonly>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Taxe</label>
                    <div class="flex items-center">
                        <input type="number" id="tva" name="tva" value="20" class="w-full border border-gray-300 rounded px-3 py-1.5 text-right" onchange="updateTotals()"> <span class="ml-2">%</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Montant de la taxe</label>
                    <input type="text" id="taxe-montant" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium">Total TTC</label>
                    <input type="text" id="ttc" name="total_ttc" class="w-full border border-gray-300 rounded px-3 py-1.5 bg-gray-100 text-right" readonly>
                </div>
            </div>
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded shadow">
                Créer mon bon de commande
            </button>
        </div>
    </form>
</div>

<script>
    let ligneIndex = 0;
    const produits = @json($produits); // Fournis depuis le contrôleur

    function addLigne() {
        const tbody = document.getElementById('lignes-body');
        const row = document.createElement('tr');

        let options = `<option value="">-- Choisir un produit ou écrire --</option>`;
        produits.forEach(prod => {
            options += `<option value="${prod.id}" data-prix="${prod.prix_ht}" data-tva="${prod.tva}">${prod.nom}</option>`;
        });
        options += `<option value="autre">Autre</option>`;

        row.innerHTML = `
            <td class="border px-2 py-1 text-center">${ligneIndex + 1}</td>
            <td class="border px-2 py-1 text-center">
                <select name="lignes[${ligneIndex}][ajouter_au_stock]" class="border rounded px-2 py-1 w-full">
                    <option value="0">NON</option>
                    <option value="1">OUI</option>
                </select>
            </td>
            <td class="border px-2 py-1 text-center">
                <select name="lignes[${ligneIndex}][produit_id]" class="border rounded px-2 py-1 w-full" onchange="handleProduitSelect(this)">
                    ${options}
                </select>
                <input type="text" name="lignes[${ligneIndex}][produit_nom]" class="mt-1 hidden w-full border px-2 py-1 rounded" placeholder="Nom du produit">
            </td>
            <td class="border px-2 py-1 text-center">
                <input type="number" name="lignes[${ligneIndex}][quantite]" value="1" class="border rounded px-2 py-1 w-full" onchange="updateLigneTotal(this)">
            </td>
            <td class="border px-2 py-1 text-center">
                <input type="number" name="lignes[${ligneIndex}][prix]" value="0" class="border rounded px-2 py-1 w-full" onchange="updateLigneTotal(this)">
            </td>
            <td class="border px-2 py-1 text-center">
                <input type="number" name="lignes[${ligneIndex}][remise]" value="0" class="border rounded px-2 py-1 w-full" onchange="updateLigneTotal(this)">
            </td>
            <td class="border px-2 py-1 text-center">
                <input type="text" name="lignes[${ligneIndex}][total]" value="0" class="border rounded px-2 py-1 w-full bg-gray-100 text-right" readonly>
            </td>
            <td class="border px-2 py-1 text-center">
                <button type="button" onclick="this.closest('tr').remove(); updateTotals()" class="text-red-500 hover:underline">✖</button>
            </td>
        `;
        tbody.appendChild(row);
        ligneIndex++;
    }

    function handleProduitSelect(select) {
        const selected = select.options[select.selectedIndex];
        const row = select.closest('tr');
        const prixField = row.querySelector('input[name$="[prix]"]');
        const nomField = row.querySelector('input[name$="[produit_nom]"]');

        if (select.value === 'autre') {
            nomField.classList.remove('hidden');
            prixField.value = 0;
        } else {
            nomField.classList.add('hidden');
            prixField.value = selected.dataset.prix || 0;
        }

        updateLigneTotal(prixField);
    }

    function removeLigne() {
        const tbody = document.getElementById('lignes-body');
        if (tbody.lastChild) {
            tbody.removeChild(tbody.lastChild);
            updateTotals();
        }
    }

    function updateLigneTotal(input) {
        const row = input.closest('tr');
        const quantite = parseFloat(row.querySelector('input[name$="[quantite]"]').value) || 0;
        const prix = parseFloat(row.querySelector('input[name$="[prix]"]').value) || 0;
        const remise = parseFloat(row.querySelector('input[name$="[remise]"]').value) || 0;

        const brut = quantite * prix;
        const net = brut - (brut * remise / 100);
        row.querySelector('input[name$="[total]"]').value = net.toFixed(2);

        updateTotals();
    }

    function updateTotals() {
        let totalHT = 0;
        document.querySelectorAll('input[name$="[total]"]').forEach(input => {
            totalHT += parseFloat(input.value) || 0;
        });
        const tvaRate = parseFloat(document.getElementById('tva').value) || 0;
        const taxeMontant = totalHT * tvaRate / 100;
        const ttc = totalHT + taxeMontant;

        document.getElementById('sous-total').value = totalHT.toFixed(2);
        document.getElementById('taxe-montant').value = taxeMontant.toFixed(2);
        document.getElementById('ttc').value = ttc.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', addLigne);
</script>
@endsection