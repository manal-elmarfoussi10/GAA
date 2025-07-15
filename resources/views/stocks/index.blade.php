@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Stocks</h1>
        <a href="{{ route('stocks.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un produit
        </a>
    </div>

    <form method="GET" action="{{ route('stocks.index') }}" class="mb-4 flex gap-4 items-center">
      
        <select name="statut" onchange="this.form.submit()" class="border px-4 py-2 rounded">
            <option value="">Tous les statuts</option>
            @php
                $statuts = [
                    'À COMMANDER',
                    'COMMANDÉ',
                    'LIVRÉ',
                    'POSÉ',
                    'A RETOURNER',
                    'CASSÉ À LA LIVRAISON',
                    'CASSÉ POSÉ',
                    'RETOURNÉ',
                    'STOCKÉ',
                    'ATTENTE REMBOURSEMENT',
                    'REMBOURSÉ'
                ];
            @endphp
            @foreach($statuts as $statut)
                <option value="{{ $statut }}" {{ request('statut') === $statut ? 'selected' : '' }}>
                    {{ $statut }}
                </option>
            @endforeach
        </select>
    
        <a href="{{ route('stocks.export.excel') }}" class="ml-auto bg-green-500 text-white px-3 py-2 rounded text-sm">Export Excel</a>
        <a href="{{ route('stocks.export.pdf') }}" class="bg-red-500 text-white px-3 py-2 rounded text-sm">Export PDF</a>
    </form>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">Date</th>
                    <th class="px-4 py-2 text-left text-sm">Produit</th>
                    <th class="px-4 py-2 text-left text-sm">Fournisseur</th>
                    <th class="px-4 py-2 text-left text-sm">Statut</th>
                    <th class="px-4 py-2 text-left text-sm">Poseur</th>
                    <th class="px-4 py-2 text-left text-sm">Accord</th>
                    <th class="px-4 py-2 text-left text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm">{{ $stock->date }}</td>
                    <td class="px-4 py-2 text-sm">{{ $stock->produit->nom ?? '' }}</td>
                    <td class="px-4 py-2 text-sm">{{ $stock->fournisseur->nom_societe ?? '' }}</td>
                    <td class="px-4 py-2 text-sm">{{ $stock->statut }}</td>
                    <td class="px-4 py-2 text-sm">{{ $stock->poseur->nom ?? '' }}</td>
                    <td class="px-4 py-2 text-sm">{{ $stock->accord ? 'Oui' : 'Non' }}</td>
                    <td class="px-4 py-2 text-sm">
                        <a href="{{ route('stocks.edit', $stock) }}" class="text-orange-500 hover:underline mr-2">Modifier</a>
                        <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline" onclick="return confirm('Supprimer ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
