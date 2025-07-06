<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('employe.user')->get();
        return view('absences.index', compact('absences'));
    }

    public function historique()
    {
        $employe = Auth::user()->employe;
        $absences = Absence::where('employe_id', $employe->id)->orderBy('date_absence', 'desc')->get();
        return view('absences.index', compact('absences'));
    }

}




