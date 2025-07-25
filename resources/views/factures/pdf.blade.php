<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ... (styles identiques à ton design fourni) ... */
        /* Ajoute ici le style CSS de ton design précédent */
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="company-info">
                    <div class="company-name">
                        <i class="fas fa-car"></i>
                        <span>{{ $company->name }}</span>
                    </div>
                    <div class="company-details">
                        <div><i class="fas fa-map-marker-alt"></i></div>
                        <div>{{ $company->address }}</div>
                        <div><i class="fas fa-envelope"></i></div>
                        <div>{{ $company->email }}</div>
                        <div><i class="fas fa-phone"></i></div>
                        <div>{{ $company->phone }}</div>
                        <div><i class="fas fa-id-card"></i></div>
                        <div>SIRET: {{ $company->siret ?? 'Non renseigné' }}</div>
                    </div>
                </div>
            </div>

            <div class="invoice-meta">
                <div class="invoice-title">FACTURE</div>
                <div class="invoice-number">N° : {{ $facture->numero }}</div>
                <div class="invoice-date">Date : {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Client Section -->
        <div class="client-section">
            <div class="bill-to">
                <div class="section-title">
                    <i class="fas fa-user"></i>
                    <span>CLIENT</span>
                </div>
                <div class="client-details">
                    <div><strong>Nom :</strong></div>
                    <div>{{ $facture->client->nom }}</div>
                    <div><strong>Adresse :</strong></div>
                    <div>{{ $facture->client->adresse }}</div>
                    <div><strong>Téléphone :</strong></div>
                    <div>{{ $facture->client->telephone }}</div>
                    <div><strong>Email :</strong></div>
                    <div>{{ $facture->client->email }}</div>
                </div>
            </div>

            <div class="vehicle-info">
                <div class="section-title">
                    <i class="fas fa-car-side"></i>
                    <span>VÉHICULE</span>
                </div>
                <div class="vehicle-details">
                    <div><strong>Marque :</strong></div>
                    <div>{{ $facture->marque ?? 'N/A' }}</div>
                    <div><strong>Modèle :</strong></div>
                    <div>{{ $facture->modele ?? 'N/A' }}</div>
                    <div><strong>Immatriculation :</strong></div>
                    <div>{{ $facture->immatriculation ?? 'N/A' }}</div>
                    <div><strong>Assurance :</strong></div>
                    <div>{{ $facture->assurance ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            <div class="section-title">
                <i class="fas fa-file-alt"></i>
                <span>DESCRIPTION</span>
            </div>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th class="text-right">Montant HT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facture->items as $item)
                        <tr>
                            <td>{{ $item->produit }}</td>
                            <td>{{ number_format($item->prix_unitaire, 2, ',', ' ') }} €</td>
                            <td>{{ $item->quantite }}</td>
                            <td class="text-right">{{ number_format($item->total_ht, 2, ',', ' ') }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td><strong>Total HT</strong></td>
                        <td class="text-right">{{ number_format($facture->total_ht, 2, ',', ' ') }} €</td>
                    </tr>
                    <tr>
                        <td><strong>TVA (20%)</strong></td>
                        <td class="text-right">{{ number_format($facture->total_tva, 2, ',', ' ') }} €</td>
                    </tr>
                    <tr>
                        <td><strong>Total TTC</strong></td>
                        <td class="text-right">{{ number_format($facture->total_ttc, 2, ',', ' ') }} €</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="payment-section">
            <div class="payment-info">
                <div class="payment-methods">
                    <div class="section-title">
                        <i class="fas fa-credit-card"></i>
                        <span>MODALITÉS DE PAIEMENT</span>
                    </div>
                    <p>Paiement attendu sous 30 jours</p>
                    <div class="methods">
                        <p><i class="fas fa-check-circle"></i> Virement bancaire</p>
                        <p><i class="fas fa-check-circle"></i> Chèque</p>
                        <p><i class="fas fa-check-circle"></i> Espèces</p>
                    </div>
                </div>

                <div class="bank-info">
                    <div class="section-title">
                        <i class="fas fa-university"></i>
                        <span>COORDONNÉES BANCAIRES</span>
                    </div>
                    <div class="bank-details">
                        <p><strong>Titulaire :</strong> {{ $company->name }}</p>
                        <p><strong>IBAN :</strong> FR76 1234 5678 9123 4567 8901 234</p>
                        <p><strong>BIC :</strong> ABCDFRPPXXX</p>
                        <p><strong>Banque :</strong> Banque Générique</p>
                    </div>
                </div>
            </div>

            <div class="thank-you">
                <p>Merci pour votre confiance !</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="invoice-footer">
            <div>
                &copy; {{ now()->year }} {{ $company->name }} - Tous droits réservés
            </div>
            <div class="footer-contact">
                <div><i class="fas fa-phone"></i> {{ $company->phone }}</div>
                <div><i class="fas fa-envelope"></i> {{ $company->email }}</div>
            </div>
        </div>
    </div>
</body>
</html>
