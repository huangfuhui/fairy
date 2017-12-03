<?php

namespace App\Providers;

use App\Services\AntService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AntServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ant', function () {
            $baseUri = config('ant.base_uri');
            $client  = new Client(['base_uri' => $baseUri]);

            return new AntService($client);
        });
    }
}
