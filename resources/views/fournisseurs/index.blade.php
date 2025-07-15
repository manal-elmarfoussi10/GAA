@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Mes Fournisseurs</h1>
        <a href="{{ route('fournisseurs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un fournisseur
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Téléphone</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total HT</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fournisseurs as $fournisseur)
                <tr class="border-t">
                    <td class="px-6 py-4 text-sm">{{ $fournisseur->nom_societe }}</td>
                    <td class="px-6 py-4 text-sm">{{ $fournisseur->telephone }}</td>
                    <td class="px-6 py-4 text-sm">{{ $fournisseur->categorie }}</td>
                    <td class="px-6 py-4 text-sm">{{ number_format($fournisseur->total_ht ?? 0, 2) }} €</td>
                    <td class="px-6 py-4 text-sm text-orange-600 space-x-2">
                        <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}">Modifier</a>
                        <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce fournisseur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
