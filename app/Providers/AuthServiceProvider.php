<?php

namespace App\Providers;
use App\Models\User; // ADD USER MODEL HERE 

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

        // defining gates for admin role 

        Gate::define('role-admin', function (User $user) {
            //defining admin user role 
            if($user->role == 'admin'){
                return true;
            }
            // if user role is not admin then return false 
            return false;
        });
    }
}
