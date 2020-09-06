<?php

namespace Pownall\MagicLogin\Tests\Unit;

use Pownall\MagicLogin\Tests\TestCase;
use Pownall\MagicLogin\UserClass;

class UserClassTest extends TestCase
{
    /** @test **/
    public function make_from_class()
    {
        $slug = UserClass::toSlug('HelloWorld\\ModelsFolder\\User');

        $this->assertEquals('hello_world-models_folder-user', $slug);
    }

    /** @test **/
    public function make_from_slug()
    {
        $userClass = UserClass::fromSlug('hello_world-models_folder-user');

        $this->assertEquals('HelloWorld\\ModelsFolder\\User', $userClass);
    }
}
