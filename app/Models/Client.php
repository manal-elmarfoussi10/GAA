<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rdv;

class Client extends Model
{
    protected $fillable = [
        'nom_assure', 'prenom', 'email', 'telephone', 'adresse',
        'code_postal', 'ville', 'plaque', 'nom_assurance', 'autre_assurance',
        'ancien_modele_plaque', 'numero_police', 'date_sinistre', 'date_declaration',
        'raison', 'type_vitrage', 'professionnel', 'reparation',
        'photo_vitrage', 'photo_carte_verte', 'photo_carte_grise',
        'type_cadeau', 'numero_sinistre', 'kilometrage', 'connu_par',
        'adresse_pose', 'reference_interne', 'reference_client', 'precision',
    ];
    public function rdvs()
{
    return $this->hasMany(Rdv::class);
}
}
