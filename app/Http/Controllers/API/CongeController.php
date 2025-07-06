<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conge; // Assuming you have a Conge model
use Illuminate\Support\Facades\Auth;    
use App\Models\User;        



class CongeController extends Controller
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
        /** @var \App\Models\User $user */
        $user = auth::user();

        if (! $user->hasRole('Employe')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $employe = $user->employe;

        $conge = Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en_attente',
        ]);

        return response()->json($conge, 201);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,approuve,rejete',
        ]);

        $conge = Conge::findOrFail($id);
        $conge->statut = $request->statut;
        $conge->save();

        return response()->json(['message' => 'Statut mis à jour']);
    }

    public function approuver(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = auth::user(); // ← syntaxe correcte avec aide à Intelephense

        if (! $user->hasRole('Manager')) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $conge = Conge::with('employe')->findOrFail($id);

        // Vérifie que le congé appartient à un membre de son équipe
        if ($conge->employe->manager_id !== $user->id) {
            return response()->json(['message' => 'Non autorisé à modifier ce congé'], 403);
        }

        $request->validate([
            'statut' => 'required|in:approuve,rejete',
        ]);

        $conge->statut = $request->statut;
        $conge->save();

        return response()->json(['message' => 'Statut du congé mis à jour']);
}


    public function mesConges()
    {
        $employe = auth::user()->employe;

        return Conge::where('employe_id', $employe->id)->get();
    }



}
