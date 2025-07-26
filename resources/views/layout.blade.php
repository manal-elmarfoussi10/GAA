<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GG AUTO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome & Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .ring-orange-custom {
            --tw-ring-color: #FF4B00;
        }
    </style>
</head>
<body class="flex min-h-screen bg-gray-100 font-sans text-sm text-gray-800">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md flex flex-col">
    @php $role = auth()->user()->role ?? ''; @endphp
    @includeIf('layouts.sidebars.' . $role)
</aside>

<!-- Main Content -->
<div class="flex-1 flex flex-col">

   <nav class="bg-white px-4 py-3 flex justify-between items-center shadow text-sm">

    <!-- Barre de recherche  -->
    <div class="relative w-40">
        <input type="text"
               placeholder="Rechercher..."
               class="w-full pl-8 pr-6 py-1.5 rounded border border-[#FF4B00] bg-white text-gray-700 placeholder:text-gray-500 focus:outline-none focus:ring ring-orange-custom">
        <div class="absolute inset-y-0 left-2 flex items-center pointer-events-none">
            <i class="fas fa-search text-[#FF4B00] text-xs"></i>
        </div>
        <div class="absolute inset-y-0 right-2 flex items-center">
            <div class="bg-[#FFF1E8] text-[#FF4B00] text-[10px] px-1 py-0.5 rounded font-semibold">
                ⌘
            </div>
        </div>
    </div>

    <!-- Navigation + Infos utilisateur -->
    <div class="flex items-center gap-1.5 font-medium">

        @php
            $navItems = [
                ['label' => 'FONCTIONNALITÉS', 'route' => 'fonctionnalites'],
                ['label' => 'CONTACT', 'route' => 'contact'],
                ['label' => 'MON COMPTE', 'route' => 'profile'],
                ['label' => 'DASHBOARD', 'route' => 'dashboard'],
            ];
        @endphp

        @foreach ($navItems as $item)
            @php $isActive = request()->is($item['route'].'*'); @endphp
            <a href="{{ url($item['route']) }}"
               class="px-2 py-1 rounded transition duration-150 focus:outline-none focus:ring-2 focus:ring-[#FF4B00]
                      {{ $isActive ? 'bg-[#FF4B00] text-white' : 'text-[#FF4B00] hover:bg-[#FFA366] hover:text-white' }}">
                {{ $item['label'] }}
            </a>
        @endforeach

        <!-- Unités -->
        @php $isUnit = request()->is('acheter-unites'); @endphp
        <a href="{{ url('/acheter-unites') }}"
           class="px-2 py-1 rounded transition duration-150 focus:outline-none focus:ring-2 focus:ring-[#FF4B00]
                  {{ $isUnit ? 'bg-[#FF4B00] text-white' : 'text-[#FF4B00] hover:bg-[#FFA366] hover:text-white' }}">
            NB UNITÉS : {{ session('unit_count', '0.00') }}
        </a>

        <!-- Notifications -->
        <button class="ml-1 focus:outline-none focus:ring-2 focus:ring-[#FF4B00] rounded-full">
            <i data-lucide="bell" class="w-4 h-4 text-[#FF4B00]"></i>
        </button>

        <!-- Avatar + nom -->
        @php $user = auth()->user(); @endphp
        <a href="{{ route('mon-compte') }}" class="flex items-center gap-1 ml-2 hover:opacity-80 transition max-w-[140px]">
            @if ($user && $user->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->photo))
                <img src="{{ asset('storage/' . $user->photo) }}"
                     alt="Photo de profil"
                     class="h-7 w-7 rounded-full object-cover border-2 border-[#FF4B00] shadow" />
            @else
                <div class="h-7 w-7 bg-[#FF4B00] text-white rounded-full flex items-center justify-center font-bold text-xs uppercase">
                    {{ strtoupper($user->name[0] ?? 'U') }}
                </div>
            @endif
            <span class="text-[#FF4B00] truncate text-sm">
                {{ $user->name ?? 'Utilisateur' }}
            </span>
        </a>
    </div>
</nav>


    <!-- Main -->
    <main class="p-6">
        @yield('content')
    </main>
</div>

<script>
    lucide.createIcons();
</script>

@yield('scripts')
</body>
</html>
