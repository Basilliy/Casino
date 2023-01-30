<?php

namespace App\Services\Game;

use App\Models\Game;
use App\Repositories\Game\GameRepository;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\GameInterface', function($app) {
            return new GameRepository(new Game());
        });

        $this->app->bind('gameService', function($app) {
            return new GameService(
                $app->make('App\Interfaces\Repositories\GameInterface')
            );
        });
    }
}
