<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User; // Importa el modelo User

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Define Gates para permisos
        Gate::define('manage users', function (User $user) {
            return $user->hasPermissionTo('manage users');
        });

        Gate::define('manage roles', function (User $user) {
            return $user->hasPermissionTo('manage roles');
        });

        Gate::define('manage permissions', function (User $user) {
            return $user->hasPermissionTo('manage permissions');
        });

        // Puedes definir Gates para otros permisos según tu aplicación
    }
}