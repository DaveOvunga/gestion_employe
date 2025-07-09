<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Employe; 
class UserControllers extends Controller
{    

    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|exists:roles,name', // Vérifie que le rôle existe dans la table 'roles'
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);


         if (in_array($request->role, ['Employe', 'Manager'])) {
            Employe::create([
                'user_id'        => $user->id,
                'departement_id' => $request->departement_id,
                'date_embauche'  => $request->date_embauche ?? now()->toDateString(),
                'poste'          => $request->poste ?? ($request->role === 'Manager' ? 'Manager' : 'Employé'),
                'salaire'        => $request->salaire ?? 0.00,
                'manager_id'     => $request->role === 'Manager' ? null : $this->getDefaultManagerId(),
            ]);
        }


        // Attribution du rôle
        $user->assignRole($request->role);

        // Retour avec succès ou redirection
        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
    }

    private function getDefaultManagerId()
    {
        // Exemple : retourner le premier manager disponible
        $manager = Employe::whereHas('user', function ($q) {
            $q->where('role', 'Manager');
        })->first();

        return $manager ? $manager->id : null;
    }

}
