<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\DevisItem;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Exports\DevisExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Facture;
use App\Models\FactureItem;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::paginate(10);
        return view('devis.index', compact('devis'));
    }

    public function create()
    {
        $clients = Client::all();
        $produits = Produit::all();
        return view('devis.create', compact('clients', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'titre' => 'nullable|string',
            'date_devis' => 'required|date',
            'date_validite' => 'required|date',
            'items.*.produit' => 'required|string',
            'items.*.description' => 'nullable|string',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric', // Fixed field name
            'items.*.taux_tva' => 'required|numeric',     // Added TVA rate
            'items.*.remise' => 'nullable|numeric|min:0|max:100',
        ]);

        $devis = Devis::create($request->only([
            'client_id', 'titre', 'date_devis', 'date_validite'
        ]));
    

        $totalHT = 0;
        $totalTVA = 0;

        foreach ($request->items as $item) {
            // Calculate line total with discount
            $lineTotal = $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100);
            $totalHT += $lineTotal;
            
            // Calculate TVA for this line
            $tvaAmount = $lineTotal * ($item['taux_tva'] ?? 0) / 100;
            $totalTVA += $tvaAmount;

            $devis->items()->create([
                'produit' => $item['produit'],
                'description' => $item['description'] ?? '',
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'], // Fixed field name
                'taux_tva' => $item['taux_tva'] ?? 0,     // Store TVA rate
                'remise' => $item['remise'] ?? 0,
                'total_ht' => $lineTotal,
            ]);
        }

        $devis->update([
            'total_ht' => $totalHT,
            'total_tva' => $totalTVA,
            'total_ttc' => $totalHT + $totalTVA,
        ]);

        return redirect()->route('devis.index')->with('success', 'Devis créé.');
    }

    public function edit($id)
{
    $devis = Devis::with('items')->findOrFail($id);
    $clients = Client::all();
    $produits = Produit::all(); // Add this line
    return view('devis.edit', compact('devis', 'clients', 'produits')); // Add 'produits' here
}

    public function update(Request $request, $id)
    {
        $devis = Devis::findOrFail($id);

        $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'titre' => 'nullable|string',
            'date_devis' => 'required|date',
            'date_validite' => 'required|date',
            'items.*.produit' => 'required|string',
            'items.*.description' => 'nullable|string',
            'items.*.quantite' => 'required|integer|min:1',
            'items.*.prix_unitaire' => 'required|numeric',
            'items.*.taux_tva' => 'required|numeric',
            'items.*.remise' => 'nullable|numeric|min:0|max:100',
        ]);

        $devis->update($request->only(['client_id', 'titre', 'date_devis', 'date_validite']));

        $devis->items()->delete();

        $totalHT = 0;
        $totalTVA = 0;

        foreach ($request->items as $item) {
            $lineTotal = $item['prix_unitaire'] * $item['quantite'] * (1 - ($item['remise'] ?? 0) / 100);
            $totalHT += $lineTotal;
            
            $tvaAmount = $lineTotal * ($item['taux_tva'] ?? 0) / 100;
            $totalTVA += $tvaAmount;

            $devis->items()->create([
                'produit' => $item['produit'],
                'description' => $item['description'] ?? '',
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix_unitaire'],
                'taux_tva' => $item['taux_tva'] ?? 0,
                'remise' => $item['remise'] ?? 0,
                'total_ht' => $lineTotal,
            ]);
        }

        $devis->update([
            'total_ht' => $totalHT,
            'total_tva' => $totalTVA,
            'total_ttc' => $totalHT + $totalTVA,
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

   // In your DevisController
public function exportPDF()
{
    $devis = Devis::with('client')->get();
    
    // Get the company for the authenticated user
    $company = auth()->user()->company;
    
    // Handle company logo
    $logoBase64 = null;
    if ($company->logo) {
        try {
            $logoPath = storage_path('app/' . $company->logo);
            if (file_exists($logoPath)) {
                $logoData = file_get_contents($logoPath);
                $logoBase64 = 'data:'.mime_content_type($logoPath).';base64,'.base64_encode($logoData);
            }
        } catch (\Exception $e) {
            // Log error if needed
            \Log::error('Error loading company logo: '.$e->getMessage());
        }
    }
    
    $pdf = PDF::loadView('devis.export_pdf', [
        'devis' => $devis,
        'company' => $company,
        'logoBase64' => $logoBase64
    ]);
    
    return $pdf->download('devis.pdf');
}
    
    public function generateFacture(Devis $devis)
    {
        $facture = Facture::create([
            'client_id' => $devis->client_id,
            'devis_id' => $devis->id,
            'date_facture' => $devis->date_devis,
            'total_ht' => $devis->total_ht,
            'total_ttc' => $devis->total_ttc,
            'total_tva' => $devis->total_tva,
        ]);

        foreach ($devis->items as $item) {
            $facture->items()->create([
                'produit' => $item->produit,
                'description' => $item->description,
                'quantite' => $item->quantite,
                'prix_unitaire' => $item->prix_unitaire,
                'taux_tva' => $item->taux_tva,
                'remise' => $item->remise,
                'total_ht' => $item->total_ht,
            ]);
        }

        return redirect()->route('factures.index')->with('success', 'Facture générée depuis le devis.');
    }
    
    public function downloadSinglePdf($id)
    {
        $devis = Devis::with(['client', 'items'])->findOrFail($id);
        $company = auth()->user()->company;
        
        // Handle company logo
        $logoBase64 = null;
        if ($company->logo) {
            try {
                $logoPath = storage_path('app/' . $company->logo);
                if (file_exists($logoPath)) {
                    $logoData = file_get_contents($logoPath);
                    $logoBase64 = 'data:'.mime_content_type($logoPath).';base64,'.base64_encode($logoData);
                }
            } catch (\Exception $e) {
                \Log::error('Error loading company logo: '.$e->getMessage());
            }
        }
        
        $pdf = PDF::loadView('devis.single-pdf', [
            'devis' => $devis,
            'company' => $company,
            'logoBase64' => $logoBase64
        ]);
        
        return $pdf->download("devis_{$devis->id}.pdf");
    }
}