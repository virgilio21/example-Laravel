<?php

namespace App\Providers;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Llave y parametros adicionales
        //dms direct messages :> mi llave :o
        Gate::define('dms', function(User $user, User $otherUser){

            //Solo si se siguen mutuamente dara true.
            return $user->isfollowing($otherUser) && $otherUser->isfollowing($user);

        });
    }
}
