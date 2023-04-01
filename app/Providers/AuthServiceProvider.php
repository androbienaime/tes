<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use App\Models\User;
use App\Policies\CustomerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Customer::class => CustomerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Gate::define("access-settings", function (User $user){
            return $user->isSuperAdmin();
        });

        Gate::define("access-update-customer", function (User $user){
            return $user->isSuperAdmin();
        });

        Gate::define("isAdmin", function (User $user){
            return $user->isSuperAdmin();
        });


    }
}
