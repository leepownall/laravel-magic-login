<?php

use Illuminate\Support\Facades\Route;
use Pownall\MagicLogin\Http\Controllers\LoginUser;

Route::get('magic-login/{user_id}', LoginUser::class)
    ->middleware('web')
    ->name('magic-login');
