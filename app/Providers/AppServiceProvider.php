<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   

     public function boot()
     {
         Gate::define('access-client', fn($user) =>
             in_array($user->role, ['admin', 'client_service', 'commercial'])
         );
     
         Gate::define('access-dashboard', fn($user) => true);
     
         Gate::define('create-client', fn($user) =>
             in_array($user->role, ['admin', 'client_service'])
         );
     
         Gate::define('access-calendar', fn($user) =>
             in_array($user->role, ['admin', 'poseur', 'commercial'])
         );
     
         Gate::define('view-devis', fn($user) =>
             in_array($user->role, ['admin', 'commercial', 'planner'])
         );
     
         Gate::define('view-factures', fn($user) =>
             in_array($user->role, ['admin', 'comptable'])
         );
     
         Gate::define('view-avoirs', fn($user) =>
             in_array($user->role, ['admin', 'comptable'])
         );
     
         Gate::define('access-expenses', fn($user) =>
             in_array($user->role, ['admin', 'planner', 'comptable'])
         );
     
         Gate::define('view-orders', fn($user) =>
             in_array($user->role, ['admin', 'planner'])
         );
         Gate::define('is-superadmin', fn($user) => $user->role === 'superadmin');
     }
}
