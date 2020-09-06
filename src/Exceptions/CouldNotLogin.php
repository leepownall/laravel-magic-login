<?php

namespace Pownall\MagicLogin\Exceptions;

use Exception;

class CouldNotLogin extends Exception
{
    public static function hasInvalidSignature(string $signature): self
    {
        return new static("The signature `{$signature}` is invalid.");
    }
}
