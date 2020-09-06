<?php

namespace Pownall\MagicLogin\Tests\Feature;

use Carbon\Carbon;
use Pownall\MagicLogin\Exceptions\CouldNotLogin;
use Pownall\MagicLogin\MagicLogin;
use Pownall\MagicLogin\Tests\TestCase;
use Pownall\MagicLogin\Tests\User;

class MagicLoginTest extends TestCase
{
    /** @test */
    public function can_login()
    {
        $user = factory(User::class)->create();

        $this->assertGuest();

        $url = MagicLogin::forUser($user)->generate();

        $this->get($url);

        $this->assertAuthenticated();
    }

    /** @test */
    public function cannot_login_if_signature_invalid()
    {
        $this->withoutExceptionHandling();

        $this->expectException(CouldNotLogin::class);
        $this->expectExceptionMessage('The signature is invalid or the link has expired.');

        Carbon::setTestNow('2020-09-01 13:00:00');

        factory(User::class)->create();

        $this->assertGuest();

        $url = 'http://localhost/magic-login/1
            ?expires=1598968800
            &redirect_to_url=%2F
            &user_class=pownall-magic_login-tests-user
            &signature=invalid-signature';

        $this->get($url);

        $this->assertGuest();
    }

    /** @test */
    public function cannot_login_if_link_expired()
    {
        $this->withoutExceptionHandling();

        $this->expectException(CouldNotLogin::class);
        $this->expectExceptionMessage('The signature is invalid or the link has expired.');

        Carbon::setTestNow('2020-09-01 13:00:00');

        $user = factory(User::class)->create();

        $this->assertGuest();

        $url = MagicLogin::forUser($user)->expiresAt(now()->addMinutes(5))->generate();

        Carbon::setTestNow('2020-09-01 13:10:00');

        $this->get($url);

        $this->assertGuest();
    }

    /** @test */
    public function can_login_and_be_redirected()
    {
        $user = factory(User::class)->create();

        $this->assertGuest();

        $url = MagicLogin::forUser($user)->generate();

        $this->get($url);
    }
}
