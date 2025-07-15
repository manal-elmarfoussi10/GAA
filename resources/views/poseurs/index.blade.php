@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Liste des Poseurs</h1>
        <a href="{{ route('poseurs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter un poseur
        </a>
    </div>

    <div class="flex items-center gap-4 mb-4">
        <form method="GET" action="{{ route('poseurs.index') }}" class="w-full md:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par nom, email..." class="border px-4 py-2 rounded w-full" />
        </form>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Téléphone</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Ville</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Active</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($poseurs as $poseur)
                <tr class="border-t">
                    <td class="px-6 py-4 text-sm">{{ $poseur->nom }}</td>
                    <td class="px-6 py-4 text-sm">{{ $poseur->email }}</td>
                    <td class="px-6 py-4 text-sm">{{ $poseur->telephone }}</td>
                    <td class="px-6 py-4 text-sm">{{ $poseur->ville }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if ($poseur->actif)
                            <span class="text-green-600 font-semibold">Oui</span>
                        @else
                            <span class="text-red-500 font-semibold">Non</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('poseurs.edit', $poseur) }}" class="text-orange-500 hover:underline">Modifier</a>
                        <form action="{{ route('poseurs.destroy', $poseur) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
