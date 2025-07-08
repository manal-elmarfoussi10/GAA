<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\FactureItem;
use Illuminate\Http\Request;
use App\Exports\FacturesExport;
use App\Models\Paiement;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::with('client')->latest()->get();
        return view('factures.index', compact('factures'));
    }

    public function create()
    {
        $clients = Client::all();
        $devis = Devis::all();
        return view('factures.create', compact('clients', 'devis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'devis_id' => 'nullable|exists:devis,id',
            'titre' => 'nullable|string|max:255',
            'date_facture' => 'required|date',
            'items.*.produit' => 'required|string|max:255',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric|min:0',
            'items.*.remise' => 'nullable|numeric|min:0|max:100',
        ]);

        $facture = new Facture($request->only([
            'client_id', 'devis_id', 'titre', 'date_facture'
        ]));

        $totalHT = 0;

        foreach ($request->items as $itemData) {
            $pu = $itemData['prix_unitaire'];
            $qty = $itemData['quantite'];
            $discount = $itemData['remise'] ?? 0;

            $itemTotal = $pu * $qty * (1 - $discount / 100);
            $totalHT += $itemTotal;
        }

        $facture->total_ht = $totalHT;
        $facture->tva = 20;
        $facture->total_tva = $totalHT * 0.2;
        $facture->total_ttc = $totalHT * 1.2;
        $facture->save();

        foreach ($request->items as $item) {
            FactureItem::create([
                'facture_id' => $facture->id,
                'produit' => $item['produit'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'],
                'remise' => $item['remise'] ?? 0,
                'total_ht' => $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100),
            ]);
        }

        $facture = new Facture($request->all());

// Générer un numéro unique
$today = now()->format('dmy'); // exemple : 250624
$nextId = Facture::max('id') + 1;
$numero = $today . str_pad($nextId, 4, '0', STR_PAD_LEFT); // 2506240001

$facture->numero = $numero;
$facture->save();
        return redirect()->route('factures.index')->with('success', 'Facture créée avec succès.');
    }
    public function edit($id)
{
    $facture = Facture::with('items')->findOrFail($id);
    $clients = Client::all();
    return view('factures.edit', compact('facture', 'clients'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'client_id' => 'nullable|exists:clients,id',
        'date_facture' => 'required|date',
        'items.*.produit' => 'required|string|max:255',
        'items.*.quantite' => 'required|integer|min:1',
        'items.*.prix_unitaire' => 'required|numeric|min:0',
        'items.*.remise' => 'nullable|numeric|min:0|max:100',
    ]);

    $facture = Facture::findOrFail($id);
    $facture->client_id = $request->client_id;
    $facture->date_facture = $request->date_facture;

    $totalHT = 0;
    foreach ($request->items as $itemData) {
        $pu = $itemData['prix_unitaire'];
        $qty = $itemData['quantite'];
        $discount = $itemData['remise'] ?? 0;

        $itemTotal = $pu * $qty * (1 - $discount / 100);
        $totalHT += $itemTotal;
    }

    $facture->total_ht = $totalHT;
    $facture->tva = 20;
    $facture->total_tva = $totalHT * 0.2;
    $facture->total_ttc = $totalHT * 1.2;
    $facture->save();

    // Remove existing items before re-inserting updated ones
    $facture->items()->delete();

    foreach ($request->items as $item) {
        $facture->items()->create([
            'produit' => $item['produit'],
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix_unitaire'],
            'remise' => $item['remise'] ?? 0,
            'total_ht' => $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100),
        ]);
    }

    return redirect()->route('factures.index')->with('success', 'Facture mise à jour avec succès.');
}

public function exportExcel()
{
    return Excel::download(new FacturesExport, 'factures.xlsx');
}

public function exportPDF()
{
    $factures = Facture::with('client')->get();
    $pdf = PDF::loadView('factures.export_pdf', compact('factures'));
    return $pdf->download('factures.pdf');
}
public function downloadPdf($id)
{
    $facture = \App\Models\Facture::with(['client', 'items'])->findOrFail($id);

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('factures.pdf', compact('facture'));

    return $pdf->download("facture_{$facture->id}.pdf");
}
public function acquitter($id)
{
    $facture = Facture::with(['paiements', 'avoirs'])->findOrFail($id);

    $totalPaye = $facture->paiements->sum('montant');
    $totalAvoir = $facture->avoirs->sum('montant');
    $reste = $facture->total_ttc - $totalPaye - $totalAvoir;

    if ($reste > 0) {
        Paiement::create([
            'facture_id' => $facture->id,
            'montant' => $reste,
            'mode' => 'Virement', // Default mode
            'date' => now(),
        ]);
    }

    return redirect()->route('factures.index')->with('success', 'Facture acquittée.');
}


}
