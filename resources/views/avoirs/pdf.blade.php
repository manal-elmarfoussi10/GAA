<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des Avoirs</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Liste des Avoirs</h2>
    <table>
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
</body>
</html>