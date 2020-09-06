<?php

namespace Pownall\MagicLogin\Tests\Unit;

use Carbon\Carbon;
use Pownall\MagicLogin\MagicLogin;
use Pownall\MagicLogin\Tests\TestCase;
use Pownall\MagicLogin\Tests\User;
use Spatie\Url\Url;

class MagicLoginTest extends TestCase
{
    /** @test */
    public function can_make_for_user()
    {
        $user = factory(User::class)->create();

        $url = MagicLogin::forUser($user)->generate();

        $this->assertEquals(
            1,
            Url::fromString($url)->getSegment(2)
        );
    }

    /** @test */
    public function can_alter_expires_at_date()
    {
        Carbon::setTestNow('2020-09-01 13:00:00');

        $user = factory(User::class)->create();

        $url = MagicLogin::forUser($user)
            ->expiresAt(now()->addMinutes(30))
            ->generate();

        $this->assertEquals(
            '1598967000',
            Url::fromString($url)->getQueryParameter('expires')
        );
    }

    /** @test */
    public function can_add_redirect_to_url()
    {
        $user = factory(User::class)->create();

        $url = MagicLogin::forUser($user)
            ->redirectToUrl('http://google.com')
            ->generate();

        $this->assertEquals(
            'http://google.com',
            Url::fromString($url)->getQueryParameter('redirect_to_url')
        );
    }
}
