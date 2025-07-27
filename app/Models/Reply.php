<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'email_id', 'sender_id', 'content', 
        'file_path', 'file_name'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'email_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id');
    }
}