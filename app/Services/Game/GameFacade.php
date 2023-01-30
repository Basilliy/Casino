<?php

namespace App\Services\Game;

use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * App\Services\Link\LinkFacade
 *
 * @method static new(User $user)
 * @method static getUserGames(User $user)
 * @method static removePastsGamesForUser(User $user)
 */
class GameFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'gameService'; }
}
