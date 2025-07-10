<?php

use App\Services\DepartementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartementController extends Controller
{
    public function index(DepartementService $service)
    {
        return response()->json($service->liste());
    }

    public function store(Request $request, DepartementService $service)
    {
        $request->validate(['nom' => 'required|string']);
        $departement = $service->creer($request->all());

        return response()->json($departement, 201);
    }

    public function destroy(string $id, DepartementService $service)
    {
        $service->supprimer($id);
        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
