<!-- resources/views/users/index.blade.php -->
@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Mes utilisateurs</h2>
        <a href="{{ route('users.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded">
            Ajouter un utilisateur
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Nom</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-700">Rôle</th>
                    <th class="px-6 py-3 text-right font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('users.edit', $user) }}" class="text-orange-500 hover:underline">Modifier</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-3" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
