<?php

namespace Pownall\MagicLogin\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Pownall\MagicLogin\Exceptions\CouldNotLogin;
use Pownall\MagicLogin\UserClass;

class LoginUser extends Controller
{
    public function __invoke(Request $request, string $userId): RedirectResponse
    {
        throw_unless($request->hasValidSignature(), CouldNotLogin::hasInvalidSignatureOrHasExpired());

        /** @var Model $userModel */
        $userModel = UserClass::fromSlug($request->get('user_class'));

        /** @var Authenticatable $user */
        $user = $userModel::findOrFail($userId);

        Auth::guard('web')->login($user);

        return redirect()->to($request->get('redirect_to_url'));
    }
}
