@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Modifier les informations de l'entreprise</h2>

    <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Text Inputs --}}
        @foreach ([
            'name' => 'Nom',
            'commercial_name' => 'Nom commercial',
            'email' => 'Email',
            'phone' => 'Téléphone',
            'siret' => 'Numéro de SIRET',
            'tva' => 'Numéro de TVA',
            'iban' => 'IBAN',
            'bic' => 'BIC',
            'ape' => 'APE',
            'address' => 'Adresse',
            'postal_code' => 'Code postal',
            'city' => 'Ville',
            'known_by' => 'Connu par',
            'contact_permission' => 'Autorisation contact',
            'garage_type' => 'Type de garage',
        ] as $field => $label)
            <div>
                <label class="block font-semibold">{{ $label }}</label>
                <input type="text" name="{{ $field }}" value="{{ old($field, $company->$field) }}"
                       class="w-full border rounded px-3 py-2 mt-1" />
            </div>
        @endforeach

        {{-- File Inputs --}}
        @foreach ([
            'logo' => 'Logo de la société',
            'id_photo_recto' => 'Photo identité recto',
            'id_photo_verso' => 'Photo identité verso',
            'kbis' => 'Document Kbis',
            'rib' => 'Document RIB',
            'tva_exemption_doc' => 'Document non assujetti TVA',
            'invoice_terms_doc' => 'Document pour devis/factures'
        ] as $field => $label)
            <div>
                <label class="block font-semibold">{{ $label }}</label>
                <input type="file" name="{{ $field }}" class="w-full border rounded px-3 py-2 mt-1" />
                @if ($company->$field)
                    <p class="text-sm mt-1 text-green-600">Fichier existant</p>
                @endif
            </div>
        @endforeach

        <div class="pt-4">
            <button type="submit" class="bg-orange-500 hover:bg-blue-600 text-white px-6 py-2 rounded">Enregistrer</button>
        </div>
    </form>
</div>
@endsection