@extends('layout')

@section('content')
<div class="flex h-screen">
    {{-- Sidebar --}}
    @include('emails.partials.sidebar')

    {{-- Sent Emails Content --}}
    <div class="flex-1 p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Emails envoyés</h1>
        </div>

        {{-- Search bar --}}
        <div class="mb-6">
            <input type="text" placeholder="Rechercher..." class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        {{-- Email list --}}
        <div class="bg-white rounded shadow overflow-hidden">
            @forelse($emails as $email)
                <div class="group flex items-center justify-between px-6 py-4 border-b hover:bg-gray-50 transition">

                    {{-- Left section: Star + subject + tag --}}
                    <div class="flex items-center gap-4">
                        {{-- Star (important toggle) --}}
                        <form method="POST" action="{{ route('emails.toggleImportant', $email->id) }}">
                            @csrf
                            <button type="submit" title="Important" class="focus:outline-none">
                                <i class="fas fa-star text-xl transition
                                    {{ $email->tag === 'important' ? 'text-yellow-400' : 'text-gray-300 group-hover:text-yellow-400' }}"></i>
                            </button>
                        </form>

                        {{-- Email Subject (clickable) --}}
                        <a href="{{ route('emails.show', $email->id) }}"
                           class="font-medium text-gray-800 hover:underline">
                            {{ $email->subject }}
                        </a>

                        {{-- Tag --}}
                        @if($email->tag)
                            <span class="text-xs px-3 py-1 rounded-full font-semibold text-white"
                                  style="background-color: {{ $email->tag_color ?? '#999' }}">
                                {{ ucfirst($email->tag) }}
                            </span>
                        @endif
                    </div>

                    {{-- Right section: Move to Trash --}}
                    <div class="flex gap-4 items-center text-gray-500">
                        <form method="POST" action="{{ route('emails.moveToTrash', $email->id) }}">
                            @csrf
                            <button type="submit" title="Mettre à la corbeille">
                                <i class="fas fa-trash hover:text-red-500"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-10">Aucun email envoyé.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection