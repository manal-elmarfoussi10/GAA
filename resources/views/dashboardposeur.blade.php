@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-orange-600 mb-4">Tableau de Bord - Poseur</h1>

        <div class="bg-white p-6 rounded shadow">
            <ul class="list-disc pl-5 text-gray-700 space-y-2">
                <li>Accès uniquement à son calendrier de pose et aux informations de planification.</li>
                <li>Peut consulter les dossiers associés à ses interventions, mais sans pouvoir les modifier.</li>
                <li>Accès à l'ajout de photos et commentaires dans les dossiers.</li>
                <li><strong>À recommander pour :</strong> techniciens vitrage / monteurs.</li>
            </ul>
        </div>
    </div>
@endsection
