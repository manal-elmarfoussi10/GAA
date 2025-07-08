<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['facture_id', 'montant', 'mode', 'commentaire', 'date'];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
