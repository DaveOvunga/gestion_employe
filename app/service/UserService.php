<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function creerUtilisateur(array $data): User
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($data['role']);

        if (in_array($data['role'], ['Employe', 'Manager'])) {
            Employe::create([
                'user_id'        => $user->id,
                'departement_id' => $data['departement_id'],
                'date_embauche'  => $data['date_embauche'] ?? now()->toDateString(),
                'poste'          => $data['poste'] ?? $data['role'],
                'salaire'        => $data['salaire'] ?? 0.00,
                'manager_id'     => $data['role'] === 'Manager' ? null : $this->getDefaultManagerId(),
            ]);
        }

        return $user;
    }

    public function getDefaultManagerId(): ?int
    {
        $manager = Employe::whereHas('user', function ($q) {
            $q->role('Manager');
        })->first();

        return $manager ? $manager->id : null;
    }

    public function updateUtilisateur(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function me(User $user)
    {
        return $user->load('roles', 'employe.departement');
    }
}
