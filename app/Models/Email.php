<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender', 'receiver', 'subject', 'content', 
        'label', 'label_color', 'important', 'is_deleted', 'folder',
        'client_id', 'company_id', 'thread_id' // Add client_id and company_id
    ];

    // Rename to conversation for clarity
    public function replies()
    {
        return $this->hasMany(Reply::class, 'email_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    // Alias for conversation
    public function getConversationAttribute()
    {
        return $this;
    }

    public function scopeForCompany($query, $companyId)
{
    return $query->where('company_id', $companyId);
}

public function thread()
{
    return $this->belongsTo(ConversationThread::class);
}

public function senderUser()
{
    return $this->belongsTo(User::class, 'sender_id');
}
}