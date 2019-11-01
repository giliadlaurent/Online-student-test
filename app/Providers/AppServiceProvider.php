<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('access_mod', function($attribute, $value, $parameters, $validator) {
            if (Auth::user()->isAdministrator()) {
                return true;
            }

            if (Auth::user()->isModerator()) {
                return $value < 3;
            }
            return false;

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
