<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function create()
{
    return view('clients.create');
}

public function index()
{
    $clients = \App\Models\Client::latest()->get();
    return view('clients.index', compact('clients'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nom_assure' => 'required|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string|max:255',
        'code_postal' => 'nullable|string|max:10',
        'ville' => 'nullable|string|max:100',
        'plaque' => 'nullable|string|max:20',
        'nom_assurance' => 'nullable|string|max:255',
        'autre_assurance' => 'nullable|string|max:255',
        'numero_police' => 'nullable|string|max:100',
        'date_sinistre' => 'nullable|date',
        'date_declaration' => 'nullable|date',
        'raison' => 'nullable|string|max:255',
        'type_vitrage' => 'nullable|string|max:255',
        'professionnel' => 'nullable|string|max:255',
        'photo_vitrage' => 'nullable|image|max:2048',
        'photo_carte_verte' => 'nullable|image|max:2048',
        'photo_carte_grise' => 'nullable|image|max:2048',
        'type_cadeau' => 'nullable|string|max:255',
        'numero_sinistre' => 'nullable|string|max:255',
        'kilometrage' => 'nullable|string|max:255',
        'connu_par' => 'nullable|string|max:255',
        'adresse_pose' => 'nullable|string|max:255',
        'reference_interne' => 'nullable|string|max:255',
        'reference_client' => 'nullable|string|max:255',
        'precision' => 'nullable|string',
    ]);

    // Handle checkbox
    $validated['ancien_modele_plaque'] = $request->has('ancien_modele_plaque');
    $validated['reparation'] = $request->has('reparation');

    // File uploads
    foreach (['photo_vitrage', 'photo_carte_verte', 'photo_carte_grise'] as $field) {
        if ($request->hasFile($field)) {
            $validated[$field] = $request->file($field)->store('uploads', 'public');
        }
    }

    Client::create($validated);

    return redirect()->route('clients.create')->with('success', 'Dossier client créé avec succès.');
}
public function rdvs()
{
    return $this->hasMany(\App\Models\Rdv::class);
}
}

