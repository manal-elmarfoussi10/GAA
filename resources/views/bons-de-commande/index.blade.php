@extends('layout')

@section('content')
@php use Carbon\Carbon; @endphp
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Mes bons de commande</h1>
        <a href="{{ route('bons-de-commande.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded">
            Ajouter un bon de commande
        </a>
    </div>

    <div class="flex gap-4 mb-4">
        <a href="{{ route('bons-de-commande.export.excel') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Exporter en Excel</a>
        <a href="{{ route('bons-de-commande.export.pdf') }}" class="bg-gray-700 text-white px-4 py-2 rounded">Exporter en PDF</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Dossier</th>
                    <th class="px-4 py-2">Fournisseurs</th>
                    <th class="px-4 py-2">HT</th>
                    <th class="px-4 py-2">TTC</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bons as $bon)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ Carbon::parse($bon->date_commande)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $bon->client?->full_name ?? $bon->titre }}</td>
                    <td class="px-4 py-2 font-semibold">{{ strtoupper($bon->fournisseur->nom_societe ?? '-') }}</td>
                    <td class="px-4 py-2">{{ number_format($bon->total_ht, 2, ',', ' ') }}€</td>
                    <td class="px-4 py-2">{{ number_format($bon->total_ttc, 2, ',', ' ') }}€</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('bons-de-commande.edit', $bon) }}" class="text-orange-500 hover:underline mr-2">Modifier</a>
                        <form action="{{ route('bons-de-commande.destroy', $bon) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:underline" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
