<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Artist;

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

        // define if user has the following roles or has created the request
        Gate::define('admin', fn(User $user) => $user->hasRole('admin'));
        Gate::define('likable', fn(User $user) => $user->hasRole('user') || $user->hasRole('admin'));
        Gate::define('favouritable', fn(User $user) => $user->hasRole('user') || $user->hasRole('admin'));
        Gate::define('artist', fn(User $user) => $user->hasRole('artist'));
        Gate::define('isArtist', fn(User $user, $artist) => $user->id == $artist->users->id);
        Gate::define('isClient', fn(User $user, $request) => $user->id == $request->user_id || $user->hasRole('admin'));
        
    }
}
