@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
<div class="bg-white rounded-2xl shadow-lg px-8 py-10">
    <!-- Logo du projet en haut -->
    <div class="flex justify-center mb-8">
        <!-- Mets ici le chemin de ton logo ou supprime si tu ne veux pas d'image -->
        <img src="{{ asset('images/GA GESTION LOGO.png') }}" alt="Logo Project France" class="h-16 w-auto" />
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-900 mb-1">Connexion à votre compte</h2>
    <p class="text-gray-500 text-center mb-8">Connectez-vous pour accéder à la plateform.</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="block mb-1 font-medium text-gray-700">Adresse e-mail</label>
            <div class="flex items-center border border-gray-300 rounded px-2 bg-gray-50">
                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12H8m0-4h8M3 8l7.89 5.26a3 3 0 003.22 0L21 8"/>
                    <rect width="18" height="14" x="3" y="6" rx="2" />
                </svg>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full bg-transparent border-0 py-2 focus:ring-0 focus:outline-none"
                    placeholder="exemple@domaine.com" value="{{ old('email') }}" />
            </div>
        </div>

        <!-- Mot de passe -->
        <div class="mb-5">
            <label for="password" class="block mb-1 font-medium text-gray-700">Mot de passe</label>
            <div class="flex items-center border border-gray-300 rounded px-2 bg-gray-50">
                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 11c1.657 0 3 1.343 3 3v1H9v-1c0-1.657 1.343-3 3-3zm-4 4v2a2 2 0 002 2h4a2 2 0 002-2v-2m-8 0h8"/>
                    <rect width="12" height="8" x="6" y="11" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 018 0v4" />
                  </svg>
                <input id="password" type="password" name="password" required
                    class="w-full bg-transparent border-0 py-2 focus:ring-0 focus:outline-none"
                    placeholder="Mot de passe" />
            </div>
        </div>

        <!-- Options et liens -->
        <div class="flex justify-between items-center mb-6">
            <label class="inline-flex items-center text-sm text-gray-600">
                <input type="checkbox" name="remember" class="form-checkbox text-blue-600 mr-2">
                Se souvenir de moi
            </label>
            <a href="{{ route('password.request') }}" class="text-blue-600 text-sm hover:underline font-semibold">
                Mot de passe oublié ?
            </a>
        </div>

        <button type="submit" class="w-full bg-black text-white py-2 rounded-lg text-lg font-bold hover:bg-gray-800 transition">
            Se connecter
        </button>
    </form>

    <div class="mt-8 text-center">
        <span class="text-gray-600 text-sm">Pas encore de compte ?</span>
        <a href="{{ route('register') }}" class="ml-1 text-blue-600 font-semibold hover:underline">
            Créer un compte
        </a>
    </div>
</div>
@endsection