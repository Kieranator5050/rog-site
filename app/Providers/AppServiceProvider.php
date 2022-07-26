<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (App::environment('production')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Fixing deployment string length issue
        Schema::defaultStringLength(191);

        //Adding paginate method to collection
        if (!Collection::hasMacro('paginate')) {
            Collection::macro('paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                        ->withPath('');
                });
        }

        /*
         * Authorization Roles Definitions
         */
        Gate::define('Admin', function(User $user){
            return $user->isAdmin==1;
        });

        Gate::define('TeamLead', function(User $user){
            return $user->isTeamLead==1;
        });

        Gate::define('Quartermaster', function(User $user){
            return $user->isQuartermaster==1;
        });

        Gate::define('MissionMaker', function(User $user){
            return $user->isMissionMaker==1;
        });
    }
}
