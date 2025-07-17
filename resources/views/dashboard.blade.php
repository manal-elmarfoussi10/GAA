@extends('layout')

@section('content')
<h2 class="text-2xl font-semibold text-gray-700 mb-6">Tableau de bord</h2>

<!--  CA annuel & mensuel -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Carte Année -->
    <div class="bg-white rounded-xl shadow p-6 relative">
        <div class="flex justify-between items-start mb-2">
            <span class="text-sm text-orange-500 font-semibold">Année 2025</span>
            <div class="bg-yellow-100 p-2 rounded-full absolute top-4 right-4">
                <i data-lucide="package" class="w-5 h-5 text-yellow-600"></i>
            </div>
        </div>
        <div class="space-y-2 text-sm text-gray-700">
            <div>CA (FACTURES - AVOIRS) (HT)</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>CA (TTC)</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>MARGE (FACTURES - AVOIRS - ACHATS)*</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>ENCAISSÉ</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>DÉPENSES / ACHATS*</div>
            <div class="text-xl font-bold">$89,000</div>
        </div>
    </div>

    <!-- Carte Mois -->
    <div class="bg-white rounded-xl shadow p-6 relative">
        <div class="flex justify-between items-start mb-2">
            <span class="text-sm text-indigo-500 font-semibold">Juin 2025</span>
            <div class="bg-purple-100 p-2 rounded-full absolute top-4 right-4">
                <i data-lucide="user" class="w-5 h-5 text-purple-600"></i>
            </div>
        </div>
        <div class="space-y-2 text-sm text-gray-700">
            <div>CA (FACTURES - AVOIRS) (HT)</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>CA (TTC)</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>MARGE (FACTURES - AVOIRS - ACHATS)*</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>ENCAISSÉ</div>
            <div class="text-xl font-bold">$89,000</div>
            <div>DÉPENSES / ACHATS*</div>
            <div class="text-xl font-bold">$89,000</div>
        </div>
    </div>
</div>

<!--  Statistiques annuelles & mensuelles -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Carte Stats Annuelles -->
    <div class="bg-white rounded-xl shadow p-6 relative">
        <div class="flex justify-between items-start mb-2">
            <span class="text-sm text-teal-600 font-semibold">Année 2025</span>
            <div class="bg-green-100 p-2 rounded-full absolute top-4 right-4">
                <i data-lucide="line-chart" class="w-5 h-5 text-green-600"></i>
            </div>
        </div>
        <div class="space-y-2 text-sm text-gray-700">
            <div>Dossiers</div>
            <div class="text-xl font-bold">20</div>
            <div>Recouvrements</div>
            <div class="text-xl font-bold">0</div>
            <div>NB de Rendez vous</div>
            <div class="text-xl font-bold">10</div>
            <div>Facture Règles par assurance / client</div>
            <div class="text-xl font-bold">32</div>
        </div>
    </div>

    <!-- Carte Stats Mensuelles -->
    <div class="bg-white rounded-xl shadow p-6 relative">
        <div class="flex justify-between items-start mb-2">
            <span class="text-sm text-teal-600 font-semibold">Juin 2025</span>
            <div class="bg-green-100 p-2 rounded-full absolute top-4 right-4">
                <i data-lucide="line-chart" class="w-5 h-5 text-green-600"></i>
            </div>
        </div>
        <div class="space-y-2 text-sm text-gray-700">
            <div>Dossiers</div>
            <div class="text-xl font-bold">20</div>
            <div>Recouvrements</div>
            <div class="text-xl font-bold">0</div>
            <div>NB de Rendez vous</div>
            <div class="text-xl font-bold">10</div>
            <div>Facture Règles par assurance / client</div>
            <div class="text-xl font-bold">32</div>
        </div>
    </div>
</div>

<!--  Bloc Graphiques & Stats Assurances -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-2">Chiffre d'affaire (HT) 2024/2025</h3>
        <canvas id="chartCa"></canvas>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="font-semibold mb-2">Nombre de dossier 2024/2025</h3>
        <canvas id="chartDossiers"></canvas>
    </div>
</div>

<div class="bg-white rounded-xl shadow p-6 mb-6">
    <h3 class="font-semibold text-lg mb-4">Stats Assurances :</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-gray-700">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Assurance</th>
                    <th class="text-left py-2">Part de marché €</th>
                    <th class="text-left py-2">Part de marché %</th>
                    <th class="text-left py-2">Panier moyen €</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>MACIF</td><td>5 689.95 €</td><td>24.60%</td><td>982.00 €</td></tr>
                <tr><td>MATMUT</td><td>3 086.05 €</td><td>13.40%</td><td>1 188.05 €</td></tr>
                <tr><td>MUTUELLE DE POITIERS</td><td>2 571.64 €</td><td>11.13%</td><td>1 285.82 €</td></tr>
                <tr><td>GROUPAMA / MMA</td><td>1 421.91 €</td><td>6.15%</td><td>723.06 €</td></tr>
                <tr><td>MAIF</td><td>1 349.74 €</td><td>5.83%</td><td>1 124.56 €</td></tr>
                <tr><td>PACIFICA</td><td>1 134.62 €</td><td>4.91%</td><td>1 134.62 €</td></tr>
                <tr><td>IMA / MHD</td><td>723.56 €</td><td>3.13%</td><td>1 030.80 €</td></tr>
                <tr><td>ACM MHD</td><td>694.64 €</td><td>3.04%</td><td>694.64 €</td></tr>
            </tbody>
        </table>

        <h4 class="mt-6 font-semibold">Stats Connu par :</h4>
        <table class="min-w-full text-sm text-gray-700 mt-2">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Connu par</th>
                    <th class="text-left py-2">Part de marché €</th>
                    <th class="text-left py-2">Part de marché %</th>
                    <th class="text-left py-2">Panier moyen €</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Facebook</td><td>991.34 €</td><td>100.00%</td><td>991.34 €</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartCa'), {
        type: 'line',
        data: {
            labels: Array.from({length: 50}, (_, i) => (i + 1) * 1000 + '€'),
            datasets: [{
                label: 'CA',
                data: Array.from({length: 50}, () => Math.floor(Math.random() * 100) + 20),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('chartDossiers'), {
        type: 'line',
        data: {
            labels: Array.from({length: 50}, (_, i) => `${Math.floor(i / 10) + 1}/${(i % 12) + 1}`),
            datasets: [{
                label: 'Dossiers',
                data: Array.from({length: 50}, () => Math.floor(Math.random() * 5) + 1),
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
@endsection
