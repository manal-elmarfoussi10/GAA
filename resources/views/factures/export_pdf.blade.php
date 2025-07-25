<!DOCTYPE html>
<html>
<head>
    <title>Facture #{{ $facture->numero }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 25px;
            color: #333;
            background-color: #fff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .logo-container {
            flex: 1;
        }
        .logo {
            max-height: 70px;
            max-width: 120px;
        }
        .company-info {
            flex: 2;
            padding-left: 20px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .report-info {
            text-align: right;
            color: #666;
            font-size: 14px;
        }
        .report-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin: 25px 0;
            padding: 10px 0;
            border-bottom: 2px solid #FF6B00;
            border-top: 2px solid #FF6B00;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th {
            background-color: #f8f8f8;
            color: #333;
            font-weight: bold;
            padding: 12px 10px;
            text-align: left;
            border-bottom: 2px solid #FF6B00;
        }
        td {
            padding: 10px 10px;
            border-bottom: 1px solid #eee;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .summary {
            margin-top: 25px;
            padding: 15px 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
            font-weight: bold;
            border-left: 3px solid #FF6B00;
        }
        .summary-item {
            display: inline-block;
            margin-right: 40px;
        }
        .client-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .highlight {
            color: #FF6B00;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
            @endif
        </div>

        <div class="company-info">
            <div class="company-name">{{ $company->name }}</div>
            <div>{{ $company->address }}</div>
            <div>Téléphone: {{ $company->phone }}</div>
            <div>Email: {{ $company->email }}</div>
        </div>

        <div class="report-info">
            <div>Date d'édition: {{ now()->format('d/m/Y H:i') }}</div>
            <div>Facture #{{ $facture->numero }}</div>
        </div>
    </div>

    <div class="report-title">FACTURE CLIENT</div>

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Client</th>
                <th>Date</th>
                <th class="text-right">Total HT</th>
                <th class="text-right">TVA</th>
                <th class="text-right">Total TTC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $facture->numero }}</td>
                <td class="client-cell">{{ $facture->client->nom ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</td>
                <td class="text-right">{{ number_format($facture->total_ht, 2, ',', ' ') }} €</td>
                <td class="text-right">{{ number_format($facture->total_tva, 2, ',', ' ') }} €</td>
                <td class="text-right">{{ number_format($facture->total_ttc, 2, ',', ' ') }} €</td>
            </tr>
        </tbody>
    </table>

    <div class="summary">
        <span class="summary-item">Total HT: <span class="highlight">{{ number_format($facture->total_ht, 2, ',', ' ') }} €</span></span>
        <span class="summary-item">Total TVA: <span class="highlight">{{ number_format($facture->total_tva, 2, ',', ' ') }} €</span></span>
        <span class="summary-item">Total TTC: <span class="highlight">{{ number_format($facture->total_ttc, 2, ',', ' ') }} €</span></span>
    </div>

    <div class="footer">
        Généré le {{ now()->format('d/m/Y à H:i') }} par {{ auth()->user()->name ?? 'Système' }}
    </div>
</body>
</html>
