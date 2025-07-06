<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employe; // Assuming you have an Employe model

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'poste' => 'required|string',
            'date_embauche' => 'required|date',
            'departement_id' => 'required|exists:departements,id',
        ]);

        return Employe::create($request->all());
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);

        $request->validate([
            'poste' => 'sometimes|string',
            'date_embauche' => 'sometimes|date',
            'departement_id' => 'sometimes|exists:departements,id',
        ]);

        $employe->update($request->all());

        return response()->json($employe);
    }

    
    public function equipe()
    {
        /** @var \App\Models\User $user */
        $user = auth::user();

        if (! $user->hasRole('Manager')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $equipe = Employe::where('manager_id', $user->id)
                    ->with('user', 'departement')
                    ->get();

        return response()->json($equipe);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
