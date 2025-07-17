@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto p-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-3xl font-bold text-gray-800">Mon entreprise</h2>
            @if($company)
                <a href="{{ route('company.edit') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded transition">
                    Modifier
                </a>
            @endif
        </div>

        @if($company)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                <div>
                    <h3 class="font-semibold text-orange-600">Nom :</h3>
                    <p>{{ $company->name }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Nom commercial :</h3>
                    <p>{{ $company->commercial_name }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Email :</h3>
                    <p>{{ $company->email }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Téléphone :</h3>
                    <p>{{ $company->phone }}</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="font-semibold text-orange-600">Adresse :</h3>
                    <p>{{ $company->address }}, {{ $company->postal_code }} {{ $company->city }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">SIRET :</h3>
                    <p>{{ $company->siret }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">TVA :</h3>
                    <p>{{ $company->tva }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">IBAN :</h3>
                    <p>{{ $company->iban }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">BIC :</h3>
                    <p>{{ $company->bic }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">APE :</h3>
                    <p>{{ $company->ape }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Connu par :</h3>
                    <p>{{ $company->known_by }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Autorisation de contact :</h3>
                    <p>{{ $company->contact_permission }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-600">Type de garage :</h3>
                    <p>{{ $company->garage_type }}</p>
                </div>
            </div>
        @else
            <div class="text-center text-gray-600 py-6">
                <p class="mb-4">Aucune information sur l’entreprise n’a encore été enregistrée.</p>
                <a href="{{ route('company.create') }}"
                   class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded transition">
                    ➕ Ajouter mes informations
                </a>
            </div>
        @endif
    </div>
</div>
@endsection