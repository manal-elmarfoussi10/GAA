<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    protected $fillable = [
        'email_id', 'content', 'file_path', 'file_name'
    ];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}