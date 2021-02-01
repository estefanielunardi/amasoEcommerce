<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isArtisan', function($user) {
            return $user->isArtisan == true; 
        });

        Gate::define('isAuth', function($user) {
            return $user->isArtisan == false;
        }); 

        Gate::define('isAdmin', function($user) {
            return $user->is_admin == true; 
        });
    }
}
