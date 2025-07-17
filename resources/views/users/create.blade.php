@extends('layout')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter un utilisateur</h2>

    {{-- Error Message Display --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- L’ID de l’entreprise de l’utilisateur connecté -->
        <input type="hidden" name="entreprise_id" value="{{ auth()->user()->entreprise_id }}">

        <div>
            <label class="block font-medium text-sm text-gray-700">Prénom</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}"
                   class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('first_name') border-red-500 @enderror" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Nom</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}"
                   class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('last_name') border-red-500 @enderror" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Adresse Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-500 @enderror" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Mot de passe</label>
            <input type="password" name="password"
                   class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-500 @enderror" required>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Rôle</label>
            <select name="role"
                    class="w-full border-gray-300 rounded shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('role') border-red-500 @enderror" required>
                <option value="">-- Sélectionner un rôle --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="client_support" {{ old('role') == 'client_support' ? 'selected' : '' }}>Service client</option>
                <option value="limited_client_support" {{ old('role') == 'limited_client_support' ? 'selected' : '' }}>Service client limité</option>
                <option value="commercial" {{ old('role') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                <option value="service_devis" {{ old('role') == 'service_devis' ? 'selected' : '' }}>Service Devis, commande et RDV</option>
                <option value="poseur" {{ old('role') == 'poseur' ? 'selected' : '' }}>Poseur</option>
                <option value="comptable" {{ old('role') == 'comptable' ? 'selected' : '' }}>Comptable</option>
            </select>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active"
                   class="mr-2 rounded border-gray-300 text-orange-600 focus:ring-orange-500"
                   {{ old('is_active') ? 'checked' : '' }}>
            <label for="is_active" class="text-sm text-gray-700">Activer le compte</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection