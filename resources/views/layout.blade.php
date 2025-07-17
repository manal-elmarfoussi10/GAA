<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GG AUTO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="flex bg-gray-100 min-h-screen">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md min-h-screen flex flex-col">
    <div class="p-6 border-b border-gray-200">
        <img src="{{ asset('images/GA GESTION LOGO.png') }}" alt="GG AUTO Logo" class="h-6" />
    </div>

    <nav class="flex-1 overflow-y-auto text-sm text-gray-700">
        <ul class="space-y-1 px-2 py-4">
            <li>
                <a href="{{ route('clients.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('clients.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="users" class="w-4 h-4"></i> Gestion clients
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Tableau de bord
                </a>
            </li>
            <li>
                <a href="{{ route('clients.create') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('clients.create') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Nouveau client
                </a>
            </li>
            <li>
                <a href="{{ route('rdv.calendar') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('rdv.calendar') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="calendar" class="w-4 h-4"></i> Calendrier
                </a>
            </li>
            <li>
                <a href="{{ route('devis.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('devis.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="file-text" class="w-4 h-4"></i> Devis
                </a>
            </li>
            <li>
                <a href="{{ route('factures.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('factures.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="file" class="w-4 h-4"></i> Factures
                </a>
            </li>
            <li>
                <a href="{{ route('avoirs.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('avoirs.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Avoirs
                </a>
            </li>
            <li>
                <a href="{{ route('paiement.create', ['facture' => 1]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('paiement.*') || request()->routeIs('paiements.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="credit-card" class="w-4 h-4"></i> Dépenses / achats
                </a>
            </li>
            <li>
                <a href="{{ route('bons-de-commande.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('bons-de-commande.*') ? 'bg-[#FF4B00] text-white font-semibold' : 'hover:bg-orange-100 text-gray-700' }}">
                    <i data-lucide="package" class="w-4 h-4"></i> Bons de commandes
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100 text-gray-700">
                    <i data-lucide="bell" class="w-4 h-4"></i> Mes Notifications
                </a>
            </li>
        </ul>

        <!-- Bouton Voir plus -->
        <button onclick="document.getElementById('extraMenu').classList.toggle('hidden')"
                class="flex items-center gap-2 px-3 py-2 w-full text-left hover:bg-orange-100 text-orange-600 font-medium">
            <i data-lucide="chevron-down" class="w-4 h-4"></i> Voir plus
        </button>

        <!-- Menu caché -->
        <div id="extraMenu" class="hidden">
            <ul class="space-y-1 px-2 py-2 text-gray-500">
                <li><a href="{{ route('fournisseurs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="truck" class="w-4 h-4"></i> Fournisseurs</a></li>

                <li><a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i> Produits</a></li>

                <li><a href="{{ route('poseurs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="hammer" class="w-4 h-4"></i> Poseurs</a></li>

                <li><a href="{{ route('stocks.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="layers" class="w-4 h-4"></i> Stocks</a></li>

                <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="user-check" class="w-4 h-4"></i> Recouvrements</a></li>

                <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="message-square" class="w-4 h-4"></i> Messages</a></li>

                <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i> Acheter des unités</a></li>

                <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="users" class="w-4 h-4"></i> Mes utilisateurs</a></li>

                <li><a href="#" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100">
                    <i data-lucide="bar-chart-2" class="w-4 h-4"></i> Ma consommation</a></li>
            </ul>
        </div>

        <ul class="space-y-1 px-2 py-2 border-t border-gray-200">
            <li><a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100"><i data-lucide="settings" class="w-4 h-4"></i> Paramètres</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-orange-100"><i data-lucide="log-out" class="w-4 h-4"></i> Déconnexion</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 flex flex-col">

    <!-- Top Bar -->
    <header class="flex items-center justify-between bg-white shadow px-6 py-4">
        <div class="w-1/2">
            <input type="text" placeholder="Rechercher..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
        </div>
        <div class="flex items-center gap-4">
            <button><i data-lucide="lock" class="h-5 w-5 text-gray-500"></i></button>
            <div class="flex items-center space-x-2">
                <div class="h-8 w-8 bg-gray-300 rounded-full"></div>
                <span class="text-gray-700 font-medium">Harsh</span>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="p-6">
        @yield('content')
    </main>

</div>

<!-- Init Lucide Icons -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
