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

    <!-- Header  -->
    <nav class="bg-white px-6 py-4 flex justify-between items-center shadow">

        <!-- Search bar -->
        <div class="relative w-80">
            <input type="text"
                   placeholder="Rechercher..."
                   class="w-full pl-10 pr-10 py-2 rounded-lg border border-[#FF4B00] bg-white text-gray-700 placeholder:text-gray-500 focus:outline-none focus:ring ring-orange-custom transition duration-150">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-[#FF4B00]"></i>
            </div>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <div class="bg-[#FFF1E8] text-[#FF4B00] text-sm px-2 py-0.5 rounded font-semibold">
                    ⌘
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-2 font-semibold">
            @php
                $navItems = [
                    ['label' => 'FONCTIONNALITÉS', 'route' => 'fonctionnalites'],
                    ['label' => 'CONTACT', 'route' => 'contact'],
                    ['label' => 'MON COMPTE', 'route' => 'profile'],
                    ['label' => 'DASHBOARD', 'route' => 'dashboard'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php
                    $isActive = request()->is($item['route'].'*');
                @endphp
                <a href="{{ url($item['route']) }}"
                   class="px-4 py-2 rounded-md transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-[#FF4B00]
                          {{ $isActive
                              ? 'bg-[#FF4B00] text-white'
                              : 'text-[#FF4B00] hover:bg-[#FFA366] hover:text-white' }}"
                   aria-current="{{ $isActive ? 'page' : false }}">
                    {{ $item['label'] }}
                </a>
            @endforeach

            <!-- Unit Count -->
            @php $isUnit = request()->is('acheter-unites'); @endphp
            <a href="{{ url('/acheter-unites') }}"
               class="px-4 py-2 rounded-md transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-[#FF4B00]
                      {{ $isUnit ? 'bg-[#FF4B00] text-white' : 'text-[#FF4B00] hover:bg-[#FFA366] hover:text-white' }}"
               aria-current="{{ $isUnit ? 'page' : false }}">
                NB UNITÉS : {{ session('unit_count', '0.00') }}
            </a>

            <!-- Notifications -->
            <button class="ml-2 focus:outline-none focus:ring-2 focus:ring-[#FF4B00] rounded-full">
                <i data-lucide="bell" class="w-5 h-5 text-[#FF4B00]"></i>
            </button>

            <!-- Avatar + nom avec lien vers mon compte -->
            @php
                $user = auth()->user();
            @endphp

            <a href="{{ route('mon-compte') }}" class="flex items-center gap-2 ml-2 hover:opacity-80 transition">
                @if ($user && $user->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->photo))
                    <img src="{{ asset('storage/' . $user->photo) }}"
                         alt="Photo de profil"
                         class="h-8 w-8 rounded-full object-cover border-2 border-[#FF4B00] shadow" />
                @else
                    <div class="h-8 w-8 bg-[#FF4B00] text-white rounded-full flex items-center justify-center font-bold uppercase">
                        {{ strtoupper($user->name[0] ?? 'U') }}
                    </div>
                @endif
                <span class="text-[#FF4B00] font-medium truncate max-w-[120px]">
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
