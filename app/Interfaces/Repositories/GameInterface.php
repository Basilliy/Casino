<?php

namespace App\Interfaces\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\DTO\Game\GameItemDTO;

interface GameInterface
{
    public function create(GameItemDTO $gameItemDTO): ?Model;

    public function filter(?User $user = null, ?bool $status = null): Collection;

    public function multiDelete(array $ids): bool;
}
