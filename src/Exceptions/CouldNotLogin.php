<?php

namespace Pownall\MagicLogin\Exceptions;

use Exception;

class CouldNotLogin extends Exception
{
    public static function hasInvalidSignatureOrHasExpired(): self
    {
        return new static("The signature is invalid or the link has expired.");
    }
}
