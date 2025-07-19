<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Devis #{{ $devis->id }} - {{ $company->commercial_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Roboto', 'DejaVu Sans', sans-serif;
        }
        
        body {
            font-size: 13px;
            color: #333;
            line-height: 1.6;
            background: #f9fafb;
            padding: 30px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        /* Header with Company Info */
        .header {
            background: #1e293b;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .company-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .company-logo-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
            padding: 8px;
        }
        
        .company-logo {
            max-width: 100%;
            max-height: 80px;
            object-fit: contain;
        }
        
        .company-info {
            flex: 1;
        }
        
        .company-name {
            font-size: 20px;
            font-weight: 700;
            color: #f97316;
            margin-bottom: 5px;
        }
        
        .company-details {
            font-size: 11px;
            opacity: 0.85;
            line-height: 1.6;
        }
        
        .devis-info {
            text-align: right;
        }
        
        .devis-title {
            font-size: 28px;
            font-weight: 600;
            color: #f97316;
            margin-bottom: 10px;
        }
        
        .devis-meta {
            font-size: 13px;
            opacity: 0.9;
        }
        
        .devis-meta strong {
            font-weight: 600;
            color: #f97316;
        }
        
        /* Client Info */
        .client-section {
            padding: 25px 40px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 40px;
        }
        
        .client-info {
            flex: 1;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .client-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .client-details {
            line-height: 1.8;
        }
        
        .vehicle-info {
            flex: 1;
        }
        
        .vehicle-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
        }
        
        /* Description */
        .description-section {
            padding: 20px 40px;
            background: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .description-content {
            font-size: 14px;
            line-height: 1.7;
        }
        
        /* Table */
        .table-section {
            padding: 30px 40px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0 30px;
        }
        
        thead th {
            background: #f8fafc;
            color: #334155;
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        tbody tr:nth-child(even) {
            background-color: #fafafa;
        }
        
        .text-right {
            text-align: right;
        }
        
        .currency {
            font-family: monospace;
            white-space: nowrap;
        }
        
        /* Totals */
        .totals {
            width: 300px;
            margin-left: auto;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .totals td {
            padding: 10px 15px;
        }
        
        .totals tr:last-child td {
            border-top: 1px solid #e2e8f0;
            font-weight: 600;
            font-size: 14px;
            color: #f97316;
        }
        
        /* Footer */
        .footer {
            padding: 25px 40px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        
        .payment-info {
            margin-bottom: 20px;
        }
        
        .payment-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
        }
        
        .bank-info {
            background: #fff7ed;
            border: 1px solid #ffedd5;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-size: 12px;
            line-height: 1.8;
        }
        
        .validity {
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .signature-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #cbd5e1;
        }
        
        .signature-line {
            border-bottom: 1px solid #94a3b8;
            height: 40px;
            width: 300px;
            margin-top: 10px;
        }
        
        .signature-label {
            font-size: 12px;
            color: #64748b;
            margin-top: 5px;
        }
        
        .terms {
            font-size: 11px;
            color: #64748b;
            margin-top: 20px;
            line-height: 1.6;
        }
        
        .highlight {
            background: #fffbeb;
            padding: 3px 5px;
            border-radius: 3px;
            font-weight: 500;
        }
        
        .text-orange {
            color: #f97316;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header with Company Info -->
        <div class="header">
            <div class="company-section">
                @if($company->logo)
                <div class="company-logo-container">
                    <img src="{{ $logoBase64 }}" alt="{{ $company->name }} Logo" class="company-logo">
                </div>
                @endif
                <div class="company-info">
                    <div class="company-name">{{ $company->commercial_name ?? $company->name }}</div>
                    <div class="company-details">
                        {{ $company->address }}<br>
                        {{ $company->postal_code }} {{ $company->city }}<br>
                        Tél: {{ $company->phone }} | Email: {{ $company->email }}<br>
                        SIRET: {{ $company->siret }} | TVA: {{ $company->tva }}
                    </div>
                </div>
            </div>
            <div class="devis-info">
                <div class="devis-title">DEVIS</div>
                <div class="devis-meta">
                    <div><strong>N° :</strong> {{ str_pad($devis->id, 8, '0', STR_PAD_LEFT) }}</div>
                    <div><strong>Date :</strong> {{ \Carbon\Carbon::parse($devis->date_devis)->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
        
        <!-- Client Information -->
        <div class="client-section">
            <div class="client-info">
                <div class="section-title">Client</div>
                <div class="client-name">{{ $devis->client->nom_assure }}</div>
               
            </div>
            
        </div>
        
        <!-- Description -->
        <div class="description-section">
            <div class="description-content">
                <strong>Description des travaux :</strong> CHANGEMENT PARE BRISE {{ $devis->titre }}
            </div>
        </div>
        
        <!-- Table -->
        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-right">Prix unitaire</th>
                        <th class="text-right">Quantité</th>
                        <th class="text-right">Remise</th>
                        <th class="text-right">Montant HT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devis->items as $item)
                    <tr>
                        <td>{{ $item->produit }}</td>
                        <td class="text-right currency">{{ number_format($item->prix_unitaire, 2, ',', ' ') }} €</td>
                        <td class="text-right">{{ $item->quantite }}</td>
                        <td class="text-right">{{ $item->remise ? $item->remise.'%' : '-' }}</td>
                        <td class="text-right currency">{{ number_format($item->total_ht, 2, ',', ' ') }} €</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Totals -->
            <table class="totals">
                <tr>
                    <td><strong>Total HT</strong></td>
                    <td class="text-right currency">{{ number_format($devis->total_ht, 2, ',', ' ') }} €</td>
                </tr>
                <tr>
                    <td><strong>TVA ({{ $devis->tva }}%)</strong></td>
                    <td class="text-right currency">{{ number_format($devis->total_tva, 2, ',', ' ') }} €</td>
                </tr>
                <tr>
                    <td><strong>Total TTC</strong></td>
                    <td class="text-right currency text-orange"><strong>{{ number_format($devis->total_ttc, 2, ',', ' ') }} €</strong></td>
                </tr>
            </table>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="validity">
                <strong>Offre valable jusqu'au :</strong> {{ \Carbon\Carbon::parse($devis->date_validite)->format('d/m/Y') }}
            </div>
            
            <div class="payment-info">
                <div class="payment-title">Modalités et conditions de règlement :</div>
                <div class="bank-info">
                    Par virement bancaire ou chèque à l'ordre de {{ $company->commercial_name ?? $company->name }}<br>
                    @if($company->bic && $company->iban)
                    <strong>BIC :</strong> {{ $company->bic }}<br>
                    <strong>IBAN :</strong> {{ chunk_split($company->iban, 4, ' ') }}
                    @else
                    <em>Coordonnées bancaires disponibles sur demande</em>
                    @endif
                </div>
            </div>
            
            <div class="terms">
                Ce devis est valable 30 jours.<br>
                Toute commande est soumise à nos conditions générales de vente.
            </div>
            
            <div class="signature-section">
                <div><strong>Bon pour accord et signature :</strong></div>
                <div class="signature-line"></div>
                <div class="signature-label">Fait à {{ $company->city }}, le {{ \Carbon\Carbon::parse($devis->date_devis)->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>
</body>
</html>