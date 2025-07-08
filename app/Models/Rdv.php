<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    protected $fillable = [
        'client_id',
        'technicien',
        'indisponible_poseur',
        'ga_gestion',
        'start_time',
        'end_time',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
