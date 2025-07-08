<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_societe' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'categorie' => 'nullable|string',

            // Arrays for address and contact
            'adresse_nom.*' => 'nullable|string',
            'adresse_rue.*' => 'nullable|string',
            'adresse_cp.*' => 'nullable|string',
            'adresse_ville.*' => 'nullable|string',
            'adresse_facturation.*' => 'nullable|boolean',
            'adresse_livraison.*' => 'nullable|boolean',
            'adresse_devis.*' => 'nullable|boolean',

            'contact_nom.*' => 'nullable|string',
            'contact_email.*' => 'nullable|email',
            'contact_telephone.*' => 'nullable|string',
        ]);

        $data = [
            'nom_societe' => $request->nom_societe,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'categorie' => $request->categorie,

            'adresse_nom' => $request->adresse_nom[0] ?? null,
            'adresse_rue' => $request->adresse_rue[0] ?? null,
            'adresse_cp' => $request->adresse_cp[0] ?? null,
            'adresse_ville' => $request->adresse_ville[0] ?? null,
            'adresse_facturation' => in_array(0, $request->adresse_facturation ?? []) ? 1 : 0,
            'adresse_livraison' => in_array(0, $request->adresse_livraison ?? []) ? 1 : 0,
            'adresse_devis' => in_array(0, $request->adresse_devis ?? []) ? 1 : 0,

            'contact_nom' => $request->contact_nom[0] ?? null,
            'contact_email' => $request->contact_email[0] ?? null,
            'contact_telephone' => $request->contact_telephone[0] ?? null,
        ];

        Fournisseur::create($data);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès.');
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom_societe' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
            'categorie' => 'nullable|string',

            'adresse_nom.*' => 'nullable|string',
            'adresse_rue.*' => 'nullable|string',
            'adresse_cp.*' => 'nullable|string',
            'adresse_ville.*' => 'nullable|string',
            'adresse_facturation.*' => 'nullable|boolean',
            'adresse_livraison.*' => 'nullable|boolean',
            'adresse_devis.*' => 'nullable|boolean',

            'contact_nom.*' => 'nullable|string',
            'contact_email.*' => 'nullable|email',
            'contact_telephone.*' => 'nullable|string',
        ]);

        $data = [
            'nom_societe' => $request->nom_societe,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'categorie' => $request->categorie,

            'adresse_nom' => $request->adresse_nom[0] ?? null,
            'adresse_rue' => $request->adresse_rue[0] ?? null,
            'adresse_cp' => $request->adresse_cp[0] ?? null,
            'adresse_ville' => $request->adresse_ville[0] ?? null,
            'adresse_facturation' => in_array(0, $request->adresse_facturation ?? []) ? 1 : 0,
            'adresse_livraison' => in_array(0, $request->adresse_livraison ?? []) ? 1 : 0,
            'adresse_devis' => in_array(0, $request->adresse_devis ?? []) ? 1 : 0,

            'contact_nom' => $request->contact_nom[0] ?? null,
            'contact_email' => $request->contact_email[0] ?? null,
            'contact_telephone' => $request->contact_telephone[0] ?? null,
        ];

        $fournisseur->update($data);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur modifié avec succès.');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé.');
    }
}