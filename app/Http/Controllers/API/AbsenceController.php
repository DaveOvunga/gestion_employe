<?php

use App\Services\AbsenceService;
use Illuminate\Http\Request; // ← Ajout important si manquant

class AbsenceController extends Controller
{
    public function store(Request $request, AbsenceService $service)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'motif'      => 'required|string',
            'date'       => 'required|date',
        ]);

        $absence = $service->enregistrer($request->all());

        return response()->json($absence, 201);
    }
}
