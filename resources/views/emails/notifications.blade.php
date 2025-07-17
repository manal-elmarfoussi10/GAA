@extends('layout')

@section('content')
<div class="flex h-screen">
    {{-- Sidebar --}}
  
    {{-- Main Content --}}
    <div class="flex-1 p-8 overflow-y-auto">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Mes Notifications</h1>
            <form method="POST" action="{{ route('emails.markAllRead') }}">
                @csrf
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                    Marquer toutes les notifications en lu
                </button>
            </form>
        </div>

        {{-- Email cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($emails as $email)
                <a href="{{ route('emails.show', $email->id) }}" class="block bg-white shadow rounded-lg hover:shadow-md transition">
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{ $email->subject }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                            {!! strip_tags($email->content) !!}
                        </p>
                        <div class="flex justify-between items-center text-xs text-gray-500 mt-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($email->sender_name ?? 'U', 0, 1)) }}
                                </div>
                                <span>{{ $email->sender_name ?? 'Utilisateur' }}</span>
                            </div>
                            <span>{{ \Carbon\Carbon::parse($email->created_at)->format('M d H:i') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-10">
                    Aucune notification d’email reçue.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection