<?php

namespace App\Services\User;

use App\Interfaces\Requests\User\UserCreateInterface;
use Illuminate\Support\Facades\Facade;

/**
 * App\Services\User\UserFacade
 *
 * @method static addUser(UserCreateInterface $data)
 */
class UserFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'userService'; }
}
