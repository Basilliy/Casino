<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Game\GameHistoryRequest;
use App\Http\Requests\Game\GameCreateRequest;
use App\Http\Resources\GamesCollection;
use App\Http\Resources\GamesResource;
use App\Services\Game\GameFacade;
use App\Services\Link\LinkFacade;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function game(GameCreateRequest $gameCreateRequest): JsonResponse|JsonResource
    {
        $user = LinkFacade::getUserToLink($gameCreateRequest->getLinkCode());

        GameFacade::removePastsGamesForUser(user:  $user);

        $game = GameFacade::new(user: $user);

        if ($game === null) {
            return new JsonResponse(['error' => 'some wrong'], 404);
        }

        return new GamesResource($game);
    }

    public function history(GameHistoryRequest $gameHistoryRequest): ResourceCollection
    {
        $user = LinkFacade::getUserToLink($gameHistoryRequest->getLinkCode());

        return new GamesCollection(GameFacade::getUserGames($user));
    }
}
