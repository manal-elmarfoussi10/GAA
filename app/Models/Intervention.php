<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;



class InterventionPhoto extends Model
{
    protected \$fillable = [
        'intervention_id', 'uploaded_by', 'file_path', 'commentaire'
    ];

    public function intervention()
    {
        return \$this->belongsTo(Intervention::class);
    }

    public function uploader()
    {
        return \$this->belongsTo(User::class, 'uploaded_by');
    }
}


class Intervention extends Model
{
    public function photos()
{
    return $this->hasMany(InterventionPhoto::class);
}
public function poseur()
{
    return \$this->belongsTo(User::class, 'poseur_id');
}

public function interventionPhotos()
{
    return \$this->hasMany(InterventionPhoto::class);
}
}
