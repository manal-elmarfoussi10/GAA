<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factures PDF</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Liste des Factures</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Numéro</th>
                <th>Client</th>
                <th>Date</th>
                <th>Total HT</th>
                <th>TVA</th>
                <th>Total TTC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factures as $facture)
                <tr>
                    <td>{{ $facture->id }}</td>
                    <td>{{ $facture->numero }}</td>
                    <td>{{ $facture->client->nom_assure ?? '' }}</td>
                    <td>{{ $facture->date_facture }}</td>
                    <td>{{ number_format($facture->total_ht, 2) }}</td>
                    <td>{{ number_format($facture->total_tva, 2) }}</td>
                    <td>{{ number_format($facture->total_ttc, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>