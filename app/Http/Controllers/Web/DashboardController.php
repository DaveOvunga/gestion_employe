<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Con;
use App\Http\Controllers\Controller;   
use App\Models\Employe; 

// app/Http/Controllers/Web/DashboardController.php
class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth::user();

        if ($user->hasRole('Admin')) {
            return view('dashboard.admin');
        } elseif ($user->hasRole('RH')) {
            return view('dashboard.rh');
        } elseif ($user->hasRole('Manager')) {
            return view('dashboard.manager');
        } else {
            $conges = $user->employe->conges ?? [];
            return view('dashboard.employe', compact('conges'));
        }
    }

    public function voirEquipe()
    {
        // Supposons que chaque manager est lié à une équipe via manager_id
        $equipe = Employe::where('manager_id', auth::id())->get();

        return view('dashboard.manager', compact('equipe'));
    }

}

