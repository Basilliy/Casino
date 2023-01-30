<?php

namespace App\Repositories\Game;

use App\DTO\Game\GameItemDTO;
use App\Interfaces\Repositories\GameInterface;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GameRepository implements GameInterface
{
    /**
     * @param Game $model
     */
    public function __construct(protected Game $model)
    {}

    /**
     * @param GameItemDTO $gameItemDTO
     * @return Model|null
     */
    public function create(GameItemDTO $gameItemDTO): ?Model
    {
        try {
            $link = new $this->model();
            $link->fill([
                'user_id'   => $gameItemDTO->user->id,
                'number'    => $gameItemDTO->number,
                'status'    => $gameItemDTO->status,
                'sum'       => $gameItemDTO->sum,
            ]);
            $link->save();

            return $link;
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * @param User|null $user
     * @param bool|null $status
     * @return Collection
     */
    public function filter(?User $user = null, ?bool $status = null): Collection
    {
        return $this->model
            ->newQuery()
            ->when($user, function ($query, $user){
                return $query->where('user_id', '=', $user->id);
            })
            ->when($status !== null, function ($query, $search) use ($status){
                return $query->where('status', $status);
            })
            ->get();
    }

    public function multiDelete(array $ids): bool
    {
        return $this->model->newQuery()->whereIn('id', $ids)->delete();
    }
}
