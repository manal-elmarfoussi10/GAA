<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationThread extends Model
{
    protected $fillable = ['client_id', 'company_id', 'subject'];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Email::class, 'thread_id');
    }
}
