<?php
use App\Services\AbsenceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index(AbsenceService $service)
    {
        $absences = $service->tout();
        return view('absences.index', compact('absences'));
    }

    public function historique(AbsenceService $service)
    {
        $user = Auth::user();
        $absences = $service->historique($user);
        return view('absences.index', compact('absences'));
    }
}?>