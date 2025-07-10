<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conge;
use Illuminate\Support\Facades\Auth;    

class CongeController extends Controller
{
    public function index()
    {
        $conges = Conge::with('employe.user')->get(); //

        return view('conges.index', compact('conges'));
    }


    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approuve,rejete',
        ]);

        $conge = Conge::findOrFail($id);
        $conge->status = $request->status;
        $conge->save();

        return redirect()->back()->with('success', 'Statut mis à jour');
    }


    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'type_conge' => 'required|string|max:255',
        ]);

        $employe = Auth::user()->employe;

        if (!$employe) {
            return redirect()->back()->with('error', 'Vous n’êtes pas associé à un profil employé.');
        }

        Conge::create([
            'employe_id' => $employe->id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type_conge' => $request->type_conge,
            'status' => 'en attente',
        ]);

        return redirect()->back()->with('success', ' Demande de congé envoyée avec succès.');
    }

    public function historique()
    {   
        $employe = Auth::user()->employe;
        $conges = Conge::where('employe_id', $employe->id)->orderByDesc('created_at')->get();

        return view('employes.conges', compact('conges'));
    }

    public function statutRh()
    {
        $employe = Auth::user()->employe;

        $total = Conge::where('employe_id', $employe->id)->count();
        $enAttente = Conge::where('employe_id', $employe->id)->where('status', 'en_attente')->count();
        $approuves = Conge::where('employe_id', $employe->id)->where('status', 'approuve')->count();
        $rejetes = Conge::where('employe_id', $employe->id)->where('status', 'rejete')->count();

        return view('employes.statut_rh', compact('total', 'enAttente', 'approuves', 'rejetes'));
    }

}
