@extends('layout')

@section('content')
    <h2 class="text-2xl font-semibold mb-6">Tableau de bord</h2>

    <!-- Top Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Yearly Overview Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-orange-500 font-semibold mb-2">Année 2025</p>
            <div class="space-y-2">
                <p><strong>CA (FACTURES - AVOIRS) (HT):</strong> $89,000</p>
                <p><strong>CA (TTC):</strong> $89,000</p>
                <p><strong>MARGE (FACTURES - AVOIRS - ACHATS):</strong> $89,000</p>
                <p><strong>ENCAISSÉ:</strong> $89,000</p>
                <p><strong>DÉPENSES / ACHATS:</strong> $89,000</p>
            </div>
        </div>

        <!-- Monthly Overview Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-indigo-500 font-semibold mb-2">Juin 2025</p>
            <div class="space-y-2">
                <p><strong>CA (FACTURES - AVOIRS) (HT):</strong> $89,000</p>
                <p><strong>CA (TTC):</strong> $89,000</p>
                <p><strong>MARGE (FACTURES - AVOIRS - ACHATS):</strong> $89,000</p>
                <p><strong>ENCAISSÉ:</strong> $89,000</p>
                <p><strong>DÉPENSES / ACHATS:</strong> $89,000</p>
            </div>
        </div>
    </div>

    <!-- Bottom Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Yearly Metrics Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-teal-600 font-semibold mb-2">Année 2025</p>
            <div class="space-y-2">
                <p><strong>Dossiers:</strong> 20</p>
                <p><strong>Recouvrements:</strong> 0</p>
                <p><strong>NB de Rendez vous:</strong> 10</p>
                <p><strong>Facture Regles par assurance/client:</strong> 32</p>
            </div>
        </div>

        <!-- Monthly Metrics Card -->
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-teal-600 font-semibold mb-2">Juin 2025</p>
            <div class="space-y-2">
                <p><strong>Dossiers:</strong> 20</p>
                <p><strong>Recouvrements:</strong> 0</p>
                <p><strong>NB de Rendez vous:</strong> 10</p>
                <p><strong>Facture Regles par assurance/client:</strong> 32</p>
            </div>
        </div>
    </div>
@endsection