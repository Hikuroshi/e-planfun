<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('subbag-tu-rungga', function(User $user){
            return $user->role->slug === 'subbag-tu-rungga';
        });
        Gate::define('subag-humas-protokol', function(User $user){
            return $user->role->slug === 'subag-humas-protokol';
        });
        Gate::define('kasubag-perencanaan', function(User $user){
            return $user->role->slug === 'kasubag-perencanaan';
        });
        Gate::define('kepala-kantor', function(User $user){
            return $user->role->slug === 'kepala-kantor';
        });
        Gate::define('pejabat-pembuat-komitmen', function(User $user){
            return $user->role->slug === 'pejabat-pembuat-komitmen';
        });
        Gate::define('kabag-perencanaan', function(User $user){
            return $user->role->slug === 'kabag-perencanaan';
        });
        Gate::define('sekjen', function(User $user){
            return $user->role->slug === 'sekjen';
        });

        Gate::define('operator', function(User $user){
            return $user->role->slug == 'subbag-tu-rungga' ||
                    $user->role->slug == 'subag-humas-protokol';
        });
        Gate::define('verifikator', function(User $user){
            return $user->role->slug == 'kasubag-perencanaan' ||
                    $user->role->slug == 'kepala-kantor' ||
                    $user->role->slug == 'pejabat-pembuat-komitmen' ||
                    $user->role->slug == 'kabag-perencanaan' ||
                    $user->role->slug == 'sekjen';
        });
    }
}
