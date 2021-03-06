<?php

/*
 * (c) Kevin Orriss <hello@kevinorriss.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KevinOrriss\ClientTimezone;

use Exception;
use Illuminate\Support\ServiceProvider;

/**
 * Registers classes and loads views into application
 */
class ClientTimezoneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (strcmp(config('app.timezone'), 'UTC') != 0)
        {
            throw new Exception("ClientTimezone requires timezone to be set to UTC in /config/app.php");
        }

        $this->loadViewsFrom(__DIR__ . '/views', 'clienttimezone');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('KevinOrriss\ClientTimezone\ClientTimezone');
        $this->app->make('KevinOrriss\ClientTimezone\ClientTimezoneController');
    }
}
