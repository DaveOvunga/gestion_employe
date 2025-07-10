<?php

use App\Services\UserService;
use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::with('roles')->get();
    }

    public function store(Request $request, UserService $service)
    {
        $request->validate([
            'name'           => 'required',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'role'           => 'required|in:Admin,RH,Manager,Employe',
            'departement_id' => 'nullable|exists:departements,id',
        ]);

        $user = $service->creerUtilisateur($request->all());
        return response()->json($user, 201);
    }

    public function updateMe(Request $request, UserService $service)
    {
        $user = auth::user();

        $request->validate([
            'name'  => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
        ]);

        $updated = $service->updateUtilisateur($user, $request->only('name', 'email'));
        return response()->json($updated);
    }

    public function me(UserService $service)
    {
        return response()->json($service->me(auth::user()));
    }
}
