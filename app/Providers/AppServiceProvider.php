<?php

namespace App\Providers;

use App\Models\User;
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
        //
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
