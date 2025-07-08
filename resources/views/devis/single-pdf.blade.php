<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Devis #{{ $devis->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 0; padding: 40px; }
        .header, .footer { width: 100%; }
        .header div { display: inline-block; width: 49%; vertical-align: top; }
        h1 { color: #f97316; font-size: 24px; text-align: right; }
        .client-info, .company-info { font-size: 12px; line-height: 1.5; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
        .totals { margin-top: 20px; float: right; width: 300px; }
        .totals td { padding: 6px; }
        .note { margin-top: 40px; font-size: 11px; line-height: 1.4; }
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
        <h1>DEVIS</h1>
        <p><strong>N° :</strong> {{ str_pad($devis->id, 8, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($devis->date_devis)->format('d/m/Y') }}</p>
    </div>
</div>

<hr style="margin: 20px 0;">

<div class="client-info">
    <strong>{{ $devis->client->nom_assure }}</strong><br>
    {{ $devis->client->adresse }}<br>
    {{ $devis->client->code_postal }} {{ $devis->client->ville }}
</div>

<br>
<p><strong>Description :</strong><br>
CHANGEMENT PARE BRISE {{ $devis->titre }} / {{ $devis->client->assurance ?? 'ASSURANCE' }} / {{ $devis->client->plaque ?? '' }}
</p>

<table>
    <thead>
        <tr>
            <th>Description</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Remise</th>
            <th>Montant HT</th>
        </tr>
    </thead>
    <tbody>
        @foreach($devis->items as $item)
        <tr>
            <td>{{ $item->produit }}</td>
            <td>{{ number_format($item->prix_unitaire, 2, ',', ' ') }} €</td>
            <td>{{ $item->quantite }}</td>
            <td>{{ $item->remise }}%</td>
            <td>{{ number_format($item->total_ht, 2, ',', ' ') }} €</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <td><strong>Total HT</strong></td>
        <td>{{ number_format($devis->total_ht, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <td><strong>TVA ({{ $devis->tva }}%)</strong></td>
        <td>{{ number_format($devis->total_tva, 2, ',', ' ') }} €</td>
    </tr>
    <tr>
        <td><strong>Total TTC</strong></td>
        <td><strong>{{ number_format($devis->total_ttc, 2, ',', ' ') }} €</strong></td>
    </tr>
</table>

<div style="clear: both;"></div>

<div class="note">
    <p><strong>Modalités et conditions de règlement :</strong><br>
    Par virement bancaire ou chèque à l'ordre de MONTECH AUTOMOBILES<br>
    BIC : QNTOFRP1XXX — IBAN : FR7616958000017306962053816<br>
    Ce devis est valable 30 jours.<br>
    Toute commande est soumise à nos conditions générales de vente.</p>

    <p><strong>Offre valable jusqu'au :</strong> {{ \Carbon\Carbon::parse($devis->date_validite)->format('d/m/Y') }}</p>

    <p><strong>Bon pour accord et signature :</strong></p>
    <p>.........................................................</p>
</div>

</body>
</html>