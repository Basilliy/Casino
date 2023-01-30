<?php

namespace App\Interfaces\Requests\User;

interface UserCreateInterface
{
    public function getUserName(): string;

    public function getPhoneNumber(): string;
}
