@extends('layout')

@section('content')
<div class="bg-gray-100 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl p-10">

        <!-- Header -->
        <h2 class="text-3xl font-bold text-center text-orange-500 mb-8">
            Nouveau dossier client
        </h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errors -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-6">
                <strong>Erreurs :</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section 1: Info client -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <input name="nom_assure" placeholder="Nom de l'assuré ou société" class="form-input" />
                <input name="prenom" placeholder="Prénom" class="form-input" />
                <input name="email" placeholder="Email" class="form-input" />
                <input name="telephone" placeholder="Téléphone" class="form-input" />
                <input name="adresse" placeholder="Adresse" class="form-input" />
                <input name="code_postal" placeholder="Code postal" class="form-input" />
                <input name="ville" placeholder="Ville" class="form-input" />
                <input name="plaque" placeholder="Plaque d'immatriculation" class="form-input" />
            </div>

            <!-- Section 2: Assurance -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <input name="nom_assurance" placeholder="Nom de l'assurance" class="form-input" />
                <input name="autre_assurance" placeholder="Autre assurance" class="form-input" />
                <input name="numero_police" placeholder="Numéro de police" class="form-input" />
                <input type="date" name="date_sinistre" class="form-input" />
                <input type="date" name="date_declaration" class="form-input" />
                <input name="raison" placeholder="Raison du sinistre" class="form-input" />
                <input name="type_vitrage" placeholder="Type de vitrage" class="form-input" />
                <input name="professionnel" placeholder="Professionnel ?" class="form-input" />
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="ancien_modele_plaque" class="h-5 w-5 text-orange-500">
                    Ancien modèle de plaque ?
                </label>
            </div>

            <!-- Section 3: Données facultatives -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="reparation" class="h-5 w-5 text-orange-500">
                    Réparation ?
                </label>
                <input type="file" name="photo_vitrage" class="form-file" />
                <input type="file" name="photo_carte_verte" class="form-file" />
                <input type="file" name="photo_carte_grise" class="form-file" />
                <input name="type_cadeau" placeholder="Type de cadeau" class="form-input" />
                <input name="numero_sinistre" placeholder="Numéro de sinistre" class="form-input" />
                <input name="kilometrage" placeholder="Kilométrage" class="form-input" />
                <input name="connu_par" placeholder="Connu par" class="form-input" />
                <input name="adresse_pose" placeholder="Adresse de pose" class="form-input" />
                <input name="reference_interne" placeholder="Référence interne" class="form-input" />
                <input name="reference_client" placeholder="Référence client" class="form-input" />
            </div>

            <!-- Section 4: Zone de précision -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Précision à apporter</label>
                <textarea name="precision" rows="4" class="w-full p-4 border border-gray-300 rounded focus:ring-orange-500 focus:outline-none">Type the content here!</textarea>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white text-lg px-8 py-3 rounded-full shadow-lg transition duration-200">
                    Enregistrer le client
                </button>
            </div>
        </form>
    </div>

  npm run dev
</div>
@endsection