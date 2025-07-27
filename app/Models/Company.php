<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'commercial_name',
        'email',
        'phone',
        'siret',
        'tva',
        'iban',
        'bic',
        'ape',
        'address',
        'postal_code',
        'city',
        'logo',
        'rib',
        'kbis',
        'id_photo_recto',
        'id_photo_verso',
        'tva_exemption_doc',
        'invoice_terms_doc',
        'known_by',
        'contact_permission',
        'garage_type',
    ];

    public function users()
{
    return $this->hasMany(User::class);
}


}