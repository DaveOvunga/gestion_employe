<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;       

class EmployeWebController extends Controller
{
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */

        $user = auth::user();
        $user->update($request->only('name', 'email'));
        return redirect()->back()->with('success', 'Profil mis à jour');
    }

    public function storeConge(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $employe = auth::user()->employe;

        Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en_attente',
        ]);

        return redirect()->back()->with('success', 'Demande envoyée');
    }
}
