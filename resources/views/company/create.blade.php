@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Ajouter les informations de mon entreprise</h2>

    <form action="{{ route('company.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block font-medium">Nom :</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Nom commercial :</label>
                <input type="text" name="commercial_name" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Email :</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Téléphone :</label>
                <input type="text" name="phone" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Adresse :</label>
                <input type="text" name="address" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Code postal :</label>
                <input type="text" name="postal_code" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Ville :</label>
                <input type="text" name="city" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">SIRET :</label>
                <input type="text" name="siret" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">TVA :</label>
                <input type="text" name="tva" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">IBAN :</label>
                <input type="text" name="iban" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">BIC :</label>
                <input type="text" name="bic" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">APE :</label>
                <input type="text" name="ape" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Connu par :</label>
                <input type="text" name="known_by" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Autorisation de contact :</label>
                <select name="contact_permission" class="w-full border rounded px-3 py-2">
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                    <option value="demander">Me demander avant</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Type de garage :</label>
                <select name="garage_type" class="w-full border rounded px-3 py-2">
                    <option value="fixe">Fixe</option>
                    <option value="mobile">Mobile</option>
                    <option value="les deux">Les deux</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-green-600 text-white px-6 py-2 rounded">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection