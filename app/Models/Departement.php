<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function employes()
    {
        return $this->hasMany(Employe::class);
    }
}

