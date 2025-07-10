<?php 
namespace App\Services;

use App\Models\Absence;
use App\Models\User;

class AbsenceService
{
    public function enregistrer(array $data): Absence
    {
        return Absence::create([
            'employe_id'   => $data['employe_id'],
            'motif'        => $data['motif'],
            'date_absence' => $data['date'] ?? now(),
        ]);
    }

    public function historique(User $user)
    {
        $employe = $user->employe;

        return Absence::where('employe_id', $employe->id)
                      ->orderByDesc('date_absence')
                      ->get();
    }

    public function tout()
    {
        return Absence::with('employe.user')
                      ->orderByDesc('date_absence')
                      ->get();
    }
}?>