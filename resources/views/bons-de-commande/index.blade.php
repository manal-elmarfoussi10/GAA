@extends('layout')

@section('content')
@php use Carbon\Carbon; @endphp

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mes bons de commande</h1>
        <a href="{{ route('bons-de-commande.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded shadow">
            + Ajouter un bon de commande
        </a>
    </div>

    <div class="flex gap-4 mb-4">
        <a href="{{ route('bons-de-commande.export.excel') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
            Exporter en Excel
        </a>
        <a href="{{ route('bons-de-commande.export.pdf') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
            Exporter en PDF
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm table-auto">
            <thead class="bg-gray-100 text-left text-gray-600">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Dossier</th>
                    <th class="px-4 py-2">Fournisseur</th>
                    <th class="px-4 py-2">HT</th>
                    <th class="px-4 py-2">TTC</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bons as $bon)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ Carbon::parse($bon->date_commande)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $bon->client?->full_name ?? $bon->titre }}</td>
                    <td class="px-4 py-2 font-semibold">{{ strtoupper($bon->fournisseur->nom_societe ?? '-') }}</td>
                    <td class="px-4 py-2">{{ number_format($bon->total_ht, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-2">{{ number_format($bon->total_ttc, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('bons-de-commande.edit', $bon) }}"
                               class="text-white bg-orange-500 hover:bg-orange-600 px-3 py-1 rounded text-xs font-medium">
                                Modifier
                            </a>
                            <form action="{{ route('bons-de-commande.destroy', $bon) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-xs font-medium">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 px-4 py-6">Aucun bon de commande disponible.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection