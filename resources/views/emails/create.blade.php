@extends('layout')

@section('content')
<div class="flex h-screen">
    {{-- Sidebar --}}
    @include('emails.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-8 overflow-y-auto bg-gray-50">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
                    <strong>Erreur(s) :</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('emails.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Hidden Receiver -->
                <input type="hidden" name="receiver" value="support@yourdomain.com" />

                <!-- Sender Name -->
                <div>
                    <label for="sender" class="block font-medium text-gray-700 mb-1">Nom :</label>
                    <input type="text" name="sender" id="sender"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-orange-500 focus:border-orange-500"
                           placeholder="Votre nom" value="{{ old('sender') }}">
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block font-medium text-gray-700 mb-1">Objet :</label>
                    <input type="text" name="subject" id="subject"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-orange-500 focus:border-orange-500"
                           placeholder="Objet de l’email" value="{{ old('subject') }}">
                </div>

                <!-- Content (CKEditor) -->
                <div>
                    <label for="content" class="block font-medium text-gray-700 mb-1">Contenu :</label>
                    <textarea name="content" id="content"
                              class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-orange-500 focus:border-orange-500"
                              placeholder="Votre message ici...">{{ old('content') }}</textarea>
                </div>

                <!-- File Upload -->
                <div>
                    <label for="file" class="block font-medium text-gray-700 mb-1">Fichier :</label>
                    <input type="file" name="file" id="file"
                           class="w-full border border-gray-300 rounded px-4 py-2 file:bg-orange-500 file:text-white file:font-semibold file:rounded file:border-none">
                </div>

                <!-- Filename -->
                <div>
                    <label for="filename" class="block font-medium text-gray-700 mb-1">Nom du fichier :</label>
                    <input type="text" name="filename" id="filename"
                           class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-orange-500 focus:border-orange-500"
                           placeholder="Nom du fichier" value="{{ old('filename') }}">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- CKEditor Integration --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('content')) {
                CKEDITOR.replace('content', {
                    toolbar: 'Full',
                    height: 100,
                    versionCheck: false // ✅ Disable the warning
                });
            }
        });
    </script>
@endsection