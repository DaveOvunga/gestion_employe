<?php
use App\Services\DepartementService;
use App\Http\Controllers\Controller;    

class DepartementController extends Controller
{
    public function index(DepartementService $service)
    {
        $departements = $service->liste();
        return view('departements.index', compact('departements'));
    }
}

