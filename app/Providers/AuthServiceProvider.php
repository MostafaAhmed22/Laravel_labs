<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//if the user is super admin he can do anything
        Gate::before(function (User $user) {
            if ($user->role === 'super_admin') {
                return true; 
            }
        });

        Gate::define('is_admin', function (User $user) {
            return $user->role === 'admin' ;
        });

        Gate::define('is_super_admin', function (User $user) {
            return $user->role === 'super_admin';
        });

        Gate::define('is_user', function (User $user) {
            return $user->role === 'user';
        });

    }
}
