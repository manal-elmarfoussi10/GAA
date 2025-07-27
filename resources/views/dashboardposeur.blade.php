@extends('layout')

@section('content')
<div class="container mx-auto p-6">

    <div class="bg-gray-100 p-4 rounded shadow text-sm text-gray-700 mb-6">
        <ul class="list-disc list-inside">
            <li>Accès uniquement à son calendrier de pose et aux informations de planification.</li>
            <li>Peut consulter les dossiers associés à ses interventions, mais sans pouvoir les modifier.</li>
            <li>Accès à l’ajout de photos et commentaires dans les dossiers.</li>
            <li><strong>À recommander pour :</strong> techniciens vitrage / monteurs.</li>
        </ul>
    </div>

    @foreach ($interventions as $intervention)
        <div class="border p-4 mb-4 rounded shadow">
            <h2 class="text-lg font-bold">{{ $intervention->titre }}</h2>
            <p><strong>Date :</strong> {{ $intervention->date }}</p>
            <p><strong>Dossier :</strong> {{ $intervention->dossier->reference ?? '---' }}</p>
            <p><strong>Client :</strong> {{ $intervention->dossier->client->nom ?? '---' }}</p>

            <form action="{{ route('poseur.commenter', $intervention->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <textarea name="commentaire" class="w-full border rounded p-2" placeholder="Ajouter un commentaire..."></textarea>
                <input type="file" name="photo" class="mt-2">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded mt-2">Ajouter</button>
            </form>
        </div>
    @endforeach

</div>
@endsection
