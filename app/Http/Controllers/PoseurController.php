<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervention;
use App\Models\Photo;
use App\Models\Commentaire;

class PoseurController extends Controller
{
    public function dashboard()
    {
        if (!auth()->user()->isRole('poseur')) {
            abort(403, 'Accès interdit');
        }

        $interventions = Intervention::with('dossier.client')
            ->where('poseur_id', auth()->id())
            ->get();

        return view('dashboardposeur', compact('interventions'));
    }

    public function commenter(Request $request, $id)
    {
        if (!auth()->user()->isRole('poseur')) {
            abort(403, 'Accès interdit');
        }

        $request->validate([
            'commentaire' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $intervention = Intervention::where('poseur_id', auth()->id())->findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('interventions', 'public');
            Photo::create([
                'intervention_id' => $intervention->id,
                'url' => $path,
                'commentaire' => $request->commentaire,
            ]);
        } elseif ($request->commentaire) {
            Commentaire::create([
                'intervention_id' => $intervention->id,
                'user_id' => auth()->id(),
                'contenu' => $request->commentaire,
            ]);
        }

        return back()->with('success', 'Ajout effectué');
    }
}
