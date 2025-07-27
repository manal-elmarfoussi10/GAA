@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 border-b-2 border-orange-500 pb-2">Créer un nouveau bon de commande</h1>
    
    <form action="{{ route('bons-de-commande.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg" id="order-form">
        @csrf
        
        <!-- Client & Supplier Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Client Selection (Dossier) -->
            <div class="mb-6">
                <label for="client_id" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-folder-open text-orange-500 mr-2"></i>
                    Sélectionner un dossier
                </label>
                <select name="client_id" id="client_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    <option value="">Sélectionnez un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->nom_assure }} {{ $client->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Supplier Selection -->
            <div class="mb-6">
                <label for="fournisseur_id" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-truck text-orange-500 mr-2"></i>
                    Sélectionner le fournisseur *
                </label>
                <select name="fournisseur_id" id="fournisseur_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    <option value="">Sélectionnez un fournisseur</option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                            {{ $fournisseur->nom_societe }}
                        </option>
                    @endforeach
                </select>
                @error('fournisseur_id')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Order Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Title -->
            <div class="mb-6">
                <label for="titre" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-heading text-orange-500 mr-2"></i>
                    Titre
                </label>
                <input type="text" name="titre" id="titre" value="{{ old('titre') }}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                @error('titre')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Order Date -->
            <div class="mb-6">
                <label for="date_commande" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-calendar-day text-orange-500 mr-2"></i>
                    Date de commande *
                </label>
                <input type="date" name="date_commande" id="date_commande" value="{{ old('date_commande', date('Y-m-d')) }}" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                @error('date_commande')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Product Lines -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-6 text-gray-800 pb-2 border-b border-orange-300 flex items-center">
                <i class="fas fa-list-ul text-orange-500 mr-3"></i>
                Lignes de commande
            </h2>
            <div id="product-lines" class="space-y-5">
                <!-- Initial Product Line -->
                <div class="product-line grid grid-cols-1 md:grid-cols-12 gap-4 items-end p-5 bg-orange-50 rounded-xl border border-orange-100">
                    <div class="md:col-span-5">
                        <label class="block text-gray-700 font-medium mb-2">Produit</label>
                        <select name="lignes[0][produit_id]" class="product-select w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                            <option value="">Sélectionnez un produit</option>
                            <option value="autre">Autre produit</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" data-price="{{ $produit->prix }}">
                                    {{ $produit->nom }} ({{ number_format($produit->prix, 2, ',', ' ') }} €)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="md:col-span-5 hidden product-name-container">
                        <label class="block text-gray-700 font-medium mb-2">Nom du produit</label>
                        <input type="text" name="lignes[0][nom_produit]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Quantité</label>
                        <input type="number" name="lignes[0][quantite]" min="1" value="1" class="quantity w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    </div>
                    
                    <div class="md:col-span-3">
                        <label class="block text-gray-700 font-medium mb-2">Prix unitaire (€)</label>
                        <input type="number" name="lignes[0][prix]" step="0.01" min="0" value="0" class="price w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    </div>
                    
                    <div class="md:col-span-3">
                        <label class="block text-gray-700 font-medium mb-2">Remise (%)</label>
                        <input type="number" name="lignes[0][remise]" step="0.01" min="0" max="100" value="0" class="discount w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    </div>
                    
                    <div class="md:col-span-3 flex items-center">
                        <div class="mt-4 flex items-center">
                            <input type="checkbox" name="lignes[0][ajouter_au_stock]" id="stock_0" value="1" class="mr-3 h-5 w-5 text-orange-500 border-gray-300 rounded focus:ring-orange-400">
                            <label for="stock_0" class="text-gray-700 font-medium">Ajouter au stock</label>
                        </div>
                    </div>
                    
                    <div class="md:col-span-1">
                        <button type="button" class="remove-line bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition flex items-center justify-center">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <!-- Line total display -->
                    <div class="md:col-span-12 mt-4">
                        <div class="flex justify-between items-center p-3 bg-orange-100 rounded-lg">
                            <span class="font-bold text-orange-700">Total ligne:</span>
                            <span class="line-total font-bold text-orange-700">0.00 €</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" id="add-line" class="mt-6 bg-orange-500 text-white px-5 py-3 rounded-lg hover:bg-orange-600 transition flex items-center">
                <i class="fas fa-plus-circle mr-3"></i> Ajouter une ligne
            </button>
        </div>
        
        <!-- Totals Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-orange-50 p-6 rounded-xl border border-orange-100">
            <div class="mb-4">
                <label for="total_ht" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-calculator text-orange-500 mr-2"></i>
                    Total HT (€)*
                </label>
                <input type="number" name="total_ht" id="total_ht" step="0.01" min="0" required 
                       value="{{ old('total_ht', 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition bg-white" readonly>
                @error('total_ht')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="tva" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-percent text-orange-500 mr-2"></i>
                    TVA (€)*
                </label>
                <input type="number" name="tva" id="tva" step="0.01" min="0" required 
                       value="{{ old('tva', 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition bg-white" readonly>
                @error('tva')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="total_ttc" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-file-invoice-dollar text-orange-500 mr-2"></i>
                    Total TTC (€)*
                </label>
                <input type="number" name="total_ttc" id="total_ttc" step="0.01" min="0" required 
                       value="{{ old('total_ttc', 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition bg-white" readonly>
                @error('total_ttc')
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- TVA Rate Selection -->
            <div class="md:col-span-3 mb-4 mt-2">
                <label for="tva_rate" class="block text-gray-700 font-bold mb-3 flex items-center">
                    <i class="fas fa-percentage text-orange-500 mr-2"></i>
                    Taux de TVA (%)
                </label>
                <select id="tva_rate" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
                    <option value="20" selected>20% (Standard)</option>
                    <option value="10">10% (Réduit)</option>
                    <option value="5.5">5.5% (Intermédiaire)</option>
                    <option value="2.1">2.1% (Particulier)</option>
                </select>
            </div>
        </div>
        
        <!-- File Upload -->
        <div class="mb-8">
            <label for="fichier" class="block text-gray-700 font-bold mb-3 flex items-center">
                <i class="fas fa-paperclip text-orange-500 mr-2"></i>
                Fichier
            </label>
            <div class="flex items-center">
                <input type="file" name="fichier" id="fichier" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-300 transition">
            </div>
            <p class="text-gray-500 text-sm mt-2 font-medium">Formats acceptés: PDF, JPG, PNG, DOC, DOCX, XLS, XLSX</p>
            @error('fichier')
                <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-5">
            <a href="{{ route('bons-de-commande.index') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition font-bold flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Annuler
            </a>
            <button type="submit" class="bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition font-bold flex items-center">
                <i class="fas fa-save mr-2"></i> Créer le bon de commande
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add new product line
        const addLineBtn = document.getElementById('add-line');
        const productLines = document.getElementById('product-lines');
        let lineCount = 1; // Start from 1 because we have one initial row
        
        addLineBtn.addEventListener('click', function() {
            const newLine = document.querySelector('.product-line').cloneNode(true);
            const newIndex = lineCount++;
            
            // Update names and IDs
            newLine.innerHTML = newLine.innerHTML.replace(/\[0\]/g, `[${newIndex}]`);
            newLine.innerHTML = newLine.innerHTML.replace(/_0/g, `_${newIndex}`);
            
            // Reset values
            newLine.querySelector('.product-select').value = '';
            newLine.querySelector('.product-name-container').classList.add('hidden');
            newLine.querySelector('input[name*="nom_produit"]').value = '';
            newLine.querySelector('.quantity').value = '1';
            newLine.querySelector('.price').value = '0';
            newLine.querySelector('.discount').value = '0';
            newLine.querySelector('.line-total').textContent = '0.00 €';
            newLine.querySelector('input[name*="ajouter_au_stock"]').checked = false;
            
            // Add to container
            productLines.appendChild(newLine);
            
            // Reattach event listeners
            attachProductLineEvents(newLine);
            
            // Recalculate totals
            calculateOrderTotals();
        });
        
        // Handle product selection change
        function attachProductLineEvents(line) {
            const productSelect = line.querySelector('.product-select');
            const productNameContainer = line.querySelector('.product-name-container');
            const priceInput = line.querySelector('.price');
            
            productSelect.addEventListener('change', function() {
                if (this.value === 'autre') {
                    productNameContainer.classList.remove('hidden');
                    priceInput.value = '0';
                } else {
                    productNameContainer.classList.add('hidden');
                    
                    // Set price from selected product
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption && selectedOption.dataset.price) {
                        priceInput.value = selectedOption.dataset.price;
                    }
                }
                
                // Calculate line total
                calculateLineTotal(line);
            });
            
            // Remove line button
            line.querySelector('.remove-line').addEventListener('click', function() {
                // Only remove if there's more than one line
                if (document.querySelectorAll('.product-line').length > 1) {
                    line.remove();
                    calculateOrderTotals();
                }
            });
            
            // Add event listeners for quantity, price, discount inputs
            line.querySelector('.quantity').addEventListener('input', () => calculateLineTotal(line));
            line.querySelector('.price').addEventListener('input', () => calculateLineTotal(line));
            line.querySelector('.discount').addEventListener('input', () => calculateLineTotal(line));
        }
        
        // Calculate line total
        function calculateLineTotal(line) {
            const quantity = parseFloat(line.querySelector('.quantity').value) || 0;
            const price = parseFloat(line.querySelector('.price').value) || 0;
            const discount = parseFloat(line.querySelector('.discount').value) || 0;
            
            // Calculate discounted price
            const discountedPrice = price * (1 - discount / 100);
            const lineTotal = quantity * discountedPrice;
            
            // Update line total display
            line.querySelector('.line-total').textContent = lineTotal.toFixed(2) + ' €';
            
            // Update order totals
            calculateOrderTotals();
        }
        
        // Calculate order totals
        function calculateOrderTotals() {
            let totalHT = 0;
            
            // Sum all line totals
            document.querySelectorAll('.product-line').forEach(line => {
                const lineTotalText = line.querySelector('.line-total').textContent;
                const lineTotal = parseFloat(lineTotalText.replace(' €', '')) || 0;
                totalHT += lineTotal;
            });
            
            // Get TVA rate
            const tvaRate = parseFloat(document.getElementById('tva_rate').value) || 20;
            const tva = totalHT * (tvaRate / 100);
            const totalTTC = totalHT + tva;
            
            // Update order totals
            document.getElementById('total_ht').value = totalHT.toFixed(2);
            document.getElementById('tva').value = tva.toFixed(2);
            document.getElementById('total_ttc').value = totalTTC.toFixed(2);
        }
        
        // Attach events to initial line
        attachProductLineEvents(document.querySelector('.product-line'));
        
        // Add event listener to TVA rate selector
        document.getElementById('tva_rate').addEventListener('change', calculateOrderTotals);
        
        // Initialize calculations
        calculateLineTotal(document.querySelector('.product-line'));
    });
</script>

<style>
    .product-line {
        transition: all 0.3s ease;
    }
    
    .remove-line {
        transition: all 0.2s ease;
    }
    
    .remove-line:hover {
        transform: scale(1.05);
    }
    
    .product-name-container {
        transition: all 0.3s ease;
    }
    
    .focus\:ring-orange-300:focus {
        --tw-ring-color: rgba(253, 186, 116, 0.5);
    }
    
    .focus\:border-orange-300:focus {
        border-color: #fda56e;
    }
    
    .bg-orange-50 {
        background-color: #fff8f1;
    }
    
    .border-orange-100 {
        border-color: #fee0c0;
    }
    
    .border-orange-300 {
        border-color: #fda56e;
    }
    
    .bg-orange-100 {
        background-color: #ffedcc;
    }
    
    .text-orange-700 {
        color: #cc5500;
    }
</style>
@endsection