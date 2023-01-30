<?php

namespace App\DTO\Link;

use App\Models\User;

class LinkItemDTO
{
    public function __construct(
      public readonly User $user,
      public readonly string $link_code,
      public readonly ?int $id = null,
      public readonly ?string $created_at = null,
    ) {}
}
