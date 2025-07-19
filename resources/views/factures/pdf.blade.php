<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture #INV2023-001</title>
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
        
        /* Header Section */
        .invoice-header {
            background: linear-gradient(135deg, var(--primary) 0%, #ea580c 100%);
            color: white;
            padding: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
        }
        
        .company-info {
            max-width: 60%;
        }
        
        .company-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
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
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.5rem 1rem;
            font-size: 0.95rem;
            margin-top: 1rem;
        }
        
        .invoice-meta {
            text-align: right;
        }
        
        .invoice-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .invoice-number {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .invoice-date {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        /* Client Section */
        .client-section {
            display: flex;
            padding: 2rem;
            background: var(--light);
            border-bottom: 1px solid var(--border);
        }
        
        .bill-to {
            flex: 1;
            padding-right: 2rem;
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title i {
            background: var(--primary-light);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }
        
        .client-details {
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.75rem 1.5rem;
            font-size: 1rem;
        }
        
        .vehicle-info {
            flex: 0 0 300px;
            background: var(--primary-light);
            padding: 1.25rem;
            border-radius: 10px;
        }
        
        .vehicle-details {
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        /* Items Table */
        .items-section {
            padding: 2rem;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        
        .items-table th {
            background-color: var(--primary-light);
            color: var(--primary);
            text-align: left;
            padding: 1rem 1.25rem;
            font-weight: 600;
            border-bottom: 2px solid var(--primary);
        }
        
        .items-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
        }
        
        .items-table tr:nth-child(even) {
            background-color: var(--light);
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Totals Section */
        .totals-section {
            padding: 0 2rem 2rem;
            display: flex;
            justify-content: flex-end;
        }
        
        .totals-table {
            width: 300px;
            border-collapse: collapse;
        }
        
        .totals-table td {
            padding: 0.75rem 1rem;
        }
        
        .totals-table tr:last-child {
            font-weight: bold;
            background-color: var(--primary-light);
            border-top: 2px solid var(--primary);
            font-size: 1.1rem;
        }
        
        /* Payment Section */
        .payment-section {
            background: var(--primary-light);
            padding: 2rem;
            border-top: 1px solid var(--border);
        }
        
        .payment-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .payment-methods, .bank-info {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .bank-details {
            margin-top: 1rem;
            display: grid;
            gap: 0.5rem;
        }
        
        .thank-you {
            text-align: center;
            margin-top: 2rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            padding: 1rem;
            border-top: 1px dashed var(--primary);
        }
        
        /* Footer */
        .invoice-footer {
            background: var(--dark);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }
        
        .footer-contact {
            display: flex;
            gap: 1.5rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .invoice-header {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
            
            .company-info {
                max-width: 100%;
                text-align: center;
            }
            
            .company-name {
                justify-content: center;
            }
            
            .company-details {
                justify-content: center;
            }
            
            .client-section {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .bill-to {
                padding-right: 0;
            }
            
            .items-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header Section -->
        <div class="invoice-header">
            <div class="header-content">
                <div class="company-info">
                    <div class="company-name">
                        <i class="fas fa-car"></i>
                        <span>MONTECH AUTOMOBILES</span>
                    </div>
                    <div class="company-details">
                        <div><i class="fas fa-map-marker-alt"></i></div>
                        <div>10 Impasse des Cormiers, 49460 Feneu</div>
                        <div><i class="fas fa-envelope"></i></div>
                        <div>stemontechauto@gmail.com</div>
                        <div><i class="fas fa-phone"></i></div>
                        <div>06 67 72 43 94</div>
                        <div><i class="fas fa-id-card"></i></div>
                        <div>SIRET: 123 456 789 00012</div>
                    </div>
                </div>
            </div>
            
            <div class="invoice-meta">
                <div class="invoice-title">FACTURE</div>
                <div class="invoice-number">N° : INV2023-001</div>
                <div class="invoice-date">Date : 30/07/2023</div>
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
                    <div>Pierre Martin</div>
                    <div><strong>Adresse :</strong></div>
                    <div>15 Rue des Lilas, 49000 Angers</div>
                    <div><strong>Téléphone :</strong></div>
                    <div>06 12 34 56 78</div>
                    <div><strong>Email :</strong></div>
                    <div>pierre.martin@example.com</div>
                </div>
            </div>
            
            <div class="vehicle-info">
                <div class="section-title">
                    <i class="fas fa-car-side"></i>
                    <span>VÉHICULE</span>
                </div>
                <div class="vehicle-details">
                    <div><strong>Marque :</strong></div>
                    <div>Peugeot</div>
                    <div><strong>Modèle :</strong></div>
                    <div>308</div>
                    <div><strong>Immatriculation :</strong></div>
                    <div>AB-123-CD</div>
                    <div><strong>Assurance :</strong></div>
                    <div>MAIF</div>
                </div>
            </div>
        </div>
        
        <!-- Description -->
        <div class="items-section">
            <div class="section-title">
                <i class="fas fa-file-alt"></i>
                <span>DESCRIPTION</span>
            </div>
            <p>Remplacement de pare-brise avant avec vitrage original - Intervention sur véhicule</p>
            
            <!-- Items Table -->
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
                    <tr>
                        <td>Pare-brise avant original</td>
                        <td>350,00 €</td>
                        <td>1</td>
                        <td class="text-right">350,00 €</td>
                    </tr>
                    <tr>
                        <td>Joint d'étanchéité</td>
                        <td>45,00 €</td>
                        <td>1</td>
                        <td class="text-right">45,00 €</td>
                    </tr>
                    <tr>
                        <td>Main d'œuvre</td>
                        <td>85,00 €</td>
                        <td>2</td>
                        <td class="text-right">170,00 €</td>
                    </tr>
                    <tr>
                        <td>Nettoyage intérieur</td>
                        <td>25,00 €</td>
                        <td>1</td>
                        <td class="text-right">25,00 €</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Totals -->
            <div class="totals-section">
                <table class="totals-table">
                    <tr>
                        <td><strong>Total HT</strong></td>
                        <td class="text-right">590,00 €</td>
                    </tr>
                    <tr>
                        <td><strong>TVA (20%)</strong></td>
                        <td class="text-right">118,00 €</td>
                    </tr>
                    <tr>
                        <td><strong>Total TTC</strong></td>
                        <td class="text-right">708,00 €</td>
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
                        <p><strong>Titulaire :</strong> MONTECH AUTOMOBILES</p>
                        <p><strong>IBAN :</strong> FR76 1695 8000 0173 0696 2053 816</p>
                        <p><strong>BIC :</strong> QNTOFRP1XXX</p>
                        <p><strong>Banque :</strong> CREDIT AGRICOLE</p>
                    </div>
                </div>
            </div>
            
            <div class="thank-you">
                <p>Merci pour votre confiance !</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="invoice-footer">
            <div class="footer-copyright">
                &copy; 2023 MONTECH AUTOMOBILES - Tous droits réservés
            </div>
            <div class="footer-contact">
                <div><i class="fas fa-phone"></i> 06 67 72 43 94</div>
                <div><i class="fas fa-envelope"></i> stemontechauto@gmail.com</div>
            </div>
        </div>
    </div>

    <script>
        // Dynamic date functionality
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const formattedDate = now.toLocaleDateString('fr-FR');
            document.querySelector('.invoice-date').textContent = `Date : ${formattedDate}`;
            
            // Generate random invoice number
            const randomNum = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            document.querySelector('.invoice-number').textContent = `N° : INV2023-${randomNum}`;
        });
    </script>
</body>
</html>