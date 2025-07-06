<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employe;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{    
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }   

}
