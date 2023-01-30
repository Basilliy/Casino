<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\LinkCreateRequest;
use App\Http\Requests\Link\LinkInfoRequest;
use App\Services\Link\LinkFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function info(LinkInfoRequest $linkInfoRequest): View
    {
        return view('link.info', ['link_code'=> $linkInfoRequest->getLinkCode()]);
    }

    public function new(LinkCreateRequest $linkCreateRequest): JsonResponse
    {
        $user = LinkFacade::getUserToLink($linkCreateRequest->getLinkCode());

        $newLink = LinkFacade::addLink(user: $user);

        return new JsonResponse(['link' => route('link.info', ['code' => $newLink->link_code])], 200);
    }

    public function deactivate(LinkCreateRequest $linkCreateRequest): JsonResponse
    {
        if (LinkFacade::deactivateLink($linkCreateRequest->getLinkCode())) {
            return new JsonResponse(['status' => true], 200);
        }

        return new JsonResponse(['status' => false], 404);
    }
}
