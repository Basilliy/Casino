<?php

namespace App\Services\Link;

use App\Repositories\Link\LinkRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\Link;

class LinkServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\LinkInterface', function($app) {
            return new LinkRepository(new Link());
        });

        $this->app->bind('linkService', function($app) {
            return new LinkService(
                $app->make('App\Interfaces\Repositories\LinkInterface')
            );
        });
    }
}
