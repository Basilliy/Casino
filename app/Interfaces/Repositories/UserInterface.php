<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Requests\User\UserCreateInterface;
use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    public function saveUser(UserCreateInterface $data): ?Model;
}
