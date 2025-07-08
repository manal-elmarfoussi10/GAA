<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_societe',
        'email',
        'telephone',
        'categorie',

        // Adresse
        'adresse_nom',
        'adresse_rue',
        'adresse_cp',
        'adresse_ville',
        'adresse_facturation',
        'adresse_livraison',
        'adresse_devis',

        // Contact
        'contact_nom',
        'contact_email',
        'contact_telephone',
    ];
}