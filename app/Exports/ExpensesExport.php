<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Expense::with(['client', 'fournisseur'])->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Dossier',
            'Fournisseur',
            'Payé ?',
            'HT',
            'TTC'
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->date->format('d/m/Y'),
            $expense->client->reference_client,
            $expense->fournisseur->nom_societe,
            $expense->paid_status === 'paid' ? 'OUI' : ($expense->paid_status === 'pending' ? 'En attente' : 'Non'),
            $expense->ht_amount,
            $expense->ttc_amount
        ];
    }
}
