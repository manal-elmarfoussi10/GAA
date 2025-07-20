<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devis extends Model
{
    use HasFactory;

protected $fillable = [
    'produit',
    'description', // Add this
    'quantite',
    'prix_unitaire',
    'taux_tva', // Add this
    'remise',
    'total_ht'
];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(DevisItem::class);
    }
}


