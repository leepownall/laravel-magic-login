<?php

namespace Pownall\MagicLogin;

use Illuminate\Support\Str;

class UserClass
{
    public static function toSlug(string $class): string
    {
        return Str::of($class)
            ->explode('\\')
            ->map(fn (string $piece): string => Str::snake($piece))
            ->implode('-');
    }

    public static function fromSlug(string $slug): string
    {
        return Str::of($slug)
            ->explode('-')
            ->map(fn (string $piece): string => ucfirst(Str::studly($piece)))
            ->implode('\\');
    }
}
