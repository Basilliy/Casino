<?php

namespace App\Repositories\User;

use App\Interfaces\Requests\User\UserCreateInterface;
use App\Interfaces\Repositories\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserInterface
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(protected User $model)
    {}

    /**
     * @param UserCreateInterface $data
     * @return Model|null
     */
    public function saveUser(UserCreateInterface $data): ?Model
    {
        try {
            $model = new $this->model();
            $model->fill([
                'name'       => $data->getUserName(),
                'phone'      => $data->getPhoneNumber(),
            ]);
            $model->save();

            return $model;
        } catch (\Exception $exception) {
            return null;
        }
    }
}
