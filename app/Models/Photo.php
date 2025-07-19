<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['client_id', 'type', 'path'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
