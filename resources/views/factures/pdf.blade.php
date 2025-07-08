<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $facture->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            padding: 40px;
        }
        .header, .footer { width: 100%; }
        .header div {
            display: inline-block;
            width: 49%;
            vertical-align: top;
        }
        h1 {
            color: #f97316;
            font-size: 24px;
            text-align: right;
            margin: 0;
        }
        .client-info, .company-info {
            font-size: 12px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f3f4f6;
        }
        .totals {
            margin-top: 20px;
            float: right;
            width: 300px;
        }
        .totals td {
            padding: 6px;
        }
        .note {
            margin-top: 60px;
            font-size: 11px;
            line-height: 1.4;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="company-info">
        <strong>MONTECH AUTOMOBILES</strong><br>
        10 IMPASSE DES CORMIERS<br>
        49460 FENEU<br>
        stemontechauto@gmail.com<br>
        06 67 72 43 94
    </div>
    <div>
        <h1>FACTURE</h1>
        <p><strong>N° :</strong> {{ str_pad($facture->id, 8, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</p>
    </div>
</div>

<hr style="margin: 20px 0;">

<div class="client-info">
    <strong>{{ $facture->client->nom_assure }}</strong><br>
    {{ $facture->client->adresse }}<br>
    {{ $facture->client->code_postal }} {{ $facture->client->ville }}
</div>

<br>
<p><strong>Description :</strong><br>
FACTURATION - {{ $facture->description ?? 'Remplacement Pare-brise' }}<br>
{{ $facture->client->assurance ?? '' }} / {{ $facture->client->plaque ?? '' }}
</p>

<table>
    <thead>
        <tr>
            <th>Description</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Montant HT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facture->items ?? [] as $item)
        <tr>
            <td>{{ $item->produit }}</td>
            <td>{{ number_format($item->prix_unitaire, 2, ',', ' ') }} €</td>
            <td>{{ $item->quantite }}</td>
            <td>{{ number_format($item->total_ht, 2, ',', ' ') }} €</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <td><strong>Total HT</strong></td>
        <td>{{ number_format($facture->total_ht, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <td><strong>TVA ({{ $facture->tva }}%)</strong></td>
        <td>{{ number_format($facture->total_tva, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <td><strong>Total TTC</strong></td>
        <td><strong>{{ number_format($facture->total_ttc, 2, ',', ' ') }} €</strong></td>
    </tr>
</table>

<div style="clear: both;"></div>

<div class="note">
    <p><strong>Modalités de règlement :</strong><br>
    Paiement par virement ou chèque à l’ordre de MONTECH AUTOMOBILES<br>
    IBAN : FR7616958000017306962053816 — BIC : QNTOFRP1XXX</p>

    <p><strong>Merci pour votre confiance.</strong></p>
</div>

</body>
</html>