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
use App\Http\Controllers\BonDeCommandeLigneController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SidexaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;


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
Route::resource('bons-de-commande', BonDeCommandeController::class)->parameters([
    'bons-de-commande' => 'bon',
]);
Route::get('bons-de-commande/export/excel', [BonDeCommandeController::class, 'exportExcel'])->name('bons-de-commande.export.excel');
Route::get('bons-de-commande/export/pdf', [BonDeCommandeController::class, 'exportPDF'])->name('bons-de-commande.export.pdf');

Route::resource('email-templates', EmailTemplateController::class)->only(['index', 'store', 'show']);
Route::get('/email-templates', [EmailTemplateController::class, 'inbox'])->name('email-templates.inbox');

Route::prefix('emails')->controller(EmailController::class)->group(function () {
    Route::get('/', 'inbox')->name('emails.inbox');
    Route::get('/sent', 'sent')->name('emails.sent');
    Route::get('/important', 'important')->name('emails.important');
    Route::get('/bin', 'bin')->name('emails.bin');
    Route::get('/create', 'create')->name('emails.create');

    Route::get('/notifications', 'notifications')->name('emails.notifications'); // ✅ ADD THIS LINE
    Route::post('/mark-all-read', 'markAllRead')->name('emails.markAllRead');
    Route::post('/', 'store')->name('emails.store');
    Route::get('/{id}', 'show')->name('emails.show');
    Route::post('/{id}/delete', 'destroy')->name('emails.delete');
    Route::post('/{id}/restore', 'restore')->name('emails.restore');
    Route::post('/{id}/toggle-star', 'toggleStar')->name('emails.toggleStar');
    Route::delete('/{id}/permanent', 'permanentDelete')->name('emails.permanentDelete');
});
Route::post('/emails/{email}/mark-important', [EmailController::class, 'markImportant'])->name('emails.markImportant');
Route::post('/emails/{email}/move-to-trash', [EmailController::class, 'moveToTrash'])->name('emails.moveToTrash');
Route::get('/emails/{email}/reply', [EmailController::class, 'reply'])->name('emails.reply');
Route::post('/emails/{id}/toggle-important', [EmailController::class, 'toggleImportant'])->name('emails.toggleImportant');
Route::post('/emails/{id}/restore', [EmailController::class, 'restore'])->name('emails.restore');
Route::post('/emails/{email}/reply', [EmailController::class, 'reply'])->name('emails.reply');
Route::delete('/emails/{email}', [EmailController::class, 'destroy'])->name('emails.destroy');


Route::get('/profile', [CompanyController::class, 'show'])->name('company.profile');
Route::get('/profile/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::put('/profile/update', [CompanyController::class, 'update'])->name('company.update');
Route::get('/profile/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/profile', [CompanyController::class, 'store'])->name('company.store');


Route::prefix('sidexa')->controller(SidexaController::class)->group(function () {
    Route::get('/', 'index')->name('sidexa.index');
    Route::get('/create', 'create')->name('sidexa.create');
    Route::post('/', 'store')->name('sidexa.store');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');            // List all users
    Route::get('/create', [UserController::class, 'create'])->name('create');    // Show create form
    Route::post('/', [UserController::class, 'store'])->name('store');           // Store user
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');   // Edit form
    Route::put('/{user}', [UserController::class, 'update'])->name('update');    // Update user
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy'); // Delete user
});


Route::get('/acheter-unites', [UnitController::class, 'showPurchaseForm'])->name('units.form');
Route::post('/acheter-unites', [UnitController::class, 'purchase'])->name('units.purchase');


Route::get('/ma-consommation', function () {
    return view('consommation.index');
})->name('consommation.index');

Route::view('/depenses', 'depenses.index')->name('depenses.index');

require __DIR__.'/auth.php';
