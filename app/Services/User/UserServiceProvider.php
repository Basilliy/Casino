<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\UserInterface', function($app) {
            return new UserRepository(new User());
        });

        $this->app->bind('userService', function($app) {
            return new UserService(
                $app->make('App\Interfaces\Repositories\UserInterface')
            );
        });
    }
}
