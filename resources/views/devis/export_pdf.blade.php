<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Devis</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des Devis</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Dossier</th>
                <th>HT</th>
                <th>TTC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devis as $item)
                <tr>
                    <td>{{ $item->date_devis }}</td>
                    <td>{{ $item->client->nom_assure ?? '-' }}</td>
                    <td>{{ number_format($item->total_ht, 2) }} €</td>
                    <td>{{ number_format($item->total_ttc, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>