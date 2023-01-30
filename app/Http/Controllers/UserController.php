<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Services\Link\LinkFacade;
use Illuminate\Http\RedirectResponse;
use App\Services\User\UserFacade;

class UserController extends Controller
{
    public function create(UserCreateRequest $request): RedirectResponse
    {
        $user = UserFacade::addUser(data: $request);

        if ($user) {
            $link = LinkFacade::addLink(user: $user);
            return redirect()->back()->withSuccess([route('link.info', ['code' => $link->link_code])]);
        }

        return redirect()->back()->withErrors(['form' => 'Some Error']);
    }
}
