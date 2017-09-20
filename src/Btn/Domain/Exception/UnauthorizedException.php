<?php

namespace Btn\Domain\Exception;

class UnauthorizedException extends \Exception
{
    public static function create($message)
    {
        return new self($message);
    }
}
