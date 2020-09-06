<?php

namespace Pownall\MagicLogin;

use Illuminate\Support\ServiceProvider;

class MagicLoginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
