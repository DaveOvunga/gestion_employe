<?php

// app/Models/Employe.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    // ...
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

}
