<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conge;
use Illuminate\Support\Facades\Auth; 
use App\Services\CongeService;   

class CongeController extends Controller
{
        

    public function store(Request $request, CongeService $service)
    {
        $user = Auth::user();
        $request->validate([...]);

        $service->soumettreDemande($user, $request->all());

        return redirect()->back()->with('success', 'Demande envoyée');
    }

    public function historique(CongeService $service)
    {
        $user = Auth::user();
        $conges = $service->historique($user);

        return view('employes.conges', compact('conges'));
    }
}
