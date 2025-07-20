<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Avoirs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #f97316;
            --primary-light: #ffedd5;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --border: #e2e8f0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        body {
            background-color: #f1f5f9;
            color: var(--dark);
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .invoice-container {
            max-width: 900px;
            width: 100%;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }
        .invoice-header {
            background: linear-gradient(135deg, var(--primary) 0%, #ea580c 100%);
            color: white;
            padding: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .company-name {
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .company-name i {
            background: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .company-details {
            margin-top: 1rem;
            font-size: 0.95rem;
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.5rem 1rem;
        }
        .invoice-meta {
            text-align: right;
        }
        .invoice-title {
            font-size: 2.5rem;
            font-weight: 800;
        }
        .invoice-date {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .items-section {
            padding: 2rem;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }
        .items-table th {
            background-color: var(--primary-light);
            color: var(--primary);
            text-align: left;
            padding: 1rem;
            border-bottom: 2px solid var(--primary);
        }
        .items-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .items-table tr:nth-child(even) {
            background-color: var(--light);
        }
        .invoice-footer {
            background: var(--dark);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="invoice-header">
        <div>
            <div class="company-name">
                <i class="fas fa-car"></i>
                <span>Global Auto Gestion</span>
            </div>
            <div class="company-details">
                <div><i class="fas fa-phone"></i></div><div>Téléphone :</div>
                <div><i class="fas fa-envelope"></i></div><div>info@gestion.com</div>
            </div>
        </div>
        <div class="invoice-meta">
            <div class="invoice-title">Liste des Avoirs</div>
            <div class="invoice-date">Date d'édition : {{ now()->format('d/m/Y H:i') }}</div>
            <div>Total avoirs : {{ count($avoirs) }}</div>
        </div>
    </div>

    <div class="items-section">
        <div class="section-title">
            <i class="fas fa-file-invoice"></i>
            <span>Détails des Avoirs</span>
        </div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Facture ID</th>
                    <th>Année fiscale</th>
                    <th>Date de RDV</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($avoirs as $avoir)
                    <tr>
                        <td>{{ $avoir->created_at->format('d/m/Y') }}</td>
                        <td>{{ $avoir->facture->client->nom_assure ?? '-' }}</td>
                        <td>{{ number_format($avoir->montant, 2) }} €</td>
                        <td>{{ $avoir->facture_id }}</td>
                        <td>{{ $avoir->created_at->format('Y') }}</td>
                        <td>{{ optional($avoir->facture->client->rdvs->first())->start_time ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="invoice-footer">
        <div>&copy; {{ date('Y') }} Global Auto Gestion - Tous droits réservés</div>
        <div>
            <i class="fas fa-phone"></i> Téléphone
            <i class="fas fa-envelope" style="margin-left: 1rem;"></i> info@gestion.com
        </div>
    </div>
</div>
</body>
</html>
