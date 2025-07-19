<?php

namespace App\Http\Controllers;

use App\Models\Poseur;
use Illuminate\Http\Request;

class PoseurController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    
    // Get counts for stats cards
    $totalPoseurs = Poseur::count();
    $activePoseurs = Poseur::where('actif', true)->count();
    
    $poseurs = Poseur::query()
        ->when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('telephone', 'like', "%{$search}%");
        })
        ->orderBy('nom')
        ->paginate(10); // Paginate with 10 items per page

    return view('poseurs.index', compact('poseurs', 'search', 'totalPoseurs', 'activePoseurs'));
}

    public function create()
    {
        return view('poseurs.create');
    }

    public function store(Request $request)
    {
        // Force valeurs de checkbox pour éviter erreur validation
        $request->merge([
            'actif' => $request->has('actif'),
        ]);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'mot_de_passe' => 'nullable|string|max:255',
            'actif' => 'boolean',
            'couleur' => 'nullable|string|max:50',
            'rue' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'ville' => 'nullable|string|max:100',
            'info' => 'nullable|string',
            'departements' => 'nullable|array',
        ]);

        // Encode les départements en JSON
        $data['departements'] = json_encode($data['departements'] ?? []);

        Poseur::create($data);

        return redirect()->route('poseurs.index')->with('success', 'Poseur ajouté avec succès.');
    }

    public function edit(Poseur $poseur)
    {
        return view('poseurs.edit', compact('poseur'));
    }

    public function update(Request $request, Poseur $poseur)
    {
        $request->merge([
            'actif' => $request->has('actif'),
        ]);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'mot_de_passe' => 'nullable|string|max:255',
            'actif' => 'boolean',
            'couleur' => 'nullable|string|max:50',
            'rue' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'ville' => 'nullable|string|max:100',
            'info' => 'nullable|string',
            'departements' => 'nullable|array',
        ]);

        $data['departements'] = json_encode($data['departements'] ?? []);

        $poseur->update($data);

        return redirect()->route('poseurs.index')->with('success', 'Poseur modifié avec succès.');
    }

    public function destroy(Poseur $poseur)
    {
        $poseur->delete();

        return redirect()->route('poseurs.index')->with('success', 'Poseur supprimé.');
    }
}