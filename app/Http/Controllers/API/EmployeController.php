<?php

use App\Services\EmployeService;
use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployeWebController extends Controller
{
    public function update(Request $request, EmployeService $service)
    {
        $service->updateProfil(auth::user(), $request->only('name', 'email'));
        return redirect()->back()->with('success', 'Profil mis à jour');
    }

    public function storeConge(Request $request, EmployeService $service)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
        ]);

        $service->soumettreConge(auth::user(), $request->all());
        return redirect()->back()->with('success', 'Demande envoyée');
    }
}
