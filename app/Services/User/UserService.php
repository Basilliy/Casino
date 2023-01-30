<?php

namespace App\Services\User;

use App\Interfaces\Repositories\UserInterface;
use App\Interfaces\Requests\User\UserCreateInterface;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * UserService constructor.
     * @param UserInterface $repo
     */
    public function __construct(protected UserInterface $repo)
    {}

    /**
     * @param UserCreateInterface $data
     * @return Model|null
     */
    public function addUser(UserCreateInterface $data): ?Model
    {
        return $this->repo->saveUser($data);
    }
}
