@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Mes produits</h1>
        <a href="{{ route('produits.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un produit
        </a>
    </div>

    <form method="GET" action="{{ route('produits.index') }}" class="mb-4">
        <div class="flex items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="border px-4 py-2 rounded w-1/3" />
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Rechercher</button>
        </div>
    </form>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Produit</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Code</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Prix (HT)</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">TVA</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actif</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm">{{ $produit->nom }}</td>
                        <td class="px-6 py-4 text-sm">{{ $produit->code }}</td>
                        <td class="px-6 py-4 text-sm">{{ $produit->description }}</td>
                        <td class="px-6 py-4 text-sm">{{ number_format($produit->prix_ht, 2) }} €</td>
                        <td class="px-6 py-4 text-sm">{{ number_format($produit->montant_tva, 2) }} €</td>
                        <td class="px-6 py-4 text-sm">{{ $produit->categorie }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if ($produit->actif)
                                <span class="text-green-600 font-semibold">Oui</span>
                            @else
                                <span class="text-gray-500">Non</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('produits.edit', $produit) }}" class="text-orange-500 hover:underline mr-2">Modifier</a>
                            <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline" onclick="return confirm('Confirmer suppression ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection