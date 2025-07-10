<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conge; // Assuming you have a Conge model
use Illuminate\Support\Facades\Auth;    
use App\Services\CongeService;
use App\Models\User;        



class CongeController extends Controller
{
   

    public function store(Request $request, CongeService $service)
    {
        $user = auth::user();
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'type_conge' => 'required|string|max:255',
        ]);

        $conge = $service->soumettreDemande($user, $request->all());

        return response()->json($conge, 201);
    }
}
