<?php

namespace App\DTO\Game;

use App\Models\User;

class GameItemDTO
{
    public function __construct(
        public readonly User $user,
        public readonly int $number,
        public readonly bool $status,
        public readonly int $sum,
        public readonly ?int $id = null,
    ) {}
}
