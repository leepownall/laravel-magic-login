<?php

namespace Pownall\MagicLogin;

use Illuminate\Foundation\Auth\User;

class MagicLogin
{
    public static function forUser(User $user): PendingMagicLogin
    {
        return new PendingMagicLogin($user);
    }
}
