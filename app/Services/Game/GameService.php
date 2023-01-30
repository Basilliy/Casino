<?php

namespace App\Services\Game;

use App\DTO\Game\GameItemDTO;
use App\Interfaces\Repositories\GameInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GameService
{
    public function __construct(protected GameInterface $repo)
    {}

    public function removePastsGamesForUser(User $user): bool
    {
        $games = $this->getUserGames($user);

        $games = $games->slice(0, -2);

        $ids = $games->pluck('id')->toArray();

        if (!empty($ids)) {
            return $this->repo->multiDelete(ids: $ids);
        }

        return true;
    }

    public function getUserGames(User $user): Collection
    {
        return $this->repo->filter(user: $user);
    }
    public function new(User $user): ?Model
    {
        $price = 0;
        $number = rand(0, 1000);

        $result = $this->getResult($number);

        if ($result) {
            $price = $this->getPrice($number);
        }

        $gameItem = new GameItemDTO(
            user: $user,
            number: $number,
            status: $result,
            sum: $price
        );

        return $this->repo->create(gameItemDTO: $gameItem);
    }

    protected function getResult(int $number): bool
    {
        return $number %2 === 0;
    }

    protected function getPrice(int $number): int
    {
        $price = match (true) {
            $number > 900 => $number * 0.7,
            $number > 600 => $number * 0.5,
            $number > 300 => $number * 0.3,
            default => $number * 0.1,
        };

        return round($price);
    }
}
