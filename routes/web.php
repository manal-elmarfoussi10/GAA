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


require __DIR__.'/auth.php';
