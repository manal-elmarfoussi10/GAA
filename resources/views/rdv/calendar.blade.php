@extends('layout')

@section('content')
<div class="px-6 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Calendrier</h1>
        <button id="openModal" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded shadow text-sm">
            + Ajouter
        </button>
    </div>

    <!-- Calendar -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <div id="calendar"></div>
    </div>
</div>

<!-- FullCalendar CSS/JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '{{ route('rdv.events') }}',

            eventClick: function(info) {
                const event = info.event;
                const props = event.extendedProps;

                document.getElementById('edit-id').value = event.id;
                document.getElementById('edit-technicien').value = props.technicien || '';
                document.getElementById('edit-client-id').value = props.client_id || '';
                document.getElementById('edit-start-time').value = event.startStr;
                document.getElementById('edit-end-time').value = event.endStr;
                document.getElementById('edit-ga-gestion').checked = !!props.ga_gestion;
                document.getElementById('edit-indisponible').checked = !!props.indisponible_poseur;

                document.getElementById('editForm').action = `/rdv/${event.id}`;
                document.getElementById('editModal').classList.remove('hidden');
            }
        });

        calendar.render();
    });
</script>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-xl relative">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">

            <h2 class="text-lg font-semibold text-orange-600 mb-4">Modifier le RDV</h2>

            <input type="text" name="technicien" id="edit-technicien" class="form-input mb-3" placeholder="Technicien">

            <select name="client_id" id="edit-client-id" class="form-input mb-3">
                @foreach(\App\Models\Client::all() as $client)
                    <option value="{{ $client->id }}">{{ $client->nom_assure }}</option>
                @endforeach
            </select>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <input type="datetime-local" name="start_time" id="edit-start-time" class="form-input">
                <input type="datetime-local" name="end_time" id="edit-end-time" class="form-input">
            </div>

            <div class="flex items-center gap-4 mb-4">
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="ga_gestion" id="edit-ga-gestion"> GA GESTION
                </label>
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="indisponible_poseur" id="edit-indisponible"> Indisponible
                </label>
            </div>

            <div class="flex justify-between mt-4">
                <button type="button" onclick="deleteRdv()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Supprimer
                </button>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                    Enregistrer
                </button>
            </div>
        </form>

        <button onclick="document.getElementById('editModal').classList.add('hidden')" class="absolute top-2 right-3 text-gray-500 text-xl hover:text-black">&times;</button>
    </div>
</div>

<!-- Add Modal -->
<div id="rdvModal" class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-2xl relative">
        <button id="closeModal" class="absolute top-3 right-4 text-gray-400 text-xl hover:text-black">&times;</button>

        <h2 class="text-xl font-bold text-orange-500 mb-6">Nouvelle date de RDV</h2>

        <form action="{{ route('rdv.store') }}" method="POST">
            @csrf

            <input type="text" name="technicien" placeholder="Technicien" class="form-input mb-4" required>

            <select name="client_id" class="form-input mb-4" required>
                <option value="">Sélectionner le dossier...</option>
                @foreach(\App\Models\Client::all() as $client)
                    <option value="{{ $client->id }}">{{ $client->nom_assure }} ({{ $client->plaque }})</option>
                @endforeach
            </select>

            <div class="flex items-center mb-4">
                <input type="checkbox" name="indisponible_poseur" id="indisponible" class="mr-2">
                <label for="indisponible" class="text-sm text-cyan-700">Rendre indisponible le poseur</label>
            </div>

            <div class="flex items-center mb-4">
                <input type="checkbox" name="ga_gestion" id="ga_gestion" class="mr-2">
                <label for="ga_gestion" class="text-sm font-medium">Dossier avec <strong>GA GESTION</strong> (1 jeton)</label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm mb-1">Début du créneau</label>
                    <input type="datetime-local" name="start_time" class="form-input" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Fin du créneau</label>
                    <input type="datetime-local" name="end_time" class="form-input" required>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded shadow">
                    Valider
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal JS -->
<script>
    document.getElementById('openModal').addEventListener('click', () => {
        document.getElementById('rdvModal').classList.remove('hidden');
    });
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('rdvModal').classList.add('hidden');
    });

    function deleteRdv() {
        const id = document.getElementById('edit-id').value;
        if (confirm('Confirmer la suppression ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/rdv/${id}`;

            const token = document.createElement('input');
            token.name = '_token';
            token.value = '{{ csrf_token() }}';

            const method = document.createElement('input');
            method.name = '_method';
            method.value = 'DELETE';

            form.appendChild(token);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<style>
    .form-input {
        @apply w-full px-4 py-2 border border-gray-300 rounded focus:ring-orange-500 focus:border-orange-500 focus:outline-none;
    }
</style>
@endsection