<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver',
        'subject',
        'content',
        'label',       // Primary, Work, etc.
        'label_color', // green, orange, etc.
        'important',
        'is_deleted',
        'folder',      // inbox, sent, bin, etc.
    ];

    public function replies()
{
    return $this->hasMany(Reply::class);
}
}