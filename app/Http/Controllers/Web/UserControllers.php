<?php

use App\Services\UserService;
use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserControllers extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request, UserService $service)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'role'           => 'required|exists:roles,name',
            'departement_id' => 'nullable|exists:departements,id',
        ]);

        $data = $request->all();
        $data['manager_id'] = $service->getDefaultManagerId();

        $service->creerUtilisateur($data);

        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
    }
}
