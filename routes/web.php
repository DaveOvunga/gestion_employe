<?php

use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardController;  
use App\Http\Controllers\Web\UserControllers;
use App\Http\Controllers\Web\DepartementController;
use App\Http\Controllers\Web\EmployeController; 
use App\Http\Controllers\Web\AbsenceController;
use App\Http\Controllers\Web\CongeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    


Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('login');
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserControllers::class, 'index'])->name('users.index');
    Route::get('/departements', [DepartementController::class, 'index'])->name('departements.index');
    Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/update-me', [ProfileController::class, 'update'])->name('update.me');
    Route::put('/update-store', [ProfileController::class, 'update'])->name('update.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
    Route::get('/dashboard/rh', fn() => view('dashboard.rh'))->name('dashboard.rh');
    Route::get('/dashboard/manager', [DashboardController::class, 'voirEquipe'])->name('dashboard.manager');
    Route::get('/dashboard/employe', [DashboardController::class, 'index'])->name('dashboard.employe');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store'); //
    Route::post('/conges/{id}/statut', [CongeController::class, 'updateStatut'])->name('conges.updateStatut');
});

Route::post('/users', [UserControllers::class, 'store'])->name('users.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/manager/equipe', [DashboardController::class, 'voirEquipe'])->name('manager.equipe');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/employe/absences', [AbsenceController::class, 'historique'])->name('employe.absences');
    Route::get('/employe/conges', [CongeController::class, 'historique'])->name('employe.conges');
    Route::get('/employe/departement', [EmployeController::class, 'monDepartement'])->name('employe.departement');
    Route::get('/employe/statut-rh', [CongeController::class, 'statutRh'])->name('employe.statut_rh');        
});


require __DIR__.'/auth.php';
