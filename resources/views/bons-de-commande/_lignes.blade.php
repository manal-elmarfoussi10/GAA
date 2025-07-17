@foreach ($lignes as $index => $ligne)
    <div class="mb-4">
        <label>Produit</label>
        <input type="text" name="lignes[{{ $index }}][produit_id]" value="{{ $ligne->produit_id }}" class="border px-2 py-1 w-full" />

        <label>Quantité</label>
        <input type="number" name="lignes[{{ $index }}][quantite]" value="{{ $ligne->quantite }}" class="border px-2 py-1 w-full" />

        <label>Prix</label>
        <input type="number" name="lignes[{{ $index }}][prix]" value="{{ $ligne->prix_unitaire }}" class="border px-2 py-1 w-full" />
    </div>
@endforeach