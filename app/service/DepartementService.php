<?php
namespace App\Services;

use App\Models\Departement;

class DepartementService
{
    public function liste()
    {
        return Departement::all();
    }

    public function creer(array $data)
    {
        return Departement::create([
            'nom' => $data['nom'],
        ]);
    }

    public function supprimer(string $id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();
    }

    // Tu peux ajouter show / update si besoin plus tard
}
