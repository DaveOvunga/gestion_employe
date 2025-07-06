<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employe;
class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::with('user', 'departement')->get();
        return view('employes.index', compact('employes'));
    }

     public function monDepartement()
    {
        $employe = Auth::user()->employe;
        $departement = $employe->departement;
        $equipe = Employe::where('departement_id', $departement->id)->with('user')->get();

        return view('departements.index', compact('departement', 'equipe'));
    }

}
