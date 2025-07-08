<?php

namespace App\Exports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacturesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Facture::select('id', 'client_id', 'date_facture', 'total_ht', 'total_tva', 'total_ttc')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Client', 'Date', 'Total HT', 'TVA', 'Total TTC'];
    }
}
