<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employe;
use App\Models\Conge;

class EmployeService
{
    public function updateProfil(User $user, array $data)
    {
        $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function soumettreConge(User $user, array $data): Conge
    {
        $employe = $user->employe;

        return Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $data['date_debut'],
            'date_fin'   => $data['date_fin'],
            'statut'     => 'en_attente',
        ]);
    }

    public function creerEmploye(array $data): Employe
    {
        return Employe::create($data);
    }

    public function mettreAJourEmploye(Employe $employe, array $data): Employe
    {
        $employe->update($data);
        return $employe;
    }

    public function getEquipe(User $manager)
    {
        return Employe::where('manager_id', $manager->id)
                      ->with(['user', 'departement'])
                      ->get();
    }
}
