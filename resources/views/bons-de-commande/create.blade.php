@extends('layout')

@section('content')
@php use Carbon\Carbon; @endphp

<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Nouveau bon de commande</h1>
            <p class="text-gray-600 mt-1">Remplissez les informations nécessaires pour créer une nouvelle commande</p>
        </div>
        <a href="{{ route('bons-de-commande.index') }}" class="flex items-center text-orange-500 hover:text-orange-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Retour à la liste
        </a>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Veuillez corriger les {{ $errors->count() }} erreur(s) suivante(s)
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('bons-de-commande.store') }}" method="POST" enctype="multipart/form-data" id="commande-form">
        @csrf

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Informations générales</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Fixed Client Selection --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Sélectionner le dossier *</label>
                        <div class="relative">
                            <select name="client_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" required>
                                <option value="">Sélectionner un dossier</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        
                        @if(count($clients) === 0)
                            <div class="mt-4 p-4 bg-gray-50 rounded-lg text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="mt-3 text-gray-600">Aucun dossier disponible</p>
                                <p class="text-sm text-gray-500 mt-1">Veuillez d'abord créer un dossier</p>
                                <a href="{{ route('clients.create') }}" class="mt-3 inline-block text-orange-500 hover:text-orange-700 font-medium">
                                    + Créer un nouveau dossier
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Titre</label>
                        <input type="text" name="titre" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" value="{{ old('titre') }}">
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Sélectionner le fournisseur *</label>
                        <div class="relative">
                            <select name="fournisseur_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" required>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom_societe }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Fichier</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquez pour télécharger</span> ou glisser-déposer</p>
                                    <p class="text-xs text-gray-500">PDF, DOC, XLS (MAX. 5MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="fichier" class="hidden" />
                            </label>
                        </div> 
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">Date du bon de commande</label>
                        <input type="date" name="date_commande" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" value="{{ old('date_commande', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Lignes de commande --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-800">Lignes de commande</h2>
                    <div class="flex gap-2">
                        <button type="button" onclick="addLigne()" class="flex items-center bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Ajouter une ligne
                        </button>
                        <button type="button" onclick="removeLigne()" class="flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm" id="lignes-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Ajouter au stock</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Produit</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Quantité</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Prix (HT)</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Remise (%)</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Total HT</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody id="lignes-body" class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Totaux --}}
        <div class="flex justify-end mb-8">
            <div class="bg-white rounded-xl shadow-md w-full md:w-1/2">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-800">Récapitulatif</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-gray-600">Sous Total HT</div>
                        <div class="text-right">
                            <input type="text" id="sous-total" name="total_ht" class="w-full md:w-48 bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-right font-medium text-gray-900" readonly>
                        </div>
                        
                        <div class="text-gray-600">Taux de TVA</div>
                        <div class="flex justify-end">
                            <div class="relative w-full md:w-48">
                                <input type="number" id="tva" name="tva" value="20" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-right font-medium focus:ring-2 focus:ring-orange-300 focus:border-orange-400" onchange="updateTotals()">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">%</span>
                            </div>
                        </div>
                        
                        <div class="text-gray-600">Montant de la taxe</div>
                        <div class="text-right">
                            <input type="text" id="taxe-montant" class="w-full md:w-48 bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-right font-medium text-gray-900" readonly>
                        </div>
                        
                        <div class="text-lg font-medium text-gray-900">Total TTC</div>
                        <div class="text-right">
                            <input type="text" id="ttc" name="total_ttc" class="w-full md:w-48 bg-orange-50 border border-orange-200 rounded-lg px-4 py-2 text-right font-bold text-orange-700" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="flex items-center bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
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
        row.className = 'hover:bg-gray-50';

        let options = `<option value="">-- Choisir un produit --</option>`;
        produits.forEach(prod => {
            options += `<option value="${prod.id}" data-prix="${prod.prix_ht}" data-tva="${prod.tva}">${prod.nom}</option>`;
        });
        options += `<option value="autre">Autre produit</option>`;

        row.innerHTML = `
            <td class="px-4 py-3 font-medium text-gray-900">${ligneIndex + 1}</td>
            <td class="px-4 py-3">
                <select name="lignes[${ligneIndex}][ajouter_au_stock]" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400">
                    <option value="0">NON</option>
                    <option value="1">OUI</option>
                </select>
            </td>
            <td class="px-4 py-3">
                <select name="lignes[${ligneIndex}][produit_id]" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" onchange="handleProduitSelect(this)">
                    ${options}
                </select>
                <input type="text" name="lignes[${ligneIndex}][produit_nom]" class="mt-2 hidden w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" placeholder="Nom du produit">
            </td>
            <td class="px-4 py-3">
                <input type="number" name="lignes[${ligneIndex}][quantite]" value="1" min="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" onchange="updateLigneTotal(this)">
            </td>
            <td class="px-4 py-3">
                <div class="relative">
                    <input type="number" name="lignes[${ligneIndex}][prix]" value="0" min="0" step="0.01" class="w-full border border-gray-300 rounded-lg px-3 py-2 pl-7 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" onchange="updateLigneTotal(this)">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-500">€</span>
                </div>
            </td>
            <td class="px-4 py-3">
                <div class="relative">
                    <input type="number" name="lignes[${ligneIndex}][remise]" value="0" min="0" max="100" class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-7 focus:ring-2 focus:ring-orange-300 focus:border-orange-400" onchange="updateLigneTotal(this)">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">%</span>
                </div>
            </td>
            <td class="px-4 py-3">
                <div class="relative">
                    <input type="text" name="lignes[${ligneIndex}][total]" value="0.00" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 pr-7 text-right font-medium" readonly>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">€</span>
                </div>
            </td>
            <td class="px-4 py-3">
                <button type="button" onclick="this.closest('tr').remove(); updateTotals()" class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
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
            ligneIndex--;
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