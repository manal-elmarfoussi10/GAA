@extends('layout')

@section('content')
<div class="flex h-screen">
    {{-- Sidebar --}}
    @include('emails.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 overflow-y-auto p-6 space-y-8">

        {{-- 📧 Original Email --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $email->subject }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 text-sm mb-2">
                <div><strong>De :</strong> {{ $email->sender_name ?? 'N/A' }}</div>
                <div class="text-right"><strong>Date :</strong> {{ \Carbon\Carbon::parse($email->created_at)->format('d/m/Y H:i') }}</div>
            </div>

            <div class="prose max-w-none text-gray-800 mb-4">
                {!! $email->content !!}
            </div>

            @if($email->file_path)
                <div class="mt-4">
                    <p class="text-sm font-semibold text-gray-700 mb-1">📎 Pièce jointe :</p>
                    <a href="{{ asset('storage/' . $email->file_path) }}"
                       target="_blank"
                       class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded hover:bg-gray-200">
                        {{ $email->file_name ?? basename($email->file_path) }}
                    </a>
                </div>
            @endif
        </div>

        {{-- 📨 Replies --}}
        @if($email->replies && $email->replies->count())
            <div class="space-y-4">

                @foreach($email->replies as $reply)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center text-sm text-blue-700 mb-2">
                           
                            <div>{{ \Carbon\Carbon::parse($reply->created_at)->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="prose max-w-none text-gray-800">
                            {!! $reply->content !!}
                        </div>

                        @if($reply->file_path)
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $reply->file_path) }}"
                                   target="_blank"
                                   class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                                    📎 {{ $reply->file_name }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ✍️ Reply Form --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Répondre à l’email</h3>

            {{-- Show validation errors --}}
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 p-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('emails.reply', $email->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea id="content" name="content" rows="6"
                              class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('content') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ajouter une pièce jointe</label>
                    <input type="file" name="file"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0 file:text-sm file:font-semibold
                                  file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                </div>

                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded">
                    Envoyer la réponse
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.25.1/full/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('content')) {
            CKEDITOR.replace('content', {
                toolbar: 'Full',
                height: 150,
                versionCheck: false
            });
        }
    });
</script>
@endsection