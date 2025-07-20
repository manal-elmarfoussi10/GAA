<!DOCTYPE html>
<html>
<head>
    <title>Export PDF</title>
</head>
<body>
    <h1>Liste des Dépenses</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Date</th>
                <th>Dossier</th>
                <th>Fournisseur</th>
                <th>Payé ?</th>
                <th>HT</th>
                <th>TTC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->date->format('d/m/Y') }}</td>
                <td>{{ $expense->client->reference_client }}</td>
                <td>{{ $expense->fournisseur->nom_societe }}</td>
                <td>
                    @if($expense->paid_status == 'paid')
                        OUI
                    @elseif($expense->paid_status == 'pending')
                        En attente
                    @else
                        Non
                    @endif
                </td>
                <td>{{ number_format($expense->ht_amount, 2, ',', ' ') }} €</td>
                <td>{{ number_format($expense->ttc_amount, 2, ',', ' ') }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>