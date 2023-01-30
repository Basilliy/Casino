<?php

namespace App\Repositories\Link;

use App\DTO\Link\LinkItemDTO;
use App\Interfaces\Repositories\LinkInterface;
use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LinkRepository implements LinkInterface
{
    /**
     * LinkRepository constructor.
     * @param Link $model
     */
    public function __construct(protected Link $model)
    {}

    /**
     * @param LinkItemDTO $linkItemDTO
     * @return Model|null
     */
    public function createLink(LinkItemDTO $linkItemDTO): ?Model
    {
        try {
            $link = new $this->model();
            $link->fill([
                'user_id'   => $linkItemDTO->user->id,
                'link_code' => $linkItemDTO->link_code,
            ]);
            $link->save();

            return $link;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * @param string|null $linkCode
     * @param User|null $user
     * @return Collection
     */
    public function filter(?string $linkCode = null, ?User $user = null): Collection
    {
        return $this->model
            ->newQuery()
            ->when($linkCode, function ($query, $search){
                return $query->where('link_code','=', $search);
            })
            ->when($user, function ($query, $user){
                return $query->where('user_id','=', $user->id);
            })
            ->get();
    }

    /**
     * @param LinkItemDTO $linkItemDTO
     * @return bool
     */
    public function update(LinkItemDTO $linkItemDTO): bool
    {
        return (bool)$this->model
            ->newQuery()
            ->where('id', $linkItemDTO->id)
            ->update([
                'user_id'       => $linkItemDTO->user->id,
                'link_code'     => $linkItemDTO->link_code,
                'created_at'    => $linkItemDTO->created_at
            ]);
    }
}
