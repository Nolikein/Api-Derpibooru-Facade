<?php

namespace Nolikein\ApiDerpibooruFacade;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class DerpibooruApiFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!app()->configurationIsCached()) {
            $this->mergeConfigFrom(dirname(__DIR__) . '/config/derpibooru_api.php', 'derpibooru_api');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/derpibooru_api.php' => config_path('derpibooru_api.php')
        ], 'api-derpibooru-facade-config');

        $this->publishes([
            dirname(__DIR__) . '/tests' => base_path('tests/DerpibooruApiFacade')
        ], 'api-derpibooru-facade-tests');
    }
}
