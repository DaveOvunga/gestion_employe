<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;    

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Cette propriété est utilisée pour indiquer le chemin de la ressource "home".
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    // Ajout de la constante HOME
    public static function redirectTo()
    {
        /** @var \App\Models\User $user */
        $user = auth::user();

        if ($user->hasRole('Admin')) {
            return '/dashboard/admin';
        } elseif ($user->hasRole('RH')) {
            return '/dashboard/rh';
        } elseif ($user->hasRole('Manager')) {
            return '/dashboard/manager';
        } elseif ($user->hasRole('Employe')) {
            return '/dashboard/employe';
        }

        return '/dashboard'; // fallback
    }


    /**
     * Bootstrap des services de routage.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Enregistre les routes de l'application.
     *
     * @return void
     */
    public function map()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}