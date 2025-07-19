@extends('layout')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord dynamique</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        :root {
            --primary: #FF4B00;
            --primary-light: #ff7b40;
            --primary-extra-light: #fff1ec;
            --dark: #2d3748;
            --gray-800: #1a202c;
            --gray-700: #4a5568;
            --gray-500: #718096;
            --gray-300: #e2e8f0;
            --gray-200: #edf2f7;
            --gray-100: #f7fafc;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --success: #10b981;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
            color: var(--gray-800);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--gray-300);
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s ease;
        }

        .header-title:hover {
            transform: scale(1.02);
        }

        .header-title span {
            color: var(--primary);
        }

        .header-actions {
            display: flex;
            gap: 16px;
        }

        .header-btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            border: none;
            outline: none;
        }

        .primary-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
        }

        .primary-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .secondary-btn {
            background: transparent;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .secondary-btn:hover {
            background: var(--gray-100);
            border-color: var(--gray-500);
        }

        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--primary);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: var(--primary-extra-light);
            border-radius: 0 0 0 100%;
            z-index: 0;
            transition: all 0.4s ease;
        }

        .stat-card:hover::before {
            width: 100%;
            height: 100%;
            border-radius: 16px;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            position: relative;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-extra-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 20px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1);
            background: var(--primary);
            color: white;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-value {
            color: var(--primary);
        }

        .stat-subtitle {
            font-size: 14px;
            color: var(--gray-500);
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-subtitle {
            color: var(--gray-700);
        }

        .trend-up {
            color: var(--success);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
        }

        .trend-down {
            color: var(--warning);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
        }

        /* Charts section */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-3px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Table section */
        .table-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        .table-card:hover {
            transform: translateY(-3px);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            font-weight: 600;
            color: var(--gray-700);
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--gray-300);
            position: sticky;
            top: 0;
            background: white;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-200);
            color: var(--gray-700);
            transition: all 0.2s ease;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--gray-100);
            transform: scale(1.01);
        }

        .progress-bar {
            height: 6px;
            background: var(--gray-200);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 8px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
            background: var(--primary);
            transition: width 1s ease;
        }

        .insurance-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-extra-light);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            transition: all 0.3s ease;
        }

        tr:hover .insurance-icon {
            background: var(--primary);
            color: white;
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--primary-extra-light);
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <div class="dashboard-container">
        <!-- Header -->
        <div class="header">
            <h1 class="header-title">
                <i class="fas fa-chart-line"></i>
                Tableau de <span>Bord</span>
            </h1>
            <div class="header-actions">
                <button class="header-btn secondary-btn" id="exportBtn">
                    <i class="fas fa-download"></i> Exporter PDF
                </button>
                <button class="header-btn primary-btn" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Actualiser
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">CA Annuel (HT)</div>
                        <div class="stat-value" id="annualRevenue">{{ number_format($totalHT, 0, ',', ' ') }} €</div>
                        <div class="trend-up">
                            <i class="fas fa-arrow-up"></i> <span id="revenueTrend">12.5%</span> vs année précédente
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Marge (TTC)</div>
                        <div class="stat-value" id="marginValue">{{ number_format($marge, 0, ',', ' ') }} €</div>
                        <div class="trend-up">
                            <i class="fas fa-arrow-up"></i> <span id="marginTrend">8.2%</span> vs année précédente
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Dépenses</div>
                        <div class="stat-value" id="expensesValue">{{ number_format($depenses, 0, ',', ' ') }} €</div>
                        <div class="stat-subtitle">
                            <i class="fas fa-info-circle"></i> Contrôlé dans le budget
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div>
                        <div class="stat-title">Dossiers actifs</div>
                        <div class="stat-value" id="activeFiles">{{ $dossiersActifs }}</div>
                        <div class="trend-up">
                            <i class="fas fa-arrow-up"></i> <span id="newFiles">{{ $nouveauxDossiers }}</span> nouveaux ce mois-ci
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="card-header">
                    <h2 class="card-title">Chiffre d'affaire (HT)</h2>
                    <div class="header-actions">
                        <button class="secondary-btn" style="padding: 6px 12px;" id="caYearBtn">
                            <i class="fas fa-calendar"></i> <span id="currentYear">{{ now()->year }}</span>
                        </button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="chartCa"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="card-header">
                    <h2 class="card-title">Nombre de dossiers</h2>
                    <div class="header-actions">
                        <button class="secondary-btn" style="padding: 6px 12px;" id="filterBtn">
                            <i class="fas fa-filter"></i> Tous
                        </button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="chartDossiers"></canvas>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-card">
            <div class="card-header">
                <h2 class="card-title">Statistiques par Assurance</h2>
                <button class="secondary-btn" style="padding: 6px 12px;" id="exportTableBtn">
                    <i class="fas fa-download"></i> Exporter Excel
                </button>
            </div>

            <div class="overflow-x-auto">
                <table id="insuranceTable">
                    <thead>
                        <tr>
                            <th>Assurance</th>
                            <th>Part €</th>
                            <th>Part %</th>
                            <th>Panier moyen</th>
                            <th>Évolution</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPartEuro = $statsParAssurance->sum('part_euro');
                        @endphp

                        @foreach($statsParAssurance as $assurance)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div class="insurance-icon">
                                        @switch($assurance->nom_assurance)
                                            @case('MACIF') <i class="fas fa-building"></i> @break
                                            @case('MATMUT') <i class="fas fa-shield-alt"></i> @break
                                            @case('GROUPAMA') <i class="fas fa-umbrella"></i> @break
                                            @case('MMA') <i class="fas fa-home"></i> @break
                                            @case('AXA') <i class="fas fa-car"></i> @break
                                            @default <i class="fas fa-shield-alt"></i>
                                        @endswitch
                                    </div>
                                    {{ $assurance->nom_assurance }}
                                </div>
                            </td>
                            <td>{{ number_format($assurance->part_euro ?? 0, 0, ',', ' ') }} €</td>
                            <td>
                                @php
                                    $partPercentage = $totalPartEuro > 0 ? ($assurance->part_euro / $totalPartEuro) * 100 : 0;
                                @endphp
                                <div>{{ number_format($partPercentage, 1) }}%</div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $partPercentage }}%"></div>
                                </div>
                            </td>
                            <td>{{ number_format($assurance->panier_moyen ?? 0, 0, ',', ' ') }} €</td>
                            <td class="trend-up">+{{ number_format(rand(5, 15)/10, 1) }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour exporter en PDF
        function exportToPDF() {
            const spinner = document.getElementById('loadingSpinner');
            spinner.style.display = 'flex';

            setTimeout(() => {
                // Utilisation de html2canvas pour capturer le dashboard
                html2canvas(document.querySelector('.dashboard-container')).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                    const imgProps = pdf.getImageProperties(imgData);
                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                    pdf.save('tableau-de-bord-' + new Date().toISOString().slice(0, 10) + '.pdf');

                    spinner.style.display = 'none';
                }).catch(error => {
                    console.error('Erreur lors de la génération du PDF:', error);
                    spinner.style.display = 'none';
                    alert('Une erreur est survenue lors de l\'export PDF');
                });
            }, 500);
        }

        // Fonction pour exporter le tableau en Excel
        function exportTableToExcel() {
            const table = document.getElementById('insuranceTable');
            const wb = XLSX.utils.book_new();

            // Préparer les données du tableau
            const data = [];
            const headers = [];

            // Récupérer les en-têtes
            table.querySelectorAll('th').forEach(th => {
                headers.push(th.innerText);
            });
            data.push(headers);

            // Récupérer les lignes de données
            table.querySelectorAll('tbody tr').forEach(tr => {
                const row = [];
                tr.querySelectorAll('td').forEach((td, index) => {
                    // Pour la colonne de pourcentage, prendre juste la valeur numérique
                    if (index === 2) {
                        const percentValue = td.querySelector('div:first-child').innerText;
                        row.push(percentValue.replace('%', ''));
                    } else {
                        row.push(td.innerText);
                    }
                });
                data.push(row);
            });

            // Créer la feuille Excel
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, 'Statistiques');

            // Exporter le fichier
            XLSX.writeFile(wb, 'statistiques-assurances-' + new Date().toISOString().slice(0, 10) + '.xlsx');
        }

        // Fonction utilitaire pour formater les montants
        function formatCurrency(value) {
            return new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: 'EUR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(value);
        }

        // Initialisation des graphiques avec les données Laravel
        document.addEventListener('DOMContentLoaded', function() {
            // CA Chart
            const caCtx = document.getElementById('chartCa').getContext('2d');
            const caChart = new Chart(caCtx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'CA (€)',
                        data: @json($data),
                        borderColor: '#FF4B00',
                        backgroundColor: 'rgba(255, 75, 0, 0.05)',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#FF4B00',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(45, 55, 72, 0.95)',
                            padding: 12,
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 14
                            },
                            callbacks: {
                                label: function(context) {
                                    return `CA: ${formatCurrency(context.parsed.y)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return formatCurrency(value);
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Dossiers Chart
            const dossiersCtx = document.getElementById('chartDossiers').getContext('2d');
            const dossiersChart = new Chart(dossiersCtx, {
                type: 'bar',
                data: {
                    labels: @json($dossiersLabels),
                    datasets: [{
                        label: 'Dossiers',
                        data: @json($dossiersData),
                        backgroundColor: 'rgba(255, 75, 0, 0.7)',
                        borderColor: 'rgba(255, 75, 0, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                        hoverBackgroundColor: 'rgba(255, 75, 0, 0.9)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.5)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Animation des barres de progression
            document.querySelectorAll('.progress-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });

            // Gestionnaire d'événements pour le bouton Actualiser
            document.getElementById('refreshBtn').addEventListener('click', function() {
                const spinner = document.getElementById('loadingSpinner');
                spinner.style.display = 'flex';
                this.querySelector('i').classList.add('fa-spin');

                setTimeout(() => {
                    location.reload();
                }, 500);
            });

            // Gestionnaire d'événements pour le bouton Exporter PDF
            document.getElementById('exportBtn').addEventListener('click', function() {
                // Animation de confirmation
                this.classList.add('primary-btn');
                setTimeout(() => {
                    this.classList.remove('primary-btn');
                }, 2000);

                exportToPDF();
            });

            // Gestionnaire d'événements pour le bouton Exporter Excel
            document.getElementById('exportTableBtn').addEventListener('click', function() {
                // Animation de confirmation
                this.classList.add('primary-btn');
                setTimeout(() => {
                    this.classList.remove('primary-btn');
                }, 2000);

                exportTableToExcel();
            });
        });
    </script>
</body>
</html>
@endsection
