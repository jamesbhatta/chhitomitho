<?php

namespace App\Providers;

use App\Order;
use App\Policies\OrderPolicy;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-backend', function ($user) {
            return $user->hasRoles(['admin', 'manager', 'partner', 'courier' ]);
        });

        Gate::define('access-orders', function ($user) {
            return $user->hasRoles(['admin', 'manager', 'partner', 'courier' ]);
        });

        Gate::define('manage-categories', function ($user) {
            return $user->hasRoles(['admin']);
        });

        Gate::define('manage-products', function ($user) {
            return $user->hasRoles(['admin']);
        });

        Gate::define('manage-users', function ($user) {
            return $user->hasRoles(['admin']);
        });

        Gate::define('manage-stores', function ($user) {
            return $user->hasRoles(['admin']);
        });
    }
}
