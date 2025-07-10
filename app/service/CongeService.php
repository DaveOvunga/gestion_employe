<?php
namespace App\Services;

use App\Models\Conge;
use App\Models\User;

class CongeService
{
    public function soumettreDemande(User $user, array $data): Conge
    {
        $employe = $user->employe;

        return Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $data['date_debut'],
            'date_fin' => $data['date_fin'],
            'type_conge' => $data['type_conge'] ?? null,
            'statut' => $data['statut'] ?? 'en_attente',
        ]);
    }

    public function historique(User $user)
    {
        return Conge::where('employe_id', $user->employe->id)
                    ->orderByDesc('created_at')
                    ->get();
    }

    public function statistiques(User $user): array
    {
        $employeId = $user->employe->id;

        return [
            'total' => Conge::where('employe_id', $employeId)->count(),
            'en_attente' => Conge::where('employe_id', $employeId)->where('statut', 'en_attente')->count(),
            'approuves' => Conge::where('employe_id', $employeId)->where('statut', 'approuve')->count(),
            'rejetes' => Conge::where('employe_id', $employeId)->where('statut', 'rejete')->count(),
        ];
    }
}
