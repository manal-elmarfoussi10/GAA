@extends('layout')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">Gestion clients</h2>

        <!-- Top Buttons -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <a href="{{ route('clients.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Ajouter un dossier client
            </a>
            <button class="bg-gray-100 px-4 py-2 rounded hover:bg-gray-200">Voir pas statut interne</button>
            <button class="bg-gray-100 px-4 py-2 rounded hover:bg-gray-200">Voir mes dossiers par marge</button>
            <button class="bg-gray-100 px-4 py-2 rounded hover:bg-gray-200">Colonne visible</button>
            <button class="bg-gray-100 px-4 py-2 rounded hover:bg-gray-200">Export en Excel</button>
            <button class="bg-gray-100 px-4 py-2 rounded hover:bg-gray-200">Export en PDF</button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg text-sm">
                <thead class="bg-gray-100 text-gray-700 text-left">
                    <tr>
                        <th class="p-3">Date</th>
                        <th class="p-3">Dossier</th>
                        <th class="p-3">Statut GG auto</th>
                        <th class="p-3">Assurance N Siniste</th>
                        <th class="p-3">Facture HT</th>
                        <th class="p-3">Statut interne</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($clients as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">{{ $client->created_at->format('d/m/Y') }}</td>
                            <td class="p-3 font-medium">{{ $client->nom_assure }} {{ $client->prenom }}</td>

                            <!-- Statut GG Auto -->
                            <td class="p-3 space-x-1">
                                @if($client->statut_gg === 'Termine')
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Termine</span>
                                @elseif($client->statut_gg === 'Signature')
                                    <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded">Signature</span>
                                @elseif($client->statut_gg === 'Envoi Courrier')
                                    <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded">Envoi Courrier</span>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>

                            <td class="p-3">{{ $client->nom_assurance }} - {{ $client->numero_police }}</td>
                            <td class="p-3">604,63€</td> <!-- Example static value, replace with $client->facture_ht if dynamic -->
                            <td class="p-3">
                                <a href="#" class="bg-teal-100 text-teal-700 text-xs px-3 py-1 rounded hover:bg-teal-200">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection