<?php

namespace App\Http\Controllers;

use App\Models\Rdv;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class RdvController extends Controller
{
    public function calendar()
    {
        return view('rdv.calendar');
    }

    public function events()
    {
        $events = Rdv::with('client')->get()->map(function ($rdv) {
            return [
                'title' => $rdv->technicien . ' / ' . optional($rdv->client)->nom_assure,
                'start' => $rdv->start_time,
                'end' => $rdv->end_time,
                'color' => $rdv->ga_gestion ? '#FF9800' : '#00BCD4',
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'technicien' => 'required|string|max:255',
        'client_id' => 'required|exists:clients,id',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
    ]);

    $data['indisponible_poseur'] = $request->has('indisponible_poseur');
    $data['ga_gestion'] = $request->has('ga_gestion');

    Rdv::create($data);

    return redirect()->route('rdv.calendar')->with('success', 'RDV enregistré avec succès.');
}

public function update(Request $request, $id)
{
    $rdv = Rdv::findOrFail($id);

    $data = $request->validate([
        'technicien' => 'required|string|max:255',
        'client_id' => 'required|exists:clients,id',
        'start_time' => 'required|date',
        'end_time' => 'required|date',
        'ga_gestion' => 'nullable|boolean',
        'indisponible_poseur' => 'nullable|boolean',
    ]);

    $data['ga_gestion'] = $request->has('ga_gestion');
    $data['indisponible_poseur'] = $request->has('indisponible_poseur');

    $rdv->update($data);

    return redirect()->route('rdv.calendar')->with('success', 'RDV mis à jour.');
}

public function destroy($id)
{
    Rdv::findOrFail($id)->delete();
    return redirect()->route('rdv.calendar')->with('success', 'RDV supprimé');
}

}
