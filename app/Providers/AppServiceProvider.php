<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::defaultView('pagination');
        View::share('year', date('Y'));

        //  Gate::before(function (User $user, string $ability) {
        //     return true;
        //  });
        //     if ($user->isAdmin()) {
        //         return true;
        //     }
        //     if ($user->isGuest()) {
        //         return false;
        //     }
        // });

// will use policies vs. gates
        // Gate::define('update-car', function (User $user, Car $car) {
        //     return $user->id === $car->user_id ? Response::allow()
        //         : Response::denyWithStatus(404);
        // });

        // Gate::define('delete-car', function (User $user, Car $car) {
        //     return $user->id === $car->user_id ? Response::allow()
        //         : Response::denyWithStatus(404);
        // });



    }
}
