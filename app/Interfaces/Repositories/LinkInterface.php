<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\DTO\Link\LinkItemDTO;
use App\Models\User;

interface LinkInterface
{
    public function createLink(LinkItemDTO $linkItemDTO): ?Model;

    public function filter(?string $linkCode = null, ?User $user = null): Collection;

    public function update(LinkItemDTO $linkItemDTO): bool;
}
