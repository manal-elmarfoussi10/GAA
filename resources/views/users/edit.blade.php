@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Modifier l'utilisateur</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-sm text-gray-700">Prénom</label>
            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Nom</label>
            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Adresse Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Mot de passe <span class="text-sm text-gray-400">(laisser vide pour ne pas changer)</span></label>
            <input type="password" name="password" class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Rôle</label>
            <select name="role" class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
                <option value="">-- Sélectionner un rôle --</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="client_support" {{ $user->role === 'client_support' ? 'selected' : '' }}>Service client</option>
                <option value="limited_support" {{ $user->role === 'limited_support' ? 'selected' : '' }}>Service client limité</option>
                <option value="sales" {{ $user->role === 'sales' ? 'selected' : '' }}>Commercial</option>
                <option value="orders" {{ $user->role === 'orders' ? 'selected' : '' }}>Service Devis, commande et RDV</option>
                <option value="installer" {{ $user->role === 'installer' ? 'selected' : '' }}>Poseur</option>
                <option value="accounting" {{ $user->role === 'accounting' ? 'selected' : '' }}>Comptable</option>
            </select>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" {{ $user->is_active ? 'checked' : '' }} class="mr-2 rounded border-gray-300 text-orange-600 focus:ring-orange-500">
            <label for="is_active" class="text-sm text-gray-700">Activer le compte</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection