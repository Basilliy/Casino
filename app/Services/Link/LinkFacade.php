<?php

namespace App\Services\Link;

use Illuminate\Support\Facades\Facade;
use App\Models\User;

/**
 * App\Services\Link\LinkFacade
 *
 * @method static addLink(User $user)
 * @method static getUserToLink(string $linkCode)
 * @method static deactivateLink(string $linkCode)
 */
class LinkFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'linkService'; }
}
