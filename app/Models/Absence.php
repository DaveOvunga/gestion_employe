<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = ['employe_id', 'motif', 'date'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    
}


