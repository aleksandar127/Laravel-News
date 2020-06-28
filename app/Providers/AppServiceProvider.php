<?php

namespace App\Providers;

use App\User;
use App\Locator;
use App\Weather;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('notification', function ($app) {
            if (auth()->user()) {
                return auth()->user()->unreadNotifications;
            } else {
                $u = new User();
                return $u->unreadNotifications;
            }
        });

        $this->app->bind('weather', function ($app) {
            $locator = new Locator();
            $weatherObj =  new Weather($locator);
            return $weatherObj->getData();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
