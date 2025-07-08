<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\DevisItem;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Exports\DevisExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Facture;
use App\Models\FactureItem;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::with(['client.rdvs'])->latest()->get();
    return view('devis.index', compact('devis'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('devis.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'titre' => 'nullable|string',
            'date_devis' => 'required|date',
            'date_validite' => 'required|date',
            'items.*.produit' => 'required|string',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric',
            'items.*.remise' => 'nullable|numeric|min:0|max:100',
        ]);

        $devis = Devis::create($request->only([
            'client_id', 'titre', 'date_devis', 'date_validite'
        ]));

        $totalHT = 0;

        foreach ($request->items as $item) {
            $lineTotal = $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100);
            $totalHT += $lineTotal;

            $devis->items()->create([
                'produit' => $item['produit'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'],
                'remise' => $item['remise'] ?? 0,
                'total_ht' => $lineTotal,
            ]);
        }

        $devis->update([
            'total_ht' => $totalHT,
            'tva' => 20,
            'total_tva' => $totalHT * 0.2,
            'total_ttc' => $totalHT * 1.2,
        ]);

        return redirect()->route('devis.index')->with('success', 'Devis créé.');
    }

    public function edit($id)
    {
        $devis = Devis::with('items')->findOrFail($id);
        $clients = Client::all();
        return view('devis.edit', compact('devis', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $devis = Devis::findOrFail($id);

        $devis->update($request->only(['client_id', 'titre', 'date_devis', 'date_validite']));

        $devis->items()->delete();

        $totalHT = 0;

        foreach ($request->items as $item) {
            $lineTotal = $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100);
            $totalHT += $lineTotal;

            $devis->items()->create([
                'produit' => $item['produit'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'],
                'remise' => $item['remise'] ?? 0,
                'total_ht' => $lineTotal,
            ]);
        }

        $devis->update([
            'total_ht' => $totalHT,
            'total_tva' => $totalHT * 0.2,
            'total_ttc' => $totalHT * 1.2,
        ]);

        return redirect()->route('devis.index')->with('success', 'Devis mis à jour.');
    }

    public function destroy($id)
    {
        $devis = Devis::findOrFail($id);
        $devis->delete();

        return redirect()->route('devis.index')->with('success', 'Devis supprimé.');
    }

    public function exportExcel()
{
    return Excel::download(new DevisExport, 'devis.xlsx');
}

public function exportPDF()
{
    $devis = Devis::with('client')->get();
    $pdf = PDF::loadView('devis.export_pdf', compact('devis'));
    return $pdf->download('devis.pdf');
}
public function generateFacture(Devis $devis)
{
    // Create facture from devis
    $facture = Facture::create([
        'client_id' => $devis->client_id,
        'devis_id' => $devis->id,
        'date_facture' => $devis->date_devis,
        'total_ht' => $devis->total_ht,
        'total_ttc' => $devis->total_ttc,
        'tva' => $devis->tva,
    ]);

    // Copy items
    foreach ($devis->items as $item) {
        $facture->items()->create([
            'produit' => $item->produit,
            'quantite' => $item->quantite,
            'prix_unitaire' => $item->prix_unitaire,
            'remise' => $item->remise,
            'total_ht' => $item->total_ht,
        ]);
    }

    return redirect()->route('factures.index')->with('success', 'Facture générée depuis le devis.');
}
public function downloadSinglePdf($id)
{
    $devis = Devis::with(['client', 'items'])->findOrFail($id);

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('devis.single-pdf', compact('devis'));

    return $pdf->download("devis_{$devis->id}.pdf");
}
}
