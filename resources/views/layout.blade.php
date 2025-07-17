<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GG AUTO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN (or use Laravel Mix) -->
    <!-- FontAwesome Free -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome Pro CDN -->
<script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100 min-h-screen">

   <!-- Sidebar -->
<aside class="w-64 bg-white shadow-md min-h-screen">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-center mb-2">
            <img src="{{ asset('images/GA GESTION LOGO.png') }}" alt="Logo Project France" class="h-16 w-auto" />
        </div>
    </div>
    <nav class="p-4 text-sm text-gray-700 space-y-2">

        <!-- Main Links with Icons -->
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100 font-medium">
            🏠 <span>Tableau de bord</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            ➕ <span>Nouveau client</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            👥 <span>Gestion clients</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            📅 <span>Calendrier</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            📄 <span>Devis</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            🧾 <span>Factures</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            ♻️ <span>Avoirs</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            💸 <span>Dépenses / achats</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            📦 <span>Bons de commandes</span>
        </a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">
            🔔 <span>Mes Notifications</span>
        </a>

        <!-- Voir Plus Toggle Button -->
        <button onclick="document.getElementById('moreLinks').classList.toggle('hidden')"
                class="w-full text-left py-2 px-4 rounded hover:bg-orange-100 flex items-center gap-2 text-blue-600">
            ➕ <span>Voir plus</span>
        </button>

        <!-- Hidden Links -->
        <div id="moreLinks" class="hidden space-y-2 pt-2">
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">📥 <span>Recouvrements</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">🔧 <span>Sidexa</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">📦 <span>Stocks</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">🧰 <span>Poseurs</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">🚚 <span>Fournisseurs</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">📋 <span>Produits</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">💬 <span>Messages</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">💰 <span>Acheter des unités</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">👤 <span>Mes utilisateurs</span></a>
            <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">📊 <span>Ma consommation</span></a>
        </div>

        <hr class="my-2 border-t border-gray-200">

        <!-- Settings and Logout -->
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">⚙️ <span>Settings</span></a>
        <a href="#" class="flex items-center gap-2 py-2 px-4 rounded hover:bg-orange-100">🚪 <span>Logout</span></a>
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
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405M15 17V9a3 3 0 00-6 0v8m0 0H4l1.405 1.405" />
                    </svg>
                </button>
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
    @yield('scripts')
</body>
</html>