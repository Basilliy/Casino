<?php

namespace App\Services\Link;

use App\DTO\Link\LinkItemDTO;
use App\Interfaces\Repositories\LinkInterface;
use App\Models\Link;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LinkService
{
    public function __construct(protected LinkInterface $repo)
    {}

    public function addLink(User $user): ?Model
    {
        $linkItemDTO = new LinkItemDTO(
            user: $user,
            link_code: md5($user->id.$user->name.$user->phone.now())
        );

        return $this->repo->createLink($linkItemDTO);
    }

    public function getUserToLink(string $linkCode): ?User
    {
        $links = $this->repo->filter(linkCode: $linkCode);

        return $links->isNotEmpty() ? $links->first()->user : null;
    }

    public function deactivateLink(string $linkCode): bool
    {
        $links = $this->repo->filter(linkCode: $linkCode);

        if($links->isEmpty()) {
            return false;
        }

        /** @var Link $link */
        $link = $links->first();

        $linkItem = new LinkItemDTO(
            user: $link->user,
            link_code: $link->link_code,
            id: $link->id,
            created_at: Carbon::now()->subDays(8)->format('Y-m-d H:i:s')
        );

        return $this->repo->update($linkItem);
    }
}
