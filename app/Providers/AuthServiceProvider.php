<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::before(function (Admin $user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        Gate::define( 'update-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });
        
        Gate::define('delete-post', function (Admin $user, $post) {
            if($user->isSuperAdmin()) {
                return true;
            }
            return false;
        });

        Gate::define('super-admin', function ($user) {
            if($user->isSuperAdmin()) {
                return true;
            }
            return false;
        });

        
    }
}
