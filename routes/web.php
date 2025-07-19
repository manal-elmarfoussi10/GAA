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
use App\Http\Middleware\CompanyAccess;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', CompanyAccess::class])
    ->name('dashboard');


Route::middleware(['auth', CompanyAccess::class])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    Route::post('/clients/{client}/statut-interne', [ClientController::class, 'updateStatutInterne'])->name('clients.statut_interne');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])
    ->name('clients.destroy');
    Route::get('/clients/{client}/export-pdf', [ClientController::class, 'exportPdf'])->name('clients.export.pdf');

    Route::get('/calendar', [RdvController::class, 'calendar'])->name('rdv.calendar');
    Route::get('/calendar/events', [RdvController::class, 'events'])->name('rdv.events');

    Route::get('/rdv/calendar', [RdvController::class, 'calendar'])->name('rdv.calendar');
    Route::get('/rdv/events', [RdvController::class, 'events'])->name('rdv.events');
    Route::post('/rdv', [RdvController::class, 'store'])->name('rdv.store');
    Route::put('/rdv/{rdv}', [RdvController::class, 'update'])->name('rdv.update');
    Route::delete('/rdv/{rdv}', [RdvController::class, 'destroy'])->name('rdv.destroy');

    Route::resource('devis', DevisController::class);
    Route::get('/devis/export/excel', [DevisController::class, 'exportExcel'])->name('devis.export.excel');
    Route::get('/devis/export/pdf', [DevisController::class, 'exportPDF'])->name('devis.export.pdf');
    Route::post('/devis/{devis}/generate-facture', [DevisController::class, 'generateFacture'])->name('devis.generate.facture');
    Route::get('/devis/pdf/{devis}', [DevisController::class, 'exportPDF'])->name('devis.pdf');
    Route::get('/devis/{id}/pdf', [DevisController::class, 'downloadSinglePdf'])->name('devis.download.pdf');

    Route::resource('factures', FactureController::class);
    Route::get('/factures/export/excel', [FactureController::class, 'exportExcel'])
    ->name('factures.export.excel');

Route::get('/factures/export/pdf', [FactureController::class, 'exportFacturesPDF'])
    ->name('factures.export.pdf');
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
    Route::get('/avoirs/create', [AvoirController::class, 'create'])->name('avoirs.create');
    Route::get('/avoirs/create/from-facture/{facture}', [AvoirController::class, 'createFromFacture'])->name('avoirs.create.fromFacture');

    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('produits', ProduitController::class);
    Route::resource('poseurs', PoseurController::class);

    Route::get('/stocks/export/excel', [StockController::class, 'exportExcel'])->name('stocks.export.excel');
    Route::get('/stocks/export/pdf', [StockController::class, 'exportPDF'])->name('stocks.export.pdf');
    Route::resource('stocks', StockController::class);

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
        Route::get('/notifications', 'notifications')->name('emails.notifications');
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
    Route::post('/emails/upload', [EmailController::class, 'upload'])->name('emails.upload');

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
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::get('/acheter-unites', [UnitController::class, 'showPurchaseForm'])->name('units.form');
    Route::post('/acheter-unites', [UnitController::class, 'purchase'])->name('units.purchase');

    Route::get('/ma-consommation', function () {
        return view('consommation.index');
    })->name('consommation.index');

    Route::view('/depenses', 'depenses.index')->name('depenses.index');
    Route::get('/fonctionnalites', function () {
        return view('fonctionnalites.fonctionnalites');
    });

    Route::view('/commercial', 'commercial.dashboard')->name('commercial.dashboard');
    Route::view('/comptable', 'comptable.dashboard')->name('comptable.dashboard');

    Route::resource('expenses', ExpenseController::class);
    Route::get('/expenses/export/excel', [ExpenseController::class, 'exportExcel'])
    ->name('expenses.export.excel');

Route::get('/expenses/export/pdf', [ExpenseController::class, 'exportPDF'])
    ->name('expenses.export.pdf');
// Remplacer :
Route::get('/export-pdf', [FactureController::class, 'exportPDF']);

// Par :
Route::get('/export-pdf', [FactureController::class, 'exportFacturesPDF']);
Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');


Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});

require __DIR__.'/auth.php';
