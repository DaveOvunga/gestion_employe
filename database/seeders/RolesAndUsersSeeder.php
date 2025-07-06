<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departement;
use App\Models\Employe;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        $roles = ['Admin', 'RH', 'Manager', 'Employe'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Créer un département par défaut
        $departement = Departement::firstOrCreate(['name' => 'Informatique']);

        // Créer un Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole('Admin');

        // Créer un RH
        $rh = User::firstOrCreate(
            ['email' => 'rh@example.com'],
            ['name' => 'RH', 'password' => bcrypt('password')]
        );
        $rh->assignRole('RH');

        // Créer un Manager
        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            ['name' => 'Manager', 'password' => bcrypt('password')]
        );
        $manager->assignRole('Manager');

        // Créer un Employé
        $employeUser = User::firstOrCreate(
            ['email' => 'employe@example.com'],
            ['name' => 'Employé', 'password' => bcrypt('password')],
            
        );
        $employeUser->assignRole('Employe');

        // Créer l'entrée Employe liée à l'utilisateur
        Employe::firstOrCreate([
            'user_id' => $employeUser->id,
        ], [
            'poste' => 'Développeur',
            'date_embauche' => now(),
            'departement_id' => $departement->id,
            'manager_id' => $manager->id,
            'salaire' => 30000
        ]);
    }
}

