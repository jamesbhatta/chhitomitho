<?php

namespace App\Providers;

use App\LedgerEntry;
use App\Order;
use App\Policies\LedgerPolicy;
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
        LedgerEntry::class => LedgerPolicy::class,
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

        Gate::define('manage-sliders', function ($user) {
            return $user->hasRoles(['admin']);
        });

        Gate::define('manage-logs', function ($user) {
            return $user->hasRoles(['admin']);
        });

        Gate::define('viewTransactions', function ($user, \App\Store $store) {
            return true;
        });

        Gate::define('request-payment', function ($user, \App\Store $store) {
            return $user->id == $store->user_id;
        });

       
    }
}
