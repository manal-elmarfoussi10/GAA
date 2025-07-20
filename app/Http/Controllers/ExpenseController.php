<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Client;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['client', 'fournisseur'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    // Add other CRUD methods as needed
    public function exportExcel()
    {
        return Excel::download(new ExpensesExport, 'depenses.xlsx');
    }

    public function exportPDF()
    {
        $expenses = Expense::with(['client', 'fournisseur'])->get();
        $pdf = PDF::loadView('expenses.pdf', compact('expenses'));
        return $pdf->download('depenses.pdf');
    }
}