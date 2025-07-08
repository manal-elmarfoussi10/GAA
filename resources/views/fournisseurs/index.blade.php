@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Liste des Fournisseurs</h1>
        <a href="{{ route('fournisseurs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un fournisseur
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Société</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Téléphone</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Adresse</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Contact</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fournisseurs as $fournisseur)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm">{{ $fournisseur->nom_societe }}</td>
                        <td class="px-6 py-4 text-sm">{{ $fournisseur->email }}</td>
                        <td class="px-6 py-4 text-sm">{{ $fournisseur->telephone }}</td>
                        <td class="px-6 py-4 text-sm">{{ $fournisseur->categorie }}</td>
                        <td class="px-6 py-4 text-sm">
                            {{ $fournisseur->adresse }}, {{ $fournisseur->code_postal }} {{ $fournisseur->ville }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            {{ $fournisseur->contact_nom }}<br>
                            {{ $fournisseur->contact_email }}<br>
                            {{ $fournisseur->contact_telephone }}
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
