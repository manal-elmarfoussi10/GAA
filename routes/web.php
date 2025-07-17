<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AvoirController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PoseurController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BonDeCommandeController;




Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/calendar', [RdvController::class, 'calendar'])->name('rdv.calendar');
Route::get('/calendar/events', [RdvController::class, 'events'])->name('rdv.events');

Route::resource('rdv', RdvController::class);
Route::put('/rdv/{id}', [RdvController::class, 'update'])->name('rdv.update');

Route::resource('devis', DevisController::class);
Route::get('/devis/export/excel', [DevisController::class, 'exportExcel'])->name('devis.export.excel');
Route::get('/devis/export/pdf', [DevisController::class, 'exportPDF'])->name('devis.export.pdf');
Route::post('/devis/{devis}/generate-facture', [DevisController::class, 'generateFacture'])->name('devis.generate.facture');
Route::get('/devis/pdf/{devis}', [DevisController::class, 'exportPDF'])->name('devis.pdf');
Route::get('/devis/{id}/pdf', [DevisController::class, 'downloadSinglePdf'])->name('devis.download.pdf');

Route::resource('factures', FactureController::class);
Route::get('/factures/export/excel', [FactureController::class, 'exportExcel'])->name('factures.export.excel');
Route::get('/factures/export/pdf', [FactureController::class, 'exportPDF'])->name('factures.export.pdf');
Route::get('/factures/{id}/pdf', [FactureController::class, 'downloadPdf'])->name('factures.download.pdf');
Route::post('/factures/{id}/acquitter', [FactureController::class, 'acquitter'])->name('factures.acquitter');
Route::get('/factures/{facture}/acquitter', [FactureController::class, 'acquitter'])->name('factures.acquitter');

Route::prefix('paiements')->group(function () {
    Route::get('/{facture}/create', [PaiementController::class, 'create'])->name('paiement.create');
    Route::post('/{facture}', [PaiementController::class, 'store'])->name('paiement.store');
});
Route::get('/paiements/create/{facture_id}', [PaiementController::class, 'create'])->name('paiements.create');
Route::post('/paiements/store', [PaiementController::class, 'store'])->name('paiements.store');

Route::resource('avoirs', AvoirController::class);
Route::get('/avoirs/export/excel', [AvoirController::class, 'exportExcel'])->name('avoirs.export.excel');
Route::get('/avoirs/export/pdf', [AvoirController::class, 'exportPDF'])->name('avoirs.export.pdf');
Route::get('/avoirs/create', [AvoirController::class, 'create'])->name('avoirs.create'); // generic
Route::get('/avoirs/create/from-facture/{facture}', [AvoirController::class, 'createFromFacture'])->name('avoirs.create.fromFacture'); // from facture

Route::resource('fournisseurs', FournisseurController::class);

//produits
Route::resource('produits', ProduitController::class);

//poseur
Route::resource('poseurs', PoseurController::class);

//stocks
// Export routes (should be placed BEFORE the resource route)
Route::get('/stocks/export/excel', [StockController::class, 'exportExcel'])->name('stocks.export.excel');
Route::get('/stocks/export/pdf', [StockController::class, 'exportPDF'])->name('stocks.export.pdf');

// Resource route
Route::resource('stocks', StockController::class);

//bon de commande
Route::resource('bons-de-commande', BonDeCommandeController::class);
Route::get('bons-de-commande/export/excel', [BonDeCommandeController::class, 'exportExcel'])->name('bons-de-commande.export.excel');
Route::get('bons-de-commande/export/pdf', [BonDeCommandeController::class, 'exportPDF'])->name('bons-de-commande.export.pdf');

//fonctionnalites

Route::get('/fonctionnalites', function () {
    return view('fonctionnalites.fonctionnalites');
});

require __DIR__.'/auth.php';
