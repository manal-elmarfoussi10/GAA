<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevisItem extends Model
{
    protected $fillable = [
        'devis_id', 'produit', 'quantite', 'prix_unitaire', 'remise', 'total_ht'
    ];

    public function devis()
    {
        return $this->belongsTo(Devis::class);
    }
}
