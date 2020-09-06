<?php

namespace Pownall\MagicLogin;

use Carbon\CarbonInterface;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\URL;

class PendingMagicLogin
{
    private User $user;

    private CarbonInterface $expiresAt;

    private string $redirectToUrl = '/';

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->expiresAt = now()->addHour();
    }

    public function expiresAt(CarbonInterface $pointInTime): self
    {
        $this->expiresAt = $pointInTime;

        return $this;
    }

    public function redirectToUrl(string $url): self
    {
        $this->redirectToUrl = $url;

        return $this;
    }

    public function generate(): string
    {
        $key = $this->user->getKeyName();

        return URL::temporarySignedRoute(
            'magic-login',
            $this->expiresAt,
            [
                'user_id' => $this->user->{$key},
                'redirect_to_url' => $this->redirectToUrl,
                'user_class' => UserClass::toSlug(get_class($this->user)),
            ]
        );
    }
}
