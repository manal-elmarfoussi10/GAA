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

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="flex bg-gray-100 min-h-screen">

<!-- Sidebar -->

<aside class="w-64 bg-white shadow-md min-h-screen flex flex-col">
    @php $role = auth()->user()->role ?? ''; @endphp

    @includeIf('layouts.sidebars.' . $role)
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
@yield('scripts')

    </div>
    @yield('scripts')
</body>
</html>
