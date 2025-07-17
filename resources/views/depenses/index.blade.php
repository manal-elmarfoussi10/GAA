@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8 bg-white rounded shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Mes dépenses / achats</h2>

    <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2 items-center border border-blue-500 rounded overflow-hidden">
            <button class="px-4 py-2 hover:bg-blue-50 text-sm border-r">Colonne visible ⌄</button>
            <button class="px-4 py-2 hover:bg-blue-50 text-sm border-r">Export en Excel</button>
            <button class="px-4 py-2 hover:bg-blue-50 text-sm">Export en PDF</button>
        </div>
        <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
            Ajouter une dépense
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-t">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm text-left">
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Dossier</th>
                    <th class="px-4 py-2">Fournisseurs</th>
                    <th class="px-4 py-2">Payé ?</th>
                    <th class="px-4 py-2">HT</th>
                    <th class="px-4 py-2">TTC</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @for ($i = 0; $i < 5; $i++)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">09/06/2025</td>
                        <td class="px-4 py-2">Nom Prénom</td>
                        <td class="px-4 py-2">GG AUTO</td>
                        <td class="px-4 py-2 text-teal-600">
                            OUI<br><span class="text-xs text-teal-400">- Ajout le : 10/05/2025</span>
                        </td>
                        <td class="px-4 py-2">604,63€</td>
                        <td class="px-4 py-2">604,63€</td>
                        <td class="px-4 py-2 text-sm">
                            <a href="#" class="text-orange-600 font-medium">Modifier</a> <br>
                            <a href="#" class="text-red-500 text-sm">Supprimer</a>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection