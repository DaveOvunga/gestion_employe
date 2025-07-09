<?php

// app/Models/Employe.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    // ...

    protected $fillable = [
    'user_id',
    'departement_id',
    'date_embauche',
    'poste',
    'salaire',
    'manager_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

}
