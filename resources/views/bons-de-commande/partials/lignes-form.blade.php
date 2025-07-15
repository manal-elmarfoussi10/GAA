<div class="mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Lignes de commande</h3>

    <table class="w-full border border-gray-200 rounded overflow-hidden text-sm">
        <thead class="bg-gray-100 text-left text-gray-700">
            <tr>
                <th class="px-3 py-2">#</th>
                <th class="px-3 py-2">Ajouter au stock</th>
                <th class="px-3 py-2">Produit</th>
                <th class="px-3 py-2">Quantité</th>
                <th class="px-3 py-2">Prix HT</th>
                <th class="px-3 py-2">Remise (%)</th>
                <th class="px-3 py-2">Total HT</th>
                <th class="px-3 py-2 text-center">Action</th>
            </tr>
        </thead>
        <tbody id="ligne-produits">
            <tr>
                <td class="px-3 py-2">1</td>
                <td class="px-3 py-2">
                    <select name="lignes[0][ajouter_stock]" class="w-full border rounded px-2 py-1">
                        <option value="0">NON</option>
                        <option value="1">OUI</option>
                    </select>
                </td>
                <td class="px-3 py-2">
                    <input type="text" name="lignes[0][produit]" class="w-full border rounded px-2 py-1" placeholder="Nom du produit">
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="lignes[0][quantite]" class="w-full border rounded px-2 py-1" value="1" min="1">
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="lignes[0][prix_ht]" class="w-full border rounded px-2 py-1" step="0.01" value="0">
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="lignes[0][remise]" class="w-full border rounded px-2 py-1" step="0.01" value="0">
                </td>
                <td class="px-3 py-2">
                    <input type="number" name="lignes[0][total_ht]" class="w-full border rounded px-2 py-1 bg-gray-100" value="0" readonly>
                </td>
                <td class="px-3 py-2 text-center">
                    <button type="button" class="text-red-500 hover:text-red-700 font-semibold">×</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="flex gap-3 mt-4">
        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-sm px-4 py-2 rounded">+ Ajouter une ligne</button>
        <button type="button" class="bg-gray-100 hover:bg-gray-200 text-sm px-4 py-2 rounded">- Supprimer une ligne</button>
    </div>
</div>