@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ma consommation</h2>

    <table class="min-w-full table-auto border border-gray-200">
        <thead class="bg-gray-50 text-sm text-gray-600">
            <tr>
                <th class="px-4 py-2 border-b text-left">Date</th>
                <th class="px-4 py-2 border-b text-left">Dossier</th>
                <th class="px-4 py-2 border-b text-left">Jetons</th>
                <th class="px-4 py-2 border-b text-left">Type</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-800">
            @for($i = 0; $i < 9; $i++)
            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                <td class="px-4 py-2 border-b">11/06/2025</td>
                <td class="px-4 py-2 border-b text-blue-600 underline">
                    THIERRY LOCHIN - RENAULT KADJAR - EG-844-MF
                </td>
                <td class="px-4 py-2 border-b text-red-500">-1</td>
                <td class="px-4 py-2 border-b">Achat</td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection